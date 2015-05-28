<?php

/**
 * ThemeOptions form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Krunal Nerikar
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ThemeOptionsForm extends BaseThemeOptionsForm
{
    public function configure()
    {
        unset(
        $this["Id"],
        $this["ThemeId"],
        $this["WebsiteId"],
        $this["OptionKey"],
        $this["OptionValue"],
        $this["CreateDateTime"],
        $this["UpdateDateTime"]
        );
        $featureArr = $this->getOption("featureList");

        if ($featureArr['ManageColorAndBackground'] == "Yes") {
            $temp = array_merge(sfConfig::get('app_ThemeOptions_Color'),sfConfig::get('app_ThemeOptions_Image'));
        }
        if ($featureArr['ManageSocialMedia'] == "Yes") {
            $temp = array_merge($temp,sfConfig::get('app_ThemeOptions_SocialMedia'));
        }
        if ($featureArr['ManageChangeLogo'] == "Yes") {
            $temp = array_merge($temp,sfConfig::get('app_ThemeOptions_Logo'));
        }
        if ($featureArr['BodyBackground'] == "Yes") {
            $temp = array_merge($temp,sfConfig::get('app_ThemeOptions_BodyBackground'));
        }
//         if ($featureArr['ManageTextWidget'] == "Yes") {
//             $temp = array_merge($temp,sfConfig::get('app_ThemeOptions_TextWidgets'));
//         }

        //clsCommon::pr($temp,1);
        $widgets = $this->widgetSchema->getFields();
        if ($featureArr['ManageColorAndBackground'] == "Yes") {
            $widgets[$temp['BGColor']]          = new dcWidgetFormColorPicker();
            $widgets[$temp['TextColor']]        = new dcWidgetFormColorPicker();
            $widgets[$temp['BorderColor']]      = new dcWidgetFormColorPicker();
            $widgets[$temp['LinkColor']]        = new dcWidgetFormColorPicker();
            $widgets[$temp['LinkHoverColor']]   = new dcWidgetFormColorPicker();
            $widgets[$temp['BGImage']]          = new sfWidgetFormInputFile();
            $this->setWidgets($widgets);
        }
        if ($featureArr['ManageSocialMedia'] == "Yes") {
            $widgets[$temp['Facebook']]         = new sfWidgetFormInputText();
            $widgets[$temp['Twitter']]          = new sfWidgetFormInputText();
            $widgets[$temp['LinkedIn']]         = new sfWidgetFormInputText();
            $widgets[$temp['Google']]           = new sfWidgetFormInputText();
            $widgets[$temp['Skype']]            = new sfWidgetFormInputText();
            $widgets[$temp['Rss']]              = new sfWidgetFormInputText();
            $this->setWidgets($widgets);
        }
        if ($featureArr['ManageChangeLogo'] == "Yes") {
            $widgets[$temp['Logo']]            = new sfWidgetFormInputFile();
            $this->setWidgets($widgets);
        }

        if ($featureArr['BodyBackground'] == "Yes") {
            $widgets[$temp['BodyBackground']]            = new sfWidgetFormInputFile();
            $this->setWidgets($widgets);
        }
      /*  if ($featureArr['ManageTextWidget'] == "Yes") {
            $widgetLength = ThemeTable::getWidgetLength();
            for ($i=1;$i<($widgetLength+1);$i++)
            {
                $widgets['TextWidgetsTitle'."_".$i]             = new sfWidgetFormInput(array(),array('style'=>'width:250px;'));
                $widgets[$temp['TextWidgets']."_".$i]      = new sfWidgetFormTextarea(array(),array('style'=>'width:244px;'));
            }
            $this->setWidgets($widgets);
        } */
        //clsCommon::pr($temp,1);
        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('theme_options[%s]');
    }
}
