<?php
class TopNavmenu extends CWidget
{
	 public $activemenu;
    public function run()
    {
		$useronline=OnlineUsers::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
	 	$profilename  = User::model()->notsafe()->findByPk(Yii::app()->user->id)->username;
	 	 $this->render('navmenu',array('profilename'=>$profilename,'activemenu'=>$this->activemenu,'useronline'=>$useronline));
    }
}