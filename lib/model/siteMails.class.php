<?php

/**
 * Site Mails.
 *
 * @package    counceledge
 * @subpackage lib
 * @author     Chintan Fadia
 * @version    SVN: $Id: siteMails.class.php 12479 2010-09-16 10:54:40Z fabien $
 */
class siteMails{
    protected $mailer;
    protected $charSet;
    protected $contentType;
    protected $senderEmail;
    protected $senderLabel;
    protected $fromEmail;
    protected $fromLabel;
    protected $replyTo;
    protected $toAddress;
    protected $subject;
    protected $body;

    public function __construct(){
        $this->mailer = 'sentmail';
        $this->charSet = 'utf-8';
        $this->contentType = 'text/html';
        //$this->senderEmail = 'network@counceledge.com';
        //$this->senderLabel = 'counceledge';
        $this->fromEmail = "";
        $this->fromLabel = "";
        $this->replyTo = '';
        $this->toAddress = '';
        $this->subject = '';
        $this->body = '';


    }
    /**
	*Send Email Master Function
	*/
    public function sendSfMail(){
        if(sfConfig::get('app_smtp_flag') == 'On'){
            //COMMENT : Create the Transport
            $transport = Swift_SmtpTransport::newInstance(sfConfig::get('app_smtp_host'), sfConfig::get('app_smtp_port'), sfConfig::get('app_smtp_security'))
            ->setUsername(sfConfig::get('app_smtp_username'))
            ->setPassword(sfConfig::get('app_smtp_password'));
        } else {
            //COMMENT : Create the Transport
            $transport = Swift_MailTransport::newInstance();
        }



        //COMMENT : CREATE THE MAILER USING ABOVE CREATED TRANSPORT
        $mailer = Swift_Mailer::newInstance($transport);

        // COMMENT : Replace Common Variable
        $SITE_URL = clsCommon::getSystemConfigVars('SITE_URL');
        $supportEmail = clsCommon::getSystemConfigVars('SUPPORT_EMAIL');
        $SITE_NAME = clsCommon::getSystemConfigVars('SITE_NAME');
        $this->fromEmail = clsCommon::getSystemConfigVars('SITE_EMAIL_FROM');
        $this->fromLabel = clsCommon::getSystemConfigVars('SITE_EMAIL_FROM_LABEL');

        /*$SITE_URL = 'http://vcdev.demo.brainvire.com';
        $supportEmail = 'support@counceledge.com';
        $SITE_NAME = 'counceledge';
        $this->fromEmail = 'no-reply@counceledge.com';
        $this->fromLabel = 'counceledge';*/


        $this->body = preg_replace('/##SITE_URL##/', $SITE_URL, $this->body);
        $this->body = preg_replace('/##SUPPORT_EMAIL##/', $supportEmail, $this->body);
        $this->body = preg_replace('/##SITE_NAME##/', $SITE_NAME, $this->body);
        /*echo $this->subject; */
        #echo $this->body; die;
        //Create a message
        $message = Swift_Message::newInstance($this->subject)
        ->setFrom(array($this->fromEmail=>$this->fromLabel))
        ->setTo($this->toAddress)
        ->addPart($this->body, $this->contentType);
        //Send the message

        return $mailer->send($message);
    }

    /**
	*Send Email Master Function
	*/
    public function sendPersonalWebsiteMail(){

        if(sfConfig::get('app_smtp_flag') == 'On'){
            //COMMENT : Create the Transport
            $transport = Swift_SmtpTransport::newInstance(sfConfig::get('app_smtp_host'), sfConfig::get('app_smtp_port'), sfConfig::get('app_smtp_security'))
            ->setUsername(sfConfig::get('app_smtp_username'))
            ->setPassword(sfConfig::get('app_smtp_password'));
        } else {
            //COMMENT : Create the Transport
            $transport = Swift_MailTransport::newInstance();
        }

        //COMMENT : CREATE THE MAILER USING ABOVE CREATED TRANSPORT
        $mailer = Swift_Mailer::newInstance($transport);

        // COMMENT : Replace Common Variable
        /*$SITE_URL = clsCommon::getSystemConfigVars('SITE_URL');
        $supportEmail = clsCommon::getSystemConfigVars('SUPPORT_EMAIL');
        $SITE_NAME = clsCommon::getSystemConfigVars('SITE_NAME');
        $this->fromEmail = clsCommon::getSystemConfigVars('SITE_EMAIL_FROM');
        $this->fromLabel = clsCommon::getSystemConfigVars('SITE_EMAIL_FROM_LABEL'); */

        /*$this->body = preg_replace('/##SITE_URL##/', $SITE_URL, $this->body);
        $this->body = preg_replace('/##SUPPORT_EMAIL##/', $supportEmail, $this->body);
        $this->body = preg_replace('/##SITE_NAME##/', $SITE_NAME, $this->body);
        */

        /*echo $this->subject;
        echo $this->body; die;*/
        //Create a message
        $message = Swift_Message::newInstance($this->subject)
        ->setFrom(array($this->fromEmail=>$this->fromLabel))
        ->setTo($this->toAddress)
        ->addPart($this->body, $this->contentType);
        //Send the message

        return $mailer->send($message);
    }


