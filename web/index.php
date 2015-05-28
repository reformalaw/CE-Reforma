<!--<html>
<body>
<p>
<a href="http://www.counseledge.com/admin.php">
<img src="images/button-client-login.jpg" alt="Login"></a></p>
<p><img src="images/undercs.jpg" alt="Coming Soon" height="399" width="600" ></p>
</body>
</html>-->

<?php

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php'); //require of Sf

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'prod', false);
sfContext::createInstance($configuration)->dispatch(); 