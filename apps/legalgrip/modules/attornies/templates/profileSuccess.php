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
    <div class="filter-search">
      <div class="inner-box-title">
        <?php #echo ucwords($objUser->getFirstName().' '.$objUser->getLastName()) ; ?>
        <?php $userslugName = clsCommon::slugify($objUser->getFirstName().' '.$objUser->getLastName());?>              
        <?php $profilePageURL = clsCommon::generateProfilePageURL($objUser->getId(),$userslugName); ?>
        <?php echo link_to(ucwords($objUser->getFirstName().' '.$objUser->getLastName()),$profilePageURL); ?>
      </div>
      <div class="profile-main">
        <div class="profile-left">
          <?php #echo image_tag('legalgrip/profile-img.png')?>
          <?php $imgArr = clsCommon::userProfileImage($objUser->getId(), 'large');   ?>
          
          <?php echo link_to(image_tag($imgArr['path'], array('alt'=> $imgArr['title'], 'title'=> $imgArr['title'])),$profilePageURL); ?>
          
          
          <h3>Speak directly to Attorney <?php echo ucwords($objUser->getFirstName().' '.$objUser->getLastName());?> regarding 
your case. Get help <a href="javascript:void(0)"  onclick="openContactForm(<?php echo $objUser->getId(); ?>)">now!</a></h3>
         <div class="client-rating">
            <?php  
            /*$attroneyAdd = '';
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
            }*/

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
					<a onclick="openRating('<?php echo $objUser->getId(); ?>');" href="javascript:void(0);" title="Click here to give rating" >Rate this Attorney</a> 
				<!--This Condition is for display message if already rating is given-->
				<?php elseif($sf_user->getAttribute('referer') != ""): ?>
						<?php $sf_user->getAttributeHolder()->remove('referer');?>
						<?php include_partial('default/message'); ?>
				<?php endif; ?>
			<?php else: ?>
				<?php echo link_to('Rate this Attorney','auth/login?flag=referer',array('title'=>"Click here to give rating")); ?>
			<?php endif; ?>
			
			<?php if($sf_user->getAttribute('user_user_id') != '' && $objUser->getAvgRating() > 0 ): ?>
				<?php if(ReviewRatingTable::RatingExists($sf_user->getAttribute('user_user_id'), $objUser->getId()) == false && $objUser->getAvgRating() > 0): ?>
					|
				<?php endif; ?>
			<?php elseif($objUser->getAvgRating() > 0): ?>
					|
			<?php endif; ?>
			
			<!--condition is for display view rating-->
			<?php if($objUser->getAvgRating() > 0): ?>
				<?php echo link_to('See Reviews','rating/review?id='.$objUser->getId()) ?> 
			<?php endif; ?>

			<!--This condition is for display pipe sign-->
			<?php if($objUser->getAvgRating() > 0 && $objUser->getUsersUserProfile()->getFreeConsultation() == 'Yes' ): ?>
					|
			<?php elseif($objUser->getUsersUserProfile()->getFreeConsultation() == 'Yes' ):?>
					|
			<?php endif;?>

			<?php if($objUser->getUsersUserProfile()->getFreeConsultation() == 'Yes' ) {?>
                 <a>Free Consultation</a> 
                <!--| <a href="#">Credit Cards Accepted</a>-->
            <?php } ?> 
         </div>

        </div>
        <div class="profile-right" >
          <?php echo image_tag('legalgrip/right-add.png');?>
        </div>
        
        
      </div>
    </div>
    <div class="content-main">
    <div class="content-left overview-review">
		<h1>
			<span>Overview</span>
			<!--this condition is for review rating is exists then and then link display-->
			<?php if($objUser->getAvgRating() > 0): ?>				
				<?php echo link_to('See Reviews','rating/review?id='.$objUser->getId())?>
			<?php endif; ?>
		</h1>
      <div class="result-box">
      
      <?php # /* Old Code of Practice Area?>
      <?php /*$userPracticeAreas = UsersTable::getUserPracticeArea($objUser->getId());   ?>
						<?php if(!empty($userPracticeAreas)) {?>
						<div class="overview-practice-area">
						<p>Practice Areas</p>
						<ul>
						<?php for($i=0;$i<count($userPracticeAreas); $i++)  { ?>
						<li> <a><?php echo $userPracticeAreas[$i]['practiceareaname']?></a> </li>
						<?php } // end of for  ?>
						</ul>
						</div>
        <?php }  */// End of IF ?>
        <?php #Old code complete */ ?>
        
        <?php if($objUser->getUsersUserProfile()->getSummary() != '' ) {?>
        <div class="payment" style="border-top:none 0px;">
          <p>Bio-data</p>
          <div class="payment-right">
            <?php echo html_entity_decode(nl2br($objUser->getUsersUserProfile()->getSummary()));?>
            </div>
        </div>
        <?php } ?>
        
      
      <?php if(!empty($usersPracticeArr) && count($usersPracticeArr) > 0 )  {?>
         <div class="overview-practice-area" style="border-top:1px solid #D0D0CF;">   
             <p>Practice Areas</p>
                <ul>
                 <?php foreach($usersPracticeArr as $key => $val) { ?>
                    
                    <li><a class="main"><?php echo $val['Parent']; #echo $key.'=='.$val['Parent'].'<br>';  // Shows Parent Category  // $key will be Parent category ID ?></a>
                    
                    <?php if(isset($val['Subcat'])) { // If Sub Category Exists ?>
                            <ul>
                                <?php  foreach($val['Subcat']['Name'] as $sub => $subname) {?>
                                       <li>  <a><?php echo $subname ; #echo $sub.'++'.$subname ; // $sub will be Sub category ID ?></a> 
                                       
                                       
                                       <?php if(isset($val['Subcat']['Name-'.$sub])) {  // IF Sub Category Exist ?> 
                                            <ul>
                                            <?php foreach($val['Subcat']['Name-'.$sub]['Child'] as $child => $childname ) {?>
                                                <li><a><?php echo $childname ; #echo $child.'++'.$childname ; // $child will be Child Category ID ?></a></li>
                                            <?php } // End of For each ?>
                                            </ul>
                                        <?php   } // End of IF if(isset($val['Subcat']['Name-'.$sub] ?>
                                	</li>
                                <?php } // End of For Each for Sub category?>
                            </ul>
                    
                    <?php } // End of if sub Category Not Exist ?>
              		</li>
                
                <?php } // End of For Each ?>
                </ul>
        </div>
      <?php } // End of if Not Empty  $usersPracticeArr?>
      
      <?php if(!empty($usersPracticeLocation) && count($usersPracticeLocation) > 0 )  {?>
         <div class="overview-practice-area" style="border-top:1px solid #D0D0CF;">   
             <p>Practice Area Location</p>
                <ul>
                 <?php foreach($usersPracticeLocation as $key => $val) { ?>
                    <li><a class="main"><?php echo $val['Name'];  ?></a>
                    <?php if(isset($val['County'])) { // If County Exists  ?>
                            <ul>
                                <?php  foreach($val['County'] as $k => $v) {?>
                                       <li>  <a><?php echo $v['Name'] ; ?></a> </li>
                                <?php } // End of For Each for Sub category?>
                            </ul>
                    <?php } // End of if sub Category Not Exist ?>
              		</li>
                
                <?php } // End of For Each ?>
                </ul>
        </div>
      <?php } // End of if Not Empty  $usersPracticeArr?>
      
      
      
      
      
        <?php if($objUser->getUsersUserProfile()->getFeesInformation() != '' ) {?>
        <div class="payment">
          <p>Fees and Payment Types</p>
           <div class="payment-right">
            <p><?php echo nl2br($objUser->getUsersUserProfile()->getFeesInformation()) ;?></p>
         </div>
        </div>
        <?php } ?>


        <div class="payment">
          <p>Contact 
