<?php
class LandingsideprofileWidget extends CWidget {
   
   
 private $_compmodel;
 public $show_editbtn;
   
    public function run() {
	    $sidemodel = $this->loadcompUser();
		$sideprofile=$sidemodel->profile;
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
        $this->render('landingsideprofile',array('sidemodel'=>$sidemodel,
			'sideprofile'=>$sideprofile,'profilephoto'=>$profilephoto,'show_editbtn'=>$this->show_editbtn));
    }
	
	public function loadcompUser()
	{
		if($this->_compmodel===null)
		{
			if(Yii::app()->user->id)
			$this->_compmodel=Yii::app()->getModule('user')->user();
	          if($this->_compmodel===null)
				$this->redirect(Yii::app()->getModule('user')->loginUrl);
		}
		return $this->_compmodel;
	}
}

?>