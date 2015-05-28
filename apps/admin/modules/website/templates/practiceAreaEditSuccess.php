<table width="98%" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">
		<!--START TOP USER DETAIL-->
		<?php  include_component('website', 'usersDetail');?>
		<!--END TOP USER DETAIL-->
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="150" align="left" valign="top" class="LeftMenu">
			<!--START VERTICAL MENU-->
			<?php include_partial("websiteMenu"); ?>
			<!--END VERTICAL MENU-->
        </td>
        <td align="center" valign="top" class="CashDetails">
        	<table width="96%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" height="25">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="WebsiteTab"><table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" class="BorderBottom">&nbsp;</td>
        <td width="110" align="center" valign="middle" class="DeSelectTab"><?php echo link_to("Practice Area List", "website/practiceAreaList?customerId=".$customerId)?><!--<a href="#">Practise Area List</a>--></td>
        <td width="2" align="center" valign="middle" class="BorderBottom"></td>
        <td width="110" align="center" valign="middle" class="SelectTab">Edit Practice Area</td>
        <td class="BorderBottom">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top" class="WebsiteDetails">
    	<table width="100%" cellspacing="10" cellpadding="0">
           <tr>
                <td align="center" valign="top">
                	<table width="98%" cellspacing="1" cellpadding="1" class="PageListHeading">
                      <tr>
                        <td align="left" valign="middle"><strong>Website Practice Area Detail</strong></td>
                      </tr>
                  </table>
                </td>
           </tr> 
           <tr>
                <td align="center" valign="top">
                	<table width="98%" cellspacing="1" cellpadding="1">
                      <tr>
                        <td align="right" valign="middle"><?php include_partial('practiceAreaform', array('form' => $form , 'websitedetail' => $websitedetail, 'displaySlugValue'=> $displaySlugValue, 'customerId'=>$customerId)) ;?></td>
                      </tr>
                  </table>
                </td>
           </tr> 
			<tr>
                <td align="left" valign="top" height="5"></td>
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
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
</table>





<?php /*?><table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="100%">
		<!-- Bread Crumb Start -->
			<table cellspacing="0" cellpadding="0" class="AdminNavBar">
				<tr>
					<td width="66%" class="drkgrylnk padlft"><a href="<?php //echo url_for("default/index");?>" title="Home"> <?php //echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home")) ?></a></td>
					<td width="34%" align="right" class="AdminBreadCrumb">
						<table cellpadding="8" cellspacing="0" align="right">
							<tr align="center">
								<!--<td width="57" class="LinkImg" ><a href="#" title="Edit"><?php image_tag("admin/Icon_Save.gif", array("alt"=>"Save","title"=>"Save","border"=>"0")) ?><br />
								Save </a></td>-->
								<td width="57" class="LinkImg" ><a href="<?php echo url_for('website/practiceAreaList?customerId='.$customerId) ?>"><?php echo image_tag("admin/Icon_Cancel.gif", array("alt"=>"Cancel","title"=>"Cancel","border"=>"0")) ?><br />
								Cancel </a></td>
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
					<td width="95%" class="ContentPad">
						<table width="99%" align="center" cellpadding="0" cellspacing="0" class="MainTbl">
							<tr>
								<td class="MaintblPadding">
									<table width="100%" cellspacing="0" cellpadding="0">
										<tr>
											<td class="ContentPad">
												<table cellspacing="0" cellpadding="0" align="center" class="ContentTable">
													<tr>
														<td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php //echo image_tag("admin/Icon_Groups.gif",array("alt"=>"Groups","title"=>"Groups","align"=>"middle")) ?><span class="Title"> </span></td>
														<td width="90%" class="ContentBtmDotLn">
															<div style="float:left;" class="Title">Edit Practice Area </div>
														</td>
													</tr>
													<tr valign="top">
														<td colspan="2" class="dot"></td>
													</tr>
													<?php include_partial('practiceAreaform', array('form' => $form , 'websitedetail' => $websitedetail, 'displaySlugValue'=> $displaySlugValue, 'customerId'=>$customerId)) ;?>
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
</table><?php */?>