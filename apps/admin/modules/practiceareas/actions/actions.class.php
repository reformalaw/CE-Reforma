<?php

/**
 * practiceareas actions.
 *
 * @package    counceledge
 * @subpackage practiceareas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class practiceareasActions extends sfActions
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
     * Function to Listing practiceareas
     *
     * @param sfWebRequest $request
     */
    public function executeIndex(sfWebRequest $request)
    {
        $this->orderBy = "";
        $this->orderType="";
        $where = "";

        # FOR THE SEARCHING
        if($request->isMethod('post')) {
            $isSearchBtn = $request->getPostParameter('submit');
            $this->search_text  = trim($request->getPostParameter('search_text'));

            if ('' != $this->search_text)
            {
                $qSearch = Doctrine_Query::create()
                ->from("PracticeAreas pa")
                ->where("pa.Name LIKE '%".addslashes($this->search_text)."%'")
                ->orderBy('pa.Name ASC');
                $arrList = $qSearch->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
                $arrListReturn = array();
                for ($i = 0; $i<count($arrList); $i++)
                {
                    $arrListReturn[$arrList[$i]['Id']] = array('Id'=>$arrList[$i]['Id'],'Name'=>$arrList[$i]['Name'],'ParentId'=>$arrList[$i]['ParentId'],'Description'=>$arrList[$i]['Description'],'Status'=>$arrList[$i]['Status'],'UpdateDateTime'=>$arrList[$i]['UpdateDateTime'],'CreateDateTime'=>$arrList[$i]['CreateDateTime'],'level'=>0);
                }
                $this->qSearch = $arrListReturn;
            }
        }else {
            # FOR THE LISTING CREATE ONE ARRAY() AND SEND THAT RESULT TO TAMPLATE.
            $this->qSearch = PracticeAreasTable::getPracticeAreaListing();
        }
    }

    /**
     * Function to new practiceareas
     *
     * @param sfWebRequest $request
     */
    public function executeNew(sfWebRequest $request)
    {
        $this->form = new PracticeAreasForm();
    }

    /**
     * Function to Create practiceareas
     *
     * @param sfWebRequest $request
     */
    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new PracticeAreasForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * Function to Edit practiceareas
     *
     * @param sfWebRequest $request
     */
    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($practice_areas = Doctrine::getTable('PracticeAreas')->find(array($request->getParameter('id'))), sprintf('Object practice_areas does not exist (%s).', $request->getParameter('id')));
        $this->form = new PracticeAreasForm($practice_areas,array('edit'=>true,'id'=>$practice_areas->getId(),'name'=>$practice_areas->getName()));
        $practice_areas->getParentId();
    }

    /**
     * Function to Update practiceareas
     *
     * @param sfWebRequest $request
     */
    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($practice_areas = Doctrine::getTable('PracticeAreas')->find(array($request->getParameter('id'))), sprintf('Object practice_areas does not exist (%s).', $request->getParameter('id')));
        $this->form = new PracticeAreasForm($practice_areas,array('edit'=>true));

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    /**
     * Function to Delete practiceareas
     *
     * @param sfWebRequest $request
     */
    public function executeDelete(sfWebRequest $request)
    {
        //$request->checkCSRFProtection();
        $this->forward404Unless($practice_areas = Doctrine::getTable('PracticeAreas')->find(array($request->getParameter('id'))), sprintf('Object practice_areas does not exist (%s).', $request->getParameter('id')));
        PracticeAreasTable::deletedChildSubchild($practice_areas->getId());
        //$practice_areas->delete();
        $this->getUser()->setFlash("errMsg",'Deletion successful.');
        $this->redirect('practiceareas/index');
    }

    /**
     * Function to Process Form of practiceareas
     *
     * @param sfWebRequest $request
     */
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $users = $request->getParameter($form->getName());
        //clsCommon::pr($users,1);
        if ($form->isValid())
        {
            $CatNameCheck = 0;
            if ($request->isMethod(sfRequest::PUT)) {
                $CatNameCheck = PracticeAreasTable::nameCheck($request->getParameter('id'),$users['Name']);
            }
            if($CatNameCheck == 0) {
                $parentVal = explode("-",$users['ParentId']);
                $parentTempValue = $parentVal[0];
                $parentLevel = $parentVal[1];
                if((isset($users)) && ($users['ParentId'] != "") && ($users['ParentId'] != 0)){
                    $form->getObject()->setParentId($parentTempValue);
                }else {
                    $form->getObject()->setParentId(0);
                }
                if($request->isMethod(sfRequest::PUT)){
                    $form->getObject()->setStatus($form->getObject()->getStatus());
                    $practice_areas = $form->save();
                }else {
                    $form->getObject()->setStatus(sfConfig::get('app_Status_Active'));
                    $practice_areas = $form->save();
                }

                if($request->isMethod(sfRequest::PUT))
                $this->getUser()->setFlash('succMsg', "Update successful.");
                else
                $this->getUser()->setFlash('succMsg', "New practice areas category added successfully.");

                $this->redirect('practiceareas/index');
                //$this->redirect('practiceareas/edit?id='.$practice_areas->getId());
            }else {
                $this->getUser()->setFlash('errMsg', "Category name already in use, please try again. ");
                $this->redirect('practiceareas/edit?id='.$request->getParameter('id'));
            }
        }
    }

    /**
     * Function to Change Status of practiceareas
     *
     * @param sfWebRequest $request
     */
    public function executeChangeStatus(sfWebRequest $request)
    {
        $this->forward404Unless($users = Doctrine::getTable('PracticeAreas')->find(array($request->getParameter('id'))), sprintf('User not found!'));
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

        // when admin change status from view 
        if($request->hasParameter('flag'))
			if($request->getParameter('flag') == true)
			{
				$level = 0;
				if($request->hasParameter('level'))
					$level = $request->getParameter('level');

				$this->redirect('practiceareas/view?id='.$request->getParameter('id').'&level='.$level);
			}

        $this->redirect('practiceareas/index');
    }

    /**
     * Function to View practiceareas
     *
     * @param sfWebRequest $request
     */
    public function executeView(sfWebRequest $request)
    {
        $this->forward404Unless($this->practiceArea = Doctrine::getTable('PracticeAreas')->find(array($request->getParameter('id'))), 'Practice Area does not exist.');
    }

}
