

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
var time_interval = setInterval(
 function ()   {
  $.ajax({
			  url: "<?php echo Yii::app()->request->baseUrl;?>/message/view/dropdownrefresh?message_id=<?php echo $_GET['message_id']?>",
			  type : 'post',
			  cache: false,
			  success: function(html){
				$("#dropdown").html(html);
			  }
			})
   }, 5000);

</script>


<?php $this->pageTitle=Yii::app()->name . ' - ' . MessageModule::t("Compose Message"); ?>
<?php //$isIncomeMessage = $sentMessage->receiver_id == Yii::app()->user->getId() ?>

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
					<aside class="msg_profile">
								<?php
								//echo $sentMessage[0]->receiver_id;die; 
								if($sentMessage[0]->sender_id==Yii::app()->user->getId())
								 {
									 $photoid=$sentMessage[0]->receiver_id;
								 }else
								 {
									 $photoid=$sentMessage[0]->sender_id;
								 }
								$sendermodel = User::model()->findByAttributes(array('id'=>$photoid));
								
								if($sendermodel->profile->avatar!=NULL)
                                {
                                $circularthumbimg=Yii::app()->request->baseUrl.'/'.$sendermodel->profile->avatar;
                                }else{
                                $circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/default.jpg';
                                }
                                ?><figure>
                                <div class="pro_img circular" style="background: url(<?php echo $circularthumbimg; ?>) no-repeat;"><img src="<?php echo $circularthumbimg; ?>" />
                                </div></figure>
								<div class="msg_title">
                                <h4 class="message-to">To: 
								<?php 
								$getReceiverName= User::model()->findByAttributes(array('id'=>$sentMessage[0]->receiver_id));
								echo CHtml::link($getReceiverName->username,array('/user/profile/'.$getReceiverName->username)); ?></h4>
                               
									<p class="msg">
									<?php
										 if(strlen($sentMessage[0]->subject)>30)
										{
											echo strrev(stristr(strrev(substr(CHtml::encode($sentMessage[0]->subject),
											0,30)),' '))." ...";
										}elseif(strlen($sentMessage[0]->subject)==0)
										{
											echo '';
										}
										else
										{
											echo CHtml::encode($sentMessage[0]->subject);
										}
										?>
										</p>
									<p class="date">
                                    <?php $tmp=date(Yii::app()->getModule('message')->dateFormat, strtotime($sentMessage[0]->created_at));
									$date = new DateTime($tmp);
									echo $date->format('l, F jS');
                                    ?>.</p>
								</div>
								<div class="right top_space" id="dropdown">
									<div class="dropdown s_dropdown"  id="vmaction">
										<span class="select">Actions</span>
										<ul>
											<li id="spam"><span>Mark as spam</span></li>
                                            
                                            <?php 
											
											$user_Senderon=Yii::app()->db->createCommand("select * from online_users where user_id='".$sentMessage[0]->sender_id."' and online=1")->queryRow();
											$user_Receiveron=Yii::app()->db->createCommand("select * from online_users where user_id='".$sentMessage[0]->receiver_id."' and online=1")->queryRow();
											if($sentMessage[0]->sender_id!=Yii::app()->user->getId())
											{
                                            if($user_Senderon){?>
                                            <li id="chat"><span onclick="javascript:chatWith('<?php echo $sentMessage[0]->getSenderName(); ?>')">Chat</span></li><?php }}elseif($viewedMessage->receiver_id!=Yii::app()->user->getId())
											{ 
											if($user_Receiveron){?><li id="chat"><span onclick="javascript:chatWith('<?php echo $sentMessage[0]->getReceiverName(); ?>')">Chat</span></li><?php }}?>
											<li id="delete"><span>Delete</span></li>
										</ul>
									</div>
								</div>
								<div class="clear"></div>
							</aside>
                        </section>
                        <section class="content_block2">
                        	<aside class="msg_text_block">
								<div class="msg_text" >
                              <p><?php 
							echo nl2br(CHtml::decode($sentMessage[0]->body));
							  ?></p>
								</div>
							</aside>
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
	$(document).ready(function() {
	
	$('div #vmaction li').click(function()
	{

	    if($(this).attr('id')=='delete')   
		{
			var confmsg=confirm('Do you want to delete the message?');
			var msgid=<?php echo $_GET['message_id']?>;
			if(confmsg)
			$.ajax({
			type : 'GET', 
			url: "<?php echo Yii::app()->request->baseUrl;?>/message/delete",
			datatype: "json",
			data: { id: msgid,actiontype:'ajax'},
			success: function(complete){
			window.location="<?php echo Yii::app()->request->baseUrl;?>/message";
				}
			})
			return false;
		}
	     if($(this).attr('id')=='spam')    
		 {
		    var msgid=$('#Message_parent_id').val();
			$.ajax({
			type : 'GET', 
			url: "<?php echo Yii::app()->request->baseUrl;?>/message/spam",
			datatype: "json",
			data: { id: msgid,actiontype:'ajax'},
			success: function(complete){
			window.location="<?php echo Yii::app()->request->baseUrl;?>/message";
				}
			})
			return false;
			 
			 
		 }
	});
	
	});
     </script>