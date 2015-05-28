<section>
<div class="middle-inner">
  <div class="page">
    <div class="inner-top-link">
      <!--<ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Find a Attorney</a></li>
        <li><a class="active" href="#">Georgia</a></li>
      </ul>-->
    </div>
    <div class="filter-search">
      <div class="inner-box-title">
        FAQs
      </div>
    </div>
    <div class="content-main">
    	<div class="static-content-main">

               <!-- Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vestibulum elementum arcu, at facilisis leo pretium eget. Nulla lacus risus, aliquam id faucibus sit amet, imperdiet vitae quam.-->

				<?php $i = 1; ?>
            	   <?php foreach ($ligalgripList as $ligalgripFaq) {?>
            	       <?php if ($ligalgripFaq->getWebsiteXFAQsFAQs()->getQuestion() != "" || $ligalgripFaq->getWebsiteXFAQsFAQs()->getAnswer() != ""){ ?>
                            <h4 class="twisty">
                                <a class="twisty-collapse" href="javascript:void(0)" title="<?php echo $ligalgripFaq->getWebsiteXFAQsFAQs()->getQuestion();?>">
        					       <?php echo $i.") &nbsp;".$ligalgripFaq->getWebsiteXFAQsFAQs()->getQuestion(); ?>
					           </a>
				
					           <div class="answer" style="text-align:justify;">
					               <p><?php echo $ligalgripFaq->getWebsiteXFAQsFAQs()->getAnswer(); ?></p>
					           </div>
				            </h4>
                            <?php $i++; ?>
                   <?php } ?>
                <?php } ?>

                <!--<p class="address">Address: The Company Name Inc.
                  9870 St Vincent Place,
                  Glasgow, DC 45 Fr 45.</p>-->

        	<div class="static-menu">
            <!--<ul>
            	<li class="select"><a href="#">About Us</a></li>
                <li><a href="#">The Team</a></li>
                <li><a href="#">Media</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>-->
        </div>
        </div>
    </div>
  </div>
  </div>
</section>


<?php /*
<section class="middle"  id="faq">
  <div class="page">
    <div class="content-area left">
         <h2>FAQs</h2>
          <div class="content-text">
            	<?php $i = 1; ?>
            	   <?php foreach ($ligalgripList as $ligalgripFaq) {?>
            	       <?php if ($ligalgripFaq->getWebsiteXFAQsFAQs()->getQuestion() != "" || $ligalgripFaq->getWebsiteXFAQsFAQs()->getAnswer() != ""){ ?>
                            <h4 class="twisty">
                                <a class="twisty-collapse" href="javascript:void(0)" title="<?php echo $ligalgripFaq->getWebsiteXFAQsFAQs()->getQuestion();?>">
        					       <?php echo $i.") &nbsp;".$ligalgripFaq->getWebsiteXFAQsFAQs()->getQuestion(); ?>
					           </a>
				
					           <div class="answer" style="text-align:justify;">
					               <p><?php echo $ligalgripFaq->getWebsiteXFAQsFAQs()->getAnswer(); ?></p>
					           </div>
				            </h4>
                            <?php $i++; ?>
                   <?php } ?>
                <?php } ?>
        </div>
     </div>
    </div>
</section>
<?php */ ?>

<script type="text/javascript">
jQuery().ready(function() {

    jQuery(".twisty-collapse").click(function(){
        jQuery(this).toggleClass('twisty-collapse');
        jQuery(this).toggleClass('twisty-expand');
        if(jQuery(this).hasClass('twisty-collapse')){
            jQuery(this ).parents().children(".answer").slideDown('slow');
        }else{
            jQuery(this ).parents().children(".answer").slideUp('slow');
        }

    })

});
</script>
