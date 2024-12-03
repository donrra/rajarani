<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>
<?php if(Yii::app()->user->hasFlash('contact')): ?>
<div class="flash-success">
<p><?php echo Yii::app()->user->getFlash('contact'); ?></p>
</div>
<?php else: ?>
<p>
If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
</p>
<div class="form formfields">
<fieldset>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->

	<?php echo $form->errorSummary($model); ?>

	<div class="row odd">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('class'=>'textbox2')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
    
	<div class="row odd">
		<?php echo $form->labelEx($model,'profilename'); ?>
		<?php echo $form->textField($model,'profilename',array('class'=>'textbox2')); ?>
	</div>
    

	<div class="row odd">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('class'=>'textbox2')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row odd">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128,'class'=>'textbox2')); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row odd">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50,'class'=>'txtara')); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row odd">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div class="captcha_field">
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode',array('class'=>'textbox2')); ?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>

	<div class="row submit">
    	<p class="greenbtn">
		<?php echo CHtml::submitButton('Submit'); ?>
        <em></em>
        </p>
	</div>

<?php $this->endWidget(); ?>
</fieldset>
</div><!-- form -->

<?php endif; ?>