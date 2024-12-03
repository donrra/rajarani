<?php
class PopupWidget extends CWidget {
   
   
 private $_compmodel;
  public $model=NULL;  
    public function run() {
	    $this->render('popup',array('model' => $this->model));
    }
	
}

?>