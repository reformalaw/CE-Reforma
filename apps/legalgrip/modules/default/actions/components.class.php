<?php

class defaultComponents extends sfComponents
{

    public function executeHeader(sfWebRequest $request)
    {
        $this->headerSearchForm = new LGHeaderSearchForm();

        $searchArr =  array(
        'DefaultState'       =>  0 ,
        'BasicSearch'        =>  '' ,
        'ParentPracticeArea' =>  0 ,
        'SubPracticeArea'    =>  0 ,
        'ChildPracticeArea'  =>  0

        );

		/* to get the site url */
		$oSiteConfig = Doctrine::getTable('SiteConfig')->findByConfigKey("SITE_URL");
		$asSiteUrl = $oSiteConfig->toArray();
		$this->ssSiteUrl = $asSiteUrl[0]["ConfigValue"];
		/* End the site url path */
        
        if($request->isMethod(sfRequest::POST )) {
            $searchArr = $request->getParameter($this->headerSearchForm->getName());
        } else {

            if($request->hasParameter('stateid')) {
                $searchArr['DefaultState'] = $request->getParameter('stateid');
            }
            if($request->hasParameter('basicsearch')) {
                $searchArr['BasicSearch'] = $request->getParameter('basicsearch');
            }
            if($request->hasParameter('praentid')) {
                $searchArr['ParentPracticeArea'] = $request->getParameter('praentid');
            }
            if($request->hasParameter('subid')) {
                $searchArr['SubPracticeArea'] = $request->getParameter('subid');
            }
            if($request->hasParameter('childid')) {
                $searchArr['ChildPracticeArea'] = $request->getParameter('childid');
            }


        }

        // Default Search Array
        $defaultArr =  array(
        'DefaultState'       =>  isset($searchArr['DefaultState']) ? $searchArr['DefaultState'] : 0 ,
        'BasicSearch'        =>  isset($searchArr['BasicSearch']) ? $searchArr['BasicSearch'] : '' ,
        //'ParentPracticeArea' =>  isset($searchArr['ParentPracticeArea']) ? $searchArr['ParentPracticeArea'] : 0,
        'ParentPracticeArea' =>  isset($searchArr['ParentPracticeArea']) ? 0 : 0,
        'SubPracticeArea'    =>  isset($searchArr['SubPracticeArea']) ? $searchArr['SubPracticeArea'] : 0,
        'ChildPracticeArea'  =>  isset($searchArr['ChildPracticeArea']) ? $searchArr['ChildPracticeArea'] : 0 ,
        );

        // Set State in Cookie
        /*$defaultStateId =  0 ;
        if (isset($_COOKIE["LgStateId"]))
        echo "Welcome " . $_COOKIE["LgStateId"] . "!<br>";
        else
        echo "Welcome guest!<br>";*/

        $this->headerSearchForm->setDefaults($defaultArr) ;
        
        // Code to Set State Slug Value in Hidden Varable
        $this->statesArr = StatesTable::getUSStatesData();
        $this->countiesArr = CountiesTable::getCounties();
        
        $stateSlugValue = '';
        if(clsCommon::checkStateCookieExist()){
            $stateName = $this->statesArr[clsCommon::checkStateCookieValue()];
            $stateSlugValue = clsCommon::slugify($stateName);
        }
        $this->stateSlugValue = $stateSlugValue;
        
        $countySlugValue = '';
        if(clsCommon::checkCountyCookieExist()){
            $countyName = $this->countiesArr[clsCommon::checkCountyCookieValue()];
            $countySlugValue = clsCommon::slugify($countyName);
        }
        $this->countySlugValue = $countySlugValue;
        // Complete to Set Slug Value


    } // End of Function

    public function executeFooter(sfWebRequest $request)
    {

    }

    /**
     * Function to Get Featured Attorneys
     *
     * @param sfWebRequest $request
     */
    public function executeFeaturedAttorney(sfWebRequest $request)
    {
        $this->featuredArr = UsersTable::getFeaturedAttorneys();
    }

    /**
     * Function to Get Featured Attorneys
     *
     * @param sfWebRequest $request
     */
    public function executeFeaturedAttorneyVertical(sfWebRequest $request)
    {
        $this->featuredArr = UsersTable::getFeaturedAttorneys();
    }
    

}
?>