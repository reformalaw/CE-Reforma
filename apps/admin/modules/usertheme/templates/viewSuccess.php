<table>
	<?php /*
	<tr align="right">
		<?php if($view->getId() != $snThemeId): ?>
				<?php  if($view->getStatus()=="Active"): ?>
					<td width="110" class="LinkImg" style="padding-right: 30px">
						<a onClick="return setThemeConfirmation();" href="<?php echo url_for("usertheme/updateTheme?themeId=".$view->getId());?>" title= "Click To Set As Current Theme"><?php echo image_tag("admin/Icon_default.png", array("alt"=>"Set Default","title"=>"Click To Set Current Theme","border"=>"0","style"=>"padding-right: 30px" )) ?><br />Set As Current Theme</a>
					</td>
				<?php endif; ?>
			<?php endif; ?>
	</tr>
	*/ ?>
	<tr>
		<td align="center" valign="top" width="98%">
			<?php include_partial('view', array('form' => $view,'optionData'=>$optionData,'ssSiteUrl'=>$ssSiteUrl)) ?>
		</td>
	</tr>
</table>