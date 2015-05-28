<?php if(count($sf_data->getRaw('countyCombo')) > 0  )  { #clsCommon::pr($sf_data->getRaw('countyCombo'));?>

    <script type="text/javascript">
    $(function () {
        $("#headersearch_DefaultCounty").selectbox();
    });

    $("#county_dropdown > div > ul.sbOptions > li:last a").css('border-bottom','0'); // Remove CSS from Legal Professional Box County Dropdown
    </script>
    
    <select id="headersearch_DefaultCounty" name="headersearch[DefaultCounty]" style="border-bottom:0;">
         <?php  
         echo '<option value="0">Select County</option>';
         foreach ($countyCombo as $key => $value){
             echo '<option value="'.$key.'">'.$value.'</option>';

            }?> 
    </select>

<?php } else { ?>
<?php } ?> 