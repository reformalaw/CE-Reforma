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

		<form action="<?php echo url_for('registration/myprofile') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="lgMyProfileFrm" name="lgMyProfileFrm">
			<?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
 
			<ul>
				<li><label>Email:</label><?php echo $ssEmail; ?></li>
				<li>&nbsp;</li>
				<!--<li><label>User Name :</label> <?php //echo $ssUsername; ?></li>-->
				<li style="clear:both;"><?php echo $form['FirstName']->renderLabel(); ?>
						<?php echo $form['FirstName']->render() ?>
						<?php if ($form['FirstName']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['FirstName']->getError()?></div>
						<?php endif; ?>
				</li>
				<li><?php echo $form['LastName']->renderLabel() ?>
						<?php echo $form['LastName']->render() ?>
						<?php if ($form['LastName']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['LastName']->getError()?></div>
						<?php endif; ?>
				</li>
				<li><?php echo $form['StateId']->renderLabel() ?>
						<?php echo $form['StateId']->render() ?>
						<?php if ($form['StateId']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['StateId']->getError()?></div>
						<?php endif; ?>
                  </li>
				<li><?php echo $form['ProfilePic']->renderLabel() ?>
						<?php echo $form['ProfilePic']->render() ?>
						<?php if ($form['ProfilePic']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['ProfilePic']->getError()?></div>
						<?php endif; ?>
				</li>
				<li><label>Image Preview :</label> 
						<?php
							if($viewImageName != "")
							{
								if(file_exists(sfConfig::get('sf_upload_dir')."/userpic/".$snId."/"."medium_".$viewImageName))
									echo image_tag('../uploads/userpic/'.$snId."/"."medium_".$viewImageName,array('border'=>'0','alt'=>'Image','title'=>$viewImageName,'width'=>'75px','height'=>'75px'));
								else
									echo image_tag('legalgrip/noImage.jpeg',array('border'=>'0','alt'=>'Image','title'=>"noImage",'width'=>'75px','height'=>'75px'));
							}
							else
							{
								echo image_tag('legalgrip/noImage.jpeg',array('border'=>'0','alt'=>'Image','title'=>"noImage",'width'=>'75px','height'=>'75px'));
							}
						?>
				</li>
				<li class="changepassword"><label>Change Password</label></li>
				<li><?php echo $form['Password']->renderLabel() ?>
						<?php echo $form['Password']->render() ?>
						<?php if ($form['Password']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['Password']->getError()?></div>
						<?php endif; ?>
				</li>
				<li style="clear:both;"><?php echo $form['New_Password']->renderLabel() ?>
					<?php echo $form['New_Password']->render() ?>
				</li>
				<li><?php echo $form['Confirm_Password']->renderLabel() ?>
						<?php echo $form['Confirm_Password']->render() ?>
						<?php if ($form['Confirm_Password']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['Confirm_Password']->getError()?></div>
						<?php endif; ?>
				</li>
				<li class="save-register">
					<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?>    
					<?php echo $form->renderHiddenFields(false) ?>
					<!--<input id="submit" class="bluButton" type="submit" value="Save" name="submit">-->
				</li>
			</ul>
		</form>

<script type="text/javascript">
jQuery().ready(function() {
    
	// validate form on keyup and submit
	jQuery("#lgMyProfileFrm").validate({
		errorClass: "errormsgs",
		rules: {
		    "lgmyprofile[FirstName]": {
				required: true,
				minlength: 2,
				maxlength: 45
			},
		    "lgmyprofile[LastName]": {
				required: true,
				minlength: 2,
				maxlength: 45
			},
			"lgmyprofile[StateId]": {
				required: true
			},
			"lgmyprofile[New_Password]":{
				required: function(){

				    if( jQuery.trim(jQuery("#lgmyprofile_Password").val()) != ""){
				        return true;   
				    }else{
				        return false;   
				    }

				},
				minlength: 6
		    },
		    "lgmyprofile[Confirm_Password]":{
				required: false,
				equalTo: "#lgmyprofile_New_Password"
		    }
		},
		messages: {
		    "lgmyprofile[FirstName]": {
		      required:   "This field is required.",
		      minlength:  "First name  must be at least 2 characters long.",
		      maxlength:  "First name cannot be longer than 45 characters."
		    },
		    "lgmyprofile[LastName]": {
		      required:   "This field is required.",
		      minlength:  "Last  name  must be at least 2 characters long.",
		      maxlength:  "Last name cannot be longer than 45 characters."
		    },
		    "lgmyprofile[StateId]": {
		      required:   "Please Select the State"
		    },
		    "lgmyprofile[New_Password]":{
				required: "This field is required.",
				minlength: "New password must be atleast 6 characters long."
		    },
		    "lgmyprofile[Confirm_Password]":{
				required: "This field is required.",
				equalTo: "New and confirm password must be same."
			}
		}
	});
});
</script>