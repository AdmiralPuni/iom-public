<?php
include_once("components/menubar.php");
?>
<style>
    .detail tr td:nth-child(5) form{
        min-width:400px;
        display:inline;
    }
</style>
<tr>
    <td class="content">
        <h1>LIST USER</h1>
        <hr>
        <table class="listiom">
            <tr>
                <form action="<?= site_url('userlist/search') ?>" method="GET">
                    <td><input type="text" id="kduser" name="kduser" placeholder="KODE USER"></td>
                    <td><input type="text" id="nmuser" name="nmuser" placeholder="NAMA USER"></td>
                    <td><input type="text" id="nmdept" name="nmdept" placeholder="DEPARTMENT"></td>
                    <td><input type="text" id="stsappr" name="stsappr" placeholder="APPROVAL"></td>
                    <td></td>
                    <td><input type="submit" value="SHOW"></td>
                </form>
            </tr>
            <tr>
                <form action="<?= site_url('userlist/update') ?>" method="POST">
                    <td><input type="text" id="kode_update" name="kode" placeholder="KODE USER"></td>
                    <td><input type="text" id="ket_update" name="ket" placeholder="NAMA USER"></td>
                    <td><input type="text" id="dept_update" name="dept" placeholder="DEPARTMENT"></td>
                    <td><input type="text" id="stsappr_update" name="stsappr" placeholder="APPROVAL"></td>
                    <td><input type="text" id="password_update" name="password" placeholder="PASSWORD"></td>
                    <td><input type="submit" value="UPDATE"></td>
                </form>
            </tr>
        </table>
        <hr>
        <table class="detail">
            <tr>
                <td>KODE USER</td>
                <td>NAMA USER</td>
                <td>DEPARTMENT</td>
                <td>APPROVAL</td>
                <td>ACTION</td>
            </tr>
            <?php foreach ($data as $row) { ?>
                <tr>
                    <td><?= $row->kduser ?></td>
                    <td><?= $row->nmuser ?></td>
                    <td><?= $row->nmdept ?></td>
                    <td><?= $row->stsappr ?></td>
                    <td><button onclick="take('<?= $row->kduser ?>','<?= $row->nmuser ?>','<?= $row->nmdept ?>','<?= $row->stsappr ?>')">UPDATE</button>
                        <form onsubmit="return confirm('Delete <?= $row->kduser ?>?')" action="<?= site_url('userlist/delete') ?>" method="POST">
                            <input type="hidden" id="kode" name="kode" value="<?= $row->kduser ?>">
                            <input type="submit" value="DELETE"> </form>
                    </td>
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
    function take(kode, ket, dept, stsappr) {
        document.getElementById("kode_update").value = kode;
        document.getElementById("ket_update").value = ket;
        document.getElementById("dept_update").value = dept;
        document.getElementById("stsappr_update").value = stsappr;
    }
</script>

</html>