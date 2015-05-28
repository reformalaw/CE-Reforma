<?php

class themeComponents extends sfComponents
{

    // Here Theme color setting has been done
    public function executeCustomize(sfWebRequest $request)
    {
        $websiteId =  $this->context->get('WebsiteId');
        $themeId = $this->context->get('ThemeId');

        // Get Theme Options from the ThemeOptions Table
        $themeOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($websiteId);

        // Themes Original Setings from Theme Table
        $themeDetail = Doctrine_Core::getTable('Theme')->findOneById($themeId);
        $optionsStr = $themeDetail->getOptions();
        $optionsArr = unserialize($optionsStr);
		$bodyBackgroundValue = $themeDetail->getBodyBackground();

        /* Custom Theme Apply */
        $updateValArr = array(

        '##BGCOLOR##'       =>  ((!empty($themeOptions['BGColor'])      ? $themeOptions['BGColor'] : (!empty($optionsArr['BGColor'])      ? $optionsArr['BGColor'] : ''))) ,
        '##TEXTCOLOR##'     =>  ((!empty($themeOptions['TextColor'])    ? $themeOptions['TextColor'] : (!empty($optionsArr['TextColor'])      ? $optionsArr['TextColor'] : ''))) ,
        '##BORDERCOLOR##'   =>  ((!empty($themeOptions['BorderColor'])  ? $themeOptions['BorderColor'] : (!empty($optionsArr['BorderColor'])      ? $optionsArr['BorderColor'] : ''))),
        '##LINKCOLOR##'     =>  ((!empty($themeOptions['LinkColor'])    ? $themeOptions['LinkColor'] : (!empty($optionsArr['LinkColor'])      ? $optionsArr['LinkColor'] : ''))),
        '##LINKHOVERCOLOR##'=>  ((!empty($themeOptions['LinkHoverColor']) ? $themeOptions['LinkHoverColor'] : (!empty($optionsArr['LinkHoverColor'])      ? $optionsArr['LinkHoverColor'] : '')))
        );


        /* START code added by jaydip dodiya for body background (texture) */
        // Now check For Body Background
        if(isset($bodyBackgroundValue) && $bodyBackgroundValue == 'Yes' && !empty($themeOptions['BodyBackground'])) {
            $bodyBackgroundImagePath = sfConfig::get("sf_upload_dir").DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$websiteId.DIRECTORY_SEPARATOR.'body-background'.DIRECTORY_SEPARATOR.$themeOptions['BodyBackground'];
            if(file_exists($bodyBackgroundImagePath)) {
                $updateValArr['##BODYBACKGROUND##'] = "url(../../uploads/website/".$websiteId."/body-background/".$themeOptions['BodyBackground'].")";
            }
        } // End of IF
        /* END code added by jaydip dodiya for body background (texture) */


        // Now check For Banner Background
        if(isset($optionsArr['BannerBackground']) && $optionsArr['BannerBackground'] == 'Yes' && !empty($themeOptions['BGImage'])) {
            $bgImagePath = sfConfig::get("sf_upload_dir").DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR.$websiteId.DIRECTORY_SEPARATOR.'banner-background'.DIRECTORY_SEPARATOR.$themeOptions['BGImage'];
            if(file_exists($bgImagePath)) {
                $updateValArr['##BGIMAGE##'] = "url(../../uploads/website/".$websiteId."/banner-background/".$themeOptions['BGImage'].")";
            }
            
        } // End of IF

        /*clsCommon::pr($optionsArr);
        clsCommon::pr($themeOptions);
        clsCommon::pr($updateValArr);*/

        // Read Custom CSS for Theme
        $cssFilePath = sfConfig::get("sf_web_dir").DIRECTORY_SEPARATOR.'css'.DIRECTORY_SEPARATOR.'theme'.$themeId.DIRECTORY_SEPARATOR.'custom.css';
        $handle = fopen($cssFilePath, "r");
        $contents = fread($handle, filesize($cssFilePath));
        fclose($handle);


        foreach ($updateValArr as $key => $val ){

            $contents = str_replace($key, $val, $contents);
        }
        $this->cssContent = $contents;
        // Complete

        #die;
        // Completed


    }

