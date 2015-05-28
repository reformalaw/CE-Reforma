<table width="98%" cellspacing="0" cellpadding="0" align="center">
 <?php include_component('customercase', 'profile');?>
  <tr>
    <td align="left" valign="top">
    	<table width="100%" cellspacing="0" cellpadding="0">
			<tr align="center" valign="top">
				<?php include_partial('default/message'); ?>
			</tr>
      <tr>
        <?php include_partial('customercase/verticalheader',array('caseObj' => $case)) ?>
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
                                        <?php include_partial('form', array('form' => $form,'caseId'=>$caseId,'caseNo'=>$caseNo,'bFlag'=>$bFlag)) ?>
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
                                                    
                                                            <tr><td height="10"></td></tr>
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
																	<td class="fldrowbg" align="center" valign="top"><?php echo link_to(image_tag("admin/download.gif",array('title'=>'Click here to Download Document','alt'=>'Download Document')),"casedocuments/downloadinvoice?id=".$case_documents->getId().'&caseId='.$caseId); ?></td>
																	<td class="fldrowbg" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'), strtotime($case_documents->getCreateDateTime())) ?></td>
																	<td class="fldrowbg" align="center">

																	<?php echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>"24px" ,'height'=>"25px" ,'border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")), 'casedocuments/delete?id='.$case_documents->getId().'&bFlag='.$bFlag.'&caseId='.$caseId); ?>
																		<!--	<a href="<?php //echo url_for('casedocuments/edit?id='.$case_documents->getId())?>"><?php //echo image_tag('admin/edit-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit'))?></a>&nbsp;-->
																		<!--<a href="<?php //echo url_for('casedocuments/delete?id='.$case_documents->getId().'&bFlag='.$bFlag)?>"><?php //echo image_tag('admin/Delete_small.gif',array('border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();"))?></a>-->
																	</td>
																</tr>
															<?php endforeach; ?>    
															<?php } else { ?> 
																<tr class="fldbg"><td class="errormss">No documents found.</td></tr>
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
															
															/*mainatain flag*/
															if($bFlag == 1)
															{
																$varExtra.= "&caseId=".$caseId."&bFlag=1&id=".$caseId;
															}
															else
															{
																$varExtra.= "&caseId=".$caseId;
															}
															/*end mainatain flag*/
														?>
												<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'casedocuments/index', 'varExtra' => $varExtra));?>
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