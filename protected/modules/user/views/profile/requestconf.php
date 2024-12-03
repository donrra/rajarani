<article class="container">
	 	<section class="cms_block">
			<aside class="content">
		
              	<div class="wrapper s_wrapper">
                   <div class="heightblock">
				<div class="conf_message" style="height:300px;">
         		
                <?php
				 $baseUrl = Yii::app()->baseUrl;
				if($usrdata['status']==1)
				{
				echo "You have successfully accepted the request.";
				}else if($usrdata['status']==2)
				{
				echo "You have successfully denied the request.";
				}else{
				?>
                
         		<span class="rfc_confirm">Do you wish to accept the contact request from <span><?php echo $usrdata['sendername']; ?></span>?</span>
                
               <?php 
					$arrayAuthRoleItems = Yii::app()->authManager->getAuthItems(2, $usrdata['friend_id']);
					$arrayKeys = array_keys($arrayAuthRoleItems);
					$role = strtolower ($arrayKeys[0]);
					if($role=='pm'){?>
					
					
					<section class="accept_rfc1 "><a href="<?php echo $usrdata['deny_url']; ?>"><?php echo UserModule::t('Deny');?></a><em></em></section>
                    
                    <section class="accept_rfc1"><a href="<?php echo $usrdata['accept_url']; ?>"><?php echo UserModule::t('Accept'); ?></a><em></em></section>
                
   			 <?php }else{?>
             
                <section class="accept_rfc1 "><aside class="profile"><a href="javascript:void(0);" class="normalTip popupopen" onclick="showpopup('buymember','param1', 'param2');"><?php echo UserModule::t('Deny');?></a>
                <em></em></aside>
                </section>
                
				 <section class="accept_rfc1 "><aside class="profile">
                        	<a href="javascript:void(0);" class="normalTip popupopen" onclick="showpopup('buymember','param1', 'param2');"><?php echo UserModule::t('Accept'); ?></a><em></em></aside></section>
                
				
				<?php }?>
    
    			<?php
				}
				?>
                  </div>
            </div>
          	</div>
			</aside>
		</section>
	 </article>
      <section class="popup_block">
<div class="popupbg"></div>
<div class="open_popup">
<div class="popup_top">
<p><a class="button1 closebtn" href="javascript:void(0)"><span><sup class="close"></sup></span><em></em></a></p>
</div>
<div class="popup_body">

</div>
</div>
</section>