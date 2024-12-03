<article class="container">
	 	<em class="shadow_1"></em>
	 	<div class="wrapper">
        	<div class="succes_msg"></div>
			<div class="white_nbody">
				<div class="left_container">
					<div class="left_block equal">
						<section class="top_block">
                        	<aside class="heading_text_block">
								<div class="middle_text">
									<h1><?php echo UserModule::t("Friends List")?></h1>
									<h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</h3>
    
    <ul>
    <?php
	foreach($friends as $friend)
	{
		
		$friend = User::model()->findByAttributes(array('id'=>$friend->friend_id));
		
		if($friend->profile->getAttribute('avatar')!=NULL)
		{
		$circularthumbimg=Yii::app()->request->baseUrl.'/'.$friend->profile->getAttribute('avatar');
		}else{
		$circularthumbimg=Yii::app()->request->baseUrl.'/user_avatar/thumb/defaultsearch.jpg';
		}
		
	?>
    <li>
    <section class="profile_pic">
    <aside class="pro_img">
    <div class="img_block">
    <img src="<?php echo $circularthumbimg; ?>">
    </div>
    <p><?php echo $friend->username;?></p>
    </aside>
    </section>
    </li>
    <?php
	}
	?>
    </ul>					
								</div>
							</aside>
                        </section>
         					</div>
				</div>
				<div class="right_container equal">
                	<section class="block-space">
                    </section>
                </div>
                <div class="clear"></div>
			</div>
		</div>
	 </article>
