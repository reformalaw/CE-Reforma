<h2>Areas of Practice</h2>
<ul>
   <?php if(!empty($practiceAreaArr)) { ?>
       <?php for($i=0; $i<count($practiceAreaArr); $i++) {?>
			<?php if(($i+1) == count($practiceAreaArr)): ?>  <!--this condition is for remove the last white line for that put the style in li-->
				<li style=" border-bottom:none;" ><?php echo link_to($practiceAreaArr[$i]['Title'],'/practice-area/'.$practiceAreaArr[$i]['Slug'],array('title' => $practiceAreaArr[$i]['Title']))?></li>
			<?php else: ?>
				<li><?php echo link_to($practiceAreaArr[$i]['Title'],'/practice-area/'.$practiceAreaArr[$i]['Slug'],array('title' => $practiceAreaArr[$i]['Title']))?></li>
			<?php endif; ?>
       <?php }  ?>
   <?php } ?>
</ul>