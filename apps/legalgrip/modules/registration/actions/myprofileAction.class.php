<?php

/**
* myprofile Action
*
* @package    legalrgrip
*/
class myprofileAction extends sfActions
{
	/**
	 * Function to update profile
	 *
	 * @param sfWebRequest $request
	 */
	public function executeMyprofile(sfWebRequest $request)
	{
		$this->snId = $this->getUser()->getAttribute('user_user_id');     // get log in user id
		$this->forward404Unless($users = Doctrine::getTable('Users')->find(array($this->snId)), sprintf('Object users does not exist (%s).', $this->snId));
		$this->ssEmail = $users->getEmail();
		$this->ssUsername = $users->getUsername();
		$this->viewImageName = $users->getProfilePic();

		$this->form = new LGMyProfileForm($users);        //form object

		if($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT))
		{
			$this->processForm($request, $this->form);              // Call processform()
		}
	}

	/**
	 * Function to update profile process
	 *
	 * @param sfWebRequest $request
	 * @param sfForm       $form
	 */
	protected function processForm(sfWebRequest $request, sfForm $form)
	{
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		$user = $request->getParameter($form->getName());

		$ssUserEnterOldPassword = $request->getPostParameter('lgmyprofile[Password]');

		$ssOldUserPassword = $form->getObject()->getPassword(); 
		$objPassEncDec = new encryptDecrypt(sfConfig::get('app_pwdEncDecKey'));          // encryption class call
		$Password = $objPassEncDec->decrypt($ssOldUserPassword);                         // decrypt the database password

		$ssNewPassword = $request->getPostParameter('lgmyprofile[New_Password]');          // New password 
		$ssConfirmPassword = $request->getPostParameter('lgmyprofile[Confirm_Password]');  // Confirm Password

		if ($form->isValid())
		{
			$file = $request->getFiles($form->getName());
			$fileExtArr = sfConfig::get('app_imageType');
			$profilepicPath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR."userpic".DIRECTORY_SEPARATOR;
			clsCommon::createFolders($profilepicPath,$form->getObject()->getId());
			$profilepicPath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR."userpic".DIRECTORY_SEPARATOR.$form->getObject()->getId().DIRECTORY_SEPARATOR;
			//$profilepicThumbPath = $profilepicPath.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

			$hasError = false;

			if (!empty($file['ProfilePic']['name']))
			{
				if (in_array($file['ProfilePic']['type'],$fileExtArr))
				{
					$ext = explode(".",$file['ProfilePic']['name']);
					$filename = $ext[0].'_'.time();
					
					$extension = $ext[count($ext) - 1];
					$this->docName = $filename.".".$extension;

					// file name with diffrent extention
					$this->org_docName = sfConfig::get("app_Prefix_Org").$this->docName;
					$this->small_docName = sfConfig::get("app_Prefix_Small").$this->docName;
					$this->large_docName = sfConfig::get("app_Prefix_Large").$this->docName;
					$this->mediam_docName = sfConfig::get("app_Prefix_Medium").$this->docName;
					$this->thumb_docName = sfConfig::get("app_Prefix_Thumb").$this->docName;

					//Original Image Upload
					$this->docOrgName = $file['ProfilePic']['name'];
					move_uploaded_file($file['ProfilePic']['tmp_name'],$profilepicPath.$this->org_docName);

					//Small Image Uplaod
                    $smallThumbnail = new sfThumbnail(sfConfig::get('app_Image_SmallHeight'), sfConfig::get('app_Image_SmallWidth'),true,true,100);
                    $smallThumbnail->loadFile($profilepicPath.$this->org_docName);
                    $smallThumbnail->save($profilepicPath.$this->small_docName);

                    //Mediam Image Uplaod
                    $mediamThumbnail = new sfThumbnail(sfConfig::get('app_Image_MediamHeight'), sfConfig::get('app_Image_MediamWidth'),true,true,100);
                    $mediamThumbnail->loadFile($profilepicPath.$this->org_docName);
                    $mediamThumbnail->save($profilepicPath.$this->mediam_docName);

                    //Large Image Uplaod
                    $largeThumbnail = new sfThumbnail(sfConfig::get('app_Image_LargeHeight'), sfConfig::get('app_Image_LargeWidth'),true,true,100);
                    $largeThumbnail->loadFile($profilepicPath.$this->org_docName);
                    $largeThumbnail->save($profilepicPath.$this->large_docName);

					//Thumbnail Image Uplaod
                    $thumbnail = new sfThumbnail(sfConfig::get('app_Image_ThumbHeight'), sfConfig::get('app_Image_ThumbWidth'),true,true,100);
                    $thumbnail->loadFile($profilepicPath.$this->org_docName);
                    $thumbnail->save($profilepicPath.$this->thumb_docName);
				}
				else
				{
					$hasError=true;
					$this->getUser()->setFlash('errMsg', "Please provide a valid Image");
				}
			}

			if($this->docName != "")
			{
				if($request->isMethod(sfRequest::PUT))
					$oldFile =  $form->getObject()->getProfilePic();
				
				$form->getObject()->setProfilePic($this->docName);
				unset($form["ProfilePic"]);
				
				if($request->isMethod(sfRequest::PUT))
				{
					$unlink_media = @unlink($profilepicPath.sfConfig::get("app_Prefix_Org").$oldFile);
					$unlink_media = @unlink($profilepicPath.sfConfig::get("app_Prefix_Thumb").$oldFile);
					$unlink_media = @unlink($profilepicPath.sfConfig::get("app_Prefix_Small").$oldFile);
					$unlink_media = @unlink($profilepicPath.sfConfig::get("app_Prefix_Large").$oldFile);
					$unlink_media = @unlink($profilepicPath.sfConfig::get("app_Prefix_Medium").$oldFile);
				}
			}

			if(!$hasError)
			{
				if(empty($ssUserEnterOldPassword) && (!empty($ssNewPassword) || !empty($ssConfirmPassword)))
				{
					$this->getUser()->setFlash('errMsg','Enter Current Password');
					return sfView::ERROR;
				}
				elseif(!empty($ssUserEnterOldPassword))      // if current password not empty
				{
					if(empty($ssNewPassword) || empty($ssConfirmPassword))
					{
						$this->getUser()->setFlash('errMsg','Enter New and Confirm Password');
						return sfView::ERROR;
					}
					else
					{
						if($ssNewPassword != $ssConfirmPassword)     // check New & Confirm Password match or not
						{
							$this->getUser()->setFlash('errMsg','New and Confirm Password not match');
							return sfView::ERROR;    
						}
						elseif($ssNewPassword == $ssConfirmPassword)
						{
							if($ssUserEnterOldPassword == $Password)
							{
								unset($form['Password']);                         // unset the password due to change the new password 
								$form->getObject()->setPassword($ssNewPassword);  // set New password
							}
							else
							{
								$this->getUser()->setFlash('errMsg','Current Password is wrong');
								return sfView::ERROR;
							}
						}
					}
				}
				$users = $form->save();   // save the profile records
				$this->getUser()->setFlash('succMsg','Your Profile Updated Successfully');
				$this->redirect('registration/myprofile');
			}
		}
	}
}
?>