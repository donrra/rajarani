<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Profile"),
);

/*
$this->menu=array(
	((UserModule::isAdmin())
		?array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin'))
		:array()),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
    array('label'=>UserModule::t('Edit'), 'url'=>array('edit'),'visible'=>Yii::app()->user->checkAccess('User.Profile.Edit')),
    array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
    array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
);*/

?>
<?php
  if(UserModule::isAdmin())
  {
////////////////////////////////////////
$this->widget('bootstrap.widgets.TbButtonGroup', array(
'buttons'=>array(
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin')),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
    array('label'=>UserModule::t('Edit'), 'url'=>array('edit')),
	array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
    array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
),
));
////////////////////////////////////////

  }else
  {
////////////////////////////////////////
$this->widget('bootstrap.widgets.TbButtonGroup', array(
'buttons'=>array(
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
(Yii::app()->user->checkAccess('User.Profile.Edit')
		?array('label'=>UserModule::t('Edit'), 'url'=>array('edit'))
		:array('label'=>UserModule::t('Edit'), 'url'=>array('#'))),
    array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
    array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
),
));
////////////////////////////////////////
  
  }

?>


<h1><?php echo UserModule::t('Your profile'); ?></h1>



<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>

<?php
$profile_labels=array();
$profile_values=array();
?>
	<?php 
	    array_push($profile_labels,array('name'=>'username', 'label'=>$model->getAttributeLabel('username')));
		$profile_values['id']=1;
		$profile_values['username']=$model->username;
		
		$profileFields=ProfileField::model()->forOwner()->sort()->findAll();
		if ($profileFields) {
			foreach($profileFields as $field) {
			array_push($profile_labels,array('name'=>$field->title, 'label'=>UserModule::t($field->title)));	
			
			if($field->widgetView($profile))
			{
				$profile_values[$field->title]=$field->widgetView($profile);
			}else if($field->range)
			{
			//$temp=Profile::range($field->range,$profile->getAttribute($field->varname));
			$profile_values[$field->title]= $profile->getAttribute($field->varname);
			
			}else if($profile->getAttribute($field->varname))
			{
			$profile_values[$field->title]= $profile->getAttribute($field->varname);	
			}
			
		  /*   $profile_values[$field->title]=(($field->widgetView($profile))?$field->widgetView($profile):($field->range)?Profile::range($field->range,$profile->getAttribute($field->varname)):$profile->getAttribute($field->varname));
			*/ 
			}//$profile->getAttribute($field->varname)
		}
		$profile_values['email']=$model->email;
		$profile_values['create_at']=$model->getAttributeLabel('lastvisit_at');
		$profile_values['lastvisit_at']=$model->getAttributeLabel('lastvisit_at');
		$profile_values['status']=User::itemAlias("UserStatus",$model->status);
		array_push($profile_labels,array('name'=>'email', 'label'=>$model->getAttributeLabel('email')));
		array_push($profile_labels,array('name'=>'create_at', 'label'=>$model->getAttributeLabel('create_at')));
		array_push($profile_labels,array('name'=>'lastvisit_at', 'label'=>$model->getAttributeLabel('lastvisit_at')));
		array_push($profile_labels,array('name'=>'status', 'label'=>$model->getAttributeLabel('status')));
	?>
<?php
$data_array=$profile_values;

$attributes=$profile_labels;
$this->widget('bootstrap.widgets.TbDetailView', array(
'data'=>$data_array,
'attributes'=>$attributes,
'type'=>'bordered',
));
?>
