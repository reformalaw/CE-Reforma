  public function executeIndex(sfWebRequest $request)
  {
    $this->orderBy = "";
    $this->orderType="";
    $where = "";
         
    $qSearch = Doctrine_Query::create();
    $qSearch->from('<?php echo $this->getModelClass() ?> <?php echo strtolower(substr($this->getModelClass(),0,2)) ?>');
    
    
    /*if($request->getParameter('search_text'))
      $where .="<?php echo strtolower(substr($this->getModelClass(),0,2)) ?>.name LIKE '%".$request->getParameter('search_text')."%'";
    
     $qSearch->where($where);

    switch($request->getParameter('orderBy'))
    {
      case "id":
        $orderBy = '<?php echo strtolower(substr($this->getModelClass(),0,2)) ?>.Id';        
        $this->orderBy = "id";        
        break;
      case "name":
      default:
        $orderBy = '<?php echo strtolower(substr($this->getModelClass(),0,2)) ?>.Name';
        $this->orderBy = "name";       
        break;
        
    }
    
    switch($request->getParameter('orderType'))
    {
      case "desc":
        $qSearch->orderBy("$orderBy DESC");
        $this->orderType = "desc";
        break;
      case "asc":
      default:        
        $qSearch->orderBy("$orderBy ASC");
        $this->orderType = "asc";
        break;
    }    
    */

     
    
    $pager = new sfDoctrinePager('<?php echo $this->getModelClass() ?>', sfConfig::get('app_no_of_records_per_page'));
    $pager->setQuery($qSearch);
    $pager->setPage($request->getParameter('page', 1));
    $pager->init();
    $this->pager = $pager; 
  }