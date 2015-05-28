<table width="98%" cellspacing="0" cellpadding="0" align="center">
  <?php include_component('dashboardcase', 'profile');?>
  <?php include_partial('default/message'); ?>
  <tr>
    <td align="left" valign="top"><table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <?php include_partial('verticalheader',array('caseObj' => $case)) ?>
        
        <td align="center" valign="top" class="CashDetails"><table width="98%" cellspacing="10" cellpadding="0">
          <tr><td height="5"></td></tr>
          <tr>
            <td align="center" valign="top" class="WebsiteDetails" style="padding:20px 0px;"><table width="98%" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" width="60%"><table width="100%" cellspacing="8" cellpadding="0">
                <tr>
                <td width="200" align="left" valign="middle"><strong>Case Title :</strong></td>
                <td align="left" valign="middle"><?php echo ucwords($case->getFirstTitle()." ".$case->getLastTitle());?></td>
              </tr>
              <?php if ($case->getDescription() != ""){ ?>
              <tr>
                <td align="left" valign="top"><strong>Case Description :</strong></td>
                <td align="left" valign="middle"><?php echo nl2br($case->getDescription()); ?></td>
              </tr>
              <?php } ?>
                <?php if ($case->getAgreementDate() != "") { ?>
                  <tr>
                    <td width="200" align="left" valign="middle"><strong>Agreement Date :</strong></td>
                    <td align="left" valign="middle">
                        <?php   if($case->getStage() != sfConfig::get('app_CaseStage_Submitted'))
                        echo date(sfConfig::get('app_dateformat'),strtotime($case->getAgreementDate()));
                        else
                        echo '---';

                                    ?>
                     </td>
                  </tr>
                <?php } ?>
                <?php /*if ($case->getCustomerPaidDate() != "") { ?>
                                    <tr>
                                    <td align="left" valign="middle"><strong>Customer Paid Date :</strong></td>
                                    <td align="left" valign="middle"><?php echo date('Y-m-d',strtotime($case->getCustomerPaidDate()))?></td>
                                    </tr>
                                    <?php } ?>
                                    <?php if ($case->getPaymentReceivedDate() != "") { ?>
                                    <tr>
                                    <td align="left" valign="middle"><strong>3rd Party Payment Received Date :</strong></td>
                                    <td align="left" valign="middle"><?php echo date('d/m/Y',strtotime($case->getPaymentReceivedDate()))?></td>
                                    </tr>
                <?php } */ ?>
                <?php if ($case->getStage() != "") { ?>
                  <tr>
                    <td align="left" valign="middle"><strong>Case Stage :</strong></td>
                    <?php if($case->getStage() == sfConfig::get("app_CaseStage_Close")): ?>
						<td align="left" valign="middle"><?php echo "Closed"; ?></td>
					<?php else: ?>
						<td align="left" valign="middle"><?php echo $case->getStage(); ?></td>
					<?php endif; ?>
                  </tr>
                <?php } ?>
                <?php if ($case->getStatus() != "") { ?>
                  <tr>
                    <td align="left" valign="middle"><strong>Case Status :</strong></td>
                    <td align="left" valign="middle"><?php echo $case->getStatus(); ?></td>
                  </tr>
                <?php } ?>
                <?php if ($case->getCreateDateTime() != "") { ?>
                  <tr>
                    <td align="left" valign="middle"><strong>Case Created Date :</strong></td>
                    <td align="left" valign="middle"><?php echo date('Y-m-d',strtotime($case->getCreateDateTime()))?></td>
                  </tr>
                <?php } ?>
                </table></td>
                <td align="left" valign="top" style="padding-right:10px;">
                	<fieldset>
                    	<legend>Payment Details</legend>
                        <table width="98%" cellspacing="1" cellpadding="5">
                        <?php if ($case->getActualAmount() != "") { ?>
                          <tr>
                            <td width="50%" align="left" valign="middle" class="BgColor">Actual Amount :</td>
                            <td align="left" valign="middle" class="BgColor">$<?php echo round($case->getActualAmount(),2); ?></td>
                          </tr>
                        <?php } ?>
                        <?php if ($case->getCommisionPercentage() != "") { ?>
                          <tr>
                            <td align="left" valign="middle" class="BgColor">Commission Percentage :</td>
                            <td align="left" valign="middle" class="BgColor"><?php echo $case->getCommisionPercentage(); ?>%</td>
                          </tr>
                        <?php } ?>
                        <?php if ($case->getCommisionActual() != "") { ?>
                          <tr>
                            <td align="left" valign="middle" class="BgColor">Actual Commission :</td>
                            <td align="left" valign="middle" class="BgColor"><?php echo sfConfig::get('app_currency').round($case->getCommisionActual(),2); ?></td>
                          </tr>
                        <?php } ?>
                        <?php if ($case->getProcessingFees() != "") { ?>
                          <tr>
                            <td align="left" valign="middle" class="BgColor">Processing Fees :</td>
                            <td align="left" valign="middle" class="BgColor"><?php echo sfConfig::get('app_currency').$case->getProcessingFees(); ?></td>
                          </tr>
                        <?php } ?>
                        <?php if ($case->getPayableAmount() != "") { ?>
                          <tr>
                            <td align="left" valign="middle" class="BgColor">Payable Amount To Customer :</td>
                            <td align="left" valign="middle" class="BgColor"><?php echo sfConfig::get('app_currency').round($case->getPayableAmount(),2); ?></td>
                          </tr>
                        <?php } ?>
                       
                          <tr>
                            <td align="left" valign="middle" class="BgColor">Under Payment Adjustments :</td>
                            <td align="left" valign="middle" class="BgColor">
                             <?php if ($case->getUnderpayAdjustment() != "") { ?>    
                                <?php echo sfConfig::get('app_currency').round($case->getUnderpayAdjustment(),2); ?>
                             <?php } else { ?>   
                                <?php echo sfConfig::get('app_currency').'0';?>
                             <?php }?>
                             
                                </td>
                          </tr>

                        
                          <tr>
                            <td align="left" valign="middle" class="BgColor">Paid Amount :</td>
                            <td align="left" valign="middle" class="BgColor">
                               <?php if ($case->getPaidAmount() != "")
                               echo sfConfig::get('app_currency').round($case->getPaidAmount(),2);
                               else
                               echo sfConfig::get('app_currency').'0';
								 ?>                            
                            </td>
                          </tr>
                        
                        
                          <tr>
                            <td align="left" valign="middle" class="BgColor">Remain To Pay Amount :</td>
                            <td align="left" valign="middle" class="BgColor" style="color:red;">
								<?php if(in_array($case->getStage(),array( sfConfig::get('app_CaseStage_Submitted'),sfConfig::get('app_CaseStage_Accepted')))) 
								{
								    echo sfConfig::get('app_currency').round($case->getPayableAmount(),2);
								} else {
								    if($case->getPaidAmount() > $case->getPayableAmount()) {
								        echo sfConfig::get('app_currency').'0';
								    } else {
								        echo sfConfig::get('app_currency');
								        if($case->getRemainToPay() != '')  { echo  round($case->getRemainToPay(),2);}
								        else { echo '0';}
								    }

								}
							 ?>                            
                            </td>
                          </tr>
                          
                          <?php if($case->getPaidAmount() > $case->getPayableAmount()) { ?>
                             <tr >
                                <td align="left" valign="middle" class="BgColor">Overpaid Amount :</td>
                                <td align="left" valign="middle" class="BgColor"><?php echo sfConfig::get('app_currency').round(($case->getPaidAmount() - $case->getPayableAmount()),2);?></td>
                             </tr>
                          
                          <?php } ?>
                          
                        
                          <tr>
                            <td align="left" valign="middle" class="BgColor">Received Amount From 3rd Party :</td>
                            <td align="left" valign="middle" class="BgColor"><?php if ($case->getReceivedAmount() != "") { echo sfConfig::get('app_currency').round($case->getReceivedAmount(),2); }else{ echo sfConfig::get('app_currency').'0'; } ?></td>
                          </tr>

                          <tr>
                            <td align="left" valign="middle" class="BgColor">Remain To Receive :</td>
                            <td align="left" valign="middle" class="BgColor" style="color:red;">
                                <?php #if ($case->getRemainToReceive() != "") { echo sfConfig::get('app_currency').$case->getRemainToReceive(); }else{ echo sfConfig::get('app_currency').$case->getPayableAmount(); } ?>
                                <?php if($case->getReceivedAmount() > $case->getActualAmount() ) { ?>
                                      <?php  echo sfConfig::get('app_currency').'0'; ?>  
                                <?php } else { ?>
                                        <?php if ($case->getRemainToReceive() != "") { 
                                            echo sfConfig::get('app_currency').round($case->getRemainToReceive(),2);
                                        }else{
                                            echo sfConfig::get('app_currency').round(($case->getActualAmount() -  $case->getReceivedAmount()),2);
                                         } ?>
                                
                                 <?php } ?>
                                
                             </td>
                          </tr>
                          
                          <?php if($case->getReceivedAmount() > $case->getActualAmount() ) { ?>
                          <tr>
                            <td align="left" valign="middle" class="BgColor">3rd Party Overpaid :</td>
                            <td align="left" valign="middle" class="BgColor"><?php echo sfConfig::get('app_currency').round(($case->getReceivedAmount() - $case->getActualAmount()),2);  ?></td>
                          </tr>
                          <?php } ?>
                          
                          <!-- Start diffrence display only when case is close -->
                          <?php if($case->getStage() == sfConfig::get("app_CaseStage_Close")): ?> 
                          <tr>
                            <td align="left" valign="middle">Difference Amount :</td>
                            <td align="left" valign="middle">
                             <?php  if ($case->getDifferenceAmount() != "") { 
                                 echo sfConfig::get('app_currency').round($case->getDifferenceAmount(),2);
                             } else {
                                 echo sfConfig::get('app_currency').'0';
                             }
                             ?></td>
                          </tr>
						<?php endif; ?>
						<!-- End diffrence display only when case is close -->
                        </table>
                    </fieldset>
                </td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="5" align="left" valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="top">
            	<fieldset>
                    <legend>Action</legend>
                        <table width="100%" cellspacing="5" cellpadding="0">
                            <tr>
                                <td width="10%" align="center" valign="top">
                                    <?php 
                                    if($case->getStage() == sfConfig::get('app_CaseStage_Submitted')) {
                                        echo link_to(image_tag("admin/submited-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Click to accept case",'width'=>'30px','height'=>'30px')),"dashboardcase/changestage?stage=Accepted&caseId=".$case->getId().'&customerId='.$sf_params->get('customerId').'&from=caseDetail');
                                        echo link_to("<p>Accept?</p>","dashboardcase/changestage?stage=Accepted&caseId=".$case->getId().'&customerId='.$sf_params->get('customerId').'&from=caseDetail',array('title'=>'Click to accept case'));
                                    } else{ ?>
                                        <?php echo image_tag("admin/accepted-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Accepted",'width'=>'30px','height'=>'30px'))?>
                                        <p>Accepted</p>
                                    <?php }?>
                                </td>
                                <td width="10%" align="center" valign="top">
                                    <?php echo link_to(image_tag("admin/document-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Documents",'width'=>'30px','height'=>'30px')),"dashboardcase/caseDocumentList?caseId=".$sf_params->get("caseId")."&customerId=".$sf_params->get("customerId"));?>
                                    <?php echo link_to("<p>Documents</p>","dashboardcase/caseDocumentList?caseId=".$sf_params->get("caseId")."&customerId=".$sf_params->get("customerId"),array('title'=>'Documents'));     ?>
                                </td>
                                <td width="10%" align="center" valign="top">
                                    <?php /*
                                    if($case->getStage() == sfConfig::get('app_CaseStage_Accepted') && $case->getThirdPartyBillsSubmitted() == 'No' ) {
                                    echo link_to(image_tag("admin/bill-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Bill To 3rd Party",'width'=>'30px','height'=>'30px')),"dashboardcase/submitbill?caseId=".$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&from=caseDetail');
                                    echo link_to("<p>Bill To 3rd Party</p>","dashboardcase/submitbill?caseId=".$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&from=caseDetail',array('title'=>'Bill To 3rd Party'));
                                    }else { ?>
                                    <?php echo image_tag("admin/blank-img.png", array('border'=>'1','alt'=>'Image','title'=>"Bill To 3rd Party",'width'=>'30px','height'=>'30px'))?>
                                    <p>Bill To 3rd Party</p>
                                    <?php } */?>
                                    
                                    
                                <?php if($case->getStage() == sfConfig::get('app_CaseStage_Submitted')){  ?>
                                        
                                        <a href="javascript:void(0)" onclick="alert('Please Accept Case to Submit Bill'); return false;"><?php echo image_tag("admin/bill-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Submit Bill To 3rd Party",'width'=>'30px','height'=>'30px')); ?></a>
                                        <a title="Submit Bill To 3rd Party" href="javascript:void(0)" onclick="alert('Please Accept Case to Submit Bill'); return false;"><p>Bill To 3rd Party</p></a>
                                        
                                <?php } else if(in_array($case->getStage(), array(sfConfig::get('app_CaseStage_Accepted'), sfConfig::get('app_CaseStage_Paid')) )) {?>
                                
                                        <?php if( $case->getThirdPartyBillsSubmitted() == 'No') { 
                                            echo link_to(image_tag("admin/bill-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Bill To 3rd Party",'width'=>'30px','height'=>'30px')),"dashboardcase/submitbill?caseId=".$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&from=caseDetail&stat=Yes');
                                            echo link_to("<p>Bill To 3rd Party</p>","dashboardcase/submitbill?caseId=".$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&from=caseDetail&stat=Yes',array('title'=>'Bill To 3rd Party'));
                                        } else {
                                            echo link_to(image_tag("admin/bill-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Reject Bill To 3rd Party",'width'=>'30px','height'=>'30px')),"dashboardcase/submitbill?caseId=".$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&from=caseDetail&stat=No');
                                            echo link_to("<p>Reject Bill To 3rd Party</p>","dashboardcase/submitbill?caseId=".$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&from=caseDetail&stat=No',array('title'=>'Reject Bill To 3rd Party'));
                                        }
                                            ?>
                                                                                    
                                <?php } else if($case->getStage() == sfConfig::get('app_CaseStage_Close')) {?>
                                        <a href="javascript:void(0)" onclick="alert('This feature will not be available as the case is closed'); return false;"><?php echo image_tag("admin/blank-img.png", array('border'=>'1','alt'=>'Image','title'=>"Submit Bill To 3rd Party",'width'=>'30px','height'=>'30px')); ?></a>
                                        <a title="Submit Bill To 3rd Party" href="javascript:void(0)" onclick="alert('This feature will not be available as the case is closed'); return false;"><p>Bill To 3rd Party</p></a>
                                
                                <?php } ?>
                                </td>
                                <td width="10%" align="center" valign="top">
                                    <?php 
                                    if ($case->getStage() != sfConfig::get('app_CaseStage_Close')) {
                                        echo link_to(image_tag("admin/edit-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Edit",'width'=>'30px','height'=>'30px')),'dashboardcase/edit?caseId='.$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&from=caseDetail');
                                        echo link_to("<p>Edit</p>",'dashboardcase/edit?caseId='.$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&from=caseDetail',array('title'=>'Edit'));
                                        }else { ?>
                                            <a href= "javascript:void(0)" onclick="alert('This feature will not be available as the case is closed'); return false;"><?php echo image_tag("admin/edit-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Edit",'width'=>'30px','height'=>'30px'));?></a>
                                            <a title="Edit" href= "javascript:void(0)" onclick="alert('This feature will not be available as the case is closed'); return false;"><p>Edit</p></a>
                                    <?php } ?>
                                </td>
                                
                                
                                <td width="10%" align="center" valign="top">
                                    <?php 
                                    if ($case->getStage() != sfConfig::get('app_CaseStage_Close')) {
                                        if($sf_user->hasCredential('admin')):
                                        /*when admin login physically delete the record */
                                        echo link_to(image_tag("admin/delete-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Delete",'width'=>'30px','height'=>'30px','OnClick'=>"return deletePhysicallyConfirmation();")),'case/permanentDeleteCase?id='.$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&flag=2');
                                        echo link_to("<p>Delete</p>",'case/permanentDeleteCase?id='.$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&flag=2',array('OnClick'=>"return deletePhysicallyConfirmation();",'title'=>'Delete'));
                                        else:
                                        echo link_to(image_tag("admin/delete-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Delete",'width'=>'30px','height'=>'30px','OnClick'=>"return deleteConfirmation();")),'dashboardcase/changeStatus?status=Deleted&caseId='.$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&from=caseDetail');
                                        echo link_to("<p>Delete</p>",'dashboardcase/changeStatus?status=Deleted&caseId='.$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&from=caseDetail',array('OnClick'=>"return deleteConfirmation();",'title'=>'Delete'));
                                        endif;
                                        }else { ?>
                                            <a href= "javascript:void(0)" onclick="alert('This feature will not be available as the case is closed'); return false;"><?php echo image_tag("admin/delete-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Delete",'width'=>'30px','height'=>'30px'));?></a>
                                            <a title="Delete" href= "javascript:void(0)" onclick="alert('This feature will not be available as the case is closed'); return false;"><p>Delete</p></a>
                                        <?php } ?>
                                </td>
                                
                                
                                
                                <td width="10%" align="center" valign="top">
                                <?php if ($case->getStage() != sfConfig::get('app_CaseStage_Close')) {
                                    if($case->getStatus() == sfConfig::get('app_CaseStatus_Active')) {
                                        echo link_to(image_tag("admin/active-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>'Click here to Inactive Case','width'=>'30px','height'=>'30px')),"dashboardcase/changeStatus?status=Inactive&caseId=".$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&from=caseDetail');
                                        echo link_to("<p>Active</p>","dashboardcase/changeStatus?status=Inactive&caseId=".$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&from=caseDetail',array('title'=> 'Click here to Inactive Case'));
                                    }else if ($case->getStatus()  == sfConfig::get('app_CaseStatus_Inactive')){
                                        echo link_to(image_tag("admin/inactive-icon.png", array('border'=>'1','alt'=>'Image','title'=>'Click here to activate this Case','width'=>'30px','height'=>'30px')),"dashboardcase/changeStatus?status=Active&caseId=".$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&from=caseDetail');
                                        echo link_to("<p>Inactive</p>","dashboardcase/changeStatus?status=Active&caseId=".$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&from=caseDetail',array('title'=>"Click here to activate this Case"));
                                    }else if ($case->getStatus() == ""){
                                        echo link_to(image_tag("admin/blank-img.png", array('border'=>'1','alt'=>'Image','title'=>'This Case is Pending. Click here to activate this Case','width'=>'30px','height'=>'30px')),"dashboardcase/changeStatus?status=Active&caseId=".$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&from=caseDetail');
                                        echo link_to("<p>Pending</p>","dashboardcase/changeStatus?status=Active&caseId=".$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&from=caseDetail',array('title'=>"This Case is Pending. Click here to activate this Case"));
                                    }
                                    }else{ ?>
                                        <a href= "javascript:void(0)" onclick="alert('This feature will not be available as the case is closed'); return false;"><?php echo image_tag("admin/active-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Click here to Inactive Case",'width'=>'30px','height'=>'30px'));?></a>
                                        <a title="Click here to Inactive Case" href= "javascript:void(0)" onclick="alert('This feature will not be available as the case is closed'); return false;"><p><?php echo $case->getStatus();?></p></a>
                                    <?php }?>    
                                </td>
                                
                                
                                <td width="10%" align="center" valign="top">
                                <?php 
                                if($case->getPaidAmount() ==  '' || $case->getReceivedAmount() ==  '' ) {

                                    #echo link_to(image_tag("admin/close-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Close Case",'width'=>'30px','height'=>'30px','OnClick'=>"return closeConfirmation();")),"dashboardcase/changestage?stage=Close&caseId=".$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&from=caseDetail');
                                    #echo link_to("<p>Close Case</p>","dashboardcase/changestage?stage=Close&caseId=".$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&from=caseDetail',array('title'=>'Close Case','OnClick'=>"return closeConfirmation();"));
                                    ?>
                                    <a href="javascript:void(0)" onclick="alert('You can not close this case as Payment not made/received'); return false;"><?php echo image_tag("admin/close-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Close Case",'width'=>'30px','height'=>'30px'));?></a>
                                    <a href="javascript:void(0)" onclick="alert('You can not close this case as Payment not made/received'); return false;"><p>Close Case</p></a>

                               <?php } else if($case->getStage() != sfConfig::get('app_CaseStage_Close')) {
                                   echo link_to(image_tag("admin/close-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Close Case",'width'=>'30px','height'=>'30px','OnClick'=>"return closeConfirmation();")),"dashboardcase/changestage?stage=Close&caseId=".$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&from=caseDetail');
                                   echo link_to("<p>Close Case</p>","dashboardcase/changestage?stage=Close&caseId=".$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&from=caseDetail',array('title'=>'Close Case','OnClick'=>"return closeConfirmation();"));
                               }else {
                                        echo image_tag("admin/blank-img.png", array('border'=>'1','alt'=>'Image','title'=>"Close Case",'width'=>'30px','height'=>'30px'))?>
                                        <p>Closed</p>
                                      <?php } ?>
                                    </td>
                                    
                                    
                                <td width="10%" align="center" valign="top">
                                <?php 
                                if ($case->getStage() != sfConfig::get('app_CaseStage_Submitted')){
                                    echo link_to(image_tag("admin/make-payment-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Payment History",'width'=>'30px','height'=>'30px')),'paymenthistory/index?caseId='.$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId'));
                                    echo link_to("<p>Make Payment</p>",'paymenthistory/index?caseId='.$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId'),array('title'=>'Payment History'));
                                    }else {?>
                                        <a href="javascript:void(0)" onclick="alert('Please Accept Case to view Payment History'); return false;"><?php echo image_tag("admin/make-payment-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Payment History",'width'=>'30px','height'=>'30px')); ?></a>
                                        <a title="Payment History" href="javascript:void(0)" onclick="alert('Please Accept Case to view Payment History'); return false;"><p>Payment History</p></a>
                                <?php } ?>
                                </td>

                                <td width="12%" align="center" valign="top">
                                <?php 
                                if ($case->getStage() != sfConfig::get('app_CaseStage_Submitted')){
                                    echo link_to(image_tag("admin/recieve-payment-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Received Payment",'width'=>'30px','height'=>'30px')),'paymentreceived/index?caseId='.$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId'));
                                    echo link_to("<p>Received Payment</p>",'paymentreceived/index?caseId='.$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId'),array('title'=>'Received Payment'));
                                    }else {?>
                                        <a href="javascript:void(0)" onclick="alert('Please Accept Case to view Payment History'); return false;"><?php echo image_tag("admin/recieve-payment-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Received Payment",'width'=>'30px','height'=>'30px')); ?></a>
                                        <a title="Received Payment" href="javascript:void(0)" onclick="alert('Please Accept Case to view Payment History'); return false;"><p>Received Payment</p></a>
                                <?php } ?>
                                </td>
                            </tr>
                        </table>
                </fieldset>
            </td>
          </tr>
          <tr>
            <td height="10" align="left" valign="top"></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php                     /*if($cases->getStatus() == sfConfig::get('app_CaseStatus_Active')) {
                                    echo link_to(image_tag("admin/active-cases-icon.png",array('title'=>'Click here to Inactive Case','alt'=>'Active','width'=>24)),"dashboardcase/changeStatus?status=Inactive&id=".$cases->getId().'&customerId='.$sf_params->get('customerId'));
}elseif($cases->getStatus()  == sfConfig::get('app_CaseStatus_Inactive')){
echo link_to(image_tag("admin/blank-img.png",array('title'=>'Click here to activate this Case','alt'=>'Inactive','width'=>24)),"dashboardcase/changeStatus?status=Active&id=".$cases->getId().'&customerId='.$sf_params->get('customerId'));
}elseif($cases->getStatus() == ""){
echo link_to(image_tag("admin/blank-img.png",array('title'=>'This Case\'s status is Pending. Click here to activate this Case','alt'=>'Panding','width'=>24)),"dashboardcase/changeStatus?status=Active&id=".$cases->getId().'&customerId='.$sf_params->get('customerId'));
}*/
