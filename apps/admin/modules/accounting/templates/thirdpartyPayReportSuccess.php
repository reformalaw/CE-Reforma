<?php include_partial('case/header');?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">
<!-- Bread Crumb Start -->
<?php /*
<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
  <td width="30%" class="drkgrylnk" align="center"><div class="Title">3rd Party Payment Received</div></td>
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
          <tr valign="top">
            <td colspan="2" class="" align="center">
                <table border="0" cellspacing="0" cellpadding="0" class="filterMain">
                  <tr>
                    <td align="left" valign="top" colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center" valign="top" class="CasesListSearch" colspan="2">
                    <form action="<?php echo url_for('accounting/thirdpartyPayReport') ?>" method="post" onsubmit="return validateThirdPartyPayReportSearch();">
    	               <table width="100%" cellspacing="10" cellpadding="0">
                        <tr>
                            <td width="220" align="left" valign="top"><?php echo $searchForm['ThirdParty']->renderLabel(); ?></td>
                            <td width="220" align="left" valign="top"><?php echo $searchForm['CaseNo']->renderLabel(); ?></td>
                            <td width="220" align="left" valign="top"><?php echo $searchForm['FromDate']->renderLabel(); ?></td>
                            <td width="220" align="left" valign="top"><?php echo $searchForm['StartAmount']->renderLabel(); ?></td>
                            <td align="left" valign="top">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="left" valign="top"><?php echo $searchForm['ThirdParty']->render(); ?></td>
                            <td align="left" valign="top"><?php echo $searchForm['CaseNo']->render(); ?></td>
                            <td align="left" valign="top"><?php echo $searchForm['FromDate']->render(); 
                                        echo "&nbsp;To&nbsp;";
										echo $searchForm['ToDate']->render(); ?>
                                        <br>  											
                                        <label class="error" id="dateError"></label></td>
                            <td align="left" valign="top"> From
                                        <?php   echo $searchForm['StartAmount']->render(array('style'=>'width:50px;')); 
                                                echo "&nbsp;To&nbsp;";
											    echo $searchForm['EndAmount']->render(array('style'=>'width:50px;')); ?>
								                <br>													
                                                <label class="error" id="searchAmountError"></label></td>
                            <td align="left" valign="top"><span class="bluButton"> <?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'bluButton', 'value' => 'Search')); ?> </span> <span class="grayButton">
                                        <?php echo tag('input', array('name' => 'clear', 'type' => 'reset', 'id' => 'clear', 'class' => 'grayButton', 'value' => 'Clear', "onclick"=>'window.location="'.url_for('accounting/thirdpartyPayReport').'"')); ?> </span> </td>
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
                            
                            <td align="center" width="20%"><b>3rd Party</b></td>
                            <td align="center" width="30%"><b>Case No. - Case Title & Actual Amount</b></td>
                            <td align="center" width="30%"><b>Payments Disbursed</b></td>
                            <!--<td align="center" width="15%"><b>Difference Amount</b></td>-->
                            <td align="center" width="20%"><b>Payments Disbursed Date</b></td>
             </tr>              
             <?php $i=1; ?>
             <?php foreach ($pager->getResults() as $cases):?>
             <?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
             <tr class="<?php echo $class;?>">
                                    
                            <td class="fldrowbg" align="left" valign="top"><?php echo $cases->getThirdPartyPaymentReceivedThirdParties()->getName(); ?></td>
                            <td class="fldrowbg" align="left" valign="top"><?php echo link_to($cases->getCaseNo()." - ".$cases->getThirdPartyPaymentReceivedCases()->getFirstTitle().' '.$cases->getThirdPartyPaymentReceivedCases()->getLastTitle().' - '.sfConfig::get('app_currency').$cases->getThirdPartyPaymentReceivedCases()->getActualAmount(), "dashboardcase/dashboardCaseDetails?customerId=".$cases->getThirdPartyPaymentReceivedCases()->getUserId()."&caseId=".$cases->getThirdPartyPaymentReceivedCases()->getId()); ?></td>
                            <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($cases->getReceivedAmount(),2); ?></td>
                           <!-- <td class="fldrowbg" align="left" valign="top"><?php /*
                            if($cases->getDifferenceAmount() != '')
                            echo sfConfig::get('app_currency').$cases->getDifferenceAmount();
                            else
                            echo sfConfig::get('app_currency').'0'; */
                            ?></td> -->                           
                            <td class="fldrowbg" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'),strtotime($cases->getPaymentReceivedDate())); ?></td>
                                                    
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
              if(isset($defaultArr['ThirdParty']) && !empty($defaultArr['ThirdParty'])) {
                  $varExtra .="&ThirdParty=".$defaultArr['ThirdParty'];
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

              if($defaultArr['StartAmount'] != ''  && $defaultArr['EndAmount'] != '') {
                  $varExtra .="&StartAmount=".$defaultArr['StartAmount'];
              }

              if($defaultArr['StartAmount'] != '' && $defaultArr['EndAmount'] != '' ) {
                  $varExtra .="&EndAmount=".$defaultArr['EndAmount'];
              }

              ?>
               <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'accounting/thirdpartyPayReport', 'varExtra' => $varExtra));?>
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
    var dataString = 'partyId='+val+'&stage=PC';
    $.ajax({
        type: "POST",
        url: "<?php echo url_for('accounting/getThirdPartyCloseCases'); ?>",
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
