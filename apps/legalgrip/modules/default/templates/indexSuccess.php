<?php include_partial('default/message'); ?>

<?php	 /*
if($sf_user->getAttribute('user_user_id') != "")
{
echo link_to("logout","auth/logout");echo "</br>";
echo link_to("EditProfile","registration/myprofile");
}
else
{
echo link_to("Registration","registration/new");
echo " | ";
echo link_to("signIn","auth/login");echo "</br>";

}
*/

?>


<section class="banner">
	<div id="sequence-theme">
		<div id="sequence">
			<?php #echo image_tag('legalgrip/bt-prev.png',array("class"=> "prev", 'alt' => 'Previous Frame' ));?>
			<?php #echo image_tag('legalgrip/bt-prev.png',array("class" => "next", 'alt' => 'Next Frame' ));?>
				
			<ul>
				<li class="animate-in bannere-images">
					<div style="width:980px;margin:auto;">
						<div class="round animate-in">
							<div class="round-inside">
								<h2 class="title">Auto Accidents</h2>
								<h3 class="subtitle">The Responsive Slider with Advanced CSS3 Transitions</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do 
									eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut 
									enim ad minim veniam, quis nostrud exercitation......</p>
								<a class="read-more" href="#">Read More
									<?php echo image_tag('legalgrip/readmore-arrow.png');?>
								</a>
							</div>
						</div>
						<?php echo image_tag('legalgrip/banner-button-1.png', array('class' => "model", 'alt'=> "Model 1" ));?>							
					</div>
				</li>
					
				<li class="animate-in bannere-images-1">
					<div style="width:980px;margin:auto;"><!--div added by jaydip to put home page round image in center-->
						<div class="round animate-in">
							<div class="round-inside">
								<h2 class="title">Auto Accidents</h2>
								<h3 class="subtitle">The Responsive Slider with Advanced CSS3 Transitions</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do 
									eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut 
									enim ad minim veniam, quis nostrud exercitation......</p>
								<a class="read-more" href="#">Read More<?php echo image_tag('legalgrip/readmore-arrow.png');?></a>
							</div>
						</div>
						<?php echo image_tag('legalgrip/banner-button-2.png', array('class' => "model", 'alt'=> "Model 2" ));?>	
					</div>
				</li>

				<li class="animate-in bannere-images-2">
					<div style="width:980px;margin:auto;"><!--div added by jaydip to put home page round image in center-->
						<div class="round animate-in">
							<div class="round-inside">
								<h2 class="title">Auto Accidents</h2>
								<h3 class="subtitle">The Responsive Slider with Advanced CSS3 Transitions</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do 
									eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut 
									enim ad minim veniam, quis nostrud exercitation......</p>
								<a class="read-more" href="#">Read More<?php echo image_tag('legalgrip/readmore-arrow.png');?></a>
							</div>
						</div>
						<?php echo image_tag('legalgrip/banner-button-3.png', array('class' => "model", 'alt'=> "Model 3" ));?>						
					</div>
				</li>

				<li class="animate-in bannere-images-1">
					<div style="width:980px;margin:auto;"><!--div added by jaydip to put home page round image in center-->
						<div class="round animate-in">
							<div class="round-inside">
								<h2 class="title">Auto Accidents</h2>
								<h3 class="subtitle">The Responsive Slider with Advanced CSS3 Transitions</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do 
									eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut 
									enim ad minim veniam, quis nostrud exercitation......</p>
								<a class="read-more" href="#">Read More<?php echo image_tag('legalgrip/readmore-arrow.png');?></a>
							</div>
						</div>
						<?php echo image_tag('legalgrip/banner-button-4.png', array('class' => "model", 'alt'=> "Model 2" ));?>
					</div>
				</li>

				<li class="animate-in bannere-images-1">
					<div style="width:980px;margin:auto;"> <!--div added by jaydip to put home page round image in center-->
						<div class="round animate-in">
							<div class="round-inside">
								<h2 class="title">Auto Accidents</h2>
								<h3 class="subtitle">The Responsive Slider with Advanced CSS3 Transitions</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do 
									eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut 
									enim ad minim veniam, quis nostrud exercitation......</p>
								<a class="read-more" href="#">Read More<?php echo image_tag('legalgrip/readmore-arrow.png');?></a>
							</div>
						</div>
						<?php echo image_tag('legalgrip/banner-button-5.png', array('class' => "model", 'alt'=> "Model 2" ));?>
					</div>
				</li>
			</ul>
		</div>
		<div style="width:980px;margin:auto;">
			<ul class="nav">
				<li><?php echo image_tag('legalgrip/banner-button-1.png', array('alt' => "" ));?></li>
				<li><?php echo image_tag('legalgrip/banner-button-2.png', array('alt' => "" ));?></li>
				<li><?php echo image_tag('legalgrip/banner-button-3.png', array('alt' => "" ));?></li>
				<li><?php echo image_tag('legalgrip/banner-button-4.png', array('alt' => "" ));?></li>
				<li><?php echo image_tag('legalgrip/banner-button-5.png', array('alt' => "" ));?></li>
			</ul>
		</div>
	</div>
</section>

<?php include_component('default', 'featuredAttorney'); // Displays Featured Attorneys ?>

