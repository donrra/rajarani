<?php

class SuggestController extends Controller {

	public function actionUser() {
		
		Yii::import('application.modules.user.models.UserFriends');
		$q = Yii::app()->request->getParam('name_startsWith');
		$userModels = (array) call_user_func(array(
			CActiveRecord::model(Yii::app()->getModule('message')->userModel),
			Yii::app()->getModule('message')->getSuggestMethod
		), $q);

		$users = array();
		if ($userModels) {
			foreach ($userModels as $userModel) {
				$checkfriendsobj=UserFriends::model()->havefriends($userModel->getPrimaryKey(),Yii::app()->user->id);
				if($checkfriendsobj[0]['isfriend']=='yes')
				{
				$users[] = array(
					'id' => $userModel->getPrimaryKey(),
					'name' => call_user_func(array(
						$userModel, $this->getModule()->getNameMethod
					))
				);
			}
				
			}
		}
		$json = CJSON::encode(array('users' => $users));

		if (Yii::app()->request->getParam('callback')) {
		    $callback = Yii::app()->request->getParam('callback');
			$json = $callback . '('. $json . ')';
		}

		header('Cache-Control: no-store');
		header('Pragma: no-store');
		header("Content-type: application/json");
		echo $json;
		Yii::app()->end();
	}
	public function actionIsvaliduser()
	{
		
		
		 if (Yii::app()->getRequest()->getIsPostRequest()) {
		   $tmpconformtxt = $_POST['tmpconformtxt'];
			 $validuser_model = User::model()->find('username=:username', array(':username'=>$tmpconformtxt));
			if($validuser_model)	
			{
				$checkfriendsobj=UserFriends::model()->havefriends($validuser_model->id,Yii::app()->user->id);  		if($checkfriendsobj[0]['isfriend']=='yes')
			    {
					echo $validuser_model->id;
				}else
				{
					echo 'error';;
				}
			}else
			 echo 'error';;
	 	
		
		} else
    		 echo 'error';;
	 
	
	}
	
}