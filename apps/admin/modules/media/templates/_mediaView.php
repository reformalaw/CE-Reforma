<tr valign="top">
	<td colspan="2" class="ListAreaPad">
		<table width="65%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
			<tr class="fldbg">
				<td colspan="2" class="whttxt">Stock Photo Detail</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'Title' ?>:</b></td>
				<td width="68%" class="fldrowlightbg">
				<?php echo $form[0]['Title']; ?>
				</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'ImageName'; ?>:</b></td>
				<td width="68%" class="fldrowlightbg">
				<?php  echo nl2br($form[0]['ImageName']); ?>
				</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg" valign="Top" ><b><?php echo 'Image'; ?>:</b></td>
				<td width="68%" class="fldrowlightbg">
				<?php  echo image_tag('../uploads/Media/'.$form[0]['ImageName'],array('border'=>'0','alt'=>'Image','title'=>$form[0]['ImageName'],'width'=>'75px','height'=>'75px')) ?>
				</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'Created Date'; ?>:</b></td>
				<td width="68%" class="fldrowlightbg">
				<?php echo date(sfConfig::get('app_dateformat'),strtotime($form[0]['CreateDateTime'])); ?>
				</td>
			</tr>
		</table>
	</td>
</tr>