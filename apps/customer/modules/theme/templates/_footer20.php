<footer>
	<div class="page">
		<div class="social-icons">
			<?php if (isset($websiteOptions['Facebook']) && !empty($websiteOptions['Facebook']) ) {?>
				<a class="fb-icon" href="<?php if (isset($websiteOptions['Facebook']))echo $websiteOptions['Facebook']; ?>"  target="_blank"></a>
			<?php } ?>
			
			<?php if (isset($websiteOptions['Twitter']) && !empty($websiteOptions['Twitter']) ) {?>
				<a class="teet-icon" href="<?php if (isset($websiteOptions['Twitter']))echo $websiteOptions['Twitter']; ?>"  target="_blank"></a>
			<?php } ?>

			<?php if (isset($websiteOptions['Google']) && !empty($websiteOptions['Google']) ) {?>
				<a class="google-icon" href="<?php if (isset($websiteOptions['Google']))echo $websiteOptions['Google']; ?>"  target="_blank"></a>
			<?php } ?>
		
			<?php if (isset($websiteOptions['LinkedIn']) && !empty($websiteOptions['LinkedIn']) ) {?>
				<a class="linkdin-icon" href="<?php if (isset($websiteOptions['LinkedIn']))echo $websiteOptions['LinkedIn']; ?>"  target="_blank"></a>
			<?php } ?>
			
			<?php /*if (isset($websiteOptions['Rss']) && !empty($websiteOptions['Rss']) ) {?>
				<a class="google-icon" href="https://www.rss.com/<?php if (isset($websiteOptions['Rss']))echo $websiteOptions['Rss']; ?>"  target="_blank"></a>
			<?php } */ ?>
		</div> 
		<div class="left">
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