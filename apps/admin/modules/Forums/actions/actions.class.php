
<?php

/**
 * Forums actions.
 *
 * @package    counceledge
 * @subpackage Forums
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ForumsActions extends sfActions
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
     * Function to ForumCategories Listing
     *
     * @param sfWebRequest $request
     */
    public function executeIndex(sfWebRequest $request)
    {
        // 		$this->orderBy = "";
        // 		$this->orderType="";
        // 		$where = "";

        $oForumCategories = new ForumCategories();
        $qSearch = $oForumCategories->categoriesListing();

        switch($request->getParameter('orderBy'))
        {
            case "CreateDateTime":
                $orderBy = "CreateDateTime";
                $this->orderBy = "CreateDateTime";
                break;
            case "Title":
                $orderBy = "Title";
                $this->orderBy = "Title";
                break;
            default:
                $orderBy = 'Id';
                $this->orderBy = "Id";
                break;

        }

        switch($request->getParameter('orderType'))
        {
            case "asc":
                $qSearch->orderBy("$orderBy asc");
                $this->orderType = "asc";
                break;
            case "desc":
            default:
                $qSearch->orderBy("$orderBy desc");
                $this->orderType = "desc";
                break;
        }

        $pager = new sfDoctrinePager('ForumCategories', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;

        //$this->pager = $qSearch->execute();
    }


    /**
     * Function to ForumCategories New
     *
     * @param sfWebRequest $request
     */
    public function executeNew(sfWebRequest $request)
    {
        $this->form = new ForumCategoriesForm();
    }

    /**
     * Function to ForumCategories Create
     *
     * @param sfWebRequest $request
     */
    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new ForumCategoriesForm();
        $this->processForm($request, $this->form,"ForumCategories");
        $this->setTemplate('new');
    }

    /**
     * Function to ForumCategories Edit
     *
     * @param sfWebRequest $request
     */
    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($forum_categories = Doctrine::getTable('ForumCategories')->find(array($request->getParameter('id'))), sprintf('Object forum_categories does not exist (%s).', $request->getParameter('id')));
        $this->form = new ForumCategoriesForm($forum_categories);
    }

    /**
     * Function to ForumCategories Update
     *
     * @param sfWebRequest $request
     */
    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($forum_categories = Doctrine::getTable('ForumCategories')->find(array($request->getParameter('id'))), sprintf('Object forum_categories does not exist (%s).', $request->getParameter('id')));
        $this->form = new ForumCategoriesForm($forum_categories);

        $this->processForm($request, $this->form,"ForumCategories");

        $this->setTemplate('edit');
    }

    /**
     * Function to ForumCategories View
     *
     * @param sfWebRequest $request
     */
    public function executeView(sfWebRequest $request)
    {
        $oForumCategories = new ForumCategories();
        $asResult = $oForumCategories->viewForumCategoryQuery($request->getParameter('id'));
        $this->form = $asResult;
    }

    /**
     * Function to ForumCategories Delete
     *
     * @param sfWebRequest $request
     */
    public function executeDelete(sfWebRequest $request)
    {
        $this->forward404Unless($forum_categories = Doctrine::getTable('ForumCategories')->find(array($request->getParameter('id'))), sprintf('Object forum_categories does not exist (%s).', $request->getParameter('id')));

        $oForumCategories = new ForumCategories();
        $oForumCategories->changeStatus($request->getParameter('id'),"Deleted");
        $this->getUser()->setFlash('errMsg', "Deletion successful.");
        $this->redirect('Forums/index');
    }


    /**
     * Function to ForumCategories Change Status
     *
     * @param sfWebRequest $request
     */
    public function executeChangeStatus(sfWebRequest $request)
    {
        $snId 		= 	$request->getParameter('id');
        $ssStatus 	= 	$request->getParameter('status');
        $oForumCategories = new ForumCategories();
        $oForumCategories->changeStatus($snId,$ssStatus);

        if($ssStatus == sfConfig::get("app_Status_Active")){
            $successMessage = "activated";
            $msgStatus = "succMsg";
        }
        else{
            $successMessage = "inactivated";
            $msgStatus = "errMsg";
        }

        $this->getUser()->setFlash($msgStatus,'Status successfully changed to '.$successMessage.'.');

        $this->redirect('Forums/index');
    }

    /**
     * Function to ForumCategories && Forums To Process
     *
     * @param sfWebRequest $request
     */
    protected function processForm(sfWebRequest $request, sfForm $form,$keyToRedirect, $flagCategoryId ='')
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $data = $request->getParameter($form->getName());
        if ($form->isValid())
        {
            if($keyToRedirect == "Forums")
            {
                $oForums = new Forums();
                $order = $oForums->maxForumOrderByCategories($data["ForumCategoriesId"]);
                $form->getObject()->setOrdering(($order+1));
                $form->getObject()->setLastTopicBy( $this->getUser()->getAttribute('admin_user_id'));
            }

            $forum_categories = $form->save();


            if($keyToRedirect == "ForumCategories")
            {
                if($request->isMethod(sfRequest::PUT))
                $this->getUser()->setFlash('succMsg', "Update successful.");
                else
                $this->getUser()->setFlash('succMsg', "New category added successfully.");

                $this->redirect('Forums/index');
            }
            elseif($keyToRedirect == "Forums")
            {
                if($request->isMethod(sfRequest::PUT)){
                    $this->getUser()->setFlash('succMsg', "Update successful.");
                    $this->getUser()->setFlash('succmessages');
                }else{
                    $this->getUser()->setFlash('succMsg', "New forum added successfully.");
                }

                if($flagCategoryId != '')
					$this->redirect('Forums/forumsList?flagCategoryId='.$flagCategoryId);
                else
					$this->redirect('Forums/forumsList');
            }
            //$this->redirect('Forums/edit?id='.$forum_categories->getId());
        }
    }

    /**
     * Function to Forums Listing
     *
     * @param sfWebRequest $request
     */
    public function executeForumsList(sfWebRequest $request)
    {
        $this->orderBy = "";
        $this->orderType="";
        $where = "";

        $qSearch = Doctrine_Query::create();
		$qSearch->from('ForumCategories FC');
		$qSearch->leftJoin('FC.ForumCategoriesForums FCF');
		$qSearch->where('FCF.Status != ?', "Deleted");
		$qSearch->andWhere("FC.Status = ?", "Active");

		$qSearch->orderBy("FC.Id Desc");
		$qSearch->orderBy("FCF.Ordering");
		
		if($request->hasParameter('flagCategoryId'))
			if($request->getParameter('flagCategoryId'))
			{
				$this->flagCategoryId = $flagCategoryId = $request->getParameter('flagCategoryId');
				$qSearch->andWhere("FCF.ForumCategoriesId = ?", $flagCategoryId);
			}

//         $oForums = new Forums();
//         $qSearch = $oForums->ForumListing();

        $this->pager = $qSearch->execute();
    }


    /**
     * Function to Forums New
     *
     * @param sfWebRequest $request
     */
    public function executeForumsNew(sfWebRequest $request)
    {
        $this->form = new ForumsForm();

        $this->flagCategoryId = '';
        if($request->hasParameter('flagCategoryId'))
			if($request->getParameter('flagCategoryId'))
				$this->flagCategoryId = $request->getParameter('flagCategoryId');
    }

    /**
     * Function to Forums Create
     *
     * @param sfWebRequest $request
     */
    public function executeForumsCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new ForumsForm();

        $flagCategoryId = '';
        $flagCategoryId = $request->getPostParameter('flagCategoryId');
		$this->flagCategoryId = $flagCategoryId;
		
        $this->processForm($request, $this->form,"Forums", $flagCategoryId);

        $this->setTemplate('forumsNew');
    }


    /**
     * Function to Forums Delete
     *
     * @param sfWebRequest $request
     */
    public function executeForumDelete(sfWebRequest $request)
    {

        $this->forward404Unless($forums = Doctrine::getTable('Forums')->find(array($request->getParameter('id'))), sprintf('Object forum_categories does not exist (%s).', $request->getParameter('id')));
        $asData = $forums->toArray();

        /* this is for maintain order at delete time */
        $oForums = new Forums();
        $oForums->updateForumOrdrAtDelete($asData["Ordering"]);

        /* this is for set -1 ordring when delete */
        $oForums = new Forums();
        $oForums->updateForumOrdering($asData["Id"],-1);

        /* this is for change status to delete */
        $oForums = new Forums();
        $oForums->changeForumStatus($request->getParameter('id'),"Deleted");

        $this->getUser()->setFlash('errMsg', "Deletion successful.");

        if($request->hasParameter('flagCategoryId'))
			if($request->getParameter('flagCategoryId'))
				$this->redirect('Forums/forumsList?flagCategoryId='.$request->getParameter('flagCategoryId'));

        $this->redirect('Forums/forumsList');
    }

    /**
     * Function to Forums Change Status
     *
     * @param sfWebRequest $request
     */
    public function executeChangeForumStatus(sfWebRequest $request)
    {
        $snId 		= 	$request->getParameter('id');
        $ssStatus 	= 	$request->getParameter('status');
        $oForums = new Forums();
        $oForums->changeForumStatus($snId,$ssStatus);

        if($ssStatus == sfConfig::get("app_Status_Active")){
            $successMessage = "activated";
            $msgMsg = "succMsg";
        }
        else{
            $successMessage = "inactivated";
            $msgMsg = "errMsg";
        }

        $this->getUser()->setFlash($msgMsg,'Status successfully changed to active.'.$successMessage.'.');

        if($request->hasParameter('flagCategoryId'))
			if($request->getParameter('flagCategoryId'))
				$this->redirect('Forums/forumsList?flagCategoryId='.$request->getParameter('flagCategoryId'));

        $this->redirect('Forums/forumsList');
    }


    /**
     * Function to Forums EditForum
     *
     * @param sfWebRequest $request
     */
    public function executeEditForum(sfWebRequest $request)
    {
        $this->forward404Unless($forum = Doctrine::getTable('Forums')->find(array($request->getParameter('id'))), sprintf('Object forum does not exist (%s).', $request->getParameter('id')));
        $this->form = new ForumsForm($forum);

        $this->flagCategoryId = '';
        if($request->hasParameter('flagCategoryId'))
			if($request->getParameter('flagCategoryId'))
				$this->flagCategoryId = $flagCategoryId = $request->getParameter('flagCategoryId');
				
    }


    /**
     * Function to Forums Update
     *
     * @param sfWebRequest $request
     */
    public function executeUpdateForum(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($forum = Doctrine::getTable('Forums')->find(array($request->getParameter('id'))), sprintf('Object forum does not exist (%s).', $request->getParameter('id')));
        $this->form = new ForumsForm($forum);

        $flagCategoryId = '';
        $flagCategoryId = $request->getPostParameter('flagCategoryId');
		$this->flagCategoryId = $flagCategoryId;


        $this->processForm($request, $this->form,"Forums", $flagCategoryId);

        $this->setTemplate('editForum');
    }

    /**
     * Function to Forums View
     *
     * @param sfWebRequest $request
     */
    public function executeForumView(sfWebRequest $request)
    {
        $oForums = new Forums();
        $asRecord = $oForums->viewForumsQuery($request->getParameter('id'));
        $this->form = $asRecord;
    }

    /**
     * Function to Forums Dynamic Form Generation
     *
     * @param sfWebRequest $request
     */
    public function executeDynamicForm(sfWebRequest $request)
    {
        $this->form = new CustomerContactForm(null, array('userId' => $this->getUser()->getAttribute('admin_user_id')));
    }

    /**
     * Function to Dynamic Form Create
     *
     * @param sfWebRequest $request
     */
    public function executeDynamicFormCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        #clsCommon::pr($_POST);

        $this->form = new CustomerContactForm(null, array('userId' => $this->getUser()->getAttribute('admin_user_id')));
        $this->processDynamicForm($request, $this->form);
        $this->setTemplate('dynamicForm');
    }

    /**
     * Function to Dynamic Process Form
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     */
    protected function processDynamicForm(sfWebRequest $request, sfForm $form)
    {
		$userId = $this->getUser()->getAttribute('admin_user_id');
        $customerDatas = CustomerContactTable::getCustomers($userId);
        $userData = Doctrine::getTable('Users')->find(array($userId));
		$WebsiteId = $this->getUser()->getAttribute('personalWebsiteId');
		$attachment = array();

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid())
        {
			$formFileData = $request->getFiles($form->getName());
			$formData = $request->getParameter($form->getName());

			$mailDatas = array();
            foreach($customerDatas as $customerData)
            {
				if($customerData["FieldType"] == "FileUpload")
				{
					$fileInfo = $formFileData["input_".$customerData["Id"]."_".$userId];
					$mailDatas[$customerData["Label"]] = $fileInfo["name"];
					$attachPath = $this->fileUploads($WebsiteId,$formFileData["input_".$customerData["Id"]."_".$userId]);
					$attachment[] = $attachPath;
				}
				else
				{
					if($customerData["FieldType"] == "CheckBox")
					{
						$checBoxValues = $formData["input_".$customerData["Id"]."_".$userId];
						$checBoxData = "";
						foreach($checBoxValues as $checBoxValue)
						{
							$checBoxData.= $checBoxValue.",";
						}
						$checBoxData = substr_replace($checBoxData ,"",-1);
						$mailDatas[$customerData["Label"]] = $checBoxData;
					}
					else
					{
						$mailDatas[$customerData["Label"]] = $formData["input_".$customerData["Id"]."_".$userId];
					}
				}
            }

            foreach($mailDatas as $key => $mailData)
            {
				$mailTable.= "<p><strong>".$key.": </strong>".$mailData."</p>";
            }

            $themeOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($WebsiteId);

            $siteOwenerInfo = array();
            $siteOwenerInfo['UserName'] = $userData->getFirstName()." ".$userData->getLastName();
            $siteOwenerInfo['UserWebsite'] = $userData->getUsersUsersWebsite()->getWebsiteurl();
            $siteOwenerInfo['UserEmail'] = $userData->getEmail();
            $siteUrl = clsCommon::getSystemConfigVars('SITE_URL');
            $siteOwenerInfo['UserLogo'] = $siteUrl.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$WebsiteId.DIRECTORY_SEPARATOR.'logo'.DIRECTORY_SEPARATOR.$themeOptions['Logo'];
            //$siteOwenerInfo['UserLogo'] = 'www.counceledge.demo.brainvire.com'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$WebsiteId.DIRECTORY_SEPARATOR.'logo'.DIRECTORY_SEPARATOR.$themeOptions['Logo'];

            //$siteOwenerInfo['UserLogo'] = $this->getRequest()->getHost().DIRECTORY_SEPARATOR."web".DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$WebsiteId.DIRECTORY_SEPARATOR.'logo'.DIRECTORY_SEPARATOR.$themeOptions['Logo'];
            $siteOwenerInfo['UserBGColor'] = $themeOptions['BGColor'];

            $objSiteMails = new siteMails();
            $objSiteMails->sendCustomerContactUsEmail($mailTable, $siteOwenerInfo,$attachment);

            if($request->isMethod(sfRequest::PUT))
            $this->getUser()->setFlash('succMsg', "Update successful.");
            else
            $this->getUser()->setFlash('succMsg', "New form added successfully.");

            foreach($attachment as $fileAttach)
            {
				$unlinkAttach = @unlink($fileAttach);
            }

            $this->redirect('Forums/topicList');
        }
    }

    /**
     * Function to upload the files
     *
     * @param integer $webId
     * @param array $file
     */
    public function fileUploads($webId,$file)
    {
		if (!empty($file['name']))
		{
			$attachmentPathExist = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR."website".DIRECTORY_SEPARATOR.$webId;
			$this->FileDirectoryExist($attachmentPathExist);
			$attachmentPath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR."website".DIRECTORY_SEPARATOR.$webId.DIRECTORY_SEPARATOR."attachments".DIRECTORY_SEPARATOR;
			$ext = explode(".",$file['name']);
			$this->docOrgName = $file['name'];
			move_uploaded_file($file['tmp_name'],$attachmentPath.$this->docOrgName); 
			return $attachmentPath.$this->docOrgName;
		}
    }

    /**
     * Function to check directory exist or not
     *
     * @param string $path
     */
    public function FileDirectoryExist($path)
    {
		if(!is_dir($path))
		{
			mkdir($path, 0777, true);
			$attachFile = $path.DIRECTORY_SEPARATOR."attachments";
			if(!is_dir($attachFile))
			{
				mkdir($attachFile, 0777, true);
				return true;
			}
		}
		else
		{
			$attachFile = $path.DIRECTORY_SEPARATOR."attachments";
			if(!is_dir($attachFile))
			{
				mkdir($attachFile, 0777, true);
				return true;
			}
		}
    }
    /**
     * Function to Topic Listing
     *
     * @param sfWebRequest $request
     */
    public function executeTopicList(sfWebRequest $request)
    {
        $this->orderBy = "";
        $this->orderType="";
        $where = "";

        $oForumTopics = new ForumTopics();
        $qSearch = $oForumTopics->topicListing();

        if($request->hasParameter('flagForumsId'))
			if($request->getParameter('flagForumsId'))
			{
				$this->flagForumsId = $flagForumsId = $request->getParameter('flagForumsId');
				$qSearch->where('ForumId = ?', $flagForumsId);
			}
			
		$qSearch->andWhere('Status != ?',sfConfig::get('app_Status_Deleted'));

        switch($request->getParameter('orderBy'))
        {
            case "CreateDateTime":
                $orderBy = "CreateDateTime";
                $this->orderBy = "CreateDateTime";
                break;
            case "Topic":
                $orderBy = "Topic";
                $this->orderBy = "Topic";
                break;
            default:
                $orderBy = 'Id';
                $this->orderBy = "Id";
                break;

        }

        switch($request->getParameter('orderType'))
        {
            case "asc":
                $qSearch->orderBy("$orderBy asc");
                $this->orderType = "asc";
                break;
            case "desc":
            default:
                $qSearch->orderBy("$orderBy desc");
                $this->orderType = "desc";
                break;
        }

        $pager = new sfDoctrinePager('ForumTopic', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;

        //$this->pager = $qSearch->execute();
    }

    /**
     * Function to Topic New
     *
     * @param sfWebRequest $request
     */
    public function executeTopicNew(sfWebRequest $request)
    {
		$this->flagForumsId = '';
		if($request->hasParameter('flagForumsId'))
			if($request->getParameter('flagForumsId'))
				$this->flagForumsId = $request->getParameter('flagForumsId');
				
        $this->form = new ForumTopicsForm();
    }

    /**
     * Function to Topic Create
     *
     * @param sfWebRequest $request
     */
    public function executeTopicCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new ForumTopicsForm();

        $flagForumsId = '';
		$flagForumsId = $request->getPostParameter('flagForumsId');
		$this->flagForumsId = $flagForumsId;
        $this->processTopicForm($request, $this->form, $flagForumsId);

        //$this->processTopicForm($request, $this->form);
        $this->setTemplate('topicNew');
    }

    /**
     * Function to Topic Edit
     *
     * @param sfWebRequest $request
     */
    public function executeEditTopic(sfWebRequest $request)
    {
		$this->flagForumsId = '';
		if($request->hasParameter('flagForumsId'))
			if($request->getParameter('flagForumsId'))
				$this->flagForumsId = $request->getParameter('flagForumsId');

        $this->forward404Unless($forumTopic = Doctrine::getTable('ForumTopics')->find(array($request->getParameter('id'))), sprintf('Object forumTopic does not exist (%s).', $request->getParameter('id')));
        $this->form = new ForumTopicsForm($forumTopic,array('formusId' => $forumTopic->getForumId()));
    }

    /**
     * Function to Topic Update
     *
     * @param sfWebRequest $request
     */
    public function executeUpdateTopic(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($forumTopic = Doctrine::getTable('ForumTopics')->find(array($request->getParameter('id'))), sprintf('Object forumTopic does not exist (%s).', $request->getParameter('id')));
        $this->form = new ForumTopicsForm($forumTopic,array('formusId' => $forumTopic->getForumId()));
		
		$flagForumsId = '';
		$flagForumsId = $request->getPostParameter('flagForumsId');
		$this->flagForumsId = $flagForumsId;
        $this->processTopicForm($request, $this->form, $flagForumsId);

        $this->setTemplate('editTopic');
    }


    /**
     * Function to Topic delete
     *
     * @param sfWebRequest $request
     */
    public function executeDeleteTopic(sfWebRequest $request)
    {
        $this->forward404Unless($fa_qs = Doctrine::getTable('ForumTopics')->find(array($request->getParameter('id'))), sprintf('Object Forum Topic does not exist (%s).', $request->getParameter('id')));
        //$fa_qs->delete();
        $oForumTopics = new ForumTopics();
       // $oForumTopics->changeTopicStatus($request->getParameter('id'),sfConfig::get("app_Status_Deleted"));

        $this->getUser()->setFlash('errMsg', "Deletion successful.");

		// Start delete time set the forums data 
		$lastTopicData = ForumTopicsTable::getLastTopicOfForums($fa_qs->getForumId());
		$topicId = ($lastTopicData[0]["Id"])? $lastTopicData[0]["Id"] : 0;
		$userId = ($lastTopicData[0]["UserId"])? $lastTopicData[0]["UserId"] : 0;
		
		$objectForums = new Forums();
		$objectForums->deleteTimeUpdateForumsData($topicId,$userId,$fa_qs->getForumId());
		//End delete time set the forums data 

		if($request->hasParameter('flagForumsId'))
			if($request->getParameter('flagForumsId'))
				$this->redirect("Forums/topicList?flagForumsId=".$request->getParameter('flagForumsId'));

        $this->redirect("Forums/topicList");
    }

    /**
     * Function to Topic View
     *
     * @param sfWebRequest $request
     */
    public function executeTopicView(sfWebRequest $request)
    {
        $oForumTopics = new ForumTopics();
        $asRecord = $oForumTopics->viewForumsTopicQuery($request->getParameter('id'));

        $this->form = $asRecord;
    }

    /**
     * Function to Topic Changestatus
     *
     * @param sfWebRequest $request
     */
    public function executeChangeTopicStatus(sfWebRequest $request)
    {
        $snId 		= 	$request->getParameter('id');
        $ssStatus 	= 	$request->getParameter('status');
        $oForumTopics = new ForumTopics();
        $oForumTopics->changeTopicStatus($snId,$ssStatus);

        if($ssStatus == sfConfig::get("app_Status_Active")){
            $successMessage = "activated";
            $msgStatus = "succMsg";
        }
        else {
            $successMessage = "inactivated";
            $msgStatus = "errMsg";
        }

        $this->getUser()->setFlash($msgStatus,'Status successfully changed to '.$successMessage.'.');

        if($request->hasParameter('flagForumsId'))
			if($request->getParameter('flagForumsId'))
				$this->redirect('Forums/topicList?flagForumsId='.$request->getParameter('flagForumsId'));

        $this->redirect('Forums/topicList');
    }

    /**
     * Function to Topic Process
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     * @param string $flag
     */
    protected function processTopicForm(sfWebRequest $request, sfForm $form, $flagForumsId)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            if(!$request->isMethod(sfRequest::PUT))
				$form->getObject()->setUserId( $this->getUser()->getAttribute('admin_user_id') );

            $forumTopic = $form->save();

            if($request->isMethod(sfRequest::PUT))
            $this->getUser()->setFlash('succMsg', "Update successful.");
            else
            $this->getUser()->setFlash('succMsg', "New topic added successfully.");

            //add time set forums data
			if(!$request->isMethod(sfRequest::PUT))
			{
				$userId = $this->getUser()->getAttribute('admin_user_id');
				$objectForums = new Forums();
				$objectForums->updateForumsData($forumTopic->getId(), $userId, $forumTopic->getForumId());
			}

			if($flagForumsId != '')
				$this->redirect('Forums/topicList?flagForumsId='.$flagForumsId);

            $this->redirect('Forums/topicList');

        }
    }

    /**
     * Function to ordering of listing
     *
     * @param sfWebRequest $request
     */
    public function executeGlobelOrdering(sfWebRequest $request)
    {
        $anOrdering = $request->getParameter('recordsArray');
        $oForums = new Forums();
        foreach($anOrdering as $key => $snOrderning)
        {
            $oForums->updateForumOrdering($snOrderning,$key);
        }
        return sfView::NONE;
    }
}
