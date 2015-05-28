<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

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
		<form id="ForumsTopicFrm" name="ForumsTopicFrm" action="<?php echo url_for('Forums/'.($form->getObject()->isNew() ? 'topicCreate' : 'updateTopic').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '').(!$form->getObject()->isNew() ? (($flagForumsId != "") ? '&flagForumsId='.$flagForumsId : '') : (($flagForumsId != "") ? '?flagForumsId='.$flagForumsId : ''))) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
		<?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
		
			<input type="hidden" value="<?php echo $flagForumsId; ?>" name="flagForumsId" id="flagForumsId" >
			<table width="97%" cellspacing="1" cellpadding="1" class="EditFAQ CaseEditForm" align="center">
			<!--<table width="65%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
				<tr class="fldbg">
					<td colspan="2" class="whttxt">Topic Detail</td>
				</tr>-->
				<tr>
					<!--<td align="center" class="fldrowbg error">*</td>-->
					<td width="26%" class="fldrowbg"><b><?php echo $form['ForumId']->renderLabel() ?>: </b><span class="error">*</span></td>
					<td width="68%" class="fldrowlightbg">
					<?php echo $form['ForumId']->render() ?>
					<?php if ($form['ForumId']->hasError()): ?>
						<div class="errormsgs"><?php echo $form['ForumId']->getError()?></div>
					<?php endif; ?>
					</td>
				</tr>
				<tr>
					<!--<td align="center" class="fldrowbg error">*</td>-->
					<td width="26%" class="fldrowbg"><b><?php echo $form['Topic']->renderLabel() ?>: </b><span class="error">*</span></td>
					<td width="68%" class="fldrowlightbg">
					<?php echo $form['Topic']->render() ?>
					<?php if ($form['Topic']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['Topic']->getError()?></div>
					<?php endif; ?>
					</td>
				</tr>
				<tr>
					<!--<td valign="Top" align="center" class="fldrowbg error">*</td>-->
					<td valign="Top" width="26%" class="fldrowbg"><b><?php echo $form['Description']->renderLabel() ?>: </b><span class="error">*</span></td>
					<td width="68%" class="fldrowlightbg">
					<?php echo $form['Description']->render() ?>
					<?php if ($form['Description']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['Description']->getError()?></div>
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
		</form>
	</td>
</tr>

<script type="text/javascript">
jQuery().ready(function() {

	// validate form on keyup and submit
	jQuery("#ForumsTopicFrm").validate({
		errorClass: "errormsgs",
		rules: {
		    "ForumsTopic[Topic]": {
				required: true,
				minlength: 3,
				maxlength: 256
			},
			"ForumsTopic[Description]": {
				required: true,
				minlength: 3,
			},
			"ForumsTopic[ForumId]": {
				required: true,
			},
		},
		messages: {
		    "ForumsTopic[Topic]": {
		      required: "This field is required.",
		      minlength: "Topic must be at least 3 characters long.",
		      maxlength: "Topic cannot be longer than 45 characters."
		    },
		    "ForumsTopic[Description]": {
		      required: "This field is required.",
		      minlength: "Description must be at least 3 characters long.",
		    },
		    "ForumsTopic[ForumId]":{
				required: "This field is required.",
		    },
		}
	});
});
</script>