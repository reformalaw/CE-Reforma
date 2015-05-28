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
						<?php include_partial('personalcms/customerMenu');?>
						<!--END VERTICAL MENU-->
					</td>
					<td align="center" valign="top" class="CashDetails">
					<table width="96%" cellspacing="0" cellpadding="0">
						<tr>
							<td align="left" valign="top" height="25">&nbsp;</td>
						</tr>
						<tr>
							<td align="left" valign="top" class="WebsiteTab">
								<?php include_partial('personalcms/horizontalMenu');?>
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" class="WebsiteDetails">
								<table width="100%" cellspacing="10" cellpadding="0">
									<tr>
										<td align="center" valign="top">
											<table width="98%" cellspacing="1" cellpadding="1" class="PageListHeading">
												<tr>
													<td align="left" valign="middle"><strong>Theme List</strong></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td align="center" valign="top">
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
														//if($sortBy) $varExtra .="&sortBy=$sortBy";
													?>
													
												<tr align="center" valign="top">
														<td colspan="2" class="ThemeList ListAreaPad">
															<?php if(count($pager) > 0){?>
															<form id="radioform" method="POST" action="<?php echo url_for('usertheme/updateTheme');?>" name="radioform" >
																	<h3><span>Current Theme:</span> <label>&nbsp;</label></h3>
																
																	<ul>
																	<?php foreach ($pager as $theme):?>
																			
																				<?php if($theme->getId() == $snThemeId): ?> 
																							<li class="current">
																					<?php else:?>
																							<li>
																					<?php endif; ?>
																					
																						<?php if($theme->getScreenshot() != "" ): ?>
																							<?php if(file_exists(sfConfig::get('sf_upload_dir')."/Theme/".$theme->getScreenshot())):?>
																								<a onclick="openview('<?php echo $theme->getId(); ?>');" href="javascript:void(0);"><?php echo image_tag('../uploads/Theme/thumb/'.$theme->getScreenshot(),array('border'=>'1','alt'=>'Image','title'=>"Click To See Preview",'width'=>'200px','height'=>'200px'))?></a>
																							<?php else:?>
																								<a onclick="openview('<?php echo $theme->getId(); ?>');" href="javascript:void(0);"><?php echo image_tag("admin/noImage.jpeg", array('border'=>'1','alt'=>'Image','title'=>"Click To See Preview",'width'=>'200px','height'=>'200px'))?></a>
																							<?php endif;?>
																						<?php else: ?>
																							<a onclick="openview('<?php echo $theme->getId(); ?>');" href="javascript:void(0);"><?php echo image_tag("admin/noImage.jpeg", array('border'=>'1','alt'=>'Image','title'=>"Click To See Preview",'width'=>'200px','height'=>'200px'))?></a>
																						<?php endif; ?>
																						<div class="name"><?php echo $theme->getName() ?></div>
																						<div class="settheme">
																							<?php if($theme->getId() == $snThemeId): ?>
																										<span style="float:right;">
																											<?php echo link_to("Settings","themeOptions/edit"); ?>
																										</span>
																							<?php else: ?>
																									<label>Set Theme:</label> 
																										<input type="radio" id="radio<?php echo $theme->getId(); ?>" name="radio[]" value="<?php echo $theme->getId(); ?>"  onClick="SelectTheme();">
																										<span style="float:right;">
																											<a onclick="openDiffrence('<?php echo $theme->getId(); ?>');" href="javascript:void(0);" title="Click here to compare with current theme" >Compare</a>
																										</span>
																							<?php endif; ?>
																						</div>
																					</li>
																			

																			<?php  endforeach; ?>
																			</ul>
															</form>
															<?php } else { ?> 
																<ul><li >No items found.</li></ul>
															<?php } ?>
															
														</td>
													</tr>
													<tr align="right" valign="top">
														<td colspan="2" class="ListAreaPad">
														<?php
															if($orderBy) $varExtra .="&orderBy=$orderBy";
															if($orderType) $varExtra .="&orderType=$orderType";
														?>
														<?php //include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'theme/index', 'varExtra' => $varExtra));?>
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

