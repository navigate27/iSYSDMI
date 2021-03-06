<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Chart.js demo</title>
        <script src='Chart.min.js'></script>
    </head>
    <body>

			<canvas id="income" width="600" height="400"></canvas>

		<script>
		var barData = {
			labels : ["January","February","March","April","May","June"],
			datasets : [
				{
					fillColor : "#48A497",
					strokeColor : "#48A4D1",
					data : [456,479,324,569,702,600]
				},
				{
					fillColor : "rgba(73,188,170,0.4)",
					strokeColor : "rgba(72,174,209,0.4)",
					data : [364,504,605,400,345,320]
				}

			]
		}
		var income = document.getElementById("income").getContext("2d");
		new Chart(income).Bar(barData);

		</script>

    </body>


</html>
