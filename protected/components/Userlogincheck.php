<?php
class Userlogincheck extends CApplicationComponent
{
    public function logincheck()
    {
			$timestamp=Yii::app()->db->createCommand("select runtime from timestampcheck")->queryRow();
			$currentTime = date('Y-m-d H:i:s');
			$scriptRuntime = $timestamp['runtime']; //the variable here is in dateTime format coming from the database
			$timeDiff = abs(strtotime($scriptRuntime) - strtotime($currentTime)); //Does this give the seconds?
			$timestampDiff = floor($timeDiff / 60);
			if($timestampDiff >= Yii::app()->params['userTimeStamp'] )
			{
				$loggeduser=Yii::app()->db->createCommand("SELECT `ou`.`user_id` , `ou`.`online` , `u`.`page_last_visit` FROM `online_users` AS `ou` LEFT JOIN `users` AS `u` ON `ou`.`user_id` = `u`.`id` WHERE `ou`.`online` = '1'")->queryAll();
				foreach($loggeduser as $loggeduserval)
					{
						$currentTime = date('Y-m-d H:i:s');
						$userVisitTime = $loggeduserval['page_last_visit']; //the variable here is in dateTime format coming from the database
						$pageVisitdiff = abs(strtotime($userVisitTime) - strtotime($currentTime)); //Does this give the seconds?
						$pageVisitdiffmins = floor($pageVisitdiff / 60);
		 				if($pageVisitdiffmins >= Yii::app()->params['userTimeStamp'])
						{
							if($loggeduserval['user_id'] != Yii::app()->user->id)
							{
							$useractivity=Yii::app()->db->createCommand("update online_users set online=0 where user_id='".$loggeduserval['user_id']."'")->execute();					
							}
						}
					}
				$useractivity=Yii::app()->db->createCommand("update timestampcheck set runtime='".date('Y-m-d H:i:s')."' where id='1'")->execute();
	
					
			}
    }
}
?>