    // COMMENT : METHOD TO SEND REGISTRATION MAIL WITH ACTIVATION LINK
    public function sendRegistrationEmail($arrParams = array()){
        //COMMENT : RETURN FALSE IF ANY OF THE REQUIRED VARIABLE NOT FOUND
        if(empty($arrParams['toEmailAddress']))
        return false;
        if(empty($arrParams['FirstName']))
        return false;
        if(empty($arrParams['ActivationKey']))
        return false;
        if(empty($arrParams['UserId']))
        return false;

        //COMMENT :  LOAD THE HELPER
        sfProjectConfiguration::getActive()->loadHelpers(Array('Url', 'Tag'));

        //COMMENT : CREATE THE OBJECT FOR THE SITE MAIL CLASS WITH ACTIAVTION MAIL FORMAT.
        $objSiteEmails = clsCommon::getSiteEmails('REGISTRATION_ACTIVATIONMAIL');
        //COMMENT : GET THE SYSTEM VARS FOR MAIL FORM SUPPORT MAIL & SITE URL



        //COMMENT : SET TO EMAIL ADDRESS & FORM THE MESSAGE BODY BY REPLACING PROPER VALUE ON PLACE HOLDER
        $this->toAddress = $arrParams['toEmailAddress'];
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();


        $this->body = preg_replace('/##FIRST_NAME##/', $arrParams['FirstName'], $this->body);

        $this->body = preg_replace('/##ACTIVATION_LINK##/', url_for('administrators/verifyAccount?id='.$arrParams['UserId'].'&actKey='.$arrParams['ActivationKey'], true), $this->body);

        $this->body = preg_replace('/##EMAIL##/', $arrParams['toEmailAddress'], $this->body);

        //COMMENT : SEND MAIL
        $this->sendSfMail();
    }
    // COMMENT : METHOD TO SEND WELCOME MAIL
    public function sendWelcomeEmail($arrParams = array())
    {
        //COMMENT : RETURN FALSE IF ANY OF THE REQUIRED VARIABLE NOT FOUND
        if(empty($arrParams['toEmailAddress']))
        return false;
        if(empty($arrParams['FirstName']))
        return false;
        if(empty($arrParams['Password']))
        return false;

        //COMMENT : CREATE THE OBJECT FOR THE SITE MAIL CLASS WITH FORGOTPASSWORD MAIL FORMAT.
        $objSiteEmails = clsCommon::getSiteEmails('REGISTRATION_WELCOMEEMAIL');


        //COMMENT : SET TO EMAIL ADDRESS & FORM THE MESSAGE BODY BY REPLACING PROPER VALUE ON PLACE HOLDER
        $this->toAddress = $arrParams['toEmailAddress'];
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();
        $this->body = preg_replace('/##FIRST_NAME##/', $arrParams['FirstName'], $this->body);
        $this->body = preg_replace('/##EMAIL##/', $arrParams['toEmailAddress'], $this->body);
        $this->body = preg_replace('/##USERNAME##/',$arrParams['toEmailAddress'], $this->body);
        $this->body = preg_replace('/##PASSWORD##/',$arrParams['Password'], $this->body);
        //COMMENT : SEND MAIL
        $this->sendSfMail();

        return true;
    }
    /**
	*Send Forgot Password Email
	*/
    public function sendForgotPasswordEmail($arrParams = array())
    {
        //COMMENT : RETURN FALSE IF ANY OF THE REQUIRED VARIABLE NOT FOUND
        if(empty($arrParams['toEmailAddress']))
        return false;
        if(empty($arrParams['FirstName']))
        return false;
        if(empty($arrParams['Password']))
        return false;

        //COMMENT : CREATE THE OBJECT FOR THE SITE MAIL CLASS WITH FORGOTPASSWORD MAIL FORMAT.
        $objSiteEmails = clsCommon::getSiteEmails('FORGOTPASSWORD_EMAIL');


        //COMMENT : SET TO EMAIL ADDRESS & FORM THE MESSAGE BODY BY REPLACING PROPER VALUE ON PLACE HOLDER
        $this->toAddress = $arrParams['toEmailAddress'];
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();
        $this->body = preg_replace('/##FIRST_NAME##/', $arrParams['FirstName'], $this->body);
        $this->body = preg_replace('/##EMAIL##/', $arrParams['toEmailAddress'], $this->body);
        $this->body = preg_replace('/##PASSWORD##/',$arrParams['Password'], $this->body);

        //COMMENT : SEND MAIL
        $this->sendSfMail();

        return true;
    }
    /*****************
    * SEND Contact Us Email
    *****************/
    public function sendContactUsEmail($arrParams = array()){
        extract($arrParams);

        $objSiteEmails = clsCommon::getSiteEmails('CONTACT_US');
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();

        $this->toAddress = clsCommon::getSystemConfigVars('CONTACT_US');
        $this->body = preg_replace('/##EMAIL##/', $this->toAddress, $this->body);

        $this->subject = preg_replace('/##Subject##/', $Subject, $this->subject);
        $this->body = preg_replace('/##FirstName##/', $FirstName, $this->body);
        $this->body = preg_replace('/##LastName##/', $LastName, $this->body);
        $this->body = preg_replace('/##Email##/', $Email, $this->body);
        $this->body = preg_replace('/##Subject##/', $Subject, $this->body);
        $this->body = preg_replace('/##Message##/', nl2br($Message), $this->body);
        $this->sendSfMail();
        return true;
    }
    /*****************
    * SEND Account Deactivation notification email
    *****************/
    public function sendDeactivationEmail($arrParams = array()){
        //COMMENT : RETURN FALSE IF ANY OF THE REQUIRED VARIABLE NOT FOUND
        if(empty($arrParams['toEmailAddress']))
        return false;
        if(empty($arrParams['FirstName']))
        return false;

        //COMMENT : CREATE THE OBJECT FOR THE SITE MAIL CLASS WITH DEACTIVATION_NOTIFICATION MAIL FORMAT.
        $objSiteEmails = clsCommon::getSiteEmails('DEACTIVATION_NOTIFICATION');


        //COMMENT : SET TO EMAIL ADDRESS & FORM THE MESSAGE BODY BY REPLACING PROPER VALUE ON PLACE HOLDER
        $this->toAddress = $arrParams['toEmailAddress'];
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();
        $this->body = preg_replace('/##FIRST_NAME##/', $arrParams['FirstName'], $this->body);
        $this->body = preg_replace('/##EMAIL##/', $arrParams['toEmailAddress'], $this->body);

        //COMMENT : SEND MAIL
        $this->sendSfMail();

        return true;
    }
    /*****************
    * SEND status change notification email
    *****************/
    public function sendStatusChangeEmail($arrParams = array()){
        //COMMENT : RETURN FALSE IF ANY OF THE REQUIRED VARIABLE NOT FOUND
        if(empty($arrParams['toEmailAddress']))
        return false;
        if(empty($arrParams['FirstName']))
        return false;
        if(empty($arrParams['Status']))
        return false;

        //COMMENT : CREATE THE OBJECT FOR THE SITE MAIL CLASS WITH STATUSCHANGE_NOTIFICATION MAIL FORMAT.
        $objSiteEmails = clsCommon::getSiteEmails('STATUSCHANGE_NOTIFICATION');


        //COMMENT : SET TO EMAIL ADDRESS & FORM THE MESSAGE BODY BY REPLACING PROPER VALUE ON PLACE HOLDER
        $this->toAddress = $arrParams['toEmailAddress'];
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();
        $this->body = preg_replace('/##FIRST_NAME##/', $arrParams['FirstName'], $this->body);
        $this->body = preg_replace('/##EMAIL##/', $arrParams['toEmailAddress'], $this->body);
        $this->body = preg_replace('/##STATUS##/', $arrParams['Status'], $this->body);

        //COMMENT : SEND MAIL
        $this->sendSfMail();

        return true;
    }
    /*****************
    * SEND winner notification email
    *****************/
    public function sendWinnerEmail($arrParams = array()){
        //COMMENT : RETURN FALSE IF ANY OF THE REQUIRED VARIABLE NOT FOUND
        if(empty($arrParams['toEmailAddress']))
        return false;
        if(empty($arrParams['FirstName']))
        return false;
        if(empty($arrParams['Prize']))
        return false;

        //COMMENT : CREATE THE OBJECT FOR THE SITE MAIL CLASS WITH WINNER_NOTIFICATION MAIL FORMAT.
        $objSiteEmails = clsCommon::getSiteEmails('WINNER_NOTIFICATION');


        //COMMENT : SET TO EMAIL ADDRESS & FORM THE MESSAGE BODY BY REPLACING PROPER VALUE ON PLACE HOLDER
        $this->toAddress = $arrParams['toEmailAddress'];
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();
        $this->body = preg_replace('/##FIRST_NAME##/', $arrParams['FirstName'], $this->body);
        $this->body = preg_replace('/##EMAIL##/', $arrParams['toEmailAddress'], $this->body);
        $this->body = str_replace('##PRIZE##', $arrParams['Prize'], $this->body);

        //COMMENT : SEND MAIL
        $this->sendSfMail();

        return true;
    }
    /*****************
    * SEND winner status change notification email
    *****************/
    public function sendWinnerStatusChangeEmail($arrParams = array()){
        //COMMENT : RETURN FALSE IF ANY OF THE REQUIRED VARIABLE NOT FOUND
        if(empty($arrParams['toEmailAddress']))
        return false;
        if(empty($arrParams['FirstName']))
        return false;
        if(empty($arrParams['Message']))
        return false;

        //COMMENT : CREATE THE OBJECT FOR THE SITE MAIL CLASS WITH WINNERSTATUSCHANGE_NOTIFICATION MAIL FORMAT.
        $objSiteEmails = clsCommon::getSiteEmails('WINNERSTATUSCHANGE_NOTIFICATION');


        //COMMENT : SET TO EMAIL ADDRESS & FORM THE MESSAGE BODY BY REPLACING PROPER VALUE ON PLACE HOLDER
        $this->toAddress = $arrParams['toEmailAddress'];
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();
        $this->body = preg_replace('/##FIRST_NAME##/', $arrParams['FirstName'], $this->body);
        $this->body = preg_replace('/##EMAIL##/', $arrParams['toEmailAddress'], $this->body);
        $this->body = preg_replace('/##MESSAGE##/', $arrParams['Message'], $this->body);

        //COMMENT : SEND MAIL
        $this->sendSfMail();

        return true;
    }
    /*****************
    * SEND Claim Prize Notification to admin
    *****************/
    public function sendClaimPrizeEmailAdmin($arrParams = array()){
        //COMMENT : RETURN FALSE IF ANY OF THE REQUIRED VARIABLE NOT FOUND
        if(empty($arrParams['Username']))
        return false;
        //COMMENT : GET SITE ADMIN EMAIL ADDRESS
        $SITE_ADMIN = clsCommon::getSystemConfigVars('ADMIN_EMAIL');
        if(empty($SITE_ADMIN))
        return false;

        //COMMENT : CREATE THE OBJECT FOR THE SITE MAIL CLASS WITH WINNER_NOTIFICATION_ADMIN MAIL FORMAT.
        $objSiteEmails = clsCommon::getSiteEmails('WINNER_NOTIFICATION_ADMIN');

        //COMMENT : SET TO EMAIL ADDRESS & FORM THE MESSAGE BODY BY REPLACING PROPER VALUE ON PLACE HOLDER
        $this->toAddress = $SITE_ADMIN;
        $this->subject = $objSiteEmails->getSubject();

        $this->body = $objSiteEmails->getMessageBody();
        $this->body = preg_replace('/##USERNAME##/', $arrParams['Username'], $this->body);

        //COMMENT : SEND MAIL
        $this->sendSfMail();

        return true;
    }
    /**
	 * Mail send to the admin side when client request for premium plan
	 *
	 * @param unknown_type $arrParams
	 * @return unknown
	 */
    public function sendPremiumPlanEmailAdmin($arrParams = array()){
        //COMMENT : RETURN FALSE IF ANY OF THE REQUIRED VARIABLE NOT FOUND
        if(empty($arrParams['Username']))
        return false;
        //COMMENT : GET SITE ADMIN EMAIL ADDRESS
        $SITE_ADMIN = clsCommon::getSystemConfigVars('ADMIN_EMAIL');
        if(empty($SITE_ADMIN))
        return false;

        //COMMENT : CREATE THE OBJECT FOR THE SITE MAIL CLASS WITH WINNER_NOTIFICATION_ADMIN MAIL FORMAT.
        $objSiteEmails = clsCommon::getSiteEmails('PREMIUM_PLAN_NOTIFICATION_ADMIN');

        //COMMENT : SET TO EMAIL ADDRESS & FORM THE MESSAGE BODY BY REPLACING PROPER VALUE ON PLACE HOLDER
        $this->toAddress = $SITE_ADMIN;
        $this->subject = $objSiteEmails->getSubject();

        $this->body = $objSiteEmails->getMessageBody();
        $this->body = preg_replace('/##USERNAME##/', $arrParams['Username'], $this->body);

        //COMMENT : SEND MAIL
        $this->sendSfMail();

        return true;
    }
    /**
	 * send mail to client if we active the their premium plan
	 *
	 * @param unknown_type $arrParams
	 * @return unknown
	 */
    public function sendPremiumPlanChangeEmail($arrParams = array())
    {
        //COMMENT : RETURN FALSE IF ANY OF THE REQUIRED VARIABLE NOT FOUND
        if(empty($arrParams['toEmailAddress']))
        return false;
        if(empty($arrParams['FirstName']))
        return false;
        if(empty($arrParams['PremiumPlan']))
        return false;

        //COMMENT : CREATE THE OBJECT FOR THE SITE MAIL CLASS WITH STATUSCHANGE_NOTIFICATION MAIL FORMAT.
        $objSiteEmails = clsCommon::getSiteEmails('PREMIUMPLANCHANGE_NOTIFICATION');

        //COMMENT : SET TO EMAIL ADDRESS & FORM THE MESSAGE BODY BY REPLACING PROPER VALUE ON PLACE HOLDER
        $this->toAddress = $arrParams['toEmailAddress'];
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();
        $this->body = preg_replace('/##FIRST_NAME##/', $arrParams['FirstName'], $this->body);
        $this->body = preg_replace('/##EMAIL##/', $arrParams['toEmailAddress'], $this->body);
        $this->body = preg_replace('/##PREMIUMPLAN##/', $arrParams['PremiumPlan'], $this->body);

        //COMMENT : SEND MAIL
        $this->sendSfMail();

        return true;
    }


