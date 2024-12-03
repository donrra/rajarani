<?php
/* @var $this UserfeedbackController */
/* @var $model Userfeedback */

$this->breadcrumbs=array(
	'Userfeedbacks'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Userfeedback', 'url'=>array('index')),
	array('label'=>'Create Userfeedback', 'url'=>array('create')),
	array('label'=>'View Userfeedback', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Userfeedback', 'url'=>array('admin')),
);
?>

<h1>Update Userfeedback <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>