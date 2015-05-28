
<?php $webId = $sf_user->getAttribute('personalWebsiteId'); ?>
<?php include_partial('default/message'); ?>
<tr valign="top">
	<td colspan="2" class="ListAreaPad">
		<form id="ThemeBannerBackgroundFrm" name="ThemeBannerBackgroundFrm" action="<?php echo url_for('themebanner/bannerBackground') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>		
		<?php if (!$form->getObject()->isNew()): ?><input id="sf_method" type="hidden" name="sf_method" value="put" /><?php endif; ?>
		<input id="stockPhotoId" type="hidden" name="stockPhotoId" value="" >
			<table width="98%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
				
				<tr>
					<td width="26%" class="fldrowbg" valign="Top" ><b><?php echo "Current Banner Background" ?>:</b></td>
					<td width="68%" class="fldrowlightbg">
					<?php
								/* Start to show the image in edit time */
								if( $form->getObject()->getOptionValue () != "")
								{
									// this path is for inline resize image and display
									$resizeImagePath = $ssSiteUrl.'/resizeimage.php?image=uploads'.DIRECTORY_SEPARATOR.sfConfig::get("app_themebanner").$webId.DIRECTORY_SEPARATOR.sfConfig::get("app_Website_BannerBackground").DIRECTORY_SEPARATOR.$form->getObject()->getOptionValue ().'&width='.sfConfig::get("app_BannerBackgroundResize_Width").'&height='.sfConfig::get("app_BannerBackgroundResize_Height");
								?>
									<img src="<?php echo $resizeImagePath; ?>"  />
								<?php
									//echo image_tag('..'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.sfConfig::get("app_themebanner").$webId.DIRECTORY_SEPARATOR.sfConfig::get("app_Website_BannerBackground").DIRECTORY_SEPARATOR.$form->getObject()->getOptionValue (),array('border'=>'0','alt'=>'Image','title'=>$form->getObject()->getOptionValue (),'width'=>'75px','height'=>'75px'));
								}
								/* End to show the image in edit time */
						?>
					</td>
				</tr>

				<tr>
					<td width="26%" class="fldrowbg"><b><?php echo $form['StockPhotoChoice']->renderLabel() ?>:</b> <span class="error">*</span></td>
					<td width="68%" class="fldrowlightbg">
					<?php echo $form['StockPhotoChoice']->render(array('onClick'=>"backgroundBannerShowHide(this.id)")) ?>
					<?php if ($form['StockPhotoChoice']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['StockPhotoChoice']->getError()?></div>
					<?php endif; ?>
					</td>
				</tr>

				<tr id="customTr" style="display:none;">
					<td width="26%" class="fldrowbg"><!--<b><?php //echo $form['OptionValue']->renderLabel() ?>:</b> <span class="error">*</span>--></td>
					<td width="68%" class="fldrowlightbg">
					<?php echo $form['OptionValue']->render() ?>
					<br>
					<div class="noteDisplay">
					<strong> Note: </strong></br>
							1. Only jpeg, jpg, png, gif are allowed </br>
							2. For better result dimension should be 1900px X 400px
					</div>
					<?php if ($form['OptionValue']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['OptionValue']->getError()?></div>
					<?php endif; ?>
					</td>
				</tr>

				<tr id="stockPhotoTr" style="display:none;">
					<td width="26%" class="fldrowbg" valign="top"><!--<b>Background Image:</b> <span class="error">*</span>--></td>
					<td width="68%" class="fldrowlightbg">
						</br> <div class="noteDisplay" ><strong> Note: </strong> Select any one image from below </div>
						<div id="tS2" class="jThumbnailScroller">
							<div class="jTscrollerContainer">
								<div class="jTscroller">
									<?php
										foreach($backgroundImages as $backgroundImage) : ?>
											<div style="float:left;width:185px;text-align:center;"></br>
												<?php echo $backgroundImage["Title"]; ?>
												<a href="<?php echo $ssSiteUrl; ?>/uploads/Media/Banner-Background/<?php echo $backgroundImage["ImageName"]; ?>" rel="lightbox" >
													<?php echo image_tag('../uploads/stockPhotoThumb/Banner-Background/'.$backgroundImage["ImageName"], array('border'=>'1','alt'=>'Image','title'=>"Click To See Preview",'width'=>'90px','height'=>'90px'))?>
													<?php $imagePath = $ssSiteUrl.'/uploads/stockPhotoThumb/Banner-Background/'.$backgroundImage["ImageName"]; ?>
												</a>
												<div class="redio-btn">
													<?php 	$imageWidthHeight = getimagesize($ssSiteUrl."/uploads/Media/Banner-Background/".$backgroundImage["ImageName"]); ?>
													<input  onClick="setHiddenImage('Background_<?php echo $backgroundImage["Id"];?>','<?php echo $imagePath; ?>');" type="radio" name="backgroundImageName[]"   id="Background_<?php echo $backgroundImage["Id"]; ?>"/><?php echo "</br></br>Width:".$imageWidthHeight[0]."px"."</br>Height:".$imageWidthHeight[1]."px"; ?>
												</div>
											</div>
									<?php 	endforeach; ?>
								</div>
							</div>
							<a href="#" class="jTscrollerPrevButton"></a>
							<a href="#" class="jTscrollerNextButton"></a>
						</div>
					</td>
				</tr>
				
				<tr id="stockPhotoPreviewTr" style="display:none;">
					<td width="26%" class="fldrowbg" ><b>Preview Background :</b></td>
					<td width="68%" class="fldrowlightbg" id="stockPhotoImage"></td>
				</tr>
				<tr class="fldbg">
					<td height="33" align="center" class="fldrowbg error">&nbsp;</td>
					<td class="fldrowbg" colspan="2" align="left">
					<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?>    
							<?php echo $form->renderHiddenFields(false) ?>
						</td>
				</tr>
			</table>
		</form>
	</td>
</tr>

<script type="text/javascript">
function backgroundBannerShowHide(id)
{
	if(id == "BannerBackground_StockPhotoChoice_1")
	{
 		$("#customTr").show();
 		$("#stockPhotoPreviewTr").hide();
 		$("#stockPhotoTr").hide();

		$('[name="backgroundImageName[]"]:checked').removeAttr('checked');
		document.getElementById("stockPhotoId").value = "";
	}
	else if(id == "BannerBackground_StockPhotoChoice_0")
	{
		setTimeout(function() {
			$("#customTr").hide();
			$("#stockPhotoTr").show();
			$("#tS2").thumbnailScroller({ 
				scrollerType:"clickButtons", 
				scrollerOrientation:"horizontal", 
				scrollSpeed:2, 
				scrollEasing:"easeOutCirc", 
				scrollEasingAmount:600, 
				acceleration:4, 
				scrollSpeed:800, 
				noScrollCenterSpace:10, 
				autoScrolling:0, 
				autoScrollingSpeed:2000, 
				autoScrollingEasing:"easeInOutQuad", 
				autoScrollingDelay:500 
			});
		}, 500);

	}
}

function setHiddenImage(id, imagePath)
{
	$("#stockPhotoPreviewTr").show();
	document.getElementById("stockPhotoImage").innerHTML = '<img src='+imagePath+' height="75px" width="75px" />';
	document.getElementById("stockPhotoId").value = id;
}

</script>

<script>
$(document).ready(function() {

	$("#tS2").thumbnailScroller({ 
		scrollerType:"clickButtons", 
		scrollerOrientation:"horizontal", 
		scrollSpeed:2, 
		scrollEasing:"easeOutCirc", 
		scrollEasingAmount:600, 
		acceleration:4, 
		scrollSpeed:800, 
		noScrollCenterSpace:10, 
		autoScrolling:0, 
		autoScrollingSpeed:2000, 
		autoScrollingEasing:"easeInOutQuad", 
		autoScrollingDelay:500 
	});

});
</script>

<script type="text/javascript">
jQuery().ready(function() {

	jQuery("#ThemeBannerBackgroundFrm").validate({
		errorClass: "errormsgs",
		rules: {
		    "BannerBackground[OptionValue]": {
				required: function(element) {
								var valueChk = $("#BannerBackground_StockPhotoChoice_1").attr('checked');
								if(valueChk == "checked")
									return true;
								else
									return false;
								}
			},
			"backgroundImageName[]": {
				required: function(element) {
				
								var valueChk = $("#BannerBackground_StockPhotoChoice_0").attr('checked');
								if(valueChk == "checked")
								{
									return true;
								}
								else
									return false;
								}
			},
			"BannerBackground[StockPhotoChoice]": {
				required: true,
			},
		},
		messages: {
		    "BannerBackground[OptionValue]": {
				required:   "This field is required.",
		    },
		    "backgroundImageName[]": {
				required:   "This field is required.",
		    },
		    "BannerBackground[StockPhotoChoice]":{
				required:   "This field is required.",
		    }
		}
	});
});

</script>