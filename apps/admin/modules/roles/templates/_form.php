<?php $arrCheckBoxPermission = $sf_data->getRaw('arrCheckBoxPermission');?>
<?php $arrCategory = $sf_data->getRaw('arrCategory');?>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php /*if($sf_user->hasFlash('errMsg')) { ?>            
                      <tr align="center" valign="top">
                       <td colspan="2" class="ListAreaPad">
                        <table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">
                         <tr>
                          <td class="dot2"></td>
                         </tr>
                         <tr>
                          <td class="error" align="center"><?php echo $sf_user->getFlash('errMsg');?></td>
                         </tr>
                         <tr>
                          <td class="dot2"></td>
                         </tr>
                        </table>
                       </td>
                      </tr>
            <?php }*/?>
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
  <form action="<?php echo url_for('roles/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="newRoles" name="newRoles">
  <?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
  <table width="100%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
   <tr class="fldbg">
    <td colspan="2" class="whttxt">Role Detail</td>
   </tr>
   <tr>
      <td width="18%" class="fldrowbg" valign="top"><b><?php echo $form['Name']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="80%" class="fldrowlightbg">
       <?php echo $form['Name']->render() ?>
       <?php if ($form['Name']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['Name']->getError()?></div>            
       <?php endif; ?></td>
   </tr>
  <!-- <tr>
      <td width="26%" class="fldrowbg"><b><?php echo $form['selectAll']->renderLabel() ?> :</b> <span class="error">*</span></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form['selectAll']->render(array('id'=>'selectall')) ?>
       <?php if ($form['selectAll']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['selectAll']->getError()?></div>            
       <?php endif; ?></td>
   </tr> -->
    <!--<tr>
      <td align="center" class="fldrowbg error">*</td>
      <td width="26%" class="fldrowbg"><b><?php /*echo $form['selectAll']->renderLabel() ?>:</b></td>
      <td width="68%" class="fldrowbg">
       <?php echo $form['selectAll']->render(array('id'=>'selectall')) ?>
       <?php if ($form['selectAll']->hasError()): ?>            
            <div class="errormsgs"><?php echo $form['selectAll']->getError()?></div>            
       <?php endif;*/ ?>
      </td>
    </tr>-->
    
<!--  <tr id="permissionsdiv">
      <td width="26%" class="fldrowbg"></td>
      <td width="68%" class="fldrowlightbg"><dd style="height:225px;margin-left:0px;"><div class="treeMenu" style="width:350px;"><?php echo $form['Permission']->render(array('class'=>'case')); ?></div></dd>
       <?php if ($form['Permission']->hasError()): ?>            
            <div class="errormsgs" style="color: #FF0000;font-size: 11px;font-weight: bold;padding: 2px 0 0;"><?php echo $form['Permission']->getError()?></div>            
       <?php endif; ?></td> 
   </tr>-->
   <!--<tr id="permissionsdiv">
      <td align="center" class="fldrowbg error" valign="top"></td>
      <td width="26%" class="fldrowbg" align="right" valign="top"><b><?php /*echo $form['Permission']->renderLabel() ?></b></td>
      <td width="68%" class="fldrowbg">
       <dd style="height:225px;margin-left:0px;"><div class="treeMenu" style="width:350px;"><?php echo $form['Permission']->render(array('class'=>'case')); ?></div></dd>
       <?php if ($form['Permission']->hasError()): ?>            
            <div class="errormsgs" style="color: #FF0000;font-size: 11px;font-weight: bold;padding: 2px 0 0;"><?php echo $form['Permission']->getError()?></div>            
       <?php endif;*/ ?>
      </td>
    </tr>-->

<tr id="permissionsdiv">
      <td width="18%" class="fldrowbg" valign="top"><b><?php echo "Permissions" ?> :</b> <span class="error">*</span></td>
      <td width="80%" class="fldrowlightbg rollsList">
       <?php 
        foreach($arrCategory as $arrCategory):
            $i = 0; 
             echo '<ul>
                        <li class="rollHeading"> <input type="checkbox" name="checkboxParent_Category[]" value= "'.$arrCategory['Name'].'" id="parent_category_'.$arrCategory['Id'].'" class="category_'.$arrCategory['Id'].'" onclick= parentCheckUncheck("category_'.$arrCategory['Id'].'") />';
             
            echo  '<b>'.$arrCategory['Name'].':</b></li>';
            
                foreach($arrCategory['PermissionCategoryPermissions'] as $childCategory):
                     if($i%5==0) {
                    echo " ";
                    }
                    if(in_array($childCategory['Id'],$arrCheckBoxPermission)) { ?>                       
                        <script type="text/javascript">
                        /*Function during edit time parent selected if all child selected */
                        $(function(){
                                var clsId = '<?php echo $arrCategory["Id"] ?>'

                                if($(".child_category_"+clsId).length == $(".child_category_"+clsId+":checked").length)
                                    $("#parent_category_"+clsId).attr("checked", "checked");
                            });
                        </script>
                       <?php  echo '<li><input type="checkbox" name="checkboxChild_list[]" value= "parentCategory_'.$arrCategory['Id'].'_'.$childCategory['Id'].'" id="parent_category_'.$arrCategory['Id'].'" class= "child_category_'.$arrCategory['Id'].'" onclick= childCheckUncheck("category_'.$arrCategory['Id'].'") checked = "checked" /> '; 
                    }
                    else {
                        echo '<li><input type="checkbox" name="checkboxChild_list[]" value= "parentCategory_'.$arrCategory['Id'].'_'.$childCategory['Id'].'" id="parent_category_'.$arrCategory['Id'].'" class= "child_category_'.$arrCategory['Id'].'" onclick= childCheckUncheck("category_'.$arrCategory['Id'].'")  />'; }
                        echo $childCategory['UniqueKey'].'</li>';
                    $i++;
                endforeach;
                echo "</ul>";
        endforeach; 
        ?>
        
       <?php if($sf_user->hasFlash('errMsgs')): ?>            
            <div class="errormsgs"><?php echo $sf_user->getFlash('errMsgs');?></div>            
       <?php endif; ?></td>
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
/*$(function(){
    
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
    });
        
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
 
    });
    
}); */

/* Function for parent category select or unselect check box*/
function parentCheckUncheck(clsId)
{
    if(document.getElementById("parent_"+clsId).checked == true){
        $('.child_'+clsId).attr('checked', "checked");
    }
    else
        $('.child_'+clsId).removeAttr("checked");
}

/* Function for child category select or unselect check box */
function childCheckUncheck(clsId)
{
    if($(".child_"+clsId).length == $(".child_"+clsId+":checked").length) {
            $("#parent_"+clsId).attr("checked", "checked");
        } else {
            $("#parent_"+clsId).removeAttr("checked");
        }
}

jQuery().ready(function() {
    
	// validate form on keyup and submit
	jQuery("#newRoles").validate({
		errorClass: "errormsgs",
		rules: {
		    "roles[Name]": {
				required: true,
				minlength: 3,
				maxlength: 45
			}
		},
		messages: {
		    "roles[Name]": {
		      required:   "This field is required.",
		      minlength:  "Role name must be at least 3 characters long.",
		      maxlength:  "Role Name cannot be longer than 45 characters."
		    }
		}
	});
});
</script>
