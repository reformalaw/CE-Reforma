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
													<td align="left" valign="middle"><strong>Forum Replies List</strong></td>
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
														//if($sortBy) $varExtra .="&sortBy=$sortBy";       
												?>
												<tr align="center" valign="top">
													<td colspan="2" class="ListAreaPad">
														<table width="100%" cellspacing="1" cellpadding="1" class="brd1">
															<?php if($pager->getnbResults() > 0){?>
															<tr class="fldbg">
																<td width="30%" align="center"><?php include_partial('default/ordering',array('title'=>'Reply','ordering'=>false,"siteURL"=>'forumreplay/index','alias'=>'Reply','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																<td width="20%" align="center"><?php include_partial('default/ordering',array('title'=>'Topic','ordering'=>false,"siteURL"=>'forumreplay/index','alias'=>'Topic','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																<td align="center"><?php include_partial('default/ordering',array('title'=>'Forum','ordering'=>false,"siteURL"=>'forumreplay/index','alias'=>'Forum','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Replied By','ordering'=>false,"siteURL"=>'forumreplay/index','alias'=>'FirstName','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Replied Date','ordering'=>false,"siteURL"=>'forumreplay/index','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																<td width="15%" align="center" class="whttxt">Action</td>
															</tr>
															<?php $i=1; ?>
															<?php foreach ($pager->getResults() as $forum_reply):?>
															<?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
															<tr class="<?php echo $class;?>">
																<td class="fldrowbg" align="left" valign="top"><?php  $oTheme = new Theme(); echo $oTheme->limitWords($forum_reply->getReply(),20); ?></td>
																<td class="fldrowbg" align="left" valign="top"><?php echo $forum_reply->getForumReplyForumTopics()->getTopic() ?></td>
																<td class="fldrowbg" align="left" valign="top"><?php echo $forum_reply->getForumReplyForums()->getTitle() ?></td>
																<td class="fldrowbg" align="left" valign="top"><?php echo $forum_reply->getForumReplyUsers()->getFirstName().' '.$forum_reply->getForumReplyUsers()->getLastName() ?></td>
																<td class="fldrowbg" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'),strtotime($forum_reply->getCreateDateTime()))  ?></td>
																<td class="fldrowbg" align="center">
																	<?php 
																		if($forum_reply->getStatus()== sfConfig::get('app_FAQs_Active'))
																		{
																			if(isset($flagTopicId))
																				echo link_to(image_tag("admin/active-cases-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip'),'alt'=>'Active')),"forumreplay/changeReplayStatus?status=".sfConfig::get('app_FAQs_Inactive')."&id=".$forum_reply->getId()."&flagTopicId=".$flagTopicId);
																			else
																				echo link_to(image_tag("admin/active-cases-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip'),'alt'=>'Active')),"forumreplay/changeReplayStatus?status=".sfConfig::get('app_FAQs_Inactive')."&id=".$forum_reply->getId());
																		}
																		else
																		{
																			if(isset($flagTopicId))
																				echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'),'alt'=>'Inactive')),"forumreplay/changeReplayStatus?status=".sfConfig::get('app_FAQs_Active')."&id=".$forum_reply->getId()."&flagTopicId=".$flagTopicId);
																			else
																				echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','height'=>'25px','title'=> sfConfig::get('app_ActiveDeactive_ActiveToolTip'),'alt'=>'Inactive')),"forumreplay/changeReplayStatus?status=".sfConfig::get('app_FAQs_Active')."&id=".$forum_reply->getId());
																		}
																	?>
																	<?php 
																		if(isset($flagTopicId))
																			echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'24px','height'=>'25px')), 'forumreplay/edit?id='.$forum_reply->getId()."&flagTopicId=".$flagTopicId);
																		else
																			echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'24px','height'=>'25px')), 'forumreplay/edit?id='.$forum_reply->getId());?>
																	<?php //echo link_to(image_tag('admin/view-icon.png',array('border'=>'0','alt'=>'View','title'=>'View','width'=>'24px','height'=>'25px')),'forumreplay/replayView?id='.$forum_reply->getId());?>
																	
																	<?php 
																		if(isset($flagTopicId))
																			echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")),'forumreplay/delete?id='.$forum_reply->getId()."&flagTopicId=".$flagTopicId); 
																		else
																			echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")),'forumreplay/delete?id='.$forum_reply->getId()); ?>
																</td>
															</tr>
                                                            
									
															<?php endforeach; ?>    
															<?php } else { ?> 
															<tr class="fldbg">
																<td class="errormss">No items found.</td>
															</tr>
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
															if(isset($flagTopicId)) $varExtra .="&flagTopicId=$flagTopicId";
														?>
														<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'forumreplay/index', 'varExtra' => $varExtra));?>
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
					<td width="30%" class="drkgrylnk" align="center"><div class="Title">Forum Replies List</div></td>
					<td width="35%" align="right" class="AdminBreadCrumb">
						<table cellpadding="8" cellspacing="0" align="right">
							<tr align="center">
								<!-- <td width="57" class="LinkImg" ><a href="<?php //echo url_for('forumreplay/new') ?>" title="Add New"><?php //echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
								Add </a></td>   -->  
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
													<td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php //echo image_tag("admin/Icon_Groups.gif", array("alt"=>"Forum reply","title"=>"Forum reply","align"=>"middle"))?></td>
													<td width="90%" class="ContentBtmDotLn">
														<div style="float:left;" class="Title">Forum Replies List</div>
														<div style="float:right;" class="padrht">-->
															<!--<form action="<?php //echo url_for('forumreplay/index') ?>" method="post">
																<span><?php //echo $objSearchForm['search_text']->renderLabel(); ?>:</span>&nbsp;&nbsp;<?php //echo $objSearchForm['search_text']->render(); ?>&nbsp;&nbsp;
																<?php //echo $objSearchForm['field_type']->renderLabel(); ?>:&nbsp;&nbsp;<?php //echo $objSearchForm['field_type']->render(); ?>&nbsp;&nbsp;
																<?php //echo tag('input', array('name' => 'search_btn', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
																<a href="<?php //echo url_for('forumreplay/index') ?>">Clear</a>
															</form>-->
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
																<td width="30%" align="center"><?php include_partial('default/ordering',array('title'=>'Reply','ordering'=>false,"siteURL"=>'forumreplay/index','alias'=>'Reply','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																<td width="20%" align="center"><?php include_partial('default/ordering',array('title'=>'Topic','ordering'=>false,"siteURL"=>'forumreplay/index','alias'=>'Topic','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																<td align="center"><?php include_partial('default/ordering',array('title'=>'Forum','ordering'=>false,"siteURL"=>'forumreplay/index','alias'=>'Forum','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Replied By','ordering'=>false,"siteURL"=>'forumreplay/index','alias'=>'FirstName','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Replied Date','ordering'=>false,"siteURL"=>'forumreplay/index','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																<td width="15%" align="center" class="whttxt">Action</td>
															</tr>
															<?php $i=1; ?>
															<?php foreach ($pager->getResults() as $forum_reply):?>
															<?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
															<tr class="<?php echo $class;?>">
																<td class="fldrowbg" align="left" valign="top"><?php  $oTheme = new Theme(); echo $oTheme->limitWords($forum_reply->getReply(),20); ?></td>
																<td class="fldrowbg" align="left" valign="top"><?php echo $forum_reply->getForumReplyForumTopics()->getTopic() ?></td>
																<td class="fldrowbg" align="left" valign="top"><?php echo $forum_reply->getForumReplyForums()->getTitle() ?></td>
																<td class="fldrowbg" align="left" valign="top"><?php echo $forum_reply->getForumReplyUsers()->getFirstName().' '.$forum_reply->getForumReplyUsers()->getLastName() ?></td>
																<td class="fldrowbg" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'),strtotime($forum_reply->getCreateDateTime()))  ?></td>
																<td class="fldrowbg" align="center">
																	<?php 
																		if($forum_reply->getStatus()== sfConfig::get('app_FAQs_Active'))
																			echo link_to(image_tag("admin/active-cases-icon.png",array('width'=>'24px','height'=>'25px','title'=>'Click here to Inactive Reply','alt'=>'Active')),"forumreplay/changeReplayStatus?status=".sfConfig::get('app_FAQs_Inactive')."&id=".$forum_reply->getId());
																		else
																			echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','height'=>'25px','title'=>'Click here to activate Reply','alt'=>'Inactive')),"forumreplay/changeReplayStatus?status=".sfConfig::get('app_FAQs_Active')."&id=".$forum_reply->getId());
																	?>
																	<?php echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'24px','height'=>'25px')), 'forumreplay/edit?id='.$forum_reply->getId());?>
																	<?php echo link_to(image_tag('admin/view-icon.png',array('border'=>'0','alt'=>'View','title'=>'View','width'=>'24px','height'=>'25px')),'forumreplay/replayView?id='.$forum_reply->getId());?>
																	<?php echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")),'forumreplay/delete?id='.$forum_reply->getId()); ?>
																</td>
															</tr>
															<?php endforeach; ?>    
															<?php } else { ?> 
															<tr class="fldbg">
																<td class="errormss">No Forum reply found!</td>
															</tr>
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
														<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'forumreplay/index', 'varExtra' => $varExtra));?>
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