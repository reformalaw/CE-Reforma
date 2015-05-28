<?php
/*
  This file is used as the partial for sorting/ordering table.
	Method to Call :
	<?php include_partial('default/ordering',array('title'=><Header Title>,'ordering'=><Need Ordering>,"siteURL"=><URL to call>,'alias'=><Order By Alias>,'orderBy'=><Current OrderBy>,'orderType'=><Current Order Type>, 'extra_vars'=><Extra Variables like search>));?>

	Have to Pass four variables:
	1. title   : Header Title to be displayed	
	2. ordering  : Whether want ordering feature on this column. Value could be true/false.
	IF ordering IS TRUE THEN
	3. alias  : Name to be used for Ordering Table
	4. orderBy: Current Order By Column
	5. orderType: Current Order Type
	6. varExtra: The extra variables passed with the links like search parameter. Need to start with & and two or more variables need to separate the variables with &
*/
?>

<?php $extra_vars = html_entity_decode($extra_vars);?>

<?php if($ordering){?>
<?php if($alias == $orderBy && $orderType=='asc'):?>
  <?php echo image_tag('admin/active_asc.gif',array('border'=>'0','title'=>"Asc",'alt'=>'Asc'));?>
<?php else:?>
  <a href="<?php echo url_for($siteURL."?orderType=asc&orderBy=".$alias.$extra_vars,array('title'=>'Asc'))?>"><?php echo image_tag('admin/asc.gif',array('border'=>'0','title'=>"Asc",'alt'=>'Asc'));?></a>
<?php endif;?>
<?php }?>

<span class="whttxt"><?php echo $title?></span>

<?php if($ordering){?>
<?php if($alias == $orderBy && $orderType=='desc'):?>
  <?php echo image_tag('admin/active_desc.gif',array('border'=>'0','title'=>"Desc",'alt'=>'Desc'));?>
<?php else:?>
  <a href="<?php echo url_for($siteURL."?orderType=desc&orderBy=".$alias.$extra_vars,array('title'=>'Desc'))?>"><?php echo image_tag('admin/desc.gif',array('border'=>'0','title'=>"Desc",'alt'=>'Desc'));?></a>
<?php endif;?>
<?php }?>
