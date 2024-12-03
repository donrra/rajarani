<?php

class InboxController extends Controller
{
	public $defaultAction = 'inbox';

	public function actionInbox() {
		$_SESSION['activemenu']='envelope';
		if(isset($_SESSION['userprofileldstatus']) && $_SESSION['userprofileldstatus'] == 'incomplete')
					{
					 $this->redirect(Yii::app()->createUrl("/user/profile/edit"));
					}
		$this->layout='//layouts/subpage';
		
			$messagesAdapter = Message::getAdapterForInbox(Yii::app()->user->getId());
			//echo $messagesAdapter->totalItemCount;
		$pager = new CPagination($messagesAdapter->totalItemCount);
		$pager->pageSize = 10;
		$messagesAdapter->setPagination($pager);
		
		
		$this->render(Yii::app()->getModule('message')->viewPath . '/inbox', array(
			'messagesAdapter' => $messagesAdapter
		));
	}
public function actionInboxcount() {
		$_SESSION['activemenu']='envelope';
		if(isset($_SESSION['userprofileldstatus']) && $_SESSION['userprofileldstatus'] == 'incomplete')
					{
					 $this->redirect(Yii::app()->createUrl("/user/profile/edit"));
					}
		$this->layout='//layouts/subpage';
		$messagesAdapter = Message::getAdapterForInbox(Yii::app()->user->getId());
		$pager = new CPagination($messagesAdapter->totalItemCount);
		$pager->pageSize = 10;
		$messagesAdapter->setPagination($pager);
		
		$totalinboxcount=0;
		foreach($messagesAdapter->data as $data)
		{
			if($data['is_read']==0 && $data['is_read']!='')
			 $totalinboxcount=count($data['is_read']);
		}//echo $totalinboxcount;
		//$totalinboxcounts=$messagesAdapter->totalItemCount-$totalinboxcount;
		$inboxdata['totalinboxcount']=$totalinboxcount;
		 ob_end_clean(); 
		 echo CJavaScript::jsonEncode($inboxdata); 
	}

}
