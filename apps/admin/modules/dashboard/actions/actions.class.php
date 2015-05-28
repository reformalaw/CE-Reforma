<?php

/**
 * dashboard actions.
 *
 * @package    counceledge
 * @subpackage dashboard
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dashboardActions extends sfActions
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

            // pending condition remove cause give the edit option in dashboard
            if($userData->getUserType() != sfConfig::get("app_UserType_Customer") ) //$userData->getStatus() == sfConfig::get("app_UserStatus_Pending")
            $this->redirect("users/index");
        }
        else
        $this->redirect("users/index");


    }
    /**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
    public function executeIndex(sfWebRequest $request)
    {
        if($request->hasParameter("customerId"))
        {
            $this->customerId =$request->getParameter('customerId');
            $this->underPayAmt = CasesTable::getCustomerUnderPayAmt($this->customerId); // added by jaydip dodiya for disply under pay amount
            $this->oUserData = Doctrine::getTable('Users')->find(array($request->getParameter('customerId')));
            $oUserInfo = $this->oUserData;
            if($oUserInfo->getBillingSubscription() == "Yes")
            {
                $this->oCaseDatas = CasesTable::getCaseInformation($request->getParameter('customerId'));
            }

            // For below statistics considered only Active Cases
            $this->totalAcceptedCasesCount = CasesTable::GetCustomerAcceptedCaseCount($this->customerId); // Considered only Accepted Cases
            #$this->totalPaidCasesCount = CasesTable::GetCustomerPaidCaseCount($this->customerId); // Only Close Cased
            #$this->totalPendingCasesCount = CasesTable::GetCustomerPendingCaseCount($this->customerId);
            $this->totalCasesAmount = CasesTable::GetCustomerCaseAllAmount($this->customerId);
            #clsCommon::pr($this->totalCasesAmount);
            $this->totalDifferenceAmount = CasesTable::GetCaseDifferenceAmount($this->customerId);



        }
    }

    /**
	 * Executes DashboardComingSoon action
	 *
	 */
    public function executeComingSoon()
    {

    }

    /**
     * Function to change subscription status the record
     *
     * @param sfWebRequest $request
     */
    public function executeChangeSubscriptionStatus(sfWebRequest $request)
    {
        $ssTempval 	= $request->getParameter("tempval");
        $ssStatus  	= $request->getParameter("status");
        $snId 		= $request->getParameter("id");

        if($ssTempval == "billing")
        {
            $oUsers = new Users();
            $oUsers->changeSubscriptionStatus($snId,"BillingSubscription",$ssStatus);

            if($ssStatus == "No")
            $this->getUser()->setFlash("succMsg","Status successfully changed to inactive.");
            elseif($ssStatus == "Yes")
            $this->getUser()->setFlash("succMsg","Status successfully changed to Active.");
        }
        elseif($ssTempval == "website")
        {
            $oUsers = new Users();
            $oUsers->changeSubscriptionStatus($snId,"WebsiteSubscriotion",$ssStatus);

            if($ssStatus == "No")
            $this->getUser()->setFlash("succMsg","Status successfully changed to inactive.");
            elseif($ssStatus == "Yes")
            $this->getUser()->setFlash("succMsg","Status successfully changed to Active.");
        }
        elseif($ssTempval == "net")
        {
            $oUsers = new Users();
            $oUsers->changeSubscriptionStatus($snId,"NetworkProfileSubscription",$ssStatus);

            if($ssStatus == "No")
            $this->getUser()->setFlash("succMsg","Status successfully changed to inactive.");
            elseif($ssStatus == "Yes")
            $this->getUser()->setFlash("succMsg","Status successfully changed to Active.");
        }

        $this->redirect("dashboard/index?customerId=".$snId);
    }

    /**
     * Function to change user status the record
     *
     * @param sfWebRequest $request
     */
    public function executeChangeUserStatus(sfWebRequest $request)
    {
        $ssStatus 	= $request->getParameter("status");
        $snId 		= $request->getParameter("id");

        $oUsers = new Users();
        $oUsers->changeStatus($snId, $ssStatus);

        $users = Doctrine::getTable('Users')->find(array($snId));
        if($users->getWebsiteSubscriotion() == "Yes")
		{
			$oUsersWebsite = new UsersWebsite();
			$oUsersWebsite->setWebsiteStatus($users->getId(),$ssStatus);
		}

        if($ssStatus == "Active")
        $this->getUser()->setFlash("succMsg","Status successfully changed to Active.");
        elseif($ssStatus == "Inactive")
        $this->getUser()->setFlash("succMsg","Status successfully changed to inactive.");

        $this->redirect("dashboard/index?customerId=".$snId);
    }

    /**
     * Function to Edit the record
     *
     * @param sfWebRequest $request
     */
    public function executeEdit(sfWebRequest $request)
    {
        //When admin Edit from user listing
        $this->flag = '';
        if($request->hasParameter('flag'))
        $this->flag = $request->getParameter('flag');

        $this->webTem = "";
        $this->netWork = "";
        $this->weburlTem = "";
        $this->displayWebBox = "";
        $this->forward404Unless($users = Doctrine::getTable('Users')->find(array($request->getParameter('id'))), sprintf('Object users does not exist (%s).', $request->getParameter('id')));

        $users =  UsersTable::getUserWithPA($request->getParameter('id'));
        $this->snUserId = $request->getParameter('id');

        $this->webTem = $users->getWebsiteSubscriotion();
        $this->netWork = $users->getNetworkProfileSubscription();
        //clsCommon::pr($users->getU,1);
        $this->form = new AdminUsersCustomersForm($users,array('edit'=>true,'id'=>$users->getId(),'email'=>$users->getEmail()));

        #SET THE BILLING SUBSCRIPTION CHECK AS WELL AS SET THE VALUE;
        if ($users->getBillingSubscription() == "Yes") {
            $this->form->setDefault('BillingSubscription', true);
        }elseif ($users->getBillingSubscription() == "No") {
            $this->form->setDefault('BillingSubscription', false);
        }else {
            $this->form->setDefault('BillingSubscription', false);
        }

        #SET THE WEBSITE SUBSCRIPTION CHECK AS WELL AS SET THE VALUE;
        if ($users->getWebsiteSubscriotion() == "Yes") {
            $this->weburlTem = $users->getUsersUsersWebsite()->getWebsiteurl();
            $this->form->setDefault('WebsiteSubscriotion', true);
        } else if($users->getWebsiteSubscriotion() == "No"){
            $this->form->setDefault('WebsiteSubscriotion', false);
        } else {
            $this->form->setDefault('WebsiteSubscriotion', false);
        }

        #SET THE NETWORK SUBSCRIPTION CHECK AS WELL AS SET THE VALUE;
        if ($users->getNetworkProfileSubscription() == "Yes") {
            $networkList = UserPracticeAreaTable::getRecordList($users->getId());
            //clsCommon::pr($networkList,1);
            $this->form->setDefault('Network',$networkList);
            $this->form->setDefault('NetworkProfileSubscription', true);
        }elseif ($users->getNetworkProfileSubscription() == "No") {
            $this->form->setDefault('NetworkProfileSubscription', false);
        }else {
            $this->form->setDefault('NetworkProfileSubscription', false);
        }
    }

    /**
     * Function to Update the record
     *
     * @param sfWebRequest $request
     */
    public function executeUpdate(sfWebRequest $request)
    {
        //When admin Edit from user listing
        $flag = '';
        if($request->hasParameter('flag'))
        $flag = $request->getParameter('flag');


        $this->webTem = "";     // set default webtem
        $this->weburlTem = "";  // set default weburltem

        //$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($users = Doctrine::getTable('Users')->find(array($request->getParameter('id'))), sprintf('Object users does not exist (%s).', $request->getParameter('id')));

        $this->webTem = $users->getWebsiteSubscriotion(); // get websitesubscription
        $this->netWork = $users->getNetworkProfileSubscription();        

        $this->form = new AdminUsersCustomersForm($users,array('edit'=>true));
        unset($this->form['Password']);
        $this->processForm($request, $this->form,$flag);

        $this->setTemplate('edit');
    }

    /**
     * Function to process at insert and update time
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     */
    protected function processForm(sfWebRequest $request, sfForm $form, $flag)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $usersTem = $request->getParameter($form->getName());
        #clsCommon::pr($usersTem,1);

        if ($form->isValid())
        {

            $EmailCheck = 0; $WebUrlCheck = 0; $hasError =0;
            if ($request->isMethod(sfRequest::PUT)) {
                $EmailCheck = UsersTable::emailCheck($request->getParameter('id'),$usersTem['Email']);
            }
            if ($request->isMethod(sfRequest::PUT)) {
                $this->forward404Unless($urlCheckusers = Doctrine::getTable('Users')->find(array($request->getParameter('id'))), sprintf('Object users does not exist (%s).', $request->getParameter('id')));
                $WebUrlCheck = UsersWebsiteTable::urlCheck($urlCheckusers->getUsersUsersWebsite()->getId(),$urlCheckusers->getUsersUsersWebsite()->getUserId(),$usersTem['Weburl']);

                // Here To Make Entry For Website on Edit Mode by Chintan
                if($urlCheckusers->getUsersUsersWebsite()->getId() == '' && isset($usersTem['WebsiteSubscriotion']) && $usersTem['WebsiteSubscriotion'] == "on") {

                    $oTheme = new Theme();
                    $snThemeId = $oTheme->getDefaultId();

                    /*End get default Id */
                    $objUserWebsite = new UsersWebsite();
                    $objUserWebsite->setUserId($urlCheckusers->getUsersUsersWebsite()->getUserId());
                    $objUserWebsite->setThemeId($snThemeId[0]["Id"]);
                    $objUserWebsite->setWebsiteurl($usersTem['Weburl']);
                    $objUserWebsite->save();

                    #$this->optionRecordInsert($objUserWebsite);
                    clsCommon::optionRecordInsert($objUserWebsite);

                    $userWebsiteArr = array();
                    $userWebsiteArr['websiteId'] = $objUserWebsite->getId();
                    $userWebsiteArr['userId'] = $objUserWebsite->getUserId();
                    $userWebsiteArr['themeId'] = $objUserWebsite->getThemeId();
                    $userWebsiteArr['weburl'] = $objUserWebsite->getWebsiteurl();
                    $userWebsiteArr['defaultThemeId'] = $snThemeId[0]["Id"];
                    $userWebsiteArr['status'] = $objUserWebsite->getStatus();
                    $this->generateSiteDefaultContent($userWebsiteArr);

                }   // Complete
                elseif($urlCheckusers->getUsersUsersWebsite()->getId() != ''  && isset($usersTem['WebsiteSubscriotion']) && $usersTem['WebsiteSubscriotion'] == "on")
                {
					$oUsersWebsite = new UsersWebsite();
					$oUsersWebsite->setWebsiteStatus($request->getParameter('id'), "Active");
                }
                
                /* START  code added by jadip dodiya */
                if($urlCheckusers->getUsersUsersWebsite()->getId() != '' && !array_key_exists('WebsiteSubscriotion',$usersTem))
                {
					$oUsersWebsite = new UsersWebsite();
					$oUsersWebsite->setWebsiteStatus($request->getParameter('id'), "Inactive");
					//clsCommon::deleteWebsiteFromTable($urlCheckusers->getUsersUsersWebsite()->getId());
                }
                /* END code added by jadip dodiya */

            }

            if($EmailCheck == 0) {
                if ($WebUrlCheck == 0){
                    if ($request->isMethod(sfRequest::PUT)) {

                        UsersTable::updateUserData($usersTem,$request->getParameter('id'));
                        if (isset($usersTem['Weburl']) && $usersTem['Weburl'] != "" && isset($usersTem['WebsiteSubscriotion']) && $usersTem['WebsiteSubscriotion'] == "on") {
                            UsersWebsiteTable::updateWebUrl($urlCheckusers->getUsersUsersWebsite()->getId(),$urlCheckusers->getUsersUsersWebsite()->getUserId(),$usersTem['Weburl']);


                        }
                        if (isset($usersTem['Network']) && !empty($usersTem['Network']) && isset($usersTem['NetworkProfileSubscription']) && $usersTem['NetworkProfileSubscription'] == "on") {
                            UserPracticeAreaTable::deleteOldPracticeAreaData($request->getParameter('id'));
                            /*for ($p=0;$p<count($usersTem['Network']);$p++)
                            {

                            if ($usersTem['Network'][$p] == -1) {
                            $objUserNetwork = new UserPracticeArea();
                            $objUserNetwork->setUserId($request->getParameter('id'));
                            $objUserNetwork->setPracticeareaId(1);
                            $objUserNetwork->save();
                            }else {
                            $objUserNetwork = new UserPracticeArea();
                            $objUserNetwork->setUserId($request->getParameter('id'));
                            $objUserNetwork->setPracticeareaId($usersTem['Network'][$p]);
                            $objUserNetwork->save();
                            }
                            } */// End of For


                            for ($i=0;$i<count($usersTem['Network']);$i++)
                            {
                                if ($usersTem['Network'][$i] == "-1") {
                                    $objUserNetwork = new UserPracticeArea();
                                    $objUserNetwork->setUserId($request->getParameter('id'));
                                    $objUserNetwork->setPracticeareaId('-1');
                                    $objUserNetwork->setCatId(0);
                                    $objUserNetwork->setSubCatId(0);
                                    $objUserNetwork->setChildId(0);
                                    $objUserNetwork->setLevel(0);
                                    $objUserNetwork->save();
                                }else {
                                    $objUserNetwork = new UserPracticeArea();
                                    $practiceAreaArr = explode('-',$usersTem['Network'][$i]);

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


                                    $objUserNetwork->setUserId($request->getParameter('id'));
                                    #$objUserNetwork->setPracticeareaId($usersTem['Network'][$i]);
                                    $objUserNetwork->setPracticeareaId($practiceAreaArr[0]);
                                    $objUserNetwork->save();
                                }
                            } // end of For

                        }
                        $this->getUser()->setFlash('succMsg', "Update successful.");

                        //When admin Edit from user listing
                        if($flag == true)
                        $this->redirect('users/index');

                        $this->redirect('dashboard/index?customerId='.$request->getParameter('id'));
                    }
                }else {
                    $this->getUser()->setFlash('errMsg', "URL already in use.  Please try again.");

                    //When admin Edit from user listing
                    if($flag == true)
                    $this->redirect('dashboard/edit?id='.$request->getParameter('id').'&customerId='.$request->getParameter('id').'&flag='.$flag);

                    $this->redirect('dashboard/edit?id='.$request->getParameter('id').'&customerId='.$request->getParameter('id'));
                }
            }else {
                $this->getUser()->setFlash('errMsg', "E-mail address already in use.  Please try again.");

                //When admin Edit from user listing
                if($flag == true)
                $this->redirect('dashboard/edit?id='.$request->getParameter('id').'&customerId='.$request->getParameter('id').'&flag='.$flag);

                $this->redirect('dashboard/edit?id='.$request->getParameter('id').'&customerId='.$request->getParameter('id'));
            }
        }
    }

    /* this function is for insert record in ThemeOptions table */
    /**
     * Function to insert record in ThemeOptions table
     *
     * @param object $objUserWebsite
     */
    public function optionRecordInsert1($objUserWebsite)
    {
        /* get default Theme Record */
        $snThemeId = ThemeTable::getDefaultRecord();
        $ssOption = $snThemeId[0]["Options"];
        $asOptions = unserialize($ssOption);

        /*if($asOptions[sfConfig::get("app_Color_Logo")] == "Yes")
        {
        // START move logo from one folder to another
        $asPathInfo = pathinfo(sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'../images/admin/logo.png');
        $ssImageName = $objUserWebsite->getId()."L_".$asPathInfo["basename"];

        //to crate the website id folder
        $ssWebPath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.sfConfig::get("app_LogoPath_WebsitePath").DIRECTORY_SEPARATOR.$objUserWebsite->getId();
        if(!is_dir($ssWebPath))
        {
        mkdir($ssWebPath, 0777);
        }

        //to create the logo folder
        $ssLogoPath = $ssWebPath.DIRECTORY_SEPARATOR.sfConfig::get("app_LogoPath_LogoPath");
        if(!is_dir($ssLogoPath))
        {
        mkdir($ssLogoPath, 0777);
        }

        $ssDestinationPath = $ssLogoPath.DIRECTORY_SEPARATOR.$ssImageName;
        // to copy the image to destination path
        copy(sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'../images/admin/logo.png', $ssDestinationPath);
        $asOptions[sfConfig::get("app_Color_Logo")] = $ssImageName;
        // End move logo from one folder to another
        }*/

        /* this for loop is for insert blank textwidget */
        /*for($i=1; $i<=$asOptions["TextWidgets"]; $i++)
        {
        $asOptions[sfConfig::get('app_Color_TextWidgets')."_".$i] = "";
        $asOptions[sfConfig::get("app_Color_TextWidgetsTitle")."_".$i] = "";
        }

        unset($asOptions["TextWidgets"]); */
        /* insert record in table */
        foreach($asOptions as $key => $asOption)
        {
            $notRequired = array('Logo', 'TextWidgets');
            if(!in_array($key, $notRequired ))    {
                $oThemeOptions = new ThemeOptions();
                $oThemeOptions->setThemeId($snThemeId[0]["Id"]);
                $oThemeOptions->setWebsiteId($objUserWebsite->getId());
                $oThemeOptions->setOptionKey($key);
                $oThemeOptions->setOptionValue($asOption);
                $oThemeOptions->save();
            }
        }
    } // End of Function



    /**
     * This function is for insert default content for website if User is selected for Website Subscription  
     *
     * @param object $objUserWebsite
     */
    #public function executeGenerateSiteDefaultContent(sfWebRequest $request ,$userWebsiteArr = array())
    public function generateSiteDefaultContent($userWebsiteArr = array())
    {
        $defaultTheme = $userWebsiteArr['defaultThemeId'] ;
        $websiteId = $userWebsiteArr['websiteId'] ;
        $themeId = $userWebsiteArr['themeId'] ;
        $userId = $userWebsiteArr['userId'] ;

        // Get Theme Options
        $themeObj = Doctrine::getTable('Theme')->find($defaultTheme);
        $themeOptions = unserialize($themeObj->getOptions());


        // Create defaylt Folders in Uploads Folder under website/websiteid
        clsCommon::createPersonalWebsiteDefaultFolders($websiteId);
        // Code Complete to Set up Default Website folder

        $XMLArr = clsCommon::getThemeDefaultContent($websiteId, $defaultTheme);


        $dataFolder = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR;
        $thmeFolder = 'theme'.$defaultTheme.DIRECTORY_SEPARATOR;

        /*$xmlFile = 'setup.xml';
        $xlFilePath = $dataFolder.$thmeFolder.'xml'.DIRECTORY_SEPARATOR.$xmlFile;*/
        $logoFilePath = $dataFolder.$thmeFolder.'logo'.DIRECTORY_SEPARATOR.'logo.png';
        $bannerFilePath = $dataFolder.$thmeFolder.'banner'.DIRECTORY_SEPARATOR;

        $fileExist = true ;

        if($fileExist) {

            // Theme Color Combination
            $colorCombArr = array();
            /*if(isset($XMLArr['themecolor']) && !empty($XMLArr['themecolor']) )  {
            for($i=0; $i< count($XMLArr['themecolor']['item']) ; $i++) {
            $colorCombArr[$i]['OptionKey'] = $XMLArr['themecolor']['item'][$i]['optionkey'];
            $colorCombArr[$i]['OptionValue'] = $XMLArr['themecolor']['item'][$i]['optionvalue'];
            } // End of For
            }*/
            // Complete Theme Color

            // Start Body Background
            $bodyBackgroundArr = array();
            if(isset($XMLArr['bodybackground']) && !empty($XMLArr['bodybackground']) )  {
                $bodyBackgroundImage = explode('/',$XMLArr['bodybackground']['item']['optionvalue']);
                $bodyBackgroundName = end($bodyBackgroundImage);
                $sourceBodyBackground = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'Media'.DIRECTORY_SEPARATOR.$XMLArr['bodybackground']['item']['optionvalue'];
                $destinationBodyBackground = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$websiteId.DIRECTORY_SEPARATOR.'body-background'.DIRECTORY_SEPARATOR.$bodyBackgroundName;
                copy($sourceBodyBackground, $destinationBodyBackground);
                $bodyBackgroundArr[0]['OptionKey'] = $XMLArr['bodybackground']['item']['optionkey'];
                $bodyBackgroundArr[0]['OptionValue'] = $bodyBackgroundName;
            }
            // End Body Background

            // Logo
            $logoArr = array();
            if(isset($XMLArr['logo']) && !empty($XMLArr['logo']) )  {
                /*$sourceLogo = $logoFilePath;
                $logoName = $websiteId."L_".$XMLArr['logo']['item']['optionvalue'];*/
                
                $logoImage = explode('/',$XMLArr['logo']['item']['optionvalue']);
                $logoName = end($logoImage);
                $sourceLogo = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'Media'.DIRECTORY_SEPARATOR.$XMLArr['logo']['item']['optionvalue'];
                $destinationLogo = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$websiteId.DIRECTORY_SEPARATOR.'logo'.DIRECTORY_SEPARATOR.$logoName;
                copy($sourceLogo, $destinationLogo);
                $logoArr[0]['OptionKey'] = $XMLArr['logo']['item']['optionkey'];
                $logoArr[0]['OptionValue'] = $logoName;
            } // Check if Exist in XML or not
            // End Logo


            // TextWidget
            $textWidgetArr = array();
            if(isset($XMLArr['textwidget']) && !empty($XMLArr['textwidget']) )  {
                for($i=0, $j = 0;  $i< count($XMLArr['textwidget']['item']) ; $i++ , $j=$j+2) {
                
					if(!empty($XMLArr['textwidget']['item'][$i]['title']))
					{
						$textWidgetArr[$j]['OptionKey'] = 'TextWidgetsTitle_'.($i+1);
						$textWidgetArr[$j]['OptionValue'] = $XMLArr['textwidget']['item'][$i]['title'];

						$textWidgetArr[$j+1]['OptionKey'] = 'TextWidgets_'.($i+1);
						$textWidgetArr[$j+1]['OptionValue'] = $XMLArr['textwidget']['item'][$i]['content'];
					}
                } // End of For
            } // Complete if Exist in XML or not
            // Complete Text Widget

            // Social Media
            $socialMediaArr = array();
            if(isset($XMLArr['socialmedia']) && !empty($XMLArr['socialmedia']) )  {
                for($i=0; $i< count($XMLArr['socialmedia']['item']) ; $i++) {
                    $socialMediaArr[$i]['OptionKey'] = $XMLArr['socialmedia']['item'][$i]['optionkey'];
                    $socialMediaArr[$i]['OptionValue'] = $XMLArr['socialmedia']['item'][$i]['optionvalue'];
                } // End of For
            } // Complete if Exist in XML or not
            // Complete Social Media

            $ThemeOptionsArr = array();
            $ThemeOptionsArr = array_merge($colorCombArr, $logoArr,  $textWidgetArr, $socialMediaArr, $bodyBackgroundArr);
            // Complete


            /*clsCommon::pr($colorCombArr);
            clsCommon::pr($logoArr);
            clsCommon::pr($textWidgetArr);
            clsCommon::pr($socialMediaArr);
            clsCommon::pr($ThemeOptionsArr);*/


            // Save Theme Options to DB
            if(!empty($ThemeOptionsArr)  ) {
                foreach($ThemeOptionsArr as $key => $asOption)         {
                    $themeOptions = new ThemeOptions();
                    $themeOptions->setThemeId($themeId);
                    $themeOptions->setWebsiteId($websiteId);
                    $themeOptions->setOptionKey(trim($asOption['OptionKey']));
                    $themeOptions->setOptionValue(trim($asOption['OptionValue']));
                    $themeOptions->save();
                } // End of Theme Option Save
            } // Complete If theme Option not empty

            // Contact  US Form
            if(isset($XMLArr['contactpage']) && !empty($XMLArr['contactpage']) )  {
                for($i= 0; $i<count($XMLArr['contactpage']['item']) ; $i++) {

                    $options = '';
                    if( in_array($XMLArr['contactpage']['item'][$i]['fieldtype'], array('DropDown', 'CheckBox', 'Radio'))) {
                        $options = $XMLArr['contactpage']['item'][$i]['options'];
                    }

                    $maxContactOrder = CustomerContactTable::contactMaxOrder($userId);
                    $objContact = new CustomerContact();
                    $objContact->setUserId($userId);
                    $objContact->setLabel($XMLArr['contactpage']['item'][$i]['label']);
                    $objContact->setFieldType($XMLArr['contactpage']['item'][$i]['fieldtype']);
                    $objContact->setOptions($options);
                    $objContact->setRequired($XMLArr['contactpage']['item'][$i]['required']);
                    $objContact->setOrdering($maxContactOrder);
                    $objContact->save();
                } // End of For

            } // Complete if Exist in XML or not

            // End of Contact Form

            // FAQ
            if(isset($XMLArr['faq']) && !empty($XMLArr['faq']) )  {
                for($i= 0; $i<count($XMLArr['faq']['item']) ; $i++) {
                    // Save in FAQ
                    $objFaq = new FAQs();
                    $objFaq->setQuestion(trim($XMLArr['faq']['item'][$i]['question']));
                    $objFaq->setAnswer(trim($XMLArr['faq']['item'][$i]['answer']));
                    $objFaq->setGloble(trim('No'));
                    $objFaq->save();

                    // Save in Web FAQ
                    $maxFaqOrder = WebsiteXFAQsTable::faqMaxOrder($websiteId);
                    $objWebFaq = new WebsiteXFAQs();
                    $objWebFaq->setFAQId($objFaq->getId());
                    $objWebFaq->setWebsiteId($websiteId);
                    $objWebFaq->setOrdering($maxFaqOrder);
                    $objWebFaq->save();

                } // End of For
            } // Complete if Exist in XML or not
            // End of FAQ

            // Banners
            if(isset($XMLArr['banner']) && !empty($XMLArr['banner']) )  {
                for($i= 0; $i<count($XMLArr['banner']['item']) ; $i++) {

                    if(!empty($XMLArr['banner']['item'][$i]))
                    {
						$bImage = explode('/',$XMLArr['banner']['item'][$i]['image']);
						$bImage = end($bImage);

						$sourceBanner = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'Media'.DIRECTORY_SEPARATOR.$XMLArr['banner']['item'][$i]['image'];
						$destinationBanner = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$websiteId.DIRECTORY_SEPARATOR.'banner'.DIRECTORY_SEPARATOR.$bImage;
						copy($sourceBanner, $destinationBanner);

						$destinationThumbBanner = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$websiteId.DIRECTORY_SEPARATOR.'banner'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$bImage;
						#$thumbnail = new sfThumbnail(sfConfig::get('app_BannerImageSize_Height'), sfConfig::get('app_BannerImageSize_Width'),true,true,100);
						$thumbnail = new sfThumbnail(sfConfig::get('app_BannerCustomImage_ThumbHeight'), sfConfig::get('app_BannerCustomImage_ThumbWidth'),true,true,100);
						$thumbnail->loadFile($destinationBanner);
						$thumbnail->save($destinationThumbBanner);

						$objBanner = new ThemeBanner();
						$objBanner->setThemeId(trim($themeId));
						$objBanner->setWebsiteId(trim($websiteId));
						$objBanner->setImage(trim($bImage));
						$objBanner->setBannerName(trim($XMLArr['banner']['item'][$i]['bannername']));
						$objBanner->setTitle1(trim($XMLArr['banner']['item'][$i]['title1']));
						$objBanner->setTitle2(trim($XMLArr['banner']['item'][$i]['title2']));
						$objBanner->setTitle3(trim($XMLArr['banner']['item'][$i]['title3']));
						$objBanner->save();
                    }// END IF

                } // End of For

                // Banner Back ground
                if(isset($XMLArr['banner']['backgroundimage']) && !empty($XMLArr['banner']['backgroundimage'])) {
                    $bgImage = explode('/',$XMLArr['banner']['backgroundimage']);
                    $bgImage = end($bgImage);

                    $sourceBGBanner = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'Media'.DIRECTORY_SEPARATOR.$XMLArr['banner']['backgroundimage'];
                    $destinationBGBanner = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$websiteId.DIRECTORY_SEPARATOR.'banner-background'.DIRECTORY_SEPARATOR.$bgImage;
                    copy($sourceBGBanner, $destinationBGBanner);

                    // Save in Theme Option table
                    $themeOptions = new ThemeOptions();
                    $themeOptions->setThemeId($themeId);
                    $themeOptions->setWebsiteId($websiteId);
                    $themeOptions->setOptionKey('BGImage');
                    $themeOptions->setOptionValue($bgImage);
                    $themeOptions->save();

                } // end of if with banner -background


            } // Complete if Exist in XML or not
            // Complete Banner

            // CMS Pages
            if(isset($XMLArr['cmspages']) && !empty($XMLArr['cmspages']) )  {
                for($i= 0; $i<count($XMLArr['cmspages']['item']) ; $i++) {
                    $objCmsPage = new CMSPages();
                    $objCmsPage->setWebsiteId(trim($websiteId));
                    $objCmsPage->setTitle(trim($XMLArr['cmspages']['item'][$i]['title']));
                    $objCmsPage->setSubTitle(trim($XMLArr['cmspages']['item'][$i]['subtitle']));
                    $objCmsPage->setMetaTitle(trim($XMLArr['cmspages']['item'][$i]['metatitle']));
                    $objCmsPage->setMetaKeywords(trim($XMLArr['cmspages']['item'][$i]['metakeywords']));
                    $objCmsPage->setMetaDescription(trim($XMLArr['cmspages']['item'][$i]['metadescription']));
                    $objCmsPage->setContent(trim($XMLArr['cmspages']['item'][$i]['content']));
                    $objCmsPage->setTemplate(trim($XMLArr['cmspages']['item'][$i]['template']));
                    $objCmsPage->setStatus(sfConfig::get('app_Status_Active'));
                    #$objCmsPage->setStatus(trim($XMLArr['cmspages']['item'][$i]['status']));
                    $objCmsPage->setUniqueKey(trim($websiteId.'_'.$XMLArr['cmspages']['item'][$i]['slug']));

                    // Code For Slug
                    $slugTitle = $XMLArr['cmspages']['item'][$i]['slug'];
                    $reservedSlugForPageAndPracticeArea = sfConfig::get('app_ReservedSlugForPageAndPracticeArea_keywords') ;
                    if(in_array($slugTitle, $reservedSlugForPageAndPracticeArea)) {
                        $slugTitle = $slugTitle;
                    } else {
                        $slugTitle = clsCommon::getCmsPageSlug($websiteId, $XMLArr['cmspages']['item'][$i]['title'] );
                    }
                    $objCmsPage->setSlug(trim($slugTitle));
                    $objCmsPage->save();
                } // End of Banner
            } // Complete if Exist in XML or not
            // End CMS Pages

            // Practice Areas
            if(isset($XMLArr['practice-areas']) && !empty($XMLArr['practice-areas']) )  {
                for($i= 0; $i<count($XMLArr['practice-areas']['item']) ; $i++) {
                    $objPractice = new WebsitePracticeArea();
                    $objPractice->setWebsiteId(trim($websiteId));
                    $objPractice->setTitle(trim($XMLArr['practice-areas']['item'][$i]['title']));
                    $objPractice->setSubTitle(trim($XMLArr['practice-areas']['item'][$i]['subtitle']));
                    $objPractice->setMetaTitle(trim($XMLArr['practice-areas']['item'][$i]['metatitle']));
                    $objPractice->setMetaKeywords(trim($XMLArr['practice-areas']['item'][$i]['metakeywords']));
                    $objPractice->setMetaDescription(trim($XMLArr['practice-areas']['item'][$i]['metadescription']));
                    $objPractice->setContent(trim($XMLArr['practice-areas']['item'][$i]['content']));

                    $objPractice->setTemplate(trim($XMLArr['practice-areas']['item'][$i]['template']));
                    $objPractice->setStatus(sfConfig::get('app_Status_Active'));

                    $practiceSlug = clsCommon::getPracticeAreaSlug($websiteId, $XMLArr['practice-areas']['item'][$i]['title'] );
                    $objPractice->setSlug(trim($practiceSlug));
                    $objPractice->save();
                } // End  For
            } // Complete if Exist in XML or not

            // End of Practice Areas

            // Footer Menu
            if(isset($XMLArr['footermenu']) && !empty($XMLArr['footermenu']) )  {
                for($i= 0; $i<count($XMLArr['footermenu']['item']) ; $i++) {

                    $fMenuTitle = trim($XMLArr['footermenu']['item'][$i]['title']);
                    $fType = trim($XMLArr['footermenu']['item'][$i]['type']);
                    $fSlugTitle = clsCommon::slugify($fMenuTitle);

                    if($fType == 1){
                        $cmsPageId = CMSPagesTable::getCMSPageBasedonSlug($websiteId, $fSlugTitle);
                        $websitePracticeAreaId = 0 ;
                    } else if($fType == 2) {
                        $cmsPageId = 0;
                        $websitePracticeAreaId = WebsitePracticeAreaTable::getPracticeAreaBasedonSlug($websiteId, $fSlugTitle);
                    }
                    $maxMenuOrder = WebsiteMenuTable::MenuMaxOrder($websiteId , sfConfig::get('app_MenuType_Footer'));

                    $objFooter = new WebsiteMenu();
                    $objFooter->setWebsiteId(trim($websiteId));
                    $objFooter->setCmsPageId($cmsPageId);
                    $objFooter->setWebsitePracticeAreaId($websitePracticeAreaId);
                    $objFooter->setParentId(0);
                    $objFooter->setTitle(trim($fMenuTitle));
                    $objFooter->setType(trim($fType));
                    $objFooter->setMenuType(sfConfig::get('app_MenuType_Footer'));
                    $objFooter->setOrdering($maxMenuOrder);
                    $objFooter->save();
                } // End  For
            } // Complete if Exist in XML or not
            // End of Footer Menu

            // Header Menu
            if(isset($XMLArr['headermenu']) && !empty($XMLArr['headermenu']) )  {
                for($i= 0; $i<count($XMLArr['headermenu']['item']) ; $i++) {

                    $hMenuTitle = trim($XMLArr['headermenu']['item'][$i]['title']);
                    $hSlugTitle = clsCommon::slugify($hMenuTitle);
                    $menuTitleArr = array('Home','FAQ','FAQs','Contact','Contact US','Contact Us');

                    if(in_array($hMenuTitle, $menuTitleArr)){

                        if($hMenuTitle == 'Home'){
                            $hSlugTitle = 'home';
                        } else if (in_array($hMenuTitle, array('FAQ', 'FAQs' ))) {
                            $hSlugTitle = 'faq';
                        } else if (in_array($hMenuTitle, array('Contact', 'Contact US', 'Contact Us' ))){
                            $hSlugTitle = 'contact';
                        } else {
                            $hSlugTitle = 'home';
                        }

                    } // End of

                    $hType = trim($XMLArr['headermenu']['item'][$i]['type']);
                    if($hType == 1){
                        $cmsPageId = CMSPagesTable::getCMSPageBasedonSlug($websiteId, $hSlugTitle);
                        $websitePracticeAreaId = 0 ;
                    } else if($hType == 2) {
                        $cmsPageId = 0;
                        $websitePracticeAreaId = WebsitePracticeAreaTable::getPracticeAreaBasedonSlug($websiteId, $hSlugTitle);
                    }
                    $maxMenuOrder = WebsiteMenuTable::MenuMaxOrder($websiteId , sfConfig::get('app_MenuType_Header'));

                    // Save Header MAin Menu
                    $objHeader = new WebsiteMenu();
                    $objHeader->setWebsiteId(trim($websiteId));
                    $objHeader->setCmsPageId($cmsPageId);
                    $objHeader->setWebsitePracticeAreaId($websitePracticeAreaId);
                    $objHeader->setParentId(0);
                    $objHeader->setTitle(trim($hMenuTitle));
                    $objHeader->setType(trim($hType));
                    $objHeader->setMenuType(sfConfig::get('app_MenuType_Header'));
                    $objHeader->setOrdering($maxMenuOrder);
                    $objHeader->save();
                    $parentMenuId =  $objHeader->getId();

                    // For Submenu
                    if(isset($XMLArr['headermenu']['item'][$i]['subitem']) && !empty($XMLArr['headermenu']['item'][$i]['subitem']))  {
                        $subMenuArr = $XMLArr['headermenu']['item'][$i]['subitem'] ;
                        #clsCommon::pr($subMenuArr);
                        #echo count($subMenuArr);
                        #die;
                        for($j= 0; $j <count($subMenuArr) ; $j++) {

                            $sMenuTitle = trim($subMenuArr[$j]['title']);
                            $sSlugTitle = clsCommon::slugify($sMenuTitle);
                            $sType = trim($subMenuArr[$j]['type']);

                            if($sType == 1){
                                $cmsPageId = CMSPagesTable::getCMSPageBasedonSlug($websiteId, $sSlugTitle);
                                $websitePracticeAreaId = 0 ;
                            } else if($sType == 2) {
                                $cmsPageId = 0;
                                $websitePracticeAreaId = WebsitePracticeAreaTable::getPracticeAreaBasedonSlug($websiteId, $sSlugTitle);
                            }
                            $maxMenuOrder = WebsiteMenuTable::MenuMaxOrder($websiteId , sfConfig::get('app_MenuType_Header'));

                            // Save Header MAin Menu
                            $objSubMenu = new WebsiteMenu();
                            $objSubMenu->setWebsiteId(trim($websiteId));
                            $objSubMenu->setCmsPageId($cmsPageId);
                            $objSubMenu->setWebsitePracticeAreaId($websitePracticeAreaId);
                            $objSubMenu->setParentId($parentMenuId);
                            $objSubMenu->setTitle(trim($sMenuTitle));
                            $objSubMenu->setType(trim($sType));
                            $objSubMenu->setMenuType(sfConfig::get('app_MenuType_Header'));
                            $objSubMenu->setOrdering($maxMenuOrder);
                            $objSubMenu->save();
                        } // End of For Loop For sub Menu

                    } // End of IF

                } // End  For Header Parent Menu
            } // Complete if Exist in XML or not
            // End of Header Menu


        } // IF XML File Exsit then Do entry


    } // End of Function

}