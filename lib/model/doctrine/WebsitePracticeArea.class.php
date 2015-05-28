<?php

/**
 * WebsitePracticeArea
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    counceledge
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class WebsitePracticeArea extends BaseWebsitePracticeArea
{

	public function __toString()
	{
			return $this->getTitle();
	}

    public function practiceAreaListing()
    {
        $RecordData = Doctrine_Query::create()
        ->select("wpa.*")
        ->from('WebsitePracticeArea wpa')
        ->where("wpa.Status != ?", sfConfig::get("app_Status_Deleted"));

        return $RecordData;
    }

    public function changeStatus($snId,$ssStatus)
    {
        if(!is_numeric($snId) || $ssStatus == '')
        return false;

        Doctrine_Query::create()
        ->update('WebsitePracticeArea')
        ->set('Status', '?', $ssStatus)
        ->where('id = ?', $snId)
        ->execute();

        return true;
    }

    public function viewPracticeArea($snId)
    {
        if(!is_numeric($snId))
        return false;

        $RecordData = Doctrine_Query::create()
        ->select("wpa.*,uw.*")
        ->from('WebsitePracticeArea wpa')
        ->leftJoin("wpa.WebsitePracticeAreaUsersWebsite uw")
        ->where("wpa.Id = ?", $snId)
        ->fetchArray();

        return $RecordData;
    }
    
    /**
     * This function is for delete website data
     *
     * @param  integer $websiteId
     * @auther jaydip dodiya
     * @return boolean
     */
	public function deleteWebsitePracticeAreaData($websiteId)
	{
		if(!is_numeric($websiteId))
			return false;

		Doctrine_Query::create()
		->delete('WebsitePracticeArea W')
		->where('W.WebsiteId = ?', $websiteId)
		->execute();

		return true;
	}
}