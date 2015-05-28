<?php

class defaultComponents extends sfComponents
{
	
	public function executeHeader()
	{		
		
	}
	
	public function executeFooter()
	{

	}
	
	public function executeClientSays()
	{
		$testimonialData = Doctrine::getTable('Testimonial')
							->createQuery()
							->orderBy('RAND()')
							->fetchOne();
							
		$this->objTestimonial = $testimonialData;
	}
	
	public function executeContactInfo()
	{

	}
}
?>