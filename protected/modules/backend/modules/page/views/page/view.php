<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Page', 'url'=>array('index')),
	array('label'=>'Create Page', 'url'=>array('create')),
	array('label'=>'Update Page', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Page', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Page', 'url'=>array('admin')),
);
?>

<h1>View Page #<?php echo $model->id; ?></h1>

<?php
/* $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'created',
		'updated',
		'created_by',
		'modified_by',
		'meta_title',
		'meta_keywords',
		'meta_description',
		'page_title',
		'content',
		'published',
		'page_type',
	),
));
*/
 ?>

<?php

$this->widget('zii.widgets.jui.CJuiTabs', array(
    'tabs'=>array(
        'En page'=>$this->renderPartial('tabview',array('page'=>$en_page),true),
        'Da page'=>$this->renderPartial('tabview',array('page'=>$da_page),true),
        'Se page'=>$this->renderPartial('tabview',array('page'=>$se_page),true),
		'No page'=>$this->renderPartial('tabview',array('page'=>$no_page),true),
    ),
    'options'=>array(
        'collapsible'=>true,
        'selected'=>0,
    ),
    'htmlOptions'=>array(
        'style'=>'width:700px;'
    ),
));
?>