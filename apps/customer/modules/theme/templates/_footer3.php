<footer>
	<div class="page">
		<div class="footer-left">
			<?php /*&copy; <?php echo date('Y',strtotime($this->context->get('WebsiteCreatedDate')));?> by <?php echo ucfirst($this->context->get('UserFirstName')).' '.ucfirst($this->context->get('UserLastName'));?> Attorney. All rights reserved. */ ?>
		
            <?php $ceSiteURL = clsCommon::getSystemConfigVars('SITE_URL'); ?>
    	    Website Design by <a href="<?php echo $ceSiteURL; ?>" target="_blank" title="<?php echo $ceSiteURL; ?>"><?php echo sfConfig::get('app_counceledge_site_name');?></a> All rights reserved.
			
	
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
        <div class="footer-right">
            <?php if (isset($websiteOptions['Facebook']) && !empty($websiteOptions['Facebook']) ) {?>
                <a href="<?php if (isset($websiteOptions['Facebook']))echo $websiteOptions['Facebook']; ?>"  target="_blank" class="icon"></a>
            <?php } ?>

            <?php if (isset($websiteOptions['Twitter']) && !empty($websiteOptions['Twitter']) ) {?>
                <a href="<?php if (isset($websiteOptions['Twitter']))echo $websiteOptions['Twitter']; ?>"  target="_blank" class="icon1"></a>
            <?php } ?>

            <?php if (isset($websiteOptions['LinkedIn']) && !empty($websiteOptions['LinkedIn']) ) {?>
                <a href="<?php if (isset($websiteOptions['LinkedIn']))echo $websiteOptions['LinkedIn']; ?>"  target="_blank" class="icon2"></a>
            <?php } ?>

            <?php if (isset($websiteOptions['Rss']) && !empty($websiteOptions['Rss']) ) {?>
                <a href="<?php if (isset($websiteOptions['Rss']))echo $websiteOptions['Rss']; ?>"  target="_blank" class="icon3"></a>
            <?php } ?>
        </div>
    </div>
</footer>