<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>


<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">
<!-- Bread Crumb Start -->
<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="66%" class="drkgrylnk padlft"><a href="<?php echo url_for("default/index");?>" title="Home"> 
    <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home")) ?></a>
    </td>
  <td width="34%" align="right" class="AdminBreadCrumb">
   <table cellpadding="8" cellspacing="0" align="right">
    <tr align="center">
     <!--<td width="57" class="LinkImg" ><a href="#" title="Edit"><?php image_tag("admin/Icon_Save.gif", array("alt"=>"Save","title"=>"Save","border"=>"0")) ?><br />
      Save </a></td>-->
     <td width="57" class="LinkImg" ><a href="<?php echo url_for('accounting/thirdpartyPayReport') ?>">
        <?php echo image_tag("admin/Icon_Cancel.gif", array("alt"=>"Cancel","title"=>"Cancel","border"=>"0")) ?><br />
      Cancel </a></td>
    </tr>
   </table>
  </td>
 </tr>
</table>
<!-- Bread Crumb End -->
</td></tr>
<tr><td width="100%">
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
           <td width="10%" align="right" class="ContentBtmDotLn Pad5">
            <?php echo image_tag("admin/Icon_Groups.gif",array("alt"=>"Groups","title"=>"Groups","align"=>"middle")) ?><span class="Title"> </span></td>
           <td width="90%" class="ContentBtmDotLn">
            <div style="float:left;" class="Title">Log 3rd Party Payment Received </div>           
           </td>
          </tr>
          <tr valign="top">
           <td colspan="2" class="dot"></td>
          </tr>
          
            <?php if($sf_user->hasFlash('errMsg')) { ?>            
                      <tr align="center" valign="top">
                       <td colspan="2" class="ListAreaPad">
                        <table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">
                         <tr>
                          <td class="dot2"></td>
                         </tr>
                         <tr>
                          <td class="error" align="center"><?php echo $sf_user->getFlash('errMsg');?></td>
                         </tr>
                         <tr>
                          <td class="dot2"></td>
                         </tr>
                        </table>
                       </td>
                      </tr>
            <?php }?>
          
            <?php if($sf_user->hasFlash('succMsg')) { ?>            
            <tr align="center" valign="top">
            <td colspan="2" class="ListAreaPad">
            <table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">
             <tr>
              <td class="dot2"></td>
             </tr>
             <tr>
              <td class="success" align="center"><?php echo $sf_user->getFlash('succMsg');?></td>
             </tr>
             <tr>
              <td class="dot2"></td>
             </tr>
            </table>
            </td>
            </tr>
            <?php }?>
            
          
             <tr valign="top">
 <td class="ListAreaPad" colspan="2">
  <table width="55%" cellspacing="0" cellpadding="0" border="0" align="center">
  
  <?php if ($form->hasGlobalErrors()): ?>
   <tr>
    <td class="dot2"></td>
   </tr>
   <?php foreach ($form->getGlobalErrors() as $name => $error): ?>
     <tr>
      <td class="errormss" align="center"><?php echo $name.': '.$error ?></td>
     </tr>
   <?php endforeach; ?>
   <tr>
    <td class="dot2"></td>
   </tr>
  <?php endif; ?>
  
  </table>
 </td>
