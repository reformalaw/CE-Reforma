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
													<td align="left" valign="middle"><strong>Forum Topic List </strong></td>
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
										<td align="left" valign="top" height="10"></td>
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
															<table width="100%" cellspacing="1" cellpadding="1" class="brd1">
															<?php if($pager->getnbResults() > 0){?>
																<tr class="fldbg">
																	<td width="30%" align="center"><?php include_partial('default/ordering',array('title'=>'Topic','ordering'=>false,"siteURL"=>'Forums/topicList','alias'=>'Topic','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td align="center"><?php include_partial('default/ordering',array('title'=>'Forum','ordering'=>false,"siteURL"=>'Forums/topicList','alias'=>'Forum','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Created By','ordering'=>false,"siteURL"=>'Forums/topicList','alias'=>'FirstName','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Total Replies','ordering'=>false,"siteURL"=>'Forums/topicList','alias'=>'TotalReplies','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Posted date','ordering'=>false,"siteURL"=>'Forums/topicList','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="15%" align="center" class="whttxt">Action</td>
																</tr>
																<?php $i =1; ?>
																<?php foreach ($pager->getResults() as $forumTopic):?>
																<?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
																<tr class="<?php echo $class;?>">
																	<td class="fldrowbg" align="left" valign="top"><?php echo link_to($forumTopic->getTopic(), "forumreplay/index?flagTopicId=".$forumTopic->getId()); ?></td>
																	<td class="fldrowbg" align="left" valign="top"><?php echo $forumTopic->getForumTopicsForums()->getTitle() ?></td>
																	<td class="fldrowbg" align="center" valign="top"><?php echo $forumTopic->getForumTopicsUsers()->getFirstName().' '.$forumTopic->getForumTopicsUsers()->getLastName() ?></td>
																	<td class="fldrowbg" align="center" valign="top"><?php echo $forumTopic->getTotalReplies() ?></td>
																	<td class="fldrowbg" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'),strtotime($forumTopic->getCreateDateTime())) ?></td> <!-- M d, Y H:i:s a-->
																	<td class="fldrowbg" align="center">
																		<?php 
																			if($forumTopic->getStatus()== sfConfig::get('app_FAQs_Active'))
																			{
																				if(isset($flagForumsId))
																					echo link_to(image_tag("admin/active-cases-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip'),'alt'=>'Active')),"Forums/changeTopicStatus?status=".sfConfig::get('app_FAQs_Inactive')."&id=".$forumTopic->getId().'&flagForumsId='.$flagForumsId);
																				else
																					echo link_to(image_tag("admin/active-cases-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip'),'alt'=>'Active')),"Forums/changeTopicStatus?status=".sfConfig::get('app_FAQs_Inactive')."&id=".$forumTopic->getId());
																			}
																			else
																			{
																				if(isset($flagForumsId))
																					echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'),'alt'=>'Inactive')),"Forums/changeTopicStatus?status=".sfConfig::get('app_FAQs_Active')."&id=".$forumTopic->getId().'&flagForumsId='.$flagForumsId);
																				else
																					echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'),'alt'=>'Inactive')),"Forums/changeTopicStatus?status=".sfConfig::get('app_FAQs_Active')."&id=".$forumTopic->getId());
																			}
																		?>
																		<?php 
																			if(isset($flagForumsId))
																				echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'24px','height'=>'25px')), 'Forums/editTopic?id='.$forumTopic->getId().'&flagForumsId='.$flagForumsId);
																			else
																				echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'24px','height'=>'25px')), 'Forums/editTopic?id='.$forumTopic->getId());
																		?>
																		<?php //echo link_to(image_tag('admin/view-icon.png',array('border'=>'0','alt'=>'View','title'=>'View','width'=>'24px','height'=>'25px')),'Forums/topicView?id='.$forumTopic->getId())?>
																		<?php 
																			if(isset($flagForumsId))
																				echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")),'Forums/deleteTopic?id='.$forumTopic->getId().'&flagForumsId='.$flagForumsId);
																			else
																				echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")),'Forums/deleteTopic?id='.$forumTopic->getId());
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
                                                    <tr>
										<td align="left" valign="top" height="20"></td>
									</tr>
													<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<?php
																if($orderBy) $varExtra .="&orderBy=$orderBy";
																if($orderType) $varExtra .="&orderType=$orderType";
																if(isset($flagForumsId)) $varExtra .="&flagForumsId=$flagForumsId";
															?>
															<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'Forums/topicList', 'varExtra' => $varExtra));?>
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



