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
  <form action="<?php echo url_for('users/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="userRegistration" name="userRegistration">
  <?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
  <table width="65%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
   <tr class="fldbg">
    <td colspan="2" class="whttxt">Customers Details</td>
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
      <td width="26%" class="fldrowbg"><b><?php echo $form['MiddleName']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['MiddleName']->render() ?>
       <?php if ($form['MiddleName']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['MiddleName']->getError()?></div>            
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
   <?php if ($form->getObject()->isNew()){?>
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
   <?php } ?>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Address1']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Address1']->render() ?>
       <?php if ($form['Address1']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Address1']->getError()?></div>            
       <?php endif; ?></td>
   </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Address2']->renderLabel() ?> :</b> </td>
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
      <td width="26%" class="fldrowbg"><b><?php echo $form['City']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['City']->render() ?>
       <?php if ($form['City']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['City']->getError()?></div>            
       <?php endif; ?></td>
   </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['StateId']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['StateId']->render(array('style'=>'width: 460px;')) ?>
       <?php if ($form['StateId']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['StateId']->getError()?></div>            
       <?php endif; ?></td>
   </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Zip']->renderLabel() ?> :</b> </td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Zip']->render() ?>
       <?php if ($form['Zip']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Zip']->getError()?></div>            
       <?php endif; ?></td>
   </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "Subscribe For ";?>:</b> </td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['BillingSubscription']->renderLabel();?>
       <?php echo $form['BillingSubscription']->render(array('style'=>'vertical-align:middle')) ?>
       <?php if ($form['BillingSubscription']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['BillingSubscription']->getError()?></div>            
       <?php endif; ?>
       &nbsp;


       <?php echo $form['WebsiteSubscriotion']->renderLabel() ?>
       <?php echo $form['WebsiteSubscriotion']->render(array('onClick'=>'generateRow(this.value,this.id)','style'=>'vertical-align:middle')) ?>
       <?php if ($form['WebsiteSubscriotion']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['WebsiteSubscriotion']->getError()?></div>            
       <?php endif; ?>
       &nbsp;


       <?php echo $form['NetworkProfileSubscription']->renderLabel() ?>
       <?php echo $form['NetworkProfileSubscription']->render(array('onClick'=>'generateSelectArea(this.value,this.id)','style'=>'vertical-align:middle')) ?>
       <?php if ($form['NetworkProfileSubscription']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['NetworkProfileSubscription']->getError()?></div>            
       <?php endif; ?>
      </td>
   </tr>

    <?php 
    $tempVal = "display:none;";
    $tempVal2 = "display:none;";
    $tempDisp = "display:none;";
    if ($sf_request->getParameter('js_id')) {
        $tempVal = "";
    }
    if ($form->getObject()->isNew() && sfContext::getInstance()->getActionName() != "create") {
        $webTem = null;
        $netWork = null;
        $weburlTem = null;
        $webUrl2 = null;
    }
    if ($webTem == 'Yes') {
        $tempVal = "";
    }
    if ($netWork == 'Yes') {
        $tempVal2 = "";
    }
    if ($displayWebBox == 1) {
        $tempVal = "";
    }?>
    <tr id="weburldiv" style="<?php echo $tempVal; ?>">
      <td width="26%" class="fldrowbg"><b><?php echo $form['Weburl']->renderLabel() ?> :</b> </td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Weburl']->render(array('style'=>'width:305px;','value'=>$weburlTem,'onblur'=>'return checkUrl(this.value)')) ?>&nbsp;<span class="noteDisplay" id="mesg">(<b>Ex :</b>&nbsp;www.counseledge.com)</span>
       <?php if ($form['Weburl']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Weburl']->getError()?></div>            
       <?php endif; ?></td>
   </tr>
    <tr id="networkdiv" style="<?php echo $tempVal2; ?>">
      <td width="26%" class="fldrowbg" valign="top"><b><?php echo $form['Network']->renderLabel() ?> :</b> </td>
      <td width="68%" class="fldrowlightbg">
       <dd style="height:225px;">
       <div class="treeMenu" style="width:295px">
		<?php echo $form['Network']; ?>
       </div>
       </dd> 
       <?php //echo $form['PriorityListing']->render(); ?>
       <?php if ($form['Network']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Network']->getError()?></div>            
       <?php endif; ?></td>
   </tr>

	<tr id="priorityTr" style="<?php echo $tempVal2; ?>">
      <td width="26%" class="fldrowbg"><b><?php echo $form['PriorityListing']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['PriorityListing']->render() ?>
       <?php if ($form['PriorityListing']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['PriorityListing']->getError()?></div>            
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
function generateRow(value,id) {
    if(value == "on"){
        if($('#'+id).is(':checked') == true){
            $('#weburldiv').show();
        }else{
            $('#weburldiv').hide();
        }
    }else{

    }
}
function generateSelectArea(value,id) {
    if(value == "on"){
        if($('#'+id).is(':checked') == true){
            $('#networkdiv').show();
            $('#priorityTr').show();
            $('#admin_users_customers_PriorityListing_No').attr("checked", "checked");
        }else{
            $('#networkdiv').hide();
            $('#priorityTr').hide();
            $('#admin_users_customers_PriorityListing_No').attr("checked", false);
        }
    }else{

    }
}

function checkUrl(value)
{
    var pattern = /^(www.[a-zA-Z0-9].)[a-zA-Z0-9\-\.]+\.[a-zA-Z]*$/i ;
    if(!pattern.test(value)){
        $('#mesg').css('color','red');
        $('#admin_users_customers_Weburl').val('');
        return false;
    }else{
        $('#mesg').css('color','');
        return true;
    }
}

jQuery().ready(function() {

    // validate form on keyup and submit
    jQuery("#userRegistration").validate({
        errorClass: "errormsgs",
        rules: {
        "admin_users_customers[FirstName]": {
            required: true,
            minlength: 2,
            maxlength: 45
        },
        "admin_users_customers[MiddleName]": {
            required: false,
            minlength: 2,
            maxlength: 45
        },

        "admin_users_customers[LastName]": {
            required: true,
            minlength: 2,
            maxlength: 45
        },
        "admin_users_customers[Email]": {
            required: true,
            email: true,
            maxlength: 70
        },
        "admin_users_customers[Username]": {
            required: true,
            minlength: 3,
            maxlength: 45
        },
        "admin_users_customers[Password]": {
            required: true,
            minlength: 6,
            maxlength: 45
        },
        "admin_users_customers[Address1]": {
            required: true,
            minlength: 3,
            maxlength: 45
        },
        "admin_users_customers[Phone]": {
            required: true,
            phoneUS: true
        },
        "admin_users_customers[City]": {
            required: true,
            minlength: 3,
            maxlength: 45
        },
        "admin_users_customers[StateId]": {
            required: true
        },
		"admin_users_customers[Confirm_Password]":{
			required: true,
			equalTo: "#admin_users_customers_Password"
		},
		"admin_users_customers[Confirm_Email]":{
			required: true,
			equalTo: "#admin_users_customers_Email"
		}
        },
        messages: {
        "admin_users_customers[FirstName]": {
            required:   "This field is required.",
            minlength:  "First name  must be at least 2 characters long.",
            maxlength:  "First name cannot be longer than 45 characters."
        },
        "admin_users_customers[LastName]": {
            required:   "This field is required.",
            minlength:  "Last  name  must be at least 2 characters long.",
            maxlength:  "Last name cannot be longer than 45 characters."
        },
        "admin_users_customers[Email]": {
            required:   "This field is required.",
            email:      "Please enter valid e-mail address.",
            maxlength:  "E-mail address cannot be longer than 70 characters."
        },
        "admin_users_customers[Username]": {
            required:   "This field is required.",
            minlength:  "User name  must be at least 3 characters long.",
            maxlength:  "User name cannot be longer than 45 characters."
        },
        "admin_users_customers[Password]": {
            required:   "This field is required.",
            minlength:  "Password must be atleast 6 characters long",
            maxlength:  "Password cannot be longer than 45 characters."
        },
        "admin_users_customers[Address1]": {
            required:   "This field is required.",
            minlength:  "Address 1 field must be at least 3 characters long.",
            maxlength:  "Address 1 cannot be longer than 45 characters."
        },
        "admin_users_customers[Phone]": {
            required: "This field is required.",
            phoneUS: "Please enter a valid 10 digit phone number."
        },
        "admin_users_customers[City]": {
            required:   "This field is required.",
            minlength:  "City must be atleast 3 characters long",
            maxlength:  "City cannot be longer than 45 characters."
        },
        "admin_users_customers[StateId]": {
            required:   "This field is required.s"
        },
        "admin_users_customers[Confirm_Password]":{
			required: "This field is required.",
			equalTo: "Password and confirm password must be same."
		},
		"admin_users_customers[Confirm_Email]":{
			required: "This field is required.",
			equalTo: "E-mail and confirm e-mail must be same."
		}
        }
    });
});

$().ready(function() {
    $('#treeNetworkProfile').checkboxTree({
        onCheck: {
            ancestors: 'checkIfFull',
            descendants: 'check'
        },
        onUncheck: {
            ancestors: 'uncheck'
        },
        collapseImage: '<?php echo image_path('check-Minus.gif')?>',
        expandImage: '<?php echo image_path('check-Plus.gif')?>'
    });
});
</script>