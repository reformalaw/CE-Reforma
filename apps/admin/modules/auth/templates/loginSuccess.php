<?php use_helper('Tag') ?>
<table cellspacing="0" cellpadding="0" class="loginPage" border="0" width="100%">
	<tr>
    	<td align="center" valign="top">
        	<table cellspacing="0" cellpadding="0" border="0" width="100%">
            	<tr>
					<?php if($sf_user->hasFlash('succMsg')): ?>
                    <td class="success" align="center"><?php echo $sf_user->getFlash('succMsg'); ?></td>
                    <?php endif; ?>
                    
                    <?php if($sf_user->hasFlash('success')): ?>
                    <td class="success" align="center"><?php echo $sf_user->getFlash('success'); ?></td>
                    <?php elseif($sf_user->hasFlash('error')): ?>
                    <td class="errormss" align="center"><?php echo $sf_user->getFlash('error'); ?></td>
                    <?php endif;?>
                
                </tr>
				<tr>
                    <td align="center" valign="bottom" height="50">&nbsp;</td>
                </tr>
                <tr>
                    <td align="center" valign="top" >
                    	<div class="errormsgPosition">
                            <p class="errormsg">
                                    <?php if($form['email']->hasError()) {
                                        echo $form['email']->getError();
                                        } else if($form['password']->hasError()) {
                                        echo $form['password']->getError();
                                    }else if($sf_user->hasFlash('errorMessage')) {
                                        echo $sf_user->getFlash('errorMessage');
                                    }?>
                               </p>
                           </div>
                    	<div class="loginForm">
                        	<p class="loginLogo"><?php echo image_tag('admin/logo.png'); ?></p>
                            <?php echo form_tag('auth/login',array('name'=>'frmuserlogin','id'=>'frmuserlogin')); ?>
                        	<h1>Admin Login</h1>
                            <p>Welcome to <b> Counseledge.com </b><br/>Use a valid username and password to gain access to the administration console.</p>
                            <div class="loginDetails">
                           <?php  $emailVal = 'Email';
                           if(isset($mail) && $mail!= '') {
                               $emailVal = $mail;
                            } ?>
                            
                            	<div class="FrmFields"><?php echo $form['email']->render(array('maxlength'=>50,'value'=>$emailVal,'onBlur'=>"if(this.value=='') this.value=this.defaultValue;", 'onFocus'=> "if(this.value==this.defaultValue) this.value='';")); ?></div>
                            	
                                  <div class="FrmFields" id="login_password_field"><?php echo $form['password']->render(array('value'=>'Password','id'=>'login_password','name'=>'login[password]', 'onClick'=>'login_change_pass_field_type_topass()','onFocus'=>'login_change_pass_field_type_topass()')); ?></div>
                                  <div class="FrmFields rememberPart"><!--<div class="remember"><?php  //echo $form['remember'] ?><?php  //echo $form['remember']->renderLabel() ?></div>--> <span class="forgetps"><?php  echo link_to('Forgot Password ?','auth/forgot',array('style'=>'padding-left:20px;')); ?></span></div>
                                  <div class="loginBtn"><?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'bluButton', 'value' => 'Login')); ?></div>
                            </div>
                            <?php if ($form->isCSRFProtected()) : ?><?php echo $form['_csrf_token'] ?><?php endif; ?>
       </form>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>


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
            minlength: 5,
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
            minlength:  "Password must be at least 6 characters long.",
            maxlength:  "Password cannot be longer than 45 characters."
        }
        }
    });

    jQuery.validator.addMethod("defaultInvalid", function(value, element) {
        if(element.value == 'Email' || element.value == 'Password') {

            return !(element.value == element.defaultValue);
        } else {

            return true;

        }

    }, 'Please enter valid information');

});

function login_change_pass_field_type_topass(){
    if(document.getElementById("login_password").value=="Password"){
        var pass_new_field = document.createElement("input");
 
        pass_new_field.name = "login[password]";
        pass_new_field.id = "login_password";
 
        
        pass_new_field.type = "password";
        //pass_new_field.tabindex = 2;
        pass_new_field.value = "";
 
        pass_new_field.onblur = function(){
            login_change_pass_field_type_totext();
        }
 
        document.getElementById("login_password_field").removeChild(document.getElementById("login_password"));
 
        document.getElementById("login_password_field").appendChild(pass_new_field);
 
        document.getElementById("login_password").focus();
    }
}
 
function login_change_pass_field_type_totext(){
    if(document.getElementById("login_password").value==""){
        var pass_new_field = document.createElement("input");
 
        pass_new_field.name = "login[password]";
        pass_new_field.id = "login_password";
        
 
        pass_new_field.type = "text";
        pass_new_field.tabindex = 2;
        pass_new_field.value = "Password";
 
        pass_new_field.onclick = function(){
            login_change_pass_field_type_topass();
        }
        pass_new_field.onfocus = function(){
            login_change_pass_field_type_topass();
        }
 
        document.getElementById("login_password_field").removeChild(document.getElementById("login_password"));
 
        document.getElementById("login_password_field").appendChild(pass_new_field);
    }
}

</script>