</tr>
            <td class="ListAreaPad" colspan="2">
            
           <form action="<?php echo url_for('accounting/createReceived') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  
            <table width="65%" cellspacing="1" cellpadding="1" align="center" class="brd1">
               <tbody>
               
               <tr class="fldbg">
                <td class="whttxt" colspan="3">Payment Details</td>
               </tr>
               

                <tr>
                  <td align="center" class="fldrowbg error">*</td>
                  <td width="26%" class="fldrowbg"><b><?php echo $form['ThirdParty']->renderLabel() ?>:</b></td>
                  <td width="68%" class="fldrowbg">
                   <?php echo $form['ThirdParty']->render(array('onChange'=>'getCaseInfo(this.value)')) ?>
                   <?php if ($form['ThirdParty']->hasError()): ?>            
                        <div class="errormsgs"><?php echo $form['ThirdParty']->getError()?></div>            
                   <?php endif; ?>
                  </td>
                </tr>
               
                <tr>
                  <td align="center" class="fldrowbg error">*</td>
                  <td width="26%" class="fldrowbg"><b><?php echo $form['CaseNo']->renderLabel() ?>:</b></td>
                  <td width="68%" class="fldrowbg">
                   <?php echo $form['CaseNo']->render(array('onChange'=>'getCasePaymentdetail(this.value)')) ?>
                   <?php if ($form['CaseNo']->hasError()): ?>            
                        <div class="errormsgs"><?php echo $form['CaseNo']->getError()?></div>            
                   <?php endif; ?>
                  </td>
                </tr>

                
                <tr id="paymentDetail" style="display:none;">
                  <td align="center" class="fldrowbg error"></td>
                  <td width="26%" class="fldrowbg"><b>&nbsp;Actual Amount:</b></td>
                  <td width="68%" class="fldrowbg">
                   <div id="actual_amount"></div>
                  </td>
                </tr>
                
                
                <tr>
                  <td align="center" class="fldrowbg error">*</td>
                  <td width="26%" class="fldrowbg"><b><?php echo $form['ReceivedAmount']->renderLabel() ?>:</b></td>
                  <td width="68%" class="fldrowbg">
                   <?php echo $form['ReceivedAmount']->render() ?>
                   <?php if ($form['ReceivedAmount']->hasError()): ?>            
                        <div class="errormsgs"><?php echo $form['ReceivedAmount']->getError()?></div>            
                   <?php endif; ?>
                  </td>
                </tr>

                <tr>
                  <td align="center" class="fldrowbg error">*</td>
                  <td width="26%" class="fldrowbg"><b><?php echo $form['PaymentReceivedDate']->renderLabel() ?>:</b></td>
                  <td width="68%" class="fldrowbg">
                   <?php echo $form['PaymentReceivedDate']->render() ?>
                   <?php if ($form['PaymentReceivedDate']->hasError()): ?>            
                        <div class="errormsgs"><?php echo $form['PaymentReceivedDate']->getError()?></div>            
                   <?php endif; ?>
                  </td>
                </tr>
                
               
               <tr class="fldrowbg">
                <td height="33" align="center" class="fldrowbg error">&nbsp;</td>
                <td align="center" colspan="2" class="fldrowbg">
                    <input type="submit" value="Save" class="CommonButton" id="submit" name="submit"> 
                    <?php echo $form->renderHiddenFields(false) ?>   
                </td>
               </tr>
               
              </tbody>
             </table>
          </form>
             </td>
          
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

<script>

$("input[type=submit]").attr("disabled", "disabled");

/* function for the change county according to state*/
function getCaseInfo(partyId){

    $.ajax({
    'dataType': 'html',
    'type': 'POST',
    'url': '<?php echo url_for("accounting/getThirdPartyPaidCases"); ?>',
    'data': {partyId:partyId},
    beforeSend: function(){
        $('#paymentDetail').hide(); // Hide Payment div
        $('#logReceived_CaseNo').html("<option>Loading...</option>");
    },
    'success': function(data) {

        $('#logReceived_CaseNo').html(data);
    }

    });
}

function getCasePaymentdetail(caseId) {
    //alert(caseId);
    $.ajax({
        //'dataType': 'post',
        'type': 'POST',
        'url': '<?php echo url_for("accounting/getCasePaymentdetail"); ?>',
        'data': {caseId:caseId},
        beforeSend: function(){
            $('#paymentDetail').hide(); // Hide Payment div
            
        },
        'success': function(data) {
            //alert(data);
            var dollar = ' $';
            var obj = eval ("(" + data + ")");
            //alert(obj.actual_amount);
            $('#actual_amount').html(dollar + obj.actual_amount);
            $('#paymentDetail').show();
            
               $("input[type=submit]").removeAttr("disabled"); // Enable the Submit button
        }

    });

} // End of Function
</script>
