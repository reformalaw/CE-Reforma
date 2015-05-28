<?php
class acClientObjectRoute extends sfDoctrineRoute
{
  #protected $baseHost = '.sympalbuilder.com';
 
  public function matchesUrl($url, $context = array())
  {
    if (false === $parameters = parent::matchesUrl($url, $context))
    {
      return false;
    }
    
    $website = $context['host'];
    
    // Code to check WWW exist in host or not
    $splitHost = explode('.', $website);
    if($splitHost[0] != 'www') {
        $website = 'www.'.$website;
    }
    // Complete

    
    $client = Doctrine_Core::getTable('UsersWebsite')
      ->findOneByWebsiteurlAndStatus($website,'Active');

    if (!$client)
    {
      return false;
    }
 
    return array_merge(array('client_id' => $client->Id), $parameters);
  }
}