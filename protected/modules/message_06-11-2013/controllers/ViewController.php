<?php

class ViewController extends Controller {

	public $defaultAction = 'view';

	public function actionView_old() {
				$this->layout='//layouts/subpage';
		$messageId = (int)Yii::app()->request->getParam('message_id');
		$viewedMessage = Message::model()->findByPk($messageId);

		if (!$viewedMessage) {
			 throw new CHttpException(404, MessageModule::t('Message not found'));
		}

		$userId = Yii::app()->user->getId();

		if ($viewedMessage->sender_id != $userId && $viewedMessage->receiver_id != $userId) {
		    throw new CHttpException(403, MessageModule::t('You can not view this message'));
		}
		if (($viewedMessage->sender_id == $userId && $viewedMessage->deleted_by == Message::DELETED_BY_SENDER)
		    || $viewedMessage->receiver_id == $userId && $viewedMessage->deleted_by == Message::DELETED_BY_RECEIVER) {
		    throw new CHttpException(404, MessageModule::t('Message not found'));
		}
		$message = new Message();

		$isIncomeMessage = $viewedMessage->receiver_id == $userId;
		if ($isIncomeMessage) {
		    $message->subject = preg_match('/^Re:/',$viewedMessage->subject) ? $viewedMessage->subject : 'Re: ' . $viewedMessage->subject;
			$message->receiver_id = $viewedMessage->sender_id;
		} else {
			$message->receiver_id = $viewedMessage->receiver_id;
		}

		if (Yii::app()->request->getPost('Message')) {
			$message->attributes = Yii::app()->request->getPost('Message');
			$message->sender_id = $userId;
			if ($message->save()) {
				Yii::app()->user->setFlash('success', MessageModule::t('Message has been sent'));
			    if ($isIncomeMessage) {
					$this->redirect($this->createUrl('inbox/'));
			    } else {
					$this->redirect($this->createUrl('sent/'));
				}
			}
		}

		if ($isIncomeMessage) {
			$viewedMessage->markAsRead();
		}
	
		
		$this->render(Yii::app()->getModule('message')->viewPath . '/view', array('viewedMessage' => $viewedMessage, 'message' => $message));
	}
	
	public function actionView() {
		
		$this->layout='//layouts/subpage';
		$messageId = (int)Yii::app()->request->getParam('message_id');
		$viewedMessage = Message::model()->findByPk($messageId);
		
		// set all child message as markasread.
		Message::model()->updateAll(array( 'is_read' => true ));
		
		if (!$viewedMessage) {
			 throw new CHttpException(404, MessageModule::t('Message not found'));
		}
		$userId = Yii::app()->user->getId();
		
		if ($viewedMessage->sender_id != $userId && $viewedMessage->receiver_id != $userId) {
		    throw new CHttpException(403, MessageModule::t('You can not view this message'));
		}
		if (($viewedMessage->sender_id == $userId && $viewedMessage->deleted_by == Message::DELETED_BY_SENDER)
		    || $viewedMessage->receiver_id == $userId && $viewedMessage->deleted_by == Message::DELETED_BY_RECEIVER) {
		    throw new CHttpException(404, MessageModule::t('Message not found'));
		}
				$message = new Message();
			$isIncomeMessage = $viewedMessage->receiver_id == $userId;
			
			if ($isIncomeMessage) {
				
					$message->subject = preg_match('/^Re:/',$viewedMessage->subject) ? $viewedMessage->subject : 'Re: ' . $viewedMessage->subject;
					$message->receiver_id = $viewedMessage->sender_id;
				
			} else {
				$message->receiver_id = $viewedMessage->receiver_id;
			}
	
			if (Yii::app()->request->getPost('Message')) {
				$message->attributes = Yii::app()->request->getPost('Message');
				//unsetAttributes(parent_id);
				$message->sender_id = $userId;
				
				
				if ($message->save()) {
					//set parent message again unread as well.
					$parentMessage = Message::model()->findByPk($message->parent_id);
					$viewedMessage->markAsUnread();

					Yii::app()->user->setFlash('messageModule', MessageModule::t('Message has been sent'));
					if ($isIncomeMessage) {
						$this->redirect($this->createUrl('inbox/'));
					} else {
						$this->redirect($this->createUrl('sent/'));
					}
				}
			}

		if ($isIncomeMessage) {
			$viewedMessage->markAsRead();
		}
	
		$messagehistory='';
		$messagehistoryAdapter = Message::getAdapterForMessageHistory($messageId);
	
							
		$this->render(Yii::app()->getModule('message')->viewPath . '/view', array('viewedMessage' => $viewedMessage, 'message' => $message,'messagehistory'=>$messagehistoryAdapter));
	}
	
public function actionDropdownrefresh()
 {
		$messageId = (int)Yii::app()->request->getParam('message_id');
		$viewedMessage = Message::model()->findByPk($messageId);
					
		$this->renderPartial(Yii::app()->getModule('message')->viewPath . '/dropdownrefresh', array('viewedMessage' => $viewedMessage,'message_id'=>$_REQUEST['message_id']));
	
 }
}