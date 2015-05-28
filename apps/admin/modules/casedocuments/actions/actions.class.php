<?php

/**
 * casedocuments actions.
 *
 * @package    counceledge
 * @subpackage casedocuments
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class casedocumentsActions extends sfActions
{
	/**
     * Function For check case 
     *
     */
	public function preExecute()
	{
        /**
    * HERE IN THIS FUNCTION WE ARE CHECKING THAT USER IS NOT ADMIN AND PERMISSION CHECK IS FALSE
    * THE REDIRECT TO THE NOT AUTHENTICATED PAGE.
    */

         if (clsCommon::permissionCheck($this->getModuleName()."/".$this->getActionName()) == false){
            $this->getUser()->setFlash("errMsg",sfConfig::get('app_Permission_Message'));
            $this->redirect('default/index');
        }

		$request = $this->getRequest();
        if($request->hasParameter('caseId'))
 		{
			if($request->getParameter("caseId") != '')
			{
				$this->caseId = $request->getParameter("caseId");
				$caseData = Doctrine::getTable('Cases')->find(array($this->caseId));
				$customerId = $this->getUser()->getAttribute('admin_user_id');
				if($caseData->getUserId() != $customerId)
				{
					$this->redirect("customercase/index");
				}
			}
 			else
 				$this->redirect("customercase/index");
 		}
	}

	/**
     * Function For Listing
     *
     * @param sfWebRequest $request
     */
	public function executeIndex(sfWebRequest $request)
	{
	    
	    // This will be case id if paased on URL then need to check its User id with Looged in USer id , if not then redirect to Case Listing page
		if($request->hasParameter("id") != '')
		{
			$caseData = Doctrine::getTable('Cases')->find(array($request->getParameter("id")));
			if($caseData->getUserId() != $this->getUser()->getAttribute('admin_user_id'))
			{
				$this->redirect("customercase/index");
			}
		}
	    
		if($request->hasParameter("caseId"))
		{
			$this->caseId = $request->getParameter("caseId");
			$this->case = Doctrine::getTable('Cases')->find(array($this->caseId));
		}

		if($request->hasParameter("bFlag"))
			$this->bFlag = $request->getParameter("bFlag");
		else
			$this->bFlag = 0;

		$oCases = Doctrine::getTable('Cases')->findById($this->caseId);
		$asCaseData = $oCases->toArray();
		$this->caseNo = $asCaseData[0]["CaseNo"];

		$this->orderBy = "";
		$this->orderType="";
		$where = "";
			
		$qSearch = Doctrine_Query::create();
		$qSearch->from('CaseDocuments ca');
		$qSearch->where("CaseId = ?",$this->caseId);
		$qSearch->orderBy('ca.Id Desc');
		
		$this->form = new CaseDocumentsForm(array(),array('caseId'=>$this->caseId));
		if($request->isMethod(sfRequest::POST))
		{
			$this->form = new CaseDocumentsForm(array(),array('caseId'=>$this->caseId));
			$this->processForm($request, $this->form,$this->bFlag);
		}
		
		$pager = new sfDoctrinePager('CaseDocuments', sfConfig::get('app_no_of_records_per_page'));
		$pager->setQuery($qSearch);
		$pager->setPage($request->getParameter('page', 1));
		$pager->init();
		$this->pager = $pager; 
	}
	
	/**
     * Function To new record
     *
     * @param sfWebRequest $request
     */
	public function executeNew(sfWebRequest $request)
	{
		//$this->caseId = $this->getUser()->getAttribute("caseId");
		if($request->hasParameter("caseId"))
			$this->caseId = $request->getParameter("caseId");

		/* this is for cutomer case maintain flag */
		if($request->hasParameter("bFlag"))
			$this->bFlag = $request->getParameter("bFlag");
		else
			$this->bFlag = 0;
		/*End of maintain flag */
		
		$oCases = Doctrine::getTable('Cases')->findById($this->caseId);
		$asCaseData = $oCases->toArray();
		$this->caseNo = $asCaseData[0]["CaseNo"];
		
		$this->form = new CaseDocumentsForm(array(),array('caseId'=>$this->caseId));
	}

	/**
     * Function To Create the Record
     *
     * @param sfWebRequest $request
     */
	public function executeCreate(sfWebRequest $request)
	{
		$this->caseId = $request->getPostParameter("caseId");

		/* this is for cutomer case maintain flag */
		if($request->getPostParameter("bFlag"))
			$this->bFlag = $request->getPostParameter("bFlag");
		else
			$this->bFlag = 0;
		/*End of maintain flag */
		
		$oCases = Doctrine::getTable('Cases')->findById($this->caseId);
		$asCaseData = $oCases->toArray();
		$this->caseNo = $asCaseData[0]["CaseNo"];
		//$this->caseId = $this->getUser()->getAttribute("caseId");
	
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new CaseDocumentsForm(array(),array('caseId'=>$this->caseId));

		$this->processForm($request, $this->form,$this->bFlag);

		$this->setTemplate('new');
	}

