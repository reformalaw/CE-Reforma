<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php if($sf_user->hasFlash('imgErrMsg')) { ?>
<tr align="center" valign="top" id="msg">
    <td colspan="2" class="ListAreaPad">
        <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
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
  <form action="<?php echo url_for('media/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="mediaFrm" name="mediaFrm">
  <?php if (!$form->getObject()->isNew()): ?><input id="sf_method" type="hidden" name="sf_method" value="put" /><?php endif; ?>
  <table width="65%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
   <tr class="fldbg">
    <td colspan="2" class="whttxt">Stock Photo Detail</td>
   </tr>
       <tr>
      <!--<td align="center" class="fldrowbg error">*</td>-->
      <td width="26%" class="fldrowbg"><b><?php echo $form['Title']->renderLabel() ?>: </b><span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['Title']->render() ?>
       <?php if ($form['Title']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Title']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>
    <?php if($form->getObject()->isNew() != "create"):?>
    <tr>
      <td width="26%" class="fldrowbg" valign="Top" ><b><?php echo "Image Preview" ?>: </b></td>
      <td width="68%" class="fldrowlightbg">
       <?php
				if($viewImageName != "")
				{
					$mediaPath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.sfConfig::get('app_mediapath').$viewBannerType.DIRECTORY_SEPARATOR.$viewImageName;
					if(file_exists($mediaPath))
						echo image_tag('../uploads/Media/'.$viewBannerType.'/'.$viewImageName,array('border'=>'0','alt'=>'Image','title'=>$viewImageName,'width'=>'75px','height'=>'75px'));
					else
						echo image_tag('/images/admin/noImage.jpeg',array('border'=>'0','alt'=>'Image','title'=>"no-image",'width'=>'75px','height'=>'75px'));
				}
				else
					echo image_tag('/images/admin/noImage.jpeg',array('border'=>'0','alt'=>'Image','title'=>"no-image",'width'=>'75px','height'=>'75px'));
		?>
      </td>
    </tr>
    <?php endif; ?>
    <tr>
      <!--<td align="center" class="fldrowbg error">*</td>-->
      <td width="26%" class="fldrowbg"><b><?php echo $form['ImageName']->renderLabel() ?>: </b><span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['ImageName']->render() ?>

       <br><span class="noteDisplay"><strong style="float: left;"> Note: </strong></br>
									1. Only jpeg, jpg, png, gif are allowed </br>
									2. For better result of logo dimension should be 225px X 50px </br>
									3. For better result of banner-foreground and banner-unsorted dimension should be 350px X 400px </br>
									4. For better result of banner-background dimension should be 1900px X 400px </span>
								  
       <?php if ($form['ImageName']->hasError()): ?>
            <div class="errormsgs" style="color: #FF0000;font-size: 11px;font-weight: bold;padding: 2px 0 0;"><?php echo $form['ImageName']->getError()?></div>            
       <?php endif; ?>
      </td>
    </tr>

    <tr>
		<td width="26%" class="fldrowbg"><b><?php echo $form['Type']->renderLabel() ?>: </b><span class="error">*</span></td>
		<td width="68%" class="fldrowlightbg">
			<?php echo $form['Type']->render() ?>
			
			<?php if ($form['Type']->hasError()): ?>
				<div class="errormsgs"><?php echo $form['Type']->getError()?></div>
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
jQuery().ready(function() {
    
	// validate form on keyup and submit
	jQuery("#mediaFrm").validate({
		errorClass: "errormsgs",
		rules: {
		    "Media[Title]": {
				required: true,
				minlength: 3,
				maxlength: 30
			},
			"Media[ImageName]":{
				required: function(element) {
								return $("#sf_method").val() != 'put';
								}
			},
			"Media[Type]":{
				required: true,
			}
		},
		messages: {
		    "Media[Title]": {
		      required:   "This field is required.",
		      minlength:  "Stock photo title must be at least 3 characters long.",
		      maxlength:  "Stock photo title cannot be longer than 30 characters."
		    },
		    "Media[ImageName]": {
		      required: "This field is required.",
		    },
		    "Media[Type]": {
		      required: "This field is required.",
		    },
		}
	});
});
</script>