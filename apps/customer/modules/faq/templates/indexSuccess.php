<section class="middle"  id="faq">
  <div class="page">
    <div class="content-area left">
         <h2>FAQs</h2>
          <div class="content-text">
            	<?php $i = 1; ?>
			<?php foreach ($objFaqs as $faqs_data) {?>
				<?php if ($faqs_data->getWebsiteXFAQsFAQs()->getQuestion() != "" || $faqs_data->getWebsiteXFAQsFAQs()->getAnswer() != ""){ ?>
					<h4 class="twisty">
						<a class="twisty-collapse" href="javascript:void(0)" title="<?php echo $faqs_data->getWebsiteXFAQsFAQs()->getQuestion();?>">
							<?php echo $i.")&nbsp;&nbsp;".$faqs_data->getWebsiteXFAQsFAQs()->getQuestion(); ?>
						</a>
		
						<div class="answer" style="text-align:justify;">
							<p><?php echo nl2br($faqs_data->getWebsiteXFAQsFAQs()->getAnswer()); ?></p>
						</div>
					</h4>
					<?php $i++; ?>
				<?php } ?>
			<?php } ?>
        </div>
     </div>
    </div>   
</section>
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