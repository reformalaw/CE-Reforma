<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="100%">
			<table cellspacing="0" cellpadding="0" class="AdminNavBar">
				<tr>
					<td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
					<td width="30%" class="drkgrylnk" align="center"><div class="Title">Testimonial List</div></td>
					<td width="35%" align="right" class="AdminBreadCrumb">
						<table cellpadding="8" cellspacing="0" align="right">
							<tr align="center">
								<td width="57" class="LinkImg" ><a href="<?php echo url_for('testimonial/new') ?>" title="Add New"><?php echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>Add </a></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td width="100%">
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
												<table cellspacing="0" cellpadding="0" align="center" width="100%">
													<tr>
														<td align="left" valign="top" colspan="2">&nbsp;</td>
													</tr>
													<tr>
														<td height="20" align="left" valign="top">&nbsp;</td>
													</tr> 
													<tr valign="top">
														<td colspan="2" class="dot"></td>
													</tr>
													<?php include_partial('default/message'); ?>
													<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<table width="100%" cellspacing="1" cellpadding="1" class="brd1">
																<?php $varExtra =""; ?>
																<?php if($pager->getnbResults() > 0){?>
																		<tr class="fldbg">
																			<td width="20%" align="center"><?php include_partial('default/ordering',array('title'=>'Client Name','ordering'=>false,"siteURL"=>'testimonial/index','alias'=>'ClientName','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																			<td width="20%" align="center"><?php include_partial('default/ordering',array('title'=>'Company Name','ordering'=>false,"siteURL"=>'testimonial/index','alias'=>'CompanyName ','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																			<td align="center"><?php include_partial('default/ordering',array('title'=>'Description','ordering'=>false,"siteURL"=>'testimonial/index','alias'=>'Description','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																			<td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Created date','ordering'=>false,"siteURL"=>'testimonial/index','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																			<td width="10%" align="center" class="whttxt">Action</td>
																		</tr>

																	<?php $i =1; ?>
																	<?php foreach ($pager->getResults() as $dataTestimonial):?>
																		<?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
																		<tr class="<?php echo $class;?>">
																			<td valign="top"><?php echo ucwords($dataTestimonial->getClientName()); ?></td>
																			<td valign="top"><?php echo $dataTestimonial->getCompanyName(); ?></td>
																			<td class="fldrowbg" align="left" valign="top"><?php echo nl2br(substr($dataTestimonial->getDescription(),0,100).".."); ?></td>
																			<td class="fldrowbg" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'),strtotime($dataTestimonial->getCreateDateTime())) ?></td>
																			<td valign="top" class="fldrowbg PracticeAreaActionIcons" align="center" valign="middle">
																				<?php
																					echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>24)), 'testimonial/edit?id='.$dataTestimonial->getId()); ?>
																					<a onclick="openview('<?php echo $dataTestimonial->getId(); ?>');" href="javascript:void(0);"><?php echo image_tag("admin/view-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Click to view",'width'=>'24px','height'=>'25px'))?></a>
																				<?php
																					echo link_to(image_tag('admin/delete-cases-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();",'width'=>24,'height'=>25)), 'testimonial/delete?id='.$dataTestimonial->getId());
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
																?>
															<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'testimonial/index', 'varExtra' => $varExtra));?>
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
		</td>
	</tr>
</table>

<script type="text/javascript">
function openview(id)
{
	$.fancybox.open({
            href : "<?php echo url_for('testimonial/view?id=')?>"+id,
            type : 'iframe',
            padding : 5
        });
}
</script>