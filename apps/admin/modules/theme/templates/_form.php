<?php

if(!$form->getObject()->isNew())
	$asOptionsValues = $sf_data->getRaw('asOptionsValue');
else
	$asOptionsValues = array();
?>

<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php include_partial('default/message'); ?>
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
		<form name="ThemeFrm" id="ThemeFrm" action="<?php echo url_for('theme/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
			<?php if (!$form->getObject()->isNew()): ?><input id="sf_method" type="hidden" name="sf_method" value="put" /><?php endif; ?>
			<table width="65%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
				<tr class="fldbg">
					<td colspan="2" class="whttxt">Theme Detail</td>
				</tr>
				<tr>
					<!--<td align="center" class="fldrowbg error">*</td>-->
					<td width="26%" class="fldrowbg"><b><?php echo $form['Name']->renderLabel() ?>: </b><span class="error">*</span></td>
					<td width="65%" class="fldrowlightbg">
					<?php echo $form['Name']->render() ?>
					<?php if ($form['Name']->hasError()): ?>
						<div class="errormsgs"><?php echo $form['Name']->getError()?></div>
					<?php endif; ?>
					</td>
				</tr>
				<!--<tr>
					<td align="center" class="fldrowbg error">*</td>
					<td width="26%" class="fldrowbg"><b><?php //echo $form['UniqueName']->renderLabel() ?>:</b></td>
					<td width="68%" class="fldrowbg">
					<?php //echo $form['UniqueName']->render() ?>
					<?php //if ($form['UniqueName']->hasError()): ?>
						<div class="errormsgs"><?php //echo $form['UniqueName']->getError()?></div>
					<?php //endif; ?>
					</td>
				</tr>-->
				<tr>
					<!--<td align="center" class="fldrowbg error">*</td>-->
					<td width="26%" class="fldrowbg"><b><?php echo $form['ScreenShot']->renderLabel() ?>: </b><span class="error">*</span></td>
					<td width="65%" class="fldrowlightbg">
					<?php echo $form['ScreenShot']->render() ?>
					<?php if ($form['ScreenShot']->hasError()): ?>
						<div class="errormsgs" style = " color: #FF0000;font-size: 11px;font-weight: bold;padding: 2px 0 0;"><?php echo $form['ScreenShot']->getError()?></div>
					<?php endif; ?>
					</td>
				</tr>
				<tr>
					<!--<td valign="Top" align="center" class="fldrowbg error">*</td>-->
					<td valign="Top" width="26%" class="fldrowbg"><b><?php echo "Content" ?>: </b><span class="error">*</span></td>
					<td width="65%" class="fldrowlightbg">
					<?php echo $form['Features']->render() ?>
					<?php if ($form['Features']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['Features']->getError()?></div>
					<?php endif; ?>
					</td>
				</tr>
				<tr>
					<!--<td align="center" class="fldrowbg error"></td>-->
					<td valign="Top" width="15%" class="fldrowbg"><b><?php echo "Features" ?>: </b></td>
					<td width="65%" class="fldrowlightbg">

					<?php echo $form['ManageTopMenu']->render(array('style'=>'vertical-align:middle')) ?>
					<?php echo $form['ManageTopMenu']->renderLabel();?>
					<?php if ($form['ManageTopMenu']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['ManageTopMenu']->getError()?></div>
					<?php endif; ?>
					<br/>
					
					<?php echo $form['ManageFooterMenu']->render(array('style'=>'vertical-align:middle')) ?>
					<?php echo $form['ManageFooterMenu']->renderLabel();?>
					<?php if ($form['ManageFooterMenu']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['ManageFooterMenu']->getError()?></div>
					<?php endif; ?>
					<br/>

					<?php echo $form['ManageBanner']->render(array('style'=>'vertical-align:middle','onClick'=>"textBoxInableDisable('theme_ManageBanner','theme_BannerTitleCombo');")) ?>
					<?php echo $form['ManageBanner']->renderLabel();?>
					<?php if ($form['ManageBanner']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['ManageBanner']->getError()?></div>
					<?php endif; ?>
						<div id=BannerTitleProperty style ="display:none;">
								<table>
									<?php if(array_key_exists(sfConfig::get("app_Color_ManageBanner"),$asOptionsValues)):?>
									<tr>
										<td><?php echo $form[sfConfig::get("app_Options_BannerTitleCombo")]->renderLabel() ?></td>
										<td>
											<?php $form->setDefault(sfConfig::get('app_Options_BannerTitleCombo'),$asOptionsValues[sfConfig::get("app_Color_ManageBanner")]) ?>
											<?php echo $form[sfConfig::get('app_Options_BannerTitleCombo')]->render() ?>
										</td>
									</tr>
									<?php else:?>
									<tr>
										<td><?php echo $form[sfConfig::get("app_Options_BannerTitleCombo")]->renderLabel() ?></td>
										<td>
											<?php echo $form[sfConfig::get('app_Options_BannerTitleCombo')]->render(array('style'=>'vertical-align:middle','disabled'=>'disabled')) ?>
										</td>
									</tr>
									<?php endif; ?>
								</table>

								<table>
									<tr>
										<?php if(array_key_exists(sfConfig::get("app_Color_BannerBackground"),$asOptionsValues)):?>
											<?php if($asOptionsValues[sfConfig::get("app_Color_BannerBackground")] == "No"): ?>
												<td>
													<?php echo $form['BannerBackground']->render(array('style'=>'vertical-align:middle')) ?>
												</td>
											<?php else:?>
												<td>
												<?php echo $form['BannerBackground']->render(array('checked'=>'checked','style'=>'vertical-align:middle')) ?>
												</td>
											<?php endif; ?>
										<?php else:?>
											<td>
											<?php echo $form['BannerBackground']->render(array('style'=>'vertical-align:middle')) ?>
											</td>
										<?php endif; ?>
										<td>
											<?php echo $form['BannerBackground']->renderLabel();?>
										</td>
										<td>
											<?php if ($form['BannerBackground']->hasError()): ?>
												<div class="errormsgs"><?php echo $form['BannerBackground']->getError()?></div>
											<?php endif; ?>
										</td>
									</tr>
								</table>
						</div>
					<br/>
					
					

					<?php echo $form['ManageColorAndBackground']->render(array('style'=>'vertical-align:middle','onClick'=>"BGProperty();")) ?>
					<?php echo $form['ManageColorAndBackground']->renderLabel() ?>
					<?php if ($form['ManageColorAndBackground']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['ManageColorAndBackground']->getError()?></div>
					<?php endif; ?>
					<br/>
							<div id=backgroudProperty style ="display:none;">
								<table>

									<?php if(array_key_exists(sfConfig::get("app_Color_BGColor"),$asOptionsValues)):?>
									<tr>
										<td>
											<?php echo $form[sfConfig::get("app_Color_BGColor")]->render(array('checked'=>'checked','style'=>'vertical-align:middle','onClick'=>"textBoxInableDisable('theme_BGColor', 'theme_BGcolorPicker')")) ?>
											<?php echo $form[sfConfig::get("app_Color_BGColor")]->renderLabel() ?>
										</td>
										<td>
											<?php echo $form[sfConfig::get('app_Options_BGcolorPicker')]->render(array('value'=>$asOptionsValues[sfConfig::get("app_Color_BGColor")])) ?>
										</td>
									</tr>
									<?php else:?>
									<tr>
										<td>
											<?php echo $form[sfConfig::get("app_Color_BGColor")]->render(array('style'=>'vertical-align:middle','onClick'=>"textBoxInableDisable('theme_BGColor', 'theme_BGcolorPicker')")) ?>
											<?php echo $form[sfConfig::get("app_Color_BGColor")]->renderLabel() ?>
										</td>
										<td>
											<?php echo $form[sfConfig::get('app_Options_BGcolorPicker')]->render(array('disabled'=>'disabled')) ?>
										</td>
									</tr>
									<?php endif; ?>
									

									<?php if(array_key_exists(sfConfig::get("app_Color_TextColor"),$asOptionsValues)):?>
									<tr>
										<td>
											<?php echo $form[sfConfig::get("app_Color_TextColor")]->render(array('checked'=>'checked', 'style'=>'vertical-align:middle','onClick'=>"textBoxInableDisable('theme_TextColor', 'theme_TextcolorPicker')")) ?>
											<?php echo $form[sfConfig::get("app_Color_TextColor")]->renderLabel() ?>
										</td>
										<td>
											<?php echo $form[sfConfig::get('app_Options_TextcolorPicker')]->render(array('value'=>$asOptionsValues[sfConfig::get("app_Color_TextColor")])) ?>
										</td>
									</tr>
									<?php else:?>
									<tr>
										<td>
											<?php echo $form[sfConfig::get("app_Color_TextColor")]->render(array('style'=>'vertical-align:middle','onClick'=>"textBoxInableDisable('theme_TextColor', 'theme_TextcolorPicker')")) ?>
											<?php echo $form[sfConfig::get("app_Color_TextColor")]->renderLabel() ?>
										</td>
										<td>
											<?php echo $form[sfConfig::get('app_Options_TextcolorPicker')]->render(array('disabled'=>'disabled')) ?>
										</td>
									</tr>
									<?php endif; ?>


									<?php if(array_key_exists(sfConfig::get("app_Color_BorderColor"),$asOptionsValues)):?>
									<tr>
										<td>
											<?php echo $form[sfConfig::get("app_Color_BorderColor")]->render(array('checked'=>'checked','style'=>'vertical-align:middle','onClick'=>"textBoxInableDisable('theme_BorderColor', 'theme_BordercolorPicker')")) ?>
											<?php echo $form[sfConfig::get("app_Color_BorderColor")]->renderLabel() ?>
										</td>
										<td>
											<?php echo $form[sfConfig::get('app_Options_BordercolorPicker')]->render(array('value'=>$asOptionsValues[sfConfig::get("app_Color_BorderColor")])) ?>
										</td>
									</tr>
									<?php else:?>
									<tr>
										<td>
											<?php echo $form[sfConfig::get("app_Color_BorderColor")]->render(array('style'=>'vertical-align:middle','onClick'=>"textBoxInableDisable('theme_BorderColor', 'theme_BordercolorPicker')")) ?>
											<?php echo $form[sfConfig::get("app_Color_BorderColor")]->renderLabel() ?>
										</td>
										<td>
											<?php echo $form[sfConfig::get('app_Options_BordercolorPicker')]->render(array('disabled'=>'disabled')) ?>
										</td>
									</tr>
									<?php endif; ?>

									
									<?php if(array_key_exists(sfConfig::get("app_Color_LinkColor"),$asOptionsValues)):?>
									<tr>
										<td>
											<?php echo $form[sfConfig::get("app_Color_LinkColor")]->render(array('checked'=>'checked','style'=>'vertical-align:middle','onClick'=>"textBoxInableDisable('theme_LinkColor', 'theme_LinkcolorPicker')")) ?>
											<?php echo $form[sfConfig::get("app_Color_LinkColor")]->renderLabel() ?>
										</td>
										<td>
											<?php echo $form[sfConfig::get('app_Options_LinkcolorPicker')]->render(array('value'=>$asOptionsValues[sfConfig::get("app_Color_LinkColor")])) ?>
										</td>
									</tr>
									<?php else:?>
									<tr>
										<td>
											<?php echo $form[sfConfig::get("app_Color_LinkColor")]->render(array('style'=>'vertical-align:middle','onClick'=>"textBoxInableDisable('theme_LinkColor', 'theme_LinkcolorPicker')")) ?>
											<?php echo $form[sfConfig::get("app_Color_LinkColor")]->renderLabel() ?>
										</td>
										<td>
											<?php echo $form[sfConfig::get('app_Options_LinkcolorPicker')]->render(array('disabled'=>'disabled')) ?>
										</td>
									</tr>
									<?php endif; ?>


									<?php if(array_key_exists(sfConfig::get("app_Color_LinkHoverColor"),$asOptionsValues)):?>
									<tr>
										<td>
											<?php echo $form[sfConfig::get("app_Color_LinkHoverColor")]->render(array('checked'=>'checked','style'=>'vertical-align:middle','onClick'=>"textBoxInableDisable('theme_LinkHoverColor', 'theme_LinkHoverColorPicker')")) ?>
											<?php echo $form[sfConfig::get("app_Color_LinkHoverColor")]->renderLabel() ?>
										</td>
										<td>
											<?php echo $form[sfConfig::get('app_Options_LinkHoverColorPicker')]->render(array('value'=>$asOptionsValues[sfConfig::get("app_Color_LinkHoverColor")])) ?>
										</td>
									</tr>
									<?php else:?>
									<tr>
										<td>
											<?php echo $form[sfConfig::get("app_Color_LinkHoverColor")]->render(array('style'=>'vertical-align:middle','onClick'=>"textBoxInableDisable('theme_LinkHoverColor', 'theme_LinkHoverColorPicker')")) ?>
											<?php echo $form[sfConfig::get("app_Color_LinkHoverColor")]->renderLabel() ?>
										</td>
										<td>
											<?php echo $form[sfConfig::get('app_Options_LinkHoverColorPicker')]->render(array('disabled'=>'disabled')) ?>
										</td>
									</tr>
									<?php endif; ?>
								</table>
						</div>
					
					<?php echo $form['ManageSocialMedia']->render(array('style'=>'vertical-align:middle')) ?>
					<?php echo $form['ManageSocialMedia']->renderLabel() ?>
					<?php if ($form['ManageSocialMedia']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['ManageSocialMedia']->getError()?></div>
					<?php endif; ?>
					<br/>

					<?php echo $form['ChangeLogo']->render(array('style'=>'vertical-align:middle')) ?>
					<?php echo $form['ChangeLogo']->renderLabel() ?>
					<?php if ($form['ChangeLogo']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['ChangeLogo']->getError()?></div>
					<?php endif; ?>
					<br/>

					<?php echo $form['ManageFAQs']->render(array('style'=>'vertical-align:middle')) ?>
					<?php echo $form['ManageFAQs']->renderLabel() ?>
					<?php if ($form['ManageFAQs']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['ManageFAQs']->getError()?></div>
					<?php endif; ?>
					<br/>
					
					<?php echo $form[sfConfig::get("app_Color_TextWidgets")]->render(array('style'=>'vertical-align:middle','onClick'=>"textBoxInableDisable('theme_TextWidgets','theme_TextWidgetCombo');")) ?>
					<?php echo $form[sfConfig::get("app_Color_TextWidgets")]->renderLabel() ?>
					<?php if ($form[sfConfig::get("app_Color_TextWidgets")]->hasError()): ?>
							<div class="errormsgs"><?php echo $form[sfConfig::get("app_Color_TextWidgets")]->getError()?></div>
					<?php endif; ?>
						<div id=TextWidgetProperty style ="display:none;">
								<table>
									<?php if(array_key_exists(sfConfig::get("app_Color_TextWidgets"),$asOptionsValues)):?>
									<tr>
										<td><?php echo $form[sfConfig::get("app_Options_TextWidgetCombo")]->renderLabel() ?></td>
										<td>
											<?php $form->setDefault(sfConfig::get('app_Options_TextWidgetCombo'),$asOptionsValues[sfConfig::get("app_Color_TextWidgets")]) ?>
											<?php echo $form[sfConfig::get('app_Options_TextWidgetCombo')]->render() ?>
										</td>
									</tr>
									<?php else:?>
									<tr>
										<td><?php echo $form[sfConfig::get("app_Options_TextWidgetCombo")]->renderLabel() ?></td>
										<td>
											<?php echo $form[sfConfig::get('app_Options_TextWidgetCombo')]->render(array('style'=>'vertical-align:middle','disabled'=>'disabled')) ?>
										</td>
									</tr>
									<?php endif; ?>
								</table>
						</div>
					</br>

					<?php echo $form['BodyBackground']->render(array('style'=>'vertical-align:middle')) ?>
					<?php echo $form['BodyBackground']->renderLabel();?>
					<?php if ($form['BodyBackground']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['BodyBackground']->getError()?></div>
					<?php endif; ?>
					
					</td>
				</tr>
				<tr class="fldbg">
					<td height="33" align="center" class="fldrowbg error">&nbsp;</td>
					<td height="33" class="fldrowbg" colspan="2" align="left">
					<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?>    
							<?php echo $form->renderHiddenFields(false) ?>
						</td>
				</tr>
			</table>
		</form>
	</td>
</tr>

<script type="text/javascript">

	$(document).ready(function() {

		if($("#theme_ManageColorAndBackground").attr("checked") == "checked")
			$("#backgroudProperty").css("display", "block");
		else
			$("#backgroudProperty").css("display", "none");

		/* START this is for textWidget */
		if($("#theme_TextWidgets").attr("checked") == "checked")
		{
			$("#TextWidgetProperty").css("display", "block");
			$("#theme_TextWidgetCombo").removeAttr("disabled");
		}
		else
			$("#TextWidgetProperty").css("display", "none");
			
		
		/* END this is for textWidget */
		
		/* START this is for Banner management */
		if($("#theme_ManageBanner").attr("checked") == "checked")
		{
			$("#BannerTitleProperty").css("display", "block");
			$("#theme_BannerTitleCombo").removeAttr("disabled");
		}
		else
			$("#BannerTitleProperty").css("display", "none");

		/* END this is for Banner management */
	});

	function BGProperty()
	{
		if($("#theme_ManageColorAndBackground").attr("checked") == "checked")
			$("#backgroudProperty").css("display", "block");
		else
			$("#backgroudProperty").css("display", "none");
	}

	function textBoxInableDisable(chkId,texId)
	{
		if($("#"+chkId).attr("checked") == "checked")
		{
			$("#"+texId).removeAttr("disabled");
			$("#"+texId).focus();
		}
		else
		{
			$("#"+texId).attr("disabled","disabled");
			$("#"+texId).val('');
		}
	}
	
	//function textwidgetShowHide()
	$("#theme_TextWidgets").click(function(){
	
		if($("#theme_TextWidgets").attr("checked") == "checked")
			$("#TextWidgetProperty").css("display", "block");
		else
			$("#TextWidgetProperty").css("display", "none");
	});
	
	//function banner title 
	$("#theme_ManageBanner").click(function(){
	
		if($("#theme_ManageBanner").attr("checked") == "checked")
			$("#BannerTitleProperty").css("display", "block");
		else
		{
			$("#BannerTitleProperty").css("display", "none");
			$("#theme_BannerBackground").attr("checked",false);
		}
	});
</script>
<script type="text/javascript">
jQuery().ready(function() {

	// validate form on keyup and submit
	jQuery("#ThemeFrm").validate({
		errorClass: "errormsgs",
		rules: {
		    "theme[Name]": {
				required: true,
				minlength: 3,
				maxlength: 50
			},
			"theme[Features]": {
				required: true,
				minlength: 3,
			},
			"theme[ScreenShot]":{
				required: function(element) {
								return $("#sf_method").val() != 'put';
								}
			},
		},
		messages: {
		    "theme[Name]": {
		      required: "This field is required.",
		      minlength: "Name must be at least 3 characters long.",
		      maxlength: "Name cannot be longer than 50 characters."
		    },
		    "theme[Features]": {
		      required: "This field is required.",
		      minlength: "Content must be at least 3 characters long.",
		    },
		    "theme[ScreenShot]": {
		      required: "This field is required.",
		    },

		}
	});
});
</script>
