<?php
/*
  This file is used as the partial.
	Method to Call :
	<?php include_partial('default/paginate',array('pager' => <Pager Object>, 'strUrl' => <URL to call>, 'varExtra' => <Extra Variables>)); ?>

	Have to Pass four variables:
	1. pager   : Normal Pager Object	
	2. strUrl  : The url which one to called on click of the link
	3. varExtra: The extra variables passed with the links. Need to start with & and two or more variables need to separate the variables with &
*/
?>
<nav class="pagination">
<?php if ($pager->haveToPaginate()){?>
	<ul>
	<?php 
		$varExtra = html_entity_decode($varExtra);
		if ($pager->getPage() != $pager->getFirstPage())
		{
			if($varExtra!="")
				$varExtraTmp = preg_replace("/&/","?",$varExtra,1);
			else 
				$varExtraTmp = "";
				
			echo("<li  class='previous'><a href='".url_for($strUrl.$varExtraTmp)."' alt='First Page' title='First Page'>First</a></li>");			
			if($pager->getPreviousPage()==1)
			{
				if($varExtra!="")
					$varExtraTmp = preg_replace("/&/","?",$varExtra,1);						
				echo("<li  class='previous'><a href='".url_for($strUrl.$varExtraTmp)."' title='Previous'>&#171; Previous</a></li>");			
			}
			else
				echo("<li  class='previous'><a href='".url_for($strUrl.'?page='.$pager->getPreviousPage().$varExtra)."' title='Previous'>&#171; Previous</a></li>");			
		}
		else
		{
			echo "<li class='previous-off'><a href='javascript:void(0);'>First</a></li>";
			echo "<li class='previous-off'><a href='javascript:void(0);'>&#171; Previous</a></li>";
		}
		
		$links = $pager->getLinks(10);
			
		foreach ($links as $page)			
		{
			if($page==1)
			{
				if($varExtra!="")
					 $varExtraTmp = preg_replace("/&/","?",$varExtra,1);						
				echo(($page == $pager->getPage()) ? "<li class='active'>$page</li>" : "<li><a href='".url_for($strUrl.$varExtraTmp)."' title='".$page."'>".$page."</a></li>");					
			}
			else
			{				  
				echo(($page == $pager->getPage()) ? "<li class='active'>$page</li>" : "<li><a href='".url_for($strUrl.'?page='.$page.$varExtra)."' title='".$page."'>".$page."</a></li>"); 
			}
		}
		if ($pager->getPage() != $pager->getLastPage())
		{
			echo("<li class='next'><a href='".url_for($strUrl.'?page='.$pager->getNextPage().$varExtra)."', title='Next'>Next &#187;</a></li>");
			echo("<li class='next'><a href='".url_for($strUrl.'?page='.$pager->getLastPage().$varExtra)."', title='Last Page'>Last</a></li>");
		}
		else
		{
			echo "<li class='next-off '><a href='javascript:void(0);'>Next &#187;</a></li>";
			echo "<li class='next-off '><a href='javascript:void(0);'>Last</a></li>";
		}
	?>
	</ul>
<?php }?>
</nav>
