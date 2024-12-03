<script type="text/javascript">
$(document).ready(function() {
	
	//if submit button is clicked
	$('#submit').click(function () {		
		var urlbaseDir = "<?php echo Yii::app()->request->baseUrl;?>";
		var comment = $('textarea[name=comment]');
		if (comment.val()=='') {
			comment.addClass('hightlight');
			return false;
		} else comment.removeClass('hightlight');
		
		//organize the data properly
		var data =  'comment='  + encodeURIComponent(comment.val());
		
		//disabled all the text fields
		$('.text').attr('disabled','true');
		
		//show the loading sign
		$('.loading').show();
		
		//start the ajax
		$.ajax({
			//this is the php file that processes the data and send mail
			url: urlbaseDir + '/profile/process',	
			 
			//GET method is used
			type: "POST",

			//pass the data			
			data: data,		
			
			//Do not cache the page
			cache: false,
			
			//success
			success: function (html) {				
					$('.form').fadeOut('slow');					
					
					//show the success message
					$('.done').fadeIn('slow');
						
			}		
		});
		
		//cancel the submit button default behaviours
		return false;
	});	
});	
</script>
<script>
$(document).ready(function(){
	$('#message_body').focus(function(){
		if($(this).attr("placeholder"))
		$(this).attr("placeholder",'');
	})
	
	$('#message_body').blur(function(){
		if($(this).attr("placeholder") == '')
		$(this).attr("placeholder",'Message');
	})
})
</script>
<style>
.customerror{
background: none repeat scroll 0 0 #FFE5E5;
    border: 1px solid #FCCACA;
    border-radius: 3px 3px 3px 3px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    color: #EE0000;
    font: 13px Arial,Helvetica,sans-serif;
    margin-bottom: 10px;
    padding: 10px;
	}
</style>
<article class="container">
	 	<em class="shadow_1"></em>
	 	<div class="wrapper">
        	<div class="succes_msg" style="display:none;"></div>
			<div class="white_body">
				<div class="left_container">
					<div class="left_block equal">
						<!-- message list -->
						<section class="top_block">
                    	<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation') ?>
                        </section>
                        <section class="content_block2">
							<div class="form" style="padding-left:50px;">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id'=>'message-form',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array('class'=>'login_form'),
	)); ?>

<div style="clear:both">&nbsp;</div>
	<p class="note"><b><?php echo MessageModule::t('Fields with <span class="required">*</span> are required.'); ?></b></p>
<div style="clear:both">&nbsp;</div>
	
	<?php
    if($form->error($model, 'receiver_id')!='')
	{
	?>
	<?php echo $form->errorSummary($model); ?>
	<?php
	}else{
	?>
    <div style="display:none" class="customerror">
    </div>
	<?php
	}
	
	
	if(isset($_REQUEST['sendto']))
	{
		 $receiverName = base64_decode(trim($_REQUEST['sendto']));
	    $receiverid = base64_decode(trim($_REQUEST['sid']));

	}else
	{
		$receiverid='';
	}
	
	?>
<p class="textbox1">
<?php  
	$user_friend=Yii::app()->db->createCommand("select * from user_friends where status='1' and 
	user_id='".Yii::app()->user->getId()."' OR status='1' and friend_id='".Yii::app()->user->getId()."'")->queryAll();
	
	$user_array = array();
	foreach($user_friend as $val)
	{
		if($val['user_id']==Yii::app()->user->getId())
		{
		 $user=Yii::app()->db->createCommand("select * from users where id='".$val['friend_id']."'")->queryAll();
		 $user_array[$user[0]['id']]=$user[0]['username'];				  
		}
		elseif($val['friend_id']==Yii::app()->user->getId())
		{
		 $user=Yii::app()->db->createCommand("select * from users where id='".$val['user_id']."'")->queryAll();
		 $user_array[$user[0]['id']]=$user[0]['username'];				  
		}
	}	
	
	echo $form->dropDownList($model,'receiver_id',$user_array,array('class'=>'styled','prompt'=>'receiver','options' => array($receiverid=>array('selected'=>true))));
 ?>
</p>

<div class="row"></div>
	
<p class="textbox1">
<?php echo $form->hiddenField($model,'subject',array('size'=>20,'maxlength'=>20,'placeholder'=>'subject','value'=>'subject')); ?>
<?php echo $form->error($model,'subject'); ?>
</p>
<div style="clear:both">&nbsp;</div>
	<div class="row"></div>
<p>
<?php echo $form->textArea($model,'body',array('placeholder'=>'Message','class'=>'txtara','id'=>'message_body')); ?>
<em></em>
<?php echo $form->error($model,'body'); ?>
</p>
	<div class="row"></div>
	
<div style="clear:both">&nbsp;</div>
	<div class="row buttons">
    <p class="greenbtn messagegreen">
      	<?php echo CHtml::submitButton(MessageModule::t("Send"),array('id'=>'sendmessage')); ?><em></em></p>
	</div>
<div style="clear:both">&nbsp;</div>
	<?php $this->endWidget(); ?>

</div>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_suggest'); ?>

                        </section>
                        <!-- message list End -->
					</div>
				</div>
				<div class="right_container equal">
                
                <?php  $this->widget('application.modules.user.components.sideprofilewidget'); ?>                 
                                  
                	<section class="block-space">
                     <?php  $this->widget('application.components.sitecomment'); ?>
					</section>
                </div>
                <div class="clear"></div>
			</div>
		</div>
	 </article>
<script type="text/javascript">
$(document).ready(function()
{
		$('textarea').autogrow();
		window.setInterval(yourfunction, 1000);
		function yourfunction() { 
		
		if($('#receiver').val()=='')
		{
			$('#Message_receiver_id').val('');
			$("p.messagegreen").css("opacity","0.3");
			 $('#sendmessage').attr("disabled", true);
		}
		if($('textarea').val()!='')
		   {
			 	if($('#Message_receiver_id').val()=='')
				 {
					if($('#receiver').val()!='')
					{ 	
						$.ajax({
						type:'POST',
						url:"<?php echo $this->createUrl('suggest/isvaliduser') ?>",
						data:'tmpconformtxt=' + $('#receiver').val(),
						success:function (t) {
						  console.log('>>>>'+t);
						  if(t!='error')
						{
							$('#Message_receiver_id').val(t);
							 $("p.messagegreen").css("opacity","1.0");
							  $('#sendmessage').attr("disabled", false);
						}else
						{
							$('#Message_receiver_id').val(''); 
							$("p.messagegreen").css("opacity","0.3");
							$('#sendmessage').attr("disabled", true);
						}
						}});
					}
					
					
				  $('.customerror').html('<p>Please select valid Username</p>').show('slow');
				 $("p.messagegreen").css("opacity","0.3");
				  $('#sendmessage').attr("disabled", true);
				   console.log('text field ::'+$('#receiver').val()); 
				 }else
				 {
					  $('.customerror').html('').hide('slow');
					 $("p.messagegreen").css("opacity","1.0");
					  $('#sendmessage').attr("disabled", false);
				 }
		   }
		}
});
</script>	 
