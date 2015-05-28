<?php

$moduleName =  $sf_params->get('module');
$actionName =  $sf_params->get('action');

	$categoriesAction 	= array("index", "edit", "new", "update", "create");
	$forumsAction 		= array("forumsList", "editForum", "forumsNew", "forumsCreate", "updateForum");
	$topicAction 		= array("topicList", "editTopic", "topicNew", "topicCreate", "updateTopic");
	$replayAction		= array("index", "edit", "update");

	if($moduleName == "Forums" &&  in_array($actionName, $categoriesAction))
	{
		$activeCategories = "select";
		$activeForums		= "deselect";
		$activeTopic			= "deselect";
		$activeReplay		= "deselect";
	}
	elseif($moduleName == "Forums" && in_array($actionName, $forumsAction))
	{
		$activeCategories 	= "deselect";
		$activeForums		= "select";
		$activeTopic			= "deselect";
		$activeReplay		= "deselect";
	}
	elseif($moduleName == "Forums" && in_array($actionName, $topicAction))
	{
		$activeCategories 	= "deselect";
		$activeForums		= "deselect";
		$activeTopic			= "select";
		$activeReplay		= "deselect";
	}
	elseif($moduleName == "forumreplay" && in_array($actionName, $replayAction))
	{
		$activeCategories 	= "deselect";
		$activeForums		= "deselect";
		$activeTopic			= "deselect";
		$activeReplay		= "select";
	}

?>


<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left" valign="middle" class="deselect" style="padding:0px; border:none 0px;">&nbsp;</td>
	</tr>

	<tr>
		<td align="left" valign="middle" class="<?php echo $activeCategories; ?>">
			<?php echo link_to("Manage Categories","Forums/index"); ?>
		</td>
	</tr>
	
	<tr>
		<td align="left" valign="middle" class="<?php echo $activeForums; ?>">
			<?php echo link_to("Manage Forums","Forums/forumsList"); ?>
		</td>
	</tr>

	<tr>
		<td align="left" valign="middle" class="<?php echo $activeTopic; ?>">
			<?php echo link_to("Manage Topic","Forums/topicList"); ?>
		</td>
	</tr>

	<tr>
		<td align="left" valign="middle" class="<?php echo $activeReplay; ?>">
			<?php echo link_to("Manage Reply","forumreplay/index"); ?>
		</td>
	</tr>
</table>