<footer>
	<div class="page">
		<div class="footer-left">
			<?php $ceSiteURL = clsCommon::getSystemConfigVars('SITE_URL'); ?>
			Website Design by <a href="<?php echo $ceSiteURL; ?>" target="_blank" title="<?php echo $ceSiteURL; ?>"><?php echo sfConfig::get('app_counceledge_site_name');?></a>
			
			<div class="right">
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
		
		
			<?php if((isset($websiteOptions['Facebook']) && !empty($websiteOptions['Facebook']) ) 	||
					(isset($websiteOptions['Twitter']) && !empty($websiteOptions['Twitter']) )	||
					(isset($websiteOptions['Google']) && !empty($websiteOptions['Google']) )		||
					(isset($websiteOptions['LinkedIn']) && !empty($websiteOptions['LinkedIn']) )	||
					(isset($websiteOptions['Rss']) && !empty($websiteOptions['Rss']) )
			): ?>
				<div class="footer-right">
					<div class="social-icons">
						<h2>Get Connected:</h2>
						
						<?php if (isset($websiteOptions['Facebook']) && !empty($websiteOptions['Facebook']) ) {?>
							<a class="tweet-icon" href="<?php if (isset($websiteOptions['Facebook']))echo $websiteOptions['Facebook']; ?>"  target="_blank"></a>
						<?php } ?>
						
						<?php if (isset($websiteOptions['Twitter']) && !empty($websiteOptions['Twitter']) ) {?>
							<a class="fb-icon" href="<?php if (isset($websiteOptions['Twitter']))echo $websiteOptions['Twitter']; ?>"  target="_blank"></a>
						<?php } ?>

						<?php if (isset($websiteOptions['Google']) && !empty($websiteOptions['Google']) ) {?>
							<a class="linkdin-icon" href="<?php if (isset($websiteOptions['Google']))echo $websiteOptions['Google']; ?>"  target="_blank"></a>
						<?php } ?>
					
						<?php if (isset($websiteOptions['LinkedIn']) && !empty($websiteOptions['LinkedIn']) ) {?>
							<a class="google-icon" href="<?php if (isset($websiteOptions['LinkedIn']))echo $websiteOptions['LinkedIn']; ?>"  target="_blank"></a>
						<?php } ?>
						
						<?php /* if (isset($websiteOptions['Rss']) && !empty($websiteOptions['Rss']) ) {?>
							<a class="google-icon" href="https://www.rss.com/<?php if (isset($websiteOptions['Rss']))echo $websiteOptions['Rss']; ?>"  target="_blank"></a>
						<?php } */ ?>
					</div>
				</div>
			<?php endif; ?>
		
	</div>
</footer>