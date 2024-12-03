<?php
Yii::app()->getComponent('bootstrap');
$this->widget('bootstrap.widgets.TbButtonGroup', array(
'buttons'=>array(

(Yii::app()->user->checkAccess('Message.Inbox.Inbox')
		?array('label'=>MessageModule::t('inbox'), 'url'=>array('inbox/'))
		:array('label'=>MessageModule::t('inbox'), 'url'=>array('#'))),

(Yii::app()->user->checkAccess('Message.Sent.Sent')
		?array('label'=>MessageModule::t('sent'), 'url'=>array('sent/'))
		:array('label'=>MessageModule::t('sent'), 'url'=>array('#'))),

(Yii::app()->user->checkAccess('Message.Compose.Compose')
		?array('label'=>MessageModule::t('compose'), 'url'=>array('compose/'))
		:array('label'=>MessageModule::t('compose'), 'url'=>array('#'))),
),
));

$inboxlink = (Yii::app()->user->checkAccess('Message.Inbox.Inbox')) ? $this->createUrl('inbox/') : 'javascript:void(0);';
$sentlink = (Yii::app()->user->checkAccess('Message.Sent.Sent')) ? $this->createUrl('sent/') : 'javascript:void(0);';
$composelink = (Yii::app()->user->checkAccess('Message.Compose.Compose')) ? $this->createUrl('compose/') : 'javascript:void(0);';

?>
            <aside class="buttons" style="display:none;">
            <p><a  class="green bold" id="msginbox" href="<?php echo $inboxlink; ?>">inbox<?php if (Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId())): ?>
			(<?php echo Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()); ?>)
		<?php endif; ?>
	</a>   </p>
            <p><a href="<?php echo $sentlink; ?>">sent</a></p>
            <p><a href="<?php echo $composelink; ?>">compose</a></p>
            <div class="clear"></div>
            </aside>
<ul class="actions" style="display:none">
	<li><a href="<?php echo $this->createUrl('inbox/') ?>">inbox
		<?php if (Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId())): ?>
			(<?php echo Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()); ?>)
		<?php endif; ?>
	</a></li>
	<li><a href="<?php echo $this->createUrl('sent/sent') ?>">sent</a></li>
	<li><a href="<?php echo $this->createUrl('compose/') ?>">compose</a></li>
</ul>

<?php if(Yii::app()->user->hasFlash('messageModule')): ?>
	<div class="success">
		<?php echo Yii::app()->user->getFlash('messageModule'); ?>
	</div>
<?php endif; ?>
