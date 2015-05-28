<?php

/**
 * rating actions.
 *
 * @package    counceledge
 * @subpackage rating
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ratingActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		$this->forward('default', 'module');
	}

	/** Function to add review rating
     *
     * @param sfWebRequest $request
     * @return unknown
     */
    public function executeReviewRating(sfWebRequest $request)
    {
        if($request->hasParameter('customerId'))
        {
            $this->customerId = $request->getParameter('customerId');
            $this->form = new ReviewRatingForm();
        }
        $this->setLayout('popup');
    }

    /** Function to add review rating
     *
     * @param sfWebRequest $request
     * @return unknown
     */
    public function executeAddReviewRating(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new ReviewRatingForm();
        $this->customerId = $customerId = $request->getPostParameter('customerId');
        $rating = $request->getPostParameter('score_value');
        $this->processForm($request, $this->form, $customerId, $rating);
        $this->setTemplate('reviewRating');
        $this->setLayout('popup');
    }

    /** Function to process the form for add review rating
     *
     * @param sfWebRequest $request
     * @param sfForms $form
     * @param integer $customerId
     * @param integer $rating
     * @return unknown
     */
    public function processForm($request, $form, $customerId, $rating)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            if($rating == "")
            $rating = 3;

            $userId = $this->getUser()->getAttribute('user_user_id');
            $form->getObject()->setUserId($userId);
            $form->getObject()->setCustomerId($customerId);
            $form->getObject()->setRate($rating);
            $forumTopic = $form->save();

			$objCustomer = Doctrine::getTable('Users')->find(array($forumTopic->getCustomerId()));
			$objUser = Doctrine::getTable('Users')->find(array($forumTopic->getUserId()));
			$customerName = ucwords($objCustomer->getFirstName()." ".$objCustomer->getLastName());
			$userName = ucwords($objUser->getFirstName()." ".$objUser->getLastName());

            $arrParams = array();
            $arrParams['Name'] = trim($customerName);
            $arrParams['UserName'] = trim($userName);
            $arrParams['Rating'] = trim($forumTopic->getRate());
            $arrParams['Review'] = trim($forumTopic->getReview());
            $arrParams['ToAddress'] = trim($objCustomer->getEmail());
            //$arrParams['ToAddress'] = "jaydip.dodiya@brainvire.com";

            $objSiteMails = new siteMails();
            $objSiteMails->sendLegalgripReviewRatingEmail($arrParams);
            
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

            $this->getUser()->setFlash('succMsg', "Rating added Successfully.",false);
            $this->getUser()->setFlash('succMsg2', "Please note that your rating will not be visible until screened for inappropriate language and content.",false);
            
        }
    } // End of Function

    /**
     * Function to list Customer Review
     *
     */
    public function executeReview(sfWebRequest $request) {

        $objUser = Doctrine_Core::getTable('Users')->findOneByIdAndUserTypeAndNetworkProfileSubscriptionAndStatus($request->getParameter('id'),sfConfig::get('app_UserType_Customer'),'Yes', sfConfig::get('app_UserStatus_Active'));

        if(!$objUser) {
            $this->forward($objUser);
        }
        $this->objUser = $objUser;
        $customerId = $request->getParameter('id'); 

        $qSearch = Doctrine_Query::create();
        $qSearch->from('ReviewRating r');
        $qSearch->leftJoin('r.ReviewRatingUsers ru');
        #$qSearch->leftJoin('r.ReviewRatingCustomers rc');
        $qSearch->where('r.CustomerId = ? ', $customerId);
        $qSearch->andWhere('r.Status = ? ', sfConfig::get('app_UserStatus_Active') );
        $qSearch->andWhere('r.Spam = ? ', 0 );
        $qSearch->orderBy('r.Id DESC');

        # echo $qSearch;    
        $pager = new sfDoctrinePager('ReviewRating', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;

    } // End of Function

}