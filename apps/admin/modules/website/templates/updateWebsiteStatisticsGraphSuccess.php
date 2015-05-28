<?php echo $sf_params->get('BtnDay').' '.$sf_params->get('DayType') ?>
<?php if( count($statisticsDetail) >= 1):?>
<!--Graph Section-->
<div id="graph"></div>
<pre id="code" class="prettyprint linenums" style="display:none;">
<script>
    var day_data = [
                <?php foreach($statisticsDetail as $statistics): ?>
                    <?php //if($statistics['WebsiteId'] == 1 ):?>
                        { year: '<?php echo $statistics["VisitDate"]; ?>', value: '<?php echo $statistics["TotalVisit"]?>' },
                    <?php //endif; ?>
                <?php endforeach; ?>
            ];

    Morris.Line({
            element: 'graph',
            data: day_data,
            xkey: 'year',
            ykeys: ['value'],
            labels: ['Total Visits'],
    });
</script>
</pre>
<!--Graph Section End-->
<?php else:
 echo "<br/> <br/> <b>". sfConfig::get('app_Statistics_no_visit')."</b>";
 endif;
?>
