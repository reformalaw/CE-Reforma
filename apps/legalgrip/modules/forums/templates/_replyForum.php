<?php if($sf_user->hasFlash('succMsg')): ?>
	<div style="margin-top:100px;">
		<?php include_partial('default/message'); ?>
	</div>

	<?php else: ?>
		<form id="ReplyForumsFrm" name="ReplyForumsFrm" action="<?php echo url_for('forums/'.($form->getObject()->isNew() ? 'createReply' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
			<?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
			<input type="hidden" value="<?php echo $forumsId; ?>" name="LGForumId" id="LGForumId">
			<input type="hidden" value="<?php echo $topicId; ?>" name="LGTopicId" id="LGTopicId">
			<div class="topicforum">
				<ul>
					<li><label>Forum Title :</label> <?php echo $forumTitle; ?> </li>
					<li class="message"><label>Forum Topic :</label> <?php echo $forumTopic; ?> </li>
					<li class="message"><?php echo $form['Reply']->renderLabel() ?><!--<span>*</span>-->
						<?php echo $form['Reply']->render() ?>
						<?php if ($form['Reply']->hasError()): ?>
								<div class="errormsgs"><?php echo $form['Reply']->getError()?></div>
						<?php endif; ?>
					</li>
					<li style="margin-top:15px;">
						<?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?>
						<?php echo $form->renderHiddenFields(false) ?>
					</li>
				</ul>
			</div>
		</form>
	<?php endif; ?>
<script type="text/javascript">
jQuery().ready(function() {

	jQuery("#ReplyForumsFrm").validate({
		errorClass: "errormsgs",
		rules: {
			"ForumReply[Reply]": {
				required: true,
				minlength: 3,
			},
		},
		messages: {
		    "ForumReply[Reply]": {
		      required: "Please Enter the Reply",
		      minlength: "Reply must be atleast 3 characters long",
		    },
		}
	});
});


<?php if($sf_user->hasFlash('succMsg')): ?>
    setTimeout("parent.jQuery.fancybox.close(); parent.window.location.reload();",4000); 
<?php endif; ?>
</script>