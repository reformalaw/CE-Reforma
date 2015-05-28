<?php 
	$summaryTab 		= 'deselect';
	$documentsTab 	= 'deselect';
	$paymentTab 		= 'deselect';
	$editTab 		= 'deselect';
	$deleteTab 		= 'deselect';

	if ($sf_params->get('module') == 'customercase' && $sf_params->get('action') == 'view')
		$summaryTab = 'select';

	if ($sf_params->get('module') == 'casedocuments' && $sf_params->get('action') == 'index')
		$documentsTab = 'select';

	if ($sf_params->get('module') == 'customercase' && $sf_params->get('action') == 'paymentreceived')
		$paymentTab = 'select';

	if ($sf_params->get('module') == 'customercase' && $sf_params->get('action') == 'changeStatus')
		$deleteTab = 'select';

	if ($sf_params->get('module') == 'customercase' && $sf_params->get('action') == 'edit')
		$editTab = 'select';
?>

	<td width="150" align="left" valign="top" class="LeftMenu"><table width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td align="left" valign="middle" class="deselect" style="padding:0px;">&nbsp;</td>
		</tr>

		<tr>
			<td align="left" valign="middle" class="<?php echo $summaryTab ?>"><?php echo link_to('Summary','customercase/view?id='.$caseObj->getId());?></td>
		</tr>

		<tr>
			<td align="left" valign="middle" class="<?php echo $documentsTab ?>">
				<?php echo link_to("Documents", "casedocuments/index?caseId=".$caseObj->getId().'&bFlag=1'.'&id='.$caseObj->getId()); ?>
			</td>
		</tr>

		<tr>
			<td align="left" valign="middle" class="<?php echo $paymentTab ?>">
				<?php 
				if($caseObj->getStage() != sfConfig::get('app_CaseStage_Submitted')) {
					echo link_to("Payment History",'customercase/paymentreceived?id='.$caseObj->getId());
				} else {?>
					<a href="javascript:void(0)" onclick="alert('This feature will be available once Counsel Edge accepts your case.'); return false;">Payment History</a>                     
				<?php } ?>
			</td>
		</tr>

		<tr>
			<td align="left" valign="middle" class="<?php echo $editTab ?>">
				<?php if($caseObj->getStage() == sfConfig::get('app_CaseStage_Submitted')) { ?>
					<?php echo link_to("Edit",'customercase/edit?id='.$caseObj->getId().'&bFlag=1', array('title' => 'Click here to Edit Case')); ?>
				<?php } else { ?>
					<a href="javascript:void(0)" onclick="alert('This feature will not be available as the case is accepted by Counsel Edge'); return false;" title="Click here to Edit Case">Edit</a>                     
				<?php } ?>
			</td>
		</tr>

		<tr>
			<td align="left" valign="middle" class="<?php echo $deleteTab; ?>">
				<?php if($caseObj->getStage() == sfConfig::get('app_CaseStage_Submitted')) { ?>
					<?php echo link_to("Delete",'customercase/changeStatus?status=Deleted&id='.$caseObj->getId(),array('OnClick'=>"return deleteConfirmation();",'title' => 'Click here to Delete Case')); ?>
				<?php } else { ?>
						<a href="javascript:void(0)" onclick="alert('This feature will not be available as the case is accepted by Counsel Edge'); return false;" title="Click here to Delete Case">Delete</a>                     
				<?php } ?>
			</td>
		</tr>

	</table>
</td>