<?php $this->render('results', array('model' => $model)); ?>

<?php if ($userVote->id): ?>
  <p id="pollvote-<?php echo $userVote->id ?>" style="padding-left:20px;color:#949494;">
    <?php echo UserModule::t('You voted:'); ?> <strong><?php echo UserModule::t($userChoice->label) ?></strong>.<br />
    <?php
     /* if ($userCanCancel) {
        echo CHtml::ajaxLink(
          'Cancel Vote',
          array('/poll/pollvote/delete', 'id' => $userVote->id, 'ajax' => TRUE),
          array(
            'type' => 'POST',
            'success' => 'js:function(){window.location.reload();}',
          ),
          array(
            'class' => 'cancel-vote',
            'confirm' => 'Are you sure you want to cancel your vote?'
          )
        );
      }*/
    ?>
  </p>
<?php else: ?>
  <p><?php echo CHtml::link('Vote', array('/poll/poll/vote', 'id' => $model->id)); ?></p>
<?php endif; ?>
