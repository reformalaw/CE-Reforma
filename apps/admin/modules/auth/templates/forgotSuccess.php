<?php use_helper('Tag') ?>
<table cellspacing="0" cellpadding="0" class="loginPage" border="0" width="100%">
    
	<tr>
    	<td align="center" valign="top">

        	<table cellspacing="0" cellpadding="0" border="0" width="100%">
            	<tr>
					<?php if($form['email']->hasError()) { ?>
                        <td align="center"><p class="errormsg"><?php echo $form['email']->getError();?></p></td>
                    <?php } ?>
                </tr>
				<tr>
                    <td align="center" valign="bottom" height="70">&nbsp;</td>
                </tr>
                <?php include_partial('default/message'); ?>
                <tr>
                    <td align="center" valign="top" >
                    	<div class="loginForm">
                        	<p class="loginLogo"><?php echo image_tag('admin/logo.png'); ?></p>
                            <?php echo form_tag('auth/forgot',array('name'=>'frmuserforgot','id'=>'frmuserforgot')); ?>
                        	<h1>Forgot Password</h1>
                            <div class="loginDetails forgetPass">
                            
                           <?php  $emailVal = 'Email';
                           if(isset($mail) && $mail!= '') {
                               $emailVal = $mail;
                            } ?>

                            	<div class="FrmFields"><?php echo $form['email']->render(array('size'=>50, 'maxlength'=>50,'value'=>$emailVal,'onBlur'=>"if(this.value=='') this.value=this.defaultValue;", 'onFocus'=> "if(this.value==this.defaultValue) this.value='';")); ?></div>
                                  <div class="loginBtn"><?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'bluButton frgtbluButton', 'value' => 'Submit')); ?>&nbsp;<?php echo tag('input', array('name' => 'reset', 'type' => 'reset', 'id' => 'submit', 'class' => 'CommonButton frgtblackButton', 'value' => 'Cancel', 'onclick'=> 'window.location="'.url_for('auth/login').'"')); ?></div>
                            </div>
                             <?php echo $form->renderHiddenFields(false) ?>
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

    jQuery("#frmuserforgot").validate({
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