Information</p>
         <div class="payment-right">
         
         <?php echo image_tag('legalgrip/address-icons.png');?>
           <p class="address"><strong><?php echo ucwords($objUser->getFirstName().' '.$objUser->getLastName());?></strong> 
           
            <?php  
            $attroneyAdd = '';
            if($objUser->getUsersUserProfile()->getFirmName() != '') {
                $attroneyAdd .=  $objUser->getUsersUserProfile()->getFirmName();
            }

            if($objUser->getUsersUserProfile()->getAddress1() != '') {
                $attroneyAdd .= '<br>';
                $attroneyAdd .= $objUser->getUsersUserProfile()->getAddress1();
            }

            if($objUser->getUsersUserProfile()->getAddress2() != '') {
                $attroneyAdd .= '<br>';
                $attroneyAdd .= $objUser->getUsersUserProfile()->getAddress2();
            }
            if($objUser->getUsersUserProfile()->getCity() != '') {
                $attroneyAdd .= '<br>';
                $attroneyAdd .= $objUser->getUsersUserProfile()->getCity();
            }
            if($objUser->getUsersUserProfile()->getStateId() != '') {
                $attroneyAdd .= ', '.$objUser->getUsersUserProfile()->getUserProfileStates()->getName();
            }
            if($objUser->getUsersUserProfile()->getZip() != '') {
                $attroneyAdd .= ' '.$objUser->getUsersUserProfile()->getZip();
            }
            /*
            if($objUser->getUsersUserProfile()->getPhone() != '') {
                $attroneyAdd .= '<br>';
                $attroneyAdd .= $objUser->getUsersUserProfile()->getPhone();
            }*/
                 ?>
           
            <?php if(!empty($attroneyAdd) && $attroneyAdd!= '')
            echo $attroneyAdd;
            /*else
            echo 'Address Not Specified';*/
                 ?>
           </p>
         <div class="email-box-main">
         
         <?php if($objUser->getUsersUserProfile()->getPhone() != '' ) {?>
             <div class="email-box">
               <?php echo image_tag('legalgrip/phone-icon.png');?>
               <p><?php echo $objUser->getUsersUserProfile()->getPhone() ;  ?></p>
             </div>
         <?php } ?>
         
         <div class="email-box">
           <?php echo image_tag('legalgrip/email-icon.png');?>
           <a class="add-btn" href="javascript:void(0)" onclick="openContactForm(<?php echo $objUser->getId();?>)" >Contact this Attorney</a>
         </div>
         
         <?php if($objUser->getWebsiteSubscriotion() == 'Yes' && $objUser->getUsersUsersWebsite()->getWebsiteurl() != '') {?>
             <div class="email-box">
               <?php echo image_tag('legalgrip/visit-icon.png');?>
               
               <p><?php echo link_to('Visit website',  'http://'.$objUser->getUsersUsersWebsite()->getWebsiteurl(), array('target'=>'_blank')); ?></p>
             </div>
         <?php } ?>
         
         
         </div>
         <?php if( $objUser->getUsersUserProfile()->getAddress1() != '' || $objUser->getUsersUserProfile()->getCity() != '' || $objUser->getUsersUserProfile()->getUserProfileStates()->getName() != '') { ?>
             <p>
              <iframe width="510" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo urlencode($objUser->getUsersUserProfile()->getAddress1())?>,<?php echo urlencode($objUser->getUsersUserProfile()->getCity())?>+,+<?php echo urlencode($objUser->getUsersUserProfile()->getUserProfileStates()->getName())?>+,+<?php echo urlencode($objUser->getUsersUserProfile()->getZip())?>,+United+States&amp;aq=&amp;sll=25.745934,-80.304496&amp;sspn=0.042753,0.084543&amp;t=h&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo urlencode($objUser->getUsersUserProfile()->getAddress1())?>,<?php echo urlencode($objUser->getUsersUserProfile()->getCity())?>,+<?php echo urlencode($objUser->getUsersUserProfile()->getUserProfileStates()->getName())?>+,+<?php echo urlencode($objUser->getUsersUserProfile()->getZip())?>,+United+States&amp;output=embed"></iframe>
             </p>             
         <?php } ?>
         </div>
        </div>
        
        <?php /*if($objUser->getUsersUserProfile()->getSummary() != '' ) {?>
        <div class="payment">
          <p>Bio-data</p>
          <div class="payment-right">
            <?php echo html_entity_decode(nl2br($objUser->getUsersUserProfile()->getSummary()));?>
            </div>
        </div>
        <?php } */?>
        
      </div>
      
    </div>
    <div class="content-right">
      <!--<div class="right-add">
        <?php //echo image_tag('legalgrip/right-add.png');?>
      </div>-->
      
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
/*
jQuery(document).ready(function($) {
	
	'<?php //if($popupOpen != ""):?>'
		openRating('<?php //echo $objUser->getId(); ?>');
	'<?php //endif;?>'
});
*/
function openRating(customerId ) {

    $.fancybox.open({
        href : "<?php echo url_for('rating/reviewRating?customerId=')?>"+customerId,
        type : 'iframe',
        padding : 5,
        minHeight: 370,
        minWidth: 400 /*,
        'afterClose':function () {
        window.location.reload();
        }*/
    });

}
function openContactForm(userId) {

    $.fancybox.open({
        href : "<?php echo url_for('contact/index?id=')?>"+userId,
        type : 'iframe',
        padding : 5,
        minHeight: 420,
        minWidth: 400
    });

}

</script>
