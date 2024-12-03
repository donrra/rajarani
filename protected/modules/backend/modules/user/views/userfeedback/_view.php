<?php
/* @var $this UserfeedbackController */
/* @var $data Userfeedback */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<!--<b><?php //echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php //echo CHtml::encode($data->name); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php //echo CHtml::encode($data->comment); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('browser')); ?>:</b>
	<?php //echo CHtml::encode($data->browser); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('platform')); ?>:</b>
	<?php //echo CHtml::encode($data->platform); ?>
	<br />-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('rating')); ?>:</b>
	<?php echo CHtml::encode($data->rating); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('reason1')); ?>:</b>
	<?php echo CHtml::encode($data->reason1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reason2')); ?>:</b>
	<?php echo CHtml::encode($data->reason2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reason3')); ?>:</b>
	<?php echo CHtml::encode($data->reason3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reason4')); ?>:</b>
	<?php echo CHtml::encode($data->reason4); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reason5')); ?>:</b>
	<?php echo CHtml::encode($data->reason5); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reason6')); ?>:</b>
	<?php echo CHtml::encode($data->reason6); ?>
	<br />

	*/ ?>

</div>