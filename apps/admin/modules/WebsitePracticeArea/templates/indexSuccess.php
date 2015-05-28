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
										<td width="110" align="center" valign="middle" class="SelectTab">Practice Area List</td>
										<td width="2" align="center" valign="middle" class="BorderBottom"></td>
										<td width="110" align="center" valign="middle" class="DeSelectTab">
											<?php //echo link_to("Add Practice Area", "WebsitePracticeArea/new"); ?>
										</td>
										<td width="2" align="center" valign="middle" class="BorderBottom"></td>
										<td width="110" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select practice area to edit');" href="javascript:void(0)">Edit Practice Area</a></td>
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
													<td align="left" valign="middle"><strong>Practice Area List  <?php #echo $sf_user->getAttribute('websiteUrl'); ?></strong></td>
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
                                                <tr valign="top">
													<td colspan="2" height="15"></td>
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
																	<td width="25%" align="center"><?php include_partial('default/ordering',array('title'=>'Title','ordering'=>false,"siteURL"=>'WebsitePracticeArea/index','alias'=>'Title','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="25%" align="center"><?php include_partial('default/ordering',array('title'=>'Page Key','ordering'=>false,"siteURL"=>'WebsitePracticeArea/index','alias'=>'PageKey','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="7%" align="center"><?php include_partial('default/ordering',array('title'=>'Template','ordering'=>false,"siteURL"=>'WebsitePracticeArea/index','alias'=>'Template','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Created Date','ordering'=>false,"siteURL"=>'WebsitePracticeArea/index','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="15%" align="center" class="whttxt">Action</td>
																</tr>
																<?php $i=1; ?>
																<?php foreach ($pager->getResults() as $website_practice_area):?>
																<?php
																	// Check That Practice Area Exist in Menu Or Not 
																	$flag = WebsiteMenuTable::checkPracticeOrCmsExist($website_practice_area->getWebsiteId(),"WebsitePracticeAreaId", $website_practice_area->getId());
																?>
																<?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
																<tr class="<?php echo $class;?>">
																	<td class="fldrowbg" align="left" valign="top">
																		<?php echo link_to($website_practice_area->getTitle(), 'WebsitePracticeArea/edit?id='.$website_practice_area->getId()); ?>
																	</td>
																	<td class="fldrowbg" align="left" valign="top"><?php echo $website_practice_area->getSlug() ?></td>
																	<td class="fldrowbg" align="left" valign="top"><?php 
																	if ($website_practice_area->getTemplate() == "column1") {
																	    echo "Column One";
																	}elseif ($website_practice_area->getTemplate() == "column2L"){
																	    echo "Column To Left";
																	}else {
																	    echo "Column To Right";
																	}
																	?></td>
																	<td class="fldrowbg" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'), strtotime($website_practice_area->getCreateDateTime())) ?></td>
																	<td class="fldrowbg" align="center">
																		<?php 
																		if($website_practice_area->getStatus()== sfConfig::get('app_Status_Active'))
																		{
																			if($flag):
																				echo link_to(image_tag("admin/active-cases-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip'),'alt'=>'Active')),"WebsitePracticeArea/changePracticeAreaStatus?status=".sfConfig::get('app_Status_Inactive')."&id=".$website_practice_area->getId());
																			else: ?>
																				<a href="javascript:void(0)" OnClick="PracticeAreaExist();" > <?php echo image_tag("admin/active-cases-icon.png",array('width'=>24,'height'=>25)) ;?> </a>
																		<?php
																			endif;
																		}
																		else
																		echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'),'alt'=>'Inactive')),"WebsitePracticeArea/changePracticeAreaStatus?status=".sfConfig::get('app_Status_Active')."&id=".$website_practice_area->getId());
																		?>
																		<?php echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'24px','height'=>'25px')),'WebsitePracticeArea/edit?id='.$website_practice_area->getId()); ?>
																	
																		<?php
																			if($flag):
																				echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")),"WebsitePracticeArea/delete?id=".$website_practice_area->getId());
																			else:?>
																				<a href="javascript:void(0)" OnClick="PracticeAreaExist();" > <?php echo image_tag("admin/delete-cases-icon.png",array('width'=>24,'height'=>25)) ;?> </a>
																		<?php endif; ?>
																	</td>
																</tr>
																<?php endforeach; ?>
																<?php } else { ?> 
																<tr class="fldbg"><td class="errormss">No practice area found.</td></tr>
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
														if($search_text) $varExtra .="&search_text=".$search_text;
														?>
														<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'WebsitePracticeArea/index', 'varExtra' => $varExtra));?>
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
					<td width="30%" class="drkgrylnk" align="center"><div class="Title">Practice area list -  <?php //echo $sf_user->getAttribute('websiteUrl'); ?></div></td>
					<td width="35%" align="right" class="AdminBreadCrumb">
						<table cellpadding="8" cellspacing="0" align="right">
							<tr align="center">
								<td width="57" class="LinkImg" ><a href="<?php //echo url_for('WebsitePracticeArea/new') ?>" title="Add New"><?php //echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
								Add </a></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>-->
		<!-- Bread Crumb End -->
<!--		</td>
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
												<table cellspacing="0" cellpadding="0" align="center" width="100%">-->
					                               <!--<tr>
						                              <td align="center" valign="top" class="CasesListSearch" colspan="2">
						                              <form action="<?php //echo url_for('WebsitePracticeArea/index') ?>" method="post">
							                             <table width="100%" cellspacing="10" cellpadding="0">
							                             <tr>
								                            <td width="220" align="left" valign="top"><?php //echo $objSearchForm['search_text']->renderLabel(); ?></td>
								                            <td align="left" valign="top">&nbsp;</td>
							                             </tr>
							                             <tr>
								                            <td align="left" valign="top"><?php //echo $objSearchForm['search_text']->render(array('style'=>'width:200px;')); ?></td>
								                            <td align="left" valign="top"><?php //echo tag('input', array('name' => 'search_btn', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
																	<a href="<?php //echo url_for('WebsitePracticeArea/index') ?>" class = 'CommonButton'>Clear</a></td>
							                             </tr>
							                             <tr>
								                            <td height="1" colspan="5" align="left" valign="top"></td>
							                             </tr>
							                             </table>
						                              </form></td>
					                               </tr>-->
					                               <!--<tr>
						                              <td height="20" align="left" valign="top">&nbsp;</td>
					                               </tr>-->
												
												    <!--<tr>
														<td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php /*echo image_tag("admin/Icon_Groups.gif", array("alt"=>"Website practice area","title"=>"Website practice area","align"=>"middle"))?></td>
														<td width="90%" class="ContentBtmDotLn">
															<div style="float:left;" class="Title">Practice area list -  <?php echo $sf_user->getAttribute('websiteUrl'); ?></div>
															<div style="float:right;" class="padrht">

																<form action="<?php echo url_for('WebsitePracticeArea/index') ?>" method="post">
																	<span>
																	<?php echo $objSearchForm['search_text']->renderLabel(); ?>:</span>&nbsp;&nbsp;<?php echo $objSearchForm['search_text']->render(); ?>
																	<?php echo tag('input', array('name' => 'search_btn', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
																	<a href="<?php echo url_for('WebsitePracticeArea/index')*/ ?>" class = 'CommonButton'>Clear</a>
																</form>

															</div>
														</td>
													</tr>-->
													<!--<tr valign="top">
														<td colspan="2" class="dot"></td>
													</tr>
													<tr align="center" valign="top">
														<?php //include_partial('default/message'); ?>
													</tr>-->
													<?php
// 													$varExtra = '';
// 													if($sf_request->getParameter('search_text'))
// 													$varExtra .="&search_text=".$sf_request->getParameter('search_text');
													?>
													<!--<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<table width="100%" cellspacing="1" cellpadding="1" class="brd1">-->
															<?php //if($pager->getnbResults() > 0){?>
															<!--	<tr class="fldbg">
																	<td width="25%" align="center"><?php //include_partial('default/ordering',array('title'=>'Title','ordering'=>false,"siteURL"=>'WebsitePracticeArea/index','alias'=>'Title','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="25%" align="center"><?php //include_partial('default/ordering',array('title'=>'Page Key','ordering'=>false,"siteURL"=>'WebsitePracticeArea/index','alias'=>'PageKey','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="7%" align="center"><?php //include_partial('default/ordering',array('title'=>'Template','ordering'=>false,"siteURL"=>'WebsitePracticeArea/index','alias'=>'Template','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="10%" align="center"><?php //include_partial('default/ordering',array('title'=>'Created Date','ordering'=>false,"siteURL"=>'WebsitePracticeArea/index','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="15%" align="center" class="whttxt">Action</td>
																</tr>-->
																<?php //$i=1; ?>
																<?php //foreach ($pager->getResults() as $website_practice_area):?>
																<?php //$class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
																<!--<tr class="<?php //echo $class;?>">
																	<td class="fldrowbg" align="left" valign="top">-->
																		<?php //echo $website_practice_area->getTitle() ?>
																		<?php //echo link_to($website_practice_area->getTitle(), 'WebsitePracticeArea/edit?id='.$website_practice_area->getId()); ?>
																	<!--</td>
																	<td class="fldrowbg" align="left" valign="top"><?php //echo $website_practice_area->getSlug() ?></td>
																	<td class="fldrowbg" align="left" valign="top"><?php 
// 																	if ($website_practice_area->getTemplate() == "column1") {
// 																	    echo "Column One";
// 																	}elseif ($website_practice_area->getTemplate() == "column2L"){
// 																	    echo "Column To Left";
// 																	}else {
// 																	    echo "Column To Right";
// 																	}
																	?></td>
																	<td class="fldrowbg" align="center" valign="top"><?php //echo date(sfConfig::get('app_dateformat'), strtotime($website_practice_area->getCreateDateTime())) ?></td>
																	<td class="fldrowbg" align="center">
																		<?php 
// 																		if($website_practice_area->getStatus()== sfConfig::get('app_Status_Active'))
// 																		echo link_to(image_tag("admin/active-cases-icon.png",array('width'=>'24px','height'=>'25px','title'=>'Click here to Inactive Practice Area','alt'=>'Active')),"WebsitePracticeArea/changePracticeAreaStatus?status=".sfConfig::get('app_Status_Inactive')."&id=".$website_practice_area->getId());
// 																		else
// 																		echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','height'=>'25px','title'=>'Click here to activate this Practice Area','alt'=>'Inactive')),"WebsitePracticeArea/changePracticeAreaStatus?status=".sfConfig::get('app_Status_Active')."&id=".$website_practice_area->getId());
																		?>
																		<?php //echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'24px','height'=>'25px')),'WebsitePracticeArea/edit?id='.$website_practice_area->getId()); ?>
																	</td>
																</tr>
																<?php //endforeach; ?>
																<?php //} else { ?> 
																<tr class="fldbg"><td class="errormss">No Website practice area found!</td></tr>
																<?php //} ?>
															</table>
														</td>
													</tr>
													<tr>
						                              <td height="20" align="left" valign="top">&nbsp;</td>
					                               </tr>
													<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
														<?php
// 														if($orderBy) $varExtra .="&orderBy=$orderBy";
// 														if($orderType) $varExtra .="&orderType=$orderType";
// 														if($search_text) $varExtra .="&search_text=".$search_text;
														?>
														<?php //include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'WebsitePracticeArea/index', 'varExtra' => $varExtra));?>
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
<!--		</td>
	</tr>
</table>-->