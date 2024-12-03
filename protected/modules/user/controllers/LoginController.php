<?php
class LoginController extends Controller
{
	public $defaultAction = 'login';
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
	private function lastVisetTime() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		return $lastVisit->lastvisit_at;
	}
	
	public function actionLogin()
	{
		$this->layout='//layouts/subpage';
		$ip=$_SERVER['REMOTE_ADDR'];
		Yii::import('ext.EGeoIP');
		$geoIp = new EGeoIP();
		$geoIp->locate($ip); // use your IP
			
		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
			
			// collect user input data
			if(isset($_POST['UserLogin']))
			{
				
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
					$userlanguage_model = UserSettings::model()->find('user_id=:user_id', array(':user_id'=>$loguser_model                                          ->id));
					
					$online_usersmodel = OnlineUsers::model()->find('user_id=:user_id', array(':user_id'=>$loguser_model->                                           id));
					
					if($online_usersmodel)
					{
					$online_usersmodel->online=1;
					$online_usersmodel->save();
					$checklogin = Userlogincheck::logincheck();	
					}else
					{
						$online_new=new OnlineUsers;
						$online_new->online=1;
						$online_new->user_id=$loguser_model->id;
						$online_new->save();
						$checklogin = Userlogincheck::logincheck();
					}
					
					if($userlanguage_model)
					{
						$system_langs=Yii::app()->UrlManager->listLanguage();
					// is user default language is alreaready in system.
						if(in_array($userlanguage_model->language,array_keys($system_langs)))
						{	
							Yii::app()->setLanguage('en');
						}
						else
						{
							Yii::app()->setLanguage('en');
						}
					}
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
					
					// for 1st time login 
					if(isset($_SESSION['userprofileldstatus']) && $_SESSION['userprofileldstatus'] == 'incomplete')
					{
						 $this->redirect(array("/user/profile/edit"));
					}
					
					if($lastvisittime=='0000-00-00 00:00:00')
					{
						$_SESSION['userprofileldstatus'] = 'incomplete';
						$_SESSION['firsttimeeditmsg'] = UserModule::t('You have now activated your account.'
						);	
						$_SESSION['firsttimeeditmsg1'] = UserModule::t('Please complete your profile');	
					
					$message_obj=Systemmails::model()->findbyPk(1);  //right now it only for english language
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
					$mailer->AddAddress($loguser_model->email,$loguser_model->username);
					$mailer->FromName = 'Rajarani';
					$mailer->CharSet = 'UTF-8';
					$mailer->Subject = str_replace('{site_name}',Yii::app()->name,$message_obj->subject);
					$message_body = str_replace(array("{username}","{activation_url}","{site_name}"),array($loguser_model->username,$activation_url,Yii::app()->name),$message_obj->message);
					
					$message =  $this->renderPartial('application.modules.user.views.systemmails.systemMail',array('message'=>$message_body),true);
					$mailer->Body = $message;
					$mailer->Send();
					
					$message = new Message();
					$systemuser_model = User::model()->find('username=:username', array(':username'=>'admin'));
					$message->sender_id = $systemuser_model->id; 
					$message->receiver_id = Yii::app()->user->getId();
					
					$messagebody = MessageModule::t("We´re happy you joined us.<br />
					Please do fill out your profile with authentic information to help others and thereby yourself to find the best matches.<br />
					Feel free to let us know if you have any questions or even ideas of how we can make Rajarani a even better service for you.<br />
The Rajarani Team",array());
					$message->subject = 'Welcome!';
					$message->body =$messagebody;
					$message->type =1;
					if($message->save())
					{
						$message->message=$message->id;
						$message->save();
					}
					
					 $this->redirect(array("/user/profile/edit"));
					}else if($this->checkProfilerequired(Yii::app()->user->id))
					{
						$_SESSION['userprofileldstatus'] = 'incomplete';
						 $this->redirect(array("/user/profile/edit"));
					}
					
					if (Yii::app()->user->returnUrl=='/index.php')
					{
						$this->redirect(Yii::app()->controller->module->loginlandingUrl);
					}else
					{
							$this->redirect(Yii::app()->controller->module->loginlandingUrl);
					}
				}
			}
			// display the login form
			
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
			$this->render('/user/login',array('model'=>$model));
		} 
		else
		{
			$_SESSION['lang']= Yii::app()->language;
			Yii::app()->setLanguage($_SESSION['lang']);
			$this->redirect(Yii::app()->controller->module->loginlandingUrl);
		}
	
	}
	private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit = time();
		$lastVisit->save();
	}

}