<script type="text/javascript">


function openview(id) {
    $.fancybox.open({
        href : "<?php echo url_for('usertheme/view?id=')?>"+id,
        type : 'iframe',
        padding : 5
    });
}

	function openDiffrence(id) {
			
			$.fancybox.open({
				href : "<?php echo url_for('usertheme/themeDiffrence?id=')?>"+id,
				type : 'iframe',
				padding : 5
			});
	}

	function SelectTheme()
	{
		var id =$('input:radio:checked').attr('id');
		if(typeof id != 'undefined')
		{
			var ans = confirm("Are you sure you want to set this theme ?");
				if(ans)
				{
					radioform.submit();
					return true;
				}
				else
				{
					$("#"+id).removeAttr("checked");
					return false;
				}
		}
		else
		{
			alert("Please select Theme");
		}
	}
</script>



<?php /*

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
								<!-- <td width="57" class="LinkImg" ><a href="<?php //echo url_for('theme/new') ?>" title="Add New"><?php //echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
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
												<table cellspacing="0" cellpadding="0" align="center" width="100%">
													<!--<tr>
														<td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php //echo image_tag("admin/Icon_Groups.gif", array("alt"=>"Theme","title"=>"Theme","align"=>"middle"))?></td>
														<td width="90%" class="ContentBtmDotLn">
															<div style="float:left;" class="Title">Theme List</div>
															<div style="float:right;" class="padrht">
																<!--	<form action="<?php //echo url_for('theme/index') ?>" method="post">
																<span>Search:</span>&nbsp;&nbsp;
																<?php //echo tag('input', array('name' => 'search_text', 'type' => 'text', 'id' => 'search_text', 'size' => '25', 'value' => $sf_request->getParameter('search_text'))); ?>
																<?php //echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
																<a href="<?php //echo url_for('theme/index') ?>">Clear</a>
																</form> --
															</div>
														</td>
													</tr>-->
													<tr valign="top">
														<td colspan="2" class="dot"></td>
													</tr>
													<?php if($sf_user->hasFlash('errMsg')) { ?>
													<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">
																<tr>
																	<td class="dot2"></td>
																</tr>
																<tr>
																	<td class="errormss" align="center"><?php echo $sf_user->getFlash('errMsg');?>/td>
																</tr>
																<tr>
																	<td class="dot2"></td>
																</tr>
															</table>
														</td>
													</tr>
													<?php }?>
													<?php if($sf_user->hasFlash('succMsg')) { ?>
													<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">
																<tr>
																	<td class="dot2"></td>
																</tr>
																<tr>
																	<td class="success" align="center"><?php echo $sf_user->getFlash('succMsg');?></td>
																</tr>
																<tr>
																	<td class="dot2"></td>
																</tr>
															</table>
														</td>
													</tr>
													<?php }?>
													<?php
														$varExtra = '';
														if($sf_request->getParameter('search_text')) 
														$varExtra .="&search_text=".$sf_request->getParameter('search_text');
														//if($sortBy) $varExtra .="&sortBy=$sortBy";
													?>

													<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<table width="100%" cellspacing="1" cellpadding="1" class="brd1" border=0>
															<?php if(count($pager) > 0){?>  
															<form id="radioform" method="POST" action="<?php echo url_for('usertheme/updateTheme');?>" name="radioform" >
																<tr>
																	<!--Start this tr is for current theme with color green-->
																	<td align ="left"><table><tr><td><b>Current Theme:</b></td><td width="50%" style="background-color:#17e647"></td></tr></table></td>
																	<!--End this tr is for current theme with color green-->
																	<td colspan=3 align="right"><input type="button" class ="bluButton" value="Submit" OnClick="SelectTheme();"></td>
																</tr>
																<tr><?php $i=0;?>
																	<?php foreach ($pager as $theme):?>
																		<?php if( ($i%4) == 0 ):?>
																			</tr>
																			<tr>
																				<td colspan='5'>&nbsp;</td>
																			</tr>
																			<tr>
																		<?php endif; ?>
																				<td width="20%" height="20%">
																					<?php if($theme->getId() == $snThemeId): ?> 
																						<table border=0 align="center" width="20%" bgcolor="#17e647">
																					<?php else:?>
																						<table border=0 align="center" width="20%">
																					<?php endif; ?>
																							<tr>
																								<?php if($theme->getScreenshot() != "" ): ?>
																									<?php if(file_exists(sfConfig::get('sf_upload_dir')."/Theme/".$theme->getScreenshot())):?>
																										<td colspan=2><a rel="lightbox" href="<?php echo $ssSiteUrl; ?>/uploads/Theme/<?php echo $theme->getScreenshot();?>" ><?php echo image_tag('../uploads/Theme/thumb/'.$theme->getScreenshot(),array('border'=>'1','alt'=>'Image','title'=>"Click To See Preview",'width'=>'200px','height'=>'200px'))?></a></td>
																									<?php else:?>
																										<td colspan=2><?php echo image_tag("admin/noImage.jpeg", array('border'=>'1','alt'=>'Image','title'=>"No-Image",'width'=>'200px','height'=>'200px'))?></td>
																									<?php endif;?>
																								<?php else: ?>
																									<td colspan=2><?php echo image_tag("admin/noImage.jpeg", array('border'=>'1','alt'=>'Image','title'=>"No-Image",'width'=>'200px','height'=>'200px'))?></td>
																								<?php endif; ?>
																							</tr>
																							<tr>
																								<!--<td valign ="Top" width="40%" align="left">Name:</td>-->
																								<td height="30" width="60%" align="left" valign="top" colspan="2"><?php echo $theme->getName() ?></td>
																							</tr>
																							<tr>
																								<?php if($theme->getId() == $snThemeId): ?> 
																								<td>
																									<span style="float:right;">
																										<a href="<?php echo url_for('usertheme/view?id='.$theme->getId())?>" Title="View">View</a>&nbsp;&nbsp;&nbsp;&nbsp;
																										<?php echo link_to("Settings","themeOptions/edit"); ?>
																									</span>
																								</td>
																									<!--current theme-->
																									<!--<td width="40%" align="left">Select Theme:</td>-->
																									<!--<td width="60%" class="fldrowbgInline" align="left" valign="top"><input type="radio" id="radio<?php //echo $theme->getId(); ?>" name="radio[]" value="<?php //echo $theme->getId(); ?>" checked="checked" onClick="SelectTheme(<?php //echo $theme->getId(); ?>,<?php //echo $snThemeId; ?>)"></td>-->
																								<?php else:?>
																									<td valign ="middle" width="30%" align="left">Set Theme:</td>
																									<td width="70%" class="fldrowbgInline" align="left" valign="top"><input type="radio" id="radio<?php echo $theme->getId(); ?>" name="radio[]" value="<?php echo $theme->getId(); ?>" > 
																									
																									<span style="float:right;"><a href="<?php echo url_for('usertheme/view?id='.$theme->getId())?>" Title="View">View</a></span>
																									
																									</td>
																								<?php endif; ?>
																							</tr>
																							<tr>
																								<!--<td valign ="Top" width="40%" align="left">View:</td>-->
																								<!--<td colspan=2 width="60%" align="center"><a href="<?php //echo url_for('usertheme/view?id='.$theme->getId())?>" Title="View">View</a></td>-->
																							</tr>
																						</table>
																				</td>
																	<?php $i++; endforeach; ?>
																</tr>	
															</form>
															<?php } else { ?> 
																<tr class="fldbg"><td class="errormss">No theme found!</td></tr>
															<?php } ?>
															</table>
														</td>
													</tr>
													<tr align="right" valign="top">
														<td colspan="2" class="ListAreaPad">
														<?php
															if($orderBy) $varExtra .="&orderBy=$orderBy";
															if($orderType) $varExtra .="&orderType=$orderType";
														?>
														<?php //include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'theme/index', 'varExtra' => $varExtra));?>
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