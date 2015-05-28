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
			<li><label>Created Date:</label> <?php echo date('Y-m-d',strtotime($form->getCreateDateTime()))?> </li>
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

<?php /*
<?php
$optionData = $sf_data->getRaw("optionData");

?>
<tr valign="top">
 <td colspan="2" class="ListAreaPad">
  <table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">

  </table>
 </td>
</tr>
<tr valign="top">
 <td colspan="2" class="ListAreaPad">
 <input type="hidden" name="sf_method" value="put" />
  <table width="65%" cellspacing="1" cellpadding="1" class="CaseEditForm" align="center">
   <tr class="fldbg">
    <td colspan="2" class="whttxt">Theme Detail</td>
   </tr>
       <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "Name" ?>:</b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo $form->getName(); ?>
      </td>
    </tr>

     <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "Screen Shot" ?>:</b></td>
      <td width="68%" class="fldrowlightbg">
       <?php //echo $form->getScreenShot(); ?>
        <?php echo image_tag(sfConfig::get('app_ThumbnailPath_Thumbpath').$form->getScreenShot(),array('border'=>'0','alt'=>'ScreenShot','title'=>$form->getScreenShot()))?>
      </td>
    </tr>

    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "Description" ?>:</b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo nl2br($form->getFeatures()); ?>
      </td>
    </tr>
	
				<tr>
					<td valign ="Top" width="26%" class="fldrowbg"><b><?php echo "Possible Customization" ?>:</b></td>
					<td width="68%" class="fldrowlightbg">
						<?php 
							echo "</br>";
							if($form->getManageTopMenu() == 'Yes')
							{	?>
								<li style="list-style-position:inside;">
									<?php echo "Manage Top Menu"; ?>
								</li></br>
							<?php 

							}

							if($form->getManageFooterMenu() == 'Yes')
							{
							?>
								<li style="list-style-position:inside;">
									<?php echo "Manage Footer Menu"; ?>
								</li></br>
							<?php 
							}
								
							if($form->getManageBanner() == 'Yes')
							{
							?>
							<li style="list-style-position:inside;">
								<?php
									echo "Manage Banner ( Number of banner title: ".$optionData["ManageBanner"];
										if($optionData["BannerBackground"] == 'Yes')
										{
											echo " , Banner Background";
										}
										if($optionData["BannerForeground"] == 'Yes')
										{
											echo " , Banner Foreground";
										}

									echo " )";?>
							</li></br>
							<?php 
							}

							if($form->getManageColorAndBackground() == 'Yes')
							{
							?>
								<li style="list-style-position:inside;">
									<?php echo "Manage Color & Background";?>
								</li></br>
							<?php 
							}
							
							if($form->getManageSocialMedia() == 'Yes')
							{
							?>
								<li style="list-style-position:inside;">
									<?php echo "Manage Social Media";?>
								</li></br>
							<?php
							}
								
							if($form->getChangeLogo() == 'Yes')
							{
							?>
								<li style="list-style-position:inside;">
									<?php echo "Change Logo";?>
								</li></br>
							<?php
							}
							
							if($form->getManageFAQs() == 'Yes')
							{
							?>
								<li style="list-style-position:inside;">
									<?php echo "Manage FAQs";?>
								</li></br>
							<?php 
							}

							if($form->getTextWidgets() == 'Yes')
							{
							?>
								<li style="list-style-position:inside;">
									<?php echo "Text Widgets ( Number of text widgets: ".$optionData["TextWidgets"]." )";?>
								</li></br>
							<?php
							}
							
						?>
					</td>
				</tr>

    <tr>
      <td width="26%" class="fldrowbg"><b><?php echo "Created Date" ?>:</b></td>
      <td width="68%" class="fldrowlightbg">
       <?php echo date('Y-m-d',strtotime($form->getCreateDateTime()))?>
      </td>
    </tr>

  </table>
  </form>
 </td>
</tr>
*/ ?>