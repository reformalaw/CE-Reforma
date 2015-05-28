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
        <?php echo $staticPage->getTitle(); ?>
      </div>
    </div>
    <div class="content-main">
    	<div class="static-content-main">
    		<div class="static-content">
			<?php echo html_entity_decode($staticPage->getContent()); ?>
        </div>
        <?php include_partial('staticPageMenu', array('slug' => $staticPage->getSlug())) ?>
        </div>
    </div>
  </div>
  </div>
</section>



<?php /*
<section>
<div class="middle-inner">
  <div class="page">
    <div class="inner-top-link">
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Find a Attorney</a></li>
        <li><a class="active" href="#">Georgia</a></li>
      </ul>
    </div>
    <div class="filter-search">
      <div class="inner-box-title">
        About Us
      </div>
    </div>
    <div class="content-main">
    	<div class="static-content-main">
    		<div class="static-content">
    	When faced with a legal question, many people don't know where to start. Evaluating and choosing a lawyer for your needs and becoming educated about legal issues can be a daunting task. It's not easy to find the facts you need to make an informed decision, and the stakes - both personal and financial - are very high.
        <p><?php echo image_tag('../../images/legalgrip/aboutus-img.png'); ?></p>
        <p>Legalgrip.com can help. This FREE service from LexisNexis Martindale-Hubbell is designed specifically for individuals and small businesses, providing:</p>
        <ul>
        	<li>Accurate and reliable profiles of 1 million lawyers and firms worldwide.</li>
            <li>A wealth of information to help users better understand the law, make more informed personal legal choices and identify high quality legal representation.</li>
            <li>Helpful tips on selecting an attorney, preparing to meet with an attorney and working with an attorney.</li>
            <li>An interactive discussion community of individuals and lawyers covering hundreds of legal topics.</li>
            <li>Consumer friendly explanations of major areas of law, articles on current legal topics, links to legal resources on the web, a glossary of 10,000 legal terms, and more.</li>
        </ul>
        </div>
        	<div class="static-menu">
            <ul>
            	<li class="select"><a href="#">About Us</a></li>
                <li><a href="#">The Team</a></li>
                <li><a href="#">Media</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </div>
        </div>
    </div>
  </div>
  </div>
</section>
*/ ?>