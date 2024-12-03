<?php
//die('favorite');
class ChatController extends Controller
{
	
	public $defaultAction = 'index';
	
	public function actionLivecount()
	{
		$this->layout='//layouts/subpage';
		$chat_list = array();

		$friendslist =Yii::app()->db->createCommand("SELECT * FROM `user_friends` where user_id='".Yii::app()->user->id."'  AND status=1 OR friend_id='".Yii::app()->user->id."' AND status=1")->queryAll();
	     if($friendslist)
		 {
				foreach($friendslist as $frnd)
				{
					if($frnd['user_id']==Yii::app()->user->id)
					{
						$chat_list[]=$frnd['friend_id'];
					}elseif($frnd['friend_id']==Yii::app()->user->id)
					   {
						   $chat_list[]=$frnd['user_id'];
					   }
				}
		 }

	$online_list=array();
	$onlineuser = OnlineUsers::model()->findAll('online=:online ', array(':online'=>1));
		if($onlineuser)
		 {
				foreach($onlineuser as $online)
				{
					$online_list[]=$online->user_id;
				}
		 }
		 $count_online=0;
		 
		 foreach($chat_list as $cu)
		 {
			 if(in_array($cu,$online_list))
			 $count_online++;
		 }		 
		ob_start();
		
		$outdata['totalcount']=$count_online;
		 ob_end_clean(); 
		 echo CJavaScript::jsonEncode($outdata); 
	}
	
	public function actionLive()
	{
		$this->layout='//layouts/subpage';
		$chat_list = array();
		
$friendslist =Yii::app()->db->createCommand("SELECT * FROM `user_friends` where user_id='".Yii::app()->user->id."' AND status=1 OR friend_id='".Yii::app()->user->id."' AND status=1")->queryAll();

	      if($friendslist)
		 {
				foreach($friendslist as $frnd)
				{
					if($frnd['user_id']==Yii::app()->user->id)
					{
				$chat_list[$frnd['friend_id']]=Yii::app()->db->createCommand("SELECT * FROM `users` where  id='".$frnd['friend_id']."'")->queryAll();
					}
					elseif($frnd['friend_id']==Yii::app()->user->id)
				   {
					$chat_list[$frnd['user_id']]=Yii::app()->db->createCommand("SELECT * FROM `users` where  id='".$frnd['user_id']."'")->queryAll();
				}
				} 
		 }

	$online_list=array();
	$onlineuser = OnlineUsers::model()->findAll('online=:online ', array(':online'=>1));
		if($onlineuser)
		 {
				foreach($onlineuser as $online)
				{
					$online_list[]=$online->user_id;
				}
		 }
		 $chkonline=0;
		 foreach($chat_list as $chatusr=>$chatval)
		   {
			 if(in_array($chatusr,$online_list))
					{
						 $chkonline=$chkonline+1;
						
					}
			 
		   }
			if($chkonline==0)
			{
				$test='no users online from your contact list.';		
			}
		ob_start();
		$outdata['outdata']=$this->renderPartial('live', array('chatusers'=>$chat_list,'onlineusers'=>$online_list),true,false,false);
		$outdata['resultdata']=$test;
		 ob_end_clean(); 
		 echo CJavaScript::jsonEncode($outdata); 

	}
	
	public function actionIndex()
	{
		$this->layout='//layouts/subpage';
		$chat_list = array();

		$friendslist =Yii::app()->db->createCommand("SELECT * FROM `user_friends` where user_id='".Yii::app()->user->id."'  AND status=1 OR friend_id='".Yii::app()->user->id."' AND status=1")->queryAll();
	      if($friendslist)
		 {
				foreach($friendslist as $frnd)
				{
					if($frnd['user_id']==Yii::app()->user->id)
					{
				$chat_list[$frnd['friend_id']]=Yii::app()->db->createCommand("SELECT * FROM `users` where  id='".$frnd['friend_id']."'")->queryAll();
					}
					elseif($frnd['friend_id']==Yii::app()->user->id)
				   {
					$chat_list[$frnd['user_id']]=Yii::app()->db->createCommand("SELECT * FROM `users` where  id='".$frnd['user_id']."'")->queryAll();
				}
				} 
		 }

	$online_list=array();
	$onlineuser = OnlineUsers::model()->findAll('online=:online ', array(':online'=>1));
		if($onlineuser)
		 {
				foreach($onlineuser as $online)
				{
					$online_list[]=$online->user_id;
				}
		 }
		 $chkonline=0;
		 foreach($chat_list as $chatusr=>$chatval)
		   {
			 if(in_array($chatusr,$online_list))
					{
						 $chkonline=$chkonline+1;
					}
		   }
			if($chkonline==0)
			{
				Yii::app()->user->setFlash('offchat',UserModule::t('no users online from your contact list.'                            ));		
			}
			
       $this->render('index',array('chatusers'=>$chat_list,'onlineusers'=>$online_list));
	
	
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