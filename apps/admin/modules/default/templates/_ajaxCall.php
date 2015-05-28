<?php 
$maxsessionlimit = ini_get('session.gc_maxlifetime')*1000;
$maxsessionlimit = $maxsessionlimit - 300000;
#$maxsessionlimit = 1000;
?> 
<script language="javascript" type="text/javascript">
setInterval("ajaxCall();", <?php echo $maxsessionlimit; ?>);

function ajaxCall(){
    $.ajax({
        type: 'POST',
        url:'<?php echo url_for('default/ajaxCall',true); ?>',
        success: function(html){ }
    });
}
</script>