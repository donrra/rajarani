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
				//if process.php returned 1/true (send mail success)
				//if (html==1) {					
					//hide the form
					$('.form').fadeOut('slow');					
					
					//show the success message
					$('.done').fadeIn('slow');
					
				//if process.php returned 0/false (send mail failed)
				//} else alert('Sorry, unexpected error. Please try again later.');				
			}		
		});
		
		//cancel the submit button default behaviours
		return false;
	});	
});	
</script>
<script type="text/javascript">

$(document).ready(function() {
	$('.close').click(function(){
	   $('#msg').hide();
	   });
	}); 
	</script>
        <style>
	.ui-datepicker{z-index:1000 !important;}
	</style>
    
  
	<?php
	//echo $tabstep;
	 switch($tabstep)
	 {
	case "1":
	$step1='class="active"';
	$step2=' ';
	$step3=' ';
	$step4=' ';
	$step5=' ';
	$step6=' ';
		$dtab1='style="display: block;"';
		$dtab2='style="display: none;"';
		$dtab3='style="display: none;"';
		$dtab4='style="display: none;"';
		$dtab5='style="display: none;"';
		$dtab6='style="display: none;"';   
   break;

   case "2":
	$step1=' ';
	$step2='class="active"';
	$step3=' ';
	$step4=' ';
	$step5=' ';
	$step6=' ';
		$dtab1='style="display: none;"';
		$dtab2='style="display: block;"';
		$dtab3='style="display: none;"';
		$dtab4='style="display: none;"';
		$dtab5='style="display: none;"';
		$dtab6='style="display: none;"';
	break;

	case "3":
	$step1=' ';
	$step2=' ';
	$step3='class="active"';
	$step4=' ';
	$step5=' ';
	$step6=' ';
		$dtab1='style="display: none;"';
		$dtab2='style="display: none;"';
		$dtab3='style="display: block;"';
		$dtab4='style="display: none;"';
		$dtab5='style="display: none;"';
		$dtab6='style="display: none;"';
	break;
	case "4":
	$step1=' ';
	$step2=' ';
	$step3=' ';
	$step4='class="active"';
	$step5=' ';
	$step6=' ';
		$dtab1='style="display: none;"';
		$dtab2='style="display: none;"';
		$dtab3='style="display: none;"';
		$dtab4='style="display: block;"';
		$dtab5='style="display: none;"';
		$dtab6='style="display: none;"';
	break;

	case "5":
	$step1=' ';
	$step2=' ';
	$step3=' ';
	$step4=' ';
	$step5='class="active"';
	$step6=' ';
		$dtab1='style="display: none;"';
		$dtab2='style="display: none;"';
		$dtab3='style="display: none;"';
		$dtab4='style="display: none;"';
		$dtab5='style="display: block;"';
		$dtab6='style="display: none;"';
	break; 
	
		case "6":
	$step1=' ';
	$step2=' ';
	$step3=' ';
	$step4=' ';
	$step5=' ';
	$step6='class="active"';
		$dtab1='style="display: none;"';
		$dtab2='style="display: none;"';
		$dtab3='style="display: none;"';
		$dtab4='style="display: none;"';
		$dtab5='style="display: none;"';
		$dtab6='style="display: block;"';
	break; 

	
	}
	?>
