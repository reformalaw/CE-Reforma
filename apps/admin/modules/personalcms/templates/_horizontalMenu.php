<?php
$actionName =  $sf_params->get('action');
$moduleName =  $sf_params->get('module');
?>


<?php if($moduleName == "personalcms"): ?>
	<!--Horizontal Menu For Personal CMS-->
		<?php if($actionName == "index"): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="SelectTab">Page List</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Add CMS Page", "personalcms/new");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select cms page to edit');" href="javascript:void(0)">Edit CMS Page</a></td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>

		<?php elseif($actionName == "new" || $actionName == "create"): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Page List","personalcms/index");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">
								Add CMS Page
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select cms page to edit');" href="javascript:void(0)">Edit CMS Page</a></td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>

		<?php elseif($actionName == "edit" || $actionName == "update"): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Page List","personalcms/index");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Add CMS Page", "personalcms/new"); ?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">Edit CMS Page</td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>
		<!--End Horizontal Menu For Personal CMS-->
		<?php endif; ?>

<?php elseif($moduleName == "WebsitePracticeArea"): ?>

		<!--Horizontal Menu For Practice Area -->
		<?php if($actionName == "index"): ?>
					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="SelectTab">Practice Area List</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Add Practice Area", "WebsitePracticeArea/new"); ?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select practice area to edit');" href="javascript:void(0)">Edit Practice Area</a></td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>
		<?php elseif($actionName == "new" || $actionName == "create"): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Practice Area List","WebsitePracticeArea/index");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">
								Add Practice Area
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select practice area to edit');" href="javascript:void(0)">Edit Practice Area</a></td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>

		<?php elseif($actionName == "edit" || $actionName == "update"): ?>
		
					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Practice Area List","WebsitePracticeArea/index");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Add Practice Area","WebsitePracticeArea/new");?>
								<!--<a href="<?php //echo url_for('WebsitePracticeArea/new') ?>" >Add Practice Area</a>-->
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">Edit Practice Area</td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>
		<?php endif; ?>
		<!--End Horizontal Menu For Practice Area -->
<?php elseif($moduleName == "faq"): ?>
		<!--Horizontal Menu For FAQs -->
		<?php if($actionName == "personalWebsiteList"): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="150" align="center" valign="middle" class="SelectTab">Manage Website FAQs</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Global FAQs List","faq/globalfaqs")?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td align="right" class="BorderBottom">&nbsp;<!--<span class="noteDisplay" style="display:none;"><strong>Note: </strong> You can create your own custom FAQs or add premade ones from the Global List</span>--></td>
						</tr>
					</table>

		<?php elseif($actionName == "globalfaqs"): ?>

					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="150" align="center" valign="middle" class="DeSelectTab">
								
								<?php echo link_to("Manage Website FAQs","faq/personalWebsiteList")?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">
								Global FAQs List
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td align="right" class="BorderBottom">&nbsp;<!--<span class="noteDisplay"><strong>Note: </strong> You can create your own custom FAQs or add premade ones from the Global List</span>--></td>
						</tr>
					</table>
		<?php endif; ?>
		<!--End Horizontal Menu For FAQs -->
<?php elseif($moduleName == "websitemenu"):?>

		<!--Horizontal Menu For Header Menu  -->
		<?php if($actionName == "index"): ?>
					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="SelectTab">Header Menu List</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Add Header Menu", "websitemenu/new"); ?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select header menu to edit');" href="javascript:void(0)">Edit Header Menu</a></td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>
		<?php elseif($actionName == "new" || $actionName == "create"): ?>
					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Header Menu List","websitemenu/index");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">
								Add Header Menu
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select header menu to edit');" href="javascript:void(0)">Edit Header Menu</a></td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>
		<?php elseif($actionName == "edit" || $actionName == "update"):?>
					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Header Menu List","websitemenu/index");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Add Header Menu","websitemenu/new");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">Edit Header Menu</td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>
		<?php endif; ?>
		<!--END Horizontal Menu For Header Menu  -->
		
<?php elseif($moduleName == "footermenu"):?>
		<!-- Horizontal Menu For Footer Menu  -->
		<?php if($actionName == "index"): ?>
					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="SelectTab">Footer Menu List</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Add Footer Menu", "footermenu/new"); ?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select footer menu to edit');" href="javascript:void(0)">Edit Footer Menu</a></td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>
		<?php elseif($actionName == "new" || $actionName == "create"): ?>
					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Footer Menu List","footermenu/index");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">
								Add Footer Menu
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select footer menu to edit');" href="javascript:void(0)">Edit Footer Menu</a></td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>
		<?php elseif($actionName == "edit" || $actionName == "update"): ?>
					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Footer Menu List","footermenu/index");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Add Footer Menu","footermenu/new");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">Edit Footer Menu</td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>
		<?php endif;?>
		<!--END Horizontal Menu For Footer Menu  -->
