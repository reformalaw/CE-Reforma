<section class="banner">
	<div class="page"> 
       <div id="sequence">  	
			<?php echo image_tag('theme3/bt-prev.png',array('class' => "prev", 'alt' => "Previous Frame"));?>
			<?php echo image_tag('theme3/bt-next.png',array('class' => "next", 'alt' => "Next Frame"));?>
			
				<!--Banner Section-->
					<?php  if(!empty($bannersArr)) { ?>
						<ul>
							<?php for($i= 0; $i<count($bannersArr) ; $i++ ) { ?>
								<li>
									<?php if(!empty($bannersArr[$i]['Title1']) || !empty($bannersArr[$i]['Title2'])): ?>
										
										<?php if(!empty($bannersArr[$i]['Title1'])) {?>
											<h3 class="title subtitle animate-in">
												<?php echo $bannersArr[$i]['Title1'];?>
											</h3>
										<?php } ?>
										
										<?php if(!empty($bannersArr[$i]['Title2'])) {?>
											<p class="title get-started-link animate-in"><?php echo $bannersArr[$i]['Title2'];?></p>
										<?php } ?>

									<?php endif; ?>

									<?php if(!empty($bannersArr[$i]['Image'])) {?>
										<?php $bannerPath = '../uploads/website/'.$websiteId.'/banner/'.$bannersArr[$i]['Image'];?>
										<?php echo image_tag($bannerPath,array('class' => "model x animate-in", 'alt' => $bannersArr[$i]['Image']));?>
									<?php } ?>  
									
								</li>
							<?php } // End of For Loop ?>
			            </ul>
                    <?php } // End of IF
                    ?>
                    <!--End of Banner Section-->
			</div>
	</div>
</section>

<!--START Widget Part-->
<section class="service-part">
	<div class="page">
		<?php include_component('home','textWidget3', array('widgetNumber'=> 1));?>
		<?php include_component('home','textWidget3', array('widgetNumber'=> 2));?>
		<?php include_component('home','textWidget3', array('widgetNumber'=> 3));?>
		<?php include_component('home','textWidget3', array('widgetNumber'=> 4));?>
	</div>
</section>
<!--END Widget Part-->


<section class="middle" id="left-column">
	<div class="page">
		<!--START Left Practice Area-->
		<div class="practice-area left">
			<?php include_component('home','userWebsitePracticeArea3'); // Shows Website Practice Area?> 
		</div>
		<!--END Left Practice Area-->

		<!--START Middle Content Area -->
		<div class="content-area right">
			<?php if (($homeData->getTitle() != '')) { ?>
				<h2><?php echo $homeData->getTitle(); ?></h2>
			<?php } ?>

			<?php if (($homeData->getContent() != ''))  { ?>
				<div class="content-text">
					<?php echo html_entity_decode($homeData->getContent()); ?>
				</div>
			<?php } ?>
		</div>
		<!--END Middle Content Area -->
	</div>
</section>