<article class="container">
	 	<em class="shadow_1"></em>
	 	<div class="wrapper">

        		<?php
			if(isset($_SESSION['firsttimeeditmsg']) && $_SESSION['firsttimeeditmsg']!='')
				{
					?>
                    <div class="msg_white_body">
                    <section class="msg_block-space">
                    <h2>Welcome to Rajarani.</h2>
                    <span><?php
						echo $_SESSION['firsttimeeditmsg'];
						$_SESSION['firsttimeeditmsg']='';
					?></span>
                    <br /><br/>
				<p id="msg">Tell us about yourself in some easy steps and start looking for your lifetime partner.<a class="close" href="javascript:void(0)"></a>
                </p>
                    </section>
                    </div>
                    <?php
				}
				?>
				<?php if(Yii::app()->user->hasFlash('profileMessage1')): ?>
        	<div class="succes_msg"><p><?php echo Yii::app()->user->getFlash('profileMessage1'); ?></p></div>
 				<?php endif; ?>
                <?php if(Yii::app()->user->hasFlash('profileMessage2')): ?>
        	<div class="succes_msg"><p><?php echo Yii::app()->user->getFlash('profileMessage2'); ?></p></div>
 				<?php endif; ?>
                <?php if(Yii::app()->user->hasFlash('profileMessage3')): ?>
        	<div class="succes_msg"><p><?php echo Yii::app()->user->getFlash('profileMessage3'); ?></p></div>
 				<?php endif; ?>
                <?php if(Yii::app()->user->hasFlash('profileMessage4')): ?>
        	<div class="succes_msg"><p><?php echo Yii::app()->user->getFlash('profileMessage4'); ?></p></div>
 				<?php endif; ?>
                <?php if(Yii::app()->user->hasFlash('profileMessage5')): ?>
        	<div class="succes_msg"><p><?php echo Yii::app()->user->getFlash('profileMessage5'); ?></p></div>
 				<?php endif; ?>
                <?php if(Yii::app()->user->hasFlash('profileMessage6')): ?>
        	<div class="succes_msg"><p><?php echo Yii::app()->user->getFlash('profileMessage6'); ?></p></div>
 				<?php endif; ?>
 
			<section class="tabs">
               <ul class="nav">
                <li><a href="#tab-1" <?php echo $step1;?>><span><?php echo UserModule::t('Account'); ?></span></a></li>
                <li><a href="#tab-2" <?php echo $step2;?>><span><?php echo $model->username; ?></span></a></li>
                <li><a href="#tab-3" <?php echo $step3;?>><span><?php echo UserModule::t('Looks'); ?></span></a></li>
                <li><a href="#tab-4" <?php echo $step4;?>><span><?php echo UserModule::t('Lifestyle'); ?></span></a></li>
                <li><a href="#tab-5" <?php echo $step5;?>><span><?php echo UserModule::t('I am looking for..'); ?></span></a></li>
             <!--   <li><a href="#tab-6" <?php echo $step6;?>><span><?php echo UserModule::t('Presentation'); ?></span></a></li>-->
                </ul>
			</section>
			<div class="white_body">
				<div class="left_container">
					<div class="left_block equal">
						<div id="content"> 

                         <!-- TAB 1 STARTS HERE -->
                            <div id="tab-1" <?php echo $dtab1;?>>
                            <section class="content_block2">
                             <aside class="forms_block">
                                <?php $form=$this->beginWidget('CActiveForm', array(
                                'id'=>'profile-form',
                                'enableAjaxValidation'=>true,
                                'clientOptions'=>array(
                                'validateOnSubmit'=>true,
                                    ),
                                'htmlOptions' => array('enctype'=>'multipart/form-data','class'=>'formfields')
                                )); 
                                ?>
                        
                            <fieldset>
                        
                            <p class="note disclaimer">
                          <!-- <strong> <?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></strong>-->
                            <?php echo $form->errorSummary(array($model,$profile)); ?>
                            </p>
                            
                           
                             <?php
                             echo $form->hiddenField($model,'username',array('readonly'=>true, 'class'=>'textbox2')); ?>
                            <!-- <div class="row odd">
                            <?php  //echo $form->labelEx($model,'username',array('class'=>' ')); ?>
                            <?php
							 //echo $form->hiddenField($model,'username',array('readonly'=>true, 'class'=>'textbox2')); ?>
                            <?php //echo $form->error($model,'username'); ?>
                            </div>-->
                            <?php  echo $form->hiddenField($model,'password',array('size'=>60,'maxlength'=>128,'class'=>'textbox2','value'=>'')); ?>
                            <!--<div class="row odd">
                            <?php //echo $form->labelEx($model,'password',array('class'=>'')); ?>
                            <?php  //echo $form->PasswordField($model,'password',array('size'=>60,'maxlength'=>128,'class'=>'textbox2','value'=>'')); ?>
                          
                            <?php //echo CHtml::hiddenField('oldpassword',$model->password,array("size"=>100,"id"=>'oldpassword'));?>
                            <?php //echo $form->error($model,'oldpassword'); ?>
                            </div>-->

							<!--<div class="row even">
                            <?php // echo $form->labelEx($model,'verifyPassword',array('class'=>'')); ?>
                            <?php //echo $form->PasswordField($model,'verifyPassword',array('size'=>20,'maxlength'=>20,'class'=>'textbox2')); ?>
							<?php //echo $form->error($model,'verifyPassword'); ?>
                            </div>-->
                             <?php  echo $form->hiddenField($model,'email',array('size'=>60,'maxlength'=>128,'class'=>'textbox2')); ?>
                            <!--<div class="row odd">
                            <?php //echo $form->labelEx($model,'email',array('class'=>'')); ?>
                            <?php // echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128,'class'=>'textbox2')); ?>
                            <?php //echo $form->error($model,'email'); ?>
                            </div>
                           -->
                           

                            
