<?php

class websiteComponents extends sfComponents
{
	/**
	 * Executes Users Detail action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeUsersDetail(sfWebRequest $request)
	{
		if($request->hasParameter("customerId"))
		{
			$this->customerId 	= $request->getParameter('customerId');
			$userData = UsersWebsiteTable::getUsersData($this->customerId);
			$this->userData = $userData[0];
		}
	}
}
?>