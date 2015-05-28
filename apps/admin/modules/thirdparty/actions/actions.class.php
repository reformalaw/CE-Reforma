<?php

/**
 * thirdparty actions.
 *
 * @package    counceledge
 * @subpackage thirdparty
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class thirdpartyActions extends sfActions
{
    /**
    * HERE IN THIS FUNCTION WE ARE CHECKING THAT USER IS NOT ADMIN AND PERMISSION CHECK IS FALSE
    * THE REDIRECT TO THE NOT AUTHENTICATED PAGE.
    */
    public function preExecute()
    {
        /*$permissions= array('create','update');
        if($this->getRequest()->isXmlHttpRequest() || in_array($this->getActionName(),$permissions)){
                return true;
         }*/

         if (clsCommon::permissionCheck($this->getModuleName()."/".$this->getActionName()) == false ){
            $this->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
            $this->redirect('default/index');
        }
        
    }
    /* Action for listing the record of 3rd Partiess */
    public function executeIndex(sfWebRequest $request)
    {
        $this->orderBy = "";
        $this->orderType="";
        $where = "";

        $qSearch = Doctrine_Query::create();
        $qSearch->from('ThirdParties th');
        $qSearch->Where('th.status <> ?','Deleted');

        /*if($request->getParameter('search_text'))
        $where .="th.name LIKE '%".$request->getParameter('search_text')."%'";

        $qSearch->where($where);*/
        switch($request->getParameter('orderBy'))
        {
            case "id":
                $orderBy = 'th.Id';
                $this->orderBy = "id";
                break;
            case "City":
                $orderBy = 'th.City';
                $this->orderBy = "City";
                break;
            case "StateId":
                $orderBy = 'th.StateId';
                $this->orderBy = "StateId";
                break;
            case "CountyId":
                $orderBy = 'th.CountyId';
                $this->orderBy = "CountyId";
                break;
            case "Name":
                $orderBy = 'th.Name';
                $this->orderBy = "Name";
                break;
            default:
                $orderBy = 'th.name';
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



        $pager = new sfDoctrinePager('ThirdParties', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;
    }

    /* Action for adding new 3rd Party */
    public function executeNew(sfWebRequest $request)
    {
        $this->form = new ThirdPartiesForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $snStateId = $request->getPostParameter('third_parties[StateId]');

        $this->form = new ThirdPartiesForm(array(),array('State'=>$snStateId));
        $this->processForm($request, $this->form);
        $this->setTemplate('new');
    }

    /* Action for the Editing 3rd Party record */
    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($third_parties = Doctrine::getTable('ThirdParties')->find(array($request->getParameter('id'))), sprintf('Object third_parties does not exist (%s).', $request->getParameter('id')));
        $this->form = new ThirdPartiesForm($third_parties);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($third_parties = Doctrine::getTable('ThirdParties')->find(array($request->getParameter('id'))), sprintf('Object third_parties does not exist (%s).', $request->getParameter('id')));
        $this->form = new ThirdPartiesForm($third_parties);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    /* Action for deleting 3rd Party record */
    public function executeDelete(sfWebRequest $request)
    {
        //$request->checkCSRFProtection();
        $snId = $request->getParameter('id');

        $this->forward404Unless($third_parties = Doctrine::getTable('ThirdParties')->find(array($request->getParameter('id'))), sprintf('Object third_parties does not exist (%s).', $request->getParameter('id')));

        $objThirdParties = new ThirdParties();
        $objThirdParties->changeStatus($snId, sfConfig::get('app_Status_Deleted'));  // Set Deleted Status for the deleted 3rd Party

        $this->getUser()->setFlash('succMsg', "Deletion successful.");
        $this->redirect('thirdparty/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $user = $request->getParameter($form->getName());
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        //$form->getObject()->setStateId($user['StateId']);
        if ($form->isValid())
        {
            $third_parties = $form->save();

            if($request->isMethod(sfRequest::PUT))
            $this->getUser()->setFlash('succMsg', "Update successful.");
            else
            $this->getUser()->setFlash('succMsg', "New 3rd Party added successfully.");

            $this->redirect('thirdparty/index');
            //$this->redirect('thirdparty/edit?id='.$third_parties->getId());
        }
    }

    /* On state change ajax call for display county in dropdown*/
    public function executeGetcounty(sfWebRequest $request)
    {
        if ($request->isXmlHttpRequest())
        {
            $snStateId = $request->getParameter('snStateId');
            if($snStateId)
            {
                $asCounty =  Counties::getCountyByStateId($snStateId);
                $asCounty = Doctrine::getTable('Counties')->findByStateId(array($snStateId));
                $output = '<option value="">-- Select County --</option>';
                foreach($asCounty as $c)
                {
                    $output .= '<option value="'.$c->getId().'">'.$c->getName().'</option>';
                }
            }
            else
            {
                $output = '<option value="">-- Select County --</option>';
            }
            return $this->renderText($output);
        }
    }

    /* Action for updating the status of the 3rd Party (Active/InActive) */
    public function executeStatus(sfWebRequest $request)
    {
        $snId = $request->getParameter('id');            // get id parameter
        $ssStatus = $request->getParameter('status');    // get status parameter

        $objThirdParties = new ThirdParties();
        $objThirdParties->changeStatus($snId, $ssStatus);

        if ($ssStatus == "Active") {
            $this->getUser()->setFlash("succMsg",'Status successfully changed to '.$ssStatus.'.');	
        }else {
            $this->getUser()->setFlash("errMsg",'Status successfully changed to '.$ssStatus.'.');	
        }
        
        if($request->getParameter('flag'))
            $this->redirect('thirdparty/view?id='.$snId);
    
        $this->redirect('thirdparty/index');
    }

    public function executeView(sfWebRequest $request)
    {
        $snId = $request->getParameter('id');
        $this->view = Doctrine::getTable('ThirdParties')->find(array($snId));
    }

}
