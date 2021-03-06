<?php

/**
 * ForumTopicsTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ForumTopicsTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ForumTopicsTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('ForumTopics');
    }

    /**
     * Returns after deleted topic another last topic
     *
     * @return array
     */
    public static function getLastTopicOfForums($forumsId)
    {
		$sql = Doctrine_Query::create()
				->from('ForumTopics F')
				->where("F.ForumId = ?",$forumsId)
				->andWhere("F.Status = ?","Active")
				->orderBy("F.Id Desc")
				->limit(1)
				->fetchArray();

		return $sql;
    }
}