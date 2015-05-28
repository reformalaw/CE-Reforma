<section class="innerpage-middle">
	<div class="page row clearfix">
        <div class="middle-left">
        	<div class="innerpage-heading">
            	<h1><?php echo ucwords(str_replace('-',' ',$staticPage->getSlug())); ?> </h1> <h3><?php echo $staticPage->getSubTitle(); ?><!--Some interesting facts about our company --></h3>
            </div>
            <div class="innerpage-content">
            	<?php //echo image_tag('aboutus-img.png'); ?>
            	<?php echo html_entity_decode($staticPage->getContent()); ?>
            </div>
        </div>
        <?php  include_component('default', 'clientSays');?>
    </div>
</section>
