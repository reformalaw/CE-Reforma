<table width="98%" cellspacing="0" cellpadding="0" align="center">
  <?php include_component('dashboardcase', 'profile');?>
  <tr>
    <td align="center" valign="top">&nbsp;</td>
  </tr>
  <!--<tr>
    <td valign="middle" align="center" class="CasesListUserName"><?php //echo ucwords($name);?></td>
  </tr>
  <tr>
    <td align="center" valign="top">&nbsp;</td>
  </tr>-->
  <tr>
  	<td class="CashDetails">
    	<table width="97%" cellspacing="0" cellpadding="0" align="center">
        	<tr><td height="20"></td></tr>
        	 <tr>
    <td align="center" valign="top" class="WebsiteTab">
    	<table width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="10" class="BorderBottom">&nbsp;</td>
                    <td width="120" align="center" valign="middle" class="SelectTab"><?php echo link_to("Payment Reports",'dashboardreport/index?customerId='.$sf_params->get('customerId')); ?></td>
                    <td width="2" align="center" valign="middle" class="BorderBottom"></td>
                    <td width="140" align="center" valign="middle" class="DeSelectTab"><?php echo link_to("Under Payment Report",'dashboardreport/underpay?customerId='.$sf_params->get('customerId')); ?></td>
                    <td class="BorderBottom">&nbsp;</td>
                  </tr>
                </table>
    </td>
  </tr>
  <tr>
    <td align="center" valign="top" class="WebsiteDetails"><table width="96%" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="top" height="30">&nbsp;</td>
          </tr>
          <tr>
            <td align="center" valign="top" class="PaymentStatistics">
                <fieldset>
                    <legend>Customer Statistics</legend>
                    <table width="98%" border="0" cellspacing="1" cellpadding="0" >
                        <tr>
                            <td align="center" class="heading"><strong>Total Accepted Cases </strong></td>
                            <td align="center" class="heading"><strong>Total Actual Amount</strong></td>
                            <td align="center" class="heading"><strong>Total Payable Amount</strong></td>
                            <td align="center" class="heading"><strong>Total Paid Amount</strong></td>
                            <td align="center" class="heading"><strong>Total UnderPay Adjustment</strong></td>
                            <td align="center" class="heading"><strong>Total Balance</strong></td>
                        </tr>
                        <tr>
                            <td align="center" class="details"><strong><?php echo $totalAcceptedCasesCount;  ?></strong></td>
                            <td align="center" class="details"><strong><?php echo sfConfig::get('app_currency').round($totalCasesAmount['actualamount'],2);  ?></strong></td>
                            <td align="center" class="details"><strong><?php echo sfConfig::get('app_currency').round($totalCasesAmount['payableamount'],2);  ?></strong></td>
                            <td align="center" class="details"><strong><?php echo sfConfig::get('app_currency').round($totalCasesAmount['paidamount'],2);  ?></strong></td>
                            <td align="center" class="details"><strong><?php echo sfConfig::get('app_currency').round($totalCasesAmount['underpayamount'],2);  ?></strong></td>
                            <td align="center" class="details"><strong>
                            <?php $balance =  round(( ( $totalCasesAmount['payableamount'] - $totalCasesAmount['paidamount'] ) - $totalCasesAmount['underpayamount'] ) ,2); 
                            if($balance > 0) {
                                echo sfConfig::get('app_currency').$balance.'      Cr.';
                            } elseif( $balance < 0) {
                                echo sfConfig::get('app_currency').abs($balance).'      Dr.';
                            } else if($balance == 0) {
                                echo sfConfig::get('app_currency').$balance.'      Cr.';
                            }
                            ?>
                            </strong></td>
                        </tr>
                     </table>
                </fieldset>
            </td>
          </tr>
          
          
          <tr>
            <td align="left" valign="top" height="30">&nbsp;</td>
          </tr>
          
          <tr>
            <td align="center" valign="top" class="PaymentStatistics">
                <fieldset>
                    <legend>3rd Party Statistics</legend>
                    <table width="98%" border="0" cellspacing="1" cellpadding="0" >
                        <tr>
                            <td align="center" class="heading"><strong>Receivable Amount </strong></td>
                            <td align="center" class="heading"><strong>Received Amount</strong></td>
                            <td align="center" class="heading"><strong>3rd Party Under Paid</strong></td>
                            <td align="center" class="heading"><strong>Balance</strong></td>
                        </tr>
                        <tr>
                            <td align="center" class="details"><strong><?php echo sfConfig::get('app_currency').round($totalCasesAmount['actualamount'],2);  ?></strong></td>
                            <td align="center" class="details"><strong><?php echo sfConfig::get('app_currency').round($totalCasesAmount['receivedamount'],2);  ?></strong></td>
                            <td align="center" class="details"><strong><?php #echo sfConfig::get('app_currency').$totalCasesAmount['underpayamount'];  ?>
                            <?php echo sfConfig::get('app_currency').round($totalDifferenceAmount['diffamount'],2);  ?></strong></td>
                            
                            <td align="center" class="details"><strong>
                            <?php #$balance =  ( ( $totalCasesAmount['actualamount'] - $totalCasesAmount['receivedamount'] ) - $totalCasesAmount['underpayamount'] ) ; 
                            $balance =  round(( ( $totalCasesAmount['actualamount'] - $totalCasesAmount['receivedamount'] ) - $totalDifferenceAmount['diffamount'] ),2) ;
                            if($balance > 0) {
                                echo sfConfig::get('app_currency').$balance.'      Dr.';
                            } elseif( $balance < 0) {
                                echo sfConfig::get('app_currency').abs($balance).'     Cr.';
                            } else if($balance == 0) {
                                echo sfConfig::get('app_currency').$balance.'      Dr.';
                            }
                            ?>
                            </strong></td>
                        </tr>
                     </table>
                </fieldset>
            </td>
          </tr>
          
          
          <tr>
            <td align="left" valign="top" height="30">&nbsp;</td>
          </tr>
          
          <tr>
            <td align="center" valign="top" class="PaymentStatistics">
                <fieldset>
                    <legend>Search Area</legend>
                        <form action="<?php echo url_for('dashboardreport/index?customerId='.$customerId) ?>" method="post" onsubmit="return validateDashboardPaymentReport();">
                        <table border="0" cellspacing="0" cellpadding="0" class="SearchArea" width="98%">
                          <tr>
                            <td>
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <!--<td align="left"><b><span><?php //echo $searchForm['UserCaseNo']->renderLabel(); ?> </span></b></td>-->
                                            <td align="left" width="20%"><b><span><?php echo $searchForm['CaseNo']->renderLabel(); ?> </span></b></td>
                                            <td align="left" width="25%"><b><span><?php echo $searchForm['StartAmount']->renderLabel(); ?></span></b></td>
                                            <td align="left" width="18%"><b><span><?php echo $searchForm['Stage']->renderLabel(); ?></span></b></td>
                                            <td align="left"><b><span>Select Agreement Date<?php #echo $searchForm['FromDate']->renderLabel(); ?></span></b></td>
                                          </tr>
                                          
                                          <tr>
                                            <td align="left" valign="top"><?php echo $searchForm['CaseNo']->render(); ?> </td>
                                            
                                            <!--<td align="left" valign="top"><?php //echo $searchForm['UserCaseNo']->render(); ?> </td>-->
        
                                            <td align="left" valign="top"><?php # echo $searchForm['Amount']->render(); ?> From
                                                <?php   echo $searchForm['StartAmount']->render(); 
                                                echo "&nbsp;To&nbsp;";
                                                    echo $searchForm['EndAmount']->render(); ?>								            
                                                    <label class="error" id="searchAmountError"></label>
                                            </td>
                                            <td align="left" valign="top"><?php echo $searchForm['Stage']->render(); ?> </td>
                                            
                                            <td align="left" valign="top"><?php echo $searchForm['FromDate']->render(); 
                                            echo "&nbsp;To&nbsp;";
                                                    echo $searchForm['ToDate']->render();  ?>
                                                    <label class="error" id="dateError"></label>
                                            </td>
                                            
                                            <td align="left" class="radioBtn" valign="top"><span class="bluButton"> 
                                                <?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'bluButton', 'value' => 'Search')); ?> </span> <span class="grayButton">
                                                <?php echo tag('input', array('name' => 'clear', 'type' => 'reset', 'id' => 'clear', 'class' => 'grayButton', 'value' => 'Clear', "onclick"=>'window.location="'.url_for('dashboardreport/index?customerId='.$customerId).'"')); ?> </span> 
                                              </td>
                                          </tr>
                                          
                                        </table>
                            </td>
                          </tr>
                          
                          
                        </table>
                      </form>
                    </fieldset>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top" height="30">&nbsp;</td>
          </tr>
          <tr>
            <td align="center" valign="top"><table width="100%" cellspacing="1" cellpadding="1" class="brd1">
                    
                    <?php if($pager->getnbResults() > 0){?>
                     <tr class="fldbg">
                                    <td align="center" width="7%"><b>Agreement Dt.</b></td>   
                                    <td align="center" width="11%"><b>Case No. & Case Title</b></td>
                                    <td align="center" width="7%"><b>Actual Amt.</b></td>
                                    <td align="center" width="5%"><b> Commision</b></td>
                                    <td align="center" width="7%"><b>Processing Fees</b></td>
                                    <td align="center" width="7%"><b>Payable Amount</b></td>
                                    <td align="center" width="7%"><b>UnderPay Adjustment</b></td>
                                    <td align="center" width="7%"><b>Paid Amount</b></td>
                                    <td align="center" width="7%"><b>Remain To Pay</b></td>
                                    <td align="center" width="7%"><b>Counsel Edge Overpaid</b></td>
                                    <td align="center" width="7%"><b>Received Amount</b></td>
                                    <td align="center" width="7%"><b>Remain To Receive</b></td>
                                    <td align="center" width="7%"><b>3rd Party Overpaid</b></td>
                                    <td align="center" width="7%"><b>Stage</b></td>
                                    
                     </tr>
                     <?php $i=1; ?>              
                     <?php foreach ($pager->getResults() as $cases):?>
                     <?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
                       <tr class="<?php echo $class;?>">                        
                                    <td class="fldrowbg" align="left" valign="top"><?php echo date(sfConfig::get('app_dateformat'), strtotime($cases->getAgreementDate())) ;?></td>
                                    <td class="fldrowbg" align="left" valign="top"><?php echo link_to($cases->getCaseNo()." - ".$cases->getFirstTitle().' '.$cases->getLastTitle(),'dashboardcase/dashboardCaseDetails?customerId='.$cases->getUserId().'&caseId='.$cases->getId()); ?></td>
                                    <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($cases->getActualAmount(),2) ;?></td>
                                    <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($cases->getCommisionActual(),2) ;  ?></td>
                                    <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($cases->getProcessingFees(),2); ?></td>
                                    <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($cases->getPayableAmount(),2); ?></td>
                                    
                                    
                                    <td class="fldrowbg" align="right" valign="top"><?php  if ($cases->getUnderpayAdjustment() != ""){ echo sfConfig::get('app_currency').round($cases->getUnderpayAdjustment(),2); }else { echo sfConfig::get('app_currency')."0"; } ?></td>
                                    
                                    <?php if($cases->getStage() == sfConfig::get('app_CaseStage_Accepted')) { ?>
                                    
                                        <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').'0'; ?></td>
                                        <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($cases->getPayableAmount(),2); ?></td>
                                        
                                        
                                        <td class="fldrowbg" align="right" valign="top">
                                            <?php if($cases->getPaidAmount() > $cases->getPayableAmount()) {
                                                echo sfConfig::get('app_currency').round(( $cases->getPaidAmount() - $cases->getPayableAmount()),2);
                                            } else {
                                                echo sfConfig::get('app_currency').'0';
                                            }   ?>
                                        </td>
                                        
                                        <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').'0'; ?></td>
                                        <td class="fldrowbg" align="right" valign="top"> <?php echo sfConfig::get('app_currency').round($cases->getActualAmount(),2); ?>    </td>
                                        
                                        
                                         <td class="fldrowbg" align="right" valign="top">
                                            <?php if($cases->getReceivedAmount() > $cases->getActualAmount()) {
                                                echo sfConfig::get('app_currency').round(( $cases->getReceivedAmount() - $cases->getActualAmount()),2);
                                            } else {
                                                echo sfConfig::get('app_currency').'0';
                                            }   ?>
                                         </td>

                                    <?php } else {?>
                                    
                                        <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($cases->getPaidAmount(),2); ?></td>
                                        <td class="fldrowbg" align="right" valign="top">
                                            
                                             <?php if($cases->getPaidAmount() > $cases->getPayableAmount()) {
                                                 echo sfConfig::get('app_currency').'0';
                                             } else {
                                                 echo sfConfig::get('app_currency').round($cases->getRemainToPay(),2);
                                             }       ?>
                                            
                                         </td>
                                        
                                        <td class="fldrowbg" align="right" valign="top">
                                            <?php if($cases->getPaidAmount() > $cases->getPayableAmount()) {
                                                echo sfConfig::get('app_currency').round(( $cases->getPaidAmount() - $cases->getPayableAmount()),2);
                                            } else {
                                                echo sfConfig::get('app_currency').'0';
                                            }   ?>
                                        </td>

                                        <td class="fldrowbg" align="right" valign="top"><?php 

                                        if($cases->getReceivedAmount() != '' )
                                        echo sfConfig::get('app_currency').round($cases->getReceivedAmount(),2);
                                        else
                                        echo sfConfig::get('app_currency').'0';
                                                ?></td>
                                        <td class="fldrowbg" align="right" valign="top">
                                            <?php if($cases->getRemainToReceive() != '' ) {
                                                    if($cases->getReceivedAmount() > $cases->getActualAmount()) {
                                                        echo sfConfig::get('app_currency').'0';
                                                    } else {
                                                        echo sfConfig::get('app_currency').round($cases->getRemainToReceive(),2);
                                                    } 
                                                
                                            } else { 
                                                echo sfConfig::get('app_currency').round($cases->getActualAmount(),2);
                                            }   
                                            #echo  image_tag('admin/pending-icon.png',array('width'=>"24",'title' => 'Not Available'));
                                                ?>

                                         </td>
                                         <td class="fldrowbg" align="right" valign="top">
                                            <?php if($cases->getReceivedAmount() > $cases->getActualAmount()) {
                                                echo sfConfig::get('app_currency').round(( $cases->getReceivedAmount() - $cases->getActualAmount()),2);
                                            } else {
                                                echo sfConfig::get('app_currency').'0';
                                            }   ?>
                                         </td>
                                         
                                    <?php } ?> 

                                    <!--START this condition is added for close to closed issue solve-->
                                    <?php if($cases->getStage() == sfConfig::get("app_CaseStage_Close")):?>
										<td class="fldrowbg" align="left" valign="top"><?php echo sfConfig::get("app_CaseClosed_Closed");?> </td>
									<?php else: ?>
										<td class="fldrowbg" align="left" valign="top"><?php echo $cases->getStage();?> </td>
									<?php endif;?>
									<!--END this condition is added for close to closed issue solve-->
                     </tr>
                     <?php endforeach; ?>    
                     <?php } else { ?> 
                        <tr class="fldbg"><td class="errormss">No items found.</td></tr>
                     <?php } ?>         
                    </table></td>
          </tr>
          <tr>
            <td align="left" valign="top" height="20">&nbsp;</td>
          </tr>
          <tr>
            <td align="center" valign="top">
                <?php    
                $varExtra = '';
                /*if(isset($defaultArr['UserCaseNo']) && !empty($defaultArr['UserCaseNo'])) {
                $varExtra .="&UserCaseNo=".$defaultArr['UserCaseNo'];
                }*/


                $varExtra .="&customerId=".$customerId;

                if(isset($defaultArr['CaseNo']) && !empty($defaultArr['CaseNo'])) {
                    $varExtra .="&CaseNo=".$defaultArr['CaseNo'];
                }

                if($defaultArr['StartAmount'] != '' && $defaultArr['EndAmount'] != '') {
                    $varExtra .="&StartAmount=".$defaultArr['StartAmount'];
                }

                if($defaultArr['StartAmount'] != '' && $defaultArr['EndAmount'] != '')  {
                    $varExtra .="&EndAmount=".$defaultArr['EndAmount'];
                }

                if(isset($defaultArr['FromDate']) && !empty($defaultArr['FromDate'])) {
                    $varExtra .="&FromDate=".base64_encode($defaultArr['FromDate']);
                }

                if(isset($defaultArr['ToDate']) && !empty($defaultArr['ToDate'])) {
                    $varExtra .="&ToDate=".base64_encode($defaultArr['ToDate']);
                }

                if(isset($defaultArr['Stage']) && !empty($defaultArr['Stage'])) {
                    $varExtra .="&Stage=".$defaultArr['Stage'];
                }

                      ?>
                       <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'dashboardreport/index', 'varExtra' => $varExtra));?>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top" height="25">&nbsp;</td>
          </tr>  
    	</table>
    </td>
  </tr>
  <tr><td height="20"></td></tr>
        </table>
    </td>
  </tr>
 
