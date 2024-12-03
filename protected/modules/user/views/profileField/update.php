<?php
Yii::app()->getComponent('bootstrap');
$this->breadcrumbs=array(
	UserModule::t('Profile Fields')=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	UserModule::t('Update'),
);
?>
<?php

$this->widget('bootstrap.widgets.TbButtonGroup', array(
'buttons'=>array(
    array('label'=>UserModule::t('Create Profile Field'), 'url'=>array('create')),
    array('label'=>UserModule::t('View Profile Field'), 'url'=>array('view','id'=>$model->id)),
    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('admin')),
    array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin')),
),
));
?>
<h1><?php echo UserModule::t('Update Profile Field ').$model->id; ?></h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>