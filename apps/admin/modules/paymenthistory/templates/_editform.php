<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<tr valign="top">
 <td colspan="2" class="ListAreaPad">
  <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <?php if ($form->hasGlobalErrors()): ?>
   <?php foreach ($form->getGlobalErrors() as $name => $error): ?>
     <tr>
      <td class="errormss" align="center"><?php echo $name.': '.$error ?></td>
     </tr>
   <?php endforeach; ?>
  <?php endif; ?>
  </table>
 </td>
</tr>
<tr valign="top">
 <td colspan="2" class="" style="padding:0px;">
  <form action="<?php echo url_for('paymenthistory/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId().'&customerId='.$customerId.'&caseId='.$caseId : '?customerId='.$customerId.'&caseId='.$caseId)) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="logpayment">
  <?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
  <input type="hidden" name="paymentsent[CaseId]" value="<?php echo $caseId; ?>">
  <input type="hidden" name="paymentsent[UserId]" value="<?php echo $customerId; ?>">
  
  <input type="hidden" id="underPayAmt" name="underPayAmt" value="<?php echo $underPayAmt; ?>">
  <input type="hidden" id="old_underAdj" name="old_underAdj" value="<?php echo $form['UnderpayAdjustment']->getValue(); ?>">
   
  
  <table width="100%" cellspacing="1" cellpadding="0" align="center" class="CaseEditForm">
    <tr>
      <td width="26%" class="fldrowbg" valign="top"><b><?php echo $form['PayableAmount']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['PayableAmount']->render(array('onChange' => 'updateChkamt()')) ?>
       <?php if ($form['PayableAmount']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['PayableAmount']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    
    <tr>
      <td width="26%" class="fldrowbg" valign="top"><b>UnderPay Amount :</b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo sfConfig::get('app_currency').$underPayAmt; ?>      </td>
    </tr>
    <?php 
    $underAdjDiasbled = false ;
    if($form->getObject()->isNew() && $underPayAmt == 0) {
                $underAdjDiasbled = true ;
    } else if (!$form->getObject()->isNew() && $underPayAmt == 0 && $form['UnderpayAdjustment']->getValue() == 0  ) {
    	$underAdjDiasbled = true ;
    }                
    ?>
    
    <tr>
      <td width="26%" class="fldrowbg" valign="top"><b><?php echo $form['UnderpayAdjustment']->renderLabel() ?> :</b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['UnderpayAdjustment']->render(array('disabled' => $underAdjDiasbled, 'onChange' => 'updateChkamt()')) ?>
       <?php if ($form['UnderpayAdjustment']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['UnderpayAdjustment']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    <?php $checkAmt = '---';
          if($form['PayableAmount']->getValue() != '' )  {
              $checkAmt = '$'.($form['PayableAmount']->getValue() - $form['UnderpayAdjustment']->getValue());
          }
     ?>
    <tr>
      <td width="26%" class="fldrowbg" valign="top"><b>Check Amount :</b></td>
      <td width="68%" class="fldrowlightbg" id="chkamt"> <?php echo $checkAmt; ?> </td>
    </tr>
    
    <tr>
      <td width="26%" class="fldrowbg" valign="top"><b><?php echo $form['CustomerPaidDate']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['CustomerPaidDate']->render() ?>
       <?php if ($form['CustomerPaidDate']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['CustomerPaidDate']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg" valign="top"><b><?php echo $form['CheckNo']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['CheckNo']->render() ?>
       <?php if ($form['CheckNo']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['CheckNo']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg" valign="top"><b><?php echo $form['Description']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Description']->render() ?>
       <?php if ($form['Description']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Description']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
   <tr class="fldbg">
   	<td></td>
    <td height="33" align="left" class="fldrowbg">
    <?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?>    
              <?php echo $form->renderHiddenFields(true) ?>        </td>
   </tr>
  </table>
  </form>
 </td>
</tr>


<script type="text/javascript">

var underPayAmt = $('#underPayAmt').val();
jQuery().ready(function() {
    
	// validate form on keyup and submit
	jQuery("#logpayment").validate({
		errorClass: "errormsgs",
		rules: {
		    "paymentsent[PayableAmount]": {
				required: true
			},
            "paymentsent[CustomerPaidDate]": {
                required: true
            },		   
			"paymentsent[CheckNo]": {
				required: true
			}
		},
		messages: {
		    "paymentsent[PayableAmount]": {
		      required:   "This field is required."
		    },
            "paymentsent[CustomerPaidDate]": {
                required: "This field is required."
            },		   
		    "paymentsent[CheckNo]": {
		      required:   "This field is required."
		    }
		}
	});
	
	
});

function updateChkamt() {
    
    
    amt = $('#paymentsent_PayableAmount').val();
    if(isNaN(amt))
        amt = 0;  
    
    underAdjAmt = $('#paymentsent_UnderpayAdjustment').val();
    if(isNaN(underAdjAmt))
        underAdjAmt = 0;  
    
    
    underPayAmt = parseFloat($('#underPayAmt').val()); // Underpay Amount
    
    oldUnderAdj = $('#old_underAdj').val() ; // Old Adjustment 
    
    total = (parseFloat(underPayAmt)+parseFloat(oldUnderAdj)) ; 
    
    //alert(underAdjAmt+'---'+total);
    if(underAdjAmt>total){
        alert('You have entered wrong UnderPay Adjustment');
        $('#paymentsent_UnderpayAdjustment').val(oldUnderAdj);
        $('#paymentsent_UnderpayAdjustment').focus();
        return false;
    }
    
    if(amt != '')
        $('#chkamt').html('$'+(amt - underAdjAmt));
    
    
}
</script>