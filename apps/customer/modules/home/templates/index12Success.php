<section class="banner">
	<div class="page">
		<div id="sequence">
			<?php echo image_tag('theme12/bt-prev.png', array('class'=>"prev"));?>
			<?php echo image_tag('theme12/bt-next.png', array('class'=>"next"));?>
			<?php  if(!empty($bannersArr)) { ?>
				<ul>
					<?php for($i= 0; $i<count($bannersArr) ; $i++ ) { ?>
						<li>
							<?php if(!empty($bannersArr[$i]['Title1'])): ?>
								<h2 class="title animate-in">
									<?php if(!empty($bannersArr[$i]['Title1'])) {?>
										<?php echo $bannersArr[$i]['Title1'];?>
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
			<?php } // End of IF ?>
		</div>
	</div>
</section>

<section class="middle" id="left-column">
	<div class="page">
		<?php include_component('theme','menu12'); ?>
		<div class="practice-area left">
			<?php include_component('home','userWebsitePracticeArea12'); ?>
		</div>
		<div class="content-area right">
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
			<?php echo include_partial('caseContact12', array('contactForm' => $contactForm ));?>
		</div>
	</div>
</section>