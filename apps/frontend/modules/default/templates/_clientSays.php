<div class="middle-right">
	<?php if(count($objTestimonial) > 0 ): ?>
    <div class="client-says-inner">
        <div class="client-says-inner-heading">What Clients Says</div>
            <div class="client-says-inner-content">
				<?php 
						echo $objTestimonial->getDescription(); 
				?>
                <!--<p>muffingroup.com</p>-->
                <!--<p class="readmore"><a href="#"><?php //echo image_tag('readmore-icon.png'); ?> Read more</a></p>-->
            </div>
        </div>
        <?php endif; ?>
        <div class="sign-up-img"><a href="#"><?php echo image_tag('signup-img.png'); ?></a></div>
</div>