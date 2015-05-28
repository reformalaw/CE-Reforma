<?php include_partial('case/header');?>

<table width="98%" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td align="left" valign="top">&nbsp;</td>
	</tr>
	<tr>
		<td align="left" valign="top">
			<table width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<!--<td width="150" align="left" valign="top" class="LeftMenu">
						<?php //include_partial('personalcms/customerMenu');?>
					</td>-->
					<td align="center" valign="top" class="CashDetails">
					<table width="96%" cellspacing="0" cellpadding="0">
						<tr>
							<td align="left" valign="top" height="25">&nbsp;</td>
						</tr>
						<tr>
							<td align="left" valign="top" class="WebsiteTab">
								<?php include_partial('case/globalReportMenu');?>
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" class="WebsiteDetails">
								<table width="100%" cellspacing="10" cellpadding="0">
									<tr>
										<td align="center" valign="top">
											<table width="98%" cellspacing="1" cellpadding="1" class="PageListHeading">
												<tr>
													<td align="left" valign="middle"><strong>Finance Report</strong></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td class="ContentPad">
										<table cellspacing="0" cellpadding="0" align="center" width="100%">
										<!-- Sumary Form -->
										<tr>
											<td align="center" valign="top" class="CasesListSearch" colspan="2">
											<table width="100%" cellspacing="10" cellpadding="0">
											<tr>
												<td width="220" align="center" valign="top"><b>Total Cases</b></td>
												<td width="220" align="center" valign="top"><b>Total Amount Paid</b></td>
												<td width="220" align="center" valign="top"><b>Total Payments Disbursed</b></td>
												<td width="220" align="center" valign="top"><b>Total UnderPay Adjustment</b></td>
												
											</tr>
											<tr>
												<td align="center" valign="top"><?php echo $summary['totalcases'] ; ?></td>
												<td align="center" valign="top">$<?php echo round($summary['totalamountpaid'],2) ; ?></td>
												<td align="center" valign="top">$<?php echo round($summary['totalamountreceived'],2) ; ?></td>
												<td align="center" valign="top">$<?php echo round($summary['totalunderpayamount'],2) ; ?></td>
											</tr>
											<tr>
												<td height="1" colspan="5" align="left" valign="top"></td>
											</tr>
											</table>
											</td>
										</tr>
										<tr>
											<td height="20" align="left" valign="top">&nbsp;</td>
										</tr>
										<!-- Summary Complete-->
										<!-- Search Form -->
										<tr>
											<td align="center" valign="top" class="CasesListSearch" colspan="2">
											<form action="<?php echo url_for('globalreport/finance') ?>" method="post" onsubmit="return validateFinance();">
											<table width="100%" cellspacing="10" cellpadding="0">
											<tr>
												<td width="220" align="left" valign="top"><?php echo $searchForm['UserId']->renderLabel(); ?></td>
												<td width="220" align="left" valign="top"><?php echo $searchForm['FromDate']->renderLabel(); ?></td>
												<td align="left" valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><?php echo $searchForm['UserId']->render(); ?></td>
												<td align="left" valign="top"><?php echo $searchForm['FromDate']->render(); 
																		echo "&nbsp;To&nbsp;";
																		echo $searchForm['ToDate']->render(); ?>
																		<label class="error" id="dateError"></label></td>
												<td align="left" valign="top"><span class="bluButton"> 
																		<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'bluButton', 'value' => 'Search')); ?> </span> <span class="grayButton">
																		<?php echo tag('input', array('name' => 'clear', 'type' => 'reset', 'id' => 'clear', 'class' => 'grayButton', 'value' => 'Clear', "onclick"=>'window.location="'.url_for('globalreport/finance').'"')); ?> </span> </td>
											</tr>
											<tr>
												<td height="1" colspan="5" align="left" valign="top"></td>
											</tr>
											</table>
											</form>
											</td>
										</tr>
										<tr>
											<td height="20" align="left" valign="top">&nbsp;</td>
										</tr>
										<!-- Search Form Complete-->

										
										<tr valign="top">
										<td colspan="2" class="dot"></td>
										</tr>
										<tr align="center" valign="top">
										<td colspan="2" class="ListAreaPad">
											<table width="100%" cellspacing="1" cellpadding="1" class="brd1">
											
											<?php if($pager->getnbResults() > 0){?>
											<tr class="fldbg">
												<td align="center" width="30%"><b>Customer Name</b></td>
												<td align="center" width="20%"><b>Total Amount Paid</b></td> 
												<td align="center" width="20%"><b>Total Payments Disbursed</b></td>                           
												
												<td align="center" width="20%"><b>Total UnderPay Adjustment</b></td>
												<td align="center" width="10%"><b>Total Cases</b></td>
												<!--<td align="center" width="12%"><b>Total Paid Cases</b></td>
												<td align="center" width="11%"><b>Total Unpaid Cases</b></td>
												<td align="center" width="15%"><b>Total Pending Payment (3rd party) cases </b></td>-->
											</tr>              
											<?php $i=1; ?>
											<?php foreach ($pager->getResults() as $cases):?>
											<?php #clsCommon::pr($cases);?>
											<?php $class=($i++ %2)==0?"fldrowbgAlt":"fldrowbg";?>
											<tr class="<?php echo $class;?>">
												<td class="fldrowbg" align="left" valign="top"><?php echo link_to($cases->getFirstname().' '.$cases->getLastname(),"dashboard/index?customerId=".$cases->getId()) ;?></td>
												<td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($cases->getPadamount(),2) ?></td>
												<td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($cases->getRecdamount(),2) ?></td>
												<td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($cases->getUnderpayadjustment(),2) ?></td>
												<td class="fldrowbg" align="right" valign="top"><?php echo $cases->getTotalcases() ?></td>
												<!--<td class="fldrowbg" align="left" valign="top"><?php #echo $cases->getTotalpaidcases() ?></td>
												<td class="fldrowbg" align="left" valign="top"><?php #echo $cases->getTotalunpaidcases() ?></td>
												<td class="fldrowbg" align="left" valign="top"><?php #echo $cases->getTotalpendingcases() ?></td>-->
																					
																					
											</tr>
											<?php endforeach; ?>    
											<?php } else { ?> 
												<tr class="fldbg"><td class="errormss">No items found.</td></tr>
											<?php } ?>         
											</table>
										</td>
										</tr>
										<tr>
											<td height="20" align="left" valign="top">&nbsp;</td>
										</tr>
										<tr align="center" valign="top">
										<td colspan="2" class="ListAreaPad">                     
											<?php    
											$varExtra = '';
											if(isset($defaultArr['UserId']) && !empty($defaultArr['UserId'])) {
												$varExtra .="&UserId=".$defaultArr['UserId'];
											}


											if(isset($defaultArr['FromDate']) && !empty($defaultArr['FromDate'])) {
												$varExtra .="&FromDate=".base64_encode($defaultArr['FromDate']);
											}

											if(isset($defaultArr['ToDate']) && !empty($defaultArr['ToDate'])) {
												$varExtra .="&ToDate=".base64_encode($defaultArr['ToDate']);
											}

											?>
											<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'globalreport/finance', 'varExtra' => $varExtra));?>
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






