






<script src='js/Chart.min.js'></script>

<canvas id="income" width="900" height="400"></canvas>

<script>
var barData = {
labels : ["2014-2015","2015-2016","2016-2017","2017-2018","2018-2019","2019-2020","2020-2021","2021-2022","2022-2023","2023-2024","2024-2025"],
datasets : [
  {
    fillColor : "rgba(73,188,170,0.4)",
    strokeColor : "rgba(72,174,209,0.4)",
    data : [

    <?php
    $slctsy = $db->query("select * from sy");
    while ($rows = $slctsy->fetch_assoc()) {
      $studcount = $rows['studcount'];
      echo "$studcount,";
      }
    ?>
    ]
  }

]
}
var income = document.getElementById("income").getContext("2d");
new Chart(income).Bar(barData);

</script>
