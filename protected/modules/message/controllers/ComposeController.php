<?php
class ComposeController extends Controller
{

	public $defaultAction = 'compose';

	public function actionCompose($id = null) {
		
		
		$basePath=Yii::getPathOfAlias('application.modules.message.views.asset');
		$baseUrl=Yii::app()->getAssetManager()->publish($basePath);
		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile($baseUrl.'/js/jquery-1.6.2.min.js');
	/// above ocode for autogrow conflict problem
	
		//autoexpandabletextarea
		$baseUrl = Yii::app()->baseUrl; 
		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile($baseUrl.'/js/jquery.autogrow-textarea.js');
		
       if(!Yii::app()->user->checkAccess('Message.Compose.Compose'))
	    $this->redirect(Yii::app()->user->returnUrl);
		 else
		$this->layout='//layouts/subpage';
     	$message = new Message();
		if (Yii::app()->request->getPost('Message')) {
			$receiverName = Yii::app()->request->getPost('receiver');
		    $message->attributes = Yii::app()->request->getPost('Message');
			
			$message->sender_id = Yii::app()->user->getId();
			$message->message =rand('00000','99999');
			if ($message->save()) {
				Yii::app()->user->setFlash('messageModule', MessageModule::t('Message has been sent'));
				
				    $message_obj=Systemmails::model()->findbyPk(7); 
					$fav_users_profile=Yii::app()->db->createCommand("select * from  profiles where user_id='".$message->receiver_id."'")->queryRow();
					if($fav_users_profile['msg_receivemessage']=='Yes')
					{	
					$fav_users=Yii::app()->db->createCommand("select * from  users where id='".$message->receiver_id."'")->queryRow();
					$users=Yii::app()->db->createCommand("select * from  users where id='".$message->sender_id."'")->queryRow();
					$profie='http://' . $_SERVER['HTTP_HOST'].'/'.$_SESSION['lang'];	
					$profie_name='<a href="'.$profie.'" style="text-decoration:none;">Login</a>';
					$mailer = Yii::createComponent('application.extensions.mailer.EMailer');
					$mailer->Host = 'smtp.gigahost.dk';
					$mailer->Port = '587';
					$mailer->Username = 'support@norvida.com';
					$mailer->Password = 'QE73dse313';
					$mailer->SMTPAuth = true;
					$mailer->SMTPSecure = 'tls';
					$mailer->IsSMTP();
					$mailer->IsHTML(true);
					$mailer->From = 'support@norvida.com';
					$mailer->AddAddress($fav_users['email']);
					$mailer->FromName = 'Rajarani';
					$mailer->CharSet = 'UTF-8';
					$mailer->Subject = $message_obj->subject;
					$message_body = str_replace(array("{receiver_username}","{sender_username}","{login_link}"),array($fav_users['username'],$users['username'],$profie_name),$message_obj->message);
					$message =  $this->renderPartial('application.modules.user.views.systemmails.systemMail',array('message'=>$message_body),true);
					$mailer->Body = $message;
					$mailer->Send();
					}

			    $this->redirect($this->createUrl('inbox/'));
			} else if ($message->hasErrors('receiver_id')) {
				$message->receiver_id = null;
				$receiverName = '';
			}
		} else {
			if ($id) {
				$receiver = call_user_func(array(call_user_func(array(Yii::app()->getModule('message')->userModel, 'model')), 'findByPk'), $id);
				if ($receiver) {
					$receiverName = call_user_func(array($receiver, Yii::app()->getModule('message')->getNameMethod));
					$message->receiver_id = $receiver->id;
				}
			}
		}
		$this->render(Yii::app()->getModule('message')->viewPath . '/compose', array('model' => $message, 'receiverName' => isset($receiverName) ? $receiverName : null));
	}

