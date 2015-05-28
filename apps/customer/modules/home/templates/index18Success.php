<section class="banner">
	<div class="page">
       <div id="banner">	
		<?php echo image_tag("theme18/bt-prev.png",array("class"=>"prev")); ?>
		<?php echo image_tag("theme18/bt-next.png",array("class"=>"next")); ?>
		
			<div id="sequence">
				<?php  if(!empty($bannersArr)) { ?>
					<ul>
						<?php for($i= 0; $i<count($bannersArr) ; $i++ ) { ?>
							<li>
								
								<?php if(!empty($bannersArr[$i]['Title1'])) {?>
									<h2 class="title animate-in">
										<?php echo $bannersArr[$i]['Title1'];?>
									</h2>
								<?php } ?>

								<?php if(!empty($bannersArr[$i]['Title2'])) {?>
									<h3 class="subtitle animate-in">
										<?php echo $bannersArr[$i]['Title2'];?>
									</h3>
								<?php } ?>

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
	</div>
</section>

<section class="middle-form">
	<div class="page">
		<?php echo include_partial('caseContact18', array('contactForm' => $contactForm ));?>
	</div>
</section>

<section class="middle" id="home">
	<div class="page">
		<div class="practice-area right">
			<?php include_component('home','userWebsitePracticeArea18'); ?>
		</div>

		<div class="content-area">
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