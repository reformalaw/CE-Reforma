<?php

class customercaseComponents extends sfComponents
{
	public function executeProfile()
	{	
        $this->caseData = Doctrine_Core::getTable('Cases')->findOneBy('Id',$this->request->getParameter('id'));
	}
}
?>