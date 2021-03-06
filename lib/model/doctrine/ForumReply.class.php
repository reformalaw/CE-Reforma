<?php

/**
 * ForumReply
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    counceledge
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class ForumReply extends BaseForumReply
{
	public function replayListing()
	{
	  $result = Doctrine_Query::create()
					  ->select('fr.*')
					  ->from('ForumReply fr')
					  ->leftJoin("fr.ForumReplyForums frf")
					  ->leftJoin("fr.ForumReplyForumTopics frt");
					  //->where('fr.Status != ?',sfConfig::get('app_Status_Deleted'));

		  return $result;
	}
	
	public function changeReplayStatus($snId,$ssStatus)
	{
	  if(!is_numeric($snId) || $snId == '' || $ssStatus == '')
		return false;

		Doctrine_Query::create()
		->update('ForumReply')
		->set('Status', '?', $ssStatus)
		->where('id = ?', $snId)
		->execute();

		return true;
	}
	
	public function viewForumsReplayQuery($snId)
	{
		if(!is_numeric($snId))
			return false;

		$saRecord = Doctrine_Query::create()
					  ->select('fr.*,frf.*,frt.*,fru.*')
					  ->from('ForumReply fr')
					  ->leftJoin("fr.ForumReplyForums frf")
					  ->leftJoin("fr.ForumReplyForumTopics frt")
					  ->leftJoin("fr.ForumReplyUsers fru")
					  ->where('fr.Id = ?',$snId)
					  ->fetchArray();

		return $saRecord;
	}
}