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
		<?php include_component('theme','header11'); ?>
		<section class="banner"> </section>
		<section class="middle" id="left-column">
			<div class="page">
				<div class="practice-area left">
					<?php include_component('home','userWebsitePracticeArea11'); ?>
				</div>
				<div class="content-area right">
					<?php echo $sf_content ?>
				</div>
			</div>
		</section>
		<?php include_component('theme','footer11');?>
	</body>
</html>