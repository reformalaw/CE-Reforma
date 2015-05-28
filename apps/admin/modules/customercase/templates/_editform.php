<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php include_partial('default/message'); ?>

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
  <form id="EditCutomerCaseFrm" name="EditCutomerCaseFrm" action="<?php echo url_for('customercase/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
  <input type="hidden" name="bFlag" value="<?php echo $bFlag; ?>">
  <table width="98%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
  
    
   
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['FirstTitle']->renderLabel() ?> : </b><span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['FirstTitle']->render() ?>
       <?php if ($form['FirstTitle']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['FirstTitle']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['LastTitle']->renderLabel() ?> : </b><span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['LastTitle']->render() ?>
       <?php if ($form['LastTitle']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['LastTitle']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Description']->renderLabel() ?> :</b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Description']->render() ?>
       <?php if ($form['Description']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Description']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['ThirdParty']->renderLabel() ?> : </b><span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['ThirdParty']->render() ?>
       <?php if ($form['ThirdParty']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['ThirdParty']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    

    <?php /*if($caseDetail->getBillDocumentSystemName() != '') { ?>
    <tr  style="height:35px;">
      <td width="26%" class="fldrowbg"><b>View Uploaded Invoice:</b></td>
      <td width="68%" class="fldrowlightbg">
        <div  class="download">
			 <?php echo link_to("&nbsp;","case/downloadinvoice?id=".$caseDetail->getId(),array('title'=>'Click here to download Invoice'))?>		</div>
		
		 <?php echo link_to("Drop Invoice","case/removeinvoice?id=".$caseDetail->getId().'&type=customer',array('title'=>'Click here to delte Invoice'))?>      </td>
    </tr>
    <?php } */ ?>
    
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['ActualAmount']->renderLabel() ?> : </b><span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['ActualAmount']->render() ?>
       <?php if ($form['ActualAmount']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['ActualAmount']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>
    
    
    
   <tr class="fldbg">
   <td width="26%" class="fldrowbg"></td>
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
	jQuery("#EditCutomerCaseFrm").validate({
		errorClass: "errormsgs",
		rules: {
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
// 			"cases[Description]": {
// 				required: true,
// 				minlength: 3,
// 			},
			"cases[ActualAmount]": {
				required: true,
			},
			"cases[ThirdParty]": {
				required: true,
			},
		},
		messages: {
		    "cases[FirstTitle]": {
		      required: "This field is required.",
		      minlength: "First name must be at least 2 characters long.",
		      maxlength: "First name cannot be longer than 45 characters."
		    },
		    "cases[LastTitle]": {
		      required: "This field is required.",
		      minlength: "Last name must be at least 2 characters long.",
		      maxlength: "Last name cannot be longer than 45 characters."
		    },
// 		    "cases[Description]": {
// 		      required: "Please Enter the Description",
// 		      minlength: "Description must be atleast 3 characters long",
// 		    },
		    "cases[ActualAmount]": {
		      required: "This field is required.",
		    },
			"cases[ThirdParty]": {
				required: "This field is required.",
		    },
		    
		}
	});
});
</script>