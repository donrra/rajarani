<?php

class PageController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */

    public $layout='//layouts/cmspage';
	
	public $defaultAction='front';
	public $seoKeywords;
	public $seoDescription;
		
	
	
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view','index','front'),
				'users'=>array('*'),
			),
			
		);
	}



/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		
	
			if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}


    public function ActionFront($id)
	{
		
		
	   $pagearr=array();
	   $current_language = Yii::app()->language;
	   $tmpdata = Page::model()->find('internalname=:internalname', array(':internalname'=>$id));
	
	   $internalname=$tmpdata->internalname;	
	   		if($tmpdata)
			{
					if($current_language=='en')
					{
					$pagearr=array('meta_title'=> $tmpdata->meta_title,'meta_keywords'=> $tmpdata->meta_keywords,'meta_description'=> $tmpdata->meta_description,'page_title'=> $tmpdata->page_title,'content'=> $tmpdata->content,'internalname'=> $internalname);
					}else
					{
					$tmpdata= PageLang::model()->findByAttributes(array('page_id'=>$tmpdata->id,'language'=>$current_language));
					$pagearr=array('meta_title'=> $tmpdata->meta_title,'meta_keywords'=> $tmpdata->meta_keywords,'meta_description'=> $tmpdata->meta_description,'page_title'=> $tmpdata->page_title,'content'=> $tmpdata->content,'internalname'=> $internalname);	
					}
			$this->render('cms',array(
	    	'page'=>$pagearr,
			));
			}else
			{
				$error['code']='404';
				$error['message']='Page not Found';	
				$this->render('error',$error);
			}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		
		$this->redirect(array('admin'));
		$dataProvider=new CActiveDataProvider('Page');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	

	/**
	 * public function actionDisplay($id)
	 * Author Prasenjit Chakraborty<prosenjit@nettrackers.net>
	 * Date 4th,Januray 2012
	 * @public function actionDisplay($id)
	 * @id id of the current page
	 * Display the page content
	 */
	public function actionDisplay($id)
	{
		if(Yii::app()->user->isGuest)
			$this->layout='frontend-column2';
			
		$lo_page = Page::model()->findByPk((int)$id);
		$this->render('display',array('lo_page'=>$lo_page));
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='page-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
