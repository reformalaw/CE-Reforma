	<!--This if condition is for create textwidgetLink-->
	<?php if($textWidgetLink != false && $textWidgetLink != ""): ?>
		<a href = "<?php echo $textWidgetLink; ?>">
	<?php endif; ?>
	
<?php if(isset($widgetTitle) && !empty($widgetTitle)) {?>
        <h3><?php echo $widgetTitle ;?></h3>
<?php } ?>

<?php if(isset($widgetContent) && !empty($widgetContent)) {?>
    <div class="widget-content"><?php echo html_entity_decode($widgetContent) ;  ?></div>
<?php } ?>

	<!--This if condition is for create textwidgetLink-->
	<?php if($textWidgetLink != false && $textWidgetLink != ""): ?>
		</a>
	<?php endif; ?>