<?php use_helper('sfCryptoCaptcha');?>

	<h1>Customer Form</h1><br/>

<form action="<?php echo url_for('Forums/dynamicFormCreate') ?>" method="post"  name="dynamicform" id="dynamicform" enctype="multipart/form-data">	

	
	<table>
		<tr>
			<td>
			<?php echo $form; ?>
			</td>
		</tr>
		
		
	</table>
	
	<?php 	$userId = $sf_user->getAttribute('admin_user_id');
        	$elements = CustomerContactTable::getCustomersField($userId,'Captcha');
			if($elements){ ?>
				<div style="margin-top:6px;">
					<?php echo captcha_image(); ?>
					<span title="Click here to generate new code."><?php echo captcha_reload_button(); ?></span>
				</div>
    <?php } ?>
	
	<div style="margin-top:6px;">
		<input type="submit" name="submit" value="Send Message" class="bluButton">
	</div>

</form>