<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_component('theme','customize'); // For Site CSS ?>
    <!--[if lt IE 8]><link rel="stylesheet" type="text/css" media="screen" href="/css/frontend/sequencejs-theme.modern-slide-in.ie.css" /><![endif]-->
    <?php include_javascripts() ?>
  </head>
  <body>
    <?php include_component('theme','header4'); ?>
    <?php #echo $sf_content ?>

    <section class="middle" id="cmspages">
			<div class="page">
				<div class="middle-part">	
					<div class="middle-part-border">
						<div class="formbox-shadow"><img src="/images/theme4/formbox-shadow.png" /></div>
						<div class="practice-area left">
							<?php include_component('home','userWebsitePracticeArea4'); // Shows Website Practice Area?>           
						</div>
							
						<div class="content-area right">
								<?php echo $sf_content ?>
						</div>
					</div>
				</div>
			</div>
    </section>

    <?php include_component('theme','footer4');?>
  </body>
</html>