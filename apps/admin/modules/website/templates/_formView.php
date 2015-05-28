<tr valign="top">
	<td colspan="2" class="ListAreaPad">
		<table width="100%" cellspacing="1" cellpadding="1" align="center">
			<tr class="fldbg">
				<td colspan="3" class="whttxt">Faq Detail</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'Question' ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<?php echo $form->getQuestion(); ?>
				</td>
			</tr>
			<tr>
				<td valign="Top" width="26%" class="fldrowbg"><b><?php echo 'Answer'; ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<?php  echo $form->getAnswer(); ?>
				</td>
			</tr>
		</table>
	</td>
</tr>