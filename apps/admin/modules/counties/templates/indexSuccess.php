<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="100%">

			<table cellspacing="0" cellpadding="0" class="AdminNavBar">
				<tr>
					<td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
					<td width="30%" class="drkgrylnk" align="center"><div class="Title">Counties List</div></td>
					<td width="35%" align="right" class="AdminBreadCrumb">
						<table cellpadding="8" cellspacing="0" align="right">
							<tr align="center">
								<td width="57" class="LinkImg" ><a href="<?php echo url_for('counties/new') ?>" title="Add New"><?php echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>Add </a></td>
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
												<table cellspacing="0" cellpadding="0" align="center" width="80%">
													<tr>
														<td align="left" valign="top" colspan="2">&nbsp;</td>
													</tr>
													<?php include_partial('default/message'); ?>
													
													<tr>
														<td align="center" valign="top" class="CasesListSearch" colspan="2">
															<form action="<?php echo url_for('counties/index') ?>"  method="post" enctype="multipart/form-data">
																<table width="100%" cellspacing="10" cellpadding="0">
																	<tr style="line-height:22px">
																		<td width="100px" align="left" valign="top"><?php echo $searchForm['searchbystate']->renderLabel(); ?></td>
																		<td width="200px" align="left" valign="top">
																			<?php
																				$searchForm->setDefault("searchbystate",$searchBy);
																				echo $searchForm['searchbystate']->render(array("style"=>"width:200px;"));
																			?>
																		</td>

																		<td align="left" valign="top"><span class="bluButton"> 
																			<?php echo tag('input', array('name' => 'search_btn', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
																			<a href="<?php echo url_for('counties/index') ?>" class ='CommonButton'>Clear</a>
																		</td>
																	</tr>
																</table>
															</form>
														</td>
													</tr>

													<tr>
														<td align="left" valign="top" colspan="2">&nbsp;</td>
													</tr>
													<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<table width="100%" cellspacing="1" cellpadding="1" class="brd1">
																<?php $varExtra =""; ?>
																<?php if($pager->getnbResults() > 0){?>
																	<tr class="fldbg">
																		
																		<td width="40%" align="center"><?php include_partial('default/ordering',array('title'=>'State Name','ordering'=>false,"siteURL"=>'counties/index','alias'=>'State','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																		<td width="40%" align="center"><?php include_partial('default/ordering',array('title'=>'Counties Name','ordering'=>false,"siteURL"=>'counties/index','alias'=>'Name','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																		<td width="20%" align="center" class="whttxt">Action</td>
																	</tr>
																	<?php $i=1; ?>
																	<?php foreach ($pager->getResults() as $counties):?>
																		<?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
																		<tr class="<?php echo $class;?>">
																			<td class="fldrowbg" align="left" valign="top"><?php echo $counties->getCountiesStates()->getName(); ?></td>
																			<td class="fldrowbg" align="left" valign="top"><?php echo $counties->getName() ?></td>
																			<td class="fldrowbg" align="center">
																				<?php echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>24)), 'counties/edit?id='.$counties->getId()); ?>
																				<?php $flag = UserPracticeAreaLocationTable::checkCountiesExist($counties->getId()); ?>
																				<?php if($flag): ?>
																					<?php echo image_tag('admin/delete-cases-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return countiesDelete();",'width'=>24,'height'=>25,'style'=>"cursor: pointer;"));?>
																				<?php else: ?>
																					<?php echo link_to(image_tag('admin/delete-cases-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();",'width'=>24,'height'=>25)), 'counties/delete?id='.$counties->getId());?>
																				<?php endif; ?>
																			</td>
																		</tr>
																	<?php endforeach; ?>
																	<?php } else { ?> 
																		<tr class="fldbg"><td class="errormss">No county found.</td></tr>
																	<?php } ?>
															</table>
														</td>
													</tr>
													<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<?php
																if($orderBy) $varExtra .="&orderBy=$orderBy";
																if($orderType) $varExtra .="&orderType=$orderType";
																if($searchBy) $varExtra .="&searchBy=$searchBy";
																if($id) $varExtra .="&id=$id";
															?>
															<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'counties/index', 'varExtra' => $varExtra));?>
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
function countiesDelete()
{
	alert("You can not delete county, as it contains user location");
}

</script>