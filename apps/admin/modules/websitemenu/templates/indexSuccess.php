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
										<td width="110" align="center" valign="middle" class="SelectTab">Header Menu List</td>
										<td width="2" align="center" valign="middle" class="BorderBottom"></td>
										<td width="110" align="center" valign="middle" class="DeSelectTab">
											<?php //echo link_to("Add Header Menu", "websitemenu/new"); ?>
										</td>
										<td width="2" align="center" valign="middle" class="BorderBottom"></td>
										<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select header menu to edit');" href="javascript:void(0)">Edit Header Menu</a></td>
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
													<td align="left" valign="middle"><strong>Header Menu List</strong></td>
												</tr>
											</table>
										</td>
									</tr>
									<?php if($pager->getnbResults() > 1): ?>
									<tr>
										<td align="left" valign="top" ><div class="noteDisplay" style="padding: 0 0 0 12px;" ><strong > Note: </strong>  Please click and drag to change the order of display</div>  </td>
									</tr>
									<?php endif; ?>
									<tr>
										<td align="center" valign="top">
											<table width="100%" cellspacing="0" cellpadding="0" align="center" >
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
													?>
													<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<table width="98%" cellspacing="1" cellpadding="1" class="brd1">
																<?php if($pager->getnbResults() > 0){?>
																<tr class="fldbg">
																	<td width="30%" align="center"><?php include_partial('default/ordering',array('title'=>'Title','ordering'=>false,"siteURL"=>'websitemenu/index','alias'=>'Title','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Type','ordering'=>false,"siteURL"=>'websitemenu/index','alias'=>'Type','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="15%" align="center"><?php include_partial('default/ordering',array('title'=>'Parent','ordering'=>false,"siteURL"=>'websitemenu/index','alias'=>'ParentId','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="15%" align="center"><?php include_partial('default/ordering',array('title'=>'Pages/Practice Area','ordering'=>false,"siteURL"=>'websitemenu/index','alias'=>'ParentId','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Posted Date','ordering'=>false,"siteURL"=>'websitemenu/index','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="20%" align="center" class="whttxt">Action</td>
																</tr>
																<!-- Start Drag Drop Area -->
																<tr>
																	<td colspan="6">
																		<div id="contentLeft">
																			<ul>
																			<?php foreach ($pager->getResults() as $website_menu):?>
																				<li  id="recordsArray_<?php echo $website_menu->getId(); ?>" style="list-style-type: none;">
																					<table cellspacing="0" cellpadding="0" width="100%">
																						<tr>
																							<td width="30%" class="fldrowbg border-right border-left" align="left" valign="top">
																								<?php echo link_to($website_menu->getTitle(),'websitemenu/edit?id='.$website_menu->getId()); ?>
																								<?php //echo $website_menu->getTitle() ?>
																							</td>
																							<td width="10%" class="fldrowbg border-right" align="left" valign="top">
																								<?php
																									if($website_menu->getType() == 1)
																										echo sfCOnfig::get("app_MenuUniqueType_Pages");
																									elseif($website_menu->getType() == 2)
																										echo sfConfig::get("app_MenuUniqueType_PracticeArea");
																									elseif($website_menu->getType() == 3)
																										echo sfConfig::get("app_MenuUniqueType_External");
																								?>
																							</td>
																							<td width="15%" class="fldrowbg border-right" align="left" valign="top"><?php echo ($website_menu->getParentId() != 0 ) ?$asTitle[$website_menu->getParentId()] : "Main Menu"; ?></td>
																							<td width="15%" class="fldrowbg border-right" align="left" valign="top">
																								<?php
																									echo ($website_menu->getCmsPageId() != 0 ) ? $website_menu->getWebsiteMenuCMSPages()->getTitle() : $website_menu->getWebsiteMenuWebsitePracticeArea()->getTitle(); 
																								?>
																							</td>
																							<td width="10%" class="fldrowbg border-right" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'), strtotime($website_menu->getCreateDateTime())) ?></td>
																							<td width="20%" class="fldrowbg border-right" align="center">
																								<?php echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'24px','height'=>'25px')),'websitemenu/edit?id='.$website_menu->getId()); ?>
																								<?php //echo link_to(image_tag('admin/view-icon.png',array('border'=>'0','alt'=>'View','title'=>'View','width'=>'24px','height'=>'25px')), 'websitemenu/view?id='.$website_menu->getId()); ?>
																								<?php echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px', 'border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")),'websitemenu/delete?id='.$website_menu->getId()); ?>
																							</td>
																						</tr>
																					</table>
																				
																					<!-- Start chiled menu listing -->
																					<div id="contentChiled">
																					<ul>
																					<?php
																						$websiteChiledMenus =  WebsiteMenuTable::getChiledMenuList($website_menu->getWebsiteId(), $website_menu->getId());
																						foreach($websiteChiledMenus as $websiteChiledMenu):
																					?>
																							<li  id="recordsArray_<?php echo $websiteChiledMenu->getId(); ?>" style="list-style-type: none;">
																								<table cellspacing="0" cellpadding="0" width="100%">
																									<tr>
																										<td width="30%" class="chledFirstRow border-right border-left" align="left" valign="top">
																											<?php echo link_to($websiteChiledMenu->getTitle(),'websitemenu/edit?id='.$websiteChiledMenu->getId()); ?>
																											<?php //echo $websiteChiledMenu->getTitle() ?>
																										</td>
																										<td width="10%" class="chledOtherRow border-right" align="left" valign="top">
																											<?php
																												if($websiteChiledMenu->getType() == 1)
																													echo sfCOnfig::get("app_MenuUniqueType_Pages");
																												elseif($websiteChiledMenu->getType() == 2)
																													echo sfConfig::get("app_MenuUniqueType_PracticeArea");
																												elseif($websiteChiledMenu->getType() == 3)
																													echo sfConfig::get("app_MenuUniqueType_External");
																											?>
																										</td>
																										<td width="15%" class="chledOtherRow border-right" align="left" valign="top"><?php echo ($websiteChiledMenu->getParentId() != 0 ) ?$asTitle[$websiteChiledMenu->getParentId()] : "Main Menu"; ?></td>
																										<td width="15%" class="chledOtherRow border-right" align="left" valign="top">
																											<?php
																												echo ($websiteChiledMenu->getCmsPageId() != 0 ) ? $websiteChiledMenu->getWebsiteMenuCMSPages()->getTitle() : $websiteChiledMenu->getWebsiteMenuWebsitePracticeArea()->getTitle(); 
																											?>
																										</td>
																										<td width="10%" class="chledOtherRow border-right" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'), strtotime($websiteChiledMenu->getCreateDateTime())) ?></td>
																										<td width="20%" class="chledOtherRow border-right" align="center">
																											<?php echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'24px','height'=>'25px')),'websitemenu/edit?id='.$websiteChiledMenu->getId()); ?>
																											<?php //echo link_to(image_tag('admin/view-icon.png',array('border'=>'0','alt'=>'View','title'=>'View','width'=>'24px','height'=>'25px')), 'websitemenu/view?id='.$website_menu->getId()); ?>
																											<?php echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px', 'border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")),'websitemenu/delete?id='.$websiteChiledMenu->getId()); ?>
																										</td>
																									</tr>
																								</table>
																							</li>
																						</li>
																					<?php endforeach; ?>
																					</ul>
																					</div>
																					<!-- End chiled menu listing -->
																				<?php endforeach; ?>
																			</ul>
																		</div>
																	</td>
																</tr>
																<!-- END Drag Drop Area-->
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
															<?php //include_partial("default/pagging",array('pager' => $pager, '','strUrl' => '@faq_list', 'varExtra' => $varExtra));?>
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


<script type="text/javascript">
	$(document).ready(function()
	{
		/* this function is for parent menu */
		$(function() 
		{
			$("#contentLeft ul").sortable({ opacity: 0.6, cursor: 'move', update: function()
			{
				var order = $(this).sortable("serialize") ;
				$.post("<?php echo url_for("websitemenu/menuOrdering"); ?>", order, function(theResponse){});
			}
			});
		});
		
		/* this function is for chiled  menu */
		$(function() 
		{
			$("#contentChiled ul").sortable({ opacity: 0.6, cursor: 'move', update: function()
			{
				var order = $(this).sortable("serialize") ;
				$.post("<?php echo url_for("websitemenu/menuOrdering"); ?>", order, function(theResponse){});
			}
			});
		});

	});
</script>