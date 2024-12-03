<section class="favorit arrowlistmenu">
<div class="favorite_block menuheader ">
  Online Users
 </div>
<ul class="msg_lists categoryitems">
    <?php
   foreach($chatusers as $chatusr)
						   {
							   foreach($chatusr as $chatusrval)
						   {
								if(in_array($chatusrval['id'],$onlineusers))
								{
$Profileimg = Yii::app()->db->createCommand("SELECT * FROM `profiles` where user_id='".$chatusrval['id']."'")->queryAll();
						foreach($Profileimg as $Profileimgval)
						   {
							if($Profileimgval['avatar']!=NULL)
									{
	    						     $circularthumbimg=Yii::app()->request->baseUrl.'/'.$Profileimgval['avatar'];
									}else{
								$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/defaultsearch.jpg';
									}
                            
							}
							?>
                                
                                <li>
									<div class="pro_img">
										<img src="<?php echo $circularthumbimg; ?>" class="round_50" />
									</div>
									<div class="msg_block">
										<h4>
										<?php echo CHtml::link($chatusrval['username'],array('/user/profile/'.$chatusrval['username'])); ?></h4>
										
										<p class="date"><?php echo UserModule::t('Last active')?> 
                                             <?php
											   $tmp=date(Yii::app()->getModule('message')->dateFormat, strtotime($chatusrval['lastvisit_at']));
								    $date = new DateTime($tmp);
									echo $date->format('j, F Y');
                                    ?></p>
									</div>
									<div class="icons">
                                       <p> <a href="javascript:void(0);"  class="new_chat" title="<?php echo UserModule::t('Chat with ').$chatusrval['username']; ?>" onclick="javascript:chatWith('<?php echo strtolower($chatusrval['username']); ?>')"></a></p>
									</div>
									<div class="clear"></div>
								</li>
                            <?php
							}
						   }
						}
    ?> 
</ul>
 <div class="favorite_blockoff menuheader ">
  Offline Users
 </div>
<ul class="msg_lists categoryitems">
    <?php
foreach($chatusers as $chatusr)
						   {
							   foreach($chatusr as $chatusrval)
						   {
								if(!in_array($chatusrval['id'],$onlineusers))
								{
									$Profileimg = Yii::app()->db->createCommand("SELECT * FROM `profiles` where user_id='".$chatusrval['id']."'")->queryAll();
						foreach($Profileimg as $Profileimgval)
						   {
							if($Profileimgval['avatar']!=NULL)
									{
	    						     $circularthumbimg=Yii::app()->request->baseUrl.'/'.$Profileimgval['avatar'];
									}else{
								$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/defaultsearch.jpg';
									}
                            
							}
							?>
                                
                                <li>
									<div class="pro_img">
										<img src="<?php echo $circularthumbimg; ?>" class="round_50" />
									</div>
									<div class="msg_block">
										
										<?php echo CHtml::link($chatusrval['username'],array('/user/profile/'.$chatusrval['username'])); ?>
										<p class="date"><?php echo UserModule::t('Last active')?> 
                                             <?php
											   $tmp=date(Yii::app()->getModule('message')->dateFormat, strtotime($chatusrval['lastvisit_at']));
								    $date = new DateTime($tmp);
									echo $date->format('j, F Y');
                                    ?></p>
									</div>
									<div class="icons">
                                       <p> <a href="javascript:void(0);"  class="new_chat_off" title="<?php echo $chatusrval['username'].UserModule::t(' Offline '); ?>"></a></p>
									</div>
									<div class="clear"></div>
								</li>
                            <?php
							}
						   }
						}
    ?> 
</ul>
</section>
