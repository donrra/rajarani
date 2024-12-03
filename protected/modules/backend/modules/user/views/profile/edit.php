<?php
Yii::app()->getComponent('bootstrap');
 $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Profile")=>array('profile'),
	UserModule::t("Edit"),
);


if(UserModule::isAdmin())
{
$this->widget('bootstrap.widgets.TbButtonGroup', array(
'buttons'=>array(
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('/backend/user/admin')),
    array('label'=>UserModule::t('List User'), 'url'=>array('user/')),
    array('label'=>UserModule::t('Profile'), 'url'=>array('/backend/user/profile')),
    array('label'=>UserModule::t('Change Password'), 'url'=>array('changepassword')),
    array('label'=>UserModule::t('Logout'), 'url'=>array('/backend/user/logout')),
),
));
}else
{
$this->widget('bootstrap.widgets.TbButtonGroup', array(
'buttons'=>array(
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
    array('label'=>UserModule::t('Profile'), 'url'=>array('/user/profile')),
    array('label'=>UserModule::t('Change Password'), 'url'=>array('changepassword')),
    array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
),
));
}
?>
<h1><?php echo UserModule::t('Edit profile'); ?></h1>
<div id="content" class="safGrid"> 
  
  <!-- !Main Content Start -->
  
  <div id="mainContent" class="col cs-10 centered">
    <div id="examples">
     <?php
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
    <ul class="nav">
        <li><a href="#tab-6" <?php echo $step6;?>>Presentation</a></li>
        <li><a href="#tab-5" <?php echo $step5;?>>Match</a></li>
        <li><a href="#tab-4" <?php echo $step4;?>>Livsstil</a></li>
        <li><a href="#tab-3" <?php echo $step3;?>>Udseende</a></li>
        <li><a href="#tab-2" <?php echo $step2;?>>Personlighed</a></li>
        <li><a href="#tab-1" <?php echo $step1;?>>Generelt</a></li>
	</ul>
	<div class="content">
 <!-- TAB 1 STARTS HERE -->
   	<div id="tab-1" <?php echo $dtab1;?>>
		<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'profile-form',
		'enableAjaxValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
			),
		'htmlOptions' => array('enctype'=>'multipart/form-data')
		)); 
		?>

	<fieldset class="inlineLabels">

	<?php if(Yii::app()->user->hasFlash('profileMessage1')): ?>

	<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage1'); ?>
	</div>
	
	<?php endif; ?>
    
    <p class="note disclaimer">
	<?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?>
    <?php echo $form->errorSummary(array($model,$profile)); ?>
    </p>
	
    
    <div class="row">
	<?php  echo $form->labelEx($model,'username'); ?>
	<?php  echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
	<?php echo $form->error($model,'username'); ?>
    </div>
    
    <div class="row">
	<?php echo $form->labelEx($model,'email'); ?>
	<?php  echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
	<?php echo $form->error($model,'email'); ?>
    </div>
    
    <?php
  	$profileFields=$profile->getFields();
	$checkfields1=array('dob','relationshipstatus','avatar');
	$checkfields2=array('romance','aboutme','lookingfor','gender','residingcountry','postnr','city'
						,'civilstatus');
	$checkfields3=array('looks','eyescolor','hair','height','weight','tattoo','bodytype');
	$checkfields4=array('education','interests','income','diet','films','alcohol','wantchildren','religious','sports','smoke',                'languages','sleepinghabits','entertainment','exercise','music','pets','politics','religion');
	$checkfields5=array();
	$checkfields6=array();
	
	?>
   
	<?php 
	if ($profileFields) {
		foreach($profileFields as $field) {
	   if(!in_array($field->varname,$checkfields1))
		continue;
	?>

	<div class="row">
	<?php echo $form->labelEx($profile,$field->varname);
	if ($widgetEdit = $field->widgetEdit($profile)) {
		echo $widgetEdit;
			} elseif ($field->range) {
		if(strtolower($field->optiontype)=='checkbox')
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
										$profiles=explode(',',$profile[$field->varname]);
										foreach ($profiles as $key => $value) {
											if (empty($value)) {
											}else
											{
												$alreadytmparr[]=$value;
											}
										}
					echo CHtml::textField('Profile['.$field->varname.']', implode($alreadytmparr,','), array('id' =>                            'ytProfile_'.$field->varname));
					$this->widget('ext.ESelect2.ESelect2', array(
					'selector' => '#'.'ytProfile_'.$field->varname,
					'options' => array(
					'tags' => $tmparr,'width'=>'400px','multiple'=>true,
					),
					));
								
		}	
	
		elseif(strtolower($field->optiontype)=='radio')
		echo $form->radioButtonList($profile,$field->varname,Profile::range($field->range));
    	else if(strtolower($field->optiontype)=='select')
		echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		else
	    echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		
				} elseif ($field->field_type=="TEXT") {
					echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
					} else {
						echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
						} echo $form->error($profile,$field->varname); ?>
	</div>

    <?php
	}
	}
	
	?>

	<div class="row buttons">
	<input type="hidden" name="step" value="1" />
	<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
    </div>

	</fieldset>
    
	<?php $this->endWidget(); ?>
    </div>
 <!-- TAB 2 STARTS HERE -->
	<div id="tab-2"  <?php echo $dtab2;?>>
	<?php if(Yii::app()->user->hasFlash('profileMessage2')): ?>

	<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage2'); ?>
    </div>
    
	<?php endif; ?>

	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'enctype'=>'multipart/form-data'),
	)); ?>

	<fieldset class="inlineLabels">
    
     <p class="note disclaimer">
    <?php echo $form->errorSummary(array($model,$profile)); ?>
    </p>
