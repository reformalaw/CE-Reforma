<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">
<!-- Bread Crumb Start -->
<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
  <td width="30%" class="drkgrylnk" align="center"><div class="Title">Roles List</div></td>
  <td width="35%" align="right" class="AdminBreadCrumb">
   <table cellpadding="8" cellspacing="0" align="right">
    <tr align="center">
     <td width="57" class="LinkImg" ><a href="<?php echo url_for('roles/new') ?>" title="Add New"><?php echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
      Add </a></td>
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
          <!--<tr>
           <td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php //echo image_tag("admin/Icon_Groups.gif", array("alt"=>"Roles","title"=>"Roles","align"=>"middle"))?></td>
           <td width="90%" class="ContentBtmDotLn">
            <div style="float:left;" class="Title">Roles List</div>
            <div style="float:right;" class="padrht">

           </div>
           </td>
          </tr>-->
          <tr valign="top">
           <td colspan="2" class="dot"></td>
          </tr>
			<tr align="center" valign="top">
				<?php include_partial('default/message'); ?>
			</tr>
          <?php
          $varExtra = '';
          if($sf_request->getParameter('search_text'))
          $varExtra .="&search_text=".$sf_request->getParameter('search_text');
          //if($sortBy) $varExtra .="&sortBy=$sortBy";
          ?>
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">
            <table width="100%" cellspacing="1" cellpadding="1" class="brd1">
            <?php if($pager->getnbResults() > 0){?>
             <tr class="fldbg">
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Role Name','ordering'=>true,"siteURL"=>'roles/index','alias'=>'Name','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Created Date','ordering'=>true,"siteURL"=>'roles/index','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <!--<td align="center"><?php //include_partial('default/ordering',array('title'=>'Update date time','ordering'=>true,"siteURL"=>'roles/index','alias'=>'UpdateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>-->
                            <td width="20%" align="center" class="whttxt">Action</td>
             </tr>              
               <?php #foreach ($roless as $roles): ?>
               <?php $i =1; ?>
               <?php foreach ($pager->getResults() as $roles):?>
               <?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
               <tr class="<?php echo $class;?>">
                                                    <td class="fldrowbg" align="left" valign="top"><?php echo $roles->getName() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'),strtotime($roles->getCreateDateTime())) ?></td>
                                                    <!--<td class="fldrowbg" align="center" valign="top"><?php //echo $roles->getUpdateDateTime() ?></td>-->
                                        <td class="fldrowbg" align="center">
                                        <?php echo link_to(image_tag('admin/view-icon.png',array('height'=>'25px','width'=>'24px','alt'=>'View','title'=>'Click to View Role')),'roles/view?id='.$roles->getId(),array('style'=>'vertical-align:middle;')); ?>
                                        <?php if ($roles->getStatus() == "Active") { ?>
                                                <a href="<?php echo url_for('roles/changeStatus?status=Inactive&id='.$roles->getId())?>" style="vertical-align:middle;"><?php echo image_tag('admin/active-cases-icon.png',array('height'=>'25px','width'=>'24px','border'=>'0','alt'=>'Delete','title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip')))?></a>
                                        <?php }else {  ?>
                                                <a href="<?php echo url_for('roles/changeStatus?status=Active&id='.$roles->getId())?>" style="vertical-align:middle;"><?php echo image_tag('admin/inactive-icon.png',array('height'=>'25px','width'=>'24px','border'=>'0','alt'=>'Delete','title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip')))?></a>
                                        <?php } ?>
                                        <a href="<?php echo url_for('roles/edit?id='.$roles->getId())?>" style="vertical-align:middle;"><?php echo image_tag('admin/edit-cases-icon.png',array('height'=>'25px','width'=>'24px','border'=>'0','alt'=>'Edit','title'=>'Edit'))?></a>
                                        <a href="<?php echo url_for('roles/delete?id='.$roles->getId())?>" style="vertical-align:middle;"><?php echo image_tag('admin/delete-cases-icon.png',array('height'=>'25px','width'=>'24px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();"))?></a>
                </td>
             </tr>
             <?php endforeach; ?>    
             <?php } else { ?> 
             <tr class="fldbg"><td class="errormss">No Roles found!</td></tr>
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
               <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'roles/index', 'varExtra' => $varExtra));?>
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
