<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Rajarani</title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rajarani/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rajarani/bootstrap_overwritestyle.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rajarani/chat.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rajarani/construction.css" />



<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rajarani/ie.css" />-->

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/script.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bubbletip.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/chat.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom-form-elements.js"></script>
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
<!----><script>

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

<?php include_once("analyticstracking.php") ?>

<div class="main"><!--   class="innerpage" -->
<?php
if (!Yii::app()->user->isGuest) {
?>
	 <header>
	 	<section class="top_head">
			<div class="wrapper">
				<nav>
					<?php $this->widget('application.components.HeaderLanguage');?>
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
				<aside class="logo">
               	 <a href="<?php echo Yii::app()->request->baseUrl; ?>/"></a>
				</aside>
				
				<?php $this->widget('application.modules.user.components.profilesearchwidget'); ?>
				
                <div class="clear"></div>
			</div>
		</section>
	</header>

 <?php
 	$this->widget('application.components.TopNavmenu',array('activemenu'=>$_SESSION['activemenu'])); ?>
 <?php
 }else{
	 ?>
     <header>
	 	<section class="top_head">
		</section>
		<section class="header_block">
			<div class="wrapper">
				<aside class="logo"> 
                	<a href="<?php echo Yii::app()->request->baseUrl; ?>/"></a>
				</aside>
				<aside class="online_status1">
	     <?php
		 
		 if ($this->getAction()->getId()=='home') { 
		 ?>
         <span>Need an account? <b><?php echo CHtml::link(UserModule::t("Sign Up"),Yii::app()->getModule('user')->registrationUrl); ?></b></span><em></em>
         <?php
		}
		
		 if($this->getAction()->getId()=='login' || $this->getAction()->getId()=='recovery'){   ?>
     	<span>Need an account? <b><?php echo CHtml::link(UserModule::t("Sign Up"),Yii::app()->getModule('user')->registrationUrl); ?></b></span><em></em>
         <?php } 
		 if($this->getAction()->getId()=='registration' || $this->getAction()->getId()=='activation')
		 	{
					if(isset($this->param) && $this->param=='registrationsuccess')
					{
					?>
					<span>Need an account? <b><?php echo CHtml::link(UserModule::t("Sign Up"),Yii::app()->getModule('user')->registrationUrl); ?></b></span><em></em>
					<?php
					$this->param='';
					}else
					{	 
					?>
					<?php 
					}
			}
		  ?>		
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
<input type="hidden" id="baseurl" value="<?php echo Yii::app()->request->baseUrl;?>">
</div>
<script>
	 $(document).ready(function(e) {
		setTimeout('updateonlineusercount();',1000);
    });
	
	function updateonlineusercount()
	{
		$.ajax({
			  url: <?php echo "'".Yii::app()->createUrl('/user/chat/livecount')."'"; ?>,
			  cache: false,
			  type: "post",
	    	  data: 'data',
	          dataType: "json",
	          success: function(data) {
					  if(data.totalcount>0)
					  {
						  if(data.totalcount==1)
							data.totalcount=data.totalcount+" user online";
							else
							data.totalcount=data.totalcount+" users online";
						  $('.talk').find('a').append('<em class=talk_message1>'+data.totalcount+'</em>');
					  }
				},
   			 error: function (response) {
                console.log("error!");
       			 },});setTimeout('updateonlineusercount();',5000);
	}
	 </script>

</body>
</html>