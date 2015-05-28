<?php

/**
 * attornies actions.
 *
 * @package    counceledge
 * @subpackage attornies
 * @author     Chintan Fadia
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class attorniesActions extends sfActions
{
    /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    public function executeIndex(sfWebRequest $request)
    {
        $this->headerSearchForm = new LGHeaderSearchForm();
        $formData = $request->getParameter($this->headerSearchForm->getName());
        #clsCommon::pr($formData);

        $catIdWithSlug = PracticeAreasTable::getCatIdBasedOnSlug(); // Get Category ID Based on Slug

        $qSearch = Doctrine_Query::create();
        $qSearch->select('u.*, IF(u.PriorityListing = "Yes",1,0) as featuredOrd')   ;
        $qSearch->from('Users u');
        $qSearch->leftJoin('u.UsersUserProfile up');
        $qSearch->leftJoin('up.UserProfileStates ups');
        $qSearch->leftJoin('u.UsersUserPracticeArea practice');
        $qSearch->leftJoin('practice.UserPracticeAreaPracticeAreas practicearea');
        $qSearch->where('u.UserType = ? ', sfConfig::get('app_UserType_Customer'));
        $qSearch->andWhere('u.Status = ? ', sfConfig::get('app_UserStatus_Active') );
        $qSearch->andWhere('u.NetworkProfileSubscription = ? ', 'Yes' );
        $qSearch->orderBy('featuredOrd DESC, u.FirstName ASC');

        /*if(clsCommon::checkStateCookieExist()){
        $qSearch->andWhere('up.StateId = ? ', clsCommon::checkStateCookieValue() );
        }*/

        // For Cookie
        if(clsCommon::checkStateCookieExist() && clsCommon::checkCountyCookieExist()){
            $qSearch->leftJoin('u.UsersUserPracticeAreaLocation upal');
            $qSearch->andWhere('upal.StateId = ? ', clsCommon::checkStateCookieValue() );
            $qSearch->andWhere('upal.CountyId = ? ', clsCommon::checkCountyCookieValue() );
        } else if(clsCommon::checkStateCookieExist())  {
            $qSearch->leftJoin('u.UsersUserPracticeAreaLocation upal');
            $qSearch->andWhere('upal.StateId = ? ', clsCommon::checkStateCookieValue() );
        }


        // Default Search Array
        $searchArr =  array(
        'DefaultState'       => 0 ,
        'BasicSearch'        => '' ,
        'ParentPracticeArea' => 0 ,
        'SubPracticeArea'    => 0 ,
        'ChildPracticeArea'  => 0 ,
        'Searchby'           => '',
        'FreeConsultation'   => '',
        'SortBy'             => 0
        );
        
        #if($request->isMethod(sfRequest::POST )) {
        if($request->hasParameter('formmethod') && $request->getParameter('formmethod') == 'post') {
            $searchArr = $request->getParameter($this->headerSearchForm->getName());
             #clsCommon::pr($searchArr);
        } else  { // search By Paging

            /*if($request->hasParameter('stateid')) {
            $searchArr['DefaultState'] = $request->getParameter('stateid');
            }*/
            if($request->hasParameter('searchby')) {
                $searchArr['Searchby'] = $request->getParameter('searchby');
            }
            if($request->hasParameter('basicsearch')) {
                $searchArr['BasicSearch'] = $request->getParameter('basicsearch');
            }
            /*if($request->hasParameter('praentid')) {
            $searchArr['ParentPracticeArea'] = $request->getParameter('praentid');
            }
            if($request->hasParameter('subid')) {
            $searchArr['SubPracticeArea'] = $request->getParameter('subid');
            }
            if($request->hasParameter('childid')) {
            $searchArr['ChildPracticeArea'] = $request->getParameter('childid');
            }*/
            if($request->hasParameter('parentcat')) {
                $searchArr['ParentPracticeArea'] = $request->getParameter('parentcat');
            }
            if($request->hasParameter('subcat')) {
                $searchArr['SubPracticeArea'] = $request->getParameter('subcat');
            }
            if($request->hasParameter('childcat')) {
                $searchArr['ChildPracticeArea'] = $request->getParameter('childcat');
            }
            if($request->hasParameter('free')) {
                $searchArr['FreeConsultation'] = 'on';
            }
            if($request->hasParameter('sortby')) {
                $searchArr['SortBy'] = $request->getParameter('sortby');
            }

        } // End of Else
        #clsCommon::pr($searchArr);

        #if(!empty($searchArr['Searchby']) && $searchArr['Searchby'] == 'name' && trim($searchArr['BasicSearch'])!= ''){
        if(isset($searchArr['BasicSearch'] ) && trim($searchArr['BasicSearch'])!= ''){
            $keyword = trim($searchArr['BasicSearch']);
            //$qSearch->andWhere('u.FirstName LIKE ? OR u.LastName LIKE ?  OR up.Summary LIKE ? OR practicearea.Name LIKE ?  ', array( '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%'));
            $qSearch->andWhere('u.FirstName LIKE ? OR u.LastName LIKE ?  ', array( '%'.$keyword.'%', '%'.$keyword.'%'));
        }

        #if(!empty($searchArr['Searchby']) && $searchArr['Searchby'] == 'practice' && ( !empty($searchArr['ParentPracticeArea']) || !empty($searchArr['SubPracticeArea']) || !empty($searchArr['ChildPracticeArea']))){

        if(!empty($searchArr['ParentPracticeArea']) || !empty($searchArr['SubPracticeArea']) || !empty($searchArr['ChildPracticeArea'])){

            if(!empty($searchArr['ParentPracticeArea']) &&  !empty($searchArr['SubPracticeArea']) && !empty($searchArr['ChildPracticeArea']) ) {
                $practiceQuery =  'practice.ChildId = "'.$catIdWithSlug[$searchArr["ChildPracticeArea"]] .'"' ;

            } else if (!empty($searchArr['ParentPracticeArea']) &&  !empty($searchArr['SubPracticeArea'])) {

                $practiceQuery =  'practice.SubCatId = "'.$catIdWithSlug[$searchArr["SubPracticeArea"]] .'"' ;

            } else if (!empty($searchArr['ParentPracticeArea'])) {

                $practiceQuery =  'practice.CatId = "'.$catIdWithSlug[$searchArr["ParentPracticeArea"]] .'"' ;
            }
            /*if(isset($searchArr['ParentPracticeArea'])  )  {
            $qSearch->andWhere('practice.CatId = ?  ', $catIdWithSlug[$searchArr['ParentPracticeArea']]);
            }
            if(isset($searchArr['SubPracticeArea'])  )  {
            $qSearch->andWhere('practice.SubCatId = ?  ', $catIdWithSlug[$searchArr['SubPracticeArea']]);
            }
            if(isset($searchArr['ChildPracticeArea']) )  {
            $qSearch->andWhere('practice.ChildId = ?  ', $catIdWithSlug[$searchArr['ChildPracticeArea']]);
            }*/
            $qSearch->andWhere($practiceQuery);
        }

        if(isset($searchArr['FreeConsultation']) && $searchArr['FreeConsultation'] == 'on') {
            $qSearch->andWhere('up.FreeConsultation = ?  ', "Yes");
        }

        if(isset($searchArr['SortBy'])  && $searchArr['SortBy'] != '0' ) {

            if($searchArr['SortBy'] == 'name') {
                $qSearch->orderBy('u.FirstName ASC');
            } else if($searchArr['SortBy'] == 'rating')    {
                $qSearch->orderBy('u.AvgRating DESC');
            }

        }

        // Search By Post

        // Default Search Array
        $defaultArr =  array(
        'DefaultState'       =>  isset($searchArr['DefaultState']) ? $searchArr['DefaultState'] : 0,
        'BasicSearch'        =>  isset($searchArr['BasicSearch']) ? $searchArr['BasicSearch'] : '',
        'ParentPracticeArea' =>  isset($searchArr['ParentPracticeArea']) ? $searchArr['ParentPracticeArea'] : 0,
        'SubPracticeArea'    =>  isset($searchArr['SubPracticeArea']) ? $searchArr['SubPracticeArea'] : 0,
        'ChildPracticeArea'  =>  isset($searchArr['ChildPracticeArea']) ? $searchArr['ChildPracticeArea'] : 0,
        'Searchby'           =>  isset($searchArr['Searchby']) ? $searchArr['Searchby'] : '',
        #'FreeConsultation'  =>  isset($searchArr['FreeConsultation'])  ? $searchArr['FreeConsultation'] : '',
        'SortBy'             =>  isset($searchArr['SortBy']) ? $searchArr['SortBy'] : 0
        );

        if(isset($searchArr['FreeConsultation']) && $searchArr['FreeConsultation'] == 'on') {
            $defaultArr['FreeConsultation'] = 1 ;
        }

        #clsCommon::pr($defaultArr);

        $this->defaultPagingArr = $defaultArr ;
        $this->headerSearchForm->setDefaults($defaultArr) ;
        #echo $qSearch;

        $pager = new sfDoctrinePager('Users', sfConfig::get('app_no_of_records_per_page')); //
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;

        $this->parentCateogries = PracticeAreasTable::getPracticeAreaCategoriesWithSlug(); // Gers Parent Categories

        // Get Sub Categories
        if(!empty($defaultArr['ParentPracticeArea']) ) { //&&  !empty($defaultArr['SubPracticeArea'])
            $parentIdforSubSeclection = $catIdWithSlug[$defaultArr['ParentPracticeArea']] ;
            $this->subCategories = PracticeAreasTable::getSubPracticeAreaCategoriesWithSlug($parentIdforSubSeclection);
        } else {
            #$parentIdforSubSeclection = $this->parentCateogries[0]['Id'] ;
            #$this->subCategories = PracticeAreasTable::getSubPracticeAreaCategoriesWithSlug($parentIdforSubSeclection);
            $this->subCategories = array();
        }
        #$this->subCategories = PracticeAreasTable::getPracticeAreaCategoriesWithSlug($parentIdforSubSeclection);


        // get Child Categories
        if(!empty($defaultArr['SubPracticeArea']) ) { //&& !empty($defaultArr['ChildPracticeArea'])
            $subIdforSubSeclection = $catIdWithSlug[$defaultArr['SubPracticeArea']] ;
            $this->childCategories = PracticeAreasTable::getChildPracticeAreaCategoriesWithSlug($subIdforSubSeclection);
        } else {
            if(!empty( $this->subCategories[0]['Id'] )) {
                $subIdforSubSeclection = $this->subCategories[0]['Id'] ;
            } else  { // This condition will occurs if No Subcategory
                $subIdforSubSeclection = '-1' ; // -1 passed to get No Category
            }
            $this->childCategories = array();

        }
        #$this->childCategories = PracticeAreasTable::getPracticeAreaCategoriesWithSlug($subIdforSubSeclection);


        // Get Free Consultation Users Count
        $freeConsultSearch = clone($qSearch);
        $freeConsultSearch->andWhere('up.FreeConsultation = ?  ', "Yes");
        $this->freeConsultUserCount = $freeConsultSearch->count();
        #$this->freeConsultUserCount = UsersTable::getFreeConsultUserCount();

        #clsCommon::pr($this->parentCateogries);
        #clsCommon::pr($this->subCategories);
        #clsCommon::pr($this->childCategories);

        // Code to Set State Slug value in hideen variable on Attorney PAge
        $statesArr = StatesTable::getUSStatesData();
        $countiesArr = CountiesTable::getCounties();

        $stateSlugValueAttorniesPage = '';
        if(clsCommon::checkStateCookieExist()){
            $stateName = $statesArr[clsCommon::checkStateCookieValue()];
            $stateSlugValueAttorniesPage = clsCommon::slugify($stateName);
        }
        $this->stateSlugValueAttorniesPage = $stateSlugValueAttorniesPage;


        $countySlugValueAttorniesPage = '';
        if(clsCommon::checkCountyCookieExist()){
            $countyName = $countiesArr[clsCommon::checkCountyCookieValue()];
            $countySlugValueAttorniesPage = clsCommon::slugify($countyName);
        }
        $this->countySlugValueAttorniesPage = $countySlugValueAttorniesPage;

        // Code completee

    } // End of Function

    /**
     * Function to View Attorney Profile
     */
    public function executeProfile(sfWebRequest $request){
    
		/*$this->popupOpen = "";
		if($request->hasParameter('popupOpen'))
		{
			if($request->getParameter('popupOpen') != "")
			{
				$this->popupOpen = $request->getParameter('popupOpen');
			}
		}*/
		
        $objUser = Doctrine_Core::getTable('Users')->findOneByIdAndUserTypeAndNetworkProfileSubscriptionAndStatus($request->getParameter('id'),sfConfig::get('app_UserType_Customer'),'Yes', sfConfig::get('app_UserStatus_Active'));

        if(!$objUser) {
            $this->forward($objUser);
        }
        $this->objUser = $objUser;

        $practicveAreaArr = PracticeAreasTable::getPracticeAreas();
        $userPracticeArea = UsersTable::getPracticeAreaUserwise($request->getParameter('id'));
        #clsCommon::pr($userPracticeArea);
        $resultArr = array();
        for($i=0; $i<count($userPracticeArea) ; $i++ ) {
            if($userPracticeArea[$i]['CatId'] != 0 &&  $userPracticeArea[$i]['SubCatId']  == 0 && $userPracticeArea[$i]['ChildId'] == 0)    {
                $resultArr[$userPracticeArea[$i]['CatId']]['Parent'] =  $practicveAreaArr[$userPracticeArea[$i]['CatId']];
            }

            if($userPracticeArea[$i]['CatId'] != 0 &&  $userPracticeArea[$i]['SubCatId']  != 0 && $userPracticeArea[$i]['ChildId'] == 0)    {
                $resultArr[$userPracticeArea[$i]['CatId']]['Parent'] =  $practicveAreaArr[$userPracticeArea[$i]['CatId']];
                $resultArr[$userPracticeArea[$i]['CatId']]['Subcat']['Name'][$userPracticeArea[$i]['SubCatId']] =  $practicveAreaArr[$userPracticeArea[$i]['SubCatId']];
            }

            if($userPracticeArea[$i]['CatId'] != 0 &&  $userPracticeArea[$i]['SubCatId']  != 0 && $userPracticeArea[$i]['ChildId'] != 0)    {

                $resultArr[$userPracticeArea[$i]['CatId']]['Parent'] =  $practicveAreaArr[$userPracticeArea[$i]['CatId']];
                $resultArr[$userPracticeArea[$i]['CatId']]['Subcat']['Name'][$userPracticeArea[$i]['SubCatId']] =  $practicveAreaArr[$userPracticeArea[$i]['SubCatId']];

                $resultArr[$userPracticeArea[$i]['CatId']]['Subcat']['Name-'.$userPracticeArea[$i]['SubCatId']]['Child'][$userPracticeArea[$i]['ChildId']] =  $practicveAreaArr[$userPracticeArea[$i]['ChildId']];
            }

        } // End of For
        #clsCommon::pr($resultArr,1);
        $this->usersPracticeArr = $resultArr;

        // Get Users Practice Area Location
        $userPracticeLoc = array();
        $practiceLoc = UserPracticeAreaLocationTable::getUsersPracticeLocation($request->getParameter('id'));
        if(!empty($practiceLoc)) {

            for($i = 0 ; $i < count($practiceLoc) ; $i++) {

                if($practiceLoc[$i]['StateId'] != 0  ) { //&& $practiceLoc[$i]['CountyId'] == 0
                    //if(!isset($userPracticeLoc[$practiceLoc[$i]['StateId']]))
                    $userPracticeLoc[$practiceLoc[$i]['StateId']] ['Name'] = $practiceLoc[$i]['UserPracticeAreaLocationState']['Name'];
                }


                if($practiceLoc[$i]['StateId'] != 0 && $practiceLoc[$i]['CountyId'] != 0 ) {

                    $userPracticeLoc[$practiceLoc[$i]['StateId']] ['County'][$i]['Id'] = $practiceLoc[$i]['UserPracticeAreaLocationCounties']['Id'];
                    $userPracticeLoc[$practiceLoc[$i]['StateId']] ['County'][$i]['Name'] = $practiceLoc[$i]['UserPracticeAreaLocationCounties']['Name'];
                }

            } // End of For

        } // End of Not Empty
        #clsCommon::pr($userPracticeLoc,1);
        $this->usersPracticeLocation = $userPracticeLoc;

        // User Statistics
        AttorneyStatisticsTable::addToStatisticsByProfile($this->getRequest()->getRemoteAddress(),$request->getParameter('id')); // Statistics

    } // End of Function

}