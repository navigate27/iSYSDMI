<style type="text/css">

#placeholder2 {
  width: 400px;
  height: 350px;
}

</style>
<!-- <script src="bower_components/flot/jquery.flot.js"></script>
<script src="bower_components/flot/jquery.flot.pie.js"></script> -->
<script type="text/javascript">
$(function() {

  var old = $('#hid-old').val();
  var newStud = $('#hid-new').val();
  // var allStudents = male+fmale;

  var data = [
    { label: "Old ("+old+")",  data: old , color: "#779ca4" },
    { label: "New ("+newStud+")",  data: newStud , color: "#1eeed9"}
  ];

  var placeholder = $("#placeholder2");

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
    <div id="placeholder2" class="demo-placeholder"></div>
