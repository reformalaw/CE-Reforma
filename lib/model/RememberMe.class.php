<?php
/*******************************************************************************
* RememberMe
* @author     		Chintan Fadia
* @email	   	    chintan.fadia@brainvire.com
* @version    		1.0
* @package    		counceledge
* @Description     Remember Me Feature for User/Admin
*******************************************************************************/
class RememberMe{
    public static function setRemember($email,$password,$isAdmin = false){
        $time = time()+(3600*24*7);
        
        /*Code added for work with admin and user login Start*/
        $prefix = "";
        if($isAdmin){
            $prefix="_admin";
        }
        /*Code added for work with admin and user login End*/
        $encEmail = base64_encode($email);
        $encPassword = base64_encode($password);

        sfContext::getInstance()->getResponse()->setCookie('counceledge_auth_email'.$prefix,$encEmail,$time);
        sfContext::getInstance()->getResponse()->setCookie('counceledge_auth_pass'.$prefix,$encPassword,$time);
    }
    public static function autoLogin($isAdmin=false){
        /*Code added for work with admin and user login Start*/
        $prefix = "";
        if($isAdmin){
            $prefix="_admin";
        }
        /*Code added for work with admin and user login End*/
        $cookieEmail = sfContext::getInstance()->getRequest()->getCookie('counceledge_auth_email'.$prefix);
        $cookiePassword = sfContext::getInstance()->getRequest()->getCookie('counceledge_auth_pass'.$prefix);

        if(!empty($cookieEmail) && !empty($cookiePassword)){
            $decEmail = base64_decode($cookieEmail);
            $decPassword = base64_decode($cookiePassword);

            if(isset($decEmail) && isset($decPassword)){
                if($isAdmin){
                	//echo "ll"; exit;
                    if(!Users::checkAdminLogin($decEmail, $decPassword)){
                        RememberMe::removeRemember($isAdmin);
                    }
                }/*else{
                    list($responce, $user) = Users::checkUserLogin($decEmail,$decPassword);
                    if($responce['status']!="SUCCESS"){
                        RememberMe::removeRemember($isAdmin);
                    }
                }*/
            }else{
                RememberMe::removeRemember($isAdmin);
            }
        }
    }
    
    public static function removeRemember($isAdmin = false){
        /*Code added for work with admin and user login Start*/
        $prefix = "";
        if($isAdmin){
            $prefix="_admin";
        }
        /*Code added for work with admin and user login End*/
        sfContext::getInstance()->getResponse()->setCookie('counceledge_auth_email'.$prefix,"", -(time()+3600));
        sfContext::getInstance()->getResponse()->setCookie('counceledge_auth_pass'.$prefix,"", -(time()+3600));
    }
}
