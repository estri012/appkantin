<form method="post" action="app/grafik_mingguan">
	<label>Dari Tanggal </label>
    <div class="form-group">
    <input type="date" name="tanggal1" value="<?php echo isset($_POST['tanggal1']) ? $_POST['tanggal1'] : '' ?>" />
	</div>
	<label>Sampal Tanggal </label>
    <div class="form-group">
    <input type="date" name="tanggal2" value="<?php echo isset($_POST['tanggal2']) ? $_POST['tanggal2'] : '' ?>" />
	</div>
    <button type="submit" class="btn btn-success" >Tampilkan</button>>
    <form>
</div>

<div class="container">
    <canvas id="myChart"></canvas>
  </div>
 
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script type="text/javascript">
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
          <?php
            if (count($grafikmingguan)>0) {
              foreach ($grafikmingguan as $data) {
                echo "'" .$data->nama_tenant ."',";
              }
            }
          ?>
        ],
        datasets: [{
            label: 'Total Penjualan',
            backgroundColor: '#ADD8E6',
            borderColor: '##93C3D2',
            data: [
              <?php
                if (count($grafikmingguan)>0) {
                   foreach ($grafikmingguan as $data) {
                    echo $data->total . ", ";
                  }
                }
              ?>
            ]
        }]
    },
});
  </script>
  </body>
</html>





