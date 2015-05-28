<section class="banner">
	<div class="page">
		<div id="sequence">
			<?php image_tag("theme19/bt-prev.png", array("class"=>"prev"));?>
			<?php image_tag("theme19/bt-next.png", array("class"=>"next"));?>
			<?php  if(!empty($bannersArr)) { ?>
				<ul>
					<?php for($i= 0; $i<count($bannersArr) ; $i++ ) { ?>
						<li>
							<?php if(!empty($bannersArr[$i]['Title1']) || !empty($bannersArr[$i]['Title2']) ): ?>
								<h2 class="title subtitlebg animate-in">
									<?php if(!empty($bannersArr[$i]['Title1'])) {?>
										<span><?php echo $bannersArr[$i]['Title1'];?></span>
									<?php } ?>
									<?php if(!empty($bannersArr[$i]['Title2'])) {?>
										<p><?php echo $bannersArr[$i]['Title2'];?></p>
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

<section class="middle" id="right-column">
	<div class="box-shedow">
		<div class="page">
			<div class="content-box-main">
				<?php include_component('home','textWidget19', array('widgetNumber'=> 1));?>
				<?php include_component('home','textWidget19', array('widgetNumber'=> 2));?>
				<?php include_component('home','textWidget19', array('widgetNumber'=> 3));?>
				<?php include_component('home','textWidget19', array('widgetNumber'=> 4));?>
			</div>

			<div class="practice-area right">
				<?php include_component('home','userWebsitePracticeArea19'); ?>
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
			</div>

		</div>
	</div>
</section>