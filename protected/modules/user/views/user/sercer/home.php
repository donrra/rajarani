<?php
/*$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
$this->breadcrumbs=array(
	UserModule::t("Login"),
);*/
?>
<?php /* if(Yii::app()->user->hasFlash('loginMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>
<?php endif; */ ?>
<?php  if(Yii::app()->user->hasFlash('registration')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php endif;  ?>


<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

<div class="main">
	 <header>
	 	<section class="top_head">
			<div class="wrapper">
<?php
/* */$form=$this->beginWidget('UActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
//	'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
	'action' => Yii::app()->createUrl('user/home'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	 'htmlOptions'=>array('class'=>'login_field'),
));
 ?>
<p class="textfield1">
<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20,'placeholder'=>'Name')); ?>
<em></em>
</p>
<p class="textfield1">
<?php echo $form->passwordField($model, 'password', array('placeholder'=>'Password','class'=>'span3')); ?><em></em>
</p>
<p class="button1">
<?php echo CHtml::submitButton(UserModule::t("Log ind")); ?>
<em></em>
</p>
<?php $this->endWidget(); ?>
            	<!--<form class="login_field">
                	<p class="textfield1"><input type="text" placeholder="Name" /><em></em></p>
                    <p class="textfield1"><input type="password" placeholder="Password" /><em></em></p>
                    <p class="button1"><input type="submit" value="Log ind" /><em></em></p>
                </form>-->
			</div>
		</section>
		<section class="header_block">
			<div class="wrapper">
				<aside class="logo"><a href="#"></a></aside>
				<aside class="online_status">
					<span><b>Online:</b> 1.489</span>
					<em></em>
				</aside>
				<div class="clear"></div>
			</div>
		</section>
	 </header>
	 <article class="container">
	 	<section class="banner_block">
			<div class="wrapper">
				<aside class="field_block">
					<h1>Når kultur, tradition eller religion<br />betyder noget i jagten på kærligheden.</h1>
					<h4>
						På rajarani kan du søge ægteskabspartnere i Skandinavien. Portalen er primært for personer med<br />
						anden etnisk baggrund, der ønsker at inddrage kultur, tradition eller religion i jagten på kærligheden. 
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
<p class="textfield"><?php echo $form1->textField($regmodel,'username',array('placeholder'=>'Navn')); ?>
<em></em></p>
<p class="textfield"><?php echo $form1->textField($regmodel,'email',array('placeholder'=>'E-mail','class'=>'textfield')); ?>
<em></em></p>
<p class="button"><input type="button" value="Next" id="Nextstep" /><em></em></p>

</div>
<div id="reg_step2"  class="invisible">
<p class="textfield">
<?php echo $form1->passwordField($regmodel,'password',array('placeholder'=>'Password','class'=>'textfield')); ?>
<em></em></p>
<p class="textfield">
<?php echo $form1->passwordField($regmodel,'verifyPassword',array('placeholder'=>'Re-type Password','class'=>'textfield')); ?>
<em></em></p>
<p class="button">
<?php echo CHtml::submitButton(UserModule::t("Opret profil")); ?>
<em></em></p>
</div>
</fieldset>
<?php $this->endWidget(); ?>
<style>
  .visible { visibility:visible;position:absolute; }
  .invisible { visibility:hidden;position:absolute; }
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
<!---->

<!-- start here -->
     <!-- <?php $form1=$this->beginWidget('UActiveForm', array(
	'id'=>'registration-form',
	'enableAjaxValidation'=>true,
	'action' => Yii::app()->createUrl('user/home/registration'),
	'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
	'htmlOptions' => array('enctype'=>'multipart/form-data','class'=>'loginform'),
)); ?>





	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<?php //echo $form1->errorSummary(array($regmodel,$profile)); ?>
	
	<div class="row">
	<?php //echo $form1->labelEx($regmodel,'username'); ?>
	<?php echo $form1->textField($regmodel,'username'); ?>
	<?php echo $form1->error($regmodel,'username'); ?>
	</div>
	
	<div class="row">
	<?php //echo $form1->labelEx($regmodel,'password'); ?>
	<?php echo $form1->passwordField($regmodel,'password'); ?>
	<?php echo $form1->error($regmodel,'password'); ?>
	<p class="hint">
	<?php echo UserModule::t("Minimal password length 4 symbols."); ?>
	</p>
	</div>
	
	<div class="row">
	<?php //echo //$form1->labelEx($regmodel,'verifyPassword'); ?>
	<?php echo $form1->passwordField($regmodel,'verifyPassword'); ?>
	<?php echo $form1->error($regmodel,'verifyPassword'); ?>
	</div>
	
	<div class="row">
	<?php //echo $form1->labelEx($regmodel,'email'); ?>
	<?php echo $form1->textField($regmodel,'email'); ?>
	<?php echo $form1->error($regmodel,'email'); ?>
	</div>
	

	
	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Register")); ?>
	</div>
<?php $this->endWidget(); ?>  -->
<!-- form -->  

  
           </aside>
           </div> 
		</section>
		<section class="content_block">
			<aside class="blocks">
				<div class="wrapper">
					<figure class="icon1">
						<figcaption>Ny forbedret udgave</figcaption>
						<p>
							Vi har opdateret rajarani, til en ny og 
							mere moderne udgave. Flere funktioner, 
							et bedre interface og lynende hurtig.
						</p>
					</figure>
					<figure class="icon2">
						<figcaption>Ny chat funktion</figcaption>
						<p>
							Vil du chatte med dine kontakter. Så har 
							vi udviklet en ny og flot chat, så du hurtigt
							kan snakke med dine kontakter online.
						</p>
					</figure>
					<figure class="icon3">
						<figcaption>Seriøst og sikkert</figcaption>
						<p>
							Med den nye udgave af rajarani, er 
							vi endnu mere seriøse og sikre på at 
							dette er det rigtige valg til en ny partner.
						</p>
					</figure>
				</div>
			</aside>
			<div class="border"></div>
			<aside class="content">
				<div class="wrapper s_wrapper">
					<h2>Et bedre netværk - helt anonym og sikkert</h2>
					<p>
						Rajarani.dk is a serious matrimonial website. Rajarani.dk is creating a network for ethnic minorities looking for likeminded single 
						people for marriage. Even though immigrants have been living in Western societies for many years, the immigrants often find 
						themselves alienated to the Western way of living. Many first generation immigrants especially do not approve of the Western style.
					</p>
				</div>
			</aside>
		</section>
	 </article>
	 <footer>
	 	<div class="wrapper s_wrapper">
			<aside class="choose_language">
				<a href="#">Choose language</a>
			</aside>
			<nav>
				<ul>
					<li><a href="#">Support</a></li>
					<li><a href="#">Betingelser</a></li>
					<li><a href="#">Kundeservice</a></li>
					<li class="last"><a href="#">Kontakt</a></li>
				</ul>
			</nav>
		</div>
	 </footer>
</div>
<script type="text/javascript">
$(function() {
if (!$.support.placeholder) {
var active = document.activeElement;

$(':text').focus(function() {
if ($(this).attr('placeholder') != '' && $(this).val() == $(this).attr('placeholder')) {
$(this).val('').removeClass('hasPlaceholder');
}
}).blur(function() {
if ($(this).attr('placeholder') != '' && ($(this).val() == '' || $(this).val() == $(this).attr('placeholder'))) {
$(this).val($(this).attr('placeholder')).addClass('hasPlaceholder');
}
});
$(':text').blur();

$(active).focus();



}
});
</script>