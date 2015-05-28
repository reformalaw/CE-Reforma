<?php

/**
 * forums actions.
 *
 * @package    counceledge
 * @subpackage forums
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class forumsActions extends sfActions
{
	/**
	 * Function is for listing of Categories and Forums
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		$this->orderBy = "";
        $this->orderType="";
        $this->searchBy = "";

		$qSearch = Doctrine_Query::create();
		$qSearch->from('ForumCategories F');
		$qSearch->leftJoin('F.ForumCategoriesForums FC');
		$qSearch->where('FC.Status = ?', sfConfig::get("app_Forums_Active"));
		$qSearch->andWhere("F.Status = ?", sfConfig::get("app_Forums_Active"));
		$this->form = new SearchForumForm();

			if($request->isMethod(sfRequest::POST )) {
				$form = new SearchForumForm();
				$tableField = $request->getParameter($form->getName());
				if($tableField["searchforum"] != "")
				{
					$this->searchBy = $tableField["searchforum"];
					$qSearch->andWhere('FC.Title LIKE ? ', '%'.$tableField["searchforum"].'%' );
				}
			}
			else
			{
				if($request->getParameter('searchBy') != '')
				{
					$searchBy = $this->searchBy = $request->getParameter('searchBy');
					$qSearch->andWhere('FC.Title LIKE ? ', '%'.$searchBy.'%' );
				}
				
			}

		$qSearch->orderBy("FC.Ordering");
		$pager = new sfDoctrinePager('ForumCategories', sfConfig::get("app_no_of_records_per_page"));
		$pager->setQuery($qSearch);
		$pager->setPage($request->getParameter('page', 1));
		$pager->init();
		$this->pager = $pager;
	}
	
	/**
	 * Function is for listing of forums topic
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeTopicList(sfWebRequest $request)
	{
		if($request->hasParameter("forumsId"))
		{
			if($request->getParameter("forumsId") != "")
			{
				$this->forumsId = $forumsId = $request->getParameter("forumsId");
				$this->orderBy = "";
				$this->orderType = "";
				$this->searchBy = "";

				$objectForums = Doctrine::getTable('Forums')->find(array($forumsId));
				$this->forumsTitle = $objectForums->getTitle();
				
				$qSearch = Doctrine_Query::create();
				$qSearch->from('ForumTopics FT');
				$qSearch->where("FT.ForumId = ?", $forumsId);
				$qSearch->andWhere("FT.Status = ?", sfConfig::get("app_Forums_Active"));
				
				$this->form = new TopicSearchForm();
				if($request->isMethod(sfRequest::POST )) {
					$form = new TopicSearchForm();
					$tableField = $request->getParameter($form->getName());
					if($tableField["searchtopic"] != "" && $tableField["topicAttribute"] != "")
					{
						$this->searchBy = $tableField["searchtopic"];
						$qSearch->andWhere('FT.Topic LIKE ? ', '%'.$tableField["searchtopic"].'%' );

						$this->orderBy = $tableField["topicAttribute"];
						if("CreateDateTime" == $tableField["topicAttribute"])
							$orderType = $this->orderType= "Asc";
						else
							$orderType = $this->orderType= "Desc";

						$qSearch->orderBy("FT.".$tableField["topicAttribute"]." ".$orderType);
						
					}
					elseif($tableField["topicAttribute"] != "")
					{
						$this->orderBy = $tableField["topicAttribute"];
						if("CreateDateTime" == $tableField["topicAttribute"])
							$orderType = $this->orderType= "Asc";
						else
							$orderType = $this->orderType= "Desc";

						$qSearch->orderBy("FT.".$tableField["topicAttribute"]." ".$orderType);
					}
					elseif($tableField["searchtopic"] != "")
					{
						$this->searchBy = $tableField["searchtopic"];
						$qSearch->andWhere('FT.Topic LIKE ? ', '%'.$tableField["searchtopic"].'%' );
					}
					
				}
				else
				{
					if($request->getParameter('orderBy') != '' && $request->getParameter('orderType') != '' && $request->getParameter('searchBy'))
					{
						$searchBy = $this->searchBy = $request->getParameter('searchBy');
						$qSearch->andWhere('FT.Topic LIKE ? ', '%'.$searchBy.'%' );
					
						$orderBy = $this->orderBy = $request->getParameter('orderBy');
						$orderType = $this->orderType= $request->getParameter('orderType');
						$qSearch->orderBy("FT.".$orderBy." ".$orderType);
					}
					elseif($request->getParameter('orderBy') != '' && $request->getParameter('orderType') != '')
					{
						$orderBy = $this->orderBy = $request->getParameter('orderBy');
						$orderType = $this->orderType= $request->getParameter('orderType');
						$qSearch->orderBy("FT.".$orderBy." ".$orderType);
					}
					elseif($request->getParameter('searchBy'))
					{
						$searchBy = $this->searchBy = $request->getParameter('searchBy');
						$qSearch->andWhere('FT.Topic LIKE ? ', '%'.$searchBy.'%' );
					}
					
				}
				
				if($this->orderBy == '')
					$qSearch->orderBy("FT.Id Desc");

				$pager = new sfDoctrinePager('ForumTopics', sfConfig::get("app_no_of_records_per_page"));
				$pager->setQuery($qSearch);
				$pager->setPage($request->getParameter('page', 1));
				$pager->init();
				$this->pager = $pager;
			}
			else
				$this->redirect("forums/index");
		}
		else
			$this->redirect("forums/index");
	}
	
	/**
     * Function to create new topic
     *
     * @param sfWebRequest $request
     */
	public function executeNewTopic(sfWebRequest $request)
	{
		$this->forumsId = "";
		if($request->hasParameter("forumsId"))
			$this->forumsId = $request->getParameter("forumsId");

		$this->form = new LGForumTopicsForm();
		$this->setLayout("popup");
	}

	/**
     * Function to create topic
     *
     * @param sfWebRequest $request
     */
	public function executeCreateTopic(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new LGForumTopicsForm();
        $this->forumsId = $request->getPostParameter("LGForumId");
        $this->processTopicForm($request, $this->form, $this->forumsId);
        $this->setTemplate('newTopic');
    }

    /**
     * Function to Topic Process
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     */
    public function processTopicForm(sfWebRequest $request, sfForm $form, $forumsId="")
    {

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
			$userId = $this->getUser()->getAttribute('user_user_id');
            $form->getObject()->setUserId($userId);
            $form->getObject()->setForumId($forumsId);
            $forumTopic = $form->save();

            $this->getUser()->setFlash('succMsg', "Topic posted successfully");

            $objectForums = new Forums();
			$objectForums->updateForumsData($forumTopic->getId(), $userId, $forumsId);
			
            $this->redirect('forums/newTopic');

        }
    }

    /**
     * Function to replay list 
     *
     * @param sfWebRequest $request
     */
	public function executeReplyList(sfWebRequest $request)
	{
		if($request->hasParameter("topicId"))
		{
			if($request->getParameter("topicId") != "")
			{
				// Insert Total View in forumTopic table
				$objectForumTopics = new ForumTopics();
				$objectForumTopics->updateMostView($request->getParameter("topicId"));

				$this->forumsId = $request->getParameter('forumsId');
				$this->objectForums = Doctrine::getTable('Forums')->find(array($this->forumsId));
				
				/* to get the site url */
				$oSiteConfig = Doctrine::getTable('SiteConfig')->findByConfigKey("SITE_URL");
				$asSiteUrl = $oSiteConfig->toArray();
				$this->ssSiteUrl = $asSiteUrl[0]["ConfigValue"];
				/* End the site url path */

				$this->topicId = $topicId = $request->getParameter("topicId");
				$this->orderBy = "";
				$this->orderType="";

				$objectForumsTopic = Doctrine::getTable('ForumTopics')->find(array($topicId));
				$this->objectForumsTopic = $objectForumsTopic;
				$this->forumsTopic = $objectForumsTopic->getTopic();
				
				$qSearch = Doctrine_Query::create();
				$qSearch->select("FR.*,FU.*");
				$qSearch->from('ForumReply FR');
				$qSearch->leftJoin("FR.ForumReplyUsers FU");
				$qSearch->where("FR.TopicId = ?", $topicId);
				$qSearch->andWhere("FR.Status = ?", sfConfig::get("app_Forums_Active"));
				$qSearch->orderBy("FR.CreateDateTime Desc");
				
				$pager = new sfDoctrinePager('ForumReply', sfConfig::get("app_no_of_records_per_page"));
				$pager->setQuery($qSearch);
				$pager->setPage($request->getParameter('page', 1));
				$pager->init();
				$this->pager = $pager;
			}
			else
				$this->redirect("forums/topicList?forumsId=".$request->getParameter('forumsId'));
		}
		else
			$this->redirect("forums/topicList?forumsId=".$request->getParameter('forumsId'));
	}
	
	/**
     * Function to add new reply
     *
     * @param sfWebRequest $request
     */
	public function executeNewReply(sfWebRequest $request)
	{
		$forumsId = $this->forumsId = $request->getParameter("forumsId");
		$topicId  = $this->topicId  = $request->getParameter("topicId");
	
		$this->setLayout("popup");

		$this->forumTitle = "";
		if($request->hasParameter('forumsId'))
		{
			if($request->getParameter('forumsId') != "")
			{
				$objectTopic  = Doctrine::getTable('ForumTopics')->find(array($topicId));
				$this->forumTitle = $objectTopic->getTopic();
			}
		}
			
		$this->forumTopic = "";
		if($request->hasParameter('topicId'))
		{
			if($request->getParameter('topicId') != "")
			{
				$objectForums = Doctrine::getTable('Forums')->find(array($forumsId));
				$this->forumTopic = $objectForums->getTitle();
			}
		}

		$this->form = new ForumReplyForm();
	}
	
	/**
     * Function to create reply
     *
     * @param sfWebRequest $request
     */
	public function executeCreateReply(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new ForumReplyForm();
        $this->forumsId = $request->getPostParameter("LGForumId");
        $this->topidId = $request->getPostParameter("LGTopicId");
        $this->processReplyForums($request, $this->form, $this->forumsId, $this->topidId);
        $this->setTemplate('newReply');
	}
	
	/**
     * Function to Process Form at add time
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     */
	protected function processReplyForums(sfWebRequest $request, sfForm $form, $forumsId, $topicId)
	{
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid())
		{
			$userId = $this->getUser()->getAttribute('user_user_id');
			$form->getObject()->setForumId($forumsId);
			$form->getObject()->setTopicId($topicId);
			$form->getObject()->setUserId($userId);
			$forumReply = $form->save();
			$this->getUser()->setFlash('succMsg', "Reply posted successfully");

			// update data of forums replay in forum table
			$objectForums = new Forums();
			$objectForums->updateReplyForumsData($forumReply->getId(), $userId, $forumsId);

			// update data of forums replay in forumsTopic table
			$objectForumTopics = new ForumTopics();
			$objectForumTopics->updateTopicReplyData($forumReply->getId(), $userId, $topicId, $forumReply->getCreateDateTime()); //, $forumReply->getCreateDateTime()
			
			$this->redirect('forums/newReply');
		}
	}
}