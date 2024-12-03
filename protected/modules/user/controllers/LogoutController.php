<?php
class LogoutController extends Controller
{
	public $defaultAction = 'logout';
	
	/**
	 * Logout the current user and redirect to returnLogoutUrl.
	 */
	public function actionLogout()
	{
		
		$online_usersmodel = OnlineUsers::model()->find('user_id=:user_id', array(':user_id'=>Yii::app()->user->id));
		if($online_usersmodel)
		{
		$online_usersmodel->online=0;
		$online_usersmodel->save();	
		}
		Yii::app()->user->logout();
		Yii::app()->setLanguage('en');
		$this->redirect(Yii::app()->controller->module->returnhomeUrl);
	}

}