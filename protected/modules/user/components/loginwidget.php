<?php
class LoginWidget extends CWidget {

    public function run() {
        $model=new UserLogin;;

        $this->render('headerlogin', array(
            'model'=>$model   
        ));
    }
}

?>