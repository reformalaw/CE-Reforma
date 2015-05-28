<?php if($sf_user->hasFlash('errMsg')) { ?>
<tr align="center" valign="top" id="msg">
    <td colspan="2" class="ListAreaPad">
        <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
            <td class="errormss" align="center" onclick=""><a href="#" id="msg"><?php echo $sf_user->getFlash('errMsg');?></a></td>
          </tr>
        </table>
    </td>
</tr>
<tr id="msg2">
    <td height="15" align="left" valign="top">&nbsp;</td>
</tr>
<?php }?>
<?php if($sf_user->hasFlash('succMsg')) { ?>
<tr align="center" valign="top" id="msg">
    <td colspan="2" class="ListAreaPad">
        <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
		      <td class="success" align="center"><a href="#" id="msg"><?php echo $sf_user->getFlash('succMsg');?></a></td>
            </tr>
		</table>
    </td>
</tr>
<tr id="msg2">
    <td height="15" align="left" valign="top">&nbsp;</td>
</tr>
<?php }?>
<?php if($sf_user->hasFlash('errDocumentMsg')) { ?>
<tr align="center" valign="top" id="msg">
    <td colspan="2" class="ListAreaPad">
        <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
            <td class="errormss" align="center" onclick=""><a href="#" id="msg"><?php echo $sf_user->getFlash('errDocumentMsg');?></a></td>
          </tr>
        </table>
    </td>
</tr>
<tr id="msg2">
    <td height="15" align="left" valign="top">&nbsp;</td>
</tr>
<?php }?>
<script>
/*$("#msg").click(function(event) {
    event.preventDefault();
    $('#msg').hide("slow");
    $('#msg2').hide("slow");
});*/
$(document).ready(function() {
    $('#msg').delay(3000).fadeOut(1000);
    $('#msg2').delay(3000).fadeOut(1000);
});
/*setTimeout(function() {
    $('#msg').hide(4000);
    $('#msg2').hide(4000);
}, 1000); // <-- time in milliseconds*/
</script>