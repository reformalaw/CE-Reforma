<header>
	<div class="page">
		<div class="logo-part">
			<section class="top-corner-part"> 
				<div class="top-corner-left"></div>
				<div class="top-corner-bg">
					<div class="social-icons">
						<ul>
							<?php if (isset($websiteOptions['Twitter']) && !empty($websiteOptions['Twitter']) ) {?>
								<li><a class="twitter" href="<?php if (isset($websiteOptions['Twitter']))echo $websiteOptions['Twitter']; ?>"  target="_blank"></a></li>
							<?php } ?>
						
							<?php if (isset($websiteOptions['LinkedIn']) && !empty($websiteOptions['LinkedIn']) ) {?>
								<li><a  class="linkedin" href="<?php if (isset($websiteOptions['LinkedIn']))echo $websiteOptions['LinkedIn']; ?>"  target="_blank"></a></li>
							<?php } ?>

							<?php if (isset($websiteOptions['Rss']) && !empty($websiteOptions['Rss']) ) {?>
								<li><a class="skype"  href="<?php if (isset($websiteOptions['Rss']))echo $websiteOptions['Rss']; ?>"  target="_blank"></a></li>
							<?php } ?>

							<?php if (isset($websiteOptions['Facebook']) && !empty($websiteOptions['Facebook']) ) {?>
								<li><a class="facebook"  href="<?php if (isset($websiteOptions['Facebook']))echo $websiteOptions['Facebook']; ?>"  target="_blank"></a></li>
							<?php } ?>
							
							<?php /*if (isset($websiteOptions['Google']) && !empty($websiteOptions['Google']) ) {?>
								<li><a class="gmail"  href="https://www.Google.com/<?php if (isset($websiteOptions['Google']))echo $websiteOptions['Google']; ?>"  target="_blank"></a></li>
							<?php } */ ?>
						</ul>
					</div>
					<div class="phoneno"><?php echo $userData->getPhone(); ?></div>
				</div>
				<div class="top-corner-right"></div>
			</section>

			<section class="logo">
				<a href="#">
					<?php $logoPath = '../uploads/website/'.$websiteId.'/logo/'.$websiteOptions['Logo'];?>
					<?php echo link_to(image_tag($logoPath),'/');?>
				</a>
			</section>
		</div>
		
		<?php if(!empty($menuObj) && $menuObj->count() > 0 ){  ?>
			<nav>
				<div class="menu-left-corner"></div>
				<div class="menu-middle-bg">
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
				</div>
				<div class="menu-right-corner"></div>
			</nav>
		<?php   } // End of IF  ?>
	</div>
</header>