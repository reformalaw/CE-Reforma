<header>
	<div class="page">	
		<div class="logo">
			<a href="#">
				<?php $logoPath = '../uploads/website/'.$websiteId.'/logo/'.$websiteOptions['Logo'];?>
				<?php echo link_to(image_tag($logoPath),'/');?>
			</a>
		</div>
		<div class="phoneno">
			<?php echo image_tag("theme8/phon-icon.png"); ?>
			<?php echo $userData->getPhone(); ?>
		</div>
	</div>
</header>