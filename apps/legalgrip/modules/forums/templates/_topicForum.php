<?php if($sf_user->hasFlash('succMsg')): ?>
		<div style="margin-top:100px;">
			<?php include_partial('default/message'); ?>
		</div>

<?php else: ?>
			<form id="LGForumsTopicFrm" name="LGForumsTopicFrm" action="<?php echo url_for('forums/'.($form->getObject()->isNew() ? 'createTopic' : 'updateTopic').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
				<?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
				<input type="hidden" value="<?php echo $forumsId; ?>" name="LGForumId">
				<div class="topicforum">
					<ul>
						<li><?php echo $form['Topic']->renderLabel() ?><!--<span>*</span>-->
							<?php echo $form['Topic']->render() ?>
							<?php if ($form['Topic']->hasError()): ?>
									<div class="errormsgs"><?php echo $form['Topic']->getError()?></div>
							<?php endif; ?>
						</li>
						<li class="message"><?php echo $form['Description']->renderLabel() ?><!--<span>*</span>-->
							<?php echo $form['Description']->render() ?>
							<?php if ($form['Description']->hasError()): ?>
									<div class="errormsgs"><?php echo $form['Description']->getError()?></div>
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

	jQuery("#LGForumsTopicFrm").validate({
		errorClass: "errormsgs",
		rules: {
		    "LGForumsTopic[Topic]": {
				required: true,
				minlength: 3,
				maxlength: 45
			},
			"LGForumsTopic[Description]": {
				required: true,
				minlength: 3,
			}
		},
		messages: {
		    "LGForumsTopic[Topic]": {
		      required: "Please Enter the Topic",
		      minlength: "Topic must be atleast 3 characters long",
		      maxlength: "Topic must be most 45 characters long"
		    },
		    "LGForumsTopic[Description]": {
		      required: "Please Enter the Description",
		      minlength: "Description must be atleast 3 characters long",
		    }
		}
	});
});

<?php if($sf_user->hasFlash('succMsg')): ?>
    setTimeout("parent.jQuery.fancybox.close(); parent.window.location.reload();",4000); 
<?php endif; ?>
</script>