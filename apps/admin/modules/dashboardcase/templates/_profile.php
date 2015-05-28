<?php 
	// user profile image
	$userId = $sf_params->get('customerId');
	$imagePath = clsCommon::userProfileImage($userId, "medium");

	if ($sf_request->hasParameter('caseId')){ ?>
   <tr>
    <td align="left" valign="top" class="cases-user">
    <table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="40%" align="left" valign="middle">&nbsp;</td>
        <td width="10" align="left" valign="middle">&nbsp;</td>
        <td align="left" valign="middle">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="middle" class="cases-userimage">
			<?php
				echo image_tag($imagePath['path'], array('border'=>'1','alt'=>'Image','title'=>$imagePath['title'],'width'=>'50px','height'=>'50px'))
			?>
			<?php echo ucwords($caseData->getCasesUsers()->getFirstName()." ".$caseData->getCasesUsers()->getLastName()); ?>
		</td>
        <td align="left" valign="middle">&nbsp;</td>
        <td align="left" valign="middle"><strong>Name & Case No. :</strong> <?php echo ucwords($caseData->getFirstTitle()." ".$caseData->getLastTitle())." - ".$caseData->getCaseNo(); ?>
          <p><strong>3rd Party :</strong> <?php echo $caseData->getCasesThirdParties()->getName(); ?></p></td>
      </tr>
      <tr>
        <td align="left" valign="middle">&nbsp;</td>
        <td align="left" valign="middle">&nbsp;</td>
        <td align="left" valign="middle">&nbsp;</td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
<?php }else { ?>
   <tr>
    <td align="left" valign="top" class="cases-user">
    <table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="40%" align="left" valign="middle">&nbsp;</td>
        <td width="10" align="left" valign="middle">&nbsp;</td>
        <td align="left" valign="middle">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="middle" class="cases-userimage">
			<?php echo image_tag($imagePath['path'], array('border'=>'1','alt'=>'Image','title'=>$imagePath['title'],'width'=>'50px','height'=>'50px'))?>
			<?php echo ucwords($caseData->getFirstName()." ".$caseData->getLastName()); ?>
		</td>
        <td align="left" valign="middle">&nbsp;</td>
        <td align="left" valign="top"><strong>Last Login :</strong> <?php 
        if($caseData->getLastLoginDateTime() != '')
            echo date(sfConfig::get('app_dateformat'),strtotime($caseData->getLastLoginDateTime())); 
        else 
            echo ' Yet Not Login';        
        ?></td>
      </tr>
      <tr>
        <td align="left" valign="middle">&nbsp;</td>
        <td align="left" valign="middle">&nbsp;</td>
        <td align="left" valign="middle">&nbsp;</td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
<?php } ?>