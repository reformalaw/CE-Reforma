<section class="menu">
	<div class="page">
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
</section>