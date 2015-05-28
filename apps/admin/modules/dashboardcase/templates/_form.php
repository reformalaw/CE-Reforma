<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php include_partial('default/message'); ?>
<tr valign="top">
 <td colspan="2" class="ListAreaPad">
  <table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">
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
<tr valign="top">
 <td colspan="2" class="ListAreaPad">
  <form action="<?php echo url_for('dashboardcase/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId().'&customerId='.$sf_params->get('customerId') : '?customerId='.$sf_params->get('customerId'))) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="newCase" name="newCase">
  <?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
  <table width="65%" cellspacing="1" cellpadding="0" align="center" class="CaseEditForm">
   <tr class="fldbg">
    <td class="whttxt" colspan="2">Case Details</td>
   </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['FirstTitle']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['FirstTitle']->render() ?>
       <?php if ($form['FirstTitle']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['FirstTitle']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['LastTitle']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['LastTitle']->render() ?>
       <?php if ($form['LastTitle']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['LastTitle']->getError()?></div>            
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
    
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['ThirdParty']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['ThirdParty']->render() ?>
       <?php if ($form['ThirdParty']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['ThirdParty']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    <!--<tr>
      <td align="center" class="fldrowbg error"></td>
      <td width="26%" class="fldrowbg"><b><?php //echo $form['Document']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php //echo $form['Document']->render() ?>
       <br>
       <strong>[ NOTE: Only doc, excel, pdf are allowed ]</strong>
       <?php //if ($form['Document']->hasError()): ?>            
            <div class="errormsgs"><?php //echo $form['Document']->getError()?></div>            
       <?php //endif; ?>
      </td>
    </tr>-->
    
<!--    <tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php #echo $form['BillDocumentRealName']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php /*echo $form['BillDocumentRealName']->render() ?>
<?php if ($form['BillDocumentRealName']->hasError()): ?>
<div class="errormsgs"><?php echo $form['BillDocumentRealName']->getError()?></div>
       <?php endif;*/ ?>
      </td>
    </tr>
    <tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php #echo $form['BillDocumentSystemName']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php /* echo $form['BillDocumentSystemName']->render() ?>
       <?php if ($form['BillDocumentSystemName']->hasError()): ?>
       <div class="errormsgs"><?php echo $form['BillDocumentSystemName']->getError()?></div>
       <?php endif;*/ ?>
      </td>
    </tr>-->
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['ActualAmount']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['ActualAmount']->render() ?>
       <?php if ($form['ActualAmount']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['ActualAmount']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['AgreementDate']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['AgreementDate']->render() ?>
       <?php if ($form['AgreementDate']->hasError()): ?>
       <div class="errormsgs"><?php echo $form['AgreementDate']->getError()?></div>
       <?php endif; ?>      </td>
    </tr>
    
    <!--<tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php #echo $form['CommisionPercentage']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php /*echo $form['CommisionPercentage']->render() ?>
       <?php if ($form['CommisionPercentage']->hasError()): ?>
       <div class="errormsgs"><?php echo $form['CommisionPercentage']->getError()?></div>
       <?php endif;*/ ?>
      </td>
    </tr>-->
    <!--<tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php #echo $form['CommisionActual']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php /*echo $form['CommisionActual']->render() ?>
       <?php if ($form['CommisionActual']->hasError()): ?>
       <div class="errormsgs"><?php echo $form['CommisionActual']->getError()?></div>
       <?php endif; */ ?>
      </td>
    </tr>-->
    <!--<tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php #echo $form['ProcessingFees']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php /*echo $form['ProcessingFees']->render() ?>
       <?php if ($form['ProcessingFees']->hasError()): ?>
       <div class="errormsgs"><?php echo $form['ProcessingFees']->getError()?></div>
       <?php endif; */ ?>
      </td>
    </tr>-->
    <!--<tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php #echo $form['UnderpayAdjustment']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php /*echo $form['UnderpayAdjustment']->render() ?>
       <?php if ($form['UnderpayAdjustment']->hasError()): ?>
       <div class="errormsgs"><?php echo $form['UnderpayAdjustment']->getError()?></div>
       <?php endif; */ ?>
      </td>
    </tr>
    <tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php #echo $form['PayableAmount']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php /*echo $form['PayableAmount']->render() ?>
       <?php if ($form['PayableAmount']->hasError()): ?>
       <div class="errormsgs"><?php echo $form['PayableAmount']->getError()?></div>
       <?php endif;*/ ?>
      </td>
    </tr>
    <tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php #echo $form['ReceivedAmount']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php /*echo $form['ReceivedAmount']->render() ?>
       <?php if ($form['ReceivedAmount']->hasError()): ?>
       <div class="errormsgs"><?php echo $form['ReceivedAmount']->getError()?></div>
       <?php endif; */ ?>
      </td>
    </tr>
    <tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php #echo $form['DifferenceAmount']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php /*echo $form['DifferenceAmount']->render() ?>
       <?php if ($form['DifferenceAmount']->hasError()): ?>
       <div class="errormsgs"><?php echo $form['DifferenceAmount']->getError()?></div>
       <?php endif;*/ ?>
      </td>
    </tr>
    <tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php #echo $form['CustomerPaidDate']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php /*echo $form['CustomerPaidDate']->render() ?>
       <?php if ($form['CustomerPaidDate']->hasError()): ?>
       <div class="errormsgs"><?php echo $form['CustomerPaidDate']->getError()?></div>
       <?php endif;*/ ?>
      </td>
    </tr>
    <tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php #echo $form['PaymentReceivedDate']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php /*echo $form['PaymentReceivedDate']->render() ?>
       <?php if ($form['PaymentReceivedDate']->hasError()): ?>
       <div class="errormsgs"><?php echo $form['PaymentReceivedDate']->getError()?></div>
       <?php endif;*/ ?>
      </td>
    </tr>
    <tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php #echo $form['Status']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php /*echo $form['Status']->render() ?>
       <?php if ($form['Status']->hasError()): ?>
       <div class="errormsgs"><?php echo $form['Status']->getError()?></div>
       <?php endif;*/ ?>
      </td>
    </tr>
    <tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php #echo $form['CreateDateTime']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php /*echo $form['CreateDateTime']->render() ?>
       <?php if ($form['CreateDateTime']->hasError()): ?>
       <div class="errormsgs"><?php echo $form['CreateDateTime']->getError()?></div>
       <?php endif;*/ ?>
      </td>
    </tr>
    <tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php #echo $form['UpdateDateTime']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php /*echo $form['UpdateDateTime']->render() ?>
       <?php if ($form['UpdateDateTime']->hasError()): ?>
       <div class="errormsgs"><?php echo $form['UpdateDateTime']->getError()?></div>
       <?php endif;*/ ?>
      </td>
    </tr>-->
    
   <tr class="fldbg">
   <td height="33" align="center" class="fldrowbg">
    <td height="33" align="left" class="fldrowbg">
    <?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?>    
              <?php echo $form->renderHiddenFields(false) ?>        </td>
   </tr>
  </table>
  </form>
 </td>
</tr>


<script type="text/javascript">
jQuery().ready(function() {

    // validate form on keyup and submit
    jQuery("#newCase").validate({
        errorClass: "errormsgs",
        rules: {
        "cases[UserId]": {
            required: true
        },
        "cases[FirstTitle]": {
            required: true,
            minlength: 2,
            maxlength: 45
        },
        "cases[LastTitle]": {
            required: true,
            minlength: 2,
            maxlength: 45
        },
        "cases[ThirdParty]": {
            required: true
        },
        "cases[ActualAmount]": {
            required: true,
            minlength: 1
        },
        "cases[AgreementDate]": {
            required: true
        }

        },
        messages: {
        "cases[UserId]": {
            required:   "This field is required."
        },
        "cases[FirstTitle]": {
            required:   "This field is required.",
            minlength:  "Defendant's first name must be at least 2 characters long.",
            maxlength:  "Defendant's first name cannot be longer than 45 characters."
        },
        "cases[LastTitle]": {
            required:   "This field is required.",
            minlength:  "Defendant's last name must be at least 2 characters long.",
            maxlength:  "Defendant's last name cannot be longer than 45 characters."
        },
        "cases[ThirdParty]": {
            required:   "This field is required."
        },
        "cases[ActualAmount]": {
            required:   "This field is required.",
            minlength:  "This field is required."
        },
        "cases[AgreementDate]": {
            required: "This field is required."
        }

        }
    });
});
</script>