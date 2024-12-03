<?php
/* @var $this SystemmailsController */
/* @var $model Systemmails */

$this->breadcrumbs=array(
	'Systemmails'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Systemmails', 'url'=>array('index')),
);
?>

<h1>View in EN Systemmails #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'subject',
		'message',
		'mailattributes',
	),
)); ?>
<h1>In DK Systemmails </h1>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$dkmodel,
	'attributes'=>array(
		'name',
		'description',
		'subject',
		'message',
		'mailattributes',
	),
)); ?>
<h1>In SE Systemmails </h1>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$semodel,
	'attributes'=>array(
		'name',
		'description',
		'subject',
		'message',
		'mailattributes',
	),
)); ?>
<h1>In NO Systemmails </h1>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$nomodel,
	'attributes'=>array(
		'name',
		'description',
		'subject',
		'message',
		'mailattributes',
	),
)); ?>


