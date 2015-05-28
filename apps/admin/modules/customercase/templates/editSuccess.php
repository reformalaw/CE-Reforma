<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="66%" class="drkgrylnk padlft"><a href="<?php echo url_for("default/index");?>" title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home")) ?></a></td>
  <td width="34%" align="right" class="AdminBreadCrumb">
   <table cellpadding="8" cellspacing="0" align="right">
    <tr align="center">
     <!--<td width="57" class="LinkImg" ><a href="#" title="Edit"><?php image_tag("admin/Icon_Save.gif", array("alt"=>"Save","title"=>"Save","border"=>"0")) ?><br />
      Save </a></td>-->
     <td width="57" class="LinkImg" ><a href="<?php echo url_for('customercase/index') ?>"><?php echo image_tag("admin/Icon_Cancel.gif", array("alt"=>"Cancel","title"=>"Cancel","border"=>"0")) ?><br />
      Cancel </a></td>
    </tr>
   </table>
  </td>
 </tr>
</table>

<table width="98%" cellspacing="0" cellpadding="0" align="center">
  <!--<tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="40%" align="left" valign="middle" class="cases-userimage"><?php #echo image_tag("admin/noImage.jpeg", array('border'=>'1','alt'=>'Image','title'=>"No-Image",'width'=>'50px','height'=>'50px'))?> Jaydip Dodiya<?php //echo ucwords($case->getFirstTitle()." ".$case->getFirstTitle());?></td>
        <td width="10" align="left" valign="middle">&nbsp;</td>
        <td align="left" valign="middle"><strong>Case No :</strong> 1302000071<?php //echo $case->getCaseNo(); ?>
          <p><strong>3rd Party :</strong> Escrow<?php //echo $case->getCasesThirdParties()->getName(); ?></p></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>-->
  <?php  include_component('customercase', 'profile');?>
  <tr>
    <td align="left" valign="top">
    	<table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <?php include_partial('verticalheader',array('caseObj'=>$caseDetail)) ?>
        <td align="left" valign="top" class="CashDetails"><table width="100%" cellspacing="10" cellpadding="0">
           <tr>
                <td align="center" valign="top">
                	<table width="98%" cellspacing="1" cellpadding="1" class="PageListHeading">
                      <tr>
                        <td align="left" valign="middle"><strong>Case Edit</strong></td>
                        <td align="right" valign="middle" height="36"></td>
                      </tr>
                  </table>
                </td>
           </tr>           
          <tr>
            <td align="center" valign="top"><table cellspacing="0" cellpadding="0" align="center" width="100%">
													
													<tr valign="top">
														<td align="center" valign="middle"><?php include_partial('editform', array('form' => $form, 'caseDetail' => $caseDetail , 'bFlag'=>$bFlag )) ?></td>
													</tr>
													
												</table></td>
          </tr>
			<tr>
                <td align="left" valign="top" height="1"></td>
           </tr>
        </table></td>
      </tr>
      
    </table>
    </td>
  </tr>
</table>