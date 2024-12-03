<?php
/* @var $this UserfeedbackController */
/* @var $model Userfeedback */

$this->breadcrumbs=array(
	'Userfeedbacks'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Userfeedback', 'url'=>array('index')),
	//array('label'=>'Create Userfeedback', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#userfeedback-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Userfeedbacks</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->


<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'userfeedback-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		/*'id',*/
		'user_id',
		'name',
		//'comment',
		//'browser',
		//'platform',
		
		'rating',
		'reason1',
		'reason2',
		'reason3',
		'reason4',
		'reason5',
		'reason6',
		
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}&nbsp;{delete}',
		),
	),
)); ?>
