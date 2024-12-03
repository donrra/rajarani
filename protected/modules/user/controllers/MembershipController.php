<?php
class MembershipController extends Controller
{
	
	public $defaultAction = 'index';
	public $layout='//layouts/subpage';
	public $seoKeywords;
	public $seoDescription;
	public function actionIndex()
	{
		
		if (Yii::app()->user->isGuest) {
			
		  $this->redirect(array("/user/login"));
		}else
		{
			$this->render('index');
		}
		
	}
	
}