<?php

$user = Doctrine::getTable('Users')->find(array($sf_user->getAttribute("admin_user_id")));

$moduleName =  $sf_params->get('module');
$actionName =  $sf_params->get('action');

if($moduleName == "statistics")
{
    if($actionName == "index")
    {
		$activeCounseledge = "select";
		$activeLegalgrip = "deselect";
		$activeCustomerWebsite = "deselect";
		$activeProfileVisit = "deselect";
		$activeContact = "deselect"; 
    }
    elseif($actionName == "ligalgripStatistics")
    {
		$activeCounseledge = "deselect";
		$activeLegalgrip = "select";
		$activeCustomerWebsite = "deselect";
		$activeProfileVisit = "deselect";
		$activeContact = "deselect"; 
    }
    
    elseif($actionName == "websiteStatistics")
    {
		$activeCounseledge = "deselect";
		$activeLegalgrip = "deselect";
		$activeCustomerWebsite = "select";
		$activeProfileVisit = "deselect";
		$activeContact = "deselect"; 
    }
    
    elseif($actionName == "profileStatistics")
    {
		$activeCounseledge = "deselect";
		$activeLegalgrip = "deselect";
		$activeCustomerWebsite = "deselect";
		$activeProfileVisit = "select";
		$activeContact = "deselect"; 
    }
    
    elseif($actionName == "contactStatistics")
    {
		$activeCounseledge = "deselect";
		$activeLegalgrip = "deselect";
		$activeCustomerWebsite = "deselect";
		$activeProfileVisit = "deselect";
		$activeContact = "select"; 
    }

}


?>


<table width="100%" cellspacing="0" cellpadding="0">

		<tr>
			<td align="left" valign="middle" class="deselect" style="padding:0px; border:none 0px;">&nbsp;</td>
		</tr>

		<tr>
			<td align="left" valign="middle" class="<?php echo $activeCounseledge; ?>">
				<?php echo link_to("Counsel Edge","statistics/index"); ?>
			</td>
		</tr>

		<tr>
			<td align="left" valign="middle" class="<?php echo $activeLegalgrip; ?>">
				<?php echo link_to("Legalgrip","statistics/ligalgripStatistics"); ?>
			</td>
		</tr>
		
		<tr>
			<td align="left" valign="middle" class="<?php echo $activeCustomerWebsite; ?>">
				<?php echo link_to("Customer Website","statistics/websiteStatistics"); ?>
			</td>
		</tr>
		
		<tr>
			<td align="left" valign="middle" class="<?php echo $activeProfileVisit; ?>">
				<?php echo link_to("Profile Visit","statistics/profileStatistics"); ?>
			</td>
		</tr>
		
		<tr>
			<td align="left" valign="middle" class="<?php echo $activeContact; ?>">
				<?php echo link_to("Contact","statistics/contactStatistics"); ?>
			</td>
		</tr>
</table>