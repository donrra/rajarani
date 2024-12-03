<?php
class ProfilesearchWidget extends CWidget {

    public function run() {
		$baseUrl = Yii::app()->baseUrl; 
		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile($baseUrl.'/js/custom-form-elements.js');
			
		$loguser = User::model()->notsafe()->findbyPk(Yii::app()->user->id);																		
		$loguserprofile=$loguser->profile;
		$loguserprofile->gender; 
		
		if($loguserprofile->gender=='')
			$search_gender='Search All';
		
		$search_photo ='1';
		$search_cpuntry=$loguserprofile->residingcountry;
		
		if($search_cpuntry=='')
			$search_cpuntry='Search All';
		else
			$search_cpuntry=$loguserprofile->residingcountry;
		
		$min_age=0;
		$max_age=0;
		
		if($loguserprofile->dob!=0000-00-00)
		{
			 $datediff= abs(strtotime($loguserprofile->dob)-time());
			 $loguserage=round($datediff/(60*60*24*365));
			 if($loguserprofile->gender=='Male')
			   {
			  		$search_gender='Female';	
					$min_age= $loguserage-15;
					$max_age= $loguserage+5;
				}
			 else
				{
					$search_gender='Male';
					$min_age= $loguserage-5;
					$max_age= $loguserage+15;
				}
		}else
		{
			$min_age= '';
			$max_age= '';
		
		}
		
		 if(isset(Yii::app()->session['s_gender']) || Yii::app()->session['s_gender']!='')
		 {
			$search_gender = Yii::app()->session['s_gender'];
		 }
		  if(isset(Yii::app()->session['e_minage']) && Yii::app()->session['e_minage']!='')
		 {
			$min_age = Yii::app()->session['e_minage'];
		 }
		  if(isset(Yii::app()->session['s_maxage']) && Yii::app()->session['s_maxage']!='')
		 {
			$max_age = Yii::app()->session['s_maxage'];
		 }
		  if(isset(Yii::app()->session['s_country']) || Yii::app()->session['s_country']!='')
		 {
			$search_cpuntry = Yii::app()->session['s_country'];
		 }
		 
		   if(isset(Yii::app()->session['s_profileimage']) && Yii::app()->session['s_profileimage']!='')
		 {
			$search_photo = Yii::app()->session['s_profileimage'];
		 }
		 
		 if($min_age<18)
		 $min_age=18;
		
		 $search_criteria=array('s_gender'=>$search_gender,'e_minage'=>$min_age,'s_maxage'=>$max_age,'s_country'=>$search_cpuntry,'search_photo'=>$search_photo);
	$this->render('profilesearch',array('loguserprofile'=>$search_criteria)); 
    }
}

?>