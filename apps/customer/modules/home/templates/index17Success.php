<section class="banner-part">
	<div class="page">
		<div class="banner">
			<div id="banner">	
				<div id="sequence">
					<?php  if(!empty($bannersArr)) { ?>
						<ul>
							<?php for($i= 0; $i<count($bannersArr) ; $i++ ) { ?>
								<li>
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

			<div class="our-services">
				<?php include_component('home','textWidget17', array('widgetNumber'=> 1));?>
				<?php include_component('home','textWidget17', array('widgetNumber'=> 2));?>
				<?php include_component('home','textWidget17', array('widgetNumber'=> 3));?>
			</div>
		</div>
		
		<div class="quick-contact">
			<?php echo include_partial('caseContact17', array('contactForm' => $contactForm ));?>
		</div>
	</div>
</section>

<section class="middle" id="home">
	<div class="page">
		<div class="practice-area right">
			<?php include_component('home','userWebsitePracticeArea17'); ?>
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