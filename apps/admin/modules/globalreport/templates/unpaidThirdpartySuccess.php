<?php include_partial('case/header');?>

<table width="98%" cellspacing="0" cellpadding="0" align="center">

	<tr>
		<td align="left" valign="top">&nbsp;</td>
	</tr>
	<tr>
		<td align="left" valign="top">
			<table width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<!--<td width="150" align="left" valign="top" class="LeftMenu">
					
						<?php //include_partial('personalcms/customerMenu');?>
					
					</td>-->
					<td align="center" valign="top" class="CashDetails">
					<table width="96%" cellspacing="0" cellpadding="0">
						<tr>
							<td align="left" valign="top" height="25">&nbsp;</td>
						</tr>
						<tr>
							<td align="left" valign="top" class="WebsiteTab">
								<?php include_partial('case/globalReportMenu');?>
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" class="WebsiteDetails">
								<table width="100%" cellspacing="10" cellpadding="0">
									<tr>
										<td align="center" valign="top">
											<table width="98%" cellspacing="1" cellpadding="1" class="PageListHeading">
												<tr>
													<td align="left" valign="middle"><strong>Unpaid Cases from 3rd Party Report</strong></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td class="ContentPad">
										<table cellspacing="0" cellpadding="0" align="center" width="100%">
										<!-- Search Form -->
										<tr>
											<td align="center" valign="top" class="CasesListSearch" colspan="2">
											<form action="<?php echo url_for('globalreport/unpaidThirdparty') ?>" method="post" onsubmit="return validateUnpaidThirdParty();">
											<table width="100%" cellspacing="10" cellpadding="0">
											<tr>
												<td width="220" align="left" valign="top"><?php echo $searchForm['CaseNo']->renderLabel(); ?></td>
												<td width="220" align="left" valign="top"><?php echo $searchForm['UserId']->renderLabel(); ?></td>
												<td width="220" align="left" valign="top"><?php echo $searchForm['ThirdParty']->renderLabel(); ?></td>
												<td width="220" align="left" valign="top"><?php echo $searchForm['StartAmount']->renderLabel(); ?></td>
												<td align="left" valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><?php echo $searchForm['CaseNo']->render(); ?></td>
												<td align="left" valign="top"><?php echo $searchForm['UserId']->render(); ?></td>
												<td align="left" valign="top"><?php echo $searchForm['ThirdParty']->render(); ?></td>
												<td align="left" valign="top"> From
																		<?php   echo $searchForm['StartAmount']->render(array('style'=>'width:50px;')); 
																				echo "&nbsp;To&nbsp;";
																				echo $searchForm['EndAmount']->render(array('style'=>'width:50px;')); ?>								            
																				<br>
																				<label class="error" id="searchAmountError"></label></td>
												<td align="left" valign="top"><?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'bluButton', 'value' => 'Search')); ?> </span> <span class="grayButton">
																		<?php echo tag('input', array('name' => 'clear', 'type' => 'reset', 'id' => 'clear', 'class' => 'grayButton', 'value' => 'Clear', "onclick"=>'window.location="'.url_for('globalreport/unpaidThirdparty').'"')); ?> </span> </td>
											</tr>
											<tr>
												<td height="1" colspan="5" align="left" valign="top"></td>
											</tr>
											</table>
											</form>
											</td>
										</tr>
										<tr>
											<td height="20" align="left" valign="top">&nbsp;</td>
										</tr>
										<!-- Search Form Complete-->

										
										<tr valign="top">
										<td colspan="2" class="dot"></td>
										</tr>
										<tr align="center" valign="top">
										<td colspan="2" class="ListAreaPad">
											<table width="100%" cellspacing="1" cellpadding="1" class="brd1">
											
											<?php if($pager->getnbResults() > 0){?>
											<tr class="fldbg">
															<td align="center" width="25%"><b>Case No. & Case Title</b></td>
															<td align="center" width="25%"><b>Customer Name</b></td>
															<td align="center" width="20%"><b>3rd Party</b></td>
															<td align="center" width="15%"><b>Actual Amount</b></td>
															<td align="center" width="15%"><b>Payments Disbursed</b></td>
											</tr>              
											<?php $i=1; ?>
											<?php foreach ($pager->getResults() as $cases):?>
											<?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
											<tr class="<?php echo $class;?>">
															<td class="fldrowbg" align="left" valign="top"><?php echo link_to($cases->getCaseNo()." - ".$cases->getFirstTitle().' '.$cases->getLastTitle(),"dashboardcase/dashboardCaseDetails?customerId=".$cases->getUserId()."&caseId=".$cases->getId()); ?></td>
															<td class="fldrowbg" align="left" valign="top"><?php echo link_to($cases->getCasesUsers()->getFirstName().' '.$cases->getCasesUsers()->getLastName(),"dashboard/index?customerId=".$cases->getUserId()) ;?></td>
															<td class="fldrowbg" align="left" valign="top"><?php echo $cases->getCasesThirdParties()->getName();?></td>
															<td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($cases->getActualAmount(),2); ?></td>
															<td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency');
																if($cases->getReceivedAmount() != '') 
																	echo round($cases->getReceivedAmount(),2);
																else    
																	echo 0; ?></td>

											</tr>
											<?php endforeach; ?>
											<?php } else { ?> 
												<tr class="fldbg"><td class="errormss">No items found.</td></tr>
											<?php } ?>
											</table>
										</td>
										</tr>
										<tr>
											<td valign="top" height="20" align="left">&nbsp;</td>
										</tr>
										<tr align="center" valign="top">
										<td colspan="2" class="ListAreaPad">
											<?php
											$varExtra = '';
											if(isset($defaultArr['UserId']) && !empty($defaultArr['UserId'])) {
												$varExtra .="&UserId=".$defaultArr['UserId'];
											}

											if(isset($defaultArr['ThirdParty']) && !empty($defaultArr['ThirdParty'])) {
												$varExtra .="&ThirdParty=".$defaultArr['ThirdParty'];
											}
											
											if(isset($defaultArr['CaseNo']) && !empty($defaultArr['CaseNo'])) {
												$varExtra .="&CaseNo=".$defaultArr['CaseNo'];
											}
											
											if($defaultArr['StartAmount'] != '' && $defaultArr['EndAmount'] != '' ) {
												$varExtra .="&StartAmount=".$defaultArr['StartAmount'];
											}

											if($defaultArr['StartAmount'] != ''  && $defaultArr['EndAmount'] != '') {
												$varExtra .="&EndAmount=".$defaultArr['EndAmount'];
											}
											
											?>
											<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'globalreport/unpaidThirdparty', 'varExtra' => $varExtra));?>
										</td>
										</tr>
										</table>
										</td>
									</tr>
									<tr>
										<td align="left" valign="top" height="1"></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" height="20">&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
    <td align="left" valign="top">&nbsp;</td>
