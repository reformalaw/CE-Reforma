<?php

	if($sf_user->getAttribute('personalWebsiteId') != '')
	{
		$oUsersWebsite = new UsersWebsite();
		$asUsersWebsiteData           		= $oUsersWebsite->usersWebsiteData($sf_user->getAttribute('personalWebsiteId'));
		$ssManageTopMenu     			= $asUsersWebsiteData[0]["UsersWebsiteTheme"]["ManageTopMenu"];
		$ssManageFooterMenu     		= $asUsersWebsiteData[0]["UsersWebsiteTheme"]["ManageFooterMenu"];
		$ssManageBanner     			= $asUsersWebsiteData[0]["UsersWebsiteTheme"]["ManageBanner"];
		$ssManageColorAndBackground  	= $asUsersWebsiteData[0]["UsersWebsiteTheme"]["ManageColorAndBackground"];
		$ssManageSocialMedia 			= $asUsersWebsiteData[0]["UsersWebsiteTheme"]["ManageSocialMedia"];
		$ssChangeLogo         			= $asUsersWebsiteData[0]["UsersWebsiteTheme"]["ChangeLogo"];
		$ssManageFAQs             		= $asUsersWebsiteData[0]["UsersWebsiteTheme"]["ManageFAQs"];
	}
			
$moduleName =  $sf_params->get('module');
$actionName =  $sf_params->get('action');
	if($moduleName == "personalcms")
	{
		$activeUserTheme = "deselect";
		$acttiveThemeOption = "deselect";
		$activeThemeTextWidget = 'deselect';
		$activeCmsPage = "select";
		$activePracticeArea = "deselect";
		$activeFaq = "deselect";
		$activeHeader = "deselect";
		$activeFooter = "deselect";
		$activeBanner = "deselect";
		$activeContactUs = "deselect";
		$activeWebsite = "deselect";
	}
	elseif($moduleName == "WebsitePracticeArea")
	{
		$activeUserTheme = "deselect";
		$acttiveThemeOption = "deselect";
		$activeThemeTextWidget = 'deselect';
		$activeCmsPage = "deselect";
		$activePracticeArea = "select";
		$activeFaq = "deselect";
		$activeHeader = "deselect";
		$activeFooter = "deselect";
		$activeBanner = "deselect";
		$activeContactUs = "deselect";
		$activeWebsite = "deselect";
	}
	elseif($moduleName == "faq")
	{
		$activeUserTheme = "deselect";
		$acttiveThemeOption = "deselect";
		$activeThemeTextWidget = 'deselect';
		$activeCmsPage = "deselect";
		$activePracticeArea = "deselect";
		$activeFaq = "select";
		$activeHeader = "deselect";
		$activeFooter = "deselect";
		$activeBanner = "deselect";
		$activeContactUs = "deselect";
		$activeWebsite = "deselect";
	}
	elseif($moduleName == "websitemenu")
	{
		$activeUserTheme = "deselect";
		$acttiveThemeOption = "deselect";
		$activeThemeTextWidget = 'deselect';
		$activeCmsPage = "deselect";
		$activePracticeArea = "deselect";
		$activeFaq = "deselect";
		$activeHeader = "select";
		$activeFooter = "deselect";
		$activeBanner = "deselect";
		$activeContactUs = "deselect";
		$activeWebsite = "deselect";
	}
	elseif($moduleName == "footermenu")
	{
		$activeUserTheme = "deselect";
		$acttiveThemeOption = "deselect";
		$activeThemeTextWidget = 'deselect';
		$activeCmsPage = "deselect";
		$activePracticeArea = "deselect";
		$activeFaq = "deselect";
		$activeHeader = "deselect";
		$activeFooter = "select";
		$activeBanner = "deselect";
		$activeContactUs = "deselect";
		$activeWebsite = "deselect";
	}
	elseif($moduleName == "themebanner")
	{
		$activeUserTheme = "deselect";
		$acttiveThemeOption = "deselect";
		$activeThemeTextWidget = 'deselect';
		$activeCmsPage = "deselect";
		$activePracticeArea = "deselect";
		$activeFaq = "deselect";
		$activeHeader = "deselect";
		$activeFooter = "deselect";
		$activeBanner = "select";
		$activeContactUs = "deselect";
		$activeWebsite = "deselect";
	}
	elseif($moduleName == "contactus")
	{
		$activeUserTheme = "deselect";
		$acttiveThemeOption = "deselect";
		$activeThemeTextWidget = 'deselect';
		$activeCmsPage = "deselect";
		$activePracticeArea = "deselect";
		$activeFaq = "deselect";
		$activeHeader = "deselect";
		$activeFooter = "deselect";
		$activeBanner = "deselect";
		$activeContactUs = "select";
		$activeWebsite = "deselect";
	}
	elseif($moduleName == "usertheme")
	{
		$activeUserTheme = "select";
		$acttiveThemeOption = "deselect";
		$activeThemeTextWidget = 'deselect';
		$activeCmsPage = "deselect";
		$activePracticeArea = "deselect";
		$activeFaq = "deselect";
		$activeHeader = "deselect";
		$activeFooter = "deselect";
		$activeBanner = "deselect";
		$activeContactUs = "deselect";
		$activeWebsite = "deselect";
	}
	elseif($moduleName == "themeOptions" && $actionName == "editTextWidgets")
	{
		$activeUserTheme = "deselect";
		$acttiveThemeOption = "deselect";
		$activeThemeTextWidget = 'select';
		$activeCmsPage = "deselect";
		$activePracticeArea = "deselect";
		$activeFaq = "deselect";
		$activeHeader = "deselect";
		$activeFooter = "deselect";
		$activeBanner = "deselect";
		$activeContactUs = "deselect";
		$activeWebsite = "deselect";
	}
	elseif($moduleName == "themeOptions" && $actionName == "edit")
	{
		$activeUserTheme = "deselect";
		$acttiveThemeOption = "select";
		$activeThemeTextWidget = 'deselect';
		$activeCmsPage = "deselect";
		$activePracticeArea = "deselect";
		$activeFaq = "deselect";
		$activeHeader = "deselect";
		$activeFooter = "deselect";
		$activeBanner = "deselect";
		$activeContactUs = "deselect";
		$activeWebsite = "deselect";
	}
	elseif($moduleName == "customerstatistic")
	{
		$activeUserTheme = "deselect";
		$acttiveThemeOption = "deselect";
		$activeThemeTextWidget = 'deselect';
		$activeCmsPage = "deselect";
		$activePracticeArea = "deselect";
		$activeFaq = "deselect";
		$activeHeader = "deselect";
		$activeFooter = "deselect";
		$activeBanner = "deselect";
		$activeContactUs = "deselect";
		$activeWebsite = "select";
	}
