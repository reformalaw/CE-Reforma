<?php
//echo $sf_params->get('module').' '.$sf_params->get('action');
$overviewTab = '';$caseTab = '';$accountingTab = '';$profileTab = '';$websiteTab = '';$editTab = '';

if ($sf_params->get('module') == 'dashboard' && $sf_params->get('action') == 'edit' )
	$editTab = 'SelectTab';
elseif (($sf_params->get('module') == 'dashboard' && $sf_params->get('action') == 'myprofile') || 
		($sf_params->get('module') == 'dashboard' && $sf_params->get('action') == 'networkprofile') ||
		($sf_params->get('module') == 'manageuser' && $sf_params->get('action') == 'customerReview'))
	{
		$profileTab = 'SelectTab';
    }
elseif($sf_params->get('module') == 'dashboard')
	$overviewTab = 'SelectTab';

$tab = array('dashboardcase','paymenthistory','paymentreceived');
if (in_array($sf_params->get('module'),$tab)) {
    $caseTab = 'SelectTab';
}
if ($sf_params->get('module') == 'dashboardreport') {
    $accountingTab = 'SelectTab';
}

if ($sf_params->get('module') == 'website') {
    $websiteTab = 'SelectTab';
}
?>
<table cellspacing="0" cellpadding="0" class="AdminNavBar usernavbar">
	<tr>
		<!--<td align="center" width="70"><?php #echo image_tag("admin/home-icon.png", array('border'=>'1','alt'=>'Image','title'=>"No-Image",'width'=>'45px','height'=>'47px'))?><p><?php #echo link_to('Home','default/index'); ?></p></td>-->
		<td align="center" width="70" class="<?php echo $overviewTab ?>"><?php echo link_to(image_tag("admin/overview-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Overview",'width'=>'45px','height'=>'47px')),'dashboard/index?customerId='.$customerId)?><p><?php echo link_to('Overview','dashboard/index?customerId='.$customerId,array('title'=>'Overview')); ?></p></td>
		<td align="center" width="70" class="<?php echo $editTab ?>"><?php echo link_to(image_tag("admin/dashboard-profile-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Edit Info",'width'=>'45px','height'=>'47px')),'dashboard/edit?id='.$customerId.'&customerId='.$customerId)?><p><?php echo link_to('Edit Info','dashboard/edit?id='.$customerId.'&customerId='.$customerId,array('title'=>'Edit Info')); ?></p></td>
		<?php if(isset($oUserData)):?>

			<?php //if($oUserData->getStatus() == 'Active'): ?>

				<?php if($oUserData->getBillingSubscription() == "Yes"): ?>
					<td align="center" width="70" class="<?php echo $caseTab ?>"><?php echo  link_to(image_tag("admin/cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Cases",'width'=>'45px','height'=>'47px')), 'dashboardcase/index?customerId='.$customerId);?><p> <?php echo link_to('Cases', 'dashboardcase/index?customerId='.$customerId,array('title'=>'Cases')); ?></p></td>
					<td align="center" width="70" class="<?php echo $accountingTab ?>"><?php echo  link_to(image_tag("admin/accounting-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Accounting",'width'=>'45px','height'=>'47px')),'dashboardreport/index?customerId='.$customerId);?><p><?php echo link_to('Accounting','dashboardreport/index?customerId='.$customerId,array('title'=>'Accounting')); ?></p></td>
				<?php endif; ?>

				<?php if($oUserData->getNetworkProfileSubscription() == "Yes"): ?>
					<td align="center" width="70" class="<?php echo $profileTab ?>"><?php echo  link_to(image_tag("admin/profile-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Profile",'width'=>'45px','height'=>'47px')),'dashboard/myprofile?customerId='.$customerId);?><p><?php echo link_to('Profile','dashboard/myprofile?customerId='.$customerId,array('title'=>'Profile')); ?></p></td>
				<?php endif; ?>

				<?php if(($oUserData->getWebsiteSubscriotion() == "Yes") && ($oUserData->getUsersUsersWebsite()->getId() != '')): ?>
					<td align="center" width="70" class="<?php echo $websiteTab ?>"><?php echo link_to( image_tag("admin/website-icon-new.png", array('border'=>'1','alt'=>'Image','title'=>"Website",'width'=>'45px','height'=>'47px')),'website/index?customerId='.$customerId);?><p><?php echo link_to('Website','website/index?customerId='.$customerId,array('title'=>'Website')); ?></p></td>
				<?php endif; ?>

			<?php //endif; ?>
		<?php endif; ?>

		

        <td align="center" class="blank">&nbsp;</td>
		<td align="center" width="130"><?php echo  link_to(image_tag("admin/back-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Back To Customers",'width'=>'45px','height'=>'47px')),'users/index');?><p><?php echo link_to('Back To Customers','users/index',array('title'=>'Back To Customers')); ?></p></td>
	</tr>
</table>