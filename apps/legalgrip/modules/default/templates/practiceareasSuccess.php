<section>
<div class="middle-inner">
  <div class="page">
    <div class="inner-top-link">
      <!--<ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Find a Attorney</a></li>
        <li><a class="active" href="#">Georgia</a></li>
      </ul>-->
    </div>
    <div class="filter-search">
      <div class="inner-box-title">Browse Practice Area</div>
    </div>
    <div class="content-main">
    	<div class="browseArea-main">
    		<div class="static-content browseArea browsepracticearea">
				<?php if(!empty($parentPracticeAreas)) {?>
                	<ul>
                    <?php for($i=0; $i<count($parentPracticeAreas) ; $i++ ) { ?>
                    
                        <?php #$parentSlug =  clsCommon::slugify($parentPracticeAreas[$i]['PName']); ?>
                        <?php $parentSlug =  $parentPracticeAreas[$i]['PSlug']; ?>
                        <?php $parentSlugURL = clsCommon::generateBrowseAttorneyPageURL($parentSlug,0 ,0); ?>
                        
                        <li><?php echo link_to($parentPracticeAreas[$i]['PName'], $parentSlugURL );?>

                        
                            <?php // Get  Sub cat ?>
                            <?php $subPracticeAreas = PracticeAreasTable::getMaxUsedSubParcticeArea($parentPracticeAreas[$i]['PCatId']); ?>
                            <?php if(!empty($subPracticeAreas)) { ?>
                                <ul>
                                    <?php for($j=0; $j < count($subPracticeAreas) ; $j++) {?>
                                        <?php #$subSlug =  clsCommon::slugify($subPracticeAreas[$j]['PName']); ?>
                                        <?php $subSlug =  $subPracticeAreas[$j]['PSlug']; ?>
                                        <?php $subSlugURL = clsCommon::generateBrowseAttorneyPageURL($parentSlug, $subSlug,0); ?>
                                        
                                        <li> <?php echo link_to($subPracticeAreas[$j]['PName'], $subSlugURL );?>
                                        
                                        <?php $childPracticeAreas = PracticeAreasTable::getMaxUsedChildParcticeArea($subPracticeAreas[$j]['PSubCatId']); ?>
                                        <?php if(!empty($childPracticeAreas)) { ?>
                                            <ul>
                                                <?php for($k=0; $k < count($childPracticeAreas) ; $k++) {?>
                                                    <?php #$childSlug =  clsCommon::slugify($childPracticeAreas[$k]['PName']); ?>
                                                    <?php $childSlug =  $childPracticeAreas[$k]['PSlug']; ?>
                                                    <?php $childSlugURL = clsCommon::generateBrowseAttorneyPageURL($parentSlug, $subSlug,$childSlug); ?>
                                                    
                                                    <li><?php echo link_to($childPracticeAreas[$k]['PName'], $childSlugURL );?>  </li>
                                                <?php } ?>                                            
                                            </ul>
                                        
                                        
                                        <?php } // End of IF ?>
                                        
                                        </li>
                                    <?php } // end of For with J ?>
                                </ul>
                            
                            <?php } // End of If Not Empty Subpractice Areas?>
                        
                        </li>
                        
                    <?php } // End of For with I ?>
                </ul>
             	<?php } ?>        
          </div>
          
          
        	<div class="practiceareafalist" >
        	<?php #include_component('attornies','topProfessionals'); // Top Professionals ?>
        	
        	<?php include_component('default', 'featuredAttorneyVertical'); // Displays Featured Attorneys ?>
            <!--<ul>
            	<li><a href="#">About Us</a></li>
                <li><a href="#">The Team</a></li>
                <li><a href="#">Media</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>-->
        </div>
        
        
        </div>
    </div>
  </div>
  </div>
</section>


<?php /*

<?php #clsCommon::pr($parentPracticeAreas);?>

<br><br><br><br><br><br><br><br><br>

<?php if(!empty($parentPracticeAreas)) {?>
        <ul>
            <?php for($i=0; $i<count($parentPracticeAreas) ; $i++ ) { ?>
                <?php $parentSlug =  clsCommon::slugify($parentPracticeAreas[$i]['PName']); ?>
                
                <li><a href="#<?php echo $parentSlug ;?>"><?php echo $parentPracticeAreas[$i]['PName']?></a>
                
                    <?php // Get  Sub cat ?>
                    <?php $subPracticeAreas = PracticeAreasTable::getMaxUsedSubParcticeArea($parentPracticeAreas[$i]['PCatId']); ?>
                    <?php if(!empty($subPracticeAreas)) { ?>
                        <ul>
                            <?php for($j=0; $j < count($subPracticeAreas) ; $j++) {?>
                                <?php $subSlug =  clsCommon::slugify($subPracticeAreas[$j]['PName']); ?>
                                <li> ---<a href="#<?php echo $subSlug ;?>"><?php echo $subPracticeAreas[$j]['PName']?></a>
                                
                                <?php $childPracticeAreas = PracticeAreasTable::getMaxUsedChildParcticeArea($subPracticeAreas[$j]['PSubCatId']); ?>
                                <?php if(!empty($childPracticeAreas)) { ?>
                                    <ul>
                                        <?php for($k=0; $k < count($childPracticeAreas) ; $k++) {?>
                                            <?php $childSlug =  clsCommon::slugify($childPracticeAreas[$k]['PName']); ?>
                                            <li> ------<a href="#<?php echo $childSlug ;?>"><?php echo $childPracticeAreas[$k]['PName']?></a></li>
                                        <?php } ?>                                            
                                    </ul>
                                
                                
                                <?php } // End of IF ?>
                                
                                </li>
                            <?php } // end of For with J ?>
                        </ul>
                    
                    <?php } // End of If Not Empty Subpractice Areas?>
                
                </li>
                
            <?php } // End of For with I ?>
        </ul>
      <?php } ?>

*/ ?>