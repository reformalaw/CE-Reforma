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
		<td align="left" valign="top">
			<table width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td width="150" align="left" valign="top" class="LeftMenu">
						<!--START VERTICAL MENU-->
						<?php include_partial("websiteMenu"); ?>
						<!--END VERTICAL MENU-->
					</td>
					<td align="center" valign="top" class="CashDetails">
					<table width="96%" cellspacing="0" cellpadding="0">
						<tr>
							<td align="left" valign="top" height="25">&nbsp;</td>
						</tr>
						<tr>
							<td align="left" valign="top" class="WebsiteTab">
								<table width="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td width="10" class="BorderBottom">&nbsp;</td>
										<td width="110" align="center" valign="middle" class="SelectTab">Practice Area List</td>
										<td width="2" align="center" valign="middle" class="BorderBottom"></td>
										<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select practice area to edit');" href="javascript:void(0)">Edit Practice Area</a></td>
										<td class="BorderBottom">&nbsp;</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" class="WebsiteDetails">
								<table width="100%" cellspacing="10" cellpadding="0">
									<tr>
										<td align="center" valign="top">
											<table width="98%" cellspacing="1" cellpadding="1" class="PageListHeading">
												<tr>
													<td align="left" valign="middle"><strong>Practise Area List</strong></td>
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
																	<td width="25%" align="left"><?php include_partial('default/ordering',array('title'=>'Title','ordering'=>false,"siteURL"=>'WebsitePracticeArea/index','alias'=>'Title','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="25%" align="left"><?php include_partial('default/ordering',array('title'=>'Page Key','ordering'=>false,"siteURL"=>'WebsitePracticeArea/index','alias'=>'PageKey','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Template','ordering'=>false,"siteURL"=>'WebsitePracticeArea/index','alias'=>'Template','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Created Date','ordering'=>false,"siteURL"=>'WebsitePracticeArea/index','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="15%" align="center" class="whttxt">Action</td>
																</tr>
																<?php $i=1; ?>

																<?php foreach ($pager->getResults() as $website_practice_area):?>
																<?php
																		// Check That Cms page Exist in Menu Or Not 
																		$flag = WebsiteMenuTable::checkPracticeOrCmsExist($website_practice_area->getWebsiteId(),"WebsitePracticeAreaId", $website_practice_area->getId());
																?>
																<?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
																<tr class="<?php echo $class;?>">
																	<td class="fldrowbg" align="left" valign="top">
																		<?php //echo $website_practice_area->getTitle() ?>
																		<?php echo link_to($website_practice_area->getTitle(), 'website/practiceAreaEdit?id='.$website_practice_area->getId().'&customerId='.$customerId);?>
																	</td>
																	<td class="fldrowbg" align="left" valign="top"><?php echo $website_practice_area->getSlug() ?></td>
																	<td class="fldrowbg" align="center" valign="top"><?php 
																	if ($website_practice_area->getTemplate() == "column1") {
																	    echo "Column One";
																	}elseif ($website_practice_area->getTemplate() == "column2L"){
																	    echo "Column To Left";
																	}else {
																	    echo "Column To Right";
																	}
																	?></td>
																	<td class="fldrowbg" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'), strtotime($website_practice_area->getCreateDateTime())) ?></td>
																	<td class="fldrowbg PracticeAreaActionIcons" align="center">
																		<?php
																			echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>24,'height'=>25)), 'website/practiceAreaEdit?id='.$website_practice_area->getId().'&customerId='.$customerId); 
																		?>
																		
																		<?php
																		if($flag):
																			echo link_to(image_tag('admin/delete-cases-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Click here to Delete Practice Area','OnClick'=>"return deleteConfirmation();",'width'=>24,'height'=>25)), 'website/practiceAreaDelete?id='.$website_practice_area->getId().'&customerId='.$customerId);
																		else:
																		?>
																			<a href="javascript:void(0)" OnClick="PracticeAreaExist();" > <?php echo image_tag("admin/delete-cases-icon.png",array('width'=>24,'height'=>25)) ;?> </a>
																		<?php endif; ?>
																	</td>
																</tr>
																<?php endforeach; ?>
																<?php } else { ?> 
																<tr class="fldbg"><td class="errormss">No items found.</td></tr>
																<?php } ?>
														</table>
													</td>
												</tr>
                                                 <tr>
                                                    	<td>&nbsp;</td>
                                                 </tr>
												<tr>
														<td align="center" valign="top" colspan="2" class="ListAreaPad">
														<?php
														if($orderBy) $varExtra .="&orderBy=$orderBy";
														if($orderType) $varExtra .="&orderType=$orderType";
														if($search_text) $varExtra .="&search_text=".$search_text;
														
														$varExtra.="&customerId=".$customerId;
														?>
														<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'website/practiceAreaList', 'varExtra' => $varExtra));?>
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