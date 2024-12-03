<?php
class LangBox extends CWidget
{
    public function run()
    {
        $currentLang 	= Yii::app()->language;
		$languageList	= Yii::app()->params['languageList'];
        $this->render('langBox', array('currentLang' => $currentLang,'languageList' => $languageList));
    }
}