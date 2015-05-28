<?php
set_time_limit(0);
ini_set('memory_limit','-1');

/*******************************
* Symfony settings
*******************************/
require_once(dirname(__FILE__) . '/../config/ProjectConfiguration.class.php');
$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'dev', true);
sfContext::createInstance($configuration);



$userPwd = 'BmAEbANrVjpeKQFiBT8=';
$objPassEncDec = new encryptDecrypt(sfConfig::get('app_pwdEncDecKey'));
echo $password = $objPassEncDec->decrypt($userPwd);



?>