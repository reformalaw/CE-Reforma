<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left" valign="middle" class="cases-userimage">
			<?php
				$userId = $sf_params->get('customerId');
				$imagePath = clsCommon::userProfileImage($userId, "medium");
				echo image_tag($imagePath['path'], array('border'=>'1','alt'=>'Image','title'=>$imagePath['title'],'width'=>'50px','height'=>'50px'))
				//echo image_tag("admin/usericon.png", array('border'=>'1','alt'=>'Image','title'=>"No-Image",'width'=>'50px','height'=>'50px'))
			?>
			<?php echo ucwords($userData->getUsersWebsiteUsers()->getFirstName()." ".$userData->getUsersWebsiteUsers()->getLastName());?>
		</td>
		<td width="10" align="left" valign="middle">&nbsp;</td>
		<td align="left" valign="middle"><strong>Website URL: </strong><a href="http://<?php echo $userData->getWebsiteurl(); ?>" target="_blank"><?php echo $userData->getWebsiteurl();?></a><?php //echo $userData->getWebsiteurl();?><p><strong>Created On :</strong> <?php echo date(sfConfig::get('app_dateformat'),strtotime($userData->getUsersWebsiteUsers()->getCreateDateTime())); ?></p>
		<!--<p><strong>Status :</strong> <?php //echo $userData->getUsersWebsiteUsers()->getStatus(); ?> </p>--></td>
	</tr>
</table>