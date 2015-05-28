<?php

/**
 * default actions.
 *
 * @package    Luckzy
 * @subpackage default
 * @author     Bhavik Shah <bhavikshah@greymatterindia.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
    /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    public function executeIndex(sfWebRequest $request)
    {

    }
    public function executeComingSoon()
    {

    }
    public function executeNotAuthenticated()
    {

    }

    /**
     * Function to refresh page by Ajax request to prevent session to destroy
     *
     * @param sfWebRequest $request
     */
    public function executeAjaxCall(sfWebRequest $request) {
        exit;
    } // End of Function

}