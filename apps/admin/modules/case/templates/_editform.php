<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

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
 <td colspan="2" class="ListAreaPad">
  <form action="<?php echo url_for('case/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="editCase" name="editCase">
  <?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
  <table width="65%" cellspacing="1" cellpadding="1" class="brd1" align="center">
   <tr class="fldbg">
    <td colspan="3" class="whttxt">Case Detail</td>
   </tr>
   
    <tr>
      <td align="center" class="fldrowbg error"></td>
      <td width="26%" class="fldrowbg"><b>Case No.:</b></td>
      <td width="68%" class="fldrowbg">
       <?php echo $caseDetail->getCaseNo(); ?>
      </td>
    </tr>
   
     <tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php echo $form['UserId']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php echo $form['UserId']->render() ?>
       <?php if ($form['UserId']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['UserId']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php echo $form['FirstTitle']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php echo $form['FirstTitle']->render() ?>
       <?php if ($form['FirstTitle']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['FirstTitle']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php echo $form['LastTitle']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php echo $form['LastTitle']->render() ?>
       <?php if ($form['LastTitle']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['LastTitle']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td align="center" class="fldrowbg error"></td>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Description']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php echo $form['Description']->render() ?>
       <?php if ($form['Description']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Description']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>
    
    <tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php echo $form['ThirdParty']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php echo $form['ThirdParty']->render() ?>
       <?php if ($form['ThirdParty']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['ThirdParty']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>

    <?php if($caseDetail->getBillDocumentSystemName() != '') { ?>
    <tr  style="height:35px;">
      <td align="center" class="fldrowbg error"></td>
      <td width="26%" class="fldrowbg"><b>View Uploaded Invoice:</b></td>
      <td width="68%" class="fldrowbg">
        <div  class="download">
			 <?php echo link_to("&nbsp;","case/downloadinvoice?id=".$caseDetail->getId(),array('title'=>'Click here to download Invoice'))?>
		</div>
		
		 <?php echo link_to("Drop Invoice","case/removeinvoice?id=".$caseDetail->getId(),array('title'=>'Click here to delte Invoice'))?>
		


      </td>
    </tr>
    <?php } ?>

    <tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php echo $form['ActualAmount']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php echo $form['ActualAmount']->render() ?>
       <?php if ($form['ActualAmount']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['ActualAmount']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>
    
    <tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php echo $form['AgreementDate']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php echo $form['AgreementDate']->render() ?>
       <?php if ($form['AgreementDate']->hasError()): ?>
       <div class="errormsgs"><?php echo $form['AgreementDate']->getError()?></div>
       <?php endif; ?>
      </td>
    </tr>

   <tr class="fldrowbg">
    <td height="33" align="center" class="fldrowbg error">&nbsp;</td>
    <td class="fldrowbg" colspan="2" align="center">
    <?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?>    
              <?php echo $form->renderHiddenFields(false) ?>
        </td>
   </tr>
  </table>
  </form>
 </td>
</tr>
<script type="text/javascript">
jQuery().ready(function() {

    // validate form on keyup and submit
    jQuery("#editCase").validate({
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
            minlength:  "Actual amount must be at least 1 digit long."
        },
        "cases[AgreementDate]": {
            required: "This field is required."
        }

        }
    });
});
</script>