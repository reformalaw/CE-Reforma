<section class="banner">	
	<div id="banner">	
			<div id="sequence">
				<?php echo image_tag('theme9/bt-prev.png',array('class' => "prev"));?>
				<?php echo image_tag('theme9/bt-next.png',array('class' => "next"));?>

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
											<?php echo $bannersArr[$i]['Title2'];?></p>
										</h3>
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
			</div>
		</div>
</section>
<section class="middle" id="home">
	<div class="page">
    	<div class="quick-contact">
        <?php echo include_partial('caseContact9', array('contactForm' => $contactForm ));?>
    </div>
    	<div class="practice-area right">
        <?php include_component('home','userWebsitePracticeArea9'); // Shows Website Practice Area?>
    </div>
        <div class="content-area left">
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