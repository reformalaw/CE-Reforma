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
			<form action="<?php echo url_for('personalWebsiteFAQs/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="PWAnew" name="PWAnew">  
				<input type="hidden" value="<?php echo $hiddenWebsiteId; ?>" name="hiddenWebsiteId">
				<?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
				<table width="65%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
					<tr class="fldbg">
						<td colspan="2" class="whttxt">Faq Question/Answer Detail</td>
					</tr>
					<?php echo $form['webId']->render(); ?>
					<!--</tr>-->
					<tr>
						<!--<td align="center" class="fldrowbg error">*</td>-->
						<td width="26%" class="fldrowbg"><b><?php echo $form['Question']->renderLabel() ?>: </b><span class="error">*</span></td>
						<td width="68%" class="fldrowlightbg">
						<?php echo $form['Question']->render() ?>
						<?php if ($form['Question']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['Question']->getError()?></div>
						<?php endif; ?>
						</td>
					</tr>
					<tr>
						<!--<td align="center" class="fldrowbg error" style="vertical-align:top;">*</td>-->
						<td width="26%" class="fldrowbg" style="vertical-align:top;" ><b><?php echo $form['Answer']->renderLabel() ?>: </b><span class="error">*</span></td>
						<td width="68%" class="fldrowlightbg">
							<?php echo $form['Answer']->render() ?>
							<?php if ($form['Answer']->hasError()): ?>            
								<div class="errormsgs"><?php echo $form['Answer']->getError()?></div>            
							<?php endif; ?>
						</td>
					</tr>
					<?php if($noSubmitButton): ?>
					<tr class="fldbg">
						<!--<td height="33" align="center" class="fldrowbg error">&nbsp;</td>-->
						<td height="33" align="center" class="fldrowbg error">&nbsp;</td>
						<td height="33" class="fldrowbg" colspan="2" align="left">
							<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?>    
							<?php echo $form->renderHiddenFields(false) ?>
						</td>
					</tr>
					<?php endif;?>
				</table>
			</form>
		</td>
	</tr>
<script type="text/javascript"/">
jQuery().ready(function() {
    
	// validate form on keyup and submit
	jQuery("#PWAnew").validate({
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