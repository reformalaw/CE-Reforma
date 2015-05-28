
<?php include_partial('default/message'); ?>

<tr valign="top">
	<td colspan="2" class="ListAreaPad">
		<form action="<?php echo url_for('testimonial/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="frmTestimonial" name="frmTestimonial">
			<?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
			<table width="65%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
				<tr class="fldbg">
					<td colspan="2" class="whttxt">Testimonial Details</td>
				</tr>
				<tr>
					<td width="26%" class="fldrowbg"><b><?php echo $form['ClientName']->renderLabel() ?> :</b> <span class="error">*</span></td>
					<td width="68%" class="fldrowlightbg">
						<?php echo $form['ClientName']->render() ?>
						<?php if ($form['ClientName']->hasError()): ?>
						<div class="errormsgs"><?php echo $form['ClientName']->getError()?></div>
						<?php endif; ?>
					</td>
				</tr>

				<tr>
					<td width="26%" class="fldrowbg"><b><?php echo $form['CompanyName']->renderLabel() ?> :</b> <span class="error">*</span></td>
					<td width="68%" class="fldrowlightbg">
						<?php echo $form['CompanyName']->render() ?>
						<?php if ($form['CompanyName']->hasError()): ?>
						<div class="errormsgs"><?php echo $form['CompanyName']->getError()?></div>
						<?php endif; ?>
					</td>
				</tr>

				<tr>
					<td valign="top" width="26%" class="fldrowbg"><b><?php echo $form['Description']->renderLabel() ?> :</b> <span class="error">*</span></td>
					<td width="68%" class="fldrowlightbg">
						<?php echo $form['Description']->render() ?>
						<?php if ($form['Description']->hasError()): ?>
						<div class="errormsgs"><?php echo $form['Description']->getError()?></div>
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

    jQuery("#frmTestimonial").validate({
        errorClass: "errormsgs",
        rules: {
			"Testimonial[ClientName]": {
				required: true,
				maxlength: 150
			},
			"Testimonial[CompanyName]": {
				required: true,
				maxlength: 150
			},
			"Testimonial[Description]": {
				required: true,
				minlength: 3,
				maxlength: 350
			}
        },
        messages: {
			"Testimonial[ClientName]": {
				required:   "This field is required.",
				maxlength:  "Client Name cannot be longer than 150 characters."
			},
			"Testimonial[CompanyName]": {
				required:   "This field is required.",
				maxlength:  "Company Name cannot be longer than 150 characters."
			},
			"Testimonial[Description]": {
				required:   "This field is required.",
				maxlength:  "Description cannot be longer than 350 characters."
			}
        }
    });
});
</script>