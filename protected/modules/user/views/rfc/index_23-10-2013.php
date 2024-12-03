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
					$('.form').fadeOut('slow');					
					$('.done').fadeIn('slow');
			}		
		});
		
		//cancel the submit button default behaviours
		return false;
	});	
});	
</script>
<script type="text/javascript">
$(document).ready(function(){
	$('.expandable').click(function()
	{
		
		$('.categoryitems').hide('slow');
		$(this).next().show('fast');
	});
})

</script>
<article class="container">
	 	<em class="shadow_1"></em>
	 	<div class="wrapper">
        	<div class="succes_msg"></div>
			<div class="white_body">
				<div class="left_container">
					<div class="left_block equal" style="height: 808px;">
						<section class="top_block">
                        	<aside class="rajfav">
								<h1>My contacts</h1>
                                <p>
                                 <span>Your list of accepted and declined profiles</span></p>
								<div class="clear"></div>
							</aside>
                        </section>
                        <section class="favorit arrowlistmenu">
                        <!-- 1 -->
                    
                        <div class="favorite_block menuheader expandable">
                          Accepted
                         </div>
                         
                        <ul class="msg_lists categoryitems">
							<?php
							 $circularthumbimg='';
                            foreach($accept_list as $friend)
                            {
															
							if($friend['user']->profile->avatar!=NULL)
							{
	    					  $circularthumbimg=Yii::app()->request->baseUrl.'/'.$friend['user']->profile->avatar;							}else{
							 $circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/defaultsearch.jpg';									}/**/
?>
                                
                                <li>
									<div class="pro_img">
										<img src="<?php echo $circularthumbimg; ?>" class="round_50" />
									</div>
									<div class="msg_block">
										<h4><?php echo CHtml::link($friend['user']->username,array('/user/profile/'.$friend['user']->username)); ?></h4>
										<p class="msg">Accepted</p>
										<p class="date"><?php echo UserModule::t('Last active')?> 
                                             <?php
											   $tmp=date(Yii::app()->getModule('message')->dateFormat, strtotime($friend['user']->lastvisit_at));
									$date = new DateTime($tmp);
									echo $date->format('j, F Y');
                                    ?></p>
                                    
									</div>
									<div class="icons">
										<p class="first"></p>
										<p><a class="right_ico" href="#"></a></p>
                                      <p class="user_delete" id="<?php echo $friend['id']; ?>">
                                      <a class="newclose_icorec"></a></p>
									</div>
									<div class="clear"></div>
								</li>
                            <?php
							}
							?> 
                               
								
							</ul>
                     
                        <!-- 1 -->
                        <!-- 2 -->
                     
                          <div class="favorite_perlblock menuheader expandable">
                          Pending
                         </div>
                        <ul class="msg_lists categoryitems">
							<?php
                            
                            foreach($pending_list as $friend)
                            {
									if($friend['user']->profile->avatar!=NULL)
									{
	    						 $circularthumbimg=Yii::app()->request->baseUrl.'/'.$friend['user']->profile->avatar;
									}else{
								$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/defaultsearch.jpg';
									}
                            
                           
                            ?>
                                
                                <li>
									<div class="pro_img">
										<img src="<?php echo $circularthumbimg; ?>" class="round_50" />
									</div>
									<div class="msg_block pendingspace">
										<h4><?php echo CHtml::link($friend['user']->username,array('/user/profile/'.$friend['user']->username)); ?></h4>
										<p class="msgper">Pending</p>
										<p class="date"><?php echo UserModule::t('Last active')?> 
                                             <?php
											   $tmp=date(Yii::app()->getModule('message')->dateFormat, strtotime($friend['user']->lastvisit_at));
									$date = new DateTime($tmp);
									echo $date->format('j, F Y');
                                    ?></p>
                                    
									</div>
									<div class="icons">
										<p class="first"></p>
                                        <?php 
										$userfriend = UserFriends::model()->find('id=:id',array(':id'=>$friend['id']));
										
										if($userfriend->friend_id==Yii::app()->user->id){?>
                                        	<p class="user_add" id="<?php echo $friend['id']; ?>"><strong><a>Accept</a></strong></p>
                                            <p class="user_del" id="<?php echo $friend['id']; ?>"><strong><a>Deny</a></strong> </p><?php }?>
									
                                        <p><a class="pending_ico"></a></p>
                                        
                                        <p class="user_pendingdel" id="<?php echo $friend['id']; ?>"><strong><a class="newclose_icorec"></a></strong></p>
									</div>
									<div class="clear"></div>
								</li>
                            <?php
							}
							?> 
                               
								
							</ul>
                      
                         
                         <div class="favorite_close menuheader expandable">
                          Declined
                         </div>
                         <ul class="msg_lists categoryitems">
								<?php
                            foreach($declined_list as $friend)
                            {
									if($friend['user']->profile->avatar!=NULL)
									{
	    						 $circularthumbimg=Yii::app()->request->baseUrl.'/'.$friend['user']->profile->avatar;
									}else{
								$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/defaultsearch.jpg';
									}
                            
                           
                            ?>
                                
                                 <li>
									<div class="pro_img">
										<img src="<?php echo $circularthumbimg; ?>" class="round_50" />
									</div>
									<div class="msg_block">
										<h4><?php echo CHtml::link($friend['user']->username,array('/user/profile/'.$friend['user']->username)); ?></h4>
										<p class="msgred">Declined</p>
										<p class="date"><?php echo UserModule::t('Last active')?> 
                                             <?php
											   $tmp=date(Yii::app()->getModule('message')->dateFormat, strtotime($friend['user']->lastvisit_at));
									$date = new DateTime($tmp);
									echo $date->format('j, F Y');
                                    ?></p>
									</div>
									<div class="icons">
										<p class="first"></p>
										<p><a class="newclose_ico remove_rfc" rel="<?php echo $friend['id']; ?>" href="javascript:void(0);"></a></p>
									</div>
									<div class="clear"></div>
								</li>
                            <?php
							}
							?> 
                     
							</ul> 
                           
                        </section>
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
		 
		 $('.user_pendingdel').live('click',function()
		{
	  		var $userobj=$(this);
			var id = $userobj.attr('id');
				$.ajax({
					type : 'POST', 
					url: '<?php echo Yii::app()->createUrl('/user/profile/removerfcbyid'); ?>',
					datatype: "json",
					data: { 'id':id},
					success: function(complete){
					 
					 $userobj.parent().parent().hide();
					 $('.succes_msg').html('<p><strong>'+complete+'</strong></p>').show('slow');
					window.location.href=window.location.href;	
					 return false;
					}
					
				});
		
		});
		 $('.user_del').live('click',function()
		{
	  		var $userobj=$(this);
			var id = $userobj.attr('id');
				$.ajax({
					type : 'POST', 
					url: '<?php echo Yii::app()->createUrl('/user/rfc/declinedrfc'); ?>',
					datatype: "json",
					data: { 'id':id},
					success: function(complete){
					 
					 $userobj.parent().parent().hide();
					 $('.succes_msg').html('<p><strong>'+complete+'</strong></p>').show('slow');
					window.location.href=window.location.href;	
					 return false;
					}
					
				});
		
		});
		 $('.user_add').live('click',function()
		{
	  		var $userobj=$(this);
			var id = $userobj.attr('id');
				$.ajax({
					type : 'POST', 
					url: '<?php echo Yii::app()->createUrl('/user/rfc/addrfc'); ?>',
					datatype: "json",
					data: { 'id':id},
					success: function(complete){
					 
					 $userobj.parent().parent().hide();
					 $('.succes_msg').html('<p><strong>'+complete+'</strong></p>').show('slow');
					 setTimeout(function() { $('.succes_msg').fadeOut('slow'); }, 2000);
					 window.location.href=window.location.href;	
					 return false;
					}
					
				});
		
		});
		
        $('.user_delete').live('click',function()
		{
	  		var $userobj=$(this);
			var id = $userobj.attr('id');
				$.ajax({
					type : 'POST', 
					url: <?php echo "'".Yii::app()->createUrl('/user/profile/removerfcbyid')."'"; ?>,
					datatype: "json",
					data: { 'id':id},
					success: function(complete){
					 
					 $userobj.parent().parent().hide();
					 $('.succes_msg').html('<p><strong>'+complete+'</strong></p>').show('slow');
					setTimeout(function() { $('.succes_msg').fadeOut('slow'); }, 2000);	
					 return false;
					}
					
				});
		
		});
		
		$('.remove_rfc').live('click',function()
		{
			var $currentobj=$(this);
			var declined_id=$(this).attr('rel');
			 $('.succes_msg').html('<p><strong></strong></p>');
			
					$.ajax({
					type : 'POST', 
					url: <?php echo "'".Yii::app()->createUrl('/user/profile/removerfcbyid')."'"; ?>,
					datatype: "json",
					data: { 'id':declined_id},
					success: function(complete){
					 
					 $currentobj.parent().parent().parent().remove();
					 $('.succes_msg').html('<p><strong>'+complete+'</strong></p>').show('slow');
					setTimeout(function() { $('.succes_msg').fadeOut('slow'); }, 2000);	
					 return false;
					}
					
				}); return false;
		});
    });
	 </script>