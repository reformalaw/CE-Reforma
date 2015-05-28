<!--<script>
	$(function() {
		$('input, textarea').placeholder();
		var html;
		if ($.fn.placeholder.input && $.fn.placeholder.textarea)
		{
			//html = '<strong>Your current browser natively supports <code>placeholder</code> for <code>input</code> and <code>textarea</code> elements.</strong> The plugin won’t run in this case, since it’s not needed. If you want to test the plugin, use an older browser ;)';
		}
		else if ($.fn.placeholder.input)
		{
			//html = '<strong>Your current browser natively supports <code>placeholder</code> for <code>input</code> elements, but not for <code>textarea</code> elements.</strong> The plugin will only do its thang on the <code>textarea</code>s.';
		}
		if (html)
		{
			$('<p class="note">' + html + '</p>').insertAfter('form');
		}
	});
</script>-->

<?php #use_helper('Url') ?>
<?php $hostName = sfContext::getInstance()->getRequest()->getHost(); ?>
<script type="text/javascript">
$(function () {
    $("#headersearch_DefaultState").selectbox();
    $("#headersearch_ParentPracticeArea").selectbox();
    // $("#headersearch_SubPracticeArea").selectbox();
    // $("#headersearch_ChildPracticeArea").selectbox();
});
</script>


