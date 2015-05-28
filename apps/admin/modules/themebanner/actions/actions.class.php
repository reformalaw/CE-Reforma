<?php

/**
 * themebanner actions.
 *
 * @package    counceledge
 * @subpackage themebanner
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class themebannerActions extends sfActions
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
     * Function to Listing themebanner
     *
     * @param sfWebRequest $request
     */
	public function executeIndex(sfWebRequest $request)
	{
		$this->orderBy = "";
		$this->orderType="";
		$where = "";
		$webId = $this->getUser()->getAttribute('personalWebsiteId');
		
		//number of banner title
		$totalBannerTitle = $this->totalBannerNumber();
		$this->totalBannerTitle = $totalBannerTitle;
		
		$qSearch = Doctrine_Query::create();
		$qSearch->from('ThemeBanner th');
		$qSearch->where('th.WebsiteId = ?', $webId);
		
		
		/*if($request->getParameter('search_text'))
		$where .="th.name LIKE '%".$request->getParameter('search_text')."%'";
		
		$qSearch->where($where);*/

		switch($request->getParameter('orderBy'))
		{
			case "id":
				$orderBy = 'th.Id';
				$this->orderBy = "id";
				break;
			default:
				$orderBy = 'th.Id';
				$this->orderBy = "id";
				break;
		}

		switch($request->getParameter('orderType'))
		{
			case "asc":
				$qSearch->orderBy("$orderBy asc");
				$this->orderType = "asc";
				break;
			case "desc":
			default:
				$qSearch->orderBy("$orderBy desc");
				$this->orderType = "desc";
				break;
		}
		
		$pager = new sfDoctrinePager('ThemeBanner', sfConfig::get('app_no_of_records_per_page'));
		$pager->setQuery($qSearch);
		$pager->setPage($request->getParameter('page', 1));
		$pager->init();
		$this->pager = $pager; 
	}

	/**
     * Function to New themebanner
     *
     * @param sfWebRequest $request
     */
	public function executeNew(sfWebRequest $request)
	{
		$totalBannerTitle = $this->totalBannerNumber();
		$this->totalBannerTitle = $totalBannerTitle;
		$this->form = new ThemeBannerForm(array(),array('totlaBannerTitle'=>$totalBannerTitle));
	}

	/**
     * Function to return total banner title
     *
     * return number
     */
	public function totalBannerNumber()
	{
		$webId = $this->getUser()->getAttribute('personalWebsiteId');
		$usersWebsiteData = Doctrine::getTable('UsersWebsite')->find(array($webId));
		$options = $usersWebsiteData->getUsersWebsiteTheme()->getOptions();
		$unserializeOptions = unserialize($options);
		$result = (array_key_exists(sfConfig::get("app_Color_ManageBanner") ,$unserializeOptions)) ? $unserializeOptions[sfConfig::get("app_Color_ManageBanner")] : 0;
		return $result;
	}
	/**
     * Function to Create themebanner
     *
     * @param sfWebRequest $request
     */
	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$totalBannerTitle = $this->totalBannerNumber();
		$this->totalBannerTitle = $totalBannerTitle;
		$this->form = new ThemeBannerForm(array(),array('totlaBannerTitle'=>$totalBannerTitle));

		$imgBannerType = $request->getPostParameter('bannertype');
		$this->processForm($request, $this->form,$imgBannerType);

		$this->setTemplate('new');
	}

	/**
     * Function to Edit themebanner
     *
     * @param sfWebRequest $request
     */
	public function executeEdit(sfWebRequest $request)
	{
		if(clsCommon::chkDataExist("ThemeBanner" ,$request->getParameter('id'), $this->getUser()->getAttribute('personalWebsiteId')))
		{
			$this->forward404Unless($theme_banner = Doctrine::getTable('ThemeBanner')->find(array($request->getParameter('id'))), sprintf('Object theme_banner does not exist (%s).', $request->getParameter('id')));
			$totalBannerTitle = $this->totalBannerNumber();
			$this->totalBannerTitle = $totalBannerTitle;
			$this->form = new ThemeBannerForm($theme_banner,array('totlaBannerTitle'=>$totalBannerTitle));
		}
		else
		{
			$this->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
			$this->redirect('default/index');
		}
	}

	/**
     * Function to Update themebanner
     *
     * @param sfWebRequest $request
     */
	public function executeUpdate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($theme_banner = Doctrine::getTable('ThemeBanner')->find(array($request->getParameter('id'))), sprintf('Object theme_banner does not exist (%s).', $request->getParameter('id')));
		$totalBannerTitle = $this->totalBannerNumber();
		$this->totalBannerTitle = $totalBannerTitle;
		$this->form = new ThemeBannerForm($theme_banner,array('totlaBannerTitle'=>$totalBannerTitle));
		$imgBannerType = $request->getPostParameter('bannertype');
		$this->processForm($request, $this->form,$imgBannerType);

		$this->setTemplate('edit');
	}

	/**
     * Function to Delete themebanner
     *
     * @param sfWebRequest $request
     */
	public function executeDelete(sfWebRequest $request)
	{
		if(clsCommon::chkDataExist("ThemeBanner" ,$request->getParameter('id'), $this->getUser()->getAttribute('personalWebsiteId')))
		{
			$webId = $this->getUser()->getAttribute('personalWebsiteId');
			$this->forward404Unless($theme_banner = Doctrine::getTable('ThemeBanner')->find(array($request->getParameter('id'))), sprintf('Object theme_banner does not exist (%s).', $request->getParameter('id')));

			$ThemeBannerPath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.sfConfig::get('app_themebanner'); //GET ThemeBanner  Path
			if($theme_banner->getImage() != "")
			{
				$ssBannerPath = $ThemeBannerPath.$webId.DIRECTORY_SEPARATOR.sfConfig::get('app_banner');// Path for Banner
				$ssBannerThumbPath = $ThemeBannerPath.$webId.DIRECTORY_SEPARATOR.sfConfig::get('app_banner').DIRECTORY_SEPARATOR.sfConfig::get('app_thumb');//path for BannerThumb

				$unlink_ThemeBanner       = @unlink($ssBannerPath.$theme_banner->getImage());
				$unlink_ThemeBanner_thumb = @unlink($ssBannerThumbPath.$theme_banner->getImage());
			}

			$theme_banner->delete();
			$this->getUser()->setFlash('succMsg', "Deletion successful.");
		
			$this->redirect('themebanner/index');
		}
		else
		{
			$this->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
			$this->redirect('default/index');
		}
	}

	/**
     * Function to move picture
     *
     * @param string $ThemeBannerPath
     * @param integer $webId
     * @param string $folderName
     * @param string $imageName
     */
	public function pictureMove($ThemeBannerPath, $webId, $folderName, $imageName, $bannerFolder, $bannerThumbFolder)
	{
		//website id folder create
		if(!is_dir($ThemeBannerPath.$webId))
		{
			mkdir($ThemeBannerPath.$webId,0777);
		}
		
		//banner folder create
		if(!is_dir($bannerFolder))
		{
			mkdir($bannerFolder, 0777);
		}

		//banner thumb folder create
		if(!is_dir($bannerThumbFolder))
		{
			mkdir($bannerThumbFolder, 0777);
		}
		
		$sourceImagePath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR."Media".DIRECTORY_SEPARATOR.$folderName.DIRECTORY_SEPARATOR.$imageName;
		copy($sourceImagePath, $bannerFolder.$imageName);

		/* Start Generate Thumb */
			$thumbPath = $bannerThumbFolder;
			$thumbnail = new sfThumbnail(sfConfig::get('app_BannerCustomImage_ThumbHeight'), sfConfig::get('app_BannerCustomImage_ThumbWidth'),true,true,100);
			$thumbnail->loadFile($bannerFolder.$imageName);
			$thumbnail->save($thumbPath.$imageName);
		/* End Generate Thumb */
	}
	/**
     * Function to Process Form of themebanner
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     */
	protected function processForm(sfWebRequest $request, sfForm $form , $imgBannerType='')
	{
		$webId = $this->getUser()->getAttribute('personalWebsiteId');
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid())
		{
			$file = $request->getFiles($form->getName()); //GET  Image
			$fileExtArr = sfConfig::get('app_imageType'); //GET ALLOWED FILE TYPE
			$ThemeBannerPath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.sfConfig::get('app_themebanner'); //GET ThemeBanner  Path
			
			//IF THE USER UPLOADED THE FILE       // SET DEFAULT HAS ERROR TO FALSE
			$hasError = false;

			//path for banner folder and thumb
			$bannerFolder = $ThemeBannerPath.$webId.DIRECTORY_SEPARATOR.sfConfig::get('app_banner');
			$bannerThumbFolder = $ThemeBannerPath.$webId.DIRECTORY_SEPARATOR.sfConfig::get('app_banner').DIRECTORY_SEPARATOR.sfConfig::get('app_thumb');
			
			//when user select from scrolling 
			if($imgBannerType != '')
			{
				$typaAndId = explode("_", $imgBannerType);
				
				$objectMedia = Doctrine::getTable('Media')->find(array($typaAndId[1]));
				$imageName = $objectMedia->getImageName();
				
				/*move the image */
				if($typaAndId[0] == "Foreground"):
					$this->pictureMove($ThemeBannerPath, $webId, "Banner-Foreground", $imageName, $bannerFolder, $bannerThumbFolder);
				elseif($typaAndId[0] == "Unsorted"):
					$this->pictureMove($ThemeBannerPath, $webId, "Unsorted", $imageName, $bannerFolder, $bannerThumbFolder);
				endif;
				
				// START Update and Add time set Image name in form and unlink the image
				if($request->isMethod(sfRequest::PUT))
					$oldFile =  $form->getObject()->getImage();

				$form->getObject()->setImage($imageName);
				unset($form["Image"]);
				
				if($request->isMethod(sfRequest::PUT))
				{
					$unlink_media = @unlink($bannerFolder.$oldFile);
					$unlink_media = @unlink($bannerThumbFolder.$oldFile);
				}
				// END Update and Add time set Image name in form and unlink the image
			}
			// when user not select any image at that time move no-image
// 			elseif(empty($file['Image']['name']) && $imgBannerType == "")
// 			{
// 				$this->pictureMove($ThemeBannerPath, $webId, "Default-Image", "noImage.jpeg", $bannerFolder, $bannerThumbFolder);
// 
// 				// START Update and Add time set Image name in form and unlink the image
// 				if($request->isMethod(sfRequest::PUT))
// 					$oldFile =  $form->getObject()->getImage();
// 
// 				$form->getObject()->setImage("noImage.jpeg");
// 				unset($form["Image"]);
// 				
// 				if($request->isMethod(sfRequest::PUT))
// 				{
// 					$unlink_media = @unlink($bannerFolder.$oldFile);
// 					$unlink_media = @unlink($bannerThumbFolder.$oldFile);
// 				}
// 				// END Update and Add time set Image name in form 
// 			}

			if (!empty($file['Image']['name']))
			{
				/* Start create folder if not exit for personal website*/
				if(!is_dir($ThemeBannerPath.$webId))
				{
					mkdir($ThemeBannerPath.$webId,0777);
					mkdir($ThemeBannerPath.$webId.DIRECTORY_SEPARATOR.sfConfig::get('app_banner'),0777);
					$ssBannerPath = $ThemeBannerPath.$webId.DIRECTORY_SEPARATOR.sfConfig::get('app_banner');
					mkdir($ThemeBannerPath.$webId.DIRECTORY_SEPARATOR.sfConfig::get('app_banner').DIRECTORY_SEPARATOR.sfConfig::get('app_thumb'),0777);
					$ssBannerThumbPath = $ThemeBannerPath.$webId.DIRECTORY_SEPARATOR.sfConfig::get('app_banner').DIRECTORY_SEPARATOR.sfConfig::get('app_thumb');
				}
				else
				{
					$ssBannerPath = $ThemeBannerPath.$webId.DIRECTORY_SEPARATOR.sfConfig::get('app_banner');
					if(!is_dir($ssBannerPath))
					{
						mkdir($ssBannerPath,0777);
						$ssBannerThumbPath = $ThemeBannerPath.$webId.DIRECTORY_SEPARATOR.sfConfig::get('app_banner').DIRECTORY_SEPARATOR.sfConfig::get('app_thumb');
						if(!is_dir($ssBannerThumbPath))
						{
							mkdir($ssBannerThumbPath,0777);
						}
					}
					$ssBannerThumbPath = $ThemeBannerPath.$webId.DIRECTORY_SEPARATOR.sfConfig::get('app_banner').DIRECTORY_SEPARATOR.sfConfig::get('app_thumb');
					
				}
				/*End to create folder */

				//CHECK THE FILE EXTENSION
				if (in_array($file['Image']['type'],$fileExtArr))
				{
					$ext = explode(".",$file['Image']['name']);
					$imageSanitize = $ext[0].'_'.time(); //MODIFY THE FILE NAME
					
					$filename = clsCommon::slugify($imageSanitize);
					
					$extension = $ext[count($ext) - 1];
					$this->docName = $filename.".".$extension;
					$this->docOrgName = $file['Image']['name'];
					move_uploaded_file($file['Image']['tmp_name'],$ssBannerPath.$this->docName); // UPLOAD THE FILE TO THE SERVER
					
					/* Start Generate Thumb */
					$thumbPath = $ssBannerThumbPath;
					$thumbnail = new sfThumbnail(sfConfig::get('app_BannerCustomImage_ThumbHeight'), sfConfig::get('app_BannerCustomImage_ThumbWidth'),true,true,100);
					$thumbnail->loadFile($ssBannerPath.$this->docName);
					$thumbnail->save($thumbPath.$this->docName);
					/* End Generate Thumb */
				}
				else
				{
					// IF NOT VALID EXTENSION   //SET HAS ERROR TRUE
					$hasError=true;
					$this->getUser()->setFlash('imgErrMsg', "Please provide a valid image.");
				}
			} // End of if not empty medai Name

			//IF Media IS UPLOADED
			if($this->docName != "")
			{
				// START Update and Add time set Image name in form and unlink the image
				if($request->isMethod(sfRequest::PUT))
					$oldFile =  $form->getObject()->getImage();

				$form->getObject()->setImage($this->docName);
				unset($form["Image"]);
				
				if($request->isMethod(sfRequest::PUT))
				{
					$unlink_media = @unlink($ssBannerPath.$oldFile);
					$unlink_media = @unlink($ssBannerThumbPath.$oldFile);
				}
				// END Update and Add time set Image name in form and unlink the image
			}
		
			if(!$hasError)
			{
				if(!$request->isMethod(sfRequest::PUT))
				{
					$oUsersWebsite = new UsersWebsite();
					$snThemeId = $oUsersWebsite->currentThemeId($webId);
					$form->getObject()->setThemeId($snThemeId[0]["ThemeId"]);
					$form->getObject()->setWebsiteId($webId);
				}

				$theme_banner = $form->save();

				if($request->isMethod(sfRequest::PUT))
					$this->getUser()->setFlash('succMsg', "Update successful.");
				else 
					$this->getUser()->setFlash('succMsg', "New banner added successfully.");

				$this->redirect('themebanner/index');
			}
		}
	}
	
	/**
     * Function to View themebanner
     *
     * @param sfWebRequest $request
     */
	public function executeView(sfWebRequest $request)
	{
		if(clsCommon::chkDataExist("ThemeBanner" ,$request->getParameter('id'), $this->getUser()->getAttribute('personalWebsiteId')))
		{
			$webId = $this->getUser()->getAttribute('personalWebsiteId');
			$request->getParameter('id');
			$asThemeBannerData = ThemeBannerTable::viewThemeBanner($request->getParameter('id'));
			
			//number of banner title
			$totalBannerTitle = $this->totalBannerNumber();
			$this->totalBannerTitle = $totalBannerTitle;
			
			$this->form = $asThemeBannerData;
			$this->bannerImagePath = sfConfig::get("app_themebanner").$webId.DIRECTORY_SEPARATOR.sfConfig::get('app_banner');
		}
		else
		{
			$this->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
			$this->redirect('default/index');
		}
	}
	
	/**
     * Function to Change Status of themebanner
     *
     * @param sfWebRequest $request
     */
	public function executeChangeBannerStatus(sfWebRequest $request)
    {
		if(clsCommon::chkDataExist("ThemeBanner" ,$request->getParameter('id'), $this->getUser()->getAttribute('personalWebsiteId')))
		{
			$snId 		= 	$request->getParameter('id');
			$ssStatus 	= 	$request->getParameter('status');
			$oThemeBanner = new ThemeBanner();
			$oThemeBanner->changeStatus($snId, $ssStatus);

			if($ssStatus == sfConfig::get("app_Status_Active")){
				$successMessage = "active";
				$msgStatus = "succMsg";
			}
			else{
				$successMessage = "inactive";
				$msgStatus = "errMsg";
			}

			$this->getUser()->setFlash($msgStatus,'Status successfully changed to '.$successMessage.'.');

			$this->redirect('themebanner/index');
        }
        else
		{
			$this->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
			$this->redirect('default/index');
		}

    }

    public function executeSlider(sfWebRequest $request)
    {
		/* to get the site url */
        $oSiteConfig = Doctrine::getTable('SiteConfig')->findByConfigKey("SITE_URL");
        $asSiteUrl = $oSiteConfig->toArray();
        $this->ssSiteUrl = $asSiteUrl[0]["ConfigValue"];
        /* End the site url path */

		$this->foregroundImages = MediaTable::getForegroundImage("BannerForeground");
		$this->unsortedImages = MediaTable::getForegroundImage("Unsorted");
		$this->setLayout("popup");
    }
}