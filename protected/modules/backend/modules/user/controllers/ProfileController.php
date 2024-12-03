<?php

class ProfileController extends Controller
{
	public $defaultAction = 'profile';
	public $layout='//layouts/column2';
	

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	 public function filters()
		{
			return array(
			'accessControl', // perform access control for CRUD operations
			);
		}

	public function accessRules()
	{
		return array(
			
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('Profile','edit','changepassword'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	 
	 
	private $_model;
	/**
	 * Shows a particular model.
	 */
	public function actionProfile()
	{
		Yii::app()->getComponent('bootstrap');
		$model = $this->loadUser();
	    $this->render('profile',array(
	    	'model'=>$model,
			'profile'=>$model->profile,
	    ));
	}


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionEdit()
	{
		Yii::app()->getComponent('bootstrap');
		$this->layout='//layouts/uni-form';
		$model = $this->loadUser();
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
	
		if(isset($_POST['step'])  && $_POST['step']==1)
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
		
		$this->render('edit',array(
			'model'=>$model,
			'profile'=>$profile,
			'tabstep'=>$step
		));
		
	}
	
	/**
	 * Change password
	 */
	public function actionChangepassword() {
		$model = new UserChangePassword;
		if (Yii::app()->user->id) {
			
			// ajax validator
			if(isset($_POST['ajax']) && $_POST['ajax']==='changepassword-form')
			{
				echo UActiveForm::validate($model);
				Yii::app()->end();
			}
			
			if(isset($_POST['UserChangePassword'])) {
					$model->attributes=$_POST['UserChangePassword'];
					if($model->validate()) {
						$new_password = User::model()->notsafe()->findbyPk(Yii::app()->user->id);
						$new_password->password = UserModule::encrypting($model->password);
						$new_password->activkey=UserModule::encrypting(microtime().$model->password);
						$new_password->save();
						Yii::app()->user->setFlash('profileMessage',UserModule::t("New password is saved."));
						$this->redirect(array("profile"));
					}
			}
			$this->render('changepassword',array('model'=>$model));
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