<?php

class RecoveryController extends Controller
{
	public $defaultAction = 'recovery';
	
	/**
	 * Recovery password
	 */
	public function actionRecovery () {
		$this->layout='//layouts/subpage';
		$form = new UserRecoveryForm;
		if (Yii::app()->user->id) {
		    	$this->redirect(Yii::app()->controller->module->returnUrl);
		    } else {
				$email = ((isset($_GET['activid']))?base64_decode($_GET['activid']):'');
				$activkey = ((isset($_GET['activkey']))?$_GET['activkey']:'');
				if ($email&&$activkey) {
					$form2 = new UserChangePassword;
		    		$find = User::model()->notsafe()->findByAttributes(array('email'=>$email));
		    		
					if(isset($find)&&$find->activkey==$activkey) {
			    		if(isset($_POST['UserChangePassword'])) {
							$form2->attributes=$_POST['UserChangePassword'];
							if($form2->validate()) {
								$find->password = Yii::app()->controller->module->encrypting($form2->password);
								$find->activkey=Yii::app()->controller->module->encrypting(microtime().$form2->password);
								if ($find->status==0) {
									$find->status = 1;
								}
								$find->save();
								Yii::app()->user->setFlash('recoveryMessage',UserModule::t("Your new password has been saved."));
								$this->redirect(Yii::app()->controller->module->recoveryUrl);
							}
						} 
						$this->render('changepassword',array('form'=>$form2));
		    		} else {
		    			Yii::app()->user->setFlash('recoveryMessage1',UserModule::t("The provided recovery link is incorrect. Please recover your password again."));
						$this->redirect(Yii::app()->controller->module->recoveryUrl);
		    		}
		    	} else {
			    	if(isset($_POST['UserRecoveryForm'])) {
			    		$form->attributes=$_POST['UserRecoveryForm'];
			    		if($form->validate()) {
			    			$user = User::model()->notsafe()->findbyPk($form->user_id);
					
					if($user->status==0)
					{
				$inactive_message = UserModule::t("Your account has not been activated yet. Please activate your account through the mail we have sent to {user_email}.",
						array(
			    						'{user_email}'=>$user->email,
			    						));
									
					 Yii::app()->user->setFlash('recoveryMessage3',$inactive_message);
			    	$this->refresh();
					$this->render('recovery',array('form'=>$form));		
					 die();
					}
					
					$message_obj=Systemmails::model()->findbyPk(3);
							
					$activation_url = 'http://' . $_SERVER['HTTP_HOST'].$this->createUrl(implode(Yii::app()->controller->module->recoveryUrl),array("activkey" => $user->activkey, "activid" => base64_encode($user->email)));
							
					$subject = str_replace('{site_name}',Yii::app()->name,$message_obj->subject);
									
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
					$mailer->AddAddress($user->email,$user->username);
					$mailer->FromName = 'Rajarani';
					$mailer->CharSet = 'UTF-8';
					$mailer->Subject = $subject;
					$message_body = str_replace(array("{username}","{site_name}","{activation_url}"),array($user->username,Yii::app()->name,$activation_url),$message_obj->message);
					$message =  $this->renderPartial('application.modules.user.views.systemmails.systemMail',array('message'=>$message_body),true);
					$mailer->Body = $message;
					$mailer->Send();
				
							
							
			    			
							Yii::app()->user->setFlash('recoveryMessage2',UserModule::t("We have sent further instructions to your emailaddress. Kindly check your inbox to proceed the registration process"));
			    			$this->refresh();
			    		}
			    	}
		    		$this->render('recovery',array('form'=>$form));
		    	}
		    }
	}

}