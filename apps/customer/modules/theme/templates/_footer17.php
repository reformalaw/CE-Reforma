<footer>
	<div class="page"> 
		<div class="footer-corner">
			<div class="footer-corner-left"></div>
			<div class="footer-corner-bg">
				<?php $ceSiteURL = clsCommon::getSystemConfigVars('SITE_URL'); ?>
				Website Design by <a href="<?php echo $ceSiteURL; ?>" target="_blank" title="<?php echo $ceSiteURL; ?>"><?php echo sfConfig::get('app_counceledge_site_name');?></a>

				<div class="footer-links">
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
			<div class="footer-corner-right"></div>
		</div>
	</div>
</footer>