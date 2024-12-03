<footer>
	 	<div class="wrapper s_wrapper">
			 <aside class="choose_language dropdown" id="choose_lang">
				<a href="javascript:void(0)" class="select">
				<?php if(isset(Yii::app()->language))
				{
					 echo Yii::app()->language;
				}else
				{
				?><?php echo UserModule::t('Choose language');
				}
				?></a>
                <?php $this->widget('application.components.LangBox'); ?>
			</aside>
			<nav>
				<ul>
					<li><a href="#"><?php echo UserModule::t('Support');?></a></li>
					<li><a href="#"><?php echo UserModule::t('Conditions');?></a></li>
					<li><a href="#"><?php echo UserModule::t('Customerservice');?></a></li>
					<li class="last"><a href="#"><?php echo UserModule::t('Contact');?></a></li>
				</ul>
			</nav>
		</div>
	 </footer>