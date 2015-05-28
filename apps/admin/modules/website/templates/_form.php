<table width="98%" cellspacing="0" cellpadding="0">
	<tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><form action="<?php echo url_for('website/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="addGfaqs" name="addGfaqs">  
				<input type="hidden" value="<?php echo $customerId; ?>" name="customerId">
				<?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
<fieldset>
                    	<legend>Faq Question/Answer Detail</legend>
                        <table width="97%" cellspacing="1" cellpadding="1" class="EditFAQ" align="center">
                        	<tr>
                                <td height="5" colspan="2"></td>
                            </tr>
					<tr>
						<td class="fldrowbg" width="15%"><b><?php echo $form['Question']->renderLabel() ?> :</b> <span class="error">*</span></td>
						<td class="fldrowlightbg" width="80%">
						<?php echo $form['Question']->render() ?>
						<?php if ($form['Question']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['Question']->getError()?></div>
						<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td class="fldrowbg" style="vertical-align:top;" ><b><?php echo $form['Answer']->renderLabel() ?> :</b> <span class="error">*</span></td>
						<td class="fldrowlightbg">
							<?php echo $form['Answer']->render() ?>
							<?php if ($form['Answer']->hasError()): ?>            
								<div class="errormsgs"><?php echo $form['Answer']->getError()?></div>            
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
                    <tr>
                                <td height="1" colspan="2"></td>
                            </tr>
				</table>
                  </fieldset>

</form></td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
</table>






<?php /*?>	<tr valign="top">
		<td colspan="2" class="ListAreaPad">
        	
			<form action="<?php echo url_for('website/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="addGfaqs" name="addGfaqs">  
				<input type="hidden" value="<?php echo $customerId; ?>" name="customerId">
				<?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
				<table width="65%" cellspacing="1" cellpadding="1" class="brd1" align="center">
					<tr class="fldbg">
						<td colspan="3" class="whttxt">Faq Question/Answer Detail</td>
					</tr>
					<tr>
						<td width="6%" align="center" class="fldrowbg error">*</td>
						<td width="26%" class="fldrowbg"><b><?php echo $form['Question']->renderLabel() ?>:</b></td>
						<td width="68%" class="fldrowbg">
						<?php echo $form['Question']->render() ?>
						<?php if ($form['Question']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['Question']->getError()?></div>
						<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td width="6%" align="center" class="fldrowbg error" style="vertical-align:top;">*</td>
						<td width="26%" class="fldrowbg" style="vertical-align:top;" ><b><?php echo $form['Answer']->renderLabel() ?>:</b></td>
						<td width="68%" class="fldrowbg">
							<?php echo $form['Answer']->render() ?>
							<?php if ($form['Answer']->hasError()): ?>            
								<div class="errormsgs"><?php echo $form['Answer']->getError()?></div>            
							<?php endif; ?>
						</td>
					</tr>
					<tr class="fldrowbg">
						<td height="33" align="center" class="fldrowbg error">&nbsp;</td>
						<td height="33" align="center" class="fldrowbg error">&nbsp;</td>
						<td class="fldrowbg" colspan="2" align="left">
							<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?>    
							<?php echo $form->renderHiddenFields(false) ?>
						</td>
					</tr>
				</table>
			</form>
		</td>
	</tr><?php */?>

<script type="text/javascript">
jQuery().ready(function() {
    
	// validate form on keyup and submit
	jQuery("#addGfaqs").validate({
		errorClass: "errormsgs",
		rules: {
		    "FAQs[Question]": {
				required: true,
				minlength: 3
			},
		    "FAQs[Answer]": {
				required: true
			}
		},
		messages: {
		    "FAQs[Question]": {
		      required:   "This field is required.",
		      minlength:  "Question must be at least 3 characters long."
		    },
		    "FAQs[Answer]": {
		      required:   "This field is required."
		    }
		}
	});
});
</script>