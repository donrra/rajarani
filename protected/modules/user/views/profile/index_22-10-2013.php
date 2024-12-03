	 <article class="container">
	 	<div class="newprofile">
        <em class="shadow_1"></em>
      
	 	<div class="wrapper">
			<div class="white_body">
				<div class="left_container">
					<div class="left_block equal">
						<section class="landingprofile_block">
                        	<ul>
                               <li>
                               <h1><?php echo ($data['visit_profile_count'])? $data['visit_profile_count']: '0' ; ?></h1>
                                <?php echo UserModule::t('members visited your profile the last 7 days'); ?>
                                </li>
                              
                                 <li>
                               <h2><?php echo ($data['search_profile_count'])? $data['search_profile_count']: '0' ; ?></h2>
                              	<?php echo UserModule::t('times your profile was shown in search results'); ?>
                                  </li>
                               
                              
                               <li>
                               <!-- <h3>8</h3>
                             new flirts has been
                              sent you way-->

                               
                               </li>
                           </ul>
                        </section>
                        
					</div>
				</div>
				<div class="right_container equal">
                	
                     <?php  $this->widget('landingsideprofilewidget',array('show_editbtn'=>'yes')); ?>  
                      <!-- added poll widget -->
                        
                        <section class="block_Afstemning">
                        <p><?php echo UserModule::t('Poll:'); ?></p>
                        </section>
                        <?php $this->widget('EPoll'); ?>
                     <!--  end poll widget-->
                    <div style="clear:both;border-bottom:solid 1px #DDDDDD;height:5px;"></div>
					<section class="block-space">
					</section>
                </div>
                <div class="clear"></div>
			</div>
		</div>
	 </div>
     </article>
   