	public function actionSendrequest($id = null) {
		
		//autoexpandabletextarea
		$baseUrl = Yii::app()->baseUrl; 
		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile($baseUrl.'/js/jquery.autogrow-textarea.js');
		
		$this->layout='//layouts/subpage';
     	
		$message = new Message();
		if (isset($_POST['receiver_id']) && $_POST['receiver_id']!='') {
		$senderName = $_POST['sendername'];
		$receiver_id = $_POST['receiver_id'];
		
		$userfriend = new UserFriends();
		$userfriend->user_id=Yii::app()->user->getId();
		$userfriend->friend_id=$receiver_id;
		$userfriend->activkey = UserModule::encrypting(microtime());
		if($userfriend->save())
		{
			
			
		Yii::app()->user->setFlash('rfccmessage',UserModule::t('Your request has been sent.'));	
		echo UserModule::t('Your request has been sent.');
		
		
		
		$message->receiver_id = $receiver_id;
		$message->sender_id = Yii::app()->user->getId();
		$confirmationactivation_url = 'http://' . $_SERVER['HTTP_HOST'].$this->createUrl(implode(Yii::app()->controller->module->confirmationactivation_url),array("activkey" =>$userfriend->activkey));
		$message->subject = $senderName." is interested in you - Rajarani";
		$message->type =1;
		$messagebody = MessageModule::t($senderName." has seen your profile on Rajarani and wants to contact you. To accept the request, go to <a href='{activation_url}'>{activation_url}</a>.",
				array(
					'{site_name}'=>Yii::app()->name,
					'{activation_url}'=>$confirmationactivation_url,
				));
		 $message->body =$messagebody;
			if ($message->save()) {
		
		                $message->message=$message->id;
						$message->save();
		// check  If user setting has allowed to recieve email for contact requests, 
		// we should send an email as well
		
		// check user profile msg_receivemessage flag
		// send mail too.
		$message_obj=Systemmails::model()->findbyPk(9); 
					
						
					$fav_users=Yii::app()->db->createCommand("select * from  users where id='".$userfriend->friend_id."'")->queryRow();
					$users=Yii::app()->db->createCommand("select * from  users where id='".$userfriend->user_id."'")->queryRow();
					
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
					$mailer->AddAddress($fav_users['email'],$users['username']);
					$mailer->FromName = 'Rajarani';
					$mailer->CharSet = 'UTF-8';
					$mailer->Subject = str_replace("{sender_username}",$users['username'],$message_obj->subject);
					$message_body = str_replace(array("{activation_url}","{receiver_username}","{sender_username}"),array($confirmationactivation_url,$fav_users['username'],$users['username']),$message_obj->message);
					$message =  $this->renderPartial('application.modules.user.views.systemmails.systemMail',array('message'=>$message_body),true);
					$mailer->Body = $message;
					$mailer->Send();
					}
		
			Yii::app()->user->setFlash('message',UserModule::t('Request has successfully been sent.'));	
			} else if ($message->hasErrors('receiver_id')) {
			Yii::app()->user->setFlash('message',UserModule::t('Request failed.'));	
			}
		} 
	}
public function actionProcess()
	{
		$comment = $_POST['comment'];
		if ($_POST) $post=1;
		if (!$comment) $errors[count($errors)] = 'Please enter your comment.'; 
		if (!$errors) {

	//recipient
	$to = 'Raheel Raja<raheel@norvida.com>';	
	//sender
	$mail_user=Yii::app()->db->createCommand("select * from  users where id='".Yii::app()->user->getId()."'")->queryRow();
		$command_table=Yii::app()->db->createCommand("INSERT INTO `comment` (name,comment ) VALUES
('".$mail_user['username']."', '".$_POST['comment']."')");
        $command_table->execute();
	
	
	
	$from = $mail_user['username'] . ' <' . $mail_user['email'] . '>';
	
	//subject and the html message
	$subject = 'Comment from ' . $mail_user['username'];	
	$message = '
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head></head>
	<body>
	<table>
		<tr><td>Name</td><td>' . $mail_user['username'] . '</td></tr>
		<tr><td>Comment</td><td>' . nl2br($comment) . '</td></tr>
	</table>
	</body>
	</html>';

	//send the mail
	$result = $this->sendmail($to, $subject, $message, $from);
	if ($_POST) {
		if ($result) 
		{
			echo 'Thank you! We have received your message.';
		}else{
			 echo 'Sorry, unexpected error. Please try again later';
		}
	//else if GET was used, return the boolean value so that 
	//ajax script can react accordingly
	//1 means success, 0 means failed
	} else {
		echo $result;	
	}

//if the errors array has values
} else {
			//display the errors message
			for ($i=0; $i<count($errors); $i++) echo $errors[$i] . '<br/>';
			exit;
		}
	}
	
function sendmail($to, $subject, $message, $from)
 {
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	$headers .= 'From: ' . $from . "\r\n";
	$result = mail($to,$subject,$message,$headers);

	if ($result) return 1;
	else return 0;
 }
}
