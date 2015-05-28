<table width="98%" cellspacing="0" cellpadding="0" align="center">
  <?php  include_component('dashboardcase', 'profile');?>
  <?php include_partial('default/message'); ?>
  <tr>
    <td align="left" valign="top">
    	<table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <?php include_partial('dashboardcase/verticalheader',array('caseObj' => $caseObj)); ?>
        <td align="center" valign="top" class="CashDetails"><table width="96%" cellspacing="0" cellpadding="0">
        	<tr>
                        	<td height="25"></td>
                        </tr>
              <tr>
                <td align="left" valign="top" class="WebsiteTab"><table width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="10" class="BorderBottom">&nbsp;</td>
                    <td width="140" align="center" valign="middle" class="DeSelectTab"><?php echo link_to("Customer Payments",'paymenthistory/index?caseId='.$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId')); ?></td>
                    <td width="2" align="center" valign="middle" class="BorderBottom"></td>
                    <td width="130" align="center" valign="middle" class="SelectTab"><?php echo link_to("3rd Party Payments",'paymentreceived/index?caseId='.$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId')); ?></td>
                    <td class="BorderBottom">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td align="center" valign="top" class="WebsiteDetails">
                	<table width="96%" cellspacing="1" cellpadding="1">
                    	<tr>
                        	<td height="10"></td>
                        </tr>
                    	<tr>
                        	<td>
                            	<table width="100%" cellspacing="1" cellpadding="1" class="PageListHeading">
                                  <tr>
                                    <td align="left" valign="middle"><strong>3rd Party Payments Disbursed List</strong></td>
                                  </tr>
                              </table>
                            </td>
                        </tr>
                        <tr>
                        	<td height="20"></td>
                        </tr>
                        <tr>
                        <td align="left" valign="middle">
                        	<table width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top"><table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top" width="30%"><fieldset>
                                <legend>Payment Details</legend>
                                    <table width="100%" cellspacing="10" cellpadding="0">
                                      <tr class="ContentTable">
                                        <td width="130"><strong> Actual Amount : </strong></td>
                                        <td><?php echo sfConfig::get('app_currency').round($caseObj->getActualAmount(),2); ?></td>
                                      </tr>
                                      <tr class="ContentTable">
                                        <td><strong>Payments Disbursed :</strong></td>
                                        <td><?php if($caseObj->getReceivedAmount() != '')
            echo sfConfig::get('app_currency').round($caseObj->getReceivedAmount(),2);
            else
                 echo sfConfig::get('app_currency').'0'     ;?> </td>
                                      </tr>
                                      <tr class="ContentTable">
                                        <td><strong>Pending Amount :  </strong></td>
                                        <td><?php echo sfConfig::get('app_currency');
                                            if( $caseObj->getReceivedAmount() > $caseObj->getActualAmount() )
                                                echo 0;
                                            else     
                                                echo round(($caseObj->getActualAmount() -  $caseObj->getReceivedAmount()),2) ; ?></td>
                                      </tr>
                                      <?php if($caseObj->getReceivedAmount() > $caseObj->getActualAmount()) { ?>
                                        <tr>
                                            <td><strong>3rd Party Overpaid :  </strong></td>
                                            <td><?php echo sfConfig::get('app_currency').round(abs($caseObj->getReceivedAmount() - $caseObj->getActualAmount() ),2); ?></td>
                                            
                                        </tr>
                                      <?php } ?>
                                    </table>
        </fieldset></td>
        <td width="2%" align="left" valign="top">&nbsp;</td>
        
        <?php if($caseObj->getStage() != sfConfig::get('app_CaseStage_Close')) { ?>
        <td align="left" valign="top">
                <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                        	<td align="left" valign="top">
                            	<table width="100%" cellspacing="1" cellpadding="1" class="PageListHeading">
                                  <tr>
                                    <td align="left" valign="middle"><strong>Log Received</strong></td>
                                  </tr>
                              </table>                            
                            </td>
                 </tr>
                  <tr>
                    <td align="left" valign="top">
        				<table width="100%" cellspacing="1" cellpadding="1" class="">
                        	<tr><td height="10"></td></tr>
                        	<?php include_partial('form', array('form' => $form, 'caseId' => $caseId, 'customerId' => $customerId)) ;?>
                        </table>			</td>
                  </tr>
                  </table>
          </td>
          <?php } ?>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" cellspacing="1" cellpadding="1" class="brd1">
            <?php if($pager->getnbResults() > 0){?>
             <tr class="fldbg">
                <td align="center" width="10%"><strong>No.</strong></td>
                <td align="center" width="20%"><strong>Payments Disbursed</strong></td>
                <td align="center" width="20%"><strong>Received Date</strong></td>
                <td align="center" width="25%"><strong>Memo</strong></td>
                <td width="25%" align="center"><strong>Action</strong></td>
             </tr>              
               <?php $i = 1;  ?>
               <?php foreach ($pager->getResults() as $third_party_payment_received):?>
                 <tr>
                    <td align="center" class="fldrowbg" valign="top"><?php echo  (($pager->getPage() * sfConfig::get('app_no_of_records_per_page')  ) - sfConfig::get('app_no_of_records_per_page') ) + $i ;?></td>
                    <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($third_party_payment_received->getReceivedAmount(),2) ?></td>
                    <td class="fldrowbg" align="center" valign="top"><?php echo date('Y-m-d',strtotime($third_party_payment_received->getPaymentReceivedDate())); ?></td>
                    
                    <?php if($third_party_payment_received->getDescription() != '' ) { ?>
                            <td class="fldrowbg" align="left" valign="top"><?php echo nl2br($third_party_payment_received->getDescription()); ?>
                    <?php } else { ?>
                            <td class="fldrowbg" align="center" valign="top">---</td>
                    <?php } ?></td>
                    
                    <td class="fldrowbg" align="center">
                        <?php if($caseObj->getStage() != sfConfig::get('app_CaseStage_Close')) { ?>
                            <a href="<?php echo url_for('paymentreceived/edit?id='.$third_party_payment_received->getId()."&customerId=".$customerId.'&caseId='.$third_party_payment_received->getCaseId()) ?>"><?php echo image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=> '24','height'=>'25'))?></a> &nbsp;
                            <a href="<?php echo url_for('paymentreceived/delete?id='.$third_party_payment_received->getId()."&customerId=".$customerId."&caseId=".$third_party_payment_received->getCaseId())?>"><?php echo image_tag('admin/delete-cases-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();",'width'=> '24','height'=>'25'))?></a>
                        <?php } else { ?>                                
                            <a href="#" style="cursor:none;"><?php echo image_tag("admin/blank-img.png",array('width'=>'24','height'=>'25')) ; ?></a> 
                            <a href="#" style="cursor:none;"><?php echo image_tag("admin/blank-img.png",array('width'=>'24','height'=>'25')) ; ?></a>                                           
                        <?php } ?>
                    </td>
                 </tr>
                 <?php $i++ ; endforeach; ?>    
             <?php } else { ?> 
                 <tr class="fldbg"><td class="errormss">No items found.</td></tr>
             <?php } ?>         
            </table></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top"><?php        
              $varExtra = '';         
              if(isset($customerId) && !empty($customerId)){
                  $varExtra .="&customerId=$customerId";
              }
              if(isset($caseId) && !empty($caseId)){
                  $varExtra .="&caseId=$caseId";
              }
              ?>
               <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'paymentreceived/index', 'varExtra' => $varExtra));?></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
</table>

                        </td>
                      </tr>
                  </table>
                </td>
              </tr>
        <tr>
                        	<td height="25"></td>
                        </tr>
           		
        </table></td>
      </tr>
      
    </table>
    </td>
  </tr>
</table>