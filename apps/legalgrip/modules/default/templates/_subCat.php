<?php if(count($sf_data->getRaw('subCatCombo')) > 0  )  { #clsCommon::pr($sf_data->getRaw('subCatCombo'));?>

    <script type="text/javascript">
    $(function () {
        $("#headersearch_SubPracticeArea").selectbox();
    });

    </script>
    
    <select id="headersearch_SubPracticeArea" name="headersearch[SubPracticeArea]" style="border-bottom:0;">
         <?php  
         echo '<option value="0">Select</option>';
         foreach ($subCatCombo as $key => $value){
             echo '<option value="'.$key.'">'.$value.'</option>';

            }?> 
    </select>
    
    <script language="javascript">
    $(document).ready(function()
    {

        $("#subPracticeArea > div > ul.sbOptions > li:last a").css('border-bottom','0'); // Remove CSS from Legal Professional Box Sub category

        $("#headersearch_SubPracticeArea").change(function() {

            var cid= $(this).val();
            /*if(cid=='select'){
            return false;
            }*/
            $.ajax( {
                type: "POST",
                url: "<?php echo url_for('default/subCatSelection'); ?>",
                data : { parentId : cid},
                beforeSend: function(){

                },
                success: function(output){
                    $("#childPracticeArea").html(output);
                }
            });
        });


    });
    </script>         


<?php } else { ?>
    <script language="javascript" type="text/javascript">
      //  $("#subPracticeArea").html();
    </script>
<?php } ?> 