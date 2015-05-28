<?php

/**
 * ThemeTextWidget form.
 *
 * @package    counceledge
 * @subpackage form
 * @author     Krunal Nerikar
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ThemeTextWidgetForm extends BaseThemeOptionsForm
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
        $webId = $this->getOption("webId");


        if ($featureArr['ManageTextWidget'] == "Yes") {
            $temp = sfConfig::get('app_ThemeOptions_TextWidgets');

            $cmsOption = array();
			$cmsValues = Doctrine_Query::create()->select('C.Id, C.Title')->from('CMSPages C')->where('C.WebsiteId = ?',$webId)->andWhere('C.Status = ?','Active')->fetchArray();
			foreach($cmsValues as $cmsValue)
			{
				$cmsOption["1_".$cmsValue["Id"]] = $cmsValue["Title"];
			}

			$practiceareaOption = array();
			$practiceareaValues = Doctrine_Query::create()->select('WP.Id, WP.Title')->from('WebsitePracticeArea WP')->where('WP.WebsiteId = ?',$webId)->andWhere('WP.Status = ?','Active')->fetchArray();
			foreach($practiceareaValues as $practiceareaValue)
			{
				$practiceareaOption["2_".$practiceareaValue["Id"]] = $practiceareaValue["Title"];
			}

        }

        $widgets = $this->widgetSchema->getFields();

        if ($featureArr['ManageTextWidget'] == "Yes") {
			
			$choices = array(''=> 'Select',
						'CMSPages'  => $cmsOption,
						'Practice Area' => $practiceareaOption,
					);

            $widgetLength = ThemeTable::getWidgetLength();
            for ($i=1;$i<($widgetLength+1);$i++)
            {
                $widgets['TextWidgetsTitle'."_".$i]             = new sfWidgetFormInput(array(),array('style'=>'width:250px;'));
                $widgets[$temp['TextWidgets']."_".$i]      = new sfWidgetFormTextarea(array(),array('style'=>'width:244px;'));
                $widgets["TextWidgetsLinkType"."_".$i] = new sfWidgetFormChoice(array('multiple' => false,'choices' => $choices,'expanded' => false));
            }

            $this->setWidgets($widgets);
        }

		

		
        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('theme_text_widget[%s]');
    }
}