<?php elseif($moduleName == "themebanner" ): ?>
	<?php
		$webId = $sf_user->getAttribute('personalWebsiteId'); 
		$userWebsiteData = Doctrine::getTable('UsersWebsite')->find(array($webId));
		$themeData = Doctrine::getTable('Theme')->find(array($userWebsiteData->getThemeId()));
		$serializeCode = $themeData->getOptions();
		$unserializeCode = unserialize($serializeCode);

		if($unserializeCode["BannerBackground"] == "Yes")
			$themOptionBgImage = "Yes";
		else
			$themOptionBgImage = "";

		//$themOptionBgImage =Doctrine_Core::getTable('ThemeOptions')->findOneByWebsiteIdAndOptionKey($webId, "BGImage");
	?>
		<!--Horizontal Menu For Banner  -->
		<?php if($actionName == "index"): ?>
					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="SelectTab">Banners List</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Add Banner", "themebanner/new");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select Banner to edit');" href="javascript:void(0)">Edit Banner</a></td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select Banner to View');" href="javascript:void(0)">View Banner</a></td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<?php if($themOptionBgImage != ""): ?>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Banner Backgroud", "themebanner/bannerBackground");?>
							</td>
							<?php endif; ?>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>
		<?php elseif($actionName == "new" || $actionName == "create"):?>
					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Banners List","themebanner/index");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">
								Add Banner
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select banner to edit');" href="javascript:void(0)">Edit Banner</a></td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select Banner to View');" href="javascript:void(0)">View Banner</a></td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<?php if($themOptionBgImage != ""): ?>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Banner Backgroud", "themebanner/bannerBackground");?>
							</td>
							<?php endif; ?>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>
		<?php elseif($actionName == "edit" || $actionName == "update"): ?>
					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Banners List","themebanner/index");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Add Banner", "themebanner/new"); ?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">Edit Banner</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select Banner to View');" href="javascript:void(0)">View Banner</a></td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<?php if($themOptionBgImage != ""): ?>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Banner Backgroud", "themebanner/bannerBackground");?>
							</td>
							<?php endif; ?>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>
		<?php elseif($actionName == "view"): ?>
					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Banners List","themebanner/index");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Add Banner","themebanner/new");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select banner to edit');" href="javascript:void(0)">Edit Banner</a></td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">View Banner</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<?php if($themOptionBgImage != ""): ?>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Banner Backgroud", "themebanner/bannerBackground");?>
							</td>
							<?php endif; ?>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>
		<?php elseif($actionName == "bannerBackground"): ?>
					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Banners List","themebanner/index");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Add Banner","themebanner/new");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select banner to edit');" href="javascript:void(0)">Edit Banner</a></td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select Banner to View');" href="javascript:void(0)">View Banner</a></td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<?php if($themOptionBgImage != ""): ?>
							<td width="110" align="center" valign="middle" class="SelectTab">
								Banner Backgroud
							</td>
							<?php endif; ?>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>
		<?php endif; ?>
		<!--END Horizontal Menu For Banner  -->
<?php elseif($moduleName == "usertheme" ): ?>
		<!--START Horizontal Menu For ManageTheme  -->
		<?php if($actionName == "index"): ?>
					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="SelectTab">Manage Theme</td>
							<!--<td width="2" align="center" valign="middle" class="BorderBottom"></td>-->
							<!--<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select Theme to View');" href="javascript:void(0)">View Theme</a></td>-->
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table>
					<?php /*
		<?php elseif($actionName == "view"):?>
					<table width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10" class="BorderBottom">&nbsp;</td>
							<td width="110" align="center" valign="middle" class="DeSelectTab">
								<?php echo link_to("Manage Theme","usertheme/index");?>
							</td>
							<td width="2" align="center" valign="middle" class="BorderBottom"></td>
							<td width="110" align="center" valign="middle" class="SelectTab">View Theme</td>
							<td class="BorderBottom">&nbsp;</td>
						</tr>
					</table> */ ?>
		<?php endif; ?>
		<!--END Horizontal Menu For ManageTheme  -->
<?php endif; ?>