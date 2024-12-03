<?php
Yii::app()->getComponent('bootstrap');
$this->breadcrumbs=array(
	UserModule::t("Users"),
);
if(UserModule::isAdmin()) {
$this->widget('bootstrap.widgets.TbButtonGroup', array(
'buttons'=>array(
	    array('label'=>UserModule::t('Manage Users'), 'url'=>array('/backend/user/admin')),
	    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('/backend/user/profileField/admin')),
	),
));
}

?>

<h1><?php echo UserModule::t("List User"); ?></h1>

<?php
 $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->username),array("user/view","id"=>$data->id))',
		),
		'create_at',
		'lastvisit_at',
	),
));
 ?>
