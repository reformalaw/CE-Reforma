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
		<td colspan="2" class="ListAreaPad" align="center">
			<form id="caseDocumentsFrm" name="caseDocumentsFrm" action="<?php echo url_for('dashboardcase/'.($form->getObject()->isNew() ? 'caseDocumentList?caseId='.$caseId.'&customerId='.$customerId : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
				<?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
					<input type="hidden" value="<?php echo $caseId; ?>" name="caseId">
				<table width="98%" cellspacing="1" cellpadding="1" align="center" class="CaseEditForm">
					<tr>
						<td width="26%" class="fldrowbg" valign="Top"><b><?php echo $form['Document']->renderLabel() ?> :</b> <span class="error">*</span></td>
						<td width="68%" class="fldrowbg">
						<?php echo $form['Document']->render() ?>
						<br>
						<span class="noteDisplay"><strong>NOTE:</strong> Only doc, excel, pdf, jpg, jpeg, gif are allowed </span>
						<?php if ($form['Document']->hasError()): ?>            
							<div class="errormsgs"><?php echo $form['Document']->getError()?></div>
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

	// validate form on keyup and submit
		jQuery("#caseDocumentsFrm").validate({
			errorClass: "errormsgs",
			rules: {
				"CaseDocuments[Document]": {
					required: true,
				},
			},
			messages: {
				"CaseDocuments[Document]":{
					required: "Please upoad a document. ",
				}
			}
		});
	});
</script>