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
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" class="WebsiteDetails">
								<table width="100%" cellspacing="10" cellpadding="0">
									<tr>
										<td align="center" valign="top">
											<table width="98%" cellspacing="1" cellpadding="1" class="PageListHeading">
												<tr>
													<td align="left" valign="middle"><strong>Banners List</strong></td>
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
                                                    <tr>
                                        <td align="left" valign="top" height="10"></td>
                                    </tr>
													<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<table width="98%" cellspacing="1" cellpadding="1" class="brd1">
															<?php if($pager->getnbResults() > 0){?>
																<tr class="fldbg">
																	<td width="15%" align="center"><?php include_partial('default/ordering',array('title'=>'Banner Name','ordering'=>false,"siteURL"=>'themebanner/index','alias'=>'Theme','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<?php for($i=1;$i<=$totalBannerTitle;$i++): ?>
																		<td width="15%" align="center"><?php include_partial('default/ordering',array('title'=>'Title'.$i,'ordering'=>false,"siteURL"=>'themebanner/index','alias'=>'Title'.$i,'orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<?php endfor; ?>
																	<!--<td width="15%" align="center"><?php //include_partial('default/ordering',array('title'=>'Title2','ordering'=>false,"siteURL"=>'themebanner/index','alias'=>'Title2','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="20%" align="center"><?php //include_partial('default/ordering',array('title'=>'Title3','ordering'=>false,"siteURL"=>'themebanner/index','alias'=>'Title3','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>-->
																	<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Created Date','ordering'=>false,"siteURL"=>'themebanner/index','alias'=>'Create date time','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="20%" align="center" class="whttxt">Action</td>
																</tr>
															<?php $j=1; ?>
															<?php foreach ($pager->getResults() as $theme_banner):?>
																<?php $class=$j++%2==0?"fldrowbgAlt":"fldrowbg";?>
																<tr class="<?php echo $class;?>">
																	<td class="fldrowbg" align="left" valign="top">
																		<?php echo link_to($theme_banner->getBannerName(),'themebanner/edit?id='.$theme_banner->getId()); ?>
																		<?php //echo $theme_banner->getBannerName() ?>
																	</td>
																	
																	<?php
																		$tableObject = array(1=>"getTitle1",2=>"getTitle2",3=>"getTitle3");
																		for($i=1;$i<=$totalBannerTitle;$i++): ?>
																		<td class="fldrowbg" align="left" valign="top"><?php echo ($theme_banner->$tableObject[$i]()) ? $theme_banner->$tableObject[$i]() : "---"; ?></td>
																	<?php endfor; ?>
																	<!--<td class="fldrowbg" align="left" valign="top"><?php //echo ($theme_banner->getTitle2()) ? $theme_banner->getTitle2() : "---"; ?></td>
																	<td class="fldrowbg" align="left" valign="top"><?php //echo ($theme_banner->getTitle3()) ? $theme_banner->getTitle3() : "---"; ?></td>-->
																	<td class="fldrowbg" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'), strtotime($theme_banner->getCreateDateTime())) ?></td>
																	<td class="fldrowbg" align="center">
																		<?php 
																				if($theme_banner->getStatus()== sfConfig::get('app_Status_Active'))
																					echo link_to(image_tag("admin/active-cases-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip'),'alt'=>'Active')),"themebanner/changeBannerStatus?status=".sfConfig::get('app_Status_Inactive')."&id=".$theme_banner->getId());
																				else
																					echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'),'alt'=>'Inactive')),"themebanner/changeBannerStatus?status=".sfConfig::get('app_Status_Active')."&id=".$theme_banner->getId());
																		?>
																		<?php echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'24px','height'=>'25px')),'themebanner/edit?id='.$theme_banner->getId()); ?>
																		<?php echo link_to(image_tag('admin/view-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'View','title'=>'View')),'themebanner/view?id='.$theme_banner->getId()); ?>
																		<?php echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")), 'themebanner/delete?id='.$theme_banner->getId()); ?>
																		<!--<a href="<?php //echo url_for('themebanner/edit?id='.$theme_banner->getId())?>"><?php //echo image_tag('admin/edit-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'20px','height'=>'20px'))?></a>
																		<a href="<?php //echo url_for('themebanner/view?id='.$theme_banner->getId())?>"><?php //echo image_tag('admin/view.png',array('border'=>'0','alt'=>'View','title'=>'View'))?></a>
																		<a href="<?php //echo url_for('themebanner/delete?id='.$theme_banner->getId())?>"><?php //echo image_tag('admin/Delete_small.gif',array('border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();"))?></a>-->
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
													<td height="20" align="left" valign="top">&nbsp;</td>
												</tr>
												<tr align="center" valign="top">
													<td colspan="2" class="ListAreaPad">
													<?php
														if($orderBy) $varExtra .="&orderBy=$orderBy";
														if($orderType) $varExtra .="&orderType=$orderType";
													?>
													<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'themebanner/index', 'varExtra' => $varExtra));?>
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





<!--<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="100%">-->
		<!-- Bread Crumb Start -->
			<!--<table cellspacing="0" cellpadding="0" class="AdminNavBar">
				<tr>
					<td width="35%" class="drkgrylnk padlft"><a href='<?php //echo url_for("default/index");?>' title="Home"> <?php //echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
					<td width="30%" class="drkgrylnk" align="center"><div class="Title">Banners list</div></td>
					<td width="35%" align="right" class="AdminBreadCrumb">
						<table cellpadding="8" cellspacing="0" align="right">
							<tr align="center">
								<td width="57" class="LinkImg" ><a href="<?php //echo url_for('themebanner/new') ?>" title="Add New"><?php //echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
								Add </a></td>     
							</tr>
						</table>
					</td>
				</tr>
			</table>-->
		<!-- Bread Crumb End -->
		<!--</td>
	</tr>
	<tr>
		<td width="100%">-->
		<!-- Control Panel Start -->
			<!--<table width="100%" cellspacing="2" cellpadding="0">
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
												<table cellspacing="0" cellpadding="0" align="center" width="100%">
													<tr valign="top">
														<td colspan="2" class="dot"></td>
													</tr>-->
													<!--<tr align="center" valign="top">
														<?php //include_partial('default/message'); ?>
													</tr>-->
													<?php              
// 														$varExtra = '';
// 														if($sf_request->getParameter('search_text')) 
// 														$varExtra .="&search_text=".$sf_request->getParameter('search_text');
													?>
													<!--<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<table width="100%" cellspacing="1" cellpadding="1" class="brd1">-->
															<?php //if($pager->getnbResults() > 0){?>
																<!--<tr class="fldbg">
																	<td width="15%" align="center"><?php //include_partial('default/ordering',array('title'=>'Banner Name','ordering'=>false,"siteURL"=>'themebanner/index','alias'=>'Theme','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="25%" align="center"><?php //include_partial('default/ordering',array('title'=>'Title1','ordering'=>false,"siteURL"=>'themebanner/index','alias'=>'Title1','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="20%" align="center"><?php //include_partial('default/ordering',array('title'=>'Title2','ordering'=>false,"siteURL"=>'themebanner/index','alias'=>'Title2','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="20%" align="center"><?php //include_partial('default/ordering',array('title'=>'Title3','ordering'=>false,"siteURL"=>'themebanner/index','alias'=>'Title3','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="10%" align="center"><?php //include_partial('default/ordering',array('title'=>'Created Date','ordering'=>false,"siteURL"=>'themebanner/index','alias'=>'Create date time','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="10%" align="center" class="whttxt">Action</td>
																</tr>-->
															<?php //$i=1; ?>
															<?php //foreach ($pager->getResults() as $theme_banner):?>
																<?php //$class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
																<!--<tr class="<?php //echo $class;?>">
																	<td class="fldrowbg" align="left" valign="top"><?php //echo $theme_banner->getBannerName() ?></td>
																	<td class="fldrowbg" align="left" valign="top"><?php //echo ($theme_banner->getTitle1()) ? $theme_banner->getTitle1() : "---"; ?></td>
																	<td class="fldrowbg" align="left" valign="top"><?php //echo ($theme_banner->getTitle2()) ? $theme_banner->getTitle2() : "---"; ?></td>
																	<td class="fldrowbg" align="left" valign="top"><?php //echo ($theme_banner->getTitle3()) ? $theme_banner->getTitle3() : "---"; ?></td>
																	<td class="fldrowbg" align="center" valign="top"><?php //echo date(sfConfig::get('app_dateformat'), strtotime($theme_banner->getCreateDateTime())) ?></td>
																	<td class="fldrowbg" align="center">-->
																		<?php 
																	/*			if($theme_banner->getStatus()== sfConfig::get('app_Status_Active'))
																					echo link_to(image_tag("admin/active-cases-icon.png",array('width'=>'24px','height'=>'25px','title'=>'Click here to Inactive Banner','alt'=>'Active')),"themebanner/changeBannerStatus?status=".sfConfig::get('app_Status_Inactive')."&id=".$theme_banner->getId());
																				else
																					echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','height'=>'25px','title'=>'Click here to activate this Banner ','alt'=>'Inactive')),"themebanner/changeBannerStatus?status=".sfConfig::get('app_Status_Active')."&id=".$theme_banner->getId());*/
																		?>
																		<?php //echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'24px','height'=>'25px')),'themebanner/edit?id='.$theme_banner->getId()); ?>
																		<?php //echo link_to(image_tag('admin/view-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'View','title'=>'View')),'themebanner/view?id='.$theme_banner->getId()); ?>
																		<?php //echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")), 'themebanner/delete?id='.$theme_banner->getId()); ?>
																		<!--<a href="<?php //echo url_for('themebanner/edit?id='.$theme_banner->getId())?>"><?php //echo image_tag('admin/edit-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'20px','height'=>'20px'))?></a>
																		<a href="<?php //echo url_for('themebanner/view?id='.$theme_banner->getId())?>"><?php //echo image_tag('admin/view.png',array('border'=>'0','alt'=>'View','title'=>'View'))?></a>
																		<a href="<?php //echo url_for('themebanner/delete?id='.$theme_banner->getId())?>"><?php //echo image_tag('admin/Delete_small.gif',array('border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();"))?></a>-->
																	<!--</td>
																</tr>-->
															<?php //endforeach; ?>    
															<?php //} else { ?> 
																<!--<tr class="fldbg"><td class="errormss">No Theme banner found!</td></tr>
															<?php //} ?>
														</table>
													</td>
												</tr>
												<tr align="right" valign="top">
													<td colspan="2" class="ListAreaPad">
													<?php /*
														if($orderBy) $varExtra .="&orderBy=$orderBy";
														if($orderType) $varExtra .="&orderType=$orderType";*/
													?>
													<?php //include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'themebanner/index', 'varExtra' => $varExtra));?>
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
		</table>-->
		<!-- Control Panel End -->
<!--		</td>
	</tr>
</table>-->