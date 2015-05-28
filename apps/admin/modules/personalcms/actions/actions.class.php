<?php

/**
 * personalcms actions.
 *
 * @package    counceledge
 * @subpackage personalcms
 * @author     Krunal Nerikar
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class personalcmsActions extends sfActions
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
    public function executeIndex(sfWebRequest $request)
    {
        $this->orderBy = "";
        $this->orderType="";
        $where = "";

        # THE ABOVE CODE IS TEMPARORY PLEASE REMOVE IT AND SET THE SESSION WEBSITE ID IN
        # PALACE OF $SESSION_WEBSITEID
        #$Session_websiteId = 3;
        $Session_websiteId = $this->getUser()->getAttribute('personalWebsiteId');
        $qSearch = Doctrine_Query::create();
        $qSearch->from('CMSPages cm')
        ->where('cm.WebsiteId = ?',$Session_websiteId)
        ->andWhere('cm.Status != ?',sfConfig::get('app_Status_Deleted'))
        ->whereNotIn('cm.Slug', array('faq','contact'));


        /*if($request->getParameter('search_text'))
        $where .="cm.name LIKE '%".$request->getParameter('search_text')."%'";

        $qSearch->where($where);

        switch($request->getParameter('orderBy'))
        {
        case "id":
        $orderBy = 'cm.Id';
        $this->orderBy = "id";
        break;
        case "name":
        default:
        $orderBy = 'cm.Name';
        $this->orderBy = "name";
        break;

        }

        switch($request->getParameter('orderType'))
        {
        case "desc":
        $qSearch->orderBy("$orderBy DESC");
        $this->orderType = "desc";
        break;
        case "asc":
        default:
        $qSearch->orderBy("$orderBy ASC");
        $this->orderType = "asc";
        break;
        }
        */

        $pager = new sfDoctrinePager('CMSPages', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;
    }
    public function executeNew(sfWebRequest $request)
    {
        $this->form = new PersonalCMSPagesForm();
        $this->websitedetail = UsersWebsite::getUsersWebsiteId($this->getUser()->getAttribute('admin_user_id'));
        $this->displaySlugValue  = '';
        $this->cmspage = '';
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new PersonalCMSPagesForm();
        $this->websitedetail = UsersWebsite::getUsersWebsiteId($this->getUser()->getAttribute('admin_user_id'));
        $this->displaySlugValue  = $_POST['personalcms']['Newslug'];
        $this->cmspage = '';
        $redirectFlag = $request->getPostParameter('submit');
        $this->processForm($request, $this->form, $redirectFlag);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
		if(clsCommon::chkDataExist("CMSPages", $request->getParameter('id'), $this->getUser()->getAttribute('personalWebsiteId')))
		{
			$this->forward404Unless($cms_pages = Doctrine::getTable('CMSPages')->find(array($request->getParameter('id'))), sprintf('Object CMS Pages does not exist (%s).', $request->getParameter('id')));
			$this->cmspage = $cms_pages->getSlug();
			$this->form = new PersonalCMSPagesForm($cms_pages,array('home'=>$cms_pages->getSlug(),'Id'=>$request->getParameter('id')));
			$this->websitedetail = UsersWebsite::getUsersWebsiteId($this->getUser()->getAttribute('admin_user_id'));
			$this->displaySlugValue  = $cms_pages->getSlug();
        }
        else
        {
			$this->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
			$this->redirect('default/index');
		}
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($cms_pages = Doctrine::getTable('CMSPages')->find(array($request->getParameter('id'))), sprintf('Object CMS Pages does not exist (%s).', $request->getParameter('id')));
        $this->cmspage = $cms_pages->getSlug();
        $this->form = new PersonalCMSPagesForm($cms_pages,array('home'=>$cms_pages->getSlug(),'Id'=>$request->getParameter('id')));
        $this->websitedetail = UsersWebsite::getUsersWebsiteId($this->getUser()->getAttribute('admin_user_id'));

        $this->displaySlugValue  = $_POST['personalcms']['Newslug'];
        $redirectFlag = $request->getPostParameter('submit');
        $this->processForm($request, $this->form, $redirectFlag);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        //$request->checkCSRFProtection();
		if(clsCommon::chkDataExist("CMSPages", $request->getParameter('id'), $this->getUser()->getAttribute('personalWebsiteId')))
		{
			$oCMSPages = new CMSPages();
			$oCMSPages->deletePersonalCmsPage($request->getParameter('id'), $this->getUser()->getAttribute('personalWebsiteId'));

// 			this 3 line commented by jaydip dodiya -> you can not delete other users data so commented
	//         $this->forward404Unless($cms_pages = Doctrine::getTable('CMSPages')->find(array($request->getParameter('id'))), sprintf('Object CMS Pages does not exist (%s).', $request->getParameter('id')));
	//         $cms_pages->setStatus(sfConfig::get('app_Status_Deleted'));
	//         $cms_pages->save();

			
			$this->getUser()->setFlash("errMsg",'Deletion successful.');
			$this->redirect('personalcms/index');
		}
		else
		{
			$this->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
			$this->redirect('default/index');
		}
    }

    protected function processForm(sfWebRequest $request, sfForm $form, $redirectFlag="")
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $perCms = $request->getParameter($form->getName());
        #clsCommon::pr($perCms);
        if ($form->isValid())
        {
            #$temp = 3;

            $temp = $this->getUser()->getAttribute('personalWebsiteId');
            /**
             *  HERE $TEMP IS USE IN PLACE OF PERSONAL WEBSITE ID SESSION.
             *  IT WILL BE REPLACE AFTER  "$this->getUser()->getAttribute('personalWebsiteId')"
             */
            if(!$request->isMethod(sfRequest::PUT)){
                $form->getObject()->setWebsiteId($temp);
            }

            unset($form['Template']);
            unset($form['Status']);
            $form->getObject()->setStatus($perCms['Status']);
            $form->getObject()->setTemplate($perCms['Template']);

            $form->getObject()->setSlug($perCms['Newslug']);
            $cms_pages = $form->save();
            $form->getObject()->setUniqueKey($temp."_".$cms_pages->getSlug());
            $cms_pages = $form->save();

            if($request->isMethod(sfRequest::PUT))
            $this->getUser()->setFlash('succMsg', "Update successful.");
            else
            $this->getUser()->setFlash('succMsg', "New CMS pages added successfully.");

            if($request->isMethod(sfRequest::PUT)){
				if($redirectFlag == "Save"):
					$this->redirect('personalcms/edit?id='.$cms_pages->getId());
				elseif($redirectFlag == "Save And Quit"):
					$this->redirect('personalcms/index');
				elseif($redirectFlag == "Save And Preview"):
					$this->redirect('personalcms/edit?id='.$cms_pages->getId().'&flagPreview=1');
				else:
					$this->redirect('personalcms/index');
				endif;
            }
            else
            {
				if($redirectFlag == "Save"):
					$this->redirect('personalcms/edit?id='.$cms_pages->getId());
				elseif($redirectFlag == "Save And Quit"):
					$this->redirect('personalcms/index');
				elseif($redirectFlag == "Save And Preview"):
					$this->redirect('personalcms/edit?id='.$cms_pages->getId().'&flagPreview=1');
				else:
					$this->redirect('personalcms/index');
				endif;
				
			}
			$this->redirect('personalcms/index');
            //$this->redirect('personalcms/edit?id='.$cms_pages->getId());
        }
    }

    /**
     * Function to Generate Slug Field based on Page Title
     *
     * @param sfWebRequest $request
     * @return Sluggable Value
     */

    public function executeGetPageSlug(sfWebRequest $request)
    {
        $title =  $request->getParameter('title');
        $act =  $request->getParameter('act');
        $id=  $request->getParameter('id');

        $websiteId = $this->getUser()->getAttribute('personalWebsiteId');
        $slugTitle = clsCommon::slugify($title);

        // Check if Slug is reserved for Website, creted for Routing issues
        $reservedSlugForPageAndPracticeArea = sfConfig::get('app_ReservedSlugForPageAndPracticeArea_keywords') ;
        if(in_array($slugTitle, $reservedSlugForPageAndPracticeArea)) {
            $slugTitle = $slugTitle.'1';
        }

        $checkSlug = CMSPagesTable::checkSlugExist($websiteId, $slugTitle, $act, $id);
        if (count($checkSlug)>0) {
            $slugTitle = $checkSlug[0]['Slug'].'-'.count($checkSlug);
            return $this->renderText("$slugTitle");
        }else {
            return $this->renderText("$slugTitle");
        }
    }

    public function executeChangeStatus(sfWebRequest $request)
    {
		if(clsCommon::chkDataExist("CMSPages", $request->getParameter('id'), $this->getUser()->getAttribute('personalWebsiteId')))
		{
			$this->forward404Unless($users = Doctrine::getTable('CMSPages')->find(array($request->getParameter('id'))), sprintf('CMS Page not found!'));
			$status = $request->getParameter('status');
			// Do not allow to change status of current user
			if (in_array($status,array('Active','Inactive'))){
				PracticeAreasTable::changeChildStatus($users['Id'],$status);
				$users->setStatus($status);
				$users->setUpdateDateTime(date("Y-m-d H:i:s"));
				$users->save();
				$arrParams = array();

				if($status=="Active"){
					$this->getUser()->setFlash("succMsg",'Status successfully changed to active.');
					$arrParams['Status'] = 'Active';
				}else{
					$this->getUser()->setFlash("errMsg",'Status successfully changed to inactive.');
					$arrParams['Status'] = 'Inactive';
				}
			}
			$this->redirect('personalcms/index');
        }
        else
		{
			$this->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
			$this->redirect('default/index');
		}
    }
}