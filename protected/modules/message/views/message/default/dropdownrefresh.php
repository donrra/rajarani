<script>
$(document).ready(function() {
	
 //dropdown
	$('.dropdown').append('<em class="right"></em>');
	$(".dropdown").click(function () 
	{ 
 		$(this).children().eq(1).slideToggle(200); return false; 
	}
	);
	$(document).click(function () { $(".dropdown ul").slideUp(200); });
	$(".dropdown ul").click(function () { return false; });
	$('.dropdown ul span').click(function () {
	$(this).parent().parent().parent().find(".select").get(0).innerHTML = $(this)[0].innerHTML;
		$(".dropdown ul").slideUp(200)
	})
	
	
	$('div #vmaction li').click(function()
	{

	    if($(this).attr('id')=='delete')   
		{
			var confmsg=confirm('Do you want to delete the message?');
			var msgid=<?php echo $message_id?>;
			if(confmsg)
			$.ajax({
			type : 'GET', 
			url: "<?php echo Yii::app()->request->baseUrl;?>/message/delete",
			datatype: "json",
			data: { id: msgid,actiontype:'ajax'},
			success: function(complete){
			window.location="<?php echo Yii::app()->request->baseUrl;?>/message";
				}
			})
			return false;
		}
	     if($(this).attr('id')=='spam')    
		 {
		    var msgid=$('#Message_parent_id').val();
			$.ajax({
			type : 'GET', 
			url: "<?php echo Yii::app()->request->baseUrl;?>/message/spam",
			datatype: "json",
			data: { id: msgid,actiontype:'ajax'},
			success: function(complete){
			window.location="<?php echo Yii::app()->request->baseUrl;?>/message";
				}
			})
			return false;
			 
			 
		 }
	});
		
})
</script>
<div class="right top_space" id="dropdown">
  <div class="dropdown s_dropdown"  id="vmaction"> <span class="select">Actions</span>
    <ul>
      <li id="spam"><span>Mark as spam</span></li>
      <?php 
			$user_Senderon=Yii::app()->db->createCommand("select * from online_users where user_id='".$viewedMessage->sender_id."' and online=1")->queryRow();
			$user_Receiveron=Yii::app()->db->createCommand("select * from online_users where user_id='".$viewedMessage->receiver_id."' and online=1")->queryRow();
if($viewedMessage->sender_id!=Yii::app()->user->getId())
{
	if($user_Senderon){?>
	<li id="chat"><span onclick="javascript:chatWith('<?php echo $viewedMessage->getSenderName(); ?>')">Chat</span></li>
	<?php }}elseif($viewedMessage->receiver_id!=Yii::app()->user->getId())
	{ 
	if($user_Receiveron){?>
	<li id="chat"><span onclick="javascript:chatWith('<?php echo $viewedMessage->getReceiverName(); ?>')">Chat</span></li>
<?php }}?>
      <li id="delete"><span>Delete</span></li>
    </ul>
    
  </div>
</div>
