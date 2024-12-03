<?php
/* @var $this UserfeedbackController */
/* @var $model Userfeedback */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'userfeedback-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textField($model,'comment',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'browser'); ?>
		<?php echo $form->textField($model,'browser',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'browser'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'platform'); ?>
		<?php echo $form->textField($model,'platform',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'platform'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rating'); ?>
		<?php echo $form->textField($model,'rating'); ?>
		<?php echo $form->error($model,'rating'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reason1'); ?>
		<?php echo $form->textField($model,'reason1',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'reason1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reason2'); ?>
		<?php echo $form->textField($model,'reason2',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'reason2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reason3'); ?>
		<?php echo $form->textField($model,'reason3',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'reason3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reason4'); ?>
		<?php echo $form->textField($model,'reason4',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'reason4'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reason5'); ?>
		<?php echo $form->textField($model,'reason5',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'reason5'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reason6'); ?>
		<?php echo $form->textField($model,'reason6',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'reason6'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->