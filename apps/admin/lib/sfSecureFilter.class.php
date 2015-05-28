<?php

class sfSecureFilter extends sfFilter
{
    public function execute($filterChain)
    {
        #echo 'Here======';
        $context = $this->getContext();
        $request = $context->getRequest();

        $appName =  $context->getConfiguration()->getApplication();

        $moduleName = $request->getParameter('module');
        $actionName = $request->getParameter('action');


        

        #if (!$request->isSecure())
        if ($appName == 'admin')
        {
            echo $secure_url = str_replace('http', 'https', $request->getUri()); die;

            return $context->getController()->redirect($secure_url);
            // We don't continue the filter chain
        }
        else
        {
            // The request is already secure, so we can continue
            $filterChain->execute();
        }

        /*if ($context->getController()->actionExists($moduleName, $actionName)) {

            $action = $context->getController()->getAction($moduleName,$actionName );
            
            #echo $action->getSecurityValue('is_ssl'); die;

            if ($action->getSecurityValue('is_ssl', false) && !$request->isSecure()) {

                $secure_url = str_replace('http', 'https', $request->getUri());
                
                return $context->getController()->redirect($secure_url);

            } else if (!$action->getSecurityValue('is_ssl', false) && $request->isSecure()) {

                $not_secure_url = str_replace('https', 'http', $request->getUri());

                return $context->getController()->redirect($not_secure_url);
            }
        }*/
    }
}
?>