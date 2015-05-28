<?php

$user = Doctrine::getTable('Users')->find(array($sf_user->getAttribute("admin_user_id")));

$moduleName =  $sf_params->get('module');
$actionName =  $sf_params->get('action');

if($moduleName == "administrators")
{
    if($actionName == "myprofile")
    {
        $activeMyprofile = "select";
        $activeEditemail = "deselect";
    }
    elseif($actionName == "changeEmail")
    {
        $activeMyprofile = "deselect";
        $activeEditemail = "select";
    }
}
else
{
    $activeMyprofile = "select";
    $activeEditemail = "deselect";
}


?>


<table width="100%" cellspacing="0" cellpadding="0">

		<tr>
			<td align="left" valign="middle" class="deselect" style="padding:0px; border:none 0px;">&nbsp;</td>
		</tr>

		<tr>
			<td align="left" valign="middle" class="<?php echo $activeMyprofile; ?>">
				<?php echo link_to("Personal Profile","administrators/myprofile"); ?>
			</td>
		</tr>

		<tr>
			<td align="left" valign="middle" class="<?php echo $activeEditemail; ?>">
				<?php echo link_to("Change Email","administrators/changeEmail"); ?>
			</td>
		</tr>

</table>