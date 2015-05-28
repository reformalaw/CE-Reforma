<div class="practice-area left">
	<?php include_component('home','userWebsitePracticeArea8'); // Shows Website Practice Area?>
</div>
<div class="content-area right">
	<?php if (($homeData->getTitle() != '')) { ?>
		<h2>
			<span>
				<?php echo $homeData->getTitle(); ?>
			</span>
		</h2>
	<?php } ?>

	<?php if (($homeData->getContent() != ''))  { ?>
		<div class="content-text">
			<?php echo html_entity_decode($homeData->getContent()); ?>
		</div>
	<?php } ?>
</div>