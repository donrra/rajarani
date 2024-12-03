<?php
Yii::app()->getComponent('bootstrap');
$this->breadcrumbs=array(
	UserModule::t('Profile Fields')=>array('profileField/admin'),
	UserModule::t('Create'),
);
$this->widget('bootstrap.widgets.TbButtonGroup', array(
'buttons'=>array(
   array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin/')),
),
));
?>
<h1><?php echo UserModule::t('Create Profile Field'); ?></h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>