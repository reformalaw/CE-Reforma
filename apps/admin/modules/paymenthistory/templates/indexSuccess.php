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
                    <td width="140" align="center" valign="middle" class="SelectTab"><?php echo link_to("Customer Payments",'paymenthistory/index?caseId='.$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId')); ?></td>
                    <td width="2" align="center" valign="middle" class="BorderBottom"></td>
                    <td width="130" align="center" valign="middle" class="DeSelectTab"><?php echo link_to("3rd Party Payments",'paymentreceived/index?caseId='.$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId')); ?></td>
                    <td class="BorderBottom">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td align="center" valign="top" class="WebsiteDetails">
                	<table width="98%" cellspacing="0" cellpadding="0">
                    	<tr>
                <td align="center" valign="top">
                	<table width="98%" cellspacing="1" cellpadding="1">
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
                                        <td width="145"><strong> Actual Amount : </strong></td>
                                        <td><?php echo sfConfig::get('app_currency').round($caseObj->getActualAmount(),2); ?> </td>
                                      </tr>
                                      <tr class="ContentTable">
                                        <td><strong> Commission( <?php echo $caseObj->getCommisionPercentage(); ?>% ) :  </strong></td>
                                        <td><?php echo sfConfig::get('app_currency').round($caseObj->getCommisionActual(),2); ?></td>
                                      </tr>
                                      <tr class="ContentTable">
                                        <td><strong> Processing Fees :  </strong></td>
                                        <td><?php echo sfConfig::get('app_currency').$caseObj->getProcessingFees(); ?></td>
                                      </tr>
                                      <tr class="ContentTable">
                                        <td><strong> Payable Amount :</strong></td>
                                        <td><?php if($caseObj->getPayableAmount() != '')
                                        echo sfConfig::get('app_currency').round($caseObj->getPayableAmount(),2);
                                        else
                 echo ' --- '    ;?> </td>
                                      </tr>
                                      <tr class="ContentTable">
                                        <td><strong> UnderPay Adjustments :</strong></td>
                                        <td><?php 
                                        if($caseObj->getUnderpayAdjustment() != '')
                                        echo sfConfig::get('app_currency').$caseObj->getUnderpayAdjustment();
                                        else
                                        echo sfConfig::get('app_currency').'0'    ;
                    ?></td>
                                      </tr>
                                      <tr class="ContentTable">
                                        <td><strong> Paid Amount :</strong></td>
                                        <td><?php if($caseObj->getPaidAmount() != '')
                                        echo sfConfig::get('app_currency').round($caseObj->getPaidAmount(),2);
                                        else
                 echo sfConfig::get('app_currency').'0'     ;?></td>
                                      </tr>
                                      <tr class="ContentTable">
                                        <td><strong> Remain To Pay :</strong></td>
                                        <td><?php if($caseObj->getPaidAmount() > $caseObj->getPayableAmount()) 
                                            echo sfConfig::get('app_currency').'0';
                                        else 
                                            echo sfConfig::get('app_currency').round((($caseObj->getPayableAmount() -  $caseObj->getUnderpayAdjustment() - $caseObj->getPaidAmount())),2);
                                        /*if($caseObj->getRemainToPay() != '')
                                        echo sfConfig::get('app_currency').$caseObj->getRemainToPay();
                                        else
                 echo sfConfig::get('app_currency').$caseObj->getPayableAmount() ; */?></td>
                                      </tr>
                                      
                                      <?php if($caseObj->getPaidAmount() > $caseObj->getPayableAmount()) { ?>
                                         <tr class="ContentTable">
                                            <td><strong> Overpaid Amount :</strong></td>
                                            <td><?php echo sfConfig::get('app_currency').round(($caseObj->getPaidAmount() - $caseObj->getPayableAmount() ),2);?></td>
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
                        <td align="left" valign="middle"><strong>Log Payment</strong></td>
                      </tr>
                  </table>                            
                    </td>
                </tr>
              <tr>
                <td align="left" valign="top">
			 	<table width="100%" cellspacing="1" cellpadding="1">
                	<tr><td height="10"></td></tr>
			 	    <?php if($form->getObject()->isNew()) { ?>
                	   <?php include_partial('form', array('form' => $form,'underPayAmt' => $underPayAmt, 'caseId' => $caseId, 'customerId' => $customerId)) ;?>
                	<?php } else {  ?>
                	   <?php include_partial('editform', array('form' => $form,'underPayAmt' => $underPayAmt, 'caseId' => $caseId, 'customerId' => $customerId)) ;?>
                	<?php } ?>   
                </table>
                </td>
              </tr>
        </table></td>
        
        <?php } ?>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" cellspacing="1" cellpadding="1" class="CaseEditForm">
            <?php if($pager->getnbResults() > 0){?>
             <tr class="fldbg">
                            <td align="center" width="5%"><strong>No.</strong></td>
                            <td align="center" width="10%"><strong>Actual Amount</strong></td>
                            <td align="center" width="15%"><strong>UnderPay Adjustment</strong></td>
                            <td align="center" width="10%"><strong>Paid Amount</strong></td>
                            <td align="center" width="10%"><strong>Paid Date</strong></td>
                            <td align="center" width="10%"><strong>Check No.</strong></td>
                            <td align="center" width="25%"><strong>Memo</strong></td>
                            <td width="15%" align="center" ><strong>Action</strong></strong></td>
             </tr>              
               <?php $i = 1;  ?>
               <?php foreach ($pager->getResults() as $customer_payment_sent):?>
             <tr>
                            
                            <td align="center" class="fldrowbg" valign="top"><?php echo  (($pager->getPage() * sfConfig::get('app_no_of_records_per_page')  ) - sfConfig::get('app_no_of_records_per_page') ) + $i ;?></td>
                            <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($customer_payment_sent->getActualAmount(),2) ?></td>
                            <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($customer_payment_sent->getUnderpayAdjustment(),2) ?></td>
                            <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($customer_payment_sent->getPayableAmount(),2) ?></td>
                            
                            <td class="fldrowbg" align="center" valign="top"><?php echo date('Y-m-d',strtotime($customer_payment_sent->getCustomerPaidDate())); ?></td>
                            <td class="fldrowbg" align="left" valign="top"><?php echo $customer_payment_sent->getCheckNo() ?></td>
                            <?php if($customer_payment_sent->getDescription() != ""): ?>
								<td class="fldrowbg" align="left" valign="top"><?php echo nl2br($customer_payment_sent->getDescription()) ?></td>
							<?php else:?>
								<td class="fldrowbg" align="center" valign="top">---</td>
							<?php endif; ?>
							
                            <td class="fldrowbg" align="center">
                                <?php echo link_to(image_tag("admin/print-cases-icon.png",array('title'=>'Click here to Print Invoice','alt'=>'Print Invoice','width'=> '24','height' => '25')),"paymenthistory/printinvoice?id=".$customer_payment_sent->getId()."&customerId=".$customerId."&caseId=".$caseId,array('target'=>'_blank')); ?>&nbsp;
                                <?php if($caseObj->getStage() != sfConfig::get('app_CaseStage_Close')) { ?>
                                    <a href="<?php echo url_for('paymenthistory/edit?id='.$customer_payment_sent->getId()."&customerId=".$customerId."&caseId=".$caseId) ?>"><?php echo image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=> '24','height' => '25'))?></a> &nbsp;
                                    <a href="<?php echo url_for('paymenthistory/delete?id='.$customer_payment_sent->getId()."&customerId=".$customerId."&caseId=".$caseId)?>"><?php echo image_tag('admin/delete-cases-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();",'width'=> '24','height' => '25'))?></a>
                                <?php } else { ?>                                
                                    <a href="#" style="cursor:none;"><?php echo image_tag("admin/blank-img.png",array('width'=>'24','height' => '25')) ; ?></a> 
                                    <a href="#" style="cursor:none;"><?php echo image_tag("admin/blank-img.png",array('width'=>'24','height' => '25')) ; ?></a>                                           
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
               <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'paymenthistory/index', 'varExtra' => $varExtra));?></td>
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