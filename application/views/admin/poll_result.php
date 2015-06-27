<section id="main" class="container" >
    <header>
        <h3 style="margin-bottom:0px;">Poll Results</h3>
    </header>
    <div class="row">
        <?php
        $i = 1;
        foreach ($query as $ro) {
            //100 * round($ro['poll_c1'] / ($ro['pollsum']), 2) -> calculate percentage
            //if ($ro['op3'] != 'NULL')
            ?>

<script type="text/javascript">
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer",
	{
		title:{
			text: "<?php echo $ro['ques']?>"
		},
                animationEnabled: true,
		legend:{
			verticalAlign: "bottom",
			horizontalAlign: "center"
		},
		data: [
		{        
			indexLabelFontSize: 20,
			indexLabelFontFamily: "Monospace",       
			indexLabelFontColor: "darkgrey", 
			indexLabelLineColor: "darkgrey",        
			indexLabelPlacement: "outside",
			type: "pie",       
			showInLegend: true,
			toolTipContent: "{y} - <strong>#percent%</strong>",
			dataPoints: [
				{  y: <?php echo $ro['poll_c1']?>, legendText:"<?php echo $ro['op1']?>", indexLabel: "<?php echo $ro['op1']?>" },
				{  y: <?php echo $ro['poll_c2']?>, legendText:"<?php echo $ro['op2']?>", indexLabel: "<?php echo $ro['op2']?>" },
				{  y: <?php echo $ro['poll_c3']?>, legendText:"<?php echo $ro['op3']?>",exploded: true, indexLabel: "<?php echo $ro['op3']?>" },
				{  y: <?php echo $ro['poll_c4']?>, legendText:"<?php echo $ro['op4']?>" , indexLabel: "<?php echo $ro['op4']?>"}
			]
		}
		]
	});
	chart.render();
}
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/canvasjs.min.js"></script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
</body>
        <?php $i++; }
        ?>
    </div>
</section>