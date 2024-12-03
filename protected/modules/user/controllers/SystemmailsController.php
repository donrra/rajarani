<?php

class SystemMailsController extends Controller {
	
	public function SendActivationMail()
	{
				$mailer->Subject = Yii::t('Activate your account');
				$this->renderPartial('activation');
	}
	public function SendForgotPasswordMail()

	{
				$mailer->Subject = Yii::t('Password recovery');
				$this->renderPartial('forgotPassword');
	}
	public function SendMessageMail()
	{
				$mailer->Subject = Yii::t('New message');
				$this->renderPartial('message');
	}
	}