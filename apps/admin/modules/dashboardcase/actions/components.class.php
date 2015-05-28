<?php

class dashboardcaseComponents extends sfComponents
{
	public function executeProfile(sfWebRequest $request)
	{	
        if ($request->hasParameter('caseId')) {
            $this->caseData = Doctrine_Core::getTable('Cases')->findOneBy('Id',$this->request->getParameter('caseId'));	
        }else{
            $this->caseData = Doctrine_Core::getTable('Users')->findOneBy('Id',$this->request->getParameter('customerId'));	
        }
	}
}
?>