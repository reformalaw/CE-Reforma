<?php

/**
 * CaseDocumentsTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CaseDocumentsTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object CaseDocumentsTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('CaseDocuments');
    }
    
    /**
     * Function Returns the Case Document Detail
     */
    public static function getCaseDocumentDetail($caseDocumentId)
    {
        $sql = Doctrine_Query::create()
        ->from('CaseDocuments c')
        ->where('c.Id = ?',$caseDocumentId);
        //clsCommon::pr($queryUser->getSqlQuery(),1);
        $result = $sql->fetchArray();
        $sql->free();
        #clsCommon::pr($result,1);;
        return $result[0];
    } // End oF Class
    
    public static function getCountRecord($asCaseId)
    {
		$asResult = Doctrine_Query::create()
						->select("c.*")
						->from('CaseDocuments c')
						->where('c.CaseId = ?',$asCaseId)
						->count();

		return $asResult;
    }
}