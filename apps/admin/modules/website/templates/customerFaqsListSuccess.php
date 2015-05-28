<table width="98%" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">
		<!--START TOP USER DETAIL-->
		<?php  include_component('website', 'usersDetail');?>
		<!--END TOP USER DETAIL-->
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="150" align="left" valign="top" class="LeftMenu">
			<!--START VERTICAL MENU-->
			<?php include_partial("websiteMenu"); ?>
			<!--END VERTICAL MENU-->
        </td>
        <td align="center" valign="top" class="CashDetails" style="padding:15px 0px;"><table width="98%" cellspacing="10" cellpadding="0">
          <tr>
            <td align="left" valign="top" class="WebsiteDetails"><table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="top"><table width="96%" cellspacing="1" cellpadding="1" class="PageListHeading">
                	<tr>
                        <td align="left" valign="middle" height="10"></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"><strong>FAQs Lists</strong></td>
                        <td align="right" valign="middle">&nbsp;</td>
                      </tr>
                  </table></td>
              </tr>
              <tr>
                <td align="center" valign="top">&nbsp;</td>
              </tr>
              <tr>
              	<td align="center" valign="top" width="98%">
					<?php if(isset($form)): ?>
                        <?php include_partial('form', array('form' => $form,'customerId'=>$customerId)) ?>
                    <?php endif; ?>
                </td>
              </tr>
              <tr>
                <td align="center" valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" valign="top"><table cellspacing="0" cellpadding="0" align="center" width="98%">
													
													<tr valign="top">
														<td colspan="2" class="dot"></td>
													</tr>
													<?php if($sf_user->hasFlash('errMsg')) { ?>
													<tr align="center" valign="top">
														<?php include_partial('default/message'); ?>
													</tr>
													<?php }?>
													<?php if($sf_user->hasFlash('succMsg')) { ?>
													<tr align="center" valign="top">
														<?php include_partial('default/message'); ?>
													</tr>
													<?php }?>
													<?php
														$varExtra = '';
														if($sf_request->getParameter('search_text')) 
															$varExtra .="&search_text=".$sf_request->getParameter('search_text');
													?>
													<tr align="center" valign="top">
														<td colspan="2" class="">
															<table width="98%" cellspacing="1" cellpadding="1" class="brd1">
															<?php if($websiteLit->count() > 0){?>
																<tr class="fldbg">
																	<td class="" width="60%" align="left"><?php include_partial('default/ordering',array('title'=>'Question','ordering'=>false,"siteURL"=>'faq/personalWebsiteList','alias'=>'Question','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td class="" width="20%" align="center"><?php include_partial('default/ordering',array('title'=>'Last Posted Date','ordering'=>false,"siteURL"=>'faq/personalWebsiteList','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td class="whttxt" width="20%" align="center" >Action</td>
																</tr>
																<?php $i=1; foreach ($websiteLit as $fa_qs):?>
																<?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
																<tr class="<?php echo $class;?>">
																	<td align="left" valign="middle" width="60%">
																		<?php
																			if($fa_qs->getWebsiteXFAQsFAQs()->getGloble() == "No"):
																				echo link_to($fa_qs->getWebsiteXFAQsFAQs()->getQuestion(), 'website/customerFaqsList?customerId='.$customerId.'&id='.$fa_qs->getWebsiteXFAQsFAQs()->getId());
																			else: ?>
																				<?php echo $fa_qs->getWebsiteXFAQsFAQs()->getQuestion() ?>
																		<?php endif;?>
																	</td>
																	<td align="center" valign="middle" width="20%"><?php echo date(sfConfig::get('app_dateformat'),strtotime($fa_qs->getCreateDateTime())) ?></td>
																	<td align="center" valign="middle" class="PracticeAreaActionIcons"> <!--ActionIconFAQ-->
																								<!-- START Edit -->
																								<?php
																									if($fa_qs->getWebsiteXFAQsFAQs()->getGloble() == "No"):
																										echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>24,'height'=>25)), 'website/customerFaqsList?customerId='.$customerId.'&id='.$fa_qs->getWebsiteXFAQsFAQs()->getId());
																									else: ?>
																										<a href="#" style="cursor:none;"><?php echo image_tag("admin/blank-img.png",array('width'=>24,'height'=>25)) ; ?></a>
																								<?php endif;?>
																								<!--END Edit -->

																								<!-- START View -->
																									<a onclick="openview('<?php echo $fa_qs->getWebsiteXFAQsFAQs()->getId(); ?>','<?php echo $customerId; ?>');" href="javascript:void(0);"><?php echo image_tag('admin/view-icon.png',array('border'=>'0','alt'=>'View','title'=>'View','width'=>'24px','height'=>25))?></a>
																								<!-- END view-->

																								<!-- START Delete -->
																								<?php
																									if($fa_qs->getWebsiteXFAQsFAQs()->getGloble() == "No"):
																										echo link_to(image_tag('admin/delete-cases-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Click here to Delete Faq','OnClick'=>"return deleteConfirmation();",'width'=>24,'height'=>25)),'website/deleteCustomersFaq?customerId='.$customerId.'&id='.$fa_qs->getId());
																									else:
																										echo link_to(image_tag('admin/delete-cases-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Click here to Delete Faq','OnClick'=>"return deleteConfirmation();",'width'=>24,'height'=>25)),'website/deleteCustomerWebsiteGlobal?customerId='.$customerId.'&id='.$fa_qs->getId());
																									endif;
																								?>
																								<!-- END Delete --></td>
																</tr>
																<?php endforeach; ?>
																<?php } else { ?> 
																<tr class="fldbg"><td class="errormss">No items found.</td></tr>
																<?php } ?>
															</table>
														</td>
													</tr>
                                                    <tr>
									<td align="left" valign="top">&nbsp;</td>
								</tr>
													<tr align="right" valign="top">
														<td colspan="2" class="ListAreaPad">
															<?php
																if($orderBy) $varExtra .="&orderBy=$orderBy";
																if($orderType) $varExtra .="&orderType=$orderType";
															?>
															<?php //include_partial("default/pagging",array('pager' => $pager, '','strUrl' => '@faq_list', 'varExtra' => $varExtra));?>
														</td>
													</tr>
												</table></td>
											</tr>
										<tr>
									<td align="left" valign="top">&nbsp;</td>
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
	<tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
