<section class="profile_pic">
  <?php
if($myprofile=='yes' && $show_editbtn!='yes')
{
 $image_source='<img src="'.Yii::app()->request->baseUrl.'/css/rajarani/images/edit_ico.png" style="no-repeat scroll 0 0 transparent" />';


?>
  <?php
}
?>
  <?php
if($myprofile=='yes')
{?>
  <?php
}else
{
?>
  <?php
}
?>
  <aside class="pro_img">
    <div class="img_block"> <img src="<?php echo Yii::app()->request->baseUrl.'/'.$profilephoto; ?>" width="100px" height="100px" /> </div>
  </aside>
  <aside class="pro_desc">
    <div class="block">
      <h4><a href="#"><?php echo $sidemodel->getAttribute('username'); ?></a></h4>
      <p><?php echo $sidemodel->profile->city; ?></p>
      <p><?php echo $sidemodel->profile->residingcountry; ?></p>
      <?php
                                if($myprofile=='yes' && $show_editbtn=='yes')
                                {	
								echo CHtml::link('<p class="greenbtn"><input type="button" name="editprofile" value="Edit Profile" /><em></em></p>',array('/user/profile/edit'),array()); 
								}
								?>
      <?php
 							
   							$arrayAuthRoleItems = Yii::app()->authManager->getAuthItems(2, Yii::app()->user->getId());
                    
						   
						    $arrayKeys = array_keys($arrayAuthRoleItems);
                            $role = strtolower ($arrayKeys[0]);
					   	$checkfriendsobj=UserFriends::model()->havefriends($sidemodel->id,Yii::app()->user->getId());
						
						if($checkfriendsobj[0]['isfriend']=='no')
						{
							$countarr = UserFriends::model()->denycount(Yii::app()->user->getId(),$sidemodel->id);
						}
								?>
    </div>
  </aside>
</section>
<?php
                            if($role!='sm' && ($sidemodel->id!= Yii::app()->user->getId()))
							{
								$usermembership=true;
								if($usermembership)
								{?>
<section class="profile_block">
  <?php
								if($checkfriendsobj[0]['isfriend']=='no')
									{
										if(count($countarr)>=2){
								?>
  <aside class="profile"><a  href="javascript:void(0);" class="normalTip popupopen" onclick="showpopup('denyrfc','<?php echo Yii::app()->user->getId(); ?>', '<?php echo $sidemodel->id; ?>');" title="<?php echo UserModule::t('Request for contact'); ?>"> </a></aside>
  <?php
										}else
										{
								?>
  <aside class="profile"><a href="javascript:void(0);" class="normalTip popupopen" onclick="showpopup('rfc','<?php echo Yii::app()->user->getId(); ?>', '<?php echo $sidemodel->id; ?>');" title="<?php echo UserModule::t('Request for contact'); ?>"> </a></aside>
  <?php
										}
									}else
									{
										?>
  <aside class="writemsg"><a href="<?php echo  Yii::app()->createUrl('message/compose/').'/?sendto='.base64_encode($sidemodel->getAttribute('username')).'&sid='.base64_encode($sidemodel->id); ?>" class="normalTip"  title="<?php echo UserModule::t('Write message'); ?>"></a></aside>
  <?php
									}
									?>
  <!--<aside class="flirt"><a href="#"></a></aside>--> 
  <!-- need to check already added or not pending -->
  <aside class="addtofavorite"><a rel="<?php echo $sidemodel->id; ?>" href="javascript:void(0);" class="normalTip"  title="<?php echo UserModule::t('Add to Favorite'); ?>"></a></aside>
  <?php
									if($checkfriendsobj[0]['isfriend']=='yes')
									{
										if(isset($_REQUEST['id']))
										{
			$online_usersmodel = OnlineUsers::model()->find('user_id=:user_id', array(':user_id'=>$sidemodel->id));		if($online_usersmodel->online==1)
											{
											?>
  <aside class="chat  last"><a href="javascript:void(0);"  class="normalTip" title="<?php echo UserModule::t('Chat'); ?>"  onclick="javascript:chatWith('<?php echo $_REQUEST['id']; ?>')"></a></aside>
  <?php
											}else
											{
											?>
  <aside class="offlinechat  last"><a href="javascript:void(0);"  class="normalTip" title="<?php echo UserModule::t('User is offline'); ?>"></a></aside>
  <?php
											}
										
										}
									}else
									{  // paid member but not friend so need to RFC first
										?>
  <aside class="profile"><a href="javascript:void(0);" class="normalTip popupopen" onclick="showpopup('rfc','<?php echo Yii::app()->user->getId(); ?>', '<?php echo $sidemodel->id; ?>');" title="<?php echo UserModule::t('Request for contact'); ?>"> </a></aside>
  <?php
									}
								
							   
							   ?>
</section>
<?php
								}else
								{
									//membership expire
								}
						
							
							}else if($sidemodel->id!= Yii::app()->user->getId())
							{
							?>
<section class="profile_block">
  <aside class="profile"><a href="javascript:void(0);" class="normalTip popupopen" onclick="showpopup('freemember','param1', 'param2');" title="<?php echo UserModule::t('Request for contact'); ?>"> </a></aside>
  
  <!-- need to check already added or not pending -->
  <aside class="addtofavorite"><a href="javascript:void(0);" class="normalTip popupopen"  title="<?php echo UserModule::t('Add to favorites'); ?>"></a></aside>
  <aside class="chat last"><a href="javascript:void(0);" class="normalTip popupopen" onclick="showpopup('freemember','param1', 'param2');" title="<?php echo UserModule::t('Chat'); ?>" >123</a></aside>
</section>
<?php
								}
							?>
<section class="block_Afstemning">
  <p><?php echo UserModule::t('Poll:'); ?></p>
</section>
<?php $this->widget('EPoll'); ?>
<div style="clear:both;border-bottom:solid 1px #DDDDDD;height:5px;"></div>
<script>
$(document).ready(function() {

		
		$('aside.addtofavorite').click(function()
		{
		
		
			var favid=$(this).find('a').attr('rel');
			
					$.ajax({
					type : 'POST', 
					url: '<?php echo  Yii::app()->createUrl('user/profile/addtofavorite'); ?>',
					datatype: "json",
					data: { 'favid':favid},
					success: function(complete){
					window.location.href='<?php echo  Yii::app()->createUrl('user/favorite'); ?>';
					 return false;
					}
					
				})
			return false;
			 
		//The conversation has been unmarked as spam and moved to the Inbox.
	});
	
	///////////////////////
	
	
});
</script> 
