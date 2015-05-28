<table>
	<tr>
		<td align="center" valign="top" width="98%">
			<?php include_partial('view', array('form' => $view,'optionData'=>$optionData, 'ssSiteUrl'=>$ssSiteUrl)) ?>
			<?php //include_partial('view', array('form' => $view,'optionData'=>$optionData,'ssSiteUrl'=>$ssSiteUrl)) ?>
		</td>
	</tr>
</table>

<?php /*
<form id="chkViewForm" method="POST" action="<?php echo url_for('theme/check?flag=true');?>" name="chkViewForm" >

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">
<!-- Bread Crumb Start -->
<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="35%" class="drkgrylnk padlft"><a href="<?php echo url_for("default/index");?>" title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home")) ?></a></td>
  <td width="30%" class="drkgrylnk" align="center"><div class="Title">View Theme</div></td>
  <td width="35%" align="right" class="AdminBreadCrumb">
   <table cellpadding="8" cellspacing="0" align="right">
    <tr align="center">

	<?php if($view->getIsDefault()!='Yes'): ?>
		<?php  if($view->getStatus()=="Active"): ?>
			<td width="70" class="LinkImg" >
				<a onClick="DefaultTheme('<?php echo $view->getId(); ?>')" href="javascript:void(0);" title= "Click To Set As Default Theme"><?php echo image_tag("admin/Icon_default.png", array("alt"=>"Set Default","title"=>"Click To Set Default Theme","border"=>"0" )) ?><br />Set As Default </a>
			</td>
		<?php endif; ?>
	<?php endif; ?>


    <?php if($view->getIsDefault() !='Yes'): ?>
		<?php  if($view->getStatus()=="Active"): ?>
			<td width="57" class="LinkImg" >
				<a href="<?php echo url_for("theme/changeStatus?status=".sfConfig::get('app_Status_Inactive')."&id=".$view->getId()."&flag=true") ?>" title= "Click here to Inactive Theme"><?php echo image_tag("admin/Icon_active.png", array("alt"=>"Active","border"=>"0", "title" =>"Click here to Inactive Theme")) ?><br />Active </a>
			</td>
		<?php elseif($view->getStatus()=="Inactive"): ?>
			<td width="57" class="LinkImg" >
				<a href="<?php echo url_for("theme/changeStatus?status=".sfConfig::get('app_Status_Active')."&id=".$view->getId()."&flag=true") ?>" title= "Click here to Activate Theme"><?php echo image_tag("admin/Icon_inactive.png", array("alt"=>"Inactive","title"=>"Click here to Activate Theme","border"=>"0")) ?><br />Inactive </a>
			</td>
		<?php endif;?>
	<?php endif;?>
	
	<td width="57" class="LinkImg" >
		<a href="<?php echo url_for('theme/edit?id='.$view->getId()) ?>" title="Edit"><?php echo image_tag("admin/Icon_Add.png", array("alt"=>"Edit","title"=>"Edit","border"=>"0")) ?><br />Edit </a>
	</td>
	
    <?php if($view->getIsDefault() !='Yes'): ?>
		<td width="57" class="LinkImg" >
			<a OnClick ="return deleteConfirmation();" href="<?php echo url_for('theme/delete?id='.$view->getId()) ?>" title="Delete"><?php echo image_tag("admin/Icon_delete.png", array("alt"=>"Delete","title"=>"Delete","border"=>"0")) ?><br />Delete </a>
			<input type="hidden" id="chkbox<?php echo $view->getId(); ?>" name="chkbox[]" value="<?php echo $view->getId(); ?>" >
		</td>
	<?php endif; ?>
	
    <td width="57" class="LinkImg" >
		<a href="<?php echo url_for('theme/index') ?>" title="Cancel"><?php echo image_tag("admin/Icon_Cancel.gif", array("alt"=>"Cancel","title"=>"Cancel","border"=>"0")) ?><br />Cancel </a>
    </td>
    </tr>
   </table>
  </td>
 </tr>
</table>
<!-- Bread Crumb End -->
</td></tr>
<tr><td width="100%">
<!-- Control Panel Start -->
<table width="100%" cellspacing="2" cellpadding="0">
 <tr>
  <td align="center" class="ContentPad" height="10"></td>
 </tr>
 <tr>
  <td width="95%" class="ContentPad">
   <table width="99%" align="center" cellpadding="0" cellspacing="0" class="MainTbl">
    <tr>
     <td class="MaintblPadding">
      <table width="100%" cellspacing="0" cellpadding="0">
       <tr>
        <td class="ContentPad">
         <table width="100%" cellspacing="0" cellpadding="0" align="center" class="">

          <tr valign="top">
           <td colspan="2" class="dot"></td>
          </tr>
			<tr align="center" valign="top">
				<?php include_partial('default/message'); ?>
			</tr>
          <?php include_partial('view', array('form' => $view,'optionData'=>$optionData)) ?>
         </table>
        </td>
       </tr>
      </table>
     </td>
    </tr>
   </table>
  </td>
 </tr>
</table>
<!-- Control Panel End -->
</td></tr>
</table>

</form>
<script>
    function DefaultTheme(snId)
    { 
		var ans = confirm("Are you sure you want to set this as default theme ?");
		if(ans)
		{
			chkViewForm.submit();
			return true;
		}
		else
		{
			//$("#chkbox"+snId).removeAttr("checked");
			return false;
		}
    }
</script>

*/ ?>
