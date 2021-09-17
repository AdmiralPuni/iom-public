<style>
    .detail tr td:nth-child(5) form{
        min-width:400px;
        display:inline;
    }
</style>
<tr>
    <td class="content">
        <h1>INTERNAL MEMO</h1>
        <hr>
        <table class="description">
            <tr>
                <td>Tanggal</td>
                <td><?= date("Y-m-d"); ?></td>
            </tr>
            <tr>
                <td>Nomor Order</td>
                <td><?= $data[0]->noiom ?></td>
            </tr>
            <tr>
                <td>Nama Pemohon</td>
                <td><?= $data[0]->nmuser ?></td>
            </tr>
            <tr>
                <td>Departemen</td>
                <td><?= $data[0]->nmdept ?></td>
            </tr>
            
            <tr>
                <td>Keterangan</td>
                <td><?= $data[0]->ket ?></td>
            </tr>

            <tr>
                <td>Update</td>
                <td><form action="<?= site_url('iom/update'); ?>" method="POST">
                    <input type="hidden" id="noiom" name="noiom" value="<?= $data[0]->noiom ?>">
                    NIK : <input type="text" id="kduser" name="kduser">
                    Ket : <input type="text" id="ket" name="ket">
                    <input type="submit" value="UPDATE">
                </form></td>
            </tr>
            <tr>
                <td>Delete</td>
                <td><form onsubmit="return confirm('Delete <?= $data[0]->noiom ?>?')" action="<?= site_url('iom/delete') ?>" method="POST"> 
                        <input type="hidden" id="noiom" name="noiom" value="<?= $data[0]->noiom ?>">
                        <input type="submit"  value="DELETE"> 
                    </form>
                </td>
            </tr>
            <tr>
                <td>Tambah item</td>
                <td><form action="<?= site_url('iom/add_item'); ?>" method="POST">
                    <input type="hidden" id="noiom" name="noiom" value="<?= $data[0]->noiom ?>">
                    Kode Item : <input type="text" id="kditem" name="kditem">
                    <input type="submit" value="INSERT ITEM">
                </form></td>
            </tr>
        </table>
        <h1>DETAIL INTERNAL MEMO</h1>
        <hr>
        <table class="detail">
            <tr class="iomlist">
                <td>Departemen</td>
                <td>Approval 1</td>
                <td>Approval 2</td>
                <td>Tanggal Selesai</td>
                <td></td>
            </tr>
            <?php foreach ($details as $row) { ?>
                <tr class="listiom">
                    <td><?php echo $row->nmitem; ?></td>
                    <?php 
                        echo '<td ';
                            if($row->stsiom == 3 || $row->stsiom-1 == 0 || $row->stsiom-1 == 2){
                                echo 'class="approved">APPROVED';
                            }
                            else{
                                echo 'class="waiting">WAITING';
                            } 
                        ?>
                        </td>
                    <?php 
                        echo '<td ';
                            if($row->stsiom == 3 || $row->stsiom-2 == 0 || $row->stsiom-2 == 1){
                                echo 'class="approved">APPROVED';
                            }
                            else{
                                echo 'class="waiting">WAITING';
                            } 
                        ?></td>
                        <td>
                        <?php
                            if($row->tglselesai==NULL){
                                echo 'BELUM SELESAI';
                            }
                            else{
                                echo $row->tglselesai;
                            }
                        ?>
                        </td>
                    <td>
                    <?php 
                        if($_SESSION['nmuser'] == 'admin'){
                            if($row->stsiom == 3 || $row->stsiom-1 == 0 || $row->stsiom-1 == 2){
                                ?> 
                                    <form action="<?= site_url('iom/disapprove_item'); ?>" method="POST">
                                        <input type="hidden" id="noiom" name="noiom" value="<?= $row->noiom ?>">
                                        <input type="hidden" id="kditem" name="kditem" value="<?= $row->kditem ?>">
                                        <input type="hidden" id="approval" name="approval" value=1>
                                        <input type="submit" value="CANCEL - 1">
                                    </form>
                                 <?php 
                            }
                            else{
                                ?>
                                    <form action="<?= site_url('iom/approve_item'); ?>" method="POST">
                                        <input type="hidden" id="noiom" name="noiom" value="<?= $row->noiom ?>">
                                        <input type="hidden" id="kditem" name="kditem" value="<?= $row->kditem ?>">
                                        <input type="hidden" id="approval" name="approval" value=1>
                                        <input type="submit" value="APPROVE - 1">
                                    </form>
                                 <?php 
                            }

                            if($row->stsiom == 3 || $row->stsiom-2 == 0 || $row->stsiom-2 == 1){
                                ?> 
                                    <form action="<?= site_url('iom/disapprove_item'); ?>" method="POST">
                                        <input type="hidden" id="noiom" name="noiom" value="<?= $row->noiom ?>">
                                        <input type="hidden" id="kditem" name="kditem" value="<?= $row->kditem ?>">
                                        <input type="hidden" id="approval" name="approval" value=2>
                                        <input type="submit" value="CANCEL - 2">
                                    </form>
                                 <?php 
                            }
                            else{
                                ?> 
                                    <form action="<?= site_url('iom/approve_item'); ?>" method="POST">
                                        <input type="hidden" id="noiom" name="noiom" value="<?= $row->noiom ?>">
                                        <input type="hidden" id="kditem" name="kditem" value="<?= $row->kditem ?>">
                                        <input type="hidden" id="approval" name="approval" value=2>
                                        <input type="submit" value="APPROVE - 2">
                                    </form>
                                 <?php 
                            }
                            ?>
                                <form onsubmit="return confirm('Delete <?= $row->kditem ?>?')" action="<?= site_url('iom/delete_item') ?>" method="POST"> 
                                    <input type="hidden" id="noiom" name="noiom" value="<?= $row->noiom ?>">
                                    <input type="hidden" id="kditem" name="kditem" value="<?= $row->kditem ?>">
                                    <input type="submit"  value="DELETE"> 
                                </form>
                            <?php
                        }
                        else if($_SESSION['stsappr'] == 2){
                            if($row->stsiom == 3 || $row->stsiom-2 == 0 || $row->stsiom-2 == 1){
                                ?> 
                                    <form action="<?= site_url('iom/disapprove_item'); ?>" method="POST">
                                        <input type="hidden" id="noiom" name="noiom" value="<?= $row->noiom ?>">
                                        <input type="hidden" id="kditem" name="kditem" value="<?= $row->kditem ?>">
                                        <input type="submit" value="Cancel">
                                    </form>
                                 <?php 
                            }
                            else{
                                ?> 
                                    <form action="<?= site_url('iom/approve_item'); ?>" method="POST">
                                        <input type="hidden" id="noiom" name="noiom" value="<?= $row->noiom ?>">
                                        <input type="hidden" id="kditem" name="kditem" value="<?= $row->kditem ?>">
                                        <input type="submit" value="Approve">
                                    </form>
                                 <?php 
                            }
                        }
                        else if($_SESSION['stsappr'] ==1 ){
                            if($row->stsiom == 3 || $row->stsiom-1 == 0 || $row->stsiom-1 == 2){
                                ?> 
                                    <form action="<?= site_url('iom/disapprove_item'); ?>" method="POST">
                                        <input type="hidden" id="noiom" name="noiom" value="<?= $row->noiom ?>">
                                        <input type="hidden" id="kditem" name="kditem" value="<?= $row->kditem ?>">
                                        <input type="submit" value="Cancel">
                                    </form>
                                 <?php 
                            }
                            else{
                                ?>
                                    <form action="<?= site_url('iom/approve_item'); ?>" method="POST">
                                        <input type="hidden" id="noiom" name="noiom" value="<?= $row->noiom ?>">
                                        <input type="hidden" id="kditem" name="kditem" value="<?= $row->kditem ?>">
                                        <input type="submit" value="Approve">
                                    </form>
                                 <?php 
                            }
                        }
                        else{
                            
                        }
                        
                    ?>
                    </td>
                </tr>
            <?php
            }?>
        </table>
    </td>
</tr>