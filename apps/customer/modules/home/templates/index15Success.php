
		<div class="bannerpart">
        <div id="banner">	
			<a href="javaScript:void(0);" class="prev"></a>
			<a href="javaScript:void(0);" class="next"></a>
			
				<div id="sequence">
					<?php  if(!empty($bannersArr)) { ?>
						<ul>
							<?php for($i= 0; $i<count($bannersArr) ; $i++ ) { ?>
								<li>
									<?php if(!empty($bannersArr[$i]['Image'])) {?>
										<?php $bannerPath = '../uploads/website/'.$websiteId.'/banner/'.$bannersArr[$i]['Image'];?>
										<?php echo image_tag($bannerPath,array('class' => "model x animate-in", 'alt' => "Model 1"));?>
									<?php } ?>

									<?php if(!empty($bannersArr[$i]['Title1'])) {?>
										<div class="bannercontent title">
											<?php echo $bannersArr[$i]['Title1'];?>
										</div>
									<?php } ?>
								</li>
							<?php } // End of For Loop ?>
						</ul>
					<?php } ?> <!-- End of IF-->
				</div>	
			</div>
		</div>
	</div>
</header>

<section class="middle" id="home">
	<div class="page">
		<div class="practice-area left">
			<?php include_component('home','userWebsitePracticeArea15');?>
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
		
		<div class="quick-contact right">
			<?php echo include_partial('caseContact15', array('contactForm' => $contactForm ));?>
		</div>
	</div>
</section>