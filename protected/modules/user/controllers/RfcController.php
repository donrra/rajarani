<?php
class RfcController extends Controller
{
	
	public $defaultAction = 'index';
	
	public function actionIndex()
	{
		$baseUrl = Yii::app()->baseUrl; 
		$js = Yii::app()->getClientScript();
		$js->registerScriptFile($baseUrl.'/js/ddaccordion.js');
		$_SESSION['activemenu']='rfc';
		if (Yii::app()->user->isGuest)
		{
			$this->redirect(Yii::app()->controller->module->loginlandingUrl);
		}else
		{
			$this->layout='//layouts/subpage';
			$userfriendsobj = UserFriends::model()->findAll('user_id = :user_id AND status=:status',array(':user_id'=>Yii::app()->user->id,':status'=>1));
	    	 $friend_list=array();
		 	 if($userfriendsobj)
		 		{
					foreach($userfriendsobj as $friend)
						{
							$friend_list[]=array('id'=>$friend->id,'user'=>User::model()->find('id=:ID', array(':ID'=>$friend->friend_id)));
						}
				 }else
					 {
						$friend_list=array();
					 }
		 
		 	$userfriendsobj = UserFriends::model()->findAll('friend_id = :user_id AND status=:status',array(':user_id'=>Yii::app()->user->id,':status'=>1));
	    	 $friend_list1=array();
			 if($userfriendsobj)
				 {
					foreach($userfriendsobj as $friend)
						{
							$friend_list1[]=array('id'=>$friend->id,'user'=>User::model()->find('id=:ID', array(':ID'=>$friend->user_id)));
						}
				 }else
		 			{
						$friend_list1=array();
		 			}
			$friend_list = array_merge($friend_list, $friend_list1);
		 
		 $userfriendsobj = UserFriends::model()->findAll('user_id = :user_id AND status=:status',array(':user_id'=>Yii::app()->user->id,':status'=>2));
	     $declined_list=array();
		  if($userfriendsobj)
		 {
				foreach($userfriendsobj as $friend)
				{
					$declined_list[]=array('id'=>$friend->id,'user'=>User::model()->find('id=:ID', array(':ID'=>$friend->friend_id)));
				}
		 }else
		 {
			$declined_list=array();
		 }
		 
		  $userfriendsobj = UserFriends::model()->findAll('friend_id = :user_id AND status=:status',array(':user_id'=>Yii::app()->user->id,':status'=>2));
	     $declined_list1=array();
		  if($userfriendsobj)
		 {
				foreach($userfriendsobj as $friend)
				{
					$declined_list1[]=array('id'=>$friend->id,'user'=>User::model()->find('id=:ID', array(':ID'=>$friend->user_id)));
				}
		 }else
		 {
			$declined_list1=array();
		 }
		
		
		$declined_list = array_merge($declined_list, $declined_list1);
		
		
		$userfriendsobj = UserFriends::model()->findAll('user_id = :user_id  AND status=:status',array(':user_id'=>Yii::app()->user->id,':status'=>0));
	     $pending_list=array();
		  if($userfriendsobj)
		 {
				foreach($userfriendsobj as $friend)
				{
					$pending_list[]=array('id'=>$friend->id,'user'=>User::model()->find('id=:ID', array(':ID'=>$friend->friend_id)));
				}
		 }else
		 {
			$pending_list=array();
		 }
		 
		 $userfriendsobj = UserFriends::model()->findAll('friend_id = :user_id AND status=:status',array(':user_id'=>Yii::app()->user->id,':status'=>0));
	     $pending_list1=array();
		  if($userfriendsobj)
		 {
				foreach($userfriendsobj as $friend)
				{
					$pending_list1[]=array('id'=>$friend->id,'user'=>User::model()->find('id=:ID', array(':ID'=>$friend->user_id)));
				}
		 }else
		 {
			$pending_list1=array();
		 }
		 
		$pending_list = array_merge($pending_list, $pending_list1);
		
		$userfriendsobj1 = Yii::app()->db->createCommand("select * from user_profile_block where blocked_by='".Yii::app()->user->id."'")->queryRow();
	     
		 $block_list=array();
		  if($userfriendsobj1)
			 {
				$block_list[]=array('id'=>$userfriendsobj1['id'],'user'=>User::model()->find('id=:ID', array(':ID'=>$userfriendsobj1['blocked'])));
			 }
		 else
			 {
				$block_list=array();
			 }
		$this->render('index',array('accept_list'=>$friend_list,'declined_list'=>$declined_list,'pending_list'=>$pending_list,'block_list'=>$block_list));
	
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
 
  public function actionBlockrfcbyid()
	{
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			 $loguserid =Yii::app()->user->id;
			 $id = $_POST['id'];
			$userfriend = UserFriends::model()->find('id=:id',array(':id'=>$id));
			if($userfriend)
			{
				$userfriend->status=5;
				if($userfriend->save())
				{
					echo UserModule::t('Request for contact blocked successfully.');
					if($userfriend->user_id==$loguserid)
					{
					$profile_block=Yii::app()->db->createCommand("insert into user_profile_block values('','".$userfriend->user_id."','".$userfriend->friend_id."')")->execute();
					}
					else if($userfriend->friend_id==$loguserid)
					{
						$profile_block=Yii::app()->db->createCommand("insert into user_profile_block values('','".$userfriend->friend_id."','".$userfriend->user_id."')")->execute();	
					}
				}
				else
				{
				 echo UserModule::t('Request for contact blocked failed.');
				}
			}else
			{
				 echo UserModule::t('Invalid Request for contact.');
			}
	
		} else
            throw new CHttpException(403);	
	}
	
	public function actionUnblockrfcbyid()
	{
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			 $loguserid =Yii::app()->user->id;
			 $id = $_POST['id'];
			 $block_users=Yii::app()->db->createCommand("select * from  user_profile_block where id='".$id."'")->queryRow();
			
			 $userfriend =Yii::app()->db->createCommand("select * from  user_friends where friend_id='".$block_users['blocked']."' and user_id='".$block_users['blocked_by']."' or friend_id='".$block_users['blocked_by']."' and user_id='".$block_users['blocked']."'")->queryRow();

			if($userfriend)
			{
				$profile_unblock=Yii::app()->db->createCommand("update user_friends set status=1 where id='".$userfriend['id']."'")->execute();
				if($profile_unblock)
				{
				 	echo UserModule::t('Request for contact unblocked successfully.');
					$profile_unblock=Yii::app()->db->createCommand("delete from user_profile_block where id='".$id."'")->execute();
				}
				else
				{
				 echo UserModule::t('Request for unblocked  profile failed.');
				}
			}else
			{
				 echo UserModule::t('Invalid Request for unblocked  profile.');
			}
	
		} else
            throw new CHttpException(403);	
	}
	
 
 
