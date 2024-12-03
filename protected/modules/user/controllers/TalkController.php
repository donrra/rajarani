<?php

class TalkController extends Controller
{
//	public $defaultAction = 'talk';
	
	/**
	 * Logout the current user and redirect to returnLogoutUrl.
	 */
	
	public function actionChatheartbeat()
	{
		$items = '';	
	
	$chatBoxes = array();
	$command = Yii::app()->db->createCommand("select * from chat where (chat.to = '".($_SESSION['username'])."' AND 
	recd = 0) order by id ASC")->queryAll();
    foreach($command as $index => $chat)
        {
      
		 if (!isset($_SESSION['openChatBoxes']->$chat['from']) && isset($_SESSION['chatHistory']->$chat['from']))
		  {
			$items = $_SESSION['chatHistory']->$chat['from'];
			}
		$chat['message'] = $this->sanitize($chat['message']);
		$items .= <<<EOD
					   {
			"s": "0",
			"f": "{$chat['from']}",
			"m": "{$chat['message']}"
	   },
EOD;
		
		if (!isset($_SESSION['chatHistory'][$chat['from']])) {
		$_SESSION['chatHistory'][$chat['from']]='';
	}
		
		
		
		$_SESSION['chatHistory'][$chat['from']] .= <<<EOD
						   {
			"s": "0",
			"f": "{$chat['from']}",
			"m": "{$chat['message']}"
	   },
EOD;
		
		unset($_SESSION['tsChatBoxes'][$chat['from']]);
		
		$_SESSION['openChatBoxes'][$chat['from']] =  $chat['sent'];
		

    }
	
	if (!empty($_SESSION['openChatBoxes'])) {
	foreach ($_SESSION['openChatBoxes'] as $chatbox => $time) {
		if (!isset($_SESSION['tsChatBoxes'][$chatbox])) {
			$now = time()-strtotime($time);
			$time = date('g:iA M dS', strtotime($time));

			$message = "Sent at $time";
			if ($now > 180) {
				$items .= <<<EOD
{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;


	
	if (!isset($_SESSION['chatHistory'][$chatbox])) {
		$_SESSION['chatHistory'][$chatbox] = '';
	}
 
  
$_SESSION['chatHistory'][$chatbox].= <<<EOD
		{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;
$_SESSION['tsChatBoxes'][$chatbox] = 1;
		}
		}
	}
}

	$sql = "update chat set recd = 1 where chat.to = '".($_SESSION['username'])."' and recd = 0";
	$connection = Yii::app()-> db;
	$command = $connection ->createCommand($sql);
	$command -> execute();

	if ($items != '') {
		$items = substr($items, 0, -1);
	}
header('Content-type: application/json');
?>
{
		"items": [
			<?php echo $items;?>
        ]
}

<?php
			exit(0);
	}
	public function actionChatBoxSession($chatbox) {
	
	$items = '';
	
	if (isset($_SESSION['chatHistory'][$chatbox])) {
		$items = $_SESSION['chatHistory'][$chatbox];
	}

	return $items;
	}


	function chatBoxSession($chatbox) {
	
	$items = '';
	
	if (isset($_SESSION['chatHistory'][$chatbox])) {
		$items = $_SESSION['chatHistory'][$chatbox];
	}

	return $items;
	}

	public function actionStartchatsession()
	{
		$items = '';
		if (!empty($_SESSION['openChatBoxes'])) {
			foreach ($_SESSION['openChatBoxes'] as $chatbox => $void) {
				$items .= $this->chatBoxSession($chatbox);
			}
		}
		if ($items != '') {
			$items = substr($items, 0, -1);
		}
	
	header('Content-type: application/json');
	?>
	{
			"username": "<?php echo $_SESSION['username'];?>",
			"items": [
				<?php echo $items;?>
			]
	}
	
	<?php
		exit(0);
	}
	public function actionSendchat()
	{
	$from = $_SESSION['username'];
	$request = Yii::app()->request;
	$to = $request->getPost('to');
	$message = $request->getPost('message');

	$_SESSION['openChatBoxes'][$to] = date('Y-m-d H:i:s', time());
	
	 $messagesan = $this->sanitize($message);

	if (!isset($_SESSION['chatHistory'][$to])) {
		$_SESSION['chatHistory'][$to] = '';
	}

	$_SESSION['chatHistory'][$to] .= <<<EOD
					   {
			"s": "1",
			"f": "{$to}",
			"m": "{$messagesan}"
	   },
EOD;


	unset($_SESSION['tsChatBoxes'][$to]);
$sql = "insert into chat (chat.from,chat.to,message,sent) values ('".($from)."', '".($to)."','".($message)."',NOW())";
	$connection = Yii::app()-> db;
	$command = $connection ->createCommand($sql);
	$command -> execute();
	$Track_userPageLoad="update users set page_last_visit='".date('Y-m-d H:i:s')."' where id='".Yii::app()->user->getId()."'";
	$commandPageLoad =Yii::app()->db->createCommand($Track_userPageLoad)->execute();
	echo "1";
	exit(0);
	}
	public function actionClosechat()
	{
	$request = Yii::app()->request;
	$chatbox = $request->getPost('chatbox');
	unset($_SESSION['openChatBoxes'][$chatbox]);
	
	echo "1";
	exit(0);
	
	} 
	
	
	public function sanitize($text) {
	$text = htmlspecialchars($text, ENT_QUOTES);
	$text = str_replace("\n\r","\n",$text);
	$text = str_replace("\r\n","\n",$text);
	$text = str_replace("\n","<br>",$text);
	
	$text = str_replace("&gt;:(","<span class='grumpy'></span>",$text);
	$text = str_replace("&lt;3","<span class='sheart'></span>",$text);
	$text = str_replace("&gt;:O","<span class='upset'></span>",$text);
	$text = str_replace('O:)',"<span class='angel'></span>",$text);
	$text = str_replace('3:)',"<span class='devil'></span>",$text);
	$text = str_replace(':)',"<span class='smile'></span>",$text);
	$text = str_replace(':-(',"<span class='frown'></span>",$text);
	$text = str_replace(':-P',"<span class='tongue'></span>",$text);
	$text = str_replace('-D',"<span class='grin'></span>",$text);
	$text = str_replace(':-O',"<span class='gasp'></span>",$text);
	$text = str_replace(';-)',"<span class='wink'></span>",$text);
	$text = str_replace('8-)',"<span class='glasses'></span>",$text);
	$text = str_replace(':/',"<span class='unsure'></span>",$text);
	$text = str_replace(";-(","<span class='cry'></span>",$text);		
	$text = str_replace(':-*',"<span class='kiss'></span>",$text);
	$text = str_replace(";-(","<span class='cry'></span>",$text);
	$text = str_replace('^_^',"<span class='kiki'></span>",$text);
	$text = str_replace('-_-',"<span class='squint'></span>",$text);
	$text = str_replace('o.O',"<span class='confused'></span>",$text);
	$text = str_replace(':v',"<span class='pacman'></span>",$text);
	$text = str_replace(':3',"<span class='curly_lips'></span>",$text);
	
	$shortcode = array(":-)", ":)", ":]","=)");
	$textstr   = array("smile", "smile", "smile");	
	return $text;
    }
}