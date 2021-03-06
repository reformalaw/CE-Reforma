<?php

/**
 * ThemeOptionsTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ThemeOptionsTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ThemeOptionsTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('ThemeOptions');
    }

    /**
     * THIS FUNCTION IS USE FOR GETTING THE THEME DETAILS
     *
     * @param unknown_type $themeId
     * @param unknown_type $websiteId
     * @return unknown
     */
    public static function getThemeDetails($themeId,$websiteId)
    {
        $sql = Doctrine_Query::create()
        ->from('ThemeOptions to')
        ->where('to.ThemeId = ?',$themeId)
        ->andWhere('to.WebsiteId = ?',$websiteId)
        ->execute();
        return $sql;
    }

    public static function getOldBGfileName($websiteId)
    {
        $sql = Doctrine_Query::create()
        ->from('ThemeOptions to')
        ->Where('to.WebsiteId = ?',$websiteId)
        ->andWhere('to.OptionKey = ?','BGImage')
        ->andWhere('to.WebsiteId = ?',sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
        ->fetchArray();
        if (isset($sql[0]['OptionValue'])) {
            return $sql[0]['OptionValue'];
        }
    }

    public static function getOldLogofileName($websiteId)
    {
        $sql = Doctrine_Query::create()
        ->from('ThemeOptions to')
        ->Where('to.WebsiteId = ?',$websiteId)
        ->andWhere('to.OptionKey = ?','Logo')
        ->andWhere('to.WebsiteId = ?',sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
        ->fetchArray();
        if (isset($sql[0]['OptionValue'])) {
            return $sql[0]['OptionValue'];
        }
    }

    public static function getOldBodyBackgroundfileName($websiteId)
    {
        $sql = Doctrine_Query::create()
        ->from('ThemeOptions to')
        ->Where('to.WebsiteId = ?',$websiteId)
        ->andWhere('to.OptionKey = ?','BodyBackground')
        ->andWhere('to.WebsiteId = ?',sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
        ->fetchArray();
        if (isset($sql[0]['OptionValue'])) {
            return $sql[0]['OptionValue'];
        }
    }

    public static function updatefileName($bgfileName)
    {
        # THIS IS USE FOR GETTING THEME ID.
        $themeId = UsersWebsiteTable::getThemeId();

        if (!empty($bgfileName) && isset($bgfileName)) {

            # CHECK THAT Logo KEY IS EXIST IN DATABASE OR NOT
            $checkBGImageKey = Doctrine_Core::getTable('ThemeOptions')->findOneBy('OptionKey','BGImage');
            if (is_object($checkBGImageKey)){
                $updateSql = Doctrine_Query::create()
                ->update('ThemeOptions to')
                ->set('to.OptionValue', "'$bgfileName'")
                ->Where('to.WebsiteId = ?',sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
                ->andWhere('to.OptionKey = ?','BGImage')
                ->execute();
            }else {

                #THIS IS USE FOR ADD THE NEW ENTRY.
                $objThemeEntry = new ThemeOptions();
                $objThemeEntry->setThemeId($themeId['ThemeId']);
                $objThemeEntry->setWebsiteId(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'));
                $objThemeEntry->setOptionKey("BGImage");
                $objThemeEntry->setOptionValue($bgfileName);
                $theme_options = $objThemeEntry->save();
            }
        }
    }

    public static function updateBodyBackgroundfileName($BodyBackgroundfileName)
    {
        # THIS IS USE FOR GETTING THEME ID.
        $themeId = UsersWebsiteTable::getThemeId();

        if (!empty($BodyBackgroundfileName) && isset($BodyBackgroundfileName)) {

            # CHECK THAT Logo KEY IS EXIST IN DATABASE OR NOT
            $checkBodyBackgroundImageKey = Doctrine_Core::getTable('ThemeOptions')->findOneBy('OptionKey','BodyBackground');
            if (is_object($checkBodyBackgroundImageKey)){
                $updateSql = Doctrine_Query::create()
                ->update('ThemeOptions to')
                ->set('to.OptionValue', "'$BodyBackgroundfileName'")
                ->Where('to.WebsiteId = ?',sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
                ->andWhere('to.OptionKey = ?','BodyBackground')
                ->execute();
            }else {

                #THIS IS USE FOR ADD THE NEW ENTRY.
                $objThemeEntry = new ThemeOptions();
                $objThemeEntry->setThemeId($themeId['ThemeId']);
                $objThemeEntry->setWebsiteId(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'));
                $objThemeEntry->setOptionKey("BodyBackground");
                $objThemeEntry->setOptionValue($BodyBackgroundfileName);
                $theme_options = $objThemeEntry->save();
            }
        }
    }

    public static function updateLogofileName($LogofileName)
    {
        # THIS IS USE FOR GETTING THEME ID.
        $themeId = UsersWebsiteTable::getThemeId();

        if (!empty($LogofileName) && isset($LogofileName)) {

            # CHECK THAT Logo KEY IS EXIST IN DATABASE OR NOT
            $checkLogoImageKey = Doctrine_Core::getTable('ThemeOptions')->findOneBy('OptionKey','Logo');
            if (is_object($checkLogoImageKey)){
                $updateSql = Doctrine_Query::create()
                ->update('ThemeOptions to')
                ->set('to.OptionValue', "'$LogofileName'")
                ->Where('to.WebsiteId = ?',sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
                ->andWhere('to.OptionKey = ?','Logo')
                ->execute();
            }else {

                #THIS IS USE FOR ADD THE NEW ENTRY.
                $objThemeEntry = new ThemeOptions();
                $objThemeEntry->setThemeId($themeId['ThemeId']);
                $objThemeEntry->setWebsiteId(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'));
                $objThemeEntry->setOptionKey("Logo");
                $objThemeEntry->setOptionValue($LogofileName);
                $theme_options = $objThemeEntry->save();
            }
        }
    }

    public static function getEditArray($websiteId)
    {
        $sql = Doctrine_Query::create()
        ->from('ThemeOptions to')
        ->Where('to.WebsiteId = ?',$websiteId)
        ->fetchArray();
        //clsCommon::pr($sql,1);
        $returnEditArr = array();
        for ($i=0;$i<count($sql);$i++)
        {
            $returnEditArr[$sql[$i]['OptionKey']] = $sql[$i]['OptionValue'];
        }
        #clsCommon::pr($returnEditArr,1);
        return $returnEditArr;
    }

	public static function updateTextWidget($options)
	{
		# THIS IS USE FOR GETTING THEME ID.
        $themeId = UsersWebsiteTable::getThemeId();
        #THIS IS USE FOR GETTING FEATURE LIST ARRAY()
        $featureListArr = UsersWebsiteTable::getThemeFeatureList();

        $update = Doctrine_Query::create()
        ->update('ThemeOptions topt');

        if ($featureListArr['ManageTextWidget'] == "Yes") {
            $widgetLength = ThemeTable::getWidgetLength();
            for ($i=1;$i<($widgetLength+1);$i++)
            {
                if (array_key_exists("TextWidgetsTitle_".$i,$options) && (array_key_exists("TextWidgets_".$i,$options))) {

                /* START LINK */
                // here we explode the value of combobox of textwidget page
				$valueLinkTypes =  $options["TextWidgetsLinkType_".$i];
				$optionKeyTextWidgetsLinkType = "TextWidgetsLinkType_".$i;
				$optionKeyTextWidgetsLinkId = "TextWidgetsLinkId_".$i;
				if($valueLinkTypes != "")
				{
					$valueLinkTypeArray = explode("_", $valueLinkTypes);

					// we set the OptionKey and OptionValue of TextWidgetsLinkType
					$optionValueTextWidgetsLinkType = $valueLinkTypeArray[0];
					// we set the OptionKey and OptionValue of TextWidgetsLinkId
					$optionValueTextWidgetsLinkId = $valueLinkTypeArray[1];
				}
				else
				{
					$optionValueTextWidgetsLinkType = "''";
					$optionValueTextWidgetsLinkId = "''";
				}
					
					$checkLinkTypeKey = ThemeOptionsTable::checkDataExistOrNot(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'),$optionKeyTextWidgetsLinkType);
					$checkLinkIdKey = ThemeOptionsTable::checkDataExistOrNot(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'),$optionKeyTextWidgetsLinkId);

					if (($checkLinkTypeKey == true) && ($checkLinkIdKey == true)){

						$update->set('topt.OptionValue', $optionValueTextWidgetsLinkType)
						->where('topt.OptionKey = ?', $optionKeyTextWidgetsLinkType)
						->andWhere('topt.WebsiteId = ?', sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
						->execute();

						$update->set('topt.OptionValue', $optionValueTextWidgetsLinkId)
						->where('topt.OptionKey = ?',$optionKeyTextWidgetsLinkId)
						->andWhere('topt.WebsiteId = ?', sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
						->execute();
					}
					else
					{
						#THIS IS USE FOR ADD THE NEW ENTRY.
						$objThemeTitle = new ThemeOptions();
						$objThemeTitle->setThemeId($themeId['ThemeId']);
						$objThemeTitle->setWebsiteId(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'));
						$objThemeTitle->setOptionKey($optionKeyTextWidgetsLinkType);
						$objThemeTitle->setOptionValue($optionValueTextWidgetsLinkType);
						$objThemeTitle->save();

						$objThemeText = new ThemeOptions();
						$objThemeText->setThemeId($themeId['ThemeId']);
						$objThemeText->setWebsiteId(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'));
						$objThemeText->setOptionKey($optionKeyTextWidgetsLinkId);
						$objThemeText->setOptionValue($optionValueTextWidgetsLinkId);
						$objThemeText->save();
					}
				
				/* END LINK */

                    $tempTitle = "TextWidgetsTitle_".$i;
                    $tempText = "TextWidgets_".$i;

                    $title = $options[$tempTitle];
                    $text = $options[$tempText];

                    $checkTitleKey = ThemeOptionsTable::checkDataExistOrNot(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'),$tempTitle);
                    $checkTextKey = ThemeOptionsTable::checkDataExistOrNot(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'),$tempText);

                    if (($checkTitleKey == true) && ($checkTextKey == true)){

                        $update->set('topt.OptionValue','"'.$title.'"')
                        ->where('topt.OptionKey = ?',$tempTitle)
                        ->andWhere('topt.WebsiteId = ?',sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
                        ->execute();

                        $update->set('topt.OptionValue','"'.addslashes($text).'"')
                        ->where('topt.OptionKey = ?',$tempText)
                        ->andWhere('topt.WebsiteId = ?',sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
                        ->execute();
                    }else {

                        #THIS IS USE FOR ADD THE NEW ENTRY.
                        $objThemeTitle = new ThemeOptions();
                        $objThemeTitle->setThemeId($themeId['ThemeId']);
                        $objThemeTitle->setWebsiteId(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'));
                        $objThemeTitle->setOptionKey($tempTitle);
                        $objThemeTitle->setOptionValue($title);
                        $objThemeTitle->save();

                        $objThemeText = new ThemeOptions();
                        $objThemeText->setThemeId($themeId['ThemeId']);
                        $objThemeText->setWebsiteId(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'));
                        $objThemeText->setOptionKey($tempText);
                        $objThemeText->setOptionValue($text);
                        $objThemeText->save();
                    }
                }
            }
        }

	}
    /**
     * THIS FUNCTION IS USE FOR UPDATE THE THEME OPTION TABLE'S VALUES
     *
     * @param unknown_type $options
     */
    public static function updateRecord($options)
    {
        #clsCommon::pr($options);
        $bgColor    = "#".$options['BGColor']; #THIS VARIABLE IS USE FOR STORE THE BACKGROUND COLOR
        $tColor     = "#".$options['TextColor']; # THIS VARIABLE IS USE FOR STORE THE TEXT COLOR
        $bColor     = "#".$options['BorderColor']; # THIS VARIABLE IS USE FOR STORE THE BORDER COLOR
        $lColor     = "#".$options['LinkColor']; # THIS VARIABLE IS USE FOR STORE THE BORDER COLOR
        $lhColor    = "#".$options['LinkHoverColor']; # THIS VARIABLE IS USE FOR STORE THE BORDER COLOR

        $fbMedia = $options['Facebook']; # THIS VARIALBE IS USE TO STORE THE FACEBOOK MEDIA NAME
        $twMedia = $options['Twitter']; # THIS VARIALBE IS USE TO STORE THE TWITTER MEDIA NAME
        $liMedia = $options['LinkedIn']; # THIS VARIALBE IS USE TO STORE THE LINKEDIN MEDIA NAME
        $goMedia = $options['Google']; # THIS VARIALBE IS USE TO STORE THE GOOGLE MEDIA NAME
        $skMedia = $options['Skype']; # THIS VARIALBE IS USE TO STORE THE SKYPE MEDIA NAME
        $rssMedia = $options['Rss']; # THIS VARIALBE IS USE TO STORE THE RSS MEDIA NAME

        # THIS IS USE FOR GETTING THEME ID.
        $themeId = UsersWebsiteTable::getThemeId();
        #THIS IS USE FOR GETTING FEATURE LIST ARRAY()
        $featureListArr = UsersWebsiteTable::getThemeFeatureList();
        #clsCommon::pr($featureListArr,1);

        $update = Doctrine_Query::create()
        ->update('ThemeOptions topt');

       /* if ($featureListArr['ManageTextWidget'] == "Yes") {
            $widgetLength = ThemeTable::getWidgetLength();
            for ($i=1;$i<($widgetLength+1);$i++)
            {
                if (array_key_exists("TextWidgetsTitle_".$i,$options) && (array_key_exists("TextWidgets_".$i,$options))) {

                    $tempTitle = "TextWidgetsTitle_".$i;
                    $tempText = "TextWidgets_".$i;

                    $title = $options[$tempTitle];
                    $text = $options[$tempText];

                    # $checkTitleKey = Doctrine_Core::getTable('ThemeOptions')->findOneBy('OptionKey',$tempTitle);
                    # $checkTextKey = Doctrine_Core::getTable('ThemeOptions')->findOneBy('OptionKey',$tempText);
                    $checkTitleKey = ThemeOptionsTable::checkDataExistOrNot(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'),$tempTitle);
                    $checkTextKey = ThemeOptionsTable::checkDataExistOrNot(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'),$tempText);
                    if (($checkTitleKey == true) && ($checkTextKey == true)){

                        #THIS IS UPDATE QUERY FOR BACKGROUND COLOR
                        $update->set('topt.OptionValue','"'.$title.'"')
                        ->where('topt.OptionKey = ?',$tempTitle)
                        ->andWhere('topt.WebsiteId = ?',sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
                        ->execute();

                        #THIS IS UPDATE QUERY FOR BACKGROUND COLOR
                        #$update->set('topt.OptionValue','"'.$text.'"')
                        $update->set('topt.OptionValue','"'.addslashes($text).'"')
                        ->where('topt.OptionKey = ?',$tempText)
                        ->andWhere('topt.WebsiteId = ?',sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
                        ->execute();
                    }else {

                        #THIS IS USE FOR ADD THE NEW ENTRY.
                        $objThemeTitle = new ThemeOptions();
                        $objThemeTitle->setThemeId($themeId['ThemeId']);
                        $objThemeTitle->setWebsiteId(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'));
                        $objThemeTitle->setOptionKey($tempTitle);
                        $objThemeTitle->setOptionValue($title);
                        $objThemeTitle->save();

                        $objThemeText = new ThemeOptions();
                        $objThemeText->setThemeId($themeId['ThemeId']);
                        $objThemeText->setWebsiteId(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'));
                        $objThemeText->setOptionKey($tempText);
                        $objThemeText->setOptionValue($text);
                        $objThemeText->save();
                    }
                }
            }
        }*/

        if ($featureListArr['ManageColorAndBackground'] == "Yes"){

            if (!empty($bgColor) && isset($bgColor)) {

                # CHECK THAT BGCOLOR KEY IS EXIST IN DATABASE OR NOT
                # $checkBGColorKey = Doctrine_Core::getTable('ThemeOptions')->findOneBy('OptionKey','BGColor');
                $checkBGColorKey = ThemeOptionsTable::checkDataExistOrNot(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'),'BGColor');
                if ($checkBGColorKey == true){

                    #THIS IS UPDATE QUERY FOR BACKGROUND COLOR
                    $update->set('topt.OptionValue',"'$bgColor'")
                    ->where('topt.OptionKey = ?','BGColor')
                    ->andWhere('topt.WebsiteId = ?',sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
                    ->execute();

                }else {

                    #THIS IS USE FOR ADD THE NEW ENTRY.
                    $objThemeEntry = new ThemeOptions();
                    $objThemeEntry->setThemeId($themeId['ThemeId']);
                    $objThemeEntry->setWebsiteId(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'));
                    $objThemeEntry->setOptionKey("BGColor");
                    $objThemeEntry->setOptionValue($bgColor);
                    $theme_options = $objThemeEntry->save();
                }
            }


            if (!empty($tColor) && isset($tColor)) {

                # CHECK THAT TEXTCOLOR KEY IS EXIST IN DATABASE OR NOT
                # $checkTextColorKey = Doctrine_Core::getTable('ThemeOptions')->findOneBy('OptionKey','TextColor');
                $checkTextColorKey = ThemeOptionsTable::checkDataExistOrNot(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'),'TextColor');
                if ($checkTextColorKey == true){

                    #THIS IS UPDATE QUERY FOR TEXT COLOR
                    $update->set('topt.OptionValue',"'$tColor'")
                    ->where('topt.OptionKey = ?','TextColor')
                    ->andWhere('topt.WebsiteId = ?',sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
                    ->execute();

                }else {

                    #THIS IS USE FOR ADD THE NEW ENTRY.
                    $objThemeEntry = new ThemeOptions();
                    $objThemeEntry->setThemeId($themeId['ThemeId']);
                    $objThemeEntry->setWebsiteId(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'));
                    $objThemeEntry->setOptionKey("TextColor");
                    $objThemeEntry->setOptionValue($tColor);
                    $theme_options = $objThemeEntry->save();
                }
            }

            if (!empty($bColor) && isset($bColor)) {

                # CHECK THAT BORDERCOLOR KEY IS EXIST IN DATABASE OR NOT
                # $checkBorderColorKey = Doctrine_Core::getTable('ThemeOptions')->findOneBy('OptionKey','BorderColor');
                $checkBorderColorKey = ThemeOptionsTable::checkDataExistOrNot(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'),'BorderColor');
                if ($checkBorderColorKey == true){

                    #THIS IS UPDATE QUERY FOR BORDER COLOR
                    $update->set('topt.OptionValue',"'$bColor'")
                    ->where('topt.OptionKey = ?','BorderColor')
                    ->andWhere('topt.WebsiteId = ?',sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
                    ->execute();

                }else {

                    #THIS IS USE FOR ADD THE NEW ENTRY.
                    $objThemeEntry = new ThemeOptions();
                    $objThemeEntry->setThemeId($themeId['ThemeId']);
                    $objThemeEntry->setWebsiteId(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'));
                    $objThemeEntry->setOptionKey("BorderColor");
                    $objThemeEntry->setOptionValue($bColor);
                    $theme_options = $objThemeEntry->save();
                }
            }

            if (!empty($lColor) && isset($lColor)) {

                # CHECK THAT BORDERCOLOR KEY IS EXIST IN DATABASE OR NOT
                # $checkLinkColorKey = Doctrine_Core::getTable('ThemeOptions')->findOneBy('OptionKey','LinkColor');
                $checkLinkColorKey = ThemeOptionsTable::checkDataExistOrNot(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'),'LinkColor');
                if ($checkLinkColorKey == true){

                    #THIS IS UPDATE QUERY FOR BORDER COLOR
                    $update->set('topt.OptionValue',"'$lColor'")
                    ->where('topt.OptionKey = ?','LinkColor')
                    ->andWhere('topt.WebsiteId = ?',sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
                    ->execute();

                }else {

                    #THIS IS USE FOR ADD THE NEW ENTRY.
                    $objThemeEntry = new ThemeOptions();
                    $objThemeEntry->setThemeId($themeId['ThemeId']);
                    $objThemeEntry->setWebsiteId(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'));
                    $objThemeEntry->setOptionKey("LinkColor");
                    $objThemeEntry->setOptionValue($lColor);
                    $theme_options = $objThemeEntry->save();
                }
            }

            if (!empty($lhColor) && isset($lhColor)) {

                # CHECK THAT BORDERCOLOR KEY IS EXIST IN DATABASE OR NOT
                # $checkLHColorKey = Doctrine_Core::getTable('ThemeOptions')->findOneBy('OptionKey','LinkHoverColor');
                $checkLHColorKey = ThemeOptionsTable::checkDataExistOrNot(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'),'LinkHoverColor');
                if ($checkLHColorKey == true){

                    #THIS IS UPDATE QUERY FOR BORDER COLOR
                    $update->set('topt.OptionValue',"'$lhColor'")
                    ->where('topt.OptionKey = ?','LinkHoverColor')
                    ->andWhere('topt.WebsiteId = ?',sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
                    ->execute();

                }else {

                    #THIS IS USE FOR ADD THE NEW ENTRY.
                    $objThemeEntry = new ThemeOptions();
                    $objThemeEntry->setThemeId($themeId['ThemeId']);
                    $objThemeEntry->setWebsiteId(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'));
                    $objThemeEntry->setOptionKey("LinkHoverColor");
                    $objThemeEntry->setOptionValue($lhColor);
                    $theme_options = $objThemeEntry->save();
                }
            }
        }

        if ($featureListArr['ManageSocialMedia'] == "Yes"){

            if (isset($fbMedia)) {

                # CHECK THAT FACEBOOK KEY IS EXIST IN DATABASE OR NOT
                #$checkFBKey = Doctrine_Core::getTable('ThemeOptions')->findOneBy('OptionKey','Facebook');
                $checkFBKey = ThemeOptionsTable::checkDataExistOrNot(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'),'Facebook');
                if ($checkFBKey == true){

                    #THIS IS UPDATE QUERY FOR FACEBOOK MEDIA
                    $update->set('topt.OptionValue',"'$fbMedia'")
                    ->where('topt.OptionKey = ?','Facebook')
                    ->andWhere('topt.WebsiteId = ?',sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
                    ->execute();

                }else {

                    #THIS IS USE FOR ADD THE NEW ENTRY.
                    $objThemeEntry = new ThemeOptions();
                    $objThemeEntry->setThemeId($themeId['ThemeId']);
                    $objThemeEntry->setWebsiteId(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'));
                    $objThemeEntry->setOptionKey("Facebook");
                    $objThemeEntry->setOptionValue($fbMedia);
                    $theme_options = $objThemeEntry->save();
                }
            }

            if (isset($twMedia)) {

                # CHECK THAT Twitter KEY IS EXIST IN DATABASE OR NOT
                # $checkTWKey = Doctrine_Core::getTable('ThemeOptions')->findOneBy('OptionKey','Twitter');
                $checkTWKey = ThemeOptionsTable::checkDataExistOrNot(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'),'Twitter');
                if ($checkTWKey == true){

                    #THIS IS UPDATE QUERY FOR Twitter MEDIA
                    $update->set('topt.OptionValue',"'$twMedia'")
                    ->where('topt.OptionKey = ?','Twitter')
                    ->andWhere('topt.WebsiteId = ?',sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
                    ->execute();

                }else {

                    #THIS IS USE FOR ADD THE NEW ENTRY.
                    $objThemeEntry = new ThemeOptions();
                    $objThemeEntry->setThemeId($themeId['ThemeId']);
                    $objThemeEntry->setWebsiteId(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'));
                    $objThemeEntry->setOptionKey("Twitter");
                    $objThemeEntry->setOptionValue($twMedia);
                    $theme_options = $objThemeEntry->save();
                }
            }


            if (isset($liMedia)) {
                # CHECK THAT LinkedIn KEY IS EXIST IN DATABASE OR NOT
                # $checkLIKey = Doctrine_Core::getTable('ThemeOptions')->findOneBy('OptionKey','LinkedIn');
                $checkLIKey = ThemeOptionsTable::checkDataExistOrNot(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'),'LinkedIn');
                if ($checkLIKey == true){

                    #THIS IS UPDATE QUERY FOR LinkedIn MEDIA
                    $update->set('topt.OptionValue',"'$liMedia'")
                    ->where('topt.OptionKey = ?','LinkedIn')
                    ->andWhere('topt.WebsiteId = ?',sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
                    ->execute();
                }else {

                    #THIS IS USE FOR ADD THE NEW ENTRY.
                    $objThemeEntry = new ThemeOptions();
                    $objThemeEntry->setThemeId($themeId['ThemeId']);
                    $objThemeEntry->setWebsiteId(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'));
                    $objThemeEntry->setOptionKey("LinkedIn");
                    $objThemeEntry->setOptionValue($liMedia);
                    $theme_options = $objThemeEntry->save();
                }
            }

            if (isset($goMedia)) {

                # CHECK THAT Google KEY IS EXIST IN DATABASE OR NOT
                # $checkGOKey = Doctrine_Core::getTable('ThemeOptions')->findOneBy('OptionKey','Google');
                $checkGOKey = ThemeOptionsTable::checkDataExistOrNot(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'),'Google');
                if ($checkGOKey == true){

                    #THIS IS UPDATE QUERY FOR Google MEDIA
                    $update->set('topt.OptionValue',"'$goMedia'")
                    ->where('topt.OptionKey = ?','Google')
                    ->andWhere('topt.WebsiteId = ?',sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
                    ->execute();
                }else {

                    #THIS IS USE FOR ADD THE NEW ENTRY.
                    $objThemeEntry = new ThemeOptions();
                    $objThemeEntry->setThemeId($themeId['ThemeId']);
                    $objThemeEntry->setWebsiteId(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'));
                    $objThemeEntry->setOptionKey("Google");
                    $objThemeEntry->setOptionValue($goMedia);
                    $theme_options = $objThemeEntry->save();
                }
            }

            if (isset($skMedia)) {

                # CHECK THAT Skype KEY IS EXIST IN DATABASE OR NOT
                # $checkSKKey = Doctrine_Core::getTable('ThemeOptions')->findOneBy('OptionKey','Skype');
                $checkSKKey = ThemeOptionsTable::checkDataExistOrNot(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'),'Skype');
                if ($checkSKKey == true){

                    #THIS IS UPDATE QUERY FOR Skype MEDIA
                    $update->set('topt.OptionValue',"'$skMedia'")
                    ->where('topt.OptionKey = ?','Skype')
                    ->andWhere('topt.WebsiteId = ?',sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
                    ->execute();
                }else {

                    #THIS IS USE FOR ADD THE NEW ENTRY.
                    $objThemeEntry = new ThemeOptions();
                    $objThemeEntry->setThemeId($themeId['ThemeId']);
                    $objThemeEntry->setWebsiteId(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'));
                    $objThemeEntry->setOptionKey("Skype");
                    $objThemeEntry->setOptionValue($skMedia);
                    $theme_options = $objThemeEntry->save();
                }
            }

            if (isset($rssMedia)) {

                # CHECK THAT Skype KEY IS EXIST IN DATABASE OR NOT
                # $checkRssKey = Doctrine_Core::getTable('ThemeOptions')->findOneBy('OptionKey','Rss');
                $checkRssKey = ThemeOptionsTable::checkDataExistOrNot(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'),'Rss');
                if ($checkRssKey == true){

                    #THIS IS UPDATE QUERY FOR Skype MEDIA
                    $update->set('topt.OptionValue',"'$rssMedia'")
                    ->where('topt.OptionKey = ?','Rss')
                    ->andWhere('topt.WebsiteId = ?',sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'))
                    ->execute();
                }else {

                    #THIS IS USE FOR ADD THE NEW ENTRY.
                    $objThemeEntry = new ThemeOptions();
                    $objThemeEntry->setThemeId($themeId['ThemeId']);
                    $objThemeEntry->setWebsiteId(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'));
                    $objThemeEntry->setOptionKey("Rss");
                    $objThemeEntry->setOptionValue($rssMedia);
                    $theme_options = $objThemeEntry->save();
                }
            }
        }
    }

    /**
     * Function to Get Theme Options in array
     *
     */
    public static function getThemeOptions($websiteId) {

        $sql = Doctrine_Query::create()
        ->from('ThemeOptions to')
        ->where('to.WebsiteId = ?', $websiteId);
        $result =  $sql->fetchArray();
        $optionsArr = array();

        for ($i=0; $i<count($result) ; $i++) {
            $optionsArr[$result[$i]['OptionKey']] = $result[$i]['OptionValue']  ;
        } // End of For Loop
        #clsCommon::pr($result);
        #clsCommon::pr($optionsArr);
        return $optionsArr ;
    } // End of Function

    /**
     * this function is use for media is exist for particular website or not.
     *
     * @param unknown_type $webId
     * @param unknown_type $OptionKey
     * @return bolean
     */
    public static function checkDataExistOrNot($webId,$OptionKey){
        $sql = Doctrine_Query::create()
        ->from('ThemeOptions to')
        ->where('to.WebsiteId = ?',$webId)
        ->andWhere('to.OptionKey = ?',$OptionKey);
        $resultSql = $sql->fetchArray();

        $sql->free();
        //echo count($resultEmail);die;
        if (count($resultSql) == 1) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * this function is use for get the value of link
     *
     * @param unknown_type $webId
     * @param unknown_type $OptionKey
     * @return bolean
     */
    public static function getTextWidgetLinkValues($webId,$OptionKey){
        $sql = Doctrine_Query::create()
        ->from('ThemeOptions to')
        ->where('to.WebsiteId = ?',$webId)
        ->andWhere('to.OptionKey = ?',$OptionKey);
        $resultSql = $sql->fetchArray();
		return $resultSql;
    }

    /**
     * Function to check whether Text Widget Exist or not
     *
     * @param unknown_type $websiteId
     * @param unknown_type $no
     */
    public static function checkTextWidgetExist($websiteId, $no )    {
        $sql = Doctrine_Query::create()
        ->from('ThemeOptions to')
        ->where('to.WebsiteId = ?',$websiteId)
        ->andWhere('to.OptionKey = ?','TextWidgets_'.$no);
        $widgetCount = $sql->count();
        $sql->free();
        if($widgetCount > 0)
        return true;
        else
        return false;

    } // end of Function

    /**
     * Function to check whether Body Background Exist or not
     *
     * @param unknown_type $websiteId
     */
    public static function checkBodyBackgroundExist($websiteId)    {
        $sql = Doctrine_Query::create()
        ->from('ThemeOptions to')
        ->where('to.WebsiteId = ?',$websiteId)
        ->andWhere('to.OptionKey = ?','BodyBackground')
        ->fetchArray();

        if(count($sql) > 0)
			return false;
        else
			return true;
			
    }
}