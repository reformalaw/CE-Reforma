<form action="<?php echo url_for('faq/globalfaqs') ?>" method="post" name="websiteListingForm">
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
													<td align="left" valign="middle"><strong>Global FAQ List </strong></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td align="center" valign="top">
											<table cellspacing="0" cellpadding="0" align="center" width="98%">		
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
                                                    <tr><td height="10"></td></tr>
													<tr align="center" valign="top">
														<td colspan="3" class="ListAreaPad">
															<table width="100%" cellspacing="1" cellpadding="1" class="brd1">
															<?php if($pager->getnbResults() > 0){?> 
																<section class="middle">
																	<div class="page">
																		<div class="middle-bg-full">
																			<div class="middle-part-rightside">

																				<tr class="fldbg">
																					<td align="center"><input type = checkbox id="ChkHeader" onClick="checkUncheck();" name="chkHeader" ></td>
																					<td class="border-right"><span style="float:left"><strong>Question</strong></span>&nbsp;&nbsp;<span style="float:right" class="noteDisplay"><strong>Note: </strong>Click on question to view answer</span></td>
																				</tr>
																			<?php $i=1; ?>
																			<?php foreach ($pager->getResults() as $fa_qs) {?>
																			<?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
																				<tr class="<?php echo $class;?>">
																					<?php if ($fa_qs->getQuestion() != "" || $fa_qs->getAnswer() != ""){ ?>
																					<td width="10%" class="fldrowbg" align="center" valign="top"><input class = "case" value="<?php echo $fa_qs->getId(); ?>" type = checkbox name="websiteId[]" id="addInWebsite<?php echo $fa_qs->getId(); ?>" ></td>
																					<td valign="top">
																						<h4 class="twisty"><a class="twisty-expand" href="javascript:void(0)" title="Click here to view answer">
																							<?php echo $fa_qs->getQuestion(); ?>
																							</a>				
																							<div class="answer" style="display:none;">
																								<p><?php echo $fa_qs->getAnswer(); ?></p>
																							</div>
																						</h4>
																					</td>
																			<?php } ?>
																				</tr>
																			<?php } ?>
																			</div>
																		</div>
																	</div>
																</section>
																<?php } else { ?> 
																<tr class="fldbg"><td class="errormss">No items found.</td></tr>
															<?php } ?>
															</table>
															<tr>
															     <td colspan="3">&nbsp;</td>
															</tr>
															<tr>
																<?php if($pager->getnbResults() > 0): ?>
																<td width="13%" >
																	<input type="button" class="CommonButton" value="Add To Website FAQ" onClick="conformAdd();">
																</td>
																<?php endif; ?>
																<td></td>
																<td></td>

															</tr>
															<tr>
															<?php if($pager->getnbResults() > 0): ?>
																<td width="100%" style="padding-top:10px;" >																	
																	<span class="noteDisplay"> <strong>Note: </strong>Select checkbox from above list and click on above button to add in your Website FAQ </span>
																</td>
															<?php endif; ?>
																<td></td>
																<td></td>

															</tr>
															
														</td>
													</tr>
													
													<tr align="right" valign="top">
														<td colspan="2" class="ListAreaPad">
															<?php
																if($orderBy) $varExtra .="&orderBy=$orderBy";
																if($orderType) $varExtra .="&orderType=$orderType";
															?>
															<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'faq/personalWebsiteList', 'varExtra' => $varExtra));?>
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
</form>














<!--<form action="<?php //echo url_for('faq/globalfaqs') ?>" method="post" name="websiteListingForm">
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="100%">-->
		<!-- Bread Crumb Start -->
			<!--<table cellspacing="0" cellpadding="0" class="AdminNavBar">
				<tr>
					<td width="35%" class="drkgrylnk padlft"><a href='<?php //echo url_for("default/index");?>' title="Home"> <?php //echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
					<td width="30%" class="drkgrylnk" align="center"><div class="Title">Global Faq List</div></td>
					<td width="35%" align="right" class="AdminBreadCrumb">
					</td>
				</tr>
			</table>-->
		<!-- Bread Crumb End -->
		<!--</td>
	</tr>
	<tr>
		<td width="100%">-->
		<!-- Control Panel Start -->
			<!--<table width="100%" cellspacing="2" cellpadding="0">
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
												<table cellspacing="0" cellpadding="0" align="center" width="100%">-->
													<!--<tr>
														<td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php //echo image_tag("admin/Icon_Groups.gif", array("alt"=>"Fa qs","title"=>"Fa qs","align"=>"middle"))?></td>
														<td width="90%" class="ContentBtmDotLn">
															<div style="float:left;" class="Title">Global Faq List</div>
															<div style="float:right;" class="padrht">

															</div>
														</td>
													</tr>-->
													<!--<tr valign="top">
														<td colspan="2" class="dot"></td>
													</tr>-->
													<?php //if($sf_user->hasFlash('errMsg')) { ?>
													<!--<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">
																<tr>
																	<td class="dot2"></td>
																</tr>
																<tr>
																	<td class="errormss" align="center"><?php //echo $sf_user->getFlash('errMsg');?>/td>
																</tr>
																<tr>
																	<td class="dot2"></td>
																</tr>
															</table>
														</td>
													</tr>-->
													<?php //}?>
													<?php
