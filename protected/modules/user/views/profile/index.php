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
                    <aside class="heading_latest_block">
                    <h2> <?php echo UserModule::t('Latest profiles'); ?></h2>
                    </aside>
                    <aside class="search_lists">
								<ul>
									<?php
									$id=0;
								foreach($la_lastactivated as $usersval)
								{
									$searchprofile=Yii::app()->db->createCommand("SELECT * from profiles WHERE user_id='".$usersval['user_id']."'")->queryAll();
									
									if($usersval[0]['user_id']==Yii::app()->user->getId())
									continue;
									if($searchprofile[0]['avatar']!=NULL)
										{
										
										$mystring =$searchprofile[0]['avatar'];
										$findme   = 'gallery';
										$pos = strpos($mystring, $findme);
										
											if($pos!==false) 
											{	
;												$searchstr=substr($mystring,8);
												// album pic as profile image
											 $imagearr=  GalleryPhoto::model()->findByAttributes(array('profile'=>$searchstr));
											
												//access level 1 => all
												// 2 => only friends 
												if($imagearr->accesslevel==1)
												{
													// all to show
													$circularthumbimg=Yii::app()->request->baseUrl.'/'.$searchprofile[0]['avatar'];
													
												}else
												{
												//only friends show
												$checkfriendsobj=UserFriends::model()->havefriends($searchprofile[0]['user_id'],Yii::app()->user->getId());
													if($checkfriendsobj[0]['isfriend']=='no')
													{
													$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/accepted_only.png';
													}else
													{
														
													$circularthumbimg=Yii::app()->request->baseUrl.'/'.$searchprofile[0]['avatar'];
													}
												
												}
											
											}else
											{
												if($searchprofile[0]['gender']=='Female')
												//default pic as profile image
												$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/woman.jpg';
												else
												$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/default.jpg';
											}
										}else{
											
										if($searchprofile[0]['gender']=='Female')
												//default pic as profile image
												$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/woman.jpg';
												else
												$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/default.jpg';
										}
								
									?>
                                    
                                    <li>
										
											  <div class="block block_search">
											<p class="image_block">
					<img src="<?php echo $circularthumbimg; ?>" class="round_50" />
                                    
                                    		</p>
                                           
											<p class="about_image">
												<strong>
												<?php 
												$searchuser=Yii::app()->db->createCommand("SELECT username from users WHERE id='".$usersval['user_id']."'")->queryRow();
												echo CHtml::link($searchuser['username'],array('/user/profile/'.$searchuser['username']));
												 ?></strong>
												<span class="msg offline"><?php
												 if($ind_user['online']==1)
												 echo UserModule::t('online');
												 else
												 echo UserModule::t('offline');
												  ?>

                                                  <span style="padding-left: 30px;"><?php 
												 if($searchprofile[0]['dob']=='0000-00-00')
												  echo '';
												  else {
													 echo ( dateDiff(date('Y-m-d'),$searchprofile[0]['dob'])) ;} ?>
												 </span>
                                                  <span style="padding-left: 30px;"><?php 
												  if($searchprofile[0]['residingcountry']=='Please choose')
												  {
												  	echo '';
												  }
												  elseif($searchprofile[0]['residingcountry']=='')
												  {
												  	echo '';
												  }
												 else
												  {
													  echo ''.$searchprofile[0]['residingcountry'];} ?></span>
                                                  
                                                  
                                                  </span>
                                                  
												<span class="date"><?php echo UserModule::t('Last active')?> 
                                             <?php
											    $searchuser=Yii::app()->db->createCommand("SELECT lastvisit_at from users WHERE id='".$usersval['user_id']."'")->queryRow();
											   $tmp=date(Yii::app()->getModule('message')->dateFormat, strtotime($searchuser['lastvisit_at']));
									$date = new DateTime($tmp);
									echo $date->format('j, F Y, g:i a');
                                    ?>
                                                </span>
                                                
												<?php
											
										    $login_user=Yii::app()->db->createCommand("SELECT * from profiles WHERE user_id='".$usersval['user_id']."'")->queryRow();
                                            $search_user=Yii::app()->db->createCommand("SELECT * from profiles WHERE user_id='".Yii::app()->user->getId()."'")->queryRow();
											
											$match_residing_percentage=0;
											$match_age_percentage=0;
											$match_postal_percentage=0;
											$match_city_percentage=0;
											$match_haschildren_percentage=0;
											$match_ethnicity_percentage=0;
											$match_profession_percentage=0;
											$match_height_percentage=0;
											$match_weight_percentage=0;
											$match_tattoos_percentage=0;
											$match_smoke_percentage=0;
											$match_alochol_percentage=0;
											$match_exercise_percentage=0;
											$match_politics_percentage=0;
											$match_education_percentage=0;
											$match_religion_percentage=0;
											$match_religious_percentage=0;
											$match_income_percentage=0;
											$match_want_children_percentage=0;
											$match_diet_percentage=0;
											
											if($login_user['residingcountry']==$search_user['match_residingcountry'] && ($login_user['residingcountry']!='will tell you later') && ($search_user['match_residingcountry']!='will tell you later'))
											{
												$match_residing_percentage=5;
											}
											
											if($login_user['dob']!='0000-00-00' && $search_user['age']!='will tell you later')
											{
												$login_user_dob=dateDiff(date('Y-m-d'),$login_user['dob']); 
												$search_user_dob=explode('-',$search_user['age']);
												if(in_array($login_user_dob,$search_user_dob))
												{
													$match_age_percentage=5;
												}
											}
											
											if($login_user['postnr']==$search_user['postal_code'] && ($login_user['postnr']!=0) && ($search_user['postal_code']!=0))
											{
												 $match_postal_percentage=5;
											}
											
											if($login_user['city']==$search_user['match_city'] && ($login_user['city']!='') && ($search_user['match_city']!=''))
											{
												$match_city_percentage=5;
											}
											
											if($login_user['havechildren']==$search_user['has children'] && ($login_user['havechildren']!='will tell you later')
											 && ($search_user['has children']!='will tell you later') &&($login_user['havechildren']!='')
											 && ($search_user['has children']!=''))
											{
												$match_haschildren_percentage=5;
											}
											
											if($login_user['ethnicity']!='' && $search_user['match_ethnicity']!='')
											{
												$search_user_ethnicity=explode(',',$search_user['match_ethnicity']);
												$login_user_ethnicity=explode(',',$login_user['ethnicity']);
												$val=array_intersect($search_user_ethnicity,$login_user_ethnicity);
												if($val)
												{
													 $match_ethnicity_percentage=5;
												}
											}
											
											if($login_user['profession']!='' && $search_user['match_profession']!='')
											{
												$search_user_profession=explode(',',$search_user['match_profession']);
												$login_user_profession=explode(',',$login_user['profession']);
												$val=array_intersect($search_user_profession,$login_user_profession);
												if($val)
												{
													$match_profession_percentage=5;
												}
											}
											
											if($login_user['height']!='will tell you later' && $search_user['match_height']!='will tell you later' && $login_user['height']!='' && $search_user['match_height']!='')
											{
												$search_user_height=explode('-',$search_user['match_height']);
												if(in_array($login_user['height'],$search_user_height))
												{
													$match_height_percentage=5;
												}
											}
											
											if($login_user['weight']!='will tell you later' && $search_user['match_weight']!='will tell you later' && $login_user['weight']!='' && $search_user['match_weight']!='' )
											{
												$search_user_weight=explode('-',$search_user['match_weight']);
												if(in_array($login_user['weight'],$search_user_weight))
												{
													 $match_weight_percentage=5;
												}
											}
											
											if($login_user['tattoo']!='will tell you later' && $search_user['has_tattoos']!='will tell you later' && $login_user['tattoo']!='' && $search_user['has_tattoos']!='')
											{
												if($search_user['has_tattoos']=='Yes' && $login_user['tattoo']!='none')
												{
													 $match_tattoos_percentage=5;
												}
												if($search_user['has_tattoos']=='No' && $login_user['tattoo']=='none')
												{
													 $match_tattoos_percentage=5;
												}
											}
											
											if($login_user['smoke']==$search_user['match_smoke'] && $login_user['smoke']!='will tell you later' && $search_user['match_smoke']!='will tell you later' && $login_user['smoke']!='' && $search_user['match_smoke']!='')
											{
												 $match_smoke_percentage=5;
											}
											
											if($login_user['alcohol']==$search_user['match_alochol'] && $login_user['alcohol']!=
											'Will tell you later' && $search_user['match_alochol']!='Will tell you later' && $login_user['alcohol']!='' && $search_user['match_alochol']!='')
											{
												 $match_alochol_percentage=5;
											}
											
											if($login_user['exercise']==$search_user['match_exercise'] && $login_user['exercise']!='will tell you later' && $search_user['match_exercise']!='will tell you later' && $login_user['exercise']!='' && $search_user['match_exercise']!='')
											{
												 $match_exercise_percentage=5;
											}
											
											if($login_user['politics']==$search_user['match_politics'] && $login_user['politics']!='will tell you later' && $search_user['match_politics']!='will tell you later' && $login_user['politics']!='' && $search_user['match_politics']!='')
											{
												 $match_politics_percentage=5;
											}
											
											if($login_user['education']==$search_user['match_education'] && $login_user['education']!='will tell you later' && $search_user['match_education']!='will tell you later' && $login_user['education']!='' && $search_user['match_education']!='')
											{
												 $match_education_percentage=5;
											}
											
											if($login_user['religion']==$search_user['match_religion'] && $login_user['religion']!='Will tell you later' && $search_user['match_religion']!='Will tell you later' && $login_user['religion']!='' && $search_user['match_religion']!='')
											{
												 $match_religion_percentage=5;
											}
											
											if($login_user['religious']==$search_user['match_religious'] && $login_user['religious']!='will tell you later' && $search_user['match_religious']!='will tell you later' && $login_user['religious']!='' && $search_user['match_religious']!='')
											{
												 $match_religious_percentage=5;
											}
											
											if($login_user['income']==$search_user['match_income'] && $login_user['income']!='' && $search_user['match_income']!=''  && $login_user['income']!='' && $search_user['match_income']!='')
											{
												 $match_income_percentage=5;
											}
											
											if($login_user['wantchildren']==$search_user['want_children'] && $login_user['wantchildren']!='will tell you later' && $search_user['want_children']!='will tell you later' && $login_user['wantchildren']!='' && $search_user['want_children']!='')
											{
												 $match_want_children_percentage=5;
											}
											
											if($login_user['diet']==$search_user['match_diet'] && $login_user['diet']!='will tell you later' && $search_user['match_diet']!='will tell you later' && $login_user['diet']!='' && $search_user['match_diet']!='')
											{
												 $match_diet_percentage=5;
											}
											
											$match_percentage=$match_residing_percentage+$match_age_percentage+$match_postal_percentage+$match_city_percentage+$match_haschildren_percentage+$match_ethnicity_percentage+$match_profession_percentage+$match_height_percentage+$match_weight_percentage+$match_tattoos_percentage+$match_smoke_percentage+$match_alochol_percentage+$match_exercise_percentage+$match_politics_percentage+$match_education_percentage+$match_religion_percentage+$match_religious_percentage+$match_income_percentage+$match_want_children_percentage+$match_diet_percentage;										
											?>
											<!--<span class="match"><?php echo $match_percentage.'% match';;
											 ?></span>-->
                                             
											</p>
                                            
                                             <?php
                                            
								 /*$userratings=Yii::app()->db->createCommand("select rating from userratings where userid='".Yii::app()->user->getId()."' AND rateduserId='".$usersval['user_id']."'")->queryAll();
								 if(count($userratings)=='0')
								 {
									  $this->widget('ext.DzRaty.DzRaty', array(
																	'name' => 'my_rating_field'.$id,
																	'value' => $userratings[0]['rating'],
																	'options' => array(
																	'half'=>TRUE,
																	//'cancel' => TRUE,
																	//'cancelPlace' => 'right',
																	'click'=>"js:function(score, evt) {
																				$.post('".Yii::app()->request->baseUrl."/user/profile/rating',{score:score, userid:".Yii::app()->user->getId().",rateduserId:".$usersval['user_id']." },
																						function(data){
																				});
																				}"
																	),
																	'htmlOptions' => array(
																						'class' => 'new-half-class star_new',
																						),
																	));
					            }
								 else{
									  $this->widget('ext.DzRaty.DzRaty', array(
																	'name' => 'my_rating_field'.$id,
																	'value' => $userratings[0]['rating'],
																	'options' => array(
																	'half'=>TRUE,
																	//'cancel' => TRUE,
																	//'cancelPlace' => 'right',
																	'click'=>"js:function(score, evt) {
																				$.post('".Yii::app()->request->baseUrl."/user/profile/ratingupdate',{score:score, userid:".Yii::app()->user->getId().",rateduserId:".$usersval['user_id']." },
																			function(data){
																							
																				});
																				}"
																	),
																	'htmlOptions' => array(
																						'class' => 'new-half-class star_new',
																						),
																	));
											 }*/?>
                                            
    <p><a href="javascript:void(0);" class="addtofavorite" rel="<?php echo $searchprofile[0]['user_id']; ?>" title="<?php echo UserModule::t('Add to favorites'); ?>"></a></p>
										 </div>
									</li>
                                    <?php	
									$id++;}
									?>
								</ul>
							</aside>
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
   <script type="text/javascript">
$(document).ready(function() {

		
		$('a.addtofavorite').click(function()
		{
		
			var favid=$(this).attr('rel');
				
			 $('.succes_msg').html('<p><strong></strong></p>');
			console.log('added to favorites....'+favid);
					$.ajax({
					type : 'POST', 
					url: <?php echo "'".Yii::app()->createUrl('/user/profile/addtofavorite')."'"; ?>,
					datatype: "json",
					data: { 'favid':favid},
					success: function(complete){
					 $('.succes_msg').html('<p><strong>'+complete+'</strong></p>').show('slow');
					setTimeout(function() { $('.succes_msg').fadeOut('slow'); }, 2000);	
					 return false;
					}
					
				})
			return false;
			 
		//The conversation has been unmarked as spam and moved to the Inbox.
	});
	
	///////////////////////
	
	
});
</script>