<?php
class ProfilesearchWidget extends CWidget {

    public function run() {
        $model=new User;
	$this->render('profilesearch',array(
	'model'=>$model,)); 
    }
}

?>