</tr>
<tr>
    <td align="left" valign="top">&nbsp;</td>
</tr>
</table>




<?php /*  // start comment by jaydip 
<?php include_partial('case/globalReportMenu');?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">
<!-- Bread Crumb Start -->
// end comment by jaydip
*/ ?>
<?php /*
<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
  <td width="30%" class="drkgrylnk" align="center"><div class="Title">Unpaid Cases from 3rd Party Report</div></td>
  <td width="35%" align="right" class="AdminBreadCrumb">
   <table cellpadding="8" cellspacing="0" align="right">
    <tr align="center">
     <td width="57" class="LinkImg" ><a href="<?php echo url_for('default/index') ?>" title="Home"><?php echo image_tag("admin/Icon_Cancel.gif" , array("alt"=>"Cancel","border"=>"0","title"=>"Cancel"))?><br/>
      Cancel </a></td>     
    </tr>
   </table>
  </td>
 </tr>
</table>
*/ ?>
<!-- Bread Crumb End -->
<?php /* start comment by jaydip 
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
            <td align="center" valign="top" class="CasesListSearch" colspan="2">
            <form action="<?php echo url_for('globalreport/unpaidThirdparty') ?>" method="post" onsubmit="return validateUnpaidThirdParty();">
    	       <table width="100%" cellspacing="10" cellpadding="0">
               <tr>
                <td width="220" align="left" valign="top"><?php echo $searchForm['CaseNo']->renderLabel(); ?></td>
                <td width="220" align="left" valign="top"><?php echo $searchForm['UserId']->renderLabel(); ?></td>
                <td width="220" align="left" valign="top"><?php echo $searchForm['ThirdParty']->renderLabel(); ?></td>
                <td width="220" align="left" valign="top"><?php echo $searchForm['StartAmount']->renderLabel(); ?></td>
                <td align="left" valign="top">&nbsp;</td>
               </tr>
               <tr>
                <td align="left" valign="top"><?php echo $searchForm['CaseNo']->render(); ?></td>
                <td align="left" valign="top"><?php echo $searchForm['UserId']->render(); ?></td>
                <td align="left" valign="top"><?php echo $searchForm['ThirdParty']->render(); ?></td>
                <td align="left" valign="top"> From
                                        <?php   echo $searchForm['StartAmount']->render(array('style'=>'width:50px;')); 
                                                echo "&nbsp;To&nbsp;";
											    echo $searchForm['EndAmount']->render(array('style'=>'width:50px;')); ?>								            
											    <br>
                                                <label class="error" id="searchAmountError"></label></td>
                <td align="left" valign="top"><?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'bluButton', 'value' => 'Search')); ?> </span> <span class="grayButton">
                                        <?php echo tag('input', array('name' => 'clear', 'type' => 'reset', 'id' => 'clear', 'class' => 'grayButton', 'value' => 'Clear', "onclick"=>'window.location="'.url_for('globalreport/unpaidThirdparty').'"')); ?> </span> </td>
               </tr>
               <tr>
                <td height="1" colspan="5" align="left" valign="top"></td>
               </tr>
               </table>
            </form>
            </td>
        </tr>
        <tr>
            <td height="20" align="left" valign="top">&nbsp;</td>
        </tr>
          <!-- Search Form Complete-->

          
          <tr valign="top">
           <td colspan="2" class="dot"></td>
          </tr>
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">
            <table width="100%" cellspacing="1" cellpadding="1" class="brd1">
            
            <?php if($pager->getnbResults() > 0){?>
             <tr class="fldbg">
                            <td align="center" width="25%"><b>Case No. & Case Title</b></td>
                            <td align="center" width="25%"><b>Customer Name</b></td>
                            <td align="center" width="20%"><b>3rd Party</b></td>
                            <td align="center" width="15%"><b>Actual Amount</b></td>
                            <td align="center" width="15%"><b>Received Amount</b></td>
             </tr>              
             <?php $i=1; ?>
             <?php foreach ($pager->getResults() as $cases):?>
             <?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
             <tr class="<?php echo $class;?>">
                            <td class="fldrowbg" align="left" valign="top"><?php echo link_to($cases->getCaseNo()." - ".$cases->getFirstTitle().' '.$cases->getLastTitle(),"dashboardcase/dashboardCaseDetails?customerId=".$cases->getUserId()."&caseId=".$cases->getId()); ?></td>
                            <td class="fldrowbg" align="left" valign="top"><?php echo link_to($cases->getCasesUsers()->getFirstName().' '.$cases->getCasesUsers()->getLastName(),"dashboard/index?customerId=".$cases->getUserId()) ;?></td>
                            <td class="fldrowbg" align="left" valign="top"><?php echo $cases->getCasesThirdParties()->getName();?></td>
                            <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').$cases->getActualAmount(); ?></td>
                            <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency');
                                if($cases->getReceivedAmount() != '') 
                                    echo $cases->getReceivedAmount();
                                else    
                                    echo 0; ?></td>
                                                    
             </tr>
             <?php endforeach; ?>    
             <?php } else { ?> 
                <tr class="fldbg"><td class="errormss">No 3rd Party Pending Bill Found !!</td></tr>
             <?php } ?>         
            </table>
           </td>
          </tr>
          <tr>
            <td valign="top" height="20" align="left">&nbsp;</td>
          </tr>
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">                     
              <?php    
              $varExtra = '';             
              if(isset($defaultArr['UserId']) && !empty($defaultArr['UserId'])) {
                  $varExtra .="&UserId=".$defaultArr['UserId'];
              }

              if(isset($defaultArr['ThirdParty']) && !empty($defaultArr['ThirdParty'])) {
                  $varExtra .="&ThirdParty=".$defaultArr['ThirdParty'];
              }
              /*if(isset($defaultArr['UserCaseNo']) && !empty($defaultArr['UserCaseNo'])) {
                  $varExtra .="&UserCaseNo=".$defaultArr['UserCaseNo'];
              }*/

              /* start comment by jaydip 
              if(isset($defaultArr['CaseNo']) && !empty($defaultArr['CaseNo'])) {
                  $varExtra .="&CaseNo=".$defaultArr['CaseNo'];
              }
              
              if(!empty($defaultArr['StartAmount']) && !empty($defaultArr['EndAmount'])) {
                  $varExtra .="&StartAmount=".$defaultArr['StartAmount'];
              }

              if(!empty($defaultArr['StartAmount']) && !empty($defaultArr['EndAmount'])) {
                  $varExtra .="&EndAmount=".$defaultArr['EndAmount'];
              }
              
              ?>
               <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'globalreport/unpaidThirdparty', 'varExtra' => $varExtra));?>
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
end comment by jaydip  */ ?>
<script type="text/javascript">
$(function() {
    $( "#search_CaseNo" ).autocomplete({
        source: "<?php url_for('globalreport/unpaidThirdparty') ?>",
        minLength: 2
    });
});
</script>