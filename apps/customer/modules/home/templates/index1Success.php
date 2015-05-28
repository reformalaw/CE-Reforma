<section class="banner">
	<div class="page"> 
       <div id="sequence">   	
        <!--<img class="prev" src="images/bt-prev.png" alt="Previous Frame" />-->
        <?php echo image_tag('theme1/bt-prev.png',array('class' => "prev", 'alt' => "Previous Frame"));?>
        <!--<img class="next" src="images/bt-next.png" alt="Next Frame" />-->
        <?php echo image_tag('theme1/bt-next.png',array('class' => "next", 'alt' => "Next Frame"));?>	
    	
				    <!--Banner Section-->
					<?php  if(!empty($bannersArr)) { ?>
					    <ul>
                          <?php for($i= 0; $i<count($bannersArr) ; $i++ ) { ?>
                                <li>

                                <?php if(!empty($bannersArr[$i]['Title1']) || !empty($bannersArr[$i]['Title2']) ): ?>
									<h3 class="subtitle animate-in">
										<?php if(!empty($bannersArr[$i]['Title1'])) {?>
											<?php echo $bannersArr[$i]['Title1'];?>
										<?php } ?>

										<?php if(!empty($bannersArr[$i]['Title2'])) {?>
											<p class="get-started-link animate-in"><?php echo $bannersArr[$i]['Title2'];?></p>
										<?php } ?>
									</h3>
								<?php endif; ?>

                                <?php if(!empty($bannersArr[$i]['Title3'])) {?>
                                    <h2 class="title animate-in"><?php echo $bannersArr[$i]['Title3'];?></h2>
                                <?php } ?>

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

<section class="service-part">
	<div class="page">
    	<div class="services">
    	    <?php include_component('home','textWidget1', array('widgetNumber'=> 1));?>	
    	</div>
        <div class="services services-padding">
            <?php include_component('home','textWidget1', array('widgetNumber'=> 2));?>	
        </div>
        <div class="services">
        	<?php include_component('home','textWidget1', array('widgetNumber'=> 3));?>
        </div>
    </div>
</section>

<section class="middle" id="left-column">
	<div class="page">
    	<div class="practice-area left">
	       <?php include_component('home','userWebsitePracticeArea1'); // Shows Website Practice Area?> 
        </div>
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
    </div>
</section>