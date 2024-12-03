<?php
/* @var $this UserfeedbackController */
/* @var $model Userfeedback */

$this->breadcrumbs=array(
	'Userfeedbacks'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Userfeedback', 'url'=>array('index')),
	//array('label'=>'Create Userfeedback', 'url'=>array('create')),
	//array('label'=>'Update Userfeedback', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Userfeedback', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Userfeedback', 'url'=>array('admin')),
);
?>

<h1>View Userfeedback #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'user_id',
		//'name',
		//'comment',
		//'browser',
		//'platform',
		'rating',
		'reason1',
		'reason2',
		'reason3',
		'reason4',
		'reason5',
		'reason6',
	),
)); ?>
