<?php if(!empty($topProfessionalsArr) && !empty($topProfessionalsArr[0]))  { ?>
    <div class="professionals-box">
        <h2>Top Professionals</h2>
        
        <?php for($tp = 0; $tp < count($topProfessionalsArr) ; $tp++ ) { ?>
            <div class="right-box">
                <?php #echo image_tag('legalgrip/in-client-1.png');?>
                
                <?php $userslugName = clsCommon::slugify($topProfessionalsArr[$tp]['FirstName'].' '.$topProfessionalsArr[$tp]['LastName']);?>  
                <?php $imgArr = clsCommon::userProfileImage($topProfessionalsArr[$tp]['Id'], 'small');   ?>
                <?php $profilePageURL = clsCommon::generateProfilePageURL($topProfessionalsArr[$tp]['Id'],$userslugName); ?>
                
                <?php echo link_to(image_tag($imgArr['path'], array('alt'=> $imgArr['title'], 'title'=> $imgArr['title'])),$profilePageURL); ?>
                 <h4><?php echo link_to(ucwords($topProfessionalsArr[$tp]['FirstName'].' '.$topProfessionalsArr[$tp]['LastName']),$profilePageURL); ?></h4>
                	
                <p style="width:55%;">
                	
                     <?php  
                     $attroneyAdd = '';
                     /*
                     if(!empty($topProfessionalsArr[$tp]['UsersUserProfile']['Address1'])) {
                         $attroneyAdd .= $topProfessionalsArr[$tp]['UsersUserProfile']['Address1'];
                     }
                     */

                     /*if(!empty($topProfessionalsArr[$tp]['UsersUserProfile']['Address2'])) {
                     $attroneyAdd .= ', '.$topProfessionalsArr[$tp]['UsersUserProfile']['Address2'];
                     }*/
                     
                     if(!empty($topProfessionalsArr[$tp]['UsersUserProfile']['City'])) {
                         $attroneyAdd .= $topProfessionalsArr[$tp]['UsersUserProfile']['City'];
                         $attroneyAdd .= "<br>";
                     }
                     if(!empty($topProfessionalsArr[$tp]['UsersUserProfile']['StateId'])) {
                         $attroneyAdd .= $topProfessionalsArr[$tp]['UsersUserProfile']['UserProfileStates']['Name'];
                     }
                     /*
                     if(!empty($topProfessionalsArr[$tp]['UsersUserProfile']['Zip'])) {
                         $attroneyAdd .= ', '.$topProfessionalsArr[$tp]['UsersUserProfile']['Zip'];
                     }*/
                     echo $attroneyAdd;     ?>
                    <br>
                    
               </p>
               
               <div class="right-view">
                 <?php  $startStr = clsCommon::displayRatingOnAttorneyListing($topProfessionalsArr[$tp]['AvgRating']);
                     echo $startStr;  ?>
                 <?php echo link_to('View Profile'.image_tag('legalgrip/view-arrow.png'),$profilePageURL); ?>
               </div>
            </div>
        <?php } // End of For ?>
    </div>

<?php } // End of IF  ?>