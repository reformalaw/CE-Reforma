<?php

/**
 * theme actions.
 *
 * @package    counceledge
 * @subpackage theme
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class themeActions extends sfActions
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
     * Function to Listing Records
     *
     * @param object $objUserWebsite
     */
  public function executeIndex(sfWebRequest $request)
  {
    $this->orderBy = "";
    $this->orderType="";
    $where = "";
         
    $qSearch = Doctrine_Query::create();
    $qSearch->from('Theme th');
    $qSearch->where('th.Status <> ?',sfConfig::get('app_Status_Deleted'));
    $qSearch->orderBy("th.Id Desc");
     /* to get the site url */
		$oSiteConfig = Doctrine::getTable('SiteConfig')->findByConfigKey("SITE_URL");
		$asSiteUrl = $oSiteConfig->toArray();
		$this->ssSiteUrl = $asSiteUrl[0]["ConfigValue"];
		/* End the site url path */

    /*if($request->getParameter('search_text'))
      $where .="th.name LIKE '%".$request->getParameter('search_text')."%'";
    
     $qSearch->where($where); */
//     switch($request->getParameter('orderBy'))
//     {
//       case "Unique name":
//         $orderBy = 'th.UniqueName';        
//         $this->orderBy = "Unique name";        
//         break;
//       case "Name":
//         $orderBy = 'th.Name';        
//         $this->orderBy = "Name";        
//         break;
//       default:
//         $orderBy = 'th.Id';
//         $this->orderBy = "id";       
//         break; 
//     } 
//     
//     switch($request->getParameter('orderType'))
//     {
//       case "asc":
//         $qSearch->orderBy("$orderBy ASC");
//         $this->orderType = "asc";
//         break;
//       case "desc":
//       default:        
//         $qSearch->orderBy("$orderBy DESC");
//         $this->orderType = "desc";
//         break;
//     }

     
    
//     $pager = new sfDoctrinePager('Theme', sfConfig::get('app_no_of_records_per_page'));
//     $pager->setQuery($qSearch);
//     $pager->setPage($request->getParameter('page', 1));
//     $pager->init();
    $this->pager = $qSearch->execute();
  }
  
	/**
     * Function to Insert New Record
     *
     * @param object $objUserWebsite
     */
	public function executeNew(sfWebRequest $request)
	{
		$this->form = new ThemeForm();
	}

	/**
     * Function to Create Record
     *
     * @param object $objUserWebsite
     */
	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new ThemeForm();

		$this->processForm($request, $this->form);

		$this->setTemplate('new');
	}

	/**
     * Function to Edit Record
     *
     * @param object $objUserWebsite
     */
  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($theme = Doctrine::getTable('Theme')->find(array($request->getParameter('id'))), sprintf('Object theme does not exist (%s).', $request->getParameter('id')));
    $this->form = new ThemeForm($theme);
	$optionsValue = $theme->getOptions();
	$this->asOptionsValue = unserialize($optionsValue);
	
		/* Start Set checkbox checked uncheckd */

		if ($theme->getManageTopMenu() == "Yes") {
            $this->form->setDefault('ManageTopMenu', true);
        }elseif ($theme->getManageTopMenu() == "No") {
            $this->form->setDefault('ManageTopMenu', false);
        }else {
            $this->form->setDefault('ManageTopMenu', false);
        }

        if ($theme->getManageFooterMenu() == "Yes") {
            $this->form->setDefault('ManageFooterMenu', true);
        }elseif ($theme->getManageFooterMenu() == "No") {
            $this->form->setDefault('ManageFooterMenu', false);
        }else {
            $this->form->setDefault('ManageFooterMenu', false);
        }

		if ($theme->getManageBanner() == "Yes") {
            $this->form->setDefault('ManageBanner', true);
        }elseif ($theme->getManageBanner() == "No") {
            $this->form->setDefault('ManageBanner', false);
        }else {
            $this->form->setDefault('ManageBanner', false);
        }

        if ($theme->getManageColorAndBackground() == "Yes") {
            $this->form->setDefault('ManageColorAndBackground', true);
        }elseif ($theme->getManageColorAndBackground() == "No") {
            $this->form->setDefault('ManageColorAndBackground', false);
        }else {
            $this->form->setDefault('ManageColorAndBackground', false);
        }

        if ($theme->getManageSocialMedia() == "Yes") {
            $this->form->setDefault('ManageSocialMedia', true);
        }elseif ($theme->getManageSocialMedia() == "No") {
            $this->form->setDefault('ManageSocialMedia', false);
        }else {
            $this->form->setDefault('ManageSocialMedia', false);
        }

        if ($theme->getChangeLogo() == "Yes") {
            $this->form->setDefault('ChangeLogo', true);
        }elseif ($theme->getChangeLogo() == "No") {
            $this->form->setDefault('ChangeLogo', false);
        }else {
            $this->form->setDefault('ChangeLogo', false);
        }

        if ($theme->getManageFAQs() == "Yes") {
            $this->form->setDefault('ManageFAQs', true);
        }elseif ($theme->getManageFAQs() == "No") {
            $this->form->setDefault('ManageFAQs', false);
        }else {
            $this->form->setDefault('ManageFAQs', false);
        }

        if ($theme->getTextWidgets() == "Yes") {
            $this->form->setDefault('TextWidgets', true);
        }elseif ($theme->getTextWidgets() == "No") {
            $this->form->setDefault('TextWidgets', false);
        }else {
            $this->form->setDefault('TextWidgets', false);
        }

        if ($theme->getBodyBackground() == "Yes") {
            $this->form->setDefault('BodyBackground', true);
        }elseif ($theme->getBodyBackground() == "No") {
            $this->form->setDefault('BodyBackground', false);
        }else {
            $this->form->setDefault('BodyBackground', false);
        }
        /* End Set checkbox checked uncheckd */
  }

	/**
     * Function to Update Record
     *
     * @param object $objUserWebsite
     */
	public function executeUpdate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($theme = Doctrine::getTable('Theme')->find(array($request->getParameter('id'))), sprintf('Object theme does not exist (%s).', $request->getParameter('id')));
		$this->form = new ThemeForm($theme);
		
		$optionsValue = $theme->getOptions();
		$this->asOptionsValue = unserialize($optionsValue);

		$this->processForm($request, $this->form);

		$this->setTemplate('edit');
	}

	/**
     * Function to Delete  Record
     *
     * @param object $objUserWebsite
     */
  public function executeDelete(sfWebRequest $request)
  {
    //$request->checkCSRFProtection();

    $this->forward404Unless($theme = Doctrine::getTable('Theme')->find(array($request->getParameter('id'))), sprintf('Object theme does not exist (%s).', $request->getParameter('id')));

     $snId = $request->getParameter('id');             // Get Id
     $ssStatus = sfConfig::get('app_Status_Deleted');  // Get Status
     $objTheme = new Theme();
     $objTheme->changeStatus($snId, $ssStatus);        // function call for update status
     $this->getUser()->setFlash('succMsg', "Deletion successful.");
    //$theme->delete();

    $this->redirect('theme/index');
  }

  /* set the Array of Serialize */
	/**
     * Function to create serialize string 
     *
     * @param array $asData
     */
	public function optionSerialize($asData)
	{
		$asOptionValue = array();

			/*START check there is # in value or not */
			(substr($asData[sfConfig::get("app_Options_BGcolorPicker")],0,1) != '#')        ? $BGColorHash   		= '#'.$asData[sfConfig::get("app_Options_BGcolorPicker")]        : $BGColorHash     		= $asData[sfConfig::get("app_Options_BGcolorPicker")] ;
			(substr($asData[sfConfig::get("app_Options_TextcolorPicker")],0,1) != '#')      ? $TextColorHash 		= '#'.$asData[sfConfig::get("app_Options_TextcolorPicker")]      : $TextColorHash   		= $asData[sfConfig::get("app_Options_TextcolorPicker")] ;
			(substr($asData[sfConfig::get("app_Options_BordercolorPicker")],0,1) != '#')    ? $BorderColorHash 	= '#'.$asData[sfConfig::get("app_Options_BordercolorPicker")] 	: $BorderColorHash 		= $asData[sfConfig::get("app_Options_BordercolorPicker")] ;
			(substr($asData[sfConfig::get("app_Options_LinkcolorPicker")],0,1) != '#')      ? $LinkColorHash 		= '#'.$asData[sfConfig::get("app_Options_LinkcolorPicker")] 		: $LinkColorHash 		= $asData[sfConfig::get("app_Options_LinkcolorPicker")] ;
			(substr($asData[sfConfig::get("app_Options_LinkHoverColorPicker")],0,1) != '#') ? $LinkHoverColorHash = '#'.$asData[sfConfig::get("app_Options_LinkHoverColorPicker")] 	: $LinkHoverColorHash 	= $asData[sfConfig::get("app_Options_LinkHoverColorPicker")] ;
			/*END check there is # in value or not*/


			(array_key_exists(sfConfig::get("app_Color_BGColor"),$asData))     		?  ($asData[sfConfig::get("app_Options_BGcolorPicker")] != "")   		? $asOptionValue[sfConfig::get("app_Color_BGColor")]     		= $BGColorHash         :""   : "";
			(array_key_exists(sfConfig::get("app_Color_TextColor"),$asData))   		?  ($asData[sfConfig::get("app_Options_TextcolorPicker")]!= "")  		? $asOptionValue[sfConfig::get("app_Color_TextColor")]   		= $TextColorHash       :""   : "";
			(array_key_exists(sfConfig::get("app_Color_BorderColor"),$asData)) 		?  ($asData[sfConfig::get("app_Options_BordercolorPicker")]!= "") 	? $asOptionValue[sfConfig::get("app_Color_BorderColor")] 		= $BorderColorHash     :""   : "";
			(array_key_exists(sfConfig::get("app_Color_TextWidgets"),$asData))  		?  ($asData[sfConfig::get("app_Options_TextWidgetCombo")]!= "")   	? $asOptionValue[sfConfig::get("app_Color_TextWidgets")]  		= $asData[sfConfig::get("app_Options_TextWidgetCombo")]           :""   : "";
			(array_key_exists(sfConfig::get("app_Color_LinkColor"),$asData)) 			?  ($asData[sfConfig::get("app_Options_LinkcolorPicker")]!= "") 		? $asOptionValue[sfConfig::get("app_Color_LinkColor")] 		= $LinkColorHash     :""   : "";
			(array_key_exists(sfConfig::get("app_Color_LinkHoverColor"),$asData))	 	?  ($asData[sfConfig::get("app_Options_LinkHoverColorPicker")]!= "")	? $asOptionValue[sfConfig::get("app_Color_LinkHoverColor")]	= $LinkHoverColorHash     :""   : "";
			(array_key_exists("ChangeLogo",$asData)) ? $asOptionValue[sfConfig::get("app_Color_Logo")] = "Yes" : "";
			(array_key_exists(sfConfig::get("app_Color_ManageBanner"),$asData))  		?  ($asData[sfConfig::get("app_Options_BannerTitleCombo")]!= "")   	? $asOptionValue[sfConfig::get("app_Color_ManageBanner")]  		= $asData[sfConfig::get("app_Options_BannerTitleCombo")]           :""   : "";
			(array_key_exists(sfConfig::get("app_Color_BannerBackground"),$asData))   ? $asOptionValue[sfConfig::get("app_Color_BannerBackground")] = "Yes" : $asOptionValue[sfConfig::get("app_Color_BannerBackground")] = "No";
			
			//in any case banner forground is yes 
			(array_key_exists(sfConfig::get("app_Color_BannerForeground"),$asData))   ? $asOptionValue[sfConfig::get("app_Color_BannerForeground")] = "Yes" : $asOptionValue[sfConfig::get("app_Color_BannerForeground")] = "Yes";

		$ssOptionValue =  serialize($asOptionValue);
		return $ssOptionValue;
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
	$asData = $request->getParameter($form->getName());

    if ($form->isValid())
    {
		if($asData["ManageColorAndBackground"] == "on" && $asData["BGColor"] == "on" && array_key_exists("BGcolorPicker", $asData) && $asData["BGcolorPicker"] == "")
		{
			$this->getUser()->setFlash('errMsg', "Please insert background color code.");
		}
		elseif($asData["ManageColorAndBackground"] == "on" && $asData["TextColor"] == "on" && array_key_exists("TextcolorPicker", $asData) && $asData["TextcolorPicker"] == "")
		{
			$this->getUser()->setFlash('errMsg', "Please insert text color code.");
		}
		elseif($asData["ManageColorAndBackground"] == "on" && $asData["BorderColor"] == "on" && array_key_exists("BordercolorPicker", $asData) && $asData["BordercolorPicker"] == "")
		{
			$this->getUser()->setFlash('errMsg', "Please insert border color code.");
		}
		elseif($asData["ManageColorAndBackground"] == "on" && $asData["LinkColor"] == "on" && array_key_exists("LinkcolorPicker", $asData) && $asData["LinkcolorPicker"] == "")
		{
			$this->getUser()->setFlash('errMsg', "Please insert link color code.");
		}
		elseif($asData["ManageColorAndBackground"] == "on" && $asData["LinkHoverColor"] == "on" && array_key_exists("LinkHoverColorPicker", $asData) && $asData["LinkHoverColorPicker"] == "")
		{
			$this->getUser()->setFlash('errMsg', "Please insert linkhover color code.");
		}
		elseif($asData["ManageBanner"] == "on" && $asData["BannerTitleCombo"] == "")
		{
			$this->getUser()->setFlash('errMsg', "Please select number of banner title.");
		}
		elseif( $asData["TextWidgets"] == "on" && $asData["TextWidgetCombo"] == "" )
		{
			$this->getUser()->setFlash('errMsg', "Please select number of text widget.");
		}
		else
		{
			//GET THE BOOK PIC
				$file = $request->getFiles($form->getName());

			//GET ALLOWED FILE TYPE
				$imageExtArry = sfConfig::get('app_imageType');

			//GET PROFILE IMAGE PATH
				$profileImagePath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.sfConfig::get('app_profileImagePath');

			if (!empty($file['ScreenShot']['name'])) {

					//CHECK THE FILE EXTENSION
					$imageInfo = getimagesize ($file['ScreenShot']['tmp_name']);

					if (in_array($imageInfo['mime'],$imageExtArry)) {

						//MODIFY THE FILE NAME
						$filename = $this->getUser()->getAttribute('admin_user_id')."_".time();
						$ext = explode(".",$file['ScreenShot']['name']);

						// GET FILE EXTENSION
						$extension = $ext[count($ext) - 1];
						$this->imageName = $filename.".".$extension;


						//UPLOAD THE FILE TO THE SERVER
						move_uploaded_file($file['ScreenShot']['tmp_name'],$profileImagePath.$this->imageName);

						// CREATE THUMBNAIL OF 100X100 SIZE
						// SETTING DIRECTORY
						$uploaded_images_path_100 = $profileImagePath.'thumb'.DIRECTORY_SEPARATOR;
						$thumbnail_100 = new sfThumbnail(sfConfig::get('app_ImageSize_Height'), sfConfig::get('app_ImageSize_Width'),true,true,100);
						$thumbnail_100->loadFile($profileImagePath.$this->imageName);
						$thumbnail_100->save($uploaded_images_path_100.$this->imageName);
					}
				}

				//IF PROFILE PIC IS UPLOADED
				if($this->imageName != "" && $request->isMethod(sfRequest::PUT)){
					// GET OLD FILE NAME
					$old_thumbnail =  $form->getObject()->getScreenShot();
					// SET NEW FILE NAME
					$form->getObject()->setScreenShot($this->imageName);

					// REMOVE OLD ORIGINAL FILE
					$unlink_profilepic = @unlink($profileImagePath.$old_thumbnail);
					// REMOVE OLD 100X100 Size FILE
					@unlink($profileImagePath.'thumb'.DIRECTORY_SEPARATOR.$old_thumbnail);
				} 

			if( $this->imageName == "" && $request->isMethod(sfRequest::PUT))
			{
				$form->getObject()->getScreenShot();
				$form->getObject()->setScreenShot($this->imageName);
			}
			else
			{
			unset($form['ScreenShot']);  
			$form->getObject()->setScreenShot($this->imageName);
			}

			$form->getObject()->setOptions($this->optionSerialize($asData));

			
			/* Start Insert "No" value into table when uncheckd */
			if(!array_key_exists("ManageTopMenu",$asData))
			{
				unset($form["ManageTopMenu"]); 
				$form->getObject()->setManageTopMenu("No");
			}

			if(!array_key_exists("ManageFooterMenu",$asData))
			{
				unset($form["ManageFooterMenu"]); 
				$form->getObject()->setManageFooterMenu("No");
			}
			
			if(!array_key_exists("ManageBanner",$asData))
			{
				unset($form["ManageBanner"]);
				$form->getObject()->setManageBanner("No");
			}
			
			if(!array_key_exists("ManageColorAndBackground",$asData))
			{
				unset($form["ManageColorAndBackground"]);
				$form->getObject()->setManageColorAndBackground("No");
			}
			
			if(!array_key_exists("ManageSocialMedia",$asData))
			{
				unset($form["ManageSocialMedia"]);
				$form->getObject()->setManageSocialMedia("No");
			}
			
			if(!array_key_exists("ChangeLogo",$asData))
			{
				unset($form["ChangeLogo"]);
				$form->getObject()->setChangeLogo("No");
			}
			
			if(!array_key_exists("ManageFAQs",$asData))
			{
				unset($form["ManageFAQs"]);
				$form->getObject()->setManageFAQs("No");
			}
			
			if(!array_key_exists("TextWidgets",$asData))
			{
				unset($form["TextWidgets"]);
				$form->getObject()->setTextWidgets("No");
			}
			
			if(!array_key_exists("BodyBackground",$asData))
			{
				unset($form["BodyBackground"]);
				$form->getObject()->setBodyBackground("No");
			}
			
			/* End Insert "No" value into table when uncheckd */

			$theme = $form->save();          // Save the Record

			/* Start Insert "No" value into table when uncheckd */
	// 		$oTheme = new Theme();
	//  		array_key_exists("ManageTopMenu",$asData) ? "" : $oTheme->updateTableValue("ManageTopMenu","No",$theme->getId());
	// 		array_key_exists("ManageFooterMenu",$asData) ? "" : $oTheme->updateTableValue("ManageFooterMenu","No",$theme->getId());
	// 		array_key_exists("ManageBanner",$asData) ? "" : $oTheme->updateTableValue("ManageBanner","No",$theme->getId());
	// 		array_key_exists("ManageColorAndBackground",$asData) ? "" : $oTheme->updateTableValue("ManageColorAndBackground","No",$theme->getId());
	// 		array_key_exists("ManageSocialMedia",$asData) ? "" : $oTheme->updateTableValue("ManageSocialMedia","No",$theme->getId());
	// 		array_key_exists("ChangeLogo",$asData) ? "" : $oTheme->updateTableValue("ChangeLogo","No",$theme->getId());
	// 		array_key_exists("ManageFAQs",$asData) ? "" : $oTheme->updateTableValue("ManageFAQs","No",$theme->getId());
	// 		array_key_exists("TextWidgets",$asData) ? "" : $oTheme->updateTableValue("TextWidgets","No",$theme->getId());
			/* End Insert "No" value into table when uncheckd */

		if($request->isMethod(sfRequest::PUT))
			$this->getUser()->setFlash('succMsg', "Update successful.");
		else 
			$this->getUser()->setFlash('succMsg', "New theme added successfully.");

		$this->redirect('theme/index');
		//$this->redirect('theme/edit?id='.$theme->getId());
      }
    }
  }
     /* Change Status Action*/
     /**
     * Function to change the status
     *
     * @param sfWebRequest $request
     */
     Public function executeChangeStatus(sfWebRequest $request){
 
        $snId = $request->getParameter('id');              //get id
        $ssStatus = $request->getParameter('status');    // get status
        
        $objTheme = new Theme();                           // obj create
        if($ssStatus == sfConfig::get('app_Status_Active'))
        {
            $objTheme->changeStatus($snId, $ssStatus);        // function call for update status
            $this->getUser()->setFlash('succMsg', "Status successfully changed to active.");
        }
        else
        {
            $objTheme->changeStatus($snId, $ssStatus);         // function call for update status
            $this->getUser()->setFlash('succMsg', "Status successfully changed to inactive.");
        }
    
		// whene admin active inactive status from view template
		if($request->hasParameter('flag'))
			if($request->getParameter('flag') == true)
				$this->redirect("theme/view?id=".$snId);

        $this->redirect('theme/index');
    }

    /**
     * Function to view the record
     *
     * @param sfWebRequest $request
     */
    Public function executeView(sfWebRequest $request)
    {
       $snId = $request->getParameter('id');              //get id
       $view = $this->view = Doctrine::getTable('Theme')->find(array($snId));
       $this->optionData =  unserialize($view->getOptions());
       $this->ssSiteUrl = clsCommon::getSystemConfigVars('SITE_URL');
       $this->setLayout('popup');
		
    }
    
    /* checkbox Action for Display */
    Public function executeCheck(sfWebRequest $request)
    {
       $snId = $request->getPostParameter('chkbox[0]');
        
       $theme = Doctrine::getTable('Theme')->find(array($snId));
       $changetheme = Doctrine::getTable('Theme')->changeIsDefault($snId);   // set Status
       $this->getUser()->setFlash('succMsg', "'".$theme->getName()."' is selected as a default theme.");  
       
		if($request->hasParameter('flag'))
			if($request->getParameter('flag') == true)
				$this->redirect('theme/view?id='.$snId);

       $this->redirect('theme/index');
    }
    
}
