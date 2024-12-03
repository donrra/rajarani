<div class="result">
  <div class="label">
    <?php echo CHtml::encode(UserModule::t($choice->label)); ?>
  </div>
  <div class="bar">
    <div class="fill" style="width: <?php echo $percent; ?>%;"></div>
  </div>
  <div class="totals">
    <span class="percent"><?php echo $percent; ?>%</span>
    <!--<span class="votes">(<?php //echo $voteCount; ?> <?php //echo $voteCount == 1 ? UserModule::t('Vote'): UserModule::t('Votes'); ?>)</span> -->
  </div>
</div>
