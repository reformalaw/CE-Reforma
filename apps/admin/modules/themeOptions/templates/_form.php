<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php $temp = array();

// in this array we get all options of theme
$themeOptions = $sf_data->getRaw('featureListArr');
$allColorOptions = $themeOptions["AllOptions"];

if ($featureListArr['ManageColorAndBackground'] == "Yes"){
    $temp = array_merge(sfConfig::get('app_ThemeOptions_Color'),sfConfig::get('app_ThemeOptions_Image'));
}
if ($featureListArr['ManageSocialMedia'] == "Yes") {
    $temp = array_merge($temp,sfConfig::get('app_ThemeOptions_SocialMedia'));
}
if ($featureListArr['ManageChangeLogo'] == "Yes") {
    $temp = array_merge($temp,sfConfig::get('app_ThemeOptions_Logo'));
}
if ($featureListArr['BodyBackground'] == "Yes") {
    $temp = array_merge($temp,sfConfig::get('app_ThemeOptions_BodyBackground'));
}
// if ($featureListArr['ManageTextWidget'] == "Yes") {
//     $temp = array_merge($temp,sfConfig::get('app_ThemeOptions_TextWidgets'));
// }
//clsCommon::pr($temp,1);
//clsCommon::pr($featureListArr,1);
?>
<tr valign="top">
 <td colspan="2" class="ListAreaPad">
  <table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <?php if ($form->hasGlobalErrors()): ?>
   <tr>
    <td class="dot2"></td>
   </tr>
   <?php foreach ($form->getGlobalErrors() as $name => $error): ?>
     <tr>
      <td class="errormss" align="center"><?php echo $name.': '.$error ?></td>
     </tr>
   <?php endforeach; ?>
   <tr>
    <td class="dot2"></td>
   </tr>
  <?php endif; ?>
  </table>
 </td>
