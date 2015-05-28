<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">
<!-- Bread Crumb Start -->
<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
  <td width="30%" class="drkgrylnk" align="center"><div class="Title">Users List</div></td>
  <td width="35%" align="right" class="AdminBreadCrumb">
   <table cellpadding="8" cellspacing="0" align="right">
    <tr align="center">
     <td width="57" class="LinkImg" ><!--<a href="<?php //echo url_for('users/new') ?>" title="Add New">--><?php //echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><!--<br/>
		Add </a>--></td>     
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
  <td width="95%" align="center" class="ContentPad">
   <table width="99%" align="center" cellpadding="0" cellspacing="0" class="MainTbl">
    <tr>
     <td class="MaintblPadding">
      <table width="100%" cellspacing="0" cellpadding="0">
       <tr>
        <td class="ContentPad">
         <table cellspacing="0" cellpadding="0" align="center" width="100%">
         <tr>
            <td align="left" valign="top" colspan="2">&nbsp;</td>
         </tr>
        <tr>
            <td height="20" align="left" valign="top">&nbsp;</td>
        </tr> 
          <tr valign="top">
           <td colspan="2" class="dot"></td>
          </tr>
          <?php include_partial('default/message'); ?>
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">
            <table width="100%" cellspacing="1" cellpadding="1" class="brd1">
            <?php $varExtra =""; ?>
            <?php if($pager->getnbResults() > 0){?>
             <tr class="fldbg">
							<td align="center"><?php include_partial('default/ordering',array('title'=>'User Image','ordering'=>false,"siteURL"=>'manageuser/index','alias'=>'FirstName','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'User Name','ordering'=>true,"siteURL"=>'manageuser/index','alias'=>'FirstName','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <!--<td align="center"><?php //include_partial('default/ordering',array('title'=>'Screen Name','ordering'=>false,"siteURL"=>'manageuser/index','alias'=>'Username','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>-->
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Email','ordering'=>true,"siteURL"=>'manageuser/index','alias'=>'Email','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'State','ordering'=>false,"siteURL"=>'manageuser/index','alias'=>'Email','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Last login time','ordering'=>false,"siteURL"=>'manageuser/index','alias'=>'Last login date time','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Created date','ordering'=>false,"siteURL"=>'manageuser/index','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td width="10%" align="center" class="whttxt">Action</td>
             </tr>

               <?php $i =1; ?>
               <?php foreach ($pager->getResults() as $users):?>
               <?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
               <tr class="<?php echo $class;?>">
													
													<td valign="middle" align="center">
														<?php $userProfileImage = clsCommon::userProfileImage($users->getId(), "small"); 
																echo image_tag($userProfileImage['path'], array('width'=>"50px", 'height'=>'50px', 'title'=> $userProfileImage["title"]));
														?>
													</td>
													<td valign="middle"><?php echo ucwords($users->getFirstName()." ".$users->getLastName()); ?></td>
													<!--<td valign="middle"><?php //echo $users->getUsername(); ?></td>-->
													<td class="fldrowbg" align="left" valign="middle"><?php echo $users->getEmail() ?></td>
													<td class="fldrowbg" align="left" valign="middle"><?php echo $users->getUsersStates()->getName(); ?></td>
													<td class="fldrowbg" align="center" valign="middle"><?php echo ($users->getLastLoginDateTime()) ?  $users->getLastLoginDateTime() : " Yet Not Login"; ?></td>
													<td class="fldrowbg" align="center" valign="middle"><?php echo date(sfConfig::get('app_dateformat'),strtotime($users->getCreateDateTime())) ?></td>
                                        <td class="fldrowbg PracticeAreaActionIcons" align="center" valign="middle">
                                        <?php if ($users->getStatus() == "Active") { ?>
												<?php echo link_to(image_tag("admin/active-icon-new.png", array('border'=>'1','alt'=>'Image','title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip'),'width'=>'24','height'=>'24')),'manageuser/changeStatus?status=Inactive&id='.$users->getId());?>
                                        <?php }else if($users->getStatus()=="Pending"){
												 echo link_to(image_tag("admin/pending-icon.png",array('title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'),'alt'=>'Pending','width'=>'24','height'=>'24')),'manageuser/pendingToActive?id='.$users->getId());
                                              }else {  ?>
                                                <a href="<?php echo url_for('manageuser/changeStatus?status=Active&id='.$users->getId())?>"><?php echo image_tag('admin/inactive-icon.png',array('border'=>'0','alt'=>'Delete','title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'),'width'=>24,'height'=>25))?></a>
                                        <?php } ?>
                                        <?php
											echo link_to(image_tag('admin/delete-cases-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();",'width'=>24,'height'=>25)), 'manageuser/delete?id='.$users->getId());
										?>
                </td>
             </tr>

             <?php endforeach; ?>
             <?php } else { ?> 
             <tr class="fldbg"><td class="errormss">No items found.</td></tr>
             <?php } ?>
            </table>
           </td>
          </tr>
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">
              <?php
              if($orderBy) $varExtra .="&orderBy=$orderBy";
              if($orderType) $varExtra .="&orderType=$orderType";
              ?>
               <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'manageuser/index', 'varExtra' => $varExtra));?>
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
