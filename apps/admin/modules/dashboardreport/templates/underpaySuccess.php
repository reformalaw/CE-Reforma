<table width="98%" cellspacing="0" cellpadding="0" align="center">
  <?php include_component('dashboardcase', 'profile');?>
  <tr>
    <td align="center" valign="top">&nbsp;</td>
  </tr>
  <!--<tr>
    <td valign="middle" align="center" class="CasesListUserName">Jaydip Dodiya</td>
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
                            <td width="120" align="center" valign="middle" class="DeSelectTab"><?php echo link_to("Payment Reports",'dashboardreport/index?customerId='.$sf_params->get('customerId')); ?></td>
                            <td width="2" align="center" valign="middle" class="BorderBottom"></td>
                            <td width="140" align="center" valign="middle" class="SelectTab"><?php echo link_to("Under Payment Report",'dashboardreport/underpay?customerId='.$sf_params->get('customerId')); ?></td>
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
                    <td align="center" valign="top"><table width="100%" cellspacing="1" cellpadding="5" class="brd1">
                    
                    <?php if($pager->getnbResults() > 0){?>
                     <tr class="fldbg">
                                    <td align="center" width="25%"><b>Case No. & Case Title</b></td>
                                    <td align="center" width="25%"><b>Actual Amount</b></td>
                                    <td align="center" width="25%"><b>Received Amount</b></td>
                                    <td align="center" width="25%"><b>Difference Amount</b></td>
                                    
                     </tr>   
                       <?php $i=1; ?>            
                       <?php foreach ($pager->getResults() as $cases):?>
                       <?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
                     <tr class="<?php echo $class;?>">
                                    <td class="fldrowbg" align="left" valign="top"><?php echo link_to($cases->getCaseNo()." - ".$cases->getFirstTitle().' '.$cases->getLastTitle(),'dashboardcase/dashboardCaseDetails?customerId='.$cases->getUserId().'&caseId='.$cases->getId()); ?></td>
                                    <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($cases->getActualAmount(),2) ;?></td>
                                    <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($cases->getReceivedAmount(),2) ;?></td>
                                    <td class="fldrowbg" align="right" valign="top"><?php 
                                    if ($cases->getDifferenceAmount() != "") {
                                        echo sfConfig::get('app_currency').round($cases->getDifferenceAmount(),2);
                                    }else {
                                        echo "---";
                                    }
                                    ?></td>
                                                            
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
                      $varExtra .="&customerId=".$customerId;
                      /*if(isset($defaultArr['UserCaseNo']) && !empty($defaultArr['UserCaseNo'])) {
                      $varExtra .="&UserCaseNo=".$defaultArr['UserCaseNo'];
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
                      }*/
        
        
                      ?>
                       <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'dashboardreport/underpay', 'varExtra' => $varExtra));?>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" height="5">&nbsp;</td>
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
            <div style="float:left;" class="Title">Under Payment Report</div>

           </td>
          </tr>
          
          
          <!-- Search Form -->
          <tr valign="top" style="display:none">
            <td colspan="2" class="" align="center">
            <form action="<?php echo url_for('dashboardreport/underpay') ?>" method="post" onsubmit="return validatePaymentReport();">
                <table border="0" cellspacing="0" cellpadding="0" class="filterMain">
                  <tr>
                    <td><div class="searchBoxMain">
                        <div class="innerBox padLR5">
                          <table width="100%" border="0" cellspacing="3" cellpadding="0" >
                            <tr>
                              <td width="60%"><table width="" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td align="left"><b><span><?php #echo $searchForm['UserCaseNo']->renderLabel(); ?> </span></b></td>
                                    <td align="left"  style="padding-left:25px;"><b><span><?php #echo $searchForm['StartAmount']->renderLabel(); ?></span></b></td>
                                    <td align="left"><b><span><?php #echo $searchForm['FromDate']->renderLabel(); ?></span></b></td>
                                  </tr>
                                  
                                  <tr>
                                    <td align="left" valign="top"><?php #echo $searchForm['UserCaseNo']->render(); ?> </td>

                                    <td align="left" style="padding-left:25px;" valign="top"><?php # echo $searchForm['Amount']->render(); ?> From
                                        <?php   #echo $searchForm['StartAmount']->render(); 
#echo "&nbsp;To&nbsp;";
											#echo $searchForm['EndAmount']->render(); ?>								            
                                            <label class="error" id="searchAmountError"></label>
                                    </td>
                                    
                                    
                                    <td align="left"><?php #echo $searchForm['FromDate']->render(); 
											#echo "&nbsp;To&nbsp;";
											#echo $searchForm['ToDate']->render(); ?>
									        
                                            <label class="error" id="dateError"></label>
                                    </td>
                                    
                                    <td align="left" class="radioBtn" valign="top"><span class="bluButton"> 
                                        <?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'bluButton', 'value' => 'Search')); ?> </span> <span class="grayButton">
                                        <?php echo tag('input', array('name' => 'clear', 'type' => 'reset', 'id' => 'clear', 'class' => 'grayButton', 'value' => 'Clear', "onclick"=>'window.location="'.url_for('dashboardreport/underpay').'"')); ?> </span> 
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
          
          
          <!-- Search Form Complete-->

          
          <tr valign="top">
           <td colspan="2" class="dot"></td>
          </tr>
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">
            <table width="95%" cellspacing="1" cellpadding="1" class="brd1">
            
            <?php if($pager->getnbResults() > 0){?>
             <tr class="fldbg">
                            <td align="center" width="25%"><b>Case No. & Case Title</b></td>
                            <td align="center" width="25%"><b>Actual Amount</b></td>
                            <td align="center" width="25%"><b>Received Amount</b></td>
                            <td align="center" width="25%"><b>Difference Amount</b></td>
                            
             </tr>              
               <?php foreach ($pager->getResults() as $cases):?>
             <tr>
                            <td class="fldrowbg" align="left" valign="top"><?php echo link_to($cases->getCaseNo()." - ".$cases->getFirstTitle().' '.$cases->getLastTitle(),'dashboardcase/dashboardCaseDetails?customerId='.$cases->getUserId().'&caseId='.$cases->getId()); ?></td>
                            <td class="fldrowbg" align="left" valign="top"><?php echo sfConfig::get('app_currency').$cases->getActualAmount() ;?></td>
                            <td class="fldrowbg" align="left" valign="top"><?php echo sfConfig::get('app_currency').$cases->getReceivedAmount() ;?></td>
                            <td class="fldrowbg" align="left" valign="top"><?php 
                            if ($cases->getDifferenceAmount() != "") {
                                echo sfConfig::get('app_currency').$cases->getDifferenceAmount();
                            }else {
                                echo "---";
                            }
                            ?></td>
                                                    
             </tr>
             <?php endforeach; ?>    
             <?php } else { ?> 
                <tr class="fldbg"><td class="errormss">No Under Payment Found !!</td></tr>
             <?php } ?>         
            </table>
           </td>
          </tr>
          <tr align="right" valign="top">
           <td colspan="2" class="ListAreaPad">                     
              <?php    
              $varExtra = '';
              $varExtra .="&customerId=".$customerId;
              /*if(isset($defaultArr['UserCaseNo']) && !empty($defaultArr['UserCaseNo'])) {
              $varExtra .="&UserCaseNo=".$defaultArr['UserCaseNo'];
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


              ?>
               <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'dashboardreport/underpay', 'varExtra' => $varExtra));?>
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
</table><?php */?>