</tr>
<tr valign="top">
 <td colspan="2" class="ListAreaPad">
  <!--<form action="<?php //echo url_for('themeOptions/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php //$form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>-->
  <form action="<?php echo url_for('themeOptions/editRecords?websiteId='.sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId')); ?>" method='post' enctype='multipart/form-data'>
  <?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
  <!--<table width="65%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">-->
  <table width="97%" cellspacing="1" cellpadding="1" class="EditFAQ" align="center">
    <?php 
    if ($featureListArr['ManageColorAndBackground'] == "Yes"){ ?>
    <!--<tr class="fldbg">
        <td colspan="2" class="whttxt">Theme Color & Background Details</td>
    </tr>-->

    <?php if(array_key_exists("BGColor",$allColorOptions)): ?>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "Background Color ";//$form[$temp['BGColor']]->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowlightbg"><?php echo $form[$temp['BGColor']]->render(); ?></td>
    </tr>
    <?php endif; ?>

    <?php if(array_key_exists("TextColor",$allColorOptions)): ?>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "Text Color ";//$form[$temp['TextColor']]->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowlightbg"><?php echo $form[$temp['TextColor']]->render(); ?></td>
    </tr>
    <?php endif; ?>

    <?php if(array_key_exists("BorderColor",$allColorOptions)): ?>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "Border Color ";//$form[$temp['BorderColor']]->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowlightbg"><?php echo $form[$temp['BorderColor']]->render(); ?></td>
    </tr>
	<?php endif; ?>

	<?php if(array_key_exists("LinkColor",$allColorOptions)): ?>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "Link Color ";//$form[$temp['BorderColor']]->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowlightbg"><?php echo $form[$temp['LinkColor']]->render(); ?></td>
    </tr>
    <?php endif; ?>

    <?php if(array_key_exists("LinkHoverColor",$allColorOptions)): ?>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "Link Hover Color ";//$form[$temp['BorderColor']]->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowlightbg"><?php echo $form[$temp['LinkHoverColor']]->render(); ?></td>
    </tr>
    <?php endif; ?>

    <!--<tr>
      <td width="26%" class="fldrowbg"><b><?php //echo "Background Image ";//$form[$temp['BGImage']]->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowlightbg"><?php //echo $form[$temp['BGImage']]->render();?></td>
    </tr>-->
    <!--tr>
      <td width="26%" class="fldrowbg" valign="top"><b>Current Background Image :</b></td>
      <td width="68%" class="fldrowlightbg">
      <?php /* if (!empty($editArr['BGImage']) && isset($editArr['BGImage'])){ ?>
    <?php $bgImagePath =  "/uploads/website/".sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId')."/back-images/".$editArr['BGImage']; ?>
    <?php echo image_tag($bgImagePath,array('style'=>'width:auto;height:60px;')); ?>
      <?php } */ ?>
      </td>
    </tr-->
    <?php } ?>
    <?php if ($featureListArr['ManageChangeLogo'] == "Yes") { ?>
    <tr class="fldbg">
        <td colspan="2" class="whttxt">Theme Logo Options</td>
    </tr> 
    <tr>
      <td width="26%" class="fldrowbg" valign="top"><b>Current Logo :</b></td>
      <td width="68%" class="fldrowlightbg">
      <?php if (!empty($editArr['Logo']) && isset($editArr['Logo'])){ ?>
      <?php $logoImagePath = "/uploads/website/".sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId')."/logo/".$editArr['Logo']; ?>
      <?php echo image_tag($ssSiteUrl.$logoImagePath,array('style'=>'width:auto;height:60px;'));?>
      <?php } ?>
      </td>
    </tr>

    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "Select Logo "; ?>:</b></td>
      <td width="68%" class="fldrowlightbg">
        <ul class="radio_list">
            <li><input type="radio" name="logoSetting[]" id="logo_setting_1" onClick="logoSelection('logo_setting_1');">
                <label>From Stock Photo</label> </li>
            <li><input type="radio" name="logoSetting[]" id="logo_setting_2" onClick="logoSelection('logo_setting_2');">
                <label>Your Own Image</label></li>
		</ul>      
		</td>
   </tr>
				<input id="stockPhotoId" type="hidden" name="stockPhotoId" value="" >
				<tr id="customTr" style="display:none;">
						<td width="26%" class="fldrowbg"><b><?php echo "Logo ";//$form[$temp['Logo']]->renderLabel() ?>:</b></td>
						<td width="68%" class="fldrowlightbg"><?php echo $form[$temp['Logo']]->render();?>
						<div class="noteDisplay"></br><strong >	Note: </strong></br>
										1. Only jpeg, jpg, png, gif are allowed </br>
										2. For better result dimension should be 225px X 50px </div>
						</td>
				</tr>
   
				<tr id="stockPhotoTr" style="display:none;">
					<td width="26%" class="fldrowbg" valign="top"><b>Logo :</b> </td>
					<td width="68%" class="fldrowlightbg">
						<span  class="noteDisplay"><strong>Note: </strong>Select any one image from below</span>
						<div id="tS2" class="jThumbnailScroller" style="height:124px;">
							<div class="jTscrollerContainer">
								<div class="jTscroller">
									<?php
										foreach($logoImages as $logoImage) : ?>
											<div style="float:left;width:185px;text-align:center;">
												</br>
												<?php echo $logoImage["Title"]; ?>
												<a href="javascript:void(0);" >
												<!--<a href="<?php //echo $ssSiteUrl; ?>/uploads/Media/Logo/<?php //echo $logoImage["ImageName"]; ?>" rel="lightbox" >-->
													<?php echo image_tag('../uploads/stockPhotoThumb/Logo/'.$logoImage["ImageName"], array('border'=>'1','alt'=>'Image','title'=>"",'width'=>'90px','height'=>'50px'))?>
													<?php $imagePath = $ssSiteUrl.'/uploads/stockPhotoThumb/Logo/'.$logoImage["ImageName"]; ?>
												</a>
												<div class="redio-btn">
													<?php 	$imageWidthHeight = getimagesize($ssSiteUrl."/uploads/Media/Logo/".$logoImage["ImageName"]); ?>
													<input  onClick="setHiddenImage('Logo_<?php echo $logoImage["Id"];?>');" type="radio" name="backgroundImageName[]"   id="Background_<?php echo $logoImage["Id"]; ?>"/><?php //echo "</br>Width:".$imageWidthHeight[0]."px"."</br>Height:".$imageWidthHeight[1]."px"; ?>
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
    
   
    <?php } ?>
    
    <!--BODY BACKGROUND-->
    
    <?php if ($featureListArr['BodyBackground'] == "Yes") { ?>
    <tr class="fldbg">
        <td colspan="2" class="whttxt">Theme Body Background</td>
    </tr> 
    <tr>
      <td width="26%" class="fldrowbg" valign="top"><b>Current Body Background :</b></td>
      <td width="68%" class="fldrowlightbg">
      <?php if (!empty($editArr['BodyBackground']) && isset($editArr['BodyBackground'])){ ?>
      <?php $bodyBackgroundImagePath = "/uploads/website/".sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId')."/body-background/".$editArr['BodyBackground']; ?>
      <?php echo image_tag($ssSiteUrl.$bodyBackgroundImagePath,array('style'=>'width:auto;height:60px;'));?>
      <?php } ?>
      </td>
    </tr>

    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "Select Body Background "; ?>:</b></td>
      <td width="68%" class="fldrowlightbg">
        <ul class="radio_list">
            <li><input type="radio" name="bodyBackgroundSetting[]" id="bodyBackground_setting_1" onClick="bodyBackgroundSelection('bodyBackground_setting_1');">
                <label>From Stock Photo</label> </li>
            <li><input type="radio" name="bodyBackgroundSetting[]" id="bodyBackground_setting_2" onClick="bodyBackgroundSelection('bodyBackground_setting_2');">
                <label>Your Own Image</label></li>
		</ul>
		</td>
	</tr>
				<input id="bodyBackgroundPhotoId" type="hidden" name="bodyBackgroundPhotoId" value="" >
				<tr id="bodyBackgroundCustomTr" style="display:none;">
						<td width="26%" class="fldrowbg"><b><?php echo "Body Background ";//$form[$temp['Logo']]->renderLabel() ?>:</b></td>
						<td width="68%" class="fldrowlightbg"><?php echo $form[$temp['BodyBackground']]->render();?>
						<div class="noteDisplay"></br><strong >	Note: </strong>Only jpeg, jpg, png, gif are allowed </div>
						</td>
				</tr>
   
				<tr id="bodyBackgroundStockPhotoTr" style="display:none;">
					<td width="26%" class="fldrowbg" valign="top"><b>Body Background :</b> </td>
					<td width="68%" class="fldrowlightbg">
						<span  class="noteDisplay"><strong>Note: </strong>Select any one image from below</span>
						<div id="unsortedScroll" class="jThumbnailScroller" style="height:124px;">
							<div class="jTscrollerContainer">
								<div class="jTscroller">
									<?php
										foreach($bodyBackgroundImages as $bodyBackgroundImage) : ?>
											<div style="float:left;width:185px;text-align:center;">
												</br>
												<?php echo $bodyBackgroundImage["Title"]; ?>
												<a href="javascript:void(0);" >
												<!--<a href="<?php //echo $ssSiteUrl; ?>/uploads/Media/Logo/<?php //echo $logoImage["ImageName"]; ?>" rel="lightbox" >-->
													<?php echo image_tag('../uploads/stockPhotoThumb/Body-Background/'.$bodyBackgroundImage["ImageName"], array('border'=>'1','alt'=>'Image','title'=>"",'width'=>'90px','height'=>'50px'))?>
													<?php $imagePath = $ssSiteUrl.'/uploads/stockPhotoThumb/Body-Background/'.$bodyBackgroundImage["ImageName"]; ?>
												</a>
												<div class="redio-btn">
													<?php 	$imageWidthHeight = getimagesize($ssSiteUrl."/uploads/Media/Body-Background/".$bodyBackgroundImage["ImageName"]); ?>
													<input  onClick="setHiddenBodyBackgroundImage('BodyBackground_<?php echo $bodyBackgroundImage["Id"];?>');" type="radio" name="bodyBackgroundImageName[]"   id="BodyBackground_<?php echo $bodyBackgroundImage["Id"]; ?>"/><?php //echo "</br>Width:".$imageWidthHeight[0]."px"."</br>Height:".$imageWidthHeight[1]."px"; ?>
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
    
   
    <?php } ?>
    
    <!--BODY BACKGROUND-->
    
    <?php if ($featureListArr['ManageSocialMedia'] == "Yes") { ?>
    <tr valign="top">
        <td class="ListAreaPad" colspan="2">
            <table width="55%" align="center" cellspacing="0" cellpadding="0" border="0"></table>
        </td>
    </tr>  
    <tr class="fldbg">
        <td colspan="3" class="whttxt">Theme Social Media Options</td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "Facebook Page Name ";//$form[$temp['Facebook']]->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowlightbg"><?php echo $form[$temp['Facebook']]->render(array('style'=>'width:250px;')); ?></td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "Twitter Page Name ";//$form[$temp['Twitter']]->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowlightbg"><?php echo $form[$temp['Twitter']]->render(array('style'=>'width:250px;')); ?></td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "Linked In Page Name ";//$form[$temp['LinkedIn']]->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowlightbg"><?php echo $form[$temp['LinkedIn']]->render(array('style'=>'width:250px;')); ?></td>
    </tr>
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "Google+ Page Name ";//$form[$temp['Google']]->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowlightbg"><?php echo $form[$temp['Google']]->render(array('style'=>'width:250px;')); ?></td>
    </tr>
    <!--<tr>
      <td width="26%" class="fldrowbg"><b><?php #echo "Skype Name ";//$form[$temp['Skype']]->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowlightbg"><?php #echo $form[$temp['Skype']]->render(array('style'=>'width:250px;')); ?></td>
    </tr>-->
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "Rss Feed ";//$form[$temp['Skype']]->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowlightbg"><?php echo $form[$temp['Rss']]->render(array('style'=>'width:250px;')); ?></td>
    </tr>
    <?php } ?>
    
    <?php /*if ($featureListArr['ManageTextWidget'] == "Yes") { ?>
      <tr valign="top">
      <td class="ListAreaPad" colspan="2">
      <table width="55%" align="center" cellspacing="0" cellpadding="0" border="0"></table>
      </td>
      </tr>
      <tr class="fldbg">
      <td colspan="2" class="whttxt">Text Widgets Options</td>
      </tr>
      <?php
      $widgetLength = ThemeTable::getWidgetLength();
      for ($i=1;$i<($widgetLength+1);$i++) {?>
      <tr>
      <td width="26%" class="fldrowbg" valign="top"><b><?php echo "Text Widget Title ".$i." ";//$form[$temp['Logo']]->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowlightbg"><?php echo $form['TextWidgetsTitle'."_".$i]->render(array('maxlength'=>20,'size'=>20));?><span>&nbsp;&nbsp;<b>Note :</b>&nbsp;Maximum Length 20 Characters</span></td>
      </tr>
      <tr>
      <td width="26%" class="fldrowbg" valign="top"><b><?php echo "Text Widget ".$i." ";//$form[$temp['Logo']]->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowlightbg"><?php echo $form[$temp['TextWidgets']."_".$i]->render(array('style'=>'width: 250px;'));?></td>
      </tr>
      <?php } ?>
    <?php } */ ?>
   <tr class="fldbg">
    <td height="33" align="center" class="fldrowbg error">&nbsp;</td>
    <td class="fldrowbg" colspan="2" align="left">
    <?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save','onClick'=>'FrmTrim()')); ?>    
              <?php echo $form->renderHiddenFields(false) ?>
        </td>
   </tr>
  </table>
  </form>
 </td>
