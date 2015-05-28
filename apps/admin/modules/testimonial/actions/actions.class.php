<?php

/**
 * testimonial actions.
 *
 * @package    counceledge
 * @subpackage testimonial
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class testimonialActions extends sfActions
{
	/**
	 * Function is use for listing of testimonial
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		$this->orderBy = "";
		$this->orderType="";

		$qSearch = Doctrine_Query::create();
		$qSearch->from('Testimonial T');
		$qSearch->orderBy("T.Id Desc");

		$pager = new sfDoctrinePager('Testimonial', sfConfig::get('app_no_of_records_per_page'));
		$pager->setQuery($qSearch);
		$pager->setPage($request->getParameter('page', 1));
		$pager->init();
		$this->pager = $pager;
	}
	
	/**
	 * Function is use for inserting the testimonial
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeNew(sfWebRequest $request)
	{
		$this->form = new TestimonialForm();
	}
	
	/**
	 * Function is use for create the testimonial
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new TestimonialForm();
        $this->processForm($request, $this->form);
        $this->setTemplate('new');
	}
	
	/**
	 * Function is use for Edit the testimonial
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeEdit(sfWebRequest $request)
	{
		$this->forward404Unless($dataTestimonial = Doctrine::getTable('Testimonial')->find(array($request->getParameter('id'))), sprintf('Object Testimonial does not exist (%s).', $request->getParameter('id')));
		$this->form = new TestimonialForm($dataTestimonial);
	}
	
	/**
	 * Function is use for update the testimonial
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeUpdate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($dataTestimonial = Doctrine::getTable('Testimonial')->find(array($request->getParameter('id'))), sprintf('Object Testimonial does not exist (%s).', $request->getParameter('id')));
		$this->form = new TestimonialForm($dataTestimonial);
		$this->processForm($request, $this->form);
		$this->setTemplate('edit');
	}
	
	/**
	 * Function is use for delete the testimonial
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeDelete(sfWebRequest $request)
	{
		$this->forward404Unless($dataTestimonial = Doctrine::getTable('Testimonial')->find(array($request->getParameter('id'))), sprintf('Object Testimonial does not exist (%s).', $request->getParameter('id')));
		$dataTestimonial->delete();
		$this->getUser()->setFlash('errMsg', "Deletion successful.");
		$this->redirect('testimonial/index');
	}
	
	/**
	 * Function is use for process the testimonial data
	 *
	 * @param sfRequest $request A request object
	 * @param sfForm $form A form object
	 */
	protected function processForm(sfWebRequest $request, sfForm $form)
	{
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		$data = $request->getParameter($form->getName());
		if ($form->isValid())
		{
			$testimonial = $form->save();

			if($request->isMethod(sfRequest::PUT)){
				$this->getUser()->setFlash('succMsg', "Update successful.");
			}else{
				$this->getUser()->setFlash('succMsg', "New testimonial added successfully.");
			}

			$this->redirect('testimonial/index');
        }
	}
	
	/**
	 * Function is use for to view the data
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeView(sfWEbRequest $request)
	{
		$this->form = Doctrine::getTable('Testimonial')->find(array($request->getParameter('id')));
		$this->setLayout("popup");
	}
}