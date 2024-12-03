<?php
class ProfileController extends Controller
{
	public $defaultAction = 'profile';
	public $layout='//layouts/subpage';
	

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	
	public function actionRatingupdate()
	{
	   echo  $score=$_REQUEST['score'];
		$userid=$_REQUEST['userid'];
		$rateduserId=$_REQUEST['rateduserId'];
		$userratings=Yii::app()->db->createCommand("select * from userratings where userid=".$userid." AND rateduserId=".$rateduserId."")->queryRow();
		echo '<pre>';print_r($userratings);
		$userratings_update=Yii::app()->db->createCommand("update userratings set rating=".$score." where id=".$userratings['id']."")->execute();
	}
	
	public function actionRating()
	{
	    $score=$_REQUEST['score'];
		$userid=$_REQUEST['userid'];
		$rateduserId=$_REQUEST['rateduserId'];
		$userratings=Yii::app()->db->createCommand("insert into userratings values ('',".$score.",".$userid.",".$rateduserId.")")->execute();
	}
	
	public function actionPageload()
	{
		if(Yii::app()->user->getId()!='')
		{
			$Track_userPageLoad=Yii::app()->db->createCommand("update users set page_last_visit='".date('Y-m-d H:i:s')."' where id='".Yii::app()->user->getId()."'")->execute();
		}
	}
	