</tr><?php #clsCommon::pr($editArr); clsCommon::pr(explode('#',$editArr['BGColor']));?>

<script type="text/javascript">
/* this function is for trim the social media value added by jaydip dodiya */
function FrmTrim()
{
	'<?php if ($featureListArr['ManageSocialMedia'] == "Yes") { ?>'
	$("#theme_options_Facebook").val( $.trim($("#theme_options_Facebook").val()) ) ;
	$("#theme_options_Twitter").val( $.trim($("#theme_options_Twitter").val()) ) ;
	$("#theme_options_LinkedIn").val( $.trim($("#theme_options_LinkedIn").val()) ) ;
	$("#theme_options_Google").val( $.trim($("#theme_options_Google").val()) ) ;
	$("#theme_options_Rss").val( $.trim($("#theme_options_Rss").val()) ) ;
	'<?php } ?>'
	
}
</script>
<script type="text/javascript">

	function setHiddenImage(id)
	{
		document.getElementById("stockPhotoId").value = id;
	}

	function setHiddenBodyBackgroundImage(id)
	{
		document.getElementById("bodyBackgroundPhotoId").value = id;
	}
	
	function bodyBackgroundSelection(id)
	{
		if(id == "bodyBackground_setting_2")
		{
			$("#bodyBackgroundCustomTr").show();
			$("#stockPhotoPreviewTr").hide();
			$("#bodyBackgroundStockPhotoTr").hide();

			$('[name="bodyBackgroundImageName[]"]:checked').removeAttr('checked');
			document.getElementById("bodyBackgroundPhotoId").value = "";
		}
		else if(id == "bodyBackground_setting_1")
		{
			setTimeout(function() {
				$("#bodyBackgroundCustomTr").hide();
				$("#bodyBackgroundStockPhotoTr").show();
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
			}, 500);

		}
	}
	function logoSelection(id)
	{
		if(id == "logo_setting_2")
		{
			$("#customTr").show();
			$("#stockPhotoPreviewTr").hide();
			$("#stockPhotoTr").hide();

			$('[name="backgroundImageName[]"]:checked').removeAttr('checked');
			document.getElementById("stockPhotoId").value = "";
		}
		else if(id == "logo_setting_1")
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
<?php

if ($form->getObject()->isNew()){ //THIS JAVASCRIPT FOR EDIT MODE ONLY..
    if(isset($editArr['BGColor']))
    $bgColor        = explode('#',$editArr['BGColor']);
    else
    $bgColor      = array( 0 => '', 1 => ''  );

    if(isset($editArr['TextColor']))
    $textColor      = explode('#',$editArr['TextColor']);
    else
    $textColor      = array( 0 => '', 1 => ''  );

    if(isset($editArr['BorderColor']))
    $borderColor    = explode('#',$editArr['BorderColor']);
    else
    $borderColor      = array( 0 => '', 1 => ''  );


    if(isset($editArr['LinkColor']))
    $linkColor      = explode('#',$editArr['LinkColor']);
    else
    $linkColor      = array( 0 => '', 1 => ''  );

    if(isset($editArr['LinkHoverColor']))
    $linkHoverColor      = explode('#',$editArr['LinkHoverColor']);
    else
    $linkHoverColor      = array( 0 => '', 1 => '' );

    ?>

    $('#theme_options_BGColor').val('<?php echo $bgColor[1];?>'); // SET THE BACKGROUND COLOR VALUE IN COLOR PICKER
    $('#theme_options_TextColor').val('<?php echo $textColor[1];?>'); // SET THE TEXT COLOR VALUE IN COLOR PICKER
    $('#theme_options_BorderColor').val('<?php echo $borderColor[1];?>'); // SET THE BORDER COLOR VALUE IN COLOR PICKER
    $('#theme_options_LinkColor').val('<?php echo $linkColor[1];?>'); // SET THE BORDER COLOR VALUE IN COLOR PICKER
    $('#theme_options_LinkHoverColor').val('<?php echo $linkHoverColor[1];?>'); // SET THE BORDER COLOR VALUE IN COLOR PICKER

    setTimeout(myTimeoutFunction, 100);

    function myTimeoutFunction() {
        <?php if(isset($editArr['BGColor'])) { ?>
        $('#theme_options_BGColor').css('backgroundColor', '<?php echo $editArr['BGColor'];?>');    // SET THE BACKGROUND COLOR OF INPUT FIELD OF BG COLOR
        <?php } ?>

        <?php if(isset($editArr['TextColor'])) { ?>
        $('#theme_options_TextColor').css('backgroundColor', '<?php echo $editArr['TextColor'];?>');    // SET THE BACKGROUND COLOR OF INPUT FIELD OF TEXT COLOR
        <?php } ?>

        <?php if(isset($editArr['BorderColor'])) { ?>
        $('#theme_options_BorderColor').css('backgroundColor', '<?php echo $editArr['BorderColor'];?>');    // SET THE BACKGROUND COLOR OF INPUT FIELD OF BORDER COLOR
        <?php } ?>

        <?php if(isset($editArr['LinkColor'])) { ?>
        $('#theme_options_LinkColor').css('backgroundColor', '<?php echo $editArr['LinkColor'];?>');    // SET THE BACKGROUND COLOR OF INPUT FIELD OF BORDER COLOR
        <?php } ?>

        <?php if(isset($editArr['LinkHoverColor'])) { ?>
        $('#theme_options_LinkHoverColor').css('backgroundColor', '<?php echo $editArr['LinkHoverColor'];?>');    // SET THE BACKGROUND COLOR OF INPUT FIELD OF BORDER COLOR
        <?php } ?>

    }
    <?php } ?>
    <?php
    if (!$form->getObject()->isNew()){ //THIS JAVASCRIPT FOR EDIT MODE ONLY..
        if(isset($editArr['BGColor']))
        $bgColor        = explode('#',$editArr['BGColor']);
        else
        $bgColor      = array( 0 => '', 1 => ''  );

        if(isset($editArr['TextColor']))
        $textColor      = explode('#',$editArr['TextColor']);
        else
        $textColor      = array( 0 => '', 1 => ''  );

        if(isset($editArr['BorderColor']))
        $borderColor    = explode('#',$editArr['BorderColor']);
        else
        $borderColor      = array( 0 => '', 1 => ''  );


        if(isset($editArr['LinkColor']))
        $linkColor      = explode('#',$editArr['LinkColor']);
        else
        $linkColor      = array( 0 => '', 1 => ''  );

        if(isset($editArr['LinkHoverColor']))
        $linkHoverColor      = explode('#',$editArr['LinkHoverColor']);
        else
        $linkHoverColor      = array( 0 => '', 1 => '' );

        ?>

        $('#theme_options_BGColor').val('<?php echo $bgColor[1];?>'); // SET THE BACKGROUND COLOR VALUE IN COLOR PICKER
        $('#theme_options_TextColor').val('<?php echo $textColor[1];?>'); // SET THE TEXT COLOR VALUE IN COLOR PICKER
        $('#theme_options_BorderColor').val('<?php echo $borderColor[1];?>'); // SET THE BORDER COLOR VALUE IN COLOR PICKER
        $('#theme_options_LinkColor').val('<?php echo $linkColor[1];?>'); // SET THE BORDER COLOR VALUE IN COLOR PICKER
        $('#theme_options_LinkHoverColor').val('<?php echo $linkHoverColor[1];?>'); // SET THE BORDER COLOR VALUE IN COLOR PICKER

        setTimeout(myTimeoutFunction, 100);

        function myTimeoutFunction() {
            <?php if(isset($editArr['BGColor'])) { ?>
            $('#theme_options_BGColor').css('backgroundColor', '<?php echo $editArr['BGColor'];?>');    // SET THE BACKGROUND COLOR OF INPUT FIELD OF BG COLOR
            <?php } ?>

            <?php if(isset($editArr['TextColor'])) { ?>
            $('#theme_options_TextColor').css('backgroundColor', '<?php echo $editArr['TextColor'];?>');    // SET THE BACKGROUND COLOR OF INPUT FIELD OF TEXT COLOR
            <?php } ?>

            <?php if(isset($editArr['BorderColor'])) { ?>
            $('#theme_options_BorderColor').css('backgroundColor', '<?php echo $editArr['BorderColor'];?>');    // SET THE BACKGROUND COLOR OF INPUT FIELD OF BORDER COLOR
            <?php } ?>

            <?php if(isset($editArr['LinkColor'])) { ?>
            $('#theme_options_LinkColor').css('backgroundColor', '<?php echo $editArr['LinkColor'];?>');    // SET THE BACKGROUND COLOR OF INPUT FIELD OF BORDER COLOR
            <?php } ?>

            <?php if(isset($editArr['LinkHoverColor'])) { ?>
            $('#theme_options_LinkHoverColor').css('backgroundColor', '<?php echo $editArr['LinkHoverColor'];?>');    // SET THE BACKGROUND COLOR OF INPUT FIELD OF BORDER COLOR
            <?php } ?>

        }
        <?php } ?>
</script>