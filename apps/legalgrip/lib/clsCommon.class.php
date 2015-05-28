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
     * Function to check directory exist or not
     *
     * @param string $path
     * @param unknown_type $folder
     */
    public static function createFolders($path , $folder)
    {
        if(!is_dir($path.$folder))
        {
            mkdir($path.$folder, 0777, true);
            return true;
        }
        return true;
    }

    /**
     * Function to Get User / Customer Profice Picture 
     *
     * @param unknown_type $userId
     * @param unknown_type $prefix
     * @return unknown
     */
    public static function userProfileImage($userId, $prefix)
    {
        $users = Doctrine::getTable('Users')->find(array($userId));
        $imageName = $users->getProfilePic();
        $userName = ucwords($users->getFirstName().' '.$users->getLastName());
        $noImagePath = 'user-noImage/'.$prefix.'_noImage.png';
        if($imageName != "")
        {
            $path =  "userpic/".$userId.'/'.$prefix."_".$imageName ;
            if(file_exists(sfConfig::get('sf_upload_dir').'/'.$path))
            return array('path'=>'../uploads'.'/'.$path,'title'=>$userName);
            else
            return array('path'=>$noImagePath,'title'=>$userName);
        }
        else
        {
            return array('path'=>$noImagePath,'title'=>$userName);
        }
    }

    /**
     * THIS FUNCTION IS USE FOR CHECKING SLUG VALUE.
     *
     * @param unknown_type $text
     * @return unknown
     */
    static public function slugify($text)
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

    /**
     * Funcion to Show Rating on Attorney Listig Page
     *
     * @param unknown_type $avgRating
     * @return unknown
     */
    public static function displayRatingOnAttorneyListing($avgRating) {
        $startStr = '';
        if($avgRating != 0 ) {
            $offStar = 5 - $avgRating ;
            $spiltAvgRating = explode('.',$avgRating);
            #clsCommon::pr($spiltAvgRating);
            $startStr = '';

            for($r= 0; $r < $spiltAvgRating[0] ; $r++) {
                $startStr .= image_tag('legalgrip/star-full.png');
            }

            if(isset($spiltAvgRating[1])) {
                $startStr .= image_tag('legalgrip/star-half.png');
            }

            if(intval($offStar) > 0 ) {
                for($k= 0; $k < intval($offStar) ; $k++) {
                    $startStr .= image_tag('legalgrip/star-gray.png');
                }
            }
        } else {
            for($k= 0; $k < 5 ; $k++) {
                $startStr .= image_tag('legalgrip/star-gray.png');
            }

        }
        return $startStr;

    } // End of Function

    /**
     * Funcion to Show Rating on Attorney Profile Page
     *
     * @param unknown_type $avgRating
     * @return unknown
     */

    public static function displayRatingOnProfile($avgRating) {
        $startStr = '';
        if($avgRating != 0 ) {

            $offStar = 5 - $avgRating ;
            $spiltAvgRating = explode('.',$avgRating);
            #clsCommon::pr($spiltAvgRating);


            for($r= 0; $r < $spiltAvgRating[0] ; $r++) {
                $startStr .= image_tag('legalgrip/star-on.png');
            }

            if(isset($spiltAvgRating[1])) {
                $startStr .= image_tag('legalgrip/halfstar.png');
            }

            if(intval($offStar) > 0 ) {
                for($k= 0; $k < intval($offStar) ; $k++) {
                    $startStr .= image_tag('legalgrip/star-off.png');
                }
            }
        } else {
            for($k= 0; $k < 5 ; $k++) {
                $startStr .= image_tag('legalgrip/star-off.png');
            }

        }

        return $startStr;

    } // End of Function

    /**
     * Function to check whether State Cookie exixt or not
     *
     */
    public static function checkStateCookieExist() {
        $stateCookieExist = false ;
        $stateCookie = sfContext::getInstance()->getRequest()->getCookie('LgStateId');
        if(isset($stateCookie) && !empty($stateCookie) && $stateCookie != '' && is_numeric($stateCookie))  {
            $stateCookieExist = true ;
           # $statesArr = StatesTable::getUSStatesData();
        }
        return $stateCookieExist;
    }
    /**
     * Function to check whether County Cookie exixt or not
     *
     */
    public static function checkCountyCookieExist() {
        $countyCookieExist = false ;
        $countyCookie = sfContext::getInstance()->getRequest()->getCookie('LgCountyId');
        if(isset($countyCookie) && !empty($countyCookie) && $countyCookie != '' && is_numeric($countyCookie))  {
            $countyCookieExist = true ;
        }
        return $countyCookieExist;
    }

    /**
     * Function to return State Cookie Value
     *
     */
    public static function checkStateCookieValue() {
        $stateCookie = sfContext::getInstance()->getRequest()->getCookie('LgStateId');
        return $stateCookie;
    }
    /**
     * Function to return County Cookie Value
     *
     */
    public static function checkCountyCookieValue() {
        $countyCookie = sfContext::getInstance()->getRequest()->getCookie('LgCountyId');
        return $countyCookie;
    }

    /**
     * Function to create ProfilePageURL for LegalGRip
     *
     */
    public static function generateProfilePageURL_1($custId = null , $custName = null) {
        $url = 'attorny';
        if(self::checkStateCookieExist()) {
            $stateCookie = self::checkStateCookieValue();
            $statesArr = StatesTable::getUSStatesData();
            $stateName = $statesArr[$stateCookie];
            $stateSlugValue = clsCommon::slugify($stateName);
            $url = $stateSlugValue.'/attorny';
        }

        if(isset($custId) && $custId != null && !empty($custId)) {
            $url = $url.'/' .$custId;
        }
        if(isset($custName) && $custName != null && !empty($custName)) {
            $url = $url.'/' .$custName;
        }

        return $url;
    }

    /**
     * Function to generate Profile Page URL routing 
    */
    public static function generateProfilePageURL($custId = null , $custName = null) {
        #http://symfony.com/legacy/doc/jobeet/1_4/en/05?orm=Propel
        $url = 'attornies/profile';
        if(self::checkStateCookieExist()) {
            $stateCookie = self::checkStateCookieValue();
            $statesArr = StatesTable::getUSStatesData();
            $stateName = $statesArr[$stateCookie];
            $stateSlugValue = clsCommon::slugify($stateName);
            $url .= '?state='.$stateSlugValue;

            if(isset($custId) && $custId != null && !empty($custId)) {
                $url .= '&id='.$custId;
            }
            if(isset($custName) && $custName != null && !empty($custName)) {
                $url .= '&nameslug=' .$custName;
            }

        } else {

            if(isset($custId) && $custId != null && !empty($custId)) {
                $url .='?id='.$custId;
            }
            if(isset($custName) && $custName != null && !empty($custName)) {
                $url .= '&nameslug='.$custName;
            }

        }
        return $url;
    } // End of Function 
    
    /**
     * Function to generate Profile Page URL routing 
    */
    public static function generateBrowseAttorneyPageURL($parentCat, $subCat, $childCat) {
        
        #http://symfony.com/legacy/doc/jobeet/1_4/en/05?orm=Propel
        $url = 'attornies/index';
        if(self::checkStateCookieExist()) {
            $stateCookie = self::checkStateCookieValue();
            $statesArr = StatesTable::getUSStatesData();
            $stateName = $statesArr[$stateCookie];
            $stateSlugValue = clsCommon::slugify($stateName);
            $url .= '?state='.$stateSlugValue;

            if(isset($parentCat) && $parentCat != null && !empty($parentCat)) {
                $url .= '&parentcat='.$parentCat;
            }
            if(isset($subCat) && $subCat != null && !empty($subCat)) {
                $url .= '&subcat=' .$subCat;
            }
            if(isset($childCat) && $childCat != null && !empty($childCat)) {
                $url .= '&childcat=' .$childCat;
            }

        } else {

            if(isset($parentCat) && $parentCat != null && !empty($parentCat)) {
                $url .= '?parentcat='.$parentCat;
            }
            if(isset($subCat) && $subCat != null && !empty($subCat)) {
                $url .= '&subcat=' .$subCat;
            }
            if(isset($childCat) && $childCat != null && !empty($childCat)) {
                $url .= '&childcat=' .$childCat;
            }

        }
        #echo $url;
        return $url;
    }
    

}
