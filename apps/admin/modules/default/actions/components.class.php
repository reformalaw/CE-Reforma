<?php

class defaultComponents extends sfComponents
{
	
	public function executeHeader()
	{		
		/* Start here this is for manage theme menu according to theme */
		if($this->getUser()->getAttribute('personalWebsiteId') != "")
		{
			$oUsersWebsite = new UsersWebsite();
			$asUsersWebsiteData           		= $oUsersWebsite->usersWebsiteData($this->getUser()->getAttribute('personalWebsiteId'));
			$this->ssManageTopMenu     			= $asUsersWebsiteData[0]["UsersWebsiteTheme"]["ManageTopMenu"];
			$this->ssManageFooterMenu     		= $asUsersWebsiteData[0]["UsersWebsiteTheme"]["ManageFooterMenu"];
			$this->ssManageBanner     			= $asUsersWebsiteData[0]["UsersWebsiteTheme"]["ManageBanner"];
			$this->ssManageColorAndBackground  	= $asUsersWebsiteData[0]["UsersWebsiteTheme"]["ManageColorAndBackground"];
			$this->ssManageSocialMedia 			= $asUsersWebsiteData[0]["UsersWebsiteTheme"]["ManageSocialMedia"];
			$this->ssChangeLogo         			= $asUsersWebsiteData[0]["UsersWebsiteTheme"]["ChangeLogo"];
			$this->ssManageFAQs             		= $asUsersWebsiteData[0]["UsersWebsiteTheme"]["ManageFAQs"];
		}
		/* End theme menu  */

	}
	
	public function executeFooter()
	{

	}
}
?>