<?php foreach ($data as $row) { ?>
    <tr>
        <td><?= $row->kditem ?></td>
        <td><?= $row->nmitem ?></td>
        <td><button onclick="add_item('<?= $row->kditem ?>')">Tambah</button></td>
    </tr>
<?php } ?>