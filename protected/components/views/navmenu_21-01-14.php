<script>
$(document).ready(function(){
	$('#online_status').live( 'click',function(){
		//Raed class
		var className = $(this).attr('class');
		
		//determine whether online or offline
		if( className == 'online_status' )
		{
		   $('#onlinelebel').html('Online');	
			var OnlineType = 1;
		}else
		{
		   $('#onlinelebel').html('Offline');	
			var OnlineType = 0;
		}
		//Call a ajax
		 $.ajax({
				type : 'GET', 
				url: "<?php echo Yii::app()->request->baseUrl;?>/site/onlineStatus",
				data:{OnlineType : OnlineType},
				success: function(data){
				}
	 		})
		//action upadte Online User	
	
	})
})
</script>
   <nav class="navigation">
  <section>
    <div class="wrapper">
   
    <ul>
    <li class="envelope <?php echo ($activemenu=='envelope')?'active':'';  ?>">
	<?php 
	
	if(isset($_SESSION['userprofileldstatus']) && $_SESSION['userprofileldstatus']=='incomplete')
	{
	echo '<a href="javascript:void(0);" title="'.UserModule::t('My messages').'" class=\'normalTip=\'><span></span></a>';
	}elseif(Yii::app()->user->checkAccess('Message.Inbox.Inbox'))
	{
		$messageunread =(Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()))? '<em>'.Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()).'</em>':'';
	echo CHtml::link($messageunread.'<span></span>',array('/message'),array('class'=>'normalTip','title'=>UserModule::t('My messages')));
	}else
	{
	echo '<a href="javascript:void(0);"  onclick="javascript:buymember();" title="'.UserModule::t('Messages').'" class=\'normalTip\'><em></em><span></span></a>';
    }
    ?>
    </li>
    <li class="talk <?php echo (isset($activemenu) && $activemenu=='talk')?'active':'';  ?>">
	<?php //
	if(isset($_SESSION['userprofileldstatus']) && $_SESSION['userprofileldstatus']=='incomplete')
	{
	echo '<a href="javascript:void(0);" title="'.UserModule::t('Chat with contacts').'" class=\'normalTip\'><span></span></a>';
	}else
	{
	echo CHtml::link('<span></span>',array('/user/chat'),array('class'=>'normalTip','title'=>UserModule::t('Chat with contacts')));
	}
	?>
	</li>
	<li class="favorites <?php echo (isset($activemenu) && $activemenu=='favorites')?'active':'';  ?>">
	<?php 
	if(isset($_SESSION['userprofileldstatus']) && $_SESSION['userprofileldstatus']=='incomplete')
	{
	echo '<a href="javascript:void(0);" title="'.UserModule::t('My favorites').'" class=\'normalTip=\'><span></span></a>';
	}else
	{
		echo CHtml::link('<span></span>',array('/user/favorite'),array('title'=>UserModule::t('My favorites')));
	}?>
	</li>
	<li class="image <?php echo (isset($activemenu) && $activemenu=='image')?'active':'';  ?>">
	<?php 
	if(isset($_SESSION['userprofileldstatus']) && $_SESSION['userprofileldstatus']=='incomplete')
	{
	echo '<a href="javascript:void(0);" title="'.UserModule::t('My photos').'" class=\'normalTip=\'><span></span></a>';
	}else
	{
		echo CHtml::link('<span></span>',array('/user/album'),array('title'=>UserModule::t('My photos')));
	}
	?>
	</li>

	<li class="profile <?php echo (isset($activemenu) && $activemenu=='profile')?'active':'';  ?>">
	<?php
	if(isset($_SESSION['userprofileldstatus']) && $_SESSION['userprofileldstatus']=='incomplete')
	{
	echo '<a href="javascript:void(0);" title="'.UserModule::t('My profile').'" class=\'normalTip=\'><span></span></a>';
	}else
	{
	 echo CHtml::link('<span></span>',array('/user/profile/'.$profilename),array('title'=>UserModule::t('My profile'))); 
	}
	?>
	</li>

	<li class="rfc <?php echo (isset($activemenu) && $activemenu=='rfc')?'active':'';  ?>">
	<?php
	 if(isset($_SESSION['userprofileldstatus']) && $_SESSION['userprofileldstatus']=='incomplete')
	{
		echo '<a href="javascript:void(0);" title="'.UserModule::t('My contacts').'" class=\'normalTip=\'><span></span></a>';
	}else
	{
		echo CHtml::link('<span></span>',array('/user/rfc'),array('title'=>UserModule::t('My contacts'))); 
	}
	
	?>
	</li>

	<li class="setting <?php echo (isset($activemenu) && $activemenu=='setting')?'active':'';  ?>">
	<?php 
	if(isset($_SESSION['userprofileldstatus']) && $_SESSION['userprofileldstatus']=='incomplete')
	{
	 echo '<a href="javascript:void(0);" title="'.UserModule::t('Membership & Settings').'" class=\'normalTip=\'><span></span></a>';
	}else
	{
	 echo CHtml::link('<span></span>',array('/user/profile/settings'),array('title'=>UserModule::t('Membership & Settings'))); 
	}
	?>
	</li>
	</ul>
	 <?php
		$onlineClass  = 'online_status active';
		$style 		= 'style="left: 15px;"';
		$lebel        ='Offline';
		if(!empty($useronline))
			if( !empty ( $useronline->online ) )
			{
				$onlineClass = 'online_status';
				$style = 'style="left: -1px;"';
				$lebel='Online';
			}
				
	?>
	</li>
	</ul>
    <aside class="<?php echo $onlineClass?>" id="online_status">
	<div class="drag_btn"><em <?php echo $style;?>></em></div>
	<label id='onlinelebel'><?php echo $lebel;?> </label>
	</aside>
    </div>
    
    </section>
    </nav>