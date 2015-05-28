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
			<form action="<?php echo url_for('siteconfig/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?config_key='.$form->getObject()->getConfigKey() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
			<?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
				<table width="65%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
					<tr class="fldbg">
						<td colspan="2" class="whttxt">Site Configuration Detail</td>
					</tr>
					<tr>
						<!--<td align="center" class="fldrowbg error"></td>-->
						<td width="26%" class="fldrowbg"><b><?php echo "Key" ?>: </b></td>
						<td width="68%" class="fldrowlightbg">
							<strong><?php echo $ssConfigkey; ?></strong>
						</td>
					</tr>
					<tr>
						<!--<td align="center" class="fldrowbg error">*</td>-->
						<td width="26%" class="fldrowbg"><b><?php echo $form['ConfigValue']->renderLabel() ?>: </b><span class="error">*</span></td>
						<td width="68%" class="fldrowlightbg">
							<?php echo $form['ConfigValue']->render() ?>
							<?php if ($form['ConfigValue']->hasError()): ?>            
							<div class="errormsgs"><?php echo $form['ConfigValue']->getError()?></div>            
							<?php endif; ?>
						</td>
					</tr>
					<tr class="fldbg">
						<td height="33" align="center" class="fldrowbg error">&nbsp;</td>
						<td class="fldrowbg" colspan="2" align="center">
							<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?>    
							<?php echo $form->renderHiddenFields(false) ?>
						</td>
					</tr>
				</table>
			</form>
		</td>
	</tr>