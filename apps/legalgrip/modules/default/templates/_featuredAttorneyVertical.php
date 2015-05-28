<?php  if(!empty($featuredArr) && !empty($featuredArr) && !empty($featuredArr[0])) {?>

    <div class="professionals-box">
        <h2>Featured Attorneys</h2>
        
        <?php for($f = 0; $f < count($featuredArr) ; $f++ ) { ?>
            <div class="right-box">

            <?php $userslugName = clsCommon::slugify($featuredArr[$f]['FirstName'].' '.$featuredArr[$f]['LastName']);?>  
                <?php $imgArr = clsCommon::userProfileImage($featuredArr[$f]['Id'], 'small');   ?>
                <?php $profilePageURL = clsCommon::generateProfilePageURL($featuredArr[$f]['Id'],$userslugName); ?>
                
                <?php echo link_to(image_tag($imgArr['path'], array('alt'=> $imgArr['title'], 'title'=> $imgArr['title'])),$profilePageURL); ?>
                 <h4><?php echo link_to(ucwords($featuredArr[$f]['FirstName'].' '.$featuredArr[$f]['LastName']),$profilePageURL); ?></h4>
                 
                    <?php $practiceArr = UserPracticeAreaTable::getFeaturedCustomerPracticeArea($featuredArr[$f]['Id']); ?>
                    
                    <?php if(!empty($practiceArr)){ ?>
                            <p style="width:55%;">
                                <?php for($p = 0 ; $p < count($practiceArr) ; $p++) {
                                        echo $practiceArr[$p]['UserPracticeAreaPracticeAreas']['Name'];
                                        echo '<br>';
                                        } // End of For ?>
                            </p>
                    <?php } // End of IF */ ?>                    
               
               <div class="right-view">
				<?php if($featuredArr[$f]['AvgRating']>0): ?>
					<?php  	$startStr = clsCommon::displayRatingOnAttorneyListing($featuredArr[$f]['AvgRating']);
							echo $startStr;  ?>
				<?php else: ?>
							<?php echo sfConfig::get("app_Noreview_Msg");  ?>
				<?php endif; ?>
                     
                 <?php echo link_to('View Profile'.image_tag('legalgrip/view-arrow.png'),$profilePageURL); ?>
               </div>
            </div>
        <?php } // End of For ?>
    </div>
    
<?php } // End of IF  ?>