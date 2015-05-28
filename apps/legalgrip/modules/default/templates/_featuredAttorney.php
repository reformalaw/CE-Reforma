<?php  if(!empty($featuredArr) && !empty($featuredArr) && !empty($featuredArr[0])) {?>

<section>
    <div class="featured">
        <div class="page">
            <h2>Featured Attorneys</h2>
        </div>
        <div class="client-post">
            <div class="page">
                <?php for($f = 0 ; $f < count($featuredArr) ; $f++ ) { ?>
                    <div class="client-box">
                        <?php #echo image_tag('legalgrip/client-img-1.png');?>
                        <?php $imgArr = clsCommon::userProfileImage($featuredArr[$f]['Id'], 'thumb'); 
                        $userslugName = clsCommon::slugify($featuredArr[$f]['FirstName'].' '.$featuredArr[$f]['LastName'],'_');
                        $profilePageURL = clsCommon::generateProfilePageURL($featuredArr[$f]['Id'],$userslugName);
                        ?>
                        
                        <?php #echo link_to(image_tag($imgArr['path'], array('alt'=> $imgArr['title'], 'title'=> $imgArr['title'])),'attornies/profile?id='.$featuredArr[$f]['Id'].'&name='.$userslugName); ?>
                        <?php echo link_to(image_tag($imgArr['path'], array('alt'=> $imgArr['title'], 'title'=> $imgArr['title'])),$profilePageURL); ?>
                        <h3>
                            <!--<a href="<?php #echo url_for('attornies/profile?id='.$featuredArr[$f]['Id'].'&nameslug='.$userslugName);?>"><?php #echo $featuredArr[$f]['FirstName'].' '.$featuredArr[$f]['LastName'] ; ?></a>-->
                            <?php #echo url_for('job/show?id=1&company=abm&location=ahm&position=tl');?>
                            <?php echo link_to(ucwords($featuredArr[$f]['FirstName'].' '.$featuredArr[$f]['LastName']),$profilePageURL); ?>
                        </h3>
                        
                       <div class="homestar"> 
                        <?php
							if($featuredArr[$f]['AvgRating']>0)
							{
								$startStr = clsCommon::displayRatingOnAttorneyListing($featuredArr[$f]['AvgRating']);
								echo $startStr;
							}
							else
                                echo sfConfig::get("app_Noreview_Msg");  ?>
                         </div>
                                
                          <div class="featuredattlist">     
                         <?php $practiceArr = UserPracticeAreaTable::getFeaturedCustomerPracticeArea($featuredArr[$f]['Id']);
                         #clsCommon::pr($practiceArr); die;
                         if(!empty($practiceArr)){
                         for($p = 0 ; $p < count($practiceArr) ; $p++) {
                         echo $practiceArr[$p]['UserPracticeAreaPracticeAreas']['Name'];
                         echo '<br>';
                         } // End of For

                         } // End of IF 
                         ?>   
                         </div>   
                        <!--<p><a href="#">View</a> Complete Attorney Bio</p>-->
                     </div>
                <?php } // End of For ?>
            </div>
        </div>
    </div>
</section>

<?php } else { ?>

<section>
    <div class="featured" style="height:90px;"> </div>
</section>

<?php } ?>