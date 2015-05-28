<?php if($sf_user->hasFlash('errMsg')) { ?>
            <div id="msg2" class="errormss" align="center" onclick="" width="100%">
            <a href="#" id="msg"><?php echo $sf_user->getFlash('errMsg');?></a>
            </div>
<?php }?>
<?php if($sf_user->hasFlash('succMsg')) { ?>
					<div id="msg2" class="success" align="center">
						<a href="#" id="msg"><?php echo $sf_user->getFlash('succMsg');?></a>
					</div>
<?php }?>
<?php if($sf_user->hasFlash('errDocumentMsg')) { ?>
				<div id="msg2" class="errormss" align="center" onclick="" width="100%">
					<a href="#" id="msg"><?php echo $sf_user->getFlash('errDocumentMsg');?></a>
				</div>
<?php }?>
<?php if($sf_user->hasFlash('errorMessage')) { ?>
				<div id="msg2" class="errormss" align="center" onclick="" width="100%">
					<a href="#" id="msg"><?php echo $sf_user->getFlash('errorMessage');?></a>
				</div>
<?php }?>

<?php if($sf_user->hasFlash('ratingMsg')) { ?>
					<div id="msg2">
						<a style="color:#4F8A10;" href="#" id="msg"><?php echo $sf_user->getFlash('ratingMsg');?></a>
					</div>
<?php }?>

<?php if($sf_user->hasFlash('succMsg2')) { ?>
					<div id="msg3" class="success" align="center">
						<a href="#" id="msg"><?php echo $sf_user->getFlash('succMsg2');?></a>
					</div>
<?php }?>

<script>

$(document).ready(function() {
    $('#msg').delay(3000).fadeOut(1000);
    $('#msg2').delay(3000).fadeOut(1000);
    $('#msg3').delay(3000).fadeOut(1000);
});
</script>