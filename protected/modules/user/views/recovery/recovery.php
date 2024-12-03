<?php if(Yii::app()->user->hasFlash('recoveryMessage')){ ?>
<article class="container">
	 	<section class="cms_block">
			<aside class="content">
		
              	<div class="wrapper s_wrapper">
				<h2><?php echo UserModule::t("Restore"); ?></h2>
			<p><?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>.</p>
            <p class="greenbtn" style="text-align: center; padding-right:27px;">
				<?php echo CHtml::button('Login',array('id'=>'login', 'submit' => Yii::app()->request->baseUrl.'/user/login')); ?><em></em>
            </p>
          	</div>
			</aside>
		</section>
	 </article>

<?php }else if(Yii::app()->user->hasFlash('recoveryMessage1')){ ?>
<article class="container">
	 	<section class="cms_block">
			<aside class="content">
		
              	<div class="wrapper s_wrapper">
				<h2><?php echo UserModule::t("Restore"); ?></h2>
			<p><?php echo Yii::app()->user->getFlash('recoveryMessage1'); ?>.</p>
          	</div>
			</aside>
		</section>
	 </article>

<?php }else if(Yii::app()->user->hasFlash('recoveryMessage2')){ ?>
<article class="container">
	 	<section class="cms_block">
			<aside class="content">
		
              	<div class="wrapper s_wrapper">
				<h2><?php echo UserModule::t("Restore"); ?></h2>
			<p><?php echo Yii::app()->user->getFlash('recoveryMessage2'); ?>.</p>
          	</div>
			</aside>
		</section>
	 </article>

<?php }else{ ?>

	 <article class="container">
	 	<section class="login_block">
			<aside class="login_box">
				<div class="login_top"></div>
				<div class="login_body">
					<h1><?php echo UserModule::t("Restore"); ?></h1>
                <?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Restore");
$this->breadcrumbs=array(
	UserModule::t("Login") => array('/user/login'),
	UserModule::t("Restore"),
);
?>

<?php echo CHtml::beginForm($action='', $method='post', $htmlOptions=array ('class'=>'login_form')); ?>

	<?php echo CHtml::errorSummary($form); ?>
	<p class="textbox1">
<?php echo CHtml::activeTextField($form,'login_or_email',array('size'=>20,'maxlength'=>50,'placeholder'=>'username or email')) ?>
<em></em>
</p>
	  <p style="font:13px cilliansemi-expanded_regular;"><?php echo UserModule::t("Please enter your username or email address to retreive your password."); ?></p>
	  <p><?php echo CHtml::submitButton(UserModule::t("continue"),array('class'=>'button')); ?></p>
	

<?php echo CHtml::endForm(); ?>
<!-- form -->
                </div>
				<div class="login_bottom"></div>
               
			</aside>
		</section>
	 </article>
<?php } ?>