    // notify the user for the request for the connection
    public function sendConnectionRequestToUser($arrParams = array()){

        extract($arrParams);

        if(!$email)
        return false;

        if(!$name)
        return false;

        if(!$fromName)
        return false;


        sfProjectConfiguration::getActive()->loadHelpers(Array('Url', 'Tag'));
        $objSiteEmails = clsCommon::getSiteEmails('INDIVIDUAL_CONNECTION_REQUEST_EMAIL');

        $this->fromEmail = clsCommon::getSystemConfigVars('SITE_EMAIL_FROM');
        $supportEmail = clsCommon::getSystemConfigVars('SUPPORT_EMAIL');
        $site_name    	    = clsCommon::getSystemConfigVars('SITE_NAME');

        $this->toAddress = $email;
        $this->subject = $objSiteEmails->getSubject();
        $this->subject = preg_replace('/##FROM_NAME##/', $fromName, $this->subject);


        $this->body = $objSiteEmails->getMessageBody();

        $this->body = preg_replace('/##TO_NAME##/', $name, $this->body);
        $this->body = preg_replace('/##FROM_NAME##/', $fromName, $this->body);
        $this->body = preg_replace('/##SITE_NAME##/', $site_name, $this->body);

        $this->body = preg_replace('/##SUPPORT_EMAIL##/', $supportEmail, $this->body);
        $this->body = preg_replace('/##CONN_URL##/', url_for('myaccount/notification',true), $this->body);
        $this->body = preg_replace('/##SITE_URL##/', SITE_URL, $this->body);
        $this->body = preg_replace('/##FROM_URL##/', $messageUrl, $this->body);
        $this->body = preg_replace('/##PROFILE_URL##/', $profileUrl, $this->body);
        $this->body = preg_replace('/##EMAIL##/', $email, $this->body);

        //echo $this->body;exit;
        $this->sendSfMail();
        return true;
    }

    // email for accepted associate invitations // board member invitation
    public function sendAcceptedConnectionRequestMailToUser($arrParams = array()){

        extract($arrParams);
        if(!$email)
        return false;

        if(!$name)
        return false;

        if(!$fromName)
        return false;

        sfProjectConfiguration::getActive()->loadHelpers(Array('Url', 'Tag'));

        // accepted type ( board / associate )
        if($type=='board')
        $objSiteEmails = clsCommon::getSiteEmails('ACCEPTED_BOARD_MEMBER_REQUEST_EMAIL');
        else
        $objSiteEmails = clsCommon::getSiteEmails('ACCEPTED_CONNECTION_REQUEST_EMAIL_TO_MEMBER');


        $this->fromEmail    = clsCommon::getSystemConfigVars('SITE_EMAIL_FROM');
        $supportEmail       = clsCommon::getSystemConfigVars('SUPPORT_EMAIL');
        $site_name    	    = clsCommon::getSystemConfigVars('SITE_NAME');

        $this->toAddress = $email;
        $this->subject = $objSiteEmails->getSubject();
        $this->subject = preg_replace('/##FROM_NAME##/', $fromName, $this->subject);

        $this->body = $objSiteEmails->getMessageBody();

        $this->body = preg_replace('/##TO_NAME##/', $name, $this->body);
        $this->body = preg_replace('/##FROM_NAME##/', $fromName, $this->body);
        $this->body = preg_replace('/##SITE_NAME##/', $site_name, $this->body);
        $this->body = preg_replace('/##EMAIL##/', $email, $this->body);

        $this->body = preg_replace('/##SITE_URL##/', SITE_URL, $this->body);
        $this->body = preg_replace('/##SUPPORT_EMAIL##/', $supportEmail, $this->body);


        $this->body = preg_replace('/##FROM_URL##/', $messageUrl, $this->body);
        $this->body = preg_replace('/##PROFILE_URL##/', $profileUrl, $this->body);

        //echo $this->body;exit;

        $this->sendSfMail();
        return true;
    }

    // email for rejected associate invitations // board member invitation
    public function sendRejectedConnectionRequestMailToUser($arrParams){

        //clsCommon::pr($arrParams);
        extract($arrParams);
        if(!$email)
        return false;

        if(!$name)
        return false;

        if(!$fromName)
        return false;

        sfProjectConfiguration::getActive()->loadHelpers(Array('Url', 'Tag'));

        // reject type ( board / associate )
        if($type =='board')
        $objSiteEmails = clsCommon::getSiteEmails('REJECT_BOARD_MEMBER_REQUEST_EMAIL');
        else
        $objSiteEmails = clsCommon::getSiteEmails('REJECT_CONNECTION_REQUEST_EMAIL_TO_MEMBER');


        // here we have using  preg_replace not ereg_replace ( ereg_replace gives a notice)

        $this->fromEmail = clsCommon::getSystemConfigVars('SITE_EMAIL_FROM');
        $supportEmail = clsCommon::getSystemConfigVars('SUPPORT_EMAIL');
        $site_name    	    = clsCommon::getSystemConfigVars('SITE_NAME');

        $this->toAddress = $email;
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();

        $this->body = preg_replace('/##TO_NAME##/', $name, $this->body);
        $this->body = preg_replace('/##FROM_NAME##/', $fromName, $this->body);
        $this->body = preg_replace('/##SITE_NAME##/', $site_name, $this->body);

        $this->body = preg_replace('/##SITE_URL##/', SITE_URL, $this->body);
        $this->body = preg_replace('/##SUPPORT_EMAIL##/', $supportEmail, $this->body);

        $this->body = preg_replace('/##FROM_URL##/', $messageUrl, $this->body);
        $this->body = preg_replace('/##PROFILE_URL##/', $profileUrl, $this->body);
        $this->body = preg_replace('/##EMAIL##/', $email, $this->body);

        //echo $this->body;exit;

        $this->sendSfMail();
        return true;

    }

