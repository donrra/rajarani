<header>
	 	<section class="top_head">
			<div class="wrapper">
<?php
	$form=$this->beginWidget('UActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
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
<?php echo CHtml::submitButton(UserModule::t("Log in")); ?>
<em></em>
</p>
<?php $this->endWidget(); ?>

			</div>
            
		</section>
		<section class="header_block">
			<div class="wrapper">
				<aside class="logo"><a href="#"></a></aside>
				<aside class="online_status">
					<span><b><?php echo UserModule::t('Online:');?></b> 1.489</span>
					<em></em>
				</aside>
				<div class="clear"></div>
			</div>
		</section>
	 </header>