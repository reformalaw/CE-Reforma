<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<tr valign="top">
 <td colspan="2" class="ListAreaPad">
  <table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">
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
 <td colspan="2" style="padding:0px;">
  <form action="<?php echo url_for('paymentreceived/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId().'&customerId='.$customerId.'&caseId='.$caseId : '?customerId='.$customerId.'&caseId='.$caseId)) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>  id="logreceived">
  <?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
  <table width="100%" cellspacing="1" cellpadding="0" class="CaseEditForm" align="center">
  	<tr>
      <td width="26%" class="fldrowbg" valign="top"><b><?php echo $form['ReceivedAmount']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['ReceivedAmount']->render() ?>
       <?php if ($form['ReceivedAmount']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['ReceivedAmount']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg" valign="top"><b><?php echo $form['PaymentReceivedDate']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['PaymentReceivedDate']->render() ?>
       <?php if ($form['PaymentReceivedDate']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['PaymentReceivedDate']->getError()?></div>            
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
jQuery().ready(function() {

    // validate form on keyup and submit
    jQuery("#logreceived").validate({
        errorClass: "errormsgs",
        rules: {
        "paymentrecd[ReceivedAmount]": {
            required: true
        },
        "paymentrecd[PaymentReceivedDate]": {
            required: true
        }


        },
        messages: {
        "paymentrecd[ReceivedAmount]": {
            required:   "This field is required."
        },
        "paymentrecd[PaymentReceivedDate]": {
            required: "This field is required."
        }

        }
    });
});
</script>