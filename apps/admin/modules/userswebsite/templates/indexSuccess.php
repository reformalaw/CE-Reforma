<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="100%">
		<!-- Bread Crumb Start -->
			<table cellspacing="0" cellpadding="0" class="AdminNavBar">
				<tr>
					<td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
					<td width="30%" class="drkgrylnk" align="center"><div class="Title">Manage Websites List</div></td>
					<td width="35%" align="right" class="AdminBreadCrumb">
						<table cellpadding="8" cellspacing="0" align="right">
							<tr align="center">
								<!--<td width="57" class="LinkImg" ><a href="<?php //echo url_for('userswebsite/new') ?>" title="Add New"><?php //echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
								Add </a></td>  -->   
							</tr>
						</table>
					</td>
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
												<table width="100%" cellspacing="0" cellpadding="0" align="center" class="">
													<tr>
														<td align="left" valign="top" colspan="2">&nbsp;</td>
													</tr>
													<tr>
														<td align="center" valign="top" class="CasesListSearch" colspan="2">
															<form action="<?php echo url_for('userswebsite/index') ?>" method="post">
																<table width="100%" cellspacing="10" cellpadding="0">
																	<tr>
																		<td width="100" align="left" valign="top"><?php echo $objSearchForm['field_type']->renderLabel(); ?></td>
																		<td width="100" align="left" valign="top"><?php echo $objSearchForm['search_text']->renderLabel(); ?></td>
																		<td align="left" valign="top">&nbsp;</td>
																	</tr>
																	<tr>
																		<td align="left" valign="top"><?php echo $objSearchForm['field_type']->render(array("OnChange"=>"Searchstatus();")); ?></td>
																		<td align="left" valign="top">
																			<?php echo $objSearchForm['search_text']->render(); ?>
																			<?php echo $objSearchForm['search_status']->render(); ?>
																		</td>
																		<td align="left" valign="top"><span class="bluButton">
																			<?php echo tag('input', array('name' => 'search_btn', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
																			<a href="<?php echo url_for('userswebsite/index') ?>" class = 'CommonButton'>Clear</a>
																		</span></td>
																	</tr>
																</table>
															</form>
														</td>
													</tr>
													<tr>
														<td height="20" align="left" valign="top">&nbsp;</td>
													</tr>

													<!--<tr>
														<td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php //echo image_tag("admin/Icon_Groups.gif", array("alt"=>"Users website","title"=>"Users website","align"=>"middle"))?></td>
														<td width="90%" class="ContentBtmDotLn">
															<div style="float:left;" class="Title">Manage Websites List</div>
															<div style="float:right;" class="padrht">
																<form action="<?php //echo url_for('userswebsite/index') ?>" method="post">
																	<span>
																	<?php //echo $objSearchForm['field_type']->renderLabel(); ?>:&nbsp;&nbsp;<?php //echo $objSearchForm['field_type']->render(array("OnChange"=>"Searchstatus();")); ?>&nbsp;&nbsp;
																	<?php //echo $objSearchForm['search_text']->renderLabel(); ?>:</span>&nbsp;&nbsp;<?php //echo $objSearchForm['search_text']->render(); ?>
																	<?php //echo $objSearchForm['search_status']->render(); ?>&nbsp;&nbsp;
																	
																	<?php //echo tag('input', array('name' => 'search_btn', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
																	<a href="<?php //echo url_for('userswebsite/index') ?>" class = 'CommonButton'>Clear</a>
																</form>
															</div>
														</td>
													</tr>-->
													<tr valign="top">
														<td colspan="2" class="dot"></td>
													</tr>
													<?php if($sf_user->hasFlash('errMsg')) { ?>
													<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">
																<tr>
																	<td class="dot2"></td>
																</tr>
																<tr>
																	<td class="errormss" align="center"><?php echo $sf_user->getFlash('errMsg');?>/td>
																</tr>
																<tr>
																	<td class="dot2"></td>
																</tr>
															</table>
														</td>
													</tr>
													<?php }?>
													<?php if($sf_user->hasFlash('succMsg')) { ?>            
													<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">
																<tr>
																	<td class="dot2"></td>
																</tr>
																<tr>
																	<td class="success" align="center"><?php echo $sf_user->getFlash('succMsg');?></td>
																</tr>
																<tr>
																	<td class="dot2"></td>
																</tr>
															</table>
														</td>
													</tr>
													<?php }?>
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
																	<td align="center"><?php include_partial('default/ordering',array('title'=>'Website Url','ordering'=>false,"siteURL"=>'userswebsite/index','alias'=>'Websiteurl','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="20%" align="center"><?php include_partial('default/ordering',array('title'=>'Customer Name','ordering'=>false,"siteURL"=>'userswebsite/index','alias'=>'User','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="13%" align="center"><?php include_partial('default/ordering',array('title'=>'Theme Name','ordering'=>false,"siteURL"=>'userswebsite/index','alias'=>'Name','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="7%" align="center"><?php include_partial('default/ordering',array('title'=>'Status','ordering'=>false,"siteURL"=>'userswebsite/index','alias'=>'Status','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="15%" align="center"><?php include_partial('default/ordering',array('title'=>'Created Date','ordering'=>false,"siteURL"=>'userswebsite/index','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																</tr>
																<?php $i=1;?>
																<?php foreach ($pager->getResults() as $users_website):?>
																<?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
																<tr class="<?php echo $class;?>">
																
																	<td class="fldrowbg" align="left" valign="top"><a target="_blank" href="http://<?php echo $users_website->getWebsiteurl(); ?>"><?php echo $users_website->getWebsiteurl();?></a></td>
																	<td class="fldrowbg" align="left" valign="top"><?php echo link_to($users_website->getUsersWebsiteUsers()->getFirstName()." ".$users_website->getUsersWebsiteUsers()->getLastName(),"dashboard/index?customerId=".$users_website->getUserId())?></td>
																	<?php if($users_website->getUsersWebsiteTheme()->getName()): ?>
																	<td class="fldrowbg" align="left" valign="top"><a rel="lightbox" href="<?php echo $ssSiteUrl; ?>/uploads/Theme/<?php echo $users_website->getUsersWebsiteTheme()->getScreenshot();?>" title="<?php echo $users_website->getUsersWebsiteTheme()->getName() ?>"><?php echo $users_website->getUsersWebsiteTheme()->getName() ?></a></td>
																	<?php else: ?>
																	<td class="fldrowbg" align="left" valign="top"><?php echo "---"; ?></a></td>
																	<?php endif; ?>
																	<td class="fldrowbg" align="left" valign="top"><?php echo $users_website->getStatus() ?></td>
																	<td class="fldrowbg" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'), strtotime($users_website->getCreateDateTime())) ?></td>
																	<!--   <td class="fldrowbg" align="center">
																	<?php 
// 																			if($users_website->getStatus()== sfConfig::get('app_FAQs_Active'))
// 																				echo link_to(image_tag("admin/active.png",array('title'=>'Click here to Inactive Website','alt'=>'Active')),"userswebsite/changeWebsiteStatus?status=".sfConfig::get('app_FAQs_Inactive')."&id=".$users_website->getId());
// 																			else
// 																				echo link_to(image_tag("admin/inactive.png",array('title'=>'Click here to activate Website','alt'=>'Inactive')),"userswebsite/changeWebsiteStatus?status=".sfConfig::get('app_FAQs_Active')."&id=".$users_website->getId());
																	?>
																		<a href="<?php //echo url_for('userswebsite/view?id='.$users_website->getId())?>"><?php //echo image_tag('admin/view.png',array('border'=>'0','alt'=>'View','title'=>'View','width'=>'20px','height'=>'20px'))?></a>
																		<a href="<?php //echo url_for('userswebsite/delete?id='.$users_website->getId())?>"><?php //echo image_tag('admin/Delete_small.gif',array('border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();"))?></a>
																	</td>-->
																</tr>
																<?php endforeach; ?>
																<?php } else { ?> 
																<tr class="fldbg"><td class="errormss">No items found</td></tr>
																<?php } ?>
															</table>
														</td>
													</tr>
													<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
														<?php
															if($orderBy) $varExtra .="&orderBy=$orderBy";
															if($orderType) $varExtra .="&orderType=$orderType";
															if($search_text) $varExtra .="&search_text=".$search_text."&field_type=".$field_type;
															if($search_status) $varExtra .="&search_status=".$search_status."&field_type=".$field_type;
														?>
														<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'userswebsite/index', 'varExtra' => $varExtra));?>
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

<script>
$(document).ready(function() {
	
	var value = $("#SearchUserWebsite_field_type").val();
	if(value == "" || value == "WebsiteURL")
	{
		$("#SearchUserWebsite_search_text").show();
		$("#SearchUserWebsite_search_status").hide();
	}
	else
	{
		$("#SearchUserWebsite_search_text").hide();
		$("#SearchUserWebsite_search_status").show();
	}
 });
 
 function Searchstatus(){
	
	var value = $("#SearchUserWebsite_field_type").val();
	if(value == "" || value == "WebsiteURL")
	{
		$("#SearchUserWebsite_search_text").show();
		$("#SearchUserWebsite_search_status").hide();
	}
	else
	{
		$("#SearchUserWebsite_search_text").hide();
		$("#SearchUserWebsite_search_status").show();
		
	}
 }
</script>