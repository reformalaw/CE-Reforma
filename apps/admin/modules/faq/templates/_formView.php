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
			<form action="<?php echo url_for('faq/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
				<?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
				<table width="98%" cellspacing="1" cellpadding="1" class="brd1" align="center">
					<tr class="fldbg">
						<td colspan="3" class="whttxt">Faq Question/Answer Detail</td>
					</tr>
					<?php echo $form['webId']->render(); ?>
					</tr>
					<tr>
						<td width="26%" class="fldrowbg"><b><?php echo $form['Question']->renderLabel() ?>:</b></td>
						<td width="68%" class="fldrowbg">
							<?php echo $form['Question']->getValue() ?>
							<?php if ($form['Question']->hasError()): ?>
								<div class="errormsgs"><?php echo $form['Question']->getError()?></div>
							<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td width="26%" class="fldrowbg" style="vertical-align:top;" ><b><?php echo $form['Answer']->renderLabel() ?>:</b></td>
						<td width="68%" class="fldrowbg">
							<?php echo $form['Answer']->getValue() ?>
							<?php if ($form['Answer']->hasError()): ?>
								<div class="errormsgs"><?php echo $form['Answer']->getError()?></div>
							<?php endif; ?>
						</td>
					</tr>
					<?php if($noSubmitButton): ?>
					<tr class="fldrowbg">
						<td height="33" align="center" class="fldrowbg error">&nbsp;</td>
						<td height="33" align="center" class="fldrowbg error">&nbsp;</td>
						<td class="fldrowbg" colspan="2" align="left">
							<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?>    
							<?php echo $form->renderHiddenFields(false) ?>
						</td>
					</tr>
					<?php endif;?>
				</table>
			</form>
		</td>
	</tr>