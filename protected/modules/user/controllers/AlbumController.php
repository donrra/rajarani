<?php

class AlbumController extends Controller
{
	public $defaultAction = 'view';
	public $layout='//layouts/subpage';
	

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	/**
	 * Shows a particular model.
	 */
	

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionView()
	{
		$_SESSION['activemenu']='image';
			
		if (Yii::app()->user->isGuest)
		{
		$this->redirect(Yii::app()->controller->module->loginlandingUrl);
		}else
		{	
			
			if(isset($_SESSION['userprofileldstatus']) && $_SESSION['userprofileldstatus'] == 'incomplete')
			{
			$this->redirect(array("/user/profile/edit"));
			}	
		// ajax validator
		$baseUrl = Yii::app()->baseUrl; 
		$js = Yii::app()->getClientScript();
		$js->registerScriptFile($baseUrl.'/js/jquery.lightbox.js');
		$js->registerCssFile($baseUrl.'/css/lightbox.css');
	
		 Yii::app()->getComponent('bootstrap');
		 $gallery = Gallery::model()->findByPk(1);
		 if(!$gallery)
		{
		$gallery = new Gallery();
        $gallery->name = false;
        $gallery->description = false;
        $gallery->versions = array(
            'profile' => array(
                'resize' => array(60,60,null),
            ),
			'small' => array(
                'resize' => array(172, null),
            ),
            'medium' => array(
                'resize' => array(800, null),
            )
        );
        $gallery->save();
		}
		 $this->render('view',array('gallery'=>$gallery));
		}
	}
	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
	 */
	public function loadUser()
	{
		if($this->_model===null)
		{
			
			if(Yii::app()->user->id)
				$this->_model=Yii::app()->controller->module->user();
			if($this->_model===null)
				$this->redirect(Yii::app()->controller->module->loginUrl);
		}
		return $this->_model;
	}
}