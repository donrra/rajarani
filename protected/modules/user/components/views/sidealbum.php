<?php
$baseUrl = Yii::app()->baseUrl; 
$js = Yii::app()->getClientScript();
$js->registerScriptFile($baseUrl.'/js/jquery.lightbox.js');
$js->registerCssFile($baseUrl.'/css/lightbox.css');
?>
		<script>
$(document).ready(function(){
	$(".lightbox").lightbox({
		fitToScreen: true,
		imageClickClose: false
	});
});
</script>
<?php
switch($phototype)
{
	case 'own':
	$conditionarr=array('condition'=>'user_id='.$photouser_id);
	break;
	case 'aproved':
	$conditionarr=array('condition'=>'user_id='.$photouser_id);
	break;
	case 'all':
	$conditionarr=array('condition'=>'accesslevel=1 AND user_id='.$photouser_id);
	break;
}
?>
<section class="images_list">
	<ul>
<?php
  if(count($this->gallery->galleryPhotos($conditionarr))>0)
           foreach ($this->gallery->galleryPhotos($conditionarr) as $photo): ?>
          	      	<li>
						 <div class="block">
 						<a class="lightbox" href="<?php echo $photo->getOriginal(); ?>">
							<img style="position:absolute" src="<?php echo $photo->getSideview();?>" />
						</a>
                            <div class="options">
                                <div class="top"><a href="#" class="edit_pro"></a></div>
                                <div class="bottom">
                                   <!-- <h5>Foldername</h5>-->
                                    <p>
                                        <span class="left"><a href="#" class="talk_w"></a><a href="#" class="flirt_w"></a></span>
                                        <span class="right">(23.10.12)</span>
                                    </p>
                                </div>
                            </div>
                        </div>
					</li>
			<?php endforeach;?>

		</ul>
</section>