<?php

class InboxController extends Controller
{
	public $defaultAction = 'inbox';
	
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
					'actions'=>array('inbox'),
					'users'=>array('admin'),
				),
				array('deny',  // deny all users
					'users'=>array('*'),
				),
			);
		}
	public function actionInbox() {
		$messagesAdapter = Message::getAdapterForInbox(Yii::app()->user->getId());
		$pager = new CPagination($messagesAdapter->totalItemCount);
		$pager->pageSize = 10;
		$messagesAdapter->setPagination($pager);

		$this->render(Yii::app()->getModule('message')->viewPath . '/inbox', array(
			'messagesAdapter' => $messagesAdapter
		));
	}
}
