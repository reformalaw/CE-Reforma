<?php

/**
 * home actions.
 *
 * @package    counceledge
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions
{
    /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    public function executeIndex(sfWebRequest $request)
    {

        #$this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->headerSearchForm = new LGHeaderSearchForm();
        $formData = $request->getParameter($this->headerSearchForm->getName());
        clsCommon::pr($formData);

        $qSearch = Doctrine_Query::create();
        $qSearch->select('u.*, IF(u.IsFeatured = "Yes",1,0) as featuredOrd ')   ;
        $qSearch->from('Users u');
        $qSearch->leftJoin('u.UsersUserProfile up');
        $qSearch->leftJoin('up.UserProfileStates ups');
        $qSearch->leftJoin('u.UsersUserPracticeArea practice');                           // add relation in the to get user of creted by
        $qSearch->where('u.UserType = ? ', sfConfig::get('app_UserType_Customer'));
        $qSearch->andWhere('u.Status = ? ', sfConfig::get('app_UserStatus_Active') );
        $qSearch->andWhere('u.NetworkProfileSubscription = ? ', 'Yes' );
        $qSearch->orderBy('featuredOrd DESC, u.FirstName ASC');
        #echo $qSearch->getSqlQuery();
        #$result = $qSearch->fetchArray();
        #clsCommon::pr($result);


        $defaultArr =  array(
        'DefaultState'       =>  0 ,
        'BasicSearch'        =>  '' ,
        'ParentPracticeArea' =>  0 ,
        'SubPracticeArea'    =>  0 ,
        'ChildPracticeArea'  =>  0 ,
        );

        // Search By Post
        $this->headerSearchForm->setDefaults($defaultArr) ;

        if($request->isMethod(sfRequest::POST )) {

            // If Search By Professional Name
            if($formData['Searchby'] == 'name'){

                if(isset($formData['BasicSearch']) && !empty($formData['BasicSearch']) && trim($formData['BasicSearch'])!= '' )  {
                    $keyword = trim($formData['BasicSearch']);
                    #$qSearch->andWhere('u.FirstName LIKE ? OR u.LastName LIKE ?  OR up.Summary LIKE ? ', array( '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%'));
                }


            } else if ($formData['Searchby'] == 'practice') {
                
                if(isset($formData['ParentPracticeArea']) && !empty($formData['ParentPracticeArea']) )  {
                    #$qSearch->andWhere('u.FirstName LIKE ? OR u.LastName LIKE ?  OR up.Summary LIKE ? ', array( '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%'));
                }
                

            }
            // end search By

        } else  { // search By Paging

        } // End of Else

        /*clsCommon::pr($formData );
        echo '<pre>';print_r($_POST);
        die;*/
        $this->defaultPagingArr = $defaultArr ;
        
        echo $qSearch; //sfConfig::get('app_no_of_records_per_page')
        $pager = new sfDoctrinePager('Users', 5);
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;


        /* if(trim($request->getParameter('search'))){

        $keyword = trim($request->getParameter('search'));

        $sql = Doctrine_Query::create()
        ->select('p.*,u.Username,u.FirstName,u.LastName, up.Name,s.Name as StateName')
        ->from('UserPracticeArea p')
        ->leftJoin('p.UserPracticeAreaUsers u')
        ->leftJoin('u.UsersStates s')
        ->leftJoin('p.UserPracticeAreaPracticeAreas up')
        ->where('up.Name LIKE ? OR u.FirstName LIKE ? OR u.LastName LIKE ?', array( '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%'))
        //->where('match(u.FirstName) against (?)', $keyword)
        ->groupBy('p.UserId');

        // b.	Keyword search will be performed against Professional name, description and practice area selected.
        //
        //echo $sql->getSqlQuery();
        $result = $sql->fetchArray();
        clsCommon::pr($result);

        }else{

        $sql = Doctrine_Query::create()
        ->select('p.*,u.Username,u.FirstName,u.LastName, up.Name,s.Name as StateName')
        ->from('UserPracticeArea p')
        ->leftJoin('p.UserPracticeAreaUsers u')
        ->leftJoin('u.UsersStates s')
        ->leftJoin('p.UserPracticeAreaPracticeAreas up')
        ->groupBy('p.UserId');

        if($request->getParameter('cat')!='select'){
        $sql->andWhere('p.CatId = ? ', $request->getParameter('cat') );
        }
        if($request->getParameter('subCat')!='select'){
        $sql->andWhere('p.SubCatId = ? ', $request->getParameter('subCat') );
        }
        if($request->getParameter('subICat')!='select'){
        $sql->andWhere('p.ChildId = ? ', $request->getParameter('subICat') );
        }

        $result = $sql->fetchArray();

        clsCommon::pr($result);


        foreach($result as $value){

        $userStr[] = $value['UserId'];

        }
        clsCommon::pr($userStr);

        // Top Countries Listing
        $topCountries = Doctrine_Query::create()
        ->select('count(u.StateId) as counter, u.StateId, s.Name as stateName')
        ->from('users u')
        ->leftJoin('u.UsersStates s')
        ->whereIn('u.id', $userStr)
        ->groupBy('u.StateId');
        //->limit(10);




        #$countryResult = $topCountries->fetchArray();

        #clsCommon::pr($countryResult);

        } */

    }

    public static function executeProfile(){


    } // End of Function
}
