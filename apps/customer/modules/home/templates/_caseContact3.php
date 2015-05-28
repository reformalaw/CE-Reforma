<h2>Tell us About your Case</h2>
<p>Fill out the following Information</p>

<?php if($sf_user->hasFlash('succMsg')) { ?>
    <p align="left" style="color:green;float:left;"><?php echo $sf_user->getFlash('succMsg');?></p>
<?php }?>

<form action="<?php echo url_for('home/index') ?>" method="post" name="casecontact" onsubmit="return validateForm()">

    <?php echo $contactForm['name']->render(array('class' => 'input', 'onblur' => "if(this.value=='') this.value=this.defaultValue;", 'onfocus' =>"if(this.value==this.defaultValue) this.value='';", 'value'=> "Name"));?>
    
    <?php echo $contactForm['email']->render(array('class' => 'input', 'onblur' => "if(this.value=='') this.value=this.defaultValue;", 'onfocus' =>"if(this.value==this.defaultValue) this.value='';", 'value'=> "Email"));?>
    
    <?php echo $contactForm['phone']->render(array('class' => 'input', 'onblur' => "if(this.value=='') this.value=this.defaultValue;", 'onfocus' =>"if(this.value==this.defaultValue) this.value='';", 'value'=> "Phone"));?>
    
    <?php echo $contactForm['message']->render( array( 'class' => 'input-area', 'onfocus' => "if(this.value==this.defaultValue) this.value='';", 'onblur' => "if(this.value=='') this.value=this.defaultValue;", 'value' => 'Brief Message'));?>
    <p class="submit-btn"><input name="submit" type="submit" value="Submit your Message" /></p>
</form>


<script type="text/javascript">
function validateForm() {
    var errorCount =0;
    if(trim($('#contact_name').val()) == 'Name' || trim($('#contact_name').val()) == '') {
        $('#contact_name').css('border','solid 1px red');
        $('#contact_name').focus();
        errorCount++;
        return false;
    } else {
        $('#contact_name').css('border','');
    }

    if( trim($('#contact_email').val()) == 'Email' || trim($('#contact_email').val()) == ''){
        $('#contact_email').css('border','solid 1px red');
        $('#contact_email').focus();
        errorCount++;
        return false;
    }else {
        $('#contact_email').css('border','');
    }

    if( trim($('#contact_email').val()) != '') {
        var pattern =  /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i;
        if(!pattern.test($('#contact_email').val())) {

            $('#contact_email').css('border','solid 1px red');
            $('#contact_email').val('');
            $('#contact_email').focus();
            errorCount++;
            return false;

        } else {
            $('#contact_email').css('border','');
        }
    }


    if(trim( $('#contact_phone').val()) == 'Phone' || trim($('#contact_phone').val()) == ''){
        $('#contact_phone').css('border-color','red');
        $('#contact_phone').focus();
        errorCount++;
        return false;
    }else {
        $('#contact_phone').css('border-color','');
    }

    if(trim( $('#contact_message').val()) == 'Brief Message' || trim($('#contact_message').val()) == ''){
        $('#contact_message').css('border-color','red');
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

<?php if ($contactForm['name']->hasError()){ ?>
$('#contact_name').css('border-color','red');
<?php } ?>

<?php if ($contactForm['email']->hasError()){ ?>
$('#contact_email').css('border-color','red');
<?php } ?>

<?php if ($contactForm['phone']->hasError()){ ?>
$('#contact_phone').css('border-color','red');
<?php } ?>

<?php if ($contactForm['message']->hasError()){ ?>
$('#contact_message').css('border-color','red');
<?php } ?>


</script>