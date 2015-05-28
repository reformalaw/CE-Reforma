<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php $helpIconImage =  image_tag('admin/question_icon.png',array('border'=>'1','alt'=>'Image','title'=>'Click To See Help')); ?>
<?php $helpContent = clsCommon::getSystemConfigVars('SITE_URL').'/images/coming-soon.gif';?>
<?php $helpTitle = 'Help for CMS Content';?>
	
<?php include_partial('default/message');?>
<tr valign="top">
 <td colspan="2" class="ListAreaPad">
  <form id="PersonalCmsFrm" name="PersonalCmsFrm" action="<?php echo url_for('personalcms/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
	
	
  <?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
  <input type="hidden" value="" name="personalcms[Newslug]" id="personalcms_NewSlug" />

     <table width="97%" cellspacing="1" cellpadding="1" class="EditFAQ CaseEditForm" align="center">
     <tr class="fldbg">
		<td></td>
		<td align="left">
				<?php if (!$form->getObject()->isNew()): ?>
					<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'simpleSave', 'class' => 'CommonButton', 'value' => 'Save')); ?>
					<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'quit', 'class' => 'CommonButton', 'value' => 'Save And Quit')); ?>
					<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'preview', 'class' => 'CommonButton', 'value' => 'Save And Preview')); ?>
				<?php else: ?>
					<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'simpleSave', 'class' => 'CommonButton', 'value' => 'Save')); ?>
					<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'quit', 'class' => 'CommonButton', 'value' => 'Save And Quit')); ?>
					<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'preview', 'class' => 'CommonButton', 'value' => 'Save And Preview')); ?>
				<?php endif; ?>
		</td>
     </tr>
     <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Title']->renderLabel() ?>:</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg"> 
        <?php if($form->getObject()->isNew()) { 
                echo $form['Title']->render(array('style'=>'width:400px;','onblur'=>'getSlugUrl()')); ?>
        <?php } else {
            echo $form['Title']->render(array('style'=>'width:400px;'));
        } ?>
          <a rel="lightbox" href="<?php echo $helpContent ; ?>"  title="<?php echo $helpTitle ;?>"><?php echo  $helpIconImage; ?></a>

       <?php if ($form['Title']->hasError()): ?>
            <div class="errormsgs"><?php echo $form['Title']->getError()?></div>
       <?php endif; ?>
      </td>
    </tr>
    <?php if ($cmspage != 'home') { ?>
    <tr style="display:none;" id="makeurl">
      <td width="26%" class="fldrowbg"><b><?php echo $form['Url']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldbg">
       <span id="weburl"  style="display:none;"><?php echo 'http://'.$websitedetail[0]['Websiteurl'].'/';?></span>
       <span id="slugvalue"  style="display:none;"></span>
       <span id="weburlEdit"  style="display:none;">

        <input type="text" value="" id="editUrlText" name="editUrlText" style="width:250px;"/>
        <input type="button" value="Cancel" class="CommonButton" onclick="resetUrl()"/>
        <input type="button" value="Save" class="CommonButton" onclick="editSlugUrl()"/></span>

       <span id="weburlslug" style="display:none;"></span>
       &nbsp;<input type="button" value="Edit" class="CommonButton" id="EditButton" onclick="getEditSlug()"/>
       <a rel="lightbox" href="<?php echo $helpContent ; ?>"  title="<?php echo $helpTitle ;?>"><?php echo $helpIconImage; ?></a>


      </td>
    </tr>
    <?php } ?>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['SubTitle']->renderLabel() ?>:</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['SubTitle']->render(array('style'=>'width:400px;')) ?>
       <a rel="lightbox" href="<?php echo $helpContent ; ?>" title="<?php echo $helpTitle ;?>" ><?php echo $helpIconImage; ?></a>
       <?php if ($form['SubTitle']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['SubTitle']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>
    <tr>
		<td colspan="2" width="26%" class="fldrowbg" valign="top"><b><?php echo $form['Content']->renderLabel() ?>:</b> <span class="error">*</span>
		<a rel="lightbox" href="<?php echo $helpContent ; ?>" title="<?php echo $helpTitle ;?>"><?php echo $helpIconImage; ?></a>
		</td>
		
    </tr>
    <tr>

      <td colspan="2" width="68%" class="fldrowlightbg">
       <?php echo $form['Content']->render() ?>
       <?php if ($form['Content']->hasError()): ?>            
            <div class="errormsgs" style="color: #FF0000;font-size: 11px;font-weight: bold;padding: 2px 0 0;"><?php echo $form['Content']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['MetaTitle']->renderLabel() ?>:</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['MetaTitle']->render(array('style'=>'width:400px;')) ?>
       <a rel="lightbox" href="<?php echo $helpContent ; ?>"  title="<?php echo $helpTitle ;?>"><?php echo $helpIconImage; ?></a>
       <?php if ($form['MetaTitle']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['MetaTitle']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['MetaKeywords']->renderLabel() ?>:</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['MetaKeywords']->render(array('style'=>'width:400px;')) ?>
       <a rel="lightbox" href="<?php echo $helpContent ; ?>" title="<?php echo $helpTitle ;?>"><?php echo $helpIconImage; ?></a>
       <?php if ($form['MetaKeywords']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['MetaKeywords']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg" valign="top"><b><?php echo $form['MetaDescription']->renderLabel() ?>:</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['MetaDescription']->render(array('style'=>'width:400px;')) ?>
       <a rel="lightbox" href="<?php echo $helpContent ; ?>" title="<?php echo $helpTitle ;?>"><?php echo $helpIconImage; ?></a>
       <?php if ($form['MetaDescription']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['MetaDescription']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>
    <?php if ($cmspage != 'home') { ?>
    <tr>
      <td width="26%" class="fldrowbg" valign="top"><b><?php echo $form['Template']->renderLabel() ?>:</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Template']->render() ?>
       <a rel="lightbox" href="<?php echo $helpContent ; ?>" title="<?php echo $helpTitle ;?>"><?php echo $helpIconImage; ?></a>
       <?php if ($form['Template']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Template']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg" valign="top"><b><?php echo $form['Status']->renderLabel() ?>:</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Status']->render() ?>
       <a rel="lightbox" href="<?php echo $helpContent ; ?>" title="<?php echo $helpTitle ;?>"><?php echo $helpIconImage; ?></a>
       <?php if ($form['Status']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Status']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>
   <?php }else {  unset($form['Template']); unset($form['Status']); }?>
   <tr class="fldbg">
    <td height="33" align="center" class="fldrowbg error">&nbsp;</td>
    <td class="fldrowbg" colspan="2" align="left">
    
    <?php if (!$form->getObject()->isNew()): ?>
		<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'simpleSave', 'class' => 'CommonButton', 'value' => 'Save')); ?>
		<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'quit', 'class' => 'CommonButton', 'value' => 'Save And Quit')); ?>
		<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'preview', 'class' => 'CommonButton', 'value' => 'Save And Preview')); ?>
    <?php else: ?>
		<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'simpleSave', 'class' => 'CommonButton', 'value' => 'Save')); ?>
		<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'quit', 'class' => 'CommonButton', 'value' => 'Save And Quit')); ?>
		<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'preview', 'class' => 'CommonButton', 'value' => 'Save And Preview')); ?>
	<?php endif; ?>
              <?php echo $form->renderHiddenFields(false) ?>
        </td>
   </tr>
  </table>

  </form>
 </td>

  </tr>

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
            required: "This field is required.",
            minlength: "Title must be at least 3 characters long.",
            maxlength: "Title cannot be longer than 255 characters."
        },
        "personalcms[SubTitle]": {
            required: "This field is required.",
            minlength: "Sub Title must be at least 3 characters long.",
            maxlength: "Sub Title cannot be longer than 150 characters."
        },
        "personalcms[MetaTitle]": {
            required: "This field is required.",
            minlength: "Meta Title must be at least 3 characters long.",
            maxlength: "Meta Title cannot be longer than 150 characters."
        },
        "personalcms[MetaKeywords]": {
            required: "This field is required.",
            minlength: "Meta Keywords must be at least 3 characters long.",
            maxlength: "Meta Keywords cannot be longer than 150 characters."
        },
        "personalcms[MetaDescription]": {
            required: "This field is required.",
            minlength: "Meta Description must be at least 3 characters long.",
        },
        "personalcms[Template]": {
            required: "This field is required.",
        },
        "personalcms[Status]": {
            required: "This field is required.",
        },

        }
    });
});


