<script type="text/javascript">
$(document).ready(function() {
	
	//if submit button is clicked
	$('#submit').click(function () {		
		 var urlbaseDir = "<?php echo Yii::app()->request->baseUrl;?>";
		//Get the data from all the fields
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
<?php
$arrayAuthRoleItems = Yii::app()->authManager->getAuthItems(2, Yii::app()->user->getId());
$arrayKeys = array_keys($arrayAuthRoleItems);
$role = strtolower ($arrayKeys[0]);
?>
       <article class="container">
     <div class="newprofile">
	 	<em class="shadow_1"></em>
	 	<div class="wrapper">
 		<div class="succes_msg">
			<?php if(Yii::app()->user->hasFlash('rfccmessage')){ ?>
            <p><strong><?php echo Yii::app()->user->getFlash('rfccmessage'); ?> </strong><?php }?>
			
 		 </div>
           
			<div class="white_body">
				<div class="left_container">
					<div class="left_block profile_body equal">
					   <section class="content_block1">
                       	<?php echo $model->profile->aboutme; ?>
                        </section>
                        <?php if($model->profile->lookingfor){?>
                        <section class="pro_details">
                         <h3 class="apea1"><?php echo UserModule::t('I am looking for'); ?></h3>
                         <aside class="left_side">
                            	<p class="noborder">
                                 <span class="widthblock"><?php
								 echo $model->profile->lookingfor; ?></span></p>
                                
                                </aside>
                                <div class="clear"></div>
                         </section>
                        <?php }?>
						<section class="pro_detailsshadow">
                            <h3 class="private"><?php echo UserModule::t('Private'); ?></h3>
                        	<aside class="left_side">
                            	<p><strong><?php echo UserModule::t('Gender'); ?>:</strong> <span><?php echo ($model->profile->gender ? $model->profile->gender : 'will tell you later')?></span></p>
                                <p><strong><?php echo UserModule::t('Residing in'); ?>:</strong> <span><?php echo ($model->profile->residingcountry ? $model->profile->residingcountry : 'Please choose')?></span></p>
                               <p><strong><?php echo UserModule::t('Postcode'); ?>:</strong> <span><?php if($model->profile->postnr!=0){echo $model->profile->postnr;} else { echo UserModule::t('will tell you later');} ?></span></p>
                             <p><strong><?php echo UserModule::t('City'); ?>:</strong> <span><?php echo ($model->profile->city ? $model->profile->city:'will tell you later') ?></span></p>
                              <p><strong><?php echo UserModule::t('Relationship status'); ?>:</strong> <span>
							  <?php echo ($model->profile->relationshipstatus ?
							     $model->profile->relationshipstatus
							   :  'will tell you later')?></span></p>
                                <p class="last"><strong><?php echo UserModule::t('Has children'); ?>:</strong> <span><?php echo ($model->profile->havechildren?$model->profile->havechildren :'will tell you later')?></span></p>
                            </aside>
                            <aside class="right_side">
                                <p><strong><?php echo UserModule::t('Nationality'); ?>:</strong> <span><?php echo ($model->profile->nationality?$model->profile->nationality:'will tell you later') ?></span></p>
                                <p><strong><?php echo UserModule::t('Ethnicity'); ?>:</strong> <span><?php echo ($model->profile->ethnicity ?$model->profile->ethnicity:'will tell you later') ?></span></p>
                                 <p><strong><?php echo UserModule::t('Profession'); ?>:</strong> <span><?php echo ($model->profile->profession ? $model->profile->profession:'will tell you later') ?></span></p>
                                <p><strong><?php echo UserModule::t('Personality'); ?>:</strong> <span><?php echo ($model->profile->personality ?$model->profile->personality:'will tell you later') ?></span></p>
                                <p><strong><?php echo UserModule::t('Star sign'); ?>:</strong> <span>
								<?php 
								if($model->profile->dob!='0000-00-00')
								{
									$starsign=getZodiac($model->profile->dob);
								echo $starsign;
								}
								echo $model->profile->starsign; ?></span></p>
                                <p><strong><?php echo UserModule::t('Civil status'); ?>:</strong> <span><?php echo( $model->profile->civilstatus ? $model->profile->civilstatus:'will tell you later') ?></span></p>
                                <p class="last"><strong><?php echo UserModule::t('Age'); ?>:</strong> <span>
								<?php 
								if($model->profile->dob!='0000-00-00')
								echo (dateDiff(date('Y-m-d'), $model->profile->dob)); 
								?></span></p>
                            </aside>
                            <div class="clear"></div>
                         </section>
                         <section class="pro_details">
                         
                            <h3 class="apea"><?php echo UserModule::t('Appearance'); ?></h3>
                            
                        	<aside class="left_side">
                            	<p><strong><?php echo UserModule::t('Tattoos'); ?>:</strong> <span><?php echo ($model->profile->tattoo? $model->profile->tattoo:'will tell you later') ?></span></p>
                                <p><strong><?php echo UserModule::t('Body type'); ?>:</strong> <span><?php echo ($model->profile->bodytype?$model->profile->bodytype:'will tell you later') ?></span></p>
                               <p class="last"><strong><?php echo UserModule::t('Height'); ?>:</strong> <span><?php echo$model->profile->height?$model->profile->height.'cm'  :'will tell you later'?></span></p>
                            </aside>
                            <aside class="right_side">
                            	<p><strong><?php echo UserModule::t('Weight'); ?>:</strong> <span><?php echo $model->profile->weight?$model->profile->weight.'kg':'will tell you later'?></span></p>
                                <p><strong><?php echo UserModule::t('Hair style'); ?>:</strong> <span><?php echo ($model->profile->hair?$model->profile->hair:'will tell you later') ?></span></p>
                                <p><strong><?php echo UserModule::t('Eyes color'); ?>:</strong> <span><?php echo ($model->profile->eyescolor?$model->profile->eyescolor:'will tell you later') ?></span></p>
                                <p class="last"><strong><?php echo UserModule::t('Looks'); ?>:</strong> <span><?php echo ($model->profile->looks?$model->profile->looks:'will tell you later') ?></span></p>
                            </aside>
                            
                            <div class="clear"></div>
                         </section>
                         
                         <section class="pro_details">
                        
                            <h3 class="lifestyle"><?php echo UserModule::t('Lifestyle'); ?></h3>
                             
                        	<aside class="left_side">
                            	<p><strong><?php echo UserModule::t('Education'); ?>:</strong> <span><?php echo ($model->profile->education?$model->profile->education:'will tell you later') ?></span></p>
<p><strong><?php echo UserModule::t('Interests'); ?>:</strong> <span><?php echo ($model->profile-> interests?$model->profile-> interests:'will tell you later') ?></span></p>
<p><strong><?php echo UserModule::t('Smoke'); ?>:</strong> <span><?php echo ($model->profile-> smoke?$model->profile-> smoke:'will tell you later') ?></span></p>
<p><strong><?php echo UserModule::t('Entertainment'); ?>:</strong> <span><?php echo ($model->profile-> entertainment?$model->profile-> entertainment:'will tell you later') ?></span></p>
<p><strong><?php echo UserModule::t('Films'); ?>:</strong> <span><?php echo ($model->profile-> films?$model->profile-> films:'will tell you later')?></span></p>
<p><strong><?php echo UserModule::t('Pets'); ?>:</strong> <span><?php echo ($model->profile-> pets?$model->profile-> pets:'will tell you later')?></span></p>
<p><strong><?php echo UserModule::t('Romantic'); ?>:</strong> <span><?php echo ($model->profile-> romance?$model->profile-> romance:'will tell you later') ?></span></p>
<p><strong><?php echo UserModule::t('Wants children'); ?>:</strong> <span><?php echo ($model->profile-> wantchildren?$model->profile-> wantchildren:'will tell you later') ?></span></p>
<p><strong><?php echo UserModule::t('Alcohol'); ?>:</strong> <span><?php echo ($model->profile-> alcohol?$model->profile-> alcohol:'will tell you later'); ?></span></p>
<p  class="last"><strong><?php echo UserModule::t('Religious'); ?>:</strong> <span><?php echo (
$model->profile-> religious ? $model->profile-> religious:'will tell you later')?></span></p>
                            </aside>
                            <aside class="right_side">
                            <p><strong><?php echo UserModule::t('Religion'); ?>:</strong> <span><?php echo ($model->profile-> religion?$model->profile-> religion:'will tell you later'); ?></span></p>
                            	<p><strong><?php echo UserModule::t('Sports'); ?>:</strong> <span><?php echo ($model->profile-> sports?$model->profile-> sports:'will tell you later') ?></span></p>
                               <p><strong><?php echo UserModule::t('Income'); ?>:</strong> <span><?php echo ($model->profile-> income?$model->profile-> income:'will tell you later'); ?></span></p>
                               <p><strong><?php echo UserModule::t('Diet'); ?>:</strong> <span><?php echo ($model->profile-> diet?$model->profile-> diet:'will tell you later'); ?></span></p>
                               <p><strong><?php echo UserModule::t('Exercise'); ?>:</strong> <span><?php echo ($model->profile-> exercise?$model->profile-> exercise:'will tell you later'); ?></span></p>
                               <p><strong><?php echo UserModule::t('Music'); ?>:</strong> <span><?php echo ($model->profile-> music?$model->profile-> music:'will tell you later'); ?></span></p>
                               <p><strong><?php echo UserModule::t('Politics'); ?>:</strong> <span><?php echo ($model->profile-> politics?$model->profile-> politics:'will tell you later'); ?></span></p>
                               
                               <p><strong><?php echo UserModule::t('Sleeping habits'); ?>:</strong> <span><?php echo ($model->profile-> sleepinghabits?$model->profile-> sleepinghabits:'will tell you later'); ?></span></p>
                               <p  class="last"><strong><?php echo UserModule::t('Spoken languages'); ?>:</strong> <span><?php echo ($model->profile-> languages?$model->profile-> languages:'will tell you later'); ?></span></p>
                            </aside>
                            
                            <div class="clear"></div>
                         </section>
					</div>
				</div>
			<div class="right_container equal">
            <?php  $this->widget('application.modules.user.components.profilesideprofilewidget',array('show_editbtn'=>'yes')); ?>  
            <?php  $this->widget('application.modules.user.components.sidealbumwidget',array('model'=>$model)); ?> 
              <section class="block-space"> <?php  $this->widget('application.components.sitecomment'); ?></section>
            </div>
                <div class="clear"></div>
			</div>
		</div>
        </div>
	 </article>
 	<?php  $this->widget('popupwidget',array('model'=>$model)); ?> 