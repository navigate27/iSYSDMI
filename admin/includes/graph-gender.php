	<style type="text/css">

	#placeholder {
		width: 400px;
		height: 350px;
	}

	</style>
  <script src="bower_components/flot/jquery.flot.js"></script>
  <script src="bower_components/flot/jquery.flot.pie.js"></script>
	<script type="text/javascript">
	$(function() {

    var male = $('#hid-male').val();
    var fmale = $('#hid-fmale').val();
    var allStudents = male+fmale;

		var data = [
			{ label: "Male ("+male+")",  data: male , color: "#2f7dff" },
			{ label: "Female ("+fmale+")",  data: fmale , color: "#fab9ff"}
		];

		var placeholder = $("#placeholder");

			placeholder.unbind();

			$.plot(placeholder, data, {
				series: {
					pie: {
						show: true,
            radius: 1,
            label: {
                show: true,
                radius: 3/4,
                formatter: labelFormatter,
                background: {
                    opacity: 0.5,
                    color: '#000'
                }
            }
					}
				},
        legend: {
            show: true
        },
        grid: {
            hoverable: true,
            clickable: true
        }
			});

      function labelFormatter(label, series) {
        return "<div style='font-family:Helvetica,Arial,sans-serif; font-size:12pt; text-align:center; padding:10px; color:white;'>" + Math.round(series.percent) + "%</div>";
      }

	});
	</script>
			<div id="placeholder" class="demo-placeholder"></div>
