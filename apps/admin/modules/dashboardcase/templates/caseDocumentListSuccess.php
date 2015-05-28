<table width="98%" cellspacing="0" cellpadding="0" align="center">
  <?php  include_component('dashboardcase', 'profile');?>
  <tr>
    <td align="left" valign="top">
    	<table width="100%" cellspacing="0" cellpadding="0">
			<tr align="center" valign="top">
				<?php include_partial('default/message'); ?>
			</tr>
      <tr>
        <?php include_partial('verticalheader',array('caseObj' => $case)) ?>
        <td align="center" valign="top" class="CashDetails" style="padding:10px 0px"><table width="98%" cellspacing="10" cellpadding="0">
           <tr>
                <td align="center" valign="top" class="WebsiteDetails">
                	<table width="98%" cellspacing="1" cellpadding="1">
                    	<tr>
                        	<td height="10"></td>
                        </tr>
                      <tr>
                        <td align="left" valign="middle">
                        	<fieldset>
                                <legend>Case Documents Detail</legend>
                                    <table width="100%" cellspacing="5" cellpadding="0">
                                        <?php include_partial('caseDocumentForm', array('form' => $form,'caseId'=>$caseId,'customerId'=>$customerId)) ?>
                                    </table>
                            </fieldset>
                        </td>
                      </tr>
                      <tr>
                        	<td align="left" valign="top">&nbsp;</td>
                        </tr>
                      <tr>
                        	<td align="left" valign="top">
                            	<table width="100%" cellspacing="1" cellpadding="1" class="PageListHeading">
                                  <tr>
                                    <td align="left" valign="middle"><strong>Case Documents List </strong></td>
                                  </tr>
                              </table>
                            </td>
                        </tr>
                        <tr>
                        	<td align="left" valign="top" height="5"></td>
                        </tr>
                        <tr>
                        	<td align="left" valign="top">
                            	<table cellspacing="0" cellpadding="0" align="center" width="100%">
													<tr valign="top">
														<td colspan="2" class="dot"></td>
													</tr>
													<?php
														$varExtra = '';
														if($sf_request->getParameter('search_text')) 
															$varExtra .="&search_text=".$sf_request->getParameter('search_text');
													?>
													<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<table width="100%" cellspacing="1" cellpadding="1" class="CaseEditForm">
															<?php if($pager->getnbResults() > 0){?>
																<tr class="fldbg">

																	<td align="center"><?php include_partial('default/ordering',array('title'=>'Document Name','ordering'=>false,"siteURL"=>'casedocuments/index','alias'=>'Bill document real name','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td align="center"><?php include_partial('default/ordering',array('title'=>'Download Document','ordering'=>false,"siteURL"=>'casedocuments/index','alias'=>'Bill document system name','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td align="center"><?php include_partial('default/ordering',array('title'=>'Posted Date','ordering'=>false,"siteURL"=>'casedocuments/index','alias'=>'Create date time','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="20%" align="center" class="whttxt">Action</td>
																</tr>

															<?php foreach ($pager->getResults() as $case_documents):?>
																<tr>
																	<td class="fldrowbg" align="left" valign="top"><?php echo $case_documents->getBillDocumentRealName() ?></td>
																	<td class="fldrowbg" align="center" valign="top"><?php echo link_to(image_tag("admin/download.gif",array('title'=>'Click here to Download Document','alt'=>'Download Document')),"casedocuments/downloadinvoice?id=".$case_documents->getId()); ?></td>
																	<td class="fldrowbg" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'), strtotime($case_documents->getCreateDateTime())) ?></td>
																	<td class="fldrowbg" align="center">
																		<?php echo link_to(image_tag('admin/delete-cases-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Click here to Delete Document','OnClick'=>"return deleteConfirmation();",'width'=>24)),'dashboardcase/deleteCaseDocument?id='.$case_documents->getId().'&customerId='.$customerId)?>
																	</td>
																</tr>
															<?php endforeach; ?>
															<?php } else { ?> 
																<tr class="fldbg"><td class="errormss">No items found.</td></tr>
															<?php } ?>
															</table>
														</td>
													</tr>
                                                    <tr><td height="15"></td></tr>
													<tr> <!--align="right" valign="top"-->
														<td align="center" valign="Top" colspan="2" class="ListAreaPad">
														<?php
															if($orderBy) $varExtra .="&orderBy=$orderBy";
															if($orderType) $varExtra .="&orderType=$orderType";
															
																$varExtra.= "&caseId=".$caseId."&customerId=".$customerId;
														?>
														<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'dashboardcase/caseDocumentList', 'varExtra' => $varExtra));?>
														</td>
													</tr>
                                                     <tr><td height="15"></td></tr>
												</table>
                            </td>
                        </tr>
                  </table>
                </td>
           </tr>
			
        </table></td>
      </tr>
      
    </table>
    </td>
  </tr>
</table>








<?php /*?><table>
	<tr>
		<td>
			<?php include_partial('verticalheader',array('caseObj' => $case)) ?>
		</td>
	</tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<?php include_partial('caseDocumentForm', array('form' => $form,'caseId'=>$caseId,'customerId'=>$customerId)) ?>
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
												<table cellspacing="0" cellpadding="0" align="center" class="ContentTable">
													<tr>
														<td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php echo image_tag("admin/Icon_Groups.gif", array("alt"=>"Case documents","title"=>"Case documents","align"=>"middle"))?></td>
														<td width="90%" class="ContentBtmDotLn">
															<div style="float:left;" class="Title">Case documents list </div>
															<div style="float:right;" class="padrht">
															</div>
														</td>
													</tr>
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
													?>
													<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<table width="95%" cellspacing="1" cellpadding="1" class="brd1">
															<?php if($pager->getnbResults() > 0){?>
																<tr class="fldbg">

																	<td align="center"><?php include_partial('default/ordering',array('title'=>'Document Name','ordering'=>false,"siteURL"=>'casedocuments/index','alias'=>'Bill document real name','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td align="center"><?php include_partial('default/ordering',array('title'=>'Download Document','ordering'=>false,"siteURL"=>'casedocuments/index','alias'=>'Bill document system name','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td align="center"><?php include_partial('default/ordering',array('title'=>'Create date time','ordering'=>false,"siteURL"=>'casedocuments/index','alias'=>'Create date time','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="20%" align="center" class="whttxt">Action</td>
																</tr>

															<?php foreach ($pager->getResults() as $case_documents):?>
																<tr>
																	<td class="fldrowbg" align="left" valign="top"><?php echo $case_documents->getBillDocumentRealName() ?></td>
																	<td class="fldrowbg" align="center" valign="top"><?php echo link_to(image_tag("admin/download.gif",array('title'=>'Click here to download Invoice','alt'=>'Download Invoice')),"casedocuments/downloadinvoice?id=".$case_documents->getId()); ?></td>
																	<td class="fldrowbg" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'), strtotime($case_documents->getCreateDateTime())) ?></td>
																	<td class="fldrowbg" align="center">
																		<?php echo link_to(image_tag('admin/delete-cases-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Click here to Delete Document','OnClick'=>"return deleteConfirmation();",'width'=>24)),'dashboardcase/deleteCaseDocument?id='.$case_documents->getId().'&customerId='.$customerId)?>
																	</td>
																</tr>
															<?php endforeach; ?>
															<?php } else { ?> 
																<tr class="fldbg"><td class="errormss">No documents found!</td></tr>
															<?php } ?>
															</table>
														</td>
													</tr>
													<tr align="right" valign="top">
														<td colspan="2" class="ListAreaPad">
														<?php
															if($orderBy) $varExtra .="&orderBy=$orderBy";
															if($orderType) $varExtra .="&orderType=$orderType";
															
																$varExtra.= "&caseId=".$caseId."&customerId=".$customerId;
														?>
														<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'dashboardcase/caseDocumentList', 'varExtra' => $varExtra));?>
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
</table><?php */?>