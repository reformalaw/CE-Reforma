	<!--This if condition is for create textwidgetLink-->
	<?php if($textWidgetLink != false && $textWidgetLink != ""): ?>
		<a href = "<?php echo $textWidgetLink; ?>">
	<?php endif; ?>

    <?php if(isset($widgetTitle) && !empty($widgetTitle)) {?>
	   <h3><?php echo $widgetTitle ;?></h3>
	 <?php } ?>
    <p>
        <?php echo html_entity_decode($widgetContent) ;  ?>
     </p>

     <!--This if condition is for create textwidgetLink-->
	<?php if($textWidgetLink != false && $textWidgetLink != ""): ?>
		</a>
	<?php endif; ?>