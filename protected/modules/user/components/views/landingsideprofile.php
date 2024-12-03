<section class="profile_pic">
                    	<aside class="pro_img">
                        	<div class="img_block">
                            <img src="<?php echo Yii::app()->request->baseUrl.'/'.$profilephoto; ?>" height="100px" />
                            </div>
                        </aside>
                        <aside class="pro_desc">
                        	<div class="block">
                                <h4><a href="#"><?php echo $sidemodel->getAttribute('username'); ?></a></h4>
                                <p><?php echo $sidemodel->profile->city; ?></p>
                                <p><?php echo $sidemodel->profile->residingcountry; ?></p>
                                <?php 
								 if($show_editbtn=='yes')
								 echo CHtml::link('<p class="greenbtn"><input type="button" name="editprofile" value="Edit Profile" /><em></em></p>',array('/user/profile/edit'),array());  ?>
								
                            </div>
                        </aside>
                    </section>
<?php
if($sidemodel->id == Yii::app()->user->getId())
{
?>
<section class="pro-edit">
<?php
  $image_source='<img src="'.Yii::app()->request->baseUrl.'/css/rajarani/images/edit_ico.png" style="no-repeat scroll 0 0 transparent" />';
 if($show_editbtn=='no')
 echo CHtml::link($image_source,array('/user/profile/edit'),array('class'=>'edit')); ?>
<h3><?php echo UserModule::t('Your profile:'); ?></h3>
                        <aside class="show_pro">
            
			<?php  if($sidemodel->profile->getAttribute('dob')!='0000-00-00'){  ?>
             <p><strong>Age:</strong> <span>
			<?php 
            if($sidemodel->profile->getAttribute('dob')!='0000-00-00')
            echo dateDiff(date('Y-m-d'), $sidemodel->profile->getAttribute('dob')); ?>
            </span></p>
            <?php
			}
			?>
            
            <?php if($sidemodel->profile->getAttribute('civilstatus')!=''){ ?>
             <p><strong>Status:</strong> <span><?php echo $sidemodel->profile->getAttribute('civilstatus'); ?></span></p>
             <?php } ?>
            <?php if($sidemodel->profile->getAttribute('havechildren')!=''){ ?>
             <p><strong>Children:</strong> <span><?php echo $sidemodel->profile->getAttribute('havechildren'); ?></span></p>
             <?php } ?>
            <?php if($sidemodel->profile->getAttribute('religion')!=''){ ?>
             <p><strong>Religion:</strong> <span><?php echo $sidemodel->profile->getAttribute('religion'); ?></span></p>
             <?php } ?>
             
                      
                       
                        	<?php if($sidemodel->profile->getAttribute('aboutme')!=''){ ?>
                             <p><strong><?php echo UserModule::t('Profile text:'); ?></strong>
                           
                            	<span class="dataBlock"><?php echo $sidemodel->profile->getAttribute('aboutme'); ?></span>
                                
                            </p>
                              <?php } ?>
             
                        </aside>
</section>               
<?php
}
?>
<section class="profile_pic">
<?php $this->widget('application.extensions.social.social', array(
    'style'=>'vertical', 
        'networks' => array(
        'facebook'=>array(
            'href'=>'https://www.facebook.com/rajaranidenmark', 
            'action'=>'like',//recommend, like
            'colorscheme'=>'light',
            'width'=>'140px',
            )
        )
));?>

</section>