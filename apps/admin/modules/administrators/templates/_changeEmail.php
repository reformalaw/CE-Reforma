<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php //include_partial('default/message'); ?>

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
  <form action="<?php echo url_for('administrators/changeEmail') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="changeEmailFrm" name="changeEmailFrm">
  <?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
  <input type="hidden" value="<?php echo $ssEmail; ?>" id="txtEmail" name="txtEmail">
 
	<table width="98%" cellspacing="1" cellpadding="1" class="EditFAQ CaseEditForm" align="center">
   <!--<tr class="fldbg">
    <td colspan="2" class="whttxt">Email Detail</td>
    </tr>-->
     <tr>
      <!--<td align="center" class="fldrowbg error"></td>-->
      <td width="26%" class="fldrowbg"><b><?php echo "Current Email"; ?>: </b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $ssEmail; ?>
      </td>
    </tr>

    <tr>
      <!--<td align="center" class="fldrowbg error"></td>-->
      <td width="26%" class="fldrowbg"><b><?php echo $form['Email']->renderLabel() ?>: </b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Email']->render() ?>
       <?php if ($form['Email']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Email']->getError()?></div>            
       <?php endif; ?>
       <?php if($sf_user->hasFlash('errMsg')) { ?>
            <div class="errormsgs"><?php echo $sf_user->getFlash('errMsg');?></div>
		<?php }?>
      </td>
    </tr>
    
    <tr>
      <!--<td align="center" class="fldrowbg error"></td>-->
      <td width="26%" class="fldrowbg"><b><?php echo $form['Confirm_Email']->renderLabel() ?>: </b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Confirm_Email']->render() ?>
       <?php if ($form['Confirm_Email']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Confirm_Email']->getError()?></div>            
       <?php endif; ?>
       <?php if($sf_user->hasFlash('errMsg')) { ?>
            <div class="errormsgs"><?php echo $sf_user->getFlash('errMsg');?></div>
		<?php }?>
      </td>
    </tr>
    
    
    <tr>
      <!--<td align="center" class="fldrowbg error"></td>-->
      <td width="26%" class="fldrowbg"><b><?php echo $form['Password']->renderLabel() ?>: </b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Password']->render() ?>
       <?php if ($form['Password']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Password']->getError()?></div>            
       <?php endif; ?>
       <?php if($sf_user->hasFlash('errMsgPassword')) { ?>
            <div class="errormsgs"><?php echo $sf_user->getFlash('errMsgPassword');?></div>
		<?php }?>
      </td>
    </tr>
    
    <tr>
      <!--<td align="center" class="fldrowbg error"></td>-->
      <td width="26%" class="fldrowbg"><b><?php echo $form['Confirm_Password']->renderLabel() ?>: </b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Confirm_Password']->render() ?>
       <?php if ($form['Confirm_Password']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Confirm_Password']->getError()?></div>            
       <?php endif; ?>
       <?php if($sf_user->hasFlash('errMsgPassword')) { ?>
            <div class="errormsgs"><?php echo $sf_user->getFlash('errMsgPassword');?></div>
		<?php }?>
      </td>
    </tr>

   <tr class="fldbg">
    <td height="33" align="center" class="fldrowbg error">&nbsp;</td>
    <td height="33" class="fldrowbg" colspan="2" align="left">
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
	jQuery("#changeEmailFrm").validate({
		errorClass: "errormsgs",
		rules: {
		    "changeEmail[Email]": {
				required: true,
				email:true,
				newEmail: true,
			},
		    "changeEmail[Password]": {
				required: true,
				minlength: 6,
			},
			"changeEmail[Confirm_Password]":{
				required: true,
				equalTo: "#changeEmail_Password"
		    },
		    "changeEmail[Confirm_Email]":{
				required: true,
				equalTo: "#changeEmail_Email"
			},
		},
		messages: {
		    "changeEmail[Email]": {
		        required:   "This field is required.",
		        email:      "Please enter a valid new e-mail address.",
		    },
		    "changeEmail[Password]": {
		      required:   "This field is required.",
		      minlength:  "Password must be at least 6 characters long.",
		    },
		    "changeEmail[Confirm_Password]":{
				required: "This field is required.",
				equalTo: "Password and confirm password must be same."
			},
			"changeEmail[Confirm_Email]":{
				required: "This field is required.",
				equalTo: "New e-mail and confirm e-mail must be same."
			},
		}
	});
	
	 jQuery.validator.addMethod("newEmail", 
		function(value, element, param) {

			if(value == $("#txtEmail").val()){
				return false;
			}
			return true;
		}, 
		"Current and new email are the same.  Please try again."
	);

});
</script>