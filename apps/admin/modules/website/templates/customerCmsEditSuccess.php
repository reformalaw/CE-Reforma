<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<table width="98%" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">
		<!--START TOP USER DETAIL-->
		<?php  include_component('website', 'usersDetail');?>
		<!--END TOP USER DETAIL-->
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="150" align="left" valign="top" class="LeftMenu">
			<!--START VERTICAL MENU-->
			<?php include_partial("websiteMenu"); ?>
			<!--END VERTICAL MENU-->
        </td>
        <td align="center" valign="top" class="CashDetails">
        	<table width="96%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" height="25">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="WebsiteTab"><table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" class="BorderBottom">&nbsp;</td>
        <td width="80" align="center" valign="middle" class="DeSelectTab"><?php echo link_to("Page List","website/customerCms?customerId=".$sf_params->get('customerId')); ?><!--<a href="#">Page List</a>--></td>
        <td width="2" align="center" valign="middle" class="BorderBottom"></td>
        <td width="80" align="center" valign="middle" class="SelectTab">Edit Page</td>
        <td class="BorderBottom">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top" class="WebsiteDetails">
    	<table width="100%" cellspacing="10" cellpadding="0">
           <tr>
                <td align="center" valign="top">
                	<table width="98%" cellspacing="1" cellpadding="1" class="PageListHeading">
                      <tr>
                        <td align="left" valign="middle"><strong>CMS Page Details</strong></td>
                        <td align="right" valign="middle">&nbsp;</td>
                      </tr>
                  </table>
                </td>
           </tr>           
          <tr valign="top">
 <td colspan="2" class="ListAreaPad">
  <table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <?php if ($form->hasGlobalErrors()): ?>
   <?php foreach ($form->getGlobalErrors() as $name => $error): ?>
     <tr>
      <td class="errormss" align="center"><?php echo $name.': '.$error ?></td>
     </tr>
   <?php endforeach; ?>
  <?php endif; ?>
  </table>
 </td>
