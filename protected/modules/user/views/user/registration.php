
<article class="container">
  <section class="login_block">
    <aside class="login_box">
      <div class="login_top"></div>
      <div class="login_body">
        <h1><?php echo UserModule::t('Create profile');?></h1>
        <?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'registration-form',
	'enableAjaxValidation'=>true,
	'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
	'htmlOptions' => array('enctype'=>'multipart/form-data','class'=>'login_form'),
)); ?>
        <p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
        <?php 
				      if(Yii::app()->user->hasFlash('registration_error')): 
                      echo Yii::app()->user->getFlash('registration_error'); 
                      endif;
				?>
        <?php 
echo $form->errorSummary(array($model),"",""); ?>
        <?php
$usernameerrorclass=''; 

 


if(strlen(strip_tags($form->error($model, 'username')))!=0)
	{
		$usernameerrorclass='error';
	}else
	{
		$usernameerrorclass='';
	}
?>
        <p class="textbox1 <?php echo $usernameerrorclass; ?>"> <?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20,'placeholder'=>UserModule::t('*Enter a username'))); ?> <em></em> </p>
        <?php
$passworderrorclass=''; 
if(strlen(strip_tags($form->error($model, 'password')))!=0)
	{
		$passworderrorclass='error';
	}else
	{
		$passworderrorclass='';
	}
?>
        <p class="textbox1 <?php echo $passworderrorclass; ?>"> <?php echo $form->PasswordField($model,'password',array('size'=>20,'maxlength'=>20,'placeholder'=>UserModule::t('* Choose a password'))); ?> <em></em> </p>
        <?php
$verifyPassworderrorclass=''; 
if(strlen(strip_tags($form->error($model,'verifyPassword')))!=0)
	{
		$verifyPassworderrorclass='error';
	}else
	{
		$verifyPassworderrorclass='';
	}
	
?>
        <p class="textbox1 <?php echo $verifyPassworderrorclass; ?>"> <?php echo $form->PasswordField($model,'verifyPassword',array('size'=>20,'maxlength'=>20,'placeholder'=>UserModule::t('* Repeat your password'))); ?> <em></em> </p>
        <?php

$emailerrorclass=''; 
if(strlen(strip_tags($form->error($model,'email')))!=0)
	{
		$emailerrorclass='error';
	}else
	{
		$emailerrorclass='';
	}
?>
        <p class="textbox1 <?php  echo $emailerrorclass; ?>"> <?php echo $form->textField($model,'email',array('size'=>20,'maxlength'=>60,'placeholder'=>UserModule::t('* Enter your email address'))); ?> <em></em> </p>
        <p> <?php echo CHtml::submitButton(UserModule::t("Register"),array('class'=>'button')); ?></p>
        </p>
        <?php $this->endWidget(); ?>
      </div>
      <div class="login_bottom"></div>
    </aside>
  </section>
</article>
