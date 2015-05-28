<?php

/**
 * account actions.
 *
 * @package    my profile
 */
class bannerBackgroundAction extends sfActions
{

	/**
     * Function to Edit profile
     *
     * @param sfWebRequest $request
     */
    public function executeBannerBackground(sfWebRequest $request)
    {
		$webId = $this->getUser()->getAttribute('personalWebsiteId');
		$tableField = array("WebsiteId","OptionKey");
		$themOptionBgImage =Doctrine_Core::getTable('ThemeOptions')->findOneByWebsiteIdAndOptionKey($webId, "BGImage");
		$this->backgroundImageName = $themOptionBgImage->getOptionValue();
		$this->backgroundImages = MediaTable::getForegroundImage("BannerBackground");

		/* to get the site url */
        $oSiteConfig = Doctrine::getTable('SiteConfig')->findByConfigKey("SITE_URL");
        $asSiteUrl = $oSiteConfig->toArray();
        $this->ssSiteUrl = $asSiteUrl[0]["ConfigValue"];
        /* End the site url path */

        $this->form = new BannerBackgroundForm($themOptionBgImage);
		
        if($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT))
        {
			$stockPhotoId = "";
			$stockPhotoId = $request->getPostParameter("stockPhotoId");
            $this->processForm($request, $this->form, $stockPhotoId);
        }
    }

    /**
     * Function to move picture
     *
     * @param string $ThemeBannerPath
     * @param string $folderName
     * @param string $imageName
     */
	public function pictureMove($bannerBackgroundPath, $folderName, $imageName)
	{
		$sourceImagePath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR."Media".DIRECTORY_SEPARATOR.$folderName.DIRECTORY_SEPARATOR.$imageName;
		copy($sourceImagePath, $bannerBackgroundPath.$imageName);
	}

	/**
     * Function to process Edit profile
     *
     * @param sfWebRequest $request
     * @param sfForm       $form
     */
    protected function processForm(sfWebRequest $request, sfForm $form, $stockPhotoId)
    {
        /* Bind the form values */
        $webId = $this->getUser()->getAttribute('personalWebsiteId');
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $backgroundData = $request->getParameter($form->getName());


        /* Validation of the form */
        if ($form->isValid())
        {
			$file = $request->getFiles($form->getName());
			$fileExtArr = sfConfig::get('app_imageType');

			$websiteFolder = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR."website".DIRECTORY_SEPARATOR;
			clsCommon::createWebsiteFolders($websiteFolder, $webId);
			$websiteIdFolder =$websiteFolder.$webId.DIRECTORY_SEPARATOR;
			clsCommon::createWebsiteFolders($websiteIdFolder, sfConfig::get("app_Website_BannerBackground"));
			$bannerBackgroundPath = $websiteIdFolder.sfConfig::get("app_Website_BannerBackground").DIRECTORY_SEPARATOR;

			$hasError = false;

			if($stockPhotoId != '')
			{
				$typaAndId = explode("_", $stockPhotoId);
				
				$objectMedia = Doctrine::getTable('Media')->find(array($typaAndId[1]));
				$imageName = $objectMedia->getImageName();
				
				/*move the image */
				if($typaAndId[0] == "Background"):
					$this->pictureMove($bannerBackgroundPath, "Banner-Background", $imageName);
				endif;
				
				// START Update and Add time set Image name in form and unlink the image
				if($request->isMethod(sfRequest::PUT))
					$oldFile =  $form->getObject()->getOptionValue();

				$form->getObject()->setOptionValue($imageName);
				unset($form["OptionValue"]);
				
				if($request->isMethod(sfRequest::PUT))
				{
					$unlink_media = @unlink($bannerBackgroundPath.$oldFile);
				}
				// END Update and Add time set Image name in form and unlink the image
			}

			if (!empty($file['OptionValue']['name']))
			{
				if (in_array($file['OptionValue']['type'],$fileExtArr))
				{
					$ext = explode(".",$file['OptionValue']['name']);
					$imageSanitize = $ext[0].'_'.time();
					
					$filename = clsCommon::slugify($imageSanitize);
					
					$extension = $ext[count($ext) - 1];
					$this->docName = $filename.".".$extension;
					$this->docOrgName = $file['OptionValue']['name'];
					move_uploaded_file($file['OptionValue']['tmp_name'],$bannerBackgroundPath.$this->docName);

				}
				else
				{
					$hasError=true;
					$this->getUser()->setFlash('errMsg', "Please provide a valid Image",false);
				}
			}

			if($this->docName != "")
			{
				if($request->isMethod(sfRequest::PUT))
					$oldFile =  $form->getObject()->getOptionValue();
				
				$form->getObject()->setOptionValue($this->docName);
				unset($form["OptionValue"]);
				
				if($request->isMethod(sfRequest::PUT))
				{

					$unlink_media = @unlink($bannerBackgroundPath.$oldFile);
				}
			}
			
			if(!$hasError)
			{
				$bannerBackground = $form->save();
				$this->getUser()->setFlash('succMsg','Update successful.');
				$this->redirect('themebanner/bannerBackground');
            }
    }
  }
}

?>