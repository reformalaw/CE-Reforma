<?php

/**
 * ReviewRating
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    counceledge
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class ReviewRating extends BaseReviewRating
{
	/**
     * insert spam value
     *
     * @param integer $reviewId
     * @param integer $spamValue
     * @return boolean
     */
	public function insertSpamValue($reviewId, $spamValue)
	{
		if(!is_numeric($reviewId) || !is_numeric($spamValue))
			return false;
			
		Doctrine_Query::create()
        ->update('ReviewRating')
        ->set('Spam', '?', $spamValue)
        ->where('id = ?', $reviewId)
        ->execute();

        return true;
	}
	
	public function updateReviewStatus($status, $id)
	{
		if(!is_string($status) || !is_numeric($id))
			return false;
			
		Doctrine_Query::create()
        ->update('ReviewRating')
        ->set('Status', '?', $status)
        ->where('id = ?', $id)
        ->execute();

        return true;
	}
}
