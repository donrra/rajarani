<?php
/* @var $this SystemmailsController */
/* @var $model Systemmails */

$this->breadcrumbs=array(
	'Systemmails'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Systemmails', 'url'=>array('index')),
	array('label'=>'Create Systemmails', 'url'=>array('create')),
	array('label'=>'Update Systemmails', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Systemmails', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Systemmails', 'url'=>array('admin')),
);
?>

<h1>View Systemmails #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'subject',
		'message',
		'attributes',
	),
)); ?>
