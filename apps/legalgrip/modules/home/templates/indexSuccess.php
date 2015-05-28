	<script>
	(function($){

	    $(window).load(function(){
	        $("#country_id_4").selectbox();
	        $("#content_1").mCustomScrollbar({
	            scrollButtons:{
	                enable:true
	            }
	        });
	        $("#content_2").mCustomScrollbar({
	            scrollButtons:{
	                enable:true
	            }
	        });
	        $("#content_3").mCustomScrollbar({
	            scrollButtons:{
	                enable:true
	            }
	        });
	        /*demo fn*/
	        $("#add-content").click(function(e){
	            e.preventDefault();
	            $("#content_1 .mCSB_container").append("<p>Lorem ipsum dolor sit amet. Consectetur adipiscing elit. Donec egestas mi turpis. Fusce adipiscing dui eu metus gravida vel facilisis ligula iaculis.</p>");
	            $("#content_1").mCustomScrollbar("update");
	        });
	        $("#remove-content").click(function(e){
	            e.preventDefault();
	            $("#content_1 .mCSB_container p:last").remove();
	            $("#content_1").mCustomScrollbar("update");
	        });
	    });
	})(jQuery);
	</script>
	
<section>
<div class="middle-inner">
  <div class="page">
    <div class="inner-top-link">
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Find a Attorney</a></li>
        <li><a class="active" href="#">Georgia</a></li>
      </ul>
    </div>
    <div class="filter-search">
      <div class="inner-box-title">
        Filter Your Search
      </div>
      <div class="filter-practice-areas">
      <h2>Practice Areas</h2>
        <div class="practice-areas-box">
          <div class="wrapper">
		
		<!-- content block -->
 		<div id="content_1" class="content">
			<ul>
              <li><a href="#">Attorney</a></li>
              <li><a href="#">Private Investigator</a></li>
              <li><a href="#">Bail Bondsman</a></li>
              <li><a href="#">Interpreter</a></li>
              <li><a href="#">Expert</a></li>
            </ul>
		</div>
	</div>
    <div class="wrapper">
		
		<!-- content block -->
 		<div id="content_2" class="content">
			<ul>
              <li><a href="#">Criminal</a></li>
              <li><a href="#">Civil</a></li>
              <li><a href="#">Family</a></li>
              <li><a href="#">Probate</a></li>
              <li><a href="#">ETC</a></li>
            </ul>
		</div>
	</div>
    <div class="wrapper">
		
		<!-- content block -->
 		<div id="content_3" class="content">
			<ul>
              <li><a href="#">Drug</a></li>
              <li><a href="#">Theft</a></li>
              <li><a href="#">Driver's License</a></li>
              <li><a href="#">Misdemeanor</a></li>
              <li><a href="#">Felony</a></li>
            </ul>
		</div>
	</div>
        </div>
        <div class="practice-areas-search">
          <input name="check" type="checkbox" >
          <p>Offer Free counstation (245)</p>
          <a class="areas-search" href="#">Search</a>
        </div>
      </div>
      <div class="top-counties">
        <h2>Top Counties</h2>
        <ul>
          <li><input name="check" type="checkbox" ><span>Florida</span></li>
          <li><input name="check" type="checkbox" ><span>Alaska</span></li>
          <li><input name="check" type="checkbox" ><span>Louisiana</span></li>
          <li><input name="check" type="checkbox" ><span>Georgia</span></li>
          <li><input name="check" type="checkbox" ><span>Nebraska</span></li>
          <li><input name="check" type="checkbox" ><span>Nevada </span></li>
          <li><input name="check" type="checkbox" ><span>Oklahoma</span></li>
          <li><input name="check" type="checkbox" ><span>Oregon</span></li>
          <li><input name="check" type="checkbox" ><span>Vermont</span></li>
          <li><input name="check" type="checkbox" ><span>Virginia</span></li>
          <li><input name="check" type="checkbox" ><span>Kansas</span></li>
          <li><input name="check" type="checkbox" ><span>Pennsylvania</span></li>
        </ul>
      </div>
    </div>
    <div class="content-main">
    <div class="content-left">
      <h1>Results<span>(<?php echo $pager->getnbResults();?> profiles found)</span></h1>
      
        <?php if($pager->getnbResults() > 0){?>        
          <p class="sort">Sort by: 
          <select name="country_id" id="country_id_4" tabindex="1">
    			<option value="4">Rating</option>
    		</select>
          </p>
        <?php } ?>      
      
      <?php if($pager->getnbResults() > 0){?>
            
            <?php $i = 0; ?>
            <?php foreach ($pager->getResults() as $users) {?>
            
              <div class="result-box <?php echo ($i == 0) ? 'active' : '' ?>">
                <div class="result-box-title">
                  <h2><?php echo $users->getFirstName().' '.$users->getLastName().' '.$users->getId(); ?> <span>Client Rating 5.0 / 5.0 <?php echo image_tag('legalgrip/five-star.png')?></span></h2>
                  <div class="result-box-in">
                     <?php $imgArr = clsCommon::userProfileImage($users->getId(), 'thumb');   ?>
                     <?php echo image_tag($imgArr['path'], array('title' => $imgArr['title'], 'alt'=> $imgArr['title'],'width'=> '80px'));?>
                     <p>
                         <?php  if($users->getUsersUserProfile()->getFirmName() != '') {
                             echo  $users->getUsersUserProfile()->getFirmName();
                         }  ?>
                         <br>
                         <?php  
                         $attroneyAdd = '';
                         if($users->getUsersUserProfile()->getAddress1() != '') {
                             $attroneyAdd .= $users->getUsersUserProfile()->getAddress1();
                         }
    
                         if($users->getUsersUserProfile()->getAddress2() != '') {
                             $attroneyAdd .= ', '.$users->getUsersUserProfile()->getAddress2();
                         }
                         if($users->getUsersUserProfile()->getCity() != '') {
                             $attroneyAdd .= ', '.$users->getUsersUserProfile()->getCity();
                         }
                         if($users->getUsersUserProfile()->getStateId() != '') {
                             $attroneyAdd .= ', '.$users->getUsersUserProfile()->getUserProfileStates()->getName();
                         }
                         if($users->getUsersUserProfile()->getZip() != '') {
                             $attroneyAdd .= ', '.$users->getUsersUserProfile()->getZip();
                         }
                         echo $attroneyAdd;     ?>
                     </p>
                     <ul>
                       <li><a href="#">Federal Criminal Law</a></li>
                       <li><a href="#">Criminal Law</a></li>
                       <li><a href="#">Divorce Law</a></li>
                       <li><a href="#">Commercial Law</a></li>
                       <li><a href="#">View All...</a></li>
                     </ul>
                     <div class="view-profile">
                       <p>Speak directly to Attorney Lawrence 
        Diamond regarding your car accident 
        case. Get help now!</p>
                      <a class="con-icon" href="#">Contact Us</a>
                      <a class="view-arrow" href="#">View Profile</a>
                     </div>
                  </div>
                </div>
              </div>
            <?php $i++ ; ?>
            
            <?php } // End of For ?>
            
            
      <?php } else { ?>
            <div class="result-box active">
                <div class="result-box-title">No Attorneys found!</div>
            </div>                
      <?php } ?>
      
    <?php 
    $varExtra = '';
    if(isset($defaultPagingArr['DefaultState']) && !empty($defaultPagingArr['DefaultState'])) {
        $varExtra .="&stateId=".$defaultPagingArr['DefaultState'];
    }
    if(isset($defaultPagingArr['Searchby']) && !empty($defaultPagingArr['Searchby'])) {
        $varExtra .="&searchby=".$defaultPagingArr['Searchby'];
    }
    if(isset($defaultPagingArr['BasicSearch']) && !empty($defaultPagingArr['BasicSearch'])) {
        $varExtra .="&basicSearch=".$defaultPagingArr['BasicSearch'];
    }
    if(isset($defaultPagingArr['ParentPracticeArea']) && !empty($defaultPagingArr['ParentPracticeArea'])) {
        $varExtra .="&praentId=".$defaultPagingArr['ParentPracticeArea'];
    }
    if(isset($defaultPagingArr['SubPracticeArea']) && !empty($defaultPagingArr['SubPracticeArea'])) {
        $varExtra .="&subId=".$defaultPagingArr['SubPracticeArea'];
    }
    if(isset($defaultPagingArr['ChildPracticeArea']) && !empty($defaultPagingArr['ChildPracticeArea'])) {
        $varExtra .="&childId=".$defaultPagingArr['ChildPracticeArea'];
    }
    ?>
    <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'attornies/index', 'varExtra' => $varExtra));?>
      
      
      <?php /* ?>
      <div class="result-box">
        <div class="result-box-title">
          <h2>Daniel Weintraub <span>Client Rating 5.0 / 5.0<?php echo image_tag('legalgrip/five-star.png')?></span></h2>
          <div class="result-box-in">
             <?php echo image_tag('legalgrip/in-client-2.png');?>
             <p>Doenier Family Medicine
1111 Delafield St Ste 321
Waukesha, WI 53188</p>
             <ul>
               <li><a href="#">Federal Criminal Law</a></li>
               <li><a href="#">Criminal Law</a></li>
               <li><a href="#">Divorce Law</a></li>
               <li><a href="#">Commercial Law</a></li>
               <li><a href="#">View All...</a></li>
             </ul>
             <div class="view-profile">
               <p>Speak directly to Attorney Lawrence 
Diamond regarding your car accident 
case. Get help now!</p>
              <a class="con-icon" href="#">Contact Us</a>
              <a class="view-arrow" href="#">View Profile</a>
             </div>
          </div>
        </div>
      </div>
      <div class="result-box">
        <div class="result-box-title">
          <h2>Daniel Weintraub <span>Client Rating 5.0 / 5.0<?php echo image_tag('legalgrip/five-star.png')?></span></h2>
          <div class="result-box-in">
             <?php echo image_tag('legalgrip/in-client-3.png');?>
             <p>Doenier Family Medicine
1111 Delafield St Ste 321
Waukesha, WI 53188</p>
             <ul>
               <li><a href="#">Federal Criminal Law</a></li>
               <li><a href="#">Criminal Law</a></li>
               <li><a href="#">Divorce Law</a></li>
               <li><a href="#">Commercial Law</a></li>
               <li><a href="#">View All...</a></li>
             </ul>
             <div class="view-profile">
               <p>Speak directly to Attorney Lawrence 
Diamond regarding your car accident 
case. Get help now!</p>
              <a class="con-icon" href="#">Contact Us</a>
              <a class="view-arrow" href="#">View Profile</a>
             </div>
          </div>
        </div>
      </div>
      <div class="result-box">
        <div class="result-box-title">
          <h2>Daniel Weintraub <span>Client Rating 5.0 / 5.0<?php echo image_tag('legalgrip/five-star.png')?></span></h2>
          <div class="result-box-in">
            <?php echo image_tag('legalgrip/in-client-4.png');?>

             <p>Doenier Family Medicine
1111 Delafield St Ste 321
Waukesha, WI 53188</p>
             <ul>
               <li><a href="#">Federal Criminal Law</a></li>
               <li><a href="#">Criminal Law</a></li>
               <li><a href="#">Divorce Law</a></li>
               <li><a href="#">Commercial Law</a></li>
               <li><a href="#">View All...</a></li>
             </ul>
             <div class="view-profile">
               <p>Speak directly to Attorney Lawrence 
Diamond regarding your car accident 
case. Get help now!</p>
              <a class="con-icon" href="#">Contact Us</a>
              <a class="view-arrow" href="#">View Profile</a>
             </div>
          </div>
        </div>
      </div>
      <div class="result-box">
        <div class="result-box-title">
          <h2>Daniel Weintraub <span>Client Rating 5.0 / 5.0<?php echo image_tag('legalgrip/five-star.png')?></span></h2>
          <div class="result-box-in">
             <?php echo image_tag('legalgrip/in-client-5.png');?>
             <p>Doenier Family Medicine
1111 Delafield St Ste 321
Waukesha, WI 53188</p>
             <ul>
               <li><a href="#">Federal Criminal Law</a></li>
               <li><a href="#">Criminal Law</a></li>
               <li><a href="#">Divorce Law</a></li>
               <li><a href="#">Commercial Law</a></li>
               <li><a href="#">View All...</a></li>
             </ul>
             <div class="view-profile">
               <p>Speak directly to Attorney Lawrence 
Diamond regarding your car accident 
case. Get help now!</p>
              <a class="con-icon" href="#">Contact Us</a>
              <a class="view-arrow" href="#">View Profile</a>
             </div>
          </div>
        </div>
      </div>
      <div class="result-box">
        <div class="result-box-title">
          <h2>Daniel Weintraub <span>Client Rating 5.0 / 5.0<?php echo image_tag('legalgrip/five-star.png')?></span></h2>
          <div class="result-box-in">
            <?php echo image_tag('legalgrip/in-client-6.png');?>
             <p>Doenier Family Medicine
1111 Delafield St Ste 321
Waukesha, WI 53188</p>
             <ul>
               <li><a href="#">Federal Criminal Law</a></li>
               <li><a href="#">Criminal Law</a></li>
               <li><a href="#">Divorce Law</a></li>
               <li><a href="#">Commercial Law</a></li>
               <li><a href="#">View All...</a></li>
             </ul>
             <div class="view-profile">
               <p>Speak directly to Attorney Lawrence 
Diamond regarding your car accident 
case. Get help now!</p>
              <a class="con-icon" href="#">Contact Us</a>
              <a class="view-arrow" href="#">View Profile</a>
             </div>
          </div>
        </div>
      </div>
      <div class="result-box">
        <div class="result-box-title">
          <h2>Daniel Weintraub <span>Client Rating 5.0 / 5.0<?php echo image_tag('legalgrip/five-star.png')?></span></h2>
          <div class="result-box-in">
             <?php echo image_tag('legalgrip/in-client-7.png');?>
             <p>Doenier Family Medicine
1111 Delafield St Ste 321
Waukesha, WI 53188</p>
             <ul>
               <li><a href="#">Federal Criminal Law</a></li>
               <li><a href="#">Criminal Law</a></li>
               <li><a href="#">Divorce Law</a></li>
               <li><a href="#">Commercial Law</a></li>
               <li><a href="#">View All...</a></li>
             </ul>
             <div class="view-profile">
               <p>Speak directly to Attorney Lawrence 
Diamond regarding your car accident 
case. Get help now!</p>
              <a class="con-icon" href="#">Contact Us</a>
              <a class="view-arrow" href="#">View Profile</a>
             </div>
          </div>
        </div>
      </div>
      <div class="result-box">
        <div class="result-box-title">
          <h2>Daniel Weintraub <span>Client Rating 5.0 / 5.0<?php echo image_tag('legalgrip/five-star.png')?></span></h2>
          <div class="result-box-in">
             <?php echo image_tag('legalgrip/in-client-8.png');?>
             <p>Doenier Family Medicine
1111 Delafield St Ste 321
Waukesha, WI 53188</p>
             <ul>
               <li><a href="#">Federal Criminal Law</a></li>
               <li><a href="#">Criminal Law</a></li>
               <li><a href="#">Divorce Law</a></li>
               <li><a href="#">Commercial Law</a></li>
               <li><a href="#">View All...</a></li>
             </ul>
             <div class="view-profile">
               <p>Speak directly to Attorney Lawrence 
Diamond regarding your car accident 
case. Get help now!</p>
              <a class="con-icon" href="#">Contact Us</a>
              <a class="view-arrow" href="#">View Profile</a>
             </div>
          </div>
        </div>
      </div>
      <div class="result-box">
        <div class="result-box-title">
          <h2>Daniel Weintraub <span>Client Rating 5.0 / 5.0<?php echo image_tag('legalgrip/five-star.png')?></span></h2>
          <div class="result-box-in">
             <?php echo image_tag('legalgrip/in-client-9.png');?>
             <p>Doenier Family Medicine
1111 Delafield St Ste 321
Waukesha, WI 53188</p>
             <ul>
               <li><a href="#">Federal Criminal Law</a></li>
               <li><a href="#">Criminal Law</a></li>
               <li><a href="#">Divorce Law</a></li>
               <li><a href="#">Commercial Law</a></li>
               <li><a href="#">View All...</a></li>
             </ul>
             <div class="view-profile">
               <p>Speak directly to Attorney Lawrence 
Diamond regarding your car accident 
case. Get help now!</p>
              <a class="con-icon" href="#">Contact Us</a>
              <a class="view-arrow" href="#">View Profile</a>
             </div>
          </div>
        </div>
      </div>
      <div class="result-box">
        <div class="result-box-title">
          <h2>Daniel Weintraub <span>Client Rating 5.0 / 5.0<?php echo image_tag('legalgrip/five-star.png')?></span></h2>
          <div class="result-box-in">
             <?php echo image_tag('legalgrip/in-client-10.png');?>             
             <p>Doenier Family Medicine
1111 Delafield St Ste 321
Waukesha, WI 53188</p>
             <ul>
               <li><a href="#">Federal Criminal Law</a></li>
               <li><a href="#">Criminal Law</a></li>
               <li><a href="#">Divorce Law</a></li>
               <li><a href="#">Commercial Law</a></li>
               <li><a href="#">View All...</a></li>
             </ul>
             <div class="view-profile">
               <p>Speak directly to Attorney Lawrence 
Diamond regarding your car accident 
case. Get help now!</p>
              <a class="con-icon" href="#">Contact Us</a>
              <a class="view-arrow" href="#">View Profile</a>
             </div>
          </div>
        </div>
      </div>
      
      <?php */ ?>
      
      

    </div>
    <div class="content-right">
      <div class="right-add">
        <?php echo image_tag('legalgrip/right-add.png');?>        
      </div>
      <div class="professionals-box">
        <h2>Top Professionals</h2>
        <div class="right-box">
          <?php echo image_tag('legalgrip/in-client-1.png');?>
          <p>1318 S Main Rd,
