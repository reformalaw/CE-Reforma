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
  <form action="<?php echo url_for('dashboard/myprofile?customerId='.$snId) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="myProfileFrm" name="myProfileFrm">
  <?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
 
  <table width="97%" cellspacing="1" cellpadding="1" class="EditFAQ CaseEditForm" align="center">
   <!--<tr class="fldbg">
    <td colspan="2" class="whttxt">My Details</td>
    </tr>-->
     <tr>
      <!--<td align="center" class="fldrowbg error"></td>-->
      <td width="26%" class="fldrowbg"><b><?php echo "Email"; ?>: </b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $ssEmail; ?>
      </td>
    </tr>
    
    <?php /*
     <tr>
      <!--<td align="center" class="fldrowbg error"></td>-->
      <td width="26%" class="fldrowbg"><b><?php echo "UserName" ?>: </b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $ssUsername; ?>
      </td>
    </tr>
*/ ?>
    <tr>
      <!--<td align="center" class="fldrowbg error">*</td>-->
      <td width="26%" class="fldrowbg"><b><?php echo $form['FirstName']->renderLabel() ?>: </b><span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['FirstName']->render() ?>
       <?php if ($form['FirstName']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['FirstName']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>

    <tr>
      <!--<td align="center" class="fldrowbg error">*</td>-->
      <td width="26%" class="fldrowbg"><b><?php echo $form['LastName']->renderLabel() ?>: </b><span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['LastName']->render() ?>
       <?php if ($form['LastName']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['LastName']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>
    <tr>
      <!--<td align="center" class="fldrowbg error">*</td>-->
      <td width="26%" class="fldrowbg"><b><?php echo $form['Address1']->renderLabel() ?>: </b><span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Address1']->render() ?>
       <?php if ($form['Address1']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Address1']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>
    <tr>
      <!--<td align="center" class="fldrowbg error"></td>-->
      <td width="26%" class="fldrowbg"><b><?php echo $form['Address2']->renderLabel() ?>: </b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Address2']->render() ?>
       <?php if ($form['Address2']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Address2']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>
    <tr>
      <!--<td align="center" class="fldrowbg error">*</td>-->
      <td width="26%" class="fldrowbg"><b><?php echo $form['Phone']->renderLabel() ?>: </b><span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Phone']->render() ?>
       <br><span class="noteDisplay"><strong style="float: left;"> Ex:&nbsp;&nbsp; </strong><?php echo sfConfig::get('app_Phone_Note'); ?></span></br>
       <?php if ($form['Phone']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Phone']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>
    <tr>
      <!--<td align="center" class="fldrowbg error">*</td>-->
      <td width="26%" class="fldrowbg"><b><?php echo $form['City']->renderLabel() ?>: </b><span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['City']->render() ?>
       <?php if ($form['City']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['City']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>
    <tr>
      <!--<td align="center" class="fldrowbg error">*</td>-->
      <td width="26%" class="fldrowbg"><b><?php echo $form['StateId']->renderLabel() ?>: </b><span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['StateId']->render() ?>
       <?php if ($form['StateId']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['StateId']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>
    <tr>
      <!--<td align="center" class="fldrowbg error">*</td>-->
      <td width="26%" class="fldrowbg"><b><?php echo $form['Zip']->renderLabel() ?>: </td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Zip']->render() ?>
       <?php if ($form['Zip']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Zip']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>

    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['ProfilePic']->renderLabel() ?>: </td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['ProfilePic']->render() ?>
       <?php if ($form['ProfilePic']->hasError()): ?>
            <div class="errormsgs"><?php echo $form['ProfilePic']->getError()?></div>
       <?php endif; ?>
      </td>
    </tr>

    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "Profile Preview" ?>: </td>
      <td width="68%" class="fldrowlightbg">
       <?php
			$imagePath = clsCommon::userProfileImage($snId, "medium");
			echo image_tag($imagePath['path'],array('border'=>'0','alt'=>'Image','title'=>$imagePath['title'],'width'=>'75px','height'=>'75px'));
// 				if($viewImageName != "")
// 				{
// 					if(file_exists(sfConfig::get('sf_upload_dir')."/userpic/".$snId."/"."mediam_".$viewImageName))
// 						echo image_tag('../uploads/userpic/'.$snId."/"."mediam_".$viewImageName,array('border'=>'0','alt'=>'Image','title'=>$viewImageName,'width'=>'75px','height'=>'75px'));
// 					else
// 						echo image_tag('user-noImage/mediam_noImage.png',array('border'=>'0','alt'=>'Image','title'=>"noImage",'width'=>'75px','height'=>'75px'));
// 				}
// 				else
// 				{
// 					echo image_tag('user-noImage/mediam_noImage.png',array('border'=>'0','alt'=>'Image','title'=>"noImage",'width'=>'75px','height'=>'75px'));
// 				}
		?>

      </td>
    </tr>

    <?php /*
     <tr class="fldbg">
            <td colspan="2" class="whttxt">Change Password: </td>
    </tr>
    <tr>
      <!--<td align="center" class="fldrowbg error"></td>-->
      <td width="26%" class="fldrowbg"><b><?php echo $form['Password']->renderLabel() ?>: </b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Password']->render() ?>
       <?php if ($form['Password']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Password']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>
    <tr>
      <!--<td align="center" class="fldrowbg error"></td>-->
      <td width="26%" class="fldrowbg"><b><?php echo $form['New_Password']->renderLabel() ?>: </b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['New_Password']->render() ?>      
      </td>
    </tr>
    <tr>
      <!--<td align="center" class="fldrowbg error"></td>-->
      <td width="26%" class="fldrowbg"><b><?php echo $form['Confirm_Password']->renderLabel() ?>: </b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Confirm_Password']->render() ?>
       <?php if ($form['Confirm_Password']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Confirm_Password']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>
    */ ?>

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
   <tr><td height="5"></td></tr>
<script type="text/javascript">
jQuery().ready(function() {

	// validate form on keyup and submit
	jQuery("#myProfileFrm").validate({
		errorClass: "errormsgs",
		rules: {
		    "myprofile[FirstName]": {
				required: true,
				minlength: 2,
				maxlength: 45
			},
		    "myprofile[LastName]": {
				required: true,
				minlength: 2,
				maxlength: 45
			},
		    "myprofile[Address1]": {
				required: true,
				minlength: 3,
				maxlength: 45
			},
			"myprofile[Phone]": {
				required: true,
				phoneUS: true
			},
			"myprofile[City]": {
				required: true,
				minlength: 3,
				maxlength: 45
			},
			"myprofile[StateId]": {
				required: true
			},
		},
		messages: {
		    "myprofile[FirstName]": {
		      required:   "This field is required.",
		      minlength:  "First name must be at least 2 characters long.",
		      maxlength:  "First name cannot be longer than 45 characters."
		    },
		    "myprofile[LastName]": {
		      required:   "This field is required.",
		      minlength:  "Last name must be at least 2 characters long.",
		      maxlength:  "Last name cannot be longer than 45 characters."
		    },
		    "myprofile[Address1]": {
		      required:   "This field is required.",
		      minlength:  "Address 1 field must be at least 3 characters long.",
		      maxlength:  "Address 1 cannot be longer than 45 characters."
		    },
		    "myprofile[Phone]": {
				required: "This field is required.",
				phoneUS: "Please enter a valid 10 digit phone number."
			},
		    "myprofile[City]": {
		      required:   "This field is required.",
		      minlength:  "City name must be at least 3 characters long. ",
		      maxlength:  "City name cannot be longer than 45 characters."
		    },
		    "myprofile[StateId]": {
		      required:   "This field is required."
		    }
		}
	});
});
</script>