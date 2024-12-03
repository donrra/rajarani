
	 <article class="container">
	 	<section class="login_block">
			<aside class="login_box">
				<div class="login_top"></div>
				<div class="login_body">
					<h1>Log ind til Rajarani</h1>
					<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'login-form',
	'htmlOptions' => array('class'=>'login_form'),
)); ?>
<?php echo CHtml::errorSummary($model); ?>
                    <!--<form class="login_form">-->
<p class="textbox1">
<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20,'placeholder'=>'Brugernavn')); ?>
<em></em>
</p>
<p class="textbox1">
<?php echo $form->PasswordField($model,'password',array('size'=>20,'maxlength'=>20,'placeholder'=>'password')); ?>
<em></em>
</p>
		<p class="checkbox"><?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
        <?php echo CHtml::activeLabelEx($model,'rememberMe'); ?>
        </p>
		
                <p>
                <?php echo CHtml::submitButton(UserModule::t("Log ind"),array('class'=>'button')); ?></p>
                       </p>
					
                   <?php $this->endWidget(); ?>
				</div>
				<div class="login_bottom"></div>
			</aside>
		</section>
	 </article>



