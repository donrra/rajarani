<?php
class SideprofileWidget extends CWidget {
   
   
 private $_compmodel;
 public $show_editbtn;
   
    public function run() {
		
		$myprofile;
		yii::import('ext.models.*'); 
	    $sidemodel = $this->loadcompUser();
		$sideprofile=$sidemodel->profile;
		if(Yii::app()->user->id==$sidemodel->id)
		{
			$profilephoto=$sidemodel->profile->getAttribute('avatar');
			$myprofile='yes';
			$findme   = 'gallery';
			$pos = strpos($profilephoto, $findme);	
			if($pos!==false) 
			{
				$searchstr=substr($profilephoto,8);
				$imagearr=  GalleryPhoto::model()->findByAttributes(array('profile'=>$searchstr));
				if($imagearr)
				$profilephoto=$sidemodel->profile->getAttribute('avatar');
				else
				$profilephoto='user_avatar/thumb/default.jpg';
			}else
			{
				$profilephoto='user_avatar/thumb/default.jpg';
			}
		
			
		}else
		{
			 
			$myprofile='no';
			$mystring = $sidemodel->profile->getAttribute('avatar');
			$findme   = 'gallery';
			$pos = strpos($mystring, $findme);

			if($pos!==false) 
			{
				$searchstr=substr($mystring,8);
				// album pic as profile image
				$profileimageName=$sidemodel->profile->getAttribute('avatar');
			  $imagearr=  GalleryPhoto::model()->findByAttributes(array('profile'=>$searchstr));
			  
			
			//access level 1 => all
			// 2 => only friends 
			if($imagearr->accesslevel==1)
			 {
				// all to show
				$profilephoto=$sidemodel->profile->getAttribute('avatar');
			
			 }else
			 {
				 //only friends show
			 	$checkfriendsobj=UserFriends::model()->havefriends($sidemodel->id,Yii::app()->user->getId());
						if($checkfriendsobj[0]['isfriend']=='no')
						{
							$profilephoto='user_avatar/thumb/default.jpg';
						}else
						{
							$profilephoto=$sidemodel->profile->getAttribute('avatar');
						}
			 
			 }
			}else
			{
				//default pic as profile image
				 $profilephoto=$sidemodel->profile->getAttribute('avatar');
			}
		}
		//echo $this->show_editbtn;
        $this->render('sideprofile',array('sidemodel'=>$sidemodel,
			'sideprofile'=>$sideprofile,'profilephoto'=>$profilephoto,'myprofile'=>$myprofile,'show_editbtn'=>$this->show_editbtn));
    }
	
	public function loadcompUser()
	{
		if($this->_compmodel===null)
		{
			if(Yii::app()->user->id)
			{
				$this->_compmodel=Yii::app()->getModule('user')->user();
			}
			  if($this->_compmodel===null)
				$this->redirect(Yii::app()->getModule('user')->loginUrl);
		}
		return $this->_compmodel;
	}	
}
?>