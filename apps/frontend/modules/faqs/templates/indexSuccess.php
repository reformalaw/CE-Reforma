<section class="innerpage-middle">
	<div class="page row clearfix">
        <div class="middle-left">
        	<div class="innerpage-heading">
            	<h1>FAQs </h1> <h3>Answers to questions you may have</h3>
            </div>
            <div class="innerpage-content">
            	<?php //echo image_tag('faq-img.png'); ?> <!--this image is commented by jaydip dodiya-->
            	<?php $i = 1; ?>
            	   <?php foreach ($faqs as $faqs_data) {?>
            	       <?php if ($faqs_data->getWebsiteXFAQsFAQs()->getQuestion() != "" || $faqs_data->getWebsiteXFAQsFAQs()->getAnswer() != ""){ ?>
                            <h6><?php echo $i.")&nbsp;&nbsp;".$faqs_data->getWebsiteXFAQsFAQs()->getQuestion(); ?></h6>
                            <p><?php echo $faqs_data->getWebsiteXFAQsFAQs()->getAnswer(); ?></p>
                            <?php $i++; ?>
                   <?php } ?>
                <?php } ?>
            </div>
        </div>
        <?php  include_component('default', 'clientSays');?>
    </div>
</section>