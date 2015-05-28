	<section class="banner">
      <div id="banner">
		<?php echo image_tag('theme11/bt-prev.png', array('class'=>"prev"));?>
		<?php echo image_tag('theme11/bt-next.png', array('class'=>"next"));?>
			
			<div id="sequence">
				<?php  if(!empty($bannersArr)) { ?>
					<ul>
					<?php for($i= 0; $i<count($bannersArr) ; $i++ ) { ?>
							<li>
								<?php if(!empty($bannersArr[$i]['Image'])) {?>
									<?php $bannerPath = '../uploads/website/'.$websiteId.'/banner/'.$bannersArr[$i]['Image'];?>
									<?php echo image_tag($bannerPath,array('class' => "model x animate-in", 'alt' => "Model 1"));?>
								<?php } ?>
							
								<h2 class="title animate-in">
									<?php if(!empty($bannersArr[$i]['Title1'])) {?>
										<?php echo $bannersArr[$i]['Title1'];?>
									<?php } ?>
								</h2>
							
								<?php if(!empty($bannersArr[$i]['Title2']) || !empty($bannersArr[$i]['Title3'])): ?>
									<h3 class="subtitle results-box animate-in">
                                    	<span>
											<?php if(!empty($bannersArr[$i]['Title2'])) {?>
                                                <?php echo $bannersArr[$i]['Title2'];?>
                                            <?php } ?>
										</span>										
											<?php if(!empty($bannersArr[$i]['Title3'])) {?>
												<?php echo $bannersArr[$i]['Title3'];?>
											<?php } ?>										
									</h3>
								<?php endif; ?>
							
							</li>
					<?php } // End of For Loop ?>
					</ul>
				<?php } // End of IF
				?>
			</div>
		</div>
	</section>


	<section class="middle" id="left-column">
		<div class="page">
			<div class="practice-area left">
				<?php include_component('home','userWebsitePracticeArea11'); // Shows Website Practice Area?>
			</div>
			<div class="content-area right">
				<?php if (($homeData->getTitle() != '')) { ?>
					<h2>
						<span><?php echo $homeData->getTitle(); ?></span>
					</h2>
				<?php } ?>
				<?php if (($homeData->getContent() != ''))  { ?>
					<div class="content-text">
						<?php echo html_entity_decode($homeData->getContent()); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>