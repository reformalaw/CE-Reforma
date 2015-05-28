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
  <form action="<?php echo url_for('thirdparty/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="thirdPartFrm" name="thirdPartFrm">
  <?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
  <table width="65%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
   <tr class="fldbg">
    <td colspan="2" class="whttxt">3rd Party Details</td>
   </tr>
   <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Name']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
        <?php echo $form['Name']->render() ?>
       <?php if ($form['Name']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Name']->getError()?></div>            
       <?php endif; ?>
     </td>
    </tr>
   <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Address1']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
        <?php echo $form['Address1']->render() ?>
       <?php if ($form['Address1']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Address1']->getError()?></div>            
       <?php endif; ?>
     </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Address2']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
        <?php echo $form['Address2']->render() ?>
       <?php if ($form['Address2']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Address2']->getError()?></div>            
       <?php endif; ?>
     </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['StateId']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
        <?php echo $form['StateId']->render(array('id'=>'statedrp','onchange'=>'countychange()','style'=>'width:337px;')) ?>
       <?php if ($form['StateId']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['StateId']->getError()?></div>            
       <?php endif; ?>
     </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['CountyId']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
        <?php echo $form['CountyId']->render(array('id'=>'countydrp','style'=>'width:337px;')) ?>
       <?php if ($form['CountyId']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['CountyId']->getError()?></div>            
       <?php endif; ?>
     </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['City']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
        <?php echo $form['City']->render() ?>
       <?php if ($form['City']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['City']->getError()?></div>            
       <?php endif; ?>
     </td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Zip']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
        <?php echo $form['Zip']->render() ?>
       <?php if ($form['Zip']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Zip']->getError()?></div>            
       <?php endif; ?>
     </td>
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
<script>
/* function for the change county according to state*/
function countychange(){
    var id= document.getElementById('statedrp').value;
    $.ajax({
            'dataType': 'html',
			'type': 'POST',
		    'url': '<?php echo url_for("thirdparty/getcounty"); ?>',
			'data': {snStateId:id},
            'success': function(data) {
                   $('#countydrp').html(data);
               }
        });
}

jQuery().ready(function() {
    
	// validate form on keyup and submit
	jQuery("#thirdPartFrm").validate({
		errorClass: "errormsgs",
		rules: {
		    "third_parties[Name]": {
				required: true,
				minlength: 3,
				maxlength: 45
			},
		    "third_parties[Address1]": {
				required: true,
				minlength: 3,
				maxlength: 45
			},
		    "third_parties[StateId]": {
				required: true
			},
		    "third_parties[CountyId]": {
				required: true
			},
		    "third_parties[City]": {
				required: true,
				minlength: 3,
				maxlength: 45
			},
		    "third_parties[Zip]": {
				required: true
			}
		},
		messages: {
		    "third_parties[Name]": {
		      required:   "This field is required.",
		      minlength:  "Third party name must be at least 3 characters long.",
		      maxlength:  "Third party Name cannot be longer than 45 characters."
		    },
		    "third_parties[Address1]": {
		      required:   "This field is required.",
		      minlength:  "Address 1 field must be at least 3 characters long.",
		      maxlength:  "Address 1 cannot be longer than 45 characters."
		    },
		    "third_parties[StateId]": {
		      required:   "This field is required."
		    },
		    "third_parties[CountyId]": {
		      required:   "This field is required."
		    },
		    "third_parties[City]": {
		      required:   "This field is required.",
		      minlength:  "City name must be at least 3 characters long.",
		      maxlength:  "City Name cannot be longer than 45 characters."
		    },
		    "third_parties[Zip]": {
		      required:   "This field is required."
		    }
		}
	});
});
</script>