    // email for update the status in the  BOARD MEMBER listing page
    public function sendUpdateStatusBoardMemberEmail($arrParams = array()){

        //clsCommon::pr($arrParams);

        extract($arrParams);
        if(!$email)
        return false;

        if(!$name)
        return false;

        if(!$fromName)
        return false;

        sfProjectConfiguration::getActive()->loadHelpers(Array('Url', 'Tag'));


        $objSiteEmails = clsCommon::getSiteEmails('BOARD_MEMBER_STATUS_UPDATE_EMAIL');

        $this->fromEmail = clsCommon::getSystemConfigVars('SITE_EMAIL_FROM');
        $supportEmail = clsCommon::getSystemConfigVars('SUPPORT_EMAIL');
        $site_name    	    = clsCommon::getSystemConfigVars('SITE_NAME');


        $this->toAddress = $email;
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();


        $this->subject = preg_replace('/##SITE_NAME##/', $site_name, $this->subject);
        $this->subject = preg_replace('/##TO_NAME##/', $fromName, $this->subject);

        $this->body = preg_replace('/##SITE_NAME##/', $site_name, $this->body);
        $this->body = preg_replace('/##TO_NAME##/', $fromName, $this->body);
        $this->body = preg_replace('/##FIRST_NAME##/', $name, $this->body);
        $this->body = preg_replace('/##EMAIL##/', $toEmailAddress, $this->body);
        $this->body = preg_replace('/##ROLE##/', $role, $this->body);
        $this->body = preg_replace('/##SITE_URL##/', SITE_URL, $this->body);
        $this->body = preg_replace('/##SUPPORT_EMAIL##/', $supportEmail, $this->body);
        $this->body = preg_replace('/##LINK_URL##/', $LinkUrl, $this->body);

        //print_r($this->subject);
        //print_r($this->body); die;
        $this->sendSfMail();

        return true;
    }

    // email for ASSOCIATE_STATUS_DELETE_EMAIL
    public function sendDeleteStatusAssociateEmail($arrParams = array()){

        //clsCommon::pr($arrParams);

        extract($arrParams);
        if(!$email)
        return false;

        if(!$name)
        return false;

        if(!$fromName)
        return false;

        sfProjectConfiguration::getActive()->loadHelpers(Array('Url', 'Tag'));


        $objSiteEmails = clsCommon::getSiteEmails('ASSOCIATE_STATUS_DELETE_EMAIL');

        $this->fromEmail    = clsCommon::getSystemConfigVars('SITE_EMAIL_FROM');
        $supportEmail       = clsCommon::getSystemConfigVars('SUPPORT_EMAIL');
        $site_name    	    = clsCommon::getSystemConfigVars('SITE_NAME');


        $this->toAddress = $email;
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();

        $this->subject = preg_replace('/##FROM_NAME##/', $fromName, $this->subject);
        $this->body = preg_replace('/##SITE_NAME##/', $site_name, $this->body);
        $this->body = preg_replace('/##TO_NAME##/', $fromName, $this->body);
        $this->body = preg_replace('/##FIRST_NAME##/', $name, $this->body);
        $this->body = preg_replace('/##SITE_URL##/', SITE_URL, $this->body);
        $this->body = preg_replace('/##SUPPORT_EMAIL##/', $supportEmail, $this->body);
        $this->body = preg_replace('/##EMAIL##/', $email, $this->body);

        //print_r($this->subject);
        //print_r($this->body); die;
        $this->sendSfMail();

        return true;
    }

    // email for update the status in the  MANAGE WATER COOLER listing page
    public function sendUpdateStatusAssociateEmail($arrParams = array()){

        //clsCommon::pr($arrParams);

        extract($arrParams);
        if(!$email)
        return false;

        if(!$name)
        return false;

        if(!$fromName)
        return false;

        sfProjectConfiguration::getActive()->loadHelpers(Array('Url', 'Tag'));

        if($status =='assign')
        $objSiteEmails = clsCommon::getSiteEmails('ASSIGN_BOARD_MEMBER_EMAIL');
        else
        $objSiteEmails = clsCommon::getSiteEmails('CANCEL_BOARD_MEMBER_EMAIL');

        $this->fromEmail = clsCommon::getSystemConfigVars('SITE_EMAIL_FROM');
        $supportEmail = clsCommon::getSystemConfigVars('SUPPORT_EMAIL');
        $site_name    	    = clsCommon::getSystemConfigVars('SITE_NAME');

        $this->toAddress = $email;
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();


        $this->subject = preg_replace('/##FROM_NAME##/', $fromName, $this->subject);

        $this->body = preg_replace('/##SITE_NAME##/', $site_name, $this->body);
        $this->body = preg_replace('/##TO_NAME##/', $fromName, $this->body);
        $this->body = preg_replace('/##FIRST_NAME##/', $name, $this->body);
        $this->body = preg_replace('/##SITE_URL##/', SITE_URL, $this->body);
        $this->body = preg_replace('/##SUPPORT_EMAIL##/', $supportEmail, $this->body);
        $this->body = preg_replace('/##EMAIL##/', $email, $this->body);

        //print_r($this->subject);
        //print_r($this->body); die;
        $this->sendSfMail();

        return true;
    }

    // email for remove from the board member
    public function sendDeleteBoardMemberEmail($arrParams = array()){

        extract($arrParams);
        if(!$email)
        return false;

        if(!$name)
        return false;

        if(!$fromName)
        return false;

        sfProjectConfiguration::getActive()->loadHelpers(Array('Url', 'Tag'));


        $objSiteEmails = clsCommon::getSiteEmails('BOARD_MEMBER_DELETE_EMAIL');

        $this->fromEmail    = clsCommon::getSystemConfigVars('SITE_EMAIL_FROM');
        $supportEmail       = clsCommon::getSystemConfigVars('SUPPORT_EMAIL');
        $site_name    	    = clsCommon::getSystemConfigVars('SITE_NAME');


        $this->toAddress = $email;
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();

        $this->subject = preg_replace('/##FROM_NAME##/', $fromName, $this->subject);
        $this->body = preg_replace('/##SITE_NAME##/', $site_name, $this->body);
        $this->body = preg_replace('/##TO_NAME##/', $fromName, $this->body);
        $this->body = preg_replace('/##FIRST_NAME##/', $name, $this->body);
        $this->body = preg_replace('/##SITE_URL##/', SITE_URL, $this->body);
        $this->body = preg_replace('/##SUPPORT_EMAIL##/', $supportEmail, $this->body);
        $this->body = preg_replace('/##EMAIL##/', $email, $this->body);

        //print_r($this->subject);
        //print_r($this->body); die;
        $this->sendSfMail();

        return true;

    }

    // send sendInternalMessageNotification for compose mail
    public function sendInternalMessageNotification($arrParams){

        extract($arrParams);
        if(!$email)
        return false;


        $objSiteEmails = clsCommon::getSiteEmails('INTERNAL_MESSAGE_NOTIFICATION');
        $this->fromEmail = clsCommon::getSystemConfigVars('SITE_EMAIL_FROM');
        $supportEmail    = clsCommon::getSystemConfigVars('SUPPORT_EMAIL');
        $site_url    	 = clsCommon::getSystemConfigVars('SITE_URL');
        $site_name    	 = clsCommon::getSystemConfigVars('SITE_NAME');

        $this->toAddress = $email;
        $this->subject = $objSiteEmails->getSubject();
        $this->body    = $objSiteEmails->getMessageBody();

        $this->body = ereg_replace('##TO_NAME##', $name, $this->body);
        $this->body = ereg_replace('##FIRST_NAME##', $name, $this->body);
        $this->body = ereg_replace('##MESSAGE_URL##', $messageUrl, $this->body);
        $this->body = ereg_replace('##SITE_URL##', $site_url, $this->body);
        $this->body = ereg_replace('##SUPPORT_EMAIL##', $supportEmail, $this->body);
        $this->body = ereg_replace('##EMAIL##', $email, $this->body);

        $this->body = ereg_replace('##FROM_NAME##', $fromName, $this->body);
        $this->body = ereg_replace('##SITE_NAME##', $site_name, $this->body);

        //echo $this->body;exit;
        $this->sendSfMail();
        return true;

    }


