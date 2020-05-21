


<form method="post" action="app/grafik_harian">
		<label>Tanggal </label>
    <div class="form-group" id="form">
    <input type="date" name="tanggal" value="<?php echo isset($_POST['tanggal']) ? $_POST['tanggal'] : '' ?>" />
		</div>
    <button type="submit" class="btn btn-success"  >Tampilkan</button>
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
            if (count($grafikharian)>0) {
              foreach ($grafikharian as $data) {
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
                if (count($grafikharian)>0) {
                   foreach ($grafikharian as $data) {
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





