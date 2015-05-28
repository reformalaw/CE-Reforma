<?php use_helper('sfCryptoCaptcha');?>
<?php use_helper('Tag'); ?>

			<section>
				<div class="middle-inner">
					<div class="page">
						<div class="loginregister">
							<div class="inner-box-title"></div>
							<?php include_partial('default/message'); ?> <!-- message-->
							<div class="errormsgPosition">
								<p class="errormsg">
									<?php
											if($frmLogin['email']->hasError())
											{
												echo $frmLogin['email']->getError();
											}
											else if($frmLogin['password']->hasError())
											{
												echo $frmLogin['password']->getError();
											}
// 											else if($sf_user->hasFlash('errorMessage'))
// 											{
// 												echo $sf_user->getFlash('errorMessage');
// 											}
									?>
								</p>
							</div>
							<?php echo form_tag('auth/createLogin',array('name'=>'frmuserlogin','id'=>'frmuserlogin','multipart'=>true)); ?>
							<div class="login">
								<h2>User Login</h2>
								<ul>
									<li><label>Email :</label>
										<?php echo $frmLogin['email'] ?>
									</li>
									<li><label>Password :</label>
										<?php echo $frmLogin['password'] ?>
									</li>
									<li><label>&nbsp;</label>
										<a  onclick="popupForgotPassword();" href="javascript:void(0);">Forgot Password ?</a>
									</li>
									<li><label>&nbsp;</label>
										<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'bluButton', 'value' => 'Login')); ?>
										<?php if ($frmLogin->isCSRFProtected()) : ?><?php echo $frmLogin['_csrf_token'] ?><?php endif; ?>
									</li>
								</ul>
							</div>
							</form>
							<form name="registrationFrm" id="registrationFrm" action="<?php echo url_for('registration/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> >
							<?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
							<div class="login register">
								<h2>Register</h2>
								<ul>
									<li><?php echo $form['FirstName']->renderLabel(); ?>
										<?php echo $form['FirstName']->render() ?>
										<?php if ($form['FirstName']->hasError()): ?>
											<div class="errormsgs"><?php echo $form['FirstName']->getError()?></div>
										<?php endif; ?>
									</li>
									<li><?php echo $form['LastName']->renderLabel(); ?>
										<?php echo $form['LastName']->render() ?>
										<?php if ($form['LastName']->hasError()): ?>
											<div class="errormsgs"><?php echo $form['LastName']->getError()?></div>
										<?php endif; ?>
									</li>
									
									<li><?php echo $form['Email']->renderLabel(); ?>
										<?php echo $form['Email']->render() ?>
										<?php if ($form['Email']->hasError()): ?>
											<div class="errormsgs"><?php echo $form['Email']->getError()?></div>
										<?php endif; ?>
									</li>
									
									<li><?php echo $form['Confirm_Email']->renderLabel(); ?>
										<?php echo $form['Confirm_Email']->render() ?>
										<?php if ($form['Confirm_Email']->hasError()): ?>
											<div class="errormsgs"><?php echo $form['Confirm_Email']->getError()?></div>
										<?php endif; ?>
									</li>
									
									<li><?php echo $form['StateId']->renderLabel(); ?>
										<?php echo $form['StateId']->render() ?>
										<?php if ($form['StateId']->hasError()): ?>
											<div class="errormsgs"><?php echo $form['StateId']->getError()?></div>
										<?php endif; ?>
									</li>
									<?php /*
									<li><?php echo $form['Username']->renderLabel(); ?>
										<?php echo $form['Username']->render() ?>
										<?php if ($form['Username']->hasError()): ?>
											<div class="errormsgs"><?php echo $form['Username']->getError()?></div>
										<?php endif; ?>
									</li> */  ?>
									<li><?php echo $form['Password']->renderLabel(); ?>
										<?php echo $form['Password']->render() ?>
										<?php if ($form['Password']->hasError()): ?>
											<div class="errormsgs"><?php echo $form['Password']->getError()?></div>
										<?php endif; ?>
									</li>
									
									<li><?php echo $form['Confirm_Password']->renderLabel(); ?>
										<?php echo $form['Confirm_Password']->render() ?>
										<?php if ($form['Confirm_Password']->hasError()): ?>
											<div class="errormsgs"><?php echo $form['Confirm_Password']->getError()?></div>
										<?php endif; ?>
									</li>

									<li><?php echo $form['Captcha']->renderLabel(); ?>
										<?php echo $form['Captcha']->render() ?>
										<?php if ($form['Captcha']->hasError()): ?>
											<div class="errormsgs"><?php echo $form['Captcha']->getError()?></div>
										<?php endif; ?>
									</li>

									<li style="float: left;margin: 0 10px 0 100px;">
										<?php echo captcha_image(); ?>
										<span title="Click here to generate new code."><?php echo captcha_reload_button(); ?></span>
									</li>
									<li><label>&nbsp;</label>
										<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?>
								</ul>
							</div>
							<?php echo $form->renderHiddenFields(false) ?>
							</form>
						</div>
					</div>
				</div>
			</section>


<script type="text/javascript">
jQuery().ready(function() {

	// validate form on keyup and submit
	jQuery("#frmuserlogin").validate({
		errorClass: "errormsgs",
		rules: {
			"login[email]":{
				required: true,
				email:true
			},
		    "login[password]": {
				required: true,
				minlength: 6,
				maxlength: 45
			}
		},
		messages: {
		    "login[email]": {
		      required:   "This field is required.",
		      email:      "Please enter valid e-mail address."
		    },
		    "login[password]": {
		      required:   "This field is required.",
		      minlength:  "Password must be atleast 6 characters long.",
		      maxlength:  "Password cannot be longer than 45 characters."
		    }
		}
	});
	
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
			},
			"registration[Confirm_Password]":{
				required: true,
				equalTo: "#registration_Password"
		    },
		    "registration[Confirm_Email]":{
				required: true,
				equalTo: "#registration_Email"
			},
			"registration[Captcha]":{
				required: true,
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
		      required:   "This field is required.",
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
		    },
		    "registration[Confirm_Password]":{
				required: "This field is required.",
				equalTo: "Password and confirm password must be same."
			},
			"registration[Confirm_Email]":{
				required: "This field is required.",
				equalTo: "E-mail and confirm e-mail must be same."
			},
			"registration[Captcha]":{
				required: "This field is required.",
			}
		}
	});
});
</script>

<script type="text/javascript">
function popupForgotPassword() {

			$.fancybox.open({
				href : "<?php echo url_for('auth/forgot')?>",
				type : 'iframe',
				padding : 5,
				minHeight: 200,
        		minWidth: 400
			});

	}
</script>