<?php
	$contactArray = $sf_data->getRaw("customerDatas"); /*this if condition is for when form is empty*/
	if(!empty($contactArray)): ?>

<form action="<?php echo url_for('contact/create') ?>" method="post"  name="dynamicform" id="dynamicform" enctype="multipart/form-data" onsubmit="return validateForm()">	
	<h2>Contact Us</h2>
        <div class="contact-form left">
          <p class="text">Fill out The following Information <span class="required" style="float:right; font-weight:normal; font-size:13px; color:#FF0000;">Note: * Required field</span></p>
          
		  	<ul>
			
			<?php 
				$dynamicClass = "";
				foreach($sf_data->getRaw("customerDatas") as $key => $customerData):
			?>

				<?php
						/* This condition is for dynamic class applay */
						if($customerData["FieldType"] == "Text"):
							$dynamicClass = "";
						elseif($customerData["FieldType"] == "DropDown"):
							$dynamicClass = "";
						elseif($customerData["FieldType"] == "CheckBox"):
							$dynamicClass = "contact-checkbox";
						elseif($customerData["FieldType"] == "Radio"):
							$dynamicClass = "contact-radio";
						elseif($customerData["FieldType"] == "TextArea"):
							$dynamicClass = "contact-message";
						elseif($customerData["FieldType"] == "FileUpload"):
							$dynamicClass = "";
						elseif($customerData["FieldType"] == "Captcha"):
							$dynamicClass = "";
						endif;
				?>

				<li class="<?php echo $dynamicClass; ?>">

				<?php $input = "input_".$customerData["Id"]."_".$customerData["UserId"];?>
				<?php $required = $customerData["Required"]; ?>

					<!--This is for Label-->
					<p style="font-weight:bold;"><?php echo $form[$input]->renderLabel() ?>
						<?php if( $required == "Yes"): ?><span class="required">*</span> <?php endif; ?>
					</p>

						<!--This is Render the Html Element-->
						<?php echo $form[$input]->render() ?>
						
						<!--This is for Captcha-->
						<?php if($customerData["FieldType"] == "Captcha"):?>
							<?php
									$elements = CustomerContactTable::getCustomersField($UserId,'Captcha');
									if($elements){ ?>
										<?php echo captcha_image(); ?>
										<span title="Click here to generate new code."><?php echo captcha_reload_button(); ?></span>
							<?php } ?>
						<?php endif; ?>

						<?php if ($form[$input]->hasError()): ?>

							<!--This Script is for give the focus of html element with red color-->
							<script type="text/javascript">
								<?php if($customerData["FieldType"] == "Captcha"): ?>
									alert("Please provide correct captcha.");
									$('#customer_<?php echo $input; ?>').css('border-color','red');
								<?php else: ?>
									$('#customer_<?php echo $input; ?>').css('border-color','red');
								<?php endif; ?>
							</script>

						<?php endif; ?>
				</li>
			<?php endforeach;?>
			<?php //echo $form; ?>

	
				<li class="contact-message">
					<input type="submit" name="submit" value="Send Message">
				</li>
			</ul>
        	</div>
     <?php echo $form->renderHiddenFields(false); ?>
</form>
<?php else: ?>
	<h2>Contact Us</h2>
<?php endif; /*END of empty form condition*/ ?>

<script type="text/javascript">

function validateForm() {
    var errorCount =0;
    '<?php foreach($sf_data->getRaw("customerDatas") as $key => $customerData):?>
				<?php $input = "input_".$customerData["Id"]."_".$customerData["UserId"];?>
				<?php $required = $customerData["Required"]; ?>'
				<?php if($required == "Yes"): ?>
					<?php if($customerData["FieldType"] == "Radio"): ?>
						<?php #$options = explode(',',$customerData["Options"]); ?>
						<?php $options = explode(',',$customerData["OptionsSlug"]); ?>
						var flag = false;
						<?php foreach($options as $option): ?>
						
							if ($('#customer_<?php echo $input."_".$option; ?>').is(":checked")) {
								flag = true;
							}
						<?php endforeach;?>
						if(flag == false)
						{
							alert("Please fill out all required fields."); // added by jaydip dodiya
							//alert("Please select <?php //echo $customerData["Label"]; ?>");  commented by jaydip dodiya
							$('#customer_<?php echo $input."_".$option; ?>').css('border','solid 1px red');
							$('#customer_<?php echo $input."_".$option; ?>').focus();
							errorCount++;
							return false;
						}
					<?php elseif($customerData["FieldType"] == "CheckBox"): ?>
						<?php #$chkOptions = explode(',',$customerData["Options"]); ?>
						<?php $chkOptions = explode(',',$customerData["OptionsSlug"]); ?>
						var flag = false;
						<?php foreach($chkOptions as $chkOption): ?>

							if ($('#customer_<?php echo $input."_".$chkOption; ?>').is(':checked')) {
								flag = true;
							}
						<?php endforeach;?>
						if(flag == false)
						{
							alert("Please fill out all required fields."); // added by jaydip dodiya
							//alert("Please select <?php //echo $customerData["Label"]; ?>");
							$('#customer_<?php echo $input."_".$chkOption; ?>').css('border','solid 1px red');
							$('#customer_<?php echo $input."_".$chkOption; ?>').focus();
							errorCount++;
							return false;
						}
					<?php else: ?>
						if(trim($('#customer_<?php echo $input; ?>').val()) == '') {
							alert("Please fill out all required fields."); // added by jaydip dodiya
							$('#customer_<?php echo $input; ?>').css('border','solid 1px red');
							$('#customer_<?php echo $input; ?>').focus();
							errorCount++;
							return false;
						} else {
							$('#customer_<?php echo $input; ?>').css('border','');
						}
					<?php endif; ?>
				<?php endif; ?>
	'<?php endforeach; ?>'

	if(errorCount > 0) {
        return false;
    }
    return true;
}
</script>