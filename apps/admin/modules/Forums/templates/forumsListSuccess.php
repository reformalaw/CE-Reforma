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
						<?php include_partial('Forums/forumsMenu');?>
						<!--END VERTICAL MENU-->
					</td>
					<td align="center" valign="top" class="CashDetails">
					<table width="96%" cellspacing="0" cellpadding="0">
						<tr>
							<td align="left" valign="top" height="25">&nbsp;</td>
						</tr>
						<tr>
							<td align="left" valign="top" class="WebsiteTab">
								<?php include_partial('Forums/horizontalMenu');?>
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" class="WebsiteDetails">
								<table width="100%" cellspacing="10" cellpadding="0">
									<tr>
										<td align="center" valign="top">
											<table width="98%" cellspacing="1" cellpadding="1" class="PageListHeading">
												<tr>
													<td align="left" valign="middle"><strong>Forum List</strong></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
											<td class="ContentPad">
												<table width="98%" cellspacing="0" cellpadding="0" align="center" class="">
													<tr valign="top">
														<td colspan="2" class="dot"></td>
													</tr>
                                                    <tr>
                                                        <td align="left" valign="top" height="15"></td>
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
															<table width="100%" cellspacing="0" cellpadding="0" class="brd1">
																<?php if($pager->count() > 0){?>
																<tr class="fldbg">
																	<td align="left" width="50%" class="border-right border-left border-top"><?php include_partial('default/ordering',array('title'=>'Title','ordering'=>false,"siteURL"=>'Forums/index','alias'=>'Title','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<!--<td align="center" width="20%" class="border-right border-top"><?php //include_partial('default/ordering',array('title'=>'Category','ordering'=>false,"siteURL"=>'Forums/index','alias'=>'Category','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>-->
																	<td align="center" width="10%" class="border-right border-top"><?php include_partial('default/ordering',array('title'=>'Posted date','ordering'=>false,"siteURL"=>'Forums/index','alias'=>'Posted date','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="20%" align="center" class="whttxt border-right border-top">Action</td>
																</tr>
																<?php foreach ($pager as $forumsCategory):?>
																<tr><td colspan="4" class="fldrowbg"><?php echo $forumsCategory->getTitle(); ?></td></tr>
																<!-- Ordring Code Start -->
																<tr>
																	<td colspan="4">
																		<div id="contentLeft">
																			<ul><?php //$i=1; ?>
																				<?php foreach ($forumsCategory["ForumCategoriesForums"] as $forum_categories):?>
																					<li id="recordsArray_<?php echo $forum_categories->getId(); ?>">
																						<table cellspacing="0" cellpadding="0" width="100%">
																							<tr>
																								<td class="chledFirstRow border-right border-left" align="left" valign="top" width="50%"><?php echo link_to($forum_categories->getTitle(), "Forums/topicList?flagForumsId=".$forum_categories->getId()) ?></td>
																								<!--<td class="chledFirstRow border-right" align="center" valign="top" width="20%"><?php //echo $forum_categories->getForumsForumCategories()->getTitle();//echo nl2br($forum_categories->getDescription()) ?></td>-->
																								<td class="chledFirstRow border-right" align="center" valign="top" width="10%"><?php echo date(sfConfig::get('app_dateformat'),strtotime($forum_categories->getCreateDateTime())) ?></td>
																								<td class="chledFirstRow border-right" align="center" width="20%">
																									<?php 
																										if($forum_categories->getStatus()== sfConfig::get('app_FAQs_Active'))
																											if(isset($flagCategoryId))
																												echo link_to(image_tag("admin/active-cases-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip'),'alt'=>'Active')),"Forums/changeForumStatus?status=".sfConfig::get('app_FAQs_Inactive')."&id=".$forum_categories->getId().'&flagCategoryId='.$flagCategoryId);
																											else
																												echo link_to(image_tag("admin/active-cases-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip'),'alt'=>'Active')),"Forums/changeForumStatus?status=".sfConfig::get('app_FAQs_Inactive')."&id=".$forum_categories->getId());
																										else
																											if(isset($flagCategoryId))
																												echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'),'alt'=>'Inactive')),"Forums/changeForumStatus?status=".sfConfig::get('app_FAQs_Active')."&id=".$forum_categories->getId()."&flagCategoryId=".$flagCategoryId);
																											else
																												echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'),'alt'=>'Inactive')),"Forums/changeForumStatus?status=".sfConfig::get('app_FAQs_Active')."&id=".$forum_categories->getId());
																									?>
																									<?php 
																										if(isset($flagCategoryId))
																											echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'24px','height'=>'25px')),'Forums/editForum?id='.$forum_categories->getId()."&flagCategoryId=".$flagCategoryId);
																										else
																											echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'24px','height'=>'25px')),'Forums/editForum?id='.$forum_categories->getId());
																									?>
																									<?php //echo link_to(image_tag('admin/view-icon.png',array('border'=>'0','alt'=>'View','title'=>'View','width'=>'24px','height'=>'25px')),'Forums/forumView?id='.$forum_categories->getId()); ?>
																									<?php 
																										if(isset($flagCategoryId))
																											echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")),'Forums/forumDelete?id='.$forum_categories->getId()."&flagCategoryId=".$flagCategoryId);
																										else
																											echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")),'Forums/forumDelete?id='.$forum_categories->getId());
																									?>
																								</td>
																							</tr>
																						</table>
																					</li>
																				<?php endforeach; ?>
																			</ul>
																		</div>
																	</td>
																</tr>
																<!-- Ordring Code End -->
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
																if(isset($flagCategoryId)) $varExtra .="&flagCategoryId=$flagCategoryId";
															?>
															<?php //include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'Forums/index', 'varExtra' => $varExtra));?>
														</td>
													</tr>
                                                    <tr>
                                                        <td align="left" valign="top" height="10"></td>
                                                    </tr>
												</table>
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
	$(document).ready(function()
	{ 
		$(function() 
		{
			$("#contentLeft ul").sortable({ opacity: 0.6, cursor: 'move', update: function()
			{
				var order = $(this).sortable("serialize") ;
				$.post("<?php echo url_for("Forums/globelOrdering"); ?>", order, function(theResponse){});
			}
			});
		});
	});
</script>

<?php /*
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="100%">
		<!-- Bread Crumb Start -->
			<table cellspacing="0" cellpadding="0" class="AdminNavBar">
				<tr>
					<td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
					<td width="30%" class="drkgrylnk" align="center"><div class="Title">Forum List</div></td>
					<td width="35%" align="right" class="AdminBreadCrumb">
						<table cellpadding="8" cellspacing="0" align="right">
							<tr align="center">
								<td width="57" class="LinkImg" ><a href="<?php echo url_for('Forums/forumsNew') ?>" title="Add New"><?php echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
									Add </a></td>
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
												<table width="100%" cellspacing="0" cellpadding="0" align="center" class="">
													<!--<tr>
														<td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php //echo image_tag("admin/Icon_Groups.gif", array("alt"=>"Forum categories","title"=>"Forum categories","align"=>"middle"))?></td>
														<td width="90%" class="ContentBtmDotLn">
															<div style="float:left;" class="Title">Forum List</div>
															<div style="float:right;" class="padrht">-->
															<!--form action="<?php //echo url_for('Forums/index') ?>" method="post">
																	<span>Search:</span>&nbsp;&nbsp;             
																	<?php //echo tag('input', array('name' => 'search_text', 'type' => 'text', 'id' => 'search_text', 'size' => '25', 'value' => $sf_request->getParameter('search_text'))); ?>
																	<?php //echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
																	<a href="<?php //echo url_for('Forums/index') ?>">Clear</a>
															</form-->
															<!--</div>
														</td>
													</tr>-->
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
														//if($sortBy) $varExtra .="&sortBy=$sortBy";       
													?>
													<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<table width="100%" cellspacing="0" cellpadding="0" class="brd1">
																<?php if($pager->count() > 0){?>
																<tr class="fldbg">
																	<td align="left" width="50%" class="border-right border-left border-top"><?php include_partial('default/ordering',array('title'=>'Title','ordering'=>false,"siteURL"=>'Forums/index','alias'=>'Title','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td align="center" width="20%" class="border-right border-top"><?php include_partial('default/ordering',array('title'=>'Category','ordering'=>false,"siteURL"=>'Forums/index','alias'=>'Category','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td align="center" width="10%" class="border-right border-top"><?php include_partial('default/ordering',array('title'=>'Posted date','ordering'=>false,"siteURL"=>'Forums/index','alias'=>'Posted date','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="20%" align="center" class="whttxt border-right border-top">Action</td>
																</tr>
				
																<!-- Ordring Code Start -->
																<tr>
																	<td colspan="4">
																		<div id="contentLeft">
																			<ul><?php $i=1; ?>
																				<?php foreach ($pager as $forum_categories):?>
																				<?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
																					<li id="recordsArray_<?php echo $forum_categories->getId(); ?>">
																						<table cellspacing="0" cellpadding="0" width="100%">
																							<tr class="<?php echo $class;?>">
																								<td class="fldrowbg border-right border-left" align="left" valign="top" width="50%"><?php echo $forum_categories->getTitle() ?></td>
																								<td class="fldrowbg border-right" align="center" valign="top" width="20%"><?php echo $forum_categories->getForumsForumCategories()->getTitle();//echo nl2br($forum_categories->getDescription()) ?></td>
																								<td class="fldrowbg border-right" align="center" valign="top" width="10%"><?php echo date(sfConfig::get('app_dateformat'),strtotime($forum_categories->getCreateDateTime())) ?></td>
																								<td class="fldrowbg border-right" align="center" width="20%">
																									<?php 
																										if($forum_categories->getStatus()== sfConfig::get('app_FAQs_Active'))
																											echo link_to(image_tag("admin/active-cases-icon.png",array('width'=>'24px','height'=>'25px','title'=>'Click here to inactive forum','alt'=>'Active')),"Forums/changeForumStatus?status=".sfConfig::get('app_FAQs_Inactive')."&id=".$forum_categories->getId());
																										else
																											echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','height'=>'25px','title'=>'Click here to activate forum','alt'=>'Inactive')),"Forums/changeForumStatus?status=".sfConfig::get('app_FAQs_Active')."&id=".$forum_categories->getId());
																									?>
																									<?php echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'24px','height'=>'25px')),'Forums/editForum?id='.$forum_categories->getId());?>
																									<?php echo link_to(image_tag('admin/view-icon.png',array('border'=>'0','alt'=>'View','title'=>'View','width'=>'24px','height'=>'25px')),'Forums/forumView?id='.$forum_categories->getId()); ?>
																									<?php echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")),'Forums/forumDelete?id='.$forum_categories->getId())?>
																								</td>
																							</tr>
																						</table>
																					</li>
																				<?php endforeach; ?>
																			</ul>
																		</div>
																	</td>
																</tr>
																<!-- Ordring Code End -->

																<?php } else { ?> 
																<tr class="fldbg"><td class="errormss">No Forum categories found!</td></tr>
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
															<?php //include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'Forums/index', 'varExtra' => $varExtra));?>
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
</table>
*/
?>