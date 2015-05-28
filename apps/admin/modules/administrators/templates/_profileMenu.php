<?php

$user = Doctrine::getTable('Users')->find(array($sf_user->getAttribute("admin_user_id")));

$moduleName =  $sf_params->get('module');
$actionName =  $sf_params->get('action');

if($moduleName == "administrators")
{
    if($actionName == "networkprofile")
    {
        $activeNetworkprofile = "select";
        $activeContactPage = 'deselect';
        $activeCustomerReview = "deselect";
        $activeContact = "deselect";
        $activeProfile = "deselect";
    }

}
else if ($moduleName == "attorneycontact") {

    $activeNetworkprofile = "deselect";
    $activeContactPage = 'select';
    $activeCustomerReview = "deselect";
    $activeContact = "deselect";
    $activeProfile = "deselect";

}
else if($moduleName == "manageuser")
{
    $activeNetworkprofile = "deselect";
    $activeContactPage = 'deselect';
	$activeCustomerReview = "select";
    $activeContact = "deselect";
    $activeProfile = "deselect";
}
else if($moduleName == "customerstatistic")
{
	if($actionName == "customerContactStatistics")
	{
		$activeNetworkprofile = "deselect";
		$activeContactPage = 'deselect';
		$activeCustomerReview = "deselect";
		$activeContact = "select";
		$activeProfile = "deselect";
	}
	elseif($actionName == "customerProfileStatistics")
	{
		$activeNetworkprofile = "deselect";
		$activeContactPage = 'deselect';
		$activeCustomerReview = "deselect";
		$activeContact = "deselect";
		$activeProfile = "select";
	}
}

else
{
    $activeNetworkprofile = "select";
    $activeContactPage = 'deselect';
    $activeCustomerReview = "deselect";
    $activeContact = "deselect";
    $activeProfile = "deselect";
}


?>


<table width="100%" cellspacing="0" cellpadding="0">

		<tr>
			<td align="left" valign="middle" class="deselect" style="padding:0px; border:none 0px;">&nbsp;</td>
		</tr>

	
	<?php if($user->getNetworkProfileSubscription() == "Yes"): ?>
		<tr>
			<td align="left" valign="middle" class="<?php echo $activeNetworkprofile; ?>">
				<?php echo link_to("Network Profile","administrators/networkprofile"); ?>
			</td>
		</tr>
	<?php endif; ?>
		
	<?php if($user->getNetworkProfileSubscription() == "Yes"): ?>
		<tr>
			<td align="left" valign="middle" class="<?php echo $activeContactPage; ?>">
				<?php echo link_to("Contact Us Page ","attorneycontact/index"); ?>
			</td>
		</tr>
	<?php endif; ?>
	
	
	<?php if($user->getNetworkProfileSubscription() == "Yes"): ?>
		<tr>
			<td align="left" valign="middle" class="<?php echo $activeCustomerReview; ?>">
				<?php echo link_to("Review Rating","manageuser/customerReview"); ?>
			</td>
		</tr>
	<?php endif; ?>
	
	<?php if($user->getNetworkProfileSubscription() == "Yes"): ?>
			<tr>
				<td align="left" valign="middle" class="<?php echo $activeProfile; ?>">
					<?php echo link_to("Profile Visit","customerstatistic/customerProfileStatistics"); ?>
				</td>
			</tr>
		<?php endif; ?>
		
	<?php if($user->getNetworkProfileSubscription() == "Yes"): ?>
		<tr>
			<td align="left" valign="middle" class="<?php echo $activeContact; ?>">
				<?php echo link_to("Contact","customerstatistic/customerContactStatistics"); ?>
			</td>
		</tr>
	<?php endif; ?>

</table>