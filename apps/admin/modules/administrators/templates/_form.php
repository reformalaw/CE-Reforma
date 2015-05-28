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
 <td colspan="2" class="ListAreaPad">
  <form action="<?php echo url_for('administrators/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="adminRegistration" name="adminRegistration">
  <?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
  <table width="65%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
   <tr class="fldbg">
    <td class="whttxt" colspan="2">Staff Details</td>
   </tr>
   <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['FirstName']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['FirstName']->render() ?>
       <?php if ($form['FirstName']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['FirstName']->getError()?></div>            
       <?php endif; ?></td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['LastName']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['LastName']->render() ?>
       <?php if ($form['LastName']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['LastName']->getError()?></div>            
       <?php endif; ?></td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Email']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Email']->render() ?>
       <?php if ($form['Email']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Email']->getError()?></div>            
       <?php endif; ?></td>
    </tr>
    
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Confirm_Email']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Confirm_Email']->render() ?>
       <?php if ($form['Confirm_Email']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Confirm_Email']->getError()?></div>            
       <?php endif; ?></td>
    </tr>
    
    <!--<tr>
      <td width="26%" class="fldrowbg"><b><?php //echo $form['Username']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php //echo $form['Username']->render() ?>
       <?php //if ($form['Username']->hasError()): ?>            
            <div class="errormsgs"><?php //echo $form['Username']->getError()?></div>            
       <?php //endif; ?></td>
    </tr>-->
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Password']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Password']->render() ?>
       <?php if ($form['Password']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Password']->getError()?></div>            
       <?php endif; ?></td>
    </tr>
    
     <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Confirm_Password']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Confirm_Password']->render() ?>
       <?php if ($form['Confirm_Password']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Confirm_Password']->getError()?></div>            
       <?php endif; ?></td>
    </tr>
    
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Address1']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Address1']->render() ?>
       <?php if ($form['Address1']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Address1']->getError()?></div>            
       <?php endif; ?></td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Address2']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Address2']->render() ?>
       <?php if ($form['Address2']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Address2']->getError()?></div>            
       <?php endif; ?></td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Phone']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Phone']->render() ?>
		<br><span class="noteDisplay"><strong style="float: left;"> Ex:&nbsp;&nbsp; </strong><?php echo sfConfig::get('app_Phone_Note'); ?></span></br>
       <?php if ($form['Phone']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Phone']->getError()?></div>            
       <?php endif; ?></td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['selectAll']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['selectAll']->render(array('id'=>'selectall')) ?>
       <?php if ($form['selectAll']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['selectAll']->getError()?></div>            
       <?php endif; ?></td>
    </tr>
    <tr id="permissionsdiv">
      <td width="26%" class="fldrowbg"></td>
      <td width="68%" class="fldrowlightbg">
       <dd style="height:225px;margin-left:0px;" name="admin_users[Roles]"><div class="treeMenu" style="width:350px;"><?php echo $form['Roles']->render(array('class'=>'case','style'=>'vertical-align:middle;')); ?></div></dd>
       <?php if ($form['Roles']->hasError()): ?>            
            <div class="errormsgs" style="color: #FF0000;font-size: 11px;font-weight: bold;padding: 2px 0 0;"><?php echo $form['Roles']->getError()?></div>            
       <?php endif; ?></td>
    </tr>
    
   <tr class="fldbg">
    <td height="33" align="center" class="fldrowbg">&nbsp;</td>
    <td height="33" align="left" class="fldrowbg" colspan="2">
    <?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?>    
              <?php echo $form->renderHiddenFields(false) ?>
        </td>
   </tr>
  </table>
  </form>
 </td>
</tr>
<script type="text/javascript">
$(function(){
 
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
 
    });
});

jQuery().ready(function() {
    
	// validate form on keyup and submit
	jQuery("#adminRegistration").validate({
		errorClass: "errormsgs",
		rules: {
		    "admin_users[FirstName]": {
				required: true,
				minlength: 2,
				maxlength: 45
			},
			"admin_users[LastName]": {
				required: true,
				minlength: 2,
				maxlength: 45
			},
			"admin_users[Email]": {
				required: true,
				email: true,
				maxlength: 70
			},
			"admin_users[Username]": {
				required: true,
				minlength: 3,
				maxlength: 45
			},
			"admin_users[Password]": {
				required: true,
				minlength: 6,
				maxlength: 45
			},
			"admin_users[Address1]": {
				required: true,
				minlength: 3
			},
			"admin_users[Phone]": {
				required: true,
				phoneUS: true
			},
			"admin_users[Confirm_Password]":{
				required: true,
				equalTo: "#admin_users_Password"
		    },
		    "admin_users[Confirm_Email]":{
				required: true,
				equalTo: "#admin_users_Email"
			}
		},
		messages: {
		    "admin_users[FirstName]": {
		      required:   "This field is required.",
		      minlength:  "First name must be at least 2 characters long.",
		      maxlength:  "First name cannot be longer than 45 characters."
		    },
		    "admin_users[LastName]": {
		      required:   "This field is required.",
		      minlength:  "Last name must be at least 2 characters long.",
		      maxlength:  "Last name cannot be longer than 45 characters."
		    },
		    "admin_users[Email]": {
		      required:   "This field is required.",
		      email:      "Please enter valid email address.",
		      maxlength:  "E-mail address cannot be longer than 70 characters."
		    },
		    "admin_users[Username]": {
		      required:   "This field is required.",
		      minlength:  "User name must be at least 3 characters long.",
		      maxlength:  "User name cannot be longer than 45 characters."
		    },
		    "admin_users[Password]": {
		      required:   "This field is required.",
		      minlength:  "Password must be atleast 6 characters long",
		      maxlength:  "Password cannot be longer than 45 characters."
		    },
		    "admin_users[Address1]": {
		      required:   "This field is required.",
		      minlength:  "Address 1 field must be at least 3 characters long."
		    },
		    "admin_users[Phone]": {
				required: "This field is required.",
				phoneUS: "Please enter a valid 10 digit phone number."
			},
			"admin_users[Confirm_Password]":{
				required: "This field is required.",
				equalTo: "Password and confirm password must be same."
			},
			"admin_users[Confirm_Email]":{
				required: "This field is required.",
				equalTo: "E-mail and confirm e-mail must be same."
			}
		}
	});
});
</script>