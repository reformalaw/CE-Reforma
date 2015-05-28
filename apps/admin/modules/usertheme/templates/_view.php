<?php $optionData =  $sf_data->getRaw('optionData'); ?>

<div class="viewThemePopup">
	<div class="themeDetails">
		<ul>
			<li><label>Name:</label> <?php echo $form->getName(); ?> </li>
			<li><label>Description:</label> <?php echo nl2br($form->getFeatures()); ?> </li>
			<li><label>Possible Customization:</label> 
				<ul>
					<?php if($form->getManageTopMenu() == 'Yes'): ?>
						<li>Manage Top Menu</li>
					<?php endif; ?>

					<?php if($form->getManageFooterMenu() == 'Yes'): ?>
						<li>Manage Footer Menu</li>
					<?php endif; ?>
					
					<?php if($form->getManageBanner() == 'Yes'): 
							$manageBannerNumber = 0;
							if(array_key_exists("ManageBanner",$optionData))
								$manageBannerNumber = $optionData["ManageBanner"];
					?>
						<li>		<?php   echo "Manage Banner ( Number of banner title: ".$manageBannerNumber;
											if(array_key_exists("BannerBackground",$optionData))
											{
												if($optionData["BannerBackground"] == 'Yes')
												{
													echo " , Banner Background";
												}
											}
									
											if(array_key_exists("BannerForeground",$optionData))
											{
												if($optionData["BannerForeground"] == 'Yes')
												{
													echo " , Banner Foreground";
												}
											}
									echo ")";
								?>
						</li>
					<?php endif; ?>
					
					<?php if($form->getManageColorAndBackground() == 'Yes'): ?>
						<li>Manage Color & Background</li>
					<?php endif; ?>

					<?php if($form->getManageSocialMedia() == 'Yes'): ?>
						<li>Manage Social Media</li>
					<?php endif; ?>
					
					<?php if($form->getChangeLogo() == 'Yes'): ?>
						<li>Change Logo</li>
					<?php endif; ?>
					
					<?php if($form->getManageFAQs() == 'Yes'): ?>
						<li>Manage FAQs</li>
					<?php endif; ?>
					
					<?php if($form->getTextWidgets() == 'Yes'): ?>
						<li>
							<?php echo "Text Widgets ( Number of text widgets: ".$optionData["TextWidgets"]." )";?>
						</li>
					<?php endif; ?>
					
					<?php if($form->getBodyBackground() == 'Yes'): ?>
						<li>Manage Body Background</li>
					<?php endif; ?>
				</ul>
			</li>
		</ul>
	</div>
	<div class="themeImg">
		<?php if(!file_exists(sfConfig::get('sf_upload_dir')."/Theme/".$form->getScreenshot())):?>
			<?php $imageResizePath = $ssSiteUrl."/resizeimage.php?image=images/admin/noImage.jpeg&width=550"; ?>
				<img src="<?php echo $imageResizePath; ?>"  />
		<?php else:  ?>
			<?php $imageResizePath = $ssSiteUrl."/resizeimage.php?image=uploads/Theme/".$form->getScreenShot().'&width=550'; ?>
				<img src="<?php echo $imageResizePath; ?>"  />
		<?php endif; ?>
	</div>
</div>