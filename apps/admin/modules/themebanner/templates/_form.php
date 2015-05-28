<?php $webId = $sf_user->getAttribute('personalWebsiteId'); // Website id from session ?>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php if($sf_user->hasFlash('imgErrMsg')) { ?>
<tr align="center" valign="top" id="msg">
    <td colspan="2" class="ListAreaPad">
        <table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
            <td class="errormss" align="center" onclick=""><?php echo $sf_user->getFlash('imgErrMsg');?></td>
          </tr>
        </table>
    </td>
</tr>
<tr id="msg2">
    <td height="15" align="left" valign="top">&nbsp;</td>
</tr>
<?php }?>


<tr valign="top">
	<td colspan="2" class="ListAreaPad">
		<form id="ThemeBannerFrm" name="ThemeBannerFrm" action="<?php echo url_for('themebanner/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
		<input type="hidden" name="bannertype" value="" id="bannertype">
		
		<?php if (!$form->getObject()->isNew()): ?><input id="sf_method" type="hidden" name="sf_method" value="put" /><?php endif; ?>
			<table width="98%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
				
				<tr>
					<td width="26%" class="fldrowbg"><b><?php echo $form['BannerName']->renderLabel() ?>:</b> <span class="error">*</span></td>
					<td width="68%" class="fldrowlightbg">
					<?php echo $form['BannerName']->render() ?>
					<?php if ($form['BannerName']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['BannerName']->getError()?></div>
					<?php endif; ?>
					</td>
				</tr>
				
				<tr>
					<td width="26%" class="fldrowbg"><b><?php echo $form['StockPhotoChoice']->renderLabel() ?>:</b> <span class="error">*</span></td>
					<td width="68%" class="fldrowlightbg addBannerRadio">
					<?php echo $form['StockPhotoChoice']->render(array('onClick'=>"stockPhotoShowHide(this.id)")) ?>
					<?php if ($form['StockPhotoChoice']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['StockPhotoChoice']->getError()?></div>
					<?php endif; ?>
					</td>
				</tr>
				
				<!--<tr>
					<td width="26%" class="fldrowbg"><b><?php //echo "select from custom or stock photo" ?>:</td>
					<td class="fldrowlightbg">
						<input id="chkStockPhoto" type="radio" name="stockData[]" onClick="showHide('chkStockPhoto');">Stock Photo
						<input id="chkCustom" type="radio" name="stockData[]" onClick="showHide('chkCustom');">Custom
					</td>
				</tr>-->

				<tr id="trStockPhoto" class="stockPhotoNone">
					<td width="26%" class="fldrowbg"><b> Stock Photo Preview : </td>
					<td width="68%" class="fldrowlightbg" id="stockPhotoImage"> </td>
				</tr>

				<tr id="imgTr" style="display:none">
					<td width="26%" class="fldrowbg"><b><?php echo $form['Image']->renderLabel() ?>:</b> <span class="error">*</span></td>
					<td width="68%" class="fldrowlightbg">
					<?php echo $form['Image']->render() ?>
					<br>
					<div class="noteDisplay">
					<strong> Note: </strong> </br>
							1. Only jpeg, jpg, png, gif are allowed, </br>
							2. For better result dimension should be 350px X 400px
					</div>
					<?php if ($form['Image']->hasError()): ?>
							<div class="errormsgs" style = " color: #FF0000;font-size: 11px;font-weight: bold;padding: 2px 0 0;"><?php echo $form['Image']->getError()?></div>
					<?php endif; ?>
					</td>
				</tr>
				</div>
				<?php if($form->getObject()->isNew() != "create"):?>
				<tr>
					<td width="26%" class="fldrowbg" valign="Top" ><b><?php echo "Image Preview" ?>:</b></td>
					<td width="68%" class="fldrowlightbg">
					<?php
								/* Start to show the image in edit time */
								if( $form->getObject()->getImage() != "")
								{
									echo image_tag('../uploads/'.sfConfig::get("app_themebanner").$webId.DIRECTORY_SEPARATOR.sfConfig::get('app_banner').$form->getObject()->getImage(),array('border'=>'0','alt'=>'Image','title'=>$form->getObject()->getImage(),'width'=>'75px','height'=>'75px'));
								}
								/* End to show the image in edit time */
						?>
					</td>
				</tr>
				<?php endif; ?>

				<?php for($i =1;$i<=$totalBannerTitle;$i++): ?>
				
				<tr>
					<td width="26%" class="fldrowbg"><b><?php echo $form['Title'.$i]->renderLabel() ?>:</b></td>
					<td width="68%" class="fldrowlightbg">
					<?php echo $form['Title'.$i]->render() ?>
					<?php if ($form['Title'.$i]->hasError()): ?>
							<div class="errormsgs"><?php echo $form['Title'.$i]->getError()?></div>
					<?php endif; ?>
					</td>
				</tr>
				<?php endfor; ?>

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
function stockPhotoShowHide(id)
{
	
	if(id == "ThemeBanner_StockPhotoChoice_1")
	{
		$("#imgTr").show();
		window.document.getElementById("trStockPhoto").className = "stockPhotoNone";
		
	}
	else if(id == "ThemeBanner_StockPhotoChoice_0")
	{
		$("#imgTr").hide();
		openPopup('<?php echo url_for('themebanner/slider')?>');
	}
}

</script>


 <script>
 	function openPopup(id)
 	{
 		var left1 = (screen.width / 2)-(700/2);
 		var top1  = (screen.height / 2) -(500/2);
 
 		window.open(id,'','scrollbars=1,width=900,height=550,Top='+top1+',left='+left1); // height 500 if u want popup in middle

 	}
 </script>
 
<script type="text/javascript">
jQuery().ready(function() {

if($("#ThemeBanner_StockPhotoChoice_1").attr('checked'))  //when error comes at that time tr is display so this condition is write
{
	$("#imgTr").show();
}
	// validate form on keyup and submit
	jQuery("#ThemeBannerFrm").validate({
		errorClass: "errormsgs",
		rules: {
		    "ThemeBanner[BannerName]": {
				required: true,
				minlength: 3,
				maxlength: 150
			},
			"ThemeBanner[Image]": {

				required: function(element) {
								var valueChk = $("#ThemeBanner_StockPhotoChoice_1").attr('checked');
								if(valueChk == "checked")
								{
									var method = $("#sf_method").val();
									if(method == "put")
									{
										return false;
									}

									return true;
								}
								else
									return false;
								}
			},
			"ThemeBanner[StockPhotoChoice]":{
				required: function(element) {
								var method = $("#sf_method").val();
								if(method == "put")
									return false;
								else
									return true;
								},
			}

		},
		messages: {
		    "ThemeBanner[BannerName]": {
		      required: "This field is required.",
		      minlength: "Banner name must be at least 3 characters long.",
		      maxlength: "Banner Name cannot be longer than 150 characters."
		    },
		    "ThemeBanner[Image]": {
		      required: "This field is required.",
		    },
		    "ThemeBanner[StockPhotoChoice]": {
				 required: "This field is required.",
		    }
		}
	});
});
</script>
<?php include_partial('default/ajaxCall'); // AUTO CALL AT EVERY 15 MINUTE  ?>