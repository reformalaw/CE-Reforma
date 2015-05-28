<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="100%">
		<!-- Bread Crumb Start -->
			<table cellspacing="0" cellpadding="0" class="AdminNavBar">
				<tr>
					<td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
					<td width="30%" class="drkgrylnk" align="center"><div class="Title">Theme List</div></td>
					<td width="35%" align="right" class="AdminBreadCrumb">
						<table cellpadding="8" cellspacing="0" align="right">
							<tr align="center">
								<td width="57" class="LinkImg" ><a href="<?php echo url_for('theme/new') ?>" title="Add New"><?php echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
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
												<table cellspacing="0" cellpadding="0" align="center" width="100%">
													<tr valign="top">
														<td colspan="2" class="dot"></td>
													</tr>
													<tr align="center" valign="top">
														<?php include_partial('default/message'); ?>
													</tr>

													<tr align="center" valign="top">
														<td colspan="2" class="ThemeList ListAreaPad">

															<?php if(count($pager) > 0){?>  
															<form id="chkform" method="POST" action="<?php echo url_for('theme/check');?>" name="chkform" >
																<h3><span>Current Theme:</span> <label>&nbsp;</label></h3>
																	<ul>
																	<?php foreach ($pager as $theme):?>
																				<?php if($theme->getIsDefault() =='Yes'): ?> 
																					<li class="current">
																				<?php else: ?>
																					<li>
																				<?php endif; ?>

																				<?php if($theme->getScreenshot() != "" ): ?>
																					<?php if(file_exists(sfConfig::get('sf_upload_dir')."/Theme/".$theme->getScreenshot())):?>
																							<a onclick="openview('<?php echo $theme->getId(); ?>');" href="javascript:void(0);"><?php echo image_tag('../uploads/Theme/thumb/'.$theme->getScreenshot(),array('border'=>'1','alt'=>'Image','title'=>"Click To See Preview",'width'=>'200px','height'=>'200px'))?></a>
																							<!--<a rel="lightbox" href="<?php //echo $ssSiteUrl; ?>/uploads/Theme/<?php //echo $theme->getScreenshot();?>" ><?php //echo image_tag('../uploads/Theme/thumb/'.$theme->getScreenshot(),array('border'=>'1','alt'=>'Image','title'=>"Click To See Preview",'width'=>'200px','height'=>'200px'))?></a>-->
																					<?php else:?>
																							<a onclick="openview('<?php echo $theme->getId(); ?>');" href="javascript:void(0);"><?php echo image_tag("admin/noImage.jpeg", array('border'=>'1','alt'=>'Image','title'=>"Click To See Preview",'width'=>'200px','height'=>'200px'))?></a>
																							<?php //echo image_tag("admin/noImage.jpeg", array('border'=>'1','alt'=>'Image','title'=>"No-Image",'width'=>'200px','height'=>'200px'))?>
																					<?php endif;?>
																				<?php else: ?>
																							<a onclick="openview('<?php echo $theme->getId(); ?>');" href="javascript:void(0);"><?php echo image_tag("admin/noImage.jpeg", array('border'=>'1','alt'=>'Image','title'=>"Click To See Preview",'width'=>'200px','height'=>'200px'))?></a>
																							<?php //echo image_tag("admin/noImage.jpeg", array('border'=>'1','alt'=>'Image','title'=>"No-Image",'width'=>'200px','height'=>'200px'))?>
																				<?php endif; ?>
																				
                                                                                      <div class="name"><?php echo $theme->getName() ?></div>
                                                                                    	<div class="settheme">
																							
                                                                                        	<label>Make Default:</label>
																							<?php if($theme->getIsDefault()!='Yes'): ?>
																								<?php  if($theme->getStatus()=="Active"): ?>
																									<input type="checkbox" id="chkbox<?php echo $theme->getId(); ?>" name="chkbox[]" value="<?php echo $theme->getId(); ?>" onClick="DefaultTheme(<?php echo $theme->getId(); ?>)">
																								<?php else: ?>
																									--
																								<?php endif; ?>
																							<?php else : ?>
																								Default Theme
																							<?php endif; ?>
                                                                                            <p>
																							<label>Action: </label>
																								<?php //echo link_to(image_tag('admin/view-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'View')), 'theme/view?id='.$theme->getId());?>
																								
																									<?php if($theme->getIsDefault() !='Yes'): ?> 
																									<?php  if($theme->getStatus()=="Active"){
																									    echo link_to(image_tag("admin/active-cases-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip'),'alt'=>'Active')),"theme/changeStatus?status=".sfConfig::get('app_Status_Inactive')."&id=".$theme->getId());
																									}elseif($theme->getStatus()=="Inactive"){
																											echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'),'alt'=>'Inactive')),"theme/changeStatus?status=".sfConfig::get('app_Status_Active')."&id=".$theme->getId()); } ?>
																									<?php endif;?>
																									<?php echo link_to(image_tag('admin/edit-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Edit','title'=>'Edit')), 'theme/edit?id='.$theme->getId());?>
																									
																									<?php if($theme->getIsDefault() !='Yes'): ?> 
																										<?php echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")),'theme/delete?id='.$theme->getId());?>
																									<?php endif;?>
																							</p>
                                                                                      </div>
                                                                                  </li>
																	<?php  endforeach; ?>
																	</ul>
															</form>
															<?php } else { ?> 
																<ul><li>No items found.</li></ul>
															<?php } ?>
															
														</td>
													</tr>
													<tr align="right" valign="top">
														<td colspan="2" class="ListAreaPad">

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


<script>
function DefaultTheme(snId)
{
    var ans = confirm("Are you sure you want to set this as default theme ?");
    if(ans)
    {
        chkform.submit();
        return true;
    }
    else
    {
        $("#chkbox"+snId).removeAttr("checked");
        return false;
    }
}

function openview(id) {

    $.fancybox.open({
        href : "<?php echo url_for('theme/view?id=')?>"+id,
        type : 'iframe',
        padding : 5
    });

}
</script>