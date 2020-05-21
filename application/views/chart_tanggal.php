 
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
            if (count($graphtanggal)>0) {
              foreach ($graphtanggal as $data) {
                
                echo "'" .$data->tgl_penjualan ."',";
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
                if (count($graphtanggal)>0) {
                   foreach ($graphtanggal as $data) {
    
                    echo $data->jumlah . ", ";
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