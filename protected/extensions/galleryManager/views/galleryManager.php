<?php
/**
 * @var $this GalleryManager
 * @var $model GalleryPhoto
 *
 * @author Bogdan Savluk <savluk.bogdan@gmail.com>
 */
?>
<script>
$(document).ready(function(){
	$('.images').live("change",function(){
		
	})
})
</script>
<?php 
// echo UserModule::t('Lifestyle'); 
echo CHtml::openTag('div',$this->htmlOptions);?>
    <div class="gform">
           <span class="btn btn-success fileinput-button">
            <i class="icon-plus icon-white"></i>
            <?php echo UserModule::t('Add images…');//echo Yii::t('galleryManager.main', 'Add images…');?>
            <?php echo CHtml::activeFileField($model, 'image', array('class' => 'afile', 'accept' => "image/*", 'multiple' => 'true'));?>
        </span>
		<!--<span class="btn disabled edit_selected"><?php  echo UserModule::t('Edit selected');//echo Yii::t('galleryManager.main', 'Edit selected');?></span>-->
        <span class="btn disabled remove_selected"><?php echo UserModule::t('Remove selected');;//echo Yii::t('galleryManager.main', 'Remove selected');?></span>

        <label for="select_all_<?php echo $this->id?>" class="btn">
            <input type="checkbox" style="margin-bottom: 4px;"
                   id="select_all_<?php echo $this->id?>"
                   class="select_all"/>
            <?php echo UserModule::t('Select all');;//echo Yii::t('galleryManager.main', 'Select all');?>
        </label>
        <span class="btn disabled profile_selected"><?php echo UserModule::t('Set as my default photo');?></span>

        <!--  progress bar-->
            <div class="progress_bar" style="display:none;">
            <div class="complite" style="width:0%;"></div>
            <div class="progress_bg"></div>
            </div>
      <!-- <div style="display: inline-block; vertical-align: middle;">
            <div class="progress progress-success" style="width:200px; height: 20px; margin-bottom: 0;">
                <div class="bar" style="width: 10%;  height: 20px"></div>
            </div>
        </div> -->
        <?php
        echo CHtml::hiddenField('returnUrl', Yii::app()->getRequest()->getUrl() . '#' . $this->id);
        ?>
    </div>
    <hr/>
    <div class="sorter">
        <div class="images">
        
            <?php 
	//	echo "<pre>";print_r($this->gallery->attributes);
		//	print_r($this->gallery->galleryPhotos);
			//foreach ($this->gallery->galleryPhotos as $photo): ?>
            
           <?php
		    //echo count($this->gallery->galleryPhotosbyuser);
			//if(count($this->gallery->galleryPhotosbyuser)>0)
			
		//	print_r($photoadapter);
		?>
            
			 <?php
		//	 echo "asaaaaaaaaaaaaaa";
         //   print_r($this->gallery->galleryPhotosbyuser); 
		   if(count($this->gallery->galleryPhotosbyuser)>0)
           foreach ($this->gallery->galleryPhotosbyuser as $photo): ?>
           
          	<div id="<?php echo $this->id . '-' . $photo->id ?>" class="photo">
            	
                <span class="rightsalert" id="alert_<?php echo $photo->id;?>"></span>
                <div class="image-preview">
                   <a class="lightbox" href="<?php echo $photo->getOriginal(); ?>"><?php echo CHtml::image($photo->getPreview()); ?></a>
                </div>
                <div class="caption" style="display:none;">
                    <?php if ($this->gallery->name): ?>
                    <h5><?php echo $photo->name ?></h5>
                    <?php endif;?>
                    <?php if ($this->gallery->description): ?>
                    <p><?php echo $photo->description ?></p>
                    <?php endif;?>
                </div>
                <div class="caption">
                    <h5>Visible to:<?php //echo $photo->name ?></h5>
                    <?php
					if($photo->accesslevel==1)
					{
						$allcheck='checked="checked"';
						$onlycheck=' ';
					}else
					{
						$allcheck=' ';
						$onlycheck='checked="checked"';
					}
					?>
					<ul class="bullet_radio">
					<li><input type="radio" name="<?php echo $photo->id; ?>" <?php echo $allcheck;  ?>  value="1" /><span>All</span></li>
                    <li><input type="radio" name="<?php echo $photo->id; ?>" <?php echo $onlycheck;  ?> value="2" /><span>Only approved profiles</span></li>
                    </ul>
                </div>
                
                <div class="actions">
                    <?php
                    echo CHtml::hiddenField('order[' . $photo->id . ']', $photo->rank);
                    if ($this->gallery->name || $this->gallery->description)
                     {
				 //   echo '<span data-photo-id="' . $photo->id . '" class="editPhoto btn btn-primary"><i class="icon-edit icon-white"></i></span>';
                    	}echo ' <span data-photo-id="' . $photo->id . '" class="deletePhoto btn btn-danger"><i class="icon-remove icon-white"  title="' .UserModule::t('Delete Image'). '"></i></span>';		
                    ?>
                </div>
                <input type="checkbox" class="photo-select"/>
            </div>
			<?php endforeach;?>
        </div>
        <br style="clear: both;"/>
    </div>

    <div class="modal hide editor-modal"> <!-- fade removed because of opera -->
        <div class="modal-header">
            <a class="close" data-dismiss="modal">×</a>

            <h3><?php echo UserModule::t('Edit information')?></h3>
        </div>
        <div class="modal-body">
            <div class="form"></div>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary save-changes">
                <?php echo UserModule::t('Save changes');?>
            </a>
            <a href="#" class="btn" data-dismiss="modal"><?php echo UserModule::t('Close');?></a>
        </div>
    </div>
<?php echo CHtml::closeTag('div');?>
