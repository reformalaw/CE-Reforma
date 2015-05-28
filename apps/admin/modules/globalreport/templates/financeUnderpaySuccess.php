<table cellpadding="0" cellspacing="0" border="0" width="100%">
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
            <div style="float:left;" class="Title">Finance Report - Total under payment amount
                <br>
                <?php include_partial('reports');?>
            </div>
           </td>
          </tr>
          
                                                                                                                     
          <!-- Search Form -->
          <tr valign="top" style="display:none">
            <td colspan="2" class="" align="center" >
            <form action="<?php echo url_for('globalreport/financeUnderpay') ?>" method="post" onsubmit="return validateUnpaidCustomer();">
                <table border="0" cellspacing="0" cellpadding="0" class="filterMain">
                  <tr>
                    <td><div class="searchBoxMain">
                        <div class="innerBox padLR5">
                          <table width="100%" border="0" cellspacing="3" cellpadding="0" >
                            <tr>
                              <td width="60%"><table width="" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td align="left"><b><span><?php #echo $searchForm['UserId']->renderLabel(); ?> </span></b></td>

                                    <td align="left"  style="padding-left:25px;"><b><span><?php #echo $searchForm['StartAmount']->renderLabel(); ?></span></b></td>
                                    <td align="left"><b><span></span></b></td>
                                    
                                    
                                  </tr>
                                  <tr>
                                    <td align="left" valign="top"><?php #echo $searchForm['UserId']->render(); ?> </td>

                                    <td align="left" style="padding-left:25px;" valign="top"><?php # echo $searchForm['Amount']->render(); ?> From
                                        <?php   /*echo $searchForm['StartAmount']->render(); 
                                            echo "&nbsp;To&nbsp;";
											echo $searchForm['EndAmount']->render(); */ ?>								            
                                            <label class="error" id="searchAmountError"></label>
                                    </td>
                                    <td align="left"></td>
                                    <td align="left" class="radioBtn" valign="top"><span class="bluButton"> 
                                        <?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'bluButton', 'value' => 'Search')); ?> </span> <span class="grayButton">
                                        <?php echo tag('input', array('name' => 'clear', 'type' => 'reset', 'id' => 'clear', 'class' => 'grayButton', 'value' => 'Clear', "onclick"=>'window.location="'.url_for('globalreport/financeUnderpay').'"')); ?> </span> 
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
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">
            <table width="95%" cellspacing="1" cellpadding="1" class="brd1">
            
            <?php if($pager->getnbResults() > 0){?>
             <tr class="fldbg">
                <td align="center" width="25%"><b>Customer Name</b></td>
                <td align="center" width="25%"><b>UnderPay Adjustment</b></td>                            
             </tr>              
               <?php foreach ($pager->getResults() as $cases):?>
             <tr>
                <td class="fldrowbg" align="left" valign="top"><?php echo $cases->getFirstname().' '.$cases->getLastname() ;?></td>
                <td class="fldrowbg" align="left" valign="top">$<?php echo $cases->getUnderpayamt() ?></td>
                                                    
             </tr>
             <?php endforeach; ?>    
             <?php } else { ?> 
                <tr class="fldbg"><td class="errormss">No items found.</td></tr>
             <?php } ?>         
            </table>
           </td>
          </tr>
          <tr align="right" valign="top">
           <td colspan="2" class="ListAreaPad">                     
              <?php    
              $varExtra = '';             
              /*if(isset($defaultArr['UserId']) && !empty($defaultArr['UserId'])) {
                  $varExtra .="&UserId=".$defaultArr['UserId'];
              }

              if(!empty($defaultArr['StartAmount']) && !empty($defaultArr['EndAmount'])) {
                  $varExtra .="&StartAmount=".$defaultArr['StartAmount'];
              }

              if(!empty($defaultArr['StartAmount']) && !empty($defaultArr['EndAmount'])) {
                  $varExtra .="&EndAmount=".$defaultArr['EndAmount'];
              }*/
              
              ?>
               <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'globalreport/financeUnderpay', 'varExtra' => $varExtra));?>
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