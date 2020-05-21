<form id = "myform" action="<?php echo $action; ?>" method="post">
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
	<button type="submit" formaction="app/grafik_kantin_bulanan" class="btn btn-success">Tampilkan</button>
	</div>
</form>
  

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
            if (count($gkbulanan)>0) {
              foreach ($gkbulanan as $data) {
                
                echo "'" .$data->bulan ."',";
              }
            }
          ?>
        ],
        datasets: [{
            label: 'Total Pendapatan',
            backgroundColor: '#ADD8E6',
            borderColor: '##93C3D2',
            data: [
              <?php
                if (count($gkbulanan)>0) {
                   foreach ($gkbulanan as $data) {
    
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