<header>
	<div class="page">
    <section class="logo">
				<?php $logoPath = '../uploads/website/'.$websiteId.'/logo/'.$websiteOptions['Logo'];?>
				<?php echo link_to(image_tag($logoPath),'/');?>
			</section>
		<div class="social-icons">
			<?php if (isset($websiteOptions['Rss']) && !empty($websiteOptions['Rss']) ) {?>
				<a class="rss" href="<?php if (isset($websiteOptions['Rss']))echo $websiteOptions['Rss']; ?>"  target="_blank"></a>
			<?php } ?>

			<?php if (isset($websiteOptions['LinkedIn']) && !empty($websiteOptions['LinkedIn']) ) {?>
				<a class="linkedin" href="<?php if (isset($websiteOptions['LinkedIn']))echo $websiteOptions['LinkedIn']; ?>"  target="_blank"></a>
			<?php } ?>
			
			<?php if (isset($websiteOptions['Twitter']) && !empty($websiteOptions['Twitter']) ) {?>
				<a class="twitter" href="<?php if (isset($websiteOptions['Twitter']))echo $websiteOptions['Twitter']; ?>"  target="_blank"></a>
			<?php } ?>
			
			<?php if (isset($websiteOptions['Facebook']) && !empty($websiteOptions['Facebook']) ) {?>
				<a class="facebook" href="<?php if (isset($websiteOptions['Facebook']))echo $websiteOptions['Facebook']; ?>"  target="_blank"></a>
			<?php } ?>

		</div>
		<div class="phoneno"><?php echo $userData->getPhone(); ?></div>
		<div class="logo-part">
			<?php if(!empty($menuObj) && $menuObj->count() > 0 ){  ?>
				<nav>
					<ul>
						<?php foreach($menuObj as $obj) {
							$parentMenuURL = clsCommon::getHeaderMenuURL($obj);
							$childObj = WebsiteMenuTable::getChiledMenuList($websiteId, $obj->getId(), sfConfig::get('app_MenuType_Header')); // Check For SubMenu
						?>
							<li>
								<?php echo link_to( $obj->getTitle(), $parentMenuURL,array('title' => $obj->getTitle())); ?>
								<?php if($childObj->count() > 0 ) { // Child Menu?>
									<ul>
										<?php foreach($childObj as $chiObj) { #clsCommon::pr($chiObj->toArray());?>
											<?php $childMenuURL = clsCommon::getHeaderMenuURL($chiObj); ?>   
											<?php if(!empty($childMenuURL))?>
												<li><?php echo link_to($chiObj->getTitle(), $childMenuURL,array('title' => $chiObj->getTitle())); ?></li>
										<?php } // End of Foreach ?>
									</ul>
								<?php  }// End of IF  ?>
							</li>
						<?php  }     // End of For Each  ?>
					</ul>
				</nav>
			<?php   } // End of IF  ?>
		</div>
	</div>
</header>