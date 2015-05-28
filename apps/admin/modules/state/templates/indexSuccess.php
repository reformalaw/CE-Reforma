<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="100%">

			<table cellspacing="0" cellpadding="0" class="AdminNavBar">
				<tr>
					<td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
					<td width="30%" class="drkgrylnk" align="center"><div class="Title">States List</div></td>
					<td width="35%" align="right" class="AdminBreadCrumb">
						<table cellpadding="8" cellspacing="0" align="right">
							<tr align="center">
								<td width="57" class="LinkImg" ><a href="<?php echo url_for('state/new') ?>" title="Add New"><?php echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>Add </a></td>
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
													<?php include_partial('default/message'); ?>
													<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<table width="60%" cellspacing="1" cellpadding="1" class="brd1">
																<?php $varExtra =""; ?>
																<?php if($pager->getnbResults() > 0){?>
																
																<tr class="fldbg">
																	<td width="60%" align="center"><?php include_partial('default/ordering',array('title'=>'Name','ordering'=>true,"siteURL"=>'state/index','alias'=>'Name','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																	<td width="20%" align="center" class="whttxt">Action</td>
																</tr>
																
																<?php $i =1; ?>
																<?php foreach ($pager->getResults() as $states):?>
																<?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
																	<tr class="<?php echo $class;?>">
																		<td class="fldrowbg" align="left" valign="top"><?php echo link_to($states->getName(), 'counties/index?id='.$states->getId()) ?></td>
																		<td class="fldrowbg" align="center">
																			<?php echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>24)), 'state/edit?id='.$states->getId()); ?> &nbsp;
																			<?php echo link_to(image_tag('admin/view-icon.png',array('border'=>'0','alt'=>'View','title'=>'Click here to view counties of this state','width'=>'24px','height'=>'25px')), 'counties/index?id='.$states->getId()); ?>&nbsp;
																			<?php	$countiExist = CountiesTable::checkStatesCounties($states->getId());
																					if($countiExist)
																						echo image_tag('admin/delete-cases-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return fnCountiExist();",'width'=>24,'height'=>25,'style'=>"cursor: pointer;"));
																					else
																						echo link_to(image_tag('admin/delete-cases-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();",'width'=>24,'height'=>25)), 'state/delete?id='.$states->getId());
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
														<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'state/index', 'varExtra' => $varExtra));?>
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
<script>
function fnCountiExist()
{
	alert("You can not delete state, as it contains counties");
}
</script>