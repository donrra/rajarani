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
					//hide the form
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
<article class="container">
	 	<em class="shadow_1"></em>
       
	 	<div class="wrapper">
        	<div class="succes_msg">
            <?php if(Yii::app()->user->hasFlash('favoritemessage')): ?>
        <p><strong><?php echo Yii::app()->user->getFlash('favoritemessage'); ?></strong>
 		<?php endif; ?></div>
		
		
        
        <div class="white_body">
				<div class="left_container">
					<div class="left_block equal" style="height: 808px;">
						<!-- message list -->
						<section class="top_block">
                        	<aside class="rajfav">
								<h1><?php echo UserModule::t("My Favorites");?></h1>
                                <p>
                                 <span><?php echo UserModule::t("Your favorite profiles");?></span></p>
								<div class="clear"></div>
							</aside>
                        </section>
                        <section class="favorit">
                        <div class="favorite_block">
                          <?php echo UserModule::t("Profile");?>
                         </div>
                        <ul class="msg_lists">
							<?php
                          
						   
							foreach($fav_list as $fav)
                            {
								if($fav->profile->avatar!=NULL)
									{
	    						 $circularthumbimg=Yii::app()->request->baseUrl.'/'.$fav->profile->avatar;
									}else{
								$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/defaultsearch.jpg';
									}
                            
                           
                            ?>
                                
                                <li>
									<div class="pro_img">
										<img src="<?php echo $circularthumbimg; ?>" class="round_50" />
									</div>
									<div class="msg_block">
										<h4><?php echo CHtml::link($fav->username,array('/user/profile/'.$fav->username)); ?></h4>
										<p class="msg">- -</p>
										<p class="date"><?php echo UserModule::t('Last active')?> 
                                             <?php
											   $tmp=date(Yii::app()->getModule('message')->dateFormat, strtotime($fav->lastvisit_at));
									$date = new DateTime($tmp);
									echo $date->format('j, F Y');
                                    ?></p>
									</div>
									<div class="icons">
										<p class="first"></p>
										<p><a class="newclose_ico remove_fav" rel="<?php echo $fav->id; ?>" href="javascript:void(0);"></a></p>
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
        
		$('.remove_fav').live('click',function()
		{
			var $currentobj=$(this);
			var fav_id=$(this).attr('rel');
			 $('.succes_msg').html('<p><strong></strong></p>');
			
				
					$.ajax({
					type : 'POST', 
					url: <?php echo "'".Yii::app()->createUrl('/user/profile/removefav')."'"; ?>,
					datatype: "json",
					data: { 'fav_id':fav_id},
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
	 </script>