<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="100%">
		<!-- Bread Crumb Start -->
			<table cellspacing="0" cellpadding="0" class="AdminNavBar">
				<tr>
					<td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
					<td width="30%" class="drkgrylnk" align="center"><div class="Title">Faq LG List</div></td>
					<td width="35%" align="right" class="AdminBreadCrumb">
						<table cellpadding="8" cellspacing="0" align="right">
							<tr align="center">
								<td width="57" class="LinkImg" ><a href="<?php echo url_for('faq/new?webId=2') ?>" title="Add New"><?php echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
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
												<table width="100%" cellspacing="0" cellpadding="0" align="center">  <!--class="ContentTable"-->
												<?php if($pager->count() > 1): ?>
													<tr>
														<td align="left" valign="top" ><div class="noteDisplay" style="padding: 0 0 6px 12px;" ><strong > Note: </strong>  Please click and drag to change the order of display</div>  </td>
													</tr>
												<?php endif; ?>
													<!--<tr>
														<td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php //echo image_tag("admin/Icon_Groups.gif", array("alt"=>"Fa qs","title"=>"Fa qs","align"=>"middle"))?></td>
														<td width="90%" class="ContentBtmDotLn">
															<div style="float:left;" class="Title">Faq LG List</div>
															<div style="float:right;" class="padrht">
																<!--form action="<?php //echo url_for('faq/index') ?>" method="post">
																	<span>Search:</span>&nbsp;&nbsp;
																	<?php //echo tag('input', array('name' => 'search_text', 'type' => 'text', 'id' => 'search_text', 'size' => '25', 'value' => $sf_request->getParameter('search_text'))); ?>
																	<?php //echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
																	<a href="<?php //echo url_for('faq/leagaltripList') ?>">Clear</a>
																</form -->
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
													?>
													<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<table width="100%" cellspacing="1" cellpadding="1" class="brd1">
																<?php if($pager->count() > 0){?> <!-- if($pager->getnbResults() > 0) -->
																<tr class="fldbg">
																	<td class="border-right border-left border-top" align="center" width="60%"><?php include_partial('default/ordering',array('title'=>'Question','ordering'=>false,"siteURL"=>'faq/leagaltripList','alias'=>'Question','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td class="border-right border-top" align="center" width="20%" ><?php include_partial('default/ordering',array('title'=>'Last Posted Date','ordering'=>false,"siteURL"=>'faq/leagaltripList','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td class="whttxt border-right border-top" width="20%" align="center">Action</td>
																</tr>
																<!-- Start Drag Drop Area -->
																<tr>
																	<td colspan="3">
																		<div id="contentLeft">
																			<ul>
																			<?php foreach ($pager as $fa_qs):?>
																				<li  id="recordsArray_<?php echo $fa_qs->getId(); ?>">
																					<table cellspacing="0" cellpadding="0" width="100%">
																						<tr>
																							<td width="60%" class="fldrowbg border-right border-left" align="left" valign="middle">
																								<?php if($fa_qs->getWebsiteXFAQsFAQs()->getGloble() == "No"): ?>
																										<?php echo link_to($fa_qs->getWebsiteXFAQsFAQs()->getQuestion(),'faq/edit?webId=2&id='.$fa_qs->getWebsiteXFAQsFAQs()->getId());?>
																								<?php else: ?>
																										<?php echo $fa_qs->getWebsiteXFAQsFAQs()->getQuestion() ?>
																								<?php endif; ?>
																							</td>
																							<td width="20%" class="fldrowbg border-right" align="center" valign="middle"><?php echo date(sfConfig::get('app_dateformat'),strtotime($fa_qs->getCreateDateTime())) ?></td> <!-- M d, Y H:i:s a -->
																							<td width="20%" class="fldrowbg border-right" align="center" valign="middle">
																							<!-- START Active Inactive -->
																								<?php 
																								if($fa_qs->getWebsiteXFAQsFAQs()->getStatus() == sfConfig::get('app_FAQs_Active')):
																									if($fa_qs->getStatus()== sfConfig::get('app_FAQs_Active'))
																										echo link_to(image_tag("admin/active-cases-icon.png",array('width'=>'24','height'=>'25','title'=> sfConfig::get('app_ActiveDeactive_DactiveToolTip'),'alt'=>'Active')),"faq/changeStatusCounceledge?webId=2&status=".sfConfig::get('app_FAQs_Inactive')."&id=".$fa_qs->getId());
																									else
																										echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24','height'=>'25','title'=> sfConfig::get('app_ActiveDeactive_ActiveToolTip'),'alt'=>'Inactive')),"faq/changeStatusCounceledge?webId=2&status=".sfConfig::get('app_FAQs_Active')."&id=".$fa_qs->getId());
																								else:?>
																									<a href="#" style="cursor:none;"><?php echo image_tag("admin/blank-img.png",array('width'=>24,'height'=>'25')) ; ?></a>
																								<?php endif; ?>
																								<!-- END Active Inactive-->

																								<!-- START Edit -->
																								<?php if($fa_qs->getWebsiteXFAQsFAQs()->getGloble() == "No"): ?>
																										<?php echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'24px','height'=>'25')),'faq/edit?webId=2&id='.$fa_qs->getWebsiteXFAQsFAQs()->getId());?>
																								<?php else: ?>
																										<a href="#" style="cursor:none;"><?php echo image_tag("admin/blank-img.png",array('width'=>24,'height'=>'25')) ; ?></a>
																								<?php endif; ?>
																								<!--END Edit -->

																								<!-- START View -->
																								<a onclick="openview('<?php echo $fa_qs->getWebsiteXFAQsFAQs()->getId(); ?>',2);" href="javascript:void(0);"><?php echo image_tag('admin/view-icon.png',array('border'=>'0','alt'=>'View','title'=>'View','width'=>'24px','height'=>'25px'))?></a>
																								<?php //echo link_to(image_tag('admin/view-icon.png',array('border'=>'0','alt'=>'View','title'=>'View','width'=>'24px','height'=>'25px')), 'faq/view?webId=2&id='.$fa_qs->getWebsiteXFAQsFAQs()->getId());?>
																								<!-- END view-->

																								<!-- START Delete -->
																								<?php if($fa_qs->getWebsiteXFAQsFAQs()->getGloble() == "No"): ?>
																									<?php echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")),'faq/deleteCounceledge?webId=2&id='.$fa_qs->getId());?>
																								<?php else: ?>
																									<a href="#" style="cursor:none;"><?php echo image_tag("admin/blank-img.png",array('width'=>24,'height'=>'25px')) ; ?></a>
																								<?php endif; ?>
																								<!-- END Delete -->

																							</td>
																						</tr>
																					</table>
																				</li>
																			<?php endforeach; ?>
																			</ul>
																		</div>
																	</td>
																</tr>
																<!-- END Drag Drop Area-->

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
</table>

<script type="text/javascript">
	$(document).ready(function()
	{ 
		$(function() 
		{
			$("#contentLeft ul").sortable({ opacity: 0.6, cursor: 'move', update: function()
			{
			var order = $(this).sortable("serialize") ;
			$.post("<?php echo url_for("faq/globelOrdering"); ?>", order, function(theResponse){});
			}
			});
		});

	});
	function openview(id,webId) {
        $.fancybox.open({
            href : "<?php echo url_for('faq/view?id=')?>"+id+"/webId/"+webId,
            type : 'iframe',
            padding : 5
        });
	}
</script>