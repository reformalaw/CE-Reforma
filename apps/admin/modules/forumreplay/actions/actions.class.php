<?php

/**
 * forumreplay actions.
 *
 * @package    counceledge
 * @subpackage forumreplay
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class forumreplayActions extends sfActions
{
    /**
    * HERE IN THIS FUNCTION WE ARE CHECKING THAT USER IS NOT ADMIN AND PERMISSION CHECK IS FALSE
    * THE REDIRECT TO THE NOT AUTHENTICATED PAGE.
    */
    public function preExecute()
    {
         if (clsCommon::permissionCheck($this->getModuleName()."/".$this->getActionName()) == false){
            $this->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
            $this->redirect('default/index');
        }  
    }
        
	/**
     * Function to listing of ForumsReply
     *
     * @param sfWebRequest $request
     */
	public function executeIndex(sfWebRequest $request)
	{
		$this->orderBy = "";
		$this->orderType="";
		$where = "";
		
		
		$oForumReply = new ForumReply();
		$qSearch = $oForumReply->replayListing();
		$qSearch->orderBy("Id desc");

		if($request->hasParameter("flagTopicId"))
			if($request->getParameter('flagTopicId'))
			{
				$this->flagTopicId = $flagTopicId = $request->getParameter('flagTopicId');
					$qSearch->andWhere("fr.TopicId = ?", $flagTopicId);
			}

		$qSearch->andWhere('fr.Status != ?',sfConfig::get('app_Status_Deleted'));

// 		switch($request->getParameter('orderBy'))
// 		{
// 		case "CreateDateTime":
// 			$orderBy = 'CreateDateTime';
// 			$this->orderBy = "CreateDateTime";
// 			break;
// 		case "Reply":
// 			$orderBy = 'Reply';
// 			$this->orderBy = "Reply";
// 			break;
// 		default:
// 			$orderBy = 'Id';
// 			$this->orderBy = "Id";
// 			break;
// 		}
// 
// 		switch($request->getParameter('orderType'))
// 		{
// 		case "asc":
// 			$qSearch->orderBy("$orderBy asc");
// 			$this->orderType = "asc";
// 			break;
// 		case "desc":
// 		default:        
// 			$qSearch->orderBy("$orderBy desc");
// 			$this->orderType = "desc";
// 			break;
// 		}
		
		$pager = new sfDoctrinePager('forumreplay', sfConfig::get('app_no_of_records_per_page'));
		$pager->setQuery($qSearch);
		$pager->setPage($request->getParameter('page', 1));
		$pager->init();
		$this->pager = $pager;

		//$this->pager = $qSearch->execute(); 
	}
	
	/**
     * Function to New Reply
     *
     * @param sfWebRequest $request
     */
	public function executeNew(sfWebRequest $request)
	{
		$this->form = new ForumReplyForm();
	}

	/**
     * Function to Create ForumsReply
     *
     * @param sfWebRequest $request
     */
	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new ForumReplyForm();
		$this->processForm($request, $this->form);

		$this->setTemplate('new');
	}

	/**
     * Function to Edit ForumReply
     *
     * @param sfWebRequest $request
     */
	public function executeEdit(sfWebRequest $request)
	{
		$this->flagTopicId = "";
		if($request->hasParameter('flagTopicId'))
			if($request->getParameter('flagTopicId'))
				$this->flagTopicId = $request->getParameter('flagTopicId');
				
		$this->forward404Unless($forum_reply = Doctrine::getTable('ForumReply')->find(array($request->getParameter('id'))), sprintf('Object forum_reply does not exist (%s).', $request->getParameter('id')));

		$this->forumTitle = $forum_reply->getForumReplyForums()->getTitle();
		$this->forumTopic = $forum_reply->getForumReplyForumTopics()->getTopic();
		
		$this->form = new ForumReplyForm($forum_reply);
	}

	/**
     * Function to Update  ForumsReply
     *
     * @param sfWebRequest $request
     */
	public function executeUpdate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($forum_reply = Doctrine::getTable('ForumReply')->find(array($request->getParameter('id'))), sprintf('Object forum_reply does not exist (%s).', $request->getParameter('id')));
		
		$this->forumTitle = $forum_reply->getForumReplyForums()->getTitle();
		$this->forumTopic = $forum_reply->getForumReplyForumTopics()->getTopic();
		
		$this->form = new ForumReplyForm($forum_reply);

		$flagTopicId = '';
		if($request->hasParameter('flagTopicId'))
			if($request->getParameter('flagTopicId'))
				$flagTopicId = $request->getParameter('flagTopicId');
			
		$this->processForm($request, $this->form, $flagTopicId);

		$this->setTemplate('edit');
	}

	/**
     * Function to Delete  ForumsReply
     *
     * @param sfWebRequest $request
     */
	public function executeDelete(sfWebRequest $request)
	{
		$this->forward404Unless($forum_reply = Doctrine::getTable('ForumReply')->find(array($request->getParameter('id'))), sprintf('Object forum_reply does not exist (%s).', $request->getParameter('id')));
		$oForumTopics = new ForumReply();
		$oForumTopics->changeReplayStatus($request->getParameter('id'), sfConfig::get("app_Status_Deleted"));
		$this->getUser()->setFlash('errMsg', "Deletion successful.");

		$forumsReplayData = ForumReplyTable::getLastReplyOfForums($forum_reply->getForumId(), $forum_reply->getTopicId());

		$replyId  = ($forumsReplayData[0]["Id"]) 		? $forumsReplayData[0]["Id"] 		: 0;
		$userId   = ($forumsReplayData[0]["UserId"])  	? $forumsReplayData[0]["UserId"]  	: 0;
		$forumsId = ($forum_reply->getForumId()) 		? $forum_reply->getForumId() 	    	: 0;
		$lastReplayDateTime = ($forumsReplayData[0]["CreateDateTime"]) ? $forumsReplayData[0]["CreateDateTime"] : '0000-00-00 00:00:00';
		//$topicId  = ($forumsReplayData[0]["TopicId"]) 	? $forumsReplayData[0]["TopicId"] 	: 0;
		$topicId  = ($forum_reply->getTopicId()) 	? $forum_reply->getTopicId() 	: 0;

		$objectForumTopics = new ForumTopics();
		$objectForumTopics->DeleteTimeUpdateTopicReplyData($replyId, $userId, $topicId, $lastReplayDateTime); //, $lastReplayDateTime

		$objectForums = new Forums();
		$objectForums->deleteTimeUpdateReplyForumsData($replyId, $userId, $forumsId);
		
		if($request->hasParameter('flagTopicId'))
			if($request->getParameter('flagTopicId'))
				$this->redirect('forumreplay/index?flagTopicId='.$request->getParameter('flagTopicId'));

		$this->redirect('forumreplay/index');
	}

	/**
     * Function to Process Form at add ,edit time
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     */
	protected function processForm(sfWebRequest $request, sfForm $form, $flagTopicId)
	{
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid())
		{
			$forum_reply = $form->save();
			
			if($request->isMethod(sfRequest::PUT))
				$this->getUser()->setFlash('succMsg', "Update successful.");
			else 
				$this->getUser()->setFlash('succMsg', "New forum reply added successfully.");

			if($flagTopicId != "")
				$this->redirect('forumreplay/index?flagTopicId='.$flagTopicId);

			$this->redirect('forumreplay/index');

		}
	}

	/**
     * Function to Change Status
     *
     * @param sfWebRequest $request
     */
	public function executeChangeReplayStatus(sfWebRequest $request)
	{
		$snId 		= 	$request->getParameter('id');
		$ssStatus 	= 	$request->getParameter('status');
		$oForumTopics = new ForumReply();
		$oForumTopics->changeReplayStatus($snId,$ssStatus);

		if($ssStatus == sfConfig::get("app_Status_Active")){
			$successMessage = "activated";
			$msgStatus = "succMsg";
		}
		else{
			$successMessage = "inactivated";
			$msgStatus = "errMsg";
		}

		$this->getUser()->setFlash($msgStatus,'Status successfully changed to '.$successMessage.'.');

		if($request->hasParameter('flagTopicId'))
			if($request->getParameter('flagTopicId'))
				$this->redirect('forumreplay/index?flagTopicId='.$request->getParameter('flagTopicId'));
			

		$this->redirect('forumreplay/index');
	}
	
	/**
     * Function to View
     *
     * @param sfWebRequest $request
     */
	public function executeReplayView(sfWebRequest $request)
	{
		$oForumTopics = new ForumReply();
		$asRecord = $oForumTopics->viewForumsReplayQuery($request->getParameter('id'));

		$this->form = $asRecord;
	}
}
