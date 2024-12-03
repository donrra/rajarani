<?php
class FavoriteController extends Controller
{
	
	public $defaultAction = 'index';
	
	public function actionIndex()
	{
		$_SESSION['activemenu']='favorites';
		if (Yii::app()->user->isGuest)
		{
		$this->redirect(Yii::app()->controller->module->loginlandingUrl);
		}else
		{		
		$this->layout='//layouts/subpage';
		
		$favs = UserFavoriteprofiles::model()->findAll('user_id=:user_id ', array(':user_id'=>Yii::app()->user->id));
	     $fav_list=array();
		  if($favs)
		 {
				foreach($favs as $fav)
				{
					$fav_list[]=User::model()->find('id=:ID', array(':ID'=>$fav->favorite_id));
				}
		 }else
		 {
			$fav_list=array();
		 }
		
		$this->render('index',array('fav_list'=>$fav_list));
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