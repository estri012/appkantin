<div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('saldo/create'),'Buat Baru', 'class="btn btn-primary"'); ?>
            </div>
            
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('saldo/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('saldo'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        <th>No Kartu</th>
        <th>Nama Pelanggan</th>
        <th>Saldo</th>
        <th>Pengeluaran</th>
        
        <th>Action</th>
            </tr><?php
            foreach ($saldo_data as $saldo)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $saldo->no_pelanggan ?></td>
            <td><?php 
            $sql = $this->db->query("SELECT * FROM pelanggan where no_pelanggan='$saldo->no_pelanggan' ")->row();
            echo $sql->nama;
             ?></td>
            
            <td><?php
            // $saldo_tambahan = 0; 
            // $detail_saldo = $this->db->query("SELECT * FROM detail_saldo WHERE no_pelanggan='$saldo->no_pelanggan'");
            // foreach ($detail_saldo->result() as $d) {
            //     $saldo_tambahan = $saldo_tambahan + $d->saldo_tambahan;
            // }
            // $total_saldo = $saldo->saldo + $saldo_tambahan;
            // echo number_format($total_saldo) 
            echo number_format($saldo->saldo)?></td>
            <td><?php echo number_format($saldo->pengeluaran) ?></td>
            
            <td style="text-align:center" width="200px">
                <a href="app/cetak_saldo/<?php echo $saldo->no_pelanggan ?>" target="_blank">Cetak Saldo</a>
                <?php 
                //echo anchor(site_url('app/cetak_saldo/'.$saldo->no_pelanggan),'Cetak Saldo'); 
                echo ' | '; 
                echo anchor(site_url('saldo/update/'.$saldo->id_saldo),'Update'); 
                echo ' | '; 
                echo anchor(site_url('saldo/delete/'.$saldo->id_saldo),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                ?>
            </td>
        </tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
                <a href="app/riwayat_saldo"  class="btn btn-info">Riwayat</a>
                <a href="app/export_saldo" target="_blank" class="btn btn-danger">Export</a>
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>