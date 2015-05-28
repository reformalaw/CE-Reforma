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
  <?php  include_component('dashboardcase', 'profile');?>
  <tr>
    <td align="left" valign="top">
    	<table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <?php include_partial('verticalheader',array('caseObj'=>$caseDetail)) ?>
        <td align="center" valign="top" class="CashDetails" style="padding:10px 0px"><table width="98%" cellspacing="10" cellpadding="0">
        	<tr>
            	<td class="WebsiteDetails">
                	<table width="100%" cellspacing="0" cellpadding="0">
                    	<tr>
                <td align="center" valign="top">
                	<table width="96%" cellspacing="1" cellpadding="1" class="PageListHeading">
                      <tr>
                        <td align="left" valign="middle"><strong>Case Edit</strong></td>
                        <td align="right" valign="middle" height="36"></td>
                      </tr>
                  </table>
                </td>
           </tr>           
           <tr><td height="20"></td></tr>
          				<tr>
            <td align="center" valign="top"><table cellspacing="0" cellpadding="0" align="center" width="100%">
													
													<tr valign="top">
														<td align="center" valign="middle"><?php include_partial('editform', array('form' => $form, 'caseDetail' => $caseDetail)) ?></td>
													</tr>
													
												</table></td>
          </tr>
                    </table>
                </td>
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






<?php /*?><table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">
<!-- Bread Crumb Start -->
<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="66%" class="drkgrylnk padlft"><a href="<?php echo url_for("default/index");?>" title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home")) ?></a></td>
  <td width="34%" align="right" class="AdminBreadCrumb">
   <table cellpadding="8" cellspacing="0" align="right">
    <tr align="center">
     <!--<td width="57" class="LinkImg" ><a href="#" title="Edit"><?php image_tag("admin/Icon_Save.gif", array("alt"=>"Save","title"=>"Save","border"=>"0")) ?><br />
      Save </a></td>-->
     <td width="57" class="LinkImg" ><a href="<?php echo url_for('dashboardcase/index?customerId='.$sf_params->get('customerId')) ?>"><?php echo image_tag("admin/Icon_Cancel.gif", array("alt"=>"Cancel","title"=>"Cancel","border"=>"0")) ?><br />
      Cancel </a></td>
    </tr>
   </table>
  </td>
 </tr>
</table>
<!-- Bread Crumb End -->
</td></tr>
<tr><td width="100%">
<!-- Control Panel Start -->
<table width="100%" cellspacing="2" cellpadding="0">
 <tr>
  <td align="center" class="ContentPad" height="10"></td>
 </tr>
 <tr>
  <td width="95%" class="ContentPad">
   <table width="99%" align="center" cellpadding="0" cellspacing="0" class="MainTbl">
    <tr>
     <td class="MaintblPadding">
      <table width="100%" cellspacing="0" cellpadding="0">
       <tr>
        <td class="ContentPad">
         <table cellspacing="0" cellpadding="0" align="center" class="ContentTable">
          <tr>
           <td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php echo image_tag("admin/Icon_Groups.gif",array("alt"=>"Groups","title"=>"Groups","align"=>"middle")) ?><span class="Title"> </span></td>
           <td width="90%" class="ContentBtmDotLn">
            <div style="float:left;" class="Title">Edit Cases </div>           
           </td>
          </tr>
          <tr valign="top">
           <td colspan="2" class="dot"></td>
          </tr>
          <?php //include_partial('editform', array('form' => $form, 'caseDetail' => $caseDetail )) ?>
         </table>
        </td>
       </tr>
      </table>
     </td>
    </tr>
   </table>
  </td>
 </tr>
</table>
<!-- Control Panel End -->
</td></tr>
</table><?php */?>