<footer class="cmsfooter">
	 	<div class="wrapper s_wrapper">
			 <aside class="choose_language" id="choose_lang">
				<a href="javascript:void(0)" class="select">
				<?php //if(isset(Yii::app()->language))
				//{
					//echo UserModule::t('Choose language')." "; echo Yii::app()->language;
				//}else
				//{
				?><?php //echo UserModule::t('Choose language');
				//}
				?></a>
                <?php //$this->widget('application.components.LangBox'); ?>
			</aside>
			<nav>
				<ul>
					<li><?php echo CHtml::link(UserModule::t('Support'),array('/support')); ?></li>
                    <li><?php echo CHtml::link(UserModule::t('Conditions'),array('/termsofuse')); ?></li>
					<li><?php echo CHtml::link(UserModule::t('About'),array('/About')); ?></li>
                    <li class="last"><?php echo CHtml::link(UserModule::t('Contact'),array('/contact')); ?></li>
   
				</ul>
			</nav>
		</div>
	 </footer>