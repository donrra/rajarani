<?php
class ComposeController extends Controller
{

	public $defaultAction = 'compose';
 public function filters()
		{
			return array(
			'accessControl', // perform access control for CRUD operations
			);
		}
		
	public function accessRules()
		{
			return array(
				
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
					'actions'=>array('compose'),
					'users'=>array('admin'),
				),
				array('deny',  // deny all users
					'users'=>array('*'),
				),
			);
		}
	public function actionCompose($id = null) {
		
     	 $message = new Message();
		if (Yii::app()->request->getPost('Message'))
		 {
			 
			 foreach($_POST['User']['username'] as $receiver)
				{
					$message = new Message();
					$message->attributes = Yii::app()->request->getPost('Message');
			 		$message->sender_id = Yii::app()->user->getId();
					
					$message->receiver_id=$receiver;
					
					if ($message->save()) {
						$message->message=$message->id;
						$message->save();
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
							$mailer->Subject = $message->subject;
							$message_body = str_replace(array("{receiver_username}","{sender_username}","{login_link}"),array($fav_users['username'],$users['username'],$profie_name),$message_obj->message);
							$message =  $this->renderPartial('application.modules.user.views.systemmails.systemMail',array('message'=>$message_body),true);
							$mailer->Body = $message;
							$mailer->Send();
						}
				} 
				}
				$this->redirect($this->createUrl('inbox/'));
		 }
		$this->render(Yii::app()->getModule('message')->viewPath . '/compose', array('model' => $message));
	}
}
