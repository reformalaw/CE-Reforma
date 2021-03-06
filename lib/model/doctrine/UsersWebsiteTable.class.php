<?php

/**
 * UsersWebsiteTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class UsersWebsiteTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object UsersWebsiteTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('UsersWebsite');
    }

    /**
     * This Function is use for check the url id is unique or not
     *
     * @param unknown_type $id
     * @param unknown_type $newUrl
     * @return flage variable i.e. true or flase
     */
    public static function urlCheck($id,$usrId,$newUrl)
    {
        $dbEmail = Doctrine_Query::create()
        ->from('UsersWebsite uw')
        ->where('uw.id != ?',$id)
        ->andWhere('uw.UserId != ?',$usrId)
        ->andWhere('uw.WebsiteURL = ?',$newUrl);
        //echo $dbEmail->getSqlQuery();die;
        $resultEmail = $dbEmail->fetchArray();
        $dbEmail->free();
        if (count($resultEmail) == 1) {
            return 1;
        }else {
            return 0;
        }
        //return $resultEmail[0]['Email'];
    }

    /**
     * This Function is use for update url with using same table id, user id, new uls
     *
     * @param unknown_type $id
     * @param unknown_type $usrId
     * @param unknown_type $newUrl
     */
    public static function updateWebUrl($id,$usrId,$newUrl)
    {
        $q = Doctrine_Query::create()
        ->update('UsersWebsite uw')
        ->set('uw.Websiteurl', '?', $newUrl)
        ->set('uw.Status', '?', 'Active')
        ->where('uw.Id = ?', $id)
        ->andWhere('uw.UserId = ?', $usrId)
        ->execute();
    }

    public static function getWebsiteDetail($siteURL){
        $q = Doctrine_Query::create()
        ->select('uw.*')
        ->from('UsersWebsite uw')
        ->where('uw.WebsiteURL = ?', $siteURL)
        ->execute();
        #clsCommon::pr($q->toArray());
        return $q ;
    } // End of Function
    
    /**
     * THIS FUNCTION IS USE FOR CREATE ON FEATURE LIST ARRAY
     *
     * @return FEATURE ARRAY()
     */
    public static function getThemeFeatureList()
    {
        $feature[] = array();
        $sql = Doctrine_Query::create()
        ->from('UsersWebsite uw')
        ->where('uw.UserId = ?',sfContext::getInstance()->getUser()->getAttribute('admin_user_id'));
        $temp = $sql->fetchArray();
        
        $sql2 = Doctrine_Query::create()
        ->from('Theme t')
        ->where('t.Id = ?',$temp['0']['ThemeId']);
        $temp2 = $sql2->execute();

        $options = unserialize($temp2[0]->getOptions());

        return $feature = array(
        'ManageTopMenu'             =>$temp2[0]->getManageTopMenu(),
        'ManageFooterMenu'          =>$temp2[0]->getManageFooterMenu(),
        'ManageBanner'              =>$temp2[0]->getManageBanner(),
        'ManageColorAndBackground'  =>$temp2[0]->getManageColorAndBackground(),
        'ManageSocialMedia'         =>$temp2[0]->getManageSocialMedia(),
        'ManageChangeLogo'          =>$temp2[0]->getChangeLogo(),
        'ManageTextWidget'          =>$temp2[0]->getTextWidgets(),
        'BodyBackground'				=>$temp2[0]->getBodyBackground(),
        'AllOptions'                =>$options
        );
    }
    
    public static function getThemeId()
    {
        $sql = Doctrine_Query::create()
        ->from('UsersWebsite uw')
        ->where('uw.Id = ?',sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'));
        $sqlVal = $sql->fetchArray();
        return $sqlVal[0];
    }
    
    /**
     * function use for get users data 
     *
     * @param integer $userId
     */
    public static function getUsersData($userId)
    {
		if(!is_numeric($userId))
			return false;
			
		$userData = Doctrine_Query::create()
						->from('UsersWebsite uw')
						->where('uw.UserId = ?',$userId)
						->execute();

		return $userData;
    }

}
