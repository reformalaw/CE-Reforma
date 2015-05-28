<?php include_partial('customercase/header');?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">
<!-- Bread Crumb Start -->
<?php /*
<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
  <td width="30%" class="drkgrylnk" align="center"><div class="Title">Payment Report</div></td>
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
          <!-- Search Form -->
          <tr style="display:none;">
            <td align="left" valign="top" colspan="2">&nbsp;</td>
		  </tr>
		  <tr style="display:none;">
		  <td align="center" valign="top" class="CasesListSearch" colspan="2">
		  <form action="<?php echo url_for('administrators/index') ?>" method="post">
			<table width="100%" cellspacing="10" cellpadding="0">
			<tr>
			 <td width="220" align="center" valign="top">Total Accepted Cases</td>
			 <td width="220" align="center" valign="top"><b>Total Actual Amount</b></td>
			 <td width="220" align="center" valign="top"><b>Total Receivable Amount</b></td>
			 <td width="220" align="center" valign="top"><b>Total Received Amount</b></td>
			 <td width="220" align="center" valign="top"><b>Total UnderPay Adjustment</b></td>
			</tr>
			<tr>
			 <td align="center" valign="top"><?php echo $totalAcceptedCasesCount;  ?></td>
			 <td align="center" valign="top"><?php echo sfConfig::get('app_currency').round($totalCasesAmount['actualamount'],2);  ?></td>
			 <td align="center" valign="top"><?php echo sfConfig::get('app_currency').round($totalCasesAmount['payableamount'],2);  ?></td>
			 <td align="center" valign="top"><?php echo sfConfig::get('app_currency').round($totalCasesAmount['paidamount'],2);  ?></td>
			 <td align="center" valign="top"><?php echo sfConfig::get('app_currency').round($totalCasesAmount['underpayamount'],2);  ?></td>
			</tr>
			<tr>
			 <td height="1" colspan="5" align="left" valign="top"></td>
			</tr>
			</table>
		  </form>
		  </td>
		</tr>
        <tr>
            <td>&nbsp;</td>
        </tr>   

        
        <tr>
			<td align="center" valign="top" class="CasesListSearch" colspan="2">
			<form action="<?php echo url_for('customerreport/paymentReport') ?>" method="post" onsubmit="return validatePaymentReport();">
			 <table width="100%" cellspacing="10" cellpadding="0">
			 <tr>
                <td width="220" align="left" valign="top"><?php echo $searchForm['CaseNo']->renderLabel(); ?></td>
			 	<td width="220" align="left" valign="top"><?php echo $searchForm['StartAmount']->renderLabel(); ?></td>
			 	<td width="220" align="left" valign="top"><?php echo $searchForm['FromDate']->renderLabel(); ?></td>
				<td align="left" valign="top">&nbsp;</td>
			</tr>
			<tr>
                <td align="left" valign="top"><?php echo $searchForm['CaseNo']->render(); ?></td>
				<td align="left" valign="top"> From &nbsp;
                    <?php   echo $searchForm['StartAmount']->render(array('style'=>'width:50px;')); 
                    echo "&nbsp;&nbsp;To&nbsp;&nbsp;";
							echo $searchForm['EndAmount']->render(array('style'=>'width:50px;')); ?>	
							<br>							            
                            <label class="error" id="searchAmountError"></label></td>
                            
			    <td align="left" valign="top" ><?php echo $searchForm['FromDate']->render(); echo "&nbsp;&nbsp;To&nbsp;&nbsp;"; echo $searchForm['ToDate']->render(); ?>
									  <br><label class="error" id="dateError"></label></td>
                            
			    <td align="left" valign="top"><span class="bluButton"> 
                        <?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'bluButton', 'value' => 'Search')); ?> </span> <span class="grayButton">
                        <?php echo tag('input', array('name' => 'clear', 'type' => 'reset', 'id' => 'clear', 'class' => 'grayButton', 'value' => 'Clear', "onclick"=>'window.location="'.url_for('customerreport/paymentReport').'"')); ?> </span></td>
			</tr>
			<tr>
			     <td height="1" colspan="5" align="left" valign="top"></td>
		    </tr>
			</table>
			</form></td>
		</tr>
		<tr>
            <td>&nbsp;</td>
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
                            <td align="center" width="20%"><b>Case No. & Case Title</b></td>
                            <td align="center" width="15%"><b>Actual Amount</b></td>
                            <!--<td align="center" width="10%"><b>Actual Commision</b></td>
                            <td align="center" width="10%"><b>Processing Fees</b></td>-->
                            <td align="center" width="12%"><b>Receivable Amount</b></td>
                            <td align="center" width="12%"><b>UnderPay Adjustment</b></td>
                            <td align="center" width="15%"><b>Payments Disbursed</b></td>
                            <td align="center" width="15%"><b>Remain To Receive</b></td>
                            <td align="center" width="11%"><b>Overpaid Amount</b></td>
                            
             </tr>
             <?php $i=1; ?>              
             <?php foreach ($pager->getResults() as $cases):?>
             <?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
               <tr class="<?php echo $class;?>">
                            <td class="fldrowbg" align="left" valign="top"><?php echo link_to($cases->getCaseNo()." - ".$cases->getFirstTitle().' '.$cases->getLastTitle(),"customercase/view?id=".$cases->getId()) ;?></td>
                            <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($cases->getActualAmount(),2) ;?></td>
                            <!--<td class="fldrowbg" align="right" valign="top"><?php #echo sfConfig::get('app_currency').$cases->getCommisionActual() ; ?></td>
                            <td class="fldrowbg" align="right" valign="top"><?php #echo sfConfig::get('app_currency').$cases->getProcessingFees();  ?></td>-->
                            
                            
                            <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($cases->getPayableAmount(),2); ?></td>
                            <td class="fldrowbg" align="right" valign="top"><?php  if ($cases->getUnderpayAdjustment() != ""){ echo sfConfig::get('app_currency').round($cases->getUnderpayAdjustment(),2); }else { echo sfConfig::get('app_currency').'0'; } ?></td>
                            
                            <?php if($cases->getStage() == sfConfig::get('app_CaseStage_Accepted')) {?>
                                <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').'0'; ?></td>
                                <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($cases->getPayableAmount(),2) ; ?></td>
                            <?php } else {?>    
                                <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($cases->getPaidAmount(),2); ?></td>
                                <td class="fldrowbg" align="right" valign="top">
                                     <?php if( ($cases->getPaidAmount() + $cases->getUnderpayAdjustment() ) > $cases->getPayableAmount() ) { 
                                         echo sfConfig::get('app_currency').'0';
                                     } else {
                                         echo sfConfig::get('app_currency').round($cases->getRemainToPay(),2);
                                      } ?>                                           
                                    
                                 </td>
                            <?php } ?>
                            
                             <td class="fldrowbg" align="right" valign="top">
                                <?php if( ($cases->getPaidAmount() + $cases->getUnderpayAdjustment() ) > $cases->getPayableAmount() ) {
                                    echo sfConfig::get('app_currency').round(( ($cases->getPaidAmount() + $cases->getUnderpayAdjustment() ) -  $cases->getPayableAmount() ),2);
                                } else {
                                    echo sfConfig::get('app_currency').'0';
                                } ?>
                             </td>
                                
             </tr>
             <?php endforeach; ?>    
             <?php } else { ?> 
                <tr class="fldbg"><td class="errormss">No items found.</td></tr>
             <?php } ?>         
            </table>
           </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
        </tr>
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">                     
              <?php    
              $varExtra = '';
              /*if(isset($defaultArr['UserCaseNo']) && !empty($defaultArr['UserCaseNo'])) {
              $varExtra .="&UserCaseNo=".$defaultArr['UserCaseNo'];
              }*/
              if(isset($defaultArr['CaseNo']) && !empty($defaultArr['CaseNo'])) {
                  $varExtra .="&CaseNo=".$defaultArr['CaseNo'];
              }

              if($defaultArr['StartAmount'] != ''  && $defaultArr['EndAmount'] != '' ) {
                  $varExtra .="&StartAmount=".$defaultArr['StartAmount'];
              }

              if($defaultArr['StartAmount'] != '' && $defaultArr['EndAmount'] != '') {
                  $varExtra .="&EndAmount=".$defaultArr['EndAmount'];
              }

              if(isset($defaultArr['FromDate']) && !empty($defaultArr['FromDate'])) {
                  $varExtra .="&FromDate=".base64_encode($defaultArr['FromDate']);
              }

              if(isset($defaultArr['ToDate']) && !empty($defaultArr['ToDate'])) {
                  $varExtra .="&ToDate=".base64_encode($defaultArr['ToDate']);
              }


              ?>
               <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'customerreport/paymentReport', 'varExtra' => $varExtra));?>
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
<script type="text/javascript">
$(function() {
    $( "#search_CaseNo" ).autocomplete({
        source: "<?php url_for('customerreport/paymentReport') ?>",
        minLength: 2
    });
});
</script>