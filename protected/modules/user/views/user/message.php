<script>
$(document).ready(function(){
	$('#login').click(function(){
		location.href=<?php echo Yii::app()->request->baseUrl; ?>'/user/login';
	})
})
</script>
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login"); ?>


<article class="container">
  <section class="cms_block">
    <aside class="content">
      <div class="wrapper s_wrapper ">
        <h2><?php echo $title; ?></h2>
        <p> <?php echo $content; 
			?></p>
        <span class="accountText"> <b>
        <p class="greenbtn" style="text-align: center; padding-right:27px;"> <?php echo CHtml::button(UserModule::t('Proceed to Login'),array('id'=>'login')); ?><em></em></p>
        </b></span> </div>
    </aside>
  </section>
</article>
