<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Text Translation'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Texts', 'url'=>array('index')),
	array('label'=>'Update Texts', 'url'=>array('update', 'id'=>$model->id)),
);
?>

<h1>View Text #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'language',
		'translation',
	),
)); ?>
