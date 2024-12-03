<?php

class SystemmailsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','GetData'),
				'users'=>array('@'),
			),*/
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update','GetData','index','view'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'dkmodel' => SystemmailsLang::model()->findByAttributes(array('msg_id'=>$id,'lang'=>'dk')),
			'semodel' => SystemmailsLang::model()->findByAttributes(array('msg_id'=>$id,'lang'=>'se')),
			'nomodel' => SystemmailsLang::model()->findByAttributes(array('msg_id'=>$id,'lang'=>'no')),
		));
	}



		//
	public function actionGetData()
	{
		
		 $language=$_POST['language'];
		 $msg_id=$_POST['id'];
					
		if($language=='en')
		{
			$sysmsg_eng=Systemmails::model()->findbyPk($msg_id);
		$systemmesgArr=array();
		$systemmesgArr['name']=$sysmsg_eng->name;
		$systemmesgArr['description']=$sysmsg_eng->description;
		$systemmesgArr['subject']=$sysmsg_eng->subject;
		$systemmesgArr['message']=$sysmsg_eng->message;
		$systemmesgArr['mailattributes']=$sysmsg_eng->mailattributes;
		}else
		{
		$sysmsg_othrs = SystemmailsLang::model()->findByAttributes(array('msg_id'=>$msg_id,'lang'=>$language));
		$systemmesgArr=array();
		$systemmesgArr['name']=$sysmsg_othrs->name;
		$systemmesgArr['description']=$sysmsg_othrs->description;
		$systemmesgArr['subject']=$sysmsg_othrs->subject;
		$systemmesgArr['message']=$sysmsg_othrs->message;
		$systemmesgArr['mailattributes']=$sysmsg_othrs->mailattributes;
		
		}
		echo json_encode($systemmesgArr);
	}



	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Systemmails;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Systemmails']))
		{
			
			$model->attributes=$_POST['Systemmails'];
			
			if($model->save())
			{
				$langmodel=new SystemmailsLang;
				$langmodel->lang='dk';
				$langmodel->name=$model->name;
				$langmodel->description=$model->description;
				$langmodel->subject=$model->subject;
				$langmodel->message=$model->message;
				$langmodel->mailattributes=$model->mailattributes;
				$langmodel->msg_id=$model->id;
				$langmodel->save(false);
	
				$langmodel=new SystemmailsLang;
				$langmodel->lang='no';
				$langmodel->name=$model->name;
				$langmodel->description=$model->description;
				$langmodel->subject=$model->subject;
				$langmodel->message=$model->message;
				$langmodel->mailattributes=$model->mailattributes;
				$langmodel->msg_id=$model->id;
				$langmodel->save(false);
				
				$langmodel=new SystemmailsLang;
				$langmodel->lang='se';
				$langmodel->name=$model->name;
				$langmodel->description=$model->description;
				$langmodel->subject=$model->subject;
				$langmodel->message=$model->message;
				$langmodel->mailattributes=$model->mailattributes;
				$langmodel->msg_id=$model->id;
				$langmodel->save(false);
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
		Yii::app()->clientScript->registerCoreScript('jquery'); 
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Systemmails']))
		{
			
	  if($_POST['selected_lang_name']=='en')
	  {
			$model->attributes=$_POST['Systemmails'];
			if($model->save())
			$this->redirect(array('view','id'=>$model->id));
	 }else
	  {
		  
		 $sysmsg_othrs = SystemmailsLang::model()->findByAttributes(array('msg_id'=>$_POST['message_id'],'lang'=>$_POST['selected_lang_name']));
		$sysmsg_othrs->name=$_POST['Systemmails']['name'];
		$sysmsg_othrs->description=$_POST['Systemmails']['description'];
		$sysmsg_othrs->subject=$_POST['Systemmails']['subject'];
		$sysmsg_othrs->message=$_POST['Systemmails']['message'];
		$sysmsg_othrs->mailattributes=$_POST['Systemmails']['mailattributes'];
		$sysmsg_othrs->save(false);
		
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
		$this->loadModel($id)->delete();
		
	   SystemmailsLang::model()->findByAttributes(array('msg_id'=>$id,'lang'=>'dk'))->delete();
	   SystemmailsLang::model()->findByAttributes(array('msg_id'=>$id,'lang'=>'se'))->delete();
	   SystemmailsLang::model()->findByAttributes(array('msg_id'=>$id,'lang'=>'no'))->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Systemmails');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Systemmails('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Systemmails']))
			$model->attributes=$_GET['Systemmails'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Systemmails the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Systemmails::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Systemmails $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='systemmails-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
