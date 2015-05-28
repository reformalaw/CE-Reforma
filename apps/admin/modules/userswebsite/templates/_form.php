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
			<form action="<?php echo url_for('userswebsite/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
				<?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
					<table width="65%" cellspacing="1" cellpadding="1" class="brd1" align="center">
						<tr class="fldbg">
							<td colspan="3" class="whttxt">users_website Details</td>
						</tr>
						<tr>
							<td align="center" class="fldrowbg error">*</td>
							<td width="26%" class="fldrowbg"><b><?php echo $form['UserId']->renderLabel() ?>:</b></td>
							<td width="68%" class="fldrowbg">
							<?php echo $form['UserId']->render() ?>
							<?php if ($form['UserId']->hasError()): ?>            
								<div class="errormsgs"><?php echo $form['UserId']->getError()?></div>            
							<?php endif; ?>
							</td>
						</tr>
						<tr>
							<td align="center" class="fldrowbg error">*</td>
							<td width="26%" class="fldrowbg"><b><?php echo $form['ThemeId']->renderLabel() ?>:</b></td>
							<td width="68%" class="fldrowbg">
								<?php echo $form['ThemeId']->render() ?>
								<?php if ($form['ThemeId']->hasError()): ?>            
									<div class="errormsgs"><?php echo $form['ThemeId']->getError()?></div>            
								<?php endif; ?>
							</td>
						</tr>
						<tr>
							<td align="center" class="fldrowbg error">*</td>
							<td width="26%" class="fldrowbg"><b><?php echo $form['Websiteurl']->renderLabel() ?>:</b></td>
							<td width="68%" class="fldrowbg">
							<?php echo $form['Websiteurl']->render() ?>
							<?php if ($form['Websiteurl']->hasError()): ?>            
								<div class="errormsgs"><?php echo $form['Websiteurl']->getError()?></div>            
							<?php endif; ?>
							</td>
						</tr>
						<tr>
							<td align="center" class="fldrowbg error">*</td>
							<td width="26%" class="fldrowbg"><b><?php echo $form['Status']->renderLabel() ?>:</b></td>
							<td width="68%" class="fldrowbg">
							<?php echo $form['Status']->render() ?>
							<?php if ($form['Status']->hasError()): ?>            
								<div class="errormsgs"><?php echo $form['Status']->getError()?></div>            
							<?php endif; ?>
							</td>
						</tr>
						<tr>
							<td align="center" class="fldrowbg error">*</td>
							<td width="26%" class="fldrowbg"><b><?php echo $form['CreateDateTime']->renderLabel() ?>:</b></td>
							<td width="68%" class="fldrowbg">
							<?php echo $form['CreateDateTime']->render() ?>
							<?php if ($form['CreateDateTime']->hasError()): ?>            
								<div class="errormsgs"><?php echo $form['CreateDateTime']->getError()?></div>            
							<?php endif; ?>
						</td>
						</tr>
						<tr>
							<td align="center" class="fldrowbg error">*</td>
							<td width="26%" class="fldrowbg"><b><?php echo $form['UpdateDateTime']->renderLabel() ?>:</b></td>
							<td width="68%" class="fldrowbg">
							<?php echo $form['UpdateDateTime']->render() ?>
							<?php if ($form['UpdateDateTime']->hasError()): ?>            
								<div class="errormsgs"><?php echo $form['UpdateDateTime']->getError()?></div>            
							<?php endif; ?>
							</td>
						</tr>
						<tr class="fldrowbg">
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