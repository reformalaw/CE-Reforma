<section class="banner">
	<div class="page">
      <div id="banner">
		<?php echo image_tag('theme2/bt-prev.png',array('class' => "prev", 'alt' => "Previous Frame"));?>
		<?php echo image_tag('theme2/bt-next.png',array('class' => "next", 'alt' => "Next Frame"));?>
							
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
	</div>
</section>

<section class="our-services-part">
	<div class="page">
	
        <?php include_component('home','textWidget2', array('widgetNumber'=> 1));?>	
        <?php include_component('home','textWidget2', array('widgetNumber'=> 2));?>	
        <?php include_component('home','textWidget2', array('widgetNumber'=> 3));?>	
        <?php include_component('home','textWidget2', array('widgetNumber'=> 4));?>	
    </div>
</section>
<section class="middle" id="home">
	<div class="page">
	
    	<div class="practice-area tell-us left">
            <?php echo include_partial('caseContact', array('contactForm' => $contactForm ));?>
            <p>
            <?php include_component('home','textWidget2', array('widgetNumber'=> 5));?>
            </p>
      </div>
      
      
        <div class="content-area left">
            <h2><?php if (($homeData->getTitle() != ''))echo $homeData->getTitle();?></h2>
            
            <div class="content-text">
        	   <?php if (($homeData->getContent() != ''))echo html_entity_decode($homeData->getContent()); ?>
        	</div>
        </div>
        
        <div class="practice-area right">
            <?php include_component('home','userWebsitePracticeArea2'); // Shows Website Practice Area?>           
        </div> 
    </div>
</section>