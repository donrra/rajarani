<?php

class FriendController extends Controller
{
	public function actionIndex()
	{
		$this->layout='//layouts/subpage';
		
		$userfriendsobj = UserFriends::model()->findAll('user_id = :user_id AND status=:status',array(':user_id'=>Yii::app()->user->id,':status'=>1));
	
		
		$this->render('index',array('friends'=>$userfriendsobj));
	}
}