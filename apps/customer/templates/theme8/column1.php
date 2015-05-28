<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<?php include_http_metas() ?>
		<?php include_metas() ?>
		<?php include_title() ?>
		<link rel="shortcut icon" href="/favicon.ico" />
		<?php include_stylesheets() ?>
		<?php include_component('theme','customize'); // For Site CSS ?>

		<?php include_javascripts() ?>
	</head>

	<body>
		<?php include_component('theme','header8'); ?>
        <section class="banner-part">
            <div class="page">
        		<?php include_component('theme','menu8'); ?>
        	</div>
        </section>
		<section class="middle" id="full-width">
			<div class="page">				
				<div class="practice-area right">
					<?php include_component('home','userWebsitePracticeArea8');?>
				</div>
				<div class="content-area left">
					<?php echo $sf_content ?>
				</div>
			</div>
		</section>
		<?php include_component('theme','footer8');?>
	</body>
</html>