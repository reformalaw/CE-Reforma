<script>
(function($){

    $(window).load(function(){
        $("#headersearch_SortBy").selectbox();
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
        
        
        $("#sortby_dropdown > div > ul.sbOptions > li:last a").css('border-bottom','0'); // Remove CSS from Sort by Box
        /*demo fn*/
        /*$("#add-content").click(function(e){
        e.preventDefault();
        $("#content_1 .mCSB_container").append("<p>Lorem ipsum dolor sit amet. Consectetur adipiscing elit. Donec egestas mi turpis. Fusce adipiscing dui eu metus gravida vel facilisis ligula iaculis.</p>");
        $("#content_1").mCustomScrollbar("update");
        });
        $("#remove-content").click(function(e){
        e.preventDefault();
        $("#content_1 .mCSB_container p:last").remove();
        $("#content_1").mCustomScrollbar("update");
        });*/
    });
})(jQuery);
</script>
	
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
    
    
    <form action="<?php #echo url_for('attornies/index') ?>" method="GET"  name="homeSearchForm" id="homeSearchForm" onsubmit="return validateFilter();">  
    
    <input type="hidden" name="headersearch[DefaultState]" value="<?php echo $defaultPagingArr['DefaultState']; ?>" id="homesearch_DefaultState"> 
    <input type="hidden" name="headersearch[Searchby]" value="<?php echo $defaultPagingArr['Searchby']; ?>" id="homesearch_searchby">
    <input type="hidden" name="headersearch[BasicSearch]" value="<?php echo $defaultPagingArr['BasicSearch']; ?>" id="homesearch_BasicSearch">
    <input type="hidden" name="headersearch[ParentPracticeArea]" value="<?php echo $defaultPagingArr['ParentPracticeArea']; ?>" id="homesearch_ParentPracticeArea">
    <input type="hidden" name="headersearch[SubPracticeArea]" value="<?php echo $defaultPagingArr['SubPracticeArea']; ?>" id="homesearch_SubPracticeArea">
    <input type="hidden" name="headersearch[ChildPracticeArea]" value="<?php echo $defaultPagingArr['ChildPracticeArea']; ?>" id="homesearch_ChildPracticeArea">
    <input type="hidden" name="headersearch[SortBy]" value="" id="homesearch_SortBy">
    <input type="hidden" name="stateSlugValueAttorniesPage" value="<?php echo $stateSlugValueAttorniesPage;?>" id="stateSlugValueAttorniesPage">
    <input type="hidden" name="countySlugValueAttorniesPage" value="<?php echo $countySlugValueAttorniesPage;?>" id="countySlugValueAttorniesPage">
    <input type="hidden" name="formmethod" value="post">
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
                    <?php if(!empty($parentCateogries)) { ?> 
                	 <ul>         		    
                	 
                		     <?php /*for($p=0;$p<count($parentCateogries); $p++) {?>
                		         <?php if( $defaultPagingArr['ParentPracticeArea'] ==  $parentCateogries[$p]['Id']) { ?>
                		             <li class="active"><a href="javascript:void(0);"onclick="getSubCategory(<?php echo $parentCateogries[$p]['Id']; ?>,this)"><?php echo $parentCateogries[$p]['Name']?></a></li>        		         
                		         <?php  } else {?> 
                                     <li><a href="javascript:void(0);" onclick="getSubCategory(<?php echo $parentCateogries[$p]['Id']; ?>,this)"><?php echo $parentCateogries[$p]['Name']?></a></li>     		         
                		         <?php } ?>
                              <?php }  */// End of For?> 
                	 
                		     <?php for($p=0;$p<count($parentCateogries); $p++) {?>
                		         <?php if( $defaultPagingArr['ParentPracticeArea'] ===  $parentCateogries[$p]['slug']) { ?>
                		             <li class="active"><a href="javascript:void(0);"onclick="getSubCategory('<?php echo $parentCateogries[$p]["slug"]; ?>',this)"><?php echo $parentCateogries[$p]['Name']?></a></li>        		         
                		         <?php  } else {?> 
                                     <li><a href="javascript:void(0);" onclick="getSubCategory('<?php echo $parentCateogries[$p]["slug"]; ?>',this)"><?php echo $parentCateogries[$p]['Name']?></a></li>     		         
                		         <?php } ?>
                              <?php } // End of For?> 
                    </ul>
                <?php } // End of IF NOT Empty ?>
                </div>
            </div>
            <div class="wrapper" id="wrapper_content_2">
        		<!-- content block -->
      		    <?php if(count($sf_data->getRaw('subCategories')) > 0) { #clsCommon::pr($subCategories); ?> 
         		<div id="content_2" class="content">
         		
            			 <ul>         		    
                 		     <?php /*for($p=0;$p<count($subCategories); $p++) {?>
                 		         <li <?php if($defaultPagingArr['SubPracticeArea'] ==  $subCategories[$p]['Id']) { echo 'class="active"';}?>><a href="javascript:void(0);"  onclick="getChildCategory(<?php echo $subCategories[$p]['Id'] ;?>,this)"><?php echo $subCategories[$p]['Name']?></a></li>
                              <?php }*/ ?> 
                 		     <?php for($p=0;$p<count($subCategories); $p++) {?>
                 		         <li <?php if($defaultPagingArr['SubPracticeArea'] ===  $subCategories[$p]['slug']) { echo 'class="active"';}?>><a href="javascript:void(0);"  onclick="getChildCategory('<?php echo $subCategories[$p]["slug"] ;?>',this)"><?php echo $subCategories[$p]['Name']?></a></li>
                              <?php } ?> 
                        </ul>
                    
        		</div>
        		<?php } ?>
        	</div>
        	
            <div class="wrapper" id="wrapper_content_3">
            <!-- content block -->
   		    <?php if(count($sf_data->getRaw('childCategories')) > 0 ) { ?>             
            	<div id="content_3" class="content">
            			 <ul>         		    
                 		     <?php for($p=0;$p<count($childCategories); $p++) { ?>
                 		         <li <?php if($defaultPagingArr['ChildPracticeArea'] ===  $childCategories[$p]['slug']) { echo 'class="active"';}?>><a href="javascript:void(0);"  onclick="setChildCategoryValue('<?php echo $childCategories[$p]["slug"] ;?>',this)"><?php echo $childCategories[$p]['Name']?></a></li>
                              <?php } ?> 
                        </ul>
                </div>
                <?php } ?>                
            </div>
            
        </div>
        
        
        <div class="practice-areas-search">
            
          <?php if(isset($defaultPagingArr['FreeConsultation']) && $defaultPagingArr['FreeConsultation'] == 1) { ?>
            <input name="headersearch[FreeConsultation]" type="checkbox"  id="headersearch[FreeConsultation]" checked="checked">
          <?php } else {?>
            <input name="headersearch[FreeConsultation]" type="checkbox"  id="headersearch[FreeConsultation]">
          <?php } ?>
          <p>Offer Free Consultation (<?php echo $freeConsultUserCount; ?>)</p>
          <!--<a class="areas-search" href="#">Search</a>-->
          <input type="submit" name="home_search" value="Search" class="areas-search" style="float:right;">

        </div>
        
      </div>
      
      <div class="top-counties">
        <?php echo image_tag('legalgrip/right-add.png');?>
        <!--<h2>Top Counties</h2>
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
        </ul>-->
      </div>
    </div>
    </form>
    
    <div class="content-main">
    <div class="content-left">
      <h1>Results<span>( <?php if($pager->getnbResults() < 2) { echo $pager->getnbResults()." profile found";} else { echo $pager->getnbResults()." profiles found"; }?> )</span></h1>
      
        <?php if($pager->getnbResults() > 0){?>        
          <p class="sort" id="sortby_dropdown"><?php echo $headerSearchForm['SortBy']->renderLabel(); ?>: 
          
          <!--<select name="country_id" id="country_id_4" tabindex="1">
    			<option value="4">Rating</option>
    	  </select>-->
    		<?php echo $headerSearchForm['SortBy']->render(array('onChange' => "sortby(this.value)") ); ?>
          </p>
        <?php } ?>     
        
        
         
      
      <?php if($pager->getnbResults() > 0){?>
            <?php $i = 0; ?>
            <?php foreach ($pager->getResults() as $users) {?>
            
              <div class="result-box <?php echo ($i == 0) ? 'active' : '' ?>">
                <div class="result-box-title">
                  <?php $userslugName = clsCommon::slugify($users->getFirstName().' '.$users->getLastName());?>  
                  <?php $profilePageURL = clsCommon::generateProfilePageURL($users->getId(),$userslugName); ?>
                  <h2>
                    <?php echo link_to($users->getFirstName().' '.$users->getLastName(),$profilePageURL); ?>
                    <span>
							<?php if($users->getAvgRating() > 0): ?>
								Client Rating <?php echo $users->getAvgRating()?> / 5.0 
								<?php $avgRating = $users->getAvgRating(); ?>
								<?php  $startStr = clsCommon::displayRatingOnAttorneyListing($avgRating);
									echo $startStr;  ?>
							<?php else: ?>
								<?php echo sfConfig::get("app_Noreview_Msg"); ?>
							<?php endif; ?>

                    </span>
                  </h2>
                  <div class="result-box-in">
                     <?php $imgArr = clsCommon::userProfileImage($users->getId(), 'large');   ?>
                     <?php #echo image_tag($imgArr['path'], array('title' => $imgArr['title'], 'alt'=> $imgArr['title']));?>
                     <?php echo link_to(image_tag($imgArr['path'], array('alt'=> $imgArr['title'], 'title'=> $imgArr['title']) ),$profilePageURL); ?>
                     <p>
                         <?php  if($users->getUsersUserProfile()->getFirmName() != '') {
                             echo  $users->getUsersUserProfile()->getFirmName();
                         }  ?>
                         <br>
                         <?php  
                         $attroneyAdd = '';
                         /*if($users->getUsersUserProfile()->getAddress1() != '') {
                             $attroneyAdd .= $users->getUsersUserProfile()->getAddress1();
                         }

                         if($users->getUsersUserProfile()->getAddress2() != '') {
                             $attroneyAdd .= '<br>';
                             $attroneyAdd .= $users->getUsersUserProfile()->getAddress2();
                         }*/
                         if($users->getUsersUserProfile()->getCity() != '') {
                             $attroneyAdd .= $users->getUsersUserProfile()->getCity();
                             $attroneyAdd .= '<br>';
                         }
                         if($users->getUsersUserProfile()->getStateId() != '') {
                             $attroneyAdd .= $users->getUsersUserProfile()->getUserProfileStates()->getName();
                         }
                        /* if($users->getUsersUserProfile()->getZip() != '') {
                             $attroneyAdd .= ' '.$users->getUsersUserProfile()->getZip();
                         }
                         if($users->getUsersUserProfile()->getPhone() != '') {
                             $attroneyAdd .= '<br>';
                             $attroneyAdd .= $users->getUsersUserProfile()->getPhone();
                         }*/
                         if(!empty($attroneyAdd) && $attroneyAdd != '')
                         echo $attroneyAdd;
                         else
                         echo 'Address Not Specified';

                           ?>
                     </p>
                     <?php $userPracticeAreas = UsersTable::getUserPracticeArea($users->getId());   
                     #echo count($userPracticeAreas);
                           if(!empty($userPracticeAreas)) { ?>
                            <ul>
                               <?php for($k=0; $k<count($userPracticeAreas) ; $k++) { ?>
                                    <?php if($k == 4 ) break; ?> 
                                    <?php /*<li><a href="<?php echo $userPracticeAreas[$k]['practiceareaid']?>"><?php echo $userPracticeAreas[$k]['practiceareaname']?></a></li> */?>
                                    <li><a><?php echo $userPracticeAreas[$k]['practiceareaname']?></a></li>
                               
                               <?php } // End of For Loop ?>
                               <li><?php echo link_to('View All...', $profilePageURL); ?></li>
                               
                            </ul>                                    
                           <?php } // End of If
                      ?>
                     <div class="view-profile">
                        <p>
                       <?php if($users->getUsersUserProfile()->getSummary() != '') {?>
                            <?php 
                            #http://stackoverflow.com/questions/9849586/strip-tags-function-not-working-for-p-something-p
                            $summary = strip_tags(html_entity_decode(stripslashes(nl2br($users->getUsersUserProfile()->getSummary())),ENT_NOQUOTES,"Utf-8"));
                            if(strlen($summary) > 90) {
                                echo substr($summary,0,90).'...';
                            } else {
                                echo $summary;
                            } ?>
                        <?php } ?>
                        </p>    
                       <a class="con-icon" href="javascript:void(0)"  onclick="openContactForm(<?php echo $users->getId(); ?>)">Contact Us</a>
                      <?php #echo link_to('Contact Us','contact/index?id='.$users->getId(), array('class'=> "con-icon"))?>
                      
                      
                      <?php echo link_to('View Profile',$profilePageURL, array('class' => 'view-arrow')); ?>
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
    $pagestrUrl = '/attornies';
    if(clsCommon::checkStateCookieExist()){
        $pagestrUrl = "/".$sf_request->getParameter('state').'/attornies';
    }
    
    if(isset($defaultPagingArr['ParentPracticeArea']) && !empty($defaultPagingArr['ParentPracticeArea'])) {
        $pagestrUrl .="/".$defaultPagingArr['ParentPracticeArea'];
    }
    if(isset($defaultPagingArr['SubPracticeArea']) && !empty($defaultPagingArr['SubPracticeArea'])) {
        $pagestrUrl .="/".$defaultPagingArr['SubPracticeArea'];
    }
    if(isset($defaultPagingArr['ChildPracticeArea']) && !empty($defaultPagingArr['ChildPracticeArea'])) {
        $pagestrUrl .="/".$defaultPagingArr['ChildPracticeArea'];
    }
    
    #echo $pagestrUrl;
    $varExtra = '';
    
    if(isset($defaultPagingArr['DefaultState']) && !empty($defaultPagingArr['DefaultState'])) {
        $varExtra .="&stateid=".$defaultPagingArr['DefaultState'];
    }
    if(isset($defaultPagingArr['Searchby']) && !empty($defaultPagingArr['Searchby'])) {
        $varExtra .="&searchby=".$defaultPagingArr['Searchby'];
    }
    if(isset($defaultPagingArr['BasicSearch']) && !empty($defaultPagingArr['BasicSearch'])) {
        $varExtra .="&basicsearch=".$defaultPagingArr['BasicSearch'];
    }
    /*if(isset($defaultPagingArr['ParentPracticeArea']) && !empty($defaultPagingArr['ParentPracticeArea'])) {
        $varExtra .="&praentid=".$defaultPagingArr['ParentPracticeArea'];
    }
    if(isset($defaultPagingArr['SubPracticeArea']) && !empty($defaultPagingArr['SubPracticeArea'])) {
        $varExtra .="&subid=".$defaultPagingArr['SubPracticeArea'];
    }
    if(isset($defaultPagingArr['ChildPracticeArea']) && !empty($defaultPagingArr['ChildPracticeArea'])) {
        $varExtra .="&childid=".$defaultPagingArr['ChildPracticeArea'];
    }*/
    if(isset($defaultPagingArr['FreeConsultation']) && !empty($defaultPagingArr['FreeConsultation'])) {
        $varExtra .="&free=".$defaultPagingArr['FreeConsultation'];
    }
    if(isset($defaultPagingArr['SortBy']) && !empty($defaultPagingArr['SortBy'])) {
        $varExtra .="&sortby=".$defaultPagingArr['SortBy'];
    }
    ?>
      
      
    <?php #include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'attornies/index', 'varExtra' => $varExtra));?>
    <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => $pagestrUrl, 'varExtra' => $varExtra));?>
      

    </div>
    <div class="content-right">
      <!--<div class="right-add">
        <?php #echo image_tag('legalgrip/right-add.png');?>        
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

