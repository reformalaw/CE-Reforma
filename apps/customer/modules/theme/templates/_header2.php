<header>
	<section class="top-number-part">
    	<div class="page">
		<?php if((isset($websiteOptions['Facebook']) && !empty($websiteOptions['Facebook']) )	||
				(isset($websiteOptions['Twitter']) && !empty($websiteOptions['Twitter']) )	||
				(isset($websiteOptions['Google']) && !empty($websiteOptions['Google']) )		||
				(isset($websiteOptions['LinkedIn']) && !empty($websiteOptions['LinkedIn']) )
		): ?>
        	<div class="top-social-icons">
        	   <span>Follow up with us on:</span> 
        	
        	   <?php if (isset($websiteOptions['Facebook']) && !empty($websiteOptions['Facebook']) ) {?>
        	       <a href="<?php echo $websiteOptions['Facebook']; ?>" class="facebook" target="_blank"></a>
               <?php } ?>         	       
        	   
        	   <?php if (isset($websiteOptions['Twitter']) && !empty($websiteOptions['Twitter']) ) {?>
        	       <a href="<?php echo $websiteOptions['Twitter']; ?>" class="twitter" target="_blank"></a>
               <?php } ?>         	       
        	   
        	   <?php if (isset($websiteOptions['Google']) && !empty($websiteOptions['Google']) ) {?>
        	       <a href="<?php echo $websiteOptions['Google']; ?>" class="gmailplus" target="_blank"></a>
               <?php } ?>         	       
        	   
        	   <?php if (isset($websiteOptions['LinkedIn']) && !empty($websiteOptions['LinkedIn']) ) {?>
        	       <a href="<?php echo $websiteOptions['LinkedIn']; ?>" class="linkedin" target="_blank"></a>
               <?php } ?>         	       
            </div>
		<?php endif; ?>
			<div class="top-number"><?php echo image_tag('theme2/phone-icon.png'); ?><span><?php echo $userData->getPhone(); ?></span></div>
        </div>
    </section>
    <section class="page logo-part">
    	<div class="logo"> 
	       <?php $logoPath = '../uploads/website/'.$websiteId.'/logo/'.$websiteOptions['Logo'];?>
	       <?php echo link_to(image_tag($logoPath),'/');?>
       	</div>

       	<div class="top-search" style="display:none;"><input name="" type="button" /><input name="" onblur="if(this.value=='') this.value=this.defaultValue;" onfocus="if(this.value==this.defaultValue) this.value='';" value="Search" type="text" /></div>       	
       	
       	
    </section>
    <?php if(!empty($menuObj) && $menuObj->count() > 0 ){  ?>
        <nav>
        	<div class="page menu">
            	<ul>
                    <?php foreach($menuObj as $obj) {
                        $parentMenuURL = clsCommon::getHeaderMenuURL($obj);
                        $childObj = WebsiteMenuTable::getChiledMenuList($websiteId, $obj->getId(), sfConfig::get('app_MenuType_Header')); // Check For SubMenu
                    ?>
                                
                        <li><?php echo link_to( $obj->getTitle(), $parentMenuURL,array('title'=>  $obj->getTitle())); ?>
                        <?php if($childObj->count() > 0 ) { // Child Menu?>
                            <ul>
                                 <?php foreach($childObj as $chiObj) { #clsCommon::pr($chiObj->toArray());?>
                                    <?php $childMenuURL = clsCommon::getHeaderMenuURL($chiObj); ?>   
                                    <?php if(!empty($childMenuURL))?>
                                        <li><?php echo link_to($chiObj->getTitle(), $childMenuURL, array('title'=>  $chiObj->getTitle())); ?></li>
                                 <?php } // End of Foreach ?>
                            </ul>
                        <?php  }// End of IF  ?>
                        </li>
                                
                 <?php     }     // End of For Each  ?>
                                
            	</ul>
            </div>
        </nav>
   <?php   } // End of IF  ?>
    

   <?php  /*
                <nav>
                <div class="page menu">
                <ul>
                <li><?php echo link_to('Home','/',array('class' => 'selected')); ?></li>
                <li><?php echo link_to('About us','/aboutus'); ?></li>
                <li><?php echo link_to('Attorney Profile','/attorney-profile'); ?></li>
                <li><?php echo link_to('Practice Areas','/practice-areas'); ?>
                <?php if(!empty($practiceAreaArr)) { ?>
                <ul>
                <?php for($i=0; $i<count($practiceAreaArr); $i++) {?>
                <li><?php echo link_to($practiceAreaArr[$i]['Title'],'/practice-area/'.$practiceAreaArr[$i]['Slug'])?></li>
                <?php }  ?>
                </ul>
                <?php } ?>
                </li>
                <li><?php echo link_to('FAQs','/faq'); ?></li>
                <li><?php echo link_to('Contact','/contact'); ?></li>
                </ul>
                </div>
                </nav>
                */
    ?>
</header>