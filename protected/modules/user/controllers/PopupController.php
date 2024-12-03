<?php
class PopupController extends Controller
{
	public function actionFetchdata()
	{
		
		 $user_id = $_REQUEST['user_id'];
		 $friend_id = $_REQUEST['friend_id'];
		 $action_type = $_REQUEST['action_type'];
		 $loginuser = User::model()->notsafe()->findByPk($user_id);
  		 $message='';
		$sendtyomodel=User::model()->notsafe()->findByPk($friend_id);
		if($sendtyomodel)
		$sendTorequest = $sendtyomodel->username; 
		else
		$sendTorequest = ''; 
   
    
	$arrayAuthRoleItems = Yii::app()->authManager->getAuthItems(2, Yii::app()->user->getId());
    $arrayKeys = array_keys($arrayAuthRoleItems);
    $role = strtolower ($arrayKeys[0]);   
		  
			
		   switch($action_type)
		   {
			   
			   case 'deleteaccount':
			   $message='<div class="main1">
		<div class="popupmain">
		<h1>Delete Your Account.</h1>
<div class="row">
<!--<textarea name="" cols="" rows="" readonly="readonly" style="width: 579px; height: 259px;"></textarea>-->
<p>If you delete your account, you will have no access to your connections or any information your have added. This also means, your profile will no longer be visible on Rajarani and users will not be able to find you on Rajarani any longer.</p>

<strong>IMPORTANT:</strong>
<p>By deleting your account, your membership period and any balance is unrecoverable.</p>
<p><strong>Do you want to keep your account but receive less emails?</strong></p>
<p>You can add, change or stop email notifications by editing your profile and change the required amount of notifications.</p>
<p>If you still wish to delete your account, we are sad to see your leaving us. </p>
<p>Please help us in our regular efforts to improve the user experience on Rajarani.</p>
<p><strong>1. How was your overall experience having a profile on Rajarani?</strong>(Rate 1-10 where 10 is "The best experience")<br><br>
<input type="radio" name="rateinput"  value="1" class="redioblock"> <label>1</label>
<input type="radio" name="rateinput"  value="2"> <label>2</label>
<input type="radio" name="rateinput"   value="3"><label> 3</label>
<input type="radio" name="rateinput"   value="4"><label> 4</label>
<input type="radio" name="rateinput"   value="5"><label> 5</label>
<input type="radio" name="rateinput"   value="6"><label> 6 </label>
<input type="radio" name="rateinput"   value="7"> <label>7</label>
<input type="radio" name="rateinput"  value="8"><label> 8</label>
<input type="radio" name="rateinput"   value="9"><label> 9</label>
<input type="radio" name="rateinput"   value="10"><label> 10</label>
</p>
<p><strong>2. Why do you wish to delete your account?</strong><br><br>

<p><input type="checkbox" name="whydelete1" id="whydelete1" value="I have found my partner on Rajarani">  <label>I have found my partner on Rajarani </label></p>
<p><input type="checkbox" name="whydelete2" id="whydelete2"  value="I have found my partner outside Rajarani"> <label> I have found my partner outside Rajarani </label></p>
<p><input type="checkbox" name="whydelete3" id="whydelete3"  value="I want to try some other site than Rajarani"> <label>I want to try some other site than Rajarani </label></p>
<p><input type="checkbox" name="whydelete4" id="whydelete4"  value="There are no interesting profiles on Rajarani"> <label> There are no interesting profiles on Rajarani </label></p>
<p><input type="checkbox" name="whydelete5" id="whydelete5"  value="Members on Rajarani dont seem serious/valid">  <label>Members on Rajarani dont seem serious/valid </label></p>
<p><input type="checkbox" name="whydelete6" id="whydelete6"  value="0"> <label> Other reason </label></p>
<br>
<div id="othersdiv" style="display:none">
<input type="text" name="otherswhydelete" id="otherswhydelete" size="50">
</div>
</p>
<p><input type="checkbox" id="agree" name="agree"> I have understood and accept the terms for deleting my account.</p>
<p class="greenbtn" style="text-align: center; padding-right:27px;">
<input type="button" id="confdelete" name="confdelete" value=Delete My Profile" />
<em></em></p>
</div>

<div id="showmesage"></div>
</div></div><script>
			$(document).ready(function()
			{
				$("#whydelete6").live("change",function() {
				
						var checked = $(this).attr("checked");
						if (checked) { 
						$("#othersdiv").show();             
						} else {
						$("#othersdiv").hide();
						}
				
								
    			});
				
				
			});
			</script>';

			   break;
			   case 'userrfcpending':
			   $message= '<div class="space center">
				<h1>Easy now. Your request to get in contact has already been sent.</h1>
				<h2>Please wait for '.$sendTorequest.'s reply.</h2>
				</div>';
			   break;
			   
			   case 'friendrfcpending':
			   $message= '<div class="space center">
				<h1>Please check your contact list.</h1>
				<h2>'.$sendTorequest.' is already in your contact pending list.</h2>
				</div>';
			   break;
			   
			   case 'denyrfc':
			   $message= '<div class="space center">
				<h1>Oups! Many requests have been denied.</h1>
				<h2>Many requests have been denied.</h2>
				</div>';
			   break;
			   
			   case 'rfc':
			   $message= '<div class="popup_body">
  <input name="popup_receiver_id" id="popup_receiver_id" type="hidden" value="'.$sendtyomodel->id.'" />
  <input name="Message_senderName" id="Message_senderName" type="hidden" value="'.$loginuser->username.'" />
    
            
			<div class="spacenew center">
				<h1>
				'.UserModule::t(" A message will be sent to {sendTorequest} that you wish to get in contact…",
			    					array(
			    						'{sendTorequest}'=>$sendTorequest,
			    					)).'</h1>
                    <p class="space_2nd"></p>
				<h2> '.UserModule::t(" \"{sendTorequest}\" can either accept or deny your request. 
                 You will recieve a message when \"{sendTorequest}\" replies your request.",
			    					array(
			    						'{sendTorequest}'=>$sendTorequest,
			    					)).'</h2>
				
