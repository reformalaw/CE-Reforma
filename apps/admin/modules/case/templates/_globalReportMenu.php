<?php
$actionName =  $sf_params->get('action');
$moduleName =  $sf_params->get('module');
?>


<?php if($moduleName == "globalreport" && $actionName == "unpaidCustomer"): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="170" align="center" valign="middle" class="SelectTab">Unpaid Customer Report</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="170" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Unpaid 3rd Party Report","globalreport/unpaidThirdparty"); ?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="170" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("	Finance Report","globalreport/finance"); ?>
							</td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>

<?php elseif($moduleName == "globalreport" && $actionName == "unpaidThirdparty"): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="170" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Unpaid Customer Report","globalreport/unpaidCustomer"); ?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="170" align="center" valign="middle" class="SelectTab">
								Unpaid 3rd Party Report
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="170" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("	Finance Report","globalreport/finance"); ?>
							</td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>

<?php elseif($moduleName == "globalreport" && $actionName == "finance" ): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="170" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Unpaid Customer Report","globalreport/unpaidCustomer"); ?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="170" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Unpaid 3rd Party Report","globalreport/unpaidThirdparty"); ?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="170" align="center" valign="middle" class="SelectTab">
								Finance Report
							</td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>

<?php endif; ?>