<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<tr valign="top">
	<td colspan="2" class="ListAreaPad">
		<table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">
		<?php if ($form->hasGlobalErrors()): ?>
			<tr>
				<td class="dot2"></td>
			</tr>
			<?php foreach ($form->getGlobalErrors() as $name => $error): ?>
			<tr>
				<td class="errormss" align="center"><?php echo $name.': '.$error ?></td>
			</tr>
			<?php endforeach; ?>
			<tr>
				<td class="dot2"></td>
			</tr>
			<?php endif; ?>
		</table>
	</td>
</tr>

<tr valign="top">
	<td colspan="2" class="ListAreaPad">
		<form action="<?php echo url_for('Forums/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="categoryFrm" name="categoryFrm">
			<?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
			<!--<table width="65%" cellspacing="1" cellpadding="1" class="EditFAQ CaseEditForm" align="center">-->
			<table width="97%" cellspacing="1" cellpadding="1" class="EditFAQ CaseEditForm" align="center">
				<!--<tr class="fldbg">
					<td colspan="2" class="whttxt">Category Detail</td>
				</tr>-->
				<tr>
					<!--<td align="center" class="fldrowbg error">*</td>-->
					<td width="26%" class="fldrowbg"><b><?php echo $form['Title']->renderLabel() ?>: </b><span class="error">*</span></td>
					<td width="68%" class="fldrowlightbg">
					<?php echo $form['Title']->render() ?>
					<?php if ($form['Title']->hasError()): ?>
					<div class="errormsgs"><?php echo $form['Title']->getError()?></div>
					<?php endif; ?>
					</td>
				</tr>
				<tr>
					<!--<td valign="Top" align="center" class="fldrowbg error">*</td>-->
					<td valign="Top" width="26%" class="fldrowbg"><b><?php echo $form['Description']->renderLabel() ?>: </b><span class="error">*</span></td>
					<td width="68%" class="fldrowlightbg">
					<?php echo $form['Description']->render() ?>
					<?php if ($form['Description']->hasError()): ?>
					<div class="errormsgs"><?php echo $form['Description']->getError()?></div>
					<?php endif; ?>
					</td>
				</tr>
				<tr class="fldbg">
					<td height="33" align="center" class="fldrowbg error">&nbsp;</td>
					<td height="33" class="fldrowbg" colspan="2" align="left">
					<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?>    
					<?php echo $form->renderHiddenFields(false) ?>
					</td>
				</tr>
			</table>
		</form>
	</td>
</tr>
<script type="text/javascript">
jQuery().ready(function() {
    
	// validate form on keyup and submit
	jQuery("#categoryFrm").validate({
		errorClass: "errormsgs",
		rules: {
		    "ForumCategories[Title]": {
				required: true,
				minlength: 3,
				maxlength: 45
			},
			"ForumCategories[Description]": {
				required: true,
				minlength: 3
			}
		},
		messages: {
		    "ForumCategories[Title]": {
		      required: "This field is required.",
		      minlength: "Title must be at least 3 characters long.",
		      maxlength: "Title cannot be longer than 45 characters."
		    },
		    "ForumCategories[Description]": {
		      required: "This field is required.",
		      minlength: "Description must be at least 3 characters long."
		    }
		}
	});
});
</script>