<?php
/**
 * Widget to manage gallery.
 * Requires Twitter Bootstrap styles to work.
 *
 * @author Bogdan Savluk <savluk.bogdan@gmail.com>
 */
class GalleryManager extends CWidget
{
    /** @var Gallery Model of gallery to manage */
    public $gallery;
    /** @var string Route to gallery controller */
    public $controllerRoute = false;
    public $assets;
	public $page;

    public function init()
    {
        $this->assets = Yii::app()->getAssetManager()->publish(dirname(__FILE__) . '/assets');
    }


    public $htmlOptions = array();


    /** Render widget */
    public function run()
    {
		
		/*if(isset($_REQUEST['page']) && $_REQUEST['page']!='')
		{
			$page=$_REQUEST['page'];
		}else
		{
			$page=1;
		}*/
		
		
        /** @var $cs CClientScript */
        $cs = Yii::app()->clientScript;
        $cs->registerCssFile($this->assets . '/galleryManager.css');

        $cs->registerCoreScript('jquery');
        $cs->registerCoreScript('jquery.ui');

       // if (YII_DEBUG) {
            $cs->registerScriptFile($this->assets . '/jquery.iframe-transport.js');
            $cs->registerScriptFile($this->assets . '/jquery.galleryManager.js');
        /*} else {
            $cs->registerScriptFile($this->assets . '/jquery.iframe-transport.min.js');
            $cs->registerScriptFile($this->assets . '/jquery.galleryManager.min.js');
        }
*/
        if ($this->controllerRoute === null)
            throw new CException('$controllerRoute must be set.', 500);

        $opts = array(
            'hasName:' => $this->gallery->name ? true : false,
            'hasDesc:' => $this->gallery->description ? true : false,
            'uploadUrl' => Yii::app()->createUrl($this->controllerRoute . '/ajaxUpload', array('gallery_id' => $this->gallery->id)),
            'deleteUrl' => Yii::app()->createUrl($this->controllerRoute . '/delete'),
            'updateUrl' => Yii::app()->createUrl($this->controllerRoute . '/changeData'),
			 'translateUrl' => Yii::app()->createUrl($this->controllerRoute . '/getTranslatedText'),
			
			'updateRightsUrl' => Yii::app()->createUrl($this->controllerRoute . '/updateProfilephotorights'),
			'updateprofileUrl' => Yii::app()->createUrl($this->controllerRoute . '/changeProfilephoto'),
            'arrangeUrl' => Yii::app()->createUrl($this->controllerRoute . '/order'),
            'nameLabel' => Yii::t('galleryManager.main', 'Name'),
            'descriptionLabel' => Yii::t('galleryManager.main', 'Description'),
        );

        if (Yii::app()->request->enableCsrfValidation) {
            $opts['csrfTokenName'] = Yii::app()->request->csrfTokenName;
            $opts['csrfToken'] = Yii::app()->request->csrfToken;
        }
        $opts = CJavaScript::encode($opts);
        $src = "$('#{$this->id}').galleryManager({$opts});";
        $cs->registerScript('galleryManager#' . $this->id, $src);
        $model = new GalleryPhoto();

        $cls = "GalleryEditor ";
        if (!($this->gallery->name)) $cls .= 'no-name';

        if (!($this->gallery->description)) {
            $cls .= (($cls != ' ') ? '-' : '') . 'no-desc';
        }
        if (isset($this->htmlOptions['class']))
            $this->htmlOptions['class'] .= ' ' . $cls;
        else
            $this->htmlOptions['class'] = $cls;
        $this->htmlOptions['id'] = $this->id;
	
	
		
	//	$c = new CDbCriteria();
	//	$c->addCondition('t.user_id = :user_id');
	//	$c->params = array(
	//		'user_id' => Yii::app()->user->id,
	//		);
	//	$photoadapter = new CActiveDataProvider('GalleryPhoto', array('criteria' => $c));
		
	//   $pager = new CPagination($photoadapter->totalItemCount);
	//	$pager->pageSize = 4;
	//	$photoadapter->setPagination($pager);
	
		 $this->render('galleryManager', array('model' => $model,));	
	// $this->render('galleryManager', array('model' => $model,'photoadapter'=>$photoadapter));
    }

}
