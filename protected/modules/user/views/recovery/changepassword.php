	 <article class="container">
	 	<section class="login_block">
			<aside class="login_box">
				<div class="login_top"></div>
				<div class="login_body">
				<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Change Password");
$this->breadcrumbs=array(
	UserModule::t("Login") => array('/user/login'),
	UserModule::t("Change Password"),
);
?>

<h1><?php echo UserModule::t("Change Password"); ?></h1>



<?php echo CHtml::beginForm($action='', $method='post', $htmlOptions=array ('class'=>'login_form')); ?>

	<p class="note"></p>
	<?php echo CHtml::errorSummary($form); ?>
	
	
	<p class="textbox1">
<?php echo CHtml::activePasswordField($form,'password',array('size'=>20,'maxlength'=>50,'placeholder'=>'password')) ?>
<em></em>
</p>
<p class="hint">
	<?php echo UserModule::t("Minimal password length 4 symbols."); ?>
	</p>
	
	<p class="textbox1">
<?php echo CHtml::activePasswordField($form,'verifyPassword',array('size'=>20,'maxlength'=>50,'placeholder'=>'Retype Password')) ?>
<em></em>
</p>

     <p><?php echo CHtml::submitButton(UserModule::t("Save"),array('class'=>'button')); ?></p>

<?php echo CHtml::endForm(); ?>
<!-- form -->
 				</div>
				<div class="login_bottom"></div>
               
			</aside>
		</section>
	 </article>
