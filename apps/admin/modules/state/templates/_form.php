<?php include_partial('default/message'); ?>
<tr valign="top">
	<td colspan="2" class="ListAreaPad">
		<form id="frmState" action="<?php echo url_for('state/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
			<?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
				<table width="65%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
					<tr class="fldbg">
						<td colspan="3" class="whttxt">State Details</td>
					</tr>

					<tr>
						<td width="26%" class="fldrowbg"><b><?php echo $form['Name']->renderLabel() ?> :</b> <span class="error">*</span></td>
						<td width="68%" class="fldrowlightbg">
							<?php echo $form['Name']->render() ?>
							<?php if ($form['Name']->hasError()): ?>
								<div class="errormsgs"><?php echo $form['Name']->getError()?></div>
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
jQuery().ready(function() {

	jQuery("#frmState").validate({
		errorClass: "errormsgs",
		rules: {
		    "states[Name]": {
				required: true,
				minlength:2
			}
		},
		messages: {
		    "states[Name]": {
		      required:   "This field is required.",
		      minlength:  "State name must be at least 2 characters long."
		    }
		}
	});
});
</script>