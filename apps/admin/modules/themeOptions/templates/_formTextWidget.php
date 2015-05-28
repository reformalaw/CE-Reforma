<?php 


$themeOptions = $sf_data->getRaw('featureListArr');



if ($featureListArr['ManageTextWidget'] == "Yes") {
    $temp = sfConfig::get('app_ThemeOptions_TextWidgets');
}

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

  <form action="<?php echo url_for('themeOptions/processForm?websiteId='.sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId')); ?>" method='post' enctype='multipart/form-data'>
  <?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>

  <table width="98%" cellspacing="1" cellpadding="1" class="EditFAQ" align="center">

    <?php if ($featureListArr['ManageTextWidget'] == "Yes") { ?>
    <tr class="fldbg">
        <td colspan="2" class="whttxt">Text Widgets Options</td>
    </tr>
    
    <?php 
    $widgetLength = ThemeTable::getWidgetLength();
    for ($i=1;$i<($widgetLength+1);$i++) {?>
		<?php 	
			$linkTypeData = ThemeOptionsTable::getTextWidgetLinkValues(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'),"TextWidgetsLinkType_".$i);
			$linkTypeIdData = ThemeOptionsTable::getTextWidgetLinkValues(sfContext::getInstance()->getUser()->getAttribute('personalWebsiteId'),"TextWidgetsLinkId_".$i); 
			
			if(count($linkTypeIdData) <= 0 || count($linkTypeData) <= 0)
				$selectedValue = "";
			else
				$selectedValue = $linkTypeData[0]["OptionValue"]."_".$linkTypeIdData[0]["OptionValue"];
		?>
    <tr>
      <td width="26%" class="fldrowbg" valign="top"><b><?php echo "Text Widget Title ".$i." "; ?>:</b></td>
      <td width="68%" class="fldrowlightbg"><?php echo $form['TextWidgetsTitle'."_".$i]->render(array('maxlength'=>20,'size'=>20));?><span class="noteDisplay">&nbsp;&nbsp;<b>Note :</b>&nbsp;Maximum Length 20 Characters</span></td>
   </tr>
    <tr>
      <td width="26%" class="fldrowbg" valign="top"><b><?php echo "Text Widget ".$i." "; ?>:</b></td>
      <td width="68%" class="fldrowlightbg"><?php echo $form[$temp['TextWidgets']."_".$i]->render(array('style'=>'width: 250px;'));?></td>
   </tr>

   <tr>
      <td width="26%" class="fldrowbg" valign="top"><b><?php echo "Text Widget Link To ".$i." "; ?>:</b></td>
      <?php $form->setDefault("TextWidgetsLinkType"."_".$i,$selectedValue) ?>
      <td width="68%" class="fldrowlightbg"><?php echo $form["TextWidgetsLinkType"."_".$i]->render(array('style'=>'width: 250px;','maxlength'=>20,'size'=>1));?></td>
   </tr>
   <tr height="5px"></tr>
   <?php } ?>

    <?php } ?>
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