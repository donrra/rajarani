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
	<div class="row">
    <?php
	if(!$model->isNewRecord)
	{
		$tmp_languagelist=array();
	foreach (Yii::app()->UrlManager->listLanguage() as $language => $languageUrl) 
			{
				$tmp_languagelist[$language]=$language;
			}
			
       
       

	echo CHtml::dropDownList('language', '',$tmp_languagelist, 
              array('empty' => '(Select a Language)',
			  'onchange'=>"jQuery.ajax({
				  url: '".yii::app()->controller->createUrl('page/getdata')."',
				   data: {id:$model->id,pagelang:$('#language').val()},
				   'dataType':'json',
				      success: function(data){
						$('#page_language_id').val(data.id);
						$('#Page_page_title').val(data.page_title);
						$('#Page_meta_title').val(data.meta_title);
						$('#Page_meta_keywords').val(data.meta_keywords);
						$('#Page_meta_description').val(data.meta_description);
						$('textarea#Page_content').attr('value', data.content);
						var editor = $(\"#Page_content\").cleditor()[0];
						editor.updateFrame();
							  },
					                        })"));

			
	
	echo $form->hiddenField($model,'internalname',array('size'=>60,'maxlength'=>255));
	}else
	{
		?>
        <div class="row">
		<?php echo $form->labelEx($model,'internalname'); ?>
		<?php echo $form->textField($model,'internalname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'internalname'); ?>
	</div>
        <?php
		
	}
	?>
    <?php echo CHtml::hiddenField('page_language_id','0',array('size'=>10,'maxlength'=>8));
?>
    
    </div>

	
    
    <div class="row">
		<?php echo $form->labelEx($model,'page_title'); ?>
		<?php echo $form->textField($model,'page_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'page_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta_title'); ?>
		<?php echo $form->textField($model,'meta_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'meta_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta_keywords'); ?>
		<?php echo $form->textField($model,'meta_keywords',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'meta_keywords'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta_description'); ?>
		<?php echo $form->textField($model,'meta_description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'meta_description'); ?>
	</div>

	<div class="row" id="editorarea">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php $this->widget('ext.cleditor.ECLEditor', array(
	        'model'=>$model,
	        'attribute'=>'content', //Model attribute name.
	        'options'=>array(
	            'width'=>'600',
	            'height'=>250,
	            'useCSS'=>true,
	        ),
	        'value'=>$model->content,
	    ));?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'published'); ?>
		<?php echo $form->checkBox($model,'published',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'published'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'page_type'); ?>
		<?php echo $form->textField($model,'page_type',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'page_type'); ?>
	</div>

	<div class="row buttons">
	
    
    	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
$(document).ready(function() {
//$("#Page_content").cleditor({width:800, height:300, updateTextArea:function (){}})[0].clear().execCommand("inserthtml", data, null, null);
//$("#Page_content").cleditor();
//var $editor = $('#Page_meta_description').cleditor()
//updateFrame($editor,true);
// Handler for .ready() called.
});

</script>
