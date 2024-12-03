<?php
/* @var $this SystemmailsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Systemmails',
);

$this->menu=array(
	array('label'=>'Create Systemmails', 'url'=>array('create')),
);
?>

<h1>Systemmails</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'systemmails-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'id',
		'name',
		'description',
		'subject',
		'message',
		'mailattributes',
		array(
			'class'=>'CButtonColumn',
		),
			
	),
)); ?>
