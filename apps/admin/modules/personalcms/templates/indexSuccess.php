<table width="98%" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td align="left" valign="top">&nbsp;</td>
	</tr>
	<tr>
		<td align="left" valign="top">&nbsp;</td>
	</tr>
	<tr>
		<td align="left" valign="top">
			<table width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td width="150" align="left" valign="top" class="LeftMenu">
						<!--START VERTICAL MENU-->
						<?php include_partial('personalcms/customerMenu');?>
						<!--END VERTICAL MENU-->
					</td>
					<td align="center" valign="top" class="CashDetails">
					<table width="96%" cellspacing="0" cellpadding="0">
						<tr>
							<td align="left" valign="top" height="25">&nbsp;</td>
						</tr>
						<tr>
							<td align="left" valign="top" class="WebsiteTab">
								<?php include_partial('personalcms/horizontalMenu');?>
								<!--<table width="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td width="10" class="BorderBottom">&nbsp;</td>
										<td width="110" align="center" valign="middle" class="SelectTab">Page List</td>
										<td width="2" align="center" valign="middle" class="BorderBottom"></td>
										<td width="110" align="center" valign="middle" class="DeSelectTab">
											<?php //echo link_to("Add CMS Page", "personalcms/new");?>
										</td>
										<td width="2" align="center" valign="middle" class="BorderBottom"></td>
										<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select cms page to edit');" href="javascript:void(0)">Edit CMS Page</a></td>
										<td class="BorderBottom">&nbsp;</td>
									</tr>
								</table>-->
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" class="WebsiteDetails">
								<table width="100%" cellspacing="10" cellpadding="0">
									<tr>
										<td align="center" valign="top">
											<table width="98%" cellspacing="1" cellpadding="1" class="PageListHeading">
												<tr>
													<td align="left" valign="middle"><strong>CMS Pages List</strong></td>
														<!--<td align="right" valign="middle" height="36">-->
															<!--<form action="<?php //echo url_for('website/practiceAreaList?customerId='.$customerId) ?>" method="post">
																									<span>
																									<?php //echo $objSearchForm['search_text']->renderLabel(); ?>:</span>&nbsp;&nbsp;<?php //echo $objSearchForm['search_text']->render(); ?>
																									<?php //echo tag('input', array('name' => 'search_btn', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
																									
																									<?php //echo link_to("Clear","website/practiceAreaList?customerId=".$customerId,array('class' => 'CommonButton')); ?>
															</form>-->
														<!--</td>-->
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td align="center" valign="top">
											<table cellspacing="0" cellpadding="0" align="center" width="100%">		
												<tr valign="top">
													<td colspan="2" class="dot"></td>
												</tr>
                                                
                                            	<tr valign="top">
													<td colspan="2" height="15"></td>
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
														<table width="98%" cellspacing="1" cellpadding="1" class="brd1">
															<?php if($pager->getnbResults() > 0){?>
																	<tr class="fldbg">
																					<td width="35%" align="center"><?php include_partial('default/ordering',array('title'=>'Page Title','ordering'=>false,"siteURL"=>'personalcms/index','alias'=>'Title','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																					<td width="35%" align="center"><?php include_partial('default/ordering',array('title'=>'Page Key','ordering'=>false,"siteURL"=>'personalcms/index','alias'=>'Unique key','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																					<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Template','ordering'=>false,"siteURL"=>'personalcms/index','alias'=>'Template','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																					<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Created Date','ordering'=>false,"siteURL"=>'personalcms/index','alias'=>'Update date time','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																					<td width="10%" align="center" class="whttxt">Action</td>
																	</tr>              
																	<?php #foreach ($cms_pagess as $cms_pages): ?>
																	<?php $i = 1; ?> 
																	<?php foreach ($pager->getResults() as $cms_pages):?>
																	<?php
																		// Check That Cms page Exist in Menu Or Not 
																		$flag = WebsiteMenuTable::checkPracticeOrCmsExist($cms_pages->getWebsiteId(),"CmsPageId", $cms_pages->getId());
																	?>
																	<?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
																	<?php if (($cms_pages->getTitle() != 'FAQs') && ($cms_pages->getTitle() != 'Contact')){?>
																	<tr class="<?php echo $class;?>">
																					<td class="fldrowbg" align="left" valign="middle">
																						<?php //echo $cms_pages->getTitle() ?>
																						<?php echo link_to($cms_pages->getTitle(),'personalcms/edit?id='.$cms_pages->getId()); ?>
																					</td>
																					<td class="fldrowbg" align="left" valign="middle"><?php echo $cms_pages->getSlug(); ?></td>
																					<td class="fldrowbg" align="left" valign="middle">
																					<?php if ($cms_pages->getSlug() != 'home'):?>
																						<?php 
																						if ($cms_pages->getTemplate() == "column1") {
																							echo "Column One";
																						}elseif ($cms_pages->getTemplate() == "column2L"){
																							echo "Column To Left";
																						}else {
																							echo "Column To Right";
																						}
																						?>
																					<?php else: 
																							echo "Home";
																						endif;
																					?>
																						
																					</td>
																					<td class="fldrowbg" align="center" valign="middle"><?php echo date(sfConfig::get('app_dateformat'), strtotime($cms_pages->getCreateDateTime())); ?></td>
																					<td class="fldrowbg" align="center" valign="middle">
																						
																						<?php if ($cms_pages->getSlug() != 'home'):?>
																						<?php if ($cms_pages->getStatus() != "" && $cms_pages->getStatus() == "Active") { ?>
																							<?php if($flag): ?>
																							<?php echo link_to(image_tag('admin/active-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip'))), 'personalcms/changeStatus?status=Inactive&id='.$cms_pages->getId()); ?>
																							<?php else:?>
																								<a href="javascript:void(0)" OnClick="CmsPageExist();" > <?php echo image_tag('admin/active-cases-icon.png',array('width'=>24,'height'=>25)) ;?> </a>
																							<?php endif;?>
																							<!--<a href="<?php //echo url_for('personalcms/changeStatus?status=Inactive&id='.$cms_pages->getId())?>" style="vertical-align:middle;"><?php //echo image_tag('admin/active.png',array('border'=>'0','alt'=>'Delete','title'=>'Click To Inactive Status'))?></a>&nbsp;-->                               	
																						<?php }else {  ?>
																							<?php echo link_to(image_tag('admin/inactive-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'))),'personalcms/changeStatus?status=Active&id='.$cms_pages->getId());?>
																							<!--<a href="<?php //echo url_for('personalcms/changeStatus?status=Active&id='.$cms_pages->getId())?>" style="vertical-align:middle;"><?php //echo image_tag('admin/inactive.png',array('border'=>'0','alt'=>'Delete','title'=>'Click To Active Status'))?></a>&nbsp;-->
																						<?php } ?>
																						<?php else:?>
																							<a href="#" style="cursor:none;"> <?php echo image_tag("admin/blank-img.png",array('width'=>24,'height'=>25)) ;?> </a>
																						<?php endif; ?>

																						<?php echo link_to(image_tag('admin/edit-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Edit')),'personalcms/edit?id='.$cms_pages->getId()); ?>
																						<?php if ($cms_pages->getSlug() != 'home') {?>
																							<?php if($flag):?>
																								<?php echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>'return deleteConfirmation()')),'personalcms/delete?id='.$cms_pages->getId()); ?>
																							<?php else:?>
																								<a href="javascript:void(0)" OnClick="CmsPageExist();" > <?php echo image_tag("admin/delete-cases-icon.png",array('width'=>24,'height'=>25)) ;?> </a>
																							<?php endif;?>
																						<?php }else{ ?>
																						<a href="#" style="cursor:none;"> <?php echo image_tag("admin/blank-img.png",array('width'=>24,'height'=>25)) ;?> </a>
																						<?php } ?>
																						<!--<a href="<?php //echo url_for('personalcms/edit?id='.$cms_pages->getId())?>" style="vertical-align:middle;"><?php //echo image_tag('admin/edit-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Edit'))?></a>&nbsp;
																						<a href="<?php //echo url_for('personalcms/delete?id='.$cms_pages->getId())?>" style="vertical-align:middle;"><?php //echo image_tag('admin/Delete_small.gif',array('border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>'return deleteConfirmation()'))?></a>-->
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
												<tr>
													<td height="20" align="left" valign="top">&nbsp;</td>
												</tr>
												<tr>
													<td align="center" valign="top" colspan="2" class="ListAreaPad">
													<?php                 
														if($orderBy) $varExtra .="&orderBy=$orderBy";
														if($orderType) $varExtra .="&orderType=$orderType";
													?>
													<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'personalcms/index', 'varExtra' => $varExtra));?>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td align="left" valign="top" height="1"></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" height="20">&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
    <td align="left" valign="top">&nbsp;</td>
