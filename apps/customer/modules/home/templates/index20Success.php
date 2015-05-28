	<div class="page">
		<div id="sequence">
			<?php echo image_tag("theme20/bt-prev.png",array("class"=>"prev")); ?>
			<?php echo image_tag("theme20/bt-next.png",array("class"=>"next")); ?>
			<?php  if(!empty($bannersArr)) { ?>
				<ul>
					<?php for($i= 0; $i<count($bannersArr) ; $i++ ) { ?>
						<li>
							<?php if(!empty($bannersArr[$i]['Title1']) || !empty($bannersArr[$i]['Title2']) || !empty($bannersArr[$i]['Title3'])): ?>
								<h2 class="title subtitlebg animate-in">
									<?php if(!empty($bannersArr[$i]['Title1'])) {?>
										<?php echo $bannersArr[$i]['Title1'];?>
									<?php } ?>
									<?php if(!empty($bannersArr[$i]['Title2'])) {?>
										<span><?php echo $bannersArr[$i]['Title2'];?></span>
									<?php } ?>
									<?php if(!empty($bannersArr[$i]['Title3'])) {?>
										<p><?php echo $bannersArr[$i]['Title3'];?></p>
									<?php } ?>
								</h2>
							<?php endif; ?>

							<?php if(!empty($bannersArr[$i]['Image'])) {?>
								<?php $bannerPath = '../uploads/website/'.$websiteId.'/banner/'.$bannersArr[$i]['Image'];?>
								<?php echo image_tag($bannerPath,array('class' => "model x animate-in", 'alt' => "Model 1"));?>
							<?php } ?>

						</li>
					<?php } // End of For Loop ?>
				</ul>
			<?php } ?> <!-- End of IF-->
		</div>
	</div>
</section>

<section class="quick-main">
	<div class="page">
		<?php echo include_partial('caseContact20', array('contactForm' => $contactForm ));?>
	</div>
</section>

<section class="middle" id="right-column">
	<div class="page">
		<div class="practice-area right">
			<?php include_component('home','userWebsitePracticeArea20'); ?>
		</div>
		<div class="content-area left">
			<?php if (($homeData->getTitle() != '')) { ?>
				<h2>
					<?php echo $homeData->getTitle(); ?>
				</h2>
			<?php } ?>
			<div class="content-text">
				<?php if (($homeData->getContent() != ''))  { ?>
					<?php echo html_entity_decode($homeData->getContent()); ?>
				<?php } ?>
			</div>
		</div>
	</div>
</section>