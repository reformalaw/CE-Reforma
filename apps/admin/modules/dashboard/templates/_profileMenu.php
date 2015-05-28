<?php

$userId = $sf_params->get("customerId");
$user = Doctrine::getTable('Users')->find(array($userId));

$moduleName =  $sf_params->get('module');
$actionName =  $sf_params->get('action');

	if($moduleName == "dashboard")
	{
		if($actionName == "myprofile")
		{
			$activeMyprofile = "select";
			$activeNetworkprofile = "deselect";
			$activeEditemail = "deselect";
			$activeCustomerReview = "deselect";
		}
		elseif($actionName == "networkprofile")
		{
			$activeMyprofile = "deselect";
			$activeNetworkprofile = "select";
			$activeEditemail = "deselect";
			$activeCustomerReview = "deselect";
		}
	}
	elseif($moduleName == "manageuser")
	{
		if($actionName == "customerReview")
		{
			$activeMyprofile = "deselect";
			$activeNetworkprofile = "deselect";
			$activeEditemail = "deselect";
			$activeCustomerReview = "select";
		}
	}
	else
	{
		$activeMyprofile = "select";
		$activeNetworkprofile = "deselect";
		$activeEditemail = "deselect";
		$activeCustomerReview = "deselect";
	}

	
?>


<table width="100%" cellspacing="0" cellpadding="0">

		<tr>
			<td align="left" valign="middle" class="deselect" style="padding:0px; border:none 0px;">&nbsp;</td>
		</tr>

		<tr>
			<td align="left" valign="middle" class="<?php echo $activeMyprofile; ?>">
				<?php echo link_to("Personal Profile","dashboard/myprofile?customerId=".$userId); ?>
			</td>
		</tr>
	
	<?php if($user->getNetworkProfileSubscription() == "Yes"): ?>
		<tr>
			<td align="left" valign="middle" class="<?php echo $activeNetworkprofile; ?>">
				<?php echo link_to("Network Profile","dashboard/networkprofile?customerId=".$userId); ?>
			</td>
		</tr>
		
		<tr>
			<td align="left" valign="middle" class="<?php echo $activeCustomerReview; ?>">
				<?php echo link_to("Review Rating","manageuser/customerReview?customerId=".$userId); ?>
			</td>
		</tr>
	<?php endif; ?>

</table>