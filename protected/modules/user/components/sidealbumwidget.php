<?php
class SidealbumWidget extends CWidget {
   
  public $model=NULL;
   public $gallery=NULL;  
   public $phototype='all';
    public function run() {

		$this->gallery = Gallery::model()->findByPk(1);
	
	 
						
		if($this->model->id==Yii::app()->user->id)
		{
		$phototype='own';	// viewer is woner of the album
		
		}else
		{
			//need to check viewer is friends not 
		$checkfriendsobj=UserFriends::model()->havefriends(Yii::app()->user->getId(),$this->model->id);
		if($checkfriendsobj[0]['isfriend']=='yes')
		{
		$phototype="aproved";
		}else
		{
		$phototype='all';	
		}
		}
		
	    $this->render('sidealbum',array('sidegallery'=>$this->gallery,'phototype'=>$phototype,'photouser_id'=>$this->model->id));
    }
	
}

?>