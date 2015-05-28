<div class="top-part">
	<div class="menu">
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
		<?php echo image_tag('theme8/menu-btm-arrow.png');?>
	</div>

	<div class="banner">
		<div id="sequence">
			<?php  if(!empty($bannersArr)) { ?>
				<ul>
					<?php for($i= 0; $i<count($bannersArr) ; $i++ ) { ?>
						<li>
							<?php if(!empty($bannersArr[$i]['Image'])) {?>
								<?php $bannerPath = '../uploads/website/'.$websiteId.'/banner/'.$bannersArr[$i]['Image'];?>
								<?php echo image_tag($bannerPath,array('class' => "model x animate-in", 'alt' => "Model 1"));?>
							<?php } ?>
						</li>
					<?php } // End of For Loop ?>
				</ul>
			<?php } // End of IF ?>
		</div>
	</div>
</div>