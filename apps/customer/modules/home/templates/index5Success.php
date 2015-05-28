<section class="banner">
	<div class="page">
		<div class="quick-contact">
			<?php echo include_partial('caseContact5', array('contactForm' => $contactForm ));?>
		</div>
		<div id="sequence">
			<?php echo image_tag("theme5/bt-next.png", array("class"=>"next"))?>
			<?php echo image_tag("theme5/bt-prev.png", array("class"=>"prev"))?>
				<?php  if(!empty($bannersArr)) { ?>
					<ul>
						<?php for($i= 0; $i<count($bannersArr) ; $i++ ) { ?>
							<li>
								<?php if(!empty($bannersArr[$i]['Image'])) {?>
									<?php $bannerPath = '../uploads/website/'.$websiteId.'/banner/'.$bannersArr[$i]['Image'];?>
									<?php echo image_tag($bannerPath,array('class' => "model x animate-in", 'alt' => "Model 1"));?>
								<?php } ?>

								<?php if(!empty($bannersArr[$i]['Title1']) || !empty($bannersArr[$i]['Title2'])): ?>
									<h1 class="subtitle animate-in"><span class="subtitle animate-in">
										<?php echo image_tag("theme5/banner-img1.png")?>
										<?php if(!empty($bannersArr[$i]['Title1'])) {?>
											<?php echo $bannersArr[$i]['Title1'];?>
										<?php } ?></span>
										<?php if(!empty($bannersArr[$i]['Title2'])) {?>
											<?php echo $bannersArr[$i]['Title2'];?>
										<?php } ?>
										<?php echo image_tag("theme5/banner-img2.png")?>
									</h1>
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
			<?php include_component('home','userWebsitePracticeArea5'); ?>
		</div>
		<div class="content-area right">
			<?php if (($homeData->getTitle() != '')) { ?>
				<h2><span><?php echo $homeData->getTitle(); ?></span></h2>
			<?php } ?>
			<?php if (($homeData->getContent() != ''))  { ?>
				<div class="content-text">
					<?php echo html_entity_decode($homeData->getContent()); ?>
				</div>
			<?php } ?>
		</div>
	</div>
</section>