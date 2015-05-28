<?php

/**
 * WebsiteMenuTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class WebsiteMenuTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object WebsiteMenuTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('WebsiteMenu');
    }

    /**
     * Function to get parent value
     *
     * @param integer $snWebId
     * @param integer $Id
     * @param string $ssType
     */
    public static function getParentValue($snWebId, $ssType, $Id)
    {
        if(!is_numeric($snWebId) || !is_string($ssType))
        return false;

        $asResult = Doctrine_Query::create()
        ->select("wm.*")
        ->from('WebsiteMenu wm')
        ->where("wm.WebsiteId = ?", $snWebId)
        ->andWhere("wm.Type = ?", $ssType)
        ->andWhere("wm.MenuType = ?", sfConfig::get("app_MenuType_Header"))
        ->whereNotIn('wm.Id', $Id)
        ->fetchArray();

        return $asResult;
    }

    /**
     * Function to get chiled menu list for website menu
     *
     * @param integer $snWebId
     * @param integer $parentId
     * @param string $menutype
     */
    public static function getChiledMenuList($snWebId, $parentId, $menutype= 'Header')
    {
        if(!is_numeric($snWebId) || !is_numeric($parentId))
        return false;

        $asResult = Doctrine_Query::create()
        ->select("wm.*")
        ->from('WebsiteMenu wm')
        ->where("wm.WebsiteId = ?", $snWebId)
        ->andwhere("wm.ParentId = ?", $parentId)
        ->andwhere("wm.MenuType = ?", $menutype)
        //->orderBy("wm.Id asc")
        ->orderBy("wm.Ordering")
        ->execute();

        return $asResult;
    }

    /**
     * Function to get Parent menu list for website menu
     *
     * @param integer $webId
     * @param integer $parentId
     * @param integer $menutype
     */
    public static function getParentMenuList($webId, $parentId , $menutype)
    {
        $sql = Doctrine_Query::create()
        ->select("wm.*")
        ->from('WebsiteMenu wm')
        ->where("wm.WebsiteId = ?", $webId)
        ->andwhere("wm.ParentId = ?", $parentId)
        ->andwhere("wm.MenuType = ?", $menutype)
        ->orderBy("wm.Ordering")
        ->execute();
        return $sql;
    }

    /**
     * Function to Listing of Footer Menu
     *
     * @param integer $webId
     * @param string $Title
     */
    public static function getFooterList($webId)
    {
        $sql = Doctrine_Query::create()
        ->select("wm.*")
        ->from('WebsiteMenu wm')
        ->where("wm.WebsiteId = ?", $webId)
        ->andwhere("wm.MenuType = ?", sfConfig::get("app_MenuType_Footer"))
        ->orderBy("wm.Ordering");

        return $sql;
    }

    /**
     * Function to check unique title in footer
     *
     * @param integer $webId
     * @param string $Title
     */
    public static function checkFooterUniqueTitle($WebId, $Title)
    {
        if(!is_numeric($WebId) || !is_string($Title))
        return false;

        $asResult = Doctrine_Query::create()
        ->select("wm.*")
        ->from('WebsiteMenu wm')
        ->where("wm.WebsiteId = ?", $WebId)
        ->andWhere("wm.MenuType = ?", sfConfig::get("app_MenuType_Footer"))
        ->andWhere("wm.Title = ?", $Title)
        ->fetchArray();

        return $asResult;
    }

    /**
     * Function to get Max Order at add/edit time of footer menutype
     *
     * @param integer $webId
     */
    public static function maxFooterMenuOrder($WebsiteId)
    {
        if(!is_numeric($WebsiteId))
        return false;

        $maxOrder =	Doctrine_Query::create()
        ->select("MAX(w.Ordering)")
        ->from('WebsiteMenu w')
        ->where('w.WebsiteId = ?', $WebsiteId)
        ->andWhere("w.MenuType = ?", sfConfig::get("app_MenuType_Footer"))
        ->fetchArray();

        return $maxOrder[0]["MAX"];
    }

    /**
     * Function to check practice area or cms page exist in menu table or not
     *
     * @param integer 	$webId
     * @param string	  	$field
     * @param integer 	$id
     */
    public static function checkPracticeOrCmsExist($webId, $field, $id)
    {
        $asResult = Doctrine_Query::create()
        ->select("wm.*")
        ->from('WebsiteMenu wm')
        ->where("wm.WebsiteId = ?", $webId)
        ->andWhere("wm.".$field." = ?",$id)
        ->fetchArray();

        if(count($asResult) > 0)
        return false;
        else
        return true;
    } // End of Function


    /**
     * This function will retunr Max Odering of  Menu 
     *
     * @param unknown_type $WebsiteId
     * @return unknown
     */
    public static function MenuMaxOrder($WebsiteId , $menuType)
    {
        if(!is_numeric($WebsiteId))
        return false;

        $maxOrder =	Doctrine_Query::create()
        ->select("MAX(wm.Ordering) as max")
        ->from('WebsiteMenu wm')
        ->where('wm.WebsiteId = ?', $WebsiteId)
        ->andWhere('wm.MenuType = ?', $menuType)
        ->fetchArray();

        if(empty($maxOrder[0]["max"]) &&  $maxOrder[0]["max"] == '') {
            return 0;
        }else {
            return ( ($maxOrder[0]["max"] + 1) );
        }
    } // End of Function


    /**
     * Function to check whether Menu for Website Exist or not
     *
     * @param unknown_type $websiteId
     */
    public static function checkMenuExist($websiteId, $menuType){


        $sql = Doctrine_Query::create()
        ->from('WebsiteMenu wm')
        ->where('wm.WebsiteId = ?', $websiteId)
        ->andWhere('wm.MenuType = ?', $menuType);

        $menuCount = $sql->count();
        if($menuCount > 0)
        return true;
        else
        return false;
    } // End of Function


}