</tr>
<tr>
    <td align="left" valign="top">&nbsp;</td>
</tr>
</table>










<!--<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">-->
<!-- Bread Crumb Start -->
<!--<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="35%" class="drkgrylnk padlft"><a href='<?php //echo url_for("default/index");?>' title="Home"> <?php //echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
  <td width="30%" class="drkgrylnk" align="center"><div class="Title">Personal CMS Pages List</div></td>
  <td width="35%" align="right" class="AdminBreadCrumb">
   <table cellpadding="8" cellspacing="0" align="right">
    <tr align="center">
     <td width="57" class="LinkImg" ><a href="<?php //echo url_for('personalcms/new') ?>" title="Add New"><?php //echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
      Add </a></td>     
    </tr>
   </table>
  </td>
 </tr>
</table>-->
<!-- Bread Crumb End -->
<!--</td></tr>
<tr><td width="100%">-->
<!-- Control Panel Start -->
<!--<table width="100%" cellspacing="2" cellpadding="0">
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
         <table cellspacing="0" cellpadding="0" align="center" width="100%">-->
          <!--<tr>
           <td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php //echo image_tag("admin/Icon_Groups.gif", array("alt"=>"Cms pages","title"=>"Cms pages","align"=>"middle"))?></td>
           <td width="90%" class="ContentBtmDotLn">
            <div style="float:left;" class="Title">Personal CMS Pages List</div>
            <!--<div style="float:right;" class="padrht">
			<form action="<?php /*echo url_for('personalcms/index') ?>" method="post">
             <span>Search:</span>&nbsp;&nbsp;             
             <?php echo tag('input', array('name' => 'search_text', 'type' => 'text', 'id' => 'search_text', 'size' => '25', 'value' => $sf_request->getParameter('search_text'))); ?>
            <?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
            <a href="<?php echo url_for('personalcms/index')*/ ?>">Clear</a>
            </form>
           </div>--
           </td>
          </tr>-->
          <!--<tr valign="top">
           <td colspan="2" class="dot"></td>
          </tr>
			<tr align="center" valign="top">
				<?php //include_partial('default/message'); ?>
			</tr>
          <?php              
