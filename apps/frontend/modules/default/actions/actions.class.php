<?php

class defaultActions extends sfActions
{

    public function preExecute()
    {
        StatisticsTable::addIpToStatistics($this->getRequest()->getRemoteAddress(),1);
    }
    /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    public function executeIndex(sfWebRequest $request)
    {
        $objTestimonial = Doctrine::getTable('Testimonial')
							->createQuery()
							->orderBy('RAND()')
							->limit(3)
							->execute();

		$this->objTestimonial = $objTestimonial;
    }
    public function executeComingSoon()
    {

    }
    public function executeNotAuthenticated()
    {

    }
}
