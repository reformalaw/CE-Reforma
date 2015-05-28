<?php include_partial('case/header');?>

<table width="98%" cellspacing="0" cellpadding="0" align="center">
	
	<tr>
		<td align="left" valign="top">&nbsp;</td>
	</tr>
	<tr>
		<td align="left" valign="top">
			<table width="100%" cellspacing="0" cellpadding="0">
				<tr>
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
													<td align="left" valign="middle"><strong>Unpaid Customer Report</strong></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
        <td class="ContentPad">
         <table cellspacing="0" cellpadding="0" align="center" width="100%">
          <tr>
            <td align="center" valign="top" class="CasesListSearch" colspan="2">
            <form action="<?php echo url_for('globalreport/unpaidCustomer') ?>" method="post" onsubmit="return validateUnpaidCustomer();">
    	       <table width="100%" cellspacing="10" cellpadding="0">
               <tr>
                <td width="220" align="left" valign="top"><?php echo $searchForm['UserId']->renderLabel(); ?></td>
                <td width="220" align="left" valign="top"><?php echo $searchForm['StartAmount']->renderLabel(); ?></td>
                <td align="left" valign="top">&nbsp;</td>
               </tr>
               <tr>
                <td align="left" valign="top"><?php echo $searchForm['UserId']->render(); ?></td>
                <td align="left" valign="top"> From
                                        <?php   echo $searchForm['StartAmount']->render(array('style'=>'width:50px;')); 
                                                echo "&nbsp;To&nbsp;";
											    echo $searchForm['EndAmount']->render(array('style'=>'width:50px;')); ?>								            
                                                <label class="error" id="searchAmountError"></label></td>
                <td align="left" valign="top"><?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'bluButton', 'value' => 'Search')); ?> </span> <span class="grayButton">
                                        <?php echo tag('input', array('name' => 'clear', 'type' => 'reset', 'id' => 'clear', 'class' => 'grayButton', 'value' => 'Clear', "onclick"=>'window.location="'.url_for('globalreport/unpaidCustomer').'"')); ?> </span></td>
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
                            <td align="center" width="15%"><b>Actual Amount</b></td>
                            <td align="center" width="15%"><b>Payable Amount</b></td>
                            <td align="center" width="10%"><b>Paid Amount</b></td>
                            <td align="center" width="10%"><b>Accepted Date</b></td>
             </tr>              
             <?php $i=1; ?>
             <?php foreach ($pager->getResults() as $cases):?>
             <?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
             <tr class="<?php echo $class;?>">
                            <td class="fldrowbg" align="left" valign="top"><?php echo link_to($cases->getCaseNo()." - ".$cases->getFirstTitle().' '.$cases->getLastTitle(), "dashboardcase/dashboardCaseDetails?customerId=".$cases->getUserId()."&caseId=".$cases->getId()); ?></td>
                            <td class="fldrowbg" align="left" valign="top"><?php echo link_to($cases->getCasesUsers()->getFirstName().' '.$cases->getCasesUsers()->getLastName(),"dashboard/index?customerId=".$cases->getUserId()) ;?></td>
                            <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($cases->getActualAmount(),2); ?></td>
                            <td class="fldrowbg" align="right" valign="top">
                                <?php
                                echo sfConfig::get('app_currency').round($cases->getPayableAmount(),2); ?></td>

                            <td class="fldrowbg" align="right" valign="top">
                                <?php echo sfConfig::get('app_currency');
                                      if($cases->getPaidAmount() != '')  
                                            echo round($cases->getPaidAmount(),2);
                                       else 
                                            echo '0';

                                 ?></td>

                            <td class="fldrowbg" align="center" valign="top"><?php echo date('Y-m-d',strtotime($cases->getAgreementDate())); ?></td>
             </tr>
             <?php endforeach; ?>
             <?php } else { ?>
                <tr class="fldbg"><td class="errormss">No items found.</td></tr>
             <?php } ?>
            </table>
           </td>
          </tr>
          <tr>
            <td height="20" align="left" valign="top">&nbsp;</td>
          </tr>
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">
              <?php
              $varExtra = '';
              if(isset($defaultArr['UserId']) && !empty($defaultArr['UserId'])) {
                  $varExtra .="&UserId=".$defaultArr['UserId'];
              }

              if($defaultArr['StartAmount'] != '' && $defaultArr['EndAmount'] !='') {
                  $varExtra .="&StartAmount=".$defaultArr['StartAmount'];
              }

              if($defaultArr['StartAmount'] != '' && $defaultArr['EndAmount'] != '') {
                  $varExtra .="&EndAmount=".$defaultArr['EndAmount'];
              }

              ?>
               <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'globalreport/unpaidCustomer', 'varExtra' => $varExtra));?>
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