</table>











<?php /*?><table cellpadding="0" cellspacing="0" border="0" width="100%">
                      <tr><td width="100%">
                      <!-- Bread Crumb Start -->
                      <table cellspacing="0" cellpadding="0" class="AdminNavBar">
                      <tr>
                      <td width="66%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
                      <td width="34%" align="right" class="AdminBreadCrumb">
                      <table cellpadding="8" cellspacing="0" align="right">
                      <tr align="center">
                      <td width="57" class="LinkImg" ><a href="<?php echo url_for('default/index') ?>" title="Home"><?php echo image_tag("admin/Icon_Cancel.gif" , array("alt"=>"Cancel","border"=>"0","title"=>"Cancel"))?><br/>
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
                      <div style="float:left;" class="Title">Payment Report</div>

                      </td>
                      </tr>


                      <!-- Search Form -->
                      <tr valign="top" >
                      <td colspan="2" class="" align="center">
                      <table border="0" cellspacing="0" cellpadding="0" class="filterMain">
                      <tr>
                      <td><div class="searchBoxMain">
                      <div class="innerBox padLR5">

                      <table width="100%" border="0" cellspacing="3" cellpadding="0" >
                      <tr>
                      <td align="center"><b>Total Accepted Cases </b></td>
                      <td align="center"><b>Total Actual Amount</b></td>
                      <td align="center"><b>Total Paid Amount</b></td>
                      <td align="center"><b>Total Underpay Amount</b></td>
                      </tr>
                      <tr>
                      <td align="center"><b><?php echo $totalAcceptedCasesCount;  ?></b></td>
                      <td align="center"><b><?php echo sfConfig::get('app_currency').$totalCasesAmount['actualamount'];  ?></b></td>
                      <td align="center"><b><?php echo sfConfig::get('app_currency').$totalCasesAmount['paidamount'];  ?></b></td>
                      <td align="center"><b><?php echo sfConfig::get('app_currency').$totalCasesAmount['underpayamount'];  ?></b></td>
                      </tr>

                      </table>
                      </div>
                      </div>
                      </td>
                      </tr>
                      </table>
                      </td>
                      </tr>

                      <tr>
                      <td>&nbsp;</td>
                      </tr>
                      <tr valign="top">
                      <td colspan="2" class="" align="center">
                      <form action="<?php echo url_for('dashboardreport/index?customerId='.$customerId) ?>" method="post" onsubmit="return validateDashboardPaymentReport();">
                      <table border="0" cellspacing="0" cellpadding="0" class="filterMain">
                      <tr>
                      <td><div class="searchBoxMain">
                      <div class="innerBox padLR5">
                      <table width="100%" border="0" cellspacing="3" cellpadding="0" >
                      <tr>
                      <td width="60%"><table width="" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                      <!--<td align="left"><b><span><?php //echo $searchForm['UserCaseNo']->renderLabel(); ?> </span></b></td>-->
                      <td align="left"><b><span><?php echo $searchForm['CaseNo']->renderLabel(); ?> </span></b></td>
                      <td align="left"  style="padding-left:25px;"><b><span><?php echo $searchForm['StartAmount']->renderLabel(); ?></span></b></td>
                      <td align="left"  style="padding-left:25px;"><b><span><?php echo $searchForm['Stage']->renderLabel(); ?></span></b></td>
                      <!--<td align="left"><b><span><?php #echo $searchForm['FromDate']->renderLabel(); ?></span></b></td>-->
                      </tr>

                      <tr>
                      <td align="left" valign="top"><?php echo $searchForm['CaseNo']->render(); ?> </td>

                      <!--<td align="left" valign="top"><?php //echo $searchForm['UserCaseNo']->render(); ?> </td>-->

                      <td align="left" style="padding-left:25px;" valign="top"><?php # echo $searchForm['Amount']->render(); ?> From
                      <?php   echo $searchForm['StartAmount']->render();
                      echo "&nbsp;To&nbsp;";
                      echo $searchForm['EndAmount']->render(); ?>
                      <label class="error" id="searchAmountError"></label>
                      </td>
                      <td align="left" valign="top"  style="padding-left:25px;"><?php echo $searchForm['Stage']->render(); ?> </td>

                      <!--<td align="left" valign="top"><?php /*echo $searchForm['FromDate']->render();
                      echo "&nbsp;To&nbsp;";
                      echo $searchForm['ToDate']->render(); ?>

                      <label class="error" id="dateError"></label>
                      </td>-->

                      <td align="left" class="radioBtn" valign="top"><span class="bluButton">
                      <?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'bluButton', 'value' => 'Search')); ?> </span> <span class="grayButton">
                      <?php echo tag('input', array('name' => 'clear', 'type' => 'reset', 'id' => 'clear', 'class' => 'grayButton', 'value' => 'Clear', "onclick"=>'window.location="'.url_for('dashboardreport/index?customerId='.$customerId).'"')); ?> </span>
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
                      </tr>





                      <tr valign="top">
                      <td colspan="2" class="dot"></td>
                      </tr>
                      <tr align="center" valign="top">
                      <td colspan="2" class="ListAreaPad">
                      <table width="95%" cellspacing="1" cellpadding="1" class="brd1">

                      <?php if($pager->getnbResults() > 0){?>
                      <tr class="fldbg">
                      <td align="center" width="20%"><b>Case No. & Case Title</b></td>
                      <td align="center" width="10%"><b>Actual Amount</b></td>
                      <td align="center" width="5%"><b> Commision</b></td>
                      <td align="center" width="8%"><b>Processing Fees</b></td>
                      <td align="center" width="10%"><b>UnderPay Adjustment</b></td>
                      <td align="center" width="10%"><b>Payable Amount</b></td>
                      <td align="center" width="10%"><b>Paid Amount</b></td>
                      <td align="center" width="10%"><b>Remain To Pay</b></td>
                      <td align="center" width="10%"><b>Received Amount</b></td>
                      <td align="center" width="7%"><b>Remain To Receive</b></td>
                      <td align="center" width="7%"><b>Stage</b></td>

                      </tr>
                      <?php $i=1; ?>
                      <?php foreach ($pager->getResults() as $cases):?>
                      <?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
                      <tr class="<?php echo $class;?>">
                      <td class="fldrowbg" align="left" valign="top"><?php echo link_to($cases->getCaseNo()." - ".$cases->getFirstTitle().' '.$cases->getLastTitle(),'dashboardcase/dashboardCaseDetails?customerId='.$cases->getUserId().'&caseId='.$cases->getId()); ?></td>
                      <td class="fldrowbg" align="left" valign="top"><?php echo sfConfig::get('app_currency').$cases->getActualAmount() ;?></td>
                      <td class="fldrowbg" align="left" valign="top"><?php echo sfConfig::get('app_currency').$cases->getCommisionActual() ;  ?></td>
                      <td class="fldrowbg" align="left" valign="top"><?php echo sfConfig::get('app_currency').$cases->getProcessingFees(); ?></td>
                      <td class="fldrowbg" align="left" valign="top"><?php  if ($cases->getUnderpayAdjustment() != ""){ echo sfConfig::get('app_currency').$cases->getUnderpayAdjustment(); }else { echo sfConfig::get('app_currency')."0"; } ?></td>
                      <td class="fldrowbg" align="left" valign="top"><?php echo sfConfig::get('app_currency').$cases->getPayableAmount(); ?></td>
                      <td class="fldrowbg" align="left" valign="top"><?php echo sfConfig::get('app_currency').$cases->getPaidAmount(); ?></td>
                      <td class="fldrowbg" align="left" valign="top"><?php echo sfConfig::get('app_currency').$cases->getRemainToPay(); ?></td>
                      <td class="fldrowbg" align="left" valign="top"><?php
                      if($cases->getReceivedAmount() != '' )
                      echo sfConfig::get('app_currency').$cases->getReceivedAmount();
                      else
                      echo sfConfig::get('app_currency').'0';
                      ?></td>
                      <td class="fldrowbg" align="left" valign="top">
                      <?php if($cases->getRemainToReceive() != '' )
                      echo sfConfig::get('app_currency').$cases->getRemainToReceive();
                      else
                      echo  image_tag('admin/pending-icon.png',array('width'=>"24",'title' => 'Not Available'));
                      ?>

                      </td>
                      <td class="fldrowbg" align="left" valign="top"><?php echo $cases->getStage();?> </td>
                      </tr>
                      <?php endforeach; ?>
                      <?php } else { ?>
                      <tr class="fldbg"><td class="errormss">No Report Found !!</td></tr>
                      <?php } ?>
                      </table>
                      </td>
                      </tr>
                      <tr align="right" valign="top">
                      <td colspan="2" class="ListAreaPad">
                      <?php
                      $varExtra = '';
                      if(isset($defaultArr['UserCaseNo']) && !empty($defaultArr['UserCaseNo'])) {
                      $varExtra .="&UserCaseNo=".$defaultArr['UserCaseNo'];
                      }


                      $varExtra .="&customerId=".$customerId;

                      if(isset($defaultArr['CaseNo']) && !empty($defaultArr['CaseNo'])) {
                      $varExtra .="&CaseNo=".$defaultArr['CaseNo'];
                      }

                      if(!empty($defaultArr['StartAmount']) && !empty($defaultArr['EndAmount'])) {
                      $varExtra .="&StartAmount=".$defaultArr['StartAmount'];
                      }

                      if(!empty($defaultArr['StartAmount']) && !empty($defaultArr['EndAmount'])) {
                      $varExtra .="&EndAmount=".$defaultArr['EndAmount'];
                      }

                      if(isset($defaultArr['FromDate']) && !empty($defaultArr['FromDate'])) {
                      $varExtra .="&FromDate=".base64_encode($defaultArr['FromDate']);
                      }

                      if(isset($defaultArr['ToDate']) && !empty($defaultArr['ToDate'])) {
                      $varExtra .="&ToDate=".base64_encode($defaultArr['ToDate']);
                      }

                      if(isset($defaultArr['Stage']) && !empty($defaultArr['Stage'])) {
                      $varExtra .="&Stage=".$defaultArr['Stage'];
                      }

                      ?>
                      <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'dashboardreport/index', 'varExtra' => $varExtra));?>
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

                      </td></tr>
</table><?php */?>


<script type="text/javascript">
$(function() {
    $( "#search_CaseNo" ).autocomplete({
        source: "<?php url_for('customerreport/paymentReport') ?>",
        minLength: 2
    });
});
</script>