<script language="javascript" type="text/javascript">
function getSubCategory(catId,obj) { // Function to Get Sub Category

    $("#content_1 ul > li").removeClass("active");
    $(obj).closest('li').addClass("active");


    $.ajax( {
        type: "POST",
        url: "<?php echo url_for('default/getsubcategory'); ?>",
        data : { parentId : catId},
        beforeSend: function(){ },
        success: function(output){
            $("#wrapper_content_2").html(output);

            // Set Hidden Values if Search from Practice Areas
            $('#homesearch_searchby').val('practice');
            $('#homesearch_ParentPracticeArea').val(catId);
            $('#homesearch_SubPracticeArea').val(0);
            $('#homesearch_ChildPracticeArea').val(0);
        }
    });

    // Update Child category Drop Down
    $("#wrapper_content_3").html('');
    /*$.ajax( {
        type: "POST",
        url: "<?php echo url_for('default/getchildcategory'); ?>",
        data : { parentId : 0},
        beforeSend: function(){ },
        success: function(output){
            //$("#wrapper_content_3").html(output);
            $("#wrapper_content_3").html('');
        }
    });*/


} // end of Function

function getChildCategory(catId,obj) { // Function to Get Sub Category

    $("#content_2 ul > li").removeClass("active");
    $(obj).closest('li').addClass("active")

    $.ajax( {
        type: "POST",
        url: "<?php echo url_for('default/getchildcategory'); ?>",
        data : { parentId : catId},
        beforeSend: function(){ },
        success: function(output){
            $("#wrapper_content_3").html(output);

            // Set Hidden Values if Search from Practice Areas
            $('#homesearch_searchby').val('practice');
            $('#homesearch_SubPracticeArea').val(catId);
            $('#homesearch_ChildPracticeArea').val(0);
        }
    });

} // end of Function

