<section class="banner">
<div id="banner">
	<?php echo image_tag('theme6/bt-prev.png',array('class' => "prev", 'alt' => "Previous Frame"));?>
	<?php echo image_tag('theme6/bt-next.png',array('class' => "next", 'alt' => "Next Frame"));?>
		
			<div id="sequence">
				<!--Banner Section-->
					<?php  if(!empty($bannersArr)) { ?>
					    <ul>
                          <?php for($i= 0; $i<count($bannersArr) ; $i++ ) { ?>
                                <li>
                                <?php if(!empty($bannersArr[$i]['Title1']) || !empty($bannersArr[$i]['Title2']) ): ?>
									
										<?php if(!empty($bannersArr[$i]['Title1'])) {?>
										<h3 class="subtitle animate-in">
											<?php echo $bannersArr[$i]['Title1'];?>
											</h3>
										<?php } ?>

									
									<?php if(!empty($bannersArr[$i]['Title2'])) {?>
											<p class="title get-started-link animate-in"><?php echo $bannersArr[$i]['Title2'];?></p>
										<?php } ?>
								<?php endif; ?>

                                <?php if(!empty($bannersArr[$i]['Title3'])) {?>
                                    <h2 class="title animate-in"><?php echo $bannersArr[$i]['Title3'];?></h2>
                                <?php } ?>
	
                                <?php if(!empty($bannersArr[$i]['Image'])) {?>
                                    <?php $bannerPath = '../uploads/website/'.$websiteId.'/banner/'.$bannersArr[$i]['Image'];?>
                                    <?php echo image_tag($bannerPath,array('class' => "model x animate-in", 'alt' => "Model 1"));?>
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
<section class="middle-form">
	<div class="page">
        <div class="quick-contact">
                	<?php echo include_partial('caseContact6', array('contactForm' => $contactForm ));?>
        </div>
    </div>
</section>
<section class="middle" id="home">
	<div class="page">
		<div class="practice-area right">
				<?php include_component('home','userWebsitePracticeArea6'); // Shows Website Practice Area?>
		</div>
		<!--START Middle Content Area -->
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
		<!--END Middle Content Area -->
    </div>
</section>