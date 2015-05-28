<?php

/**
 * faq actions.
 *
 * @package    counceledge
 * @subpackage faq
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contactusActions extends sfActions
{
    /* this is for listing of customer form elements*/
    public function executeIndex(sfWebRequest $request)
    {

        $this->orderBy = "";
        $this->orderType="";
        $where = "";

        $userId 	= $this->getUser()->getAttribute('admin_user_id');

        /* this query is for customer contactus page Listing */
        $custList = Doctrine::getTable('CustomerContact')->customerListing($userId);
        $this->pager = $custList->execute();

        //clsCommon::pr($this->pager);exit;

    }

    /* this action is created for ordering of listing */
    public function executeGlobelOrdering(sfWebRequest $request)
    {
        $anOrdering = $request->getParameter('recordsArray');
        //echo '<pre>'; print_r($anOrdering);exit;

        foreach($anOrdering as $key => $snOrderning)
        {
            Doctrine::getTable('CustomerContact')->updateOrdering($snOrderning,$key);

        }
        return sfView::NONE;
    }


    /**
    * set the status of the users connections in search module
    */
    public function executeSaveData(sfWebRequest $request) {

        if ($request->isXmlHttpRequest())
        {
            if($request->isMethod('post'))
            {
                $userId 	= $this->getUser()->getAttribute('admin_user_id');

                //clsCommon::pr($_POST);exit;
                $id = $request->getParameter('id');

                $label 		= $request->getParameter('Label');
                $fieldType 	= $request->getParameter('FieldType');
                
                $options1 	= $request->getParameter('Options');
                $options2 	= array_map('trim',explode(',',$options1));
                $options3    = trim(implode(',',$options2),' , ');
                //$options    = preg_replace('/( *)/', '', $options3);
                $options    = $options3;
                
                $required 	= $request->getParameter('Required');
                $count	 	= $request->getParameter('TotalRecord');
                
                // For Options to Add Sluify in Table
                if(in_array($fieldType, array('DropDown','CheckBox','Radio'))) {
                    $slugOption = explode(',', $options3);
                    $slugOptionStr= '';
                    foreach($slugOption as $key => $val ) {
                        $slugOptionStr .= clsCommon::slugify($val). ',';
                        
                    }
                    $slugOptionStr = trim($slugOptionStr,',');
                    
                }  else {
                    $slugOptionStr = "" ;
                } // Complete

                if($required=='true')$req = 'Yes';
                else $req = 'No';



                if($id){

                    //clsCommon::pr($_POST);exit;

                    // Edit Mode
                    $query =  Doctrine_Query::create()
                    ->update('CustomerContact')
                    ->set('Label', '?', $label)
                    ->set('FieldType', '?', $fieldType)
                    ->set('Options', '?', $options)
                    ->set('Required', '?', $req)
                    ->set('OptionsSlug','?',$slugOptionStr)
                    ->where('Id = ?', $id)
                    ->execute();


                }else{

                    $new = new CustomerContact();

                    $new->setUserId($userId);

                    $new->setLabel($label);
                    $new->setFieldType($fieldType);
                    $new->setOptions($options);
                    $new->setRequired($req);
                    $new->setOrdering($count);
                    $new->setOptionsSlug($slugOptionStr);
                    $new->save();

                    // return inserted id for assigning into delete button
                    echo  $new->getId();
                }
                exit;

            }

        }
    }



    /*This Action is for Customer Record Delete */
    public function executeDeleteRecord(sfWebRequest $request)
    {

        $this->forward404Unless($custElem = Doctrine::getTable('CustomerContact')->find(array($request->getParameter('id'))), sprintf('Object customer elements does not exist (%s).', $request->getParameter('id')));
        $asData = $custElem->toArray();

        $userId 	= $this->getUser()->getAttribute('admin_user_id');

        /* this is for maintain order at delete time */
        $updatedrow = CustomerContactTable::getInstance()->updateUserElementOrdrAtDelete($asData["Ordering"], $userId );


        // DELETE CUSTOMER ELEMENTS
        $queryReply = Doctrine_Query::create()
        ->delete('CustomerContact')
        ->where('Id = ?' , $request->getParameter('id') );
        $queryReply->execute();


        $this->getUser()->setFlash('errMsg', "Deletion successful.");
        $this->redirect('contactus/index');
    }




}
