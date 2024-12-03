<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rajarani/popup.css" />
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
<body class="<?php echo $bodyclass; ?>">

<div class="main1"><!--   class="innerpage" -->
<?php echo $content; ?>
</div>
</body>
</html>