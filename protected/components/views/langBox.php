<?php  
 # languages list
 echo '<ul>';
   foreach (Yii::app()->UrlManager->listLanguage() as $language => $languageUrl) {
        
        if (Yii::app()->language==$language) {
            echo '<li><span>'.$language.'</span></li>';
        } else {
            echo '<li><span>'.CHtml::link($language,$languageUrl).'</span></li>';
        }
        
    }echo '</ul>';
	?>
