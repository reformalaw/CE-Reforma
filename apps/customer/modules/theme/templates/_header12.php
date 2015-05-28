<header>
	<div class="page">
		<div class="logo-part"><a href="#">
			<?php $logoPath = '../uploads/website/'.$websiteId.'/logo/'.$websiteOptions['Logo'];?>
				<?php echo link_to(image_tag($logoPath),'/');?>
			</a>
		</div>
		<div class="social-icons">
			<?php if (isset($websiteOptions['Twitter']) && !empty($websiteOptions['Twitter']) ) {?>
				<a class="teet-icon" href="<?php if (isset($websiteOptions['Twitter']))echo $websiteOptions['Twitter']; ?>"  target="_blank"></a>
			<?php } ?>
					
			<?php if (isset($websiteOptions['Facebook']) && !empty($websiteOptions['Facebook']) ) {?>
				<a class="fb-icon"  href="<?php if (isset($websiteOptions['Facebook']))echo $websiteOptions['Facebook']; ?>"  target="_blank"></a>
			<?php } ?>
			
			<?php if (isset($websiteOptions['LinkedIn']) && !empty($websiteOptions['LinkedIn']) ) {?>
				<a  class="linkdin-icon" href="<?php if (isset($websiteOptions['LinkedIn']))echo $websiteOptions['LinkedIn']; ?>"  target="_blank"></a>
			<?php } ?>
			
			<?php if (isset($websiteOptions['Google']) && !empty($websiteOptions['Google']) ) {?>
				<a class="google-icon"  href="<?php if (isset($websiteOptions['Google']))echo $websiteOptions['Google']; ?>"  target="_blank"></a>
			<?php } ?>
					
			<?php if (isset($websiteOptions['Rss']) && !empty($websiteOptions['Rss']) ) {?>
				<a class="rss-icon"  href="<?php if (isset($websiteOptions['Rss']))echo $websiteOptions['Rss']; ?>"  target="_blank"></a>
			<?php } ?>
		</div>
		<div class="contact-no">
			<span class="call-icon"></span>
			<h4><?php echo $userData->getPhone(); ?></h4>
		</div>
	</div>
</header>