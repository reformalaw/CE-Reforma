<h4>Areas of Practice</h4>
<ul>
		<?php if(count($practiceAreaArr)<= 18): ?>
			<?php for($i=0; $i<count($practiceAreaArr); $i++) {?>
					<?php $practiceTitle = $practiceAreaArr[$i]['Title']; ?>
					<?php if(strlen($practiceAreaArr[$i]['Title']) > 37){ $practiceTitle = substr($practiceAreaArr[$i]['Title'], 0, 34); $practiceTitle = $practiceTitle.'...'; } ?>
				<li><?php echo link_to($practiceTitle,'/practice-area/'.$practiceAreaArr[$i]['Slug'],array('title' => $practiceAreaArr[$i]['Title']))?></li>
			<?php }  ?>
       <?php endif;?>
</ul>