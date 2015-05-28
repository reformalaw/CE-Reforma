<?php 	$currentOptionData = $sf_data->getRaw('currentOptionData');
		$optionData = $sf_data->getRaw('optionData');
?>
<table width="100%" class="PageListHeading">
<tr>
<td align="left"><strong> <?php  echo "Difference Between ' ". $currentThemeData->getName(). " ' (Current Theme) And ' ". $selectedTheme->getName()." '"; ?> </strong>
</td>
</tr>
</table>
<table width="100%">
<tr class="fldbg">
<td width="49%" align="left"><span class="whttxt">Theme Features</span></td>
<td width="26%" align="center"><span class="whttxt"><?php echo $currentThemeData->getName()." (Current Theme)"; ?></span></td>
<td width="25%" align="center"><span class="whttxt"><?php echo $selectedTheme->getName(); ?></span></td>
</tr>
<tr>
	<td width="60%" class="fldrowbg border-right border-left" align="left" valign="top">Manage Top Menu</td>
	<td width="20%" class="fldrowbg border-right" align="left" valign="top"><?php echo $currentThemeData->getManageTopMenu(); ?></td>
	<td width="20%" class="fldrowbg border-right" align="left" valign="top"><?php echo $selectedTheme->getManageTopMenu(); ?></td>
</tr>

<tr>
	<td width="60%" class="fldrowbg border-right border-left" align="left" valign="top">Manage Footer Menu</td>
	<td width="20%" class="fldrowbg border-right" align="left" valign="top"><?php echo $currentThemeData->getManageFooterMenu(); ?></td>
	<td width="20%" class="fldrowbg border-right" align="left" valign="top"><?php echo $selectedTheme->getManageFooterMenu(); ?></td>
</tr>

<tr>
	<td width="60%" class="fldrowbg border-right border-left" align="left" valign="top">Manage Banner</td>
	<td width="20%" class="fldrowbg border-right" align="left" valign="top"><?php echo $currentThemeData->getManageBanner(); ?></td>
	<td width="20%" class="fldrowbg border-right" align="left" valign="top"><?php echo $selectedTheme->getManageBanner(); ?></td>
</tr>

	<!--START UNDER THE MANAGE BANNER-->
			<tr>
				<td width="60%" class="chledFirstRow border-right border-left" align="left" valign="top">No. Of Banner Title</td>
				<?php if(array_key_exists("ManageBanner", $currentOptionData)): ?>
						<td width="20%" class="chledOtherRow border-right" align="left" valign="top"><?php echo $currentOptionData["ManageBanner"]; ?></td>
				<?php else: ?>
						<td width="20%" class="chledOtherRow border-right" align="left" valign="top">0</td>
				<?php endif; ?>

				<?php if(array_key_exists("ManageBanner", $optionData)): ?>
						<td width="20%" class="chledOtherRow border-right" align="left" valign="top"><?php echo $optionData["ManageBanner"]; ?></td>
				<?php else: ?>
						<td width="20%" class="chledOtherRow border-right" align="left" valign="top">0</td>
				<?php endif; ?>

			</tr>

			<tr>
				<td width="60%" class="chledFirstRow border-right border-left" align="left" valign="top">Banner Background</td>
				<?php if(array_key_exists("BannerBackground", $currentOptionData)): ?>
						<td width="20%" class="chledOtherRow border-right" align="left" valign="top"><?php echo $currentOptionData["BannerBackground"]; ?></td>
				<?php else: ?>
						<td width="20%" class="chledOtherRow border-right" align="left" valign="top"><?php echo $currentOptionData["BannerBackground"]; ?></td>
				<?php endif; ?>

				<?php if(array_key_exists("BannerBackground", $optionData)): ?>
						<td width="20%" class="chledOtherRow border-right" align="left" valign="top"><?php echo $optionData["BannerBackground"]; ?></td>
				<?php else: ?>
						<td width="20%" class="chledOtherRow border-right" align="left" valign="top"><?php echo $currentOptionData["BannerBackground"]; ?></td>
				<?php endif; ?>
			</tr>

			<tr>
				<td width="60%" class="chledFirstRow border-right border-left" align="left" valign="top">Banner Foreground</td>
				<?php if(array_key_exists("BannerForeground", $currentOptionData)): ?>
						<td width="20%" class="chledOtherRow border-right" align="left" valign="top"><?php echo $currentOptionData["BannerForeground"]; ?></td>
				<?php else: ?>
						<td width="20%" class="chledOtherRow border-right" align="left" valign="top"><?php echo $currentOptionData["BannerForeground"]; ?></td>
				<?php endif; ?>

				<?php if(array_key_exists("BannerForeground", $optionData)): ?>
						<td width="20%" class="chledOtherRow border-right" align="left" valign="top"><?php echo $optionData["BannerForeground"]; ?></td>
				<?php else: ?>
						<td width="20%" class="chledOtherRow border-right" align="left" valign="top"><?php echo $currentOptionData["BannerForeground"]; ?></td>
				<?php endif; ?>
			</tr>
	<!--END UNDER THE MANAGE BANNER-->

