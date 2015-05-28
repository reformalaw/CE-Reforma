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
  <form action="<?php echo url_for('administrators/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="editRegistration" name="editRegistration">
  <?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
  <table width="65%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
    <tr class="fldbg">
        <td class="whttxt" colspan="2">Staff Details</td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "Email "; ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg"><?php echo $ssEmail; ?></td>
    </tr>
    <!--<tr>
      <td width="26%" class="fldrowbg"><b><?php //echo 'User Name '; ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg"><?php //echo $ssUserName; ?></td>
    </tr>-->
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
       <dd style="height:225px;margin-left:0px;"><div class="treeMenu" style="width:350px;"><?php echo $form['Roles']->render(array('class'=>'case')); ?></div></dd>
       <?php if ($form['Roles']->hasError()): ?>            
            <div class="errormsgs" style="color: #FF0000;font-size: 11px;font-weight: bold;padding: 2px 0 0;"><?php echo $form['Roles']->getError()?></div>            
       <?php endif; ?></td>
    </tr>
   <tr class="fldbg">
    <td height="33" align="center" class="fldrowbg error">&nbsp;</td>
    <td class="fldrowbg" colspan="2" align="left">
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
	jQuery("#editRegistration").validate({
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
			"admin_users[Address1]": {
				required: true,
				minlength: 3
			},
			"admin_users[Phone]": {
				required: true,
				phoneUS: true
			}
		},
		messages: {
		    "admin_users[FirstName]": {
				required:   "This field is required.",
				minlength:  "First name  must be at least 2 characters long.",
				maxlength:  "First name cannot be longer than 45 characters."
		    },
		    "admin_users[LastName]": {
				required:   "This field is required.",
				minlength:  "Last  name  must be at least 2 characters long.",
				maxlength:  "Last name cannot be longer than 45 characters."
		    },
		    "admin_users[Address1]": {
				required:   "This field is required.",
				minlength:  "Address 1 field must be at least 3 characters long."
		    },
		    "admin_users[Phone]": {
				required:   "This field is required.",
				phoneUS: "Please enter a valid 10 digit phone number."
			}
		}
	});
});
</script>