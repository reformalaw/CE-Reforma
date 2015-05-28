<?php

/**
 * theme actions.
 *
 * @package    counceledge
 * @subpackage usertheme
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userthemeActions extends sfActions
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
     * Function to Listing Theme
     *
     * @param sfWebRequest $request
     */
    public function executeIndex(sfWebRequest $request)
    {
        $this->orderBy = "";
        $this->orderType="";
        $where = "";

        /* to get the site url */
        $oSiteConfig = Doctrine::getTable('SiteConfig')->findByConfigKey("SITE_URL");
        $asSiteUrl = $oSiteConfig->toArray();
        $this->ssSiteUrl = $asSiteUrl[0]["ConfigValue"];
        /* End the site url path */

        $webId = $this->getUser()->getAttribute('personalWebsiteId');

        $oUsersWebsite = new UsersWebsite();
        $asResult = $oUsersWebsite->currentThemeId($webId);
        $this->snThemeId = $asResult[0]["ThemeId"];

        $qSearch = Doctrine_Query::create();
        $qSearch->from('Theme th');
        $qSearch->where('th.Status = ?',sfConfig::get('app_Status_Active'));

        /*if($request->getParameter('search_text'))
        $where .="th.name LIKE '%".$request->getParameter('search_text')."%'";

        $qSearch->where($where); */
        switch($request->getParameter('orderBy'))
        {
            case "Name":
                $orderBy = 'th.Name';
                $this->orderBy = "Name";
                break;
            default:
                $orderBy = 'th.Id';
                $this->orderBy = "id";
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

        // 		$pager = new sfDoctrinePager('Theme', 30);
        // 		$pager->setQuery($qSearch);
        // 		$pager->setPage($request->getParameter('page', 1));
        // 		$pager->init();
        $this->pager = $qSearch->execute();//$pager;
    }

    /**
     * Function to View usertheme
     *
     * @param sfWebRequest $request
     */
    Public function executeView(sfWebRequest $request)
    {
		/* to get the site url */
        $oSiteConfig = Doctrine::getTable('SiteConfig')->findByConfigKey("SITE_URL");
        $asSiteUrl = $oSiteConfig->toArray();
        $this->ssSiteUrl = $asSiteUrl[0]["ConfigValue"];
        /* End the site url path */
		
		$this->setLayout('popup');
        // START to give the option in view to set theme
        $webId = $this->getUser()->getAttribute('personalWebsiteId');
        $oUsersWebsite = new UsersWebsite();
        $asResult = $oUsersWebsite->currentThemeId($webId);
        $this->snThemeId = $asResult[0]["ThemeId"];
        // END to give the option in view to set theme

        $snId = $request->getParameter('id');
        $view = $this->view = Doctrine::getTable('Theme')->find(array($snId));
        $this->optionData = unserialize($view->getOptions());

    }

    /**
     * Function to Update usertheme
     *
     * @param sfWebRequest $request
     */
    public function executeUpdateTheme(sfWebRequest $request)
    {
        /*this is the id of userwebsite table */
        $webId = $this->getUser()->getAttribute('personalWebsiteId');
        /* get the selected theme id */

        // Start When Set Theme From View
        if($request->hasParameter('themeId'))
        {
            if($request->getParameter('themeId')!= '')
            $ThemeId = $request->getParameter('themeId');
            // End When Set Theme From View
        }
        else
        $ThemeId = $request->getPostParameter('radio[0]');

        /* update the theme id */
        $oUsersWebsite = new UsersWebsite();
        $oUsersWebsite->updteThemeId($webId,$ThemeId);

        // Here Code To Update Theme Settings And Content done by Chintan
        $this->updateThemeContent($webId, $ThemeId );

        $themeData = Doctrine::getTable('Theme')->find(array($ThemeId));
        // Code complete to update theme

        // Start When Set Theme From View
        //         if($request->hasParameter('themeId'))
        //         {
        // 			$this->getUser()->setFlash('succMsg', "Theme has been set as current theme successfully ");
        // 			if($request->getParameter('themeId')!= '')
        // 				$this->redirect("usertheme/view?id=".$ThemeId);
        // 		}
        // End When Set Theme From View
        $this->getUser()->setFlash('succMsg', '" '.$themeData->getName().' " has been set as the current theme. ');
        $this->redirect("themeOptions/edit");
    }

    public function updateThemeContent($websiteId , $themeId){
        #echo $websiteId.'=='. $themeId;

        // Get New Theme Feature
        $newThemeObj =  Doctrine::getTable('Theme')->find(array($themeId));
        $topMenu = $newThemeObj->getManageTopMenu();
        $footerMenu = $newThemeObj->getManageFooterMenu();
        $banner = $newThemeObj->getManageBanner();
        $colorComb = $newThemeObj->getManageColorAndBackground();
        $socialMedia = $newThemeObj->getManageSocialMedia();
        $logo = $newThemeObj->getChangeLogo();
        $faq = $newThemeObj->getManageFAQs();
        $textWidget = $newThemeObj->getTextWidgets();
        $bodyBackground = $newThemeObj->getBodyBackground();
        $newThemeOptions = unserialize($newThemeObj->getOptions());

        // Complete

        // Get Theme Current Options
        $oldOptions = ThemeOptionsTable::getThemeOptions($websiteId);
        #clsCommon::pr($newThemeOptions);
        #clsCommon::pr($oldOptions);
        

        clsCommon::createPersonalWebsiteDefaultFolders($websiteId); // Create Default folder for
        $XMLArr = clsCommon::getThemeDefaultContent($websiteId, $themeId);


        // File Paths
        $dataFolder = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR;
        $thmeFolder = 'theme'.$themeId.DIRECTORY_SEPARATOR;

        #$xlFilePath = $dataFolder.$thmeFolder.'xml'.DIRECTORY_SEPARATOR.$xmlFile;
        $logoFilePath = $dataFolder.$thmeFolder.'logo'.DIRECTORY_SEPARATOR.'logo.png';
        $bannerFilePath = $dataFolder.$thmeFolder.'banner'.DIRECTORY_SEPARATOR;

        /* START code added by jaydip dodiya */
		if($bodyBackground == 'Yes')
		{
			$bodyBackgroundExist = ThemeOptionsTable::checkBodyBackgroundExist($websiteId);

			if($bodyBackgroundExist)
			{
				// Start Body Background
				if(isset($XMLArr['bodybackground']) && !empty($XMLArr['bodybackground']) )  {
					$bodyBackgroundImage = explode('/',$XMLArr['bodybackground']['item']['optionvalue']);
					$bodyBackgroundName = end($bodyBackgroundImage);
					$sourceBodyBackground = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'Media'.DIRECTORY_SEPARATOR.$XMLArr['bodybackground']['item']['optionvalue'];
					$destinationBodyBackground = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$websiteId.DIRECTORY_SEPARATOR.'body-background'.DIRECTORY_SEPARATOR.$bodyBackgroundName;
					copy($sourceBodyBackground, $destinationBodyBackground);
					//$bodyBackgroundOptionKey = $XMLArr['bodybackground']['item']['optionkey'];
					$bodyBackgroundoptionValue = $bodyBackgroundName;
					
					// Update in Theme Option table
						$themeOptions1 = new ThemeOptions();
						$themeOptions1->setThemeId($themeId);
						$themeOptions1->setWebsiteId($websiteId);
						$themeOptions1->setOptionKey('BodyBackground');
						$themeOptions1->setOptionValue(trim($bodyBackgroundoptionValue));
						$themeOptions1->save();
						
				}
				// End Body Background
			}
		}
		/*END code added by jaydip dodiya */
		
        // Check For Footer Menu
        if($footerMenu == 'Yes' ) {
            $footerMenuExist = WebsiteMenuTable::checkMenuExist($websiteId, sfConfig::get('app_MenuType_Footer'));

            // If Top Menu Not Exist Then Make Entry For Top Menu in DB
            if(!$footerMenuExist) {

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



            } // End of Not Exist


        }// End of Top Menu

        // Check For Banner
        if($banner == 'Yes' ) {
            $bannerExist = ThemeBannerTable::checkBannerExist($websiteId);

            // Check for Banner Background
            if($newThemeOptions['BannerBackground'] == 'Yes' ) {

                if(isset($oldOptions['BGImage']) && !empty($oldOptions['BGImage']) ) {
                    $bgImagePath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$websiteId.DIRECTORY_SEPARATOR.'banner-background'.DIRECTORY_SEPARATOR.$oldOptions['BGImage'];
                    if(file_exists($bgImagePath)) {

                    } else { // If File Not Exist Then Update Option table with New Background Image

                        if(isset($XMLArr['banner']['backgroundimage']) && !empty($XMLArr['banner']['backgroundimage'])) {
                            $bgImage = explode('/',$XMLArr['banner']['backgroundimage']);
                            $bgImage = end($bgImage);

                            $sourceBGBanner = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'Media'.DIRECTORY_SEPARATOR.$XMLArr['banner']['backgroundimage'];
                            $destinationBGBanner = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$websiteId.DIRECTORY_SEPARATOR.'banner-background'.DIRECTORY_SEPARATOR.$bgImage;
                            copy($sourceBGBanner, $destinationBGBanner);

                            // Update in Theme Option table
                            Doctrine_Query::create()
                            ->update('ThemeOptions')
                            ->set('OptionValue', '?', $bgImage)
                            ->where('WebsiteId = ?', $websiteId)
                            ->andWhere('OptionKey = ?', 'BGImage')
                            ->execute();

                        } // end of if with banner -background

                    }
                } // End of Check Bg Image

                else { // Make New Entry for banner Background

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
                    }
                } // End of Else 
            } // End of if Banner Background
            // Complete For Background

            // If Banner Not Exist Then Make Entry For Banner in DB
            if(!$bannerExist) {

                if(isset($XMLArr['banner']) && !empty($XMLArr['banner']) )  {
                    for($i= 0; $i<count($XMLArr['banner']['item']) ; $i++) {


                        /*$sourceBanner = $bannerFilePath.'banner'.($i+1).'.png'; // Banner Image

                        $bImageName = $XMLArr['banner']['item'][$i]['image'];
                        $bImageArr = explode('.',$bImageName);
                        $extention = end($bImageArr);
                        $bTime  = time();

                        $bImage = $bImageArr[0].'_'.$bTime.'.'.$extention;*/


                        $bImage = explode('/',$XMLArr['banner']['item'][$i]['image']);
                        $bImage = end($bImage);

                        $sourceBanner = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'Media'.DIRECTORY_SEPARATOR.$XMLArr['banner']['item'][$i]['image'];
                        $destinationBanner = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$websiteId.DIRECTORY_SEPARATOR.'banner'.DIRECTORY_SEPARATOR.$bImage;
                        copy($sourceBanner, $destinationBanner);

                        $destinationThumbBanner = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$websiteId.DIRECTORY_SEPARATOR.'banner'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$bImage;
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

                    } // End of For
                } // Complete if Exist in XML or not

            }

        } // End of Banner

        // Check For Text Widget
        #clsCommon::pr($XMLArr['textwidget']);
        if($textWidget == 'Yes'){
            $totWidget = $newThemeOptions['TextWidgets'] ;

            for($i=0; $i<$totWidget  ; $i++) {
                $widgetNo = $i+1;
                $widgetExist = ThemeOptionsTable::checkTextWidgetExist($websiteId, $widgetNo);

                // If Widget Not exist then make entry in DB
                if(!$widgetExist) {
                    $themeOptions = new ThemeOptions();
                    $themeOptions->setThemeId($themeId);
                    $themeOptions->setWebsiteId($websiteId);
                    $themeOptions->setOptionKey('TextWidgetsTitle_'.$widgetNo);
                    $themeOptions->setOptionValue(trim($XMLArr['textwidget']['item'][$i]['title']));
                    $themeOptions->save();

                    $themeOptions1 = new ThemeOptions();
                    $themeOptions1->setThemeId($themeId);
                    $themeOptions1->setWebsiteId($websiteId);
                    $themeOptions1->setOptionKey('TextWidgets_'.$widgetNo);
                    $themeOptions1->setOptionValue(trim($XMLArr['textwidget']['item'][$i]['content']));
                    $themeOptions1->save();
                }   // End of if
            } // End of For

        } // End of Text widget

        /* START code added by jaydip dodiya @ 13,14/08/2013 */
		if($colorComb == 'Yes')
		{
			if($newThemeOptions["BGColor"] != "")
			{
				if(array_key_exists("BGColor", $oldOptions))
				{
					Doctrine_Query::create()
						->update('ThemeOptions')
						->set('OptionValue', '?', $newThemeOptions["BGColor"])
						->where('WebsiteId = ?', $websiteId)
						->andWhere('OptionKey = ?', 'BGColor')
						->execute();
				}
				
			}

			if($newThemeOptions["TextColor"] != "")
			{
				if(array_key_exists("TextColor", $oldOptions))
				{
					Doctrine_Query::create()
						->update('ThemeOptions')
						->set('OptionValue', '?', $newThemeOptions["TextColor"])
						->where('WebsiteId = ?', $websiteId)
						->andWhere('OptionKey = ?', 'TextColor')
						->execute();
				}
			}

			if($newThemeOptions["BorderColor"] != "")
			{
				if(array_key_exists("BorderColor", $oldOptions))
				{
					Doctrine_Query::create()
						->update('ThemeOptions')
						->set('OptionValue', '?', $newThemeOptions["BorderColor"])
						->where('WebsiteId = ?', $websiteId)
						->andWhere('OptionKey = ?', 'BorderColor')
						->execute();
				}
			}

			if($newThemeOptions["LinkColor"] != "")
			{
				if(array_key_exists("LinkColor", $oldOptions))
				{
					Doctrine_Query::create()
						->update('ThemeOptions')
						->set('OptionValue', '?', $newThemeOptions["LinkColor"])
						->where('WebsiteId = ?', $websiteId)
						->andWhere('OptionKey = ?', 'LinkColor')
						->execute();
				}
			}

			if($newThemeOptions["LinkHoverColor"] != "")
			{
				if(array_key_exists("LinkHoverColor", $oldOptions))
				{
					Doctrine_Query::create()
						->update('ThemeOptions')
						->set('OptionValue', '?', $newThemeOptions["LinkHoverColor"])
						->where('WebsiteId = ?', $websiteId)
						->andWhere('OptionKey = ?', 'LinkHoverColor')
						->execute();
				}
			}
			
		}

		/*START Set Default Background Image from XML */
		if($banner == 'Yes' ) {
			if($newThemeOptions['BannerBackground'] == 'Yes' ) {

				if(isset($oldOptions['BGImage']) && !empty($oldOptions['BGImage']) ) {
					$bgImagePath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$websiteId.DIRECTORY_SEPARATOR.'banner-background'.DIRECTORY_SEPARATOR.$oldOptions['BGImage'];
					if(isset($XMLArr['banner']['backgroundimage']) && !empty($XMLArr['banner']['backgroundimage'])) {
						$bgImage = explode('/',$XMLArr['banner']['backgroundimage']);
						$bgImage = end($bgImage);

						$sourceBGBanner = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'Media'.DIRECTORY_SEPARATOR.$XMLArr['banner']['backgroundimage'];
						$destinationBGBanner = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$websiteId.DIRECTORY_SEPARATOR.'banner-background'.DIRECTORY_SEPARATOR.$bgImage;
						@unlink($bgImagePath);
						copy($sourceBGBanner, $destinationBGBanner);

						// Update in Theme Option table
						Doctrine_Query::create()
						->update('ThemeOptions')
						->set('OptionValue', '?', $bgImage)
						->where('WebsiteId = ?', $websiteId)
						->andWhere('OptionKey = ?', 'BGImage')
						->execute();

					} // end of if with banner -background
				} // End of Check Bg Image
			} // End of if Banner Background
		}
        /*START Set Default Body Background from XML */

		/*START Set Default Body Background from XML */
		if($bodyBackground == 'Yes')
		{
			if(array_key_exists("BodyBackground", $oldOptions))
			{
				// Start Body Background
				if(isset($XMLArr['bodybackground']) && !empty($XMLArr['bodybackground']) )  {
					$bodyBackgroundImage = explode('/',$XMLArr['bodybackground']['item']['optionvalue']);
					$bodyBackgroundName = end($bodyBackgroundImage);
					$sourceBodyBackground = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'Media'.DIRECTORY_SEPARATOR.$XMLArr['bodybackground']['item']['optionvalue'];
					$destinationBodyBackground = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$websiteId.DIRECTORY_SEPARATOR.'body-background'.DIRECTORY_SEPARATOR.$bodyBackgroundName;
					$oldDestinationBodyBackground = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$websiteId.DIRECTORY_SEPARATOR.'body-background'.DIRECTORY_SEPARATOR;
					@unlink($oldDestinationBodyBackground.$oldOptions["BodyBackground"]);
					copy($sourceBodyBackground, $destinationBodyBackground);
					//$bodyBackgroundOptionKey = $XMLArr['bodybackground']['item']['optionkey'];
					$bodyBackgroundoptionValue = $bodyBackgroundName;
					
					// Update in Theme Option table
						$themeOptions1 = new ThemeOptions();
						$themeOptions1->setThemeId($themeId);
						$themeOptions1->setWebsiteId($websiteId);
						$themeOptions1->setOptionKey('BodyBackground');
						$themeOptions1->setOptionValue(trim($bodyBackgroundoptionValue));
						$themeOptions1->save();
						
				}
				// End Body Background
			}
		}
		/*END Set Default Body Background from XML */
		
		/* END code added by jaydip dodiya  @ 13,14/08/2013*/

    } // End of Function
    
    /**
     * Function to get the diffrence of theme
     *
     * @param sfWebRequest $request
     */
    public function executeThemeDiffrence(sfWebRequest $request)
    {
		// START to give the option in view to set theme
        $webId = $this->getUser()->getAttribute('personalWebsiteId');
        $oUsersWebsite = new UsersWebsite();
        $asResult = $oUsersWebsite->currentThemeId($webId);
        $this->snThemeId = $asResult[0]["ThemeId"];
        // END to give the option in view to set theme

        $currentThemeData = $this->currentThemeData = Doctrine::getTable('Theme')->find(array( $this->snThemeId ));
        $this->currentOptionData = unserialize($currentThemeData->getOptions());

        $snId = $request->getParameter('id');
        $selectedTheme = $this->selectedTheme = Doctrine::getTable('Theme')->find(array($snId));
        $this->optionData = unserialize($selectedTheme->getOptions());

        $this->setLayout('popup');
    }
}
