<?php

/**
 * attorneycontact actions.
 *
 * @package    counceledge
 * @subpackage attorneycontact
 * @author     Chintan Fadia
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class attorneycontactActions extends sfActions
{
    /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */

    public function executeIndex(sfWebRequest $request)
    {

        $this->orderBy = "";
        $this->orderType="";
        $where = "";

        $userId 	= $this->getUser()->getAttribute('admin_user_id');

        /* this query is for attorney contactus page Listing */
        $custList = Doctrine::getTable('AttorneyContact')->customerListing($userId);
        $this->pager = $custList->execute();
        //clsCommon::pr($this->pager);exit;
    } // End of Function

    /* this action is created for ordering of listing */
    public function executeGlobelOrdering(sfWebRequest $request)
    {
        $anOrdering = $request->getParameter('recordsArray');
        //echo '<pre>'; print_r($anOrdering);exit;

        foreach($anOrdering as $key => $snOrderning)         {
            Doctrine::getTable('AttorneyContact')->updateOrdering($snOrderning,$key);
        }
        return sfView::NONE;
    } // End of Function


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
                //$options    = preg_replace('/( *)/', '', $options3);  //commented by jaydip dodiya for issue put space in between option like "jaydip dodiya","jatin dodiya" this space
                $options    = $options3;  //added by jaydip for put space in between the option

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
                    ->update('AttorneyContact')
                    ->set('Label', '?', $label)
                    ->set('FieldType', '?', $fieldType)
                    ->set('Options', '?', $options)
                    ->set('Required', '?', $req)
                    ->set('OptionsSlug','?',$slugOptionStr)
                    ->where('Id = ?', $id)
                    ->execute();
                }else{
                    $new = new AttorneyContact();
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
    } // End of Function



    /*This Action is for Attroney Record Delete */
    public function executeDeleteRecord(sfWebRequest $request)
    {

        $this->forward404Unless($custElem = Doctrine::getTable('AttorneyContact')->find(array($request->getParameter('id'))), sprintf('Object Attorney elements does not exist (%s).', $request->getParameter('id')));
        $asData = $custElem->toArray();
        $userId 	= $this->getUser()->getAttribute('admin_user_id');
        /* this is for maintain order at delete time */
        $updatedrow = AttorneyContactTable::getInstance()->updateUserElementOrdrAtDelete($asData["Ordering"], $userId );

        // DELETE ATTORNEY ELEMENTS
        $queryReply = Doctrine_Query::create()
        ->delete('AttorneyContact')
        ->where('Id = ?' , $request->getParameter('id') );
        $queryReply->execute();

        $this->getUser()->setFlash('errMsg', "Deletion successful.");
        $this->redirect('attorneycontact/index');
    } // End of Function

}