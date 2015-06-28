<section id="main" class="container" >
    <header>
        <h3 style="margin-bottom:0px;">Poll Results</h3>
    </header>
    <div class="row">

    <button onclick="chart()">Click me now!</button><br><script>
<script type="text/javascript">
function chart() {
	var chart = new CanvasJS.Chart("chartContainer",
	{
		title:{
			text: "<?php echo $ques ?>"
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
				{  y: <?php echo $poll_c1?>, legendText:"<?php echo $op1?>", indexLabel: "<?php echo $op1?>" },
				{  y: <?php echo $poll_c2?>, legendText:"<?php echo $op2?>", indexLabel: "<?php echo $op2?>" },
				{  y: <?php echo $poll_c3?>, legendText:"<?php echo $op3?>",exploded: true, indexLabel: "<?php echo $op3?>" },
				{  y: <?php echo $poll_c4?>, legendText:"<?php echo $op4?>" , indexLabel: "<?php echo $op4?>"}
			]
		}
		]
	});
	chart.render();
};
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/canvasjs.min.js"></script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
</body>
    </div>
</section>