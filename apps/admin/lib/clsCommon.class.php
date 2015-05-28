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
        #clsCommon::pr($caseArr,1);
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
        'payable_amount'        =>  $payableAmt,
        'check_no'              =>  $caseArr['CheckNo']
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
        /*$ssActionName= strstr($permissionName,'/');  // get Action Name
        $defaultPermissions= array('/create','/update');  // check action name is in_array or not

        if (sfContext::getInstance()->getUser()->getAttribute('user_type') == sfConfig::get('app_UserType_Staff')) {
        $temp = array_values(sfContext::getInstance()->getUser()->getAttribute('staff_permission'));
        //echo "<pre>"; print_r($temp); exit;
        for ($i=0;$i<count($temp);$i++){
        if ($temp[$i] == $permissionName  || in_array($ssActionName,$defaultPermissions) ||
        sfContext::getInstance()->getRequest()->isXmlHttpRequest() ) {
        // if ($temp[$i] == $permissionName) {
        return true;
        }
        }
        }
        elseif (sfContext::getInstance()->getUser()->getAttribute('user_type') == sfConfig::get('app_UserType_Admin')) {
        return true;
        }else {
        #THIS IS ONLY FOR DEVELOPMENT PORPOSE AFTER ALL DEVELOPMENT HERE WE SET THE FALSE.
        return true;
        } */
        return true;
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
     * THE FOLLOWING FUNCTION IS USE FOR GETTING THE KEY AND VALUE OF AUTO SUGGEST CASE NO.
     *
     * @return unknown
     */
    public static function autoSuggestCaseNo()
    {
        $items = array();

        $AutoCom = Doctrine_Query::create()
        ->select('c.CaseNo,c.FirstTitle,c.LastTitle')
        ->from('Cases c')
        ->where('c.Status != ?', sfConfig::get('app_CaseStatus_Deleted'))
        ->fetchArray();
        //clsCommon::pr($AutoCom,1);

        foreach ($AutoCom as $key => $value)
        {
            $items[$value['CaseNo']] = $value['CaseNo']." ".$value['FirstTitle']." ".$value['LastTitle'];
        }
        return $items;
    }

    /**
     * THE FOLLOWING FUNCTION IS USE FOR GETTING THE KEY AND VALUE OF AUTO SUGGEST CASE NO FOR PARTICULAR CUSTOMER.
     *
     * @return unknown
     */
    public static function autoSuggestDashboardCaseNo($customerId, $stage = array())
    {
        $items = array();

        $AutoCom = Doctrine_Query::create()
        ->select('c.CaseNo,c.FirstTitle,c.LastTitle')
        ->from('Cases c')
        ->where('c.UserId = ?',$customerId)
        ->andWhere('c.Status != ?',sfConfig::get('app_CaseStatus_Deleted'));
        if(!empty($stage)) {
            $AutoCom->andWhereNotIn('c.Stage' , $stage);
        }
        
        $result = $AutoCom->fetchArray();

        foreach ($result as $key => $value)
        {
            $items[$value['CaseNo']] = $value['CaseNo']." ".$value['FirstTitle']." ".$value['LastTitle'];
        }
        return $items;
    }


    /**
     * This function is use for calculation of commission and return all the amts.
     *
     * @param unknown_type $actualAmt
     * @return unknown
     */
    public static function commissionCalculation($actualAmt){
        $returnArr = array();
        $returnArr['CommissionPer'] = $commissionPerct = clsCommon::getSystemConfigVars('COUNCELEDGE_COMMISSION_PERCENTAGE');
        $returnArr['ProcessingFee'] = $processingFee = clsCommon::getSystemConfigVars('COUNCELEDGE_PROCESSING_FEE');
        $returnArr['ActualCommission'] = $actualCommission = round((($actualAmt*$commissionPerct)/100 ),2);
        $returnArr['PayableAmt'] = $payableAmount =   round( ($actualAmt-$actualCommission-$processingFee),2 );

        return $returnArr;
    }


    /**
     * This function is use for calculation of commission and return all the amts.
     *
     * @param unknown_type $actualAmt
     * @return unknown
     */
    public static function editCaseCommissionCalculation($actualAmt, $commissionPerct , $processingFee){
        $returnArr = array();
        $returnArr['CommissionPer'] = $commissionPerct ;
        $returnArr['ProcessingFee'] = $processingFee ;
        $returnArr['ActualCommission'] = $actualCommission = round((($actualAmt*$commissionPerct)/100),2);
        $returnArr['PayableAmt'] = $payableAmount =   round( ($actualAmt-$actualCommission-$processingFee),2);

        return $returnArr;
    }
    
    /**
     * This function is used to convert XML objects into Array
     *
     * @param unknown_type xml object
     * @return Array
     */

    public static function xml2array( $xmlObject, $out = array () ) //http://www.php.net/manual/en/ref.simplexml.php
    {
        foreach ( (array) $xmlObject as $index => $node )
        $out[$index] = ( is_object ( $node ) ) ? clsCommon::xml2array ( $node ) : $node;

        return $out;
    }

    /**
     * Function to check directory exist or not
     *
     * @param string $path
     */
    public static function createWebsiteFolders($path , $folder)
    {
        if(!is_dir($path.$folder))
        {
            mkdir($path.$folder, 0777, true);
            return true;
        }
        return true;
    }

    public static function convertXmlToArray($xml, $root = false) { //http://milesj.me/blog/read/simplexml-to-array
        if (!$xml->children()) {
            return (string)$xml;
        }

        $array = array();
        foreach ($xml->children() as $element => $node) {
            $totalElement = count($xml->{$element});

            if (!isset($array[$element])) {
                $array[$element] = "";
            }

            // Has attributes
            if ($attributes = $node->attributes()) {
                $data = array(
                'attributes' => array(),
                'value' => (count($node) > 0) ? self::convertXmlToArray($node, false) : (string)$node
                // 'value' => (string)$node (old code)
                );

                foreach ($attributes as $attr => $value) {
                    $data['attributes'][$attr] = (string)$value;
                }

                if ($totalElement > 1) {
                    $array[$element][] = $data;
                } else {
                    $array[$element] = $data;
                }

                // Just a value
            } else {
                if ($totalElement > 1) {
                    $array[$element][] = self::convertXmlToArray($node, false);
                } else {
                    $array[$element] = self::convertXmlToArray($node, false);
                }
            }
        }

        if ($root) {
            return array($xml->getName() => $array);
        } else {
            return $array;
        }
    } //End of Function


    /** Function to get Slug for Practice Area for Seeting Theme Default Content
     * *
     *
     * @return Slug
     */
    public static function getPracticeAreaSlug($websiteId, $title){

        $slugTitle = clsCommon::slugify($title);

        // Check if Slug is reserved for Website, creted for Routing issues
        $reservedSlugForPageAndPracticeArea = sfConfig::get('app_ReservedSlugForPageAndPracticeArea_keywords') ;
        if(in_array($slugTitle, $reservedSlugForPageAndPracticeArea)) {
            $slugTitle = $slugTitle.'1';
        }

        $checkSlug = WebsitePracticeAreaTable::checkSlugExist($websiteId, $slugTitle, NULL, NULL);
        if (count($checkSlug)>0) {
            $slugTitle = $checkSlug[0]['Slug'].'-'.count($checkSlug);
            return $slugTitle;
        }else {
            return $slugTitle;
        }

    } // End of Function

    /** Function to get Slug for CMS Pages for Seeting Theme Default Content
     * *
     *
     * @return Slug
     */
    public static function getCmsPageSlug($websiteId, $title){

        $slugTitle = clsCommon::slugify($title);
        // Check if Slug is reserved for Website, creted for Routing issues
        $reservedSlugForPageAndPracticeArea = sfConfig::get('app_ReservedSlugForPageAndPracticeArea_keywords') ;
        if(in_array($slugTitle, $reservedSlugForPageAndPracticeArea)) {
            $slugTitle = $slugTitle.'1';
        }

        $checkSlug = CMSPagesTable::checkSlugExist($websiteId, $slugTitle, NULL, NULL);
        if (count($checkSlug)>0) {
            $slugTitle = $checkSlug[0]['Slug'].'-'.count($checkSlug);
            return $slugTitle;
        }else {
            return $slugTitle;
        }

    } // End of Function



    /**
     * Function to Create Websites Default Folder
     *
     * @param string $path
     */
    public static function createPersonalWebsiteDefaultFolders($websitId)
    {


        $pathToWebsiteFolder = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'website'.DIRECTORY_SEPARATOR;
        $webFolders = array($websitId , 'logo' , 'banner','banner'.DIRECTORY_SEPARATOR.'thumb', 'attachments' , 'banner-background','body-background');
        $i = 0;

        foreach($webFolders as $folder) {
            if($i == 0) {
                if(!is_dir($pathToWebsiteFolder.$folder))
                {
                    mkdir($pathToWebsiteFolder.$folder, 0777, true);
                }
                $i++;
            } else  {
                $path = $pathToWebsiteFolder.DIRECTORY_SEPARATOR.$websitId.DIRECTORY_SEPARATOR;
                if(!is_dir($path.$folder))
                {
                    mkdir($path.$folder, 0777, true);
                }
                $i++;

            }

        } // End of For

    } // End of Function

    /**
     * Function reads XML file of Theme from uploads/assests/theme folder and converts it into array
     *
     * @param unknown_type $websiteId
     * @param unknown_type $themeId
     */
    public static function  getThemeDefaultContent($websiteId, $themeId){

        $xmlFile = 'setup.xml';
        $dataFolder = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR;
        $thmeFolder = 'theme'.$themeId.DIRECTORY_SEPARATOR;

        $xlFilePath = $dataFolder.$thmeFolder.'xml'.DIRECTORY_SEPARATOR.$xmlFile;
        /*$logoFilePath = $dataFolder.$thmeFolder.'logo'.DIRECTORY_SEPARATOR.'logo.png';
        $bannerFilePath = $dataFolder.$thmeFolder.'banner'.DIRECTORY_SEPARATOR;*/

        #echo $xlFilePath;

        $fileExist = true ;
        if (file_exists($xlFilePath)) {
            $xmlObject = simplexml_load_file($xlFilePath , 'SimpleXMLElement', LIBXML_NOCDATA);
        } else {
            $fileExist = false  ;
        }

        $XMLArr = array();
        if ($fileExist) {
            $XMLArr = self::convertXmlToArray($xmlObject, $out = array () ); // Convert XML object to Array
        }
        return $XMLArr;
        // Complete To Read XML File


    } // end of Function


    /**
     * This function is for insert record in ThemeOptions table 
     *
     * @param object $objUserWebsite
     */
    public static function optionRecordInsert($objUserWebsite)
    {
        /* get default Theme Record */
        $snThemeId = ThemeTable::getDefaultRecord();
        $ssOption = $snThemeId[0]["Options"];
        $asOptions = unserialize($ssOption);

        /*if($asOptions[sfConfig::get("app_Color_Logo")] == "Yes")
        {
        // START move logo from one folder to another
        $asPathInfo = pathinfo(sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'../images/admin/logo.png');
        $ssImageName = $objUserWebsite->getId()."L_".$asPathInfo["basename"];

        //to crate the website id folder
        $ssWebPath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.sfConfig::get("app_LogoPath_WebsitePath").DIRECTORY_SEPARATOR.$objUserWebsite->getId();
        if(!is_dir($ssWebPath))
        {
        mkdir($ssWebPath, 0777);
        }

        //to create the logo folder
        $ssLogoPath = $ssWebPath.DIRECTORY_SEPARATOR.sfConfig::get("app_LogoPath_LogoPath");
        if(!is_dir($ssLogoPath))
        {
        mkdir($ssLogoPath, 0777);
        }

        $ssDestinationPath = $ssLogoPath.DIRECTORY_SEPARATOR.$ssImageName;
        // to copy the image to destination path
        copy(sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'../images/admin/logo.png', $ssDestinationPath);
        $asOptions[sfConfig::get("app_Color_Logo")] = $ssImageName;
        // End move logo from one folder to another
        }*/

        /* this for loop is for insert blank textwidget */
        /*for($i=1; $i<=$asOptions["TextWidgets"]; $i++)
        {
        $asOptions[sfConfig::get('app_Color_TextWidgets')."_".$i] = "";
        $asOptions[sfConfig::get("app_Color_TextWidgetsTitle")."_".$i] = "";
        }

        unset($asOptions["TextWidgets"]); */
        /* insert record in table */
        foreach($asOptions as $key => $asOption)
        {
            $notRequired = array('Logo', 'TextWidgets','ManageBanner','BannerBackground','BannerForeground');
            if(!in_array($key, $notRequired ))    {
                $oThemeOptions = new ThemeOptions();
                $oThemeOptions->setThemeId($snThemeId[0]["Id"]);
                $oThemeOptions->setWebsiteId($objUserWebsite->getId());
                $oThemeOptions->setOptionKey($key);
                $oThemeOptions->setOptionValue($asOption);
                $oThemeOptions->save();
            }
        }
    } // end of Function


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
        $userName = $users->getFirstName().' '.$users->getLastName();
        if($imageName != "")
        {
            if(file_exists(sfConfig::get('sf_upload_dir')."/userpic/".$userId."/".$prefix."_".$imageName))
            return array('path'=>'../uploads/userpic/'.$userId."/".$prefix."_".$imageName,'title'=>$userName);
            else
            return array('path'=>'user-noImage/'.$prefix.'_noImage.png','title'=>$userName);
        }
        else
        {
            return array('path'=>'user-noImage/'.$prefix.'_noImage.png','title'=>$userName, 'noImage'=>1);
        }
    }

      /**
     * Funcion to Show Rating star
     *
     * @param unknown_type $avgRating
     * @return unknown
     */
    public static function displayRatingStar($avgRating) {
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

    public static function autoSuggestCustomerName()
    {
		$items = array();

        $AutoCom = Doctrine_Query::create()
        ->select('U.Id,U.FirstName,U.LastName,U.Email')
        ->from('Users U')
        ->where('U.Status = ?', sfConfig::get("app_UserStatus_Active"))
        ->andWhere('U.UserType = ?', sfConfig::get("app_UserType_Customer"))
        ->andWhere("U.NetworkProfileSubscription = ?", "Yes")
        ->fetchArray();
        //clsCommon::pr($AutoCom,1);

        foreach ($AutoCom as $key => $value)
        {
            $items[$value['Id']] = $value['FirstName']." ".$value['LastName']." - ".$value["Email"];
        }
        return $items;
    }

    /**
     * Funcion to check data exist or not
     *
     * @param string  $tableName
     * @param integer $id
     * @param integer $websiteId
     * @return boolean
     */
    public static function chkDataExist($tableName, $id, $websiteId)
    {
		if(!is_string($tableName) || !is_numeric($id) || !is_numeric($websiteId))
			return false;

		$data = Doctrine_Query::create()
					->select('*')
					->from("".$tableName." c")
					->where('c.Id = ?', $id)
					->andWhere('c.WebsiteId = ?', $websiteId)
					->fetchArray();

		if(count($data)>0)
			return true;
		else
			return false;
    }
    
    /**
     * Funcion to check data exist or not
     *
     * @param string  $tableName
     * @param unknown_type $field1
     * @param unknown_type $field2
     * @param unknown_type $value1
     * @param unknown_type $value2
     * @return boolean
     */
    public static function chkDataExistOrNot($tableName, $field1, $field2, $value1, $value2)
    {
		$data = Doctrine_Query::create()
					->select('*')
					->from("".$tableName." c")
					->where('c.'.$field1.' = ?', $value1)
					->andWhere('c.'.$field2.' = ?', $value2)
					->fetchArray();

		if(count($data)>0)
			return true;
		else
			return false;
    }
    
    public static function deleteWebsiteFromTable($webisteId)
    {
		if($webisteId != "")
		{
			$oThemeOptions = new ThemeOptions();
			$oThemeOptions->deleteThemeOptionsWebsiteData($webisteId);
			
			$oWebsiteXFAQs = new WebsiteXFAQs();
			$oWebsiteXFAQs->deleteFAQsWebsiteData($webisteId);
			
			$oWebsiteMenu = new WebsiteMenu();
			$oWebsiteMenu->deleteWebsiteMenuData($webisteId);
			
			$oCMSPages = new CMSPages();
			$oCMSPages->deleteCMSPagesWebsiteData($webisteId);
			
			$oWebsitePracticeArea = new WebsitePracticeArea();
			$oWebsitePracticeArea->deleteWebsitePracticeAreaData($webisteId);
			
			$oThemeBanner = new ThemeBanner();
			$oThemeBanner->deleteThemeBannerData($webisteId);
			
			$oUsersWebsite = new UsersWebsite();
			$oUsersWebsite->deleteUsersWebsiteData($webisteId);
			
			$webFolderPath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR."website".DIRECTORY_SEPARATOR.$webisteId;
			
			$oclsCommon = new clsCommon();
			$oclsCommon->rrmdir($webFolderPath);
		}
    }
    
    public function rrmdir($dir) {

	if (is_dir($dir)) {
		$objects = scandir($dir);
		foreach ($objects as $object) {
		if ($object != "." && $object != "..") {
			if (filetype($dir."/".$object) == "dir")
			{
				$oclsCommon = new clsCommon();
				$oclsCommon->rrmdir($dir."/".$object); 
			}
			else unlink   ($dir."/".$object);
		}
		}
		reset($objects);
		rmdir($dir);
	}
 
	}
}