<script type="text/javascript">
$(document).ready(function() {
	
	//if submit button is clicked
	$('#submit').click(function () {		
		var urlbaseDir = "<?php echo Yii::app()->request->baseUrl;?>";
		var comment = $('textarea[name=comment]');
		if (comment.val()=='') {
			comment.addClass('hightlight');
			return false;
		} else comment.removeClass('hightlight');
		
		//organize the data properly
		var data =  'comment='  + encodeURIComponent(comment.val());
		
		//disabled all the text fields
		$('.text').attr('disabled','true');
		
		//show the loading sign
		$('.loading').show();
		
		//start the ajax
		$.ajax({
			//this is the php file that processes the data and send mail
			url: urlbaseDir + '/user/profile/process',	
			 
			//GET method is used
			type: "POST",

			//pass the data			
			data: data,		
			
			//Do not cache the page
			cache: false,
			
			//success
			success: function (html) {				
					$('.form').fadeOut('slow');					
					$('.done').fadeIn('slow');
			}		
		});
		
		//cancel the submit button default behaviours
		return false;
	});	
});	
</script>

    <article class="container">
	 	<em class="shadow_1"></em>
	 	<div class="wrapper">
   			<div class="white_body">			
                <div class="left_container">
                <section class="content_block2">
                 <aside class="forms_block">
                <?php echo CHtml::beginForm($action='', $method='post',$htmlOptions=array('id'=>'userpro_form','class'=>"formfields")); ?>                  
                <fieldset>
                    <div id="resultmsg">
                    <?php if(Yii::app()->user->hasFlash('Premiummessage')){ ?>
            			 <p><strong><?php echo Yii::app()->user->getFlash('Premiummessage'); }?></strong>
                    </div>
                <div class="row even"> 
	                 <?php  echo CHtml::activeLabel($usermodel,'username',array('class'=>' ')); ?>
                     <div class="selectfield">
                     <?php echo CHtml::activeTextField($usermodel,'username',array('readonly'=>true,'class'=>'textbox2')); ?>
                     </div>
                 </div>
 				<div class="row odd"> 
	                 <?php  echo CHtml::activeLabel($usermodel,'email',array('class'=>' ')); ?>
                     <div class="selectfield">
                     <?php echo CHtml::activeTextField($usermodel,'email',array('class'=>'textbox2')); ?>
                     </div>
                </div>
             	<div class="row even"> 
	                 <?php  echo CHtml::activeLabel($usermodel,'password',array('class'=>'')); ?>
                     <div class="selectfield">
                     <?php echo CHtml::activePasswordField($usermodel,'password',array('class'=>'textbox2','value'=>'')); ?>
                     </div>
                </div>
                <div class="row odd">
                    <?php  echo CHtml::activeLabel($usermodel,'verifyPassword',array('class'=>'','value'=>'')); ?>
                    <?php echo CHtml::activePasswordField($usermodel,'verifyPassword',array('size'=>20,'maxlength'=>20,
                    'class'=>'textbox2','value'=>'')); ?>
               </div>
               <?php
				$profileFields=$profilemodel->getFields();
				$checkfields=array('msg_receivemessage','msg_receivefavorit');
			   
			   ?>
               <?php 
                 $divtav1=1;
              	if ($profileFields) {
                                foreach($profileFields as $field) {
							if($divtav1%2==0){ $divrowclass='odd'; }else{ $divrowclass='even'; }		
									
                               if(!in_array($field->varname,$checkfields))
                               {
							   continue;
							   }else
							   {
								   if($field->field_type=='DATE')
									{
									$tmpdata =explode('-',$profilemodel[$field->varname]);
									$fieldvalue = $tmpdata[2].'-'.$tmpdata[1].'-'.$tmpdata[0];
									$profilemodel[$field->varname] = $fieldvalue ;
									}
							   }
                            ?>
                        
                            <div class="row  <?php echo $divrowclass;?>">
                            <?php 
							if(trim(strtolower($field->optiontype))=='checkbox')
							{
								echo CHtml::activeLabel($profilemodel,$field->varname,array('class'=>'normal'));
							}else
							{
								echo CHtml::activeLabel($profilemodel,$field->varname,array('class'=>''));
							}
							if ($widgetEdit = $field->widgetEdit($profilemodel,array('class'=>'textbox2'))) {
                                echo $widgetEdit;
                                    } elseif ($field->range) {
                                
                                 if($field->optiontype!= '' && strtolower($field->optiontype)=='checkbox')
                                  {
                                    if(!is_array($profilemodel[$field->varname])) 
                                    $selected_arr=explode(',',$profilemodel[$field->varname]);
                                    $profilemodel[$field->varname]=array();
                                    foreach($selected_arr as $key1=>$vall1)
                                    {
                                    $selected_arr1[$vall1]=$vall1;
                                    }
                                    $profilemodel[$field->varname]=$selected_arr1;
                                 }	
                           
						   	
							    if(strtolower($field->optiontype)=='radio')
                                {
								
					   echo '<div class="radiofields radiofields1">'.CHtml::activeRadioButtonList($profilemodel,$field->varname,Profile::range($field->range),$htmlOptions = array('separator'=>'')).'</div>';
							   }elseif(strtolower($field->optiontype)=='select')
                                {
									$fieldvalues=Profile::range($field->range);
										foreach ($fieldvalues as $key => $value) {
											if (empty($value)) {
											unset($fieldvalues[$key]);
											}
										}
			echo '<div class="selectfield">'.CHtml::activeDropDownList($profilemodel,$field->varname,$fieldvalues,array('class'=>'styled')).'</div>';
								}elseif(trim(strtolower($field->optiontype))=='checkbox')
                                {
									
						echo '<div class="checkboxes">'.CHtml::activeCheckBoxList($profilemodel,$field->varname,Profile::range($field->range)).'</div>';
  
 								}else
                                {
									$fieldvalues=Profile::range($field->range);
										foreach ($fieldvalues as $key => $value) {
											if (empty($value)) {
											unset($fieldvalues[$key]);
											}
										}
										echo '<div class="selectfield">'.CHtml::activeDropDownList($profilemodel,$field->varname,$fieldvalues,array('class'=>'styled')).'</div>';
								}
                                        } elseif ($field->field_type=="TEXT") {
                                            echo CHtml::activeTextArea($profilemodel,$field->varname,array('rows'=>6, 'cols'=>50,'class'=>'txtara'));
                                            } else {
												
                                         echo CHtml::activeTextField($profilemodel,$field->varname,array('class'=>'textbox2','size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
                                                } echo Chtml::error($profilemodel,$field->varname); ?>
                            </div>
                        
                            <?php
                           $divtav1++; }
                            }
              ?>

                    </fieldset>
               <?php echo CHtml::endForm(); ?>
                 
                 </aside>
                </section>    
      
               
               <section class="content_block2">
                 <aside class="forms_block">
                 <?php $form=$this->beginWidget('CActiveForm', array(
                                'id'=>'settings-form',
                                'enableAjaxValidation'=>true,
                                'clientOptions'=>array(
                                    'validateOnSubmit'=>true,
                                    ),
                                'htmlOptions' => array('enctype'=>'multipart/form-data','class'=>'formfields')
                                )); 
                                ?>                       
                <fieldset>
 
                <div class="row even"> 
                 <?php  echo $form->labelEx($model,'language',array('class'=>' ')); ?>
                 <div class="selectfield">
				 <?php
				 $data= array ('en' => 'English', 'dk' => 'Danish', 'se'=>'Swedish','no' => 'Norwegian'/**/ ); 
				   echo $form->dropDownList($model,'language',$data,array('class'=>'styled'));
				   ?>
                   <div class="updateblock">
                      <span class="greenbtn">
                    </span>
                   
                   </div>
                  
                   </div>
                   
                   
                 </div> 
                 <div class="row submit">
                    <p class="greenbtn">
               <?php echo CHtml::button('Update Profile',array('id'=>'updateprodetails')); ?>
                 <em></em></p>
					</div>
                    </fieldset>
                  <?php $this->endWidget(); ?>
                 
                 </aside>
                </section>
               
               <section class="content_block2">
                 <aside class="forms_block">
                  <form class="formfields"> 
                  <fieldset>
 				 <div class="row even"> 
                 <label for="UserSettings_language" class="  required">Membership:</label>
                 <div class="selectfield">
				 <span class="membership_span">
                 <?php
				  $arrayAuthRoleItems = Yii::app()->authManager->getAuthItems(2, Yii::app()->user->getId());
                 $arrayKeys = array_keys($arrayAuthRoleItems);//       print_r( $arrayKeys);
                 $role = strtolower ($arrayKeys[0]);
				 
						 switch($role)
							{
								case 'sm':
								echo "Standard Member"; 
								break;
								case 'pm':
								echo "Paid Member";
								break;
								default:
								echo "Standard Member";
								break;
							}
				 ?>
                 </span>
                 <span class="upgrade_span">
                 <?php
				 $arrayAuthRoleItems = Yii::app()->authManager->getAuthItems(2, Yii::app()->user->getId());
                 $arrayKeys = array_keys($arrayAuthRoleItems);//       print_r( $arrayKeys);
                 $role = strtolower ($arrayKeys[0]);
				 if($role=='sm')
					{
				 ?>
                    <a title="Upgrade" onclick="showpopup('buymember','param1', 'param2');" class="normalTip popupopen" href="javascript:void(0);">
                    <p class="greenbtn">
                   <input type="button"  name="Upgrade" value="<?php echo UserModule::t('Upgrade Membership');?>" />
                     <em></em></p>
                     </a>
                      <?php 
					}else{}?>
					    </span>
                 </div>
                 </div>
                 <div class="row submit">
                 	</div>
                    </fieldset>
                    </form>
                 </aside>
                </section>
                
               <section class="content_block2">
               
                 <aside class="forms_block">
                   <div class="row submit">
 		<a title="Delete Acount" onclick="showpopup('deleteaccount','param1', 'param2');" class="normalTip popupopen" href="javascript:void(0);">
                    <p style="float:right;padding-right:27px;">
                   <input type="button"  name="Upgrade" class="css3button"   value="<?php echo UserModule::t('Delete My Profile');?>" />
                     <em></em></p>
                     </a>
					</div>
                    <div class="row submit">
                 	</div>
                 </aside>
                </section> 
                </div>
                <!-- for right side start-->
                <div class="right_container equal">
                	 <?php  $this->widget('sideprofilewidget',array('show_editbtn'=>'yes')); ?> 
					<section class="block-space">
                     <?php  $this->widget('application.components.sitecomment'); ?>
					</section>
                </div>
                 <!-- for right side end-->
                <div class="clear"></div>
           </div>     
                
		</div>
	 </article>
    <?php  $this->widget('popupwidget',array('model'=>$model)); ?> 
    <style>
	.popup_block .open_popup
	{
		height:634px;
	}
	</style>

  <script>
	  $(document).ready(function(){
	 var urlbaseDir = "<?php echo Yii::app()->request->baseUrl;?>";
 
	  $('#updateprodetails').click(function(){
	  
	 
		var str = $("#userpro_form").serialize();  
		  
			$.ajax({  
            type: "POST",  
 		    url: urlbaseDir + '/user/profile/updateprofiledetails',
            data:str,  
            success: function(value)  
					{  
					$('#resultmsg').removeClass();
					$('#resultmsg').html(value);
					}   
			
			});
			var str1 = $("#settings-form").serialize();
			
	  $.ajax({  
            type: "POST",  
 		    url: urlbaseDir + '/user/profile/settings',
            data:str1,  
            success: function(value)  
					{  
					}   
			});
	     
	  });  //click
	  });
  </script>
                   