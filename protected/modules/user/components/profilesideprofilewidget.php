<?php
class ProfilesideprofileWidget extends CWidget {
   
   
 private $_compmodel;
 public $show_editbtn;

    public function run() {
		$sidemodel = User::model()->find('username=:username', array(':username'=>$_REQUEST['id']));
		$myprofile;
		
		
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
				$profilephoto=$sidemodel->profile->avatar;
				else
				$profilephoto='user_avatar/thumb/default.jpg';
			}else
			{
				$profilephoto='user_avatar/thumb/default.jpg';
			}
				
		}else
		{
			$myprofile='no';
			$mystring = $sidemodel->profile->avatar;
			$findme   = 'gallery';
			$pos = strpos($mystring, $findme);

			if($pos!==false) 
			{
				$searchstr=substr($mystring,8);
				// album pic as profile image
				$profileimageName=$sidemodel->profile->avatar;
			  $imagearr=  GalleryPhoto::model()->findByAttributes(array('profile'=>$searchstr));
			//access level 1 => all
			// 2 => only friends 
			if($imagearr->accesslevel==1)
			 {
				// all to show
				$profilephoto=$sidemodel->profile->avatar;
			 }else
			 {
				 //only friends show
			 	$checkfriendsobj=UserFriends::model()->havefriends($sidemodel->id,Yii::app()->user->getId());
						if($checkfriendsobj[0]['isfriend']=='no')
						{
							$profilephoto='user_avatar/thumb/default.jpg';
						}else
						{
							$profilephoto=$sidemodel->profile->avatar;
						}
			 }
			}else
			{
				//default pic as profile image
				 $profilephoto=$sidemodel->profile->avatar;
			}
		}
		
		$sideprofile=$sidemodel->profile;
        $this->render('sideprofile',array('sidemodel'=>$sidemodel,'sideprofile'=>$sideprofile,'profilephoto'=>$profilephoto,'myprofile'=>$myprofile,'show_editbtn'=>$this->show_editbtn));
    }
}

?>