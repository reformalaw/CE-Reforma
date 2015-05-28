<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="<?php echo public_path("images");?>/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <!--<meta http-equiv="X-UA-Compatible" content="IE=8; " />-->
    <!--<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" />-->
  </head>
  <body>
  <table cellpadding="0" cellspacing="0" border="0"  width="100%" align="center">
    <tr><td width="100%">
    <!-- Header part Start -->
    <?php #echo $sf_user->isAuthenticated().'==========.&.'.$sf_user->hasAttribute('admin_user_id'); ?>
    <?php if($sf_user->isAuthenticated() && $sf_user->hasAttribute('admin_user_id') ) {?>
	    <?php  include_component('default', 'header');?>
	<?php } ?>
    <!-- Header part End -->
    </td></tr>
    <tr><td  width="100%">
    <!-- Main Content part Start -->
      <?php echo $sf_content ?>
    <!-- Main Content part End -->
    </td></tr>
    <tr><td  width="100%">
    <!-- Footer part Start -->
        <?php  include_component('default', 'footer');?>
    <!-- Footer part End -->
    </td></tr>
  </table>   
  </body>
</html>