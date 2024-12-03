<?php

class AdminController extends Controller
{
	public $defaultAction = 'admin';
	public $layout='//layouts/column2';
	
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return CMap::mergeArray(parent::filters(),array(
			'accessControl', // perform access control for CRUD operations
		));
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
				'actions'=>array('admin','delete','create','update','view'),
				'users'=>UserModule::getAdmins(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->layout='//layouts/column1';
		$model=new User('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['User']))
            $model->attributes=$_GET['User'];

        $this->render('index',array(
            'model'=>$model,
        ));
	}


	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$model = $this->loadModel();
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;
		$profile=new Profile;
		$this->performAjaxValidation(array($model,$profile));
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);
			$profile->attributes=$_POST['Profile'];
			$profile->user_id=0;
			if($model->validate()&&$profile->validate()) {
				$model->password=Yii::app()->controller->module->encrypting($model->password);
				if($model->save()) {
					$profile->user_id=$model->id;
					$profile->save();	
				}
				$this->redirect(array('view','id'=>$model->id));
			} else $profile->validate();
		}

		$this->render('create',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		Yii::app()->getComponent('bootstrap');
		$this->layout='//layouts/uni-form';
		$model =User::model()->notsafe()->findbyPk($_GET['id']);
		$profile=$model->profile;
	
		UWprofilepic::handleProfilePic($model,$profile);
		    
		$step=1;
		
		// ajax validator
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo UActiveForm::validate(array($model));
			Yii::app()->end();
		}
		if(isset($_POST))
		{
	
		if(isset($_POST['step']) && $_POST['step']==1)
		{
		$profile->attributes=$_POST['Profile'];
		foreach($_POST['Profile'] as $name1 => $val1)
		{
			if(is_array($val1))
			{
				$profile->$name1=implode(',',$val1);
			}
		}
		
	
	    if($model->validate($_POST['User']) && $profile->validate($_POST['Profile']) ) { //
		
		$model->attributes=$_POST['User'];
		$profile->attributes=$_POST['Profile'];
		foreach($_POST['Profile'] as $name1 => $val1)
		{
			if(is_array($val1))
			{
				$profile->$name1=implode(',',$val1);
			}
		}
			if($model->save() && $profile->save(false))
			{
			Yii::app()->user->updateSession();
			Yii::app()->user->setFlash('profileMessage1',UserModule::t(" Step 1 Changes is saved."));
			   $step=1;
			}
			}
		}
		if(isset($_POST['step'])  && $_POST['step']==2)
		{
			
			
		$profile->attributes=$_POST['Profile'];
		foreach($_POST['Profile'] as $name1 => $val1)
		{
			if(is_array($val1))
			{
				$profile->$name1=implode(',',$val1);
			}
		}
			
		  if($profile->validate($_POST['Profile']))
		   {
			   
		$profile->attributes=$_POST['Profile'];
		foreach($_POST['Profile'] as $name1 => $val1)
		{
			if(is_array($val1))
			{
				$profile->$name1=implode(',',$val1);
			}
		}			   


			if($profile->save(false))
			{
			Yii::app()->user->updateSession();
			Yii::app()->user->setFlash('profileMessage2',UserModule::t(" Step 2 Changes is saved."));
			$step=2;
			}
			}
		
		}elseif(isset($_POST['step'])  && $_POST['step']==3)
		{
			$profile->attributes=$_POST['Profile'];
			foreach($_POST['Profile'] as $name1 => $val1)
			{
			if(is_array($val1))
			{
			$profile->$name1=implode(',',$val1);
			}
			}
	
			
			
          if($profile->validate($_POST['Profile'])) 
		  {
		$profile->attributes=$_POST['Profile'];
		foreach($_POST['Profile'] as $name1 => $val1)
		{
			if(is_array($val1))
			{
				$profile->$name1=implode(',',$val1);
			}
		}			   
			if($profile->save(false))
			{
			Yii::app()->user->updateSession();
			Yii::app()->user->setFlash('profileMessage3',UserModule::t(" Step 3 Changes is saved."));
				$step=3;
			}		
		  }		
		}elseif(isset($_POST['step'])  && $_POST['step']==4)
		{


		$profile->attributes=$_POST['Profile'];
		foreach($_POST['Profile'] as $name1 => $val1)
		{
			if(is_array($val1))
			{
				$profile->$name1=implode(',',$val1);
			}
		}	
		
			
          if($profile->validate($_POST['Profile'])) 
		  {
		$profile->attributes=$_POST['Profile'];
		foreach($_POST['Profile'] as $name1 => $val1)
		{
			if(is_array($val1))
			{
				$profile->$name1=implode(',',$val1);
			}
		}			   
			if($profile->save(false))
			{
			Yii::app()->user->updateSession();
			Yii::app()->user->setFlash('profileMessage4',UserModule::t(" Step 4 Changes is saved."));
				$step=4;
			}		
		  }		
		}
		elseif(isset($_POST['step'])  && $_POST['step']==5)
		{


		$profile->attributes=$_POST['Profile'];
		foreach($_POST['Profile'] as $name1 => $val1)
		{
			if(is_array($val1))
			{
				$profile->$name1=implode(',',$val1);
			}
		}	
		
			
          if($profile->validate($_POST['Profile'])) 
		  {
		$profile->attributes=$_POST['Profile'];
		foreach($_POST['Profile'] as $name1 => $val1)
		{
			if(is_array($val1))
			{
				$profile->$name1=implode(',',$val1);
			}
		}			   
			if($profile->save(false))
			{
			Yii::app()->user->updateSession();
			Yii::app()->user->setFlash('profileMessage5',UserModule::t(" Step 5 Changes is saved."));
				$step=5;
			}		
		  }		
		}
		elseif(isset($_POST['step'])  && $_POST['step']==6)
		{


		$profile->attributes=$_POST['Profile'];
		foreach($_POST['Profile'] as $name1 => $val1)
		{
			if(is_array($val1))
			{
				$profile->$name1=implode(',',$val1);
			}
		}	
		
			
          if($profile->validate($_POST['Profile'])) 
		  {
		$profile->attributes=$_POST['Profile'];
		foreach($_POST['Profile'] as $name1 => $val1)
		{
			if(is_array($val1))
			{
				$profile->$name1=implode(',',$val1);
			}
		}			   
			if($profile->save(false))
			{
			Yii::app()->user->updateSession();
			Yii::app()->user->setFlash('profileMessage6',UserModule::t(" Step 6 Changes is saved."));
				$step=6;
			}		
		  }		
		}
		}
		
		$this->render('update',array(
			'model'=>$model,
			'profile'=>$profile,
			'tabstep'=>$step
		));
		
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model = $this->loadModel();
			
			$profile=Yii::app()->db->createCommand("delete from profiles where user_id='".$model->id."'")->
			execute();
			$model->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_POST['ajax']))
				$this->redirect(array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	/**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($validate)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
        {
            echo CActiveForm::validate($validate);
            Yii::app()->end();
        }
    }
	
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=User::model()->notsafe()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
	
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