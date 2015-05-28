<?php include_partial('customercase/header');?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">
<!-- Bread Crumb Start -->
<?php /*
<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="36%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
  <td width="30%" class="drkgrylnk" align="center"><div class="Title">Case List </div></td>
  
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
*/ ?>
<!-- Bread Crumb End -->
</td></tr>
</table>

<table width="98%" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <?php $varExtra = '';?>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr> <!--search form-->
    <td align="center" valign="top" class="CasesListSearch">
    	<form action="<?php echo url_for('customercase/index') ?>"  onsubmit="return validateCustomerSearch();" method="post">
    	<table width="100%" cellspacing="10" cellpadding="0">
			<tr>
			  	<td width="220" align="left" valign="top"><?php echo $searchForm['CaseNo']->renderLabel(); ?></td>
			    <td width="220" align="left" valign="top"><?php echo $searchForm['FromDate']->renderLabel(); ?></td>
			    <td width="210" align="left" valign="top"><?php echo $searchForm['Stage']->renderLabel(); ?></td>
			    <td align="left" valign="top">&nbsp;</td>
			</tr>
  			<tr>
			    <td align="left" valign="top"><?php echo $searchForm['CaseNo']->render(); ?></td>
			    <td align="left" valign="top" ><?php echo $searchForm['FromDate']->render(); echo "&nbsp;To&nbsp;"; echo $searchForm['ToDate']->render(); ?>
									  <br><label class="error" id="dateError"></label></td>
			    <td align="left" valign="top"><?php echo $searchForm['Stage']->render(); ?></td>
				<td align="left" valign="top"><span class="bluButton"><?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'bluButton', 'value' => 'Search')); ?> </span> <span class="grayButton"><?php echo tag('input', array('name' => 'clear', 'type' => 'reset', 'id' => 'clear', 'class' => 'grayButton', 'value' => 'Clear', "onclick"=>'window.location="'.url_for('customercase/index').'"')); ?> </span></td>
			</tr>
  			<tr>
			    <td height="1" colspan="4" align="left" valign="top"></td>
			</tr>
		</table>
		</form>
	</td>
  </tr> <!--end of search form-->
  <tr>
    <td height="20" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr> <!--color notation-->
    <td align="left" valign="top" class="CaseStageCode"><table width="100%" cellspacing="0" cellpadding="0">
          <tr>
          	<td rowspan="2" align="right" valign="middle" class="heading"><span style="float:left;">Total Cases:&nbsp; <?php echo $pager->getnbResults(); ?></span><strong> Case Stage Code:</strong></td>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="100" align="left" valign="top"><strong>Submitted :</strong></td>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="100" align="left" valign="top"><strong>Accepted :</strong></td>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="100" align="left" valign="top"><strong>Paid :</strong></td>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="100" align="left" valign="top"><strong>Closed :</strong></td>
            
            
          </tr>
          <tr>
          	<td width="10" height="25" align="center" valign="top">&nbsp;</td>
            <td align="left" valign="top" style="background-color:#7757A6;">&nbsp;</td>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td align="left" valign="top" style="background-color:#74DF00;">&nbsp;</td>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td align="left" valign="top" style="background-color:#FFEA00;">&nbsp;</td>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td align="left" valign="top" style="background-color:#9D9D9D;">&nbsp;</td>
            
            
          </tr>
    </table></td>
  </tr> 
  <tr>
    <td height="25" align="left" valign="top">&nbsp;</td>
  </tr>
  <?php include_partial('default/message'); ?>
  <tr>
    <td align="left" valign="top"><table width="100%" cellspacing="1" cellpadding="5">
    <?php if($pager->getnbResults() > 0){?>
    <?php 
    $colorCode = array(
    'Submitted'     => '#7757a6', // Purple
    'Accepted'      => '#74DF00', // Green
    'Paid'          => '#ffea00', // Yellow
    'Close'         => '#9d9d9d', // Grey
    '3rdPartyBillsSubmitted'     => '#0090ff',
    'UnderPay'      => '#fe0303' // Red
    );#fe0303-red #166f27-green #ffea00-yellow #0090ff-blue #9d9d9d-gry #7757a6-purple     ?>
	<!--end of color notation-->
      <tr class="fldbg" style="font-weight:bold">
        <td align="center" valign="middle" width="7%">Agreement Date</td>
        <td align="center" valign="middle" width="15%">Case No. &amp; Title</td>
        <td align="center" valign="middle" width="6%">3rd Party</td>
        <td align="center" valign="middle" width="6%">Actual Amount</td>
        <td align="center" valign="middle" width="8%">Receivable Amount</td>
        <td align="center" valign="middle" width="6%">Payments Disbursed</td>
		<td align="center" valign="middle" width="7%">Created By</td>
        <td align="center" valign="middle" width="10%">Action</td>
      </tr>
		<?php #foreach ($casess as $cases): ?>
		<?php foreach ($pager->getResults() as $cases):?>
		<tr bgcolor="<?php echo $colorCode[$cases->getStage()] ?>">
			<td align="center" valign="middle"><?php if($cases->getStage() != sfConfig::get('app_CaseStage_Submitted')) {
													echo date('Y-m-d',strtotime($cases->getAgreementdate()));
												   }else {
													echo "---";
												   }?></td>
		    <td align="left" valign="middle"><?php echo link_to($cases->getCaseNo().' - '.$cases->getFirstTitle().' '.$cases->getLastTitle(), 'customercase/view?id='.$cases->getId(), array('title'=>'Click to View Case Detail')); ?></td>
			<td align="center" valign="middle"><?php $thirdParty  =  $cases->getCasesThirdParties()->getName(); echo $thirdParty; ?></td>
			<td align="right" valign="middle"><?php echo sfConfig::get('app_currency').round($cases->getActualAmount(),2); ?></td>
			<td align="right" valign="middle"><?php if ($cases->getPayableAmount() != '')echo sfConfig::get('app_currency').round($cases->getPayableAmount(),2);else echo "---"; ?></td>
			<td align="right" valign="middle"><?php if ($cases->getStage() == sfConfig::get('app_CaseStage_Paid') || $cases->getStage() == sfConfig::get('app_CaseStage_Close'))echo sfConfig::get('app_currency').round($cases->getPaidAmount(),2);else echo "---"; ?></td>
			<td align="left" valign="middle">
			<?php if($cases->getCreatedBy() == $sf_user->getAttribute('admin_user_id')) {
			     echo 'Own';  
			} else {
			    echo $cases->getCasesUsersCreatedBy()->getFirstName(). ' '. $cases->getCasesUsersCreatedBy()->getLastName();
			} ?></td>
			
			<td align="center" valign="middle"><?php echo link_to(image_tag("admin/document-cases-icon.png",array('title'=>'Click here to Manage Case Documents','alt'=>'Manage Case Document','width'=>24,'height'=>25)),"casedocuments/index?caseId=".$cases->getId()."&bFlag=1&id=".$cases->getId()); ?>
										<?php if($cases->getStage() == sfConfig::get('app_CaseStage_Submitted')) { ?>
										<a href="<?php echo url_for('customercase/edit?id='.$cases->getId()) ?>"><?php echo image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>24,'height'=>25))?></a>
										<a href="<?php echo url_for('customercase/changeStatus?status=Deleted&id='.$cases->getId())?>"><?php echo image_tag('admin/delete-cases-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Click here to Delete Case','OnClick'=>"return deleteConfirmation();",'width'=>24,'height'=>25))?></a>
										<?php } else {?>
										<a href="#" style="cursor:none;"> <?php echo image_tag("admin/blank-img.png",array('width'=>24,'height'=>25)) ;?> </a> <a href="#" style="cursor:none;"> <?php echo image_tag("admin/blank-img.png",array('width'=>24,'height'=>25)) ;?> </a>
										<?php } ?>
										<?php echo link_to(image_tag('admin/view-icon.png',array('alt'=>'View','title'=>'Click to View Case Detail','width'=>24,'height'=>25)),'customercase/view?id='.$cases->getId()); ?> 
			</td>
		  </tr>
      <?php endforeach; ?>    
      <?php } else { ?> 
        <tr class="fldbg"><td class="errormss">No Cases Found !!</td></tr>
      <?php } ?>         
        <tr>
        <td align="left" valign="middle" colspan="8">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr align="center">
           <td colspan="2" class="ListAreaPad">                     
			<?php
              #if($orderBy) $varExtra .="&orderBy=$orderBy";
              #if($orderType) $varExtra .="&orderType=$orderType";

              if(isset($defaultArr['CaseNo']) && !empty($defaultArr['CaseNo'])) {
                  $varExtra .="&CaseNo=".$defaultArr['CaseNo'];
              }
              
              if(isset($defaultArr['FromDate']) && !empty($defaultArr['FromDate'])) {
                  $varExtra .="&FromDate=".base64_encode($defaultArr['FromDate']);
              }

              if(isset($defaultArr['ToDate']) && !empty($defaultArr['ToDate'])) {
                  $varExtra .="&ToDate=".base64_encode($defaultArr['ToDate']);
              }

              if(isset($defaultArr['Stage']) && !empty($defaultArr['Stage'])) {
                  $varExtra .="&Stage=".$defaultArr['Stage'];
              }?>
			<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'customercase/index', 'varExtra' => $varExtra));?>
           </td>
          </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
</table>

<script type="text/javascript">
$(function() {
    $( "#search_customer_case_CaseNo" ).autocomplete({
        source: "<?php url_for('customercase/index') ?>",
        minLength: 2
    });
});
</script>
