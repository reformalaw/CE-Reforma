<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="100%">
		<!-- Bread Crumb Start -->
			<table cellspacing="0" cellpadding="0" class="AdminNavBar">
				<tr>
					<td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
					<td width="30%" class="drkgrylnk" align="center"><div class="Title">Global Faq List</div></td>
					<td width="35%" align="right" class="AdminBreadCrumb">
						<table cellpadding="8" cellspacing="0" align="right">
							<tr align="center">
								<td width="57" class="LinkImg" ><a href="<?php echo url_for('faq/new?webId=0') ?>" title="Add New"><?php echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
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
												<table width="100%" cellspacing="0" cellpadding="0" align="center" > <!--class="ContentTable"-->
													<!--<tr>-->
														<!--<td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php //echo image_tag("admin/Icon_Groups.gif", array("alt"=>"Fa qs","title"=>"Fa qs","align"=>"middle"))?></td>-->
														<!--<td width="90%" class="ContentBtmDotLn">-->
														<!--	<div style="float:left;" class="Title">Global Faq List</div>-->
															<!--<div style="float:right;" class="padrht">-->
																<form action="<?php echo url_for('faq/index') ?>" method="post">

																</form>
															<!--</div>-->
														<!--</td>-->
													<!--</tr>-->
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
															<?php if($pager->getnbResults() > 0){?> <!-- if($pager->getnbResults() > 0) -->
																<tr class="fldbg">
																	<td align="center"><?php include_partial('default/ordering',array('title'=>'Question','ordering'=>false,"siteURL"=>'@faq_list','alias'=>'Question','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td align="center"><?php include_partial('default/ordering',array('title'=>'Global','ordering'=>false,"siteURL"=>'@faq_list','alias'=>'Globle','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td align="center"><?php include_partial('default/ordering',array('title'=>'Last Posted Date','ordering'=>false,"siteURL"=>'@faq_list','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td align="center"><?php include_partial('default/ordering',array('title'=>'Counsel Edge','ordering'=>false,"siteURL"=>'@faq_list','alias'=>'Counceledge','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td align="center"><?php include_partial('default/ordering',array('title'=>'Leagalgrip','ordering'=>false,"siteURL"=>'@faq_list','alias'=>'Leagaltrip','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="20%" align="center" class="whttxt">Action</td>
																</tr>
																<?php $i=1;?>
																<?php foreach ($pager->getResults() as $fa_qs):?>  <!--   ->getResults() -->
																<?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
																<tr class="<?php echo $class;?>">
																	<td class="fldrowbg" align="left" valign="top">
																		<?php echo link_to($fa_qs->getQuestion(),'faq/edit?webId=0&id='.$fa_qs->getId());?>
																		<?php //echo $fa_qs->getQuestion() ?>
																	</td>
																	<td class="fldrowbg" align="center" valign="top"><?php echo $fa_qs->getGloble() ?></td>
																	<td class="fldrowbg" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'),strtotime($fa_qs->getCreateDateTime())) ?></td>
																	<?php
																		/* Here we check that record is awailabel in table WebsiteXFAQs or not */
																			$oWebsiteXFAQs = new WebsiteXFAQs();
																			if($oWebsiteXFAQs->CheckBoxCheckUncheck($fa_qs->getId(),1)):
																	?>
																	<td class="fldrowbg" align="center" valign="top"><input type="checkbox" checked= true id="ce<?php echo $fa_qs->getId()?>" onClick="InsertCE(<?php echo $fa_qs->getId() ?>,1,'ce');"></td>
																	<?php
																			else:
																	?>
																	<td class="fldrowbg" align="center" valign="top"><input type="checkbox" id="ce<?php echo $fa_qs->getId()?>" onClick="InsertCE(<?php echo $fa_qs->getId() ?>,1,'ce');"></td>
																	<?php endif; ?>
																	<?php 
																		/* Here we check that record is awailabel in table WebsiteXFAQs or not */
																			$oWebsiteXFAQs = new WebsiteXFAQs();
																			if($oWebsiteXFAQs->CheckBoxCheckUncheck($fa_qs->getId(),2)):
																	?>
																	<td class="fldrowbg" align="center" valign="top"><input type="checkbox" checked=true id="lg<?php echo $fa_qs->getId()?>" onClick="InsertCE(<?php echo $fa_qs->getId() ?>,2,'lg');"></td>
																		<?php else: ?>
																	<td class="fldrowbg" align="center" valign="top"><input type="checkbox" id="lg<?php echo $fa_qs->getId()?>" onClick="InsertCE(<?php echo $fa_qs->getId() ?>,2,'lg');"></td>
																	<?php endif; ?>
																	<td class="fldrowbg" align="center">
																	<?php 
																	if($fa_qs->getStatus()== sfConfig::get('app_FAQs_Active'))
																		echo link_to(image_tag("admin/active-cases-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip'),'alt'=>'Active')),"faq/changeStatus?status=".sfConfig::get('app_FAQs_Inactive')."&id=".$fa_qs->getId());
																	else
																		echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'),'alt'=>'Inactive')),"faq/changeStatus?status=".sfConfig::get('app_FAQs_Active')."&id=".$fa_qs->getId());
																	?>
																	<?php echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'24px','height'=>'25px')),'faq/edit?webId=0&id='.$fa_qs->getId());?>
																	<a onclick="openview('<?php echo $fa_qs->getId(); ?>',0);" href="javascript:void(0);"><?php echo image_tag('admin/view-icon.png',array('border'=>'0','alt'=>'View','title'=>'View','width'=>'24px','height'=>'25px'))?></a>
																	<?php //echo link_to(image_tag('admin/view-icon.png',array('border'=>'0','alt'=>'View','title'=>'View','width'=>'24px','height'=>'25px')),'faq/view?webId=0&id='.$fa_qs->getId());?>
																	<?php echo link_to(image_tag('admin/delete-cases-icon.png',array('height'=>'25px','width'=>'24px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")),'faq/delete?webId=0&id='.$fa_qs->getId());?>
																	<!--<a href="<?php //echo url_for('faq/edit?webId=0&id='.$fa_qs->getId())?>"><?php //echo image_tag('admin/edit-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'20px','height'=>'20px'))?></a>-->
																	
																	<!--<a href="<?php //echo url_for('faq/delete?webId=0&id='.$fa_qs->getId())?>"><?php //echo image_tag('admin/Delete_small.gif',array('border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();"))?></a>-->
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
															?>
															<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => '@faq_list', 'varExtra' => $varExtra));?>
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
/* this function is for insert counceldedge and leagaltrip */
function InsertCE(id,WebsiteId,prefix)
{
    if(document.getElementById(prefix+id).checked == true)
    {
		$.ajax({
				  'type': 'POST',
				  'url': '<?php echo url_for("faq/ajaxInsertWebsiteXFAQs"); ?>',
				  'data': {FAQId:id, WebsiteId:WebsiteId, Status:'<?php echo sfConfig::get('app_FAQs_Active'); ?>'}
			  });
    }
    else
    {
		$.ajax({
				  'type': 'POST',
				  'url': '<?php echo url_for("faq/ajaxDeleteWebsiteXFAQs"); ?>',
				  'data': {FAQId:id, WebsiteId:WebsiteId}
			  });
    }
}

function openview(id,webId) {
        $.fancybox.open({
            href : "<?php echo url_for('faq/view?id=')?>"+id+"/webId/"+webId,
            type : 'iframe',
            padding : 5
        });
	}
</script>