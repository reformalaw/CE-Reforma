<?php

class caseComponents extends sfComponents
{
	/**
	 * Executes Header action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeHeader(sfWebRequest $request)
	{
// 		if($request->hasParameter("customerId"))
// 		{
// 			$this->customerId 	= $request->getParameter('customerId');
//  			$this->oUserData 	= Doctrine::getTable('Users')->find(array($request->getParameter('customerId')));
// 		}
	}
}
?>