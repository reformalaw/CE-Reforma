<?php

/**
 * staticpages actions.
 *
 * @package    counceledge
 * @subpackage staticpages
 * @author     Krunal Nerikar
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class staticpagesActions extends sfActions
{
	/**
     * Function to list of counceledge pages
     *
     * @param sfWebRequest $request
     */
    public function executeIndex(sfWebRequest $request)
    {
        $this->orderBy = "";
        $this->orderType="";
        $where = "";

        $qSearch = Doctrine_Query::create();
        $qSearch->from('CMSPages cm')
        ->where('cm.WebsiteId = ?',1);

        $pager = new sfDoctrinePager('CMSPages', sfConfig::get(20));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;
    }
    
    /**
     * Function to add new cms pages
     *
     * @param string $temp
     * @return array
     */
    public function websiteUrlStaticPage($temp)
    {
		if($temp == "LG")
			return  UsersWebsite::getWebsiteUrlStaticPage(2);
		elseif($temp == "CE")
			return  UsersWebsite::getWebsiteUrlStaticPage(1);
    }

    /**
     * Function to add new cms pages
     *
     * @param sfWebRequest $request
     */
    public function executeNew(sfWebRequest $request)
    {
		if($request->hasParameter('temp'))
			$this->temp = $request->getParameter('temp');

		//$this->websitedetail = UsersWebsite::getUsersWebsiteId($this->getUser()->getAttribute('admin_user_id'));
		//above line commented by 

		// START code added by jaydip
		$this->websitedetail = $this->websiteUrlStaticPage($this->temp);
		// END code added by jaydip
		
		$this->cmspage = '';
		$this->displaySlugValue  = '';
        $this->form = new CMSPagesForm();
    }

    /**
     * Function to create cms pages
     *
     * @param sfWebRequest $request
     */
    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
		$this->temp = $request->getPostParameter('temp');
		$this->cmspage = '';
		//$this->websitedetail = UsersWebsite::getUsersWebsiteId($this->getUser()->getAttribute('admin_user_id'));
		//above line commented by jaydip

		// START code added by jaydip
		$this->websitedetail = $this->websiteUrlStaticPage($this->temp);
		// END code added by jaydip

        $this->form = new CMSPagesForm();

        $this->displaySlugValue  = $request->getPostParameter('cmspages[Newslug]');
        $this->processForm($request, $this->form, $this->temp);

        $this->setTemplate('new');
    }

    /**
     * Function to edit cms pages
     *
     * @param sfWebRequest $request
     */
    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($cms_pages = Doctrine::getTable('CMSPages')->find(array($request->getParameter('id'))), sprintf('Object cms_pages does not exist (%s).', $request->getParameter('id')));
        $this->cmspage = $cms_pages->getSlug();
        $this->form = new CMSPagesForm($cms_pages,array('edit'=>true,'id'=>$cms_pages->getId(),'UniqueKey'=>$cms_pages->getUniqueKey()));
        //$this->websitedetail = UsersWebsite::getUsersWebsiteId($this->getUser()->getAttribute('admin_user_id'));  
		//above line commented by jaydip dodiya

        // START code added by jaydip
        if($request->hasParameter('temp'))
			$this->temp = $request->getParameter('temp');

        $this->websitedetail = $this->websiteUrlStaticPage($this->temp);
		// END code added by jaydip
	
        $this->displaySlugValue  = $cms_pages->getSlug();
        $this->type = $cms_pages->getType();
        $temp = explode('_',$cms_pages->getUniqueKey());
        $this->form->setDefault('UniqueKey', $temp[1]);
    }

    /**
     * Function to update cms pages
     *
     * @param sfWebRequest $request
     */
    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($cms_pages = Doctrine::getTable('CMSPages')->find(array($request->getParameter('id'))), sprintf('Object cms_pages does not exist (%s).', $request->getParameter('id')));
        $this->cmspage = $cms_pages->getSlug();
        $this->form = new CMSPagesForm($cms_pages,array('edit'=>true));

        // START code added by jaydip
        $this->temp = $request->getPostParameter('temp');
		$this->websitedetail = $this->websiteUrlStaticPage($this->temp);
		// END code added by jaydip
		
		$this->type = $cms_pages->getType();
		//$this->websitedetail = UsersWebsite::getUsersWebsiteId($this->getUser()->getAttribute('admin_user_id')); line commented by jaydip
        $this->displaySlugValue  = $request->getPostParameter('cmspages[Newslug]');
        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    /**
     * Function to delete cms pages
     *
     * @param sfWebRequest $request
     */
    public function executeDelete(sfWebRequest $request)
    {
        //$request->checkCSRFProtection();

        $this->forward404Unless($cms_pages = Doctrine::getTable('CMSPages')->find(array($request->getParameter('id'))), sprintf('Object cms_pages does not exist (%s).', $request->getParameter('id')));
        $cms_pages->delete();

		$this->getUser()->setFlash('succMsg', "Deletion successful.");
		if($request->hasParameter('temp'))
			if($request->getParameter('temp') == "CE")
				$this->redirect('staticpages/index');
			elseif($request->getParameter('temp') == "LG")
				$this->redirect('staticpages/lgList');

		$this->redirect('staticpages/index');
    }

    /**
     * Function to process form
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     * @param string $temp
     */
    protected function processForm(sfWebRequest $request, sfForm $form, $temp='')
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $cms = $request->getParameter($form->getName());

        if ($form->isValid())
        {
            $uniqueKey = 0;
            if ($request->isMethod(sfRequest::PUT)) {
                $uniqueKey = CMSPagesTable::uniqueKeyCheck($request->getParameter('id'),$tempKey);
            }
            if($uniqueKey == 0) {
                if ($request->isMethod(sfRequest::PUT)) {
                    unset($form['UniqueKey']);
                    if ($request->getParameter('temp') == "CE") {
                        $form->getObject()->setWebsiteId(1);
                    }elseif ($request->getParameter('temp') == "LG") {
                        $form->getObject()->setWebsiteId(2);
                    }

					$form->getObject()->setSlug($cms['Newslug']);
                    $cms_pages = $form->save();

                }else{
					
					if ($temp == "CE")
						$form->getObject()->setWebsiteId(1);
					elseif ($temp == "LG")
						$form->getObject()->setWebsiteId(2);

					$form->getObject()->setSlug($cms['Newslug']);
					$form->getObject()->setStatus("Active");
                    $cms_pages = $form->save();

                    if ($temp == "CE")
						$form->getObject()->setUniqueKey("1"."_".$cms_pages->getSlug());
					elseif ($temp == "LG")
						$form->getObject()->setUniqueKey("2"."_".$cms_pages->getSlug());

					$cms_pages = $form->save();
                }
            }else {
                $this->getUser()->setFlash('errMsg', "Unique Key already in use, please try again. ");
                $this->redirect('staticpages/edit?id='.$request->getParameter('id'));
            }

            if($request->isMethod(sfRequest::PUT))
            {
				$this->getUser()->setFlash('succMsg', "Update successful.");
				if ($request->getParameter('temp') == "CE")
				{
					$this->redirect('staticpages/index');
				}
				elseif ($request->getParameter('temp') == "LG")
				{
					$this->redirect('staticpages/lgList');
				}
			}
            else
            {
				$this->getUser()->setFlash('succMsg', "New CMS page added successfully.");
				if ($temp == "CE")
					$this->redirect('staticpages/index');
				elseif ($temp == "LG")
					$this->redirect('staticpages/lgList');
				
			}

        }
    }

    /**
     * Function to listing of lg
     *
     * @param sfWebRequest $request
     */
    public function executeLgList(sfWebRequest $request)
    {
        $this->orderBy = "";
        $this->orderType="";
        $where = "";

        $qSearch = Doctrine_Query::create();
        $qSearch->from('CMSPages cm')
        ->where('cm.WebsiteId = ?',2);

        $pager = new sfDoctrinePager('CMSPages', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;
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
		$temp = $request->getParameter('temp');
		
		if($temp == "CE")
			$websiteId = 1;
		elseif($temp == "LG")
			$websiteId = 2;

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
}
