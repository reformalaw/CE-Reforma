<?php include_partial('case/header');?>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">
<!-- Bread Crumb Start -->
<?php /*
<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
  <td width="30%" class="drkgrylnk" align="center"><div class="Title">Customer Payment Report</div></td>
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
          <!--<tr>
           <td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php //echo image_tag("admin/Icon_Groups.gif", array("alt"=>"Cases","title"=>"Cases","align"=>"middle"))?></td>
           <td width="90%" class="ContentBtmDotLn">
            <div style="float:left;" class="Title">Customer Payment Report</div>

           </td>
          </tr>-->
          
          
          <!-- Search Form -->
         <tr>
            <td align="center" valign="top" class="CasesListSearch" colspan="2">
            <form action="<?php echo url_for('accounting/customerPayReport') ?>" method="post" onsubmit="return validateCustomerPayReportSearch();">
    	       <table width="100%" cellspacing="10" cellpadding="0">
               <tr>
                <td width="220" align="left" valign="top"><?php echo $searchForm['UserId']->renderLabel(); ?></td>
                <td width="220" align="left" valign="top"><?php echo $searchForm['CaseNo']->renderLabel(); ?></td>
                <td width="220" align="left" valign="top"><?php echo $searchForm['FromDate']->renderLabel(); ?></td>
                <td width="220" align="left" valign="top"><?php echo $searchForm['StartAmount']->renderLabel(); ?></td>
                <td align="left" valign="top">&nbsp;</td>
               </tr>
               <tr>
                <td align="left" valign="top"><?php echo $searchForm['UserId']->render(); ?></td>
                <td align="left" valign="top"><?php echo $searchForm['CaseNo']->render(); ?></td>
                <td align="left" valign="top"><?php echo $searchForm['FromDate']->render(); 
                                                    echo "&nbsp;To&nbsp;";
										            echo $searchForm['ToDate']->render(); ?>
                                                    <br>  											
                                                    <label class="error" id="dateError"></label></td>
                <td align="left" valign="top"> From <?php   echo $searchForm['StartAmount']->render(array('style'=>'width:50px;')); 
                                                            echo "&nbsp;To&nbsp;";
											                echo $searchForm['EndAmount']->render(array('style'=>'width:50px;')); ?>
								                            <br>													
                                                            <label class="error" id="searchAmountError"></label></td>
                <td align="left" valign="top"><span class="bluButton"> <?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'bluButton', 'value' => 'Search')); ?> </span> <span class="grayButton">
                                        <?php echo tag('input', array('name' => 'clear', 'type' => 'reset', 'id' => 'clear', 'class' => 'grayButton', 'value' => 'Clear', "onclick"=>'window.location="'.url_for('accounting/customerPayReport').'"')); ?> </span></td>
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
      </table>
     </td>
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
                            <td align="center" width="20%"><b>Customer Name</b></td>
                            <td align="center" width="25%"><b>Case No.- Case Title - Actual Amount </b></td>
                            <td align="center" width="15%"><b>Paid Amount</b></td>
                            <td align="center" width="15%"><b>UnderPay Adjustment</b></td>
                            <td align="center" width="15%"><b>Check No.</b></td>
                            <td align="center" width="10%"><b>Paid Date</b></td>
             </tr>
             <?php $i =1; ?>              
             <?php foreach ($pager->getResults() as $cases):?>
             <?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
             <tr class="<?php echo $class;?>">
                            <td class="fldrowbg" align="left" valign="top"><?php echo link_to($cases->getCustomerPaymentSentUsers()->getFirstName().' '.$cases->getCustomerPaymentSentUsers()->getLastName(),"dashboard/index?customerId=".$cases->getCustomerPaymentSentUsers()->getId()); ?></td>
                            <td class="fldrowbg" align="left" valign="top"><?php echo link_to($cases->getCaseNo()." - ".$cases->getCustomerPaymentSentCases()->getFirstTitle().' '.$cases->getCustomerPaymentSentCases()->getLastTitle().' - '.sfConfig::get('app_currency').round($cases->getActualAmount(),2),"dashboardcase/dashboardCaseDetails?customerId=".$cases->getCustomerPaymentSentCases()->getUserId()."&caseId=".$cases->getCustomerPaymentSentCases()->getId()); ?></td>
 
                            <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($cases->getPayableAmount(),2); ?></td>
                           <td class="fldrowbg" align="right" valign="top"><?php 
                           if($cases->getUnderpayAdjustment() != '')
                           echo sfConfig::get('app_currency').round($cases->getUnderpayAdjustment(),2);
                           else
                           echo sfConfig::get('app_currency').'0';
                            ?></td>
                            <td class="fldrowbg" align="right" valign="top"><?php echo $cases->getCheckNo() ?></td>
                            <td class="fldrowbg" align="center" valign="top"><?php echo date('Y-m-d',strtotime($cases->getCustomerPaidDate())); ?></td>
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

              /*if(isset($defaultArr['UserCaseNo']) && !empty($defaultArr['UserCaseNo'])) {
              $varExtra .="&UserCaseNo=".$defaultArr['UserCaseNo'];
              }*/

              if(isset($defaultArr['CaseNo']) && !empty($defaultArr['CaseNo'])) {
                  $varExtra .="&CaseNo=".$defaultArr['CaseNo'];
              }

              if(isset($defaultArr['FromDate']) && !empty($defaultArr['FromDate'])) {
                  $varExtra .="&FromDate=".base64_encode($defaultArr['FromDate']);
              }

              if(isset($defaultArr['ToDate']) && !empty($defaultArr['ToDate'])) {
                  $varExtra .="&ToDate=".base64_encode($defaultArr['ToDate']);
              }

              /*if(isset($defaultArr['Amount']) && !empty($defaultArr['Amount'])) {
              $varExtra .="&Amount=".$defaultArr['Amount'];
              }*/


              if($defaultArr['StartAmount'] != '' && $defaultArr['EndAmount'] != '') {
                  $varExtra .="&StartAmount=".$defaultArr['StartAmount'];
              }

              if($defaultArr['StartAmount'] != '' && $defaultArr['EndAmount'] != '') {
                  $varExtra .="&EndAmount=".$defaultArr['EndAmount'];
              }

              ?>
               <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'accounting/customerPayReport', 'varExtra' => $varExtra));?>
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

<script language="javascript" type="text/javascript">

function getCases(val) {
    //if(val != '') {
    var dataString = 'userid='+val+'&stage=PC';
    $.ajax({
        type: "POST",
        url: "<?php echo url_for('accounting/getSelectedCase'); ?>",
        data: dataString,
        beforeSend: function(){
            $('#search_UserCaseNo').html("<option>Loading...</option>");
        },
        success: function(message) {
            $('#search_UserCaseNo').html(message);
        }
    });

    /*} else {
    alert(val+'========');
    }*/

} // End of Function

$(function() {
    $( "#search_CaseNo" ).autocomplete({
        source: "<?php url_for('accounting/customerPayReport') ?>",
        minLength: 2
    });
});
</script>