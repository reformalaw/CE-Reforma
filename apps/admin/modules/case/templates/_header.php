<?php

$manageCasesTab = '';$activityLoggingTab = '';$customerPaymentHistoryTab = '';$thirdPartyPaymentHistoryTab = '';$globalReportTab = '';

if ($sf_params->get('module') == 'case' && $sf_params->get('action') == 'index' )
	$manageCasesTab = 'SelectTab';
elseif( $sf_params->get('module') == 'case' && $sf_params->get('action') == 'new' )
	$newCasesTab = 'SelectTab';
elseif ( $sf_params->get('module') == 'activity' && $sf_params->get('action') == 'index' )
    $activityLoggingTab = 'SelectTab';
elseif($sf_params->get('module') == 'accounting' && $sf_params->get('action') == 'customerPayReport')
	$customerPaymentHistoryTab = 'SelectTab';
elseif($sf_params->get('module') == 'accounting' && $sf_params->get('action') == 'thirdpartyPayReport')
	$thirdPartyPaymentHistoryTab = 'SelectTab';
elseif($sf_params->get('module') == 'globalreport')
	$globalReportTab = 'SelectTab';

?>
<table cellspacing="0" cellpadding="0" class="AdminNavBar usernavbar">
	<tr>
		<td align="center" width="10%" class="<?php echo $manageCasesTab ?>"><?php echo link_to(image_tag("admin/manage-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Manage Cases",'width'=>'45px','height'=>'47px')),'case/index')?><p class="imageText" ><?php echo link_to('Manage Cases','case/index',array('title'=>'Manage Cases')); ?></p></td>
		<td align="center" width="10%" class="<?php echo $newCasesTab ?>"><?php echo link_to(image_tag("admin/addcase.png", array('border'=>'1','alt'=>'Image','title'=>"Add Case",'width'=>'45px','height'=>'47px')),'case/new')?><p class="imageText" ><?php echo link_to('Add Case','case/new',array('title'=>'Add Case')); ?></p></td>
		<td align="center" width="10%" class="<?php echo $customerPaymentHistoryTab ?>"><?php echo link_to(image_tag("admin/payment-hisry-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Customer Payment History",'width'=>'45px','height'=>'47px')),'accounting/customerPayReport')?><p class="imageText" ><?php echo link_to('Customer Payment History','accounting/customerPayReport',array('title'=>'Customer Payment History')); ?></p></td>
		<td align="center" width="10%" class="<?php echo $thirdPartyPaymentHistoryTab ?>"><?php echo link_to(image_tag("admin/3rd-party-icon.png", array('border'=>'1','alt'=>'Image','title'=>"3rd Party Payment History",'width'=>'45px','height'=>'47px')),'accounting/thirdpartyPayReport')?><p class="imageText" ><?php echo link_to('3rd Party Payment History','accounting/thirdpartyPayReport',array('title'=>'3rd Party Payment History')); ?></p></td>
		<td align="center" width="10%" class="<?php echo $globalReportTab ?>"><?php echo link_to(image_tag("admin/global-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Global Report",'width'=>'45px','height'=>'47px')),'globalreport/unpaidCustomer')?><p class="imageText" ><?php echo link_to('Global Report','globalreport/unpaidCustomer',array('title'=>'Global Report')); ?></p></td>
		<td align="center" width="10%" class="<?php echo $activityLoggingTab ?>"><?php echo link_to(image_tag("admin/logging.png", array('border'=>'1','alt'=>'Image','title'=>"Activity Logging",'width'=>'45px','height'=>'47px')),'activity/index')?><p class="imageText" ><?php echo link_to('Activity Logging','activity/index',array('title'=>'Activity Logging')); ?></p></td>
        <td align="center" class="blank" width="40%">&nbsp;</td>
	</tr>
</table>