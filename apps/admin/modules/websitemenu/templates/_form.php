<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php if ($sf_user->hasFlash('errCmsMsg')): ?>
	<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
				<td class="errormss" align="center"><?php echo $sf_user->getFlash('errCmsMsg') ?></td>
		</tr>
	</table>
<?php endif; ?>
	
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
	</tr>-->
	<tr valign="top">
		<td colspan="2" class="ListAreaPad">
			<form id="WebsiteMenuFrm" name="WebsiteMenuFrm" action="<?php echo url_for('websitemenu/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
				<?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
				<table width="98%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
					<!--<tr class="fldbg">
						<td colspan="2" class="whttxt">Website menu detail</td>
					</tr>-->
					<tr>
						<td width="26%" class="fldrowbg"><b><?php echo $form['Title']->renderLabel() ?>:</b> <span class="error">*</span></td>
						<td width="68%" class="fldrowlightbg">
						<?php echo $form['Title']->render(array('style'=>'width:350px;')) ?>
						<?php if ($form['Title']->hasError()): ?>
								<div class="errormsgs"><?php echo $form['Title']->getError()?></div>
						<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td width="26%" class="fldrowbg"><b><?php echo $form['Type']->renderLabel() ?>:</b> <span class="error">*</span></td>
						<td width="68%" class="fldrowlightbg">
						<?php echo $form['Type']->render(array('id'=>"AjaxType",'onChange'=>"showHide();",'style'=>'width:362px;')) ?><!--array('onChange'=>"showHide();")-->
						<?php if ($form['Type']->hasError()): ?>
								<div class="errormsgs"><?php echo $form['Type']->getError()?></div>
						<?php endif; ?>
						</td>
					</tr>
					<tr id="cmsPageTr" style="display:none">
						<td width="26%" class="fldrowbg"><b><?php echo $form['CmsPageId']->renderLabel() ?>:</b> <span class="error">*</span></td>
						<td width="68%" class="fldrowlightbg">
						<?php echo $form['CmsPageId']->render(array('style'=>'width:362px;')) ?>
						<?php if ($form['CmsPageId']->hasError()): ?>
								<div class="errormsgs"><?php echo $form['CmsPageId']->getError()?></div>
						<?php endif; ?>
						</td>
					</tr>
					<tr id="practiceAreaTr" style="display:none">
						<td width="26%" class="fldrowbg"><b><?php echo $form['WebsitePracticeAreaId']->renderLabel() ?>:</b> <span class="error">*</span></td>
						<td width="68%" class="fldrowlightbg">
						<?php echo $form['WebsitePracticeAreaId']->render(array('style'=>'width:362px;')) ?>
						<?php if ($form['WebsitePracticeAreaId']->hasError()): ?>
								<div class="errormsgs"><?php echo $form['WebsitePracticeAreaId']->getError()?></div>
						<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td width="26%" class="fldrowbg"><b><?php echo $form['ParentId']->renderLabel() ?>: </b><span class="error">*</span></td>
						<td width="68%" class="fldrowlightbg">
						<?php echo $form['ParentId']->render(array('id'=>"AjaxParent",'style'=>'width:362px;')) ?>
						<?php if ($form['ParentId']->hasError()): ?>
								<div class="errormsgs"><?php echo $form['ParentId']->getError()?></div>
						<?php endif; ?>
						</td>
					</tr>
					<tr class="fldbg">
						<td height="33" align="center" class="fldrowbg error">&nbsp;</td>
						<td class="fldrowbg" colspan="2" align="left">
						<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?>    
								<?php echo $form->renderHiddenFields(false) ?>
							</td>
					</tr>			
				</table>
			</form>
		</td>
	</tr>

<script type="text/javascript">

	/*show hide the <tr> according to Type */
	function showHide()
	{
		var value = $("#AjaxType").val();
		if(value == 2)
		{
			//$("#WebsiteMenu_CmsPageId").attr('disabled', 'disabled');
			$("#cmsPageTr").hide();
			$("#practiceAreaTr").show();
		}
		else if(value == 1)
		{
			//$("#WebsiteMenu_CmsPageId").removeAttr('disabled');
			$("#practiceAreaTr").hide();
			$("#cmsPageTr").show();
			
		}
		/* ajax request function */
		//Typechange();
	}

	/* this function is for first time load */
	$(document).ready(function() {
		
		var value = $("#AjaxType").val();
		if(value == 2)
		{
			//$("#WebsiteMenu_CmsPageId").attr('disabled', 'disabled');
			$("#cmsPageTr").hide();
			$("#practiceAreaTr").show();
		}
		else if(value == 1)
		{
			//$("#WebsiteMenu_CmsPageId").removeAttr('disabled');
			$("#practiceAreaTr").hide();
			$("#cmsPageTr").show();
		}

	});
 
 /* function for the change parent according to type*/
	function Typechange(){

		var ssType= document.getElementById('AjaxType').value;
		var snId = '<?php echo ($form->getObject()->getId() != '' ) ? $form->getObject()->getId() : "" ; ?>'

		$.ajax({
				'dataType': 'html',
				'type': 'POST',
				'url': '<?php echo url_for("websitemenu/setParentValue"); ?>',
				'data': {ssType:ssType,snId:snId},
				'success': function(data) {
					$('#AjaxParent').html(data);
				}
			});
	}
</script>

<script type="text/javascript">
jQuery().ready(function() {

	// validate form on keyup and submit
	jQuery("#WebsiteMenuFrm").validate({
		errorClass: "errormsgs",
		rules: {
		    "WebsiteMenu[Title]": {
				required: true,
				minlength: 3,
				maxlength: 255
			},
			"WebsiteMenu[Type]":{
				required: true,
			},
			"WebsiteMenu[ParentId]":{
				required: true,
			},
			"WebsiteMenu[WebsitePracticeAreaId]":{
				required: function(element) {
								return $("#AjaxType").val() == 2;}
			},
			"WebsiteMenu[CmsPageId]":{
				required: function(element) {
								return $("#AjaxType").val() == 1;}
			}
		},
		messages: {
		    "WebsiteMenu[Title]": {
		      required: "This field is required.",
		      minlength: "Title must be at least 3 characters long.",
		      maxlength: "Title cannot be longer than 255 characters."
		    },
		    "WebsiteMenu[Type]":{
				required: "This field is required.",
		    },
		    "WebsiteMenu[ParentId]":{
				required: "This field is required.",
		    },
		    "WebsiteMenu[WebsitePracticeAreaId]":{
				required: "This field is required.",
		    },
		    "WebsiteMenu[CmsPageId]":{
				required: "This field is required.",
		    }
		}
	});
});
</script>