//                 $varExtra = '';
//                 if($sf_request->getParameter('search_text')) 
//                   $varExtra .="&search_text=".$sf_request->getParameter('search_text');
                //if($sortBy) $varExtra .="&sortBy=$sortBy";       
          ?>
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">
            <table width="100%" cellspacing="1" cellpadding="1" class="brd1">
            <?php //if($pager->getnbResults() > 0){?>
             <tr class="fldbg">
                            <td width="35%" align="center"><?php //include_partial('default/ordering',array('title'=>'Page Title','ordering'=>false,"siteURL"=>'personalcms/index','alias'=>'Title','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td width="35%" align="center"><?php //include_partial('default/ordering',array('title'=>'Page key','ordering'=>false,"siteURL"=>'personalcms/index','alias'=>'Unique key','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td width="10%" align="center"><?php //include_partial('default/ordering',array('title'=>'Template','ordering'=>false,"siteURL"=>'personalcms/index','alias'=>'Template','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td width="10%" align="center"><?php //include_partial('default/ordering',array('title'=>'Created Date','ordering'=>false,"siteURL"=>'personalcms/index','alias'=>'Update date time','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td width="10%" align="center" class="whttxt">Action</td>
             </tr>         -->     
             <?php #foreach ($cms_pagess as $cms_pages): ?>
             <?php //$i = 1; ?> 
             <?php //foreach ($pager->getResults() as $cms_pages):?>
             <?php //$class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
             <?php //if (($cms_pages->getTitle() != 'FAQs') && ($cms_pages->getTitle() != 'Contact')){?>
             <!--<tr class="<?php //echo $class;?>">
                            <td class="fldrowbg" align="left" valign="middle">
								<?php //echo $cms_pages->getTitle() ?>
								<?php //echo link_to($cms_pages->getTitle(),'personalcms/edit?id='.$cms_pages->getId()); ?>
							</td>
                            <td class="fldrowbg" align="left" valign="middle"><?php //echo $cms_pages->getSlug(); ?></td>
                            <td class="fldrowbg" align="left" valign="middle"><?php 
