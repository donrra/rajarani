<?php

class PageController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $defaultAction='admin';
	
		
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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update','view','index','getdata'),
				'users'=>UserModule::getAdmins(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
		
	/*	return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view','index','getdata'),
				'users'=>array('*'),
				//'expression'=>'UserModule::isAdmin()',
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('*'),
				//'expression'=>'UserModule::isAdmin()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('*'),
			//	'expression'=>'UserModule::isAdmin()',
			),
			array('allow',
				'actions'=>array('display'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'actions'=>array('index',),
				'users'=>array('*'),
			),
		);
		*/
	}


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionGetdata($id,$pagelang)
	{
		if($pagelang=='en')
		{
			echo CJavaScript::jsonEncode($this->loadModel($id));
		}else
		{
	        echo CJavaScript::jsonEncode(PageLang::model()->findByAttributes(array('page_id'=>$id,'language'=>$pagelang)));
			
		}/**/
	}
		/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		
		
		
		$tmpdata=$this->loadModel($id);
		
		$en_pagearr=array('meta_title'=> $tmpdata->meta_title,'meta_keywords'=> $tmpdata->meta_keywords,'meta_description'=> $tmpdata->meta_description,'page_title'=> $tmpdata->page_title,'content'=> $tmpdata->content);
		
		$tmpdata= PageLang::model()->findByAttributes(array('page_id'=>$id,'language'=>'da'));
		$da_pagearr=array('meta_title'=>$tmpdata['meta_title'],'meta_keywords'=>$tmpdata['meta_keywords'],'meta_description'=>$tmpdata['meta_description'],'page_title'=>$tmpdata['page_title'],'content'=>$tmpdata['content']);
		
		
		$tmpdata= PageLang::model()->findByAttributes(array('page_id'=>$id,'language'=>'se'));
		$se_pagearr=array('meta_title'=>$tmpdata['meta_title'],'meta_keywords'=>$tmpdata['meta_keywords'],'meta_description'=>$tmpdata['meta_description'],'page_title'=>$tmpdata['page_title'],'content'=>$tmpdata['content']);
		
		$tmpdata= PageLang::model()->findByAttributes(array('page_id'=>$id,'language'=>'no'));
		$no_pagearr=array('meta_title'=>$tmpdata['meta_title'],'meta_keywords'=>$tmpdata['meta_keywords'],'meta_description'=>$tmpdata['meta_description'],'page_title'=>$tmpdata['page_title'],'content'=>$tmpdata['content']);
		/*
		Meta Title
		Meta Keywords
		Meta Description
		Page Title
		Content
		*/
		$this->render('view',array(
			'model'=>$this->loadModel($id),'en_page'=>$en_pagearr,'da_page'=>$da_pagearr,'se_page'=>$se_pagearr,'no_page'=>$no_pagearr,
            ));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Page;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Page']))
		{
			$model->attributes=$_POST['Page'];
			
		if($model->save())
			{
			//save for others languages 
			// Add it
			foreach (Yii::app()->UrlManager->listLanguage() as $language => $languageUrl) 
			{
				
				if($language!='en')
				{
					$PageLangmodel = new PageLang;
					$action = (empty($_POST['action'])) ? 'default' : $_POST['action'];
				$PageLangmodel->page_id = $model->id;
		    	$PageLangmodel->meta_title = (empty($model->meta_title)) ? ' ' : $model->meta_title;
				$PageLangmodel->meta_keywords = (empty($model->meta_keywords)) ? ' ' : $model->meta_keywords;
				$PageLangmodel->meta_description = (empty($model->meta_description)) ? ' ' : $model->meta_description; 
				$PageLangmodel->page_title = (empty($model->page_title)) ? ' ' : $model->page_title;
				$PageLangmodel->content = (empty($model->content)) ? ' ' : $model->content;
				$PageLangmodel->language = $language;
					//print_r($PageLangmodel);
					$PageLangmodel->save();
								
				}
			}
			
			
			
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
   
		//	print_r($_POST);       
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['language']))
		{

			if(isset($_POST['language']) && $_POST['language']=='en')
				{
				$model->attributes=$_POST['Page'];
				if($model->save())
				$this->redirect(array('view','id'=>$model->id));
				}else
				{
					
					if(isset($_POST['page_language_id']) && $_POST['page_language_id']!=0)
					{
					$model->published= $_POST['Page']['published'];;
					$model->updated= date('d-m-Y h:i:s');
					$model->save();
					 	
						
						
					
					$pagelang_model = PageLang::model()->find('id=:id', array(':id'=>$_POST['page_language_id']));
					$pagelang_model->meta_title = (empty($_POST['Page']['meta_title'])) ? ' ' : $_POST['Page']['meta_title'];
					$pagelang_model->meta_keywords = (empty($_POST['Page']['meta_keywords'])) ? ' ' : $_POST['Page']['meta_keywords'];
					$pagelang_model->meta_description = (empty($_POST['Page']['meta_description'])) ? ' ' : $_POST['Page']['meta_description'];
		        	$pagelang_model->page_title = (empty($_POST['Page']['page_title'])) ? ' ' : $_POST['Page']['page_title'];
					$pagelang_model->content = (empty($_POST['Page']['content'])) ? ' ' : $_POST['Page']['content'];
					$pagelang_model->language = (empty($_POST['language'])) ? ' ' : $_POST['language'];
					//print_r($PageLangmodel->attributes);
					if($pagelang_model->save())
					{
						$this->redirect(array('view','id'=>$model->id));
					}
					else{
						print_r($pagelang_model->getErrors());
						die();
						}
					//	$model->attributes=$_POST['Page'];
					//	if($model->save())
					
					}
				}
			
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
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
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Page('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Page']))
			$model->attributes=$_GET['Page'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Page::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
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
			//$this->layout='frontend-1';
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
