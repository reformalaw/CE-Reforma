<?php $webId = $sf_user->getAttribute('personalWebsiteId');?>
<tr valign="top">
	<td colspan="2" class="ListAreaPad">
		<table width="98%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
			<!--<tr class="fldbg">
				<td colspan="3" class="whttxt">Banner detail</td>
			</tr>-->

			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'Banner Name' ?>:</b></td>
				<td width="68%" class="fldrowlightbg">
				<?php echo $form[0]["BannerName"]; ?>
				</td>
			</tr>
			
			<!--<tr>
				<td width="26%" class="fldrowbg"><b><?php //echo 'Image'; ?>:</b></td>
				<td width="68%" class="fldrowbg">
				<?php  //echo $form[0]['Image']; ?>
				</td>
			</tr>-->
			<?php if($form[0]['Image'] != ""): ?>
			<tr>
				<td width="26%" class="fldrowbg" valign="Top" ><b><?php echo 'Image Preview'; ?>:</b></td>
				<td width="68%" class="fldrowlightbg">
				<?php  echo image_tag('../uploads/'.$bannerImagePath.$form[0]['Image'],array('border'=>'0','alt'=>'Image','title'=>$form[0]['Image'],'width'=>'75px','height'=>'75px')) ?>
				</td>
			</tr>
			<?php endif; ?>

			<?php for($i=1;$i<=$totalBannerTitle;$i++): ?>
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'Title'.$i ?>:</b></td>
				<td width="68%" class="fldrowlightbg">
				<?php echo ($form[0]['Title'.$i]) ? $form[0]['Title'.$i] : "---"; ?>
				</td>
			</tr>
			<?php endfor; ?>
			<!--<tr>
				<td width="26%" class="fldrowbg"><b><?php //echo 'Title2' ?>:</b></td>
				<td width="68%" class="fldrowlightbg">
				<?php //echo ($form[0]['Title2']) ? $form[0]['Title2'] : "---"; ?>
				</td>
			</tr>
			<tr>
				<td width="26%" class="fldrowbg"><b><?php //echo 'Title3' ?>:</b></td>
				<td width="68%" class="fldrowlightbg">
				<?php //echo ($form[0]['Title3']) ? $form[0]['Title3'] : "---"; ?>
				</td>
			</tr>-->
			<tr>
				<td width="26%" class="fldrowbg"><b><?php echo 'Status' ?>:</b></td>
				<td width="68%" class="fldrowlightbg">
				<?php echo $form[0]['Status']; ?>
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