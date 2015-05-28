<?php

/**
 * ThirdParties
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    counceledge
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class ThirdParties extends BaseThirdParties
{

    public function __toString(){
        return $this->getName();
    }
    
    /* update the status of the 3rd party */
    public function changeStatus($snId , $ssStatus)
    {
        if(!is_numeric($snId) || !is_string($ssStatus))
		return false;

	 $ssQuery =Doctrine_Query::create()
			  ->update('ThirdParties')
			  ->set('status', '?', $ssStatus)
			  ->where('id = ?', $snId)
			  ->execute();
    }
}
