<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
    public function setup()
    {
        $this->enablePlugins('sfDoctrinePlugin');
        $this->enablePlugins('sfThumbnailPlugin');
        $this->enablePlugins('sfFCKEditorPlugin');
        $this->enablePlugins('sfTCPDFPlugin');
        $this->enablePlugins('dcWidgetColorPickerPlugin');
        $this->enablePlugins('sfJqueryReloadedPlugin');
        $this->enablePlugins('sfCryptoCaptchaPlugin');
    }
}
