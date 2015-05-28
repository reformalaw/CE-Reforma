<?php

	$classOverview = array("index");
	$classCmsPage  = array("customerCms","customerCmsEdit","customerCmsDelete");
	$classPraciceArea = array("practiceAreaList","practiceAreaEdit","practiceAreaDelete");
	$classFaq = array("customerFaqsList","deleteCustomerWebsiteGlobal","deleteCustomersFaq");
	if(in_array($sf_params->get('action'), $classOverview))
	{
		$activeOverview = "select";
		$activeCmsPage = "deselect";
		$activePracticeArea = "deselect";
		$activeFaq = "deselect";
	}
	elseif(in_array($sf_params->get('action'), $classCmsPage))
	{
		$activeOverview = "deselect";
		$activeCmsPage = "select";
		$activePracticeArea = "deselect";
		$activeFaq = "deselect";
	}
	elseif(in_array($sf_params->get('action'), $classPraciceArea))
	{
		$activeOverview = "deselect";
		$activeCmsPage = "deselect";
		$activePracticeArea = "select";
		$activeFaq = "deselect";
	}
	elseif(in_array($sf_params->get('action'), $classFaq))
	{
		$activeOverview = "deselect";
		$activeCmsPage = "deselect";
		$activePracticeArea = "deselect";
		$activeFaq = "select";
	}
	
?>
<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left" valign="middle" class="deselect" style="padding:0px; border:none 0px;">&nbsp;</td>
	</tr>

	<tr>
		<td align="left" valign="middle" class="<?php echo $activeOverview; ?>">
			<?php echo link_to("Overview","website/index?customerId=".$sf_params->get('customerId')); ?>
		</td>
	</tr>

	<tr>
		<td align="left" valign="middle" class="<?php echo $activeCmsPage; ?>">
			<?php echo link_to("CMS Pages","website/customerCms?customerId=".$sf_params->get('customerId')); ?>
		</td>
	</tr>

	<tr>
		<td align="left" valign="middle" class="<?php echo $activePracticeArea; ?>">
			<?php echo link_to("Practice Area","website/practiceAreaList?customerId=".$sf_params->get('customerId')); ?>
		</td>
	</tr>

	<tr>
		<td align="left" valign="middle" class="<?php echo $activeFaq; ?>">
			<?php echo link_to("FAQs","website/customerFaqsList?customerId=".$sf_params->get('customerId')); ?>
		</td>
	</tr>
</table>