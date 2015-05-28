<table width="98%" cellspacing="0" cellpadding="0">
	<tr>
    	<td>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<!--
<?php /*if($sf_user->hasFlash('errMsg')) { ?>            
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
<?php }*/?>-->
<?php include_partial('default/message'); ?>
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
<?php
$caseLink = "";
if ($sf_params->get('from') == "caseDetail") {
    $caseLink = '&from=caseDetail&caseId='.$sf_params->get('caseId');
}
?>
<tr valign="top">
 <td colspan="2" class="ListAreaPad">
  <form action="<?php echo url_for('dashboardcase/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '').'&customerId='.$sf_params->get('customerId').$caseLink) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="editCase" name="editCase">
  <?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
  <table width="98%" cellspacing="1" cellpadding="1" align="center" class="CaseEditForm">
  
    <tr>
      <td width="26%" class="fldrowbg"><b>Case No.:</b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $caseDetail->getCaseNo(); ?>      </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['FirstTitle']->renderLabel() ?>: </b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['FirstTitle']->render() ?>
       <?php if ($form['FirstTitle']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['FirstTitle']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['LastTitle']->renderLabel() ?>: </b> <span class="error">*</span></td>
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
      <td width="26%" class="fldrowbg"><b><?php echo $form['ThirdParty']->renderLabel() ?>: </b> 
        <?php if($caseDetail->getStage() == sfConfig::get('app_CaseStage_Submitted')) { ?>
            <span class="error">*</span>
        <?php } ?>
        </td>
      <td width="68%" class="fldrowlightbg">
       <?php if($caseDetail->getStage() == sfConfig::get('app_CaseStage_Submitted')) {
           echo $form['ThirdParty']->render();
       } else {
           echo $caseDetail->getCasesThirdParties()->getName();
       } ?>
       
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

    <?php /* if($caseDetail->getBillDocumentSystemName() != '') { ?>
       <tr  style="height:35px;">
       <td width="26%" class="fldrowbg"><b>View Uploaded Invoice:</b></td>
       <td width="68%" class="fldrowlightbg">
       <div  class="download">
       <?php echo link_to("&nbsp;","case/downloadinvoice?id=".$caseDetail->getId(),array('title'=>'Click here to download Invoice'))?>		</div>

       <?php echo link_to("Drop Invoice","case/removeinvoice?id=".$caseDetail->getId(),array('title'=>'Click here to delte Invoice'))?>      </td>
       </tr>
    <?php } */ ?>
    
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
      <td width="26%" class="fldrowbg"><b><?php echo $form['ActualAmount']->renderLabel() ?>: </b> 
      <?php if($caseDetail->getStage() == sfConfig::get('app_CaseStage_Submitted')) { ?>
        <span class="error">*</span>
      <?php } ?>  
      
      </td>
      <td width="68%" class="fldrowlightbg">
      
       <?php if($caseDetail->getStage() == sfConfig::get('app_CaseStage_Submitted')) {
           echo $form['ActualAmount']->render();
       } else {
           echo sfConfig::get('app_currency').$caseDetail->getActualAmount();
       } ?>
       
       <?php if ($form['ActualAmount']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['ActualAmount']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['AgreementDate']->renderLabel() ?>: </b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['AgreementDate']->render() ?>
       <?php if ($form['AgreementDate']->hasError()): ?>
       <div class="errormsgs"><?php echo $form['AgreementDate']->getError()?></div>
       <?php endif; ?>      </td>
    </tr>
    
    
   <tr class="fldbg">
    <td height="33" align="center" class="fldrowbg error">&nbsp;</td>
    <td class="fldrowbg" colspan="2" align="left">
    <?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?>    
              <?php echo $form->renderHiddenFields(false) ?>        </td>
   </tr>
   
  </table>
  </form>
 </td>
</tr>
 <tr>
      <td align="center" height="20"></td>
    </tr>
		</td>
	</tr>
</table>
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
        /*        "cases[ThirdParty]": {
        required: true
        },*/
        "cases[ThirdParty]": {
            required:function(){
                <?php if($caseDetail->getStage() == sfConfig::get('app_CaseStage_Submitted')) { ?>
                return true;
                <?php }else{ ?>
                return false;
                <?php  } ?>
            }
        },
        /*        "cases[ActualAmount]": {
        required: true,
        minlength: 1
        }*/
        "cases[ActualAmount]": {
            required: function(){
                <?php if($caseDetail->getStage() == sfConfig::get('app_CaseStage_Submitted')) { ?>
                return true;
                <?php }else{ ?>
                return false;
                <?php  } ?>

            },
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