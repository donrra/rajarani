<?php
class HomeController extends Controller
{
	public $defaultAction = 'home';
	public $param='';
	
	private function checkProfilerequired($userid)
	 {
		 //true -> not completd
		 //false -> completed
		$model = User::model()->notsafe()->findByPk($userid);
		if($model->status==1)
		{
			$profile=$model->profile;
			if($profile->save())
			return false;
			else
			return true;
		}
	 }
	
	/**
	 * Displays the login page
	 */
	public function actionHome()
	{
		$this->layout='//layouts/home';
		
		$ip=$_SERVER['REMOTE_ADDR'];

		Yii::import('ext.EGeoIP');
		$geoIp = new EGeoIP();
		$geoIp->locate($ip); // use your IP
			
		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
			$regmodel = new RegistrationForm;

			// collect user input data
			if(isset($_POST['UserLogin']))
			{
			  if($_POST['UserLogin']['username']==UserModule::t('User Name'))
			  {
				  $_POST['UserLogin']['username']='';
			  }
				$model->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model->validate()) {
					$lastvisittime= $this->lastVisetTime();
					$this->lastViset();
					
					// 1st check IP => country => set language 
					 //step 1: if user set the language from settings tab then do it as per settings
		
					// step 2: if user not set any language then set it based on country.
					
					// step 3: else set it default language in english
					
					
					// set dafault language for user if they set it from settings tab.
					$loguser_model = User::model()->find('username=:username OR email=:email', array(':username'=>$model->username,':email'=>$model->username));
					
					$online_usersmodel = OnlineUsers::model()->find('user_id=:user_id', array(':user_id'=>$loguser_model->id));
					if($online_usersmodel)
					{
						$online_usersmodel->online=1;
						$online_usersmodel->save();	
						$checklogin = Userlogincheck::logincheck();
					}else
					{
						$online_new=new OnlineUsers;
						$online_new->user_id=$loguser_model->id;
						$online_new->online=1;
						$online_new->save();
						$checklogin = Userlogincheck::logincheck();
					}
					
					$userlanguage_model = UserSettings::model()->find('user_id=:user_id', array(':user_id'=>$loguser_model->id));
					if($userlanguage_model)
					Yii::app()->setLanguage($userlanguage_model->language);
					else
					{
						Yii::app()->setLanguage($_SESSION['lang']);
					}
					//for chat section 
					if($loguser_model->email==$model->username)
					{
						 Yii::app()->session['username']=strtolower($loguser_model->username);
					}else if(strtolower($loguser_model->username)==$model->username)
					{
						 Yii::app()->session['username']=strtolower($loguser_model->username);
					} 
					
					//for chat section $_SESSION
					if (!isset($_SESSION['chatHistory'])) {
						$_SESSION['chatHistory'] = array();	
					}	
			
					if (!isset($_SESSION['openChatBoxes'])) {
						$_SESSION['openChatBoxes'] = array();	
					}
					
					if(isset($_SESSION['userprofileldstatus']) && $_SESSION['userprofileldstatus'] == 'incomplete')
					{
						 $this->redirect(array("/user/profile/edit"));
					}
					
					
					if($lastvisittime=='0000-00-00 00:00:00')
					{
						$_SESSION['userprofileldstatus'] = 'incomplete';
						$_SESSION['firsttimeeditmsg'] = UserModule::t('You have now activated your account.');	
					 
					/////////////// send user to welcome message during first login/////////////////////
										//subject: welcome to Rajarani
										//message: Welcome to Rajarani
				
				$message_obj=Systemmails::model()->findbyPk(1);
				
					
					/* mail template 
					04.22.1013 [3:29:41 PM] Raheel Raja: we keep it in english
					[3:29:50 PM] Raheel Raja: and in pase 2 we do the multi lang
					*/
					
					$hmailer = Yii::createComponent('application.extensions.mailer.EMailer');
					$hmailer->Host = 'smtp.gigahost.dk';
					//$hmailer->SMTPDebug = 2;
					$hmailer->Port = '587';
					$hmailer->Username = 'support@rajarani.dk';
					$hmailer->Password = 'QE73dse313';
					$hmailer->SMTPAuth = true;
					$hmailer->SMTPSecure = 'tls';
					$hmailer->IsSMTP();
					$hmailer->IsHTML(true);
					$hmailer->From = 'support@rajarani.dk';
					$hmailer->AddAddress($loguser_model->email,$loguser_model->username);
					$hmailer->FromName = 'Rajarani';
					$hmailer->CharSet = 'UTF-8';
					$hmailer->Subject = str_replace('{site_name}',Yii::app()->name,$message_obj->subject);
					$message_body=str_replace('{site_name}',Yii::app()->name,$message_obj->message);
					$message=  $this->renderPartial('application.modules.user.views.systemmails.systemMail',array('message'=>$message_body),true);
					$hmailer->Body = $message;
					if(!$hmailer->Send())
					{
						//ob_start();
						//echo "<pre>"; print_r($hmailer);
						//die;
					}

 					$message = new Message();
					$systemuser_model = User::model()->find('username=:username', array(':username'=>'admin'));
					$message->sender_id = $systemuser_model->id; 
					$message->receiver_id = Yii::app()->user->getId();
					
					$messagebody = MessageModule::t("We´re happy you joined us.<br />
					Fill out your profile with authentic information and remember to tell about yourself.<br />
					The Rajarani Team.",array());
					$message->subject = 'Welcome Message';
					$message->body =$messagebody;
					$message->type =1;
					if($message->save())
					{
						$message->message=$message->id;
						$message->save();
					}
					$this->redirect(array("/user/profile/edit"));
					/////////////////////////////////////////////////////////////////////////////////////
			
					
					}else if($this->checkProfilerequired(Yii::app()->user->id))
					{
						 $_SESSION['userprofileldstatus'] = 'incomplete';
						 $this->redirect(array("/user/profile/edit"));
					}
					
					if (Yii::app()->user->returnUrl=='/index.php')
					{
						$this->redirect(Yii::app()->controller->module->landingUrl);
					}else
					{	
						$this->redirect(Yii::app()->controller->module->landingUrl);
					}
				}
				else{
						if(!isset($_SESSION['lang']) && $_SESSION['lang']=='')
							{
								switch($geoIp->countryCode)
								{
									case 'DK':
									Yii::app()->setLanguage('dk');
									break;
									case 'NO':
									Yii::app()->setLanguage('no');
									break;
									case 'SE':
									Yii::app()->setLanguage('se');
									break;
									default:					
									Yii::app()->setLanguage('en');		
									break;
								}
						}
						else{
							$_SESSION['lang']= Yii::app()->language;
							Yii::app()->setLanguage($_SESSION['lang']);
							}
				
				$this->layout='//layouts/subpage';
				$this->render('/user/login',array('model'=>$model,'regmodel'=>$regmodel));
				die();
				}
			}
			if(!isset($_SESSION['lang']))
			{
						switch($geoIp->countryCode)
						{
							case 'DK':
							Yii::app()->setLanguage('dk');
							break;
							case 'NO':
							Yii::app()->setLanguage('no');
							break;
							case 'SE':
							Yii::app()->setLanguage('se');
							break;
							default:					
							Yii::app()->setLanguage('en');		
							break;
						}
			}
			else{
				$_SESSION['lang']= Yii::app()->language;
				Yii::app()->setLanguage($_SESSION['lang']);
				}
			// display the login form
			$this->render('/user/home',array('model'=>$model,'regmodel'=>$regmodel));
		   }
			else{
					$_SESSION['lang']= Yii::app()->language;
					Yii::app()->setLanguage($_SESSION['lang']);
					$this->redirect(Yii::app()->controller->module->loginlandingUrl);
			}
	}
		
	private function lastVisetTime() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		return $lastVisit->lastvisit_at;
		
	}
	
	private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit = time();
		$lastVisit->save();
	}
	
	public function actionRegistration() {
	  Yii::import("application.modules.rights.models.*"); 
		   
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
							$profile->msg_receivemessage='Yes';
							$profile->msg_receivefavorit='Yes';
							$profile->save(false);
							// update in authassignment
							$command_table=Yii::app()->db->createCommand("INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('PM', '".$regmodel->id."', NULL, 0x4e3b);");
                    $command_table->execute();
							
							////////////////////////////////////////
							
								if (Yii::app()->controller->module->sendActivationMail) {
							$activation_url = $this->createAbsoluteUrl('/user/activation/activation',array("activkey" => $regmodel->activkey, "activid" => base64_encode($regmodel->email)));
							
					$message_obj=Systemmails::model()->findbyPk(2);
					
					$mailer = Yii::createComponent('application.extensions.mailer.EMailer');
					$mailer->Host = 'smtp.gigahost.dk';
					$mailer->Port = '587';
					$mailer->Username = 'support@rajarani.dk';
					$mailer->Password = 'QE73dse313';
					$mailer->SMTPAuth = true;
					$mailer->SMTPSecure = 'tls';
					$mailer->IsSMTP();
					$mailer->IsHTML(true);
					$mailer->From = 'support@rajarani.dk';
					$mailer->AddAddress($regmodel->email,$regmodel->username);
					$mailer->FromName = 'Rajarani';
					$mailer->CharSet = 'UTF-8';
					$mailer->Subject = str_replace('{site_name}',Yii::app()->name,$message_obj->subject);
					$message_body = str_replace(array("{username}","{activation_url}"),array($regmodel->username,$activation_url),$message_obj->message);
					
					$message =  $this->renderPartial('application.modules.user.views.systemmails.systemMail',array('message'=>$message_body),true);
					$mailer->Body = $message;
					$mailer->Send();
						}
							
								////////////////////////////////////////
								
							if ((Yii::app()->controller->module->loginNotActiv||(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false))&&Yii::app()->controller->module->autoLogin) {
									$identity=new UserIdentity($regmodel->username,$soucePassword);
									$identity->authenticate();
									Yii::app()->user->login($identity,0);
									$this->redirect(Yii::app()->controller->module->returnUrl);
							} else {
								if (!Yii::app()->controller->module->activeAfterRegister&&!Yii::app()->controller->module->sendActivationMail) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you! Contact Admin to activate your account."));
								} elseif(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you! Please {{login}}.",array('{{login}}'=>CHtml::link(UserModule::t('Login'),Yii::app()->controller->module->loginUrl))));
								} elseif(Yii::app()->controller->module->loginNotActiv) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you! Please check your mail or login."));
								} else {
									Yii::app()->user->setFlash('registration',UserModule::t("<p>Thank you for registrering with Rajarani!</p><br /><p>Your account has been created and a verification email has been sent to your registered email address.</p><br /><p>Please click the verification link included in the email to activate your account.</p><br /><p><strong>Your account will not be activated until you verify your email address.</strong></p><br /><p>Also remember to check your Junk folder in case the mail should be classified as spam.</p><br /><p>Having trouble accessing your account or with the activation process? Please contact us at support@rajarani.dk</p>"));
								}
							}
							$loginmodel=new UserLogin;
						  $this->layout='//layouts/subpage';
						  $this->param = 'registrationsuccess';
						  $this->render('/user/registrationsuccess',array('model'=>$loginmodel));
						}
						else
						{
							  $this->layout='//layouts/subpage';
							  $this->render('/user/registration',array('model'=>$model,'regmodel'=>$regmodel));
						}
					} 
					else
					{
							//if any error 
						 $profile->validate();
						 $this->layout='//layouts/subpage';
						 $this->render('/user/registration',array('model'=>$regmodel,'profile'=>$profile));
						 die();
					}
				}
				else{
			   $this->render('/user/registration',array('model'=>$regmodel,'regmodel'=>$regmodel));
				}
			}
	}

}