    /*****************
    * SEND Contact Email TO COMPANY
    *****************/
    public function sendCompanyContactUsEmail($arrParams = array()){

        extract($arrParams);
        sfProjectConfiguration::getActive()->loadHelpers(Array('Url', 'Tag'));

        $objSiteEmails = clsCommon::getSiteEmails('CONTACT_US_COMPANY');
        $site_name    	 = clsCommon::getSystemConfigVars('SITE_NAME');
        $site_url    	 = clsCommon::getSystemConfigVars('SITE_URL');
        $support_mail    = clsCommon::getSystemConfigVars('SUPPORT_EMAIL');

        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();

        //$this->toAddress = clsCommon::getSystemConfigVars('CONTACT_US');

        $this->toAddress = $toEmailAddress;
        //$this->toAddress  = 'montu.pepavanshi@brainvire.com';

        $this->body = preg_replace('/##EMAIL##/', $this->toAddress, $this->body);

        $this->subject = preg_replace('/##Name##/', $name, $this->subject);

        $this->body = preg_replace('/##Name##/', $name, $this->body);
        $this->body = preg_replace('/##Address##/', $address, $this->body);
        $this->body = preg_replace('/##Email##/', $fromEmailAddress, $this->body);
        $this->body = preg_replace('/##Subject##/', $subject, $this->body);
        $this->body = preg_replace('/##Message##/', nl2br($message), $this->body);

        $this->body = preg_replace('/##SUPPORT_EMAIL##/', $support_mail, $this->body);
        $this->body = preg_replace('/##SITE_NAME##/', $site_name, $this->body);
        $this->body = preg_replace('/##SITE_URL##/', $site_url, $this->body);


        //echo $this->body;exit;

        $this->sendSfMail();
        return true;
    }

    /*****************
    * SEND Company Contact Email to ADMIN
    *****************/
    public function sendCompanyContactUsAdminEmail($arrParams = array()){

        extract($arrParams);
        sfProjectConfiguration::getActive()->loadHelpers(Array('Url', 'Tag'));

        $objSiteEmails = clsCommon::getSiteEmails('CONTACT_US_COMPANY');
        $site_name    	 = clsCommon::getSystemConfigVars('SITE_NAME');
        $site_url    	 = clsCommon::getSystemConfigVars('SITE_URL');
        $support_mail    = clsCommon::getSystemConfigVars('SUPPORT_EMAIL');

        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();

        $this->toAddress = clsCommon::getSystemConfigVars('CONTACT_US');
        //$this->toAddress  = 'montu0074i@gmail.com';

        $this->body = preg_replace('/##EMAIL##/', $this->toAddress, $this->body);

        $this->subject = preg_replace('/##Name##/', $name, $this->subject);

        $this->body = preg_replace('/##Name##/', $name, $this->body);
        $this->body = preg_replace('/##Address##/', $address, $this->body);
        $this->body = preg_replace('/##Email##/', $fromEmailAddress, $this->body);
        $this->body = preg_replace('/##Subject##/', $subject, $this->body);
        $this->body = preg_replace('/##Message##/', nl2br($message), $this->body);

        $this->body = preg_replace('/##SUPPORT_EMAIL##/', $support_mail, $this->body);
        $this->body = preg_replace('/##SITE_NAME##/', $site_name, $this->body);
        $this->body = preg_replace('/##SITE_URL##/', $site_url, $this->body);


        //echo $this->body;exit;

        $this->sendSfMail();
        return true;
    }

    /*****************
    * SEND Contact Us Email
    *****************/
    public function sendUserContactUsEmail($arrParams = array()){
        extract($arrParams);

        $objSiteEmails = clsCommon::getSiteEmails('USER_CONTACT_US');
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();
        $site_name    	 = clsCommon::getSystemConfigVars('SITE_NAME');
        $site_url    	 = clsCommon::getSystemConfigVars('SITE_URL');
        $support_mail    = clsCommon::getSystemConfigVars('SUPPORT_EMAIL');

        $this->toAddress = clsCommon::getSystemConfigVars('CONTACT_US');
        $this->body = preg_replace('/##EMAIL##/', $this->toAddress, $this->body);

        $this->body = preg_replace('/##Name##/', $arrParams['Name'], $this->body);
        $this->body = preg_replace('/##Email##/', $arrParams['toEmailAddress'], $this->body);
        if (in_array($arrParams['preferredEmail'],$arrParams)) {
            $this->body = preg_replace('/##PreferredEmail##/', "Yes", $this->body);
        }else {
            $this->body = preg_replace('/##PreferredEmail##/', "No", $this->body);
        }
        $this->body = preg_replace('/##Phone##/', $arrParams['Phone'], $this->body);
        if (in_array($arrParams['preferredPhone'],$arrParams)) {
            $this->body = preg_replace('/##PreferredPhone##/', "Yes", $this->body);
        }else {
            $this->body = preg_replace('/##PreferredPhone##/', "No", $this->body);
        }
        $this->body = preg_replace('/##Note##/', nl2br($arrParams['Note']), $this->body);

        $this->body = preg_replace('/##SUPPORT_EMAIL##/', $support_mail, $this->body);
        $this->body = preg_replace('/##SITE_NAME##/', $site_name, $this->body);
        $this->body = preg_replace('/##SITE_URL##/', $site_url, $this->body);
        $this->sendSfMail();
        return true;
    }


    /*****************
    * COMMENT : METHOD TO SEND ALERT TO ADMIN WHEN CUSTOMER CREATES NEW CASE
    *****************/

    public function sendNewCaseRegEmailToAdmin($arrParams = array()){
        //COMMENT : RETURN FALSE IF ANY OF THE REQUIRED VARIABLE NOT FOUND


        if(empty($arrParams['CaseNo']))
        return false;
        if(empty($arrParams['CustomerName']))
        return false;
        if(empty($arrParams['CaseTitle']))
        return false;

        //COMMENT :  LOAD THE HELPER
        sfProjectConfiguration::getActive()->loadHelpers(Array('Url', 'Tag'));

        //COMMENT : CREATE THE OBJECT FOR THE SITE MAIL CLASS WITH ACTIAVTION MAIL FORMAT.
        $objSiteEmails = clsCommon::getSiteEmails('CASE_REGISTRATION_ALERT_TO_ADMIN');
        //COMMENT : GET THE SYSTEM VARS FOR MAIL FORM SUPPORT MAIL & SITE URL


        //COMMENT : SET TO EMAIL ADDRESS & FORM THE MESSAGE BODY BY REPLACING PROPER VALUE ON PLACE HOLDER
        $this->toAddress = clsCommon::getSystemConfigVars('ADMIN_EMAIL');
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();


        $this->body = preg_replace('/##CASE_NO##/', $arrParams['CaseNo'], $this->body);
        $this->body = preg_replace('/##CUST_NAME##/', $arrParams['CustomerName'], $this->body);
        $this->body = preg_replace('/##CASE_TITLE##/', $arrParams['CaseTitle'], $this->body);
        #echo $this->body ;

        //COMMENT : SEND MAIL
        $this->sendSfMail();
    }

    /*****************
    * COMMENT : METHOD TO SEND ALERT TO ADMIN WHEN CUSTOMER DELETES CASE
    *****************/

    public function sendDeleteCaseEmailToAdmin($arrParams = array()){
        //COMMENT : RETURN FALSE IF ANY OF THE REQUIRED VARIABLE NOT FOUND

        if(empty($arrParams['CaseNo']))
        return false;
        if(empty($arrParams['CustomerName']))
        return false;
        if(empty($arrParams['CaseTitle']))
        return false;

        //COMMENT :  LOAD THE HELPER
        sfProjectConfiguration::getActive()->loadHelpers(Array('Url', 'Tag'));

        //COMMENT : CREATE THE OBJECT FOR THE SITE MAIL CLASS WITH ACTIAVTION MAIL FORMAT.
        $objSiteEmails = clsCommon::getSiteEmails('CASE_DELETED_ALERT_TO_ADMIN');
        //COMMENT : GET THE SYSTEM VARS FOR MAIL FORM SUPPORT MAIL & SITE URL


        //COMMENT : SET TO EMAIL ADDRESS & FORM THE MESSAGE BODY BY REPLACING PROPER VALUE ON PLACE HOLDER
        $this->toAddress = clsCommon::getSystemConfigVars('ADMIN_EMAIL');
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();


        $this->body = preg_replace('/##CASE_NO##/', $arrParams['CaseNo'], $this->body);
        $this->body = preg_replace('/##CUST_NAME##/', $arrParams['CustomerName'], $this->body);
        $this->body = preg_replace('/##CASE_TITLE##/', $arrParams['CaseTitle'], $this->body);
        #echo $this->body ;

        //COMMENT : SEND MAIL
        $this->sendSfMail();
    }


    /*****************
    * COMMENT : METHOD TO SEND ALERT TO CUSTOMER  WHEN ADMIN CREATES CASE ON BEHALF OF CUSTOMER
    *****************/