<?php 
   
	if ($profileFields) {
		foreach($profileFields as $field) {
	   if(!in_array($field->varname,$checkfields2))
		continue;
		 
	?>
            <div class="row"> <?php echo $form->labelEx($profile,$field->varname);

		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
		
if(strtolower($field->optiontype)=='checkbox')
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
										$profiles=explode(',',$profile[$field->varname]);
										foreach ($profiles as $key => $value) {
											if (empty($value)) {
											}else
											{
												$alreadytmparr[]=$value;
											}
										}
					echo CHtml::textField('Profile['.$field->varname.']', implode($alreadytmparr,','), array('id' =>                            'ytProfile_'.$field->varname));
					$this->widget('ext.ESelect2.ESelect2', array(
					'selector' => '#'.'ytProfile_'.$field->varname,
					'options' => array(
					'tags' => $tmparr,'width'=>'400px','multiple'=>true,
					),
					));
								
		}	
	
	
		elseif(strtolower($field->optiontype)=='radio')
		echo $form->radioButtonList($profile,$field->varname,Profile::range($field->range));
    	else if(strtolower($field->optiontype)=='select')
		echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		
	    else
	    echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		
		
		}
		elseif ($field->field_type=="TEXT") {
			echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		echo $form->error($profile,$field->varname); ?> </div>
            <?php
			}
		}
   
?>
            <div class="row buttons">
              <input type="hidden" name="step" value="2" />
              <?php if(count($checkfields2)>0)
			  echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?> </div>
          </fieldset>
          <?php $this->endWidget(); ?>
          </fieldset>
        </div>
 <!-- TAB 3 STARTS HERE -->
    <div id="tab-3"  <?php echo $dtab3;?>>
          <?php if(Yii::app()->user->hasFlash('profileMessage3')): ?>
          <div class="success"> 
		  <?php echo Yii::app()->user->getFlash('profileMessage3'); ?> </div>
          <?php endif; ?>
          
          
          
          <?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'profile-form',
