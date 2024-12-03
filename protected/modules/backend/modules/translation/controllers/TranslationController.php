<?php

class TranslationController extends Controller
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
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view','index'),
				//'users'=>array('*'),
				'expression'=>'UserModule::isAdmin()'
				),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','AjaxGetText'),
				//'users'=>array('*'),
				'expression'=>'UserModule::isAdmin()'
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				//'users'=>array('*'),
				'expression'=>'UserModule::isAdmin()'
			),*/
			array('allow',
				'actions'=>array('display','admin','delete','create','update','AjaxGetText','view','index'),
				'users'=>array('admin'),
				'expression'=>'UserModule::isAdmin()'
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
	public function actionView($id,$language)
	{
		
		$this->render('view',array(
			'model'=>$this->loadModelbyLang($id,$language),
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

		if(isset($_POST['Lang']))
		{
			$model->attributes=$_POST['Lang'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}




	public function actionAjaxGetText($id,$language)
	{
		$model=Lang::model()->findByAttributes(array(
        'id' => $id,'language' =>$language
        ));
		echo $model->translation;
	
	}







	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadAllLangTextByID($id);

		if(isset($_POST['LangSource']))
		{
		//	echo "UPDATE `lang` SET `translation` = '".addslashes($_POST['LangSource']['danish'])."' WHERE `lang`.`id` =".$_POST['LangSource']['id']." AND `lang`.`language` = 'da';";
		
		if($model->danish=='')
		{
			Yii::app()->db->createCommand("Insert into `lang`(id,language,translation) values (".$_POST['LangSource']['id'].",'dk','".addslashes($_POST['LangSource']['danish'])."')")->execute();
		}else
		{
			Yii::app()->db->createCommand("UPDATE `lang` SET `translation` = '".addslashes($_POST['LangSource']['danish'])."' WHERE `lang`.`id` =".$_POST['LangSource']['id']." AND `lang`.`language` = 'dk';")->execute();
		}
		
		if($model->swedish=='')
		{
			Yii::app()->db->createCommand("Insert into `lang`(id,language,translation) values (".$_POST['LangSource']['id'].",'se','".addslashes($_POST['LangSource']['swedish'])."')")->execute();
		}else
		{
			Yii::app()->db->createCommand("UPDATE `lang` SET `translation` = '".addslashes($_POST['LangSource']['swedish'])."' WHERE `lang`.`id` =".$_POST['LangSource']['id']." AND `lang`.`language` = 'se';")->execute();
		}
		
		if($model->norwegian=='')
		{
			Yii::app()->db->createCommand("Insert into `lang`(id,language,translation) values (".$_POST['LangSource']['id'].",'no','".addslashes($_POST['LangSource']['norwegian'])."')")->execute();
		}else
		{
			Yii::app()->db->createCommand("UPDATE `lang` SET `translation` = '".addslashes($_POST['LangSource']['norwegian'])."' WHERE `lang`.`id` =".$_POST['LangSource']['id']." AND `lang`.`language` = 'no';")->execute();	
		}
			$this->redirect(array('admin'));
		}

        $this->render('update',array(
			'model'=>$model
		));
	}

	public function actionIndex()
	{
		$this->redirect(array('admin'));
		$dataProvider=new CActiveDataProvider('Lang');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new LangSource('search');
			$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LangSource']))
			$model->attributes=$_GET['LangSource'];

		$this->render('admin',array(
			'model'=>$model
		));
	}
	
	 public function loadAllLangTextByID($id)
	 {		
		$criteria=new CDbCriteria;
		$criteria->select="t.id,t.category,t.message AS english,u.language AS language,u.translation AS danish,u2.language AS language2,u2.translation AS swedish,u3.translation AS norwegian  ";//,u.id,u.translation";
		$criteria->join=" left join lang u on t.id=u.id  AND u.language='dk'";
		$criteria->join.=" left join lang u2 on t.id=u2.id AND u2.language='se'";
		$criteria->join.=" left join lang u3 on t.id=u3.id AND u3.language='no'";
		$criteria->condition="u.translation!='' AND t.id=$id"; // AND u2.translation!=''
		$model=LangSource::model()->find($criteria);
		
	 
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;	 
		 
		 
	 }
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)//,$language
	{
		$model=Lang::model()->findByAttributes(array(
        'id' => $id,
        ));
	
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function loadModelbyLang($id,$language)//,$language
	{
		$model=Lang::model()->findByAttributes(array(
        'id' => $id,'language' =>$language
        ));
	
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
	public function actionDisplay($id,$language)
	{
		if(Yii::app()->user->isGuest)
			$this->layout='frontend-column2';
			
		$lo_page = Page::model()->findByAttributes(array(
        'id' => $id,
        'language' =>$language));
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
