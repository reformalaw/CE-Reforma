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
													<td align="left" valign="middle"><strong>Contact Statistics</strong></td>
												</tr>
											</table>
											<table align="left">
												<tr>
													<td>
														<strong>Enter Customer Name:</strong>
														<input type="text" id="autoName" style="width:350px;">
														<input type="hidden" value="" id="hiddenCustomerId"> 
													</td>
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

$(function() {

    $( "#autoName" ).autocomplete({
        source: "<?php url_for('statistics/contactStatistics') ?>",
        minLength: 2,
        select: function(event, ui) {
			var selectedObj = ui.item;
			$("#autoName").val(selectedObj.value);
 			$('#hiddenCustomerId').val(selectedObj.id);
 			BtnDate('1', 'DAY','btn_1');
			return false;
		}
    });
});

function BtnDate(buttonDay,buttonDayType,btnid)
{
    $.ajax({
		    'type': 'POST',
		    'url': '<?php echo url_for("statistics/updateStatisticsGraph"); ?>',
		    'data': {BtnDay:buttonDay ,DayType:buttonDayType, customerId:$("#hiddenCustomerId").val(),flag:"contact"},
            'success': function (msg) {
                         $("#ListAreaPad" ).html(msg);

                         $('input').removeClass("CommonButton");
                         $('input').addClass("unselectButton");
                         $("#autoName").removeClass("unselectButton");
                         $("#"+btnid).removeClass("unselectButton").addClass("CommonButton");
                    } 
		});
}
</script>
<!-- End  -->