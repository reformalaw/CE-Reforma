<div class="middle-right"><h2>Areas of Practice</h2>
	<ul>
	   <?php if(!empty($practiceAreaArr)) { ?>
	       <?php for($i=0; $i<count($practiceAreaArr); $i++) {?>
	           <li><?php echo link_to($practiceAreaArr[$i]['Title'],'/practice-area/'.$practiceAreaArr[$i]['Slug'])?></li>
	       <?php }  ?>
	       
	   <?php }   	       ?>
    </ul>
</div>