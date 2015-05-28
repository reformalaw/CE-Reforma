<?php include_partial('customercase/header');?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">
<!-- Bread Crumb Start -->
<?php /*
<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
  <td width="30%" class="drkgrylnk" align="center"><div class="Title">Under Payment Report</div></td>
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
</td></tr>
<tr><td width="100%">
<!-- Control Panel Start -->
<table width="100%" cellspacing="2" cellpadding="0">
 <tr>
  <td align="center" class="ContentPad" height="10"></td>
 </tr>
 <tr>
  <td width="100%" align="center" class="ContentPad">
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
            <div style="float:left;" class="Title">Under Payment Report</div>

           </td>
          </tr>-->
          
          
          <!-- Search Form -->
          <tr valign="top" style="display:none">
            <td colspan="2" class="" align="center">
            <form action="<?php echo url_for('customerreport/underPaymentReport') ?>" method="post" onsubmit="return validatePaymentReport();">
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
                                        <?php echo tag('input', array('name' => 'clear', 'type' => 'reset', 'id' => 'clear', 'class' => 'grayButton', 'value' => 'Clear', "onclick"=>'window.location="'.url_for('customerreport/underPaymentReport').'"')); ?> </span> 
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
            <table width="100%" cellspacing="1" cellpadding="1" class="brd1">
            
            <?php if($pager->getnbResults() > 0){?>
             <tr class="fldbg">
                            <td align="center" width="30%"><b>Case No. & Case Title</b></td>
                            <td align="center" width="25%"><b>Actual Amount</b></td>
                            <td align="center" width="15%"><b>Receivable Amount</b></td>
                            <td align="center" width="15%"><b>Payments Disbursed</b></td>
                            <td align="center" width="15%"><b>Difference Amount</b></td>
                            
             </tr>
               <?php $i=1; ?>              
               <?php foreach ($pager->getResults() as $cases):?>
             <?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
               <tr class="<?php echo $class;?>">    
                            <td class="fldrowbg" align="left" valign="top"><?php echo link_to($cases->getCaseNo()." - ".$cases->getFirstTitle().' '.$cases->getLastTitle(),"customercase/view?id=".$cases->getId()) ;?></td>
                            <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').$cases->getActualAmount() ;?></td>
                            <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').$cases->getPayableAmount() ;?></td>
                            <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').$cases->getPaidAmount() ;?></td>
                            <td class="fldrowbg" align="right" valign="top"><?php 
                            if ($cases->getDifferenceAmount() != "") {
                                echo sfConfig::get('app_currency').$cases->getDifferenceAmount();	
                            }else {
                                echo sfConfig::get('app_currency').'0';
                            }
                            ?></td>
                                                    
             </tr>
             <?php endforeach; ?>    
             <?php } else { ?> 
                <tr class="fldbg"><td class="errormss">No items found.</td></tr>
             <?php } ?>         
            </table>
           </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr align="right" valign="top">
           <td colspan="2" class="ListAreaPad">                     
              <?php    
              $varExtra = '';             
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
               <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'customerreport/underPaymentReport', 'varExtra' => $varExtra));?>
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