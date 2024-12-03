<?php
/* @var $this SystemmailsController */
/* @var $model Systemmails */

$this->breadcrumbs=array(
	'Systemmails'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Systemmails', 'url'=>array('index')),
	array('label'=>'Manage Systemmails', 'url'=>array('admin')),
);
?>

<h1>Create Systemmails</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>