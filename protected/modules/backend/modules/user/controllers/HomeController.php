<?php
class HomeController extends Controller
{
	public $defaultAction = 'home';

	/**
	 * Displays the login page
	 */
	public function actionHome()
	{
		
		$this->layout='//layouts/home';

		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
			$regmodel = new RegistrationForm;
			// collect user input data
			if(isset($_POST['UserLogin']))
			{
				$model->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model->validate()) {
					$this->lastViset();
					if (Yii::app()->user->returnUrl=='/index.php')
						$this->redirect(Yii::app()->controller->module->returnUrl);
					else
						$this->redirect(Yii::app()->user->returnUrl);
				}else
				{
				$this->layout='//layouts/subpage';
				$this->render('/user/login',array('model'=>$model,'regmodel'=>$regmodel));
				die();
				}
			}
			
			// display the login form
			$this->render('/user/home',array('model'=>$model,'regmodel'=>$regmodel));
		} else
			$this->redirect(Yii::app()->controller->module->returnUrl);
	}
	
	private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit = time();
		$lastVisit->save();
	}
	
	public function actionRegistration() {
		   $this->layout='//layouts/home';
	        $model=new UserLogin;
			$regmodel = new RegistrationForm;
            $profile=new Profile;
            $profile->regMode = true;
            
			// ajax validator
			if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
			{
				echo UActiveForm::validate(array($regmodel));
				Yii::app()->end();
			}
			
		    if (Yii::app()->user->id) {
		    	$this->redirect(Yii::app()->controller->module->profileUrl);
		    } else {
		    	if(isset($_POST['RegistrationForm'])) {
					$regmodel->attributes=$_POST['RegistrationForm'];
					if($regmodel->validate())
					{
						$soucePassword = $regmodel->password;
						$regmodel->activkey=UserModule::encrypting(microtime().$regmodel->password);
						$regmodel->password=UserModule::encrypting($regmodel->password);
						$regmodel->verifyPassword=UserModule::encrypting($regmodel->verifyPassword);
						$regmodel->superuser=0;
						$regmodel->status=((Yii::app()->controller->module->activeAfterRegister)?User::STATUS_ACTIVE:User::STATUS_NOACTIVE);
						
						
						
						if ($regmodel->save()) {
							$profile->user_id=$regmodel->id;
							$profile->save();
							
								if (Yii::app()->controller->module->sendActivationMail) {
									
							$activation_url = $this->createAbsoluteUrl('/user/activation/activation',array("activkey" => $regmodel->activkey, "email" => $regmodel->email));
							UserModule::sendMail($regmodel->email,UserModule::t("You registered from {site_name}",array('{site_name}'=>Yii::app()->name)),UserModule::t("Please activate you account go to {activation_url}",array('{activation_url}'=>$activation_url)));
							}
							
							if ((Yii::app()->controller->module->loginNotActiv||(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false))&&Yii::app()->controller->module->autoLogin) {
									$identity=new UserIdentity($regmodel->username,$soucePassword);
									$identity->authenticate();
									Yii::app()->user->login($identity,0);
									$this->redirect(Yii::app()->controller->module->returnUrl);
							} else {
								if (!Yii::app()->controller->module->activeAfterRegister&&!Yii::app()->controller->module->sendActivationMail) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
								} elseif(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please {{login}}.",array('{{login}}'=>CHtml::link(UserModule::t('Login'),Yii::app()->controller->module->loginUrl))));
								} elseif(Yii::app()->controller->module->loginNotActiv) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email or login."));
								} else {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email."));
								}
							}
						}
						else
						{
							 $this->render('/user/registration',array('model'=>$model,'regmodel'=>$regmodel));
						}
					} 
					else
					{
							//if any error 
				 $profile->validate();
				 $this->layout='//layouts/home';
			     $this->render('/user/registration',array('model'=>$regmodel,'profile'=>$profile));
				 die();
					}
				}
			   $this->render('/user/home',array('model'=>$model,'regmodel'=>$regmodel));
		    }
	}

}