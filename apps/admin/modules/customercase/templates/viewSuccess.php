<!-- Bread Crumb Start -->
<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="36%" class="drkgrylnk padlft"><a href="<?php echo url_for("default/index");?>" title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home")) ?></a></td>
  <td width="30%" class="drkgrylnk" align="center"><div class="Title">View Case Summary</div></td>
  <td width="34%" align="right" class="AdminBreadCrumb">
   <table cellpadding="8" cellspacing="0" align="right">
    <tr align="center">
     <!--<td width="57" class="LinkImg" ><a href="#" title="Edit"><?php image_tag("admin/Icon_Save.gif", array("alt"=>"Save","title"=>"Save","border"=>"0")) ?><br />
      Save </a></td>-->
     <td width="57" class="LinkImg" ><a href="<?php echo url_for('customercase/index') ?>"><?php echo image_tag("admin/Icon_Cancel.gif", array("alt"=>"Cancel","title"=>"Cancel","border"=>"0")) ?><br />
      Cancel </a></td>
    </tr>
   </table>
  </td>
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
            <td align="left" valign="top" class="WebsiteDetails" style="padding:10px;"><table width="99%" cellspacing="0" cellpadding="0">
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
                  <tr>
                    <td width="200" align="left" valign="middle"><strong>Agreement Date :</strong></td>
                    <td align="left" valign="middle">
		                <?php if ($case->getStage() != sfConfig::get('app_CaseStage_Submitted') ) { ?>
							<?php echo date('Y-m-d',strtotime($case->getAgreementDate()))?>
						<?php } else {  echo ' --- ';  ?>	
		                <?php } ?>
							</td>
							
							
                  </tr>

                <?php if ($case->getStage() != "") { ?>
                  <tr>
                    <td align="left" valign="middle"><strong>Case Stage :</strong></td>
                    <?php if($case->getStage() == sfConfig::get('app_CaseStage_Close')): ?>
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
                <td align="left" valign="top" style="padding:10px 0px;">
                	<fieldset>
                    	<legend>Payment Details</legend>
                        <table width="100%" cellspacing="1" cellpadding="5">
                        <?php if ($case->getActualAmount() != "") { ?>
                          <tr>
                            <td width="45%" align="left" valign="middle" class="BgColor">Actual Amount :</td>
                            <td align="left" valign="middle" class="BgColor"><?php echo sfConfig::get('app_currency').round($case->getActualAmount(),2); ?></td>
                          </tr>
                        <?php } ?>
                        <?php /*if ($case->getCommisionPercentage() != "") { ?>
                          <tr>
                            <td align="left" valign="middle" class="BgColor">Commission Percentage :</td>
                            <td align="left" valign="middle" class="BgColor"><?php echo $case->getCommisionPercentage(); ?>%</td>
                          </tr>
                        <?php } */ ?>
                        <?php /*if ($case->getCommisionActual() != "") { ?>
                          <tr>
                            <td align="left" valign="middle" class="BgColor">Actual Commission :</td>
                            <td align="left" valign="middle" class="BgColor"><?php echo sfConfig::get('app_currency').$case->getCommisionActual(); ?></td>
                          </tr>
                        <?php } */ ?>
                        <?php /*if ($case->getProcessingFees() != "") { ?>
                          <tr>
                            <td align="left" valign="middle" class="BgColor">Processing Fees :</td>
                            <td align="left" valign="middle" class="BgColor"><?php echo sfConfig::get('app_currency').$case->getProcessingFees(); ?></td>
                          </tr>
                        <?php }*/ ?>
                        <?php if ($case->getPayableAmount() != "") { ?>
                          <tr>
                            <td align="left" valign="middle" class="BgColor">Receivable Amount :</td>
                            <td align="left" valign="middle" class="BgColor"><?php echo sfConfig::get('app_currency').round($case->getPayableAmount(),2); ?></td>
                          </tr>
                        <?php } ?>
                        
                          <tr>
                            <td align="left" valign="middle" class="BgColor">Under Payment Adjustments :</td>
                            <td align="left" valign="middle" class="BgColor">
							<?php if ($case->getUnderpayAdjustment() != "")
									echo sfConfig::get('app_currency').round($case->getUnderpayAdjustment(),2); 
								  else 
								  	echo sfConfig::get('app_currency').'0';			
							?></td>
                          </tr>
                        
                        <?php #if ($case->getPaidAmount() != "") { ?>
                          <tr>
                            <td align="left" valign="middle" class="BgColor">Payments Disbursed :</td>   <!--Received Amount-->
                            <td align="left" valign="middle" class="BgColor">
								<?php if ($case->getPaidAmount() != "")
								 		echo sfConfig::get('app_currency').round($case->getPaidAmount(),2); 
									  else
									  	echo sfConfig::get('app_currency').'0'; 	
								 ?>
							</td>
                          </tr>
                        <?php #} ?>

                          <tr>
                            <td align="left" valign="middle" class="BgColor">Remain To Receive :</td>
                            <td align="left" valign="middle" class="BgColor" style="color:red;">
								<?php if(in_array($case->getStage(),array( sfConfig::get('app_CaseStage_Submitted'),sfConfig::get('app_CaseStage_Accepted')))) 
								{
									echo sfConfig::get('app_currency').round($case->getPayableAmount(),2);
								} else {
									#echo sfConfig::get('app_currency').$case->getRemainToPay();
									if( ($case->getPaidAmount() + $case->getUnderpayAdjustment() ) > $case->getPayableAmount()) {
								        echo sfConfig::get('app_currency').'0';
								    } else {
								        echo sfConfig::get('app_currency');
								        if($case->getRemainToPay() != '')  { echo  round($case->getRemainToPay(),2);} 
								        else { echo round($case->getPayableAmount() -( $case->getPaidAmount() + $case->getUnderpayAdjustment() ),2);} 
								    }
								}	
									 ?></td>
                          </tr>
                          
                          <?php if( ($case->getPaidAmount() + $case->getUnderpayAdjustment() )> $case->getPayableAmount()) { ?>
                             <tr >
                                <td align="left" valign="middle" class="BgColor">Overpaid Amount :</td>
                                <td align="left" valign="middle" class="BgColor"><?php echo sfConfig::get('app_currency').($case->getPaidAmount() - $case->getPayableAmount() );?></td>
                             </tr>
                          <?php } ?>
                          

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
                                        echo image_tag("admin/submited-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Case Submitted",'width'=>'30px','height'=>'30px')); ?>
                                        <p>Submitted</p>
                                    <?php } else{ ?>
                                        <?php echo image_tag("admin/accepted-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Case Accepted",'width'=>'30px','height'=>'30px'))?>
                                        <p>Accepted</p>
                                    <?php }?>
                                </td>
                                <td width="10%" align="center" valign="top">
                                    <?php echo link_to(image_tag("admin/document-cases-icon.png", array('border'=>'1','title'=>'Click here to Manage Case Documents','alt'=>'Manage Case Documents','width'=>'30px','height'=>'30px')),"casedocuments/index?caseId=".$case->getId()."&bFlag=1&id=".$case->getId());?>
                                    <?php echo link_to("<p>Documents</p>","casedocuments/index?caseId=".$case->getId()."&bFlag=1&id=".$case->getId(),array('title'=>'Click here to Manage Case Documents'));     ?>									
									
                                </td>
                                <td width="10%" align="center" valign="top">
                                    <?php 
                                        if ($case->getStage() == sfConfig::get('app_CaseStage_Submitted')) { 
                                            echo link_to(image_tag("admin/edit-cases-icon.png", array('border'=>'1','alt'=>'Click here to Edit Case','title'=>"Click here to Edit Case",'width'=>'30px','height'=>'30px')),'customercase/edit?id='.$case->getId().'&bFlag=1');
                                            echo link_to("<p>Edit</p>",'customercase/edit?id='.$case->getId().'&bFlag=1', array('title' =>'Click here to Edit Case' )); 
                                        }else { ?>
                                            <a href= "javascript:void(0)" onclick="alert('This feature will not be available as the case is accepted by Counsel Edge'); return false;"><?php echo image_tag("admin/edit-cases-icon.png", array('border'=>'1','alt'=>'Click here to Edit Case','title'=>"Click here to Edit Case",'width'=>'30px','height'=>'30px'));?></a>
                                            <a href= "javascript:void(0)" onclick="alert('This feature will not be available as the case is accepted by Counsel Edge'); return false;" title="Click here to Edit Case" ><p>Edit</p></a>
                                    <?php } ?>
                                </td>
								
								
                                <td width="10%" align="center" valign="top">
                                    <?php 
                                        if ($case->getStage() == sfConfig::get('app_CaseStage_Submitted')) { 
                                            echo link_to(image_tag("admin/delete-cases-icon.png", array('border'=>'1','alt'=>'Click here to Delete Case','title'=>"Click here to Delete Case",'width'=>'30px','height'=>'30px','OnClick'=>"return deleteConfirmation();")),'customercase/changeStatus?status=Deleted&id='.$case->getId());
                                            echo link_to("<p>Delete</p>",'customercase/changeStatus?status=Deleted&id='.$case->getId(),array('OnClick'=>"return deleteConfirmation();",'title'=>"Click here to Delete Case")); 
                                        }else { ?>
                                            <a href= "javascript:void(0)" onclick="alert('This feature will not be available as the case is accepted by Counsel Edge'); return false;"><?php echo image_tag("admin/delete-cases-icon.png", array('border'=>'1','alt'=>'Click here to Delete Case','title'=>"Click here to Delete Case",'width'=>'30px','height'=>'30px'));?></a>
                                            <a href= "javascript:void(0)" onclick="alert('This feature will not be available as the case is accepted by Counsel Edge'); return false;"  title="Click here to Delete Case"><p>Delete</p></a>
                                        <?php } ?>
                                </td>
                                
								<?php if($case->getStage() == sfConfig::get('app_CaseStage_Close')) {  ?>
                                <td width="10%" align="center" valign="top">
                                
                                    <?php  echo image_tag("admin/blank-img.png", array('border'=>'1','alt'=>'Case Closed','title'=>"Case Closed",'width'=>'30px','height'=>'30px'))?>
                                        <p>Closed</p>

                                 </td>
                                 <?php } ?>										 

                                <td width="12%" align="center" valign="top">
                                <?php 
                                    if ($case->getStage() != sfConfig::get('app_CaseStage_Submitted')){
                                        echo link_to(image_tag("admin/recieve-payment-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Click here to View Received Payment",'width'=>'30px','height'=>'30px')),'customercase/paymentreceived?id='.$case->getId());
                                        echo link_to("<p>Received Payment</p>",'customercase/paymentreceived?id='.$case->getId(),array('title' => 'Click here to View Received Payment')); 
                                    }else {?>
                                        <a href="javascript:void(0)" onclick="alert('This feature will be available once Counsel Edge accepts your case.'); return false;"><?php echo image_tag("admin/recieve-payment-cases-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Click here to View Received Payment",'width'=>'30px','height'=>'30px')); ?></a>
                                        <a href="javascript:void(0)" onclick="alert('This feature will be available once Counsel Edge accepts your case.'); return false;" title="Click here to View Received Payment"><p>Received Payment</p></a>
                                <?php } ?>
                                </td>
                            </tr>
                        </table>
                </fieldset>
            </td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>