<?php

/**
 * PermissionsTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PermissionsTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PermissionsTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Permissions');
    }

    /**
     *  THIS FUNCTION IS USE TO GIVE THE PERMISSION LIST ON THE BASIS OF PERMISSION TABLE.
     *
     * @return ARRAY()
     */
    public static function getPermissionsList()
    {
        $sql = Doctrine_Query::create()
        ->from('Permissions pr')
        ->orderBy('pr.UniqueKey ASC')
        ->execute(array(),Doctrine_Core::HYDRATE_ARRAY );
        $arrListReturn = array();
        for ($i = 0; $i<count($sql); $i++)
        {
            $arrListReturn[$sql[$i]['Id']] = $sql[$i]['UniqueKey'];
        }
        return $arrListReturn;
    }
    
    /**
     * THIS FUNCTION IS FOR GIVE THE COUNT OF ALL PERMISSION.
     *
     * @return unknown
     */
    public static function getAllRecord()
    {
        $sql = Doctrine_Query::create()
        ->from('Permissions pr')
        ->execute(array(),Doctrine_Core::HYDRATE_ARRAY );
        return count($sql);
    }
}