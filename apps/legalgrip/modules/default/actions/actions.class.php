<?php

/**
 * default actions.
 *
 * @package    counceledge
 * @subpackage default
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
    /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    public function executeIndex(sfWebRequest $request)
    {

        StatisticsTable::addIpToStatistics($this->getRequest()->getRemoteAddress(),2); // Statistics

        $this->practiceAreas = PracticeAreasTable::getMaxUsedParcticeArea(); // Get Browse By Practice Area
        $this->PracticeCat = PracticeAreasTable::getPracticeAreasKeyVal(); // Get All Practice Area Categories
        $this->PracticeCatSlug = PracticeAreasTable::getSlug(); // Get All Practice Area Slug



        $this->recentReview = ReviewRatingTable::getRecentReview() ;
        #clsCommon::pr($this->PracticeCat);


    } // End of Function

    public function executeCatSelection(sfWebRequest $request)
    {
        $this->setLayout(false);

        if ($request->isXmlHttpRequest()){

            if($request->isMethod('post')) {
                if($_POST['parentId'] != '0'  ) {
                    #$subCat = PracticeAreasTable :: getPracticeAreaSubCat($_POST['parentId']);
                    $subCat = PracticeAreasTable::getPracticeAreaSubCatWithSlug($_POST['parentId']);
                    #clsCommon::pr($subCat);
                } else {
                    $subCat = array();
                }
                return $this->renderPartial('subCat', array('subCatCombo' => $subCat));
            }
        }
        exit;

    }

    public function executeSubCatSelection(sfWebRequest $request)
    {
        $this->setLayout(false);

        if ($request->isXmlHttpRequest()){

            if($request->isMethod('post')) {

                if($_POST['parentId'] != '0'  ) {
                    #$subICat = PracticeAreasTable :: getPracticeAreaSubICat($_POST['parentId']);
                    $subICat = PracticeAreasTable :: getPracticeAreaSubICatWithSlug($_POST['parentId']);
                } else {
                    $subICat = array();
                }
                return $this->renderPartial('subICat', array('subICatCombo' => $subICat));

            }
        }
        exit;

    }

    public function executePracticeareas(sfWebRequest $request)
    {

        $this->PracticeCat = PracticeAreasTable::getPracticeAreasKeyVal(); // Get All Practice Area Categories
        $this->parentPracticeAreas = PracticeAreasTable::getMaxUsedParentParcticeArea(); // Get Practice Area

        #clsCommon::pr($this->parentPracticeAreas);

    } // End of Function


    public function executeChangestateOld(sfWebRequest $request)
    {
        // http://php-opensource-help.blogspot.in/2010/06/how-to-set-cookie-in-symfony.html

        if($request->isMethod(sfRequest::GET )) {
            $headerSearchForm = new LGHeaderSearchForm();
            $formData = $request->getParameter($headerSearchForm->getName());
            
            #clsCommon::pr($formData,1);
            if(isset($formData['DefaultState']) &&  $formData['DefaultState'] != 0 ) {
                #clsCommon::pr($formData,1);
                #setcookie('LgStateId', $formData['DefaultState']);
                $this->getResponse()->setCookie('LgStateId', $formData['DefaultState'], time()+60*60*24*180);
            }
            
            if(isset($formData['DefaultCounty']) &&  $formData['DefaultCounty'] != 0 ) {
                $this->getResponse()->setCookie('LgCountyId', $formData['DefaultCounty'], time()+60*60*24*180);
            }
            
        }
        $this->redirect('default/index');


    } // End of Function

    public function executeClearstate(sfWebRequest $request)
    {
        // http://php-opensource-help.blogspot.in/2010/06/how-to-set-cookie-in-symfony.html

        if($request->isMethod(sfRequest::GET )) {
            
            if(isset($_GET['clear_state']) &&  $_GET['clear_state'] == 'Clear' ) {

                $this->getResponse()->setCookie('LgStateId', '');
                $this->getResponse()->setCookie('LgCountyId', '');
            }
        }
        $this->redirect('default/index');


    } // End of Function

    /** Function to get Sub Category based on Parent Category For Attornies Filter search
     *
     * @param sfWebRequest $request
     * @return unknown
     */
    public function executeGetsubcategory(sfWebRequest $request)
    {
        $this->setLayout(false);
        if ($request->isXmlHttpRequest()){

            if($request->isMethod('post')) {
                if($_POST['parentId'] != '0'  ) {
                    # $subCat = PracticeAreasTable :: getPracticeAreaSubCat($_POST['parentId']);
                    $subCat = PracticeAreasTable :: getPracticeAreaSubCatWithSlug($_POST['parentId']);

                    #clsCommon::pr($subCat);
                } else {
                    $subCat = array();
                }
                return $this->renderPartial('getsubcategory', array('subCatCombo' => $subCat));
            }
        }
        exit;
    } // End of Function

    /**
     * Function to get Child category based on selected Sub Category  For Attornies Filter search 
     *
     * @param sfWebRequest $request
     * @return unknown
     */
    public function executeGetchildcategory(sfWebRequest $request)
    {
        $this->setLayout(false);

        if ($request->isXmlHttpRequest()){
            if($request->isMethod('post')) {
                if($_POST['parentId'] != '0'  ) {
                    #$subICat = PracticeAreasTable :: getPracticeAreaSubICat($_POST['parentId']);
                    $subICat = PracticeAreasTable :: getPracticeAreaSubICatWithSlug($_POST['parentId']);
                } else {
                    $subICat = array();
                }
                return $this->renderPartial('getchildcategory', array('subICatCombo' => $subICat));
            }
        }
        exit;
    }

    /**
     * Function to Get State county based on State Selection from Top Header
     *
     */
    public function executeGetStateCounty(sfWebRequest $request) {
        $this->setLayout(false);

        if ($request->isXmlHttpRequest()){
            if($request->isMethod('post')) {
                if($_POST['stateId'] != '0'  ) {
                    $county = UserPracticeAreaLocationTable::getStateCounty($_POST['stateId']);
                } else {
                    $county = array();
                }
                return $this->renderPartial('county', array('countyCombo' => $county));
            }
        }
        exit;


    } // End of Function
    
    public function executeChangestate(sfWebRequest $request)
    {
        // http://php-opensource-help.blogspot.in/2010/06/how-to-set-cookie-in-symfony.html

        if($request->isMethod(sfRequest::GET )) {
            $headerSearchForm = new LGHeaderSearchForm();
            $formData = $request->getParameter($headerSearchForm->getName());
            
            $county = array();
            if(isset($formData['DefaultState']) &&  $formData['DefaultState'] != 0 ) {
                #clsCommon::pr($formData,1);
                #setcookie('LgStateId', $formData['DefaultState']);
                $this->getResponse()->setCookie('LgStateId', $formData['DefaultState'], time()+60*60*24*180);
            }
            
            if(isset($formData['DefaultCounty']) &&  $formData['DefaultCounty'] != 0 ) {
                $this->getResponse()->setCookie('LgCountyId', $formData['DefaultCounty'], time()+60*60*24*180);
            }
            
        }
        $this->redirect('default/index');


    } // End of Function

    /**
     * Function to Clease State Cookie
     *
     * @param sfWebRequest $request
     */
    public function executeClearstatecookie(sfWebRequest $request)
    {
        $this->getResponse()->setCookie('LgStateId', '');
        $this->getResponse()->setCookie('LgCountyId', '');
        $this->redirect('default/index');

    } // End of Function    

}
