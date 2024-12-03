<!--<div class="row"></div><div class="row buttons"></div>-->
<?php $form=$this->beginWidget('CActiveForm', array(
  'id'=>'portlet-poll-form',
  'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->errorSummary($model); ?>
<section class="Afstemning">
<ul>

 <?php //echo $form->labelEx($userVote,'choice_id'); ?>
    <?php $template = '<li><div class="radionew">{input}</div><div class="radiotext">{label}</div></li>'; ?>
    <?php echo $form->radioButtonList($userVote,'choice_id',$choices,array(
      'template'=>$template,
      'separator'=>'',
      'name'=>'PortletPollVote_choice_id')); ?>
    <?php echo $form->error($userVote,'choice_id'); ?>


</ul>
<p class="greenbtn">
  <?php echo CHtml::submitButton('Vote',array('style'=>'width:245px')); ?><em></em>
</p>
</section>
<?php $this->endWidget(); ?>
<section class="block-space">
</section><!-- form -->