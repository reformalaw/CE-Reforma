<!--Start Banner Section-->
<section class="banner">
<div id="banner">
	<?php echo image_tag('theme4/bt-prev.png',array('class' => "prev", 'alt' => "Previous Frame"));?>
    <?php echo image_tag('theme4/bt-next.png',array('class' => "next", 'alt' => "Next Frame"));?>

	
			<div id="sequence">
				<?php  if(!empty($bannersArr)) { ?>
                <ul>
                <?php  for($i= 0; $i<count($bannersArr) ; $i++ ) { ?>
                        <li>
                            <?php if(!empty($bannersArr[$i]['Title1'])) {?>
                                <h2 class="title animate-in"><?php echo $bannersArr[$i]['Title1'];?></h2>
                            <?php } ?>

                            <?php if(!empty($bannersArr[$i]['Title2']) || !empty($bannersArr[$i]['Title3'])): ?>
								<h3 class="subtitle animate-in">
									<?php if(!empty($bannersArr[$i]['Title2'])) {?>
										<?php echo $bannersArr[$i]['Title2'];?>
									<?php } ?>

								<?php if(!empty($bannersArr[$i]['Title3'])) {?>
									<p class="get-started-link animate-in"><?php echo $bannersArr[$i]['Title3'];?></p>
								<?php } ?>

								</h3>
                            <?php endif; ?>

                            <?php if(!empty($bannersArr[$i]['Image'])) {?>
                                <?php $bannerPath = '../uploads/website/'.$websiteId.'/banner/'.$bannersArr[$i]['Image'];?>
                                <?php echo image_tag($bannerPath,array('class' => "model x animate-in", 'alt' => $bannersArr[$i]['Image']));?>
                            <?php } ?>
                        </li>
                <?php   } // End of For Loop ?>
                </ul>
            <?php } // End of IF ?>
			</div>
		</div>
</section>
<!--END Banner Section-->

<!--Start Contact Us Form Part-->
<section class="middle-form">
	<div class="page">
        <div class="tellus-form-part">
			<div class="tellus-border">
				<div class="tellus-form">
					<?php echo include_partial('caseContact4', array('contactForm' => $contactForm ));?>
				</div>
				<div class="free-consultation" >
					<?php include_component('home','textWidget4', array('widgetNumber'=> 1));?>
				</div>
			</div>
        </div>
    </div>
</section>
<!--End Contact Us Form Part-->

<!--Start Content Part-->
<section class="middle" id="cmspages">
	<div class="page">
        <div class="middle-part">
        	<div class="middle-part-border">
            	<div class="formbox-shadow"><img src="/images/theme4/formbox-shadow.png" /></div>
                <div class="content-area left">
                    	<h2><?php if (($homeData->getTitle() != ''))echo $homeData->getTitle();?></h2>
                        <div class="content-text">
							<?php if (($homeData->getContent() != ''))echo html_entity_decode($homeData->getContent()); ?>
                            <!--Start Bottum Widget-->
                     <div class="home-contactus">
						<?php include_component('home','textWidget4', array('widgetNumber'=> 2));?>
                    </div>
					<div class="home-contactus">
						<?php include_component('home','textWidget4', array('widgetNumber'=> 3));?>
					</div>
					<!--End Bottum Widget-->
                        </div>
                </div>
                <div class="practice-area right">
				<?php include_component('home','userWebsitePracticeArea4'); // Shows Website Practice Area?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--END Content Part-->