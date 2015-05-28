<?php

$moduleName =  $sf_params->get('module');
$actionName =  $sf_params->get('action');

	if(($moduleName == "staticpages" && $actionName == "index") ||
		($moduleName == "staticpages" && $actionName == "edit" && $sf_params->get('temp') == "CE" ) ||
		($moduleName == "staticpages" && $actionName == "update" && $sf_params->get('temp') == "CE" ) ||
		($moduleName == "staticpages" && $actionName == "new" && $sf_params->get('temp') == "CE" ) ||
		($moduleName == "staticpages" && $actionName == "create" && $sf_params->get('temp') == "CE" )
		)
	{
		$activeCE = "select";
		$activeLG = "deselect";
	}
	elseif($moduleName == "staticpages" && $actionName == "lgList" ||
			($moduleName == "staticpages" && $actionName == "edit" && $sf_params->get('temp') == "LG" ) ||
			($moduleName == "staticpages" && $actionName == "update" && $sf_params->get('temp') == "LG" ) ||
			($moduleName == "staticpages" && $actionName == "new" && $sf_params->get('temp') == "LG" ) ||
			($moduleName == "staticpages" && $actionName == "create" && $sf_params->get('temp') == "LG" )
		)
	{
		$activeCE = "deselect";
		$activeLG = "select";
		
	}
	
	
?>
<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left" valign="middle" class="deselect" style="padding:0px; border:none 0px;">&nbsp;</td>
	</tr>

	<tr>
		<td align="left" valign="middle" class="<?php echo $activeCE; ?>">
			<?php echo link_to("CE Pages","staticpages/index"); ?>
		</td>
	</tr>

	<tr>
		<td align="left" valign="middle" class="<?php echo $activeLG; ?>">
			<?php echo link_to("LG Pages","staticpages/lgList"); ?>
		</td>
	</tr>

</table>