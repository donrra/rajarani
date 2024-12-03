<?php
class HeaderLanguage extends CWidget
{
    public function run()
    {
        $currentLang 	= Yii::app()->language;
		$languageList	= Yii::app()->UrlManager->listLanguage();
		$userlanguage_model = UserSettings::model()->find('user_id=:user_id', array(':user_id'=>Yii::app()->user->id));
        $this->render('headerlanguage', array('currentLang' => $currentLang,'languageList' => $languageList,'userlanguage_model'=>$userlanguage_model));
    }
}