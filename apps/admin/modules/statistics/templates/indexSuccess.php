<style>
#graph {
  width: 800px;
  height: 250px;
  margin: 20px auto 0 auto;
}
pre {
  height: 250px;
  overflow: auto;
}
</style>


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
						<?php include_partial('statistics/statisticsMenu');?>
						<!--END VERTICAL MENU-->
					</td>
					<td align="center" valign="top" class="CashDetails">
					<table width="96%" cellspacing="0" cellpadding="0">
						<tr>
							<td align="left" valign="top" height="25">&nbsp;</td>
						</tr>
						<tr>
							<td align="left" valign="top" class="WebsiteTab">
								<?php //include_partial('personalcms/horizontalMenu');?>
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" class="WebsiteDetails">
								<table width="100%" cellspacing="10" cellpadding="0">
									<tr>
										<td align="center" valign="top">
											<table width="98%" cellspacing="1" cellpadding="1" class="PageListHeading">
												<tr>
													<td align="left" valign="middle"><strong>Counsel Edge Statistics</strong></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td align="center">
											<!-- Start Buttons -->
											<input type="button" id="btn_1" Value="Default ( 1 Day )" onclick="BtnDate('1', 'DAY','btn_1')" title="Default" class="CommonButton"/> &nbsp;&nbsp;
											<input type="button" id="btn_2" Value="7 Days"  onclick="BtnDate('7', 'DAYS','btn_2')" title="7 Days"  class="unselectButton"/> &nbsp;&nbsp;
											<input type="button" id="btn_3" Value="1 Month" onclick="BtnDate('1', 'MONTH','btn_3')" title="1 Month" class="unselectButton"/> &nbsp;&nbsp;
											<input type="button" id="btn_4" Value="6 Months" onclick="BtnDate('6', 'MONTHS','btn_4')" title="6 Months" class="unselectButton"/> &nbsp;&nbsp;
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

<!-- Start Ajax call for Update Graph accrording to days -->
<script type="text/javascript">

function BtnDate(buttonDay,buttonDayType,btnid)
{

    $.ajax({
		    'type': 'POST',
		    'url': '<?php echo url_for("statistics/updateStatisticsGraph"); ?>',
		    'data': {BtnDay:buttonDay ,DayType:buttonDayType, webId:1},
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

<?php /*
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">
<!-- Bread Crumb Start -->
<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
  <td width="30%" class="drkgrylnk" align="center"><div class="Title">Counsel Edge Statistics</div></td>
  <td width="35%" align="right" class="AdminBreadCrumb">
   <table cellpadding="8" cellspacing="0" align="right">
    <tr align="center">
     <td width="57" class="LinkImg" ><!--<a href="<?php echo url_for('statistics/new') ?>" title="Add New"><?php echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
      Add </a>--></td>     
    </tr>
   </table>
  </td>
 </tr>
</table>

<!-- Bread Crumb End -->
</td></tr>
<tr><td width="100%" align="center" height="20"></td></tr>
<tr><td width="100%" align="center">
	<!-- Start Buttons -->
<input type="button" id="btn_1" Value="Default ( 1 Day )" onclick="BtnDate('1', 'DAY','btn_1')" title="Default" class="CommonButton"/> &nbsp;&nbsp;
<input type="button" id="btn_2" Value="7 Days"  onclick="BtnDate('7', 'DAYS','btn_2')" title="7 Days"  class="unselectButton"/> &nbsp;&nbsp;
<input type="button" id="btn_3" Value="1 Month" onclick="BtnDate('1', 'MONTH','btn_3')" title="1 Month" class="unselectButton"/> &nbsp;&nbsp;
<input type="button" id="btn_4" Value="6 Months" onclick="BtnDate('6', 'MONTHS','btn_4')" title="6 Months" class="unselectButton"/> &nbsp;&nbsp;
<!-- End Buttons -->
</td></tr>
<tr><td width="100%">
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
         <table cellspacing="0" cellpadding="0" align="center" class="ContentTable">
          <tr valign="top">
           <td colspan="2" class="dot"></td>
          </tr>
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad" id="ListAreaPad">
           <?php echo "1 DAY"; ?>
            <?php if( count($statisticsDetail) > 1):?>
           <!--Graph Section-->
           <div id="graph"></div>
           <pre id="code" class="prettyprint linenums" style="display:none;">
            var day_data = [
                     <?php if(count($statisticsDetail) > 1 ):?>  
                     <?php foreach($statisticsDetail as $statistics):?>
                        <?php if($statistics['WebsiteId'] == 1 ):?>
                     { year: '<?php echo $statistics['VisitDate']; ?>', Total_visit: '<?php echo $statistics["TotalVisit"]?>' },
                        <?php endif; ?>
                    <?php endforeach; ?>
                     <?php echo "No Visits" ; ?>
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
</td></tr>
</table>
*/ ?>