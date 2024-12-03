   <?php
  if($loguserprofile['search_photo']=='0')
  {
	  $photostyle="active";
	  $leftpos='left: 15px;';
  }else
  {
  	  $photostyle=" ";
	   $leftpos=' ';
  }
   ?>
   
    <aside class="top_option">
					<div class="left_curve"></div>
					<div class="curve_body">
						<?php echo CHtml::beginForm(array('/user/profile/search/'),'get'); ?>
						<label class="bold">Quicksearch:</label>
                        
                      
							<div class="cam_body  <?php echo $photostyle; ?>">
								<em class="leftcam" title="With Photos"></em>
								<div class="drag_btn" id="drag"><em style="<?php echo $leftpos; ?>"></em></div>
								<em class="rightcam" title="Without Photos"></em>
                               <?php echo CHtml::hiddenField('profileimage',$loguserprofile['search_photo']); ?> 
							</div>							
<div class="genderstyle">
<?php


echo CHtml::dropDownList('gender',$loguserprofile['s_gender'],array('' => 'Search All','Male' =>'Male','Female' =>'Female'),array('value'=>'Male','class'=>'styled'));
?>
</div>
						<p class="textbox space"><input id="from_age"  name="from_age" type="text" value="<?php echo (isset($loguserprofile['e_minage']) && $loguserprofile['e_minage']!='')? $loguserprofile['e_minage'] :""; ?>" /></p>
							<label class="text">til</label>
							<p class="textbox"><input id="to_age"  name="to_age" type="text" value="<?php echo (isset($loguserprofile['e_minage']) && $loguserprofile['s_maxage']!='')? $loguserprofile['s_maxage'] :""; ?>" /></p>
                            <div class="countrystyle">
<?php
//country

$country = Country::model()->findAll(
                 array('order' => 'name'));
 
 $list = CHtml::listData($country,'name', 'name');
echo CHtml::dropDownList('country',$loguserprofile['s_country'], $list,array('class'=>'styled','empty' =>'Search All')); 
?>                            </div>
 							<p class="search_btn"><input type="submit" class="search_ico" value="" />
                            </p>
					<?php echo CHtml::endForm(); ?>
					</div><!-- form -->
					<div class="right_curve"></div>
				</aside>
    <script type="text/javascript">            
          $("#from_age,#to_age").bind("keyup paste", function(){
	    setTimeout(jQuery.proxy(function() {
	        this.val(this.val().replace(/[^0-9]/g, ''));
	    }, $(this)), 0);
	});      
</script>
