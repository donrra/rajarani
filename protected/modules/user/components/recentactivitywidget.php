<?php
class RecentactivityWidget extends CWidget {
   
   
    public function run() {
		
		
		$ls_replysql="SELECT t.`sender_id` FROM `messages` t WHERE t.`receiver_id`=".Yii::app()->user->id." AND t.parent_id!=0 AND  t.`is_read` ='0' order by t.id DESC limit 0,1";
		$lo_commandSql=Yii::app()->db->createCommand($ls_replysql);
		$lsa_reply =$lo_commandSql->queryAll();
		if($lsa_reply)
		{
			$replysender=User::model()->find('id=:ID', array(':ID'=>$lsa_reply[0]['sender_id']))->username;
		}else
		{
			$replysender='';;
		}
		
		$ls_messagesql="SELECT t.`sender_id` FROM `messages` t WHERE t.`receiver_id`=".Yii::app()->user->id." AND t.parent_id=0 AND  t.`is_read` ='0' order by t.id DESC limit 0,1";
		$lo_commandSql=Yii::app()->db->createCommand($ls_messagesql);
		$lsa_message =$lo_commandSql->queryAll();
		if($lsa_message)
		{
			$messsagesender=User::model()->find('id=:ID', array(':ID'=>$lsa_message[0]['sender_id']))->username;
		}else
		{
			$messsagesender='';;
		}
		
		
		
		$activity_list=array('reply'=>$replysender,'message'=>$messsagesender,'flirt'=>'');
		  $this->render('recentactivity',array('activity'=>$activity_list));
    }
	

}

?>