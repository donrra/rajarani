<?php
class SideprofileWidget extends CWidget {
   
   
 private $_compmodel;
   
    public function run() {
		
	    $sidemodel = $this->loadcompUser();
		$sideprofile=$sidemodel->profile;
        $this->render('sideprofile',array('sidemodel'=>$sidemodel,
			'sideprofile'=>$sideprofile));
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