<?php

class ViewController extends Controller {

	public $defaultAction = 'view';

	public function actionView_old() {
				$this->layout='//layouts/subpage';
		$messageId = (int)Yii::app()->request->getParam('message_id');
		$viewedMessage = Message::model()->findByPk($messageId);

		if (!$viewedMessage) {
			 throw new CHttpException(404, MessageModule::t('Message not found'));
		}

		$userId = Yii::app()->user->getId();

		if ($viewedMessage->sender_id != $userId && $viewedMessage->receiver_id != $userId) {
		    throw new CHttpException(403, MessageModule::t('You can not view this message'));
		}
		if (($viewedMessage->sender_id == $userId && $viewedMessage->deleted_by == Message::DELETED_BY_SENDER)
		    || $viewedMessage->receiver_id == $userId && $viewedMessage->deleted_by == Message::DELETED_BY_RECEIVER) {
		    throw new CHttpException(404, MessageModule::t('Message not found'));
		}
		$message = new Message();

		$isIncomeMessage = $viewedMessage->receiver_id == $userId;
		if ($isIncomeMessage) {
		    $message->subject = preg_match('/^Re:/',$viewedMessage->subject) ? $viewedMessage->subject : 'Re: ' . $viewedMessage->subject;
			$message->receiver_id = $viewedMessage->sender_id;
		} else {
			$message->receiver_id = $viewedMessage->receiver_id;
		}

		if (Yii::app()->request->getPost('Message')) {
			$message->attributes = Yii::app()->request->getPost('Message');
			$message->sender_id = $userId;
			if ($message->save()) {
				Yii::app()->user->setFlash('success', MessageModule::t('Message has been sent'));
			    if ($isIncomeMessage) {
					$this->redirect($this->createUrl('inbox/'));
			    } else {
					$this->redirect($this->createUrl('sent/'));
				}
			}
		}

		if ($isIncomeMessage) {
			$viewedMessage->markAsRead();
		}
	
		
		$this->render(Yii::app()->getModule('message')->viewPath . '/view', array('viewedMessage' => $viewedMessage, 'message' => $message));
	}
	public function actionMessageviewed() {
		
		$messageId = (int)Yii::app()->request->getParam('message_id');
		$viewedMessage = Message::model()->findByPk($messageId);
		$userId = Yii::app()->user->getId();
		
		if($viewedMessage->sender_id==$userId)
			{
				//echo 'hi';die;
				$sender_viewed=Yii::app()->db->createCommand("update messages set sender_viewed='".$viewedMessage->sender_id."' where id='".$viewedMessage->id."'")->execute();
			}
		elseif($viewedMessage->receiver_id==$userId)
			{
				$reciever_viewed=Yii::app()->db->createCommand("update messages set reciever_viewed='".$viewedMessage->receiver_id."' where id='".$viewedMessage->id."'")->execute();//echo 'bi';die;
			}
		}
	
	
	public function actionView() {
		
		$this->layout='//layouts/subpage';
		$messageId = (int)Yii::app()->request->getParam('message_id');
		$viewedMessage = Message::model()->findByPk($messageId);
		
		// set all child message as markasread.
		Message::model()->updateAll(array( 'is_read' => true ), 'parent_id ="'.$messageId.'" AND receiver_id="'.Yii::app()->user->getId().'"' );
		
		if (!$viewedMessage) {
			 throw new CHttpException(404, MessageModule::t('Message not found'));
		}
		$userId = Yii::app()->user->getId();
		
		if ($viewedMessage->sender_id != $userId && $viewedMessage->receiver_id != $userId) {
		    throw new CHttpException(403, MessageModule::t('You can not view this message'));
		}
		if (($viewedMessage->sender_id == $userId && $viewedMessage->deleted_by == Message::DELETED_BY_SENDER)
		    || $viewedMessage->receiver_id == $userId && $viewedMessage->deleted_by == Message::DELETED_BY_RECEIVER) {
		    throw new CHttpException(404, MessageModule::t('Message not found'));
		}
				$message = new Message();
			$isIncomeMessage = $viewedMessage->receiver_id == $userId;
			
			if ($isIncomeMessage) {
				
					$message->subject = $viewedMessage->subject;
					$message->receiver_id = $viewedMessage->sender_id;
				
			} else {
				$message->receiver_id = $viewedMessage->receiver_id;
			}
	
			if (Yii::app()->request->getPost('Message')) {
				//echo '<pre>';print_r($message->attributes);
				$message->attributes = Yii::app()->request->getPost('Message');
				$message->sender_id = $userId;
				$message->message =$_POST['Message']['message'];
				if ($message->save()) {
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
					
					//set parent message again unread as well.
					$parentMessage = Message::model()->findByPk($message->parent_id);
					$viewedMessage->markAsUnread();

					Yii::app()->user->setFlash('messageModule', MessageModule::t('Message has been sent'));
					if ($isIncomeMessage) {
						$this->redirect($this->createUrl('inbox/'));
					} else {
						$this->redirect($this->createUrl('sent/'));
					}
				}
			}

		if ($isIncomeMessage) {
			$viewedMessage->markAsRead();
		}
	
		$messagehistory='';
		$messagehistoryAdapter = Message::getAdapterForMessageHistory($messageId,$viewedMessage->message);
		//echo '<prE>';print_r($messagehistoryAdapter);die;
							
		$this->render(Yii::app()->getModule('message')->viewPath . '/view', array('viewedMessage' => $viewedMessage, 'message' => $message,'messagehistory'=>$messagehistoryAdapter));
	}
	
public function actionDropdownrefresh()
 {
		$messageId = (int)Yii::app()->request->getParam('message_id');
		$viewedMessage = Message::model()->findByPk($messageId);
					
		$this->renderPartial(Yii::app()->getModule('message')->viewPath . '/dropdownrefresh', array('viewedMessage' => $viewedMessage,'message_id'=>$_REQUEST['message_id']));
	
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
