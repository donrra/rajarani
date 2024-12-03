 <script>
	 $(document).ready(function() {
		 $('.online_status1').hide();
	   
    });
	 </script>
     <article class="container">
	 	<section class="cms_block">
			<aside class="content">
		
              	<div class="wrapper s_wrapper">
				<h2><?php echo UserModule::t('Well done!');?></h2>
			<?php if(Yii::app()->user->hasFlash('registration')): ?>
           
            <p><?php  echo Yii::app()->user->getFlash('registration'); ?></p>
       
            <?php endif;?>


				</div>
			</aside>
		</section>
	 </article>
    