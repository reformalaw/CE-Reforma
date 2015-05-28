<header>
	<div class="page">
    	<div class="logo-part">
    	   <?php $logoPath = '../uploads/website/'.$websiteId.'/logo/'.$websiteOptions['Logo'];?>
    	   <?php echo link_to(image_tag($logoPath),'/');?>
    	</div>
    	
        <?php if(!empty($menuObj) && $menuObj->count() > 0 ){  ?>
            <nav>
            	<ul>
                    <?php foreach($menuObj as $obj) {
                        $parentMenuURL = clsCommon::getHeaderMenuURL($obj);
                        $childObj = WebsiteMenuTable::getChiledMenuList($websiteId, $obj->getId(), sfConfig::get('app_MenuType_Header')); // Check For SubMenu
                    ?>
                        <li><?php echo link_to( $obj->getTitle(), $parentMenuURL,array('title' => $obj->getTitle())); ?>
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
                                
                 <?php     }     // End of For Each  ?>
            	</ul>
            </nav>
       <?php   } // End of IF  ?>
    	
        <?php /*      
        <nav>
        	<ul>
        	    <li><?php echo link_to('Home','/'); ?></li>
            	<li><?php echo link_to('About us','/about-us'); ?></li>
                <li><?php echo link_to('Attorney Profile','/attorney-profile'); ?></li>
                <li><?php echo link_to('Practice Areas','/practice-area1'); ?>
                <?php if(!empty($practiceAreaArr)) { ?>
                    <ul>
            	       <?php for($i=0; $i<count($practiceAreaArr); $i++) {?>
            	           <li><?php echo link_to($practiceAreaArr[$i]['Title'],'/practice-area/'.$practiceAreaArr[$i]['Slug'])?></li>
            	       <?php }  ?>
                    </ul>
                <?php } ?>
                <li><?php echo link_to('FAQs','/faq'); ?></li>
                <li><?php echo link_to('Contact Us','/contact'); ?></li>
                
            </ul>
        </nav> */?>
    </div>
</header>
</header>