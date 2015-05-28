<?php if(count( $sf_data->getRaw('subCatCombo') ) > 0 ) {  ?>
<script type="text/javascript">
$(function () {
    $("#content_2").mCustomScrollbar({
        scrollButtons:{
            enable:true
        }
    });

});
</script>

<div id="content_2" class="content">
    <?php if(!empty($subCatCombo)) { ?> 
         <ul>         		    
            <?php foreach ($subCatCombo as $key => $value){?>
                 <li><a href="javascript:void(0);" onclick="getChildCategory('<?php echo $key ;?>', this)" ><?php echo $value; ?></a></li>
            <?php } ?> 
        </ul>
    <?php } ?>
</div>

<?php } ?>