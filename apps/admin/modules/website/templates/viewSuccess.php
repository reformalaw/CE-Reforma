<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<?php /*?><tr>
		<td width="100%">
		<!-- Bread Crumb Start -->
			<table cellspacing="0" cellpadding="0" class="AdminNavBar">
				<tr>
					<!--<td width="66%" class="drkgrylnk padlft"><a href="<?php //echo url_for("default/index");?>" title="Home"> <?php //echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home")) ?></a></td>-->
					<td width="34%" align="right" class="AdminBreadCrumb">
						<table cellpadding="8" cellspacing="0" align="right">
							<tr align="center">

							</tr>
						</table>
					</td>
				</tr>
			</table>
		<!-- Bread Crumb End -->
		</td>
	</tr><?php */?>
	<tr>
		<td width="100%">
		<!-- Control Panel Start -->
			<table width="100%" cellspacing="2" cellpadding="0">
				<tr>
					<td width="95%" class="ContentPad">
						<table width="99%" align="center" cellpadding="0" cellspacing="0" class="MainTbl">
							<tr>
								<td class="MaintblPadding">
									<table width="100%" cellspacing="0" cellpadding="0">
										<tr>
											<td class="ContentPad">
												<table cellspacing="0" cellpadding="0" align="center">
													<tr>
														<!--<td width="90%" class="ContentBtmDotLn" height="30"><strong><?php //echo "View Customer FAQs" ?></strong></td>-->
													</tr>
													<tr valign="top">
														<td class="dot"></td>
													</tr>
													<?php include_partial('formView', array('form' => $form)) ?>
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