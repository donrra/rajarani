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
			url: urlbaseDir + '/user/profile/process',	
			 
			//GET method is used
			type: "POST",

			//pass the data			
			data: data,		
			
			//Do not cache the page
			cache: false,
			
			//success
			success: function (html) {				
				//if process.php returned 1/true (send mail success)
				//if (html==1) {					
					//hide the form
					$('.form').fadeOut('slow');					
					
					//show the success message
					$('.done').fadeIn('slow');
					
				//if process.php returned 0/false (send mail failed)
				//} else alert('Sorry, unexpected error. Please try again later.');				
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
        	<div class="succes_msg">
            <?php if(Yii::app()->user->hasFlash('offchat')){ ?>
            <p><strong><?php echo Yii::app()->user->getFlash('offchat'); ?> </strong></p><?php }?>
            </div>
			<div class="white_body">
				<div class="left_container">
					<div class="left_block equal" style="height: 808px;">
						<section class="top_block">
                        	<aside class="rajfav">
								<h1>Chat with  friends</h1>
                      
                       	  </aside>
                        </section>
                        <div id="online_chatuser">
                        <section class="favorit arrowlistmenu">
                        <div class="favorite_block menuheader ">
                          Online
                         </div>
                        <ul class="msg_lists categoryitems">
							<?php
						   foreach($chatusers as $chatusr)
						   {
							   foreach($chatusr as $chatusrval)
						   {
								if(in_array($chatusrval['id'],$onlineusers))
								{
$Profileimg = Yii::app()->db->createCommand("SELECT * FROM `profiles` where user_id='".$chatusrval['id']."'")->queryAll();
						foreach($Profileimg as $Profileimgval)
						   {
							if($Profileimgval['avatar']!=NULL)
									{
	    						    if($Profileimgval['avatar']=='user_avatar/thumb/default.jpg')
										   {
												if($Profileimgval['gender']=='Female')
													//default pic as profile image
													$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/woman.jpg';
												else
													$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/default.jpg';
										   }else
									 				$circularthumbimg=Yii::app()->request->baseUrl.'/'.$Profileimgval['avatar'];
									}else{
											if($Profileimgval['gender']=='Female')
												//default pic as profile image
												$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/woman.jpg';
											else
												$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/default.jpg';
									}
                            
							}
							?>
                                
                                <li>
									<div class="pro_img">
										<img src="<?php echo $circularthumbimg; ?>" class="round_50" />
									</div>
									<div class="msg_block">
										<h4><?php 
										
										$language = Yii::app()->language;
												if(Yii::app()->language == 'en')
													$language = 'uk';
												
												echo CHtml::link($chatusrval['username'],Yii::app()->baseurl.'/'.$language.'/user/profile/'.$chatusrval['username']);
										
										
										
										//echo CHtml::link($chatusrval['username'],array('/user/profile/'.$chatusrval['username'])); ?></h4>
										<!--<p class="msg">...</p>-->
										<p class="date"><?php echo UserModule::t('Last active')?> 
                                             <?php
											   $tmp=date(Yii::app()->getModule('message')->dateFormat, strtotime($chatusrval['lastvisit_at']));
								    $date = new DateTime($tmp);
									echo $date->format('j, F Y');
                                    ?></p>
									</div>
									<div class="icons">
										<!--<p class="first"></p>-->
                                       <p> <a href="javascript:void(0);"  class="new_chat" title="<?php echo UserModule::t('Chat with ').$chatusrval['username']; ?>"  onclick="javascript:chatWith('<?php echo strtolower($chatusrval['username']); ?>')"></a></p>
									</div>
									<div class="clear"></div>
								</li>
                            <?php
							}
						   }
						}
						  	?> 
                       	</ul>
                         <div class="favorite_blockoff menuheader ">
                          Offline
                         </div>
                        <ul class="msg_lists categoryitems">
							<?php
                            foreach($chatusers as $chatusr)
						   {
							   foreach($chatusr as $chatusrval)
						   {
								if(!in_array($chatusrval['id'],$onlineusers))
								{
									$Profileimg = Yii::app()->db->createCommand("SELECT * FROM `profiles` where user_id='".$chatusrval['id']."'")->queryAll();
						foreach($Profileimg as $Profileimgval)
						   {
							if($Profileimgval['avatar']!=NULL)
									{
	    						     if($Profileimgval['avatar']=='user_avatar/thumb/default.jpg')
										   {
												if($Profileimgval['gender']=='Female')
													//default pic as profile image
													$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/woman.jpg';
												else
													$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/default.jpg';
										   }else
									 				$circularthumbimg=Yii::app()->request->baseUrl.'/'.$Profileimgval['avatar'];
									}else{
											if($Profileimgval['gender']=='Female')
												//default pic as profile image
												$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/woman.jpg';
											else
												$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/default.jpg';
									}
							}
							?>
                                <li>
									<div class="pro_img">
										<img src="<?php echo $circularthumbimg; ?>" class="round_50" />
									</div>
									<div class="msg_block">
										<h4><?php
										$language = Yii::app()->language;
												if(Yii::app()->language == 'en')
													$language = 'uk';
												
												echo CHtml::link($chatusrval['username'],Yii::app()->baseurl.'/'.$language.'/user/profile/'.$chatusrval['username']);
										
										
										
										 //echo CHtml::link($chatusrval['username'],array('/user/profile/'.$chatusrval['username'])); ?></h4>
										<!--<p class="msg">...</p>-->
										<p class="date"><?php echo UserModule::t('Last active')?> 
                                             <?php
											   $tmp=date(Yii::app()->getModule('message')->dateFormat, strtotime($chatusrval['lastvisit_at']));
								    $date = new DateTime($tmp);
									echo $date->format('j, F Y');
                                    ?></p>
									</div>
									<div class="icons">
										<!--<p class="first"></p>-->
                                       <p> <a href="javascript:void(0);"  class="new_chat_off" title="<?php echo $chatusrval['username'].UserModule::t(' Offline '); ?>"></a></p>
									</div>
									<div class="clear"></div>
								</li>
                            <?php
							}
						   }
						}
							?> 
                       	</ul>
                        </section>
                        </div>
                        <!-- message list End -->
					</div>
				</div>
				<div class="right_container equal">
                  <?php  $this->widget('landingsideprofilewidget',array('show_editbtn'=>'no')); ?>  
                     
					<section class="block-space">
                     <?php  $this->widget('application.components.sitecomment'); ?>      
					</section>
                </div>
                <div class="clear"></div>
			</div>
		</div>
	 </article>

  <script>
   
	 $(document).ready(function(e) {
        
		setTimeout('updateonlineusers();',5000);
		
		$('.remove_rfc').live('click',function()
		{
			var $currentobj=$(this);
			var declined_id=$(this).attr('rel');
			 $('.succes_msg').html('<p><strong></strong></p>');
			
					$.ajax({
					type : 'POST', 
					url: <?php echo "'".Yii::app()->createUrl('/user/profile/removerfc')."'"; ?>,
					datatype: "json",
					data: { 'declined_id':declined_id},
					success: function(complete){
					 
					 $currentobj.parent().parent().parent().remove();
					 $('.succes_msg').html('<p><strong>'+complete+'</strong></p>').show('slow');
					setTimeout(function() { $('.succes_msg').fadeOut('slow'); }, 2000);	
					 return false;
					}
					
				})
			return false;
		});
    });
	
	function updateonlineusers()
	{
		$.ajax({
	  url: <?php echo "'".Yii::app()->createUrl('/user/chat/live')."'"; ?>,
	  cache: false,
	   type: "post",
	    data: 'data',
	  dataType: "json",
	  success: function(outdata) {
		  $('#online_chatuser').html(outdata.outdata);
 if(outdata.resultdata!=null)
 {
		   $('.succes_msg').html('<p><strong>'+outdata.resultdata+'</strong><a class="close_msg" href="#"  onclick="closediv()"></a></p>').show('slow');
	}	
	else
	{
	 $('.succes_msg').html('');
	}
	},
    error: function (response) {
                console.log("error!");
        },});setTimeout('updateonlineusers();',5000);
	
		
		
	}
	function closediv()
	{
		$(".succes_msg").fadeOut(200)	
	}
	 </script>