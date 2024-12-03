<?php

class SpamviewController extends Controller {

	public $defaultAction = 'spamview';
	
	public function actionSpamview() {
		
				$this->layout='//layouts/subpage';
		$messageId = (int)Yii::app()->request->getParam('message_id');
		$viewedMessage = Message::model()->findByPk($messageId);
		
		// set all child message as markasread.
		Message::model()->updateAll(array( 'is_read' => true ), 'parent_id ="'.$messageId.'" ' );
		

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
		$this->render(Yii::app()->getModule('message')->viewPath . '/spamview', array('viewedMessage' => $viewedMessage, 'message' => $message,'messagehistory'=>$messagehistoryAdapter));
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