function setChildCategoryValue(catId,obj){

    $("#content_3 ul > li").removeClass("active");
    $(obj).closest('li').addClass("active")

    // Set Hidden Values if Search from Practice Areas
    $('#homesearch_searchby').val('practice');
    $('#homesearch_ChildPracticeArea').val(catId);
}

function validateFilter() { // Subtmis Home Page
    $('#homesearch_searchby').val('practice');

    var stateId = readStateCookie('LgStateId');
    var countyId = readCookie('LgCountyId');    
    
    var defautaction = '/attornies' ;
    var action = '';
    action = defautaction;
    if($('#homesearch_ParentPracticeArea').val() != 0 ) {
        action = defautaction+'/'+$('#homesearch_ParentPracticeArea').val();
    }
    if($('#homesearch_ParentPracticeArea').val() != 0 && $('#homesearch_SubPracticeArea').val() != 0 ){
        action = defautaction +'/' + $('#homesearch_ParentPracticeArea').val() + '/' + $('#homesearch_SubPracticeArea').val() ;
    }
    
    if($('#homesearch_ParentPracticeArea').val() != 0 && $('#homesearch_SubPracticeArea').val() != 0 &&  $('#homesearch_ChildPracticeArea').val() != 0 ){
        action = defautaction +'/' + $('#homesearch_ParentPracticeArea').val() + '/' + $('#homesearch_SubPracticeArea').val() + '/' +  $('#homesearch_ChildPracticeArea').val();
    }
    
    if(stateId == null) { // IF Cookie not exist then URL without State
        
        document.forms["homeSearchForm"].action = action;
        //alert(document.forms["homeSearchForm"].action);
        document.forms["homeSearchForm"].submit();

    } else { // Set ACtion URL for Submit of Basic Search
       
        /*if(stateId != null && countyId != null) { // IF Both State and  County both in cookie

            var stateSlugValue = $('#stateSlugValueAttorniesPage').val() ; // Get State Slug value stored in Hidden Variable
            var countySlugValue = $('#countySlugValueAttorniesPage').val() ; // Get State Slug value stored in Hidden Variable
            document.forms["homeSearchForm"].action = '/'+stateSlugValue+'/'+countySlugValue+action;
           // alert(document.forms["homeSearchForm"].action); return false;
            document.forms["homeSearchForm"].submit();

        } else { */
            var stateSlugValue = $('#stateSlugValueAttorniesPage').val() ; // Get State Slug value stored in Hidden Variable
            document.forms["homeSearchForm"].action = '/'+stateSlugValue+action;
           // alert(document.forms["homeSearchForm"].action); return false;
            document.forms["homeSearchForm"].submit();
        //}
        
        

    }
    
    
} // End of Function 

function sortby(val) { 
    $('#homesearch_SortBy').val(val);
   // document.forms["homeSearchForm"].submit();
   validateFilter();
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

function readStateCookie(name) { // http://www.daniweb.com/web-development/javascript-dhtml-ajax/threads/260880/read-cookie-set-with-php-in-javascript
    var cookieName = name + "=";
    var cookieArray = document.cookie.split(';');
    for (var i = 0; i < cookieArray.length; i++){
        var cookie = cookieArray[i];
        while (cookie.charAt(0)==' '){
            cookie = cookie.substring(1,cookie.length);
        }
        if (cookie.indexOf(cookieName) == 0){
            return cookie.substring(cookieName.length,cookie.length);
        }
    }
    return null;
}


</script>