// 	public function executeEdit(sfWebRequest $request)
// 	{
// 		$this->caseId = $this->getUser()->getAttribute("caseId");
// 		$this->forward404Unless($case_documents = Doctrine::getTable('CaseDocuments')->find(array($request->getParameter('id'))), sprintf('Object case_documents does not exist (%s).', $request->getParameter('id')));
// 		$this->form = new CaseDocumentsForm($case_documents);
// 	}
// 
// 	public function executeUpdate(sfWebRequest $request)
// 	{
// 		$this->caseId = $this->getUser()->getAttribute("caseId");
// 		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
// 		$this->forward404Unless($case_documents = Doctrine::getTable('CaseDocuments')->find(array($request->getParameter('id'))), sprintf('Object case_documents does not exist (%s).', $request->getParameter('id')));
// 		$this->form = new CaseDocumentsForm($case_documents);
// 
// 		$this->processForm($request, $this->form);
// 
// 		$this->setTemplate('edit');
// 	}

	/**
     * Function To Delete The Record
     *
     * @param sfWebRequest $request
     */
	public function executeDelete(sfWebRequest $request)
	{
		//$request->checkCSRFProtection();
		if($request->hasParameter("bFlag"))
			$bFlag = $request->getParameter("bFlag");

		$this->forward404Unless($case_documents = Doctrine::getTable('CaseDocuments')->find(array($request->getParameter('id'))), sprintf('Object case_documents does not exist (%s).', $request->getParameter('id')));

		/* Start physically Delete the image */
		//$caseId = $this->getUser()->getAttribute("caseId");
		$caseId = $case_documents->getCaseId();
		$caseInvoicePath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.sfConfig::get('app_caseInvoicePath').$caseId.DIRECTORY_SEPARATOR; //GET Case Invoice Path
		$oldFile = $case_documents->getBillDocumentSystemName();
		$unlink_document = @unlink($caseInvoicePath.$oldFile);

		$case_documents->delete();
		/* End physically Delete the image */
		$this->getUser()->setFlash('succMsg', "Deletion successful.");

		if($bFlag == 1)
			$this->redirect('casedocuments/index?caseId='.$caseId.'&bFlag=1&id='.$caseId);
		else
			$this->redirect('casedocuments/index?caseId='.$caseId);
	}

	/**
     * Function To Process the Add Record
     *
     * @param sfWebRequest $request
     * @param sfForm $form
     * @param boolean $bFlag
     */
	protected function processForm(sfWebRequest $request, sfForm $form, $bFlag)
	{
		//$caseId = $this->getUser()->getAttribute("caseId");
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		$asCaseDocumentData = $request->getParameter($form->getName());
		$caseId =$asCaseDocumentData["caseId"];
		if ($form->isValid())
		{
			$file = $request->getFiles($form->getName()); //GET Case Invoice
            $fileExtArr = sfConfig::get('app_caseFileType'); //GET ALLOWED FILE TYPE
            $caseInvoicePath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.sfConfig::get('app_caseInvoicePath').$caseId.DIRECTORY_SEPARATOR; //GET Case Invoice Path

			if(!is_dir($caseInvoicePath))
			{
				mkdir($caseInvoicePath,0777);
			}
            //IF THE USER UPLOADED THE FILE       // SET DEFAULT HAS ERROR TO FALSE
            $hasError = false;

            if (!empty($file['Document']['name'])) {

                //CHECK THE FILE EXTENSION
                if (in_array($file['Document']['type'],$fileExtArr)) {

                    $filename = time(); //MODIFY THE FILE NAME
                    $ext = explode(".",$file['Document']['name']);

                    // GET FILE EXTENSION
                    #clsCommon::pr($filename);
                    #clsCommon::pr($ext);

                    $extension = $ext[count($ext) - 1];
                    $this->docName = $filename.".".$extension;
                    $this->docOrgName = $file['Document']['name'];
                    move_uploaded_file($file['Document']['tmp_name'],$caseInvoicePath.$this->docName); // UPLOAD THE FILE TO THE SERVER
                }else{
                    // IF NOT VALID EXTENSION   //SET HAS ERROR TRUE
                    $hasError=true;
                    $this->getUser()->setFlash('errDocumentMsg', "Please provide a valid document.");
                }
            } // End of if not empty Document Name

            if(!$hasError){
                // SET NEW FILE NAME

				$form->getObject()->setBillDocumentRealName($this->docOrgName);
                $form->getObject()->setBillDocumentSystemName($this->docName);
                $form->getObject()->setCaseId($caseId);

                $case_documents = $form->save();

				if($request->isMethod(sfRequest::PUT))
					$this->getUser()->setFlash('succMsg', "Update successful.");
				else 
					$this->getUser()->setFlash('succMsg', "New case document added successfully.");

				if($bFlag == 1)
					$this->redirect('casedocuments/index?caseId='.$caseId.'&bFlag=1&id='.$caseId);
				else
					$this->redirect('casedocuments/index?caseId='.$caseId);
            }

		}
	}
	
    /**
     * Function To Download Case Document
     *
     * @param sfWebRequest $request
     */
    public function executeDownloadinvoice(sfWebRequest $request) {

        $caseDoumentId = $request->getParameter('id');
        $oCaseDocumentData = Doctrine::getTable('CaseDocuments')->find(array($caseDoumentId));
		//$caseId = $this->getUser()->getAttribute("caseId");
		$caseId = $oCaseDocumentData->getCaseId();

        $caseDetail = CaseDocumentsTable::getCaseDocumentDetail($caseDoumentId);
        #clsCommon::pr($caseDetail);

        $orgName = $caseDetail['BillDocumentRealName'];
        $sysName = $caseDetail['BillDocumentSystemName'];

        // For Linux
        #$source = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.sfConfig::get('app_caseInvoicePath').$sysName ;
        $source = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.sfConfig::get('app_caseInvoicePath').$caseId.DIRECTORY_SEPARATOR.$sysName; //GET Case Invoice Path
        # $caseInvoicePath.$sysName;
        #die;

        // For Windows
        /*$source = trim(sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.sfConfig::get('app_caseInvoicePath'),'/');
        $source .= '\\'.$sysName; */

        if (file_exists($source)){

            header("Pragma: ");
            header("Cache-Control: ");
            header("Content-type: application/force-download");
            header('Content-Disposition: inline; filename="' .$source.''. '"');
            header("Content-Transfer-Encoding: Binary");
            header("Content-length: ".filesize($source));
            header('Content-Type: application/octet-stream');

            header('Content-Disposition: attachment; filename="'.$orgName.'"');
            readfile("$source");
            exit();
        }
        exit();
        
    } // End of function
}
