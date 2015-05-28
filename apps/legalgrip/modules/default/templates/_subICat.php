<?php if(count($sf_data->getRaw('subICatCombo')) > 0  )  { #clsCommon::pr($sf_data->getRaw('$subICatCombo'));?>

    <script type="text/javascript">
    $(function () {
        $("#headersearch_ChildPracticeArea").selectbox();
    });
    </script>
    
    
    <select name="headersearch[ChildPracticeArea]" id="headersearch_ChildPracticeArea">
        <?php  
        echo '<option value="0">Select</option>';
        foreach ($subICatCombo as $key => $value){
            echo '<option value="'.$key.'">'.$value.'</option>';

        }?> 
    </select>
    
    <script language="javascript">
    $(document).ready(function() {
        $("#childPracticeArea > div > ul.sbOptions > li:last a").css('border-bottom','0'); // Remove CSS from Legal Professional Box Sub category
    });
    </script>     
    
<?php } ?>