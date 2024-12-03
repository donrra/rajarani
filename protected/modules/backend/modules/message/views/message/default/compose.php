<style type="text/css">
.itens{ float:left; display:inline; width:147px;}
</style>
<?php $this->pageTitle=Yii::app()->name . ' - '.MessageModule::t("Compose Message"); ?>
<?php
	$this->breadcrumbs=array(
		MessageModule::t("Messages"),
		MessageModule::t("Compose"),
	);
?>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation'); ?>

<h2><?php echo MessageModule::t('Compose New Message'); ?></h2>

<div class="form">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id'=>'message-form',
		'enableAjaxValidation'=>false,
	)); ?>

	<p class="note"><?php echo MessageModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>

	<!--<div class="row" style="float:left; display:inline; min-height:400px; height:auto;">
   <?php
    
 		  /*$lo_usermodel= new User;

   		  $user=Yii::app()->db->createCommand("select * from users where status='1' and id!='".Yii::app()->user->getId()."'")->queryAll();
		  echo $form->checkBoxList($lo_usermodel, 'username', CHtml::listData($user, 'id', 'username'),array(
'separator'=>'',
'template'=>'<label class="itens">{input}&nbsp;<span>{label}</span></label>','labelOptions'=>array('style'=>'display:inline')
)
); */?>
	</div>-->
    <div class="row">
		<?php 
            $lo_usermodel= new User;
            $user=Yii::app()->db->createCommand("select id,username from users where status='1' and id!='".Yii::app()->user->getId()."'")->queryAll();
			$user_array = array();
			foreach($user as $val)
			{
				 $user_array[$val['id']]=$val['username'];					  
			}
            echo $form->dropDownList($lo_usermodel,'username',$user_array,array('empty'=>'Users','multiple'=>'multiple','style'=>'width:400px;','size'=>'10'));
        ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject'); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		
		
		
		<?php echo $form->labelEx($model,'body'); ?>
		<?php // echo $form->textArea($model,'body'); ?>
		<?php $this->widget('application.extensions.cleditor.ECLEditor', array(
			'model'=>$model,
	        'attribute'=>'body'
			));
			?>        
        
        
		<?php echo $form->error($model,'body'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(MessageModule::t("Send")); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_suggest'); ?>
