<?php

/**
 * manageuser actions.
 *
 * @package    counceledge
 * @subpackage manageuser
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class manageuserActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		$this->orderBy = "";
        $this->orderType="";

		$qSearch = Doctrine_Query::create();
        $qSearch->select('U.*');
        $qSearch->from('Users U');
        $qSearch->where('U.UserType = ?', "User");
        $qSearch->andWhere('U.Status != ?', "Deleted");
        //$qSearch->orderBy('U.Id DESC');

        switch($request->getParameter('orderBy'))
        {
            case "FirstName":
                $orderBy = 'FirstName';
                $this->orderBy = "FirstName";
                break;
            case "Email":
                $orderBy = 'Email';
                $this->orderBy = "Email";
                break;
            default:
                $orderBy = 'CreateDateTime';
                $this->orderBy = "CreateDateTime";
                break;
        }

        switch($request->getParameter('orderType'))
        {
            case "asc":
                $qSearch->orderBy("$orderBy ASC");
                $this->orderType = "asc";
                break;
            case "desc":
            default:
                $qSearch->orderBy("$orderBy DESC");
                $this->orderType = "desc";
                break;
        }

		$pager = new sfDoctrinePager('Users', sfConfig::get('app_no_of_records_per_page_for_users'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;
	}
	
	/**
     * Function to change status Delete
     *
     * @param sfWebRequest $request
     */
	public function executeDelete(sfWebRequest $request)
	{
		$this->forward404Unless($users = Doctrine::getTable('Users')->find(array($request->getParameter('id'))), sprintf('Object forum_categories does not exist (%s).', $request->getParameter('id')));

		$users->setUpdateDateTime(date("Y-m-d H:i:s"));
		$users->setStatus("Deleted");
		$users->save();

		// SEND NOTIFICATION EMAIL TO USER START
			$arrParams = array();
			$arrParams['toEmailAddress'] = $users->getEmail();
			$arrParams['FirstName'] = ucfirst(strtolower($users->getFirstName()));
			$arrParams['Status'] = 'deactivated';

			$objSiteMails = new siteMails();
			$objSiteMails->sendStatusChangeEmail($arrParams);
		// SEND NOTIFICATION EMAIL TO USER END

        $this->getUser()->setFlash('errMsg', "Deletion successful.");
        $this->redirect('manageuser/index');
	}
	
	/**
     * Function to change status pending to active
     *
     * @param sfWebRequest $request
     */
    public function executePendingToActive(sfWebRequest $request)
    {
        $id = $request->getParameter('id');

        $oUsers = new Users();
        $oUsers->changeStatus($id, sfConfig::get('app_UserStatus_Active'));

        /* to get the site url */
        $oSiteConfig = Doctrine::getTable('SiteConfig')->findByConfigKey("SITE_URL");
        $asSiteUrl = $oSiteConfig->toArray();
        $siteUrl = $asSiteUrl[0]["ConfigValue"];
        /* End the site url path */

        $url =  $siteUrl.DIRECTORY_SEPARATOR.'admin.php'.DIRECTORY_SEPARATOR;

        $userDetails = UsersTable::getUserDetailById($id);

        $objPassEncDec = new encryptDecrypt(sfConfig::get('app_pwdEncDecKey'));
        $password = $objPassEncDec->decrypt($userDetails->getPassword());

        $arrParams = array();
        $arrParams['toEmailAddress'] = $userDetails->getEmail();
        $arrParams['Password'] = $password;
        $arrParams['FirstName'] = $userDetails->getFirstName();
        $arrParams['LastName'] = $userDetails->getLastName();
        $arrParams['Url'] = $url;

        $objSiteMails = new siteMails();
        $objSiteMails->changePandingToActiveStatus($arrParams);

        $this->getUser()->setFlash("succMsg",'Status successfully changed to active.');

        $this->redirect('manageuser/index');
    }
    
    /**
	 * for changes status
	 *
	 * @param sfRequest $request A request object
	 */
    public function executeChangeStatus(sfWebRequest $request)
    {
		$this->forward404Unless($users = Doctrine::getTable('Users')->find(array($request->getParameter('id'))), sprintf('User not found!'));
        $status = $request->getParameter('status');

		$users->setStatus($status);
		$users->setUpdateDateTime(date("Y-m-d H:i:s"));
		$users->save();
		$arrParams = array();
		
		if($status=="Active"){
			$this->getUser()->setFlash("succMsg",'Status successfully changed to active.');
			$arrParams['Status'] = 'Active';
		}else{
			$this->getUser()->setFlash("succMsg",'Status successfully changed to inactive.');
			$arrParams['Status'] = 'Inactive';
		}
		
		$arrParams['toEmailAddress'] = $users->getEmail();
		$arrParams['FirstName'] = ucfirst(strtolower($users->getFirstName()));
		$objSiteMails = new siteMails();
		$objSiteMails->sendStatusChangeEmail($arrParams);
		$this->redirect('manageuser/index');
    }
    
    /**
	 * for customer reply list
	 *
	 * @param sfRequest $request A request object
	 */
    public function executeCustomerReview(sfWebRequest $request)
    {
		$this->customerId = "";
		$userId = 0;
		
		/*this condition is for display review rating in profile dashboard */
		if($request->hasParameter('customerId'))
		{
			if($request->getParameter('customerId') != "")
			{
				$this->customerId = $request->getParameter('customerId');
				$userId = $request->getParameter('customerId');
			}
			else
				$this->redirect("users/index");
		}
		/*this condition is for display review rating customer side */
		elseif($this->getUser()->getAttribute('admin_user_id') != "")
			$userId = $this->getUser()->getAttribute('admin_user_id');
		else
			$userId = 0;
		
		/*when display in profile dashboar set layout dashboar */
		if($this->customerId != "")
			$this->setLayout("dashboard");
		
		$this->orderBy = "";
        $this->orderType="";

		$qSearch = Doctrine_Query::create();
        $qSearch->select('RR.*');
        $qSearch->from('ReviewRating RR');
        $qSearch->where('RR.CustomerId = ?', $userId);
        $qSearch->orderBy('RR.CreateDateTime DESC');

		$pager = new sfDoctrinePager('ReviewRating', sfConfig::get('app_no_of_records_per_page_for_users'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;
    }

    /**
	 * function for insert spam value in review table 
	 *
	 * @param sfRequest $request A request object
	 */
    public function executeAjaxSpamInsert(sfWebRequest $request)
    {
		if($request->isXmlHttpRequest())
        {
            $reviewId 			= $request->getParameter('reviewId');
            $spamValue 			= $request->getParameter('spamValue');
            $objReviewRating 	= new ReviewRating();
			$objReviewRating->insertSpamValue($reviewId, $spamValue);
        }
        return sfView::NONE;
    }

    /**
	 * function to delete review
	 *
	 * @param sfRequest $request A request object
	 */
    public function executeDeleteReview(sfWebRequest $request)
    {
		if($request->hasParameter('id'))
		{
			if($request->getParameter('id') != '')
			{
				$this->forward404Unless($ReviewRating = Doctrine::getTable('ReviewRating')->find(array($request->getParameter('id'))), sprintf('Object Review rating does not exist (%s).', $request->getParameter('id')));
				$ReviewRating->delete();
				$this->getUser()->setFlash('errMsg', "Deletion successful.");
				
 				// Start update review rating average and number of reivew 
 				$userId		= $request->getParameter('userId');
 				$customerId	= $request->getParameter('customerId');
				$userTableData = ReviewRatingTable::getNoOfRatingAndAvgRating($userId, $customerId);

				$ratingAvg  = 0;
				$noOfRating = 0;

				if(count($userTableData) >= 1)
				{
					$noOfRating = $userTableData[0]['noOfRating'];

					// rating explode to check that ceil and floor
					$cellingFloarAvg = explode('.', $userTableData[0]["avgRating"]);

					if(count($cellingFloarAvg) >= 1)
					{
						$desimalPointValue = "0.".$cellingFloarAvg[1];

						if( $desimalPointValue > 0.5 )
						$ratingAvg = ceil($userTableData[0]["avgRating"]);
						elseif( $desimalPointValue < 0.5 )
						$ratingAvg = floor($userTableData[0]["avgRating"]);
						else
						$ratingAvg = $userTableData[0]["avgRating"];
					}
				}
				$objectUser = new Users();
				$objectUser->setTotalAndAvgRating($noOfRating, $ratingAvg, $customerId);
				// END update review rating average and number of reivew 

				$this->redirect('manageuser/adminReview');
			}
		}
		$this->redirect('manageuser/adminReview');
    }

    /**
	 * function for listing of all review rating
	 *
	 * @param sfRequest $request A request object
	 */
    public function executeAdminReview(sfWebRequest $request)
    {
		
		$this->orderBy = "";
        $this->orderType="";
		$this->searchBy = "";
		$this->searchBySpam = "";
		
		$qSearch = Doctrine_Query::create();
        $qSearch->select('RR.*');
        $qSearch->from('ReviewRating RR');

				$this->searchForm = new SearchReviewRatingForm();
				if($request->isMethod(sfRequest::POST )) {
					$searchForm = new SearchReviewRatingForm();
					$searchUserId = $request->getParameter($searchForm->getName());

					if(array_key_exists("searchspam", $searchUserId))
					{
						if(($searchUserId["searchcustomer"] != "" && $searchUserId["searchcustomer"] != '0') && $searchUserId["searchspam"] == "on")
						{
							$this->searchBy = $searchUserId["searchcustomer"];
							$qSearch->andWhere("RR.CustomerId = ?", $searchUserId["searchcustomer"]);
							$this->searchBySpam = $searchUserId["searchspam"];
							$qSearch->andWhere("RR.Spam  = ?", 1);
						}
						elseif($searchUserId["searchcustomer"] != "" && $searchUserId["searchcustomer"] != '0')
						{
							$this->searchBy = $searchUserId["searchcustomer"];
							$qSearch->andWhere("RR.CustomerId = ?", $searchUserId["searchcustomer"]);
						}
						elseif($searchUserId["searchspam"] == "on")
						{
							$this->searchBySpam = $searchUserId["searchspam"];
							$qSearch->andWhere("RR.Spam  = ?", 1);
						}
					}
					else
					{
						if($searchUserId["searchcustomer"] != "" && $searchUserId["searchcustomer"] != '0')
						{
							$this->searchBy = $searchUserId["searchcustomer"];
							$qSearch->andWhere("RR.CustomerId = ?", $searchUserId["searchcustomer"]);
						}
					}
				}
				else
				{
					if(($request->getParameter('searchBy') != '' && $request->getParameter('searchBy') != '') && $request->getParameter('searchBySpam') == 'on')
					{
						$searchBy = $this->searchBy = $request->getParameter('searchBy');
						$qSearch->andWhere("RR.CustomerId = ?", $searchBy);
						$searchBySpam = $this->searchBySpam = $request->getParameter('searchBySpam');
						$qSearch->andWhere("RR.Spam  = ?", 1);
					}
					elseif($request->getParameter('searchBy') != '' && $request->getParameter('searchBy') != '')
					{
						$searchBy = $this->searchBy = $request->getParameter('searchBy');
						$qSearch->andWhere("RR.CustomerId = ?", $searchBy);
					}
					elseif($request->getParameter('searchBySpam') == 'on')
					{
						$searchBySpam = $this->searchBySpam = $request->getParameter('searchBySpam');
						$qSearch->andWhere("RR.Spam  = ?", 1);
					}
				}
				
		$qSearch->orderBy('RR.CreateDateTime DESC');
		$pager = new sfDoctrinePager('ReviewRating', sfConfig::get('app_no_of_records_per_page_for_users'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;
    }
    
    /**
	 * function for listing of all review rating
	 *
	 * @param sfRequest $request A request object
	 */
	 public function executeChangeReviewStatus(sfWebRequest $request)
	 {
		$status 	=  $request->getParameter('status');
		$id 		=  $request->getParameter('id');
		$objReview = new ReviewRating();
		$objReview->updateReviewStatus($status, $id);
		
		$this->getUser()->setFlash("succMsg",'Review successfully.');
		
		if($status == sfConfig::get('app_Status_Active')):
			$this->getUser()->setFlash("succMsg",'Status successfully changed to active.');
			$this->addAvgRating($id);
		elseif($status == sfConfig::get('app_Status_Inactive')):
			$this->addAvgRating($id);
			$this->getUser()->setFlash("succMsg",'Status successfully changed to inactive.');
		endif;

		if($request->getParameter('flag') == "admin")
			$this->redirect("manageuser/adminReview");
		elseif($request->getParameter('flag') == "customer")
			$this->redirect("manageuser/customerReview");
		elseif($request->getParameter('flag') == "dashboard")
			$this->redirect("manageuser/customerReview?customerId=".$request->getParameter('customerId'));
	 }
	 
	 /**
	 * function for inserting avg review in user table
	 *
	 * @param integer $userId
	 * @param integer $customerId
	 */
	 public function addAvgRating($id)
	 {
		$reviewData = Doctrine::getTable('ReviewRating')->find(array($id));
		
		$customerId = $reviewData->getCustomerId();
		$userId = $reviewData->getUserId();
		$userTableData = ReviewRatingTable::getNoOfRatingAndAvgRating($userId, $customerId);

            $ratingAvg  = 0;
            $noOfRating = 0;

            if(count($userTableData) >= 1)
            {
                $noOfRating = $userTableData[0]['noOfRating'];

                // rating explode to check that ceil and floor
                $cellingFloarAvg = explode('.', $userTableData[0]["avgRating"]);

                if(count($cellingFloarAvg) >= 1)
                {
                    $desimalPointValue = "0.".$cellingFloarAvg[1];

                    if( $desimalPointValue > 0.5 )
                    $ratingAvg = ceil($userTableData[0]["avgRating"]);
                    elseif( $desimalPointValue < 0.5 )
                    $ratingAvg = floor($userTableData[0]["avgRating"]);
                    else
                    $ratingAvg = $userTableData[0]["avgRating"];
                }
            }

            $objectUser = new Users();
            $objectUser->setTotalAndAvgRating($noOfRating, $ratingAvg, $customerId);
	 }
}