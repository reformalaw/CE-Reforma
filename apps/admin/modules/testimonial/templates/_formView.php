	<tr valign="top">
		<td colspan="2" class="ListAreaPad">
				<table width="98%" cellspacing="1" cellpadding="1" class="brd1" align="center">
					<tr class="fldbg">
						<td colspan="3" class="whttxt">Testimonial Detail</td>
					</tr>

					<tr>
						<td width="26%" class="fldrowbg"><b>Client Name:</b></td>
						<td width="68%" class="fldrowbg">
							<?php echo $form->getClientName(); ?>
						</td>
					</tr>
					
					<tr>
						<td width="26%" class="fldrowbg"><b>Company Name:</b></td>
						<td width="68%" class="fldrowbg">
							<?php echo $form->getCompanyName(); ?>
						</td>
					</tr>

					<tr>
						<td valign="top" width="26%" class="fldrowbg"><b>Description:</b></td>
						<td width="68%" class="fldrowbg">
							<?php echo nl2br($form->getDescription()); ?>
						</td>
					</tr>

					</table>
		</td>
	</tr>