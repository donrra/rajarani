<script type="text/javascript">
$(document).ready(function() {
	
	//if submit button is clicked
	$('#submit').click(function () {		
		 var urlbaseDir = "<?php echo Yii::app()->request->baseUrl;?>";
		var comment = $('textarea[name=comment]');
		if (comment.val()=='') {
			comment.addClass('hightlight');
			return false;
		} else comment.removeClass('hightlight');
		
		//organize the data properly
		var data =  'comment='  + encodeURIComponent(comment.val());
		
		//disabled all the text fields
		$('.text').attr('disabled','true');
		
		//show the loading sign
		$('.loading').show();
		
		//start the ajax
		$.ajax({
			//this is the php file that processes the data and send mail
			url: urlbaseDir + '/user/profile/process',	
			 
			//GET method is used
			type: "POST",

			//pass the data			
			data: data,		
			
			//Do not cache the page
			cache: false,
			
			//success
			success: function (html) {				
				//if process.php returned 1/true (send mail success)
					//hide the form
					$('.form').fadeOut('slow');					
					//show the success message
					$('.done').fadeIn('slow');
				//if process.php returned 0/false (send mail failed)
			}		
		});
		
		//cancel the submit button default behaviours
		return false;
	});	
});</script>
<script>
		$(document).ready(function(){
			$(".lightbox").lightbox({
			    fitToScreen: true,
			    imageClickClose: false
		    });
		});

	</script>
    <article class="container">
	 	<em class="shadow_1"></em>
	 	<div class="wrapper">
        <div class="succes_msg"></div>
        	<div class="white_body">
				<div class="left_container">
					<div class="left_block equal">
						<!-- Search Block -->
						<section class="top_block">
                        	<aside class="heading_text_block">
								<div class="middle_text">
									<div class="left">
									<h1><?php echo UserModule::t('My Photos'); ?></h1>
									<h3><?php echo UserModule::t('Upload, edit or share your photos'); ?></h3>
									</div>
									<div class="drop_pic_block" style="display:none;">
										<div class="left_drag">
														<p>
												<!--Drop picture in here<br />or click to pick manually-->.
											</p>
										</div>
										<div class="right_btn">
											<a href="#" class="square">
                                            </a>
											<a href="#" class="close1"></a>
										</div>
									</div>
								</div>
							</aside>
                        </section>
                        <section class="content_block2 no-border">
<?php
  	// render widget in view
$this->widget('GalleryManager', array(
    'gallery' => $gallery,
    'controllerRoute' => 'user/gallery',
	 //route to gallery controller
));
?>
                        </section>
                        <!-- Search Block End -->
					</div>
				</div>
				<div class="right_container equal">
                	 <?php  $this->widget('sideprofilewidget',array('show_editbtn'=>'yes')); ?> 
     				<section class="block-space">
                       <?php  $this->widget('application.components.sitecomment'); ?>
					</section>
                </div>
                <div class="clear"></div>
			</div>
		</div>
	 </article>