	public function actionAcceptrequest()
	{
		if(Yii::app()->user->isGuest) {
		$this->redirect(Yii::app()->getModule('user')->loginUrl);
		}else
		{
		$friends_activkey=$_GET['activkey'];
		
		$userfriend = UserFriends::model()->find('activkey=:activkey',array(':activkey'=>$friends_activkey));
		
		
		
		if($userfriend)
		{
			$friends = User::model()->findByAttributes(array('id'=>$userfriend->friend_id));
			 $loginuser = User::model()->findByAttributes(array('id'=>$userfriend->user_id));
	 		$sendername = $loginuser->username; 
	 
	$acceptconfirmation_url = 'http://' . $_SERVER['HTTP_HOST'].$this->createUrl(implode(Yii::app()->controller->module->updateconfirmation_url),array("activkey" =>$userfriend->activkey,'type'=>'acpt'));
	$denyconfirmation_url = 'http://' . $_SERVER['HTTP_HOST'].$this->createUrl(implode(Yii::app()->controller->module->updateconfirmation_url),array("activkey" =>$userfriend->activkey,'type'=>'dny'));
		
			
	$userfr_data=array('user_id'=>Yii::app()->user->getId(),'friend_id'=>$userfriend->friend_id,'friends_id'=>
	$userfriend->friend_id,'from_id'=>$userfriend->user_id,'status'=>$userfriend->status,'friendsname'=>$friends->username,'sendername'=>$sendername,'accept_url'=>$acceptconfirmation_url,'deny_url'=>$denyconfirmation_url);
	
		}else
		{
			$userfr_data=array();
		}
		
		$this->layout='//layouts/subpage';
		$this->render('requestconf',array('usrdata'=>$userfr_data));
	}
	}
	public function actionUpdaterequest()
	{
		
		Yii::import('application.modules.message.models.Message');


		$friends_activkey=$_GET['activkey'];
		$accepttype=$_GET['type'];
		
		$userfriend = UserFriends::model()->find('activkey=:activkey',array(':activkey'=>$friends_activkey));
		
		if($userfriend || ($userfriend->friend_id==Yii::app()->user->getId()))
		{
			$friends = User::model()->findByAttributes(array('id'=>$userfriend->friend_id));
			if($accepttype=='acpt')
			$accept_status=1;
			else
			$accept_status=2;
			
			$userfriend->status=$accept_status;
			$userfriend->save();
			
			
			//send message foe accept/deny
		$message = new Message();
		$message->sender_id = Yii::app()->user->getId(); 
		$message->receiver_id = $userfriend->user_id;
		$acceptuser = User::model()->findByAttributes(array('id'=>Yii::app()->user->getId()));
			
		if($accept_status==1)
		{
		$messagebody = MessageModule::t($acceptuser->username." has accepted your request.",
				array());
		}else
		{
		$messagebody = MessageModule::t($acceptuser->username." has denied your request.",
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
			if($accept_status==1)
			{
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
			if($accept_status==2)
			{
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
			
			$userfr_data=array('user_id'=>Yii::app()->user->getId(),'friends_id'=>$userfriend->friend_id,'from_id'=>$userfriend->user_id,'status'=>$accept_status,'friendsname'=>$friends->username);
		}else
		{
			$userfr_data=array();
		}
		
		$this->layout='//layouts/subpage';
		$this->render('requestconf',array('usrdata'=>$userfr_data));
	}
	
	public function actionProcess()
	{
		$comment = $_POST['comment'];
		if ($_POST) $post=1;
		if (!$comment) $errors[count($errors)] = 'Please enter your comment.'; 
		if (!$errors) {

	//recipient
	$to = 'Rajarani Support<support@rajarani.dk>';	
	//sender
	$mail_user=Yii::app()->db->createCommand("select * from  users where id='".Yii::app()->user->getId()."'")->queryRow();
		$command_table=Yii::app()->db->createCommand("INSERT INTO `comment` (id,name,comment, browser, platform) VALUES
('','".$mail_user['username']."', 
 '".$comment."', 
 '".$browser = Yii::app()->browser->getBrowser()."', 
' ".$platform = Yii::app()->browser->getPlatform()."')")->execute();

	
	$platform = Yii::app()->browser->getPlatform();
	
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
		<tr><td>Name: </td><td>' . $mail_user['username'] . '</td></tr>
		<tr><td>Comment: </td><td>' . nl2br($comment) . '</td></tr>
		<tr><td>Browser: </td><td>' . nl2br($browser) . '</td></tr>
		<tr><td>Platform: </td><td>' . nl2br($platform) . '</td></tr>
		
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
			 echo 'Sorry, there was unexpected error. Please try again later';
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

	public function actionIndex()
	{
		$_SESSION['activemenu']='';
		if(Yii::app()->user->isGuest) {
		$this->redirect(Yii::app()->getModule('user')->loginUrl);
		}else
		{
			if(isset($_SESSION['userprofileldstatus']) && $_SESSION['userprofileldstatus'] == 'incomplete')
			{
			 $this->redirect(Yii::app()->createUrl("/user/profile/edit"));
			}
			
			$login_Profile=Yii::app()->db->createCommand("SELECT gender from profiles where user_id='".Yii::app()->user->getId()."'")->queryRow();
			if($login_Profile['gender']=='Male')
			{
			//SELECT * FROM `users` WHERE `create_at` IN (SELECT `create_at` FROM `users` ORDER BY `create_at` DESC) ORDER BY `create_at` DESC
			$la_lastactivated=Yii::app()->db->createCommand("SELECT t.user_id,s.online FROM profiles `t` LEFT JOIN online_users `s` ON t.user_id=s.user_id LEFT JOIN users `u` ON t.user_id=u.id WHERE u.create_at in (SELECT `u`.create_at FROM `users` ORDER BY `u`.create_at DESC ) and t.user_id!='".Yii::app()->user->getId()."' and u.superuser=0 and u.status NOT IN (0,2) and `t`.`gender`='Female' ORDER BY `u`.create_at DESC LIMIT 10")->queryAll();
			}
			else
			{
				$la_lastactivated=Yii::app()->db->createCommand("SELECT t.user_id,s.online FROM profiles `t` LEFT JOIN online_users `s` ON t.user_id=s.user_id LEFT JOIN users `u` ON t.user_id=u.id WHERE u.create_at in (SELECT `u`.create_at FROM `users` ORDER BY `u`.create_at DESC ) and t.user_id!='".Yii::app()->user->getId()."' and u.superuser=0 and u.status NOT IN (0,2) and `t`.`gender`='Male' ORDER BY `u`.create_at DESC LIMIT 10")->queryAll();
			}
			
			$data=array();
			
			$vcount = VisitProfile::Model()->count("profileid=:profileid AND visitby != :visitby AND visit_time > DATE_SUB(UTC_TIMESTAMP(),INTERVAL 7 DAY)", array(":profileid" => Yii::app()->user->getId(),':visitby' => Yii::app()->user->getId()));
			
			$data['visit_profile_count']=$vcount;
			
			$scount = SearchProfile::Model()->count("profileid=:profileid", array("profileid" => Yii::app()->user->getId()));
				 $data['search_profile_count']=$scount;

			$this->layout='//layouts/subpage';
			$this->render('index',array('data'=>$data,'la_lastactivated'=>$la_lastactivated));
		}
	
	}

	
	public function actionUpdateprofiledetails()
	{
		
		$error_msg='';
	$tmpusermodel = User::model()->find('id=:user_id', array(':user_id'=>Yii::app()->user->id));
	$tmpprofile=$tmpusermodel->profile;

	if($_REQUEST['User']['password']=='' && $_REQUEST['User']['verifyPassword']=='')
	{
		$tmpusermodel->password =$tmpusermodel->password;
	}
	else if($_REQUEST['User']['password']!='')
	{
		if($_REQUEST['User']['verifyPassword']=='')
		{
			$tmpusermodel->addError('verifyPassword',UserModule::t("Field cannot be blank."));
		}
		else
		{
			if($_REQUEST['User']['password'] != $_REQUEST['User']['verifyPassword'])
				{
					$tmpusermodel->addError('verifyPassword',UserModule::t("Passwords do not match."));
				}
				else
				{
					$tmpusermodel->password = UserModule::encrypting($_REQUEST['User']['password']);	
				}
		}
	}
	
	
	//==========================================
	 if(isset($_REQUEST['User']['email']) && $_REQUEST['User']['email']!='')
	 {
	 $tmpusermodel->email = $_REQUEST['User']['email'];	 
	 }
	
	$tmpprofile->msg_receivemessage = $_REQUEST['Profile']['msg_receivemessage'];
	$tmpprofile->msg_receivefavorit = $_REQUEST['Profile']['msg_receivefavorit'];
	
	  
	  if(!$tmpusermodel->hasErrors() && $tmpusermodel->save() && $tmpprofile->save())
		{
			echo UserModule::t("<div class='succes_msg'><p>Your changes have been saved.</p><div>");
	
		}else
		{
			echo CHtml::errorSummary(array($tmpusermodel));
			
		}
	}
	
	public function actionSettings()
	{
		$_SESSION['activemenu']='setting';
		if (Yii::app()->user->isGuest) {
		$this->redirect(array("/user/login"));
		}else
		{
			$usermodel = User::model()->find('id=:user_id', array(':user_id'=>Yii::app()->user->id));
			
			$model = UserSettings::model()->find('user_id=:user_id', array(':user_id'=>Yii::app()->user->id));
			if(!$model)
			$model = new UserSettings;		
			
			
			if(isset($_REQUEST['UserSettings']['language']))
			{
			
			$model->language=$_REQUEST['UserSettings']['language'];
			
				if($model->validate()) 
				{
					
					$model->save();
					Yii::app()->setLanguage($model->language);

				}
			}
			$this->render('settings',array('model'=>$model,'usermodel'=>$usermodel,'profilemodel'=>$usermodel->profile));	
		}
	}
	
	public function actionDeleteconfirm()
	{
		
		$rating = $_GET['rating'];
		$whydelete1 = $_GET['whydelete1'] ;
		$whydelete2 = $_GET['whydelete2'] ;
		$whydelete3 = $_GET['whydelete3'] ;
		$whydelete4 = $_GET['whydelete4'] ;
		$whydelete5 = $_GET['whydelete5'] ;
		$whydelete6 = $_GET['whydelete6'] ;
		
		$userfedback = new Userfeedback;
		
		$userfedback->user_id = Yii::app()->user->id;
		$userfedback->rating = $rating;
		$userfedback->reason1 = $whydelete1;
		$userfedback->reason2 = $whydelete2;
		$userfedback->reason3 = $whydelete3;
		$userfedback->reason4 = $whydelete4;
		$userfedback->reason5 = $whydelete5;
		$userfedback->reason6 = $whydelete6;
		$userfedback->save();
		
		$deleteaccount = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$deleteaccount->status =2;
		if($deleteaccount->save())
		{
			$loguserid =Yii::app()->user->id;
			
			$message=Yii::app()->db->createCommand("select * from  messages where sender_id='".$loguserid."' or receiver_id='".$loguserid."'")->queryAll();
		
			if($message)
			{
				$messagedetails=Yii::app()->db->createCommand("delete from messages where sender_id='".$loguserid."' or receiver_id='".$loguserid."'")->execute();
			}
			
			$profiles=Yii::app()->db->createCommand("select * from  profiles where user_id='".$loguserid."'")->queryAll();
			if($profiles)
			{
				$profilesdetails=Yii::app()->db->createCommand("delete from profiles where user_id='".$loguserid."'")->execute();
			}
			
			$favs=Yii::app()->db->createCommand("select * from  user_favoriteprofiles where user_id='".$loguserid."' or favorite_id='".$loguserid."'")->queryAll();
		
			if($favs)
			{
				$favsdetails=Yii::app()->db->createCommand("delete from user_favoriteprofiles where user_id='".$loguserid."' or favorite_id='".$loguserid."'")->execute();
			}
			
			
			$userfriend_details =Yii::app()->db->createCommand("select * from  user_friends where user_id='".$loguserid."' or friend_id='".$loguserid."'")->queryAll();		
			if($userfriend_details)
			{
				$userfriend_update =Yii::app()->db->createCommand("update user_friends set status=4 where user_id='".$loguserid."' or friend_id='".$loguserid."'")->execute();
			}
			
			Yii::app()->user->logout();
			echo "success";
		}else
		{
			echo "error";
		}
	}
	
	
	/**
	 * Shows a particular model.
	*/
	public function actionProfile($id)
	{
	$_SESSION['activemenu']='profile';
	if (Yii::app()->user->isGuest) {
	$this->redirect(array("/user/login"));
	}else
	{
		$this->layout='//layouts/subpage';
		$model = User::model()->find('username=:username', array(':username'=>$id));
        if($model)
	    {
			$visitprofile = new VisitProfile;
			$visitprofile->profileid = $model->id;
			$visitprofile->visitby =  Yii::app()->user->id;
			$visitprofile->visit_time = Date('Y-m-d H:i:s');
			$visitprofile->save();

			$this->render('profile',array(
	    	'model'=>$model,
			'profile'=>$model->profile,
	    ));
		
		}else
		{
			$error['code']='404';
			$error['message']='Page not found';	
			$this->render('error',$error);
		}
	
		}
	} 
	
	
	public function actionSearch()
	{
		if (Yii::app()->user->isGuest)
		{
		$this->redirect(Yii::app()->controller->module->loginlandingUrl);
		}else
		{
		
		$this->layout='//layouts/searchprofile';
		 $gender=isset($_REQUEST['gender']) ? $_REQUEST['gender']:'';
		 $f_age=isset($_REQUEST['from_age']) ? intval($_REQUEST['from_age']):'';
		 $t_age=isset($_REQUEST['to_age']) ? intval($_REQUEST['to_age']):'';
		 $country=isset($_REQUEST['country']) ? $_REQUEST['country']:'';
         $profileimage=isset($_REQUEST['profileimage']) ? $_REQUEST['profileimage']:''; 
		
		//set data in to the search fields
		Yii::app()->session['s_gender'] = $gender;
		Yii::app()->session['e_minage'] = $f_age;
		Yii::app()->session['s_maxage'] = $t_age;
		Yii::app()->session['s_country'] = $country;
		Yii::app()->session['s_profileimage'] =  $profileimage;
		
		
		 $whereclause='';
		
		
		if($profileimage==1)
		  {
			  
			  $whereclause.="   `avatar` NOT LIKE '%default.jpg%'";
		  }else
		  {
			  $whereclause.="   `avatar`  LIKE '%default.jpg%'";
		  }
		
		 if($country!='')
		 {
				if($whereclause=='')
				{
				$whereclause.="residingcountry LIKE '$country'";
				}else
				{
				$whereclause.=" AND residingcountry  LIKE '$country'";	 
				}
		 }
		 
		 if($gender!='')
		{
			if($whereclause=='')
			 {
				 $whereclause.=" gender='$gender'";
			 }else
			 {
			   $whereclause.=" AND gender='$gender'";	 
			 }
		 }
		 if($f_age!='' && $t_age!='')
		{
			if($whereclause=='')
			 {
				 $whereclause.=" FLOOR(DATEDIFF( now( ) , dob )/365) > $f_age AND FLOOR(DATEDIFF( now( ) , dob )/365) <=$t_age";
			 }else
			 {
			   $whereclause.=" AND  FLOOR(DATEDIFF( now( ) , dob )/365) > $f_age AND FLOOR(DATEDIFF( now( ) , dob )/365) <=$t_age";	 
			 }
		 }
		  
		 $user_profile=array();
		 
		  if($whereclause!='')
		 {
			 $ls_searchprogile="SELECT t.user_id,s.online FROM profiles `t` LEFT JOIN online_users `s` ON t.user_id=s.user_id LEFT JOIN users `u` ON t.user_id=u.id WHERE $whereclause and t.user_id!='".Yii::app()->user->getId()."' and u.superuser=0 and status NOT IN (0,2) ORDER BY `u`.`lastvisit_at` DESC";
			$lo_commandSql=Yii::app()->db->createCommand($ls_searchprogile);
			$lsa_user =$lo_commandSql->queryAll();
			
			if($lsa_user)
				{
					foreach($lsa_user as $lo_user)
					{
					if($lo_user['user_id']!=Yii::app()->user->getId())
					$user_profile[]=array('searchuser'=>User::model()->find('id=:ID', array(':ID'=>$lo_user['user_id'])),'online'=>$lo_user['online']);
						$searchprofile = new SearchProfile;
						$searchprofile->profileid = $lo_user['user_id'];
						$searchprofile->searchby =  Yii::app()->user->id;
						$searchprofile->search_time = Date('Y-m-d H:i:s');
						$searchprofile->save();
					}
				}
		 }else
		 {
			$user_profile=array();
		 }
	    $this->render('search',array('users'=>$user_profile));
		}
	
	} 

	public function actionRemovefav()
	{
		if (Yii::app()->getRequest()->getIsPostRequest()) {
            
			$loguserid =Yii::app()->user->id;
			$fav_id = $_POST['fav_id'];
			$favs = UserFavoriteprofiles::model()->find('user_id=:user_id AND favorite_id =:fav_id', array(':user_id'=>$loguserid,':fav_id'=>$fav_id));
				if($favs)
				{
				 if($favs->delete())
				 echo UserModule::t('Deleted successfully.');
				else
				 echo UserModule::t('Delete failed.');	
				
			}else
			{
				 echo UserModule::t('Invalid Request.');
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
				  echo UserModule::t('Added successfully.');
				else
				{
				 echo UserModule::t('Add failed.');
				}
			}else
			{
				 echo UserModule::t('Invalid Request.');
			}
	
		} else
            throw new CHttpException(403);	
	}
	public function actionRemoverfcbyid()
	{
		
		if (Yii::app()->getRequest()->getIsPostRequest()) {
            
			$loguserid =Yii::app()->user->id;
			$id = $_POST['id'];
			
			
	//AND status=2
		$userfriend = UserFriends::model()->find('id=:id',array(':id'=>$id));
		
			if($userfriend)
			{
				
				$userfriend->status=4;
				if($userfriend->save())
				 echo UserModule::t('Deleted!');
			else
				 echo UserModule::t('Delete failed.');
			
			}else
			{
				 echo UserModule::t('Invalid Request.');
			}
	
		} else
            throw new CHttpException(403);	
	
	}
	public function actionRemoverfc()
	{
		if (Yii::app()->getRequest()->getIsPostRequest()) {
            
			$loguserid =Yii::app()->user->id;
			$declined_id = $_POST['declined_id'];
			
			
	//AND status=2
		$userfriend = UserFriends::model()->find('user_id=:user_id AND friend_id=:friend_id ',array(':user_id'=>$loguserid,'friend_id'=>$declined_id));
		
			if($userfriend)
			{
				$userfriend->status=4;
				if($userfriend->save())
				 echo UserModule::t('Removed successfully.');
			else
				 echo UserModule::t('Delete failed.');
			
			}else
			{
				 echo UserModule::t('Invalid Request.');
			}
	
		} else
            throw new CHttpException(403);	
	}
	
	public function actionAddtofavorite()
	{

	if (Yii::app()->getRequest()->getIsPostRequest()) {
            
			$loguserid =Yii::app()->user->id;
			$favid = $_REQUEST['favid'];
			if($loguserid == $favid)
			{
				echo UserModule::t('You can\'t add yourself to your Favorite List.');
			}else
			{
				$favs = UserFavoriteprofiles::model()->findAll('user_id=:user_id AND favorite_id =:favorite_id', array(':user_id'=>$loguserid,':favorite_id'=>$favid));
				if(!$favs)
				{
					$newfavs= new UserFavoriteprofiles();
					$newfavs->user_id=Yii::app()->user->id;
					$newfavs->favorite_id=$_REQUEST['favid'];
					$newfavs->save(false);
			Yii::app()->user->setFlash('favoritemessage',UserModule::t('Add to Favorites - DONE.'));	
				 echo UserModule::t('Add to Favorites - DONE.');
				 
			
					$message_obj=Systemmails::model()->findbyPk(6); 
					$fav_users_profile=Yii::app()->db->createCommand("select * from  profiles where user_id='".$newfavs->favorite_id."'")->queryRow();
					
					if($fav_users_profile['msg_receivefavorit']=='Yes')
					{	
					$fav_users=Yii::app()->db->createCommand("select * from  users where id='".$newfavs->favorite_id."'")->queryRow();
					$users=Yii::app()->db->createCommand("select * from  users where id='".$newfavs->user_id."'")->queryRow();
					$profie='http://' . $_SERVER['HTTP_HOST'].'/'.$_SESSION['lang'].'/user/profile/'.$users['username'];	
					$profie_name='<a href="'.$profie.'">"'.$users['username'].'"</a>';
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
					$mailer->AddAddress($fav_users['email']);
					$mailer->FromName = 'Rajarani';
					$mailer->CharSet = 'UTF-8';
					$mailer->Subject = $message_obj->subject;
					$message_body = str_replace(array("{sender_userprofile}","{receiver_username}","{sender_username}"),array($profie_name,$fav_users['username'],$users['username']),$message_obj->message);
					 $message =  $this->renderPartial('application.modules.user.views.systemmails.systemMail',array('message'=>$message_body),true);
					$mailer->Body = $message;
					$mailer->Send();
					}
				}else
				{
			Yii::app()->user->setFlash('favoritemessage',UserModule::t('This profile is on your Favorit List already.'));	
				 echo UserModule::t('This profile is on your Favorite List already.');	
				}
			}
		} else
            throw new CHttpException(403);		
		
	} 
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionEdit()
	{
		$this->layout='//layouts/editprofile';
		$model = $this->loadUser();
		$password = $model->password;
		$model->password=null;
		$profile=$model->profile;
		UWprofilepic::handleProfilePic($model,$profile);    
		$step=1;
		

		// ajax validator
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo UActiveForm::validate(array($model));
			Yii::app()->end();
		}
		
		if(isset($_POST))
		{
	
		if(isset($_POST['step'])  && $_POST['step']==1)
		{
		$profile->attributes=$_POST['Profile'];
	    if($model->validate($_POST['User']) && $profile->validate($_POST['Profile']) ) 
		{ 
		$model->attributes=$_POST['User'];
		$profile->attributes=$_POST['Profile'];
		foreach($_POST['Profile'] as $name1 => $val1)
		{
			if(is_array($val1))
			{
				$profile->$name1=implode(',',$val1);
			}
		}  
		 
		if($model->password!='')
		{
			if($model->verifyPassword!=$model->password )
			{
				$model->addError('verifyPassword',UserModule::t("The passwords do not match."));
			}
			$model->password = UserModule::encrypting($_REQUEST['User']['password']);
		}
		else
		{
			 $model->password = $password;
		}
			foreach($profile->attributes as $fieldname=>$fieldvalue)
			{
				if($fieldname=='dob')
				{
				$tmpprofilefield = ProfileField::model()->find('varname=:varname', array('varname' => $fieldname));
				$tmpdata =explode('-',$fieldvalue);
				$fieldvalue = $tmpdata[2].'-'.$tmpdata[1].'-'.$tmpdata[0];
				$profile[$fieldname] = $fieldvalue ;
				}
				
			}
		
			if( !$model->hasErrors() && $model->save() && $profile->save() )
			{
			$_SESSION['userprofileldstatus'] = '';
			Yii::app()->user->updateSession();
			Yii::app()->user->setFlash('profileMessage1',UserModule::t("Your changes have been saved."));
			   $step=1;
			}else
			{  // not completed with required fields
				$_SESSION['userprofileldstatus'] = 'incomplete';
			}
			}
		}
		if(isset($_POST['step'])  && $_POST['step']==2)
		{
			if($profile->validate($_POST['Profile']))
		  	 {
				$profile->attributes=$_POST['Profile'];
				foreach($_POST['Profile'] as $name1 => $val1)
					{
						if(is_array($val1))
							{
								$profile->$name1=implode(',',$val1);
							}else
			{
				$profile->$name1=$val1;
			}
		}
	
			if($profile->save(false))
			{
			Yii::app()->user->updateSession();
			Yii::app()->user->setFlash('profileMessage2',UserModule::t("Your changes have been saved."));
			$step=2;
			}else
			{
				$step=2;
			}
			}
		}elseif(isset($_POST['step'])  && $_POST['step']==3)
		{
			$profile->attributes=$_POST['Profile'];
			foreach($_POST['Profile'] as $name1 => $val1)
			{
				if(is_array($val1))
				{
				$profile->$name1=implode(',',$val1);
				}else
					{
						$profile->$name1=$val1;
					}
			}
	
			
			
          if($profile->validate($_POST['Profile'])) 
		  {
		$profile->attributes=$_POST['Profile'];
		foreach($_POST['Profile'] as $name1 => $val1)
		{
			if(is_array($val1))
			{
				$profile->$name1=implode(',',$val1);
			}else
			{
				$profile->$name1=$val1;
			}
		}			   
			if($profile->save(false))
			{
				Yii::app()->user->updateSession();
				Yii::app()->user->setFlash('profileMessage3',UserModule::t("Your changes have been saved."));
				$step=3;
			}		
		  }		
		}elseif(isset($_POST['step'])  && $_POST['step']==4)
		{
         if($profile->validate($_POST['Profile'])) 
		  {
		$profile->attributes=$_POST['Profile'];
		foreach($_POST['Profile'] as $name1 => $val1)
		{
			if(is_array($val1))
			{
				$profile->$name1=implode(',',$val1);
			}else
			{
				$profile->$name1=$val1;
			}
		}			   
			if($profile->save(false))
			{
			Yii::app()->user->updateSession();
			Yii::app()->user->setFlash('profileMessage4',UserModule::t("Your changes have been saved."));
				$step=4;
			}		
		  }		
		}
		elseif(isset($_POST['step'])  && $_POST['step']==5)
		{
			$profile->attributes=$_POST['Profile'];
			foreach($_POST['Profile'] as $name1 => $val1)
				{
					if(is_array($val1))
						{
							$profile->$name1=implode(',',$val1);
						}else
							{
							$profile->$name1=$val1;
							}
				}	
		
			
          if($profile->validate($_POST['Profile'])) 
		  {
			$profile->attributes=$_POST['Profile'];
			foreach($_POST['Profile'] as $name1 => $val1)
				{
					if(is_array($val1))
						{
							$profile->$name1=implode(',',$val1);
						}else
						{
							$profile->$name1=$val1;
						}
				}			   
			if($profile->save(false))
			{
			Yii::app()->user->updateSession();
			Yii::app()->user->setFlash('profileMessage5',UserModule::t("Your changes have been saved."));
				$step=5;
			}		
		  }		
		}
		elseif(isset($_POST['step'])  && $_POST['step']==6)
		{
		$profile->attributes=$_POST['Profile'];
		foreach($_POST['Profile'] as $name1 => $val1)
		{
			if(is_array($val1))
			{
				$profile->$name1=implode(',',$val1);
			}
		}	
			
          if($profile->validate($_POST['Profile'])) 
		  {
		$profile->attributes=$_POST['Profile'];
		foreach($_POST['Profile'] as $name1 => $val1)
		{
			if(is_array($val1))
			{
				$profile->$name1=implode(',',$val1);
			}else
			{
				$profile->$name1=$val1;
			}
		}			   
			if($profile->save(false))
			{
			Yii::app()->user->updateSession();
			Yii::app()->user->setFlash('profileMessage6',UserModule::t("Your changes have been saved."));
				$step=6;
			}		
		  }		
		}
		}
		$this->render('edit',array(
			'model'=>$model,
			'profile'=>$profile,
			'tabstep'=>$step
		));
	}
	/**
	 * Change password
	 */
	public function actionChangepassword() {
		$model = new UserChangePassword;
		if (Yii::app()->user->id) {
			
			// ajax validator
			if(isset($_POST['ajax']) && $_POST['ajax']==='changepassword-form')
			{
				echo UActiveForm::validate($model);
				Yii::app()->end();
			}
			
			if(isset($_POST['UserChangePassword'])) {
					$model->attributes=$_POST['UserChangePassword'];
					if($model->validate()) {
						$new_password = User::model()->notsafe()->findbyPk(Yii::app()->user->id);
						$new_password->password = UserModule::encrypting($model->password);
						$new_password->activkey=UserModule::encrypting(microtime().$model->password);
						$new_password->save();
						Yii::app()->user->setFlash('profileMessage',UserModule::t("New password saved."));
						$this->redirect(array("profile"));
					}
			}
			$this->render('changepassword',array('model'=>$model));
	    }
	}
	
public function actionImport()
		{
			set_time_limit(0);
			$connection=Yii::app()->db;
			$sql="SELECT * FROM user_db WHERE lastvisit BETWEEN DATE_SUB( CURDATE( ) , INTERVAL 12 MONTH ) AND CURDATE( ) GROUP BY profilename";
			$countno=0;
			foreach($connection->createCommand($sql)->queryAll() as $rows)
			{				
				echo "<br>".$rows['uid'].$rows['profilename']."<br>";
				$tmpuser=new User;
				$tmpuser->id=$rows['uid'];
				$tmpuser->username=$rows['profilename'];
				$tmpuser->password=UserModule::encrypting($rows['password1']);
				$tmpuser->email=$rows['email'];
				$tmpuser->status='1';
				$tmpuser->create_at=$rows['enterdate'];
				$tmpuser->lastvisit_at=$rows['lastvisit'];
				$tmpuser->superuser=0;
				if($tmpuser->save())
					{ 
						$country=Yii::app()->db->createCommand("SELECT name FROM country where id='".$rows['Residing']."'")->queryRow();
						$tmpProfile = new Profile;
						$tmpProfile->user_id=$tmpuser->id;
						$tmpProfile->dob=$rows['DOB'];
						if($rows['gender']=='M')
						{
							$tmpProfile->gender='Male';
						}
						else
							$tmpProfile->gender='Female';
							
						$tmpProfile->residingcountry=$country['name'];
						$tmpProfile->nationality=$rows['Nationality'];
						$tmpProfile->ethnicity=$rows['Ethnicalbackground'];
						$tmpProfile->religion=$rows['Religion'];
						$tmpProfile->eyescolor=$rows['Eyescolor'];
						$tmpProfile->hair=$rows['Haircolor'];
						$tmpProfile->height=$rows['Height'];
						$tmpProfile->education=$rows['Education'];
						$tmpProfile->profession=$rows['Occupation'];
						$tmpProfile->marriage=$rows['Marriage'];
						$tmpProfile->havechildren=$rows['Children'];
						$tmpProfile->personality=$rows['Personality'];
						$tmpProfile->smoke=$rows['Smoke'];
						$tmpProfile->alcohol=$rows['Drink'];
						$tmpProfile->diet=$rows['Diet'];
						$tmpProfile->aboutme=$rows['Aboutme'];
						$tmpProfile->weight=$rows['Weight'];
						$tmpProfile->save(false);
						
						// import user ohotos 
						$connection1=Yii::app()->db;
						echo $sql1="select photo from user_photo where UID =".$rows['uid'];
						
						
							
						foreach($connection1->createCommand($sql1)->queryAll() as $rows1)
						{
							 
							 $gallerymodel = new GalleryPhoto();
            				$gallerymodel->gallery_id = 1;
							$gallerymodel->file_name = $rows1['photo'];
							$gallerymodel->user_id =$tmpuser->id;
							$gallerymodel->save();
 				           echo "image path::".Yii::app()->request->baseUrl. '/' . $gallerymodel->galleryDir . '/'.'_pictures'. '/' .$rows1['photo'];
							
						}
						
						
					}
				$countno++;
			
			}
		}
	
	public function actionUseronline()
		{
			$connection=Yii::app()->db;
			$sql="SELECT * FROM user_db WHERE lastvisit BETWEEN DATE_SUB( CURDATE( ) , INTERVAL 12 MONTH ) AND CURDATE( ) GROUP BY profilename";
			foreach($connection->createCommand($sql)->queryAll() as $rows)
			{
				echo "<br>".$rows['uid']."<br>";
				$onlineuser=new OnlineUsers;
				$onlineuser->user_id=$rows['uid'];
				$onlineuser->online=0;
				$onlineuser->save();
			}
		}
		
	public function actionRight()
		{
			$connection=Yii::app()->db;
			$sql="SELECT * FROM user_db WHERE lastvisit BETWEEN DATE_SUB( CURDATE( ) , INTERVAL 12 MONTH ) AND CURDATE( ) GROUP BY profilename";
			foreach($connection->createCommand($sql)->queryAll() as $rows)
			{
				echo "<br>".$rows['uid']."<br>";
				$command_table=Yii::app()->db->createCommand("INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES('PM', '".$rows['uid']."', NULL, 0x4e3b);");
				$command_table->execute();
			}
		}
		
	public function actionGeneratephoto()
	{
		
		$data = GalleryPhoto::Model()->findAll();
		foreach ($data as $photo): 
		if($photo->small==NULL || $photo->medium==NULL || $photo->original==NULL || $photo->thumb==NULL || $photo->profile==NULL )
		{
		
		$model =  GalleryPhoto::model()->findByPk($photo->id);
			$imgpath=  Yii::app()->getBasePath(). '/' . $model->galleryDir . '/'.$photo->file_name;
			if(is_file(Yii::app()->getBasePath().'/'.'..' . '/' . $model->galleryDir . '/'.$photo->file_name))	
			{
			$model->generateImage(Yii::app()->getBasePath().'/'.'..' . '/' . $model->galleryDir . '/'.$photo->file_name);
			}
		}
		
		
        endforeach;
	}
	
	public function actionUsermessage()
		{
			$connection=Yii::app()->db;
			$sql="SELECT id FROM users";
			foreach($connection->createCommand($sql)->queryAll() as $rows)
			{
				$msgsql="SELECT sender,receiver,subject,msgbody,hasread,sendtime FROM msg_db where sender='".$rows['id']."'";
				$msgsqlexecute=$connection->createCommand($msgsql)->queryAll();
				foreach($msgsqlexecute as $msg)
				{
					$msgusersql="SELECT id FROM users where id='".$msg['receiver']."'";
					$msgusersqlexecute=$connection->createCommand($msgusersql)->queryAll();
					foreach($msgusersqlexecute as $msguser)
					{
						$Message=Yii::app()->db->createCommand("INSERT INTO messages (sender_id, receiver_id, subject,body, is_read,created_at,type) VALUES('".$msg['sender']."', '".$msguser['id']."', '".addslashes($msg['subject'])."', '".addslashes($msg['msgbody'])."','".$msg['hasread']."','".$msg['sendtime']."','0');");
						$Message->execute();
					}
				}
			}
		}
		
	public function actionUserrfc()
		{
			$connection=Yii::app()->db;
			$sql="SELECT id FROM users";
			foreach($connection->createCommand($sql)->queryAll() as $rows)
			{
				$rfcsql="SELECT * FROM accept_db where UID='".$rows['id']."'";
				$rfcsqlexecute=$connection->createCommand($rfcsql)->queryAll();
				foreach($rfcsqlexecute as $rfc)
				{
					$rfcusersql="SELECT * FROM users where id='".$rfc['RUID']."'";
					$rfcusersqlexecute=$connection->createCommand($rfcusersql)->queryAll();
					foreach($rfcusersqlexecute as $rfcuser)
					{
						$UserFriends              = new UserFriends;
						$UserFriends->user_id     = $rfc['UID'];
						$UserFriends->friend_id   = $rfcuser['id'];
						$UserFriends->status	  = 1;
						$UserFriends->save();
					}
				}
			}
		}
		
 	public function actionUserfav()
		{
			$connection=Yii::app()->db;
			$sql="SELECT id FROM users";
			foreach($connection->createCommand($sql)->queryAll() as $rows)
			{
				$favsql="SELECT * FROM favourate_db where UID='".$rows['id']."'";
				$favsqlexecute=$connection->createCommand($favsql)->queryAll();
				foreach($favsqlexecute as $fav)
				{
					$favusersql="SELECT * FROM users where id='".$fav['FUID']."'";
					$favusersqlexecute=$connection->createCommand($favusersql)->queryAll();
					foreach($favusersqlexecute as $favuser)
					{
						$UserFavorite              = new UserFavoriteprofiles;
						$UserFavorite->user_id     = $fav['UID'];
						$UserFavorite->favorite_id = $favuser['id'];
						$UserFavorite->save();
					}
				}
			}
		}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
	 */
	public function loadUser()
	{
		if($this->_model===null)
		{
			
			if(Yii::app()->user->id)
				$this->_model=Yii::app()->controller->module->user();
			if($this->_model===null)
				$this->redirect(Yii::app()->controller->module->loginUrl);
		}
		return $this->_model;
	}

	public function actionUpdateprofilephoto()
	{
		$data = GalleryPhoto::Model()->findAll();
		foreach ($data as $photo): 
		 $profilemodel = Profile::model()->findByAttributes(array('user_id'=>$photo->user_id));
		 if($profilemodel)
		 {
		 $profilemodel->user_id=$photo->user_id;
		 echo "<br>";
		 echo $profilemodel->avatar = 'gallery/'.$photo->profile;
		 $profilemodel->save(false);
		 echo "done";
		 }
		endforeach;
		
	}

}