//                             if ($cms_pages->getTemplate() == "column1") {
//                             	echo "Column One";
//                             }elseif ($cms_pages->getTemplate() == "column2L"){
//                                 echo "Column To Left";
//                             }else {
//                                 echo "Column To Right";
//                             }
                            ?>
                            </td>
                            <td class="fldrowbg" align="center" valign="middle"><?php //echo date(sfConfig::get('app_dateformat'), strtotime($cms_pages->getCreateDateTime())); ?></td>
                            <td class="fldrowbg" align="center" valign="middle">
                                -->
                                <?php //if ($cms_pages->getStatus() != "" && $cms_pages->getStatus() == "Active") { ?>
									<?php //echo link_to(image_tag('admin/active-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Click To Inactive Status')), 'personalcms/changeStatus?status=Inactive&id='.$cms_pages->getId()); ?>
                                    <!--<a href="<?php //echo url_for('personalcms/changeStatus?status=Inactive&id='.$cms_pages->getId())?>" style="vertical-align:middle;"><?php //echo image_tag('admin/active.png',array('border'=>'0','alt'=>'Delete','title'=>'Click To Inactive Status'))?></a>&nbsp;-->                               	
                                <?php //}else {  ?>
									<?php //echo link_to(image_tag('admin/inactive-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Click To Active Status')),'personalcms/changeStatus?status=Active&id='.$cms_pages->getId());?>
                                    <!--<a href="<?php //echo url_for('personalcms/changeStatus?status=Active&id='.$cms_pages->getId())?>" style="vertical-align:middle;"><?php //echo image_tag('admin/inactive.png',array('border'=>'0','alt'=>'Delete','title'=>'Click To Active Status'))?></a>&nbsp;-->
                                <?php //} ?>
                                <?php //echo link_to(image_tag('admin/edit-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Edit')),'personalcms/edit?id='.$cms_pages->getId()); ?>
                                <?php //if ($cms_pages->getTitle() != 'Home') {?>
                                <?php //echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>'return deleteConfirmation()')),'personalcms/delete?id='.$cms_pages->getId()); ?>
                                <?php //}else{ ?>
                                <!--<a href="#" style="cursor:none;"> <?php //echo image_tag("admin/blank-img.png",array('width'=>24,'height'=>25)) ;?> </a>-->
                                <?php //} ?>
                                <!--<a href="<?php //echo url_for('personalcms/edit?id='.$cms_pages->getId())?>" style="vertical-align:middle;"><?php //echo image_tag('admin/edit-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Edit'))?></a>&nbsp;
                                <a href="<?php //echo url_for('personalcms/delete?id='.$cms_pages->getId())?>" style="vertical-align:middle;"><?php //echo image_tag('admin/Delete_small.gif',array('border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>'return deleteConfirmation()'))?></a>-->
                            <!--</td>-->
             <!--</tr>-->
             <?php //} ?>
             <?php //endforeach; ?>    
             <?php //} else { ?> 
             <!--<tr class="fldbg"><td class="errormss">No Personal CMS Pages found!</td></tr>-->
             <?php //} ?>         
            <!--</table>
           </td>
          </tr>
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">                     -->
              <?php                 
//                 if($orderBy) $varExtra .="&orderBy=$orderBy";
//                 if($orderType) $varExtra .="&orderType=$orderType";
              ?>
               <?php //include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'personalcms/index', 'varExtra' => $varExtra));?>
           <!--</td>
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
</table>-->
<!-- Control Panel End -->
<!--</td></tr>
</table>-->