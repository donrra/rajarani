<?php
	$this->pageTitle = $page['page_title'];
	$this->seoKeywords = $page['meta_keywords'];
	$this->seoDescription = $page['meta_description'];

?>
     <article class="container <?php if($page['internalname']=='contact'){ echo 'contact_block';} ?>">
	 	<section class="cms_block">
			<aside class="content">
				<div class="wrapper s_wrapper">
                	
					
					<?php 
					if($page['internalname']=='contact')
					{
					?>
                    	<div class="white_body white_nbody">
                   	 <div class="left_container">
                      <?php
                        $model=new ContactForm;
						if(isset($_POST['ContactForm']))
						{
							$model->attributes=$_POST['ContactForm'];
							if($model->validate())
							{
								$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
								$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
								$headers="From: $name <{$model->email}>\r\n".
									"Reply-To: {$model->email}\r\n".
									"MIME-Version: 1.0\r\n".
									"Content-type: text/plain; charset=UTF-8";
				
								mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
								Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
								$this->refresh();
							}
						}
						echo $this->renderPartial('_contact', array('model'=>$model));
						?>
                            </div>
                            <div class="clear"></div>
                        </div>
						<?php
											
					}else
					{
					 ?>
                     <h2><?php echo $page['page_title']; ?></h2>
                     <?php
						echo '<p>'.$page['content'].'</p>';
					}
					?>
                    	
				</div>
			</aside>
		</section>
	 </article>
