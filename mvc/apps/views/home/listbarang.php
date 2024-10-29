<a href="<?= BASE_URL.'index.php?r=home/insertbarang' ?>" class="btn btn-primary my-3">Tambah Barang</a>
<table class="table">
    <thead class="table-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">QTY</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $item) : ?>
        <tr scope="row">
            <td><?= $item['id'] ?></td>
            <td><?= $item['nama'] ?></td>
            <td><span class="badge text-bg-<?= $item['qty']>50? 'success' : 'danger' ?>"><?= $item['qty'] ?></span></td>
            <td>
                <a href="<?= BASE_URL.'index.php?r=home/updatebarang/'.$item['id']?>" class="badge text-bg-light text-decoration-none">Update</a>
                <a href="<?= BASE_URL.'index.php?r=home/delete/'.$item['id']?>" class="badge text-bg-light text-decoration-none" onclick="return confirm('Apakah anda yakin ingin mengahapus data?')">Delete</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>