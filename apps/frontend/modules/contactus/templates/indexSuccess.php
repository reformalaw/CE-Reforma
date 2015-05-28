<section class="innerpage-middle">
	<div class="page row clearfix">
        <div class="middle-left">
        	<div class="innerpage-heading">
            	<h1>Contact Us </h1> <h3>There are few options for contacting us</h3>
            </div>
            <div class="innerpage-content">
            	<h4 class="contact-form-heading">Contact Form</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vestibulum elementum arcu, at facilisis leo pretium eget. Nulla lacus risus, aliquam id faucibus sit amet, imperdiet vitae quam.</p>
                    <?php if($sf_user->hasFlash('succMsg')) { ?>            
                        <p align="center" style="color:green;"><?php echo $sf_user->getFlash('succMsg');?></p>
                    <?php }?>
                    <div class="contact-form">
                        <form action="<?php url_for('contactus/index') ?>" method="post" name="contact_us" onsubmit="return validateForm()">
					<div class="contact-form-left">
						<p>Name <?php if($contactForm['name']->hasError()){ ?><span>(Required)</span><?php }else {?><span id="nameRequired">(Required)</span><?php } ?><?php echo $contactForm['name']->render();?>
							<div><?php if($contactForm['name']->hasError()){?><span style="color:red;"><?php echo $contactForm['name']->getError(); ?></span> <?php } ?></div>
						<p>Email <?php if($contactForm['email']->hasError()){ ?><span>(Required)</span><?php }else {?><span id="emailRequired">(Required)</span><?php } ?><span class="contact-method"><?php echo $contactForm['preferredEmail']->render();?><font id="contact_method">Preferred Contact Method</font></span><?php echo $contactForm['email']->render();?></p>
							<div><?php if($contactForm['email']->hasError()){?><span style="color:red;"><?php echo $contactForm['email']->getError(); ?></span> <?php } ?></div>
						<p>Phone <?php if($contactForm['phone']->hasError()){ ?><span>(Required)</span><?php }else {?><span id="phoneRequired">(Required)</span><?php } ?><span class="contact-method"><?php echo $contactForm['preferredPhone']->render();?><font id="contact_method1">Preferred Contact Method</font></span><?php echo $contactForm['phone']->render();?></p>
							<div><?php if($contactForm['phone']->hasError()){?><span style="color:red;"><?php echo $contactForm['phone']->getError(); ?></span> <?php } ?></div>
					</div>
                        <div class="contact-form-left contact-form-right">
                        	<p>Add a Note <span>(Optional)</span> <?php echo $contactForm['note']->render();?></p>
                            <p><input name="Submit" type="submit" value="Send"></p>
                        </div>
                        </form>
                    </div>            
            </div>
        </div>
        <?php include_component('default','contactInfo');?>
    </div>
</section>
<script type="text/javascript">
function validateForm()
{
    var emailCheckbox = $('#contact_us_preferredEmail').is(':checked');
    var phoneCheckbox = $('#contact_us_preferredPhone').is(':checked');

    if(emailCheckbox == false && phoneCheckbox == false)
    {
        $('#nameRequired').css('color','red');
        $('#emailRequired').css('color','red');
        $('#phoneRequired').css('color','red');
        $('#contact_method').css('color','red');
        $('#contact_method1').css('color','red');
        return  false;
    }

    if($('#contact_us_name').val() == '')
    {
		$('#nameRequired').css('color','red');
		return false;
    }
    return true;
}
</script>