 public function actionAddrfc()
	{
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			 $loguserid =Yii::app()->user->id;
			 $id = $_POST['id'];
			$userfriend = UserFriends::model()->find('id=:id',array(':id'=>$id));
			if($userfriend)
			{
				$userfriend->status=1;
				if($userfriend->save())
				{
				 	echo UserModule::t('Request for contact added successfully.');
					$message = new Message();
					$message->sender_id = Yii::app()->user->getId(); 
					$message->receiver_id = $userfriend->user_id;
					$acceptuser = User::model()->findByAttributes(array('id'=>Yii::app()->user->getId()));
						
					if($userfriend->status==1)
					{
					$messagebody = MessageModule::t($acceptuser->username." has accepted your request for contact.",
							array());
					}
					$message->subject = 'Reply request sent';
					$message->body =$messagebody;
					$message->type =1;
					if($message->save())
					{
						$message->message=$message->id;
						$message->save();
					}
					
					
					$message_obj=Systemmails::model()->findbyPk(11); 
						
					$rfcsender_users=Yii::app()->db->createCommand("select * from  users where id='".$userfriend->user_id."'")->queryRow();
					$rfcdeny_users=Yii::app()->db->createCommand("select * from  users where id='".$userfriend->friend_id."'")->queryRow();
					
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
					$mailer->AddAddress($rfcsender_users['email']);
					$mailer->FromName = 'Rajarani';
					$mailer->CharSet = 'UTF-8';
					$mailer->Subject =str_replace("{sender_username}",$rfcdeny_users['username'],$message_obj->subject);
					
					$message_body = str_replace(array("{receiver_username}","{sender_username}"),array($rfcsender_users['username'],$rfcdeny_users['username']),$message_obj->message);
					 $message =  $this->renderPartial('application.modules.user.views.systemmails.systemMail',array('message'=>$message_body),true);
					$mailer->Body = $message;
					$mailer->Send();
				}
				else
				{
				 echo UserModule::t('Request for contact add failed.');
				}
			}else
			{
				 echo UserModule::t('Invalid Request for contact.');
			}
	
		} else
            throw new CHttpException(403);	
	}
	
	public function actionDeclinedrfc()
	{
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			 $loguserid =Yii::app()->user->id;
			 $id = $_POST['id'];
			$userfriend = UserFriends::model()->find('id=:id',array(':id'=>$id));
			if($userfriend)
			{
				$userfriend->status=2;
				if($userfriend->save())
				{
				  echo UserModule::t('Request for contact delcined successfully.');
				    $message = new Message();
					$message->sender_id = Yii::app()->user->getId(); 
					$message->receiver_id = $userfriend->user_id;
					$acceptuser = User::model()->findByAttributes(array('id'=>Yii::app()->user->getId()));
						
					if($userfriend->status==2)
					{
					$messagebody = MessageModule::t($acceptuser->username." has declined your request for contact.",
							array());
					}
					$message->subject = 'Reply request sent';
					$message->body =$messagebody;
					$message->type =1;
					if($message->save())
					{
						$message->message=$message->id;
						$message->save();
					}
					
				  
				    $message_obj=Systemmails::model()->findbyPk(10); 
						
					$rfcsender_users=Yii::app()->db->createCommand("select * from  users where id='".$userfriend->user_id."'")->queryRow();
					$rfcdeny_users=Yii::app()->db->createCommand("select * from  users where id='".$userfriend->friend_id."'")->queryRow();
					
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
					$mailer->AddAddress($rfcsender_users['email']);
					$mailer->FromName = 'Rajarani';
					$mailer->CharSet = 'UTF-8';
					$mailer->Subject =str_replace("{sender_username}",$rfcdeny_users['username'],$message_obj->subject);
					
					$message_body = str_replace(array("{receiver_username}","{sender_username}"),array($rfcsender_users['username'],$rfcdeny_users['username']),$message_obj->message);
					 $message =  $this->renderPartial('application.modules.user.views.systemmails.systemMail',array('message'=>$message_body),true);
					$mailer->Body = $message;
					$mailer->Send();
				}
				else
				{
				 echo UserModule::t('Request for contact delcined failed.');
				}
			}else
			{
				 echo UserModule::t('Invalid Request for contact.');
			}
	
		} else
            throw new CHttpException(403);	
	}
}