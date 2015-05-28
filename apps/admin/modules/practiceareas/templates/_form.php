<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

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
  <form action="<?php echo url_for('practiceareas/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="newPA" name="newPA">
  <?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
  <table width="65%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
   <tr class="fldbg">
    <td class="whttxt" colspan="2">Practice Areas Category Detail</td>
   </tr>
   <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['Name']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Name']->render(array('style'=>'width:450px;')) ?>
       <?php if ($form['Name']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Name']->getError()?></div>            
       <?php endif; ?></td>
    </tr>
   <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['ParentId']->renderLabel() ?> :</b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['ParentId']->render() ?>&nbsp;&nbsp;&nbsp;&nbsp;<span class="noteDisplay"><em>"Do not select category If you want to create parent."</em></span>
       <?php if ($form['ParentId']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['ParentId']->getError()?></div>            
       <?php endif; ?></td>
    </tr>
   <tr>
      <td width="26%" class="fldrowbg" valign="top"><b><?php echo $form['Description']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Description']->render() ?>
       <?php if ($form['Description']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Description']->getError()?></div>            
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
var tempId = '<?php echo $sf_request->getParameter("id"); ?>';
var temp = '<?php echo $form['ParentId']->getValue();?>';
var level = '<?php echo $sf_request->getParameter("level"); ?>';
//alert(level);
checkLevel(temp);
function checkLevel(value)
{
    var ddlArray= new Array();
    var ddl = document.getElementById('practiceareas_ParentId');
    for (i = 0; i < ddl.options.length; i++) {
        ddlArray[i] = ddl.options[i].value;
        var result = ddlArray[i].split("-");
        if(result[0] == value)
            ddl.options[i].selected = true;
        if(result[1] == 2){
            ddl.options[i].disabled = true;
        }
        if(result[0] == tempId){
            ddl.options[i].disabled = true;
        }
    }
}

jQuery().ready(function() {
    
	// validate form on keyup and submit
	jQuery("#newPA").validate({
		errorClass: "errormsgs",
		rules: {
		    "practiceareas[Name]": {
				required: true,
				minlength: 3,
				maxlength: 45
			},
			"practiceareas[Description]": {
				required: true
			},
		},
		messages: {
		    "practiceareas[Name]": {
		      required:   "This field is required.",
		      minlength:  "Practice area name must be at least 3 characters long.",
		      maxlength:  "Practice area name cannot be longer than 45 characters."
		    },
		    "practiceareas[Description]": {
		      required:   "This field is required.",
		    },
		}
	});
});
</script>