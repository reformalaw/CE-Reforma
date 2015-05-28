<?php use_helper('sfCryptoCaptcha');?>    

<section class="middle" id="contactus">
  <div class="page">
    <div class="content-area left">

        <?php /* -------------------------------------------*/ ?>
			<?php include_partial('form', array('form' => $form , 'UserId' => $UserId,'customerDatas'=>$customerDatas)); //'inputId'=>$inputId,'required'=>$required ?>
        <?php /* -------------------------------------------*/ ?>

            <div class="contact-details right">
                <label style="cursor:auto;">Address :</label>
                <p><strong><?php echo ucwords($userData->getFirstName().' '.$userData->getMiddleName().' '.$userData->getLastName()) ;?></strong><br>
                  <?php echo $userData->getAddress1();?> <br>
                  <?php if($userData->getAddress2() != '' ){ ?>
                    <?php echo $userData->getAddress2(); ?> <br>
                  <?php } ?>  
                  <?php echo $userData->getCity().', '; ?> 

                  <?php echo $userData->getUsersStates()->getName();   ?>
                  <?php if($userData->getZip() != '') 
                       echo ' '.$userData->getZip(); ?>
                  <?php if($userData->getPhone() != '') 
                       echo '<br> '.$userData->getPhone(); ?>
                  </p>

                <label style="cursor:auto;">Email :</label> <p><a href="mailto:<?php echo $userData->getEmail(); ?>"><?php echo $userData->getEmail(); ?></a></p>
            </div>
    </div>
  </div>
<p></p>



</section>
<div class="page">

             <p>
              <iframe width="600" height="400" frameborder="0" scrolling="no" marginheight="20" marginwidth="20"  src="https://maps.google.com/?q=<?php echo urlencode($userData->getAddress1())?>+<?php echo urlencode($userData->getAddress2())?>+<?php echo urlencode($userData->getCity())?>+<?php echo urlencode($userData->getZip())?>&output=embed"</iframe>
             </p>             
         
         </div>