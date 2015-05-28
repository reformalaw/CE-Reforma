<?php
$target = '/home/counceledge/public_html/web/uploads/Media';
$link = '/home/counceledge/public_html/web/uploads/pages/55/Media';
symlink($target, $link);

echo readlink($link);
?>
