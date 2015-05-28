<?php include_partial('default/message'); ?>
<table width="98%" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="left" valign="top">
    	<table width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="top" width="50%" class="customerInfo">
           	  <table width="100%" cellspacing="5" cellpadding="0" class="border">
                  <tr>
                    <td align="left" valign="top" class=""><table cellspacing="1" cellpadding="0" width="100%">
				<tr>
					<td rowspan="5" align="left" valign="top" width="110" class="nopadding">
						<?php
							$imagePath = clsCommon::userProfileImage($oUserData->getId(), "large");
							echo image_tag($imagePath['path'], array('border'=>'1','alt'=>'Image','title'=>$imagePath['title'],'width'=>'100px','height'=>'100px'))
						?>
					</td>
					<td align="left" valign="top" class="usrrowbg rightborder" width="90">Name :</td>
					<td align="left" valign="top" class="usrrowbg"><?php echo ucwords($oUserData->getFirstName()." ".$oUserData->getLastName());?></td>
				</tr>
				<tr>
					<td align="left" valign="top" class="usrrowbg rightborder">Address :</td>
					<td align="left" valign="top" class="usrrowbg">
					<?php $address = $oUserData->getAddress1().", ";
                            if($oUserData->getAddress2() != '') 
                                $address  .=   $oUserData->getAddress2().', ';  
                            $address .=  $oUserData->getCity().", ".$oUserData->getUsersStates()->getName();   
                            if($oUserData->getZip() != '') 
                                $address  .= ", ".$oUserData->getZip();  
                            echo $address ;	?></td>
				</tr>
				<tr>
					<td align="left" valign="top" class="usrrowbg rightborder">Member Since :</td>
					<td align="left" valign="top" class="usrrowbg"><?php echo date(sfConfig::get('app_dateformat') ,strtotime($oUserData->getCreateDateTime()));?></td>
				</tr>
				<tr>
					<td align="left" valign="top" class="rightborder">Last Login:</td>
					<td align="left" valign="top"><?php echo date(sfConfig::get('app_dateformat') ,strtotime($oUserData->getLastLoginDateTime()));?></td>
				</tr>
				<tr>
					<td align="left" valign="top" colspan="2" class="iconbg"  style="padding:12px;">
						<table width="100%" cellspacing="0" cellpadding="0">
                          <tr>
							<td align="center" valign="middle" width="35">

								<?php 	if ($oUserData->getStatus() == sfConfig::get("app_UserStatus_Active")): ?>
									<?php echo link_to(image_tag("admin/active-icon-new.png", array('border'=>'1','alt'=>'Image','title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip'),'width'=>'20px','height'=>'20px')),'dashboard/ChangeUserStatus?status=Inactive&id='.$oUserData->getId().'&customerId='.$oUserData->getId());?>
									<p>
										<?php echo link_to("Active", 'dashboard/ChangeUserStatus?status=Inactive&id='.$oUserData->getId().'&customerId='.$oUserData->getId(), array('title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip')));?>
									</p>
								<?php 	elseif($oUserData->getStatus()== sfConfig::get("app_UserStatus_Pending")):?>
									<?php echo link_to(image_tag("admin/pending-icon.png",array('title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'),'alt'=>'Pending','width'=>'20px','height'=>'20px')),'users/pendingToActive?id='.$oUserData->getId().'&customerId='.$oUserData->getId().'&flag=true');?>
									<p>
										<?php echo link_to("Pending", 'users/pendingToActive?id='.$oUserData->getId().'&customerId='.$oUserData->getId().'&flag=true', array('title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip')));?>
									</p>
									
									<?php //echo image_tag("admin/pending-icon.png",array('title'=>'This user\'s status is Pending.','alt'=>'Pending','width'=>'20px','height'=>'20px')); ?>
									<!--<p>
										Pending
									</p>-->
								<?php 	else: ?>
									<?php echo link_to(image_tag('admin/inactive-icon.png',array('border'=>'1','alt'=>'Image','width'=>'20px','height'=>'20px','title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'))), 'dashboard/ChangeUserStatus?status=Active&id='.$oUserData->getId().'&customerId='.$oUserData->getId());?>
									<p>
										<?php echo link_to("Inactive", 'dashboard/ChangeUserStatus?status=Active&id='.$oUserData->getId().'&customerId='.$oUserData->getId(),array('title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip')));?>
									</p>
								<?php 	endif; ?>
							</td>

                            <td align="center" valign="middle" width="35">
								<?php echo link_to(image_tag("admin/edit-icon-new.png", array('border'=>'1','alt'=>'Image','title'=>"Click here to edit",'width'=>'20px','height'=>'20px')), 'dashboard/edit?id='.$oUserData->getId().'&customerId='.$oUserData->getId()); ?>
								<p>
									<?php echo link_to("Edit", 'dashboard/edit?id='.$oUserData->getId().'&customerId='.$oUserData->getId(),array('title'=>"Click here to edit")); ?>
								</p>
							</td>
							<td align="center" valign="middle" width="35">
								<?php echo link_to(image_tag("admin/delete-icon-new.png", array('border'=>'1','alt'=>'Image','title'=>"Click here to delete",'width'=>'20px','height'=>'20px',"onClick"=>"return deleteConfirmation();")), 'users/Delete?id='.$oUserData->getId().'&customerId='.$oUserData->getId());?>
								<p>
									<?php echo link_to("Delete",'users/Delete?id='.$oUserData->getId().'&customerId='.$oUserData->getId(),array("onClick"=>"return deleteConfirmation();",'title'=>'Click here to delete'));?>
								</p>
							</td>
                            <td align="center" valign="middle">&nbsp;</td>
                          </tr>
                        </table>
                     </td>
				</tr>
			</table></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">
                    	<!--Start Subscriptions table-->
						<table cellspacing="1" cellpadding="0" width="100%" class="subscription">
				<tr>
					<td class="heading" align="center" valign="middle" width="100"><strong>Subscriptions:</strong></td>
                    <td width="75" align="center" class="iconbg">
						<?php
							if($oUserData->getBillingSubscription()=="Yes"){ 
								echo image_tag("admin/billing-services-icon.png", array('border'=>'1','alt'=>'Image','width'=>'24px','height'=>'24px'));
								//echo link_to(image_tag("admin/billing-services-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Click here to inactive",'width'=>'24px','height'=>'24px')),"dashboard/ChangeSubscriptionStatus?tempval=billing&status=No&id=".$oUserData->getId().'&customerId='.$oUserData->getId());
								}
							else{
								echo image_tag("admin/billing-services-icon.png", array('border'=>'1','alt'=>'Image','width'=>'24px','height'=>'24px'));
								//echo link_to(image_tag("admin/billing-services-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Click here to active",'width'=>'24px','height'=>'24px')),"dashboard/ChangeSubscriptionStatus?tempval=billing&status=Yes&id=".$oUserData->getId().'&customerId='.$oUserData->getId());
							}
						?>
						<p>Billing Service</p>
						<p><?php
						if($oUserData->getBillingSubscription()=="Yes"){
							echo "Yes";
							//echo link_to(sfConfig::get("app_UserStatus_Active"), "dashboard/ChangeSubscriptionStatus?tempval=billing&status=No&id=".$oUserData->getId().'&customerId='.$oUserData->getId(),array("title"=>"Click here to inactive"));
							
						}else{ //elseif($oUserData->getBillingSubscription()=="No")
							echo "No";
							//echo link_to(sfConfig::get("app_UserStatus_Inactive"), "dashboard/ChangeSubscriptionStatus?tempval=billing&status=Yes&id=".$oUserData->getId().'&customerId='.$oUserData->getId(),array("title"=>"Click here to active"));
						}?></p>					</td>
					<td width="75" align="center" class="iconbg">
						<?php 
							if($oUserData->getWebsiteSubscriotion()=="Yes"){
								echo image_tag("admin/website-icon.png", array('border'=>'1','alt'=>'Image','width'=>'24px','height'=>'24px'));
								//echo link_to(image_tag("admin/website-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Click here to inactive",'width'=>'24px','height'=>'24px')), "dashboard/ChangeSubscriptionStatus?tempval=website&status=No&id=".$oUserData->getId().'&customerId='.$oUserData->getId());
								}
							else{
								echo image_tag("admin/website-icon.png", array('border'=>'1','alt'=>'Image','width'=>'24px','height'=>'24px'));
								//echo link_to(image_tag("admin/website-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Click here to active",'width'=>'24px','height'=>'24px')),"dashboard/ChangeSubscriptionStatus?tempval=website&status=Yes&id=".$oUserData->getId().'&customerId='.$oUserData->getId());
							}
						?>
						<p>Website</p>
						<p><?php
						if($oUserData->getWebsiteSubscriotion()=="Yes"){
							echo "Yes";
							//echo link_to(sfConfig::get("app_UserStatus_Active"), "dashboard/ChangeSubscriptionStatus?tempval=website&status=No&id=".$oUserData->getId().'&customerId='.$oUserData->getId(),array("title"=>"Click here to inactive"));
						}else{ //elseif($oUserData->getWebsiteSubscriotion()=="No")
							echo "No";
							//echo link_to(sfConfig::get("app_UserStatus_Inactive"), "dashboard/ChangeSubscriptionStatus?tempval=website&status=Yes&id=".$oUserData->getId().'&customerId='.$oUserData->getId(),array("title"=>"Click here to active"));
						}?></p>					</td>
					<td width="75" align="center" class="iconbg">
						<?php 
							if($oUserData->getNetworkProfileSubscription()=="Yes"){
								echo image_tag("admin/network-icon.png", array('border'=>'1','alt'=>'Image','width'=>'24px','height'=>'24px'));
								//echo link_to(image_tag("admin/network-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Click here to inactive",'width'=>'24px','height'=>'24px')),"dashboard/ChangeSubscriptionStatus?tempval=net&status=No&id=".$oUserData->getId().'&customerId='.$oUserData->getId());
								}
							else{
								echo image_tag("admin/network-icon.png", array('border'=>'1','alt'=>'Image','width'=>'24px','height'=>'24px'));
								//echo link_to(image_tag("admin/network-icon.png", array('border'=>'1','alt'=>'Image','title'=>"Click here to active",'width'=>'24px','height'=>'24px')),"dashboard/ChangeSubscriptionStatus?tempval=net&status=Yes&id=".$oUserData->getId().'&customerId='.$oUserData->getId());
							}
						?>
						<p>Network Portal</p>
						<p><?php 
						if($oUserData->getNetworkProfileSubscription()=="Yes"){
							echo "Yes";
							//echo link_to(sfConfig::get("app_UserStatus_Active"), "dashboard/ChangeSubscriptionStatus?tempval=net&status=No&id=".$oUserData->getId().'&customerId='.$oUserData->getId(),array("title"=>"Click here to inactive"));
						}else{ //elseif($oUserData->getNetworkProfileSubscription()=="No")
							echo "No";
							//echo link_to(sfConfig::get("app_UserStatus_Inactive"), "dashboard/ChangeSubscriptionStatus?tempval=net&status=Yes&id=".$oUserData->getId().'&customerId='.$oUserData->getId(),array("title"=>"Click here to active"));
						}?>	</p>				</td>
				    <td align="center" class="iconbg">&nbsp;</td>
				</tr>
			</table>
                        <!--End Subscriptions Table-->
                    </td>
                  </tr>
              </table>
            </td>
            <td align="left" valign="top" class="AccountSummary">
            	<!--Start Account summary Table-->
				<?php if($oUserData->getBillingSubscription() == "Yes"): ?>
                    <table cellspacing="1" cellpadding="5" width="100%" class="border">
                        <tr>
                            <td width="130" align="left" valign="middle" class="heading" colspan="5">Account Summary :</td>
                            
                        </tr>
                        <tr>
                          <td align="left" valign="middle" class="usrrowbg rightborder" >Total Cases :</td>
                          <td align="left" valign="middle" class="usrrowlightbg rightborder" ><?php echo $totalAcceptedCasesCount;  ?></td>
                          <td align="left" valign="middle" class="usrrowbg rightborder" >Remaining UnderPay Amount :</td>
                          <td align="left" valign="middle" class="usrrowlightbg" colspan="2"><?php echo sfConfig::get('app_currency').$underPayAmt;  ?></td>
                        </tr>

                        <!--START Code added by jaydip dodiya-->
                        
                        <!--END code added by jaydip dodiya-->

                        <!--<tr>
                          <td align="left" valign="middle" class="usrrowbg rightborder">Paid Cases :</td>
                          <td align="left" valign="middle" class="usrrowlightbg"><?php #echo $totalPaidCasesCount;  ?></td>
                        </tr>
                        <tr>
                          <td align="left" valign="middle" class="usrrowbg rightborder">Unpaid Cases :</td>
                          <td align="left" valign="middle" class="usrrowlightbg"><?php #echo $totalPendingCasesCount;  ?></td>
                        </tr>-->
                        <tr>
                          <td align="left" valign="middle" height="1"></td>
                          <td align="left" valign="middle"></td>
                        </tr>
                        
                        <tr>
                            <td width="130" align="left" valign="middle" class="heading" colspan="5">Customer Payment Summary :</td>
                            <!--<td align="left" valign="middle" class="heading">&nbsp;</td>-->
                        </tr>
                        
                        <tr>
                          <td align="center" valign="middle" class="usrrowbg rightborder">Actual Amount</td>
                          <td align="center" valign="middle" class="usrrowbg rightborder">Payable Amount</td>
                          <td align="center" valign="middle" class="usrrowbg rightborder">Amount paid</td>
                          <td align="center" valign="middle" class="usrrowbg rightborder">UnderPay Adjustment</td>
                          <td align="center" valign="middle" class="usrrowlightbg">Balance</td>
                          
                          
                        </tr>
                        
                        <tr>
                            <td align="center" valign="middle" class="usrrowlightbg rightborder"><?php echo sfConfig::get('app_currency').round($totalCasesAmount['actualamount'],2);  ?></td>
                            <td align="center" valign="middle" class="usrrowlightbg rightborder"><?php echo sfConfig::get('app_currency').round($totalCasesAmount['payableamount'],2);  ?></td>
                            <td align="center" valign="middle" class="usrrowlightbg rightborder"><?php echo sfConfig::get('app_currency').round($totalCasesAmount['paidamount'],2);  ?></td>
                            <td align="center" valign="middle" class="usrrowlightbg rightborder"><?php echo sfConfig::get('app_currency').round($totalCasesAmount['underpayamount'],2);  ?></td>
                            <td align="center" valign="middle"  class="usrrowlightbg">
                            <?php $balance = round( ( ( $totalCasesAmount['payableamount'] - $totalCasesAmount['paidamount'] ) - $totalCasesAmount['underpayamount'] ),2) ; 
                                  if($balance > 0) {
                                      echo sfConfig::get('app_currency').$balance.'      Cr.';
                                  } elseif( $balance < 0) {
                                      echo sfConfig::get('app_currency').abs($balance).'      Dr.'; 
                                  } else if($balance == 0) {
                                      echo sfConfig::get('app_currency').$balance.'      Cr.'; 
                                  }
                            ?>
                            </td>
                                                    
                        </tr>

                        
                        <tr>
                          <td align="left" valign="middle" height="1"></td>
                          <td align="left" valign="middle"></td>
                        </tr>
                        
                        
                        <tr>
                            <td width="130" align="left" valign="middle" class="heading" colspan="5">3rd Party Summary :</td>
                            <!--<td align="left" valign="middle" class="heading">&nbsp;</td>-->
                        </tr>
                        <tr>
                            <td align="center" valign="middle" class="usrrowbg rightborder topborder">Receivable Amount</td>
                            <td align="center" valign="middle" class="usrrowbg rightborder">Received Amount</td>
                            <td align="center" valign="middle" class="usrrowbg rightborder">3rd Party Under Paid</td>
                            <td align="center" valign="middle" class="usrrowlightbg"  colspan="2">Balance</td>
                        </tr>

                        
                        <tr>
                            <td align="center" valign="middle" class=" rightborder"><?php echo sfConfig::get('app_currency').$totalCasesAmount['actualamount'];  ?></td>
                            <td align="center" valign="middle" class="rightborder"><?php echo sfConfig::get('app_currency').$totalCasesAmount['receivedamount']  ?></td>
                            <td align="center" valign="middle" class="rightborder"><?php #echo sfConfig::get('app_currency').$totalCasesAmount['underpayamount'];  ?>
                            <?php echo sfConfig::get('app_currency').$totalDifferenceAmount['diffamount'];  ?>
                            </td>
                            <td align="center" valign="middle" class="" colspan="2">
                            <?php $balance =  ( ( $totalCasesAmount['actualamount'] - $totalCasesAmount['receivedamount'] ) - $totalCasesAmount['underpayamount'] ) ;  ?>
                            <?php $balance =  ( ( $totalCasesAmount['actualamount'] - $totalCasesAmount['receivedamount'] ) - $totalDifferenceAmount['diffamount'] ) ; 
                                  if($balance > 0) {
                                      echo sfConfig::get('app_currency').$balance.'         Dr.';
                                  } elseif( $balance < 0) {
                                      echo sfConfig::get('app_currency').abs($balance).'        Cr.'; 
                                  } else if($balance == 0) {
                                      echo sfConfig::get('app_currency').$balance.'         Dr.'; 
                                  }
                            ?>
                            </td>
                            
                        </tr>
                        

                        
                        
                        
                    </table>
                <?php endif; ?>
                <!--End Account summary Table -->
            </td>
          </tr>
        </table>
    </td>
  </tr>
  <!--Start Latest Case Table -->
  <?php if($oUserData->getBillingSubscription() == "Yes"): ?>
  <tr>
    <td align="left" valign="top">
        <table cellspacing="15" cellpadding="0" class="brd1" width="100%">
				<tr>
				  <td class="Title"> <strong>Latest Cases:</strong> </td>
				</tr>
				<?php if(($oCaseDatas->count())>0):?>
				<tr>
					<td>
					  <table cellspacing="1" cellpadding="5" width="100%" class="brd1">
					    <tr class="fldbg">
						        <td align="center" valign="middle"><strong>Agreement Date</strong></td>		
					            <td align="center" valign="middle"><strong>Case No. & Title</strong></td>
								<td align="center" valign="middle"><strong>3rd Party</strong></td>
								<td align="center" valign="middle"><strong>Actual Amount</strong></td>
								<td align="center" valign="middle"><strong>Stage</strong></td>
					    </tr>
					    <?php $i = 0; ?>
    					<?php foreach($oCaseDatas as $oCaseData): ?>
        						<tr <?php if(($i % 2 ) == 0 ) { ?> class="fldrowbg" <?php } ?>>
        										<td align="center" valign="middle">
        										<?php if($oCaseData->getStage() != sfConfig::get('app_CaseStage_Submitted'))
        										              echo date(sfConfig::get('app_dateformat'),strtotime($oCaseData->getAgreementDate()));
        										          else
        										              echo '---'; ?>
        										</td>
        						                <td align="left" valign="middle"><?php echo link_to($oCaseData->getCaseNo().' - '.$oCaseData->getFirstTitle().' '.$oCaseData->getLastTitle(), 'dashboardcase/dashboardCaseDetails?customerId='.$customerId.'&caseId='.$oCaseData->getId()); ?></td>
        										<td align="center" valign="middle"><?php echo $oCaseData->getCasesThirdParties()->getName(); ?></td>
        										<td align="right" valign="middle"><?php echo sfConfig::get("app_currency").round($oCaseData->getActualAmount(),2); ?></td>
        										<!--START this condition is added for close to closed issue solve-->
												<?php if($oCaseData->getStage() == sfConfig::get("app_CaseStage_Close")):?>
													<td align="left" valign="middle"><?php echo sfConfig::get("app_CaseClosed_Closed");?> </td>
												<?php else: ?>
													<td align="left" valign="middle"><?php echo $oCaseData->getStage(); ?></td>
												<?php endif;?>
											<!--END this condition is added for close to closed issue solve-->
        										<!--<td align="left" valign="middle"><?php //echo $oCaseData->getStage(); ?></td>-->
        						</tr>
        						<?php $i++ ;?>
						<?php endforeach; ?>
					  </table>
					</td>
				</tr>
				<?php else:?>
				<tr>
					<td class="errormss">No items found.</td>
				</tr>
				<?php endif; ?>
			</table>
		</td>
  </tr>
  <?php endif; ?>
  <!--End Latest Case Table-->
</table>