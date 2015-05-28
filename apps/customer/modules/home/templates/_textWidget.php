<div class="our-services">
	
	<!--This if condition is for create textwidgetLink-->
	<?php if($textWidgetLink != false && $textWidgetLink != ""): ?>
		<a href = "<?php echo $textWidgetLink; ?>">
	<?php endif; ?>
	
    <?php if(isset($widgetTitle) && !empty($widgetTitle)) {?>
	   <h4><?php echo $widgetTitle ;?></h4>
	 <?php } ?>
    <p class="services-content">
        <?php echo html_entity_decode($widgetContent) ;  ?>
     </p>
     
     <!--This if condition is for create textwidgetLink-->
	<?php if($textWidgetLink != false && $textWidgetLink != ""): ?>
		</a>
	<?php endif; ?>
</div>