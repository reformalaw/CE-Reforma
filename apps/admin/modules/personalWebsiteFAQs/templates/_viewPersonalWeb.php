<tr valign="top">
	<td colspan="2" class="ListAreaPad">
		<table width="98%" cellspacing="1" cellpadding="1" class="brd1" align="center">
			<tr class="fldbg">
				<td colspan="3" class="whttxt">Personal website Detail</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'Question' ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<?php echo $form[0]["WebsiteXFAQsFAQs"]["Question"]; ?>
				</td>
			</tr>
			<tr>
				<td valign="top" width="26%" class="fldrowbg"><b><?php echo 'Answer'; ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<?php  echo nl2br($form[0]["WebsiteXFAQsFAQs"]["Answer"]); ?>
				</td>
			</tr>
			<?php if($form[0]["WebsiteXFAQsUsersWebsite"]["Websiteurl"] != ''): ?>
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'Website'; ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<a target="_blank" href="http://<?php echo $form[0]["WebsiteXFAQsUsersWebsite"]["Websiteurl"]; ?>"><?php echo $form[0]["WebsiteXFAQsUsersWebsite"]["Websiteurl"]; ?></a>
				
				</td>
			</tr>
			<?php endif; ?>
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'Status'; ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<?php echo $form[0]["Status"]; ?>
				</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'Created Date'; ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<?php echo date(sfConfig::get('app_dateformat'), strtotime($form[0]["CreateDateTime"])); ?>
				</td>
			</tr>
		</table>
	</td>
</tr>