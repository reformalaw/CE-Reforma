<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">
<!-- Bread Crumb Start -->
<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
  <td width="30%" class="drkgrylnk" align="center"><div class="Title">Customers List</div></td>
  <td width="35%" align="right" class="AdminBreadCrumb">
   <table cellpadding="8" cellspacing="0" align="right">
    <tr align="center">
     <td width="57" class="LinkImg" ><a href="<?php echo url_for('users/new') ?>" title="Add New"><?php echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
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
         <tr>
            <td align="left" valign="top" colspan="2">&nbsp;</td>
         </tr>
         <tr>
            <td align="center" valign="top" class="CasesListSearch" colspan="2">
            <form action="<?php echo url_for('users/index') ?>" method="post">
    	       <table width="100%" cellspacing="10" cellpadding="0">
               <tr>
                <td width="220" align="left" valign="top"><?php echo $objSearchForm['search_text']->renderLabel(); ?></td>
                <td width="220" align="left" valign="top"><?php echo $objSearchForm['field_type']->renderLabel(); ?></td>
                <td width="220" align="left" valign="top" id="div3" style="display:none;"><span id="div" style="<?php if ($val == true) { echo ""; }else { echo "display:none;"; }?>><?php echo $objSearchForm['status']->renderLabel(); ?></span></td>
                <td align="left" valign="top">&nbsp;</td>
               </tr>
               <tr>
                <td align="left" valign="top"><?php echo $objSearchForm['search_text']->render(array('style'=>'width:200px;')); ?></td>
                <td align="left" valign="top"><?php echo $objSearchForm['field_type']->render(array('style'=>'width:200px;','onchange'=>"generateRow(this.value)")); ?></td>
                <td align="left" valign="top" id="div4" style="display:none;"><span id="div2" style="display:none;"><?php echo $objSearchForm['status']->render(array('style'=>'width:200px;')); ?></span></td>
                <td align="left" valign="top"><span class="bluButton"> <?php echo tag('input', array('name' => 'search_btn', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
            <a href="<?php echo url_for('users/index') ?>" class ='CommonButton'>Clear</a></td>
               </tr>
               <tr>
                <td height="1" colspan="5" align="left" valign="top"></td>
               </tr>
               </table>
            </form>
            </td>
        </tr>
        <tr>
            <td height="20" align="left" valign="top">&nbsp;</td>
        </tr> 
         <!--<tr>
           <td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php /*echo image_tag("admin/Icon_Groups.gif", array("alt"=>"Users","title"=>"Users","align"=>"middle"))?></td>
           <td width="90%" class="ContentBtmDotLn">
            <div style="float:left;" class="Title">Users/Customers List</div>
            <div style="float:right;" class="padrht">
			 <form action="<?php echo url_for('users/index') ?>" method="post">
             <span><?php echo $objSearchForm['search_text']->renderLabel(); ?>:&nbsp;&nbsp;<?php echo $objSearchForm['search_text']->render(); ?>&nbsp;&nbsp;</span>
             <?php echo $objSearchForm['field_type']->renderLabel(); ?>:&nbsp;&nbsp;<?php echo $objSearchForm['field_type']->render(array('onchange'=>"generateRow(this.value)")); ?>&nbsp;&nbsp;
             <span id="div" style="<?php if ($val == true) { echo ""; }else { echo "display:none;"; }?>><?php echo $objSearchForm['status']->renderLabel(); ?>:&nbsp;&nbsp;<?php echo $objSearchForm['status']->render(); ?>&nbsp;&nbsp;</span>
             <?php echo tag('input', array('name' => 'search_btn', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
            <a href="<?php echo url_for('users/index')*/ ?>" class ='CommonButton'>Clear</a>
            </form>
           </div>
           </td>
          </tr>-->
          <tr valign="top">
           <td colspan="2" class="dot"></td>
          </tr>
          <?php include_partial('default/message'); ?>
          <?php
          $varExtra = '';
          if($sf_request->getParameter('search_text'))
          $varExtra .="&search_text=".$sf_request->getParameter('search_text');
          ?>
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">
            <table width="100%" cellspacing="1" cellpadding="1" class="brd1">
            <?php if($pager->getnbResults() > 0){?>
             <tr class="fldbg">
                            <td align="center" width="14%"> <?php include_partial('default/ordering',array('title'=>'Customer Name','ordering'=>false,"siteURL"=>'users/index','alias'=>'FirstName','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center" width="14%"><?php include_partial('default/ordering',array('title'=>'Email','ordering'=>false,"siteURL"=>'users/index','alias'=>'Email','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center" width="6%"><?php include_partial('default/ordering',array('title'=>'Billing','ordering'=>false,"siteURL"=>'users/index','alias'=>'Billing subscription','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center" width="13%"><?php include_partial('default/ordering',array('title'=>'Website','ordering'=>false,"siteURL"=>'users/index','alias'=>'Website subscriotion','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center" width="6%"> <?php include_partial('default/ordering',array('title'=>'Network','ordering'=>false,"siteURL"=>'users/index','alias'=>'Network profile subscription','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center" width="10%"><?php include_partial('default/ordering',array('title'=>'Featured Attorney','ordering'=>false,"siteURL"=>'users/index','alias'=>'Featured Attorney','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center" width="12%"><?php include_partial('default/ordering',array('title'=>'Priority Listing','ordering'=>false,"siteURL"=>'users/index','alias'=>'Priority Listing','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center" width="10%"><?php include_partial('default/ordering',array('title'=>'Created date','ordering'=>false,"siteURL"=>'users/index','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td width="15%" align="center" class="whttxt">Action</td>
             </tr>

               <?php $i =1; ?>
               <?php foreach ($pager->getResults() as $users):?>
               <?php if (($users->getEmail() != $sf_user->getAttribute("admin_email"))&&($users->getStatus() != "Deleted")&&($users->getUserType() == "Customer")){?>
               <?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
               <tr class="<?php echo $class;?>">
                                                      <?php //if(($users->getBillingSubscription()=="Yes" || $users->getWebsiteSubscriotion()=="Yes" || $users->getNetworkProfileSubscription()=="Yes")&& ($users->getStatus() == sfConfig::get("app_UserStatus_Active"))): ?>
															<td valign="middle"><?php echo link_to(ucwords($users->getFirstName()." ".$users->getLastName()) ,'dashboard/index?customerId='.$users->getId()); ?></td>
													<?php //else:?>
															<!--<td class="fldrowbg" align="left" valign="middle"><?php //echo $users->getFirstName()." ".$users->getLastName() ?></td>-->
													<?php //endif; ?>
                                                    <td class="fldrowbg" align="left" valign="middle"><?php echo $users->getEmail() ?></td>
                                                    <td class="fldrowbg" align="center" valign="middle">
                                                        <?php 
															if($users->getBillingSubscription()=="Yes"):
																echo "Yes";
															elseif($users->getBillingSubscription()=="No"):
																echo "No";
															elseif($users->getBillingSubscription()==""):
																echo "No";
															endif;
														
															/*if($users->getBillingSubscription()=="Yes"){
																echo link_to(image_tag("admin/active-icon-new.png",array('title'=>'Click here to Inactive Billing Subscription','alt'=>'Active')),"users/changeStatus?tempval=billing&status=No&id=".$users->getId());
															}elseif($users->getBillingSubscription()=="No"){
																echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','title'=>'Click here to Activate Billing Subscription','alt'=>'Inactive')),"users/changeStatus?tempval=billing&status=Yes&id=".$users->getId());
															}elseif($users->getBillingSubscription()==""){
																echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','title'=>'This user\'s status is Pending. Click here to activate this user','alt'=>'Panding')),"users/changeStatus?tempval=billing&status=Yes&id=".$users->getId());
															}*/
                                                        ?>
                                                    </td>
                                                    <td class="fldrowbg" align="center" valign="middle">
														<?php 
															if($users->getWebsiteSubscriotion()=="Yes"):
																echo "Yes";
																if($users->getUsersUsersWebsite()->getStatus() == sfConfig::get("app_UserStatus_Active")): ?>
																	</br><strong>[<a href="http://<?php echo $users->getUsersUsersWebsite()->getWebsiteurl(); ?>" target="_blank"><?php echo $users->getUsersUsersWebsite()->getWebsiteurl();?></a>]</strong>
															<?php endif;
															elseif($users->getWebsiteSubscriotion()=="No"):
																echo "No";
															elseif($users->getWebsiteSubscriotion()==""):
																echo "No";
															endif;
															
																/*if($users->getWebsiteSubscriotion()=="Yes"){
																	echo link_to(image_tag("admin/active-icon-new.png",array('title'=>'Click here to Inactive Website Subscriotion','alt'=>'Active')),"users/changeStatus?tempval=website&status=No&id=".$users->getId());
																	if($users->getUsersUsersWebsite()->getStatus() == sfConfig::get("app_UserStatus_Active")): ?>
																		</br><strong>[<a href="http://<?php echo $users->getUsersUsersWebsite()->getWebsiteurl(); ?>" target="_blank"><?php echo $users->getUsersUsersWebsite()->getWebsiteurl();?></a>]</strong>
																<?php endif; }elseif($users->getWebsiteSubscriotion()=="No"){
																	echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','title'=>'Click here to Activate Website Subscriotion','alt'=>'Inactive')),"users/edit?tempval=website&status=Yes&id=".$users->getId());
																}elseif($users->getWebsiteSubscriotion()==""){
																	echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','title'=>'This user\'s status is Pending. Click here to activate this user','alt'=>'Panding')),"users/edit?tempval=website&status=Yes&id=".$users->getId());
																}*/
														?>
                                                    </td>
                                                    <td class="fldrowbg" align="center" valign="middle">
														<?php 
															if($users->getNetworkProfileSubscription()=="Yes"):
																echo "Yes";
															elseif($users->getNetworkProfileSubscription()=="No"):
																echo "No";
															elseif($users->getNetworkProfileSubscription()==""):
																echo "No";
															endif;
															/*
															if($users->getNetworkProfileSubscription()=="Yes"){
																echo link_to(image_tag("admin/active-icon-new.png",array('title'=>'Click here to Inactive Network Profile Subscription','alt'=>'Active')),"users/changeStatus?tempval=net&status=No&id=".$users->getId());
															}elseif($users->getNetworkProfileSubscription()=="No"){
																echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','title'=>'Click here to Activate Network Profile Subscription','alt'=>'Inactive')),"users/changeStatus?tempval=net&status=Yes&id=".$users->getId());
															}elseif($users->getNetworkProfileSubscription()==""){
																echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','title'=>'This user\'s status is Pending. Click here to activate this user','alt'=>'Panding')),"users/changeStatus?tempval=net&status=Yes&id=".$users->getId());
															}*/
														?>
                                                    </td>
                                                    <td class="fldrowbg" align="center" valign="middle">
														<?php 
															if($users->getNetworkProfileSubscription()=="Yes" && $users->getStatus() == "Active"): 
																if($users->getIsFeatured() == "Yes"): ?>
																	<input type="checkbox" checked= true id="isFeatured<?php echo $users->getId(); ?>" onClick="ajaxIsFeatured(<?php echo $users->getId(); ?>);">
														<?php	else: ?>
																	<input type="checkbox" id="isFeatured<?php echo $users->getId(); ?>" onClick="ajaxIsFeatured(<?php echo $users->getId(); ?>);">
														<?php 	endif; ?>
													<?php			
															elseif($users->getNetworkProfileSubscription()=="Yes" && $users->getStatus() == "Inactive"):
																if($users->getIsFeatured() == "Yes"):
																	echo "Yes";
																else:
																	echo "No";
																endif;
															else:
																echo "--";
															endif; ?>
                                                    </td>
													<td class="fldrowbg" align="center" valign="middle">
														<?php //echo ($users->getLastLoginDateTime()) ?  $users->getLastLoginDateTime() : " Yet Not Login"; ?>
														<?php 
															if($users->getNetworkProfileSubscription()=="Yes" && $users->getStatus() == "Active"): 
																if($users->getPriorityListing() == "Yes"): ?>
																	<input type="checkbox" checked= true id="PriorityListing<?php echo $users->getId(); ?>" onClick="ajaxPriorityListing(<?php echo $users->getId(); ?>);">
														<?php	else: ?>
																	<input type="checkbox" id="PriorityListing<?php echo $users->getId(); ?>" onClick="ajaxPriorityListing(<?php echo $users->getId(); ?>);">
														<?php 	endif; ?>
														<?php			
															elseif($users->getNetworkProfileSubscription()=="Yes" && $users->getStatus() == "Inactive"):
																if($users->getPriorityListing() == "Yes"):
																	echo "Yes";
																else:
																	echo "No";
																endif;
															else:
																echo "--";
															endif; ?>
													</td>
                                                    <td class="fldrowbg" align="center" valign="middle"><?php echo date(sfConfig::get('app_dateformat'),strtotime($users->getCreateDateTime())) ?></td>
                                        <td class="fldrowbg PracticeAreaActionIcons" align="center" valign="middle">
                                        
                                        <?php if($sf_user->hasCredential('admin')) {
                                             if ($users->getStatus() == sfConfig::get('app_UserStatus_Active') || $users->getStatus() == sfConfig::get('app_UserStatus_Inactive')) { 
                                                   echo link_to(image_tag("admin/controlPanel.png",array('title'=>'Click here to view Customer Panel of this User','alt'=>'Login','width'=>'24','height'=>'25')),'users/logintocustomer?id='.$users->getId(),array('title' => 'Click here to view Customer Panel of this User'));
                                             } else {
                                                   echo image_tag("admin/blank-img.png",array('width'=>'24','height'=>25)) ; 
                                             }
                                        } ?>


                                        <?php if ($users->getStatus() == "Active") { ?>
												<?php echo link_to(image_tag("admin/active-icon-new.png", array('border'=>'1','alt'=>'Image','title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip'),'width'=>'24','height'=>'24')),'users/changeStatus?tempval=userStatus&status=Inactive&id='.$users->getId());?>
                                                <!--<a href="<?php //echo url_for('users/changeStatus?tempval=userStatus&status=Inactive&id='.$users->getId())?>"><?php //echo image_tag('admin/active.png',array('border'=>'0','alt'=>'Delete','title'=>'Click To Inactive Status'))?></a>&nbsp;-->
                                        <?php }else if($users->getStatus()=="Pending"){
												 echo link_to(image_tag("admin/pending-icon.png",array('title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'),'alt'=>'Pending','width'=>'24','height'=>'24')),'users/pendingToActive?id='.$users->getId());
                                                //echo image_tag("admin/pending-icon.png",array('title'=>'This user is Pending.','alt'=>'Pending','width'=>'24','height'=>25));
                                              }else {  ?>
                                                <a href="<?php echo url_for('users/changeStatus?tempval=userStatus&status=Active&id='.$users->getId())?>"><?php echo image_tag('admin/inactive-icon.png',array('border'=>'0','alt'=>'Delete','title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'),'width'=>'24','height'=>25))?></a>
                                        <?php } ?>
                                        <?php
											//echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>24)), 'users/edit?id='.$users->getId());
											echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>24)), 'dashboard/edit?id='.$users->getId().'&customerId='.$users->getId().'&flag=true');
											echo link_to(image_tag('admin/delete-cases-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();",'width'=>24,'height'=>25)), 'users/delete?id='.$users->getId());
										?>
                                        <!--<a href="<?php //echo url_for('users/edit?id='.$users->getId())?>"><?php //echo image_tag('admin/edit-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Edit'))?></a>&nbsp;
                                        <a href="<?php //echo url_for('users/delete?id='.$users->getId())?>"><?php //echo image_tag('admin/Delete_small.gif',array('border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();"))?></a>-->
                </td>
             </tr>
             <?php } ?>
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
               <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'users/index', 'varExtra' => $varExtra));?>
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
<script type="text/javascript">
function generateRow(value) {
    if(value == "BillingSubscription" || value == "WebsiteSubscriotion" || value == "NetworkProfileSubscription"){
        $('#div').show(); $('#div2').show(); $('#div3').show(); $('#div4').show();
    }else{
        $('#div').hide(); $('#div2').hide(); $('#div3').hide(); $('#div4').hide();
    }
}

function ajaxIsFeatured(id)
{
  	if(document.getElementById("isFeatured"+id).checked == true)
  	{
		$.ajax({
				  'type': 'POST',
				  'url': '<?php echo url_for("users/changeIsFeatured"); ?>',
				  'data': {id:id,value:"Yes"}
			  });
    }
    else
    {
		$.ajax({
				  'type': 'POST',
				  'url': '<?php echo url_for("users/changeIsFeatured"); ?>',
				  'data': {id:id,value:"No"}
			  });
    }
}

function ajaxPriorityListing(id)
{
  	if(document.getElementById("PriorityListing"+id).checked == true)
  	{
		$.ajax({
				  'type': 'POST',
				  'url': '<?php echo url_for("users/changePriorityListing"); ?>',
				  'data': {id:id,value:"Yes"}
			  });
    }
    else
    {
		$.ajax({
				  'type': 'POST',
				  'url': '<?php echo url_for("users/changePriorityListing"); ?>',
				  'data': {id:id,value:"No"}
			  });
    }
}
</script>