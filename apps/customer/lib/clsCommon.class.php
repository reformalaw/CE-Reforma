<?php
class clsCommon
{
    /**
    * This function will return the activation key.
    * Hiren Raval
    * @param integer $randomIdLength
    * @return string 
    */


    static public function getActivationKey($randomIdLength)
    {
        $rndId = crypt(uniqid(rand(),1));
        $rndId = strip_tags(stripslashes($rndId));
        $rndId = str_replace(".","",$rndId);
        $rndId = strrev(str_replace("/","",$rndId));
        $randKey = substr($rndId,0,$randomIdLength);
        return($randKey);
    }

    /**
	* This function will return the Print formatted Output to user
	* Chintan Fadia
	* @return user login status
	*/

    /**
		* This function will return the site emails value from Database.
		* Mitul Patel
		* @param string $key
		* @param string $from can be config or db
		* @return string or array as per config value 
		*/

    static public function getSiteEmails($emailKey)
    {
        if(!$emailKey)
        return false;

        $q = Doctrine_Query::create()
        ->select('Subject, MessageBody')
        ->from('Siteemails')
        ->Where('Id = ?', $emailKey);
        $objSiteEmails = $q->fetchOne();
        return $objSiteEmails;
    }

    /**
		* This function will return the site configuration variable value from Database.
		* Mitul Patel
		* @param string $key
		* @param string $from can be config or db
		* @return string or array as per config value 
		*/

    static public function getSystemConfigVars($key)
    {
        if(!$key)
        return false;

        $q = Doctrine_Query::create()
        ->select('ConfigValue')
        ->from('SiteConfig')
        ->Where('ConfigKey = ?', $key);
        $objSiteConfig = $q->fetchOne();
        if($objSiteConfig){
            return $objSiteConfig->getConfigValue();
        }else{
            return false;
        }
    }

    public static function pr($passval,$exit=false)
    {
        echo "<pre>";
        print_r($passval);
        echo "</pre>";
        if($exit == true)
        {
            exit;
        }
    }



    /**
		* This function will return the Calculated different Amount of Case .
		* Chintan Fadia
		* @param  Case Id 
		* @return array of Case Amount 
		*/

    static public function calcCustomerPayment($caseId)
    {

        $caseArr =  CasesTable::getCaseDetail($caseId);
        #clsCommon::pr($caseArr);
        $commPercentage = clsCommon::getSystemConfigVars('COUNCELEDGE_COMMISSION_PERCENTAGE');
        $commActual = (($caseArr['ActualAmount'] * $commPercentage) / 100 ) ;
        $processingFee = clsCommon::getSystemConfigVars('COUNCELEDGE_PROCESSING_FEE') ;

        // Calc Underpay Payment
        $underPay = CasesTable::getCustomerUnderPayAmt($caseArr['UserId']);
        // Completed

        /*$underPay = 0 ;
        if(!empty( $caseArr['UnderpayAdjustment']))
        $underPay =  $caseArr['UnderpayAdjustment']; */

        $payableAmt =  ($caseArr['ActualAmount'] - ( $commActual + $processingFee + $underPay  )) ;
        $output = array(
        'case_no'               =>  $caseArr['CaseNo'] ,
        'actual_amount'         =>  $caseArr['ActualAmount'] ,
        'commision_percentage'  =>  $commPercentage ,
        'processing_fees'       =>  $processingFee ,
        'commision_actual'      =>  $commActual ,
        'underpay_amount'       =>  $underPay,
        'payable_amount'        =>  $payableAmt
        ) ;
        return $output ;
    } // End of Function

    /**
     * THIS FUNCTION IS USE FOR CHECKING THE PERMISSION NAME IS EXIST OR NOT IN SESSION VALUE.
     *
     * @param unknown_type $permissionName
     * @return RETURN "TRUE" IF WE GOT THE VALUE OTHERWISE "FALSE".
     */
    public static function permissionCheck($permissionName)
    {
        if (sfContext::getInstance()->getUser()->getAttribute('user_type') != "Admin") {
            $temp = array_values(sfContext::getInstance()->getUser()->getAttribute('staff_permission'));
            for ($i=0;$i<count($temp);$i++){
                if ($temp[$i] == $permissionName) {
                    return true;
                }
            }
        }
        #THIS IS ONLY FOR DEVELOPMENT PORPOSE AFTER ALL DEVELOPMENT HERE WE SET THE FALSE.
        return true;
    }

    /**
     * THIS FUNCTION IS USED FOR GETTING HEDAR MENU MAIN AND SUB MENU URL
     *
     * @param unknown_type Object
     * @return RETURN "TRUE" IF WE GOT THE VALUE OTHERWISE "FALSE".
     */

    public static function getHeaderMenuURL($rsObj) {
        if($rsObj->getType() == 1) { // For CMS Page
            $childTitle = $rsObj->getTitle();
            $slugForchildTitle = $rsObj->getWebsiteMenuCMSPages()->getSlug();
            $childURL = '/'.$slugForchildTitle ;
        }  else if($rsObj->getType() == 2){ // For Practice Area
            $childTitle = $rsObj->getTitle();
            $slugForchildTitle = $rsObj->getWebsiteMenuWebsitePracticeArea()->getSlug();
            $childURL = 'practice-area/'.$slugForchildTitle ;
        } else if($rsObj->getType() == 3) { // For External


        } else {
            $childTitle = $rsObj->getTitle();
            $slugForchildTitle = $rsObj->getWebsiteMenuCMSPages()->getSlug();
            $childURL = '/'.$slugForchildTitle ;
        }
        return $childURL;
    }  // End of Function

    /**
     * THIS FUNCTION IS USED FOR GETTING FOOTER MENU URL
     *
     * @param unknown_type Object
     * @return RETURN "TRUE" IF WE GOT THE VALUE OTHERWISE "FALSE".
     */

    public static function getFooterMenuURL($rsObj) {
        if($rsObj->getType() == 1) { // For CMS Page
            $childTitle = $rsObj->getTitle();
            $slugForchildTitle = $rsObj->getWebsiteMenuCMSPages()->getSlug();
            $childURL = '/'.$slugForchildTitle ;
        }  else if($rsObj->getType() == 2){ // For Practice Area
            $childTitle = $rsObj->getTitle();
            $slugForchildTitle = $rsObj->getWebsiteMenuWebsitePracticeArea()->getSlug();
            $childURL = 'practice-area/'.$slugForchildTitle ;
        } else if($rsObj->getType() == 3) { // For External


        } else {
            $childTitle = $rsObj->getTitle();
            $slugForchildTitle = $rsObj->getWebsiteMenuCMSPages()->getSlug();
            $childURL = '/'.$slugForchildTitle ;
        }
        return $childURL;
    }  // End of Function
    
    /**
     * THIS FUNCTION IS USE FOR CHECKING SLUG VALUE.
     *
     * @param unknown_type $text
     * @return unknown
     */
    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text))
        {
            return 'n-a';
        }

        return $text;
    }

    

}
