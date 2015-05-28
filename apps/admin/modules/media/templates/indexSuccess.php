<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="100%">
		<!-- Bread Crumb Start -->
			<table cellspacing="0" cellpadding="0" class="AdminNavBar">
				<tr>
					<td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
					<td width="30%" class="drkgrylnk" align="center"><div class="Title">Stock Photos List</div></td>
					<td width="35%" align="right" class="AdminBreadCrumb">
						<table cellpadding="8" cellspacing="0" align="right">
							<tr align="center">
								<td width="57" class="LinkImg" ><a href="<?php echo url_for('media/new') ?>" title="Add New"><?php echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
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
					<td align="right">	
						<!--START code added by jaydip dodiya-->
						<form id="SearchMediaFrm" action="<?php echo url_for('media/index') ?>" method="post">
							<table width="100%" cellspacing="10" cellpadding="0">
								<tr>
									<td  align="right" valign="middle" style="font-size:14px;"><?php echo $objSearchForm['search_type']->renderLabel(); ?></td>
									<td width="100" align="right" valign="top"><?php echo $objSearchForm['search_type']->render(array('onChange'=>"submitForm();")); ?></td>
									<?php /*<td align="left" valign="top"><span class="bluButton">
										<?php echo tag('input', array('name' => 'search_btn', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
										<a href="<?php echo url_for('media/index') ?>" class = 'CommonButton'>Clear</a>
									</span></td>*/ ?>
								</tr>
							</table>
						</form>
						<!--END code added by jaydip dodiya-->
					</td>
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

													<?php
														$varExtra = '';
														if($sf_request->getParameter('search_text')) 
														$varExtra .="&search_text=".$sf_request->getParameter('search_text');
													?>

													<tr align="center" valign="top">
														<td colspan="2" class="ThemeList ListAreaPad">
															<?php if(count($pager) > 0){?>
																	<ul>
																	<?php foreach ($pager as $media):?>
																				<li>
																					<?php 
																						$bannerType = $media->getType();
																						$bannerFolderName = "";
																						if($bannerType == "BannerBackground")
																							$bannerFolderName = "Banner-Background".DIRECTORY_SEPARATOR;
																						elseif($bannerType == "BannerForeground")
																							$bannerFolderName = "Banner-Foreground".DIRECTORY_SEPARATOR;
																						elseif($bannerType == "Unsorted")
																							$bannerFolderName = "Unsorted".DIRECTORY_SEPARATOR;
																						elseif($bannerType == "Logo")
																							$bannerFolderName = "Logo".DIRECTORY_SEPARATOR;
																						elseif($bannerType == "BodyBackground")
																							$bannerFolderName = "Body-Background".DIRECTORY_SEPARATOR;
																					?>
																					<?php if($media->getImageName() != "" ): ?>
																						<?php if(file_exists(sfConfig::get('sf_upload_dir')."/Media/".$bannerFolderName.$media->getImageName())):?> <!--  if(file_exists(sfConfig::get('sf_upload_dir')."/stockPhotoThumb/".$bannerFolderName.$media->getImageName())) -->
																							<a rel="lightbox" href="<?php echo $ssSiteUrl; ?>/uploads/Media/<?php echo $bannerFolderName.$media->getImageName();?>" ><?php echo image_tag('../uploads/Media/'.$bannerFolderName.$media->getImageName(),array('border'=>'1','alt'=>'Image','title'=>"Click To See Preview",'width'=>'100px','height'=>'100px'))?></a>
																						<?php else:?>
																							<?php echo image_tag("admin/noImage.jpeg", array('border'=>'1','alt'=>'Image','title'=>"No-Image",'width'=>'100px','height'=>'100px'))?>
																						<?php endif;?>	
																					<?php else: ?>
																						<?php echo image_tag("admin/noImage.jpeg", array('border'=>'1','alt'=>'Image','title'=>"No-Image",'width'=>'100px','height'=>'100px'))?>
																					<?php endif; ?>
																					
																					<div class="name"><?php echo $media->getTitle() ?></div>
																					<div class="settheme">
                                                                                    	<label>Type:</label>
																						<?php echo $media->getType() ?>
																						<p>
                                                                                        <label>Action: </label>
																							<?php echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'24px','height'=>'25px')),'media/edit?id='.$media->getId());?>
																							<?php echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();")),'media/delete?id='.$media->getId()); ?>
																						</p>
																					</div>
																				</li>
																	<?php endforeach; ?>
																	</ul>

															<?php } else { ?> 
																<ul><li>No items found.</li></ul>
															<?php } ?>
															</table>
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

<script type="text/javascript">
function submitForm()
{
	$("#SearchMediaFrm").submit();
}
</script>