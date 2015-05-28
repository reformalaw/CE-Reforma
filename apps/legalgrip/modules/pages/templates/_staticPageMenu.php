<?php 
	$selectHistory 		= 	"";
	$selectMedia			=	"";
	$selectContact		= 	"";
	$selectPrivacy		=	"";
	$selectTerms			=	"";
	$selectDisclaimer	=	"";
	$selectAdvertising	=	"";
	$selectJob			=	"";
?>
<?php if($slug == "company-history"): ?>
		<?php $selectHistory = "select"; ?>
		
<?php elseif($slug == "media"): ?>
		<?php $selectMedia = "select"; ?>
		
<?php elseif($slug == "contact"): ?>
		<?php $selectContact = "select"; ?>

<?php elseif($slug == "privacy"): ?>
		<?php $selectPrivacy = "select"; ?>

<?php elseif($slug == "terms"): ?>
		<?php $selectTerms = "select"; ?>

<?php elseif($slug == "disclaimer"): ?>
		<?php $selectDisclaimer = "select"; ?>
		
<?php elseif($slug == "advertising"): ?>
		<?php $selectAdvertising = "select"; ?>

<?php elseif($slug == "jobs"): ?>
		<?php $selectJob = "select"; ?>
		
<?php endif;?>
	

<div class="static-menu">
		<ul>
			<li class="<?php echo $selectHistory; ?>"><?php echo link_to('Company History','pages/company-history');?></li>
			<li class="<?php echo $selectMedia; ?>"><?php echo link_to('Media','pages/media');?></li>
			<li class="<?php echo $selectContact; ?>"><?php echo link_to('Contact Us','contactus');?></li>
			<li class="<?php echo $selectPrivacy; ?>"><?php echo link_to('Privacy','pages/privacy');?></li>
			<li class="<?php echo $selectTerms; ?>"><?php echo link_to('Terms','pages/terms');?></li>
			<li class="<?php echo $selectDisclaimer; ?>"><?php echo link_to('Disclaimer','pages/disclaimer');?></li>
			<li class="<?php echo $selectAdvertising; ?>"><?php echo link_to('Advertising','pages/advertising');?></li>
			<li class="<?php echo $selectJob; ?>"><?php echo link_to('Jobs','pages/jobs');?></li>

		</ul>
</div>