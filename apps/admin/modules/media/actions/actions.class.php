<?php

/**
 * media actions.
 *
 * @package    counceledge
 * @subpackage media
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mediaActions extends sfActions
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
     * Function to Media Listing
     *
     * @param sfWebRequest $request
     */
    public function executeIndex(sfWebRequest $request)
    {
        /* to get the site url */
        $oSiteConfig = Doctrine::getTable('SiteConfig')->findByConfigKey("SITE_URL");
        $asSiteUrl = $oSiteConfig->toArray();
        $this->ssSiteUrl = $asSiteUrl[0]["ConfigValue"];
        /* End the site url path */
		$this->search_type = "BannerBackground";
        $this->orderBy = "";
        $this->orderType="";
        $where = "";
        $this->mediaPath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.sfConfig::get('app_mediapath'); //GET Media  Path
        $oMedia = new Media();
        $qSearch = $oMedia->mediaListing();

        $this->objSearchForm = new SearchMediaForm();

        if($request->isMethod('post'))
		{
			$mediaType = $request->getParameter($this->objSearchForm->getName());
		}

		if((!empty($mediaType["search_type"])))
		{
			$this->search_type = $mediaType["search_type"];
			$qSearch->andWhere('m.Type = ?', $mediaType["search_type"]);
		}
		elseif($request->getParameter("search_type"))
		{
			$this->search_type = $request->getParameter("search_type");
			$qSearch->andWhere('m.Type = ?', $request->getParameter("search_type"));
		}
		else
		{
			$qSearch->andWhere('m.Type = ?', $this->search_type);
		}

		$this->objSearchForm->setDefault('search_type', $this->search_type );
		
        $this->pager = $qSearch->execute();

    }

    /**
     * Function to Media New
     *
     * @param sfWebRequest $request
     */
    public function executeNew(sfWebRequest $request)
    {
        $this->form = new MediaForm();
    }

    /**
     * Function to Create Media
     *
     * @param sfWebRequest $request
     */
    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new MediaForm();
        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * Function to Edit Media
     *
     * @param sfWebRequest $request
     */
    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($media = Doctrine::getTable('Media')->find(array($request->getParameter('id'))), sprintf('Object media does not exist (%s).', $request->getParameter('id')));
        $this->viewImageName = $media->getImageName();
		$this->viewBannerType = $this->getBannerFullType($media->getType());
        $this->form = new MediaForm($media, array('bannerType'=>$media->getType()));
    }

    /**
     * Function to Update Media
     *
     * @param sfWebRequest $request
     */
    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($media = Doctrine::getTable('Media')->find(array($request->getParameter('id'))), sprintf('Object media does not exist (%s).', $request->getParameter('id')));
        $this->viewImageName = $media->getImageName();
        $this->viewBannerType = $this->getBannerFullType($media->getType());
        $this->form = new MediaForm($media, array('bannerType'=>$media->getType()));

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    /**
     * Function to Media Delete
     *
     * @param sfWebRequest $request
     */
    public function executeDelete(sfWebRequest $request)
    {
        $this->forward404Unless($media = Doctrine::getTable('Media')->find(array($request->getParameter('id'))), sprintf('Object media does not exist (%s).', $request->getParameter('id')));

        $bannetType = $this->getBannerFullType($media->getType());
        $mediaPath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.sfConfig::get('app_mediapath').$bannetType.DIRECTORY_SEPARATOR; //GET Media  Path
        $stockPhotoThumbPath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'stockPhotoThumb'.DIRECTORY_SEPARATOR.$bannetType.DIRECTORY_SEPARATOR;
        if($media->getImageName() != "")
        {
            $unlink_media = @unlink($mediaPath.$media->getImageName());
            $unlink_media = @unlink($stockPhotoThumbPath.$media->getImageName());

        }

        $media->delete();
        $this->getUser()->setFlash('errMsg', "Deletion successful.");

        $this->redirect('media/index?search_type='.$media->getType());
    }

    public function getBannerFullType($bannerType)
    {
		if($bannerType == "BannerBackground")
			return "Banner-Background";
		elseif($bannerType == "BannerForeground")
			return "Banner-Foreground";
		elseif($bannerType == "Unsorted")
			return "Unsorted";
		elseif($bannerType == "Logo")
			return "Logo";
		elseif($bannerType == "BodyBackground")
			return "Body-Background";
    }
    /**
     * Function to Media Process
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     */
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $mediaData = $request->getParameter($form->getName());

        if ($form->isValid())
        {
            $file = $request->getFiles($form->getName()); //GET Media Image
            $fileExtArr = sfConfig::get('app_imageType'); //GET ALLOWED FILE TYPE

            // return the folder name
            $bannerType = $this->getBannerFullType($mediaData["Type"]);
            $mediaPath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.sfConfig::get('app_mediapath').$bannerType.DIRECTORY_SEPARATOR;//GET Media  Path
            $stockPhotoThumbPath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'stockPhotoThumb'.DIRECTORY_SEPARATOR.$bannerType.DIRECTORY_SEPARATOR;

            //IF THE USER UPLOADED THE FILE       // SET DEFAULT HAS ERROR TO FALSE
            $hasError = false;

            if (!empty($file['ImageName']['name']))
            {
                //CHECK THE FILE EXTENSION
                if (in_array($file['ImageName']['type'],$fileExtArr))
                {
                    $ext = explode(".",$file['ImageName']['name']);
                    $imageSanitize = $ext[0].'_'.time(); //MODIFY THE FILE NAME

                    //Sanitize the image name
					$filename = clsCommon::slugify($imageSanitize);
					
                    $extension = $ext[count($ext) - 1];
                    $this->docName = $filename.".".$extension;
                    $this->docOrgName = $file['ImageName']['name'];
                    move_uploaded_file($file['ImageName']['tmp_name'],$mediaPath.$this->docName); // UPLOAD THE FILE TO THE SERVER

                    // THUMB OF STOCK PHOTO
                    $thumbnail_100 = new sfThumbnail(sfConfig::get('app_BannerImage_ThumbHeight'), sfConfig::get('app_BannerImage_ThumbWidth'),true,true,100);
                    $thumbnail_100->loadFile($mediaPath.$this->docName);
                    $thumbnail_100->save($stockPhotoThumbPath.$this->docName);
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
                if($request->isMethod(sfRequest::PUT))
                $oldFile =  $form->getObject()->getImageName();
                // SET NEW FILE NAME
                $form->getObject()->setImageName($this->docName);
                unset($form["ImageName"]);

                if($request->isMethod(sfRequest::PUT))
                {
                    $unlink_media = @unlink($mediaPath.$oldFile);
                    $unlink_media = @unlink($stockPhotoThumbPath.$oldFile);
                }
            }

            if(!$hasError)
            {
				$form->getObject()->setOrgName($this->docOrgName);
                $media = $form->save();

                if($request->isMethod(sfRequest::PUT))
                $this->getUser()->setFlash('succMsg', "Update successful.");
                else
                $this->getUser()->setFlash('succMsg', "New stock photo added successfully.");

                $this->redirect('media/index?search_type='.$media->getType());
            }
        }
    }

    /**
     * Function to Media View
     *
     * @param sfWebRequest $request
     */
    public function executeView(sfWebRequest $request)
    {
        $oMedia = new Media();
        $asRecord = $oMedia->mediaViewQuery($request->getParameter('id'));
        $this->form = $asRecord;
    }

    /**
     * Function to Preview Image
     *
     * @param sfWebRequest $request
     */
    public function executePreviewImage(sfWebRequest $request)
    {
        $snId = $request->getParameter("id");
        $ssMediaData = Doctrine::getTable('Media')->find(array($snId));
        $this->ssImageName = $ssMediaData["ImageName"];
        $this->setLayout(false);
    }
}
