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
										<td width="110" align="center" valign="middle" class="SelectTab">Footer Menu List</td>
										<td width="2" align="center" valign="middle" class="BorderBottom"></td>
										<td width="110" align="center" valign="middle" class="DeSelectTab">
											<?php //echo link_to("Add Footer Menu", "footermenu/new"); ?>
										</td>
										<td width="2" align="center" valign="middle" class="BorderBottom"></td>
										<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select footer menu to edit');" href="javascript:void(0)">Edit Footer Menu</a></td>
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
													<td align="left" valign="middle"><strong>Footer Menu List</strong></td>
												</tr>
											</table>
										</td>
									</tr>
									<?php if($pager->count() > 1): ?>
									<tr>
										<td align="left" valign="middle" ><div class="noteDisplay" style="padding: 0 0 0 12px;"><strong > Note: </strong>  Please click and drag to change the order of display</div>  </td>
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
																<?php if($pager->count() > 0){?>
																<tr class="fldbg">
																	<td width="30%" align="center"><?php include_partial('default/ordering',array('title'=>'Title','ordering'=>false,"siteURL"=>'websitemenu/index','alias'=>'Title','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Type','ordering'=>false,"siteURL"=>'websitemenu/index','alias'=>'Type','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="15%" align="center"><?php include_partial('default/ordering',array('title'=>'Pages/Practice Area','ordering'=>false,"siteURL"=>'websitemenu/index','alias'=>'ParentId','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Posted Date','ordering'=>false,"siteURL"=>'websitemenu/index','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="20%" align="center" class="whttxt">Action</td>
																</tr>
																<!-- Start Drag Drop Area -->
																<tr>
																	<td colspan="5">
																		<div id="contentLeft">
																			<ul>
																			<?php foreach ($pager as $footerMenu):?> <!-- ->getResults() -->
																				<li  id="recordsArray_<?php echo $footerMenu->getId(); ?>">
																					<table cellspacing="0" cellpadding="0" width="100%">
																						<tr>
																							<td width="30%" class="fldrowbg border-right border-left" align="left" valign="top">
																								<?php echo link_to($footerMenu->getTitle(),'footermenu/edit?id='.$footerMenu->getId()); ?>
																								<?php //echo $footerMenu->getTitle() ?>
																							</td>
																							<td width="10%" class="fldrowbg border-right" align="left" valign="top">
																								<?php
																									if($footerMenu->getType() == 1)
																										echo sfCOnfig::get("app_MenuUniqueType_Pages");
																									elseif($footerMenu->getType() == 2)
																										echo sfConfig::get("app_MenuUniqueType_PracticeArea");
																									elseif($footerMenu->getType() == 3)
																										echo sfConfig::get("app_MenuUniqueType_External");
																								?>
																							</td>
																							<td width="15%" class="fldrowbg border-right" align="left" valign="top">
																								<?php
																									echo ($footerMenu->getCmsPageId() != 0 ) ? $footerMenu->getWebsiteMenuCMSPages()->getTitle() : $footerMenu->getWebsiteMenuWebsitePracticeArea()->getTitle(); 
																								?>
																							</td>
																							<td width="10%" class="fldrowbg border-right" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'), strtotime($footerMenu->getCreateDateTime())) ?></td>
																							<td width="20%" class="fldrowbg border-right" align="center">
																								<?php echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'24px','height'=>'25px')),'footermenu/edit?id='.$footerMenu->getId()); ?>
																								<?php echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px', 'border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")),'footermenu/delete?id='.$footerMenu->getId()); ?>
																							</td>
																						</tr>
																					</table>
																				</li>
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
		$(function() 
		{
			$("#contentLeft ul").sortable({ opacity: 0.6, cursor: 'move', update: function()
			{
			var order = $(this).sortable("serialize") ;
			$.post("<?php echo url_for("footermenu/footerMenuOrdering"); ?>", order, function(theResponse){});
			}
			});
		});

	});

</script>