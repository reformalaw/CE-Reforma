
<tr valign="top">
 <td colspan="2" class="ListAreaPad">
  <table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">
     <?php include_partial('default/message'); ?>  
  </table>
 </td>
</tr>
<tr valign="top">
 <td colspan="2" class="ListAreaPad">
 <input type="hidden" name="sf_method" value="put" />
  <table width="65%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
   <tr class="fldbg">
    <td colspan="3" class="whttxt">3rd Party Details</td>
   </tr>
   <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "Name" ?>:</b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form->getName(); ?>
      </td>
    </tr>
    
     <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "Address" ?>:</b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form->getAddress1().' , '.$form->getAddress2(); ?>
      </td>
    </tr>
    
     <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "City" ?>:</b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form->getCity(); ?>
      </td>
    </tr>

    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "State" ?>:</b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form->getThirdPartiesStates()->getName() ?>
      </td>
    </tr>
    
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "County" ?>:</b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form->getThirdPartiesCounties()->getName() ?>
      </td>
    </tr>
   
    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "Registered Date" ?>:</b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo date(sfConfig::get('app_dateformat'),strtotime($form->getCreateDateTime()))?>
      </td>
    </tr>

  </table>
  </form>
 </td>
</tr>
