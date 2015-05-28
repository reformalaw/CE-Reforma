<header>
	<div class="page">	
		<div class="logo">
			<?php $logoPath = '../uploads/website/'.$websiteId.'/logo/'.$websiteOptions['Logo'];?>
			<?php echo link_to(image_tag($logoPath),'/');?>
		</div>
		<div class="phoneno">
			<span><?php echo $userData->getPhone(); ?></span>
			<?php echo image_tag("theme10/phone-icon.png");?>
		</div>
	</div>
</header>