<section>
<div class="middle">
  <div class="page">
    <div class="practice-area">
      <h2>Browse Attorneys by Practice Area</h2>
      <?php if(!empty($practiceAreas) && count($sf_data->getRaw('practiceAreas')) > 0) { ?>
        <ul>
            <?php for($i=0; $i<count($practiceAreas) ; $i++ ) { ?>
                <?php if($i == 18 ) break ; ?>
                <?php #clsCommon::pr($practiceAreas[$i]); 
                    if($practiceAreas[$i]['PLevel'] == 0)  {
                        #$parentCat =  clsCommon::slugify($PracticeCat[$practiceAreas[$i]['CatId']]);
                        $parentCat  =  $PracticeCatSlug[$practiceAreas[$i]['CatId']];
                        $subCat     = 0;
                        $childCat   = 0;
                    
                    } else if($practiceAreas[$i]['PLevel'] == 1){
                        /*$parentCat = clsCommon::slugify($PracticeCat[$practiceAreas[$i]['CatId']]);
                        $subCat      = clsCommon::slugify($PracticeCat[$practiceAreas[$i]['SubCatId']]);*/
                    
                        $parentCat   = $PracticeCatSlug[$practiceAreas[$i]['CatId']];
                        $subCat      = $PracticeCatSlug[$practiceAreas[$i]['SubCatId']];
                        $childCat = 0;
                    
                    } else if($practiceAreas[$i]['PLevel'] == 2) {
                        /*$parentCat = clsCommon::slugify($PracticeCat[$practiceAreas[$i]['CatId']]);
                        $subCat      = clsCommon::slugify($PracticeCat[$practiceAreas[$i]['SubCatId']]);
                        $childCat    = clsCommon::slugify($PracticeCat[$practiceAreas[$i]['ChildId']]);*/
                    
                        $parentCat = $PracticeCatSlug[$practiceAreas[$i]['CatId']];
                        $subCat    = $PracticeCatSlug[$practiceAreas[$i]['SubCatId']];
                        $childCat  = $PracticeCatSlug[$practiceAreas[$i]['ChildId']];
                    
                    }
                #echo  $parentCat.'=='.$subCat.'=='.$childCat; ?>
                
                
                
                <!--<li><a href="#<?php #echo $parentCat.'=='.$subCat.'=='.$childCat; ?>"><?php #echo $practiceAreas[$i]['Name']?></a></li>-->
                
                <?php $serachPageURL = clsCommon::generateBrowseAttorneyPageURL($parentCat, $subCat, $childCat); ?>
                <li><?php echo link_to($practiceAreas[$i]['Name'], $serachPageURL);?></li>
                
                
            <?php } // End of For ?>
        </ul>
      <?php } ?>
      
      <?php if(count($sf_data->getRaw('practiceAreas')) > 0) { ?>
        <a class="practice-area-read-more" href="<?php echo url_for('default/practiceareas')?>">More <span class="read-more-img"></span></a>
      <?php } ?>  
      
      
    </div>
    
    
    <div class="client-say">
      <h2>Recent Review</h2>
        <?php if(!empty($recentReview) && count($sf_data->getRaw('recentReview')) > 0 ) { ?>
        <?php $imgArr = clsCommon::userProfileImage($recentReview['ReviewRatingCustomers']['Id'], 'thumb');?>
        <?php $userslugName = clsCommon::slugify($recentReview['ReviewRatingCustomers']['FirstName'].' '.$recentReview['ReviewRatingCustomers']['LastName']);?>  
        <?php $profilePageURL = clsCommon::generateProfilePageURL($recentReview['ReviewRatingCustomers']['Id'],$userslugName); ?>
        <?php #echo image_tag($imgArr['path']);?>          
        <?php echo link_to(image_tag($imgArr['path'],array('alt'=> $imgArr['title'], 'title'=> $imgArr['title'])),$profilePageURL)?>        
        <p><?php echo link_to(ucwords($recentReview['ReviewRatingCustomers']['FirstName'].' '.$recentReview['ReviewRatingCustomers']['LastName']),$profilePageURL)?></p>
        
        <p class="star"><?php  $startStr = clsCommon::displayRatingOnAttorneyListing($recentReview['Rate']); echo $startStr;  ?> </p>
        <p><span><strong>By <?php echo ucwords($recentReview['ReviewRatingUsers']['FirstName'].' '.$recentReview['ReviewRatingUsers']['LastName'])?></strong>
        <br/>
        <?php echo date('d M Y', strtotime($recentReview['CreateDateTime']));?></span></p>
        <p class="desc"><?php echo nl2br(substr($recentReview['Review'],0, 125 ).'...'); ?></p>
        <?php } else { ?>  
            <p>No Review available for this location</p>
        <?php } ?>
      
    </div>
    
    
    <?php /*
                <div class="client-say">
                <h2>Recent Review</h2>
                <?php echo image_tag('legalgrip/client-img-5.png'); ?>
                <p><a href="#">Bradley Grosh</a></p>
                <p class="star"><?php echo image_tag('legalgrip/for-star.png'); ?></p>
                <p><span><strong>By Joginder Tuteja</strong><br/> 25 Feb 2013, 11:48 hrs IST</span></p>
                <p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...</p>

                </div>
    */ ?>
    
  </div>
  </div>
</section>