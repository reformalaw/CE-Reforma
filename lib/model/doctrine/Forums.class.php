<?php

/**
 * Forums
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    counceledge
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Forums extends BaseForums
{
	public function __toString()
	{
		  return $this->getTitle();
	}
  
	public function ForumListing()
	{
	  $result = Doctrine_Query::create()
					  ->select('f.*,fc.*')
					  ->from('Forums f')
					  ->leftJoin("f.ForumsForumCategories fc")
					  ->where('f.Status != ?',"Deleted")
					  ->orderBy("f.Ordering");

		  return $result;
	}

	public function changeForumStatus($snId,$ssStatus)
	{

	  if(!is_numeric($snId) || $snId == '' || $ssStatus == '')
		return false;

		Doctrine_Query::create()
		->update('Forums')
		->set('Status', '?', $ssStatus)
		->where('id = ?', $snId)
		->execute();

		return true;
	}
  
	public function viewForumsQuery($snId)
	{
	  $saRecord = Doctrine_Query::create()
					  ->select('fc.*,f.*')
					  ->from('Forums f')
					  ->leftJoin('f.ForumsForumCategories fc')
					  ->where('f.Id = ?',$snId)
					  ->fetchArray();

	  return $saRecord;
					  

	}
	
	public function maxForumOrder()
	{
		$maxOrder =	Doctrine_Query::create()
					  ->select("MAX(f.Ordering)")
					  ->from('Forums f')
					  ->fetchArray();

		return $maxOrder[0]["MAX"];
	}
	
	/**
     * function is get the max ordering by category id
     *
     * @return numeric
     */
	public function maxForumOrderByCategories($categoryId)
	{
		$maxOrder =	Doctrine_Query::create()
					  ->select("MAX(f.Ordering)")
					  ->from('Forums f')
					  ->where('f.ForumCategoriesId = ?', $categoryId)
					  ->fetchArray();

		if(count($maxOrder) <= 0)
			return 0;

		return $maxOrder[0]["MAX"];
	}
	public function updateForumOrdrAtDelete($orderNumber)
	{
	  if(!is_numeric($orderNumber))
		 return false;
		  
	  $sql = Doctrine_Query::create()
			  ->update('Forums f')
			  ->set('f.Ordering',  ('f.Ordering -1 '))
			  ->where('f.Ordering > ?',$orderNumber)
			  ->execute();

		return true;
	}

	/* this function is made for updating the order of Forums*/
	public function updateForumOrdering($snId,$snOrder)
	{
	  if(!is_numeric($snId) || !is_numeric($snOrder))
		return false;

		Doctrine_Query::create()
			  ->update('Forums')
			  ->set('Ordering', '?', $snOrder)
			  ->where('id = ?', $snId)
			  ->execute();
	}
	
	/**
     * function is for update forums data
     *
     * @return boolean
     */
	public function updateForumsData($topicId, $lastTopicUser, $forumsId)
	{
		if(!is_numeric($topicId) || !is_numeric($lastTopicUser) || !is_numeric($forumsId))
			return false;

		$sql = Doctrine_Query::create()
        ->update('Forums F')
        ->set('F.LastTopicId', $topicId)
        ->set('F.LastTopicBy', $lastTopicUser)
        ->set('F.TotalTopic', ('F.TotalTopic + 1'))
        ->where('F.Id = ?', $forumsId)
        ->execute();

        return true;
	}
	
	/**
     * function to delete topic at that thime set the data
     *
     * @return boolean
     */
	public function deleteTimeUpdateForumsData($topicId, $lastTopicUser, $forumsId)
	{
		if(!is_numeric($topicId) || !is_numeric($lastTopicUser) || !is_numeric($forumsId))
			return false;

		$sql = Doctrine_Query::create()
        ->update('Forums F')
        ->set('F.LastTopicId', $topicId)
        ->set('F.LastTopicBy', $lastTopicUser)
        ->set('F.TotalTopic', ('F.TotalTopic - 1'))
        ->where('F.Id = ?', $forumsId)
        ->execute();

        return true;
	}
	
	/**
     * function is for update forums reply data
     *
     * @return boolean
     */
	public function updateReplyForumsData($replyId, $lastReplyUser, $forumsId)
	{
		if(!is_numeric($replyId) || !is_numeric($lastReplyUser) || !is_numeric($forumsId))
			return false;

		$sql = Doctrine_Query::create()
        ->update('Forums F')
        ->set('F.LastRepliedId', $replyId)
        ->set('F.LastRepliedBy', $lastReplyUser)
        ->set('F.TotalReplies', ('F.TotalReplies + 1'))
        ->where('F.Id = ?', $forumsId)
        ->execute();

        return true;
	}
	
	/**
     * function is for update forums reply data at delete time
     *
     * @return boolean
     */
	public function deleteTimeUpdateReplyForumsData($replyId, $lastReplyUser, $forumsId)
	{
		if(!is_numeric($replyId) || !is_numeric($lastReplyUser) || !is_numeric($forumsId))
			return false;

		$sql = Doctrine_Query::create()
        ->update('Forums F')
        ->set('F.LastRepliedId', $replyId)
        ->set('F.LastRepliedBy', $lastReplyUser)
        ->set('F.TotalReplies', ('F.TotalReplies - 1'))
        ->where('F.Id = ?', $forumsId)
        ->execute();

        return true;
	}
}