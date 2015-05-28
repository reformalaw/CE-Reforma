[?php use_stylesheets_for_form($form) ?]
[?php use_javascripts_for_form($form) ?]
<?php $form = $this->getFormObject() ?>

<tr valign="top">
 <td colspan="2" class="ListAreaPad">
  <table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">
  [?php if ($form->hasGlobalErrors()): ?]
   <tr>
    <td class="dot2"></td>
   </tr>
   [?php foreach ($form->getGlobalErrors() as $name => $error): ?]
     <tr>
      <td class="errormss" align="center">[?php echo $name.': '.$error ?]</td>
     </tr>
   [?php endforeach; ?]
   <tr>
    <td class="dot2"></td>
   </tr>
  [?php endif; ?]
  </table>
 </td>
</tr>
<tr valign="top">
 <td colspan="2" class="ListAreaPad">
  <form action="[?php echo url_for('<?php echo $this->getModuleName() ?>/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?<?php echo $this->getPrimaryKeyUrlParams('$form->getObject()', true) ?> : '')) ?]" method="post" [?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?]>
  [?php if (!$form->getObject()->isNew()): ?]<input type="hidden" name="sf_method" value="put" />[?php endif; ?]
  <table width="65%" cellspacing="1" cellpadding="1" class="brd1" align="center">
   <tr class="fldbg">
    <td colspan="3" class="whttxt"><?php echo $this->getSingularName() ?> Details</td>
   </tr>
   <?php foreach ($form as $name => $field): if ($field->isHidden()) continue ?>
    <tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b>[?php echo $form['<?php echo $name ?>']->renderLabel() ?]:</b></td>
      <td width="68%" class="fldrowbg">
       [?php echo $form['<?php echo $name ?>']->render() ?]
       [?php if ($form['<?php echo $name ?>']->hasError()): ?]            
            <div class="errormsgs">[?php echo $form['<?php echo $name ?>']->getError()?]</div>            
       [?php endif; ?]
      </td>
    </tr>
<?php endforeach; ?>
   <tr class="fldrowbg">
    <td height="33" align="center" class="fldrowbg error">&nbsp;</td>
    <td class="fldrowbg" colspan="2" align="center">
    [?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Save')); ?]    
    <?php if (!isset($this->params['non_verbose_templates']) || !$this->params['non_verbose_templates']): ?>
          [?php echo $form->renderHiddenFields(false) ?]
    <?php endif; ?>
    </td>
   </tr>
  </table>
  </form>
 </td>
</tr>