
<style type="text/css">
body{margin:0; padding:0; background:#ddd;}
.info{position:absolute; left:40px; top:20px; width:360px; color:#333; font-family:"Lobster",Arial,Helvetica,sans-serif; font-size:18px; padding:5px;}
.info .big{font-size:34px; color:#d56916;}
</style>
<div class="slider-main noteDisplay"><b>Note:</b> Please Select Any One Banner Either from Banner Foreground or From Unsorted</div><br>

<div class="slider-main">


<div> <b>Banner Foreground </div>
<div id="tS2" class="jThumbnailScroller">
	<div class="jTscrollerContainer">
		<div class="jTscroller">
			<?php
				foreach($foregroundImages as $foregroundImage) : ?>
					<div style="float:left;width:185px;text-align:center;"> <!--text-align:center;-->
						</br>
						<?php echo $foregroundImage["Title"]; ?>
						<a href="<?php echo $ssSiteUrl; ?>/uploads/Media/Banner-Foreground/<?php echo $foregroundImage["ImageName"]; ?>" rel="lightbox" >
							<?php echo image_tag('../uploads/stockPhotoThumb/Banner-Foreground/'.$foregroundImage["ImageName"], array('border'=>'1','alt'=>'Image','title'=>"Click To See Preview",'width'=>'90px','height'=>'90px'))?>
							<?php $imagePath = $ssSiteUrl.'/uploads/stockPhotoThumb/Banner-Foreground/'.$foregroundImage["ImageName"]; ?>
						</a>
						<div class="redio-btn">
							<?php 	$imageWidthHeight = getimagesize($ssSiteUrl."/uploads/Media/Banner-Foreground/".$foregroundImage["ImageName"]); ?>
						    <input onClick="setValueParent('Foreground_<?php echo $foregroundImage["Id"];?>','<?php echo $imagePath; ?>');" type="radio" name="foregroundImageName[]"   id="Foreground_<?php echo $foregroundImage["Id"]; ?>"/><?php echo "</br>Width:".$imageWidthHeight[0]."px"."</br>Height:".$imageWidthHeight[1]."px"; ?>
					    </div>
					</div>
			<?php 	endforeach; ?>
		</div>
	</div>
	<a href="#" class="jTscrollerPrevButton"></a>
	<a href="#" class="jTscrollerNextButton"></a>
</div>

<div> <b>Banner Unsorted </div>
<div id="unsortedScroll" class="jThumbnailScroller">
	<div class="jTscrollerContainer">
		<div class="jTscroller">
			<?php
				foreach($unsortedImages as $unsortedImage) : ?>
					<div style="float:left;width:185px;text-align:center;"> <!--text-align:center;-->
						</br>
						<?php echo $unsortedImage["Title"]; ?>
						<a href="<?php echo $ssSiteUrl; ?>/uploads/Media/Unsorted/<?php echo $unsortedImage["ImageName"]; ?>" rel="lightbox" >
							<?php echo image_tag('../uploads/stockPhotoThumb/Unsorted/'.$unsortedImage["ImageName"], array('border'=>'1','alt'=>'Image','title'=>"Click To See Preview",'width'=>'90px','height'=>'90px'))?>
							<?php $imagePath = $ssSiteUrl.'/uploads/stockPhotoThumb/Unsorted/'.$unsortedImage["ImageName"]; ?>
						</a>
						<div class="redio-btn">
							<?php 	$unsortedImageWidthHeight = getimagesize($ssSiteUrl."/uploads/Media/Unsorted/".$unsortedImage["ImageName"]); ?>
						    <input onClick="setValueParent('Unsorted_<?php echo $unsortedImage["Id"];?>','<?php echo $imagePath; ?>');" type="radio" name="foregroundImageName[]"   id="Unsorted_<?php echo $unsortedImage["Id"]; ?>"/><?php echo "</br>Width:".$unsortedImageWidthHeight[0]."px"."</br>Height:".$unsortedImageWidthHeight[1]."px"; ?>
					    </div>
					</div>
			<?php 	endforeach; ?>
		</div>
	</div>
	<a href="#" class="jTscrollerPrevButton"></a>
	<a href="#" class="jTscrollerNextButton"></a>
</div>
</div>
<!--&nbsp;&nbsp;<div class="slider-main noteDisplay"><b>Note: Please Select Any One Banner From Above </b></div>-->
<script type="text/javascript">
function submitForm()
{
	var checkedLength = $('[name="foregroundImageName[]"]:checked').length;

	if(checkedLength <= 0)
		alert("Please select image");
	else if(checkedLength >= 1)
		window.close();
}
function setValueParent(id, imagePath)
{
	window.opener.document.getElementById("trStockPhoto").removeAttribute("class");
	window.opener.document.getElementById("trStockPhoto").className = "stockPhotoBlock";

	window.opener.document.getElementById("stockPhotoImage").innerHTML = '<img src='+imagePath+' height="75px" width="75px" />';
	window.opener.document.getElementById("bannertype").value = id;
	window.close();
}

</script>

<script>

(function($){
window.onload=function(){ 

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

	$("#unsortedScroll").thumbnailScroller({ 
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
}
})(jQuery);

</script>