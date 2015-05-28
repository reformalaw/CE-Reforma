<section class="banner">
	<div class="page">
		<div id="sequence">
			<?php echo image_tag("theme13/bt-prev.png", array("class"=>"prev"))?>
			<?php echo image_tag("theme13/bt-next.png", array("class"=>"next"))?>

			<?php  if(!empty($bannersArr)) { ?>
				<ul>
					<?php for($i= 0; $i<count($bannersArr) ; $i++ ) { ?>
						<li>
							<?php if(!empty($bannersArr[$i]['Image'])) {?>
								<?php $bannerPath = '../uploads/website/'.$websiteId.'/banner/'.$bannersArr[$i]['Image'];?>
								<?php echo image_tag($bannerPath,array('class' => "model x animate-in", 'alt' => "Model 1"));?>
							<?php } ?>
							
							<h1 class="subtitle animate-in">
								<?php if(!empty($bannersArr[$i]['Title1'])) {?>
									<?php echo $bannersArr[$i]['Title1'];?>
								<?php } ?>
							</h1>
						
							<h2 class="subtitle animate-in">
								<?php if(!empty($bannersArr[$i]['Title2'])) {?>
									<?php echo $bannersArr[$i]['Title2'];?>
								<?php } ?>
							</h2>
							
						</li>
					<?php } // End of For Loop ?>
				</ul>
			<?php } ?> <!-- End of IF-->
		</div>
	</div>
</section>

<section class="middle" id="right-column">
	<div class="page">
		<div class="practice-area right">
			<?php include_component('home','userWebsitePracticeArea13');?>
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
            <div class="quick-contact">
				<?php echo include_partial('caseContact13', array('contactForm' => $contactForm ));?>
			</div>
		</div>

	</div>
</section>