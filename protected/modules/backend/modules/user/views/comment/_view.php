<?php
/* @var $this CommentController */
/* @var $data Comment */
?>

<div class="view">

	<!--<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('browser')); ?>:</b>
	<?php echo CHtml::encode($data->browser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('platform')); ?>:</b>
	<?php echo CHtml::encode($data->platform); ?>
	<br />


</div>