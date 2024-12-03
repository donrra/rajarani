<?php
class RegistrationController extends Controller
{
	public $defaultAction = 'registration';
	public $param='';
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}
	/**
	 * Registration user
	**/
	public function actionRegistration() {
		  $this->layout='//layouts/subpage';
			$model = new RegistrationForm;
			$profile=new Profile;
			$profile->regMode = true;
            
			// ajax validator
			if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
			{
				echo UActiveForm::validate(array($model,$profile));
				Yii::app()->end();
			}
			
		    if (Yii::app()->user->id) {
		    	$this->redirect(Yii::app()->controller->module->profileUrl);
		    } else {
		    	if(isset($_POST['RegistrationForm'])) {
					$model->attributes=$_POST['RegistrationForm'];
					if($model->validate())
					{
						$soucePassword = $model->password;
						$model->activkey=UserModule::encrypting(microtime().$model->password);
						$model->password=UserModule::encrypting($model->password);
						$model->verifyPassword=UserModule::encrypting($model->verifyPassword);
						$model->superuser=0;
						$model->status=((Yii::app()->controller->module->activeAfterRegister)?User::STATUS_ACTIVE:User::STATUS_NOACTIVE);
						
						
						
						if ($model->save()) {
							$profile->user_id=$model->id;
							$profile->msg_receivemessage='Yes';
							$profile->msg_receivefavorit='Yes';
							$profile->save(false);
							// update in authassignment
					$command_table=Yii::app()->db->createCommand("INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES('PM', '".$model->id."', NULL, 0x4e3b);");
                    $command_table->execute();
							
							
							if (Yii::app()->controller->module->sendActivationMail) {
								$activation_url = $this->createAbsoluteUrl('/user/activation/activation',array("activkey" => $model->activkey, "activid" => base64_encode($model->email)));
								
					$message_obj=Systemmails::model()->findbyPk(2);  //right now only in english
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
					$mailer->AddAddress($model->email,$model->username);
					$mailer->FromName = 'Rajarani';
					$mailer->CharSet = 'UTF-8';
					$mailer->Subject = str_replace('{site_name}',Yii::app()->name,$message_obj->subject);
					$message_body = str_replace(array("{username}","{activation_url}"),array($model->username,$activation_url),$message_obj->message);
					$message =  $this->renderPartial('application.modules.user.views.systemmails.systemMail',array('message'=>$message_body),true);
					$mailer->Body = $message;
					$mailer->Send();
							}
							
							// add user role during registration ad a guest user
							
							if ((Yii::app()->controller->module->loginNotActiv ||(Yii::app()->controller->module->activeAfterRegister && Yii::app()->controller->module->sendActivationMail==false)) && Yii::app()->controller->module->autoLogin) {
									$identity=new UserIdentity($model->username,$soucePassword);
									$identity->authenticate();
									Yii::app()->user->login($identity,0);
									$this->redirect(Yii::app()->controller->module->returnUrl);
							} else {
								
								
								if (!Yii::app()->controller->module->activeAfterRegister && !Yii::app()->controller->module->sendActivationMail) { 
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
								} elseif(Yii::app()->controller->module->activeAfterRegister && Yii::app()->controller->module->sendActivationMail==false) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please {{login}}.",array('{{login}}'=>CHtml::link(UserModule::t('Login'),Yii::app()->controller->module->loginUrl))));
								} elseif(Yii::app()->controller->module->loginNotActiv) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for registrering. Please check your email for further instructions."));
								} else {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for registering. Please check your email for further instructions."));
								}
							}
							$loginmodel=new UserLogin;
						  $this->layout='//layouts/subpage';
						  $this->param = 'registrationsuccess';
						  $this->render('/user/registrationsuccess',array('model'=>$loginmodel));
						 
						}else
						{    
							  $this->layout='//layouts/subpage';
							  $this->render('/user/registration',array('model'=>$model,'regmodel'=>$regmodel));
						
						}
					} else 
					{
						$profile->validate();
						 $this->layout='//layouts/subpage';
						 $this->render('/user/registration',array('model'=>$model,'profile'=>$profile));
						 die();
					}
				}else
				{
			    $this->render('/user/registration',array('model'=>$model,'profile'=>$profile));
				}
		    }
	}
}