?>
<?php /*
<strong style='float:left;'><a href="http://<?php #echo $asUsersWebsiteData[0]["Websiteurl"]; ?>" title="Click here to view Website" target="_blank"><?php #echo $asUsersWebsiteData[0]["Websiteurl"]; ?></a></strong>
*/ ?>

<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left" valign="middle" class="deselect" style="padding:0px; border:none 0px;">&nbsp;</td>
	</tr>

	<tr>
		<td align="left" valign="middle" class="<?php echo $activeUserTheme; ?>">
			<?php echo link_to("Manage Theme","usertheme/index"); ?>
		</td>
	</tr>
	
	<tr>
		<td align="left" valign="middle" class="<?php echo $acttiveThemeOption; ?>">
			<?php echo link_to("Theme Setting","themeOptions/edit"); ?>
		</td>
	</tr>

	<?php $featureListArr = UsersWebsiteTable::getThemeFeatureList(); ?>
	<?php if($featureListArr["ManageTextWidget"] == "Yes"): ?>
	<tr>
		<td align="left" valign="middle" class="<?php echo $activeThemeTextWidget; ?>">
			<?php echo link_to("Text Widget","themeOptions/editTextWidgets"); ?>
		</td>
	</tr>
	<?php endif;?>
	
	<tr>
		<td align="left" valign="middle" class="<?php echo $activeCmsPage; ?>">
			<?php echo link_to("CMS Pages","personalcms/index"); ?>
		</td>
	</tr>

	<tr>
		<td align="left" valign="middle" class="<?php echo $activePracticeArea; ?>">
			<?php echo link_to("Practice Area","WebsitePracticeArea/index"); ?>
		</td>
	</tr>

	<?php if($ssManageFAQs == sfConfig::get("app_Theme_Yes")): ?>
	<tr>
		<td align="left" valign="middle" class="<?php echo $activeFaq; ?>">
			<?php echo link_to("FAQs","faq/personalWebsiteList"); ?>
		</td>
	</tr>
	<?php endif; ?>

	<?php if($ssManageTopMenu == sfConfig::get("app_Theme_Yes")): ?>
	<tr>
		<td align="left" valign="middle" class="<?php echo $activeHeader; ?>">
			<?php echo link_to("Header Menu","websitemenu/index"); ?>
		</td>
	</tr>
	<?php endif; ?>


	<?php if($ssManageFooterMenu == sfConfig::get("app_Theme_Yes")): ?>
	<tr>
		<td align="left" valign="middle" class="<?php echo $activeFooter; ?>">
			<?php echo link_to("Footer Menu","footermenu/index"); ?>
		</td>
	</tr>
	<?php endif; ?>

	<?php if($ssManageBanner == sfConfig::get("app_Theme_Yes")): ?>
	<tr>
		<td align="left" valign="middle" class="<?php echo $activeBanner; ?>">
			<?php echo link_to("Banner","themebanner/index"); ?>
		</td>
	</tr>
	<?php endif; ?>
	
	<tr>
		<td align="left" valign="middle" class="<?php echo $activeContactUs; ?>">
			<?php echo link_to("Contact Us Page","contactus/index"); ?>
		</td>
	</tr>
	
	<tr>
		<td align="left" valign="middle" class="<?php echo $activeWebsite; ?>">
			<?php echo link_to("Website Statistics","customerstatistic/websiteStatistics"); ?>
		</td>
	</tr>
</table>