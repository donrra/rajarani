<!DOCTYPE HTML>
<html>
<head>

<link rel="shortcut icon" href="favicon_rr.png" />

<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="google-site-verification" content="07E4WtZXK9gRRw8Q_kNdgeNdeffBvkBhn5rOMBY3PQc" />

<title>Rajarani</title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rajarani/style.css" />



<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rajarani/ie.css" />
<![endif]-->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bubbletip.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/script.js"></script>
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
</head>
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

<?php include_once("analyticstracking.php") ?>

<body class="loginpage" >

<div class="main">
<?php  if(Yii::app()->user->hasFlash('registration')): ?>
<div class="succes_msg">
	<p><?php echo Yii::app()->user->getFlash('registration'); ?></p>
</div>
<?php endif;  ?>

     <?php $this->widget('application.modules.user.components.loginwidget'); ?>
     	<?php echo $content; ?>
	 <?php $this->widget('application.modules.user.components.footerwidget'); ?>
</div>
<script type="text/javascript">
$(function() {
if (!$.support.placeholder) {
var active = document.activeElement;

$(':text').focus(function() {
if ($(this).attr('placeholder') != '' && $(this).val() == $(this).attr('placeholder')) {
$(this).val('').removeClass('hasPlaceholder');
}
}).blur(function() {
if ($(this).attr('placeholder') != '' && ($(this).val() == '' || $(this).val() == $(this).attr('placeholder'))) {
$(this).val($(this).attr('placeholder')).addClass('hasPlaceholder');
}
});
$(':text').blur();

$(active).focus();



}
});
</script>
</body>
</html>
