﻿<script type="text/javascript">	
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
        pauseOnHover: false /*,
        preloadTheseImages: [
        "images/tn-model1.png",
        "images/tn-model2.png",
        "images/tn-model1.png",
        "images/tn-model2.png",
        "images/tn-model3.png"
        ]*/
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
<section class="banner-part">
	<div id="banner">
			<div class="main-arrow-width">
				<?php echo image_tag('bt-prev.png',array('class'=>'prev','alt'=>'Previous Frame'));?>
				<?php echo image_tag('bt-next.png',array('class'=>'next','alt'=>'Next Frame'));?>
			</div>
			<div id="sequence">
				<ul>
					<li id="intro">
						<div class="title main-slider-width">
							<h2 class="title animate-in">Your Money when you need it</h2>
							<h3 class="subtitle animate-in"> Don't wait
								<p class="get-started-link"><a href="#">Get Started<?php echo image_tag('get-started-arrow.png');?></a></p>  
							</h3>
							<?php echo image_tag('banner-1-img.png',array('class'=>'model x animate-in','alt'=>'Model 1'));?>
                        </div>						
					</li>
					<li id="creative">
						<div class="title main-slider-width">
							<h2 class="title">Accurate and Reliable Remote <br/>Billing and Bookkeeping Services</h2>
							<h3 class="subtitle">Accusamu dolore massa fugharum quidemed rerum facilisiusto ssimos ducimus qui blanditii stes es praesentiumvol.  Accusamu dolore massa fugharum quidemed rerum ......        
							<p class="get-started-link"><a href="#">Get Started<?php echo image_tag('get-started-arrow.png');?></a></p>  
							</h3>
							<?php echo image_tag('banner-1-img.png',array('class'=>'model','alt'=>'Model 2'));?>
                        </div>
					</li>
					<li id="support" class="frame3">
						<div class="title main-slider-width">
							<h2 class="title">Accurate and Reliable Remote <br/>Billing and Bookkeeping Services</h2>
							<h3 class="subtitle">Accusamu dolore massa fugharum quidemed rerum facilisiusto ssimos ducimus qui blanditii stes es praesentiumvol.  Accusamu dolore massa fugharum quidemed rerum ......        
							<p class="get-started-link"><a href="#">Get Started<?php echo image_tag('get-started-arrow.png');?></a></p>  
							</h3>
							<?php echo image_tag('banner-1-img.png',array('class'=>'model','alt'=>'Model 3'));?>
                        </div>
					</li>
                    <li id="intro-1">
						<div class="title main-slider-width">
							<h2 class="title animate-in">Accurate and Reliable Remote <br/>Billing and Bookkeeping Services</h2>
							<h3 class="subtitle animate-in">Accusamu dolore massa fugharum quidemed rerum facilisiusto ssimos ducimus qui blanditii stes es praesentiumvol.  Accusamu dolore massa fugharum quidemed rerum ......        
								<p class="get-started-link"><a href="#">Get Started<?php echo image_tag('get-started-arrow.png');?></a></p>  
							</h3>
							<?php echo image_tag('banner-1-img.png',array('class'=>'model x animate-in','alt'=>'Model 1'));?>              
                        </div>
					</li>
					<li id="creative-1">
						<div class="title main-slider-width">
							<h2 class="title">Accurate and Reliable Remote <br/>Billing and Bookkeeping Services</h2>
							<h3 class="subtitle">Accusamu dolore massa fugharum quidemed rerum facilisiusto ssimos ducimus qui blanditii stes es praesentiumvol.  Accusamu dolore massa fugharum quidemed rerum ......        
							<p class="get-started-link"><a href="#">Get Started<?php echo image_tag('get-started-arrow.png');?></a></p>  
							</h3>
							<?php echo image_tag('banner-1-img.png',array('class'=>'model','alt'=>'Model 2'));?>
                        </div>
					</li>
				</ul>
			</div>
			<div id="banner-nav">
                <ul id="nav">
                    <li><?php echo image_tag('tn-model1.png',array('alt'=>'Model 1'));?></li>
                    <li><?php echo image_tag('tn-model2.png',array('alt'=>'Model 2'));?></li>
                    <li><?php echo image_tag('tn-model3.png',array('alt'=>'Model 3'));?></li>
                    <li><?php echo image_tag('tn-model1.png',array('alt'=>'Model 4'));?></li>
                    <li><?php echo image_tag('tn-model2.png',array('alt'=>'Model 5'));?></li>
                </ul>
            </div>
		</div>
</section>
<section class="featured-part">
	<div class="page row clearfix">
    	<div class="billing-solution"><?php echo image_tag('billing-solution-icon.png'); ?> <h2>Billing Solutions</h2>
        	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation...</p>
            <p><?php echo image_tag('black-arrow-icon.png'); ?><a href="#">Read more</a></p>
        </div>
        <div class="billing-solution featured-site"><?php echo image_tag('featured-site-icon.png'); ?><h2>Featured site</h2>
        	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation...</p>
            <p><?php echo image_tag('black-arrow-icon.png'); ?><a href="#">Read more</a></p>
        </div>
        <div class="billing-solution sign-up-now"><?php echo image_tag('sign-up-icon.png'); ?><h2>Sign up Now!</h2>
        	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation...</p>
            <p><?php echo image_tag('black-arrow-icon.png'); ?><a href="#">Read more</a></p>
        </div>
    </div>
</section>
<section class="welcome-part">
	<div class="page row clearfix">
    	<div class="welcome">
        	<h2>Welcome to <span>Counsel</span> <span class="blue">Edge</span> </h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> 
        </div>
        <?php if(count($objTestimonial) > 0 ): ?>
        <div class="client-says">
        	<h2>What Clients Says</h2>
		<div id="slides" class="client-says-bg">
			<div class="slides_container">
				<?php
					foreach($objTestimonial as $objTestimonialData): ?>
						<div>
							<p> <?php echo $objTestimonialData->getDescription(); ?></p>
							<!--<p>Muffin Group, <span>muffingroup.com</span></p>-->
						</div>
				<?php 
					endforeach;
				?>
			</div>
		</div>
        <?php /* <div class="client-says-paging"><?php echo image_tag('client-says-paging.png'); ?></div> */ ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<style type="text/css" media="screen">

		/*#slides .slides_container {
			width:570px;
			height:170px;
			display:none;
		}

		#slides .slides_container div {
			width:570px;
			height:170px;
			display:block;
		}

		#slides_two .slides_container {
			width:250px;
			display:none;
		}

		#slides_two .slides_container div {
			width:250px;
			height:250px;
			display:block;
		}

		#slides_three .slides_container {
			width:200px;
			display:none;
		}

		#slides_three .slides_container div {
			width:200px;
			height:100px;
			display:block;
		}

		.pagination .current a {
			color:red;
		}
		hr {
			background:#efefef;
		}*/
	</style>

	<script>
		$(function(){
			$('#slides').slides({
				play: 10000
			});
			$('#slides_two').slides({
				play: 14000
			});
			$('#slides_three').slides({
				play: 19000,
				autoHeight: true
			});

		});
	</script>