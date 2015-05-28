<?php

/**
 * roles actions.
 *
 * @package    counceledge
 * @subpackage roles
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class rolesActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $this->orderBy = "";
        $this->orderType="";
        $where = "";


        $qSearch = Doctrine_Query::create();
        $qSearch->from('Roles ro');
        $qSearch->where('ro.Status != ?',sfConfig::get('app_Status_Deleted'));

        /*
        # THIS COMMENT SECTION IS USE FOR SEACRHING PORPOSE.
        # IF YOU WANT TO SET SEARCH BOX THEN REMOVE THE COMMENT CODE IS ALREADY DONE.
        if($request->isMethod('post')) {
        $isSearchBtn = $request->getPostParameter('search_btn');
        $this->search_text  = trim($request->getPostParameter('search_text'));

        if ('' != $this->search_text)
        {
        $qSearch->andWhere("ro.Name LIKE '%".addslashes($this->search_text)."%'");
        }
        }*/

        switch($request->getParameter('orderBy'))
        {
            case "Name":
                $orderBy = 'Name';
                $this->orderBy = "Name";
                break;
            case "UpdateDateTime":
                $orderBy = 'UpdateDateTime';
                $this->orderBy = "UpdateDateTime";
                break;
            case "CreateDateTime":
            default:
                $orderBy = 'CreateDateTime';
                $this->orderBy = "CreateDateTime";
                break;
        }

        switch($request->getParameter('orderType'))
        {
            case "asc":
                $qSearch->orderBy("$orderBy ASC");
                $this->orderType = "asc";
                break;
            case "desc":
            default:
                $qSearch->orderBy("$orderBy DESC");
                $this->orderType = "desc";
                break;
        }


        $pager = new sfDoctrinePager('Roles', sfConfig::get('app_no_of_records_per_page'));
        $pager->setQuery($qSearch);
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        $this->pager = $pager;
    }
    
    public function executeNew(sfWebRequest $request)
    {
        $this->form = new RolesForm();
        $this->arrCategory = PermissionCategoryTable::getAllRecordList();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new RolesForm();
        $this->arrCategory = PermissionCategoryTable::getAllRecordList();
        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($roles = Doctrine::getTable('Roles')->find(array($request->getParameter('id'))), sprintf('Object roles does not exist (%s).', $request->getParameter('id')));
        $this->form = new RolesForm($roles,array('edit'=>true,'id'=>$roles->getId(),'Name'=>$roles->getName()));
        $arrCount = PermissionsTable::getAllRecord();
        $this->arrCategory = PermissionCategoryTable::getAllRecordList();
        $arrPermission = RolesXPermissionTable::getPermissionList($roles->getId());
        $this->arrCheckBoxPermission = PermissionCategoryTable::getPermissionList($roles->getId());
        if (count($arrPermission) == $arrCount) {
            $this->form->setDefault('selectAll',"");
        }
        $this->form->setDefault('Permission',$arrPermission);
        //$this->form->setDefault('PermissionCategoryPermissions',$arrPermission1);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($roles = Doctrine::getTable('Roles')->find(array($request->getParameter('id'))), sprintf('Object roles does not exist (%s).', $request->getParameter('id')));
        $this->form = new RolesForm($roles,array('edit'=>true));
        $this->arrCategory = PermissionCategoryTable::getAllRecordList();
        $this->arrCheckBoxPermission = PermissionCategoryTable::getPermissionList($roles->getId());
        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        //$request->checkCSRFProtection();

        $this->forward404Unless($roles = Doctrine::getTable('Roles')->find(array($request->getParameter('id'))), sprintf('Object roles does not exist (%s).', $request->getParameter('id')));
        $roles->setUpdateDateTime(date("Y-m-d H:i:s"));
        $roles->setStatus(sfConfig::get('app_Status_Deleted'));
        $roles->save();

        $this->getUser()->setFlash("errMsg","Deletion successful.");
        //$roles->delete();

        $this->redirect('roles/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $users = $request->getParameter($form->getName());
        $checkBoxString = $request->getPostParameter('checkboxChild_list');
        //echo "<pre>"; print_r($checkBoxString); exit;
        //clsCommon::pr($checkBoxString,1);
        if ($form->isValid())
        {
            $NameCheck = 0;
            $NameCheck = RolesTable::emailName($request->getParameter('id'),$users['Name']);
            if($NameCheck == 0) {
                if ($request->isMethod(sfRequest::PUT)) {
                    
                    if (!empty($checkBoxString)) {
                      $form->getObject()->setStatus($form->getObject()->getStatus());
                      $roles = $form->save();
                      RolesXPermissionTable::deleteOldPermissionData($request->getParameter('id'));
                        foreach($checkBoxString as $checkBoxString){
                            $checkboxExplode = explode("_", $checkBoxString);

                            $objRoleXPer = new RolesXPermission();
                            $objRoleXPer->setRoleId($roles->getId());
                            $objRoleXPer->setPermissionId($checkboxExplode[2]);
                         
                            $objRoleXPer->setPermissionCategoryId($checkboxExplode[1]);
                            $objRoleXPer->save();
                            } 
                           $this->getUser()->setFlash('succMsg', "Update successful."); 
                            $this->redirect('roles/index');  
                        }
                    else {
                        $this->getUser()->setFlash('errMsgs', "Selct atleast one permission.");
                    }
                }
                else {
                    
                    
                    if (!empty($checkBoxString)) {
                        $form->getObject()->setStatus(sfConfig::get('app_Status_Active'));
                        $roles = $form->save();
                        foreach($checkBoxString as $checkBoxString){
                            $checkboxExplode = explode("_", $checkBoxString);

                            $objRoleXPer = new RolesXPermission();
                            $objRoleXPer->setRoleId($roles->getId());
                            $objRoleXPer->setPermissionId($checkboxExplode[2]);
                         
                            $objRoleXPer->setPermissionCategoryId($checkboxExplode[1]);
                            $objRoleXPer->save();
                            }    
                         $this->getUser()->setFlash('succMsg', "New role added successfully.");
                          $this->redirect('roles/index');
                        }
                    else {
                        $this->getUser()->setFlash('errMsgs', "Select atleast one permission.");
                    }
                }
        }else {
            $this->getUser()->setFlash('errMsg', "Role name already in use, please try again. ");
            $this->redirect('roles/edit?id='.$request->getParameter('id'));
        }
        /*if($request->isMethod(sfRequest::PUT))
            $this->getUser()->setFlash('succMsg', "Role updated successfully");
        else
            $this->getUser()->setFlash('succMsg', "New Role added Successfully"); */
         
        //$this->redirect('roles/index');
        //$this->redirect('roles/edit?id='.$roles->getId());
        }
     
    }

    public function executeChangeStatus(sfWebRequest $request)
    {
        $this->forward404Unless($roles = Doctrine::getTable('Roles')->find(array($request->getParameter('id'))), sprintf('Role not found!'));
        $status = $request->getParameter('status');
        // Do not allow to change status of current user
        if (in_array($status,array('Active','Inactive'))){
            PracticeAreasTable::changeChildStatus($roles['Id'],$status);
            $roles->setStatus($status);
            $roles->setUpdateDateTime(date("Y-m-d H:i:s"));
            $roles->save();
            $arrParams = array();

            if($status=="Active"){
                $this->getUser()->setFlash("succMsg",'Status successfully changed to active.');
                $arrParams['Status'] = 'Active';
            }else{
                $this->getUser()->setFlash("errMsg",'Status successfully changed to inactive.');
                $arrParams['Status'] = 'Inactive';
            }
        }

        if($request->hasParameter('flag'))
			if($request->getParameter('flag') == true)
				$this->redirect('roles/view?id='.$request->getParameter('id'));
				

        $this->redirect('roles/index');
    }

    public function executeView(sfWebRequest $request)
    {
        // DISPLAY 404 PAGE IF FAQ NOT EXIST.
        $this->forward404Unless($this->role = Doctrine::getTable('Roles')->find(array($request->getParameter('id'))), 'Faqs does not exist.');
    }

    /**
    * HERE IN THIS FUNCTION WE ARE CHECKING THAT USER IS NOT ADMIN AND PERMISSION CHECK IS FALSE
    * THE REDIRECT TO THE NOT AUTHENTICATED PAGE.
    */
    public function preExecute()
    {
        if (clsCommon::permissionCheck($this->getModuleName()."/".$this->getActionName()) == false){
            $this->redirect('default/NotAuthenticated');
        }
    }
}
