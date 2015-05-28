<tr valign="top">
	<td colspan="2" class="ListAreaPad">
		<table width="65%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
			<tr class="fldbg">
				<td colspan="3" class="whttxt">Website menu detail</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'Title'; ?>:</b></td>
				<td width="68%" class="fldrowlightbg">
				<?php  echo $form['Title']; ?>
				</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'Type' ?>:</b></td>
				<td width="68%" class="fldrowlightbg">
				<?php echo $form['Type']; ?>
				</td>
			</tr>
			<?php if($form["CmsPageId"] != 0): ?>
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'CMSpage Title'; ?>:</b></td>
				<td width="68%" class="fldrowlightbg">
				<?php echo $form["WebsiteMenuCMSPages"]["Title"]; ?>
				</td>
			</tr>
			<?php endif; ?>
			
			<?php if($form["ParentId"] != 0 ):?>
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'Parent'; ?>:</b></td>
				<td width="68%" class="fldrowlightbg">
				<?php $asData = Doctrine::getTable('WebsiteMenu')->findById($form["ParentId"]); echo $asData[0]["Title"];?>
				</td>
			</tr>
			<?php endif; ?>
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'WebsiteUrl'; ?>:</b></td>
				<td width="68%" class="fldrowlightbg">
				<?php  echo $form["WebsiteMenuUsersWebsite"]["Websiteurl"]; ?>
				</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'Order'; ?>:</b></td>
				<td width="68%" class="fldrowlightbg">
				<?php echo $form["Ordering"]; ?>
				</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'Created Date'; ?>:</b></td>
				<td width="68%" class="fldrowlightbg">
				<?php echo date(sfConfig::get('app_dateformat'), strtotime($form["CreateDateTime"])); ?>
				</td>
			</tr>
		</table>
	</td>
</tr>