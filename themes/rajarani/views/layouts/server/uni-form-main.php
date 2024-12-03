<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    
  
     
     <!-- CSS -->
     <!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rajarani/screen.css" media="screen, projection" />
     <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rajarani/main.css" />
     
     <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/uni-form/uni-form.css" media="screen"/>
     <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/uni-form/default.uni-form.css" media="screen"/>
     <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/uni-form/assets/default.css" media="screen"/>
     
    <!-- !IE Specific Style Sheets --> 
    <!--[if lte ie 6]><link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/uni-form/assets/assets/ie6.css" media="screen"/><![endif]--> 
    <!--[if lt IE 7]><script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE7.js" type="text/javascript"></script><![endif]--> 
    <!--[if ie 7]><link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/uni-form/assets/assets/ie7.css" media="screen"/><![endif]--> 
    <!--[if ie 8]><link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/uni-form/assets/assets/ie8.css" media="screen"/><![endif]-->

  </head>

<body id="home">
<div class="container" id="page">
	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->
<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
        array('label'=>'Rights', 'url'=>array('/rights'), 'visible'=>!Yii::app()->user->isGuest),
        array('url'=>Yii::app()->getModule('user')->loginUrl, 'label'=>Yii::app()->getModule('user')->t("Login"), 'visible'=>Yii::app()->user->isGuest),
        array('url'=>Yii::app()->getModule('user')->registrationUrl, 'label'=>Yii::app()->getModule('user')->t("Register"), 'visible'=>Yii::app()->user->isGuest),
        array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest),
        array('url'=>Yii::app()->getModule('user')->logoutUrl, 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest),
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
    
    

	<?php echo $content; ?>
 <!-- JavaScript -->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/uni-form/uni-form.jquery.js"></script>
  </div>  
</body>
</html>