<header>
    <div class="legalgrip_professional">
	    <a href="<?php echo $ssSiteUrl; ?>" target='_blank' >
			<?php echo image_tag("legalgrip/legalgrip_professional.png")?>
			<!--<img src="images/legalgrip/legalgrip_professional.png" />-->
		</a>
    </div>
  <div class="page">
    <div class="header-top">
      <div class="header-top-left">
      
    	<?php   
    	#$request  = sfContext::getInstance()->getRequest();
    	#$stateCookie = $request->getCookie('LgStateId');
    	#if(isset($stateCookie) && !empty($stateCookie) && $stateCookie != '')  {
    	if(clsCommon::checkStateCookieExist() && clsCommon::checkCountyCookieExist() ){
           ?>
           
            <p><label>Current Location:</label></p>
            <form name="stateForm" id="stateForm" action="<?php echo url_for('default/clearstate') ?>"  method="GET">
              <span id="state_dropdown_span">
                <?php if(clsCommon::checkCountyCookieExist()){  ?>
                    <?php echo $countiesArr[clsCommon::checkCountyCookieValue()].', '.$statesArr[clsCommon::checkStateCookieValue()]; ?>
                <?php } else { ?>                    
                    <?php echo $statesArr[clsCommon::checkStateCookieValue()]; ?>
                <?php } ?>
                
                </span>
              <input type="submit" value="Clear" name="clear_state" class="search-btn" style="float:none;" title="Click here to change location">

            </form>
        <?php } else if(clsCommon::checkStateCookieExist() && !clsCommon::checkCountyCookieExist()) { ?>

            <p><label>Current Location:</label></p>
            <form name="stateForm" id="stateForm" action="<?php echo url_for('default/changestate') ?>"  method="GET">
              <span style="float:left;margin:0 0 0 5px;padding:5px 10px;">
                <?php if(clsCommon::checkStateCookieValue()){  ?>
                    <?php echo $statesArr[clsCommon::checkStateCookieValue()]; ?> <?php } ?>
                <?php $countyCombo = UserPracticeAreaLocationTable::getStateCounty(clsCommon::checkStateCookieValue()); ?>
                <?php if(!empty($countyCombo)) { echo ','; }?>
                </span>
                
                <?php 
                #clsCommon::pr($countyCombo);
                if(!empty($countyCombo)) {?>
                
                  
                    
                    <span id="county_dropdown">
                        <select id="headersearch_DefaultCounty" name="headersearch[DefaultCounty]" style="border-bottom:0;" onchange="this.form.submit();">
                             <?php  
                             echo '<option value="0">Select County</option>';
                             foreach ($countyCombo as $key => $value){
                                 echo '<option value="'.$key.'">'.$value.'</option>';
                    
                                }?> 
                        </select>
                    </span>
                    
                    <script type="text/javascript">
                        $(function () {
                            $("#headersearch_DefaultCounty").selectbox();
                            $("#county_dropdown > div > ul.sbOptions > li:last a").css('border-bottom','0'); // Remove CSS from Legal Professional Box County Dropdown
                        });
                    
                        
                    </script>                    
                    
                <?php } ?>
                
              <!--<input type="submit" value="Clear" name="clear_state" class="search-btn" style="float:none;" title="Click here to change location">-->
              <?php echo link_to('Clear', 'default/clearstatecookie', array('class'=> 'search-btn','style' => 'padding-bottom:5px;','title'=>"Click here to change location" ))?>
            </form>        

                
             
		<?php } else { ?>
            <p><?php echo $headerSearchForm['DefaultState']->renderLabel();?>:</p>
            <form name="stateForm" id="stateForm" action="<?php echo url_for('default/changestate') ?>"  method="GET" onsubmit="return setLocationCookie();">
    		  <span id="state_dropdown"><?php #echo $headerSearchForm['DefaultState']->render(array("tabindex"=>"1" ,'onChange'=>'setStateCookie(this.value)'));?>
    		  <?php #echo $headerSearchForm['DefaultState']->render(array("tabindex"=>"1" ,'onChange'=>'getStateCounty(this.value)'));?>
    		  <?php echo $headerSearchForm['DefaultState']->render(array("tabindex"=>"1" ,'onChange'=>'this.form.submit()'));?>
    		  </span>
    		  <span id="county_dropdown"><?php #echo $headerSearchForm['DefaultCounty']->render(array("tabindex"=>"2" ,'onChange'=>'setStateCookie(this.value)'));?></span>
    		  <!--<input type="submit" name="set_location" id="set_location" value="Set" class="search-btn">-->
    		</form>
		          
		          
        <?php } ?>
		
		
      </div>
      <input type="hidden" name="stateSlugValue" id="stateSlugValue" value="<?php echo $stateSlugValue ;?>">
      <input type="hidden" name="countySlugValue" id="countySlugValue" value="<?php echo $countySlugValue ;?>">
        

      <div class="header-top-right">
        <div class="search">
            <form method="GET"  name="basicSearchForm" id="basicSearchForm" onsubmit="return submitBasicSearchForm();">
                <?php #echo $headerSearchForm['BasicSearch']->renderLabel();?>
                <?php echo $headerSearchForm['BasicSearch']->render(array("class"=>"input-search","validate"=>"Search Lawyers by Name","placeholder"=>"Search Lawyers by Name"));?> 
                <?php echo image_tag('legalgrip/search-icon.png') ?>
                <input type="submit" value="Search" name="basic_search" class="search-btn">
                <input type="hidden" name="headersearch[Searchby]" value="name">
                <input type="hidden" name="formmethod" value="post">
            </form>
        </div>
        <div>
            <?php #echo link_to('Forums','/forums',array('class'=> 'forms'));?>
        	<?php echo link_to('FAQs','/faq',array('class'=> 'faq'));?>
        	
            
            <?php if($sf_user->isAuthenticated() && $sf_user->hasAttribute('user_user_id') ) {?>
                <!--<span class="username"><?php //echo $sf_user->getAttribute('user_firstname').' '.$sf_user->getAttribute('user_lastname'); ?></span>   commented by jaydip dodiya-->
            	<p> <!--<label>Welcome,</label>-->&nbsp;<?php echo link_to('My Account','registration/myprofile',array('class'=> 'headerlogout'));?>  <span>|</span>  
                <?php echo link_to('Logout','auth/logout',array('class'=> 'headerlogout'));?></p>
            <?php } else {?>
            
			<?php echo link_to('Register','auth/login',array('class'=> 'headerlogin'));?>
            <?php echo link_to('Login','auth/login',array('class'=> 'headerlogin'));?>
            
            <?php } ?>
            
            
            
        </div>
      </div>
    </div>
    
    <div class="logo"><?php echo link_to(image_tag('legalgrip/logo.png'),'default'); ?></div>
    
    <div class="header-legal-part">
        <form action="<?php #echo url_for('attornies/index') ?>" method="GET"  name="legalSearchForm" id="legalSearchForm" onsubmit=" return submitLegalSearchForm();">
            <input type="hidden" name="headersearch[Searchby]" value="practice">
            <input type="hidden" name="formmethod" value="post">
            <h4> <?php echo $headerSearchForm['ParentPracticeArea']->renderLabel();?>:</h4>
            <input type="submit" value="Search" name="legal_search" class="legal-search">
            
            <span id="childPracticeArea"><?php #echo $headerSearchForm['ChildPracticeArea']->render();?></span>
            <span id="subPracticeArea"><?php #echo $headerSearchForm['SubPracticeArea']->render();?></span>
            <?php echo $headerSearchForm['ParentPracticeArea']->render();?>
          </form>  

            <span style="float:right;width:100%;text-align:right;margin-top:5px;">Find Lawyers by Practice Area</span>
          
    </div>
  </div>
</header>
<input type="hidden" name="ids" id="ids" value="1">

 
<script language="javascript">

$(document).ready(function()
{
    $(".sbOptions > li:last a").css('border-bottom','0'); // Remove CSS from Legal Professional Box Parent category
    $("#state_dropdown > div > ul.sbOptions > li:last a").css('border-bottom','0'); // Remove CSS from Legal Professional Box Parent category

    // Get Sub category Based on Selected Parent Category
    $("#headersearch_ParentPracticeArea").change(function() {

        var cid= $(this).val();

        /*if(cid==0){
        $("#subPracticeArea").hide();
        }*/
        $.ajax( {
            type: "POST",
            url: "<?php echo url_for('default/catSelection'); ?>",
            data : { parentId : cid},
            beforeSend: function(){

            },
            success: function(output){
                // $("#headersearch_SubPracticeArea").html(output);

                $("#subPracticeArea").html(output);
                //$("#subPracticeArea").show();

                $("#childPracticeArea").html('');
                //$("#childPracticeArea").html("<select id='headersearch_ChildPracticeArea' name='headersearch[ChildPracticeArea]'><option value='0'>Select</option></select>");
                //$("#headersearch_ChildPracticeArea").selectbox();



            }
        });
    });


    // Get Child Category Based on Selected Sub Category
    /*$("#headersearch_SubPracticeArea").change(function() {

    var cid= $(this).val();

    $.ajax( {
    type: "POST",
    url: "<?php echo url_for('default/subCatSelection'); ?>",
    data : { parentId : cid},
    beforeSend: function(){

    },
    success: function(output){
    $("#childPracticeArea").html(output);
    // $("#headersearch_ChildPracticeArea").html(output);
    }
    });
    }); */
});