<tr>
	<td width="60%" class="fldrowbg border-right border-left" align="left" valign="top">Manage Color And Background</td>
	<td width="20%" class="fldrowbg border-right" align="left" valign="top"><?php echo $currentThemeData->getManageColorAndBackground(); ?></td>
	<td width="20%" class="fldrowbg border-right" align="left" valign="top"><?php echo $selectedTheme->getManageColorAndBackground(); ?></td>
</tr>
		<!--START UNDER THE MANAGE COLOR AND BACKGROUND -->

				<tr>
					<td width="60%" class="chledFirstRow border-right border-left" align="left" valign="top">Background Color</td>
					<?php if(array_key_exists("BGColor", $currentOptionData)): ?>
							<td width="20%" class="chledOtherRow border-right" align="left" valign="top">Yes</td>
					<?php else: ?>
							<td width="20%" class="chledOtherRow border-right" align="left" valign="top">No</td>
					<?php endif; ?>

					<?php if(array_key_exists("BGColor", $optionData)): ?>
							<td width="20%" class="chledOtherRow border-right" align="left" valign="top">Yes</td>
					<?php else: ?>
							<td width="20%" class="chledOtherRow border-right" align="left" valign="top">No</td>
					<?php endif; ?>
				</tr>
				
				<tr>
					<td width="60%" class="chledFirstRow border-right border-left" align="left" valign="top">Text Color</td>
					<?php if(array_key_exists("TextColor", $currentOptionData)): ?>
							<td width="20%" class="chledOtherRow border-right" align="left" valign="top">Yes</td>
					<?php else: ?>
							<td width="20%" class="chledOtherRow border-right" align="left" valign="top">No</td>
					<?php endif; ?>

					<?php if(array_key_exists("TextColor", $optionData)): ?>
							<td width="20%" class="chledOtherRow border-right" align="left" valign="top">Yes</td>
					<?php else: ?>
							<td width="20%" class="chledOtherRow border-right" align="left" valign="top">No</td>
					<?php endif; ?>
				</tr>
				
				<tr>
					<td width="60%" class="chledFirstRow border-right border-left" align="left" valign="top">Border Color</td>
					<?php if(array_key_exists("BorderColor", $currentOptionData)): ?>
							<td width="20%" class="chledOtherRow border-right" align="left" valign="top">Yes</td>
					<?php else: ?>
							<td width="20%" class="chledOtherRow border-right" align="left" valign="top">No</td>
					<?php endif; ?>

					<?php if(array_key_exists("BorderColor", $optionData)): ?>
							<td width="20%" class="chledOtherRow border-right" align="left" valign="top">Yes</td>
					<?php else: ?>
							<td width="20%" class="chledOtherRow border-right" align="left" valign="top">No</td>
					<?php endif; ?>
				</tr>

				<tr>
					<td width="60%" class="chledFirstRow border-right border-left" align="left" valign="top">Link Color</td>
					<?php if(array_key_exists("LinkColor", $currentOptionData)): ?>
							<td width="20%" class="chledOtherRow border-right" align="left" valign="top">Yes</td>
					<?php else: ?>
							<td width="20%" class="chledOtherRow border-right" align="left" valign="top">No</td>
					<?php endif; ?>

					<?php if(array_key_exists("LinkColor", $optionData)): ?>
							<td width="20%" class="chledOtherRow border-right" align="left" valign="top">Yes</td>
					<?php else: ?>
							<td width="20%" class="chledOtherRow border-right" align="left" valign="top">No</td>
					<?php endif; ?>
				</tr>
				
				<tr>
					<td width="60%" class="chledFirstRow border-right border-left" align="left" valign="top">Link Hover Color</td>
					<?php if(array_key_exists("LinkHoverColor", $currentOptionData)): ?>
							<td width="20%" class="chledOtherRow border-right" align="left" valign="top">Yes</td>
					<?php else: ?>
							<td width="20%" class="chledOtherRow border-right" align="left" valign="top">No</td>
					<?php endif; ?>

					<?php if(array_key_exists("LinkHoverColor", $optionData)): ?>
							<td width="20%" class="chledOtherRow border-right" align="left" valign="top">Yes</td>
					<?php else: ?>
							<td width="20%" class="chledOtherRow border-right" align="left" valign="top">No</td>
					<?php endif; ?>
				</tr>
		<!--END UNDER THE MANAGE COLOR AND BACKGROUND -->
