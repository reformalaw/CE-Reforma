<?php

/**
 * users actions.
 *
 * @package    counceledge
 * @subpackage users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class usersActions extends sfActions
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
     * Function to Listing the records
     *
     * @param sfWebRequest $request
     */
    public function executeIndex(sfWebRequest $request)
    {

        if($this->getUser()->hasCredential('customer')){
            $this->redirect('default/index');
        } // end of IF

        $this->orderBy = "";
        $this->orderType="";
        $where = "";
        $search_text = '';
        $isSearchBtn = '';
        $this->search_text = "";
        $this->field_type = "";
        $this->objSearchForm = new SearchAdminUsersCustomersForm();

        $qSearch = Doctrine_Query::create();
        $qSearch->from('Users us');
        $qSearch->where('us.Status != ?', sfConfig::get('app_UserStatus_Deleted'));
        $qSearch->where('us.UserType = ?', sfConfig::get('app_UserType_Customer'));
        $this->val = false;
        #clsCommon::pr($_POST);
        if($request->isMethod('post')) {
            $isSearchBtn = $request->getPostParameter('search_btn');
            $this->search_text  = trim($request->getPostParameter('search_admin_users_customers[search_text]'));
            $this->field_type   = $request->getPostParameter('search_admin_users_customers[field_type]');
            $this->status       = $request->getPostParameter('search_admin_users_customers[status]');


            if ($this->BillingSubscription == "Yes") {
                $tempVariable = "BillingSubscription";
            }elseif ($this->WebsiteSubscriotion == "Yes"){
                $tempVariable = "WebsiteSubscriotion";
            }else {
                $tempVariable = "NetworkProfileSubscription";
            }

            if ('' != $this->field_type && '' != $this->search_text)
            {
                $qSearch->andWhere("us.$this->field_type LIKE '%".addslashes($this->search_text)."%'");
            }
            if ($this->field_type != "" && $this->status != "") {
                $qSearch->andWhere("us.$this->field_type = ?","$this->status");
                #$qSearch->orWhere("us.$this->field_type = ?","");
                $this->val = true;
            }
        }

        $this->objSearchForm->setDefault('search_text', $this->search_text);
        $this->objSearchForm->setDefault('field_type', $this->field_type);
        $this->objSearchForm->setDefault('status', $this->status);

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
            case "LastLoginDateTime":
                $orderBy = 'LastLoginDateTime';
                $this->orderBy = "LastLoginDateTime";
                break;
            case "CreateDateTime":
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
     * Function to Insert New record
     *
     * @param sfWebRequest $request
     */
    public function executeNew(sfWebRequest $request)
    {
        $this->displayWebBox = "";
        $this->webTem = "";
        $this->netWork = "";
        $this->weburlTem ="";
        $this->form = new AdminUsersCustomersForm();
        /*$this->webTem = '';
        $this->netWork = '';
        $this->weburlTem = '';*/
    }

    /**
     * Function to Create the record
     *
     * @param sfWebRequest $request
     */
    public function executeCreate(sfWebRequest $request)
    {   #clsCommon::pr($_POST);
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new AdminUsersCustomersForm();

        $this->webTem = "";    // set default webtem
        $this->weburlTem = "";  // set default weburltem
        $this->displayWebBox = "";
        $this->netWork = "";
        if (isset($_POST['admin_users_customers']['WebsiteSubscriotion']) && $_POST['admin_users_customers']['WebsiteSubscriotion'] == "on") {
            $this->displayWebBox = 1;
        }
        if ($_POST['admin_users_customers']['Weburl'] != "") {
            $this->weburlTem = $_POST['admin_users_customers']['Weburl'];  // set default weburltem
        }
        
        if (isset($_POST['admin_users_customers']['NetworkProfileSubscription']) && $_POST['admin_users_customers']['NetworkProfileSubscription'] == "on") {
            $this->netWork = 'Yes';
        }
        

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * Function to Edit the record
     *
     * @param sfWebRequest $request
     */
    public function executeEdit(sfWebRequest $request)
    {
        $this->webTem = "";
        $this->netWork = "";
        $this->weburlTem = "";
        $this->displayWebBox = "";
        $this->forward404Unless($users = Doctrine::getTable('Users')->find(array($request->getParameter('id'))), sprintf('Object users does not exist (%s).', $request->getParameter('id')));

        $users =  UsersTable::getUserWithPA($request->getParameter('id'));

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
        $this->webTem = "";     // set default webtem
        $this->weburlTem = "";  // set default weburltem

        //$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($users = Doctrine::getTable('Users')->find(array($request->getParameter('id'))), sprintf('Object users does not exist (%s).', $request->getParameter('id')));

        $this->webTem = $users->getWebsiteSubscriotion(); // get websitesubscription

        $this->form = new AdminUsersCustomersForm($users,array('edit'=>true));
        unset($this->form['Password']);
        $this->editprocessForm($request, $this->form);

        $this->setTemplate('edit');
    }

    /**
     * Function to Delete the record
     *
     * @param sfWebRequest $request
     */
    public function executeDelete(sfWebRequest $request)
    {
        //$request->checkCSRFProtection();

        $this->forward404Unless($users = Doctrine::getTable('Users')->find(array($request->getParameter('id'))), sprintf('Object users does not exist (%s).', $request->getParameter('id')));
        //$users->delete();
        if($request->getParameter('id') == $this->getUser()->getAttribute("admin_user_id")){
            $this->getUser()->setFlash("errMsg","Cannot delete yourself.");
        }else{
            $users->setUpdateDateTime(date("Y-m-d H:i:s"));
            $users->setStatus("Deleted");
            $users->save();
            // SEND NOTIFICATION EMAIL TO USER START
            $arrParams = array();
            $arrParams['toEmailAddress'] = $users->getEmail();
            $arrParams['FirstName'] = ucfirst(strtolower($users->getFirstName()));
            $arrParams['Status'] = 'deactivated';

            //COMMENT : GET THE OBJECT OF MAIL CLASS
            $objSiteMails = new siteMails();
            //COMMENT : CALL TO SENDSTATUSCHANGE EMAIL MEHTOD OF MAIL CLASS
            $objSiteMails->sendStatusChangeEmail($arrParams);
            // SEND NOTIFICATION EMAIL TO USER END

            $this->getUser()->setFlash("errMsg","Deletion successful.");

            if($users->getUsersUsersWebsite()->getId() != "")
            {
				clsCommon::deleteWebsiteFromTable($users->getUsersUsersWebsite()->getId());
			}
        }

        $this->redirect('users/index');
    }

    /**
     * Function to process at insert and update time
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     */
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $usersTem = $request->getParameter($form->getName());
        

        if ($form->isValid())
        {
            $hasError = 0; $hasWeburl = 0; $hasUname = 0;
            if (isset($usersTem['WebsiteSubscriotion']) && $usersTem['WebsiteSubscriotion'] == "on" && $usersTem['Weburl'] == "") {
                $hasError = 1;
            }
           
            if (isset($usersTem['NetworkProfileSubscription']) && $usersTem['NetworkProfileSubscription'] == "on" &&  ( empty($usersTem['Network']) || ( count($usersTem['Network']) == 1  && $usersTem['Network'][0] == '-1' ) )   )  { 
                $hasError = 2;
            }
            if ((isset($usersTem['WebsiteSubscriotion']) && $usersTem['WebsiteSubscriotion'] == "on" && $usersTem['Weburl'] == "") && (isset($usersTem['NetworkProfileSubscription']) && $usersTem['NetworkProfileSubscription'] == "on" && empty($usersTem['Network']) == 1))
            {
                $hasError = 3;
            }
            if (isset($usersTem['Weburl']) && $usersTem['Weburl'] != "") {
                $hasWeburl = UserProfileTable::urlExist($usersTem['Weburl']);
            }
            if (isset($usersTem['Username']) && $usersTem['Username'] != "") {
                $hasUname = UsersTable::userNameExist($usersTem['Username']);
            }
            if ($hasError == 1) {
                $this->getUser()->setFlash('errMsg', "Please Provide web url.");
                $this->webTem = 'Yes';
            }else if ($hasError == 2) {
                $this->getUser()->setFlash('errMsg', "Please provide network profile subscription.");
                $this->netWork = 'Yes';
            }else if ($hasError == 3){
                $this->getUser()->setFlash('errMsg', "Please provide weburl and network profile subscription.");
                $this->webTem = 'Yes';$this->netWork = 'Yes';
            }else if ($hasWeburl == true){
                $this->getUser()->setFlash('errMsg', "Please provide another weburl url.");
            }else if ($hasUname == true){
                $this->getUser()->setFlash('errMsg', "Customer name already in use.  Please try again.");
            }else {
                # below code for set the value of billing subscription, website subscription and network profile.
                if (isset($usersTem['BillingSubscription']) && $usersTem['BillingSubscription'] == "on") {
                    $form->getObject()->setBillingSubscription('Yes');
                }else {
                    unset($form['BillingSubscription']);
                    $form->getObject()->setBillingSubscription('No');
                }

                if (isset($usersTem['WebsiteSubscriotion']) && $usersTem['WebsiteSubscriotion'] == "on") {
                    $form->getObject()->setWebsiteSubscriotion('Yes');
                }else {
                    unset($form['WebsiteSubscriotion']);
                    $form->getObject()->setWebsiteSubscriotion('No');
                }

                if (isset($usersTem['NetworkProfileSubscription']) && $usersTem['NetworkProfileSubscription'] == "on") {
                    $form->getObject()->setNetworkProfileSubscription('Yes');
                }else {
                    unset($form['NetworkProfileSubscription']);
                    $form->getObject()->setNetworkProfileSubscription('No');
                }

                $form->getObject()->setStatus(sfConfig::get('app_UserStatus_Pending'));
                $form->getObject()->setUserType(sfConfig::get('app_UserType_Customer'));
                $form->getObject()->setActivationCode(clsCommon::getActivationKey(10));
                $users = $form->save();

                if ($usersTem['Weburl'] != '' &&  isset($usersTem['WebsiteSubscriotion']) && $usersTem['WebsiteSubscriotion'] == "on"){
                    /* get default Theme id */
                    $oTheme = new Theme();
                    $snThemeId = $oTheme->getDefaultId();
                    /*End get default Id */
                    $objUserWebsite = new UsersWebsite();
                    $objUserWebsite->setUserId($users->getId());
                    $objUserWebsite->setThemeId($snThemeId[0]["Id"]);
                    $objUserWebsite->setWebsiteurl($usersTem['Weburl']);
                    $userWebsite = $objUserWebsite->save();



                    # ADD THE DEFAULT HOME PAGE AT CMSPAGES.
                    /*$objDefaultCmspage = new CMSPages();
                    $objDefaultCmspage->setWebsiteId($objUserWebsite->getId());
                    $objDefaultCmspage->setTitle('Home');
                    $objDefaultCmspage->setSubTitle('Home');
                    $objDefaultCmspage->setMetaTitle('Home');
                    $objDefaultCmspage->setMetaKeywords('Home');
                    $objDefaultCmspage->setMetaDescription('Home');
                    $objDefaultCmspage->setContent('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.');
                    $objDefaultCmspage->setTemplate('home');
                    $objDefaultCmspage->setStatus('Active');
                    $objDefaultCmspage->setUniqueKey($users->getId()."_home");
                    $objDefaultCmspage->setSlug('home');
                    $objDefaultCmspage->save();

                    #ADD THE DEFAULT FAQS PAGE AT CMSPAGES.
                    $objDefaultCmspage = new CMSPages();
                    $objDefaultCmspage->setWebsiteId($objUserWebsite->getId());
                    $objDefaultCmspage->setTitle('FAQs');
                    $objDefaultCmspage->setSubTitle('FAQs');
                    $objDefaultCmspage->setMetaTitle('FAQs');
                    $objDefaultCmspage->setMetaKeywords('FAQs');
                    $objDefaultCmspage->setMetaDescription('FAQs');
                    $objDefaultCmspage->setTemplate('default');
                    $objDefaultCmspage->setStatus('Active');
                    $objDefaultCmspage->setUniqueKey($users->getId()."_faq");
                    $objDefaultCmspage->setSlug('faq');
                    $objDefaultCmspage->save();

                    #ADD THE DEFAULT CONTACT PAGE AT CMSPAGES.
                    $objDefaultCmspage = new CMSPages();
                    $objDefaultCmspage->setWebsiteId($objUserWebsite->getId());
                    $objDefaultCmspage->setTitle('Contact');
                    $objDefaultCmspage->setSubTitle('Contact');
                    $objDefaultCmspage->setMetaTitle('Contact');
                    $objDefaultCmspage->setMetaKeywords('Contact');
                    $objDefaultCmspage->setMetaDescription('Contact');
                    $objDefaultCmspage->setTemplate('default');
                    $objDefaultCmspage->setStatus('Active');
                    $objDefaultCmspage->setUniqueKey($users->getId()."_contact");
                    $objDefaultCmspage->setSlug('contact');
                    $objDefaultCmspage->save();*/
                }

                /* Insert value in ThemeOptions Table */
                if($usersTem['Weburl'] != '' &&  isset($usersTem['WebsiteSubscriotion']) && $usersTem['WebsiteSubscriotion'] == "on")
                {
                    /*function to inser record in themeoption table */
                    #$this->optionRecordInsert($objUserWebsite);
                    clsCommon::optionRecordInsert($objUserWebsite);

                    // Setup User Personal Site Default Content
                    $oTheme = new Theme();
                    $snThemeId = $oTheme->getDefaultId();

                    $userWebsiteArr = array();
                    $userWebsiteArr['websiteId'] = $objUserWebsite->getId();
                    $userWebsiteArr['userId'] = $objUserWebsite->getUserId();
                    $userWebsiteArr['themeId'] = $objUserWebsite->getThemeId();
                    $userWebsiteArr['weburl'] = $objUserWebsite->getWebsiteurl();
                    $userWebsiteArr['defaultThemeId'] = $snThemeId[0]["Id"];
                    $userWebsiteArr['status'] = $objUserWebsite->getStatus();
                    #clsCommon::pr($userWebsiteArr);
                    $this->generateSiteDefaultContent($userWebsiteArr);
                    // Code Complete to Setup Default Content

                }
                /*End value insert in option table */
                #clsCommon::pr($usersTem['Network']);
                if ($usersTem['Network'] != '' && isset($usersTem['NetworkProfileSubscription']) && $usersTem['NetworkProfileSubscription'] == "on") {
                    for ($i=0;$i<count($usersTem['Network']);$i++)
                    {
                        if ($usersTem['Network'][$i] == "-1") {
                            $objUserNetwork = new UserPracticeArea();
                            $objUserNetwork->setUserId($users->getId());
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


                            $objUserNetwork->setUserId($users->getId());
                            #$objUserNetwork->setPracticeareaId($usersTem['Network'][$i]);
                            $objUserNetwork->setPracticeareaId($practiceAreaArr[0]);
                            $objUserNetwork->save();
                        }
                    }
                }
                #clsCommon::pr($usersTem,1);
                $arrParams = array();
                $arrParams['FirstName'] = $users->getFirstName()." ".$users->getLastName();
                $arrParams['toEmailAddress'] = $users->getEmail();
                $arrParams['ActivationKey'] = $users->getActivationCode();
                $arrParams['UserId'] = $users->getId();
                $objSiteMail = new siteMails();
                $objSiteMail->sendRegistrationEmail($arrParams);

                if($request->isMethod(sfRequest::PUT))
                $this->getUser()->setFlash('succMsg', "Update successful.");
                else
                $this->getUser()->setFlash('succMsg', "New customer added successfully.");


                $this->redirect('users/index');
                //$this->redirect('users/edit?id='.$users->getId());
            }
        }
    }

    protected function editprocessForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $usersTem = $request->getParameter($form->getName());
        #clsCommon::pr($usersTem,1);

        if ($form->isValid())
        {

            $EmailCheck = 0; $WebUrlCheck = 0; $hasError = 0; $UnameCheck = 0; $hasWeburl = 0;
            if (isset($usersTem['WebsiteSubscriotion']) && $usersTem['WebsiteSubscriotion'] == "on" && $usersTem['Weburl'] == "") {
                $hasError = 1;
            }
            if (isset($usersTem['NetworkProfileSubscription']) && $usersTem['NetworkProfileSubscription'] == "on" && empty($usersTem['Network']) == 1) {
                $hasError = 2;
            }
            if ((isset($usersTem['WebsiteSubscriotion']) && $usersTem['WebsiteSubscriotion'] == "on" && $usersTem['Weburl'] == "") && (isset($usersTem['NetworkProfileSubscription']) && $usersTem['NetworkProfileSubscription'] == "on" && empty($usersTem['Network']) == 1)){
                $hasError = 3;
            }
            if (isset($usersTem['Email']) && $usersTem['Email'] != "") {
                $EmailCheck = UsersTable::emailCheck($request->getParameter('id'),$usersTem['Email']);
            }
            if (isset($usersTem['Username']) && $usersTem['Username'] != "") {
                $UnameCheck = UsersTable::userNameCheck($request->getParameter('id'),$usersTem['Username']);
            }

            if (isset($usersTem['Weburl']) && $usersTem['Weburl'] != "") {

                $this->forward404Unless($urlCheckusers = Doctrine::getTable('Users')->find(array($request->getParameter('id'))), sprintf('Object users does not exist (%s).', $request->getParameter('id')));
                $WebUrlCheck = UsersWebsiteTable::urlCheck($urlCheckusers->getUsersUsersWebsite()->getId(),$urlCheckusers->getUsersUsersWebsite()->getUserId(),$usersTem['Weburl']);

                // Here To Make Entry For Website on Edit Mode by Chintan
                if($urlCheckusers->getUsersUsersWebsite()->getId() == '') {

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
            }


            if ($hasError == 1) {
                $this->getUser()->setFlash('errMsg', "Please provide web url.");
                $this->redirect('users/edit?id='.$request->getParameter('id'));
                $this->webTem = 'Yes';
            }else if ($hasError == 2) {
                $this->getUser()->setFlash('errMsg', "Please provide network profile subscription.");
                $this->redirect('users/edit?id='.$request->getParameter('id'));
                $this->netWork = 'Yes';
            }else if ($hasError == 3){
                $this->getUser()->setFlash('errMsg', "Please provide weburl and network profile subscription.");
                $this->redirect('users/edit?id='.$request->getParameter('id'));
                $this->webTem = 'Yes'; $this->netWork = 'Yes';
            }else if ($EmailCheck == true){
                $this->getUser()->setFlash('errMsg', "E-mail already in use.  Please try again.");
                $this->redirect('users/edit?id='.$request->getParameter('id'));
            }else if ($UnameCheck == true){
                $this->getUser()->setFlash('errMsg', "User name already in use.  Please try again.");
                $this->redirect('users/edit?id='.$request->getParameter('id'));
            }else if ($WebUrlCheck == true){
                $this->getUser()->setFlash('errMsg', "Web url already in use.  Please try again.");
                $this->redirect('users/edit?id='.$request->getParameter('id'));
            }else {
                # below code for set the value of billing subscription, website subscription and network profile.
                if (isset($usersTem['BillingSubscription']) && $usersTem['BillingSubscription'] == "on") {
                    $form->getObject()->setBillingSubscription('Yes');
                }else {
                    unset($form['BillingSubscription']);
                    $form->getObject()->setBillingSubscription('No');
                }

                if (isset($usersTem['WebsiteSubscriotion']) && $usersTem['WebsiteSubscriotion'] == "on") {
                    $form->getObject()->setWebsiteSubscriotion('Yes');
                }else {
                    unset($form['WebsiteSubscriotion']);
                    $form->getObject()->setWebsiteSubscriotion('No');
                }

                if (isset($usersTem['NetworkProfileSubscription']) && $usersTem['NetworkProfileSubscription'] == "on") {
                    $form->getObject()->setNetworkProfileSubscription('Yes');
                }else {
                    unset($form['NetworkProfileSubscription']);
                    $form->getObject()->setNetworkProfileSubscription('No');
                }

                UsersTable::updateUserData($usersTem,$request->getParameter('id'));
                if (isset($usersTem['Weburl']) && $usersTem['Weburl'] != "") {
                    UsersWebsiteTable::updateWebUrl($urlCheckusers->getUsersUsersWebsite()->getId(),$urlCheckusers->getUsersUsersWebsite()->getUserId(),$usersTem['Weburl']);
                }
                if (isset($usersTem['Network']) && !empty($usersTem['Network'])) {
                    UserPracticeAreaTable::deleteOldPracticeAreaData($request->getParameter('id'));
                    for ($p=0;$p<count($usersTem['Network']);$p++)
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
                    }
                }

                $this->getUser()->setFlash('succMsg', "Update successful.");
                $this->redirect('users/index');
                //$this->redirect('users/edit?id='.$users->getId());
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
    }

    /**
     * Function to Change the Status
     *
     * @param object $objUserWebsite
     */
    public function executeChangeStatus(sfWebRequest $request)
    {
        $this->forward404Unless($users = Doctrine::getTable('Users')->find(array($request->getParameter('id'))), sprintf('User not found!'));
        $status = $request->getParameter('status');
        // Do not allow to change status of current user
        if($request->getParameter('id') == $this->getUser()->getAttribute("admin_user_id")){
            $this->getUser()->setFlash("errMsg","You can't change your status");
        }else if(in_array($status,array('Yes','No'))){
            /**
             * set the value of billing,website,network profile subscription i.e. yes or no
             */
            if ($request->getParameter('tempval') == "billing") {
                $users->setBillingSubscription($status);
            }else if ($request->getParameter('tempval') == "website") {
                $users->setWebsiteSubscriotion($status);
                if($status == "Yes")
					$webStatus = "Active";
				else
					$webStatus = "Inactive";
					
				$oUsersWebsite = new UsersWebsite();
				$oUsersWebsite->setWebsiteStatus($users->getId(), $webStatus);
				

            }else {
                $users->setNetworkProfileSubscription($status);
            }
            $users->setUpdateDateTime(date("Y-m-d H:i:s"));
            $users->save();
            /**
             *  Set the poper message as above set subscriptions.
             */
            $arrParams = array();
            if ($request->getParameter('tempval') == "billing") {
                if($status=="Yes"){
                    $this->getUser()->setFlash("succMsg",'Status successfully changed to active.');
                    $arrParams['Status'] = 'Yes';
                }else{
                    $this->getUser()->setFlash("errMsg",'Status successfully changed to inactive.');
                    $arrParams['Status'] = 'No';
                }
            }else if ($request->getParameter('tempval') == "website") {
                if($status=="Yes"){
                    $this->getUser()->setFlash("succMsg",'Status successfully changed to active.');
                    $arrParams['Status'] = 'Yes';
                }else{
                    $this->getUser()->setFlash("errMsg",'Status successfully changed to inactive.');
                    $arrParams['Status'] = 'No';
                }
            }else {
                if($status=="Yes"){
                    $this->getUser()->setFlash("succMsg",'Status successfully changed to active.');
                    $arrParams['Status'] = 'Yes';
                }else{
                    $this->getUser()->setFlash("errMsg",'Status successfully changed to inactive.');
                    $arrParams['Status'] = 'No';
                }
            }

            // SEND NOTIFICATION EMAIL TO USER START
            $arrParams['toEmailAddress'] = $users->getEmail();
            $arrParams['FirstName'] = ucfirst(strtolower($users->getFirstName()));

            //COMMENT : GET THE OBJECT OF MAIL CLASS
            $objSiteMails = new siteMails();
            //COMMENT : CALL TO SENDSTATUSCHANGE EMAIL MEHTOD OF MAIL CLASS
            $objSiteMails->sendStatusChangeEmail($arrParams);

            // SEND NOTIFICATION EMAIL TO USER END
        }else if (in_array($status,array('Active','Inactive'))){
            /**
             *  Here is set the satus of User i.e. active or inactive.
             */
            /*echo $status;die;*/
            $users->setStatus($status);
            $users->setUpdateDateTime(date("Y-m-d H:i:s"));
            $users->save();

            if($users->getWebsiteSubscriotion() == "Yes")
            {
				$oUsersWebsite = new UsersWebsite();
				$oUsersWebsite->setWebsiteStatus($users->getId(),$status);
            }

            $arrParams = array();
            if ($request->getParameter('tempval') == "userStatus") {
                if($status=="Active"){
                    $this->getUser()->setFlash("succMsg",'Status successfully changed to active.');
                    $arrParams['Status'] = 'Active';
                }else{
                    $this->getUser()->setFlash("succMsg",'Status successfully changed to inactive.');
                    $arrParams['Status'] = 'Inactive';
                }
            }

            // SEND NOTIFICATION EMAIL TO USER START
            $arrParams['toEmailAddress'] = $users->getEmail();
            $arrParams['FirstName'] = ucfirst(strtolower($users->getFirstName()));
            //COMMENT : GET THE OBJECT OF MAIL CLASS
            $objSiteMails = new siteMails();
            //COMMENT : CALL TO SENDSTATUSCHANGE EMAIL MEHTOD OF MAIL CLASS
            $objSiteMails->sendStatusChangeEmail($arrParams);

            // SEND NOTIFICATION EMAIL TO USER END
        }
        $this->redirect('users/index'.$this->urlParams);
    }

    Public function executeVerifyAccount(sfWebRequest $request){
        //COMMENT : CHECK FOR ID & ACTIVATION KEY IN THE PARAMETER IF NOT SEND USE TO REGISTER PAGE
        $this->forward404Unless($request->getParameter('id'));
        $this->forward404Unless($request->getParameter('actKey'));

        //COMMENT: FIND THE USER DETAIL
        $objUsers = Doctrine_Core::getTable('Users')->find($request->getParameter('id'));

        //COMMENT : IF USESR FOUND THEN PROCESS THE ACTIVATION OF ACCCOUNT
        if($objUsers)   	{
            //COMMENT : CHECK USERS CURRENT STATUS IS PENDING FOR REVIEW
            if($objUsers->getStatus()== sfConfig::get('app_UserStatus_Pending'))   {

                //COMMENT : ACTIVATION KEY VALIDAITON
                if($objUsers->getActivationCode()==$request->getParameter('actKey'))   {
                    //COMMENT : ACTIAVE THE USER & SET SUCESS MESSAGE
                    $objUsers->setStatus(sfConfig::get('app_UserStatus_Active'));
                    $objUsers->setActivationCode('');
                    $objUsers->save();

                    // Sending Welcome email
                    $objPassEncDec = new encryptDecrypt(sfConfig::get('app_pwdEncDecKey'));
                    $password = $objPassEncDec->decrypt($objUsers->getPassword());

                    $arrParams = array();
                    $arrParams['FirstName'] = $objUsers->getFirstName().' '.$objUsers->getLastName();
                    $arrParams['toEmailAddress'] = $objUsers->getEmail();
                    $arrParams['Password'] = $password;
                    $arrParams['UserId'] = $objUsers->getId();
                    $objSiteMail = new siteMails();
                    $objSiteMail->sendWelcomeEmail($arrParams);

                    $this->getUser()->setFlash('success', "Your Status successfully changed to active.. Please login");
                    $this->redirect('default/index');
                    //$this->redirect('default/index');
                }
                //COMMENT : INVALID ACTIVATION KEY THROW ERROR
                else
                {
                    #$this->errMsg = 'Invalid activation key. Please check your activation key and try again.';
                    $this->getUser()->setFlash('error', "Invalid activation key. Please check your activation key and try again.");
                }
            }
            //COMMENT : IF USER STATUS IS ACTIVE ALLREADY THROW ERROR
            else
            {
                #$this->errMsg = "Your account has been already activated. Please contact system administrator if you are not able to login to the system";
                $this->getUser()->setFlash('error', "Your account has already been activated. Please contact the system administrator if you are unable to login to the system.");

            }
        }
        //COMMENT : IF USER NOT FOUND THROW ERROR
        else
        {
            #$this->errMsg = "Invalid activation link. Please check your activation URL and try again.";
            $this->getUser()->setFlash('error', "Invalid activation link. Please check your activation url and try again.");
        }
        $this->redirect('default/index');
    }


    /* this function is for insert record in ThemeOptions table */
    /**
     * Function to insert record in ThemeOptions table
     *
     * @param object $objUserWebsite
     */
    #public function executeGenerateSiteDefaultContent(sfWebRequest $request ,$userWebsiteArr = array())
    public function generateSiteDefaultContent($userWebsiteArr = array())
    {
        /*$userWebsiteArr = array();
        $userWebsiteArr['websiteId'] = 127;
        $userWebsiteArr['userId'] = 175;
        $userWebsiteArr['themeId'] = 14;
        $userWebsiteArr['weburl'] = 'www.chintan-lg.com';
        $userWebsiteArr['defaultThemeId'] = 14;
        $userWebsiteArr['status'] = 'Active'; */

        $defaultTheme = $userWebsiteArr['defaultThemeId'] ;
        $websiteId = $userWebsiteArr['websiteId'] ;
        $themeId = $userWebsiteArr['themeId'] ;
        $userId = $userWebsiteArr['userId'] ;

        // Get Theme Options
        $themeObj = Doctrine::getTable('Theme')->find($defaultTheme);
        $themeOptions = unserialize($themeObj->getOptions());
        #clsCommon::pr($themeOptions);

        clsCommon::createPersonalWebsiteDefaultFolders($websiteId); // Create default Folders in Uploads Folder under website/websiteid

        // Read XML File
        $XMLArr = clsCommon::getThemeDefaultContent($websiteId, $defaultTheme);

        $xmlFile = 'setup.xml';
        $dataFolder = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR;
        $thmeFolder = 'theme'.$defaultTheme.DIRECTORY_SEPARATOR;

        $xlFilePath = $dataFolder.$thmeFolder.'xml'.DIRECTORY_SEPARATOR.$xmlFile;
        $logoFilePath = $dataFolder.$thmeFolder.'logo'.DIRECTORY_SEPARATOR.'logo.png';
        $bannerFilePath = $dataFolder.$thmeFolder.'banner'.DIRECTORY_SEPARATOR;

        $fileExist = true ;
        // Complete To Read XML File


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
                $logoName = $websiteId."L_".$XMLArr['logo']['item']['optionvalue']; */

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
					} //End If
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

        if($request->hasParameter('flag'))
        if($request->getParameter('flag') == 'true')
        $this->redirect('dashboard/index?customerId='.$id);

        $this->redirect('users/index');
    }

    /**
     * Function to change IsFeatured
     *
     * @param sfWebRequest $request
     */
    public function executeChangeIsFeatured(sfWebRequest $request)
    {
        if($request->isXmlHttpRequest())
        {
            $id    = $request->getParameter('id');
            $value = $request->getParameter('value');
            $oUsers = new Users();
            $oUsers->setUserIsFeatured($id, $value);
        }
        return sfView::NONE;
    }

    /**
     * This function will allow Admin / Stafff Admin to login into Customer Portal
     *
     */
    public function executeLogintocustomer(sfWebRequest $request) {
        $notExist = true ;
        if($request->hasParameter('id') && $this->getUser()->hasCredential('admin')){
            $customerId = $request->getParameter('id') ;
            $notExist = false ;
            $custInfo = UsersTable::checkCustomerExist($customerId);
            if($custInfo['count'] == 1 && !empty($custInfo['userData'])) {

                // Now Logout From the Current Admin or Staff Admin Login
                $this->getUser()->setAuthenticated(false);
                $this->getUser()->getAttributeHolder()->clear();
                $this->getUser()->clearCredentials();
                // Complete

                // Login As Customer
                #clsCommon::pr($custInfo,1);
                $this->getUser()->setAuthenticated(true);
                $this->getUser()->setAttribute('admin_user_id', $custInfo['userData']['Id']);
                $this->getUser()->setAttribute('admin_email', $custInfo['userData']['Email']);
                $this->getUser()->setAttribute('admin_firstname', $custInfo['userData']['FirstName']);
                $this->getUser()->setAttribute('admin_lastname', $custInfo['userData']['LastName']);
                $this->getUser()->setAttribute('user_type', $custInfo['userData']['UserType']);
                $this->getUser()->addCredential('customer');

                if($custInfo['userData']["NetworkProfileSubscription"] == "Yes")
                $this->getUser()->setAttribute('NetworkProfileSubscription',"Yes");
                else
                $this->getUser()->setAttribute('NetworkProfileSubscription',"No");

                # create session for billingSucscription is yes or no
                if($custInfo['userData']['BillingSubscription'] == "Yes")
                $this->getUser()->setAttribute('billingSucscription',"Yes");
                else
                $this->getUser()->setAttribute('billingSucscription',"No");

                # create session for WebsiteSubscriotion is yes or no
                if($custInfo['userData']["WebsiteSubscriotion"] == "Yes")
                $this->getUser()->setAttribute('WebsiteSubscriotion',"Yes");
                else
                $this->getUser()->setAttribute('WebsiteSubscriotion',"No");


                # this if is for personal website take into session
                if($custInfo['userData']['WebsiteSubscriotion'] == "Yes")
                {
                    $oUsersWebsite = new UsersWebsite();
                    $siteData = $oUsersWebsite->getUsersWebsiteId($custInfo['userData']['Id']);
                    #clsCommon::pr($siteData,1);
                    $this->getUser()->setAttribute('personalWebsiteId',$siteData[0]["Id"]);
                    $this->getUser()->setAttribute('websiteUrl',$siteData[0]["Websiteurl"]);
                }

                UsersTable::updateLastLoginDate($custInfo['userData']['Id']);
                $this->redirect("default/index");
                // Complete


            } else {
                $notExist = true ;
            }
            #clsCommon::pr($custInfo,1);
        }

        if($notExist) {
            $this->getUser()->setFlash("errMsg", 'You can not access the customer panel for this user.');
            $this->redirect('users/index');
        }


    } // End of Function
    
    /**
     * Function to change PriorityListing
     *
     * @param sfWebRequest $request
     */
    public function executeChangePriorityListing(sfWebRequest $request)
    {
        if($request->isXmlHttpRequest())
        {
            $id    = $request->getParameter('id');
            $value = $request->getParameter('value');
            $oUsers = new Users();
            $oUsers->setUserPriorityListing($id, $value);
        }
        return sfView::NONE;
    }
} // End of class
