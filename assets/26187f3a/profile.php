 
    <article class="container">
	 	<em class="shadow_1"></em>
	 	<div class="wrapper">
        	<!--<div class="succes_msg"><p><strong>Well done!</strong>You successfully read this important alert message.</p></div>-->
			<div class="white_body">
				<div class="left_container">
					<div class="left_block profile_body equal">
						<section class="profile_block">
                        	<aside class="profile"><a href="#"></a></aside>
                            <aside class="flirt"><a href="#"></a></aside>
                        </section>
                        <section class="content_block1">
                        	<?php echo $model->profile->getAttribute('aboutme'); ?>
                        </section>
<section class="pro_details">
	<aside class="left_side">

	<span><strong><?php echo UserModule::t('Gender'); ?>:</strong></span> <span><?php echo $model->profile->getAttribute('gender'); ?></span>
	<span><strong><?php echo UserModule::t('Residing in'); ?>:</strong></span> <span><?php echo $model->profile->getAttribute('residingcountry'); ?></span>
	<span><strong><?php echo UserModule::t('Postcode'); ?>:</strong></span> <span><?php echo $model->profile->getAttribute('postnr'); ?></span>
	<span><strong><?php echo UserModule::t('City'); ?>:</strong></span> <span><?php echo $model->profile->getAttribute('city'); ?></span>
	<span><strong><?php echo UserModule::t('Nationality'); ?>:</strong></span> <span><?php echo $model->profile->getAttribute('nationality'); ?></span>
	<span><strong><?php echo UserModule::t('Ethnicity'); ?>:</strong></span> <span><?php echo $model->profile->getAttribute('ethnicity'); ?></span>
	<span><strong><?php echo UserModule::t('Profession'); ?>:</strong></span> <span><?php echo $model->profile->getAttribute('profession'); ?></span>
	<span><strong><?php echo UserModule::t('Personality'); ?>:</strong></span> <span><?php echo $model->profile->getAttribute('personality'); ?></span>
	<span><strong><?php echo UserModule::t('Star sign'); ?>:</strong></span> <span><?php echo $model->profile->getAttribute('starsign'); ?></span>
	<span><strong><?php echo UserModule::t('Civil status'); ?>:</strong></span> <span><?php echo $model->profile->getAttribute('civilstatus'); ?></span>
	<span><strong><?php echo UserModule::t('Relationsship status'); ?>:</strong></span> <span><?php echo $model->profile->getAttribute('relationshipstatus'); ?></span>
	<span><strong><?php echo UserModule::t('Age'); ?>:</strong></span> <span><?php echo $model->profile->getAttribute('dob'); ?></span>
	<span><strong><?php echo UserModule::t('Has children'); ?>:</strong></span> <span><?php echo $model->profile->getAttribute('havechildren'); ?></span>

	<h3>Appearance</h3>
    <span><strong><?php echo UserModule::t('Tattoos'); ?>:</strong> <span><?php echo $model->profile->getAttribute('tattoo'); ?></span>
    <span><strong><?php echo UserModule::t('Body type'); ?>:</strong> <span><?php echo $model->profile->getAttribute('bodytype'); ?></span>
    <span><strong><?php echo UserModule::t('Height'); ?>:</strong> <span><?php echo $model->profile->getAttribute('height'); ?> cm</span>
    <span><strong><?php echo UserModule::t('Weight'); ?>:</strong> <span><?php echo $model->profile->getAttribute('weight'); ?> kg</span>
	<span><strong><?php echo UserModule::t('Hair style'); ?>:</strong> <span><?php echo $model->profile->getAttribute('hair'); ?></span>
	<span><strong><?php echo UserModule::t('Eyes color'); ?>:</strong> <span><?php echo $model->profile->getAttribute('eyescolor'); ?></span>
	<span><strong><?php echo UserModule::t('Looks'); ?>:</strong> <span><?php echo $model->profile->getAttribute('looks'); ?></span>

	<h3>Lifestyle</h3>
    
    <span><strong><?php echo UserModule::t('Education'); ?>:</strong> <span><?php echo $model->profile->getAttribute('education'); ?></span>
    <span><strong><?php echo UserModule::t('Interests'); ?>:</strong> <span><?php echo $model->profile->getAttribute('interests'); ?></span>
	<span><strong><?php echo UserModule::t('Smoke'); ?>:</strong> <span><?php echo $model->profile->getAttribute('smoke'); ?></span>
	<span><strong><?php echo UserModule::t('Sports'); ?>:</strong> <span><?php echo $model->profile->getAttribute('sports'); ?></span>
	<span><strong><?php echo UserModule::t('Income'); ?>:</strong> <span><?php echo $model->profile->getAttribute('income'); ?></span>
	<span><strong><?php echo UserModule::t('Diet'); ?>:</strong> <span><?php echo $model->profile->getAttribute('diet'); ?></span>
	<span><strong><?php echo UserModule::t('Entertainment'); ?>:</strong> <span><?php echo $model->profile->getAttribute('entertainment'); ?></span>
	<span><strong><?php echo UserModule::t('Exercise'); ?>:</strong> <span><?php echo $model->profile->getAttribute('exercise'); ?></span>
	<span><strong><?php echo UserModule::t('Films'); ?>:</strong> <span><?php echo $model->profile->getAttribute('films'); ?></span>
	<span><strong><?php echo UserModule::t('Music'); ?>:</strong> <span><?php echo $model->profile->getAttribute('music'); ?></span>
	<span><strong><?php echo UserModule::t('Pets'); ?>:</strong> <span><?php echo $model->profile->getAttribute('pets'); ?></span>
	<span><strong><?php echo UserModule::t('Politics'); ?>:</strong> <span><?php echo $model->profile->getAttribute('politics'); ?></span>
	<span><strong><?php echo UserModule::t('Religion'); ?>:</strong> <span><?php echo $model->profile->getAttribute('religion'); ?></span>
	<span><strong><?php echo UserModule::t('Romance'); ?>:</strong> <span><?php echo $model->profile->getAttribute('romance'); ?></span>
	<span><strong><?php echo UserModule::t('Sleeping habits'); ?>:</strong> <span><?php echo $model->profile->getAttribute('sleepinghabits'); ?></span>
	<span><strong><?php echo UserModule::t('Wants children'); ?>:</strong> <span><?php echo $model->profile->getAttribute('wantchildren'); ?></span>
	<span><strong><?php echo UserModule::t('Alcohol'); ?>:</strong> <span><?php echo $model->profile->getAttribute('alcohol'); ?></span>
	<span><strong><?php echo UserModule::t('Spoken languages'); ?>:</strong> <span><?php echo $model->profile->getAttribute('languages'); ?></span>
	<span><strong><?php echo UserModule::t('Religious'); ?>:</strong> <span><?php echo $model->profile->getAttribute('religious'); ?></span>
	</aside>
    
    <aside class="right_side">
                            	<?php //echo $model->profile->getAttribute('aboutme'); ?>
                            </aside>
                            <div class="clear"></div>
                         </section>
					</div>
				</div>
				<div class="right_container equal"><h1><?php echo $model->username; ?></h1>
                	
                     <?php // $this->widget('profilesideprofilewidget'); ?>        
                    <?php  // $this->widget('recentactivitywidget'); ?>        
                    
                    
                    <section class="block-space">
					</section>
                </div>
                <div class="clear"></div>
			</div>
		</div>
	 </article>