    public function sendAdminCreatedCaseEmailToCustomer($arrParams = array()){
        //COMMENT : RETURN FALSE IF ANY OF THE REQUIRED VARIABLE NOT FOUND

        if(empty($arrParams['CaseNo']))
        return false;
        if(empty($arrParams['CustomerName']))
        return false;
        if(empty($arrParams['CaseTitle']))
        return false;

        //COMMENT :  LOAD THE HELPER
        sfProjectConfiguration::getActive()->loadHelpers(Array('Url', 'Tag'));

        //COMMENT : CREATE THE OBJECT FOR THE SITE MAIL CLASS WITH ACTIAVTION MAIL FORMAT.
        $objSiteEmails = clsCommon::getSiteEmails('ADMIN_CREATED_CASE_ALERT_TO_CUSTOMER');
        //COMMENT : GET THE SYSTEM VARS FOR MAIL FORM SUPPORT MAIL & SITE URL


        //COMMENT : SET TO EMAIL ADDRESS & FORM THE MESSAGE BODY BY REPLACING PROPER VALUE ON PLACE HOLDER
        $this->toAddress =  $arrParams['CustomerEmail'];

        $subject = $objSiteEmails->getSubject();
        $siteName = clsCommon::getSystemConfigVars('SITE_NAME');

        $this->subject = preg_replace('/##SITE_NAME##/', $siteName , $subject);
        $this->subject = preg_replace('/##CASE_NO##/', $arrParams['CaseNo'] , $this->subject);
        $this->body = $objSiteEmails->getMessageBody();


        $this->body = preg_replace('/##CASE_NO##/', $arrParams['CaseNo'], $this->body);
        $this->body = preg_replace('/##CUST_NAME##/', $arrParams['CustomerName'], $this->body);
        $this->body = preg_replace('/##CASE_TITLE##/', $arrParams['CaseTitle'], $this->body);
        $this->body = preg_replace('/##ACCEPTED_DATE##/', $arrParams['CaseAcceptedDate'], $this->body);
        #echo $this->body ;

        //COMMENT : SEND MAIL
        $this->sendSfMail();

    } // End of function


    /*****************
    * COMMENT : METHOD TO SEND ALERT TO CUSTOMER  WHEN ADMIN ACCEPTS
    *****************/

    public function sendAdminAcceptedCaseEmailToCustomer($arrParams = array()){
        //COMMENT : RETURN FALSE IF ANY OF THE REQUIRED VARIABLE NOT FOUND

        if(empty($arrParams['CaseNo']))
        return false;
        if(empty($arrParams['CustomerName']))
        return false;
        if(empty($arrParams['CaseTitle']))
        return false;

        //COMMENT :  LOAD THE HELPER
        sfProjectConfiguration::getActive()->loadHelpers(Array('Url', 'Tag'));

        //COMMENT : CREATE THE OBJECT FOR THE SITE MAIL CLASS WITH ACTIAVTION MAIL FORMAT.
        $objSiteEmails = clsCommon::getSiteEmails('ADMIN_ACCEPTED_CASE_ALERT_TO_CUSTOMER');
        //COMMENT : GET THE SYSTEM VARS FOR MAIL FORM SUPPORT MAIL & SITE URL


        //COMMENT : SET TO EMAIL ADDRESS & FORM THE MESSAGE BODY BY REPLACING PROPER VALUE ON PLACE HOLDER
        $this->toAddress =  $arrParams['CustomerEmail'];

        $subject = $objSiteEmails->getSubject();
        $siteName = clsCommon::getSystemConfigVars('SITE_NAME');

        $this->subject = preg_replace('/##SITE_NAME##/', $siteName , $subject);
        $this->subject = preg_replace('/##CASE_NO##/', $arrParams['CaseNo'] , $this->subject);

        $this->body = $objSiteEmails->getMessageBody();


        $this->body = preg_replace('/##CASE_NO##/', $arrParams['CaseNo'], $this->body);
        $this->body = preg_replace('/##CUST_NAME##/', $arrParams['CustomerName'], $this->body);
        $this->body = preg_replace('/##CASE_TITLE##/', $arrParams['CaseTitle'], $this->body);
        $this->body = preg_replace('/##ACCEPTED_DATE##/', $arrParams['CaseAcceptedDate'], $this->body);
        $this->body = preg_replace('/##EMAIL##/', $arrParams['CustomerEmail'], $this->body);
        #echo $this->body ;die;

        //COMMENT : SEND MAIL
        $this->sendSfMail();
    }

    /*****************
    * COMMENT : METHOD TO SEND ALERT TO CUSTOMER  WHEN ADMIN PAYMENT DETAILS
    *****************/

    public function sendAdminPaymentCaseEmailToCustomer($arrParams = array()){
        //COMMENT :  LOAD THE HELPER
        sfProjectConfiguration::getActive()->loadHelpers(Array('Url', 'Tag'));

        //COMMENT : CREATE THE OBJECT FOR THE SITE MAIL CLASS WITH ACTIAVTION MAIL FORMAT.
        $objSiteEmails = clsCommon::getSiteEmails('ADMIN_PAYMENT_CASE_ALERT_TO_CUSTOMER');
        //COMMENT : GET THE SYSTEM VARS FOR MAIL FORM SUPPORT MAIL & SITE URL


        //COMMENT : SET TO EMAIL ADDRESS & FORM THE MESSAGE BODY BY REPLACING PROPER VALUE ON PLACE HOLDER
        $this->toAddress =  $arrParams['CustomerEmail'];

        $subject = $objSiteEmails->getSubject();
        $siteName = clsCommon::getSystemConfigVars('SITE_NAME');

        $this->subject = preg_replace('/##SITE_NAME##/', $siteName , $subject);
        $this->subject = preg_replace('/##CASE_NO##/', $arrParams['CaseNo'] , $this->subject);

        $this->body = $objSiteEmails->getMessageBody();


        $this->body = preg_replace('/##CASE_NO##/', $arrParams['CaseNo'], $this->body);
        $this->body = preg_replace('/##CUST_NAME##/', $arrParams['CustomerName'], $this->body);
        $this->body = preg_replace('/##EMAIL##/', $arrParams['CustomerEmail'], $this->body);
        $this->body = preg_replace('/##CASE_TITLE##/', $arrParams['CaseTitle'], $this->body);
        #$this->body = preg_replace('/##PAYMENT_DATE##/', $arrParams['CustomerPaidDate'], $this->body);
        #$this->body = preg_replace('/##CHECK_NO##/', $arrParams['CheckNo'], $this->body);

        // Summary
        #$this->body = preg_replace('/##ACTUAL_AMOUNT##/', $arrParams['ActualAmount'], $this->body);
        #$this->body = preg_replace('/##COMMISION_PERCENTAGE##/', $arrParams['CommisionPercentage']."%", $this->body);
        #$this->body = preg_replace('/##COMMISION_ACTUAL##/', $arrParams['CommisionActual'], $this->body);
        #$this->body = preg_replace('/##PROCESSING_FEES##/', $arrParams['ProcessingFees'], $this->body);
        #$this->body = preg_replace('/##UNDERPAY_ADJUSTMENT##/', $arrParams['UnderpayAdjustment'], $this->body);
        #$this->body = preg_replace('/##PAYABLE_AMOUNT##/', $arrParams['PayableAmount'], $this->body);


        $this->body = preg_replace('/##TOTALPAID_AMOUNT##/', $arrParams['TotalPaidAmount'], $this->body);
        $this->body = preg_replace('/##REMAIN_TO_PAY##/', $arrParams['RemainToPay'], $this->body);
        $this->body = preg_replace('/##OVERPAID_AMOUNT##/', $arrParams['OverpaidAmount'], $this->body);

        #echo $this->body;

        // Current Made Payment Detail
        $this->body = preg_replace('/##PAYMENT_DATE##/', $arrParams['CustomerPaidDate'], $this->body);
        $this->body = preg_replace('/##CHECK_NO##/', $arrParams['CheckNo'], $this->body);
        $this->body = preg_replace('/##PAID_AMOUNT##/', $arrParams['NewPaidAmount'], $this->body);
        $this->body = preg_replace('/##UNDERPAY_AMOUNT##/', $arrParams['NewUnderpayAdjustment'], $this->body);

        //COMMENT : SEND MAIL
        $this->sendSfMail();
    }


