<table width="98%" cellspacing="0" cellpadding="0" align="center">
  <?php include_component('dashboardcase', 'profile');?>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="120" align="left" valign="middle" class="CasesList"><?php echo image_tag("admin/editorial-icon.gif", array("alt"=>"Cases","title"=>"Cases","align"=>"middle"))?> Cases List</td>
        <td align="center" valign="middle" class="CasesListUserName"><?php //echo ucwords($name);?></td>
        <td width="120" class="LinkImg" align="right" ><a href="<?php echo url_for('dashboardcase/new?customerId='.$sf_params->get('customerId')) ?>" title="Add New"><?php echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
      Add Case</a></td> 
      </tr>
    </table></td>
  </tr>
  <?php $varExtra = '';?>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top" class="CasesListSearch">
    <form action="<?php echo url_for('dashboardcase/index?customerId='.$sf_params->get('customerId')) ?>" method="post">
    	<table width="100%" cellspacing="10" cellpadding="0">
  <tr>
    <td width="220" align="left" valign="top"><?php echo $searchForm['CaseNo']->renderLabel(); ?></td>
    <td width="220" align="left" valign="top"><?php echo $searchForm['FromDate']->renderLabel(); ?></td>
    <td width="210" align="left" valign="top"><?php echo $searchForm['Stage']->renderLabel(); ?></td>
    <td width="210" align="left" valign="top"><?php echo $searchForm['Status']->renderLabel(); ?></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top"><?php echo $searchForm['CaseNo']->render(); ?></td>
    <td align="left" valign="top"><?php echo $searchForm['FromDate']->render(); 
    echo "&nbsp;To&nbsp;";
											echo $searchForm['ToDate']->render(); ?>
									  <br>		
                                      <label class="error" id="dateError"></label></td>
    <td align="left" valign="top"><?php echo $searchForm['Stage']->render(); ?></td>
    <td align="left" valign="top"><?php echo $searchForm['Status']->render(); ?></td>
    <td align="left" valign="top"><span class="bluButton"> <?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'bluButton', 'value' => 'Search')); ?> </span> <span class="grayButton"><?php echo tag('input', array('name' => 'clear', 'type' => 'reset', 'id' => 'clear', 'class' => 'grayButton', 'value' => 'Clear', "onclick"=>'window.location="'.url_for('dashboardcase/index?customerId='.$sf_params->get('customerId')).'"')); ?> </span></td>
  </tr>
  <tr>
    <td height="1" colspan="5" align="left" valign="top"></td>
    </tr>