    // Theme 1 Header Footer
    public function executeHeader1(sfWebRequest $request)
    {
        $siteURL = $request->getHost();

        $this->websiteId =  $this->context->get('WebsiteId');
        $websiteUrl = $this->context->get('WebsiteURL');

        $siteDetail = Doctrine::getTable('UsersWebsite')->find($this->websiteId);
        $this->siteDetail = $siteDetail ;

        $this->practiceAreaArr = WebsitePracticeAreaTable::getPracticeArea($this->websiteId); // User Practice Area

        // Get Theme Options from the ThemeOptions Table
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Header Parent Menus
        $this->menuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Header'));


    }

    public function executeFooter1(sfWebRequest $request)
    {
        /*$UserId =  $this->context->get('UserId');
        $this->userDetail = Doctrine::getTable('Users')->findOneBy('Id',$UserId) ;*/

        // Get Theme Options from the ThemeOptions Table
        $this->websiteId =  $this->context->get('WebsiteId');
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);
        #clsCommon::pr($this->websiteOptions);

        // Get Website Footer Menus
        $this->footerMenuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Footer'));


    }

    // Theme 1 Complete

    // Theme 2 Header Footer
    public function executeHeader2(sfWebRequest $request)
    {
        $siteURL = $request->getHost();

        $this->websiteId =  $this->context->get('WebsiteId');
        $websiteUrl = $this->context->get('WebsiteURL');

        $siteDetail = Doctrine::getTable('UsersWebsite')->find($this->websiteId);
        $this->siteDetail = $siteDetail ;

        $this->practiceAreaArr = WebsitePracticeAreaTable::getPracticeArea($this->websiteId); // User Practice Area

        // Get Theme Options from the ThemeOptions Table
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Header Parent Menus
        $this->menuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Header'));

        $UserId = $this->context->get('UserId');
        $this->userData = Doctrine::getTable('Users')->find(array($UserId));

    }

    public function executeFooter2(sfWebRequest $request)
    {
        /*$UserId =  $this->context->get('UserId');
        $this->userDetail = Doctrine::getTable('Users')->findOneBy('Id',$UserId) ;*/

        // Get Theme Options from the ThemeOptions Table
        $this->websiteId =  $this->context->get('WebsiteId');
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);
        #clsCommon::pr($this->websiteOptions);

        // Get Website Footer Menus
        $this->footerMenuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Footer'));
    }

    // Theme 2 Complete


    // STAR THME 4
    // Theme 4 Header Footer
    public function executeHeader4(sfWebRequest $request)
    {
        $siteURL = $request->getHost();

        $this->websiteId =  $this->context->get('WebsiteId');
        $websiteUrl = $this->context->get('WebsiteURL');

        $siteDetail = Doctrine::getTable('UsersWebsite')->find($this->websiteId);
        $this->siteDetail = $siteDetail ;

        $this->practiceAreaArr = WebsitePracticeAreaTable::getPracticeArea($this->websiteId); // User Practice Area

        // Get Theme Options from the ThemeOptions Table
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Header Parent Menus
        $this->menuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Header'));


    }

    public function executeFooter4(sfWebRequest $request)
    {
        // Get Theme Options from the ThemeOptions Table
        $this->websiteId =  $this->context->get('WebsiteId');
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Footer Menus
        $this->footerMenuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Footer'));
    }

	// END THME 4
	
	// STAR THME 3
    // Theme 3 Header Footer
    public function executeHeader3(sfWebRequest $request)
    {
        $siteURL = $request->getHost();

        $this->websiteId =  $this->context->get('WebsiteId');
        $websiteUrl = $this->context->get('WebsiteURL');

        $siteDetail = Doctrine::getTable('UsersWebsite')->find($this->websiteId);
        $this->siteDetail = $siteDetail ;

        $this->practiceAreaArr = WebsitePracticeAreaTable::getPracticeArea($this->websiteId); // User Practice Area

        // Get Theme Options from the ThemeOptions Table
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Header Parent Menus
        $this->menuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Header'));


    }

    public function executeFooter3(sfWebRequest $request)
    {
        // Get Theme Options from the ThemeOptions Table
        $this->websiteId =  $this->context->get('WebsiteId');
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Footer Menus
        $this->footerMenuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Footer'));
    }

	// END THME 3
	
	// STAR THME 6
	public function executeHeader6(sfWebRequest $request)
    {
        $siteURL = $request->getHost();

        $this->websiteId =  $this->context->get('WebsiteId');
        $websiteUrl = $this->context->get('WebsiteURL');

        $siteDetail = Doctrine::getTable('UsersWebsite')->find($this->websiteId);
        $this->siteDetail = $siteDetail ;

        $this->practiceAreaArr = WebsitePracticeAreaTable::getPracticeArea($this->websiteId); // User Practice Area

        // Get Theme Options from the ThemeOptions Table
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Header Parent Menus
        $this->menuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Header'));

        $UserId = $this->context->get('UserId');
        $this->userData = Doctrine::getTable('Users')->find(array($UserId));

    }

    public function executeFooter6(sfWebRequest $request)
    {
        // Get Theme Options from the ThemeOptions Table
        $this->websiteId =  $this->context->get('WebsiteId');
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Footer Menus
        $this->footerMenuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Footer'));
    }
    // END THME 6

    // STAR THME 7
	public function executeHeader7(sfWebRequest $request)
    {
        $siteURL = $request->getHost();

        $this->websiteId =  $this->context->get('WebsiteId');
        $websiteUrl = $this->context->get('WebsiteURL');

        $siteDetail = Doctrine::getTable('UsersWebsite')->find($this->websiteId);
        $this->siteDetail = $siteDetail ;

        $this->practiceAreaArr = WebsitePracticeAreaTable::getPracticeArea($this->websiteId); // User Practice Area

        // Get Theme Options from the ThemeOptions Table
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Header Parent Menus
        $this->menuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Header'));

        $UserId = $this->context->get('UserId');
        $this->userData = Doctrine::getTable('Users')->find(array($UserId));
    }

    public function executeFooter7(sfWebRequest $request)
    {
        // Get Theme Options from the ThemeOptions Table
        $this->websiteId =  $this->context->get('WebsiteId');
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Footer Menus
        $this->footerMenuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Footer'));
    }
    // END THME 7

    // STAR THME 9
	public function executeHeader9(sfWebRequest $request)
    {
        $siteURL = $request->getHost();

        $this->websiteId =  $this->context->get('WebsiteId');
        $websiteUrl = $this->context->get('WebsiteURL');

        $siteDetail = Doctrine::getTable('UsersWebsite')->find($this->websiteId);
        $this->siteDetail = $siteDetail ;

        $this->practiceAreaArr = WebsitePracticeAreaTable::getPracticeArea($this->websiteId); // User Practice Area

        // Get Theme Options from the ThemeOptions Table
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Header Parent Menus
        $this->menuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Header'));

        $UserId = $this->context->get('UserId');
        $this->userData = Doctrine::getTable('Users')->find(array($UserId));

    }

    public function executeFooter9(sfWebRequest $request)
    {
        // Get Theme Options from the ThemeOptions Table
        $this->websiteId =  $this->context->get('WebsiteId');
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Footer Menus
        $this->footerMenuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Footer'));
    }
    // END THME 9

    // STAR THME 10
	public function executeHeader10(sfWebRequest $request)
    {
        $siteURL = $request->getHost();

        $this->websiteId =  $this->context->get('WebsiteId');
        $websiteUrl = $this->context->get('WebsiteURL');

        $siteDetail = Doctrine::getTable('UsersWebsite')->find($this->websiteId);
        $this->siteDetail = $siteDetail ;

        $this->practiceAreaArr = WebsitePracticeAreaTable::getPracticeArea($this->websiteId); // User Practice Area

        // Get Theme Options from the ThemeOptions Table
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Header Parent Menus
        $this->menuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Header'));

        $UserId = $this->context->get('UserId');
        $this->userData = Doctrine::getTable('Users')->find(array($UserId));

    }

    // Theme10 menu 
    public function executeMenu10(sfWebRequest $request)
    {
        $this->websiteId =  $this->context->get('WebsiteId');

        // Get Website Header Parent Menus
        $this->menuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Header'));
    }

    public function executeFooter10(sfWebRequest $request)
    {
        // Get Theme Options from the ThemeOptions Table
        $this->websiteId =  $this->context->get('WebsiteId');
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Footer Menus
        $this->footerMenuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Footer'));
    }
    // END THME 10
    
    // STAR THME 11
	public function executeHeader11(sfWebRequest $request)
    {
        $siteURL = $request->getHost();

        $this->websiteId =  $this->context->get('WebsiteId');
        $websiteUrl = $this->context->get('WebsiteURL');

        $siteDetail = Doctrine::getTable('UsersWebsite')->find($this->websiteId);
        $this->siteDetail = $siteDetail ;

        $this->practiceAreaArr = WebsitePracticeAreaTable::getPracticeArea($this->websiteId); // User Practice Area

        // Get Theme Options from the ThemeOptions Table
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Header Parent Menus
        $this->menuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Header'));

        $UserId = $this->context->get('UserId');
        $this->userData = Doctrine::getTable('Users')->find(array($UserId));

    }

    public function executeFooter11(sfWebRequest $request)
    {
        // Get Theme Options from the ThemeOptions Table
        $this->websiteId =  $this->context->get('WebsiteId');
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Footer Menus
        $this->footerMenuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Footer'));
    }
    // END THME 11
    
    // STAR THME 14
	public function executeHeader14(sfWebRequest $request)
    {
        $siteURL = $request->getHost();

        $this->websiteId =  $this->context->get('WebsiteId');
        $websiteUrl = $this->context->get('WebsiteURL');

        $siteDetail = Doctrine::getTable('UsersWebsite')->find($this->websiteId);
        $this->siteDetail = $siteDetail ;

        $this->practiceAreaArr = WebsitePracticeAreaTable::getPracticeArea($this->websiteId); // User Practice Area

        // Get Theme Options from the ThemeOptions Table
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Header Parent Menus
        $this->menuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Header'));

        $UserId = $this->context->get('UserId');
        $this->userData = Doctrine::getTable('Users')->find(array($UserId));

    }

    public function executeFooter14(sfWebRequest $request)
    {
        // Get Theme Options from the ThemeOptions Table
        $this->websiteId =  $this->context->get('WebsiteId');
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Footer Menus
        $this->footerMenuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Footer'));
    }
    // END THME 14

    // STAR THME 16
	public function executeHeader16(sfWebRequest $request)
    {
        $siteURL = $request->getHost();

        $this->websiteId =  $this->context->get('WebsiteId');
        $websiteUrl = $this->context->get('WebsiteURL');

        $siteDetail = Doctrine::getTable('UsersWebsite')->find($this->websiteId);
        $this->siteDetail = $siteDetail ;

        $this->practiceAreaArr = WebsitePracticeAreaTable::getPracticeArea($this->websiteId); // User Practice Area

        // Get Theme Options from the ThemeOptions Table
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Header Parent Menus
        $this->menuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Header'));

        $UserId = $this->context->get('UserId');
        $this->userData = Doctrine::getTable('Users')->find(array($UserId));

    }

    public function executeFooter16(sfWebRequest $request)
    {
        // Get Theme Options from the ThemeOptions Table
        $this->websiteId =  $this->context->get('WebsiteId');
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Footer Menus
        $this->footerMenuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Footer'));
    }
    // END THME 16
    
    // STAR THME 12
	public function executeHeader12(sfWebRequest $request)
    {
        $siteURL = $request->getHost();

        $this->websiteId =  $this->context->get('WebsiteId');
        $websiteUrl = $this->context->get('WebsiteURL');

        $this->practiceAreaArr = WebsitePracticeAreaTable::getPracticeArea($this->websiteId); // User Practice Area

        // Get Theme Options from the ThemeOptions Table
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Header Parent Menus
        $this->menuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Header'));

        $UserId = $this->context->get('UserId');
        $this->userData = Doctrine::getTable('Users')->find(array($UserId));

    }

    public function executeFooter12(sfWebRequest $request)
    {
        // Get Theme Options from the ThemeOptions Table
        $this->websiteId =  $this->context->get('WebsiteId');
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Footer Menus
        $this->footerMenuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Footer'));
    }
    
    // Theme12 menu 
    public function executeMenu12(sfWebRequest $request)
    {
        $this->websiteId =  $this->context->get('WebsiteId');

        // Get Website Header Parent Menus
        $this->menuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Header'));
    }
    // END THME 12

    // STAR THME 8
	public function executeHeader8(sfWebRequest $request)
    {
        $siteURL = $request->getHost();

        $this->websiteId =  $this->context->get('WebsiteId');
        $websiteUrl = $this->context->get('WebsiteURL');

        // Get Theme Options from the ThemeOptions Table
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        $UserId = $this->context->get('UserId');
        $this->userData = Doctrine::getTable('Users')->find(array($UserId));

    }

    public function executeFooter8(sfWebRequest $request)
    {
        // Get Theme Options from the ThemeOptions Table
        $this->websiteId =  $this->context->get('WebsiteId');
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Footer Menus
        $this->footerMenuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Footer'));
    }

    public function executeMenu8(sfWebRequest $request)
    {
		$this->websiteId =  $this->context->get('WebsiteId');
        $websiteUrl = $this->context->get('WebsiteURL');
		// Get Website Header Parent Menus
        $this->menuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Header'));

		//COMMENT : to display banner in header
        $this->bannersArr = ThemeBannerTable::getWebsiteBanners($this->websiteId);
    }
    // END THME 8
    
    // STAR THME 5
	public function executeHeader5(sfWebRequest $request)
    {
        $siteURL = $request->getHost();

        $this->websiteId =  $this->context->get('WebsiteId');
        $websiteUrl = $this->context->get('WebsiteURL');

        $siteDetail = Doctrine::getTable('UsersWebsite')->find($this->websiteId);
        $this->siteDetail = $siteDetail ;

        $this->practiceAreaArr = WebsitePracticeAreaTable::getPracticeArea($this->websiteId); // User Practice Area

        // Get Theme Options from the ThemeOptions Table
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Header Parent Menus
        $this->menuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Header'));

        $UserId = $this->context->get('UserId');
        $this->userData = Doctrine::getTable('Users')->find(array($UserId));

    }

    public function executeFooter5(sfWebRequest $request)
    {
        // Get Theme Options from the ThemeOptions Table
        $this->websiteId =  $this->context->get('WebsiteId');
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Footer Menus
        $this->footerMenuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Footer'));
    }
    // END THME 5
    
    // STAR THME 13
	public function executeHeader13(sfWebRequest $request)
    {
        $siteURL = $request->getHost();

        $this->websiteId =  $this->context->get('WebsiteId');
        $websiteUrl = $this->context->get('WebsiteURL');

        $siteDetail = Doctrine::getTable('UsersWebsite')->find($this->websiteId);
        $this->siteDetail = $siteDetail ;

        $this->practiceAreaArr = WebsitePracticeAreaTable::getPracticeArea($this->websiteId); // User Practice Area

        // Get Theme Options from the ThemeOptions Table
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Header Parent Menus
        $this->menuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Header'));

        $UserId = $this->context->get('UserId');
        $this->userData = Doctrine::getTable('Users')->find(array($UserId));

    }

    public function executeFooter13(sfWebRequest $request)
    {
        // Get Theme Options from the ThemeOptions Table
        $this->websiteId =  $this->context->get('WebsiteId');
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Footer Menus
        $this->footerMenuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Footer'));
    }
    // END THME 13
    
    // STAR THME 15
	public function executeHeader15(sfWebRequest $request)
    {
        $siteURL = $request->getHost();

        $this->websiteId =  $this->context->get('WebsiteId');
        $websiteUrl = $this->context->get('WebsiteURL');

        $siteDetail = Doctrine::getTable('UsersWebsite')->find($this->websiteId);
        $this->siteDetail = $siteDetail ;

        $this->practiceAreaArr = WebsitePracticeAreaTable::getPracticeArea($this->websiteId); // User Practice Area

        // Get Theme Options from the ThemeOptions Table
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Header Parent Menus
        $this->menuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Header'));

        $UserId = $this->context->get('UserId');
        $this->userData = Doctrine::getTable('Users')->find(array($UserId));

    }

    public function executeFooter15(sfWebRequest $request)
    {
        // Get Theme Options from the ThemeOptions Table
        $this->websiteId =  $this->context->get('WebsiteId');
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Footer Menus
        $this->footerMenuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Footer'));
    }
    // END THME 15
    
    // STAR THME 18
	public function executeHeader18(sfWebRequest $request)
    {
        $siteURL = $request->getHost();

        $this->websiteId =  $this->context->get('WebsiteId');
        $websiteUrl = $this->context->get('WebsiteURL');

        $siteDetail = Doctrine::getTable('UsersWebsite')->find($this->websiteId);
        $this->siteDetail = $siteDetail ;

        $this->practiceAreaArr = WebsitePracticeAreaTable::getPracticeArea($this->websiteId); // User Practice Area

        // Get Theme Options from the ThemeOptions Table
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Header Parent Menus
        $this->menuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Header'));

        $UserId = $this->context->get('UserId');
        $this->userData = Doctrine::getTable('Users')->find(array($UserId));

    }

    public function executeFooter18(sfWebRequest $request)
    {
        // Get Theme Options from the ThemeOptions Table
        $this->websiteId =  $this->context->get('WebsiteId');
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Footer Menus
        $this->footerMenuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Footer'));
    }
    // END THME 18
    
    // STAR THME 17
	public function executeHeader17(sfWebRequest $request)
    {
        $siteURL = $request->getHost();

        $this->websiteId =  $this->context->get('WebsiteId');
        $websiteUrl = $this->context->get('WebsiteURL');

        $siteDetail = Doctrine::getTable('UsersWebsite')->find($this->websiteId);
        $this->siteDetail = $siteDetail ;

        $this->practiceAreaArr = WebsitePracticeAreaTable::getPracticeArea($this->websiteId); // User Practice Area

        // Get Theme Options from the ThemeOptions Table
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Header Parent Menus
        $this->menuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Header'));

        $UserId = $this->context->get('UserId');
        $this->userData = Doctrine::getTable('Users')->find(array($UserId));

    }

    public function executeFooter17(sfWebRequest $request)
    {
        // Get Theme Options from the ThemeOptions Table
        $this->websiteId =  $this->context->get('WebsiteId');
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Footer Menus
        $this->footerMenuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Footer'));
    }
    // END THME 17

    // STAR THME 19
	public function executeHeader19(sfWebRequest $request)
    {
        $siteURL = $request->getHost();

        $this->websiteId =  $this->context->get('WebsiteId');
        $websiteUrl = $this->context->get('WebsiteURL');

        $siteDetail = Doctrine::getTable('UsersWebsite')->find($this->websiteId);
        $this->siteDetail = $siteDetail ;

        $this->practiceAreaArr = WebsitePracticeAreaTable::getPracticeArea($this->websiteId); // User Practice Area

        // Get Theme Options from the ThemeOptions Table
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Header Parent Menus
        $this->menuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Header'));

        $UserId = $this->context->get('UserId');
        $this->userData = Doctrine::getTable('Users')->find(array($UserId));

    }

    public function executeFooter19(sfWebRequest $request)
    {
        // Get Theme Options from the ThemeOptions Table
        $this->websiteId =  $this->context->get('WebsiteId');
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Footer Menus
        $this->footerMenuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Footer'));
    }
    // END THME 19

    // STAR THME 20
	public function executeHeader20(sfWebRequest $request)
    {
        $siteURL = $request->getHost();

        $this->websiteId =  $this->context->get('WebsiteId');
        $websiteUrl = $this->context->get('WebsiteURL');

        $siteDetail = Doctrine::getTable('UsersWebsite')->find($this->websiteId);
        $this->siteDetail = $siteDetail ;

        $this->practiceAreaArr = WebsitePracticeAreaTable::getPracticeArea($this->websiteId); // User Practice Area

        // Get Theme Options from the ThemeOptions Table
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Header Parent Menus
        $this->menuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Header'));

        $UserId = $this->context->get('UserId');
        $this->userData = Doctrine::getTable('Users')->find(array($UserId));

    }

    public function executeFooter20(sfWebRequest $request)
    {
        // Get Theme Options from the ThemeOptions Table
        $this->websiteId =  $this->context->get('WebsiteId');
        $this->websiteOptions = Doctrine_Core::getTable('ThemeOptions')->getThemeOptions($this->websiteId);

        // Get Website Footer Menus
        $this->footerMenuObj = WebsiteMenuTable::getParentMenuList($this->websiteId, 0, sfConfig::get('app_MenuType_Footer'));
    }
    // END THME 20
}
?>