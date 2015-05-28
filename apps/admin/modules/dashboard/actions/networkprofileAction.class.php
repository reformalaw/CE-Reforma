<?php

/**
 * network profile
 *
 * @package network profile
 */
class networkprofileAction extends sfActions
{
    /**
	 * preExecutes index action
	 *
	 */
    public function preExecute()
    {
        $this->setLayout("dashboard");

        $request = $this->getRequest();
        $this->customerId =$request->getParameter('customerId');
        if($this->customerId != "")
        {
            $userData = Doctrine::getTable('Users')->find(array($request->getParameter('customerId')));

            if($userData->getUserType() != sfConfig::get("app_UserType_Customer") )
            $this->redirect("users/index");
        }
        else
        $this->redirect("users/index");
    }

    /**
     * Function to Edit network Profile
     *
     * @param sfWebRequest $request
     */
    public function executeNetworkprofile(sfWebRequest $request)
    {
        $this->snId = $request->getParameter("customerId");
        $this->forward404Unless($userProfile = Doctrine::getTable('UserProfile')->findByUserId(array($this->snId)), sprintf('Object users does not exist (%s).', $this->snId));
        $this->form = new UserProfileForm($userProfile[0]);

        $networkList = UserPracticeAreaTable::getRecordList($this->snId);
        $locationList = UserPracticeAreaLocationTable::getStateCountyRecordList($this->snId); // Get Practice Area Location
        #clsCommon::pr($networkList);
        $this->form->setDefault('Network',$networkList);
        $this->form->setDefault('Location',$locationList);


        if($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT))
        {
            $this->processForm($request, $this->form, $this->snId);
        }
    }

    /**
     * Function to process edit network Profile
     *
     * @param sfWebRequest $request
     * @param sfForm       $form
     * @param integer      $userId
     */
    protected function processForm(sfWebRequest $request, sfForm $form, $userId)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $userProfile = $request->getParameter($form->getName());

        if ($form->isValid() && ( isset($userProfile['Network']) &&  count($userProfile['Network']) >= 1 && $userProfile['Network'][(count($userProfile['Network'])) - 1] != '-1' ) &&    ( isset($userProfile['Location']) &&  count($userProfile['Location']) >= 1 && $userProfile['Location'][(count($userProfile['Location'])) - 1] != '-1' ) )
        {
            if(!array_key_exists("FreeConsultation",$userProfile))
            {
                $form->getObject()->setFreeConsultation("No");
                unset($form["FreeConsultation"]);
            }

            $form->getObject()->setUserId($userId);
            $result = $form->save();

            // Update Practice Areas
            if (isset($userProfile['Network']) && !empty($userProfile['Network']) ) {
                UserPracticeAreaTable::deleteOldPracticeAreaData($userId);

                for ($i=0;$i<count($userProfile['Network']);$i++)
                {
                    if ($userProfile['Network'][$i] == "-1") {
                        $objUserNetwork = new UserPracticeArea();
                        $objUserNetwork->setUserId($userId);
                        $objUserNetwork->setPracticeareaId('-1');
                        $objUserNetwork->setCatId(0);
                        $objUserNetwork->setSubCatId(0);
                        $objUserNetwork->setChildId(0);
                        $objUserNetwork->setLevel(0);
                        $objUserNetwork->save();
                    }else {
                        $objUserNetwork = new UserPracticeArea();
                        $practiceAreaArr = explode('-',$userProfile['Network'][$i]);

                        if($practiceAreaArr[1] == 0 ){
                            $objUserNetwork->setCatId($practiceAreaArr[0]);
                            $objUserNetwork->setSubCatId(0);
                            $objUserNetwork->setChildId(0);
                            $objUserNetwork->setLevel(0);

                        } else if ($practiceAreaArr[1] == 1 ) {
                            $getParentId = UserPracticeAreaTable::getParentId($practiceAreaArr[0]);
                            $objUserNetwork->setCatId($getParentId);
                            $objUserNetwork->setSubCatId($practiceAreaArr[0]);
                            $objUserNetwork->setChildId(0);
                            $objUserNetwork->setLevel(1);

                        } else if ($practiceAreaArr[1] == 2 ) {
                            $getSubParentId = UserPracticeAreaTable::getParentId($practiceAreaArr[0]);
                            $getMainParentId = UserPracticeAreaTable::getParentId($getSubParentId);
                            $objUserNetwork->setCatId($getMainParentId);
                            $objUserNetwork->setSubCatId($getSubParentId);
                            $objUserNetwork->setChildId($practiceAreaArr[0]);
                            $objUserNetwork->setLevel(2);
                        } else {

                        }
                        $objUserNetwork->setUserId($userId);
                        $objUserNetwork->setPracticeareaId($practiceAreaArr[0]);
                        $objUserNetwork->save();
                    }
                } // end of For

            } else {
                UserPracticeAreaTable::deleteOldPracticeAreaData($userId);
            }
            // Practice Area Update Complete


            // Update Practice Area Location
            if (isset($userProfile['Location']) && !empty($userProfile['Location']) ) {
                UserPracticeAreaLocationTable::deleteOldPracticeAreaLocationData($userId);
                $stateCounties = CountiesTable::getCountyState();

                for ($j=0;$j<count($userProfile['Location']);$j++)
                {
                    if ($userProfile['Location'][$j] == "-1") {
                        $objLocation = new UserPracticeAreaLocation();
                        $objLocation->setUserId($userId);
                        $objLocation->setStateId('-1');
                        $objLocation->setCountyId(0);
                        $objLocation->save();
                    }else {

                        $locationArr = explode('-',$userProfile['Location'][$j]);

                        if(count($locationArr) == 2 ) {

                            if($locationArr[1] == 0 )  {// Then it will be State

                                $objLocation = new UserPracticeAreaLocation();
                                $objLocation->setUserId($userId);
                                $objLocation->setStateId($locationArr[0]);
                                $objLocation->setCountyId(0);
                                $objLocation->save();
                            } // End of Save State

                            if($locationArr[1] == 1 )  {// Then it will be County
                                $objLocation = new UserPracticeAreaLocation();
                                $objLocation->setUserId($userId);
                                $objLocation->setStateId($stateCounties[$locationArr[0]]);
                                $objLocation->setCountyId($locationArr[0]);
                                $objLocation->save();
                            } // End of IF Save county

                        } // End of IF Count = 2
                    }
                } // end of For

            } else {
                UserPracticeAreaLocationTable::deleteOldPracticeAreaLocationData($userId);
            }
            // Complete Practice Area Location


            $this->getUser()->setFlash('succMsg','Update successful.');
            $this->redirect('dashboard/networkprofile?customerId='.$userId);
        }
        else  {
           # $this->getUser()->setFlash('errMsg','At Least 1 practice area should be selected'); // IF NOT Selected Any Practice Area
        }

    }
}

?>