<?php
class PaypalController extends Controller
{
	public function actionUpgrade()
	{
				$this->layout='//layouts/subpage';  
	}
	public function actionFreemember()
	{
		    $membership=new UserMembership;
			$membership->user_id =Yii::app()->user->id;
			$membership->membe_fees = '0.00';
			$membership->duration = '1 month';
			$membership->token  = '';
			$membership->start_date  =date("Y-m-d H:i:s");
			
			$dateend_date = date("Y-m-d H:i:s",strtotime(date("Y-m-d", strtotime(date("Y-m-d H:i:s"))) . "+1 month"));
			
			$membership->end_date  =$dateend_date;
			$membership->status ='success';
			if($membership->save(false))
			{
				Yii::app()->user->setFlash('Premiummessage',UserModule::t("<div class='succes_msg'><p>Premium for free (1 month) updated successfully.</div>"));	
			$command_table=Yii::app()->db->createCommand("UPDATE `authassignment` SET `itemname`='PM' where `userid`='".Yii::app()->user->id."'");
            $command_table->execute();		
			$this->redirect('/user/profile/settings'); 	
		
			}else
			{
				die('Error::');
			}
			
	}
	
	public function actionBuy(){
         
		// set //361274695
		$paymentInfo['Order']['theTotal'] = $_POST['txtTotal'];
		$paymentInfo['Order']['description'] = $_POST['txtDesc'];
		$paymentInfo['Order']['quantity'] = '1';
		$_SESSION['theTotal']=$paymentInfo['Order']['theTotal'];

		// call paypal 
		$result = Yii::app()->Paypal->SetExpressCheckout($paymentInfo); 
		//Detect Errors 
		if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
			if(Yii::app()->Paypal->apiLive === true){
				//Live mode basic error message
				$error = 'We were unable to process your request. Please try again later';
			}else{
				//Sandbox output the actual error message to dive in.
				$error = $result['L_LONGMESSAGE0'];
			}
			echo $error;
			Yii::app()->end();
			
		}else { 
			// send user to paypal 
			$token = urldecode($result["TOKEN"]); 
		
		
		
			$membership=new UserMembership;
			$membership->user_id =Yii::app()->user->id;
			$membership->membe_fees = $paymentInfo['Order']['theTotal'];
			$membership->duration = $paymentInfo['Order']['description'].' month';
			$membership->token  = $result["TOKEN"];
			$membership->start_date  =date("Y-m-d H:i:s");
			
			$dateend_date = date("Y-m-d H:i:s",strtotime(date("Y-m-d", strtotime(date("Y-m-d H:i:s"))) . "+".$paymentInfo['Order']['description']." month"));
			
			$membership->end_date  =$dateend_date;
			$membership->status ='pending';
			
			if($membership->save())
			{
				$payPalURL = Yii::app()->Paypal->paypalUrl.$token; 
		    	$this->redirect($payPalURL); 
		   }		
		}
	}

	public function actionConfirm()
	{
		$this->layout='//layouts/subpage';     
		$token = trim($_GET['token']);
		$payerId = trim($_GET['PayerID']);
		
		$result = Yii::app()->Paypal->GetExpressCheckoutDetails($token);
		
		$result['PAYERID'] = $payerId; 
		$result['TOKEN'] = $token; 
		$result['ORDERTOTAL'] = $_SESSION['theTotal'];
		$_SESSION['theTotal']=0.00;

		//Detect errors 
		if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
			if(Yii::app()->Paypal->apiLive === true){
				//Live mode basic error message
				$error = 'We were unable to process your request. Please try again later';
			}else{
				//Sandbox output the actual error message to dive in.
				$error = $result['L_LONGMESSAGE0'];
			}
			echo $error;
			Yii::app()->end();
		}else{ 
			
			$paymentResult = Yii::app()->Paypal->DoExpressCheckoutPayment($result);
			//Detect errors  
			if(!Yii::app()->Paypal->isCallSucceeded($paymentResult)){
				if(Yii::app()->Paypal->apiLive === true){
					//Live mode basic error message
					$error = 'We were unable to process your request. Please try again later';
				}else{
					//Sandbox output the actual error message to dive in.
					$error = $paymentResult['L_LONGMESSAGE0'];
				}
				echo $error;
				Yii::app()->end();
			}else{
				//payment was completed successfully
				$Membershipmodel=UserMembership::model()->findByAttributes(array('token'=>$result['TOKEN']));
				$Membershipmodel->status ='success';
				$Membershipmodel->save();
				
				$command_table=Yii::app()->db->createCommand("UPDATE `authassignment` SET `itemname`='PM' where `userid`='".Yii::app()->user->id."'");
                    $command_table->execute();	
			
					
				$this->render('confirm');
			}
			
		}
	}
        
    public function actionCancel()
	{
		 $this->layout='//layouts/subpage';     
		//The token of the cancelled payment typically used to cancel the payment within your application
		$token = $_GET['token'];
		
		$this->render('cancel');
	}
	
	public function actionDirectPayment(){ 
		$paymentInfo = array('Member'=> 
			array( 
				'first_name'=>'name_here', 
				'last_name'=>'lastName_here', 
				'billing_address'=>'address_here', 
				'billing_address2'=>'address2_here', 
				'billing_country'=>'country_here', 
				'billing_city'=>'city_here', 
				'billing_state'=>'state_here', 
				'billing_zip'=>'zip_here' 
			), 
			'CreditCard'=> 
			array( 
				'card_number'=>'number_here', 
				'expiration_month'=>'month_here', 
				'expiration_year'=>'year_here', 
				'cv_code'=>'code_here' 
			), 
			'Order'=> 
			array('theTotal'=>1.00) 
		); 

	   /* 
		* On Success, $result contains [AMT] [CURRENCYCODE] [AVSCODE] [CVV2MATCH]  
		* [TRANSACTIONID] [TIMESTAMP] [CORRELATIONID] [ACK] [VERSION] [BUILD] 
		*  
		* On Fail, $ result contains [AMT] [CURRENCYCODE] [TIMESTAMP] [CORRELATIONID]  
		* [ACK] [VERSION] [BUILD] [L_ERRORCODE0] [L_SHORTMESSAGE0] [L_LONGMESSAGE0]  
		* [L_SEVERITYCODE0]  
		*/ 
	  
		$result = Yii::app()->Paypal->DoDirectPayment($paymentInfo); 
		
		//Detect Errors 
		if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
			if(Yii::app()->Paypal->apiLive === true){
				//Live mode basic error message
				$error = 'We were unable to process your request. Please try again later';
			}else{
				//Sandbox output the actual error message to dive in.
				$error = $result['L_LONGMESSAGE0'];
			}
			echo $error;
			
		}else { 
			//Payment was completed successfully, do the rest of your stuff
		}

		Yii::app()->end();
	} 
}