<?php
/* @var $this SystemmailsController */
/* @var $model Systemmails */

$this->breadcrumbs=array(
	'Systemmails'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
array('label'=>'List Systemmails', 'url'=>array('index')),
	array('label'=>'View Systemmails', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Update Systemmails <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>