<?php /*   // start comment by jaydip dodiya
<?php include_partial('case/globalReportMenu');?>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">
<!-- Bread Crumb Start -->
// end comment by jaydip dodiya */ ?>
<?php /*
<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
  <td width="30%" class="drkgrylnk" align="center"><div class="Title">Finance Report </div></td>
  <td width="35%" align="right" class="AdminBreadCrumb">
   <table cellpadding="8" cellspacing="0" align="right">
    <tr align="center">
     <td width="57" class="LinkImg" ><a href="<?php echo url_for('default/index') ?>" title="Home"><?php echo image_tag("admin/Icon_Cancel.gif" , array("alt"=>"Cancel","border"=>"0","title"=>"Cancel"))?><br/>
      Cancel </a></td>     
    </tr>
   </table>
  </td>
 </tr>
</table>
*/ ?>
<!-- Bread Crumb End -->
<?php /*  // start comment by jaydip dodiya
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
         <table cellspacing="0" cellpadding="0" align="center" width="100%">
          <!-- Sumary Form -->
          <tr>
            <td align="center" valign="top" class="CasesListSearch" colspan="2">
    	       <table width="100%" cellspacing="10" cellpadding="0">
               <tr>
                <td width="220" align="center" valign="top"><b>Total Cases</b></td>
                <td width="220" align="center" valign="top"><b>Total Amount Paid</b></td>
                <td width="220" align="center" valign="top"><b>Total Amount Received</b></td>
                <td width="220" align="center" valign="top"><b>Total Underpay Adjustment</b></td>
                
               </tr>
               <tr>
                <td align="center" valign="top"><?php echo $summary['totalcases'] ; ?></td>
                <td align="center" valign="top">$<?php echo $summary['totalamountpaid'] ; ?></td>
                <td align="center" valign="top">$<?php echo $summary['totalamountreceived'] ; ?></td>
                <td align="center" valign="top">$<?php echo $summary['totalunderpayamount'] ; ?></td>
               </tr>
               <tr>
                <td height="1" colspan="5" align="left" valign="top"></td>
               </tr>
               </table>
            </td>
        </tr>
        <tr>
            <td height="20" align="left" valign="top">&nbsp;</td>
        </tr>
        <!-- Summary Complete-->
        <!-- Search Form -->
          <tr>
            <td align="center" valign="top" class="CasesListSearch" colspan="2">
            <form action="<?php echo url_for('globalreport/finance') ?>" method="post" onsubmit="return validateFinance();">
    	       <table width="100%" cellspacing="10" cellpadding="0">
               <tr>
                <td width="220" align="left" valign="top"><?php echo $searchForm['UserId']->renderLabel(); ?></td>
                <td width="220" align="left" valign="top"><?php echo $searchForm['FromDate']->renderLabel(); ?></td>
                <td align="left" valign="top">&nbsp;</td>
               </tr>
               <tr>
                <td align="left" valign="top"><?php echo $searchForm['UserId']->render(); ?></td>
                <td align="left" valign="top"><?php echo $searchForm['FromDate']->render(); 
                                        echo "&nbsp;To&nbsp;";
										echo $searchForm['ToDate']->render(); ?>
                                        <label class="error" id="dateError"></label></td>
                <td align="left" valign="top"><span class="bluButton"> 
                                        <?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'bluButton', 'value' => 'Search')); ?> </span> <span class="grayButton">
                                        <?php echo tag('input', array('name' => 'clear', 'type' => 'reset', 'id' => 'clear', 'class' => 'grayButton', 'value' => 'Clear', "onclick"=>'window.location="'.url_for('globalreport/finance').'"')); ?> </span> </td>
               </tr>
               <tr>
                <td height="1" colspan="5" align="left" valign="top"></td>
               </tr>
               </table>
            </form>
            </td>
        </tr>
        <tr>
            <td height="20" align="left" valign="top">&nbsp;</td>
        </tr>
        <!-- Search Form Complete-->

          
          <tr valign="top">
           <td colspan="2" class="dot"></td>
          </tr>
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">
            <table width="100%" cellspacing="1" cellpadding="1" class="brd1">
            
            <?php if($pager->getnbResults() > 0){?>
             <tr class="fldbg">
                <td align="center" width="30%"><b>Customer Name</b></td>
                <td align="center" width="20%"><b>Total Amount Paid</b></td> 
                <td align="center" width="20%"><b>Total Amount Received</b></td>                           
                
                <td align="center" width="20%"><b>Total Underpay Adjustment</b></td>
                <td align="center" width="10%"><b>Total Cases</b></td>
                <!--<td align="center" width="12%"><b>Total Paid Cases</b></td>
                <td align="center" width="11%"><b>Total Unpaid Cases</b></td>
                <td align="center" width="15%"><b>Total Pending Payment (3rd party) cases </b></td>-->
             </tr>              
             <?php $i=1; ?>
             <?php foreach ($pager->getResults() as $cases):?>
             <?php #clsCommon::pr($cases);?>
             <?php $class=($i++ %2)==0?"fldrowbgAlt":"fldrowbg";?>
             <tr class="<?php echo $class;?>">
                <td class="fldrowbg" align="left" valign="top"><?php echo link_to($cases->getFirstname().' '.$cases->getLastname(),"dashboard/index?customerId=".$cases->getUserid()) ;?></td>
                <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').$cases->getPadamount() ?></td>
                <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').$cases->getRecdamount() ?></td>
                <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').$cases->getUnderpayadjustment() ?></td>
                <td class="fldrowbg" align="right" valign="top"><?php echo $cases->getTotalcases() ?></td>
                <!--<td class="fldrowbg" align="left" valign="top"><?php #echo $cases->getTotalpaidcases() ?></td>
                <td class="fldrowbg" align="left" valign="top"><?php #echo $cases->getTotalunpaidcases() ?></td>
                <td class="fldrowbg" align="left" valign="top"><?php #echo $cases->getTotalpendingcases() ?></td>-->
                                                    
                                                    
             </tr>
             <?php endforeach; ?>    
             <?php } else { ?> 
                <tr class="fldbg"><td class="errormss">No Finance Summary Found!!</td></tr>
             <?php } ?>         
            </table>
           </td>
          </tr>
          <tr>
            <td height="20" align="left" valign="top">&nbsp;</td>
          </tr>
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">                     
              <?php    
              $varExtra = '';
              if(isset($defaultArr['UserId']) && !empty($defaultArr['UserId'])) {
                $varExtra .="&UserId=".$defaultArr['UserId'];
              }


              if(isset($defaultArr['FromDate']) && !empty($defaultArr['FromDate'])) {
                  $varExtra .="&FromDate=".base64_encode($defaultArr['FromDate']);
              }

              if(isset($defaultArr['ToDate']) && !empty($defaultArr['ToDate'])) {
                  $varExtra .="&ToDate=".base64_encode($defaultArr['ToDate']);
              }

              ?>
               <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'globalreport/finance', 'varExtra' => $varExtra));?>
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
//end comment by jaydip dodiya */ ?>