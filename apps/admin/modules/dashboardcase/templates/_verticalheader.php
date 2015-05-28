<?php 
$summaryTab = 'deselect';
$documentsTab = 'deselect';
$paymentTab = 'deselect';
$editTab = 'deselect';

if ($sf_params->get('module') == 'dashboardcase' && $sf_params->get('action') == 'dashboardCaseDetails') {
    $summaryTab = 'select';
}
if ($sf_params->get('module') == 'dashboardcase' && $sf_params->get('action') == 'caseDocumentList') {
    $documentsTab = 'select';
}
$tabSelect = array('paymenthistory','paymentreceived');
//if ($sf_params->get('module') == 'paymenthistory' && $sf_params->get('action') == 'index') {
if (in_array($sf_params->get('module'),$tabSelect)) {
    $paymentTab = 'select';
}
if ($sf_params->get('module') == 'dashboardcase' && $sf_params->get('action') == 'edit') {
    $editTab = 'select';
}
?>
<td width="150" align="left" valign="top" class="LeftMenu"><table width="100%" cellspacing="0" cellpadding="0">
    <tr>
        <td align="left" valign="middle">&nbsp;</td>
    </tr>
    <tr>
        <td align="left" valign="middle" class="<?php echo $summaryTab ?>"><?php echo link_to('Summary','dashboardcase/dashboardCaseDetails?customerId='.$sf_params->get('customerId').'&caseId='.$sf_params->get('caseId'));?></td>
    </tr>
    <tr>
        <td align="left" valign="middle" class="<?php echo $documentsTab ?>">
			<?php echo link_to("Documents", "dashboardcase/caseDocumentList?caseId=".$sf_params->get("caseId")."&customerId=".$sf_params->get("customerId")); ?>
        <!--<a href="#">Documents</a>-->
        </td>
    </tr>
    <tr>
        <td align="left" valign="middle" class="<?php echo $paymentTab ?>">
            <?php 
            if($caseObj->getStage() != sfConfig::get('app_CaseStage_Submitted')) {
                echo link_to("Payment History",'paymenthistory/index?caseId='.$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId'));
            } else {?>
                   <a href="javascript:void(0)" onclick="alert('Please Accept Case to view Payment History'); return false;">Payment History</a>                     
            <?php } ?>                   
                    
        </td>
    </tr>
    
    <!--<tr>
        <td align="left" valign="middle" class="deselect">
            <?php 
            /*if($caseObj->getStage() != sfConfig::get('app_CaseStage_Submitted')) {
            echo link_to("Payment Received",'paymentreceived/index?caseId='.$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId'));
            } else {?>
            <a href="javascript:void(0)" onclick="alert('Please Accept Case to view Payment History'); return false;">Payment History</a>
            <?php }*/ ?>                   
                    
        </td>
    </tr>-->
    
    <tr>
        <td align="left" valign="middle" class="<?php echo $editTab ?>">
            <?php if($caseObj->getStage() == sfConfig::get('app_CaseStage_Close')) { ?>
                <a href="javascript:void(0)" onclick="alert('This feature will not be available as the case is closed'); return false;" title="Click here to Edit Case">Edit</a>                     
            <?php } else {
                echo link_to("Edit",'dashboardcase/edit?caseId='.$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId'), array('title' => 'Click here to Edit Case'));
            } ?>                   
        </td>                
    </tr>
    <tr>
        <td align="left" valign="middle" class="deselect">
            
            <?php if($caseObj->getStage() == sfConfig::get('app_CaseStage_Close')) { ?>
                <a href="javascript:void(0)" onclick="alert('This feature will not be available as the case is closed'); return false;">Delete</a>                     
            <?php } else { ?>
				<?php if($sf_user->hasCredential('admin')){ ?>
					<!-- when admin login physically delete the record -->
					<?php if($caseObj->getStage() == sfConfig::get('app_CaseStage_Submitted')) {
					    echo link_to("Delete","case/permanentDeleteCase?id=".$sf_params->get('caseId')."&flag=2&customerId=".$sf_params->get('customerId'),array('OnClick'=>"return deletePhysicallyConfirmation();",'title' => 'Click here to Delete Case'));
					} else  { ?>
                        <a href="javascript:void(0)" onclick="alert('This feature will not be available once case is accepted'); return false;">Delete</a>					    
					<?php } ?>
				
			     <?php } else { ?>
			         <?php if($caseObj->getStage() == sfConfig::get('app_CaseStage_Submitted')) {
			             echo link_to("Delete",'dashboardcase/changeStatus?status=Deleted&caseId='.$sf_params->get('caseId').'&customerId='.$sf_params->get('customerId').'&from=caseDetail',array('OnClick'=>"return deleteConfirmation();",'title' => 'Click here to Delete Case'));
    					    } else  { ?>
                      <a href="javascript:void(0)" onclick="alert('This feature will not be available once case is accepted'); return false;">Delete</a>				    
                        <?php } ?>
                <?php } ?>
                
            <?php } ?>                   

            
         </td>
    </tr>
</table></td>