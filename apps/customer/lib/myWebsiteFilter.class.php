<?php  

class myWebsiteFilter extends sfFilter{

    public function execute($filterChain){
        
        $hostname = $this->getContext()->getRequest()->getHost();
        
        // Code to check WWW exist in host or not
        $splitHost = explode('.', $hostname);
        if($splitHost[0] != 'www') {
            $hostname = 'www.'.$hostname;
        }
        // Complete
        
        $objUserWebsite = Doctrine_Core::getTable('UsersWebsite')->findOneByWebsiteurlAndStatus($hostname, sfConfig::get('app_Status_Active'));

        if(!$objUserWebsite) {
            $this->getContext()->getController()->forward($objUserWebsite);
        }

        /* SET FOLLOWING VARIABLES HERE
        1. Website ID
        2. Theme ID
        3. Website URL
        4. User ID
        ALL OTHER GENERIC DATA WHICH ARE REQUIRED FOR ALL PAGES.
        */
        
        $this->context->set('WebsiteId', $objUserWebsite->getId());
        $this->context->set('ThemeId', $objUserWebsite->getThemeId() );
        $this->context->set('WebsiteURL', $objUserWebsite->getWebsiteurl() );        
        $this->context->set('UserId', $objUserWebsite->getUserId() );  
        $this->context->set('UserEmail', $objUserWebsite->getUsersWebsiteUsers()->getEmail() );        
        $this->context->set('UserFirstName', $objUserWebsite->getUsersWebsiteUsers()->getFirstName() );       
        $this->context->set('UserLastName', $objUserWebsite->getUsersWebsiteUsers()->getLastName() );
        $this->context->set('WebsiteCreatedDate', $objUserWebsite->getCreateDateTime());

        $filterChain->execute($filterChain);
    }
}