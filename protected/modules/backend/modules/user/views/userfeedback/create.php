<?php
/* @var $this UserfeedbackController */
/* @var $model Userfeedback */

$this->breadcrumbs=array(
	'Userfeedbacks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Userfeedback', 'url'=>array('index')),
	array('label'=>'Manage Userfeedback', 'url'=>array('admin')),
);
?>

<h1>Create Userfeedback</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>