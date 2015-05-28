<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>


	<table width="98%" cellspacing="0" cellpadding="0">
        <tr style="height:25px;">
           <td style="padding-bottom:15px;padding-top:10px;"><span class="noteDisplay"><strong>Note: </strong> Create your own and/or choose from our list common FAQs.</span></td>
        </tr>
        
		<tr>
			<td>
			<form action="<?php echo url_for('faq/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="addGfaqs" name="addGfaqs">  
				<input type="hidden" value="<?php echo $hiddenWebsiteId; ?>" name="hiddenWebsiteId">
				<?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
				
				
				<fieldset>
                    	<!--<legend> Faq Question/Answer Detail </legend>-->
                    	<?php if (!$form->getObject()->isNew()): ?>
							<legend> Edit Personalised FAQ </legend>
                    	<?php else: ?>
							<legend> Add Personalised FAQ </legend>
					<?php endif; ?>
					
					

				<table width="97%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
					
					<?php echo $form['webId']->render(); ?>

					<tr>

						<td width="26%" class="fldrowbg"><b><?php echo $form['Question']->renderLabel() ?>: </b><span class="error">*</span></td>
						<td width="68%" class="fldrowlightbg">
						<?php echo $form['Question']->render() ?>
						<?php if ($form['Question']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['Question']->getError()?></div>
						<?php endif; ?>
						</td>
					</tr>
					<tr>

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

						<td height="33" align="center" class="fldrowbg error">&nbsp;</td>
						<td height="33" class="fldrowbg" colspan="2" align="left">
							<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?>    
							<?php echo $form->renderHiddenFields(false) ?>
						</td>
					</tr>
					<?php endif;?>
				</table>
				</fieldset>
			</form>
		</td>
	</tr>
</table>
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