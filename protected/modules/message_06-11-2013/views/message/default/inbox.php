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
<article class="container">
	 	<em class="shadow_1"></em>
	 	<div class="wrapper">
        <?php if(Yii::app()->user->hasFlash('messageModule')): ?>
		<div id="alertmsg" class="succes_msg">
        <p><?php echo Yii::app()->user->getFlash('messageModule'); ?></p>
	   </div>
	<?php endif; ?>
    	<div id="delete_spam" class="succes_msg" style="display:none;"></div>
			<div class="white_body ">
				<div class="left_container pageblock">
					<div class="left_block equal">
						<!-- message list -->
						<section class="top_block">
                    	<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation') ?>
                        </section>
                        <section class="content_block2">
							<?php if ($messagesAdapter->data): ?>
                            <?php $form = $this->beginWidget('CActiveForm', array(
                            'id'=>'message-delete-form',
                            'enableAjaxValidation'=>false,
                            'action' => $this->createUrl('delete/')
                            )); ?>
                            
                            

                            <ul class="msg_lists">
								<?php 
								
								foreach ($messagesAdapter->data as $index => $message):
							   
							 $ls_sqlBlocks = "SELECT * FROM `messages` WHERE `parent_id`='".$message->id."' AND `receiver_id`='".$message->receiver_id."' order by `created_at` DESC"; 							   
							 $lo_commandBlocks=Yii::app()->db->createCommand($ls_sqlBlocks);
							   $las_blockEntries=$lo_commandBlocks->queryAll();
								if(count($las_blockEntries) >0){
								foreach($las_blockEntries as $ls_blockEntry )
								{
								$las_results[]=$ls_blockEntry;
								}
								
								$chMessage = Message::model()->findByPk($las_results[0]['id']);
								
                              }
								unset($las_results);
								
								
							  if(count($las_blockEntries) >0){
								
							 ?>
                             <?php if($message->parent_id!=0 || $message->parent_id==0)
							  {?>
                              <li class="<?php echo 'unread' ?>" id="msglist_<?php echo $message->id; ?>">
							  <?php }else
							  {?>
                                <li class="<?php echo $message->is_read ? 'read' : 'unread' ?>" id="msglist_<?php echo $message->id; ?>">
                                <?php }?>
 <?php
 $sendermodel = User::model()->findByAttributes(array('id'=>$chMessage->sender_id));
if($sendermodel->profile->avatar!=NULL)
{
	$circularthumbimg=Yii::app()->request->baseUrl.'/'.$sendermodel->profile->avatar;
}else{
		$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/default.jpg';
}
?>   				<div class="pro_img circular" style="background: url(<?php echo $circularthumbimg; ?>) no-repeat;">
					<img src="<?php echo $circularthumbimg; ?>" />
                                    </div>
									<div class="msg_block"  id="<?php echo $message->id; ?>">
                                    <?php echo $form->hiddenField($message,"[$index]id"); ?>
                                   	<h4><?php echo ($chMessage->getSenderName()=='admin') ? 'The Rajarani Team':$chMessage->getSenderName() ;  ?></h4>
										<p class="msg">
                                         <?php
										 if(strlen($chMessage->subject)>30)
										{
											echo strrev(stristr(strrev(substr(CHtml::encode($chMessage->subject),0,30)),' '))." ...";
										}
										elseif(strlen($chMessage->subject)==0)
										{
											echo '';
										}
										else
										{
											echo CHtml::encode($chMessage->subject);
										}
										?>
                                        </p>
                                       <!-- <p class="msg"><a href="<?php echo $this->createUrl('view/', array('message_id' => $message->id)) ?>"><?php echo $message->subject ?></a></p>-->
										<p class="date">
									<?php
									$tmp=date(Yii::app()->getModule('message')->dateFormat, strtotime($chMessage->created_at));
									$date = new DateTime($tmp);
									echo $date->format('l, F jS');
									?></p>
                                    </div>
								  <div class="icons">
										<!----><p class="first"><a href="javascript:void(0);" title="<?php echo MessageModule::t('Spam'); ?>" rel="<?php echo $chMessage->id; ?>" class="flag_ico"></a></p>
										<p><a href="javascript:void(0);" title="<?php echo MessageModule::t('Delete'); ?>" rel="<?php echo $chMessage->id; ?>" class="delete_ico"></a></p>                         </div>
									<div class="clear"></div>
								</li>
							 <?php
							 	
							  }else
							  {?>
                              <?php if($message->parent_id!=0 || $message->parent_id==0)
							  {?>
                              <li class="<?php echo 'unread' ?>" id="msglist_<?php echo $message->id; ?>">
							  <?php }else
							  {?>
                                <li class="<?php echo $message->is_read ? 'read' : 'unread' ?>" id="msglist_<?php echo $message->id; ?>">
                                <?php }?>
 <?php
 $sendermodel = User::model()->findByAttributes(array('id'=>$message->sender_id));
if($sendermodel->profile->avatar !='')
{
	$circularthumbimg=Yii::app()->request->baseUrl.'/'.$sendermodel->profile->avatar;
}else{
	
		$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/default.jpg';
}
/**/?>   				<div class="pro_img circular" style="background: url(<?php echo $circularthumbimg; ?>) no-repeat;">
					<img src="<?php echo $circularthumbimg; ?>" />
                                    </div>
									<div class="msg_block"  id="<?php echo $message->id; ?>">
                                    <?php echo $form->hiddenField($message,"[$index]id"); ?>
                                   	<h4><?php echo ($message->getSenderName()=='admin') ? 'The Rajarani Team':$message->getSenderName() ; ?></h4>
										<p class="msg">
                                         <?php
										 if(strlen($message->subject)>30)
										{
											echo strrev(stristr(strrev(substr(CHtml::encode($message->subject),0,30)),' '))." ...";
										}
										elseif(strlen($message->subject)==0)
										{
											echo '';
										}
										else
										{
											echo CHtml::encode($message->subject);
										}
										?>
                                        </p>
                                       <!-- <p class="msg"><a href="<?php echo $this->createUrl('view/', array('message_id' => $message->id)) ?>"><?php echo $message->subject ?></a></p>-->
										<p class="date">
									<?php
									$tmp=date(Yii::app()->getModule('message')->dateFormat, strtotime($message->created_at));
									$date = new DateTime($tmp);
									echo $date->format('l, F jS');
									?></p>
                                    </div>
								  <div class="icons">
										<p class="first"><a href="javascript:void(0);" title="<?php echo MessageModule::t('Spam'); ?>" rel="<?php echo $message->id; ?>" class="flag_ico"></a></p>
										<p><a href="javascript:void(0);" title="<?php echo MessageModule::t('Delete'); ?>" rel="<?php echo $message->id; ?>" class="delete_ico"></a></p>                         </div>
									<div class="clear"></div>
								</li>
                               <?php
							  }
							  ?> 
                                <?php endforeach ?>
                            	
							</ul>
                            <?php $this->endWidget(); ?>
                            <?php endif; ?>
                            
                        </section>
                       
					</div>
                     <section class="paginationblock">
                        <?php $this->widget('CLinkPager', array('pages' => $messagesAdapter->getPagination())) ?>
                        </section>
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
/*delete actiion in message */
$(document).ready(function() {

	
	$('a.flag_ico').click(function()
	{
		var msgid=$(this).attr('rel');
		  
			$.ajax({
			type : 'GET', 
			url: "<?php echo Yii::app()->request->baseUrl;?>/message/spam",
			datatype: "json",
			data: { id: msgid,actiontype:'ajax'},
			success: function(complete){
			
			$('li').remove('#msglist_'+msgid);
			 $('#delete_spam').html('<p><strong> <?php echo MessageModule::t('Message marked as spam '); ?></strong>').show('slow');
			setTimeout(function() { $('#delete_spam').fadeOut('slow'); }, 5000);	
			 return false;
			}
			
				})
			return false;
			 
		//The conversation has been unmarked as spam and moved to the Inbox.
		
	});
	$('a.delete_ico').click(function()
	{
		var confmsg=confirm('Do you want to delete the message?');
	    var msgid=$(this).attr('rel');
		if(confmsg)
		$.ajax({
		type : 'GET', 
		url: "<?php echo Yii::app()->request->baseUrl;?>/message/delete",
		datatype: "json",
		data: { id: msgid,actiontype:'ajax'},
		success: function(complete){
	
		if($('#msglist_'+msgid).hasClass('unread'))
			{
				var msgcount= $('a#msginbox').html().match(/\d+/g);
				if(msgcount)
				{
				msgcount--;
				 $('a#msginbox').html('inbox('+msgcount+')');
				}
				
			}
			$('li').remove('#msglist_'+msgid);
			 $('#delete_spam').html('<p><strong> <?php echo MessageModule::t('The message has been deleted.'); ?></strong>').show('slow');
			setTimeout(function() { $('#delete_spam').fadeOut('slow'); }, 5000);	
			 return false;
			}
		})
		return false;
		
	});
	$("div .msg_block").click(function() {
			location.href="<?php echo Yii::app()->request->baseUrl;?>/message/view?message_id="+$(this).attr('id');
		}); 
	if($('#alertmsg').is(":visible"))
	{
		setTimeout(function() { $('#alertmsg').fadeOut('slow'); }, 5000);	
	}
});

</script>