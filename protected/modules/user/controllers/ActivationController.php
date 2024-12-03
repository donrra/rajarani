<?php

class ActivationController extends Controller
{
	public $defaultAction = 'activation';

	
	/**
	 * Activation user account
	 */
	public function actionActivation () {
		
		$this->layout='//layouts/subpage';
		$email = base64_decode($_GET['activid']);
		
		$activkey = $_GET['activkey'];
		if ($email&&$activkey) {
			$find = User::model()->notsafe()->findByAttributes(array('email'=>$email));
			if (isset($find)&&$find->status) {

			    $this->render('/user/message',array('title'=>UserModule::t("<h2>DONE!</h2>"),'content'=>UserModule::t("<p>Congratulations! Your account has been activated.</p><br /><p>Now you can start using Rajarani. All you need to do now is to fill out your profile and start searching for a match!</p><br /><p><strong>Did you know Rajarani is in its public beta so you can use it FOR FREE?</strong></p><br /><p>If you have any queries, you can reach out to us at support@rajarani.dk</p><br /><p></p>")));
	 			
			} elseif(isset($find->activkey) && ($find->activkey==$activkey)) {
				$find->activkey = UserModule::encrypting(microtime());
				$find->status = 1;
				$find->save();
			    $this->render('/user/message',array('title'=>UserModule::t("There you go!"),'content'=>UserModule::t("<p>Congratulations! Your account has been activated. Now you can start using Rajarani. All you need to do now is to fill out your profile and start searching for a match!</p><br /><p><strong>Did you know Rajarani is in its public beta so you can use it FOR FREE?</strong></p><p>If you have any queries, you can reach out to us at support@rajarani.dk</p><br /><p></p>")));
			} else {
			    $this->render('/user/message',array('title'=>UserModule::t("User activation"),'content'=>UserModule::t("The provided activation URL is incorrect.")));
			}
		} else {
			$this->render('/user/message',array('title'=>UserModule::t("User activation"),'content'=>UserModule::t("The provided activation URL is incorrect.")));
		}
	}

}