<?php
$flagTopicId = '';
$flagForumsId = '';
$flagCategoryId = '';

$actionName =  $sf_params->get('action');
$moduleName =  $sf_params->get('module');
$flagTopicId = $sf_params->get('flagTopicId');
$flagForumsId = $sf_params->get('flagForumsId');
$flagCategoryId = $sf_params->get('flagCategoryId');

?>


<?php if($moduleName == "Forums" && $actionName == "index"): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="SelectTab">Categories List</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Add Category", "Forums/new");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select categories to edit');" href="javascript:void(0)">Edit Categories</a></td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>

<?php elseif($moduleName == "Forums" && ($actionName == "new" || $actionName == "create") ): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Categories List", "Forums/index");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">
								Add Category
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select categories to edit');" href="javascript:void(0)">Edit Categories</a></td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>

<?php elseif($moduleName == "Forums" && ($actionName == "edit" || $actionName == "update") ): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Categories List", "Forums/index");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Add Category", "Forums/new");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">Edit Categories</td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>

<?php elseif($moduleName == "Forums" && $actionName == "forumsList" ): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="SelectTab">
								Forum List
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php 
									if($flagCategoryId != "")
										echo link_to("Add Forum", "Forums/forumsNew?flagCategoryId=".$flagCategoryId);
									else
										echo link_to("Add Forum", "Forums/forumsNew");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select forum to edit');" href="javascript:void(0)">Edit Forums</a></td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>

<?php elseif($moduleName == "Forums" && ($actionName == "forumsNew" || $actionName == "forumsCreate") ): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php 
									if($flagCategoryId != '')
										echo link_to("Forum List", "Forums/forumsList?flagCategoryId=".$flagCategoryId);
									else
										echo link_to("Forum List", "Forums/forumsList");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">
								Add Forum
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select forum to edit');" href="javascript:void(0)">Edit Forums</a></td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>

<?php elseif($moduleName == "Forums" && ($actionName == "editForum" || $actionName == "updateForum")): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php
									if($flagCategoryId != '')
										echo link_to("Forum List", "Forums/forumsList?flagCategoryId=".$flagCategoryId);
									else
										echo link_to("Forum List", "Forums/forumsList");
								?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php 
									if($flagCategoryId != '')
										echo link_to("Add Forum", "Forums/forumsNew?flagCategoryId=".$flagCategoryId);
									else
										echo link_to("Add Forum", "Forums/forumsNew");
								?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">Edit Forums</td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>
					
<?php elseif($moduleName == "Forums" && $actionName == "topicList" ): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="SelectTab">
								Forum Topic List<?php //echo link_to("Forum List", "Forums/topicList");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php 
									if($flagForumsId != '')
										echo link_to("Add Topic", "Forums/topicNew?flagForumsId=".$flagForumsId);
									else
										echo link_to("Add Topic", "Forums/topicNew");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select topic to edit');" href="javascript:void(0)">Edit Topic</a></td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>
					
<?php elseif($moduleName == "Forums" && ($actionName == "topicNew" || $actionName == "topicCreate") ): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php 
									if($flagForumsId != "")
										echo link_to("Forum Topic List", "Forums/topicList?flagForumsId=".$flagForumsId);
									else
										echo link_to("Forum Topic List", "Forums/topicList");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">
								Add Topic
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select topic to edit');" href="javascript:void(0)">Edit Topic</a></td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>

<?php elseif($moduleName == "Forums" && ($actionName == "editTopic" || $actionName == "updateTopic") ): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php 
									if($flagForumsId != '')
										echo link_to("Forum Topic List", "Forums/topicList?flagForumsId=".$flagForumsId);
									else
										echo link_to("Forum Topic List", "Forums/topicList");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php 
									if($flagForumsId != '')
										echo link_to("Add Topic", "Forums/topicNew?flagForumsId=".$flagForumsId);
									else
										echo link_to("Add Topic", "Forums/topicNew");
								?>
							</td>	
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">Edit Topic</td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>
					
<?php elseif($moduleName == "forumreplay" && $actionName == "index" ): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="SelectTab">
								Forum Replies List <?php //echo link_to("Forum Replies List", "forumreplay/index");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select forum-reply to edit');" href="javascript:void(0)">Edit Forum Reply</a></td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>

<?php elseif($moduleName == "forumreplay" && ($actionName == "edit" || $actionName == "update") ): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php 
									if($flagTopicId != '')
										echo link_to("Forum Replies List", "forumreplay/index?flagTopicId=".$flagTopicId);
									else
										echo link_to("Forum Replies List", "forumreplay/index");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">Edit Forum Reply</td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>
<?php endif; ?>