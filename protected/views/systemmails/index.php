<?php
/* @var $this SystemmailsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Systemmails',
);

$this->menu=array(
	array('label'=>'Create Systemmails', 'url'=>array('create')),
	array('label'=>'Manage Systemmails', 'url'=>array('admin')),
);
?>

<h1>Systemmails</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