function setStateCookie(stateId){ // Function to Set State Name is Cookie
    if(stateId != 0)     {
        document.forms["stateForm"].submit();
    }
}

function setLocationCookie() {
    return true;
    //if($('headersearch_DefaultState').val() == 0 );

}
// Function to Get County based on Selected State
function getStateCounty(stateId){
    //if(stateId != 0)     {
    $.ajax( {
        type: "POST",
        url: "<?php echo url_for('default/getStateCounty'); ?>",
        data : { stateId : stateId},
        beforeSend: function(){

        },
        success: function(output){
            $("#county_dropdown").html(output);
        }
    });

    // } // End of IF

} // End of Function

function submitBasicSearchForm() { // Function to submit by basic Search

    var stateId = readCookie('LgStateId');
    var countyId = readCookie('LgCountyId');
    //alert(stateId+'==='+countyId);


    if(stateId == null) { // IF retunrs null then do nothing
        document.forms["basicSearchForm"].action = "/attornies";
        //alert(document.forms["basicSearchForm"].action);
        document.forms["basicSearchForm"].submit();

    } else { // Set ACtion URL for Submit of Basic Search
        //alert(stateId);

        /*if(stateId != null && countyId != null) { // IF Both State and  County both in cookie
            var stateSlugValue = $('#stateSlugValue').val() ;
            var countySlugValue = $('#countySlugValue').val() ;
            document.forms["basicSearchForm"].action = '/'+stateSlugValue+'/'+countySlugValue+"/attornies";
            //alert(document.forms["basicSearchForm"].action);

            document.forms["basicSearchForm"].submit();

        } else { */ // Only State is in cookie

            var stateSlugValue = $('#stateSlugValue').val() ;
            document.forms["basicSearchForm"].action = '/'+stateSlugValue+"/attornies";
            //alert(document.forms["basicSearchForm"].action);
            document.forms["basicSearchForm"].submit();
        //}

    } // End of Else

} // End of Function


function submitLegalSearchForm() { // Function to submit by basic Search

    jQuery.fn.exists = function(){return this.length>0;}

    var stateId = readCookie('LgStateId');
    var countyId = readCookie('LgCountyId');

    var defautaction = '/attornies' ;
    var action = '';
    action = defautaction;
    if($('#headersearch_ParentPracticeArea').val() != 0 ) {
        action = defautaction+'/'+$('#headersearch_ParentPracticeArea').val();
    }
    if($('#headersearch_ParentPracticeArea').val() != 0 && $('#headersearch_SubPracticeArea').exists() && $('#headersearch_SubPracticeArea').val() != 0 ){
        action = defautaction +'/' + $('#headersearch_ParentPracticeArea').val() + '/' + $('#headersearch_SubPracticeArea').val() ;
    }

    if($('#headersearch_ParentPracticeArea').val() != 0  && $('#headersearch_SubPracticeArea').exists() && $('#headersearch_SubPracticeArea').val() != 0 && $('#headersearch_ChildPracticeArea').exists() &&  $('#headersearch_ChildPracticeArea').val() != 0 ){
        action = defautaction +'/' + $('#headersearch_ParentPracticeArea').val() + '/' + $('#headersearch_SubPracticeArea').val() + '/' +  $('#headersearch_ChildPracticeArea').val();
    }

    if(stateId == null) { // IF Cokkied No exist then do nothing

        document.forms["legalSearchForm"].action = action;
        //alert(document.forms["legalSearchForm"].action); return false;
        document.forms["legalSearchForm"].submit();

    } else { // Set ACtion URL for Submit of Basic Search, cookie is ser
        

        /*if(stateId != null && countyId != null) { // IF Both State and  County both in cookie

            var stateSlugValue = $('#stateSlugValue').val() ;
            var countySlugValue = $('#countySlugValue').val() ;
            document.forms["legalSearchForm"].action = '/'+stateSlugValue+'/'+countySlugValue+action;
            //alert(document.forms["legalSearchForm"].action); return false;
            document.forms["legalSearchForm"].submit();

        } else { */
            var stateSlugValue = $('#stateSlugValue').val() ;
            document.forms["legalSearchForm"].action = '/'+stateSlugValue+action;
            //alert(document.forms["legalSearchForm"].action); return false;
            document.forms["legalSearchForm"].submit();
        //}

    } // End of Else 
 
} // End of Function

/// This function will read cookie and return its value

function readCookie(name) { // http://www.daniweb.com/web-development/javascript-dhtml-ajax/threads/260880/read-cookie-set-with-php-in-javascript
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
