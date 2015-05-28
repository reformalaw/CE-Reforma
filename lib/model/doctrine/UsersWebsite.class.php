<?php

/**
 * UsersWebsite
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    counceledge
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class UsersWebsite extends BaseUsersWebsite
{
	/**
     * This function is __toString
     *
     */
    public function __toString()
    {
        return $this->getWebsiteurl();
    }

    /**
     * This function is use for get website url
     *
     * @param integer $userId
     * @return array
     */
    public static function getUsersWebsiteId($userId)
    {
        $userWebsiteId = Doctrine_Query::create()
        ->select("u.*")
        ->from('UsersWebsite u')
        ->where('u.UserId = ?', $userId)
        ->fetchArray();
        return $userWebsiteId;
    }

    /**
     * This function is use for website view
     *
     * @param integer $snId
     * @return array
     */
    public function websiteView($snId)
    {
        if(!is_numeric($snId))
        return false;

        $asResult = Doctrine_Query::create()
        ->select("uw.*,u.*")
        ->from('UsersWebsite uw')
        ->leftJoin("uw.UsersWebsiteUsers u")
        ->where('uw.Id = ?', $snId)
        ->fetchArray();

        return $asResult;
    }

    /**
     * This function is use for listing of user website
     * 
     * @return string
     */
    public function userWebsiteList()
    {
        $query = Doctrine_Query::create()
        ->select("u.*")
        ->from('UsersWebsite u')
        //->where("u.Status = ?", sfConfig::get('app_FAQs_Active'))
        ->whereNotIn('u.Id', array(1,2));

        return $query;

    }
	
	/**
     * This function is use for website url
     *
     * @param integer $snId
     * @return array
     */
    public function getUserwebsite($snId)
    {
        if(!is_numeric($snId))
        return false;

        $asResult = Doctrine_Query::create()
        ->select("uw.WebsiteURL")
        ->from('UsersWebsite uw')
        ->where('uw.Id = ?', $snId)
        ->fetchArray();

        return $asResult;
    }

    /**
     * This function is use update theme id in website table
     *
     * @param integer $snId
     * @param integer $ThemeId
     * @return booelan
     */
    public function updteThemeId($snId,$ThemeId)
    {
        if(!is_numeric($snId) || !is_numeric($ThemeId))
        return false;

        Doctrine_Query::create()
        ->update('UsersWebsite')
        ->set('ThemeId', '?', $ThemeId)
        ->where('id = ?', $snId)
        ->execute();

        return true;
    }

    /**
     * This function is use for get current theme id
     *
     * @param integer $snId
     * @return array
     */
    public function currentThemeId($snId)
    {
        if(!is_numeric($snId))
        return false;

        $asResult = Doctrine_Query::create()
        ->select("uw.ThemeId")
        ->from("UsersWebsite uw")
        ->where("uw.id = ?", $snId)
        ->fetchArray();

        return $asResult;
    }

    /**
     * This function is use for get website data
     *
     * @param integer $snId
     * @return object
     */
    public function usersWebsiteData($snId)
    {
		if(!is_numeric($snId))
			return false;

        $asResult = Doctrine_Query::create()
						->select("uw.*,uwt.*")
						->from("UsersWebsite uw")
						->leftJoin("uw.UsersWebsiteTheme uwt")
						->where("uw.id = ?", $snId)
						->execute();

        return $asResult;
    }

    /**
     * This function is use for get website url
     *
     * @param integer $snId
     * @return Array
     * @author jaydip dodiya
     */
     public static function getWebsiteUrlStaticPage($snId)
     {
		$userWebsiteId = Doctrine_Query::create()
        ->select("u.*")
        ->from('UsersWebsite u')
        ->where('u.Id = ?', $snId)
        ->fetchArray();
        return $userWebsiteId;
     }
     
    /**
     * This function is use for set stauts
     *
     * @param integer $userId
     * @param string $status
     * @return boolean
     */
	public function setWebsiteStatus($userId, $status)
	{
		if(!is_numeric($userId) || !is_string($status))
		return false;

		Doctrine_Query::create()
		->update('UsersWebsite')
		->set('Status', '?', $status)
		->where('UserId = ?', $userId)
		->execute();

		return true;
	}
	
	/**
     * This function is for delete website data
     *
     * @param  integer $websiteId
     * @auther jaydip dodiya
     * @return boolean
     */
	public function deleteUsersWebsiteData($websiteId)
	{
		if(!is_numeric($websiteId))
			return false;

		Doctrine_Query::create()
		->delete('UsersWebsite U')
		->where('U.Id  = ?', $websiteId)
		->execute();

		return true;
	}
}