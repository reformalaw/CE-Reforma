<?php

class permissionsFilter extends sfFilter
{
	public function execute ($filterChain)
	{

		$context = $this->getContext();
		$request = $context->getRequest();
		$hostname = $request->getHost();   // Get Host Name
		$userType = $this->getContext()->getUser()->getAttribute('user_type');
		$userId = $this->getContext()->getUser()->getAttribute('admin_user_id');

		$moduleName = $request->getParameter('module');
		$actionName = $request->getParameter('action'); 

		$permissionName = $moduleName.'/'.$actionName;

		// If user type is Staff
		if($userType == sfConfig::get('app_UserType_Staff'))
		{
			// Assign Permissions
			$arrPermission = Doctrine_Core::getTable('UserRoles')->getPermissionListUsingRole($userId);

			// Default Permissions
			$defaultPermission = array("$moduleName/create","$moduleName/update","administrators/myprofile","administrators/changeEmail");

			$arrPermission = array_merge($arrPermission,$defaultPermission);  // Merge Both permission
			// Check  permissions in array and permission is not 'default/index' and ajax call
			if(!in_array($permissionName, $arrPermission) && $permissionName != 'default/index' && !sfContext::getInstance()->getRequest()->isXmlHttpRequest()) {
						$context->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message')); // error msg
						$context->getController()->redirect('default/index');  // redirect page
				}
		}

		// Start Admin Module Security By Jaydip Dodiya
		elseif($userType == sfConfig::get('app_UserType_Customer'))
		{
			$notAllowModule = array(
				'roles', 'siteconfig', 'users', 'practiceareas', 'staticpages',
				'thirdparty', 'media', 'userswebsite', 'theme', 'case', 'activity', 'accounting', 'globalreport',
				'personalWebsiteFAQs', 'Forums', 'forumreplay', 'statistics', 'dashboard', 'dashboardcase', 'dashboardreport',
				'dashboard', 'website', 'paymenthistory');

			$allowModule = array('administrators', 'manageuser');

			if(in_array($moduleName,$notAllowModule))
			{
				$context->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
				return $context->getController()->redirect('default/index');
			}
			else
			{
				if(in_array($moduleName, $allowModule))
				{
					$allowAction = array('myprofile', 'networkprofile', 'changeEmail', 'customerReview', 'changeReviewStatus', 'ajaxSpamInsert','ajaxDefaultImage');
					if(!in_array($actionName, $allowAction))
					{
						$context->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
						return $context->getController()->redirect('default/index');
					}
				}
			}
		}
		// End Admin Module Security By Jaydip Dodiya

		$filterChain->execute();
	}
}
?>