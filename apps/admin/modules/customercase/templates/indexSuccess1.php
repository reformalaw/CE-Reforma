<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">
<!-- Bread Crumb Start -->
<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="66%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
  <td width="34%" align="right" class="AdminBreadCrumb">
   <table cellpadding="8" cellspacing="0" align="right">
    <tr align="center">
     <td width="57" class="LinkImg" ><a href="<?php echo url_for('customercase/new') ?>" title="Add New"><?php echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
      Add </a></td>     
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
  <td width="95%" align="center" class="ContentPad">
   <table width="99%" align="center" cellpadding="0" cellspacing="0" class="MainTbl">
    <tr>
     <td class="MaintblPadding">
      <table width="100%" cellspacing="0" cellpadding="0">
       <tr>
        <td class="ContentPad">
         <table cellspacing="0" cellpadding="0" align="center" class="ContentTable">
          <tr>
           <td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php echo image_tag("admin/Icon_Groups.gif", array("alt"=>"Cases","title"=>"Cases","align"=>"middle"))?></td>
           <td width="90%" class="ContentBtmDotLn">
            <div style="float:left;" class="Title">Casess List</div>
            <div style="float:right;" class="padrht">
						<form action="<?php echo url_for('customercase/index') ?>" method="post">
             <span>Search:</span>&nbsp;&nbsp;             
             <?php echo tag('input', array('name' => 'search_text', 'type' => 'text', 'id' => 'search_text', 'size' => '25', 'value' => $sf_request->getParameter('search_text'))); ?>
            <?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
            <a href="<?php echo url_for('customercase/index') ?>">Clear</a>
            </form>
           </div>
           </td>
          </tr>
          <tr valign="top">
           <td colspan="2" class="dot"></td>
          </tr>
          <?php if($sf_user->hasFlash('errMsg')) { ?>
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">
            <table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">
             <tr>
              <td class="dot2"></td>
             </tr>
             <tr>
              <td class="errormss" align="center"><?php echo $sf_user->getFlash('errMsg');?>/td>
             </tr>
             <tr>
              <td class="dot2"></td>
             </tr>
            </table>
           </td>
          </tr>
          <?php }?>
          <?php if($sf_user->hasFlash('succMsg')) { ?>            
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">
            <table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">
             <tr>
              <td class="dot2"></td>
             </tr>
             <tr>
              <td class="success" align="center"><?php echo $sf_user->getFlash('succMsg');?></td>
             </tr>
             <tr>
              <td class="dot2"></td>
             </tr>
            </table>
           </td>
          </tr>
          <?php }?>
          <?php              
                $varExtra = '';
                if($sf_request->getParameter('search_text')) 
                  $varExtra .="&search_text=".$sf_request->getParameter('search_text');
                //if($sortBy) $varExtra .="&sortBy=$sortBy";       
          ?>
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">
            <table width="95%" cellspacing="1" cellpadding="1" class="brd1">
            <?php if($pager->getnbResults() > 0){?>
             <tr class="fldbg">
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Id','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'Id','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'User','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'User','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Case no','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'Case no','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Description','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'Description','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'First title','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'First title','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Last title','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'Last title','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Third party','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'Third party','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Bill document real name','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'Bill document real name','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Bill document system name','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'Bill document system name','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Actual amount','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'Actual amount','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Commision percentage','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'Commision percentage','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Commision actual','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'Commision actual','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Processing fees','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'Processing fees','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Underpay adjustment','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'Underpay adjustment','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Payable amount','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'Payable amount','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Received amount','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'Received amount','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Difference amount','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'Difference amount','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Customer paid date','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'Customer paid date','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Payment received date','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'Payment received date','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Agreement date','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'Agreement date','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Stage','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'Stage','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Status','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'Status','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Create date time','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'Create date time','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Update date time','ordering'=>true,"siteURL"=>'customercase/index','alias'=>'Update date time','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td width="20%" align="center" class="whttxt">Action</td>
             </tr>              
               <?php #foreach ($casess as $cases): ?>
               <?php foreach ($pager->getResults() as $cases):?>
             <tr>
                                    
                <td align="center" class="fldrowbg" valign="top"><a href="<?php echo url_for('customercase/edit?id='.$cases->getId()) ?>"><?php echo $cases->getId() ?></a></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getUserId() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getCaseNo() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getDescription() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getFirstTitle() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getLastTitle() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getThirdParty() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getBillDocumentRealName() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getBillDocumentSystemName() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getActualAmount() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getCommisionPercentage() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getCommisionActual() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getProcessingFees() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getUnderpayAdjustment() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getPayableAmount() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getReceivedAmount() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getDifferenceAmount() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getCustomerPaidDate() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getPaymentReceivedDate() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getAgreementDate() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getStage() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getStatus() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getCreateDateTime() ?></td>
                                                    <td class="fldrowbg" align="center" valign="top"><?php echo $cases->getUpdateDateTime() ?></td>
                                        <td class="fldrowbg" align="center">
                <a href="<?php echo url_for('customercase/delete?id='.$cases->getId())?>"><?php echo image_tag('admin/Delete_small.gif',array('border'=>'0','alt'=>'Delete','title'=>'Delete'))?></a>
                </td>
             </tr>
             <?php endforeach; ?>    
             <?php } else { ?> 
             <tr class="fldbg"><td class="errormss">No Cases found!</td></tr>
             <?php } ?>         
            </table>
           </td>
          </tr>
          <tr align="right" valign="top">
           <td colspan="2" class="ListAreaPad">                     
              <?php                 
                if($orderBy) $varExtra .="&orderBy=$orderBy";
                if($orderType) $varExtra .="&orderType=$orderType";
              ?>
               <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'customercase/index', 'varExtra' => $varExtra));?>
           </td>
          </tr>
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
</table>