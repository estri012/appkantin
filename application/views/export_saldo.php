<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=saldo.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

 <table >
            <tr>
        <th>No Pelanggan</th>
        <th>Nama Pelanggan</th>
        <th>Saldo</th>
        <th>Pengeluaran</th>
            </tr><?php
            $saldo_data = $this->db->get('saldo');
            foreach ($saldo_data->result() as $saldo)
            {
                ?>
                <tr>
            <td><?php echo $saldo->no_pelanggan ?></td>
            <td><?php 
            $sql = $this->db->query("SELECT * FROM pelanggan where no_pelanggan='$saldo->no_pelanggan' ")->row();
            echo $sql->nama;
             ?></td>
            <td><?php
            $saldo_tambahan = 0; 
            $detail_saldo = $this->db->query("SELECT * FROM detail_saldo WHERE no_pelanggan='$saldo->no_pelanggan'");
            foreach ($detail_saldo->result() as $d) {
                $saldo_tambahan = $saldo_tambahan + $d->saldo_tambahan;
            }
            $total_saldo = $saldo->saldo + $saldo_tambahan;
            echo number_format($total_saldo) ?></td>
            <td><?php echo number_format($saldo->pengeluaran) ?></td>
        
        </tr>
                <?php
            }
            ?>
        </table>