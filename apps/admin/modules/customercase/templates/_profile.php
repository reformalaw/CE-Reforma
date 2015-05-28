<tr>
    <td align="left" valign="top" class="cases-user">
    <table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="40%" align="left" valign="middle">&nbsp;</td>
        <td width="10" align="left" valign="middle">&nbsp;</td>
        <td align="left" valign="middle">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="middle" class="cases-userimage"><?php echo image_tag("admin/usercaseicon.png", array('border'=>'1','alt'=>'Image','title'=>"No-Image",'width'=>'50px','height'=>'50px'))?><?php echo ucwords($caseData->getFirstTitle()." ".$caseData->getLastTitle());?></td>
        <td align="left" valign="middle">&nbsp;</td>
        <td align="left" valign="middle"><strong>Case No. :</strong> <?php echo $caseData->getCaseNo(); ?>
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