<?php
/* @var $this PageController */
/* @var $model Page */

$this->menu=array(
	array('label'=>'Manage Text', 'url'=>array('admin')),
);
?>

<h1>Update Text "<?php echo $model->english; ?>"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>