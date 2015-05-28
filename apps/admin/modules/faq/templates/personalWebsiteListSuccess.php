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
						<!--<span class="noteDisplay" style="float:right;"><strong>Note: </strong>You can create your own custom FAQs or add premade ones from the Global List</span>-->
						<tr>
							<td align="left" valign="top" class="WebsiteTab">
								
								<?php include_partial('personalcms/horizontalMenu');?>
								<!--<table width="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td width="10" class="BorderBottom">&nbsp;</td>
										<td width="150" align="center" valign="middle" class="SelectTab">Manage Website FAQs</td>
										<td width="2" align="center" valign="middle" class="BorderBottom"></td>
										<td width="110" align="center" valign="middle" class="DeSelectTab">
											<?php //echo link_to("Global FAQs List","faq/globalfaqs")?>
										</td>
										<td width="2" align="center" valign="middle" class="BorderBottom"></td>
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
											<table cellspacing="0" cellpadding="0" align="center" width="100%">		
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
												<tr>
													<?php include_partial('formWebsite', array('form' => $form,'noSubmitButton'=>true,'hiddenWebsiteId'=>$webId)) ?>
												</tr>
												<tr>
													<td align="center" valign="top">
														<table width="98%" cellspacing="1" cellpadding="1" class="PageListHeading">
															<tr>
																<td align="left" valign="middle"><strong>Website FAQs List </strong></td>
																<td align="right" valign="middle" ><div class="noteDisplay" style="display:none;"><strong > Note: </strong>  Please click and drag to change the order of display</div>  </td>
															</tr>
														</table>
													</td>
												</tr>
												
												<?php if($websiteLit->count() > 1): ?>
                                                <tr>
													<td height="5">
	                                                   <table width="98%" cellspacing="1" cellpadding="1">	
	                                                       <tr>
	                                                           <td  style="padding-left:10px;">
													               <div class="noteDisplay"><strong> Note: </strong>  Please click and drag to change the order of display</div>
													           </td>    
													       </tr>											
													   </table>
    											   </td>
												</tr>
												<?php endif; ?>
												
												<tr align="center" valign="top">
														<td colspan="3" class="ListAreaPad">
															<table width="98%" cellspacing="1" cellpadding="1" class="brd1">
                                                            
															<?php if($websiteLit->count() > 0){?><!-- if($pager->getnbResults() > 0) -->
																<tr class="fldbg">
																	<td class="border-right border-left border-top" width="60%" align="center"><?php include_partial('default/ordering',array('title'=>'Question','ordering'=>false,"siteURL"=>'faq/personalWebsiteList','alias'=>'Question','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td class="border-right border-top" width="20%" align="center"><?php include_partial('default/ordering',array('title'=>'Last Posted Date','ordering'=>false,"siteURL"=>'faq/personalWebsiteList','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td class="whttxt border-right border-top" width="20%" align="center" >Action</td>
																</tr>
																<!-- Start Drag Drop Area -->
																<tr>
																	<td colspan="3">
																		<div id="contentLeft">
																			<ul>
																			<?php foreach ($websiteLit as $fa_qs):?> <!-- ->getResults() -->
																				<li  id="recordsArray_<?php echo $fa_qs->getId(); ?>">
																					<table cellspacing="0" cellpadding="0" width="100%">
																						<tr>
																							<td width="60%" class="fldrowbg border-right border-left" align="left" valign="top">
																								<?php
																									if($fa_qs->getWebsiteXFAQsFAQs()->getGloble() == "No"):?>
																										<?php echo link_to($fa_qs->getWebsiteXFAQsFAQs()->getQuestion(),'faq/personalWebsiteList?webId='.$webId.'&id='.$fa_qs->getWebsiteXFAQsFAQs()->getId());?>
																								<?php else: ?>
																									<?php echo $fa_qs->getWebsiteXFAQsFAQs()->getQuestion() ?>
																								<?php endif;?>
																							</td>
																							<td width="20%" class="fldrowbg border-right" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'),strtotime($fa_qs->getCreateDateTime())) ?></td>
																							<td width="20%" class="fldrowbg border-right" align="center">
		
																								<!-- START Active Inactive -->
																								<?php
																								if($fa_qs->getWebsiteXFAQsFAQs()->getStatus() == sfConfig::get('app_FAQs_Active')):
																								if($fa_qs->getStatus()==sfConfig::get('app_FAQs_Active'))
																								echo link_to(image_tag("admin/active-cases-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip'),'alt'=>'Active')),"faq/changeStatusPersonalWebsite?webId=".$webId."&status=".sfConfig::get('app_FAQs_Inactive')."&id=".$fa_qs->getId());
																								else
																								echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'),'alt'=>'Inactive')),"faq/changeStatusPersonalWebsite?webId=".$webId."&status=".sfConfig::get('app_FAQs_Active')."&id=".$fa_qs->getId());
																									else: ?>
																										<a href="#" style="cursor:none;"><?php echo image_tag("admin/blank-img.png",array('width'=>'24px','height'=>'25px')) ; ?></a>
																									<?php endif;
																								?>
																								<!-- END Active Inactive-->

																								<!-- START Edit -->
																								<?php
																									if($fa_qs->getWebsiteXFAQsFAQs()->getGloble() == "No"):?>
																										<?php echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'24px','height'=>'25px')),'faq/personalWebsiteList?webId='.$webId.'&id='.$fa_qs->getWebsiteXFAQsFAQs()->getId());?>
																								<?php
																								else:
																								?>
																									<a href="#" style="cursor:none;"><?php echo image_tag("admin/blank-img.png",array('width'=>'24px','height'=>'25px')) ; ?></a>
																								<?php endif;?>
																								<!--END Edit -->

																								<!-- START View -->
																									
																									<a onclick="openview('<?php echo $fa_qs->getWebsiteXFAQsFAQs()->getId(); ?>','<?php echo $webId; ?>');" href="javascript:void(0);"><?php echo image_tag('admin/view-icon.png',array('border'=>'0','alt'=>'View','title'=>'View','width'=>'24px','height'=>'25px'))?></a>
																									
																								<!-- END view-->

																								<!-- START Delete -->
																								<?php
																									if($fa_qs->getWebsiteXFAQsFAQs()->getGloble() == "No"):?>
																									<?php echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")), 'faq/deletePersonalFaqs?webId='.$webId.'&id='.$fa_qs->getId()); ?>
																								<?php
																								else:
																								?>
																									<?php echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")),'faq/deletePersonalWebsiteGlobal?webId='.$webId.'&id='.$fa_qs->getId()); ?>
																								<?php endif;?>
																								<!-- END Delete -->
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
										<td align="left" valign="top" height="25"></td>
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

function openview(id,webId) {
    $.fancybox.open({
        href : "<?php echo url_for('faq/view?id=')?>"+id+"/webId/"+webId,
        type : 'iframe',
        padding : 5
    });
}

jQuery().ready(function() {

    $(function()
    {
        $("#contentLeft ul").sortable({ opacity: 0.6, cursor: 'move', update: function()
        {
            var order = $(this).sortable("serialize") ;
            $.post("<?php echo url_for("faq/globelOrdering"); ?>", order, function(theResponse){});
        }
        });
    });

});

</script>