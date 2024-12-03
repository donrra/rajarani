<?php
/* @var $this UserfeedbackController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Userfeedbacks',
);

$this->menu=array(
	//array('label'=>'Create Userfeedback', 'url'=>array('create')),
	array('label'=>'Manage Userfeedback', 'url'=>array('admin')),
);
?>

<h1>Userfeedbacks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
