<!--<script type="text/javascript">	

/mobile/i.test(navigator.userAgent) && !location.hash && setTimeout(function () {
    if (!pageYOffset) window.scrollTo(0, 1);
}, 1000);

$(document).ready(function(){
    var options = {
        nextButton: true,
        prevButton: true,
        animateStartingFrameIn: true,
        autoPlayDelay: 4000,
        preloader: true,
        preloadTheseFrames: [1],
        pauseOnHover: false,
        //preloadTheseImages: [
        //"images/tn-model1.png",
        //"images/tn-model2.png",
        //"images/tn-model1.png",
        //"images/tn-model2.png",
        //"images/tn-model3.png"
        //]
    };

    var sequence = $("#sequence").sequence(options).data("sequence");

    sequence.afterLoaded = function(){
        $("#nav").fadeIn(100);
        $("#nav li:nth-child("+(sequence.settings.startingFrameID)+") img").addClass("active");
    }

    sequence.beforeNextFrameAnimatesIn = function(){
        $("#nav li:not(:nth-child("+(sequence.nextFrameID)+")) img").removeClass("active");
        $("#nav li:nth-child("+(sequence.nextFrameID)+") img").addClass("active");
    }

    $("#nav li").click(function(){
        $(this).children("img").removeClass("active").children("img").addClass("active");
        sequence.nextFrameID = $(this).index()+1;
        sequence.goTo(sequence.nextFrameID);
    });
});
	</script>

<?php #clsCommon::pr($bannersArr);?>
<section class="banner">
	<div id="banner">
				<?php echo image_tag('theme2/bt-prev.png',array('class' => "prev", 'alt' => "Previous Frame"));?>
				<?php echo image_tag('theme2/bt-next.png',array('class' => "next", 'alt' => "Next Frame"));?>
				
				
			<div id="sequence">
				<ul>
                    <?php  if(!empty($bannersArr)) {

                            for($i= 0; $i<count($bannersArr) ; $i++ ) { ?>
                            <li id="intro">
                                <?php if(!empty($bannersArr[$i]['Title1'])) {?>
                                    <h2 class="title animate-in"><?php echo $bannersArr[$i]['Title1'];?></h2>
                                <?php } ?>
                                
                                <h3 class="subtitle animate-in">
                                    <?php if(!empty($bannersArr[$i]['Title2'])) {?>
                                        <?php echo $bannersArr[$i]['Title2'];?>
                                    <?php } ?>                                        
                                
                                <?php if(!empty($bannersArr[$i]['Title3'])) {?>
                                    <p class="get-started-link animate-in"><?php echo $bannersArr[$i]['Title3'];?></p>
                                <?php } ?>                                    
                                
                                </h3>
                                <?php if(!empty($bannersArr[$i]['Image'])) {?>
                                    <?php $bannerPath = '../uploads/website/'.$websiteId.'/banner/'.$bannersArr[$i]['Image'];?>
                                    <?php echo image_tag($bannerPath,array('class' => "model x animate-in", 'alt' => "Model 1"));?>
                                <?php } ?>                                    
                                
                                
                            </li>         
                                
                    <?php   } // End of For Loop

                    } // End of IF
                    ?>
				</ul>
			</div>
			
		</div>
</section>
<section class="our-services-part">
	<div class="page">
	
        <?php include_component('home','textWidget', array('widgetNumber'=> 1));?>	
        <?php include_component('home','textWidget', array('widgetNumber'=> 2));?>	
        <?php include_component('home','textWidget', array('widgetNumber'=> 3));?>	
        <?php include_component('home','textWidget', array('widgetNumber'=> 4));?>	
    </div>
</section>
<section class="middle">
	<div class="page">
	
    	<div class="middle-left">
            <?php echo include_partial('caseContact', array('contactForm' => $contactForm ));?>
            <p>
                <?php include_component('home','textWidget', array('widgetNumber'=> 5));?>
            </p>
      </div>
        <div class="middle-part"><h2><?php echo $this->context->get('UserFirstName').' '.$this->context->get('UserLastName')?> Attorney </h2>
        	<h4>Twenty-three years' experience in criminal and family law </h4>
            <p>Ralph Jackson Attorney at Law, my diligence, coupled with my 23 years of experience, enables me to anticipate your unique concerns, challenges and needs, while remaining mindful of the big picture. I have a reputation for successfully winning difficult criminal and family trials through dedication and hard work. I have represented my clients in more than 60 jury trials, and have only lost two cases in the last five years. </p>
           <p> I also have also gained the respect of my peers for my professionalism and ethics, earning a BV&reg; Distinguished Peer Review Rating by Martindale-Hubbell&reg;. Whether you are planning to adopt, are going through a divorce or have been charged with a criminal offense in Georgia, I offer a variety of innovative and workable solutions to help you make the best of any situation.</p>
            <h4>Adhering to principles of integrity</h4> 
            <p>Ralph Jackson Attorney at Law is dedicated to providing personalized legal services to individuals throughout South Metro Atlanta. I am also dedicated to working within my Christian principles. This does not mean I force my faith upon my clients, but rather, it means you can expect direct and honest guidance about your case. </p>
            <h4>Contact a seasoned Jonesboro law firm today </h4>
            <p>Call Ralph Jackson Attorney at Law at 770-472-7334 or contact us online to schedule an appointment. </p>
        </div>
        
         <?php include_component('home','userWebsitePracticeArea'); // Shows Website Practice Area?>           
    </div>
</section>-->