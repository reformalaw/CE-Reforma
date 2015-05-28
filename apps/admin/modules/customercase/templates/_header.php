<?php

$customerCasesTab = '';$newCasesTab = '';$activityLoggingTab = '';$paymentReport = '';$underPaymentReport = '';

if ($sf_params->get('module') == 'customercase' && $sf_params->get('action') == 'index' )
	$customerCasesTab = 'SelectTab';
elseif( $sf_params->get('module') == 'customercase' && $sf_params->get('action') == 'new' )
	$newCasesTab = 'SelectTab';
// elseif ( $sf_params->get('module') == 'customeractivity' && $sf_params->get('action') == 'index' )
//     $activityLoggingTab = 'SelectTab';
elseif($sf_params->get('module') == 'customerreport' && $sf_params->get('action') == 'paymentReport')
	$paymentReport = 'SelectTab';
elseif($sf_params->get('module') == 'customerreport' && $sf_params->get('action') == 'underPaymentReport')
	$underPaymentReport = 'SelectTab';


?>
<table cellspacing="0" cellpadding="0" class="AdminNavBar usernavbar">
	<tr>
		<td align="center" width="10%" class="<?php echo $customerCasesTab ?>"><?php echo link_to(image_tag("admin/manage-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Manage Cases",'width'=>'45px','height'=>'47px')),'customercase/index')?><p class="imageText" ><?php echo link_to('Manage Cases','customercase/index',array('title'=>'Manage Cases')); ?></p></td>
		<td align="center" width="10%" class="<?php echo $newCasesTab ?>"><?php echo link_to(image_tag("admin/addcase.png", array('border'=>'1','alt'=>'Image','title'=>"Add Case",'width'=>'45px','height'=>'47px')),'customercase/new')?><p class="imageText" ><?php echo link_to('Add Case','customercase/new',array('title'=>'Add Case')); ?></p></td>
		<td align="center" width="10%" class="<?php echo $paymentReport ?>"><?php echo link_to(image_tag("admin/payment_report.png", array('border'=>'1','alt'=>'Image','title'=>"Payment Report",'width'=>'45px','height'=>'47px')),'customerreport/paymentReport')?><p class="imageText" ><?php echo link_to('Payment Report','customerreport/paymentReport',array('title'=>'Payment Report')); ?></p></td>
		<td align="center" width="10%" class="<?php echo $underPaymentReport ?>"><?php echo link_to(image_tag("admin/under_payment.png", array('border'=>'1','alt'=>'Image','title'=>"Under Payment Report",'width'=>'45px','height'=>'47px')),'customerreport/underPaymentReport')?><p class="imageText" ><?php echo link_to('Under Payment Report','customerreport/underPaymentReport',array('title'=>'Under Payment Report')); ?></p></td>
		<!--<td align="center" width="10%" class="<?php //echo $activityLoggingTab ?>"><?php //echo link_to(image_tag("admin/logging.png", array('border'=>'1','alt'=>'Image','title'=>"Activity Logging",'width'=>'45px','height'=>'47px')),'customeractivity/index')?><p class="imageText" ><?php //echo link_to('Activity Logging','customeractivity/index',array('title'=>'Activity Logging')); ?></p></td>-->
        <td align="center" class="blank" width="40%">&nbsp;</td>
	</tr>
</table>