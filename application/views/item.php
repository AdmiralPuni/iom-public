<?php 
    include_once("components/menubar.php");
?>
<style>
    .detail tr td:nth-child(3) form{
        min-width:400px;
        display:inline;
    }
</style>
            <tr>
                <td class="content">
                    <h1>LIST ITEM</h1>
                    <hr>
                    <table class="listiom">
                        <tr>
                            <form action="<?= site_url('item/search') ?>" method="GET">
                                <td><input type="text" id="kode" name="kode" placeholder="KODE ITEM"></td>
                                <td><input type="text" id="ket" name="ket" placeholder="KETERANGAN"></td>
                                <td><input type="submit" value="SHOW"></td>
                            </form>
                        </tr>
                        <?php if($_SESSION['nmuser']=='admin'){ ?>
                        <tr>
                            <form action="<?= site_url('item/insert') ?>" method="POST">
                                <td><input type="text" id="kode" name="kode" placeholder="KODE ITEM" required></td>
                                <td><input type="text" id="ket" name="ket" placeholder="KETERANGAN" required></td>
                                <td><input type="submit" value="INSERT"></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="<?= site_url('item/update') ?>" method="POST">
                                <td><input type="text" id="kode_update" name="kode" placeholder="KODE ITEM" required></td>
                                <td><input type="text" id="ket_update" name="ket" placeholder="KETERANGAN" required></td>
                                <td><input type="submit" value="UPDATE"></td>
                            </form>
                        </tr>
                        <?php } ?>
                    </table>
                    <?php 
                        if($status == 1062){
                            echo '<br>Duplicate "Kode Item"';
                            $status = 0;
                        }
                    ?>
                    <hr>
                    <table class="detail">
                        <tr>
                            <td>KODE</td>
                            <td>KETERANGAN</td>
                            <?php if($_SESSION['nmuser']=='admin'){ ?><td>ACTION</td><?php } ?>
                        </tr>
                    <?php foreach ($data as $row) { ?>
                        <tr>
                            <td><?= $row->kditem ?></td>
                            <td><?= $row->nmitem ?></td>
                            <?php if($_SESSION['nmuser']=='admin'){ ?>
                            <td><button onclick="take('<?= $row->kditem ?>','<?= $row->nmitem ?>')">UPDATE</button>
                                <form onsubmit="return confirm('Delete <?= $row->kditem ?>?')" action="<?= site_url('item/delete') ?>" method="POST"> 
                                    <input type="hidden" id="kode" name="kode" value="<?= $row->kditem ?>">
                                    <input type="submit"  value="DELETE"> </form>
                            </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="footer"></td>
            </tr>
        </table>
    </div>
</body>
<script>
    function take(kode, ket){
        document.getElementById("kode_update").value = kode;
        document.getElementById("ket_update").value = ket;
    }
</script>
</html>