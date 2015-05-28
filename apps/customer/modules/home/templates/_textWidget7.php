<div class="service-box  <?php if($widgetNo == 3) { echo 'last';}?>" >
	<!--This if condition is for create textwidgetLink-->
	<?php if($textWidgetLink != false && $textWidgetLink != ""): ?>
		<a href = "<?php echo $textWidgetLink; ?>">
	<?php endif; ?>

    <?php if(isset($widgetTitle) && !empty($widgetTitle)) {?>
	   <h3><?php echo $widgetTitle ;?></h3>
	 <?php } ?>
    <div class="content">
        <?php echo html_entity_decode($widgetContent) ;  ?>
    </div>

     <!--This if condition is for create textwidgetLink-->
	<?php if($textWidgetLink != false && $textWidgetLink != ""): ?>
		</a>
	<?php endif; ?>
</div>