
<?php if($sf_user->hasFlash('succMsg')) { ?>            
    <p align="left" style="color:green;float:left;"><?php echo $sf_user->getFlash('succMsg');?></p>
<?php }?>

<form action="<?php echo url_for('contact/create?id='.$UserId) ?>" method="post" name="defaultcontact" onsubmit="return validateForm()">
<div class="topicforum">
	<h2 style="float:none">Contact Us <span class="required" style="float:right; font-size:13px; margin:0 0 0 10px;">Note: * Required field</span><span class="text" style="float:right;">Fill out the following Information</span></h2>
        
    
    <ul>
    <li><p class="popup-from" style="font-weight:bold;"><?php echo $form['name']->renderlabel(); ?><span class="required">*</span> </p><?php echo $form['name']->render(array(  'onfocus' =>"if(this.value==this.defaultValue) this.value='';"));?></li>
    
    <li><p class="popup-from" style="font-weight:bold;"><?php echo $form['email']->renderlabel(); ?><span class="required">*</span> </p><?php echo $form['email']->render(array(  'onfocus' =>"if(this.value==this.defaultValue) this.value='';"));?></li>
    
    <li><p class="popup-from" style="font-weight:bold;"><?php echo $form['phone']->renderlabel(); ?><span class="required">*</span> </p><?php echo $form['phone']->render(array(  'onfocus' =>"if(this.value==this.defaultValue) this.value='';"));?></li>
    
    <li class="message"><p class="popup-from" style="font-weight:bold;"><?php echo $form['message']->renderlabel(); ?><span class="required">*</span> </p><?php echo $form['message']->render( array('onfocus' => "if(this.value==this.defaultValue) this.value='';"));?></li>
    <li style="margin-top:10px;"><input name="submit" type="submit" value="Submit your Message" /></li>
    
    </ul>
    </div>

</form>

<script type="text/javascript">
function validateForm() {
    var errorCount =0;
    if(trim($('#contact_name').val()) == 'Name' || trim($('#contact_name').val()) == '') {
        $('#contact_name').css('border','solid 2px red');
        $('#contact_name').focus();
        errorCount++;
        return false;
    } else {
        $('#contact_name').css('border','');
    }

    if( trim($('#contact_email').val()) == 'Email' || trim($('#contact_email').val()) == ''){
        $('#contact_email').css('border','solid 2px red');
        $('#contact_email').focus();
        errorCount++;
        return false;
    }else {
        $('#contact_email').css('border','');
    }

    if( trim($('#contact_email').val()) != '') {
        var pattern =  /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i;
        if(!pattern.test($('#contact_email').val())) {

            $('#contact_email').css('border','solid 2px red');
            //$('#contact_email').val('');
            $('#contact_email').focus();
            errorCount++;
            return false;

        } else {
            $('#contact_email').css('border','');
        }
    }


    if(trim( $('#contact_phone').val()) == 'Phone' || trim($('#contact_phone').val()) == ''){
        $('#contact_phone').css('border','solid 2px red');
        $('#contact_phone').focus();
        errorCount++;
        return false;
    }else {
        $('#contact_phone').css('border-color','');
    }

    if(trim( $('#contact_message').val()) == 'Message' || trim($('#contact_message').val()) == ''){
        $('#contact_message').css('border','solid 2px red');
        $('#contact_message').focus();
        errorCount++;
        return false;
    }else {
        $('#contact_message').css('border-color','');
    }

    if(errorCount > 0) {
        return false;
    }
    return true;

}

<?php if ($form['name']->hasError()){ ?>
$('#contact_name').css('border-color','red');
<?php } ?>

<?php if ($form['email']->hasError()){ ?>
$('#contact_email').css('border-color','red');
<?php } ?>

<?php if ($form['phone']->hasError()){ ?>
$('#contact_phone').css('border-color','red');
<?php } ?>

<?php if ($form['message']->hasError()){ ?>
$('#contact_message').css('border-color','red');
<?php } ?>


</script>