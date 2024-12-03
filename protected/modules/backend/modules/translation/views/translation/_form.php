<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'page-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row" style="visibility:hidden">
		<?php echo $form->textField($model,'id',array('size'=>60,'maxlength'=>255)); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'english',array('style'=>'float:left; line-height:20px; padding:0 10px 0 0; width:60px;')); ?>
		<?php echo $form->textField($model,'english',array('size'=>60,'maxlength'=>255,'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'english'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'danish',array('style'=>'float:left; line-height:20px; padding:0 10px 0 0; width:60px;')); ?>
		<?php echo $form->textField($model,'danish',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'danish'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'swedish',array('style'=>'float:left; line-height:20px; padding:0 10px 0 0; width:60px;')); ?>
		<?php echo $form->textField($model,'swedish',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'swedish'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'norwegian',array('style'=>'float:left; line-height:20px; padding:0 10px 0 0; width:60px;')); ?>
		<?php echo $form->textField($model,'norwegian',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'norwegian'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->