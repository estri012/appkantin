


<form action="<?php echo $action; ?>" method="post">
<div class="form-group">
            <label>Tahun </label>
            <select name="tahun" class="form-control" >
			<?php
			$mulai= date('Y') - 50;
			for($i = $mulai;$i<$mulai + 100;$i++){
    		$sel = $i == date('Y') ? ' selected="selected"' : '';
   			 echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';}?>
            </select>
        </div>
	<div class="form-group">
	<button type="submit" formaction="app/grafik_tahunan" class="btn btn-success">Tampilkan</button>
	</div>
</form>
</div>

<div class="container">
    <canvas id="myChart" ></canvas>
  </div>
 
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script type="text/javascript">
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
          <?php
            if (count($grafiktahunan)>0) {
              foreach ($grafiktahunan as $data) {
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
                if (count($grafiktahunan)>0) {
                   foreach ($grafiktahunan as $data) {
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





