<h4>Areas of Practice</h4>
<ul>
   <?php if(!empty($practiceAreaArr)) { ?>
		<?php if(count($practiceAreaArr)<= 18): ?>
			<?php for($i=0; $i<count($practiceAreaArr); $i++) {?>
					<?php $practiceTitle = $practiceAreaArr[$i]['Title']; ?>
					<?php if(strlen($practiceAreaArr[$i]['Title']) > 29){ $practiceTitle = substr($practiceAreaArr[$i]['Title'], 0, 27); $practiceTitle = $practiceTitle.'...'; } ?>
				<li><?php echo link_to($practiceTitle,'/practice-area/'.$practiceAreaArr[$i]['Slug'],array('title' => $practiceAreaArr[$i]['Title']))?></li>
			<?php }  ?>
       <?php elseif(count($practiceAreaArr) > 18): ?>
			<?php for($i=0; $i<18; $i++) {?>
				<?php $practiceTitle = $practiceAreaArr[$i]['Title']; ?>
				<?php if(strlen($practiceAreaArr[$i]['Title']) > 29){ $practiceTitle = substr($practiceAreaArr[$i]['Title'], 0, 27); $practiceTitle = $practiceTitle.'...'; } ?>
				<li><?php echo link_to($practiceTitle,'/practice-area/'.$practiceAreaArr[$i]['Slug'],array('title' => $practiceAreaArr[$i]['Title']))?></li>
			<?php }  ?>
       <?php endif;?>
   <?php } ?>
</ul>