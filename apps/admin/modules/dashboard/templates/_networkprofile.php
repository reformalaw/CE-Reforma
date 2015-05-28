
<?php include_partial('default/message'); ?>

<tr valign="top">
 <td colspan="2" class="ListAreaPad">
  <form action="<?php echo url_for('dashboard/networkprofile?customerId='.$sf_params->get("customerId")) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="networkProfileFrm" name="networkProfileFrm">
  <?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>

  <table width="97%" cellspacing="1" cellpadding="1" class="EditFAQ CaseEditForm" align="center">
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['FirmName']->renderLabel() ?>: </b><!--<span class="error">*</span>--></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['FirmName']->render() ?>
       <?php if ($form['FirmName']->hasError()): ?>
            <div class="errormsgs"><?php echo $form['FirmName']->getError()?></div>
       <?php endif; ?>
      </td>
    </tr>

    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Address1']->renderLabel() ?>: </b><span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Address1']->render() ?>
       <?php if ($form['Address1']->hasError()): ?>
            <div class="errormsgs"><?php echo $form['Address1']->getError()?></div>
       <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Address2']->renderLabel() ?>: </b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Address2']->render() ?>
       <?php if ($form['Address2']->hasError()): ?>
            <div class="errormsgs"><?php echo $form['Address2']->getError()?></div>
       <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['City']->renderLabel() ?>: </b><span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['City']->render() ?>
       <?php if ($form['City']->hasError()): ?>
            <div class="errormsgs"><?php echo $form['City']->getError()?></div>
       <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['StateId']->renderLabel() ?>: </b><span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['StateId']->render() ?>
       <?php if ($form['StateId']->hasError()): ?>
            <div class="errormsgs"><?php echo $form['StateId']->getError()?></div>
       <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Zip']->renderLabel() ?>: </td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Zip']->render() ?>
       <?php if ($form['Zip']->hasError()): ?>
            <div class="errormsgs"><?php echo $form['Zip']->getError()?></div>
       <?php endif; ?>
      </td>
    </tr>

    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Phone']->renderLabel() ?>: </b><span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Phone']->render() ?>
       <br><span class="noteDisplay"><strong style="float: left;"> Ex: </strong><?php echo sfConfig::get('app_Phone_Note'); ?></span></br>
       <?php if ($form['Phone']->hasError()): ?>
            <div class="errormsgs"><?php echo $form['Phone']->getError()?></div>
       <?php endif; ?>
      </td>
    </tr>
    
    <tr>
		<td colspan="2" width="26%" class="fldrowbg" valign="top"><b><?php echo $form['Summary']->renderLabel() ?>:</b> <span class="error">*</span></td>
    </tr>
    <tr>
      <td colspan="2" width="68%" class="fldrowlightbg">
       <?php echo $form['Summary']->render() ?>
       <?php if ($form['Summary']->hasError()): ?>            
            <div class="errormsgs" style="color: #FF0000;font-size: 11px;font-weight: bold;padding: 2px 0 0;"><?php echo $form['Summary']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>
    
    <!--<tr>
      <td width="26%" class="fldrowbg"><b><?php //echo $form['Summary']->renderLabel() ?>: </b><span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php //echo $form['Summary']->render() ?>
       <?php //if ($form['Summary']->hasError()): ?>
            <div class="errormsgs"><?php //echo $form['Summary']->getError()?></div>
       <?php //endif; ?>
      </td>
    </tr>-->
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['FeesInformation']->renderLabel() ?>: </b><span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['FeesInformation']->render() ?>
       <?php if ($form['FeesInformation']->hasError()): ?>
            <div class="errormsgs"><?php echo $form['FeesInformation']->getError()?></div>
       <?php endif; ?>
      </td>
    </tr>

    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['FreeConsultation']->renderLabel() ?>: </td>
      <td width="68%" class="netprofiletd">
		<?php if($form["FreeConsultation"]->getValue() == "Yes"): ?>
			<input id="networkprofile_FreeConsultation" type="checkbox" checked="checked" name="networkprofile[FreeConsultation]">
		<?php else:?>
			<input id="networkprofile_FreeConsultation" type="checkbox" name="networkprofile[FreeConsultation]">
		<?php endif; ?>
       <?php //echo $form['FreeConsultation']->render(array("checked"=>false)) ?>
       <?php if ($form['FreeConsultation']->hasError()): ?>
            <div class="errormsgs"><?php echo $form['FreeConsultation']->getError()?></div>
       <?php endif; ?>
      </td>
    </tr>
    
    <tr id="networkdiv">
      <td width="26%" class="fldrowbg" valign="top"><b><?php echo $form['Network']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowlightbg">
       <dd style="height:225px;"><div class="treeMenu"><?php echo $form['Network']; ?></div></dd>    
       <?php if ($form['Network']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Network']->getError()?></div>            
       <?php endif; ?>      </td>
    </tr>

    <tr id="locationdiv">
      <td width="26%" class="fldrowbg" valign="top"><b><?php echo $form['Location']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowlightbg">
       <dd style="height:225px;"><div class="treeMenu"><?php echo $form['Location']; ?></div></dd>    
       <?php if ($form['Location']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Location']->getError()?></div>            
       <?php endif; ?>      </td>
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
    jQuery("#networkProfileFrm").validate({
        errorClass: "errormsgs",
        rules: /*{
        "networkprofile[FirmName]": {
            required: true
        },*/
        {"networkprofile[Address1]": {
            required: true
        },
        "networkprofile[City]": {
            required: true
        },
        "networkprofile[StateId]": {
            required: true
        },
        "networkprofile[Phone]": {
            required: true,
            phoneUS: true
        },
        // 			"networkprofile[Summary]": {
        // 				required: true
        // 			},
        "networkprofile[FeesInformation]": {
            required: true
        }
        },
        messages: /*{
        "networkprofile[FirmName]": {
            required:   "This field is required."
        },*/
        {"networkprofile[Address1]": {
            required:   "This field is required."
        },
        "networkprofile[City]": {
            required:   "This field is required."
        },
        "networkprofile[StateId]": {
            required:   "This field is required."
        },
        "networkprofile[Phone]": {
            required:   "This field is required.",
            phoneUS: "Please enter a valid 10 digit phone number."
        },
        // 		    "networkprofile[Summary]": {
        // 				required:   "Please enter the Summary"
        // 		    },
        "networkprofile[FeesInformation]": {
            required:   "This field is required."
        }
        }
    });
});

$().ready(function() {
    $('#treeNetworkProfile').checkboxTree({ // For Practice Area
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
    
    $('#treeNetworkLocation').checkboxTree({ // For Practice Area Location
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