<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Text Translation'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Texts', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('page-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Texts</h1>

<div class="search-form" style="display:none">
</div><!-- search-form -->



<?php
  // Custom PageSize
$data = $model->search();

$data->pagination->pageSize = 20;

 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'page-grid',
	'dataProvider'=>$data,
	
	'filter'=>$model,
	'columns'=>array(
		'category',
		'message',
	    array('name' => 'danish',
	 		   'value' => '$data->danish',
	  		   'type' => 'text'),	
	    array('name' => 'swedish',
   			  'value' => '$data->swedish',
			  'type' => 'text'),				   
		array('name' => 'norwegian',
			  'value' => '$data->norwegian',
			  'type' => 'text'),				   
		array(
'class'=>'CButtonColumn',
'template'=>'{update}',
			'buttons'=>array(
				'update'=>array(
				'url'=>'Yii::app()->createUrl("backend/translation/translation/update", array("id"=>$data->id))',	
				'label'=>Yii::t('b.images','Update'),
								),
							),
			),

		),
)); ?>
