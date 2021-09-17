<?php 
    if($_SESSION['nmuser'] == "" || !empty($_SESSION['user'])){
        redirect('auth');
    }
?>
<tr>
    <td class="menubar">
        <table>
            <tr>
                <td><a href="<?= site_url("home") ?>">HOME</a></td>
                <?php if($_SESSION['nmuser']=='admin'){ ?>
                    <td><a href="<?= site_url("userlist") ?>">LIST USER</a></td>
                <?php } ?>
                <td><a href="<?= site_url("user") ?>">USER</a></td>
                <td><a href="<?= site_url("item") ?>">ITEM</a></td>
                <td><a href="<?= site_url("iom") ?>">DAFTAR IOM</a></td>
                <td><a href="<?= site_url("iom/newiom") ?>">IOM BARU</a></td>
                <td style="border:0;"><a href="<?= site_url("auth/logout") ?>">LOG OUT</a></td>
            </tr>
        </table>
    </td>
</tr>