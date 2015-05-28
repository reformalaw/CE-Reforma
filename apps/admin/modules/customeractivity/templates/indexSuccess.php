<?php $activityArr = array(
    'CustomerBillsSubmitted' =>   'Customer Bills Submitted',
    'CaseAccepted'           =>   'Case Accepted',
    '3rdPartyBillsSubmitted' =>   '3rd Party Bills Submitted',
    '3rdPartyBillsRejected'  =>   '3rd Party Bills Rejected',  
    'CheckSent'              =>   'Check Sent', 
    'PaymentReceived'        =>   'Payment Received'
);?>


<?php include_partial('customercase/header');?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">
<!-- Bread Crumb Start -->
<?php /*
<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
  <td width="30%" class="drkgrylnk" align="center"><div class="Title">Case Activities List</div></td>
  <td width="35%" align="right" class="AdminBreadCrumb">
   <table cellpadding="8" cellspacing="0" align="right" style="display:none;">
    <tr align="center">
     <td width="57" class="LinkImg" ><a href="<?php #echo url_for('customeractivity/new') ?>" title="Add New"><?php #echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
      Add </a></td>     
    </tr>
   </table>
  </td>
 </tr>
</table>
*/ ?>
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
         <table cellspacing="0" cellpadding="0" align="center" width="100%">
         <!-- Search Form -->
          <tr>
            <td align="left" valign="top" colspan="2">&nbsp;</td>
		  </tr>
		  <tr>
		  <td align="center" valign="top" class="CasesListSearch" colspan="2">
		  <form action="<?php echo url_for('customeractivity/index') ?>" method="post" onsubmit="return validateActivity();">
			<table width="100%" cellspacing="10" cellpadding="0">
			<tr>
			 <td width="220" align="left" valign="top"><?php echo $searchForm['CaseNo']->renderLabel(); ?></td>
			 <td width="220" align="left" valign="top"><?php echo $searchForm['ActivityType']->renderLabel(); ?></td>
			 <td width="220" align="left" valign="top"><?php echo $searchForm['FromDate']->renderLabel(); ?></td>
			 <td align="left" valign="top">&nbsp;</td>
			</tr>
			<tr>
			 <td align="left" valign="top"><?php echo $searchForm['CaseNo']->render(); ?></td>
			 <td align="left" valign="top"><?php echo $searchForm['ActivityType']->render(); ?></td>
			 <td align="left" valign="top"><?php echo $searchForm['FromDate']->render(); 
                                                   echo "&nbsp;To&nbsp;";
											       echo $searchForm['ToDate']->render(); ?>
                                                   <label class="error" id="dateError"></label></td>
			 <td align="left" valign="top"><span class="bluButton"> <?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'bluButton', 'value' => 'Search')); ?> </span> <span class="grayButton"><?php echo tag('input', array('name' => 'clear', 'type' => 'reset', 'id' => 'clear', 'class' => 'grayButton', 'value' => 'Clear', "onclick"=>'window.location="'.url_for('customeractivity/index').'"')); ?> </span></td>
			</tr>
			<tr>
			 <td height="1" colspan="5" align="left" valign="top"></td>
			</tr>
			</table>
		  </form>
		  </td>
		</tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <!-- Search Form Completed -->
        <?php include_partial('default/message'); ?>        
                  

          <?php              
          $varExtra = '';
          if($sf_request->getParameter('search_text'))
          $varExtra .="&search_text=".$sf_request->getParameter('search_text');
          //if($sortBy) $varExtra .="&sortBy=$sortBy";
          ?>
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">
            <table width="100%" cellspacing="1" cellpadding="1" class="brd1">
            <?php if($pager->getnbResults() > 0){?>
             <tr class="fldbg">
                <td align="center" width="25%"><?php include_partial('default/ordering',array('title'=>'Case No. & Title','ordering'=>false,"siteURL"=>'customeractivity/index','alias'=>'Case','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                <td align="center" width="20%"><?php include_partial('default/ordering',array('title'=>'Activity Type','ordering'=>false,"siteURL"=>'customeractivity/index','alias'=>'Activity type','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                <td align="center" width="40%"><?php include_partial('default/ordering',array('title'=>'Description','ordering'=>false,"siteURL"=>'customeractivity/index','alias'=>'Description','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                <td align="center"width="15%"><?php include_partial('default/ordering',array('title'=>'Activity Date','ordering'=>false,"siteURL"=>'customeractivity/index','alias'=>'Create date time','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            
             </tr>              
               
               <?php foreach ($pager->getResults() as $case_activities):?>
             <tr>
                                    
                <td class="fldrowbg" align="left" valign="top"><?php echo link_to($case_activities->getCaseActivitiesCases()->getCaseNo().' - '.$case_activities->getCaseActivitiesCases()->getFirstTitle().' '.$case_activities->getCaseActivitiesCases()->getLastTitle(),'customercase/view?id='.$case_activities->getCaseId()) ?></td>
                <td class="fldrowbg" align="left" valign="top"><?php echo $activityArr[$case_activities->getActivityType()]; ?></td>
                <td class="fldrowbg" align="left" valign="top"><?php echo nl2br($case_activities->getDescription()); ?></td>
                <td class="fldrowbg" align="center" valign="top"><?php echo date('Y-m-d',strtotime($case_activities->getCreateDateTime())); ?></td>
             </tr>
             <?php endforeach; ?>    
             <?php } else { ?> 
             <tr class="fldbg"><td class="errormss">No items found.</td></tr>
             <?php } ?>         
            </table>
           </td>
          </tr>
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">                     
              <?php                 
              if($orderBy) $varExtra .="&orderBy=$orderBy";
              if($orderType) $varExtra .="&orderType=$orderType";


              /*if(isset($defaultArr['UserCaseNo']) && !empty($defaultArr['UserCaseNo'])) {
                  $varExtra .="&UserCaseNo=".$defaultArr['UserCaseNo'];
              }*/
              
              if(isset($defaultArr['CaseNo']) && !empty($defaultArr['CaseNo'])) {
                  $varExtra .="&CaseNo=".$defaultArr['CaseNo'];
              }

              if(isset($defaultArr['FromDate']) && !empty($defaultArr['FromDate'])) {
                  $varExtra .="&FromDate=".base64_encode($defaultArr['FromDate']);
              }

              if(isset($defaultArr['ToDate']) && !empty($defaultArr['ToDate'])) {
                  $varExtra .="&ToDate=".base64_encode($defaultArr['ToDate']);
              }

              if(isset($defaultArr['ActivityType']) && !empty($defaultArr['ActivityType'])) {
                  $varExtra .="&ActivityType=".$defaultArr['ActivityType'];
              }

              ?>
               <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'customeractivity/index', 'varExtra' => $varExtra));?>
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
<script type="text/javascript">
$(function() {
    $( "#search_CaseNo" ).autocomplete({
        source: "<?php url_for('customeractivity/index') ?>",
        minLength: 2
    });
});
</script>