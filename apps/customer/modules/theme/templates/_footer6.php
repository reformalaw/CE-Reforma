<footer>
	<div class="social-icons">
		<?php if((isset($websiteOptions['Facebook']) && !empty($websiteOptions['Facebook']) )	||
				(isset($websiteOptions['Twitter']) && !empty($websiteOptions['Twitter']) )	||
				(isset($websiteOptions['LinkedIn']) && !empty($websiteOptions['LinkedIn']) )	||
				(isset($websiteOptions['Rss']) && !empty($websiteOptions['Rss']) )			||
				(isset($websiteOptions['Google']) && !empty($websiteOptions['Google']) )
		): ?>
		<div class="page">Stay connected with us in your favorite flavor!
			<ul>
				<?php if (isset($websiteOptions['Facebook']) && !empty($websiteOptions['Facebook']) ) {?>
					<li><a href="<?php if (isset($websiteOptions['Facebook']))echo $websiteOptions['Facebook']; ?>"  target="_blank"><span class="facebook"></span>Facebook</a></li>
				<?php } ?>

				<?php if (isset($websiteOptions['Twitter']) && !empty($websiteOptions['Twitter']) ) {?>
					<li><a href="<?php if (isset($websiteOptions['Twitter']))echo $websiteOptions['Twitter']; ?>"  target="_blank"><span class="twitter"></span>Twitter</a></li>
				<?php } ?>

				<?php if (isset($websiteOptions['LinkedIn']) && !empty($websiteOptions['LinkedIn']) ) {?>
					<li><a href="<?php if (isset($websiteOptions['LinkedIn']))echo $websiteOptions['LinkedIn']; ?>"  target="_blank"><span class="linkedin"></span>LinkedIn</a></li>
				<?php } ?>

				<?php if (isset($websiteOptions['Rss']) && !empty($websiteOptions['Rss']) ) {?>
					<li><a href="<?php if (isset($websiteOptions['Rss']))echo $websiteOptions['Rss']; ?>"  target="_blank"><span class="rss"></span>Rss</a></li>
				<?php } ?>

				<?php if (isset($websiteOptions['Google']) && !empty($websiteOptions['Google']) ) {?>
					<li><a href="<?php if (isset($websiteOptions['Google']))echo $websiteOptions['Google']; ?>"  target="_blank"><span class="google"></span>Google</a></li>
				<?php } ?>
			</ul>
		</div>
		<?php endif; ?>
	</div>
    <div class="copyright">
			<div class="page">
			    <?php  /* &copy;&nbsp;<?php echo date('Y',strtotime($this->context->get('WebsiteCreatedDate')));?> by <?php echo ucfirst($this->context->get('UserFirstName')).' '.ucfirst($this->context->get('UserLastName'));?> Attorney. All rights reserved. */ ?>
			    
                <?php $ceSiteURL = clsCommon::getSystemConfigVars('SITE_URL'); ?>
        	    Website Design by <a href="<?php echo $ceSiteURL; ?>" target="_blank" title="<?php echo $ceSiteURL; ?>"><?php echo sfConfig::get('app_counceledge_site_name');?></a>
			    
				<?php if($footerMenuObj->count() > 0) {
						$menuCnt = $footerMenuObj->count() ;
						$startCnt = 1 ;
							foreach($footerMenuObj as $foterObj) {
								$footerMenuURL = clsCommon::getFooterMenuURL($foterObj);   ?>
								<?php echo link_to($foterObj->getTitle(),$footerMenuURL, array('title' => $foterObj->getTitle())); ?>   <?php if($startCnt < $menuCnt ) { ?> |    <?php } ?>
								<?php $startCnt++ ; ?>
							<?php    } // End of For Each ?>
				<?php } // End of If  ?>
			</div>
	</div>
</footer>