<tr valign="top">
	<td colspan="2" class="ListAreaPad">
		<table width="65%" cellspacing="1" cellpadding="1" class="brd1" align="center">
			<tr class="fldbg">
				<td colspan="3" class="whttxt">Users Website Detail</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'Website' ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<?php echo $form['Websiteurl']; ?>
				</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'User Name'; ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<?php  echo $form["UsersWebsiteUsers"]["FirstName"]." ".$form["UsersWebsiteUsers"]["LastName"]; ?>
				</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'Status'; ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<?php echo $form['Status']; ?>
				</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'Created Date'; ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<?php echo date(sfConfig::get('app_dateformat'),strtotime($form['CreateDateTime'])); ?>
				</td>
			</tr>
		</table>
	</td>
</tr>