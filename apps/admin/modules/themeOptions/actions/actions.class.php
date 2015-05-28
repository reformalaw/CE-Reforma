<?php

/**
 * themeOptions actions.
 *
 * @package    counceledge
 * @subpackage themeOptions
 * @author     Krunal Nerikar
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class themeOptionsActions extends sfActions
{
    public function executeEdit(sfWebRequest $request)
    {
        $theme_options = Doctrine_Core::getTable('ThemeOptions')->findBy('WebsiteId',$this->getUser()->getAttribute('personalWebsiteId'));
        $featureListArr = UsersWebsiteTable::getThemeFeatureList();
        //clsCommon::pr($featureListArr,1);
        $this->featureListArr = $featureListArr;
        $this->editArr = ThemeOptionsTable::getEditArray($this->getUser()->getAttribute('personalWebsiteId'));
        $this->logoImages = MediaTable::getForegroundImage("Logo");
        $this->bodyBackgroundImages = MediaTable::getForegroundImage("BodyBackground");
        #clsCommon::pr($this->editArr,1);
        /* to get the site url */
        $oSiteConfig = Doctrine::getTable('SiteConfig')->findByConfigKey("SITE_URL");
        $asSiteUrl = $oSiteConfig->toArray();
        $this->ssSiteUrl = $asSiteUrl[0]["ConfigValue"];
        /* End the site url path */

        $this->form = new ThemeOptionsForm(array(),array('featureList'=>$featureListArr));
        if ($featureListArr['ManageSocialMedia'] == "Yes") {
            if (!empty($this->editArr['Facebook']) && isset($this->editArr['Facebook'])) {
                $this->form->setDefault('Facebook',$this->editArr['Facebook']);
            }
            if (!empty($this->editArr['Twitter']) && isset($this->editArr['Twitter'])){
                $this->form->setDefault('Twitter',$this->editArr['Twitter']);
            }
            if (!empty($this->editArr['LinkedIn']) && isset($this->editArr['LinkedIn'])) {
                $this->form->setDefault('LinkedIn',$this->editArr['LinkedIn']);
            }
            if (!empty($this->editArr['Google']) && isset($this->editArr['Google'])) {
                $this->form->setDefault('Google',$this->editArr['Google']);
            }
            if (!empty($this->editArr['Skype']) && isset($this->editArr['Skype'])) {
                $this->form->setDefault('Skype',$this->editArr['Skype']);
            }
            if (!empty($this->editArr['Rss']) && isset($this->editArr['Rss'])) {
                $this->form->setDefault('Rss',$this->editArr['Rss']);
            }
        }
        /*if ($featureListArr['ManageTextWidget'] == "Yes") {
            $widgetLength = ThemeTable::getWidgetLength();
            for ($i=1;$i<($widgetLength+1);$i++)
            {
                if (!empty($this->editArr['TextWidgetsTitle_'.$i]) && isset($this->editArr['TextWidgetsTitle_'.$i])) {
                    $this->form->setDefault('TextWidgetsTitle_'.$i,$this->editArr['TextWidgetsTitle_'.$i]);
                }
                if (!empty($this->editArr['TextWidgets_'.$i]) && isset($this->editArr['TextWidgets_'.$i])) {
                    $this->form->setDefault('TextWidgets_'.$i,$this->editArr['TextWidgets_'.$i]);
                }
            }
        }*/

    }

    /**
     * Function to move picture
     *
     * @param string $ThemeBannerPath
     * @param string $folderName
     * @param string $imageName
     */
	public function pictureMove($logoPath, $folderName, $imageName)
	{
		$sourceImagePath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR."Media".DIRECTORY_SEPARATOR.$folderName.DIRECTORY_SEPARATOR.$imageName;
		copy($sourceImagePath, $logoPath.$imageName);
	}

	/**
     * Function to Edit Records
     *
     * @param sfWebRequest $request
     */
    public function executeEditRecords(sfWebRequest $request)
    {
		$stockPhotoId = '';
		$stockPhotoId = $request->getPostParameter("stockPhotoId");
		$bodyBackgroundPhotoId = $request->getPostParameter("bodyBackgroundPhotoId");

        $theme_options = $_REQUEST['theme_options'];
        //clsCommon::pr($theme_options,1);
        $file = $_FILES['theme_options'];
        //clsCommon::pr($file,1);
        # THIS IS USE FOR BACKGROUND IMAGE UPLOAD
        if (!empty($file['name']['BGImage']) && ($file['name']['BGImage'] != "")) {

            //GET ALLOWED FILE TYPE
            $imageExtArry = sfConfig::get('app_imageType');

            //CHECK WEBSITE FOLDER IS EXIST OR NOT
            $bgImagePath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR."website".DIRECTORY_SEPARATOR.$this->getUser()->getAttribute('personalWebsiteId');

            if (!is_dir($bgImagePath)) {
                mkdir($bgImagePath, 0777, true);
            }

            //CHECK BACK-IMAGE FOLDER IS EXIST OR NOT
            $bgImagePath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR."website".DIRECTORY_SEPARATOR.$this->getUser()->getAttribute('personalWebsiteId').DIRECTORY_SEPARATOR."back-images";
            if (!is_dir($bgImagePath)) {
                mkdir($bgImagePath,0777,true);
            }
            //GET PROFILE IMAGE PATH
            $bgImagePath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR."website".DIRECTORY_SEPARATOR.$this->getUser()->getAttribute('personalWebsiteId').DIRECTORY_SEPARATOR."back-images".DIRECTORY_SEPARATOR;

            //IF THE USER UPLOADED THE FILE
            // SET DEFAULT HAS ERROR TO FALSE
            $hasError = false;

            if (!empty($file['name']['BGImage'])) {
                //CHECK THE FILE EXTENSION
                $imageInfo = getimagesize ($file['tmp_name']['BGImage']);
                if (in_array($imageInfo['mime'],$imageExtArry)) {

                    //MODIFY THE FILE NAME
                    $filename = $this->getUser()->getAttribute('personalWebsiteId')."BG_".time();
                    $ext = explode(".",$file['name']['BGImage']);

                    // GET FILE EXTENSION
                    $extension = $ext[count($ext) - 1];
                    $this->imageName = $filename.".".$extension;


                    //UPLOAD THE FILE TO THE SERVER
                    move_uploaded_file($file['tmp_name']['BGImage'],$bgImagePath.$this->imageName);

                }else{
                    // IF NOT VALID EXTENSION
                    //SET HAS ERROR TRUE
                    $hasError=true;
                    $this->flashMessage['error']="Please provide a valid new logo.";
                    $this->getUser()->setFlash('errMsg', "Please provide a valid new logo.");
                    //$this->setTemplate('themeOptions/edit');
                }
            }

            //IF PROFILE PIC IS UPLOADED
            if($this->imageName != ""){
                // GET OLD FILE NAME
                $old_file =  ThemeOptionsTable::getOldBGfileName($this->getUser()->getAttribute('personalWebsiteId'));

                // SET NEW FILE NAME
                ThemeOptionsTable::updatefileName($this->getUser()->getAttribute('personalWebsiteId'),$this->imageName);

                // REMOVE OLD ORIGINAL FILE
                $unlink_profilepic = @unlink($bgImagePath.$old_file);
                // REMOVE OLD 100X100 Size FILE
                @unlink($bgImagePath.DIRECTORY_SEPARATOR.$old_file);
                //$theme_options = $objThemeEntry->save();
            }
            if(!$hasError){
                ThemeOptionsTable::updatefileName($this->imageName);
            }
        }
        # END OF BACKGROUND IMAGE UPLOAD

        //CHECK WEBSITE FOLDER IS EXIST OR NOT
            $logoImagePath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR."website".DIRECTORY_SEPARATOR.$this->getUser()->getAttribute('personalWebsiteId');

            if (!is_dir($logoImagePath)) {
                mkdir($logoImagePath, 0777, true);
            }

            //CHECK logo FOLDER IS EXIST OR NOT
            $logoImagePath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR."website".DIRECTORY_SEPARATOR.$this->getUser()->getAttribute('personalWebsiteId').DIRECTORY_SEPARATOR."logo";
            if (!is_dir($logoImagePath)) {

                mkdir($logoImagePath,0777,true);
            }
            //GET logo IMAGE PATH
            $logoImagePath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR."website".DIRECTORY_SEPARATOR.$this->getUser()->getAttribute('personalWebsiteId').DIRECTORY_SEPARATOR."logo".DIRECTORY_SEPARATOR;

			if($stockPhotoId != '')
			{
				
				$typaAndId = explode("_", $stockPhotoId);
				
				$objectMedia = Doctrine::getTable('Media')->find(array($typaAndId[1]));
				$imageName = $objectMedia->getImageName();
				
				/*move the image */
				if($typaAndId[0] == "Logo"):
					$this->pictureMove($logoImagePath, "Logo", $imageName);
				endif;

				$oldFile =  ThemeOptionsTable::getOldLogofileName($this->getUser()->getAttribute('personalWebsiteId'));
                ThemeOptionsTable::updateLogofileName($imageName);
				$unlink_media = @unlink($logoImagePath.$oldFile);
			}

        if (!empty($file['name']['Logo']) && ($file['name']['Logo'] != "")) {

            //GET ALLOWED FILE TYPE
            $imageExtArry = sfConfig::get('app_imageType');

            //IF THE USER UPLOADED THE FILE
            // SET DEFAULT HAS ERROR TO FALSE
            $hasError = false;

            if (!empty($file['name']['Logo'])) {
                //CHECK THE FILE EXTENSION
                $imageInfo = getimagesize ($file['tmp_name']['Logo']);
                if (in_array($imageInfo['mime'],$imageExtArry)) {

                    //MODIFY THE FILE NAME
                    $filename = $this->getUser()->getAttribute('personalWebsiteId')."L_".time();
                    $ext = explode(".",$file['name']['Logo']);

                    // GET FILE EXTENSION
                    $extension = $ext[count($ext) - 1];
                    $this->imageName = $filename.".".$extension;

                    //UPLOAD THE FILE TO THE SERVER
                    move_uploaded_file($file['tmp_name']['Logo'],$logoImagePath.$this->imageName);

                }else{
                    // IF NOT VALID EXTENSION
                    //SET HAS ERROR TRUE
                    $hasError=true;
                    $this->flashMessage['error']="Please provide a valid News Logo.";
                    $this->getUser()->setFlash('errMsg', "Please provide a valid News Logo");
                    //$this->setTemplate('themeOptions/edit');
                }
            }

            //IF PROFILE PIC IS UPLOADED
            if($this->imageName != ""){
                // GET OLD FILE NAME
                $old_file =  ThemeOptionsTable::getOldLogofileName($this->getUser()->getAttribute('personalWebsiteId'));

                // SET NEW FILE NAME
                ThemeOptionsTable::updateLogofileName($this->imageName);//$this->getUser()->getAttribute('personalWebsiteId'),

                // REMOVE OLD ORIGINAL FILE
                $unlink_profilepic = @unlink($logoImagePath.$old_file);
                // REMOVE OLD 100X100 Size FILE
                @unlink($logoImagePath.DIRECTORY_SEPARATOR.$old_file);
                //$theme_options = $objThemeEntry->save();
            }
            if(!$hasError){
                ThemeOptionsTable::updateLogofileName($this->imageName);
            }
        }
        # END OF LOGO UPLOAD
        $this->bodyBackgroundUpload($bodyBackgroundPhotoId, $file);
        
        #START OF UPDATE DATA.
        $recordUpdated = ThemeOptionsTable::updateRecord($theme_options);
        $this->getUser()->setFlash('succMsg', "Update successful.");
        $this->redirect('themeOptions/edit');
    }

    public function bodyBackgroundUpload($bodyBackgroundPhotoId, $file)
    {
		//CHECK body background FOLDER IS EXIST OR NOT
		$bodyBackgroundImagePath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR."website".DIRECTORY_SEPARATOR.$this->getUser()->getAttribute('personalWebsiteId').DIRECTORY_SEPARATOR."body-background";
		if (!is_dir($bodyBackgroundImagePath)) {

			mkdir($bodyBackgroundImagePath,0777,true);
		}

		$bodyBackgroundImagePath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR."website".DIRECTORY_SEPARATOR.$this->getUser()->getAttribute('personalWebsiteId').DIRECTORY_SEPARATOR."body-background".DIRECTORY_SEPARATOR;

		if($bodyBackgroundPhotoId != '')
		{
			
			$typaAndId = explode("_", $bodyBackgroundPhotoId);
			
			$objectMedia = Doctrine::getTable('Media')->find(array($typaAndId[1]));
			$imageName = $objectMedia->getImageName();
			
			/*move the image */
			if($typaAndId[0] == "BodyBackground"):
				$this->pictureMove($bodyBackgroundImagePath, "Body-Background", $imageName);
			endif;

			$oldFile =  ThemeOptionsTable::getOldBodyBackgroundfileName($this->getUser()->getAttribute('personalWebsiteId'));
			ThemeOptionsTable::updateBodyBackgroundfileName($imageName);
			$unlink_media = @unlink($bodyBackgroundImagePath.$oldFile);
		}
		
		if (!empty($file['name']['BodyBackground']) && ($file['name']['BodyBackground'] != "")) {

            $imageExtArry = sfConfig::get('app_imageType');
            $hasError = false;

            if (!empty($file['name']['BodyBackground'])) {
                $imageInfo = getimagesize ($file['tmp_name']['BodyBackground']);
                if (in_array($imageInfo['mime'],$imageExtArry)) {

                    $filename = $this->getUser()->getAttribute('personalWebsiteId')."B_".time();
                    $ext = explode(".",$file['name']['BodyBackground']);

                    $extension = $ext[count($ext) - 1];
                    $this->imageName = $filename.".".$extension;

                    move_uploaded_file($file['tmp_name']['BodyBackground'],$bodyBackgroundImagePath.$this->imageName);

                }else{
                    $hasError=true;
                    $this->flashMessage['error']="Please provide a valid Body Background.";
                    $this->getUser()->setFlash('errMsg', "Please provide a valid  Body Background");
                }
            }

            if($this->imageName != ""){
                $old_file =  ThemeOptionsTable::getOldBodyBackgroundfileName($this->getUser()->getAttribute('personalWebsiteId'));

                ThemeOptionsTable::updateBodyBackgroundfileName($this->imageName);

                $unlink_profilepic = @unlink($bodyBackgroundImagePath.$old_file);
                @unlink($bodyBackgroundImagePath.DIRECTORY_SEPARATOR.$old_file);
            }
            if(!$hasError){
                ThemeOptionsTable::updateBodyBackgroundfileName($this->imageName);
            }
        }
    }
	/**
     * Function to Update Text Widget
     *
     * @param sfWebRequest $request
     */
    public function executeEditTextWidgets(sfWebRequest $request)
    {
		$theme_options = Doctrine_Core::getTable('ThemeOptions')->findBy('WebsiteId',$this->getUser()->getAttribute('personalWebsiteId'));
		$featureListArr = UsersWebsiteTable::getThemeFeatureList();
        $this->featureListArr = $featureListArr;
        $this->editArr = ThemeOptionsTable::getEditArray($this->getUser()->getAttribute('personalWebsiteId'));
        $this->form = new ThemeTextWidgetForm(array(),array('featureList'=>$featureListArr,'webId'=>$this->getUser()->getAttribute('personalWebsiteId')));

        if ($featureListArr['ManageTextWidget'] == "Yes") {
            $widgetLength = ThemeTable::getWidgetLength();
            for ($i=1;$i<($widgetLength+1);$i++)
            {
                if (!empty($this->editArr['TextWidgetsTitle_'.$i]) && isset($this->editArr['TextWidgetsTitle_'.$i])) {
                    $this->form->setDefault('TextWidgetsTitle_'.$i,$this->editArr['TextWidgetsTitle_'.$i]);
                }
                if (!empty($this->editArr['TextWidgets_'.$i]) && isset($this->editArr['TextWidgets_'.$i])) {
                    $this->form->setDefault('TextWidgets_'.$i,$this->editArr['TextWidgets_'.$i]);
                }
            }
        }
    }

    /**
     * Function to Update Record
     *
     * @param sfWebRequest $request
     */
    public function executeProcessForm(sfWebRequest $request)
    {
		$theme_options = $_REQUEST['theme_text_widget'];

		$recordUpdated = ThemeOptionsTable::updateTextWidget($theme_options);
        $this->getUser()->setFlash('succMsg', "Update successful.");
        $this->redirect('themeOptions/editTextWidgets');
    }
}