<?php /* // Commented By Jaydip Dodiya
<?php include_partial('case/globalReportMenu');?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">

<!-- Bread Crumb Start -->
*/ // Commented By Jaydip Dodiya ?>
<?php /*
<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
  <td width="30%" class="drkgrylnk" align="center"><div class="Title">Unpaid Customer Bills Report</div></td>
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
<?php /* // Commented By Jaydip Dodiya
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
          <!--<tr>
           <td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php //echo image_tag("admin/Icon_Groups.gif", array("alt"=>"Cases","title"=>"Cases","align"=>"middle"))?></td>
           <td width="90%" class="ContentBtmDotLn">
            <div style="float:left;" class="Title">Unpaid Customer Bills Report</div>

           </td>
          </tr>-->
          
          
          <!-- Search Form -->
          <tr>
            <td align="center" valign="top" class="CasesListSearch" colspan="2">
            <form action="<?php echo url_for('globalreport/unpaidCustomer') ?>" method="post" onsubmit="return validateUnpaidCustomer();">
    	       <table width="100%" cellspacing="10" cellpadding="0">
               <tr>
                <td width="220" align="left" valign="top"><?php echo $searchForm['UserId']->renderLabel(); ?></td>
                <td width="220" align="left" valign="top"><?php echo $searchForm['StartAmount']->renderLabel(); ?></td>
                <td align="left" valign="top">&nbsp;</td>
               </tr>
               <tr>
                <td align="left" valign="top"><?php echo $searchForm['UserId']->render(); ?></td>
                <td align="left" valign="top"> From
                                        <?php   echo $searchForm['StartAmount']->render(array('style'=>'width:50px;')); 
                                                echo "&nbsp;To&nbsp;";
											    echo $searchForm['EndAmount']->render(array('style'=>'width:50px;')); ?>								            
                                                <label class="error" id="searchAmountError"></label></td>
                <td align="left" valign="top"><?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'bluButton', 'value' => 'Search')); ?> </span> <span class="grayButton">
                                        <?php echo tag('input', array('name' => 'clear', 'type' => 'reset', 'id' => 'clear', 'class' => 'grayButton', 'value' => 'Clear', "onclick"=>'window.location="'.url_for('globalreport/unpaidCustomer').'"')); ?> </span></td>
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
          
          
          
          
          
          
          <!--<tr valign="top">
            <td colspan="2" class="" align="center">
            <form action="<?php /*echo url_for('globalreport/unpaidCustomer') ?>" method="post" onsubmit="return validateUnpaidCustomer();">
                <table border="0" cellspacing="0" cellpadding="0" class="filterMain">
                  <tr>
                    <td><div class="searchBoxMain">
                        <div class="innerBox padLR5">
                          <table width="100%" border="0" cellspacing="3" cellpadding="0" >
                            <tr>
                              <td width="60%"><table width="" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td align="left"><b><span><?php echo $searchForm['UserId']->renderLabel(); ?> </span></b></td>

                                    <td align="left"  style="padding-left:25px;"><b><span><?php echo $searchForm['StartAmount']->renderLabel(); ?></span></b></td>
                                    <td align="left"><b><span></span></b></td>
                                    
                                    
                                  </tr>
                                  <tr>
                                    <td align="left" valign="top"><?php echo $searchForm['UserId']->render(); ?> </td>

                                    <td align="left" style="padding-left:25px;" valign="top"><?php # echo $searchForm['Amount']->render(); ?> From
                                        <?php   echo $searchForm['StartAmount']->render(); 
                                        echo "&nbsp;To&nbsp;";
											echo $searchForm['EndAmount']->render(); ?>								            
                                            <label class="error" id="searchAmountError"></label>
                                    </td>
                                    <td align="left"></td>
                                    <td align="left" class="radioBtn" valign="top"><span class="bluButton"> 
                                        <?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'bluButton', 'value' => 'Search')); ?> </span> <span class="grayButton">
                                        <?php echo tag('input', array('name' => 'clear', 'type' => 'reset', 'id' => 'clear', 'class' => 'grayButton', 'value' => 'Clear', "onclick"=>'window.location="'.url_for('globalreport/unpaidCustomer').'"'));*/  ?> 
                                        <?php /* // Commented By Jaydip Dodiya
                                        </span> 
                                      </td>
                                  </tr>
                                  
                                </table></td>
                                
                                
                            </tr>
                            
             
                          </table>
                        </div>
                      </div></td>
                  </tr>
                  
                  
                </table>
              </form></td>
          </tr>-->
          
          
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
                            <td align="center" width="15%"><b>Actual Amount</b></td>
                            <td align="center" width="15%"><b>Payable Amount</b></td>
                            <td align="center" width="10%"><b>Paid Amount</b></td>
                            <td align="center" width="10%"><b>Accepted Date</b></td>
             </tr>              
             <?php $i=1; ?>
             <?php foreach ($pager->getResults() as $cases):?>
             <?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
             <tr class="<?php echo $class;?>">
                            <td class="fldrowbg" align="left" valign="top"><?php echo link_to($cases->getCaseNo()." - ".$cases->getFirstTitle().' '.$cases->getLastTitle(), "dashboardcase/dashboardCaseDetails?customerId=".$cases->getUserId()."&caseId=".$cases->getId()); ?></td>
                            <td class="fldrowbg" align="left" valign="top"><?php echo link_to($cases->getCasesUsers()->getFirstName().' '.$cases->getCasesUsers()->getLastName(),"dashboard/index?customerId=".$cases->getUserId()) ;?></td>
                            <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').$cases->getActualAmount(); ?></td>
                            <td class="fldrowbg" align="right" valign="top">
                                <?php #$output = clsCommon::calcCustomerPayment($cases->getId());
											#echo sfConfig::get('app_currency').$output['payable_amount'];
                                echo sfConfig::get('app_currency').$cases->getPayableAmount(); ?></td>
                                
                            <td class="fldrowbg" align="right" valign="top">
                                <?php echo sfConfig::get('app_currency');
                                      if($cases->getPaidAmount() != '')  
                                            echo $cases->getPaidAmount();
                                       else 
                                            echo '0';     
                                
                                 ?></td>                                
                            
                            <td class="fldrowbg" align="center" valign="top"><?php echo date('Y-m-d',strtotime($cases->getAgreementDate())); ?></td>
             </tr>
             <?php endforeach; ?>    
             <?php } else { ?> 
                <tr class="fldbg"><td class="errormss">No Customer Pending Bill Found !!</td></tr>
             <?php } ?>         
            </table>
           </td>
          </tr>
          <tr>
            <td height="20" align="left" valign="top">&nbsp;</td>
          </tr>
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">                     
              <?php    
              $varExtra = '';
              if(isset($defaultArr['UserId']) && !empty($defaultArr['UserId'])) {
                  $varExtra .="&UserId=".$defaultArr['UserId'];
              }

              if(!empty($defaultArr['StartAmount']) && !empty($defaultArr['EndAmount'])) {
                  $varExtra .="&StartAmount=".$defaultArr['StartAmount'];
              }

              if(!empty($defaultArr['StartAmount']) && !empty($defaultArr['EndAmount'])) {
                  $varExtra .="&EndAmount=".$defaultArr['EndAmount'];
              }

              ?>
               <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'globalreport/unpaidCustomer', 'varExtra' => $varExtra));?>
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
 // Commented By Jaydip Dodiya  */ ?>