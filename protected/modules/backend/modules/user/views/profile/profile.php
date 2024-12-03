<?php

 $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Profile"),
);


?>
<?php
  if(UserModule::isAdmin())
  {
$this->widget('bootstrap.widgets.TbButtonGroup', array(
'buttons'=>array(
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('/backend/user/admin/')),
    array('label'=>UserModule::t('List User'), 'url'=>array('user/')),
    array('label'=>UserModule::t('Edit'), 'url'=>array('edit')),
  	array('label'=>UserModule::t('Change Password'), 'url'=>array('changepassword')),
    array('label'=>UserModule::t('Logout'), 'url'=>array('/backend/user/logout')),
),
));
  }else
  {
$this->widget('bootstrap.widgets.TbButtonGroup', array(
'buttons'=>array(
    array('label'=>UserModule::t('List User'), 'url'=>array('user/')),
(Yii::app()->user->checkAccess('User.Profile.Edit')
		?array('label'=>UserModule::t('Edit'), 'url'=>array('edit'))
		:array('label'=>UserModule::t('Edit'), 'url'=>array('#'))),
    array('label'=>UserModule::t('Change Password'), 'url'=>array('changepassword')),
    array('label'=>UserModule::t('Logout'), 'url'=>array('/backend/user/logout')),
),
));
  }
?>

<h1><?php echo UserModule::t('Your profile'); ?></h1>


<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
<?php
 
	$attributes = array(
		'username',
	);
	
	$profileFields=ProfileField::model()->forOwner()->sort()->findAll();
	if ($profileFields) {
		foreach($profileFields as $field) {
			array_push($attributes,array(
					'label' => UserModule::t($field->title),
					'name' => $field->varname,
					'type'=>'raw',
					'value' => (($field->widgetView($model->profile))?$field->widgetView($model->profile):(($field->range)?$model->profile->getAttribute($field->varname):$model->profile->getAttribute($field->varname))),
				));
		}
	}
	
	array_push($attributes,
		'email',
		'create_at',
		'lastvisit_at',
		array(
			'name' => 'status',
			'value' => User::itemAlias("UserStatus",$model->status),
		)
	);
	$this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,'attributes'=>$attributes,'type'=>'bordered',
		));

?>