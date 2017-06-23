<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Chart.js demo</title>
        <script src='Chart.min.js'></script>
    </head>
    <body>

			<canvas id="countries" width="600" height="400"></canvas>

		<script>
		var pieData = [
			{
				value: 20,
				color:"#878BB6"
			},
			{
				value : 40,
				color : "#4ACAB4"
			},
			{
				value : 10,
				color : "#FF8153"
			},
			{
				value : 30,
				color : "#FFEA88"
			}
		];
		var pieOptions = {
			segmentShowStroke : false,
			animateScale : false,
		}
		var countries= document.getElementById("countries").getContext("2d");
		new Chart(countries).Pie(pieData, pieOptions);

		</script>



    </body>


</html>
