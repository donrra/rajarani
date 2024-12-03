<?php

class DeleteController extends Controller {

	public $defaultAction = 'delete';

	public function actionDelete($id = null,$actiontype=null) {
		if (!$id) {
			$messagesData = Yii::app()->request->getParam('Message');
			$counter = 0;
			if ($messagesData) {
				foreach ($messagesData as $messageData) {
					
					if (isset($messageData['selected'])) {
						$message = Message::model()->findByPk($messageData['id']);
						
						if ($message->deleteByUser(Yii::app()->user->getId())) {
							$counter++;
						}
					}
				}
			}
			if ($counter) {
				Yii::app()->user->setFlash('messageModule', MessageModule::t('{count} message'.($counter > 1 ? 's' : '').' has been deleted', array('{count}' => $counter)));
			}
			$this->redirect(Yii::app()->request->getUrlReferrer());
		} else {
			$message = Message::model()->findByPk($id);

			if (!$message) {
				throw new CHttpException(404, MessageModule::t('Message not found'));
			}

			$folder = $message->receiver_id == Yii::app()->user->getId() ? 'inbox/' : 'sent/';

			$messages=Yii::app()->db->createCommand("select * from  messages where id='".$id."'")->queryAll();

			foreach($messages as $messagesval)
			{
				
				if($messagesval['receiver_id']==Yii::app()->user->getId() && $messagesval['id']!=$messagesval['message'])
				{
					$DeleteMessages=Yii::app()->db->createCommand("update messages set deleted_by='receiver' where receiver_id='".Yii::app()->user->getId()."' and message='".$messagesval['message']."'")->execute();
					Yii::app()->user->setFlash('messageModule', MessageModule::t('Message has been deleted'));
				}
				
				elseif ($messagesval['sender_id']==Yii::app()->user->getId() && $messagesval['id']!=$messagesval['message'])
				{
					$DeleteMessages=Yii::app()->db->createCommand("update messages set deleted_by='receiver' where sender_id='".Yii::app()->user->getId()."' and message='".$messagesval['message']."'")->execute();
					Yii::app()->user->setFlash('messageModule', MessageModule::t('Message has been deleted'));
				}
				
				elseif ($message->deleteByUser(Yii::app()->user->getId())) {
					Yii::app()->user->setFlash('messageModule', MessageModule::t('Message has been deleted'));
				}
			}
			
		   if($actiontype==null)
			$this->redirect($this->createUrl($folder));
		}
	}
	
	
	
	
	
	
}