</table>




<script type="text/javascript">

	function openview(id, customerId) {
        $.fancybox.open({
            href : "<?php echo url_for('website/view?id=')?>"+id+"/customerId/"+customerId,
            type : 'iframe',
            padding : 5
        });
	}

</script>



<?php /*?><table width="98%">
<tr>
<td align="left" valign="top">
		<!--START TOP USER DETAIL-->
		<?php  include_component('website', 'usersDetail');?>
		<!--END TOP USER DETAIL-->
</td>
</tr>
</table>

<tr>
	<?php if(isset($form)): ?>
		<?php include_partial('form', array('form' => $form,'customerId'=>$customerId)) ?>
	<?php endif; ?>
</tr>
<!--START VERTICAL MENU-->
<table>
<tr>
<td width="150" align="left" valign="top" class="LeftMenu">
<?php include_partial("websiteMenu"); ?>
</td>
</tr>
</table>
<!--END VERTICAL MENU-->
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="100%">
		<!-- Bread Crumb Start -->
			<table cellspacing="0" cellpadding="0" class="AdminNavBar">
				<tr>
					<td width="66%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
					<td width="34%" align="right" class="AdminBreadCrumb">
						<table cellpadding="8" cellspacing="0" align="right">
							<tr align="center">
								<!--<td width="57" class="LinkImg" ><a href="<?php //echo url_for('faq/new?webId='.$webId.'') ?>" title="Add New"><?php //echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
								Add </a></td>-->
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
												<table cellspacing="0" cellpadding="0" align="center" class="ContentTable">
													<tr>
														<td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php echo image_tag("admin/Icon_Groups.gif", array("alt"=>"Fa qs","title"=>"Fa qs","align"=>"middle"))?></td>
														<td width="90%" class="ContentBtmDotLn">
															<div style="float:left;" class="Title">Website Faqs List</div>
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
															<?php if($websiteLit->count() > 0){?>
																<tr class="fldbg">
																	<td class="border-right border-left border-top" width="60%" align="center"><?php include_partial('default/ordering',array('title'=>'Question','ordering'=>false,"siteURL"=>'faq/personalWebsiteList','alias'=>'Question','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td class="border-right border-top" width="20%" align="center"><?php include_partial('default/ordering',array('title'=>'Last Posted Date','ordering'=>false,"siteURL"=>'faq/personalWebsiteList','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td class="whttxt border-right border-top" width="20%" align="center" >Action</td>
																</tr>
																<tr>
																	<td colspan="3">
																			<?php $i=1; foreach ($websiteLit as $fa_qs):?>
																				
																					<table cellspacing="0" cellpadding="0" width="100%">
																						<?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
																						<tr class="<?php echo $class;?>">
																							<td width="60%" class="fldrowbg border-right border-left" align="left" valign="top"><?php echo $fa_qs->getWebsiteXFAQsFAQs()->getQuestion() ?></td>
																							<td width="20%" class="fldrowbg border-right" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'),strtotime($fa_qs->getCreateDateTime())) ?></td>
																							<td width="20%" class="fldrowbg border-right" align="center">

																								<!-- START Edit -->
																								<?php
																									if($fa_qs->getWebsiteXFAQsFAQs()->getGloble() == "No"):
																										echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>24)), 'website/customerFaqsList?customerId='.$customerId.'&id='.$fa_qs->getWebsiteXFAQsFAQs()->getId());
																									else: ?>
																										<a href="#" style="cursor:none;"><?php echo image_tag("admin/blank-img.png",array('width'=>24)) ; ?></a>
																								<?php endif;?>
																								<!--END Edit -->

																								<!-- START View -->
																									<a onclick="openview('<?php echo $fa_qs->getWebsiteXFAQsFAQs()->getId(); ?>');" href="javascript:void(0);"><?php echo image_tag('admin/view.png',array('border'=>'0','alt'=>'View','title'=>'View','width'=>'20px','height'=>'20px'))?></a>
																								<!-- END view-->

																								<!-- START Delete -->
																								<?php
																									if($fa_qs->getWebsiteXFAQsFAQs()->getGloble() == "No"):
																										echo link_to(image_tag('admin/delete-cases-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Click here to Delete Faq','OnClick'=>"return deleteConfirmation();",'width'=>24)),'website/deleteCustomersFaq?customerId='.$customerId.'&id='.$fa_qs->getId());
																									else:
																										echo link_to(image_tag('admin/delete-cases-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Click here to Delete Faq','OnClick'=>"return deleteConfirmation();",'width'=>24)),'website/deleteCustomerWebsiteGlobal?customerId='.$customerId.'&id='.$fa_qs->getId());
																									endif;
																								?>
																								<!-- END Delete -->
																							</td>
																						</tr>
																					</table>
																			<?php endforeach; ?>
																	</td>
																</tr>
																<?php } else { ?> 
																<tr class="fldbg"><td class="errormss">No Faqs found!</td></tr>
																<?php } ?>
															</table>
														</td>
													</tr>
													<tr align="right" valign="top">
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

