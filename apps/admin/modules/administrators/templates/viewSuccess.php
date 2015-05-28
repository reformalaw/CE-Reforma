<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">
<!-- Bread Crumb Start -->

<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="35%" class="drkgrylnk padlft"><a href="<?php echo url_for("default/index");?>" title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home")) ?></a></td>
  <td width="30%" class="drkgrylnk" align="center"><div class="Title">View Staff Detail </div></td>
  <td width="35%" align="right" class="AdminBreadCrumb">
   <table cellpadding="8" cellspacing="0" align="right">
    <tr align="center">
     <!--<td width="57" class="LinkImg" ><a href="#" title="Edit"><?php image_tag("admin/Icon_Save.gif", array("alt"=>"Save","title"=>"Save","border"=>"0")) ?><br />
      Save </a></td>-->
    <?php if($users->getStatus()== sfConfig::get('app_UserStatus_Active')) :?>
      <td width="57" class="LinkImg" ><a href="<?php echo url_for('administrators/changeStatus?status=Inactive&flag=true&id='.$users->getId()) ?>" title="Click here to Inactive this staff" alt="Active" ><?php echo image_tag("admin/Icon_active.png", array("alt"=>"Active","title"=>"Click here to Inactive this staff","border"=>"0")) ?><br />
      Active </a></td>
    <?php else:?>
      <td width="57" class="LinkImg" ><a href="<?php echo url_for('administrators/changeStatus?status=Active&flag=true&id='.$users->getId()) ?>" title="Click here to activate this Staff" alt="Inactive" ><?php echo image_tag("admin/Icon_inactive.png", array("alt"=>"Inactive","title"=>"Click here to activate this Staff","border"=>"0")) ?><br />
      Inactive </a></td>
    <?php endif; ?>
     <td width="57" class="LinkImg" ><a href="<?php echo url_for('administrators/edit?id='.$users->getId()) ?>" title="Edit" alt="Edit" ><?php echo image_tag("admin/Icon_Add.png", array("alt"=>"Edit","title"=>"Edit","border"=>"0")) ?><br />
      Edit </a></td>
      
      <td width="57" class="LinkImg" ><a href="<?php echo url_for('administrators/delete?id='.$users->getId()) ?>" title="Delete" alt="Delete" OnClick="return deleteConfirmation();"><?php echo image_tag("admin/Icon_delete.png", array("alt"=>"Delete","title"=>"Delete","border"=>"0",'OnClick'=>"return deleteConfirmation();")) ?><br />
      Delete </a></td>
     <td width="57" class="LinkImg" ><a href="<?php echo url_for('administrators/index') ?>" title="Cancel" alt="Cancel" ><?php echo image_tag("admin/Icon_Cancel.gif", array("alt"=>"Cancel","title"=>"Cancel","border"=>"0")) ?><br />
      Cancel </a></td>
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
        <?php include_partial('default/message'); ?>
   </tr>
 <tr>
  <td width="95%" class="ContentPad">
   <table width="99%" align="center" cellpadding="0" cellspacing="0" class="MainTbl">
    <tr>
     <td class="MaintblPadding">
      <table width="100%" cellspacing="0" cellpadding="0">
       <tr>
        <td class="ContentPad">
         <table cellspacing="0" cellpadding="0" align="center" width="100%">
          <!--<tr>
           <td width="05%" align="right" class="ContentBtmDotLn Pad5"><?php //echo image_tag("admin/Icon_Groups.gif",array("alt"=>"Faq","title"=>"Faq","align"=>"middle")) ?><span class="Title"> </span></td>
           <td width="95%" class="ContentBtmDotLn">
            <div style="float:left;" class="Title">View Role Detail </div>           
           </td>
          </tr>-->
          <tr valign="top">
           <td colspan="2" class="dot"></td>
          </tr>
          <tr valign="top">
			 <td colspan="2" class="ListAreaPad">
			  <table width="65%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
			   <tr class="fldbg">
				<td colspan="3" class="whttxt">Staff Detail</td>
			   </tr>
			   <tr>
                <td width="26%" class="fldrowbg"><b>Name :</b></td>
                <td width="68%" class="fldrowlightbg"><?php echo $users->getFirstName()." ".$users->getLastName();?></td>
               </tr>
			   <tr>
                <td width="26%" class="fldrowbg"><b>Email Id :</b></td>
                <td width="68%" class="fldrowlightbg"><?php echo $users->getEmail();?></td>
               </tr>
			   <!--<tr>
                <td width="26%" class="fldrowbg"><b>User Name :</b></td>
                <td width="68%" class="fldrowlightbg"><?php //echo $users->getUsername();?></td>
               </tr>-->
			   <tr>
                <td width="26%" class="fldrowbg"><b>Address :</b></td>
                <td width="68%" class="fldrowlightbg"><?php echo $users->getAddress1()."<br/>".$users->getAddress2();?></td>
               </tr>
			   <tr>
                <td width="26%" class="fldrowbg" valign="top"><b>Roles & Permissions :</b></td>
                <td width="68%" class="fldrowlightbg"><?php $arrPer = UserRolesTable::getRolesRecordForViewPage($users->getId()); echo implode('<br/>',$arrPer); ?></td>
               </tr>
			   <tr>
                <td width="26%" class="fldrowbg"><b>Created Date :</b></td>
                <td width="68%" class="fldrowlightbg"><?php echo date(sfConfig::get('app_dateformat'),strtotime($users->getCreateDateTime()));?></td>
               </tr>
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
  </td>
 </tr>
</table>
<!-- Control Panel End -->
</td></tr>
</table>
