<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

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
		<form id="WebsitePracticeAreaFrm" name="WebsitePracticeAreaFrm" action="<?php echo url_for('website/'.($form->getObject()->isNew() ? 'create' : 'practiceAreaUpdate').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
		<?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
		<input type="hidden" value="" name="WebsitePracticeArea[Newslug]" id="WebsitePracticeArea_NewSlug" />
		<input type="hidden" value="<?php echo $customerId; ?>" name="customerId">
			<table width="100%" cellspacing="1" cellpadding="1" align="center" class="PracticeAreaForm">
				<tr>
					<td width="26%" class="fldrowbg"><b><?php echo $form['Title']->renderLabel() ?> :</b> <span class="error">*</span></td>
					<td width="68%" class="fldrowlightbg">
					<?php if($form->getObject()->isNew()) { 
					        echo $form['Title']->render(array('onblur'=>'getSlugUrl()')) ;
                    } else {
                            echo $form['Title']->render();
                    }
                    ?>

					<?php if ($form['Title']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['Title']->getError()?></div>
					<?php endif; ?>					</td>
				</tr>
				
				
                <tr style="display:none;" id="makeurl">
                  <td width="26%" class="fldrowbg"><b>Page URL:</b></td>
                  <td width="68%" class="fldrowlightbg">
                   <span id="weburl"  style="display:none;"><?php echo 'http://'.$websitedetail[0]['Websiteurl'].'/practice-area/';?></span>

                   <span id="slugvalue"  style="display:none;"></span>

                   <span id="weburlEdit"  style="display:none;">

                    <input type="text" value="" id="editUrlText" name="editUrlText" style="width:250px;"/>
                    <input type="button" value="Cancel" class="CommonButton" onclick="resetUrl()"/>
                    <input type="button" value="Save" class="CommonButton" onclick="editSlugUrl()"/></span>

                   <span id="weburlslug" style="display:none;"></span>
                   &nbsp;<input type="button" value="Edit" class="CommonButton" id="EditButton" onclick="getEditSlug()"/>                  </td>
                </tr>
				
				<tr>
					<td width="26%" class="fldrowbg"><b><?php echo $form['SubTitle']->renderLabel() ?> :</b> <span class="error">*</span></td>
					<td width="68%" class="fldrowlightbg">
					<?php echo $form['SubTitle']->render() ?>
					<?php if ($form['SubTitle']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['SubTitle']->getError()?></div>
					<?php endif; ?>					</td>
				</tr>
				
				<tr><td colspan="2" valign = "Top" width="26%" class="fldrowbg"><b><?php echo $form['Content']->renderLabel() ?> :</b> <span class="error">*</span></td></tr>
				<tr>
					<!--<td valign = "Top" width="26%" class="fldrowbg"><b><?php //echo $form['Content']->renderLabel() ?> :</b> <span class="error">*</span></td>-->
					<td colspan="2" width="68%" class="fldrowlightbg">
					<?php echo $form['Content']->render() ?>
					<?php if ($form['Content']->hasError()): ?>
							<div class="errormsgs" style="color: #FF0000;font-size: 11px;font-weight: bold;padding: 2px 0 0;"><?php echo $form['Content']->getError()?></div>
					<?php endif; ?>					</td>
				</tr>
				<tr>
					<td width="26%" class="fldrowbg"><b><?php echo $form['MetaTitle']->renderLabel() ?> :</b> <span class="error">*</span></td>
					<td width="68%" class="fldrowlightbg">
					<?php echo $form['MetaTitle']->render() ?>
					<?php if ($form['MetaTitle']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['MetaTitle']->getError()?></div>
					<?php endif; ?>					</td>
				</tr>
				<tr>
					<td width="26%" class="fldrowbg"><b><?php echo $form['MetaKeywords']->renderLabel() ?> :</b> <span class="error">*</span></td>
					<td width="68%" class="fldrowlightbg">
					<?php echo $form['MetaKeywords']->render() ?>
					<?php if ($form['MetaKeywords']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['MetaKeywords']->getError()?></div>
					<?php endif; ?>					</td>
				</tr>
				<tr>
					<td valign="Top" width="26%" class="fldrowbg"><b><?php echo $form['MetaDescription']->renderLabel() ?> :</b> <span class="error">*</span></td>
					<td width="68%" class="fldrowlightbg">
					<?php echo $form['MetaDescription']->render() ?>
					<?php if ($form['MetaDescription']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['MetaDescription']->getError()?></div>
					<?php endif; ?>					</td>
				</tr>
				<tr>
					<td width="26%" class="fldrowbg"><b><?php echo $form['Template']->renderLabel() ?> :</b> <span class="error">*</span></td>
					<td width="68%" class="fldrowlightbg">
					<?php echo $form['Template']->render() ?>
					<?php if ($form['Template']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['Template']->getError()?></div>
					<?php endif; ?>					</td>
				</tr>
				<tr>
					<td width="26%" class="fldrowbg"><b><?php echo $form['Status']->renderLabel() ?> :</b> <span class="error">*</span></td>
					<td width="68%" class="fldrowlightbg">
					<?php echo $form['Status']->render() ?>
					<?php if ($form['Status']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['Status']->getError()?></div>
					<?php endif; ?>					</td>
				</tr>
				<tr class="fldbg">
					<td height="33" align="center" class="fldrowbg error">&nbsp;</td>
					<td class="fldrowbg" colspan="2" align="left">
					<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?>    
							<?php echo $form->renderHiddenFields(false) ?>						</td>
				</tr>
			</table>
	  </form>
	</td>
</tr>


<?php if(isset($displaySlugValue) && !empty($displaySlugValue))  { ?>

<script language="javascript" type="text/javascript">
var newSlugval = '<?php echo $displaySlugValue ; ?>'

$('#WebsitePracticeArea_NewSlug').val(newSlugval); // Store Generated Slug Value in Hidden variable to post
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
    var title = trim($('#WebsitePracticeArea_Title').val());
    if(title != '')
    {
        $.ajax({
        'dataType': 'html',
        'type': 'POST',
        'url': '<?php echo url_for("WebsitePracticeArea/getPageSlug"); ?>',
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
            $('#WebsitePracticeArea_NewSlug').val(data); // Store Generated Slug Value in Hidden variable to post

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
        'url': '<?php echo url_for("WebsitePracticeArea/getPageSlug"); ?>',
        'data': {title:title,act:'add'},
        beforeSend: function(){

        },
        'success': function(data) {
            //alert(data);

            var siteURL = $('#weburl').html();
            $('#slugvalue').html(data); // Generate Slug will be stored in this div
            $('#WebsitePracticeArea_NewSlug').val(data); // Store Generated Slug Value in Hidden variable to post

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
        'url': '<?php echo url_for("WebsitePracticeArea/getPageSlug"); ?>',
        'data': {title:title,act:'edit',id:id},
        beforeSend: function(){

        },
        'success': function(data) {
            //alert(data);

            var siteURL = $('#weburl').html();
            $('#slugvalue').html(data); // Generate Slug will be stored in this div
            $('#WebsitePracticeArea_NewSlug').val(data); // Store Generated Slug Value in Hidden variable to post

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
	jQuery("#WebsitePracticeAreaFrm").validate({
		errorClass: "errormsgs",
		rules: {
		    "WebsitePracticeArea[Title]": {
				required: true,
				minlength: 3,
				maxlength: 255
			},
			"WebsitePracticeArea[SubTitle]": {
				required: true,
				minlength: 3,
				maxlength: 150
			},
			"WebsitePracticeArea[MetaTitle]": {
				required: true,
				minlength: 3,
				maxlength: 150
			},
			"WebsitePracticeArea[MetaKeywords]": {
				required: true,
				minlength: 3,
				maxlength: 150
			},
			"WebsitePracticeArea[MetaDescription]": {
				required: true,
				minlength: 3,
			},
			"WebsitePracticeArea[Template]": {
				required: true,
			},
			"WebsitePracticeArea[Status]": {
				required: true,
			},
		},
		messages: {
		    "WebsitePracticeArea[Title]": {
		      required: "This field is required.",
		      minlength: "Title must be at least 3 characters long.",
		      maxlength: "Title cannot be longer than 255 characters."
		    },
		    "WebsitePracticeArea[SubTitle]": {
		      required: "This field is required.",
		      minlength: "Sub Title must be at least 3 characters long.",
		      maxlength: "Sub Title cannot be longer than 150 characters."
		    },
		    "WebsitePracticeArea[MetaTitle]": {
		      required: "This field is required.",
		      minlength: "Meta Title must be at least 3 characters long.",
		      maxlength: "Meta Title cannot be longer than 150 characters."
		    },
		    "WebsitePracticeArea[MetaKeywords]": {
		      required: "This field is required.",
		      minlength: "Meta Keywords must be at least 3 characters long.",
		      maxlength: "Meta Keywords cannot be longer than 150 characters."
		    },
		    "WebsitePracticeArea[MetaDescription]": {
		      required: "This field is required.",
		      minlength: "Meta Description must be at least 3 characters long.",
		    },
		    "WebsitePracticeArea[Template]":{
				required: "This field is required.",
		    },
		    "WebsitePracticeArea[Status]":{
				required: "This field is required.",
		    },
		}
	});
});
</script>