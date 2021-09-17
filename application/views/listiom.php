<?php 
    include_once("components/menubar.php");
    $month = $this->input->get('month');
    $year = $this->input->get('year');
    $status = $this->input->get('status');
?>
            <tr>
                <td class="content">
                    <h1>INTERNAL MEMO</h1>
                    <hr>
                    <form action="<?= site_url('iom/filter') ?>" method="get">
                        <table class="listiom">
                            <tr>
                                <td>PERIODE</td>
                                <td><select name="month" id="month">
                                    <option value="0" <?php if($month==0){echo 'selected';} ?>>SEMUA BULAN</option>
                                    <option value="1" <?php if($month==1){echo 'selected';} ?>>1 - JANUARI</option>
                                    <option value="2" <?php if($month==2){echo 'selected';} ?>>2 - FERUARI</option>
                                    <option value="3" <?php if($month==3){echo 'selected';} ?>>3 - MARET</option>
                                    <option value="4" <?php if($month==4){echo 'selected';} ?>>4 - APRIL</option>
                                    <option value="5" <?php if($month==5){echo 'selected';} ?>>5 - MEI</option>
                                    <option value="6" <?php if($month==6){echo 'selected';} ?>>6 - JUNI</option>
                                    <option value="7" <?php if($month==7){echo 'selected';} ?>>7 - JULI</option>
                                    <option value="8" <?php if($month==8){echo 'selected';} ?>>8 - AGUSTUS</option>
                                    <option value="9" <?php if($month==9){echo 'selected';} ?>>9 - SEPTEMBER</option>
                                    <option value="10" <?php if($month==10){echo 'selected';} ?>>10 - OKTOBER</option>
                                    <option value="11" <?php if($month==11){echo 'selected';} ?>>11 - NOVEMBER</option>
                                    <option value="12" <?php if($month==12){echo 'selected';} ?>>12 - DESEMBER</option>
                                </select></td>
                                <td><select name="year" id="year">
                                    <option value="0" <?php if($year==0){echo 'selected';} ?>>SEMUA TAHUN</option>
                                    <option value="2000" <?php if($year==2000){echo 'selected';} ?>>2000</option>
                                    <option value="2020" <?php if($year==2020){echo 'selected';} ?>>2020</option>
                                    <option value="2021" <?php if($year==2021){echo 'selected';} ?>>2021</option>
                                    <option value="2022" <?php if($year==2022){echo 'selected';} ?>>2022</option>
                                </select></td>
                            </tr>
                            <tr>
                                <td>STATUS</td>
                                <td><select name="status" id="status">
                                    <option value="0" <?php if($status==0){echo 'selected';} ?>>SEMUA STATUS</option>
                                    <option value="1" <?php if($status==1){echo 'selected';} ?>>BELUM TUNTAS</option>
                                    <option value="2" <?php if($status==2){echo 'selected';} ?>>TUNTAS</option>
                                </select></td>
                                <td><input type="submit" value="SHOW">
                                </td>
                            </tr>
                        </table>
                    </form>
                    <hr>
                    <table class="detail">
                        <tr class="iomlist">
                            <td>Tanggal</td>
                            <td>Nomor</td>
                            <td>Nama Pemohon</td>
                            <td>Departemen</td>
                            <td>Status</td>
                            <td></td>
                        </tr>
                        <?php foreach ($data as $row) {
                            if($status == 0){
                                
                            }
                            else if($status == 1 ){
                                if($row->stsiomcount*3 == $row->stsiomall){
                                    continue;
                                }
                            }
                            else if($status == 2){
                                if($row->stsiomcount*3 != $row->stsiomall){
                                    continue;
                                }
                            }
                            ?>
                            <tr class="listiom">
                                <td><?php echo $row->tgliom; ?></td>
                                <td><?php echo $row->noiom; ?></td>
                                <td><?php echo $row->nmuser; ?></td>
                                <td><?php echo $row->nmdept; ?></td>
                                <?php 
                                    
                                    echo '<td ';
                                        if($row->stsiomcount*3 == $row->stsiomall){
                                            echo 'class="approved">TUNTAS';
                                        }
                                        else{
                                            echo 'class="waiting">BELUM TUNTAS';
                                        } 
                                    ?></td>
                                <td><a href="<?php echo site_url("iom/view"); echo "?no="; echo urlencode($row->noiom); ?>"><button>View</button></a></td>
                            </tr>
                        <?php
                        }?>
                    </table>
                </td>
            </tr>
            <?php include_once("components/footer.php") ?>