<tr>
	<td width="60%" class="fldrowbg border-right border-left" align="left" valign="top">Manage Social Media</td>
	<td width="20%" class="fldrowbg border-right" align="left" valign="top"><?php echo $currentThemeData->getManageSocialMedia(); ?></td>
	<td width="20%" class="fldrowbg border-right" align="left" valign="top"><?php echo $selectedTheme->getManageSocialMedia(); ?></td>
</tr>

<tr>
	<td width="60%" class="fldrowbg border-right border-left" align="left" valign="top">Change Logo</td>
	<td width="20%" class="fldrowbg border-right" align="left" valign="top"><?php echo $currentThemeData->getChangeLogo(); ?></td>
	<td width="20%" class="fldrowbg border-right" align="left" valign="top"><?php echo $selectedTheme->getChangeLogo(); ?></td>
</tr>

<tr>
	<td width="60%" class="fldrowbg border-right border-left" align="left" valign="top">Manage FAQs</td>
	<td width="20%" class="fldrowbg border-right" align="left" valign="top"><?php echo $currentThemeData->getManageFAQs(); ?></td>
	<td width="20%" class="fldrowbg border-right" align="left" valign="top"><?php echo $selectedTheme->getManageFAQs(); ?></td>
</tr>

<tr>
	<td width="60%" class="fldrowbg border-right border-left" align="left" valign="top">Text Widgets</td>
	<td width="20%" class="fldrowbg border-right" align="left" valign="top"><?php echo $currentThemeData->getTextWidgets(); ?></td>
	<td width="20%" class="fldrowbg border-right" align="left" valign="top"><?php echo $selectedTheme->getTextWidgets(); ?></td>
</tr>
		<!--START UNDER THE TEXT WIDGETS-->
			<tr>
				<td width="60%" class="chledFirstRow border-right border-left" align="left" valign="top">No. Of Text Widgets</td>
				<?php if(array_key_exists("TextWidgets", $currentOptionData)): ?>
						<td width="20%" class="chledOtherRow border-right" align="left" valign="top"><?php echo $currentOptionData["TextWidgets"]; ?></td>
				<?php else: ?>
						<td width="20%" class="chledOtherRow border-right" align="left" valign="top">0</td>
				<?php endif; ?>

				<?php if(array_key_exists("TextWidgets", $optionData)): ?>
						<td width="20%" class="chledOtherRow border-right" align="left" valign="top"><?php echo $optionData["TextWidgets"]; ?></td>
				<?php else: ?>
						<td width="20%" class="chledOtherRow border-right" align="left" valign="top">0</td>
				<?php endif; ?>
			</tr>
		<!--END UNDER THE TEXT WIDGETS-->
<tr>
	<td width="60%" class="fldrowbg border-right border-left" align="left" valign="top">Manage Body Background</td>
	<td width="20%" class="fldrowbg border-right" align="left" valign="top"><?php echo $currentThemeData->getBodyBackground(); ?></td>
	<td width="20%" class="fldrowbg border-right" align="left" valign="top"><?php echo $selectedTheme->getBodyBackground(); ?></td>
</tr>
</table>