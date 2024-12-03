<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Raja Rani</title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rajarani/style.css" />

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rajarani/construction.css" />
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rajarani/ie.css" />
<![endif]-->

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/script.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bubbletip.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bubbletip2.js"></script>
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
				
				<?php $this->widget('application.modules.user.components.profilesearchwidget'); ?>
				
                <div class="clear"></div>
			</div>
		</section>
       </header>

 <?php $this->widget('application.components.TopNavmenu'); ?>
 <?php
 }else{
	 ?>
     <header>
	 	<section class="top_head">
		</section>
		<section class="header_block">
			<div class="wrapper">
				<aside class="logo"><?php echo CHtml::link('',array("/home/"),array()) ; ?></aside>
				<aside class="online_status1">
					<span>Need an account? <b><?php echo CHtml::link(UserModule::t("Sign Up"),Yii::app()->getModule('user')->registrationUrl); ?></b></span>
					<em></em>
				</aside>
				<div class="clear"></div>
			</div>
		</section>
	 </header>
     <?php 
 }
?>
    
<?php echo $content; ?>

<?php $this->widget('application.modules.user.components.footerwidget'); ?>
 
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/uni-form/uni-form.jquery.js"></script>
    <script type="text/javascript">
	
	  $(function () {
		var manutabContainers = $('div#content > div');
		$('ul.nav a').click(function()
		{
			manutabContainers.hide().filter(this.hash).show();
			$(this).parent().parent().find('a').removeClass('active');
			$(this).addClass('active');
			return false;
		});
      });
	</script>    
</div>
</body>
</html>