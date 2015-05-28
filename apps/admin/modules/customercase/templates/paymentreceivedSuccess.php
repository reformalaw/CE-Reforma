<!-- Bread Crumb Start -->

<table cellspacing="0" cellpadding="0" class="AdminNavBar">
  <tr>
    <td width="66%" class="drkgrylnk padlft"><a href="<?php echo url_for("default/index");?>" title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home")) ?></a></td>
    <td width="34%" align="right" class="AdminBreadCrumb"><table cellpadding="8" cellspacing="0" align="right">
        <tr align="center">
          <!--<td width="57" class="LinkImg" ><a href="#" title="Edit"><?php image_tag("admin/Icon_Save.gif", array("alt"=>"Save","title"=>"Save","border"=>"0")) ?><br />
      Save </a></td>-->
          <td width="57" class="LinkImg" ><a href="<?php echo url_for('customercase/index') ?>"><?php echo image_tag("admin/Icon_Cancel.gif", array("alt"=>"Cancel","title"=>"Cancel","border"=>"0")) ?><br />
            Cancel </a></td>
        </tr>
      </table></td>
  </tr>
</table>
<!-- Bread Crumb End -->
<table width="98%" cellspacing="0" cellpadding="0" align="center">
  <?php include_component('customercase', 'profile');?>
  <?php include_partial('default/message'); ?>
  <tr>
    <td align="left" valign="top"><table width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <?php include_partial('verticalheader',array('caseObj' => $case)) ?>
          <td align="center" valign="top" class="CashDetails" style="padding:10px 0px"><table width="98%" cellspacing="10" cellpadding="0">
              <tr>
                <td align="left" valign="top" class="WebsiteDetails" style="padding:10px;"><table width="100%" cellspacing="8" cellpadding="0">
                    <tr>
                      <td align="left" valign="top" width="100%"><fieldset>
                        <legend>Payment Details</legend>
                        <table width="100%" cellspacing="10" cellpadding="0">
                        <tr class="ContentTable">
							<td align="center"><strong> Actual Amount</strong></td>
							<!--<td align="center"><strong> Commission( <?php //echo $case->getCommisionPercentage(); ?>% )</strong></td>
							<td align="center"><strong> Processing Fees</strong></td>-->
							<td align="center"><strong> Receivable Amount</strong></td>
							<td align="center"><strong> UnderPay Adjustments</strong></td>
							<td align="center"><strong> Payments Disbursed</strong></td>
							<td align="center"><strong> Remain To Receive</strong></td>
							<?php if($case->getPaidAmount() > $case->getPayableAmount()) { ?>
							 <td align="center"><strong> Overpaid Amount</strong></td>
							<?php } ?>
                        </tr>
                        <tr class="ContentTable">
							<td align="center"><?php echo sfConfig::get('app_currency').round($case->getActualAmount(),2); ?> </td>
							<!--<td align="center"><?php //echo sfConfig::get('app_currency').$case->getCommisionActual(); ?></td>
							<td align="center"><?php //echo sfConfig::get('app_currency').$case->getProcessingFees(); ?></td>-->
							<td align="center"><?php echo sfConfig::get('app_currency').round($case->getPayableAmount(),2); ?></td>
							<td align="center">
								<?php 
								if($case->getUnderpayAdjustment() != '')
								echo sfConfig::get('app_currency').round($case->getUnderpayAdjustment(),2);
								else
								echo sfConfig::get('app_currency').'0'    ;
								?>
							</td>
							<td align="center">
								<?php 	
								if($case->getPaidAmount() != '')
								echo sfConfig::get('app_currency').round($case->getPaidAmount(),2);
								else
								echo sfConfig::get('app_currency').'0';
								?>
							</td>
							
						  <td align="center"><?php  
						  if( ( $case->getPaidAmount() + $case->getUnderpayAdjustment())  > $case->getPayableAmount()) {
                               echo sfConfig::get('app_currency').'0'  ;
						  } else {
						      echo sfConfig::get('app_currency').round(($case->getPayableAmount() -  $case->getUnderpayAdjustment() - $case->getPaidAmount()),2);
						  }?></td>
							
                          <?php if( ($case->getPaidAmount() + $case->getUnderpayAdjustment())  > $case->getPayableAmount()) { ?>
                                <td align="center"><?php echo sfConfig::get('app_currency').round(($case->getPaidAmount() - $case->getPayableAmount() ),2);?></td>
                          <?php } ?>
							
                        </tr>
                        </table>
                        </fieldset></td>
                    </tr>
					
					<tr>
                        	<td align="left" valign="top" height="10"></td>
                        </tr>
                    <tr>
                      <td align="left" valign="top"><table width="100%" cellspacing="1" cellpadding="1" class="CaseEditForm">
                          <?php if(count($case_payment) > 0){?>
                          <tr class="fldbg">
                            <td align="center" width="15%"><strong>Payments Disbursed</strong></td>
                            <td align="center" width="15%"><strong>UnderPay Adjustment</strong></td>
                            <td align="center" width="15%"><strong>Received Date</strong></td>
                            <td align="center" width="20%"><strong>Check No.</strong></td>
                            <td align="center" width="10%"><strong>Print Invoice</strong></td>
                          </tr>
                          <?php $i = 1;  ?>
                          <?php foreach ($case_payment as $casesData):?>
                          <tr>
                            <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($casesData->getPayableAmount(),2) ?></td>
                            <td class="fldrowbg" align="right" valign="top"><?php echo sfConfig::get('app_currency').round($casesData->getUnderpayAdjustment(),2) ?></td>
                            <td class="fldrowbg" align="center" valign="top"><?php echo date('Y-m-d',strtotime($casesData->getCustomerPaidDate())); ?></td>
                            <td class="fldrowbg" align="right" valign="top"><?php echo $casesData->getCheckNo() ?></td>
                            <td class="fldrowbg" align="center" valign="top"><?php echo link_to(image_tag("admin/print-cases-icon.png",array('title'=>'Click here to Print Invoice','alt'=>'Print Invoice','width'=> '24', 'height' =>'25')),"customercase/PaymentPrintinvoice?pId=".$casesData->getId().'&id='.$case->getId(),array('target'=>'_blank')); ?></td>
                          </tr>
                          <?php $i++ ; endforeach; ?>
                          <?php } else { ?>
                          <tr class="fldbg">
                            <td class="errormss">No items found.</td>
                          </tr>
                          <?php } ?>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="5" align="left" valign="top"></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
