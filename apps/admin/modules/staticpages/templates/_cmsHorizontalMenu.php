<?php

$actionName =  $sf_params->get('action');
$moduleName =  $sf_params->get('module');
?>

<?php if($moduleName == "staticpages"): ?>

		<?php if($actionName == "index"): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="SelectTab">CE Pages List</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Add CE Pages","staticpages/new?temp=CE");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select CE page to edit');" href="javascript:void(0)">Edit CE Page</a></td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>

		<?php elseif(($actionName == "update" && $sf_params->get('temp') == "CE") || ($actionName == "edit" && $sf_params->get('temp') == "CE") ): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("CE Pages List","staticpages/index");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Add CE Pages","staticpages/new?temp=CE");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">Edit CE Page</td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>

		<?php elseif(($actionName == "new" && $sf_params->get('temp') == "CE") || ($actionName == "create" && $sf_params->get('temp') == "CE") ): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("CE Pages List","staticpages/index");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">
								Add CE Pages
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select CE page to edit');" href="javascript:void(0)">Edit CE Page</a></td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>

		<?php elseif(($actionName == "new" && $sf_params->get('temp') == "LG") || ($actionName == "create" && $sf_params->get('temp') == "LG") ): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("LG Pages List","staticpages/lgList");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">
								Add LG Pages
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select LG page to edit');" href="javascript:void(0)">Edit LG Page</a></td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>
					
		<?php elseif(($actionName == "update" && $sf_params->get('temp') == "LG") || ($actionName == "edit" && $sf_params->get('temp') == "LG") ): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("LG Pages List","staticpages/lgList");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Add LG Pages","staticpages/new?temp=LG");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">Edit LG Page</td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>

		<?php elseif($actionName == "lgList"): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="SelectTab">LG Pages List</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Add LG Pages","staticpages/new?temp=LG");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select LG page to edit');" href="javascript:void(0)">Edit LG Page</a></td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>

		<?php endif; ?>

<?php endif; ?>