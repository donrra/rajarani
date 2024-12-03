<?php

class SentController extends Controller
{
	public $defaultAction = 'sent';
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
					'actions'=>array('sent'),
					'users'=>array('admin'),
				),
				array('deny',  // deny all users
					'users'=>array('*'),
				),
			);
		}
	public function actionSent() {
		$messagesAdapter = Message::getAdapterForSent(Yii::app()->user->getId());
		$pager = new CPagination($messagesAdapter->totalItemCount);
		$pager->pageSize = 10;
		$messagesAdapter->setPagination($pager);

		$this->render(Yii::app()->getModule('message')->viewPath . '/sent', array(
			'messagesAdapter' => $messagesAdapter
		));
	}
}
