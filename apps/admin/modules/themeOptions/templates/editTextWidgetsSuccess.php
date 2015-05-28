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
						<?php include_partial('default/message'); ?>
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
													<td align="left" valign="middle"><strong>Theme Text Widgets </strong>
													<span style="float:right;" class="noteDisplay"><b>Note:</b> No. of Text Widgets may vary from theme to theme</span>
													</td>
														
												</tr>
											</table>
										</td>
									</tr>
									
									<tr style="display:none;">
									   <td><span class="noteDisplay" style="padding-left:11px;"><b>Note:</b> No. of Text Widgets may vary from theme to theme</span></td>
									
									</tr>
											<?php include_partial('formTextWidget', array('form' => $form,'featureListArr'=>$featureListArr,'editArr'=>$editArr)) ?>
										<tr>
                                            <td align="left" valign="top" height="10"></td>
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
<?php include_partial('default/ajaxCall'); // AUTO CALL AT EVERY 15 MINUTE  ?>