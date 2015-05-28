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


<form name="registrationFrm" id="registrationFrm" action="<?php echo url_for('registration/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> >
	<?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
	<table width="65%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
		<tr>
			<td>Registration Detail</td>
		</tr>

		<tr>
			<td valign="top"><b><?php echo $form['FirstName']->renderLabel() ?> :</b> <span class="error">*</span></td>
			<td>
				<?php echo $form['FirstName']->render() ?>
				<?php if ($form['FirstName']->hasError()): ?>
					<div class="errormsgs"><?php echo $form['FirstName']->getError()?></div>
				<?php endif; ?>
			</td>
		</tr>

		<tr>
			<td valign="top"><b><?php echo $form['LastName']->renderLabel() ?> :</b> <span class="error">*</span></td>
			<td>
				<?php echo $form['LastName']->render() ?>
				<?php if ($form['LastName']->hasError()): ?>
					<div class="errormsgs"><?php echo $form['LastName']->getError()?></div>
				<?php endif; ?>
			</td>
		</tr>

		<tr>
			<td valign="top"><b><?php echo $form['Email']->renderLabel() ?> :</b> <span class="error">*</span></td>
			<td>
				<?php echo $form['Email']->render() ?>
				<?php if ($form['Email']->hasError()): ?>
					<div class="errormsgs"><?php echo $form['Email']->getError()?></div>
				<?php endif; ?>
			</td>
		</tr>

		<tr>
			<td valign="top"><b><?php echo $form['StateId']->renderLabel() ?> :</b> <span class="error">*</span></td>
			<td>
				<?php echo $form['StateId']->render() ?>
				<?php if ($form['StateId']->hasError()): ?>
					<div class="errormsgs"><?php echo $form['StateId']->getError()?></div>
				<?php endif; ?>
			</td>
		</tr>

		<tr>
			<td valign="top"><b><?php echo $form['Username']->renderLabel() ?> :</b> <span class="error">*</span></td>
			<td>
				<?php echo $form['Username']->render() ?>
				<?php if ($form['Username']->hasError()): ?>
					<div class="errormsgs"><?php echo $form['Username']->getError()?></div>
				<?php endif; ?>
			</td>
		</tr>

		<tr>
			<td valign="top"><b><?php echo $form['Password']->renderLabel() ?> :</b> <span class="error">*</span></td>
			<td>
				<?php echo $form['Password']->render() ?>
				<?php if ($form['Password']->hasError()): ?>
					<div class="errormsgs"><?php echo $form['Password']->getError()?></div>
				<?php endif; ?>
			</td>
		</tr>
		
		<tr>
			<td>&nbsp;</td>
			<td>
				<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?>    
				<?php echo $form->renderHiddenFields(false) ?>
			</td>
		</tr>
		
	</table>
</form>


<script type="text/javascript">
jQuery().ready(function() {
    
	// validate form on keyup and submit
	jQuery("#registrationFrm").validate({
		errorClass: "errormsgs",
		rules: {
			"registration[FirstName]":{
				required: true,
				minlength: 2,
				maxlength: 45
			},
			"registration[LastName]":{
				required: true,
				minlength: 2,
				maxlength: 45
			},
			"registration[Email]":{
				required: true,
				email:true,
				maxlength: 70
			},
			"registration[StateId]":{
				required: true,
			},
			"registration[Username]": {
				required: true,
				minlength: 3,
				maxlength: 45
			},
		    "registration[Password]": {
				required: true,
				minlength: 6,
				maxlength: 45
			}
		},
		messages: {
			"registration[FirstName]": {
		      required:   "This field is required.",
		      minlength:  "First name  must be at least 2 characters long.",
		      maxlength:  "First name cannot be longer than 45 characters."
		    },
		    "registration[LastName]": {
		      required:   "This field is required.",
		      minlength:  "Last  name  must be at least 2 characters long.",
		      maxlength:  "Last name cannot be longer than 45 characters."
		    },
		    "registration[Email]": {
		      required:   "This field is required.",
		      email:      "Please enter valid e-mail address.",
		      maxlength:  "E-mail address cannot be longer than 70 characters."
		    },
		    "registration[StateId]": {
		      required:   "Please select State",
		    },
		    "registration[Username]": {
		      required:   "This field is required.",
		      minlength:  "User name  must be at least 3 characters long.",
              maxlength:  "User name cannot be longer than 45 characters."
		    },
		    "registration[Password]": {
		      required:   "This field is required.",
		      minlength:  "Password must be atleast 6 characters long.",
		      maxlength:  "Password cannot be longer than 45 characters."
		    }
		}
	});
});
</script>