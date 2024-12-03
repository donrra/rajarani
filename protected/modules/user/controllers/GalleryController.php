<?php
/**
 * Backend controller for GalleryManager widget.
 * Provides following features:
 *  - Image removal
 *  - Image upload/Multiple upload
 *  - Arrange images in gallery
 *  - Changing name/description associated with image
 *
 * @author Bogdan Savluk <savluk.bogdan@gmail.com>
 */

class GalleryController extends CController
{
    /**
     * Removes image with id specified in post request.
     * On success returns 'OK'
     */
    public function actionDelete()
    {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $id = $_POST['id'];
            /** @var $photo GalleryPhoto */
            $photo = GalleryPhoto::model()->findByPk($id);
            if ($photo !== null && $photo->delete()) echo 'OK';
            else echo 'FAIL';
        } else echo 'FAIL';
    }

    /**
     * Method to handle file upload thought XHR2
     * On success returns JSON object with image info.
     * @param $gallery_id string Gallery Id to upload images
     * @throws CHttpException
     */
    public function actionAjaxUpload($gallery_id = null)
    {
        if (Yii::app()->getRequest()->getIsPostRequest()) {

            $model = new GalleryPhoto();
            $model->gallery_id = $gallery_id;
            if (isset($_POST['GalleryPhoto']))
                $model->attributes = $_POST['GalleryPhoto'];

            $imageFile = CUploadedFile::getInstance($model, 'image');
            $model->file_name = $imageFile->getName();
			 $model->user_id = Yii::app()->user->id;
           try
		   {   
			$model->setImage($imageFile->getTempName());
		   
			if($model->save())
			{
				$photo=Yii::app()->db->createCommand("select * from gallery_photo where user_id='".Yii::app()->user->getId()."'")->queryAll();
				if(count($photo)==1)
				{
					 $userpro = User::model()->notsafe()->findByPk(Yii::app()->user->id);
					 $userprofile= $userpro->profile;
					 $userprofile->avatar ='gallery/'.$photo[0]['profile'];
					 $userprofile->save(false);
				}
			}
			 
			header("Content-Type: application/json");
            echo CJSON::encode(
                array(
                    'id' => $model->id,
                    'rank' => $model->rank,
                    'name' => (string)$model->name, //todo: something wrong with model - it returns null, but it must return an empty string
                    'description' => (string)$model->description,
                    'preview' => $model->getPreview(),
					'original' => $model->getOriginal(),
                ));
			}catch(Exception $e)
		   {
			   header("Content-Type: application/json");
           		echo CJSON::encode(
                array(
                    'id' => 'xx',
                    'rank' => 'xx',
                    'name' => 'xx', //todo: something wrong with model - it returns null, but it must return an empty string
                    'description' => (string)$e->getMessage(),
                    'preview' => 'xx',
					'original' => 'xx',
                ));
			   }	
				
        } else throw new CHttpException(403);
    }

    /**
     * Saves images order according to request.
     * Variable $_POST['order'] - new arrange of image ids, to be saved
     * @throws CHttpException
     */
    public function actionOrder()
    {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $gp = $_POST['order'];
            $orders = array();
            $i = 0;
            foreach ($gp as $k => $v) {
                if (!$v) $gp[$k] = $k;
                $orders[] = $gp[$k];
                $i++;
            }
            sort($orders);
            $i = 0;
            foreach ($gp as $k => $v) {
                /** @var $p GalleryPhoto */
                $p = GalleryPhoto::model()->findByPk($k);
                $p->rank = $orders[$i];
                $p->save(false);
                $i++;
            }
            if ($_POST['ajax'] == true) {
                echo CJSON::encode(array('result' => 'ok'));
            } else {
                $this->redirect($_POST['returnUrl']);
            }
        } else
            throw new CHttpException(403);
    }


	public function actionupdateProfilephotorights()
	{
		
		 if (Yii::app()->getRequest()->getIsPostRequest()) {
			 
		   $id = $_POST['photoid'];
		   $accesslevel = $_POST['accesslevel'];
		   $photo = GalleryPhoto::model()->findByPk($id);
		  $photo->accesslevel=$accesslevel;		  
		  if($photo->save())
		  {
			   echo  UserModule::t('Rights update successfuly.');;
		  }else
		  {
			   echo  UserModule::t('Rights update failed.');;
		  }
		 }
		 
	}

	 public function actionchangeProfilephoto()
	   {
		     if (Yii::app()->getRequest()->getIsPostRequest()) {
            $id = $_POST['id'];
            /** @var $photo GalleryPhoto */
            $photo = GalleryPhoto::model()->findByPk($id);
            $userpro = User::model()->notsafe()->findByPk(Yii::app()->user->id);
			$userprofile= $userpro->profile;
			$userprofile->avatar ='gallery/'.$photo->profile;
			if($userprofile->save(false)) echo 'OK';
			else echo 'FAIL';
        } else echo 'FAIL';
	   }
	   
	 public function actiongetTranslatedText()
	 {
		 if (Yii::app()->getRequest()->getIsPostRequest()) {
            $tmpconformtxt = $_POST['tmpconformtxt'];
			 echo UserModule::t($tmpconformtxt);
	 	} else
            throw new CHttpException(403);
	 }
	   
    /**
     * Method to update images name/description via AJAX.
     * On success returns JSON array od objects with new image info.
     * @throws CHttpException
     */
    public function actionChangeData()
    {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $data = $_POST['photo'];
            $criteria = new CDbCriteria();
            $criteria->index = 'id';
            $criteria->addInCondition('id', array_keys($data));
            /** @var $models GalleryPhoto[] */
            $models = GalleryPhoto::model()->findAll($criteria);
            foreach ($data as $id => $attributes) {
                if (isset($attributes['name']))
                    $models[$id]->name = $attributes['name'];
                if (isset($attributes['description']))
                    $models[$id]->description = $attributes['description'];
                $models[$id]->save();
            }
            $resp = array();
            foreach ($models as $model) {
                $resp[] = array(
                    'id' => $model->id,
                    'rank' => $model->rank,
                    'name' => (string)$model->name, //todo: something wrong with model - it returns null, but it must return an empty string
                    'description' => (string)$model->description,
                    'preview' => $model->getPreview(),
                );
            }
            echo CJSON::encode($resp);
        } else
            throw new CHttpException(403);
    }
	public function actionProcess()
	{
		$comment = $_POST['comment'];
		if ($_POST) $post=1;
		if (!$comment) $errors[count($errors)] = 'Please enter your comment.'; 
		if (!$errors) {

	//recipient
	$to = 'Raheel Raja<raheel@norvida.com>';	
	//sender
	$mail_user=Yii::app()->db->createCommand("select * from  users where id='".Yii::app()->user->getId()."'")->queryRow();
		$command_table=Yii::app()->db->createCommand("INSERT INTO `comment` (name,comment ) VALUES
('".$mail_user['username']."', '".$_POST['comment']."')");
        $command_table->execute();
	
	
	
	$from = $mail_user['username'] . ' <' . $mail_user['email'] . '>';
	
	//subject and the html message
	$subject = 'Comment from ' . $mail_user['username'];	
	$message = '
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head></head>
	<body>
	<table>
		<tr><td>Name</td><td>' . $mail_user['username'] . '</td></tr>
		<tr><td>Comment</td><td>' . nl2br($comment) . '</td></tr>
	</table>
	</body>
	</html>';

	//send the mail
	$result = $this->sendmail($to, $subject, $message, $from);
	if ($_POST) {
		if ($result) 
		{
			echo 'Thank you! We have received your message.';
		}else{
			 echo 'Sorry, unexpected error. Please try again later';
		}
	//else if GET was used, return the boolean value so that 
	//ajax script can react accordingly
	//1 means success, 0 means failed
	} else {
		echo $result;	
	}

//if the errors array has values
} else {
			//display the errors message
			for ($i=0; $i<count($errors); $i++) echo $errors[$i] . '<br/>';
			exit;
		}
	}
	
function sendmail($to, $subject, $message, $from)
 {
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	$headers .= 'From: ' . $from . "\r\n";
	$result = mail($to,$subject,$message,$headers);

	if ($result) return 1;
	else return 0;
 }
}
