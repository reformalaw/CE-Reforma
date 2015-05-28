<?php
	// http://requestb.in/oivl2woi?inspect
    //$result = file_get_contents('http://requestb.in/oivl2woi');
    //echo $result;
	//die;
?>



<?php

//
$webhookContent = "";

$webhook = fopen('php://input' , 'rb');
while (!feof($webhook)) {
    $webhookContent .= fread($webhook, 4096);
}
fclose($webhook);


$writEfile = fopen('webhook.txt','w+');
fwrite($writEfile,webhookContent);
fclose($writEfile);

//error_log($webhookContent);
?>