<?php
$inboxlink = (Yii::app()->user->checkAccess('Message.Inbox.Inbox')) ? $this->createUrl('inbox/') : 'javascript:void(0);';
$sentlink = (Yii::app()->user->checkAccess('Message.Sent.Sent')) ? $this->createUrl('sent/sent') : 'javascript:void(0);';
$composelink = (Yii::app()->user->checkAccess('Message.Compose.Compose')) ? $this->createUrl('compose/') : 'javascript:void(0);';
$spamlink = $this->createUrl('spam/viewspam');

?>
            <aside class="buttons">
            <p><a  class="green bold" id="msginbox" href="<?php echo $inboxlink; ?>"><?php /*?><?php echo MessageModule::t("Inbox"); ?><?php if (Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId())): ?>
			(<?php echo Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()); ?>)
		<?php endif; ?><?php */?>
	</a>   </p>
            <p>
            <a href="<?php echo $sentlink; ?>" <?php echo (Yii::app()->user->checkAccess('Message.Sent.Sent')) ? '' : 'onclick="javascript:buymember();"'; ?>><?php echo MessageModule::t("sent"); ?></a></p>
            <p>
            <a href="<?php echo $composelink; ?>" <?php echo (Yii::app()->user->checkAccess('Message.Compose.Compose')) ? '' : 'onclick="javascript:buymember();"';
			?>><?php echo MessageModule::t("compose"); ?></a></p>
             <p><a href="<?php echo $spamlink; ?>"><?php echo MessageModule::t("spam"); ?></a></p>
            <?php 
			if(Yii::app()->controller->action->id=='compose' || Yii::app()->controller->action->id=='view')
			{
			?>
            <div class="right"><a  href="<?php echo $inboxlink; ?>" class="arrow_link">Back</a></div>
            <?php
			}
			?>
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
    <li><a href="<?php echo $this->createUrl('spam/viewspam') ?>">spam</a></li>
</ul>

<?php 
 $this->widget('popupwidget',array('model'=>NULL)); ?> 
 
 <script type="text/javascript">
 $(document).ready(function(e) {
		setTimeout('updateInboxMessagecount();',5000);
		
    });
 function updateInboxMessagecount()
	{
		$.ajax({
			  url: <?php echo "'".Yii::app()->createUrl('/message/inbox/inboxcount')."'"; ?>,
			  cache: false,
			  type: "post",
	    	  data: 'data',
	          dataType: "json",
	          success: function(data) {
				  if(data.totalinboxcount>0)
				  {
							data.totalinboxcount=data.totalinboxcount;
						   $('#msginbox').html('inbox('+data.totalinboxcount+')');
				  }else{
					  $('#msginbox').html('inbox');
				  }
				},
   			 error: function (response) {
                console.log("error!");
       			 },});setTimeout('updateInboxMessagecount();',5000);
	}
 
 
 </script>