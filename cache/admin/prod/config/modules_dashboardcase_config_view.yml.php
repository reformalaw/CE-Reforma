<?php
// auto-generated by sfViewConfigHandler
// date: 2013/12/17 10:03:51
$response = $this->context->getResponse();


  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());



  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('language', 'en', false, false);
  $response->addMeta('robots', 'index, no-follow', false, false);
  $response->addMeta('title', '..::Counsel Edge::.. Administrator', false, false);

  $response->addStylesheet('admin/Admin.css', '', array ());
  $response->addStylesheet('admin/notification.css', '', array ());
  $response->addStylesheet('admin/paging.css', '', array ());
  $response->addStylesheet('admin/popup.css', '', array ());
  $response->addStylesheet('admin/theme.css', '', array ());
  $response->addStylesheet('jqUi/jquery-ui.css', '', array ());
  $response->addStylesheet('checkboxtree.css', '', array ());
  $response->addStylesheet('admin/lightbox.css', '', array ());
  $response->addStylesheet('admin/jquery.fancybox.css', '', array ());
  $response->addStylesheet('admin/jquery.ui.all.css', '', array ());
  $response->addJavascript('admin/JSCookMenu.js', '', array ());
  $response->addJavascript('admin/theme.js', '', array ());
  $response->addJavascript('admin/AdminCommon.js', '', array ());
  $response->addJavascript('admin/jquery-1.7.1.min.js', '', array ());
  $response->addJavascript('admin/jquery-ui.js', '', array ());
  $response->addJavascript('admin/lightbox.js', '', array ());
  $response->addJavascript('admin/jquery.validate.js', '', array ());
  $response->addJavascript('admin/jquery.fancybox.js', '', array ());
  $response->addJavascript('admin/ui/jquery.ui.core.js', '', array ());
  $response->addJavascript('admin/ui/jquery.ui.widget.js', '', array ());
  $response->addJavascript('admin/ui/jquery.ui.position.js', '', array ());
  $response->addJavascript('admin/ui/jquery.ui.menu.js', '', array ());
  $response->addJavascript('admin/ui/jquery.ui.autocomplete.js', '', array ());
  $response->addJavascript('admin/jquery.checkboxtree.js', '', array ());


