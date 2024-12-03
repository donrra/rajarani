<?php
/* @var $this SystemmailsController */
/* @var $model Systemmails */
/* @var $form CActiveForm */
?>
<script>

function numChange()
{
	console.log($("#lang_name option:selected").val());
   $('#selected_lang_name').val($("#lang_name option:selected").val());
	$.post("getData",{language:$("#lang_name option:selected").val(),id:$('#message_id').val()},
	function(data) {
	$('#Systemmails_name').val(data.name);
	$('#Systemmails_description').val(data.description);
	$('#Systemmails_subject').val(data.subject);
	$('#Systemmails_message').val(data.message);
	$('#Systemmails_mailattributes').val(data.mailattributes);
	}, "json");
   }</script>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'systemmails-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php
	if(!$model->isNewRecord)
	{?>
    <div class="row">
	<label for="Systemmails_name">Select Language</label>
	
	<?php echo CHtml::dropDownList('lang_name','', array('en'=>'English','dk'=>'Danish','se'=>'Swedish','no'=>'Norwegian'),array('onchange'=>'numChange(this.value)'));?>
	   <?php echo CHtml::hiddenField('selected_lang_name', 'en',array('id'=>'selected_lang_name')); ?>
         <?php echo CHtml::hiddenField('message_id',$model->id); ?>
	
    </div>
  <?php
  }
  ?>
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
    	<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'message'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mailattributes'); ?>
		<?php echo $form->textField($model,'mailattributes',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'mailattributes'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->