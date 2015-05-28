	<?php use_helper('Tag') ?>
	<?php if($form['email']->hasError()) { ?>
		<tr>
			<td align="center">
				<p class="errormsg"><?php echo $form['email']->getError();?></p>
			</td>
		</tr>
	<?php
	}
	else if($sf_user->hasFlash('errormsg'))
	{ ?>
		<tr>
			<td align="center">
				<p class="errormsg"><?php echo $sf_user->getFlash('errormsg');?></p>
			</td>
		</tr>
	<?php }?>

	<?php if($sf_user->hasFlash('succMsg')) : ?>
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
	<?php else: ?>

			<?php echo form_tag('auth/forgot',array('name'=>'frmuserforgot','id'=>'frmuserforgot')); ?>
				<div class="topicforum forgotpassword">
					<h2>Forgot Password</h2>
					<ul>
						<li><?php echo $form['email']->renderLabel(); ?>
							<?php echo $form['email']->render(array('size' => '70', 'maxlength'=>'70')); ?>
						</li>
						<li><label>&nbsp;</label><?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Submit')); ?>&nbsp;<?php echo tag('input', array('name' => 'reset', 'type' => 'reset', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Cancel', 'onclick'=>'closeFancy();')); ?>&nbsp;</li>
					</ul>
				</div>
				<?php echo $form->renderHiddenFields(false) ?>
			</form>
						
	<?php endif; ?>


<script type="text/javascript">
jQuery().ready(function() {
	// validate form on keyup and submit
	jQuery("#frmuserforgot").validate({
		errorClass: "errormsgs",
		rules: {
			"forgot[email]":{
				required: true,
				email:true
			}
		},
		messages: {
		    "forgot[email]": {
		      required:   "This field is required.",
		      email:      "Please enter valid e-mail address."
		    }
		}
	});
});
</script>
<script type="text/javascript">

	function closeFancy()
	{
		setTimeout( function() {parent.jQuery.fancybox.close(); },1); 
	}
	
	<?php if($sf_user->hasFlash('succMsg')): ?>
		setTimeout("parent.jQuery.fancybox.close()",4000); 
	<?php endif; ?>
</script>