<table cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
    <td width="100%"><!-- Bread Crumb Start -->
      <table cellspacing="0" cellpadding="0" class="AdminNavBar">
        <tr>
          <td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
          <td width="30%" class="drkgrylnk" align="center"><div class="Title">Staff List</div></td>
          <td width="35%" align="right" class="AdminBreadCrumb"><table cellpadding="8" cellspacing="0" align="right">
              <tr align="center">
                <td width="57" class="LinkImg" ><a href="<?php echo url_for('administrators/new') ?>" title="Add New"><?php echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
                  Add </a></td>
              </tr>
            </table></td>
        </tr>
      </table>
      <!-- Bread Crumb End -->
    </td>
  </tr>
  <tr>
  	<td width="100%">
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
						<form action="<?php echo url_for('administrators/index') ?>" method="post">
							<table width="100%" cellspacing="10" cellpadding="0">
							  <tr>
								<td width="220" align="left" valign="top"><?php echo $objSearchForm['search_text']->renderLabel(); ?></td>
								<td width="220" align="left" valign="top"><?php echo $objSearchForm['field_type']->renderLabel(); ?></td>
								<td align="left" valign="top">&nbsp;</td>
							  </tr>
							  <tr>
								<td align="left" valign="top"><?php echo $objSearchForm['search_text']->render(array('style'=>'width:200px;')); ?></td>
								<td align="left" valign="top"><?php echo $objSearchForm['field_type']->render(array('style'=>'width:250px;')); ?></td>
								<td align="left" valign="top"><span class="bluButton"> <?php echo tag('input', array('name' => 'search_btn', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?> <a href="<?php echo url_for('administrators/index') ?>" class = 'CommonButton'>Clear</a> </span></td>
							  </tr>
							  <tr>
								<td height="1" colspan="5" align="left" valign="top"></td>
							  </tr>
							</table>
						  </form></td>
					  </tr>
					  <tr>
						<td height="20" align="left" valign="top">&nbsp;</td>
					  </tr>
					  <!--<tr>
					   <td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php /*echo image_tag("admin/Icon_Groups.gif", array("alt"=>"Users","title"=>"Users","align"=>"middle"))?></td>
					   <td width="90%" class="ContentBtmDotLn">
						<!--<div style="float:left;" class="Title">Staff List</div>--
						<div style="float:right;" class="padrht">
						 <form action="<?php echo url_for('administrators/index') ?>" method="post">
						 <span><?php echo $objSearchForm['search_text']->
					  renderLabel(); ?>:
					  </span>
					  &nbsp;&nbsp;<?php echo $objSearchForm['search_text']->render(); ?>&nbsp;&nbsp; <?php echo $objSearchForm['field_type']->renderLabel(); ?>:&nbsp;&nbsp;<?php echo $objSearchForm['field_type']->render(); ?>&nbsp;&nbsp; <?php echo tag('input', array('name' => 'search_btn', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?> <a href="<?php echo url_for('administrators/index')*/ ?>" class = 'CommonButton'>Clear</a>
					  </form>
					  
					  </div>
					  
					  </td>
					  
					  </tr>
					  -->
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
						<td colspan="2" class="ListAreaPad"><table width="100%" cellspacing="1" cellpadding="1" class="brd1">
							<?php if($pager->getnbResults() > 0){?>
							<tr class="fldbg">
							  <td width="20%" align="center"><?php include_partial('default/ordering',array('title'=>'Name','ordering'=>false,"siteURL"=>'administrators/index','alias'=>'Name','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
							  <td width="20%" align="center"><?php include_partial('default/ordering',array('title'=>'Email','ordering'=>false,"siteURL"=>'administrators/index','alias'=>'Email','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
							  <td align="center"><?php include_partial('default/ordering',array('title'=>'Roles','ordering'=>false,"siteURL"=>'administrators/index','alias'=>'Roles','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
							  <td align="center"><?php include_partial('default/ordering',array('title'=>'Created Date','ordering'=>false,"siteURL"=>'administrators/index','alias'=>'Roles','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
							  <td width="20%" align="center" class="whttxt">Action</td>
							</tr>
							<?php $i=1;?>
							<?php foreach ($pager->getResults() as $users):?>
							<?php if ($users->getEmail() != $sf_user->getAttribute("admin_email")){?>
							<?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
							<tr class="<?php echo $class;?>">
							  <td class="fldrowbg" align="left" valign="top"><?php echo $users->getFirstName()." ".$users->getLastName() ?></td>
							  <td class="fldrowbg" align="left" valign="top"><?php echo $users->getEmail() ?></td>
							  <td class="fldrowbg" align="left" valign="top"><?php
																$arrPer = UserRolesTable::getRolesRecordForIndexPage($users->getId());
																echo implode(', ',$arrPer);?></td>
							  <td class="fldrowbg" align="center"><?php echo date(sfConfig::get('app_dateformat'),strtotime($users->getCreateDateTime())); ?></td>
							  <td class="fldrowbg" align="center"><?php echo link_to(image_tag('admin/view-icon.png',array('height'=>'25px','width'=>'24px','alt'=>'View','title'=>'Click to View Staff Details')),'administrators/view?id='.$users->getId()); ?>
								<?php
													if($users->getStatus()=="Active"){
														echo link_to(image_tag("admin/active-cases-icon.png",array('height'=>'25px','width'=>'24px','title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip'),'alt'=>'Active')),"administrators/changeStatus?status=Inactive&id=".$users->getId());
													}elseif($users->getStatus()=="Inactive"){
														echo link_to(image_tag("admin/inactive-icon.png",array('height'=>'25px','width'=>'24px','title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'),'alt'=>'Inactive')),"administrators/changeStatus?status=Active&id=".$users->getId());
													}elseif($users->getStatus()=="Pending"){
														echo image_tag("admin/pending-icon.png",array('height'=>'25px','width'=>'24px','title'=>'This user\'s status is Pending.','alt'=>'Pending'));
													}?>
								<a href="<?php echo url_for('administrators/edit?id='.$users->getId())?>"><?php echo image_tag('admin/edit-cases-icon.png',array('height'=>'25px','width'=>'24px','border'=>'0','alt'=>'Edit','title'=>'Edit'))?></a> <a href="<?php echo url_for('administrators/delete?id='.$users->getId())?>"><?php echo image_tag('admin/delete-cases-icon.png',array('height'=>'25px','width'=>'24px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();"))?></a> </td>
							</tr>
							<?php } ?>
							<?php endforeach; ?>
							<?php } else { ?>
							<tr class="fldbg">
							  <td class="errormss">No items found.</td>
							</tr>
							<?php } ?>
						  </table></td>
					  </tr>
					  <tr align="center" valign="top">
						<td colspan="2" class="ListAreaPad"><?php
						  if($orderBy) $varExtra .="&orderBy=$orderBy";
						  if($orderType) $varExtra .="&orderType=$orderType";
						  if($search_text != "" && $field_type != "" ) $varExtra .="&search_text=".$search_text."&field_type=".$field_type;
			
						  ?>
						  <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'administrators/index', 'varExtra' => $varExtra));?>
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
  	</td>
  </tr>
  
</table>
