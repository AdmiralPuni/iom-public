<?php foreach ($data as $row) { ?>
    <tr>
        <td><?= $row->kditem ?></td>
        <td><?= $row->nmitem ?></td>
        <td><button onclick="remove_item('<?= $row->kditem ?>,')">Hapus</button></td>
    </tr>
<?php } ?>