'enableAjaxValidation'=>false,
'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>
          <fieldset class="inlineLabels">
           
             <p class="note disclaimer">
    <?php echo $form->errorSummary(array($model,$profile)); ?>
    </p>
           
            <?php 
   
	if ($profileFields) {
		foreach($profileFields as $field) {
	   if(!in_array($field->varname,$checkfields3))
		continue;
		 
	?>
            <div class="row"> <?php echo $form->labelEx($profile,$field->varname);
		
		
		
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
		if(strtolower($field->optiontype)=='checkbox')
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
										$profiles=explode(',',$profile[$field->varname]);
										foreach ($profiles as $key => $value) {
											if (empty($value)) {
											}else
											{
												$alreadytmparr[]=$value;
											}
										}
					echo CHtml::textField('Profile['.$field->varname.']', implode($alreadytmparr,','), array('id' =>                            'ytProfile_'.$field->varname));
					$this->widget('ext.ESelect2.ESelect2', array(
					'selector' => '#'.'ytProfile_'.$field->varname,
					'options' => array(
					'tags' => $tmparr,'width'=>'400px','multiple'=>true,
					),
					));
								
		}	
	
		
		
	
		elseif(strtolower($field->optiontype)=='radio')
		echo $form->radioButtonList($profile,$field->varname,Profile::range($field->range));
    	else if(strtolower($field->optiontype)=='select')
		echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		
	    else
	    echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		
		
		}
		elseif ($field->field_type=="TEXT") {
			echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		echo $form->error($profile,$field->varname); ?> </div>
            <?php
			}
		}
   
?>


	<div class="row buttons">
	<input type="hidden" name="step" value="3" />
	<?php if(count($checkfields3)>0)
	echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
    </div>

	</fieldset>
    
	<?php $this->endWidget(); ?>
    </div>
 <!-- TAB 4 STARTS HERE -->
	<div id="tab-4"  <?php echo $dtab4;?>>
	<?php if(Yii::app()->user->hasFlash('profileMessage4')): ?>

	<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage4'); ?>
    </div>
    
	<?php endif; ?>

	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'enctype'=>'multipart/form-data'),
	)); ?>

	<fieldset class="inlineLabels">

      <p class="note disclaimer">
    <?php echo $form->errorSummary(array($model,$profile)); ?>
    </p>
<?php
	if ($profileFields) {
		foreach($profileFields as $field) {
	   if(!in_array($field->varname,$checkfields4))
		continue;
		 
	?>            <div class="row"> <?php echo $form->labelEx($profile,$field->varname);
			if ($widgetEdit = $field->widgetEdit($profile)) {
				echo $widgetEdit;
				} elseif ($field->range) {
		if(strtolower($field->optiontype)=='checkbox')
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
										$profiles=explode(',',$profile[$field->varname]);
										foreach ($profiles as $key => $value) {
											if (empty($value)) {
											}else
											{
												$alreadytmparr[]=$value;
											}
										}
					echo CHtml::textField('Profile['.$field->varname.']', implode($alreadytmparr,','), array('id' =>                            'ytProfile_'.$field->varname));
					$this->widget('ext.ESelect2.ESelect2', array(
					'selector' => '#'.'ytProfile_'.$field->varname,
					'options' => array(
					'tags' => $tmparr,'width'=>'400px','multiple'=>true,
					),
					));
								
		}	
	
		elseif(strtolower($field->optiontype)=='radio')
		echo $form->radioButtonList($profile,$field->varname,Profile::range($field->range));
    	else if(strtolower($field->optiontype)=='select')
		echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		
	    else
	    echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		
		
					} elseif ($field->field_type=="TEXT") {
						echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
						} else {
							echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
							} echo $form->error($profile,$field->varname); ?> </div>
            <?php
            }
			}
?>

	<div class="row buttons">
	<input type="hidden" name="step" value="4" />
	<?php if(count($checkfields4)>0)
	echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
    </div>

	</fieldset>
    
	<?php $this->endWidget(); ?>
    </div>
 <!-- TAB 5 STARTS HERE -->
	<div id="tab-5"  <?php echo $dtab5;?>>
	<?php if(Yii::app()->user->hasFlash('profileMessage5')): ?>

	<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage5'); ?>
    </div>
    
	<?php endif; ?>

	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'enctype'=>'multipart/form-data'),
	)); ?>

	<fieldset class="inlineLabels">

    
      <p class="note disclaimer">
    <?php echo $form->errorSummary(array($model,$profile)); ?>
    </p>