    /*****************
    * SEND Case Contact Us Email To Site Owner for Personal Websites
    *****************/
    public function sendCaseContactUsEmail($arrParams = array() , $siteOwenerInfo){
        extract($arrParams);

        $objSiteEmails = clsCommon::getSiteEmails('CASE_CONTACT_US');

        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();

        $site_name    	 = $siteOwenerInfo['UserWebsite'];
        $site_url    	 = $siteOwenerInfo['UserWebsite'];
        $support_mail    = $siteOwenerInfo['UserEmail'];

        $this->toAddress = $siteOwenerInfo['UserEmail'];

        // Received Contact Information
        $this->body = preg_replace('/##Name##/', $arrParams['Name'], $this->body);
        $this->body = preg_replace('/##Email##/', $arrParams['Email'], $this->body);
        $this->body = preg_replace('/##Phone##/', $arrParams['Phone'], $this->body);
        $this->body = preg_replace('/##Message##/', nl2br($arrParams['Message']), $this->body);

        // Site User Information
        $this->body = preg_replace('/##EMAIL##/', $siteOwenerInfo['UserEmail'], $this->body);
        $this->body = preg_replace('/##USER_NAME##/', $siteOwenerInfo['UserName'], $this->body);
        $this->body = preg_replace('/##SUPPORT_EMAIL##/', $support_mail, $this->body);
        $this->body = preg_replace('/##SITE_NAME##/', $site_name, $this->body);

        // Email CSS Settigns
        $this->body = preg_replace('/##BG_COLOR##/', $siteOwenerInfo['UserBGColor'], $this->body);
        $this->body = preg_replace('/##SITE_URL_LOGO##/', $siteOwenerInfo['UserLogo'], $this->body);

        $this->body = preg_replace('/##SITE_URL##/', $site_url, $this->body);

        $this->fromEmail = clsCommon::getSystemConfigVars('SITE_EMAIL_FROM');
        $this->fromLabel = $siteOwenerInfo['UserEmail'];

        $this->sendPersonalWebsiteMail();
        return true;
    }

    /**
	 * send mail to Coustomer ContactUs Email
	 *
	 * @param string $mailTable
	 * @param array  $siteOwenerInfo
	 * @param array  $attachment
	 */
    public function sendCustomerContactUsEmail($mailTable , $siteOwenerInfo, $attachment){

        $objSiteEmails = clsCommon::getSiteEmails('CUSTOMER_CONTACT_US');

        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();

        $site_name    	 = $siteOwenerInfo['UserWebsite'];
        $site_url    	 = $siteOwenerInfo['UserWebsite'];
        $support_mail    = $siteOwenerInfo['UserEmail'];

        $this->toAddress = $siteOwenerInfo['UserEmail'];

        // Received Contact Information
        $this->body = preg_replace('/##CONTECT_FORM_DATA##/', $mailTable, $this->body);

        // Site User Information
        $this->body = preg_replace('/##EMAIL##/', $siteOwenerInfo['UserEmail'], $this->body);
        $this->body = preg_replace('/##USER_NAME##/', $siteOwenerInfo['UserName'], $this->body);
        $this->body = preg_replace('/##SUPPORT_EMAIL##/', $support_mail, $this->body);
        $this->body = preg_replace('/##SITE_NAME##/', $site_name, $this->body);

        // Email CSS Settigns
        $this->body = preg_replace('/##BG_COLOR##/', $siteOwenerInfo['UserBGColor'], $this->body);
        $this->body = preg_replace('/##SITE_URL_LOGO##/', $siteOwenerInfo['UserLogo'], $this->body);

        $this->body = preg_replace('/##SITE_URL##/', $site_url, $this->body);

        $this->fromEmail = clsCommon::getSystemConfigVars('SITE_EMAIL_FROM');
        $this->fromLabel = $siteOwenerInfo['UserEmail'];

        $this->sendCoustomerWebsiteMail($attachment);
        return true;
    }

    /**
	 * send mail to Coustomer Website Email With Attachment's
	 *
	 * @param array $attachment
	 */
    public function sendCoustomerWebsiteMail($attachment){

        if(sfConfig::get('app_smtp_flag') == 'On'){

            $transport = Swift_SmtpTransport::newInstance(sfConfig::get('app_smtp_host'), sfConfig::get('app_smtp_port'), sfConfig::get('app_smtp_security'))
            ->setUsername(sfConfig::get('app_smtp_username'))
            ->setPassword(sfConfig::get('app_smtp_password'));
        } else {
            $transport = Swift_MailTransport::newInstance();
        }

        $mailer = Swift_Mailer::newInstance($transport);

        $message = Swift_Message::newInstance($this->subject)
        ->setFrom(array($this->fromEmail=>$this->fromLabel))

        ->setTo($this->toAddress)
        ->addPart($this->body, $this->contentType);

        foreach($attachment as $attch)
        {
            $message->attach(Swift_Attachment::fromPath($attch));
        }

        return $mailer->send($message);
    }

    /**
	 * email Address change send mail 
	 *
	 * @param array $arrParams
	 */
    public function sendChangeEmailAddress($newEmail , $arrParams = array())
    {
        //COMMENT : RETURN FALSE IF ANY OF THE REQUIRED VARIABLE NOT FOUND
        if(empty($newEmail))
        return false;
        if(empty($arrParams['FirstName']))
        return false;

        $objSiteEmails = clsCommon::getSiteEmails('EMAIL_CHANGE');

        $this->toAddress = $newEmail;
        //		$this->toAddress = "jaydip.dodiya@brainvire.com";
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();
        $this->body = preg_replace('/##FIRST_NAME##/', $arrParams['FirstName'], $this->body);
        $this->body = preg_replace('/##EMAIL##/', $newEmail, $this->body);

        $this->sendSfMail();
        return true;
    }

    /**
	 * email Address change send mail to admin
	 *
	 * @param array $arrParams
	 */
    public function changeEmailNotificationToAdmin($newEmail , $oldEmail)
    {
        //COMMENT : RETURN FALSE IF ANY OF THE REQUIRED VARIABLE NOT FOUND
        if(empty($newEmail))
        return false;

        $objSiteEmails = clsCommon::getSiteEmails('EMAIL_CHANGE_NOTIFICATION_ADMIN');

        $this->toAddress = clsCommon::getSystemConfigVars('SITE_EMAIL_FROM');
        //$this->toAddress = "maitrak.modi@brainvire.com";
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();

        $this->body = preg_replace('/##EMAIL##/', $newEmail, $this->body);
        $this->body = preg_replace('/##OLDEMAIL##/', $oldEmail, $this->body);

        $this->sendSfMail();
        return true;
    }

    /**
	 * change Status of User From Panding to Active
	 *
	 * @param array $arrParams
	 */
    public function changePandingToActiveStatus($arrParams = array())
    {
        //COMMENT : CREATE THE OBJECT FOR THE SITE MAIL CLASS WITH FORGOTPASSWORD MAIL FORMAT.
        $objSiteEmails = clsCommon::getSiteEmails('PENDING_TO_ACTIVE_STATUS');


        //COMMENT : SET TO EMAIL ADDRESS & FORM THE MESSAGE BODY BY REPLACING PROPER VALUE ON PLACE HOLDER
        $this->toAddress = $arrParams['toEmailAddress'];
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();
        $this->body = preg_replace('/##FIRST_NAME##/', $arrParams['FirstName'], $this->body);
        $this->body = preg_replace('/##EMAIL##/', $arrParams['toEmailAddress'], $this->body);
        $this->body = preg_replace('/##PASSWORD##/',$arrParams['Password'], $this->body);
        $this->body = preg_replace('/##URL##/',$arrParams['Url'], $this->body);
        $this->body = preg_replace('/##EMAILID##/',$arrParams['toEmailAddress'], $this->body);

        //COMMENT : SEND MAIL
        $this->sendSfMail();

        return true;
    }

    /**
	 * when register in legalgrip site 
	 *
	 * @param array $arrParams
	 */
    public function sendLegalgripRegistrationEmail($arrParams = array())
    {
        //COMMENT : RETURN FALSE IF ANY OF THE REQUIRED VARIABLE NOT FOUND
        if(empty($arrParams['toEmailAddress']))
        return false;
        if(empty($arrParams['FirstName']))
        return false;
        if(empty($arrParams['ActivationKey']))
        return false;
        if(empty($arrParams['UserId']))
        return false;

        //COMMENT :  LOAD THE HELPER
        sfProjectConfiguration::getActive()->loadHelpers(Array('Url', 'Tag'));

        //COMMENT : CREATE THE OBJECT FOR THE SITE MAIL CLASS WITH ACTIAVTION MAIL FORMAT.
        $objSiteEmails = clsCommon::getSiteEmails('LEGALGRIP_REGISTRATION_ACTIVATIONMAIL');
        //COMMENT : GET THE SYSTEM VARS FOR MAIL FORM SUPPORT MAIL & SITE URL



        //COMMENT : SET TO EMAIL ADDRESS & FORM THE MESSAGE BODY BY REPLACING PROPER VALUE ON PLACE HOLDER
        $this->toAddress = $arrParams['toEmailAddress'];
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();


        $this->body = preg_replace('/##FIRST_NAME##/', $arrParams['FirstName'], $this->body);

        $this->body = preg_replace('/##ACTIVATION_LINK##/', url_for('auth/verifyAccount?id='.$arrParams['UserId'].'&actKey='.$arrParams['ActivationKey'], true), $this->body);

        $this->body = preg_replace('/##EMAIL##/', $arrParams['toEmailAddress'], $this->body);

        //COMMENT : SEND MAIL
        $this->sendLegalgripSfMail();
    }

