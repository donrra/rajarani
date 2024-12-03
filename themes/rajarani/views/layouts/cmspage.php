<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $this->pageTitle;?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo $this->seoKeywords;?>" />
<meta name="description" content="<?php echo $this->seoDescription;?>" />


<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rajarani/style.css" />
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rajarani/ie.css" />
<![endif]-->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/script.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bubbletip.js"></script>
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
</head>
<?php
if (Yii::app()->user->isGuest) {
$bodyclass='loginpage';
}else
{
$bodyclass='innerpage';	
}
?>
<script type="text/javascript">
$( document ).ready(function() {
	$.ajax({
					type : 'POST', 
					url: <?php echo "'".Yii::app()->createUrl('/user/profile/pageload')."'"; ?>,
					data: {},
					success: function(){
					}
					
				})
});
</script>
<body class="<?php echo $bodyclass; ?>">

<div class="main"><!--   class="innerpage" -->

<?php
if (!Yii::app()->user->isGuest) {
?>
	 <header>
	 	<section class="top_head">
			<div class="wrapper">
			<nav>
					<?php $this->widget('application.components.HeaderLanguage'); ?>
                 <p>
                     <?php
                    $logtxt_source='<span><sup class="close"></sup></span><em></em>';
					echo CHtml::link($logtxt_source,array('/user/logout'),array('class'=>'button1')); 
					?></p>
				</nav>
			</div>
		</section>
		<section class="header_block">
			<div class="wrapper">
				<aside class="logo"><?php echo CHtml::link('',array("/home/"),array()) ; ?></aside>
				
				<?php 
				 $this->widget('application.modules.user.components.profilesearchwidget'); ?>
                <div class="clear"></div>
			</div>
		</section>
	</header>

 <?php $this->widget('application.components.TopNavmenu'); ?>
 <?php
 }else{
	 ?>
      <?php $this->widget('application.modules.user.components.loginwidget'); ?>
	 <?php 
 }
?>
	
<?php echo $content; ?>
<?php $this->widget('application.modules.user.components.cmsfooterwidget'); ?>
</div>
</body>
</html>