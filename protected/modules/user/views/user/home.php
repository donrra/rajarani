	 <article class="container">
	 	<section class="banner_block">
			<div class="wrapper">
				<aside class="field_block">
					<h1><?php echo UserModule::t('When culture, tradition or religion <br /> matters in the quest for love'); ?></h1>
					<h4>
						<?php echo UserModule::t('On Rajarani.dk you can search marriage partners in Scandinavia. This portal is primarily for people with <br />an ethnic background, who wish to engage culture, tradition or religion in the quest for love');?> 
					</h4>
                    
<?php $form1=$this->beginWidget('UActiveForm', array(
	'id'=>'registration-form',
	'enableAjaxValidation'=>true,
	'action' => Yii::app()->createUrl('user/home/registration'),
	'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
	'htmlOptions' => array('enctype'=>'multipart/form-data','class'=>'loginform'),
)); ?>
<fieldset>

<div id="reg_step1"  class="visible">                    
<!--<form class="loginform">-->
<p class="textfield"><?php echo $form1->textField($regmodel,'username',array('placeholder'=>UserModule::t('Choose a username'))); ?>
<em></em></p>
<p class="textfield"><?php echo $form1->textField($regmodel,'email',array('placeholder'=>UserModule::t('Enter your email address'),'class'=>'textfield')); ?>
<em></em></p>
<p class="button"><input type="button" value="<?php echo UserModule::t("Next step");?>" id="Nextstep" /><em></em></p>

</div>
<div id="reg_step2"  class="invisible">
<p class="textfield">
<?php echo $form1->passwordField($regmodel,'password',array('placeholder'=>UserModule::t('Choose a password'),'class'=>'textfield')); //?>
<em></em></p>
<p class="textfield">
<?php echo $form1->passwordField($regmodel,'verifyPassword',array('placeholder'=>UserModule::t('Repeat your password'),'class'=>'textfield')); ?>
<em></em></p>
<p class="button">
<?php echo CHtml::submitButton(UserModule::t("Done")); ?>
<em></em></p>
</div>
</fieldset>
<?php $this->endWidget(); ?>
<style>
  .visible { display:block; /* visibility:visible;position:absolute; */}
  .invisible { display:none;/* visibility:hidden;position:absolute; */ }
  </style>
<script type="text/javascript">
$(document).ready(function() {
  // Handler for .ready() called.
   
 
  $('#reg_step1').removeClass().addClass('visible');
});


$('#Nextstep').click(function()
	{
	$('#reg_step1').removeClass('visible').addClass('invisible');
	$('#reg_step2').removeClass('invisible').addClass('visible'); 
	});

</script>     
           </aside>
           </div> 
		</section>
		<section class="content_block">
			<aside class="blocks">
				<div class="wrapper">
					<figure class="icon1">
						<figcaption><?php echo UserModule::t('New improved version');?></figcaption>
						<p><?php echo UserModule::t('We have updated Rajarani.dk to a new and more modern version. More features, better interface and lightning fast.') ?>
						</p>
					</figure>
					<figure class="icon2">
						<figcaption><?php echo UserModule::t('Chat with users');?></figcaption>
						<p><?php echo UserModule::t('Do you want to chat with your contacts? We have developed a new and nice chat, so you can chat with your contacts online.');?>
						</p>
					</figure>
					<figure class="icon3">
						<figcaption><?php echo UserModule::t('Safe and serious');?></figcaption>
						<p><?php echo UserModule::t('With the new version of Rajarani.dk, we are even more serious and confident that this will help you find the right partner.');?>
						</p>
					</figure>
				</div>
			</aside>
			<div class="border"></div>
			<aside class="content">
				<div class="wrapper s_wrapper">
					<h2><?php echo UserModule::t('A better network - completely anonymous and secure');?></h2>
					<p><?php echo UserModule::t('Rajarani.dk is a serious matrimonial website. Rajarani.dk provides a network for ethnic minorities looking for likeminded single people for marriage. Even though immigrants have been living in Western societies for many years, the immigrants often find themselves alienated to the Western way of living. Many first generation immigrants especially do not approve of the Western style.');?>
					</p>
				</div>
			</aside>
		</section>
	 </article>
