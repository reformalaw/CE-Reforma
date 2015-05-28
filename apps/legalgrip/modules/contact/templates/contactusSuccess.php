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
        Contact Us
      </div>
    </div>
    <div class="content-main">
    	<div class="static-content-main">
    		<div class="static-content">
    		<!--Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vestibulum elementum arcu, at facilisis leo pretium eget. Nulla lacus risus, aliquam id faucibus sit amet, imperdiet vitae quam.-->
                <div class="contactUsForm">
                    <ul>
						<?php include_partial('contactusform', array('form' => $form ));  ?>
					</ul>
                </div>
                <!--<p class="address">Address: The Company Name Inc.
                  9870 St Vincent Place,
                  Glasgow, DC 45 Fr 45.</p>-->
        </div>
        <?php include_partial('pages/staticPageMenu', array('slug' => 'contactus')) ?>
        </div>
    </div>
  </div>
  </div>
</section>