<section>
  <div class="middle-inner">
    <div class="page">
      <div class="inner-top-link">
        <!--<ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">Find a Attorney</a></li>
          <li><a href="#">Georgia</a></li>
          <li><a class="active" href="#">Daniel Weintraub </a></li>
        </ul>-->
      </div>
      <?php $userslugName = clsCommon::slugify($objUser->getFirstName().' '.$objUser->getLastName());?>  
      <?php $profilePageURL = clsCommon::generateProfilePageURL($objUser->getId(),$userslugName); ?>
      <div class="filter-search">
        <div class="inner-box-title"> 
        <?php echo link_to(ucwords($objUser->getFirstName().' '.$objUser->getLastName()),$profilePageURL); ?>
        <?php #echo ucwords($objUser->getFirstName().' '.$objUser->getLastName()) ; ?> </div>
        <div class="profile-main">
          <div class="profile-left">
            <?php #echo image_tag('legalgrip/profile-img.png')?>
            <?php $imgArr = clsCommon::userProfileImage($objUser->getId(), 'large');   ?>
            
            <?php #echo image_tag($imgArr['path'], array('title' => $imgArr['title'], 'alt'=> $imgArr['title']));?>
            <?php echo link_to(image_tag($imgArr['path'], array('alt'=> $imgArr['title'], 'title'=> $imgArr['title'])),$profilePageURL); ?>
            
            <h3>Speak directly to Attorney <?php echo ucwords($objUser->getFirstName().' '.$objUser->getLastName());?> regarding 
              your case. Get help <a href="javascript:void(0)"  onclick="openContactForm(<?php echo $objUser->getId(); ?>)">now!</a></h3>
            <div class="client-rating">
            
                <?php  
                /*
                $attroneyAdd = '';
                if($objUser->getUsersUserProfile()->getFirmName() != '') {
                    $attroneyAdd .=  $objUser->getUsersUserProfile()->getFirmName().', ';
                }
    
                if($objUser->getUsersUserProfile()->getAddress1() != '') {
                    $attroneyAdd .= $objUser->getUsersUserProfile()->getAddress1();
                }
    
                if($objUser->getUsersUserProfile()->getAddress2() != '') {
                    $attroneyAdd .= ', '.$objUser->getUsersUserProfile()->getAddress2();
                }
                if($objUser->getUsersUserProfile()->getCity() != '') {
                    $attroneyAdd .= ', '.$objUser->getUsersUserProfile()->getCity();
                }
                if($objUser->getUsersUserProfile()->getStateId() != '') {
                    $attroneyAdd .= ', '.$objUser->getUsersUserProfile()->getUserProfileStates()->getName();
                }
                if($objUser->getUsersUserProfile()->getZip() != '') {
                    $attroneyAdd .= ' '.$objUser->getUsersUserProfile()->getZip();
                }
                if($objUser->getUsersUserProfile()->getPhone() != '') {
                    $attroneyAdd .= ', '.$objUser->getUsersUserProfile()->getPhone();
                } */

                /* Start code added by jaydip dodiya */

				$attroneyAdd = '';
            if($objUser->getUsersUserProfile()->getFirmName() != '') {
                $attroneyAdd .=  $objUser->getUsersUserProfile()->getFirmName();
                $attroneyAdd .= '<br>';
            }

            if($objUser->getUsersUserProfile()->getAddress1() != '') {
                $attroneyAdd .= $objUser->getUsersUserProfile()->getAddress1();
                $attroneyAdd .= '<br>';
            }

            if($objUser->getUsersUserProfile()->getAddress2() != '') {
                $attroneyAdd .= $objUser->getUsersUserProfile()->getAddress2();
                $attroneyAdd .= '<br>';
            }
            if($objUser->getUsersUserProfile()->getCity() != '') {
                $attroneyAdd .= $objUser->getUsersUserProfile()->getCity();
            }
            if($objUser->getUsersUserProfile()->getStateId() != '') {
                $attroneyAdd .= ', '.$objUser->getUsersUserProfile()->getUserProfileStates()->getName();
            }
            if($objUser->getUsersUserProfile()->getZip() != '') {
                $attroneyAdd .= ' '.$objUser->getUsersUserProfile()->getZip();
                $attroneyAdd .= '<br>';
            }
            if($objUser->getUsersUserProfile()->getPhone() != '') {
                $attroneyAdd .= $objUser->getUsersUserProfile()->getPhone();
                $attroneyAdd .= '<br>';
            }
            
				if($objUser->getWebsiteSubscriotion() == 'Yes' && $objUser->getUsersUsersWebsite()->getWebsiteurl() != '')
				{
					if($objUser->getUsersUsersWebsite()->getWebsiteurl() != "")
					{
						$attroneyAdd .= link_to("Visit website",  'http://'.$objUser->getUsersUsersWebsite()->getWebsiteurl(), array('target'=>'_blank'));
					}
				}
				/* End code added by jaydip dodiya */
                     ?>

              <h3><?php if(!empty($attroneyAdd) && $attroneyAdd != '')echo $attroneyAdd;?></h3>

              <?php if($objUser->getAvgRating() > 0): ?>
					<h3>Client Rating <?php echo $objUser->getAvgRating(); ?> / 5.0
						<?php $avgRating = $objUser->getAvgRating(); ?>
						<?php $startStr = clsCommon::displayRatingOnProfile($avgRating);
						echo $startStr;  ?>
					</h3>
			<?php else: ?>
					<h3><?php echo sfConfig::get("app_Noreview_Msg"); ?></h3>
			<?php endif; ?>

              <?php if($sf_user->getAttribute('user_user_id') != ''): ?>
					<?php if(ReviewRatingTable::RatingExists($sf_user->getAttribute('user_user_id'), $objUser->getId()) == false): ?>
						<a onclick="openRating('<?php echo $objUser->getId(); ?>');" href="javascript:void(0);" title="Click here to give rating" >Rate this Attorney</a> |
					<!--This Condition is for display message if already rating is given-->
					<?php elseif($sf_user->getAttribute('referer') != ""): ?>
							<?php $sf_user->getAttributeHolder()->remove('referer');?>
							<?php include_partial('default/message'); ?>
					<?php endif; ?>
              <?php else: ?>
					<?php echo link_to('Rate this Attorney','auth/login?flag=referer',array('title'=>"Click here to give rating")); ?>|
              <?php endif; ?>

				<!-- START the changes by jaydip dodiya -->

				<?php echo link_to('Overview',$profilePageURL)?>    <?php if($objUser->getUsersUserProfile()->getFreeConsultation() == 'Yes' ) {?>
				|<a>Free Consultation</a>
				<?php } ?> </div>
				<!-- END the changes by jaydip dodiya -->
				
				<!-- below commented code is before changes -->
				<?php /*
						<?php echo link_to('View Review','attornies/review?id='.$objUser->getId())?>  |  <?php if($objUser->getUsersUserProfile()->getFreeConsultation() == 'Yes' ) {?>
						<a>Free Consultation</a>
				<?php } ?> </div> */ ?>

          </div>
          <div class="profile-right" >
          <?php echo image_tag('legalgrip/right-add.png');?>
        </div>
        </div>
      </div>
      <div class="content-main">
        <div class="content-left overview-review">
          <h1><?php echo link_to('Overview',$profilePageURL)?> <span>Review</span></h1>
          <div class="result-box">
          	<div class="reviewlist">
				<?php if($pager->getnbResults() > 0){?>
                <?php foreach ($pager->getResults() as $reviews) {?>
                <?php $imgArr = clsCommon::userProfileImage($reviews->getUserId(), 'thumb');   ?>
                <div style="border-bottom:solid 1px #d0d0cf;float:left;padding-top:15px;padding-bottom:15px">
                <div class="image"><?php echo image_tag($imgArr['path'], array('title' => $imgArr['title'] ));?></div>
                <div class="reviewdetails">
                <h4><?php echo strtoupper(substr($reviews->getReviewRatingUsers()->getFirstName(), 0, 1).'.'.substr($reviews->getReviewRatingUsers()->getLastName(),0,1).'.')   ; ?></h4>
                <p class="star">
                  <?php  $startStr = clsCommon::displayRatingOnAttorneyListing($reviews->getRate());
                           echo $startStr;  ?>  |  <span><?php echo date('d M Y',strtotime($reviews->getCreateDateTime()));?></span>
                </p>
                <p class="desc"><?php echo nl2br($reviews->getReview());?></p>
                <p></p>
                </div>
                </div>
                <?php } // End of For?>
                <?php } else { ?>
                <div ><!--class="result-box active"-->
                  <div >No Review Found!</div><!--class="result-box-title"-->
                </div>
                <?php } ?>
          	</div>
          </div>
          <?php 
          $varExtra = '';
          $varExtra .="&id=".$objUser->getId();

        ?>
            <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'rating/review', 'varExtra' => $varExtra));?>
        </div>
        <div class="content-right">
          <!-- <div class="right-add"> <?php //echo image_tag('legalgrip/right-add.png');?> </div> -->
          <?php include_component('attornies','topProfessionals'); // Top Professionals ?>
          <div class="professionals-box">
            <h2>Are You a Legal Professional?</h2>
            <p>Knowing how to prepare for a doctor visit in advance will help you reduce anxiety and improve the quality of your health care. Here are some quick tips on how to prepare for your next doctor's appointment.</p>
            <div class="view-more"><a href="#">View More<?php echo image_tag('legalgrip/view-arrow.png');?></a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
$('.reviewlist > div:last').css('border-bottom','0');


function openRating(customerId ) {

    $.fancybox.open({
        href : "<?php echo url_for('rating/reviewRating?customerId=')?>"+customerId,
        type : 'iframe',
        padding : 5,
        minHeight: 370,
        minWidth: 400,
        /*'afterClose':function () {
        window.location.reload();
        }*/
    });

}

function openContactForm(userId) {

    $.fancybox.open({
        href : "<?php echo url_for('contact/index?id=')?>"+userId,
        type : 'iframe',
        padding : 5,
        minHeight: 400,
        minWidth: 400
    });

}


</script>
