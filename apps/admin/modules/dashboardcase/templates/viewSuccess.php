<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">
<!-- Bread Crumb Start -->

<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="66%" class="drkgrylnk padlft"><a href="<?php echo url_for("default/index");?>" title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home")) ?></a></td>
  <td width="34%" align="right" class="AdminBreadCrumb">
   <table cellpadding="8" cellspacing="0" align="right">
    <tr align="center">
     <!--<td width="57" class="LinkImg" ><a href="#" title="Edit"><?php image_tag("admin/Icon_Save.gif", array("alt"=>"Save","title"=>"Save","border"=>"0")) ?><br />
      Save </a></td>-->
     <td width="57" class="LinkImg" ><a href="<?php echo url_for('dashboardcase/index?customerId='.$sf_params->get('customerId')) ?>"><?php echo image_tag("admin/Icon_Cancel.gif", array("alt"=>"Cancel","title"=>"Cancel","border"=>"0")) ?><br />
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
  <td width="95%" class="ContentPad">
   <table width="99%" align="center" cellpadding="0" cellspacing="0" class="MainTbl">
    <tr>
     <td class="MaintblPadding">
      <table width="100%" cellspacing="0" cellpadding="0">
       <tr>
        <td class="ContentPad">
         <table cellspacing="0" cellpadding="0" align="center" class="ContentTable">
          <tr>
           <td width="05%" align="right" class="ContentBtmDotLn Pad5"><?php echo image_tag("admin/Icon_Groups.gif",array("alt"=>"Faq","title"=>"Faq","align"=>"middle")) ?><span class="Title"> </span></td>
           <td width="95%" class="ContentBtmDotLn">
            <div style="float:left;" class="Title">View Case Detail </div>           
           </td>
          </tr>
          <tr valign="top">
           <td colspan="2" class="dot"></td>
          </tr>
          <tr valign="top">
			 <td colspan="2" class="ListAreaPad">
			  <table width="65%" cellspacing="1" cellpadding="1" class="brd1" align="center">
			   <tr class="fldbg">
				<td colspan="3" class="whttxt">Case Detail</td>
			   </tr>
			   <tr>
				  <td width="30%" class="fldrowbg"><b>Customer Name:</b></td>
				  <td width="90%" class="fldrowbg">
				   <?php echo $case->getCasesUsers()->getName();?>
				  </td>
				</tr>

			   <tr>
				  <td width="10%" class="fldrowbg"><b>Case No.:</b></td>
				  <td width="90%" class="fldrowbg">
				   <?php echo $case->getCaseNo();?>
				  </td>
				</tr>

			   <tr>
				  <td width="10%" class="fldrowbg"><b>Case Title:</b></td>
				  <td width="90%" class="fldrowbg">
				   <?php echo $case->getFirstTitle().' '.$case->getLastTitle();?>
				  </td>
				</tr>
				
			   <tr>
				  <td width="10%" class="fldrowbg" valign="top"><b>Case Description:</b></td>
				  <td width="90%" class="fldrowbg">
				   <?php echo nl2br($case->getDescription());?>
				  </td>
				</tr>

				
				<tr>
				  <td class="fldrowbg"><b>3rd Party Name:</b></td>
				  <td class="fldrowbg">
					<?php echo $case->getCasesThirdParties()->getName();?>
				  </td>
				</tr>  
                <?php $asResult = CaseDocumentsTable::getCountRecord($case->getId());?>
                <tr style="height:35px;">
				  <td class="fldrowbg"><b>View Case Documents:</b></td>
				  <td class="fldrowbg">
                    <?php if($asResult > 0): ?>
							<?php echo link_to(image_tag("admin/document.png",array('title'=>'Click here to View Documents','alt'=>'Manage Case Document')),"casedocuments/index?caseId=".$case->getId()); ?>
                    <?php else:?>
							<?php echo ' Not Provided '?>
                    <?php endif; ?>
				  </td>
				 </tr>
				<!--<tr style="height:35px;">
				  <td class="fldrowbg"><b>View Case Invoice:</b></td>
				  <td class="fldrowbg">
                    <?php //if($case->getBillDocumentSystemName() != '') { ?>
                    <div  class="download">
        				<?php //echo link_to("&nbsp;","case/downloadinvoice?id=".$case->getId(),array('title'=>'Click here to View Invoice'))?>
        			</div>
                    <?php //} else {?>
                        <?php //echo ' Not Provided '?>
                    <?php //} ?>
				  </td>
				</tr>-->

			   <tr>
				  <td width="10%" class="fldrowbg"><b>Actual Amount:</b></td>
				  <td width="90%" class="fldrowbg">
				   <?php echo $case->getActualAmount();?>
				  </td>
				</tr>

			   <tr>
				  <td width="10%" class="fldrowbg"><b>Comission Percentage:</b></td>
				  <td width="90%" class="fldrowbg">
				   <?php echo $case->getCommisionPercentage();?>
				  </td>
				</tr>

			   <tr>
				  <td width="10%" class="fldrowbg"><b>Actual Commission:</b></td>
				  <td width="90%" class="fldrowbg">
				   <?php echo $case->getCommisionActual();?>
				  </td>
				</tr>
				
			   <tr>
				  <td width="10%" class="fldrowbg"><b>Processing Fees:</b></td>
				  <td width="90%" class="fldrowbg">
				   <?php echo $case->getProcessingFees();?>
				  </td>
				</tr>
			   <tr>
				  <td width="10%" class="fldrowbg"><b>Under Payment Adjustment:</b></td>
				  <td width="90%" class="fldrowbg">
				   <?php echo $case->getUnderpayadjustment();?>
				  </td>
				</tr>
			   <tr>
				  <td width="10%" class="fldrowbg"><b>Payable Amount To Customer:</b></td>
				  <td width="90%" class="fldrowbg">
				   <?php echo $case->getPayableAmount();?>
				  </td>
				</tr>
			   <tr>
				  <td width="10%" class="fldrowbg"><b>Received Amount From 3rd Party:</b></td>
				  <td width="90%" class="fldrowbg">
				   <?php echo $case->getReceivedAmount();?>
				  </td>
				</tr>
			   <tr>
				  <td width="10%" class="fldrowbg"><b>Difference Amount:</b></td>
				  <td width="90%" class="fldrowbg">
				   <?php echo $case->getDifferenceAmount();?>
				  </td>
				</tr>
			   <tr>
				  <td width="10%" class="fldrowbg"><b>Customer Paid Date:</b></td>
				  <td width="90%" class="fldrowbg">
				   <?php  if($case->getCustomerPaidDate() != '') 
				            echo date('Y-m-d',strtotime($case->getCustomerPaidDate()));
				          else  
				            echo '---';
				            ?>
				  </td>
				</tr>
				
			   <tr>
				  <td width="10%" class="fldrowbg"><b>3rd Party Payment Received Date:</b></td>
				  <td width="90%" class="fldrowbg">
				   <?php //echo $case->getPaymentReceivedDate();?>
				   
				   <?php  if($case->getPaymentReceivedDate() != '') 
				            echo date('Y-m-d',strtotime($case->getPaymentReceivedDate()));
				          else  
            	            echo '---';
			        ?>
				   
				  </td>
				</tr>
			   <tr>
				  <td width="10%" class="fldrowbg"><b>Agreement Date:</b></td>
				  <td width="90%" class="fldrowbg">
                   <?php if($case->getStage() != sfConfig::get('app_CaseStage_Submitted')) {
                            echo date('Y-m-d',strtotime($case->getAgreementDate()));
                        } else {
                            echo '---';
                        }
                         ?>
				  </td>
				</tr>
			   <tr>
				  <td width="10%" class="fldrowbg"><b>Case Stage:</b></td>
				  <td width="90%" class="fldrowbg" valign="top">
				   <?php echo $case->getStage();?>
				   &nbsp;&nbsp;
				   <?php  if($case->getStage() == sfConfig::get('app_CaseStage_Submitted')) {
				       echo link_to(image_tag("admin/accept-case.png",array('title'=>'Click here to Accept Case','alt'=>'Accept Case')),"case/changestage?stage=Accepted&id=".$case->getId());
				   }
				    
				   
				   ?>
				   
				  </td>
				</tr>
			   <tr>
				  <td width="10%" class="fldrowbg"><b>Case Status:</b></td>
				  <td width="90%" class="fldrowbg">
				   <?php echo $case->getStatus();?>
				  </td>
				</tr>

			   <tr>
				  <td width="10%" class="fldrowbg"><b>Case Created Date:</b></td>
				  <td width="90%" class="fldrowbg">
				   <?php echo date('Y-m-d',strtotime($case->getCreateDateTime()));?>
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
  </td>
 </tr>
</table>
<!-- Control Panel End -->
</td></tr>
</table>