<?php
	if ($profileFields) {
		foreach($profileFields as $field) {
	   if(!in_array($field->varname,$checkfields5))
		continue;
		 
	?>            <div class="row"> <?php echo $form->labelEx($profile,$field->varname);
			if ($widgetEdit = $field->widgetEdit($profile)) {
				echo $widgetEdit;
				} elseif ($field->range) {
				
				if(strtolower($field->optiontype)=='checkbox')
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
										$profiles=explode(',',$profile[$field->varname]);
										foreach ($profiles as $key => $value) {
											if (empty($value)) {
											}else
											{
												$alreadytmparr[]=$value;
											}
										}
					echo CHtml::textField('Profile['.$field->varname.']', implode($alreadytmparr,','), array('id' =>                            'ytProfile_'.$field->varname));
					$this->widget('ext.ESelect2.ESelect2', array(
					'selector' => '#'.'ytProfile_'.$field->varname,
					'options' => array(
					'tags' => $tmparr,'width'=>'400px','multiple'=>true,
					),
					));
								
		}	
		if(strtolower($field->optiontype)=='radio')
		echo $form->radioButtonList($profile,$field->varname,Profile::range($field->range));
    	else if(strtolower($field->optiontype)=='select')
		echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		
	    else
	    echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		
					} elseif ($field->field_type=="TEXT") {
						echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
						} else {
							echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
							} echo $form->error($profile,$field->varname); ?> </div>
            <?php
            }
			}
?>

            <div class="row buttons">
              <input type="hidden" name="step" value="5" />
              <?php if(count($checkfields5)>0)
			  echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?> </div>
          </fieldset>
          <?php $this->endWidget(); ?>
          </fieldset>
        </div>
 <!-- TAB 6 STARTS HERE -->
    <div id="tab-6"  <?php echo $dtab6;?>>
	<?php if(Yii::app()->user->hasFlash('profileMessage6')): ?>

	<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage6'); ?>
    </div>
    
	<?php endif; ?>

	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'enctype'=>'multipart/form-data'),
	)); ?>

	<fieldset class="inlineLabels">

    
      <p class="note disclaimer">
    <?php echo $form->errorSummary(array($model,$profile)); ?>
    </p>
    
<?php
	if ($profileFields) {
		foreach($profileFields as $field) {
	   if(!in_array($field->varname,$checkfields6))
		continue;
		 
	?>            <div class="row"> <?php echo $form->labelEx($profile,$field->varname);
			if ($widgetEdit = $field->widgetEdit($profile)) {
				echo $widgetEdit;
				} elseif ($field->range) {
if(strtolower($field->optiontype)=='checkbox')
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
										$profiles=explode(',',$profile[$field->varname]);
										foreach ($profiles as $key => $value) {
											if (empty($value)) {
											}else
											{
												$alreadytmparr[]=$value;
											}
										}
					echo CHtml::textField('Profile['.$field->varname.']', implode($alreadytmparr,','), array('id' =>                            'ytProfile_'.$field->varname));
					$this->widget('ext.ESelect2.ESelect2', array(
					'selector' => '#'.'ytProfile_'.$field->varname,
					'options' => array(
					'tags' => $tmparr,'width'=>'400px','multiple'=>true,
					),
					));
								
		}	
		
	
		elseif(strtolower($field->optiontype)=='radio')
		echo $form->radioButtonList($profile,$field->varname,Profile::range($field->range));
    	else if(strtolower($field->optiontype)=='select')
		echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
	    else
	    echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		
		
					} elseif ($field->field_type=="TEXT") {
						echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
						} else {
							echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
							} echo $form->error($profile,$field->varname); ?> </div>
            <?php
            }
			}
?>

            <div class="row buttons">
              <input type="hidden" name="step" value="6" />
              <?php 
			  if(count($checkfields6)>0)
			  echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save'));
			   ?> </div>
          </fieldset>
          <?php $this->endWidget(); ?>
          </fieldset>
        </div>
        
        
      </div>
    </div>
    <!-- #examples --> 
    
  </div>
  <!-- #mainContent --> 
  
  <!-- Main Content End --> 
  
  <!-- !Footer Start --> 
  
  <!-- #footer --> 
  
  <!-- Footer End --> 
  
</div>