<?php
$profileFields=$profile->getFields();
$checkfields1=array('gender','dob','residingcountry','postnr','city','civilstatus','aboutme');
$checkfields2=array('relationshipstatus','havechildren','nationality','ethnicity','profession','personality');//,'msg_receivemessage','msg_receivefavorit',,'starsign','msg_receiveflirt'
$checkfields3=array('looks','eyescolor','hair','height','weight','tattoo','bodytype');
$checkfields4=array('sports','smoke','alcohol','entertainment','music','exercise','pets','politics','education','religion','religious','income','wantchildren','romance','sleepinghabits','diet','interests','languages','films');
$checkfields5=array('lookingfor');
$checkfields6=array(); //'smoke'
?>
                           
                            <?php 
                            

							 $divtav1=1;
                            //	$profileFields=$profile->getFields();
                            if ($profileFields) {
							
							//foreach($profileFields as $field) {
							foreach($checkfields1 as $keyfield){	
									 
							if($divtav1%2==0){ $divrowclass='odd'; }else{ $divrowclass='even'; }		
									
                              
							  foreach($profileFields as $field)
								{
									if($field->varname==$keyfield)
									{
											if($field->field_type=='DATE')
										{
										$tmpdata =explode('-',$profile[$field->varname]);
										$fieldvalue = $tmpdata[2].'-'.$tmpdata[1].'-'.$tmpdata[0];
										$profile[$field->varname] = $fieldvalue ;
										}
										break;
									}else
									{
										continue;
									}
								}
							  
							  /* if(!in_array($field->varname,$checkfields1))
                               {
							   continue;
							   }else
							   {
								   if($field->field_type=='DATE')
									{
									$tmpdata =explode('-',$profile[$field->varname]);
									$fieldvalue = $tmpdata[2].'-'.$tmpdata[1].'-'.$tmpdata[0];
									$profile[$field->varname] = $fieldvalue ;
									}
							   }*/
                            ?>
                        
                            <div class="row  <?php echo $divrowclass;?>">
                            <?php 
							if(trim(strtolower($field->optiontype))=='checkbox')
							{
								echo $form->labelEx($profile,$field->varname,array('class'=>'normal'));
							}else
							{
								echo $form->labelEx($profile,$field->varname,array('class'=>''));
							}
							if ($widgetEdit = $field->widgetEdit($profile,array('class'=>'textbox2'))) {
                                echo $widgetEdit;
                                    } elseif ($field->range) {
                                
                                
                        //		 if($field->optiontype!= '' && ((strtolower($field->optiontype)!='radio') || (strtolower($field->optiontype)!='select')))
                                 if($field->optiontype!= '' && strtolower($field->optiontype)=='checkbox')
                                  {
                                    if(!is_array($profile[$field->varname])) 
                                    $selected_arr=explode(',',$profile[$field->varname]);
                                    $profile[$field->varname]=array();
                                    foreach($selected_arr as $key1=>$vall1)
                                    {
                                    $selected_arr1[$vall1]=$vall1;
                                    }
                                    $profile[$field->varname]=$selected_arr1;
                                 }	
                           
						   	
							    if(strtolower($field->optiontype)=='radio')
                                {
									
					   echo '<div class="radiofields">'.$form->radioButtonList($profile,$field->varname,Profile::range($field->range),$htmlOptions = array('separator'=>'')).'</div>';
							   }elseif(strtolower($field->optiontype)=='select')
                                {
									$fieldvalues=Profile::range($field->range);
										foreach ($fieldvalues as $key => $value) {
											if (empty($value)) {
											unset($fieldvalues[$key]);
											}
										}
			echo '<div class="selectfield">'.$form->dropDownList($profile,$field->varname,$fieldvalues,array('class'=>'styled')).'</div>';
								}elseif(trim(strtolower($field->optiontype))=='checkbox')
                                {
									
						echo '<div class="checkboxes">'.$form->checkBoxList($profile,$field->varname,Profile::range($field->range)).'</div>';
  
 								}else
                                {
									$fieldvalues=Profile::range($field->range);
										foreach ($fieldvalues as $key => $value) {
											if (empty($value)) {
											unset($fieldvalues[$key]);
											}
										}
										echo '<div class="selectfield">'.$form->dropDownList($profile,$field->varname,$fieldvalues,array('class'=>'styled')).'</div>';
								}
                                        } elseif ($field->field_type=="TEXT") {
                                            echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50
											,'class'=>'txtara'));
                                            } else {
												
                                         echo $form->textField($profile,$field->varname,array('class'=>'textbox2','size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
                                                } echo $form->error($profile,$field->varname); ?>
                            </div>
                        
                            <?php
                           $divtav1++; }
                            }
                            
                            ?>
                            <div class="row submit">
                              <input type="hidden" name="step" value="1" />
                              <p class="greenbtn">
                               <?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>                       <em></em></p>
                            </div>
                            </fieldset>
                            <?php $this->endWidget(); ?>
                            </aside>
                            </section>
                            </div>
                         <!-- TAB 2 STARTS HERE -->
                            <div id="tab-2"  <?php echo $dtab2;?>>
                           	<section class="content_block2">
                             <aside class="forms_block">
                          
                        
                            <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'profile-form',
                            'enableAjaxValidation'=>false,
                            'htmlOptions' => array('enctype'=>'multipart/form-data','class'=>'formfields'),
                            )); ?>
                        
                              <fieldset>
                            
                             <p class="note disclaimer">
                            <?php echo $form->errorSummary(array($model,$profile)); ?>
                            </p>
                        <?php 
                           $divtav2=1;
						   
                            if ($profileFields) {
								
                                //foreach($profileFields as $field) {
								foreach($checkfields2 as $keyfield){	
								
							if($divtav2%2==0){ $divrowclass='even'; }else{ $divrowclass='odd'; }
									
                              // if(!in_array($field->varname,$checkfields2))
                              //  continue;
                                
								 foreach($profileFields as $field)
								{
									if($field->varname==$keyfield)
									{
										break;
									}else
									{
										continue;
									}
								}
								 
                            ?>
                                    <div class="row <?php echo $divrowclass;?>"> <?php echo $form->labelEx($profile,$field->varname,array('class'=>''));
                        
                                if ($widgetEdit = $field->widgetEdit($profile,array('class'=>'textbox2'))) {
                                    echo $widgetEdit;
                                } elseif ($field->range) {
                                
                        		  
                                 if($field->optiontype!= '' && strtolower($field->optiontype)=='checkbox')
                                  {
                                    if(!is_array($profile[$field->varname])) 
                                    $selected_arr=explode(',',$profile[$field->varname]);
                                    $profile[$field->varname]=array();
                                    foreach($selected_arr as $key1=>$vall1)
                                    {
                                    $selected_arr1[$vall1]=$vall1;
                                    }
                                    $profile[$field->varname]=$selected_arr1;
                                 }	
								
                            
                                if(strtolower($field->optiontype)=='radio')
                                {
								// echo "<div class='custom-radio'>";
				 			   echo '<div class="radiofields">'.$form->radioButtonList($profile,$field->varname,Profile::range($field->range),$htmlOptions = array('separator'=>'')).'</div>';
								// echo "</div>";
								}
								else if(strtolower($field->optiontype)=='select')
								{
								$fieldvalues=Profile::range($field->range);
										foreach ($fieldvalues as $key => $value) {
											if (empty($value)) {
											unset($fieldvalues[$key]);
											}
										}
								echo '<div class="selectfield">'.$form->dropDownList($profile,$field->varname,$fieldvalues,array('class'=>'styled')).'</div>';
								
								
								}else if(strtolower($field->optiontype)=='checkbox')
								{
								
								$fieldvalues=Profile::range($field->range);
								$tmparr=array();
										foreach ($fieldvalues as $key => $value) {
											if (empty($value)) {
											unset($fieldvalues[$key]);
											}else
											{
												$tmparr[]=$key;
											}
										}
	
	 							$alreadytmparr=array();
										foreach ($profile[$field->varname] as $key => $value) {
											if (empty($value)) {
											//unset($fieldvalues[$key]);
											}else
											{
												$alreadytmparr[]=$key;
											}
										}
	
     echo CHtml::textField('Profile['.$field->varname.']', implode($alreadytmparr,','), array('id' => 'ytProfile_'.$field->varname));
    $this->widget('ext.ESelect2.ESelect2', array(
        'selector' => '#'.'ytProfile_'.$field->varname,
        'options' => array(
            'tags' => $tmparr,'width'=>'400px','multiple'=>true,
        ),
    ));
	   		//echo '<div class="checkboxes">'.$form->checkBoxList($profile,$field->varname,Profile::range($field->range)).'</div>';
								}else
									{	
									
										$fieldvalues=Profile::range($field->range);
										foreach ($fieldvalues as $key => $value) {
											if (empty($value)) {
											unset($fieldvalues[$key]);
											}
										} 
									
									  echo '<div class="selectfield">'.$form->dropDownList($profile,$field->varname,$fieldvalues,array('class'=>'styled')).'</div>';
									}
								}
                                elseif ($field->field_type=="TEXT") {
                                    echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50,'class'=>'txtara'));
                                } else {
                                    echo $form->textField($profile,$field->varname,array('class'=>'textbox2','size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
                                }
                                echo $form->error($profile,$field->varname); ?> </div>
                                    <?php
                                    $divtav2++;
									}
                                }
                           
                        ?>
                                    <div class="row submit">
                                  <input type="hidden" name="step" value="2" />
                              <p class="greenbtn">
                                <?php if(count($checkfields2)>0)
                                      echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?> <em></em></p>
                            </div>
                                  </fieldset>
                                  <?php $this->endWidget(); ?>
                                  </aside>
                                  </section>
                                </div>
                         <!-- TAB 3 STARTS HERE -->
                            <div id="tab-3"  <?php echo $dtab3;?>>
                             <section class="content_block2">
                             <aside class="forms_block">
                              
                                  
                                  
                                  <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'profile-form',
                        'enableAjaxValidation'=>false,
                        'htmlOptions' => array('enctype'=>'multipart/form-data','class'=>'formfields'),
                        )); ?>
                                   <fieldset>
                                   
                                     <p class="note disclaimer">
                            <?php echo $form->errorSummary(array($model,$profile)); ?>
                            </p>
                                   
                                    <?php 
                                 $divtav3=1;
                            if ($profileFields) {
                               // foreach($profileFields as $field) {
								foreach($checkfields3 as $keyfield){		
						
									if($divtav3%2==0){ $divrowclass='even'; }else{ $divrowclass='odd'; }
									
                             //  if(!in_array($field->varname,$checkfields3))
                              //  continue;
                                 
							
								 foreach($profileFields as $field)
								{
									if($field->varname==$keyfield)
									{
										break;
									}else
									{
										continue;
									}
								}	 
								 
                            ?>
                                    <div class="row <?php echo $divrowclass;?>"> <?php echo $form->labelEx($profile,$field->varname,array('class'=>''));
                                
                                
                                
                                if ($widgetEdit = $field->widgetEdit($profile,array('class'=>'textbox2'))) {
                                    echo $widgetEdit;
                                } elseif ($field->range) {
                                
                                
                                  if($field->optiontype!= '' && strtolower($field->optiontype)=='checkbox')
                                  {
                                    if(!is_array($profile[$field->varname])) 
                                    $selected_arr=explode(',',$profile[$field->varname]);
                                    $profile[$field->varname]=array();
                                    foreach($selected_arr as $key1=>$vall1)
                                    {
                                    $selected_arr1[$vall1]=$vall1;
                                    }
                                    $profile[$field->varname]=$selected_arr1;
                                 }	
                            
                                if(strtolower($field->optiontype)=='radio')
                                {
			 			    echo '<div class="radiofields">'.$form->radioButtonList($profile,$field->varname,Profile::range($field->range),$htmlOptions = array('separator'=>'')).'</div>';
								}else if(strtolower($field->optiontype)=='select')
							   {
								   $fieldvalues=Profile::range($field->range);
										foreach ($fieldvalues as $key => $value) {
											if (empty($value)) {
											unset($fieldvalues[$key]);
											}
										}
										echo '<div class="selectfield">'.$form->dropDownList($profile,$field->varname,$fieldvalues,array('class'=>'styled')).'</div>';
							   }else if(strtolower($field->optiontype)=='checkbox')
								{
									
								
								$fieldvalues=Profile::range($field->range);
								$tmparr=array();
										foreach ($fieldvalues as $key => $value) {
											if (empty($value)) {
											unset($fieldvalues[$key]);
											}else
											{
												$tmparr[]=$key;
											}
										}
	
	 							$alreadytmparr=array();
										foreach ($profile[$field->varname] as $key => $value) {
											if (empty($value)) {
											//unset($fieldvalues[$key]);
											}else
											{
												$alreadytmparr[]=$key;
											}
										}
	
     echo CHtml::textField('Profile['.$field->varname.']', implode($alreadytmparr,','), array('id' => 'ytProfile_'.$field->varname));
    $this->widget('ext.ESelect2.ESelect2', array(
        'selector' => '#'.'ytProfile_'.$field->varname,
        'options' => array(
            'tags' => $tmparr,'width'=>'400px','multiple'=>true,
        ),
    ));
	   		//echo '<div class="checkboxes">'.$form->checkBoxList($profile,$field->varname,Profile::range($field->range)).'</div>';
								
								
								//	echo '<div class="checkboxes">'.$form->checkBoxList($profile,$field->varname,Profile::range($field->range)).'</div>';
								}else
								{
									$fieldvalues=Profile::range($field->range);
										foreach ($fieldvalues as $key => $value) {
											if (empty($value)) {
											unset($fieldvalues[$key]);
											}
										} 
									echo '<div class="selectfield">'.$form->dropDownList($profile,$field->varname,$fieldvalues,array('class'=>'styled')).'</div>';
								}
                                
                                }
                                elseif ($field->field_type=="TEXT") {
                                    echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50,'class'=>'txtara'));
                                } else {
                                    echo $form->textField($profile,$field->varname,array('class'=>'textbox2','size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
                                }
                                echo $form->error($profile,$field->varname); ?> </div>
                                    <?php
                                   $divtav3++; }
                                }
                           
                        ?>
                        
                        
                            <div class="row buttons"  style="float:right">
                            
                            
                            </div>
                             <div class="row submit">
                              <input type="hidden" name="step" value="3" />
                              <p class="greenbtn">
                              <?php if(count($checkfields3)>0)
                            echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
                            <em></em></p>
                            </div>
                            </fieldset>
                            <?php $this->endWidget(); ?>
                            </aside>
                            </section>
                            </div>
                         <!-- TAB 4 STARTS HERE -->
                            <div id="tab-4"  <?php echo $dtab4;?>>
                            <section class="content_block2">
                             <aside class="forms_block">
							
                        
                            <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'profile-form',
                            'enableAjaxValidation'=>false,
                            'htmlOptions' => array(
                                'enctype'=>'multipart/form-data','class'=>'formfields'),
                            )); ?>
                        
                             <fieldset>
                        
                              <p class="note disclaimer">
                            <?php echo $form->errorSummary(array($model,$profile)); ?>
                            </p>
                        <?php
						
								$divtav4=1;
                            if ($profileFields) {
                               // foreach($profileFields as $field) {
								foreach($checkfields4 as $keyfield){		
							
									
						if($divtav4%2==0){ $divrowclass='even'; }else{ $divrowclass='odd'; }			
									
                             //  if(!in_array($field->varname,$checkfields4))
                              //  continue;
                                  foreach($profileFields as $field)
								{
									if($field->varname==$keyfield)
									{
										break;
									}else
									{
										continue;
									}
								}	 
                            ?>  
                              <div class="row <?php echo $divrowclass;?>"> <?php echo $form->labelEx($profile,$field->varname,array('class'=>''));
                                    if ($widgetEdit = $field->widgetEdit($profile,array('class'=>'textbox2'))) {
                                        echo $widgetEdit;
                                        } elseif ($field->range) {
                                        
                                        
                                  
                                if($field->optiontype!= '' && strtolower($field->optiontype)=='checkbox')
                                  {
									 
                                   	 	if(!is_array($profile[$field->varname])) 
                                    	{
										$selected_arr=explode(',',$profile[$field->varname]);
										$profile[$field->varname]=array();
										$selected_arr1=array();
											foreach($selected_arr as $key1=>$vall1)
											{
											$selected_arr1[$vall1]=$vall1;
											}
										//print_r($selected_arr1);
									   $profile[$field->varname]=$selected_arr1;
										
										
										
										}
								 }	
                           	
                                if(strtolower($field->optiontype)=='radio')
                                {
							 echo '<div class="radiofields">'.$form->radioButtonList($profile,$field->varname,Profile::range($field->range),$htmlOptions = array('separator'=>'')).'</div>';	
								}else if(strtolower($field->optiontype)=='select')
							    {
								$fieldvalues=Profile::range($field->range);
										foreach ($fieldvalues as $key => $value) {
											if (empty($value)) {
											unset($fieldvalues[$key]);
											}
										}
									echo '<div class="selectfield">'.$form->dropDownList($profile,$field->varname,$fieldvalues,array('class'=>'styled')).'</div>';
								
								}else if(strtolower($field->optiontype)=='checkbox')
								{
									
								
								$fieldvalues=Profile::range($field->range);
								
								$tmparr=array();
										foreach ($fieldvalues as $key => $value) {
											if (empty($value)) {
											unset($fieldvalues[$key]);
											}else
											{
												$tmparr[]=$key;
											}
										}
	
	 									$alreadytmparr=array();
										foreach ($profile[$field->varname] as $key => $value) {
											if (empty($value)) {
											//unset($fieldvalues[$key]);
											}else
											{
												$alreadytmparr[]=$key;
											}
										}
										
										
	
     echo CHtml::textField('Profile['.$field->varname.']', implode($alreadytmparr,','), array('id' => 'ytProfile_'.$field->varname));
    $this->widget('ext.ESelect2.ESelect2', array(
        'selector' => '#'.'ytProfile_'.$field->varname,
        'options' => array(
            'tags' => $tmparr,'width'=>'400px','multiple'=>true,
        ),
    ));
	   		//echo '<div class="checkboxes">'.$form->checkBoxList($profile,$field->varname,Profile::range($field->range)).'</div>';
								
									//echo '<div class="checkboxes">'.$form->checkBoxList($profile,$field->varname,Profile::range($field->range)).'</div>';
								}else
								{	
									$fieldvalues=Profile::range($field->range);
										foreach ($fieldvalues as $key => $value) {
											if (empty($value)) {
											unset($fieldvalues[$key]);
											}
										} 
										echo '<div class="selectfield">'.$form->dropDownList($profile,$field->varname,$fieldvalues,array('class'=>'styled')).'</div>';
									}
								} elseif ($field->field_type=="TEXT") {
                                                echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50,'class'=>'txtara'));
                                                } else {
                                                    echo $form->textField($profile,$field->varname,array('class'=>'textbox2','size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
                                                    } echo $form->error($profile,$field->varname); ?> </div>
                                    <?php
                                   $divtav4++;
								    }
                                    }
                        ?>
                        
                            <div class="row submit">
                              <input type="hidden" name="step" value="4" />
                              <p class="greenbtn">
                            <?php if(count($checkfields4)>0)
                            echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
                             <em></em></p>
                            </div>
                            </fieldset>
                            <?php $this->endWidget(); ?>
                            </aside>
                            </section>
                            </div>
                         <!-- TAB 5 STARTS HERE -->
                            <div id="tab-5"  <?php echo $dtab5;?>>
                            <section class="content_block2">
                             <aside class="forms_block">
							 
                        
                            <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'profile-form',
                            'enableAjaxValidation'=>false,
                            'htmlOptions' => array(
                                'enctype'=>'multipart/form-data','class'=>'formfields'),
                            )); ?>
                        
                              <fieldset>
                        
                            
                              <p class="note disclaimer">
                            <?php echo $form->errorSummary(array($model,$profile)); ?>
                            </p>
                        <?php
							$divtav5=1;
                            if ($profileFields) {
                                foreach($profileFields as $field) {
									
							if($divtav5%2==0){ $divrowclass='even'; }else{ $divrowclass='odd'; }		
									
                               if(!in_array($field->varname,$checkfields5))
                                continue;
                                 
                            ?>            <div class="row <?php echo $divrowclass;?>"> <?php echo $form->labelEx($profile,$field->varname,array('class'=>''));
                                    if ($widgetEdit = $field->widgetEdit($profile,array('class'=>'textbox2'))) {
                                        echo $widgetEdit;
                                        } elseif ($field->range) {
                                        
                                        
                                
                                
                                  if($field->optiontype!= '' && strtolower($field->optiontype)=='checkbox')
                                  {
                                     if(!is_array($profile[$field->varname])) 
                                    $selected_arr=explode(',',$profile[$field->varname]);
                                    $profile[$field->varname]=array();
                                    foreach($selected_arr as $key1=>$vall1)
                                    {
                                    $selected_arr1[$vall1]=$vall1;
                                    }
                                    $profile[$field->varname]=$selected_arr1;
                                 }	
                            
                                if(strtolower($field->optiontype)=='radio')
                                {
								 echo '<div class="radiofields">'.$form->radioButtonList($profile,$field->varname,Profile::range($field->range),$htmlOptions = array('separator'=>'')).'</div>';
								}else if(strtolower($field->optiontype)=='select')
								{
									$fieldvalues=Profile::range($field->range);
										foreach ($fieldvalues as $key => $value) {
											if (empty($value)) {
											unset($fieldvalues[$key]);
											}
										}
										echo '<div class="selectfield">'.$form->dropDownList($profile,$field->varname,$fieldvalues,array('class'=>'styled')).'</div>';
								}
								else if(strtolower($field->optiontype)=='checkbox')
								{
								
								
								$fieldvalues=Profile::range($field->range);
								$tmparr=array();
										foreach ($fieldvalues as $key => $value) {
											if (empty($value)) {
											unset($fieldvalues[$key]);
											}else
											{
												$tmparr[]=$key;
											}
										}
	
	 							$alreadytmparr=array();
										foreach ($profile[$field->varname] as $key => $value) {
											if (empty($value)) {
											//unset($fieldvalues[$key]);
											}else
											{
												$alreadytmparr[]=$key;
											}
										}
										
	
     echo CHtml::textField('Profile['.$field->varname.']', implode($alreadytmparr,','), array('id' => 'ytProfile_'.$field->varname));
    $this->widget('ext.ESelect2.ESelect2', array(
        'selector' => '#'.'ytProfile_'.$field->varname,
        'options' => array(
            'tags' => $tmparr,'width'=>'400px','multiple'=>true,
        ),
    ));
	   		//echo '<div class="checkboxes">'.$form->checkBoxList($profile,$field->varname,Profile::range($field->range)).'</div>';
								
								//echo '<div class="checkboxes">'.$form->checkBoxList($profile,$field->varname,Profile::range($field->range)).'</div>';
								}else
								   {
									   $fieldvalues=Profile::range($field->range);
										
										foreach ($fieldvalues as $key => $value) {
											if (empty($value)) {
											unset($fieldvalues[$key]);
											}
										}
										echo '<div class="selectfield">'.$form->dropDownList($profile,$field->varname,$fieldvalues,array('class'=>'styled')).'</div>';
								   }
								   } elseif ($field->field_type=="TEXT") {
                                                echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50,'class'=>'txtara'));
                                                } else {
                                                    echo $form->textField($profile,$field->varname,array('class'=>'textbox2','size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
                                                    } echo $form->error($profile,$field->varname); ?> </div>
                                    <?php
                                    $divtav5++;
									}
                                    }
                        ?>
                         <div class="row submit">
                                <input type="hidden" name="step" value="5" />
                               
                                <?php if(count($checkfields5)>0)
								{
									?>
                                     <p class="greenbtn">
									 <?php
									echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save'));								?>
                                <em></em></p>
                                <?php
								}
						   ?> </div>
                                 </fieldset>
                                  <?php $this->endWidget(); ?>
 	                              </aside>
                                  </section>
                                  </div>
                         <!-- TAB 6 STARTS HERE -->
                            <div id="tab-6"  <?php echo $dtab6;?>>
                            <section class="content_block2">
                             <aside class="forms_block">
							
                        
                            <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'profile-form',
                            'enableAjaxValidation'=>false,
                            'htmlOptions' => array(
                                'enctype'=>'multipart/form-data','class'=>'formfields'),
                            )); ?>
                        
                             <fieldset>
                        
                            
                              <p class="note disclaimer">
                            <?php echo $form->errorSummary(array($model,$profile)); ?>
                            </p>
                            
                        <?php
						
							$divtav6=1;
							
                            if ($profileFields) {
                                foreach($profileFields as $field) {
									
							if($divtav6%2==0){ $divrowclass='enev'; }else{ $divrowclass='odd'; }			
									
                               if(!in_array($field->varname,$checkfields6))
                                continue;
                                 
                            ?>            <div class="row <?php echo $divrowclass;?>"> <?php echo $form->labelEx($profile,$field->varname,array('class'=>''));
                                    if ($widgetEdit = $field->widgetEdit($profile,array('class'=>'textbox2'))) {
                                        echo $widgetEdit;
                                        } elseif ($field->range) {
                                        
                                    
                            
                                 /* */
                                 if($field->optiontype!= '' && strtolower($field->optiontype)=='checkbox')
                                  {
                                    if(!is_array($profile[$field->varname])) 
                                    $selected_arr=explode(',',$profile[$field->varname]);
                                    $profile[$field->varname]=array();
                                    foreach($selected_arr as $key1=>$vall1)
                                    {
                                    $selected_arr1[$vall1]=$vall1;
                                    }
                                    $profile[$field->varname]=$selected_arr1;
                                 }	
                            
                                if(strtolower($field->optiontype)=='radio')
                                {
								 echo '<div class="radiofields">'.$form->radioButtonList($profile,$field->varname,Profile::range($field->range),$htmlOptions = array('separator'=>'')).'</div>';
								}
								else if(strtolower($field->optiontype)=='select')
								{
									$fieldvalues=Profile::range($field->range);
										foreach ($fieldvalues as $key => $value) {
											if (empty($value)) {
											unset($fieldvalues[$key]);
											}
										}
										echo '<div class="selectfield">'.$form->dropDownList($profile,$field->varname,$fieldvalues,array('class'=>'styled')).'</div>';
								}else if(strtolower($field->optiontype)=='checkbox')
								{
									
								
								$fieldvalues=Profile::range($field->range);
								$tmparr=array();
										foreach ($fieldvalues as $key => $value) {
											if (empty($value)) {
											unset($fieldvalues[$key]);
											}else
											{
												$tmparr[]=$key;
											}
										}
	
	 							$alreadytmparr=array();
										foreach ($profile[$field->varname] as $key => $value) {
											if (empty($value)) {
											//unset($fieldvalues[$key]);
											}else
											{
												$alreadytmparr[]=$key;
											}
										}
	
     echo CHtml::textField('Profile['.$field->varname.']', implode($alreadytmparr,','), array('id' => 'ytProfile_'.$field->varname));
    $this->widget('ext.ESelect2.ESelect2', array(
        'selector' => '#'.'ytProfile_'.$field->varname,
        'options' => array(
            'tags' => $tmparr,'width'=>'400px','multiple'=>true,
        ),
    ));
	   		//echo '<div class="checkboxes">'.$form->checkBoxList($profile,$field->varname,Profile::range($field->range)).'</div>';
								
								//		echo '<div class="checkboxes">'.$form->checkBoxList($profile,$field->varname,Profile::range($field->range)).'</div>';
								}else
								{
									$fieldvalues=Profile::range($field->range);
										foreach ($fieldvalues as $key => $value) {
											if (empty($value)) {
											unset($fieldvalues[$key]);
											}
										}
										echo '<div class="selectfield">'.$form->dropDownList($profile,$field->varname,$fieldvalues,array('class'=>'styled')).'</div>';
									}
										} elseif ($field->field_type=="TEXT") {
                                                echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50,'class'=>'txtara'));
                                                } else {
                                                    echo $form->textField($profile,$field->varname,array('class'=>'textbox2','size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
                                                    } echo $form->error($profile,$field->varname); ?> </div>
                                    <?php
                                    $divtav6++;
									}
                                    }
                        ?>
                                
                                <div class="row submit">
                              <input type="hidden" name="step" value="6" />
                                 <?php 
                                 if(count($checkfields6)>0)
								 {?>
                                <p class="greenbtn">
                                 <?php
                           echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); 
								 ?>
								 <em></em></p>
								 <?php
                                 }
								 ?>  
                                </div>
								</fieldset>
                                  <?php $this->endWidget(); ?>
                                  </aside>
                                  </section>
                                </div>
                                
                                
                              </div>
                            <!-- #content --> 

                        <!-- Search Block -->
						<!--<section class="top_block">
                        	<aside class="heading_text_block">
								<div class="middle_text">
									<h1>Generelt</h1>
								</div>
							</aside>
                        </section>
                        <section class="content_block2">
                        	<aside class="search_options largedrop">
								<form>
									<div class="dropdown">
										<span class="select">Nationalitet</span>
										<ul>
											<li><span>Select1</span></li>
											<li><span>Select2</span></li>
										</ul>
									</div>
									<div class="dropdown">
										<span class="select">Etnisk baggrund</span>
										<ul>
											<li><span>Select1</span></li>
											<li><span>Select2</span></li>
										</ul>
									</div>
									<div class="clear"></div>
								</form>
							</aside>
							
                        </section>-->
                        <!-- Search Block End -->
					</div>
				</div>
				    <div class="right_container equal">
              <?php  $this->widget('application.modules.user.components.sideprofilewidget',array('show_editbtn'=>'no')); ?>              <?php // $this->widget('recentactivitywidget'); ?>
					<section class="block-space">
                     <?php  $this->widget('application.components.sitecomment'); ?>
					</section>
                </div>
                <div class="clear"></div>
			</div>
            
            
		</div>
	 </article>
     <script>
  document.write('<script src=' +
  ('__proto__' in {} ? 'js/vendor/zepto' : 'js/vendor/jquery') +
  '.js><\/script>')
  </script>
   <script>
    $(document).foundation();
  </script>
       <script language="javascript">
	     function checkdata()
		  {
			 // ($(this).val().length 
			var country=$('#Profile_residingcountry').val() ;
			if(country !='Denmark')
			{
				if($('#Profile_postnr').val().length > 4){
				$('#Profile_postnr').val($('#Profile_postnr').val().substr(0, 4));
		}
			}
		  }


            $("#Profile_postnr").keyup(function () {
                checkdata();
            });
				
				 $("#Profile_residingcountry").change(function () {
               	 $('#Profile_postnr').val('');
            });
</script>