<?php /*
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="100%">
		<!-- Bread Crumb Start -->
			<table cellspacing="0" cellpadding="0" class="AdminNavBar">
				<tr>
					<td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
					<td width="30%" class="drkgrylnk" align="center"><div class="Title">Forum Topic List</div></td>
					<td width="35%" align="right" class="AdminBreadCrumb">
						<table cellpadding="8" cellspacing="0" align="right">
							<tr align="center">
								<td width="57" class="LinkImg" ><a href="<?php echo url_for('Forums/topicNew') ?>" title="Add New"><?php echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
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
															<div style="float:left;" class="Title">Forum Topic List</div>
															<div style="float:right;" class="padrht">-->
																<!--form action="<?php //echo url_for('Forums/index') ?>" method="post">
																	<span>Search:</span>&nbsp;&nbsp;             
																	<?php //echo tag('input', array('name' => 'search_text', 'type' => 'text', 'id' => 'search_text', 'size' => '25', 'value' => $sf_request->getParameter('search_text'))); ?>
																	<?php //echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
																	<a href="<?php //echo url_for('Forums/index') ?>">Clear</a>
																</form-->
													<!--		</div>
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
															<table width="100%" cellspacing="1" cellpadding="1" class="brd1">
															<?php if($pager->getnbResults() > 0){?>
																<tr class="fldbg">
																	<td width="30%" align="center"><?php include_partial('default/ordering',array('title'=>'Topic','ordering'=>false,"siteURL"=>'Forums/topicList','alias'=>'Topic','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td align="center"><?php include_partial('default/ordering',array('title'=>'Forum','ordering'=>false,"siteURL"=>'Forums/topicList','alias'=>'Forum','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Created By','ordering'=>false,"siteURL"=>'Forums/topicList','alias'=>'FirstName','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Total Replies','ordering'=>false,"siteURL"=>'Forums/topicList','alias'=>'TotalReplies','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Posted date','ordering'=>false,"siteURL"=>'Forums/topicList','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="15%" align="center" class="whttxt">Action</td>
																</tr>
																<?php $i =1; ?>
																<?php foreach ($pager->getResults() as $forumTopic):?>
																<?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
																<tr class="<?php echo $class;?>">
																	<td class="fldrowbg" align="left" valign="top"><?php echo $forumTopic->getTopic() ?></td>
																	<td class="fldrowbg" align="left" valign="top"><?php echo $forumTopic->getForumTopicsForums()->getTitle() ?></td>
																	<td class="fldrowbg" align="center" valign="top"><?php echo $forumTopic->getForumTopicsUsers()->getFirstName().' '.$forumTopic->getForumTopicsUsers()->getLastName() ?></td>
																	<td class="fldrowbg" align="center" valign="top"><?php echo $forumTopic->getTotalReplies() ?></td>
																	<td class="fldrowbg" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'),strtotime($forumTopic->getCreateDateTime())) ?></td> <!-- M d, Y H:i:s a-->
																	<td class="fldrowbg" align="center">
																		<?php 
																			if($forumTopic->getStatus()== sfConfig::get('app_FAQs_Active'))
																				echo link_to(image_tag("admin/active-cases-icon.png",array('width'=>'24px','height'=>'25px','title'=>'Click here to Inactive Topic','alt'=>'Active')),"Forums/changeTopicStatus?status=".sfConfig::get('app_FAQs_Inactive')."&id=".$forumTopic->getId());
																			else
																				echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','height'=>'25px','title'=>'Click here to activate Topic','alt'=>'Inactive')),"Forums/changeTopicStatus?status=".sfConfig::get('app_FAQs_Active')."&id=".$forumTopic->getId());
																		?>
																		<?php echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'24px','height'=>'25px')), 'Forums/editTopic?id='.$forumTopic->getId());?>
																		<?php echo link_to(image_tag('admin/view-icon.png',array('border'=>'0','alt'=>'View','title'=>'View','width'=>'24px','height'=>'25px')),'Forums/topicView?id='.$forumTopic->getId())?>
																		<?php echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")),'Forums/deleteTopic?id='.$forumTopic->getId());?>
																	</td>
																</tr>
																<?php endforeach; ?>
																<?php } else { ?> 	
																<tr class="fldbg"><td class="errormss">No Forum Topic found!</td></tr>
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
															<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'Forums/topicList', 'varExtra' => $varExtra));?>
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
*/ ?>