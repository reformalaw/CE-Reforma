<option value="">Select Case No</option>
<?php	
if(isset($caseArr) && !empty($caseArr)) {

    foreach($caseArr as $key => $val) { ?>
        <option value="<?php echo $key;?>"><?php echo $val;?></option>
    <?php } ?>

<?php } ?>
