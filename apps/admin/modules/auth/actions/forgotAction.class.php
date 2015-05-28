<?php
/**
 * forgotpassword action.
 *
 * @package    ValueCompass
 * @subpackage auth
 * @author     Chintan Fadia
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class forgotAction extends sfAction
{
    public function execute($request){
		//COMMENT : REDIRECT USER TO USER HOME IF LOGGED IN BY ACTIVATING BLOW REDIRECTER
		//$this->redirectIf(clsCommon::isUserLoggedin(),'@homepage');        
        //COMMENT CREATE OBJECT OF FORGOT PASSWORD FORM & SET EMPTY VARS.
        $this->form = new ForgotForm();
        $this->email = '';
        //$this->invalidLoginError = null;
        
        //COMMENT : CHECK IF FORM IS POSTED & IF POSTED PROCESS IT  
        if($request->isMethod('post')){
             $this->processForm($request, $this->form);            
        }
        
    }
    
    protected function processForm(sfWebRequest $request, sfForm $form){
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if($form->isValid()){  
            //COMMENT : FIND THE USER DETAIL IN DATABASE 
        	$forgotParam = $request->getParameter('forgot');
            
            $this->Email = trim($forgotParam['email']);
            $sql =	Doctrine_Query::CREATE()
                ->select('u.Id, u.FirstName, u.LastName, u.Password')
    			->from('Users u')
    			->where("u.Email ='".$this->Email."'");
    			//->andWhere("u.UserType =? ",sfConfig::get('app_UserType_User'));
    		$userDetails = $sql->fetchOne();
    		$sql->free();
    		
         	
    		//COMMENT : IF USER DETAIL ARE FOUND IN DATABASE SEND HIM THE PASSWORD 
    		if($userDetails){
    		    
    		    if($userDetails->getStatus()== sfConfig::get('app_UserStatus_Active')) {
    		        
    				$objPassEncDec = new encryptDecrypt(sfConfig::get('app_pwdEncDecKey'));
                    $password = $objPassEncDec->decrypt($userDetails->getPassword());             
    				
    				$arrParams = array();
                    $arrParams['toEmailAddress'] = $this->Email;
                    $arrParams['Password'] = $password;
                    $arrParams['FirstName'] = $userDetails->getFirstName();
                    $arrParams['LastName'] = $userDetails->getLastName();
    				
                    //COMMENT : GET THE OBJECT OF MAIL CLASS
                    $objSiteMails = new siteMails();
                    
                    //COMMENT : CALL TO FORGOT PASSWORD MAIL MEHTOD OF MAIL CLASS
                    $objSiteMails->sendForgotPasswordEmail($arrParams);
    		        
                    $this->getUser()->setFlash("forgotSuccess",1);
				    $this->getUser()->setFlash("succMsg","Your password will be sent to the e-mail on file.",false);
				    //$this->getUser()->setFlash("success",'Your password will be emailed to the registered email address entered. Please check your Inbox or Spam box.');
                    
    		        
    		        
    		    }else if($userDetails->getStatus()== sfConfig::get('app_UserStatus_Pending')){

               	    // IF USER ACC IS PENDING THEN SENT THE ACTIVATION MAIL AGAIN
               	               	    
                    // COMMENT : SET ACTIVATION CODE FOR USER TO ACTIVATE HIS ACCOUNT
                    $activationCode = clsCommon::getActivationKey(10) ;
                    //$result = Users::setUserActivationCode($userDetails->getId(),$activationCode);
                    $result= Doctrine_Core::getTable('Users')->setUserActivationCode($userDetails->getId(),$activationCode);
                        
              		// SEND ACTIVATION MAIL AGAIN
            		$arrParams = array();
            		$arrParams['FirstName'] = $userDetails->getFirstName()." ".$userDetails->getLastName();;
            		$arrParams['toEmailAddress'] = $this->Email;
            		$arrParams['ActivationKey'] = $activationCode;
            		$arrParams['UserId'] = $userDetails->getId();
            		$objSiteMail = new siteMails();
            		$objSiteMail->sendRegistrationEmail($arrParams);  
    
               	    $this->getUser()->setFlash('succMsg', "An activation e-mail has been sent to the registered e-mail address.",false);
    		        
    		    } else if($userDetails->getStatus()== sfConfig::get('app_UserStatus_Inactive')|| 
    		              $userDetails->getStatus()== sfConfig::get('app_UserStatus_Deleted') ) {
    		         $this->getUser()->setFlash('errMsg', "Your Account is Inactive.",false);
    		    }
                
                //REDIRECT TO THE SUCESS MESSAGE PAGE.
				$this->Email = '';
				//$this->redirect('auth/index');                
				//$this->redirect('auth/forgotPassword');                
        	} 
        	//COMMENT : USER IS NOT FOUND IN FOR GIVEN EMAIL THROW ERROR 
        	else {
			    $this->mail = trim($forgotParam['email']); 	
				$this->getUser()->setFlash("errMsg","The e-mail ID you entered does not exist.",false);
				
        	}
        }else{
			$this->flashMessage['error'] = 'We are unable to validate your credentials.  Please try again.';
			
		}
    }
	/**
	* Executes PreExecute all Method
	*/
	public function preExecute(){
		$this->flashMessage = array();
	}
}
