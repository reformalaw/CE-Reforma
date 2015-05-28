<?php if(count( $sf_data->getRaw('subICatCombo') ) > 0 ) {?>
<script type="text/javascript">
$(function () {
    $("#content_3").mCustomScrollbar({
        scrollButtons:{
            enable:true
        }
    });

});
</script>

<div id="content_3" class="content">
    <?php if(!empty($subICatCombo)) { ?> 
         <ul>         		    
            <?php foreach ($subICatCombo as $key => $value){?>
                 <li><a href="javascript:void(0);" onclick="setChildCategoryValue('<?php echo $key ;?>',this)" ><?php echo $value; ?></a></li>
            <?php } ?> 
        </ul>
    <?php } ?>
</div>

<?php } ?>