// 														$varExtra = '';
// 														if($sf_request->getParameter('search_text')) 
// 															$varExtra .="&search_text=".$sf_request->getParameter('search_text');
													?>
													<!--<tr align="center" valign="top">
														<td colspan="3" class="ListAreaPad">
															<table width="100%" cellspacing="1" cellpadding="1" class="brd1">-->
															<?php //if($pager->getnbResults() > 0){?> 
																<!--<section class="middle">
																	<div class="page">
																		<div class="middle-bg-full">
																			<div class="middle-part-rightside">

																				<tr class="fldbg">
																					<td align="center"><input type = checkbox id="ChkHeader" onClick="checkUncheck();" name="chkHeader" ></td>
																					<td class="border-right border-left border-top"><span style="float:left"><strong>Question</strong></span>&nbsp;&nbsp;<span style="float:right"><strong>Note: </strong>Click on question to view answer</span></td>
																				</tr>-->
																			<?php //$i=1; ?>
																			<?php //foreach ($pager->getResults() as $fa_qs) {?>
																			<?php //$class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
																				<!--<tr class="<?php //echo $class;?>">-->
																					<?php //if ($fa_qs->getQuestion() != "" || $fa_qs->getAnswer() != ""){ ?>
																					<!--<td width="10%" class="fldrowbg" align="center" valign="top"><input class = "case" value="<?php //echo $fa_qs->getId(); ?>" type = checkbox name="websiteId[]" id="addInWebsite<?php //echo $fa_qs->getId(); ?>" ></td>
																					<td valign="top">
																						<h4 class="twisty"><a class="twisty-expand" href="javascript:void(0)" title="Click here to view answer">
																							<?php //echo $fa_qs->getQuestion(); ?>
																							</a>				
																							<div class="answer" style="display:none;">-->
																								<p><?php //echo $fa_qs->getAnswer(); ?></p>
																							<!--</div>
																						</h4>
																					</td>-->
																			<?php //} ?>
																				<!--</tr>-->
																			<?php // } ?>
																			<!--</div>
																		</div>
																	</div>
																</section>-->
																<?php // } else { ?> 
																<!--<tr class="fldbg"><td class="errormss">No Global Faqs Record found!</td></tr>-->
															<?php //} ?>
															<!--</table>
															<tr>
															     <td colspan="3">&nbsp;</td>
															</tr>
															<tr>
																<td width="13%" >
																	<input type="button" class="CommonButton" value="Add To WebsiteList" onClick="conformAdd();">
																</td>
																<td></td>
																<td></td>
															</tr>
														</td>
													</tr>
													<tr align="right" valign="top">
														<td colspan="2" class="ListAreaPad">-->
															<?php
// 																if($orderBy) $varExtra .="&orderBy=$orderBy";
// 																if($orderType) $varExtra .="&orderType=$orderType";
															?>
															<?php //include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'faq/personalWebsiteList', 'varExtra' => $varExtra));?>
														<!--</td>
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
			</table>-->
			<!-- Control Panel End -->
		<!--</td>
	</tr>
</table>
</form>-->

<script type="text/javascript">

	function checkUncheck()
	{
		if(document.getElementById("ChkHeader").checked == true)
		{
			var inputs = document.getElementsByTagName("input");
			for(var i = 0; i < inputs.length; i++)
				if(inputs[i].type == "checkbox")
				inputs[i].checked = true;
		}
		else
		{
			var inputs = document.getElementsByTagName("input");
			for(var i = 0; i < inputs.length; i++)
				if(inputs[i].type == "checkbox")
				inputs[i].checked = false;
		}

	}

	function SelectOrNot()
	{
		var inputs = document.getElementsByTagName("input");
			for(var i = 0; i < inputs.length; i++)
				if(inputs[i].type == "checkbox")
				if(inputs[i].checked == true)
					return true;
	}

	function conformAdd()
	{
		var flag = SelectOrNot();
		if(flag)
			document.websiteListingForm.submit();
		else
			alert("Please Select One Checkbox");
	}

	$(function(){
		$(".case").click(function(){
		
				if($(".case").length == $(".case:checked").length) {
					$("#ChkHeader").attr("checked", "checked");
				} else {
					$("#ChkHeader").removeAttr("checked");
				}
		
			});
	});


	jQuery().ready(function() {

		jQuery(".twisty-expand").click(function(){
			jQuery(this).toggleClass('twisty-expand');
			jQuery(this).toggleClass('twisty-collapse');
			if(jQuery(this).hasClass('twisty-expand')){
				jQuery(this ).parents().children(".answer").slideUp('slow');
			}else{
				jQuery(this ).parents().children(".answer").slideDown('slow');
			}

		})
	});

</script>