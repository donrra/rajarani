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
?>                    	<aside class="pro_img">
                        	<div class="img_block">
                         <?php  
                         if($profilephoto=='user_avatar/thumb/default.jpg')
						   {
							  
 							   if($sidemodel->profile->gender=='Female'){ ?>
							   <img src="<?php echo Yii::app()->request->baseUrl.'/user_avatar/thumb/woman.jpg'; ?>" width="100px" height="100px" />
							   <?php 
							   }else{ ?>
							   <img src="<?php echo Yii::app()->request->baseUrl.'/user_avatar/thumb/default.jpg'; ?>" width="100px" height="100px" />
							  <?php } 
						   }else{
							?>
                        <img src="<?php echo Yii::app()->request->baseUrl.'/'.$profilephoto; ?>" width="100px" height="100px" />
                        <?php }?>
                            </div>
                        </aside>
                        <aside class="pro_desc">
                        	<div class="block">
                                <h4><a href="#"><?php echo $sidemodel->getAttribute('username'); ?></a></h4>
                                <p><?php echo $sidemodel->profile->city; ?></p>
                                <p><?php 
								if($sidemodel->profile->residingcountry=='Please choose')
									 echo '';
								else
								 	echo $sidemodel->profile->residingcountry;
								 ?></p>
                                 <!--<div id="star">  
							  <?php 
							  /*if($sidemodel->id!= Yii::app()->user->getId())
							{
								 $userratings=Yii::app()->db->createCommand("select rating from userratings where userid=".Yii::app()->user->getId()." AND rateduserId=".$sidemodel->id."")->queryRow();
								 if(count($userratings)==0)
								 {
									 $this->widget('ext.DzRaty.DzRaty', array(
																	'name' => 'my_rating_field',
																	'value' => $userratings['rating'],
																	'options' => array(
																	'half'=>TRUE,
																	//'cancel' => TRUE,
																	//'cancelPlace' => 'right',
																	'click'=>"js:function(score, evt) {
																				$.post('/user/profile/ratingupdate',{score:score, userid:".Yii::app()->user->getId().",rateduserId:".$sidemodel->id." },
																						function(data){
																				});
																				}"
																	),
																	'htmlOptions' => array(
																						'class' => 'new-half-class'
																						),
																	));
								 }
								 else{
							 	 		$this->widget('ext.DzRaty.DzRaty', array(
																	'name' => 'my_rating_field',
																	'value' => $userratings['rating'],
																	'options' => array(
																	'half'=>TRUE,
																	//'cancel' => TRUE,
																	//'cancelPlace' => 'right',
																	'click'=>"js:function(score, evt) {
																				$.post('/user/profile/rating',{score:score, userid:".Yii::app()->user->getId()
																				.",rateduserId:".$sidemodel->id." },
																						function(data){
																							
																				});
																				}"
																	),
																	'htmlOptions' => array(
																						'class' => 'new-half-class'
																						),
																	));
								 }
							}*/
							 ?>
                              </div>-->
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
							// find no of deny for that user
							$countarr = UserFriends::model()->denycount(Yii::app()->user->getId(),$sidemodel->id);
						}
								?>
                            </div>
                        </aside>
                    </section>
                        	<?php
                            if($role=='pm' && ($sidemodel->id!= Yii::app()->user->getId()))
							{?>
								<section class="profile_block">
								<?php
								if($checkfriendsobj[0]['isfriend']=='no')
									{
										if(count($countarr)>=2){?>
                                        
								<aside class="profile"><a  href="javascript:void(0);" class="normalTip popupopen" 									                                onclick="showpopup('denyrfc','<?php echo Yii::app()->user->getId(); ?>', '<?php echo                                 $sidemodel->id; ?>');" title="<?php echo UserModule::t('Request for contact'); ?>"> </a>                                 </aside>
                                
								<?php }else
										{
											$Userdetails =Yii::app()->db->createCommand("SELECT * FROM `user_friends`                                            where user_id='".Yii::app()->user->id."' AND friend_id='".$sidemodel->id."'                                            AND status=0")->queryAll();
											
								            $UserFriendsdetails =Yii::app()->db->createCommand("SELECT * FROM  `user_friends` where user_id='".$sidemodel->id."' AND friend_id='".Yii::app()->user->id."' AND status=0")->queryAll();
										
											if($Userdetails)
	 							              {?>
								               <aside class="profile"><a href='javascript:void(0);' class="normalTip                                                popupopen"  title="<?php echo UserModule::t('Request Already Sent'); ?>"
                                               onClick="showpopup('userrfcpending','<?php echo Yii::app()->user->getId                                                 (); ?>', '<?php echo $sidemodel->id; ?>');"> </a></aside>
								           	<?php }
											
											elseif($UserFriendsdetails)
											{?>
								               <aside class="profile"><a href='javascript:void(0);' class="normalTip                                                popupopen"  title="<?php echo UserModule::t('Request Already Sent'); ?>"
                                               onClick="showpopup('friendrfcpending','<?php echo Yii::app()->user->getId                                                 (); ?>', '<?php echo $sidemodel->id; ?>');"> </a></aside>
								           	<?php 
											}
											
											else{?>
										         <aside class="profile"><a href="javascript:void(0);" class="normalTip                                                 popupopen" onclick="showpopup('rfc','<?php echo Yii::app()->user->getId                                                 (); ?>', '<?php echo $sidemodel->id; ?>');" title="<?php echo UserModule                                                 ::t('Request for contact'); ?>"> </a></aside>
										  <?php }
										}
									}else
									{
										?>
								   <aside class="writemsg"><a href="<?php echo  Yii::app()->createUrl('message/compose/')                                   .'/?sendto='.base64_encode($sidemodel->getAttribute('username')).'&sid='.base64_encode                                  ($sidemodel->id); ?>" class="normalTip"  title="<?php echo UserModule::t('Write message                                  '); ?>"></a></aside>    
										<?php
									}
									?>
								  <aside class="addtofavorite"><a rel="<?php  echo $sidemodel->id; ?>" href=                                  "javascript:void(0);" class="normalTip"  title="<?php echo UserModule::t('Add to Favorite'); ?>"></a></aside>
							   <?php
									if($checkfriendsobj[0]['isfriend']=='yes')
									{
										if(isset($_REQUEST['id']))
										{
										  $online_usersmodel = OnlineUsers::model()->find('user_id=:user_id',                                          array(':user_id'=>$sidemodel->id));		
										  if($online_usersmodel->online==1)
											{
											?>
										<aside class="chat  last"><a href="javascript:void(0);"  class="normalTip" title="<?php echo UserModule::t('Chat'); ?>"  onclick="javascript:chatWith('<?php echo $_REQUEST['id']; ?>')"></a></aside>                        <?php
											}else
											{
											?>
										<aside class="offlinechat  last"><a href="javascript:void(0);"  class="normalTip" title="<?php echo UserModule::t('User is offline'); ?>"></a></aside>
										 <?php }
										}
									}else
									{  // paid member but not friend so need to RFC first
									$Userdetails =Yii::app()->db->createCommand("SELECT * FROM `user_friends` where user_id='".Yii::app()->user->id."' AND friend_id='".$sidemodel->id."' AND status=0 ")->queryAll();
									
									$UserFriendsdetails =Yii::app()->db->createCommand("SELECT * FROM `user_friends` where  user_id='".$sidemodel->id."' AND friend_id='".Yii::app()->user->id."' AND status=0")->queryAll();
									
									if($Userdetails)
									{?>
                                        <aside class="chat  last"><a href='javascript:void(0);' class="normalTip popupopen"  title="<?php echo UserModule::t('Request Already Sent'); ?>" onClick="showpopup('userrfcpending','<?php echo Yii::app()->user->getId(); ?>', '<?php echo $sidemodel->id; ?>');"> </a></aside>
										
										<?php }elseif($UserFriendsdetails)
									{?>
                                        <aside class="chat  last"><a href='javascript:void(0);' class="normalTip popupopen"  title="<?php echo UserModule::t('Request Already Sent'); ?>" onClick="showpopup('friendrfcpending','<?php echo Yii::app()->user->getId(); ?>', '<?php echo $sidemodel->id; ?>');"> </a></aside>
										
										<?php }else{?>
                            <aside class="chat last"><a href="javascript:void(0);" class="normalTip popupopen" onclick="showpopup('rfc','<?php echo Yii::app()->user->getId(); ?>', '<?php echo $sidemodel->id; ?>');" title="<?php echo UserModule::t('Request for chat'); ?>"> </a></aside>
                            <?php	}
									}
							   ?>
							   </section>
                            	<?php							
							}else if($sidemodel->id!= Yii::app()->user->getId())
							{
							?>
                           <section class="profile_block">
                        	<aside class="profile"><a href="javascript:void(0);" class="normalTip popupopen" onclick="showpopup('buymember','param1', 'param2');" title="<?php echo UserModule::t('Request for contanct'); ?>"> </a></aside>

                        <!-- need to check already added or not pending -->
 <aside class="addtofavorite"><a href="javascript:void(0);" rel="<?php echo $sidemodel->id; ?>" class="normalTip"  title="<?php echo UserModule::t('Add to Favorite'); ?>"></a></aside>
 	                     	 <aside class="chat last"><a href="javascript:void(0);" class="normalTip popupopen" onclick="showpopup('buymember','param1', 'param2');" title="<?php echo UserModule::t('Chat'); ?>" ></a></aside>
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
					 $('.succes_msg').html('<p><strong>'+complete+'</strong></p>').show('slow');
					setTimeout(function() { $('.succes_msg').fadeOut('slow'); }, 3000);	
					 return false;
					}
					
				})
			return false;
			 
		//The conversation has been unmarked as spam and moved to the Inbox.
	});
});
function pendingpopup()
{
	alert('hello');
}

</script>
