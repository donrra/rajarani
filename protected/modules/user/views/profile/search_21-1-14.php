<script type="text/javascript">
$(document).ready(function() {
	
	//if submit button is clicked
	$('#submit').click(function () {		
		 var urlbaseDir = "<?php echo Yii::app()->request->baseUrl;?>";
		//Get the data from all the fields		

		//Simple validation to make sure user entered something
		//If error found, add hightlight class to the text field
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
        	<div class="succes_msg"></div>
			<div class="white_body">
				<div class="left_container">
					<div class="left_block equal">
						<section class="top_block">
                        	<aside class="heading_text_block">
								<div class="middle_text">
									<h1><?php echo UserModule::t('Search results'); ?></h1>
									<h3><?php echo count($users); ?> <?php echo UserModule::t('profiles match your search criteria')?> </h3>
								</div>
							</aside>
                        </section>
                        <section class="content_block2">
                        	<!--<aside class="search_options">-->
								
                                    <aside class="top_option" style="display:none;">
					<div class="left_curve"></div>
					<div class="curve_body">
						<?php echo CHtml::beginForm('','post');?>
						<label class="bold"><?php echo UserModule::t('Quicksearch:'); ?></label>
							<div class="cam_body">
								<em class="leftcam"></em>
								<div class="drag_btn"><em></em></div>
								<em class="rightcam"></em>
							</div>							
<div class="genderstyle">
<?php
echo CHtml::dropDownList('gender','gender',array(' ' => UserModule::t('Gender'),'M' => UserModule::t('Male'), 'F' => UserModule::t('Female')),array('class'=>'styled',));
?>
</div>
						<p class="textbox space"><input id="from_age"  name="from_age" type="text" value="18" /></p>
							<label class="text"><?php echo UserModule::t('til'); ?></label>
							<p class="textbox"><input id="to_age"  name="to_age" type="text" value="25" /></p>
                            <div class="countrystyle">
<?php
echo CHtml::dropDownList('country','country',array(' ' => UserModule::t('Country'),UserModule::t('India') => UserModule::t('India'), UserModule::t('Pakistan') => UserModule::t('Pakistan')),array('class'=>'styled',));
?>                            </div>
 							<p class="search_btn"><input type="submit" class="search_ico" value="" /></p>
					<?php echo CHtml::endForm(); ?>
					</div><!-- form -->
					<div class="right_curve"></div>
				</aside>
                                
							<!--</aside>-->
							<aside class="search_lists">
								<ul>
									<?php
									
									foreach($users as $key => $ind_user)
									{ 
									if($ind_user['searchuser']->status==2) continue;
										// check if user profile image with rights permission
									//	continue;
										
										if($ind_user['searchuser']->profile->getAttribute('avatar')!=NULL)
										{
										
										$mystring =$ind_user['searchuser']->profile->getAttribute('avatar');
										$findme   = 'gallery';
										$pos = strpos($mystring, $findme);
										
											if($pos!==false) 
											{	
												$searchstr=substr($mystring,8);
												// album pic as profile image
												$imagearr=  GalleryPhoto::model()->findByAttributes(array('profile'=>$searchstr));
												//access level 1 => all
												// 2 => only friends 
												if($imagearr->accesslevel==1)
												{
													// all to show
													$circularthumbimg=Yii::app()->request->baseUrl.'/'.$ind_user['searchuser']->profile->getAttribute('avatar');
													
												}else
												{
												//only friends show
												$checkfriendsobj=UserFriends::model()->havefriends($ind_user['searchuser']->id,Yii::app()->user->getId());
													if($checkfriendsobj[0]['isfriend']=='no')
													{
													$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/accepted_only.png';
													}else
													{
														
													$circularthumbimg=Yii::app()->request->baseUrl.'/'.$ind_user['searchuser']->profile->getAttribute('avatar');
													}
												
												}
											
											}else
											{
												if($searchprofile[0]['gender']=='Female')
												//default pic as profile image
												$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/woman.jpg';
												else
												$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/default.jpg';
											}
										}else{
											
										if($searchprofile[0]['gender']=='Female')
												//default pic as profile image
												$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/woman.jpg';
												else
												$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/default.jpg';
										}
									?>
                                    <li>
											  <div class="block">
											<p class="image_block">
					<img src="<?php echo $circularthumbimg; ?>" class="round_50" />
                                    
                                    		</p>
                                           
											<p class="about_image">
												<strong>
												<?php echo CHtml::link($ind_user['searchuser']->username,array('/user/profile/'.$ind_user['searchuser']->username)); ?></strong>
												<span class="msg offline"><?php
												 if($ind_user['online']==1)
												 echo UserModule::t('online');
												 else
												 echo UserModule::t('offline');
												  ?>
                                                  <span style="padding-left: 30px;"><?php 
												  if($ind_user['searchuser']->profile->getAttribute('dob')=='0000-00-00')
												  echo '';
												  else {
													 echo ( dateDiff(date('Y-m-d'),$ind_user['searchuser']->profile->getAttribute('dob'))) ;} ?>
												 </span>
                                                  <span style="padding-left: 30px;"><?php 
												  if($ind_user['searchuser']->profile->getAttribute('residingcountry')
												  =='Please choose')
												  {
												  	echo '';
												  }
												  elseif($ind_user['searchuser']->profile->getAttribute('residingcountry')=='')
												  {
												  	echo '';
												  }
												 else
												 {
													  echo ''.$ind_user['searchuser']->profile->getAttribute('residingcountry');} ?></span>
                                                  </span>
												<span class="date"><?php echo UserModule::t('Last active')?> 
                                             <?php
											   $tmp=date(Yii::app()->getModule('message')->dateFormat, strtotime($ind_user['searchuser']->lastvisit_at));
									$date = new DateTime($tmp);
									echo $date->format('j, F Y');
                                    ?>
                                                </span>
											</p>
    <p><a href="javascript:void(0);" class="addtofavorite" rel="<?php echo $ind_user['searchuser']->id; ?>" title="<?php echo UserModule::t('Add to favorites'); ?>"></a></p>
										 </div>
									</li>
                                    <?php	
									}
									?>
								</ul>
							</aside>
                        </section>
						
					</div>
				</div>
				<div class="right_container equal">
                	
            <?php  $this->widget('application.modules.user.components.sideprofilewidget',array('show_editbtn'=>'no')); ?>					<section class="block-space">  <?php  $this->widget('application.components.sitecomment'); ?>
					</section>
                </div>
                <div class="clear"></div>
			</div>
		</div>
	 </article>
<script type="text/javascript">
$(document).ready(function() {
		$('a.addtofavorite').click(function()
		{
			var favid=$(this).attr('rel');
				
			 $('.succes_msg').html('<p><strong></strong></p>');
			console.log('added to favorites....'+favid);
					$.ajax({
					type : 'POST', 
					url: <?php echo "'".Yii::app()->createUrl('/user/profile/addtofavorite')."'"; ?>,
					datatype: "json",
					data: { 'favid':favid},
					success: function(complete){
					 $('.succes_msg').html('<p><strong>'+complete+'</strong></p>').show('slow');
					setTimeout(function() { $('.succes_msg').fadeOut('slow'); }, 2000);	
					 return false;
					}
				})
			return false;
		//The conversation has been unmarked as spam and moved to the Inbox.
	});
});
</script>