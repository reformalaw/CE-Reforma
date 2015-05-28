<?php use_helper('sfCryptoCaptcha');?>    

<?php /* User Custom Contact Form */ ?>

<?php if($sf_user->hasFlash('succMsg')) { ?>
	<div style="margin-top:100px;">
			<?php include_partial('default/message'); ?>
		</div>
    <!--<table width="100%">
		<tr align="center" valign="top" id="msg">
			<td colspan="2" class="ListAreaPad">
				<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
					<td class="success" align="center"><?php //echo $sf_user->getFlash('succMsg');?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr id="msg2">
			<td height="15" align="left" valign="top">&nbsp;</td>
		</tr>
    </table>		-->
<?php } else { ?>

    <?php if($customForm == true) { ?>
        <?php include_partial('attorneyform', array('form' => $form , 'UserId' => $UserId,'customerDatas'=>$customerDatas));  ?>
    <?php } ?>
    
    <?php if($defaultform == true) { ?>
        <?php include_partial('defaultform', array('form' => $form , 'UserId' => $UserId));  ?>
    <?php } ?>

    
<?php } ?>    

<script language="javascript">
<?php if($sf_user->hasFlash('succMsg')): ?>
    setTimeout("parent.jQuery.fancybox.close()",4000); // wait for 5 seconds...
<?php endif; ?>
</script>
