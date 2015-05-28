	<section class="banner">
		<div class="page">
			<div class="bannerpart">
				<div id="banner">
					<div id="sequence">
						<?php echo image_tag('theme10/bt-prev.png',array('class' => "prev"));?>
						<?php echo image_tag('theme10/bt-next.png',array('class' => "next"));?>
						<?php  if(!empty($bannersArr)) { ?>
							<ul>
								<?php for($i= 0; $i<count($bannersArr) ; $i++ ) { ?>
										<li>
											<?php if(!empty($bannersArr[$i]['Image'])) {?>
												<?php $bannerPath = '../uploads/website/'.$websiteId.'/banner/'.$bannersArr[$i]['Image'];?>
												<?php echo image_tag($bannerPath,array('class' => "model x animate-in", 'alt' => "Model 1"));?>
											<?php } ?>
										
											<?php if(!empty($bannersArr[$i]['Title1']) || !empty($bannersArr[$i]['Title2'])): ?>
												<div class="title bannercontent">
													<?php if(!empty($bannersArr[$i]['Title1'])) {?>
														<h3>
															<?php echo $bannersArr[$i]['Title1'];?>
														</h3>
													<?php } ?>
													<?php if(!empty($bannersArr[$i]['Title2'])) {?>
														<h2>
														<?php echo $bannersArr[$i]['Title2'];?>
														</h2>
													<?php } ?>
												</div>
											<?php endif; ?>
										</li>
								<?php } // End of For Loop ?>
							</ul>
						<?php } // End of IF
						?>
					</div>	
				</div>
			</div>
			
			<div class="tellus-form">
				<?php echo include_partial('caseContact10', array('contactForm' => $contactForm ));?>
			</div>
		</div>
	</section>

	<?php include_component('theme','menu10'); ?>

	<section class="middle" id="home">
		<div class="page">
			<div class="practice-area left">
				<?php include_component('home','userWebsitePracticeArea10'); // Shows Website Practice Area?>
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