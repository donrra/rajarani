	 <article class="container">
	 	<section class="login_block">
			<aside class="login_box">
				<div class="login_top"></div>
				<div class="login_body">
					<h1><?php echo UserModule::t('Login');?></h1>
					
					
					<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'login-form',
	'htmlOptions' => array('class'=>'login_form'),
)); ?>

<?php echo CHtml::errorSummary($model,"",""); ?>
<?php
$usernameerrorclass=''; 
if($form->error($model, 'username')!='')
	{
		$usernameerrorclass='error';
	}else
	{
		$usernameerrorclass='';
	}
?>
<p class="textbox1 <?php echo $usernameerrorclass; ?>">
<?php echo $form->textField($model,'username',array('class'=>$usernameerrorclass,'size'=>20,'maxlength'=>40,'placeholder'=>UserModule::t('User Name'))); ?>
<em></em>
</p>
<?php
$passworderrorclass=''; 
if($form->error($model, 'password')!='')
	{
		$passworderrorclass='error';
	}else
	{
		$passworderrorclass='';
	}
?>
<p class="textbox1 <?php echo $passworderrorclass; ?>">
<?php echo $form->PasswordField($model,'password',array('size'=>20,'maxlength'=>20,'placeholder'=>strtolower(UserModule::t('Password')))); ?>
<em></em>
</p>
		<p class="checkbox"><?php echo CHtml::activeCheckBox($model,'rememberMe',array('class'=>'styled')); ?>
        <?php echo CHtml::activeLabelEx($model,'rememberMe'); ?>
        </p>
		
                <p>
                <?php echo CHtml::submitButton(UserModule::t("Log in"),array('class'=>'button')); ?></p>
                   <?php $this->endWidget(); ?>
				</div>
                
				<div class="login_bottom"></div>
                <span class="forgotpassword"><!--<b><?php echo CHtml::link(UserModule::t("Forgot your password?"),Yii::app()->getModule('user')->recoveryUrl); ?></b>--> <?php echo UserModule::t("Forgot your password?");?>
                <?php echo CHtml::link(UserModule::t("Click here"),Yii::app()->getModule('user')->recoveryUrl); ?>
                </span>
			</aside>
		</section>
	 </article>



