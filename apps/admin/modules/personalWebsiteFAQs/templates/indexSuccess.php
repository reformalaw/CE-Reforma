<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="100%">
		<!-- Bread Crumb Start -->
			<table cellspacing="0" cellpadding="0" class="AdminNavBar">
				<tr>
					<td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
					<td width="30%" class="drkgrylnk" align="center"><div class="Title">Personal Website FAQs List</div></td>
					<td width="35%" align="right" class="AdminBreadCrumb">
						<table cellpadding="8" cellspacing="0" align="right">
							<tr align="center">
								<!--<td width="57" class="LinkImg" ><a href="<?php //echo url_for('personalWebsiteFAQs/new') ?>" title="Add New"><?php //echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
								Add </a></td>    --> 
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
														<!--<td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php //echo image_tag("admin/Icon_Groups.gif", array("alt"=>"Website xfa qs","title"=>"Website xfa qs","align"=>"middle"))?></td>-->
														<!--<td width="90%" class="ContentBtmDotLn">
															<div style="float:left;" class="Title">Personal Website FAQs List</div>
															<div style="float:right;" class="padrht">-->
																<form action="<?php echo url_for('personalWebsiteFAQs/index') ?>" method="post">
																<table width="100%" cellspacing="10" cellpadding="0">
																<tr>
																	<td width="220" align="left" valign="top"><?php echo $objSearchForm['field_type']->renderLabel(); ?></td>
																	<td align="left" valign="top">&nbsp;</td>
																</tr>
																<tr>
																	<td align="left" valign="top"><?php echo $objSearchForm['field_type']->render(); ?></td>
																	<td align="left" valign="top">
																		<span class="bluButton">
																		<?php echo tag('input', array('name' => 'search_btn', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
																		<a href="<?php echo url_for('personalWebsiteFAQs/index') ?>" class= 'CommonButton'>Clear</a>
																		</span>
																	</td>
																</tr>
																<tr>
																	<td height="1" colspan="5" align="left" valign="top"></td>
																</tr>
																</table>
																</form>
															<!--</div>-->
														</td>
													</tr>
													<tr>
														<td height="20" align="left" valign="top">&nbsp;</td>
													</tr>

													<!--success message partial-->
													<?php include_partial('default/message'); ?>

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
																	<td align="center"><?php include_partial('default/ordering',array('title'=>'Question','ordering'=>false,"siteURL"=>'personalWebsiteFAQs/index','alias'=>'Question','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td align="center"><?php include_partial('default/ordering',array('title'=>'Website','ordering'=>false,"siteURL"=>'personalWebsiteFAQs/index','alias'=>'Website','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Posted Date','ordering'=>false,"siteURL"=>'personalWebsiteFAQs/index','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="20%" align="center" class="whttxt">Action</td>
																</tr>
																<?php $i=1; ?>
																<?php foreach ($pager->getResults() as $website_xfa_qs):?>
																<?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
																<tr class="<?php echo $class;?>">
																	<td class="fldrowbg" align="left" valign="middle">
																		<?php echo link_to($website_xfa_qs->getWebsiteXFAQsFAQs()->getQuestion(),'personalWebsiteFAQs/edit?webId='.$website_xfa_qs->getWebsiteId().'&id='.$website_xfa_qs->getFAQId());?>
																		<?php //echo $website_xfa_qs->getWebsiteXFAQsFAQs()->getQuestion() ?>
																	</td>
																	<td class="fldrowbg" align="left" valign="middle"><?php echo $website_xfa_qs->getWebsiteXFAQsUsersWebsite()->getWebsiteurl(); ?></td>
																	<td class="fldrowbg" align="center" valign="middle"><?php echo date(sfConfig::get('app_dateformat'), strtotime($website_xfa_qs->getCreateDateTime())) ?></td>
																	<td class="fldrowbg" align="center" valign="middle">
																		<!-- START Active Inactive -->
																		<?php
// 
// 																			if($website_xfa_qs->getStatus()==sfConfig::get('app_FAQs_Active'))
// 																				echo link_to(image_tag("admin/active.png",array('title'=>'Click here to Inactive Question','alt'=>'Active')),"personalWebsiteFAQs/changeStatus?status=".sfConfig::get('app_FAQs_Inactive')."&id=".$website_xfa_qs->getId());
// 																			else
// 																				echo link_to(image_tag("admin/inactive.png",array('title'=>'Click here to activate this Question','alt'=>'Inactive')),"personalWebsiteFAQs/changeStatus?status=".sfConfig::get('app_FAQs_Active')."&id=".$website_xfa_qs->getId());
 																		?>
																		<!-- END Active Inactive-->
																		<?php echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'24px','height'=>'25px')),'personalWebsiteFAQs/edit?webId='.$website_xfa_qs->getWebsiteId().'&id='.$website_xfa_qs->getFAQId());?>
																		<a onclick="openview('<?php echo $website_xfa_qs->getId(); ?>');" href="javascript:void(0);"><?php echo image_tag('admin/view-icon.png',array('border'=>'0','alt'=>'View','title'=>'View','width'=>'24px','height'=>'25px'))?></a>
																		<?php //echo link_to(image_tag('admin/view-icon.png',array('border'=>'0','alt'=>'View','title'=>'View','width'=>'24px','height'=>'25px')), 'personalWebsiteFAQs/viewPersonalWeb?id='.$website_xfa_qs->getId());?>
																		<?php echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")), 'personalWebsiteFAQs/delete?id='.$website_xfa_qs->getId())?>
																		<!--<a href="<?php //echo url_for('personalWebsiteFAQs/edit?webId='.$website_xfa_qs->getWebsiteId().'&id='.$website_xfa_qs->getFAQId())?>"><?php //echo image_tag('admin/edit-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'20px','height'=>'20px'))?></a>
																		<a href="<?php //echo url_for('personalWebsiteFAQs/viewPersonalWeb?id='.$website_xfa_qs->getId())?>"><?php //echo image_tag('admin/view.png',array('border'=>'0','alt'=>'View','title'=>'View','width'=>'20px','height'=>'20px'))?></a>
																		<a href="<?php //echo url_for('personalWebsiteFAQs/delete?id='.$website_xfa_qs->getId())?>"><?php //echo image_tag('admin/Delete_small.gif',array('border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();"))?></a>-->
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
																$varExtra .="&field_type=".$field_type;
															?>
															<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'personalWebsiteFAQs/index', 'varExtra' => $varExtra));?>
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
<script type="text/javascript">
function openview(id,webId) {
        $.fancybox.open({
            href : "<?php echo url_for('personalWebsiteFAQs/viewPersonalWeb?id=')?>"+id,
            type : 'iframe',
            padding : 5
        });
	}
</script>