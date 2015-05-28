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
		<form id="ForumsReplyFrm" name="ForumsReplyFrm" action="<?php echo url_for('forumreplay/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId().'&flagTopicId='.$flagTopicId : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
			<?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
			<table width="97%" cellspacing="1" cellpadding="1" class="EditFAQ CaseEditForm" align="center">
			<!--<table width="65%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">-->
				<!--<tr class="fldbg">
					<td colspan="2" class="whttxt">Forum Reply Detail</td>
				</tr>-->
				<tr>
					<!--<td align="center" class="fldrowbg error"></td>-->
					<td width="26%" class="fldrowbg"><b><?php echo "Forum Title" ?>:</b></td>
					<td width="68%" class="fldrowlightbg">
						<?php echo $forumTitle; ?>
					</td>
				</tr>
				<tr>
					<!--<td align="center" class="fldrowbg error"></td>-->
					<td width="26%" class="fldrowbg"><b><?php echo "Forum Topic" ?>:</b></td>
					<td width="68%" class="fldrowlightbg">
					<?php echo $forumTopic; ?>
					</td>
				</tr>
				<!--tr>
					<td align="center" class="fldrowbg error">*</td>
					<td width="26%" class="fldrowbg"><b><?php //echo $form['UserId']->renderLabel() ?>:</b></td>
					<td width="68%" class="fldrowbg">
					<?php //echo $form['UserId']->render() ?>
					<?php //if ($form['UserId']->hasError()): ?>
							<div class="errormsgs"><?php //echo $form['UserId']->getError()?></div>
					<?php //endif; ?>
					</td>
				</tr-->
				<tr>
					<!--<td valign="Top" align="center" class="fldrowbg error">*</td>-->
					<td valign="Top" width="26%" class="fldrowbg"><b><?php echo $form['Reply']->renderLabel() ?>: </b><span class="error">*</span></td>
					<td width="68%" class="fldrowlightbg">
					<?php echo $form['Reply']->render() ?>
					<?php if ($form['Reply']->hasError()): ?>
							<div class="errormsgs"><?php echo $form['Reply']->getError()?></div>
					<?php endif; ?>
					</td>
				</tr>
				<!--tr>
					<td align="center" class="fldrowbg error">*</td>
					<td width="26%" class="fldrowbg"><b><?php //echo $form['Status']->renderLabel() ?>:</b></td>
					<td width="68%" class="fldrowbg">
					<?php //echo $form['Status']->render() ?>
					<?php //if ($form['Status']->hasError()): ?>
							<div class="errormsgs"><?php //echo $form['Status']->getError()?></div>
					<?php //endif; ?>
					</td>
				</tr-->
				<!--tr>
					<td align="center" class="fldrowbg error">*</td>
					<td width="26%" class="fldrowbg"><b><?php //echo $form['CreateDateTime']->renderLabel() ?>:</b></td>
					<td width="68%" class="fldrowbg">
					<?php //echo $form['CreateDateTime']->render() ?>
					<?php //if ($form['CreateDateTime']->hasError()): ?>
							<div class="errormsgs"><?php //echo $form['CreateDateTime']->getError()?></div>
					<?php //endif; ?>
					</td>
				</tr-->
				<!--tr>
					<td align="center" class="fldrowbg error">*</td>
					<td width="26%" class="fldrowbg"><b><?php //echo $form['UpdateDateTime']->renderLabel() ?>:</b></td>
					<td width="68%" class="fldrowbg">
					<?php //echo $form['UpdateDateTime']->render() ?>
					<?php //if ($form['UpdateDateTime']->hasError()): ?>
							<div class="errormsgs"><?php //echo $form['UpdateDateTime']->getError()?></div>
					<?php //endif; ?>
					</td>
				</tr-->
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
	jQuery("#ForumsReplyFrm").validate({
		errorClass: "errormsgs",
		rules: {
			"ForumReply[Reply]": {
				required: true,
				minlength: 3,
			},
		},
		messages: {
		    "ForumReply[Reply]": {
		      required: "This field is required.",
		      minlength: "Reply must be at least 3 characters long.",
		    },
		}
	});
});
</script>