<?php if($sf_user->hasFlash('succMsg')): ?>
		<div style="margin-top:100px;">
				<?php if($sf_user->hasFlash('succMsg')) { ?>
					<div id="msg2" class="success" align="center">
						<a href="#" id="msg"><?php echo $sf_user->getFlash('succMsg');?></a>
					</div>
				<?php }?>
				<?php if($sf_user->hasFlash('succMsg2')) { ?>
					<div id="msg3" class="success" align="center">
						<a href="#" id="msg"><?php echo $sf_user->getFlash('succMsg2');?></a>
					</div>
				<?php }?>
			<?php //include_partial('default/message'); ?>
		</div>
<?php else: ?>
<div class="addReview">
	<h2>Add Review Rating</h2>
    	<!--START when success message not set-->
        	<form id="frmReviewRating" name="frmReviewRating" action="<?php echo url_for('rating/'.($form->getObject()->isNew() ? 'addReviewRating' : 'updateTopic').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
		<?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
			<div class="reviewdetails">
			<input type="hidden" value="<?php echo $customerId; ?>" name="customerId">
			<input type="hidden" name="score_value" value="" id="score_value">
			<table width="96%" cellspacing="1" cellpadding="6" class="CaseEditForm" align="center">
				
				<tr>
					<td width="12%" class="fldrowbg"><b><?php echo "Rate"; ?>: </b></td>
					<td>
                    <ul class="star-rating">
                        <li id="currentRating" class="current-rating" style="width:60%;">Currently 3/5 Stars.</li>
                        <li><a onClick="giveRating(1,20);" href="javascript:void(0);" title="1 star out of 5" class="one-star">1</a></li>
                        <li><a onClick="giveRating(2,40);" href="javascript:void(0);" title="2 stars out of 5" class="two-stars">2</a></li>
                        <li><a onClick="giveRating(3,60);" href="javascript:void(0);" title="3 stars out of 5" class="three-stars">3</a></li>
                        <li><a onClick="giveRating(4,80);" href="javascript:void(0);" title="4 stars out of 5" class="four-stars">4</a></li>
                        <li><a onClick="giveRating(5,100);" href="javascript:void(0);" title="5 stars out of 5" class="five-stars">5</a></li>
                    </ul>
					</td>
				</tr>

				<tr>
					<td width="12%" class="fldrowbg"><b><?php echo $form['Review']->renderLabel() ?>: </b></td>
					<td width="88%" class="fldrowlightbg">
					<?php echo $form['Review']->render() ?>
					<?php if ($form['Review']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['Review']->getError()?></div>
					<?php endif; ?>
					</td>
				</tr>

				<tr class="fldbg">
					<td height="33" align="center" class="fldrowbg error">&nbsp;</td>
					<td class="fldrowbg" colspan="2" align="left">
					<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?>    
					<?php echo $form->renderHiddenFields(false) ?>
					</td>
				</tr>
			</table>
            </div>
		</form>
		<!--END when success message not set-->
<?php endif; ?>

</div>

<script type="text/javascript">

function giveRating(rating, width)
{
	var widthStyle = "width:"+width+"%";
	$("#score_value").val(rating);
	$("#currentRating").attr('style', widthStyle);
}

jQuery().ready(function() {

	jQuery("#frmReviewRating").validate({
		errorClass: "errormsgs",
		rules: {
		    "ReviewRating[Review]": {
				required: true
			},
			"score_value": {
				required: true
			}
		},
		messages: {
		    "ReviewRating[Review]": {
		      required: "This field is required."
		    },
		    "score_value": {
		      required: "Please Select the Rating"
		    }
		}
	});
});

<?php if($sf_user->hasFlash('succMsg')): ?>
	//setTimeout("parent.jQuery.fancybox.close(); openurl();",10000); 
    setTimeout("parent.jQuery.fancybox.close(); parent.window.location.reload();",10000); 
<?php endif; ?>
/*
function openurl()
{
	var url = "'"+parent.window.location+"'";
	var lasturl = url.split("?");
	var finalurl = lasturl[0];
	window.location = finalurl.replace("'", "");
	parent.window.location = window.location;
	parent.window.location.reload();
	
}
*/
</script>

<script>
$(document).ready(function() {
    $('#msg2').delay(3000).fadeOut(10000);
    $('#msg3').delay(3000).fadeOut(10000);
});
</script>