Vineland, NJ 08360
           <?php echo image_tag('legalgrip/five-star.png');?>
           </p>
           <div class="right-view">
             <h4>Curt William Cackovic</h4>
             <a href="#">View Profile<?php echo image_tag('legalgrip/view-arrow.png');?></a>
           </div>
        </div>
        <div class="right-box">
          <?php echo image_tag('legalgrip/in-client-2.png');?>
          <p>1318 S Main Rd,
Vineland, NJ 08360
           <?php echo image_tag('legalgrip/five-star.png');?>
           </p>
           <div class="right-view">
             <h4>Curt William Cackovic</h4>
             <a href="#">View Profile<?php echo image_tag('legalgrip/view-arrow.png');?></a>
           </div>
        </div>
        <div class="right-box">
          <?php echo image_tag('legalgrip/in-client-3.png');?>
          <p>1318 S Main Rd,
Vineland, NJ 08360
           <?php echo image_tag('legalgrip/five-star.png');?>
           </p>
           <div class="right-view">
             <h4>Curt William Cackovic</h4>
             <a href="#">View Profile<?php echo image_tag('legalgrip/view-arrow.png');?></a>
           </div>
        </div>
        <div class="right-box">
          <?php echo image_tag('legalgrip/in-client-4.png');?>
          <p>1318 S Main Rd,
Vineland, NJ 08360
           <?php echo image_tag('legalgrip/five-star.png');?>
           </p>
           <div class="right-view">
             <h4>Curt William Cackovic</h4>
             <a href="#">View Profile<?php echo image_tag('legalgrip/view-arrow.png');?></a>
           </div>
        </div>
        <div class="right-box">
          
          <?php echo image_tag('legalgrip/in-client-5.png');?>
          <p>1318 S Main Rd,
Vineland, NJ 08360
           
           <?php echo image_tag('legalgrip/five-star.png');?>
           </p>
           <div class="right-view">
             <h4>Curt William Cackovic</h4>
             <a href="#">View Profile<?php echo image_tag('legalgrip/view-arrow.png');?></a>
           </div>
        </div>
      </div>
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