    /**
	 * welcome mail for legalgrip activation
	 *
	 * @param array $arrParams
	 */
    public function sendLegalgripWelcomeEmail($arrParams = array())
    {
        //COMMENT : RETURN FALSE IF ANY OF THE REQUIRED VARIABLE NOT FOUND
        if(empty($arrParams['toEmailAddress']))
        return false;
        if(empty($arrParams['FirstName']))
        return false;
        if(empty($arrParams['Password']))
        return false;

        //COMMENT : CREATE THE OBJECT FOR THE SITE MAIL CLASS WITH FORGOTPASSWORD MAIL FORMAT.
        $objSiteEmails = clsCommon::getSiteEmails('LEGALGRIP_REGISTRATION_WELCOMEEMAIL');


        //COMMENT : SET TO EMAIL ADDRESS & FORM THE MESSAGE BODY BY REPLACING PROPER VALUE ON PLACE HOLDER
        $this->toAddress = $arrParams['toEmailAddress'];
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();
        $this->body = preg_replace('/##FIRST_NAME##/', $arrParams['FirstName'], $this->body);
        $this->body = preg_replace('/##EMAIL##/', $arrParams['toEmailAddress'], $this->body);
        $this->body = preg_replace('/##USERNAME##/',$arrParams['toEmailAddress'], $this->body);
        $this->body = preg_replace('/##PASSWORD##/',$arrParams['Password'], $this->body);
        //COMMENT : SEND MAIL
        $this->sendLegalgripSfMail();

        return true;
    }

    /**
	 * legagrip forget password email
	 *
	 * @param array $arrParams
	 */
    public function sendLegalgripForgotPasswordEmail($arrParams = array())
    {
        //COMMENT : RETURN FALSE IF ANY OF THE REQUIRED VARIABLE NOT FOUND
        if(empty($arrParams['toEmailAddress']))
        return false;
        if(empty($arrParams['FirstName']))
        return false;
        if(empty($arrParams['Password']))
        return false;

        //COMMENT : CREATE THE OBJECT FOR THE SITE MAIL CLASS WITH FORGOTPASSWORD MAIL FORMAT.
        $objSiteEmails = clsCommon::getSiteEmails('LEGALGRIP_FORGOTPASSWORD_EMAIL');


        //COMMENT : SET TO EMAIL ADDRESS & FORM THE MESSAGE BODY BY REPLACING PROPER VALUE ON PLACE HOLDER
        $this->toAddress = $arrParams['toEmailAddress'];
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();
        $this->body = preg_replace('/##FIRST_NAME##/', $arrParams['FirstName'], $this->body);
        $this->body = preg_replace('/##EMAIL##/', $arrParams['toEmailAddress'], $this->body);
        $this->body = preg_replace('/##PASSWORD##/',$arrParams['Password'], $this->body);

        //COMMENT : SEND MAIL
        $this->sendLegalgripSfMail();

        return true;
    }

    /**
	 * legagrip mail Sending master function
	 *
	 */
    public function sendLegalgripSfMail()
    {
        if(sfConfig::get('app_smtp_flag') == 'On')
        {
            //COMMENT : Create the Transport
            $transport = Swift_SmtpTransport::newInstance(sfConfig::get('app_smtp_host'), sfConfig::get('app_smtp_port'), sfConfig::get('app_smtp_security'))
            ->setUsername(sfConfig::get('app_smtp_username'))
            ->setPassword(sfConfig::get('app_smtp_password'));
        }
        else
        {
            //COMMENT : Create the Transport
            $transport = Swift_MailTransport::newInstance();
        }

        //COMMENT : CREATE THE MAILER USING ABOVE CREATED TRANSPORT
        $mailer = Swift_Mailer::newInstance($transport);

        // COMMENT : Replace Common Variable
        $LOGO_SITE_URL = clsCommon::getSystemConfigVars('SITE_URL');
        $SITE_URL = clsCommon::getSystemConfigVars('LEGALGRIP_SITE_URL');
        $supportEmail = clsCommon::getSystemConfigVars('LEGALGRIP_SUPPORT_EMAIL');
        $SITE_NAME = clsCommon::getSystemConfigVars('LEGALGRIP_SITE_NAME');
        $this->fromEmail = clsCommon::getSystemConfigVars('LEGALGRIP_SITE_EMAIL_FROM');
        $this->fromLabel = clsCommon::getSystemConfigVars('LEGALGRIP_SITE_EMAIL_FROM_LABEL');

        $this->body = preg_replace('/##LOGO_SITE_URL##/', $LOGO_SITE_URL, $this->body);
        $this->body = preg_replace('/##SITE_URL##/', $SITE_URL, $this->body);
        $this->body = preg_replace('/##SUPPORT_EMAIL##/', $supportEmail, $this->body);
        $this->body = preg_replace('/##SITE_NAME##/', $SITE_NAME, $this->body);

        $message = Swift_Message::newInstance($this->subject)
        ->setFrom(array($this->fromEmail=>$this->fromLabel))
        ->setTo($this->toAddress)
        ->addPart($this->body, $this->contentType);

        return $mailer->send($message);
    }


    /**
	 * send mail to Attorney for ContactUs Email From LegalGrip 
	 *
	 * @param string $mailTable
	 * @param array  $siteOwenerInfo
	 * @param array  $attachment
	 */
    public function sendAttorneyContactUsEmail($mailTable , $siteOwenerInfo, $attachment){

        $objSiteEmails = clsCommon::getSiteEmails('LEGALGRIP_ATTORNEY_CONTACT_US');

        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();
        $this->toAddress = $siteOwenerInfo['UserEmail'];

        $this->body = preg_replace('/##CONTACT_FORM_DATA##/', $mailTable, $this->body);         // Received Contact Information

        // Site User Information
        $this->body = preg_replace('/##EMAIL##/', $siteOwenerInfo['UserEmail'], $this->body);
        $this->body = preg_replace('/##USER_NAME##/', $siteOwenerInfo['UserName'], $this->body);

        $this->sendLegalgripSfMail($attachment);
        return true;
    }

    /**
	 * send mail to legagrip admin for contactus information
	 *
	 * @param array  $arrParams
	 * @return boolean
	 */
    public function sendLegalgripAdminContactusEmail($arrParams)
    {
        $objSiteEmails = clsCommon::getSiteEmails('LEGALGRIP_CONTACT_US');

        $this->toAddress = clsCommon::getSystemConfigVars('LEGALGRIP_CONTACT_US');

        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();
        $this->body = preg_replace('/##NAME##/', $arrParams['Name'], $this->body);
        $this->body = preg_replace('/##EMAIL##/', $arrParams['Email'], $this->body);
        $this->body = preg_replace('/##PHONE##/', $arrParams['Phone'], $this->body);
        $this->body = preg_replace('/##MESSAGE##/', nl2br($arrParams['Message']), $this->body);

        //COMMENT : SEND MAIL
        $this->sendLegalgripSfMail();

        return true;
    }

    /**
	 * send mail to CUSTOMER  for review rating
	 *
	 * @param array  $arrParams
	 * @return boolean
	 */
    public function sendLegalgripReviewRatingEmail($arrParams)
    {
        $objSiteEmails = clsCommon::getSiteEmails('LEGALGRIP_REVIEWRATING_EMAIL');

        $this->toAddress = $arrParams["ToAddress"];
        $this->subject = $objSiteEmails->getSubject();
        $this->body = $objSiteEmails->getMessageBody();
        $this->body = preg_replace('/##FIRST_NAME##/', $arrParams['Name'], $this->body);
        $this->body = preg_replace('/##USER_NAME##/', $arrParams['UserName'], $this->body);
        $this->body = preg_replace('/##RATING##/', $arrParams['Rating'], $this->body);
        $this->body = preg_replace('/##REVIEW##/', nl2br($arrParams['Review']), $this->body);

        $this->sendLegalgripSfMail();

        return true;
    }
}