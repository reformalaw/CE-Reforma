<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="100%">
		<!-- Bread Crumb Start -->
			<table cellspacing="0" cellpadding="0" class="AdminNavBar">
				<tr>
					<td width="35%" class="drkgrylnk padlft"><a href="<?php echo url_for("default/index");?>" title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home")) ?></a></td>
					<td width="30%" class="drkgrylnk" align="center"><div class="Title">View Role Detail </div></td>
					<td width="35%" align="right" class="AdminBreadCrumb">
						<table cellpadding="8" cellspacing="0" align="right">
							<tr align="center">
								
								<?php  if($role->getStatus()=="Active"): ?>
									<td width="57" class="LinkImg" >
										<a href="<?php echo url_for('roles/changeStatus?status=Inactive&id='.$role->getId().'&flag=true') ?>" title= "Click here to Inactive Role"><?php echo image_tag("admin/Icon_active.png", array("alt"=>"Active","border"=>"0", "title" =>"Click here to Inactive Role")) ?><br />Active </a>
									</td>
								<?php elseif($role->getStatus()=="Inactive"): ?>
									<td width="57" class="LinkImg" >
										<a href="<?php echo url_for('roles/changeStatus?status=Active&id='.$role->getId().'&flag=true') ?>" title= "Click here to Activate Role"><?php echo image_tag("admin/Icon_inactive.png", array("alt"=>"Inactive","title"=>"Click here to Activate Role","border"=>"0")) ?><br />Inactive </a>
									</td>
								<?php endif;?>

								<td width="57" class="LinkImg" >
									<a href="<?php echo url_for('roles/edit?id='.$role->getId()) ?>" title="Edit"><?php echo image_tag("admin/Icon_Add.png", array("alt"=>"Edit","title"=>"Edit","border"=>"0")) ?><br />Edit </a>
								</td>
	
								<td width="57" class="LinkImg" >
									<a OnClick ="return deleteConfirmation();" href="<?php echo url_for('roles/delete?id='.$role->getId()) ?>" title="Delete"><?php echo image_tag("admin/Icon_delete.png", array("alt"=>"Delete","title"=>"Delete","border"=>"0")) ?><br />Delete </a>
								</td>

								<td width="57" class="LinkImg" >
									<a href="<?php echo url_for('roles/index') ?>"><?php echo image_tag("admin/Icon_Cancel.gif", array("alt"=>"Cancel","title"=>"Cancel","border"=>"0")) ?><br />Cancel </a>
								</td>
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
				
				<?php
					// success message
					include_partial('default/message'); 
				?>
				<tr>
					<td width="95%" class="ContentPad">
						<table width="99%" align="center" cellpadding="0" cellspacing="0" class="MainTbl">
							<tr>
								<td class="MaintblPadding">
									<table width="100%" cellspacing="0" cellpadding="0">
										<tr>
											<td class="ContentPad">
												<table cellspacing="0" cellpadding="0" align="center" width="100%">
													<tr valign="top">
														<td colspan="2" class="dot"></td>
													</tr>
													<tr valign="top">
														<td colspan="2" class="ListAreaPad">
															<table width="65%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
																<tr class="fldbg">
																	<td colspan="2" class="whttxt">Role Detail</td>
																</tr>
																<tr>
																	<td width="26%" class="fldrowbg"><b>Role Name :</b></td>
																	<td width="68%" class="fldrowlightbg"><?php echo $role->getName();?></td>
																</tr>
																<tr>
																	<td width="26%" class="fldrowbg"><b>Permissions On :</b></td>
																	<td width="68%" class="fldrowlightbg">
																	<?php   $count = 1;
																			$arrPer = RolesXPermissionTable::getPermissionRecordForViewPage($sf_request->getParameter('id'));
																			for ($i=0;$i<count($arrPer);$i++)
																			{
																				echo $count.". ".$arrPer[$i]."<br/>";
																				$count++;
																			}?>
																	</td>
																</tr>
																<tr>
																	<td width="26%" class="fldrowbg"><b>Status :</b></td>
																	<td width="68%" class="fldrowlightbg"><?php echo $role->getStatus();?></td>
																</tr>
																<tr>
																	<td width="26%" class="fldrowbg"><b>Created Date :</b></td>
																	<td width="68%" class="fldrowlightbg"><?php echo date(sfConfig::get('app_dateformat'),strtotime($role->getCreateDateTime()));?></td>
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
		<!-- Control Panel End -->
		</td>
	</tr>
</table>