function openWin()
{
    var id = $("#weburlslug").text();

    //var id = "http://www.mitul-ce.com/customer_dev.php/practice-areas";
    var left1 = (screen.width / 2)-(700/2);
    var top1  = (screen.height / 2) -(500/2);

    window.open(id,'','scrollbars=1,width=700,height=500,Top='+top1+',left='+left1);
    myWindow.focus();

}

</script>
<?php if($sf_params->get('flagPreview') == 1 && $form->getObject()->getId() != ""): 
$objCmsPage = Doctrine::getTable('CMSPages')->find(array($form->getObject()->getId()));
$windowUrl = "http://".$objCmsPage->getCMSPagesUserWebsite()->getWebsiteurl().'/'.$objCmsPage->getSlug();
?>
	<script type="text/javascript">
	var id = '<?php echo $windowUrl; ?>';
	//var id = "http://www.mitul-ce.com/customer_dev.php/practice-areas";
	var left1 = (screen.width / 2)-(700/2);
	var top1  = (screen.height / 2) -(500/2);

	window.open(id,'','scrollbars=1,width=700,height=500,Top='+top1+',left='+left1);
	myWindow.focus();
	</script>
<?php endif; ?>

<?php include_partial('default/ajaxCall'); // AUTO CALL AT EVERY 15 MINUTE  ?>