				<aside class="button_block_new popupbutton">
                 <p class="greenbtn">
					  <input type="button" value="Send Request" id="sendrequest" name="sendrequest" style="width:245px;">
                     <em></em>
                     
                  </p>
				</aside>
                </div>
		</div>
		<script>
	$(document).ready(function() {
	//var sitelink = "http://localhost/rr1.norvida.dk";
		var sitelink = "'. Yii::app()->request->baseUrl.'";
	$(\'#sendrequest\').on("click",function()
	{ //.click(function()
		var Message_senderName = $(\'#Message_senderName\').val();
		var Message_receiver_id = $(\'#popup_receiver_id\').val();
		
		$.post(sitelink+"/message/compose/Sendrequest", {sendername:Message_senderName,receiver_id: Message_receiver_id} , function(complete){
		//alert(data);
		$(".popup_block .popupbg").hide();
  		$(".popup_block .open_popup").hide();
		 $(".succes_msg").html("<p><strong>"+complete+"</strong></p>").show("slow");
					setTimeout(function() { $(".succes_msg").fadeOut("slow"); }, 30000);
			window.location.reload();
  		});
		
				
	});
	});
</script>';
			   break;
			   case 'buymember':
		$message= <<<EOT
		<div class="space center">
				<h1>Oups! You need to upgrade for this page…</h1>
				<h2>Get cool functions as chat, flirt\'s and e-mail, all online and integrated.</h2>
				<aside class="choose_block">
					<div class="choose first">
						<div class="block">
							<h4>$5</h4>
							<input type="hidden" class="price"  value="5.00" />
							<input type="hidden" class="duration"  value="1" />
							<span>1. month</span>
							<em></em>
						</div>
					</div>
					<div class="choose middle">
						<div class="block">
							<h4>$12</h4>
							<input type="hidden" class="price" value="12.00" />
							<input type="hidden" class="duration"  value="3" />
							<span>3. month</span>
							<em></em>
						</div>
					</div>
					<div class="choose last">
						<div class="block">
							<h4>$20</h4>
							<input type="hidden" class="price" value="20.00" />
							<input type="hidden" class="duration"  value="6" />
							<span>6. month</span>
							<em></em>
						</div>
					</div>
				</aside>
				 <form id="paypalform"  method="post">
				 <aside class="button_block">
					<input type="hidden" name="txtTotal" id="txtTotal" />
					<input type="hidden" name="txtDesc" id="txtDesc" />
					<button id="paynow" class="button2 paypal"><span>Pay With</span></button>
				</aside>
				</form>
			</div>
			<script>
			$(document).ready(function()
			{
				$("#paynow").live('click',function() {
				   var baseDir = "<?php echo Yii::app()->request->baseUrl;?>";
				  
	               if(($('#txtTotal').val()!='') && ($('#txtDesc').val()!=''))
				   {
					   $('#paypalform').attr('action','/user/paypal/buy');
				   	   $('#paypalform').submit();
				   }else
				   {
					   alert('Please select one membership type.');
				   }
		
    			});
				
			});
			</script>
EOT;
			   break;
                 case 'freemember':
		$message= <<<EOT
		<div class="space center">
				<h1>Oops! you are upgraded to Premium for free (1 month)</h1>
				<h2>Get cool functions as chat, flirt's and e-mail, all online and integrated.</h2>
				 <form id="freememberform"  method="post">
				 <aside class="button_block">
					<button id="freemembernow" class="button2"><span>Paid Member</span></button>
				</aside>
				</form>
			</div>
			<script>
			$(document).ready(function()
			{
				$('#freemembernow').live('click',function() {
				  var baseDir = "<?php echo Yii::app()->request->baseUrl;?>";
	            	   $('#freememberform').attr('action',baseDir+'/user/paypal/freemember');
				   	   $('#freememberform').submit();
				
    			});
				
			});
			</script>
EOT;
			   break;
		   }
	
				
			
		
			if (empty($errors)) {
				$return['success'] = true;
				$return['messages'] = $message;
			}
			else {
				$return['success'] = false;
				$return['errors'] = $errors;
			}
			echo CJSON::encode($return);
	}
}
?>