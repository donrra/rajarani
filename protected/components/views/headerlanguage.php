<?php  
/* # languages list
echo '<p><a href="#" class="button1 lang"><span><img src="'.Yii::app()->request->baseUrl.	                            '/images/'.Yii::app()->language.'.png" alt="" class="flagicon" /></span><em></em></a></p>	';
echo '<section class="drop_new"> <ul>';						
 					
   foreach (Yii::app()->UrlManager->listLanguage() as $language => $languageUrl) 
   {
        if (Yii::app()->language==$language) {
        } else {
			echo '<li>'.CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/'.$language.'.png" />', $languageUrl).'</li>';
        }
    }
	echo '</ul></section>';*/
	?>
