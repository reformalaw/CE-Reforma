<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">
<!-- Bread Crumb Start -->
<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
  <td width="30%" class="drkgrylnk" align="center"><div class="Title">Manage 3rd Parties</div></td>
  <td width="35%" align="right" class="AdminBreadCrumb">
   <table cellpadding="8" cellspacing="0" align="right">
    <tr align="center">
     <td width="57" class="LinkImg" ><a href="<?php echo url_for('thirdparty/new') ?>" title="Add New"><?php echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
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
           <td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php /*echo image_tag("admin/Icon_Groups.gif", array("alt"=>"3rd Party","title"=>"3rd Party","align"=>"middle"))?></td>
           <td width="90%" class="ContentBtmDotLn">
            <div style="float:left;" class="Title">3rd Party List</div>
            <div style="float:right;" class="padrht">
					<!--	<form action="<?php echo url_for('thirdparty/index') ?>" method="post">
             <span>Search:</span>&nbsp;&nbsp;             
             <?php echo tag('input', array('name' => 'search_text', 'type' => 'text', 'id' => 'search_text', 'size' => '25', 'value' => $sf_request->getParameter('search_text'))); ?>
            <?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
            <a href="<?php echo url_for('thirdparty/index')*/ ?>">Clear</a>
            </form>--
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
                            
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Name','ordering'=>true,"siteURL"=>'thirdparty/index','alias'=>'Name','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Address','ordering'=>false,"siteURL"=>'thirdparty/index','alias'=>'Address','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'City','ordering'=>true,"siteURL"=>'thirdparty/index','alias'=>'City','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                          
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'State','ordering'=>true,"siteURL"=>'thirdparty/index','alias'=>'StateId','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                              <td align="center"><?php include_partial('default/ordering',array('title'=>'County','ordering'=>true,"siteURL"=>'thirdparty/index','alias'=>'CountyId','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Zip','ordering'=>false,"siteURL"=>'thirdparty/index','alias'=>'Zip','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Registered date','ordering'=>false,"siteURL"=>'thirdparty/index','alias'=>'Register date','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>


                            <td width="20%" align="center" class="whttxt">Action</td>
             </tr>              
               <?php #foreach ($third_partiess as $third_parties): ?>
               <?php foreach ($pager->getResults() as $third_parties):?>
             <tr>
                                    
                                                    <td class="fldrowbg" align="left" valign="top"><?php echo $third_parties->getName() ?></td>
                                                    <td class="fldrowbg" align="left" valign="top"><?php echo $third_parties->getAddress1().' , '.$third_parties->getAddress2()?></td>
                                                    <td class="fldrowbg" align="left" valign="top"><?php echo $third_parties->getCity() ?></td>
                                                    <td class="fldrowbg" align="left" valign="top"><?php echo $third_parties->getThirdPartiesStates()->getName() ?></td>
                                                    <td class="fldrowbg" align="left" valign="top"><?php echo $third_parties->getThirdPartiesCounties()->getName() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $third_parties->getZip() ?></td>
                                                  
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo date('Y-m-d',strtotime($third_parties->getCreateDateTime())) ?></td>

<td class="fldrowbg" align="center">
<?php echo link_to(image_tag('admin/view-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'View','title'=>'View')),'thirdparty/view?id='.$third_parties->getId()); ?>
<?php if($third_parties->getStatus() == sfConfig::get('app_UserStatus_Active')): ?>
	<?php echo link_to(image_tag('admin/active-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Active','title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip'))),'thirdparty/status?id='.$third_parties->getId().'&status='.sfConfig::get('app_UserStatus_Inactive'));?>
                <!--<a href="<?php //echo url_for('thirdparty/status?id='.$third_parties->getId().'&status='.sfConfig::get('app_UserStatus_Inactive'))?>"><?php //echo image_tag('admin/active.png',array('border'=>'0','alt'=>'Active','title'=>'Click here to Inactivate'))?></a>-->
<?php else:?>
	<?php echo link_to(image_tag('admin/inactive-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'InActive','title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'))),'thirdparty/status?id='.$third_parties->getId().'&status='.sfConfig::get('app_UserStatus_Active'));?>
                <!--<a href="<?php //echo url_for('thirdparty/status?id='.$third_parties->getId().'&status='.sfConfig::get('app_UserStatus_Active'))?>"><?php //echo image_tag('admin/inactive.png',array('border'=>'0','alt'=>'InActive','title'=>'Click here to Activate'))?></a>-->
<?php endif; ?>
	<?php echo link_to(image_tag('admin/edit-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Edit','title'=>'Edit')),'thirdparty/edit?id='.$third_parties->getId());?>
                <!--<a href="<?php //echo url_for('thirdparty/edit?id='.$third_parties->getId())?>"><?php //echo image_tag('admin/edit-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit'))?></a>-->
 <!--<a href="<?php //echo url_for('thirdparty/view?id='.$third_parties->getId())?>"><?php //echo image_tag('admin/view.png',array('border'=>'0','alt'=>'View','title'=>'View'))?></a>-->
<?php echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")),'thirdparty/delete?id='.$third_parties->getId());?>
                <!--<a href="<?php //echo url_for('thirdparty/delete?id='.$third_parties->getId())?>"><?php //echo image_tag('admin/Delete_small.gif',array('border'=>'0','alt'=>'Delete','title'=>'Delete'))?></a>-->
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
               <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'thirdparty/index', 'varExtra' => $varExtra));?>
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
