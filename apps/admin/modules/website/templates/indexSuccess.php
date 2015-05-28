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
        <td align="left" valign="top" class="CashDetails" ><table width="100%" cellspacing="10" cellpadding="0" >
          <tr>
            <td align="left" valign="top"><table width="100%" cellspacing="0" cellpadding="0">
              <tr class="WebsiteDetails">
                <td align="left" valign="top"><table width="100%" cellspacing="8" cellpadding="0">
                  <tr>
                    <td width="200" align="left" valign="middle"><strong><?php echo "Website URL"; ?> :</strong></td>
                    <td align="left" valign="middle"><a target="_blank" href="http://<?php echo $customerData->getWebsiteurl(); ?>"><?php echo $customerData->getWebsiteurl();?></a></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"><strong><?php echo "Created On"; ?> :</strong></td>
                    <td align="left" valign="middle"><?php echo date(sfConfig::get('app_dateformat') ,strtotime($customerData->getCreateDateTime()));?></td>
                  </tr>
                  <tr>
                    <td width="200" align="left" valign="middle"><strong><?php echo "Status"; ?> :</strong></td>
                    <td align="left" valign="middle"><?php echo $customerData->getStatus();?></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"><strong><?php echo "Current Theme"; ?> :</strong></td>
                    <td align="left" valign="middle"><?php echo $customerData->getUsersWebsiteTheme()->getName();?></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"><strong><?php echo "Contact Us Email"; ?> :</strong></td>
                    <td align="left" valign="middle"><?php echo $customerData->getUsersWebsiteUsers()->getEmail();?></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"><strong>Statistic :</strong></td>
                    <td align="left" valign="middle">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left" valign="middle">
								<table style="border: 3px solid #0D85C4; border-radius: 6px 6px 6px 6px;">
									<tr>
										<td align="center">
											<!-- Start Buttons -->
											<input type="button" id="btn_1" Value="Default ( 1 Day )" onclick="BtnDate('1', 'DAY','btn_1')" title="Default" class="CommonButton"/> &nbsp;&nbsp;
											<input type="button" id="btn_2" Value="7 Days"  onclick="BtnDate('7', 'DAYS','btn_2')" title="7 Days"  class="unselectButton"/> &nbsp;&nbsp;
											<input type="button" id="btn_3" Value="1 Month" onclick="BtnDate('1', 'MONTH','btn_3')" title="1 Month" class="unselectButton"/> &nbsp;&nbsp;
											<input type="button" id="btn_4" Value="6 Months" onclick="BtnDate('6', 'MONTHS','btn_4')" title="6 Months" class="unselectButton"/> &nbsp;&nbsp;
											<input type="hidden" value="<?php echo $webId; ?>" id="hiddenWebId">
											<!-- End Buttons -->
										</td>
									</tr>
									<tr>
										
										<td align="center" valign="top" width="98%" id="ListAreaPad" class="ListAreaPad">
											<?php echo "1 DAY"; ?>
												<?php if( count($statisticsDetail) >= 1):?>
											<!--Graph Section-->
											<div id="graph"></div>
											<pre id="code" class="prettyprint linenums" style="display:none;">
												var day_data = [
														<?php if(count($statisticsDetail) >= 1 ):?>  
														<?php foreach($statisticsDetail as $statistics):?>
														{ year: '<?php echo $statistics['VisitDate']; ?>', Total_visit: '<?php echo $statistics["TotalVisit"]?>' },
														<?php endforeach; ?>
														<?php //echo "No Visits" ; ?>
														<?php endif; ?>
												];
												Morris.Line({
														element: 'graph',
														data: day_data,
														xkey: 'year',
														ykeys: ['Total_visit'],
														labels: ['Total Visits'],
												});
												</pre>
											<!--Graph Section End-->
												<?php else:
													echo "<br/> <br/> <b>". sfConfig::get('app_Statistics_no_visit')."</b>";
												endif;
												?>
										</td>
									</tr>
								</table>
						<?php //echo image_tag("admin/noImage.jpeg",array('border'=>'0','alt'=>'Image','title'=>"",'width'=>'500px','height'=>'150px'))?>
					</td>
                    </tr>
                </table></td>
                <td align="right" valign="top">
                	<table width="100%" cellspacing="8" cellpadding="0">
  <tr>
    <td align="left" valign="top"><strong><?php echo "Theme Preview"; ?></strong></td>
  </tr>
  <tr>
    <td align="left" valign="top"><?php if($customerData->getUsersWebsiteTheme()->getScreenshot() != ''): ?>
								<?php if(file_exists(sfConfig::get('sf_upload_dir')."/Theme/".$customerData->getUsersWebsiteTheme()->getScreenshot())):?>
								<a rel="lightbox" href="<?php echo $ssSiteUrl; ?>/uploads/Theme/<?php echo $customerData->getUsersWebsiteTheme()->getScreenshot();?>" ><?php echo image_tag("../uploads/Theme/".$customerData->getUsersWebsiteTheme()->getScreenshot(),array('border'=>'0','alt'=>'Image','title'=>$customerData->getUsersWebsiteTheme()->getScreenshot(),'width'=>'500px','height'=>'300px'))?></a>
										<?php //echo image_tag("../uploads/Theme/".$customerData->getUsersWebsiteTheme()->getScreenshot(),array('border'=>'0','alt'=>'Image','title'=>$customerData->getUsersWebsiteTheme()->getScreenshot(),'width'=>'500px','height'=>'300px'))?>
								<?php else:?>
										<?php echo image_tag("admin/noImage.jpeg",array('border'=>'0','alt'=>'Image','title'=>"",'width'=>'500px','height'=>'300px'))?>
								<?php endif ?>
						<?php else:?>
								<?php echo image_tag("admin/noImage.jpeg",array('border'=>'0','alt'=>'Image','title'=>"",'width'=>'500px','height'=>'300px'))?>
						<?php endif; ?></td>
  </tr>
</table>

						              </td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
</table>

<!-- Start Ajax call for Update Graph accrording to days -->
<script type="text/javascript">

function BtnDate(buttonDay,buttonDayType,btnid)
{

    $.ajax({
		    'type': 'POST',
		    'url': '<?php echo url_for("website/updateWebsiteStatisticsGraph?customerId=".$customerId); ?>',
		    'data': {BtnDay:buttonDay ,DayType:buttonDayType, webId:$("#hiddenWebId").val()},
            'success': function (msg) {
                         $("#ListAreaPad" ).html(msg);

                         $('input').removeClass("CommonButton");
                         $('input').addClass("unselectButton");
                         $("#"+btnid).removeClass("unselectButton").addClass("CommonButton");
                    } 
		});
}
</script>
<!-- End  -->