</table>
</form>
</td>
  </tr>
  <tr>
    <td height="20" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="CaseStageCode"><table width="100%" cellspacing="0" cellpadding="0">
          <tr>
          	<td rowspan="2" align="right" valign="middle" class="heading"><span style="float:left;">Total Cases:&nbsp; <?php echo $pager->getnbResults(); ?></span><strong> Case Stage Code:</strong></td>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="100" align="left" valign="top"><strong>Submitted :</strong></td>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="100" align="left" valign="top"><strong>Accepted :</strong></td>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="100" align="left" valign="top"><strong>Paid :</strong></td>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="100" align="left" valign="top"><strong>Closed :</strong></td>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="100" align="left" valign="top"><strong>UnderPay :</strong></td>
          </tr>
          <tr>
          	<td width="10" height="25" align="center" valign="top">&nbsp;</td>
            <td align="left" valign="top" style="background-color:#7757A6;">&nbsp;</td>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td align="left" valign="top" style="background-color:#74DF00;">&nbsp;</td>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td align="left" valign="top" style="background-color:#FFEA00;">&nbsp;</td>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td align="left" valign="top" style="background-color:#9D9D9D;">&nbsp;</td>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td align="left" valign="top" style="background-color:#FE0303;">&nbsp;</td>
          </tr>
    </table></td>
  </tr>
  <tr>
    <td height="25" align="left" valign="top">&nbsp;</td>
  </tr>
  <?php include_partial('default/message'); ?>
  <tr>
    <td align="left" valign="top"><table width="100%" cellspacing="1" cellpadding="5">
    <?php if($pager->getnbResults() > 0){?>
    <?php 
    $colorCode = array(
    'Submitted'     => '#7757a6', // Purple
    'Accepted'      => '#74DF00', // Green
    'Paid'          => '#ffea00', // Yellow
    'Close'         => '#9d9d9d', // Grey
    '3rdPartyBillsSubmitted'     => '#0090ff',
    'UnderPay'      => '#fe0303' // Red
    );#fe0303-red #166f27-green #ffea00-yellow #0090ff-blue #9d9d9d-gry #7757a6-purple     ?>
      <tr class="fldbg" style="font-weight:bold">
        <td align="center" valign="middle" width="10%"> Agreement Dt. </td>  
        <td align="center" valign="middle" width="10%">Case No. &amp; Title</td>
        <td align="center" valign="middle" width="10%"> 3rd Party </td>
        <td align="center" valign="middle" width="10%"> Actual Amt. </td>
        <td align="center" valign="middle" width="10%"> Created By </td>
        <td align="center" valign="middle" width="8%"> Bill To 3rd Party </td>
        <td align="center" valign="middle" width="10%"> Paid Amount </td>
        <td align="center" valign="middle" width="10%"> Received Amount </td>
        <td align="center" valign="middle" width="15%">Action</td>
      </tr>
      <?php foreach ($pager->getResults() as $cases):?>
      <?php $stageColor = $colorCode[$cases->getStage()];
      if($cases->getStage() == sfConfig::get('app_CaseStage_Close') && $cases->getActualAmount() >  $cases->getReceivedAmount()) {
          $stageColor = $colorCode['UnderPay'];
            }?>
      <tr bgcolor="<?php echo $stageColor; ?>">
        <td align="center" valign="middle"><?php if($cases->getStage() != sfConfig::get('app_CaseStage_Submitted')) {
            echo date('Y-m-d',strtotime($cases->getAgreementDate()));
        } else {
            echo '---';
                                                }?></td>
        <td align="left" valign="middle"><?php echo link_to($cases->getCaseNo()."<br>".ucwords($cases->getFirstTitle().' '.$cases->getLastTitle()),'dashboardcase/dashboardCaseDetails?customerId='.$sf_params->get('customerId').'&caseId='.$cases->getId()) ;?></td>
        <td align="left" valign="middle"><?php $thirdParty  =  $cases->getCasesThirdParties()->getName(); echo $thirdParty; ?></td>
        <td align="right" valign="middle"><?php echo sfConfig::get('app_currency').round($cases->getActualAmount(),2) ?></td>
        <td align="left" valign="middle"><?php echo ucwords($cases->getCasesUsersCreatedBy()->getFirstName(). ' '. $cases->getCasesUsersCreatedBy()->getLastName()); ?></td>
        <td align="center" valign="middle"><?php echo $cases->getThirdPartyBillsSubmitted(); ?></td>
        <td align="right" valign="middle"><?php if(in_array($cases->getStage(),array(sfConfig::get('app_CaseStage_Paid'), sfConfig::get('app_CaseStage_Close') ) )) {?>  
                                                <?php echo sfConfig::get('app_currency').round($cases->getPaidAmount(),2);?>
                                            <?php } else {
                                                echo  sfConfig::get('app_currency').'0';
                                                }  ?></td>
        <td align="right" valign="middle"> <?php if($cases->getReceivedAmount() != '') {
            echo sfConfig::get('app_currency').round($cases->getReceivedAmount(),2);
        } else {
            echo  sfConfig::get('app_currency').'0';
                    						}?>                                                
                                                </td>
        <td align="center" valign="middle">
                    <?php /*if($cases->getStage() ==  sfConfig::get('app_CaseStage_Paid') || $cases->getStage() ==  sfConfig::get('app_CaseStage_Close')) { 
                    						echo link_to(image_tag("admin/print-cases-icon.png",array('title'=>'Click here to Print Invoice','alt'=>'Print Invoice','width'=>'24')),"dashboardcase/printinvoice?id=".$cases->getId()."&CaseNo=".$cases->getCaseNo().'&customerId='.$sf_params->get('customerId'),array('target'=>'_blank'));
                    } else { ?>
                    <a href="#" style="cursor:none;"><?php echo image_tag("admin/blank-img.png",array('width'=>'24')); ?></a>
                    <?php }*/
                    						if($cases->getStage() == sfConfig::get('app_CaseStage_Submitted')) {
                    						    echo link_to(image_tag("admin/accepted-cases-icon.png",array('title'=>'Click here to Accept Case','alt'=>'Accept Case','width'=>'24','height'=>25)),"dashboardcase/changestage?stage=Accepted&caseId=".$cases->getId().'&customerId='.$sf_params->get('customerId').'&from=dlist');
                          } else { ?>
                            <a href="#" style="cursor:none;"><?php echo image_tag("admin/blank-img.png",array('width'=>'24','height'=>25)) ; ?></a>
                    <?php }  

                    /*if($cases->getStage() == sfConfig::get('app_CaseStage_Accepted') && $cases->getThirdPartyBillsSubmitted() == 'No' ) { // Code to Submit Bills to 3rd Party
                    echo link_to(image_tag("admin/bill-cases-icon.png",array('title'=>'Click here for Submit Bills to 3rd Party','alt'=>'Submit Bills to 3rd Party','width'=>24,'height'=>25)),"dashboardcase/submitbill?caseId=".$cases->getId().'&customerId='.$sf_params->get('customerId'));
                          } else {*/ ?>
                            <!--<a href="#" style="cursor:none;"><?php #echo image_tag("admin/blank-img.png",array('width'=>'24','height'=>25)) ; ?></a> -->

                            
                            <?php if(in_array($cases->getStage(), array(sfConfig::get('app_CaseStage_Accepted'), sfConfig::get('app_CaseStage_Paid')) )) {?>
                            
                                    <?php if( $cases->getThirdPartyBillsSubmitted() == 'No') {
                                        echo link_to(image_tag("admin/bill-cases-icon.png",array('title'=>'Click here for Submit Bills to 3rd Party','alt'=>'Submit Bills to 3rd Party','width'=>24,'height'=>25)),"dashboardcase/submitbill?caseId=".$cases->getId().'&customerId='.$sf_params->get('customerId').'&stat=Yes');
                                    } else {
                                        echo link_to(image_tag("admin/bill-cases-icon.png",array('title'=>'Click here for Reject Bills to 3rd Party','alt'=>'Reject Bills to 3rd Party','width'=>24,'height'=>25)),"dashboardcase/submitbill?caseId=".$cases->getId().'&customerId='.$sf_params->get('customerId').'&stat=No');
                                    } ?>
                                                                                
                            <?php } else  {?>
                                    <a href="#" style="cursor:none;"><?php echo image_tag("admin/blank-img.png",array('width'=>'24','height'=>25)) ; ?></a>                      
                            <?php } ?>
                            
                            
                            
                            
                    <?php
                          if($cases->getStage() != sfConfig::get('app_CaseStage_Close') ) { ?>
                        	<a href="<?php echo url_for('dashboardcase/edit?caseId='.$cases->getId().'&customerId='.$sf_params->get('customerId'))?>"><?php echo image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>24,'height'=>25))?></a>
                    <?php } else {?>
                            <a href="#" style="cursor:none;"><?php echo image_tag("admin/blank-img.png",array('width'=>24,'height'=>25)) ; ?></a>
                    <?php } ?>
                    <?php if ($cases->getStage() != sfConfig::get('app_CaseStage_Close')){
                        if($cases->getStatus() == sfConfig::get('app_CaseStatus_Active')) {
                            echo link_to(image_tag("admin/active-cases-icon.png",array('title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip'),'alt'=>'Active','width'=>24,'height'=>25)),"dashboardcase/changeStatus?status=Inactive&caseId=".$cases->getId().'&customerId='.$sf_params->get('customerId'));
                        }elseif($cases->getStatus()  == sfConfig::get('app_CaseStatus_Inactive')){
                            echo link_to(image_tag("admin/inactive-icon.png",array('title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'),'alt'=>'Inactive','width'=>24,'height'=>25)),"dashboardcase/changeStatus?status=Active&caseId=".$cases->getId().'&customerId='.$sf_params->get('customerId'));
                        }elseif($cases->getStatus() == ""){
                            echo link_to(image_tag("admin/blank-img.png",array('title'=>'This Case\'s status is Pending. Click to activate.','alt'=>'Panding','width'=>24,'height'=>25)),"dashboardcase/changeStatus?status=Active&caseId=".$cases->getId().'&customerId='.$sf_params->get('customerId'));
                        }
                    }else {
                        echo link_to(image_tag("admin/blank-img.png",array('alt'=>'Panding','width'=>24,'height'=>25,'style'=>'cursor:none;')),"dashboardcase/changeStatus?status=Active&caseId=".$cases->getId().'&customerId='.$sf_params->get('customerId'));
                    }
                          if ($cases->getStage() != sfConfig::get('app_CaseStage_Close')){ ?>
							<?php if($sf_user->hasCredential('admin')){?>
								<!-- when admin login physically delete the record -->
    								<?php if($cases->getStage() == sfConfig::get('app_CaseStage_Submitted')) {
    								    echo link_to(image_tag('admin/delete-cases-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Click to Delete.','OnClick'=>"return deletePhysicallyConfirmation();",'width'=>24,'height'=>25)),"case/permanentDeleteCase?id=".$cases->getId()."&flag=2&customerId=".$sf_params->get('customerId'));
    								}	    else {
    								    echo image_tag("admin/blank-img.png",array('alt'=>'Panding','width'=>24,'height'=>25,'style'=>'cursor:none;'));
    								}
    								     ?>
							<?php } else { ?>
							     <?php if($cases->getStage() == sfConfig::get('app_CaseStage_Submitted')) { ?>
								    <a href="<?php echo url_for('dashboardcase/changeStatus?status=Deleted&caseId='.$cases->getId().'&customerId='.$sf_params->get('customerId'))?>"><?php echo image_tag('admin/delete-cases-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Click to Delete.','OnClick'=>"return deleteConfirmation();",'width'=>24,'height'=>25))?></a>
								 <?php } else {   
								     echo image_tag("admin/blank-img.png",array('alt'=>'Panding','width'=>24,'height'=>25,'style'=>'cursor:none;'));
								  } ?>
							<?php }  ?>
							
							
                          <?php } else {
                              echo image_tag("admin/blank-img.png",array('alt'=>'Panding','width'=>24,'height'=>25,'style'=>'cursor:none;'));
                          } ?>
        </td>
      </tr>
      <?php endforeach; ?>    
      <?php } else { ?> 
        <tr class="fldbg"><td class="errormss">No Cases Found !!</td></tr>
      <?php } ?>         
      <tr>
        <td align="left" valign="middle" colspan="9">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
           <td colspan="2" class="ListAreaPad" align="center" valign="top">                     
              <?php                 
              if($orderBy) $varExtra .="&orderBy=$orderBy";
              if($orderType) $varExtra .="&orderType=$orderType";

              if(isset($defaultArr['UserId']) && !empty($defaultArr['UserId'])) {
                  $varExtra .="&UserId=".$defaultArr['UserId'];
              }

              /*if(isset($defaultArr['UserCaseNo']) && !empty($defaultArr['UserCaseNo'])) {
              $varExtra .="&UserCaseNo=".$defaultArr['UserCaseNo'];
              }*/

              if(isset($defaultArr['CaseNo']) && !empty($defaultArr['CaseNo'])) {
                  $varExtra .="&CaseNo=".$defaultArr['CaseNo'];
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

              if(isset($defaultArr['Status']) && !empty($defaultArr['Status'])) {
                  $varExtra .="&Status=".$defaultArr['Status'];
              }
              $varExtra .="&customerId=".$sf_params->get('customerId');
              ?>
               <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'dashboardcase/index', 'varExtra' => $varExtra));?>
           </td>
          </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
</table>


<script language="javascript" type="text/javascript">

function getCases(val) {
    //if(val != '') {
    var dataString = 'userid='+val;
    $.ajax({
        type: "POST",
        url: "<?php echo url_for('case/usercase'); ?>",
        data: dataString,
        beforeSend: function(){
            $('#search_admin_case_UserCaseNo').html("<option>Loading...</option>");
        },
        success: function(message) {
            $('#search_admin_case_UserCaseNo').html(message);
        }
    });

    /*} else {
    alert(val+'========');
    }*/

} // End of Function
$(function() {
    $( "#search_admin_case_CaseNo" ).autocomplete({
        source: "<?php url_for('dashboardcase/index') ?>",
        minLength: 2,
    });
});
</script>
