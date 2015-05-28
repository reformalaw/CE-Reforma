<tr valign="top">
	<td colspan="2" class="ListAreaPad">
		<table width="65%" cellspacing="1" cellpadding="1" class="brd1" align="center">
			<tr class="fldbg">
				<td colspan="3" class="whttxt">Website prectice area detail</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'Title'; ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<?php  echo $form['Title']; ?>
				</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg" valign="Top"><b><?php echo 'Sub Title'; ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<?php  echo  strip_tags(nl2br($form["SubTitle"])); ?>
				</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg" valign="Top"><b><?php echo 'Meta Title'; ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<?php  echo  strip_tags(nl2br($form["MetaTitle"])); ?>
				</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg" valign="Top"><b><?php echo 'Meta Keywords'; ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<?php  echo  strip_tags(nl2br($form["MetaKeywords"])); ?>
				</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg" valign="Top"><b><?php echo 'Meta Description'; ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<?php  echo  strip_tags(nl2br($form["MetaDescription"])); ?>
				</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg" valign="Top"><b><?php echo 'Content'; ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<?php  echo  strip_tags(nl2br($form["Content"])); ?>
				</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg" valign="Top"><b><?php echo 'Template'; ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<?php  echo  strip_tags(nl2br($form["Template"])); ?>
				</td>
			</tr>
			<!--<tr>
				<td width="26%" class="fldrowbg"><b><?php //echo 'Place' ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<?php //echo $form['Type']; ?>
				</td>
			</tr>-->
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'Status'; ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<?php  echo $form["Status"]; ?>
				</td>
			</tr>
			<!--<tr>
				<td width="26%" class="fldrowbg"><b><?php //echo 'Websiteurl'; ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<?php //echo $form["WebsitePracticeAreaUsersWebsite"]["Websiteurl"]; ?>
				</td>
			</tr>-->
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'Created Date'; ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<?php echo date(sfConfig::get('app_dateformat'), strtotime($form["CreateDateTime"])); ?>
				</td>
			</tr>
		</table>
	</td>
</tr>