</tr>
<tr valign="top">
 <td colspan="2" class="ListAreaPad">
  <form id="PersonalCmsFrm" name="PersonalCmsFrm" action="<?php echo url_for('website/customerCmsUpdate?id='.$form->getObject()->getId().'&customerId='.$sf_params->get('customerId')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
  <input type="hidden" value="" name="personalcms[Newslug]" id="personalcms_NewSlug" />
  <table width="98%" cellspacing="1" cellpadding="1" class="CmsEditPage" align="center">
   	<tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Title']->renderLabel() ?>:</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
        <?php if($form->getObject()->isNew()) { 
                echo $form['Title']->render(array('style'=>'width:250px;','onblur'=>'getSlugUrl()'));
        } else {
                echo $form['Title']->render(array('style'=>'width:250px;'));
        }

          ?>
            
       <?php if ($form['Title']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Title']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    <?php if ($cmspage != 'home'): ?>
    <tr style="display:none;" id="makeurl">
      <td width="26%" class="fldrowbg"><b><?php echo $form['Url']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowlightbg">
       <span id="weburl"  style="display:none;"><?php echo 'http://'.$websitedetail[0]['Websiteurl'].'/';?></span>
       
       <span id="slugvalue"  style="display:none;"></span>
       
       
       <span id="weburlEdit"  style="display:none;">
        <?php #echo 'http://'.$websitedetail[0]['Websiteurl'].'/pages/';?>
        <input type="text" value="" id="editUrlText" name="editUrlText" style="width:250px;"/>
        <input type="button" value="Cancel" class="CommonButton" onclick="resetUrl()"/>
        <input type="button" value="Save" class="CommonButton" onclick="editSlugUrl()"/></span>
       
       
       <span id="weburlslug" style="display:none;"></span>
       &nbsp;<input type="button" value="Edit" class="CommonButton" id="EditButton" onclick="getEditSlug()"/>
       
       <?php //echo $form['Url']->render(array('style'=>'width:250px;')) ?>
       <?php /*if ($form['Url']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Url']->getError()?></div>            
       <?php endif;*/ ?>      </td>
    </tr>
    <?php endif; ?>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['SubTitle']->renderLabel() ?>:</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['SubTitle']->render(array('style'=>'width:400px;')) ?>
       <?php if ($form['SubTitle']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['SubTitle']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    <tr>
		<td colspan="2" width="26%" class="fldrowbg" valign="top"><b><?php echo $form['Content']->renderLabel() ?>:</b> <span class="error">*</span></td>
    </tr>
    <tr>
      <!--<td width="26%" class="fldrowbg" valign="top"><b><?php //echo $form['Content']->renderLabel() ?>:</b> <span class="error">*</span></td>-->
      <td colspan="2" width="68%" class="fldrowlightbg">
       <?php echo $form['Content']->render() ?>
       <?php if ($form['Content']->hasError()): ?>            
            <div class="errormsgs" style="color: #FF0000;font-size: 11px;font-weight: bold;padding: 2px 0 0;"><?php echo $form['Content']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['MetaTitle']->renderLabel() ?>:</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['MetaTitle']->render(array('style'=>'width:400px;')) ?>
       <?php if ($form['MetaTitle']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['MetaTitle']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['MetaKeywords']->renderLabel() ?>:</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['MetaKeywords']->render(array('style'=>'width:400px;')) ?>
       <?php if ($form['MetaKeywords']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['MetaKeywords']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg" valign="top"><b><?php echo $form['MetaDescription']->renderLabel() ?>:</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['MetaDescription']->render(array('style'=>'width:400px;')) ?>
       <?php if ($form['MetaDescription']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['MetaDescription']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    <?php if ($cmspage != 'home'): ?>
    <tr>
      <td width="26%" class="fldrowbg" valign="top"><b><?php echo $form['Template']->renderLabel() ?>:</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Template']->render() ?>
       <?php if ($form['Template']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Template']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg" valign="top"><b><?php echo $form['Status']->renderLabel() ?>:</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Status']->render() ?>
       <?php if ($form['Status']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Status']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    <?php endif; ?>
   <tr class="fldbg">
    <td height="33" align="center" class="fldrowbg error">&nbsp;</td>
    <td class="fldrowbg" colspan="2" align="left">
    <?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?>    
              <?php echo $form->renderHiddenFields(false) ?>        </td>
   </tr>
  </table>
  </form>
 </td>
</tr>   
			<tr>
                <td align="left" valign="top" height="1"></td>
           </tr>
        </table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top" height="20">&nbsp;</td>
  </tr>
</table>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
</table>



<!--<tr valign="top">
 <td colspan="2" class="ListAreaPad">
  <table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <?php //if ($form->hasGlobalErrors()): ?>
   <tr>
    <td class="dot2"></td>
   </tr>
   <?php //foreach ($form->getGlobalErrors() as $name => $error): ?>
     <tr>
      <td class="errormss" align="center"><?php //echo $name.': '.$error ?></td>
     </tr>
   <?php //endforeach; ?>
   <tr>
    <td class="dot2"></td>
   </tr>
  <?php //endif; ?>
  </table>
 </td>
</tr>
<tr valign="top">
 <td colspan="2" class="ListAreaPad">
  <form id="PersonalCmsFrm" name="PersonalCmsFrm" action="<?php //echo url_for('website/customerCmsUpdate?id='.$form->getObject()->getId()) ?>" method="post" <?php //$form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <?php //if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php //endif; ?>
  <input type="hidden" value="" name="personalcms[Newslug]" id="personalcms_NewSlug" />
  <table width="95%" cellspacing="1" cellpadding="1" class="brd1" align="center">
   <tr class="fldbg">
    <td colspan="3" class="whttxt">CMS Page Details</td>
   </tr>
     <tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php //echo $form['Title']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
        <?php /*if($form->getObject()->isNew()) { 
                echo $form['Title']->render(array('style'=>'width:250px;','onblur'=>'getSlugUrl()'));
        } else {
                echo $form['Title']->render(array('style'=>'width:250px;'));
        }*/

          ?>
            
       <?php // if ($form['Title']->hasError()): ?>            
            <div class="errormsgs"><?php //echo $form['Title']->getError()?></div>            
       <?php //endif; ?>
      </td>
    </tr>
    
    <tr style="display:none;" id="makeurl">
      <td align="center" class="fldrowbg error"></td>
      <td width="26%" class="fldrowbg"><b><?php //echo $form['Url']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <span id="weburl"  style="display:none;"><?php //echo 'http://'.$websitedetail[0]['Websiteurl'].'/';?></span>
       
       <span id="slugvalue"  style="display:none;"></span>
       
       
       <span id="weburlEdit"  style="display:none;">
        <?php #echo 'http://'.$websitedetail[0]['Websiteurl'].'/pages/';?>
        <input type="text" value="" id="editUrlText" name="editUrlText" style="width:250px;"/>
        <input type="button" value="Cancel" class="CommonButton" onclick="resetUrl()"/>
        <input type="button" value="Save" class="CommonButton" onclick="editSlugUrl()"/></span>
       
       
       <span id="weburlslug" style="display:none;"></span>
       &nbsp;<input type="button" value="Edit" class="CommonButton" id="EditButton" onclick="getEditSlug()"/>
       
       <?php //echo $form['Url']->render(array('style'=>'width:250px;')) ?>
       <?php /*if ($form['Url']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Url']->getError()?></div>            
       <?php endif;*/ ?>
      </td>
    </tr>
    <tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php //echo $form['SubTitle']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php //echo $form['SubTitle']->render(array('style'=>'width:400px;')) ?>
       <?php //if ($form['SubTitle']->hasError()): ?>            
            <div class="errormsgs"><?php //echo $form['SubTitle']->getError()?></div>            
       <?php //endif; ?>
      </td>
    </tr>
    <tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php //echo $form['MetaTitle']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php //echo $form['MetaTitle']->render(array('style'=>'width:400px;')) ?>
       <?php //if ($form['MetaTitle']->hasError()): ?>            
            <div class="errormsgs"><?php //echo $form['MetaTitle']->getError()?></div>            
       <?php //endif; ?>
      </td>
    </tr>
    <tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php //echo $form['MetaKeywords']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php //echo $form['MetaKeywords']->render(array('style'=>'width:400px;')) ?>
       <?php //if ($form['MetaKeywords']->hasError()): ?>            
            <div class="errormsgs"><?php //echo $form['MetaKeywords']->getError()?></div>            
       <?php //endif; ?>
      </td>
    </tr>
    <tr>
      <td align="center" class="fldrowbg error" valign="top">*</td>
      <td width="26%" class="fldrowbg" valign="top"><b><?php //echo $form['MetaDescription']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php //echo $form['MetaDescription']->render(array('style'=>'width:400px;')) ?>
       <?php //if ($form['MetaDescription']->hasError()): ?>            
            <div class="errormsgs"><?php //echo $form['MetaDescription']->getError()?></div>            
       <?php //endif; ?>
      </td>
    </tr>
    <tr>
      <td align="center" class="fldrowbg error" valign="top">*</td>
      <td width="26%" class="fldrowbg" valign="top"><b><?php //echo $form['Content']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php //echo $form['Content']->render() ?>
       <?php //if ($form['Content']->hasError()): ?>            
            <div class="errormsgs" style="color: #FF0000;font-size: 11px;font-weight: bold;padding: 2px 0 0;"><?php //echo $form['Content']->getError()?></div>            
       <?php //endif; ?>
      </td>
    </tr>
    <tr>
      <td align="center" class="fldrowbg error" valign="top">*</td>
      <td width="26%" class="fldrowbg" valign="top"><b><?php //echo $form['Template']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php //echo $form['Template']->render() ?>
       <?php //if ($form['Template']->hasError()): ?>            
            <div class="errormsgs"><?php //echo $form['Template']->getError()?></div>            
       <?php //endif; ?>
      </td>
    </tr>
    <tr>
      <td align="center" class="fldrowbg error" valign="top">*</td>
      <td width="26%" class="fldrowbg" valign="top"><b><?php //echo $form['Status']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php //echo $form['Status']->render() ?>
       <?php //if ($form['Status']->hasError()): ?>            
            <div class="errormsgs"><?php //echo $form['Status']->getError()?></div>            
       <?php //endif; ?>
      </td>
    </tr>
   <tr class="fldrowbg">
    <td height="33" align="center" class="fldrowbg error">&nbsp;</td>
    <td class="fldrowbg" colspan="2" align="center">
    <?php //echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?>    
              <?php //echo $form->renderHiddenFields(false) ?>
        </td>
   </tr>
  </table>
  </form>
 </td>
</tr>
-->


<?php if(isset($displaySlugValue) && !empty($displaySlugValue))  { ?>

<script language="javascript" type="text/javascript">
var newSlugval = '<?php echo $displaySlugValue ; ?>'

$('#personalcms_NewSlug').val(newSlugval); // Store Generated Slug Value in Hidden variable to post
$('#slugvalue').html(newSlugval); // Generate Slug will be stored in this div

var siteURL = $('#weburl').html();
$('#weburlslug').html(siteURL+newSlugval); // Slugable URL will be stored in this div
$('#weburlslug').show(); // Show slugable div
$('#makeurl').show(); // Default Site URL
$('#EditButton').show(); // Show Edit Button
</script>


<?php }  ?>

<script type="text/javascript">
function getSlugUrl()
{
    var title = trim($('#personalcms_Title').val());
    if(title != '')
    {
        $.ajax({
        'dataType': 'html',
        'type': 'POST',
        'url': '<?php echo url_for("personalcms/getPageSlug"); ?>',
        'data': {title:title},
        beforeSend: function(){
            $('#makeurl').hide(); // Hide Default Site URL Row

            $('#weburl').hide(); // Hide Default Site URL

            $('#weburlslug').hide(); // Hide slugable div
            $('#weburlslug').html(''); // Make Div blank

            $('#slugvalue').html(''); // Make Slug Vlue div to blank

            $('#EditButton').hide(); // Hide Edit Button

            $('#weburlEdit').hide(); // Hide Edit Section

            $('#editUrlText').html(''); // Make Text Box to Blank




        },
        'success': function(data) {

            var siteURL = $('#weburl').html();
            $('#slugvalue').html(data); // Generate Slug will be stored in this div
            $('#personalcms_NewSlug').val(data); // Store Generated Slug Value in Hidden variable to post

            $('#weburlslug').html(siteURL+data); // Slugable URL will be stored in this div
            $('#weburlslug').show(); // Show slugable div
            $('#makeurl').show(); // Default Site URL
            $('#EditButton').show(); // Show Edit Button
        }
        });
    }
}

function getEditSlug()
{
    $('#weburlslug').hide(); // Sluggable URL div will be closded

    /*var editSlug = $('#weburlslug').html();
    var tempVal = editSlug.split('/');
    var setTempVal = tempVal[tempVal.length-1]; */


    $('#weburl').show(); // Show Default site URL div
    $('#weburlEdit').show(); //  Show Edit Mode
    $('#editUrlText').val($('#slugvalue').html()); // Write Slug value in text box

    $('#EditButton').hide(); // Hide Edit Button
}

function resetUrl()
{

    $('#weburlEdit').hide(); // Hide Edit Section
    $('#weburl').hide(); // show Sluggable URL
    $('#weburlslug').show(); // show Sluggable URL
    $('#EditButton').show(); // Show Edit Button
}

</script>
<?php if($form->getObject()->isNew()) {  ?>

<script language="javascript" type="text/javascript">
function editSlugUrl()
{
    var title = trim($('#editUrlText').val());
    if(title != '')
    {
        $.ajax({
        'dataType': 'html',
        'type': 'POST',
        'url': '<?php echo url_for("personalcms/getPageSlug"); ?>',
        'data': {title:title,act:'add'},
        beforeSend: function(){

        },
        'success': function(data) {
            //alert(data);

            var siteURL = $('#weburl').html();
            $('#slugvalue').html(data); // Generate Slug will be stored in this div
            $('#personalcms_NewSlug').val(data); // Store Generated Slug Value in Hidden variable to post

            $('#weburlslug').html(siteURL+data); // Slugable URL will be stored in this div


            $('#weburl').hide(); // Hide Default Site URL
            $('#weburlEdit').hide(); // Hide Edit section
            $('#editUrlText').html(''); // Make Text box blank

            $('#weburlslug').show(); // Show slugable div
            $('#EditButton').show(); // Show Edit Button
        }
        });
    }
}


</script>

<?php } else { // This will be called at Edit Time?>

<script language="javascript" type="text/javascript">
function editSlugUrl()
{
    var title = trim($('#editUrlText').val());
    var id = '<?php echo $form->getObject()->getId(); ?>'; 
    if(title != '')
    {
        $.ajax({
        'dataType': 'html',
        'type': 'POST',
        'url': '<?php echo url_for("personalcms/getPageSlug"); ?>',
        'data': {title:title,act:'edit',id:id},
        beforeSend: function(){

        },
        'success': function(data) {
            //alert(data);

            var siteURL = $('#weburl').html();
            $('#slugvalue').html(data); // Generate Slug will be stored in this div
            $('#personalcms_NewSlug').val(data); // Store Generated Slug Value in Hidden variable to post

            $('#weburlslug').html(siteURL+data); // Slugable URL will be stored in this div


            $('#weburl').hide(); // Hide Default Site URL
            $('#weburlEdit').hide(); // Hide Edit section
            $('#editUrlText').html(''); // Make Text box blank

            $('#weburlslug').show(); // Show slugable div
            $('#EditButton').show(); // Show Edit Button
        }
        });
    }
}


</script>


<?php } ?>

<script type="text/javascript">
jQuery().ready(function() {

	// validate form on keyup and submit
	jQuery("#PersonalCmsFrm").validate({
		errorClass: "errormsgs",
		rules: {
		    "personalcms[Title]": {
				required: true,
				minlength: 3,
				maxlength: 255
			},
			 "personalcms[SubTitle]": {
				required: true,
				minlength: 3,
				maxlength: 150
			},
			"personalcms[MetaTitle]": {
				required: true,
				minlength: 3,
				maxlength: 150
			},
			"personalcms[MetaKeywords]": {
				required: true,
				minlength: 3,
				maxlength: 150
			},
			"personalcms[MetaDescription]": {
				required: true,
				minlength: 3,
			},
			"personalcms[Template]": {
				required: true,
			},
			"personalcms[Status]": {
				required: true,
			},

		},
		messages: {
		    "personalcms[Title]": {
		      required: "Please Enter the Title",
		      minlength: "Title must be atleast 3 characters long",
		      maxlength: "Title must be most 255 characters long"
		    },
		    "personalcms[SubTitle]": {
		      required: "Please Enter the Sub Title",
		      minlength: "Sub Title must be atleast 3 characters long",
		      maxlength: "Sub Title must be most 150 characters long"
		    },
		    "personalcms[MetaTitle]": {
		      required: "Please Enter the Meta Title",
		      minlength: "Meta Title must be atleast 3 characters long",
		      maxlength: "Meta Title must be most 150 characters long"
		    },
		    "personalcms[MetaKeywords]": {
		      required: "Please Enter the Meta Keywords",
		      minlength: "Meta Keywords must be atleast 3 characters long",
		      maxlength: "Meta Keywords must be most 150 characters long"
		    },
		    "personalcms[MetaDescription]": {
		      required: "Please Enter the Meta Description",
		      minlength: "Meta Description must be atleast 3 characters long",
		    },
		    "personalcms[Template]": {
		      required: "Please Select Template",
		    },
		    "personalcms[Status]": {
		      required: "Please Select Status",
		    },

		}
	});
});
</script>