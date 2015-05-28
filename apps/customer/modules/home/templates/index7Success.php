<section class="banner">
	<div id="banner">

		<a href="#" class="prev" title="Previous Frame"></a>
		<a href="#" class="next" title="Next Frame"></a>
	<?php //echo image_tag('theme7/bt-prev.png',array('class' => "prev"));?>
	<?php //echo image_tag('theme7/bt-next.png',array('class' => "next"));?>

			<div id="sequence">
				<!--Banner Section-->
					<?php  if(!empty($bannersArr)) { ?>
					    <ul>
                          <?php for($i= 0; $i<count($bannersArr) ; $i++ ) { ?>
                                <li>
									<?php if(!empty($bannersArr[$i]['Title1']) || !empty($bannersArr[$i]['Title2'])): ?>
										<h3 class="subtitle animate-in">
											<?php if(!empty($bannersArr[$i]['Title1'])) {?>
												<?php echo $bannersArr[$i]['Title1'];?>
											<?php } ?>

											<?php if(!empty($bannersArr[$i]['Title2'])) {?>
												<p class="get-started-link animate-in"><?php echo $bannersArr[$i]['Title2'];?></p>
											<?php } ?>
										</h3>
									<?php endif; ?>

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
    <div class="page">
		<?php echo image_tag('theme7/banner-shadow.png');?>
	</div>
</section>
<section class="middle" id="home">
	<div class="page">
    	<div class="practice-area left">
                	<?php include_component('home','userWebsitePracticeArea7'); // Shows Website Practice Area?>
    </div>
        <div class="content-area right">
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
<section class="services">
	<div class="page">
	 <?php include_component('home','textWidget7', array('widgetNumber'=> 1));?>	
        <?php include_component('home','textWidget7', array('widgetNumber'=> 2));?>	
        <?php include_component('home','textWidget7', array('widgetNumber'=> 3));?>	
    </div>
</section>