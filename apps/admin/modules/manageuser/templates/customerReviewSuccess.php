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
						
						<?php if($customerId != "") : ?>
							<!-- when display from dashboard-->
							<?php include_partial('dashboard/profileMenu');?>
						<?php else: ?>
							<?php include_partial('administrators/profileMenu');?>
						<?php endif; ?>
						<!--END VERTICAL MENU-->
					</td>
					<td align="center" valign="top" class="CashDetails">
					<table width="96%" cellspacing="0" cellpadding="0">
						<tr>
							<td align="left" valign="top" height="25">&nbsp;</td>
						</tr>
						<tr>
							<td align="left" valign="top" class="WebsiteDetails">
								<table width="100%" cellspacing="10" cellpadding="0" style="border-top: 1px solid #E7E7E7;">
									<tr>
										<td align="center" valign="top">
											<table width="98%" cellspacing="1" cellpadding="1" class="PageListHeading">
												<tr>
													<td align="left" valign="middle"><strong>Review Rating</strong></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td align="center" valign="top">
											<table width="100%" cellspacing="0" cellpadding="0">
										<tr>
											<td class="ContentPad">
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
													<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<table width="98%" cellspacing="1" cellpadding="1" class="brd1">
															<?php if($pager->getnbResults() > 0){?>
																<tr class="fldbg">
																	<td width="15%" align="center"><?php include_partial('default/ordering',array('title'=>'Reviewed By','ordering'=>false,"siteURL"=>'manageuser/customerReview','alias'=>'Theme','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Rate','ordering'=>false,"siteURL"=>'manageuser/customerReview','alias'=>'Rate','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="45%" align="center"><?php include_partial('default/ordering',array('title'=>'Review','ordering'=>false,"siteURL"=>'manageuser/customerReview','alias'=>'Review','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Mark Review As Spam','ordering'=>false,"siteURL"=>'manageuser/customerReview','alias'=>'Spam','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Posted Date','ordering'=>false,"siteURL"=>'manageuser/customerReview','alias'=>'CreateDateTime ','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="10%" align="center" class="whttxt">Action</td>
																</tr>
															<?php $j=1; ?>
															<?php foreach ($pager->getResults() as $customerReview):?>
																<?php $class=$j++%2==0?"fldrowbgAlt":"fldrowbg";?>
																<tr class="<?php echo $class;?>">
																	<td class="fldrowbg" align="left" valign="top">
																		<?php echo ucwords($customerReview->getReviewRatingUsers()->getFirstName()." ".$customerReview->getReviewRatingUsers()->getLastName()); ?>
																	</td>
																	<td class="fldrowbg" align="middle" valign="top"><?php echo clsCommon::displayRatingStar($customerReview->getRate())."  (".$customerReview->getRate().")"; ?></td>
																	<td class="fldrowbg" align="left" valign="top"><?php echo nl2br($customerReview->getReview()); ?></td>
																	<td class="fldrowbg" align="middle" valign="top">
																		<?php if($customerReview->getSpam() == 1): ?>
																			<input type="checkbox" checked=true id="review_<?php echo $customerReview->getId()?>" onClick="InsertSpam('<?php echo $customerReview->getId()?>');">
																		<?php else: ?>
																			<input type="checkbox"  id="review_<?php echo $customerReview->getId()?>" onClick="InsertSpam('<?php echo $customerReview->getId()?>');">
																		<?php endif; ?>
																	</td>
																	<td class="fldrowbg" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'), strtotime($customerReview->getCreateDateTime())) ?></td>
																	<td width="10%" class="fldrowbg PracticeAreaActionIcons" align="center" valign="top">
																		<?php
																			if($customerReview->getStatus()== sfConfig::get('app_Status_Active'))
																			{
																				if($customerId != "")
																					echo link_to(image_tag("admin/active-cases-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip'),'alt'=>'Active')),"manageuser/changeReviewStatus?status=".sfConfig::get('app_Status_Inactive')."&id=".$customerReview->getId()."&flag=dashboard&customerId=".$customerId);
																				else
																					echo link_to(image_tag("admin/active-cases-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip'),'alt'=>'Active')),"manageuser/changeReviewStatus?status=".sfConfig::get('app_Status_Inactive')."&id=".$customerReview->getId()."&flag=customer");
																			}
																			else
																			{
																				if($customerId != "")
																					echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'),'alt'=>'Inactive')),"manageuser/changeReviewStatus?status=".sfConfig::get('app_Status_Active')."&id=".$customerReview->getId()."&flag=dashboard&customerId=".$customerId);
																				else
																					echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'),'alt'=>'Inactive')),"manageuser/changeReviewStatus?status=".sfConfig::get('app_Status_Active')."&id=".$customerReview->getId()."&flag=customer");
																			}
																		?>
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
														// when display from dashboard
														if($customerId != "") $varExtra .="&customerId=$customerId";
													?>
													<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'manageuser/customerReview', 'varExtra' => $varExtra));?>
													</td>
												</tr>
											</table>
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

function InsertSpam(id)
{
    if(document.getElementById('review_'+id).checked == true)
    {
		$.ajax({
				  'type': 'POST',
				  'url': '<?php echo url_for("manageuser/ajaxSpamInsert"); ?>',
				  'data': {reviewId:id, spamValue:1}
			  });
    }
    else
    {
		$.ajax({
				  'type': 'POST',
				  'url': '<?php echo url_for("manageuser/ajaxSpamInsert"); ?>',
				  'data': {reviewId:id, spamValue:0}
			  });
    }
}
</script>