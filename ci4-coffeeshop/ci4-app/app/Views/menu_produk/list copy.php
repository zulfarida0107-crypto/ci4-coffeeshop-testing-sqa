<?= $this->extend('base') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="card bg-secondary text-white border-0 shadow-lg">
        
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #343a40; border-bottom: 1px solid #454d55;">
            <div>
                <i class="fa fa-coffee"></i>&nbsp;Daftar Menu Produk
            </div>
            <div class="float-right">
                <a href="<?= base_url('menu-produk/add'); ?>" 
                   class="btn btn-sm" 
                   style="background-color: #20c997; color: white; font-weight: bold;">
                    <i class="fa fa-plus"></i>&nbsp;Tambah Daftar Menu
                </a>
                <a href="<?= base_url('menu-produk'); ?>" class="btn btn-outline-light btn-sm ml-1">
                    <i class="fa fa-refresh"></i>
                </a>
            </div>
        </div>

        <div class="card-body p-0" style="background-color: #2c3034;">

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success m-3 border-0">
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>

            <table class="table table-dark table-hover mb-0"
                   style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size:13px; background-color: #343a40;">
                
                <thead style="background-color: #23272b; color: #adb5bd; border-bottom: 2px solid #454d55;">
                    <tr>
                        <th width="120" class="text-center">Aksi</th>
                        <th>ID</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($result)) : ?>
                        <?php foreach ($result as $row) : ?>
                            <tr>
                                <td class="text-center">
                                    <a href="<?= base_url('menu-produk/show/' . $row['id']); ?>" 
                                       class="text-info mr-2">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a href="<?= base_url('menu-produk/edit/' . $row['id']); ?>" 
                                       class="text-warning mr-2">
                                        <i class="fa fa-pencil"></i>
                                    </a>

                                    <a href="<?= base_url('menu-produk/destroy/' . $row['id']); ?>" 
                                       class="text-danger"
                                       onclick="return confirm('Hapus?')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>

                                <td><?= $row['id']; ?></td>
                                <td><?= $row['nama_produk']; ?></td>
                                <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>

                                <td>
                                    <?php
                                        $badgeColor = 'badge-secondary';

                                        if ($row['kategori'] == 'Kopi') {
                                            $badgeColor = 'badge-success';
                                        } elseif ($row['kategori'] == 'Non-Kopi') {
                                            $badgeColor = 'badge-info';
                                        } elseif ($row['kategori'] == 'Pastry') {
                                            // Menghapus 'text-dark' agar teks menjadi putih default
                                            $badgeColor = 'badge-warning'; 
                                        }
                                    ?>
                                    <span class="badge <?= $badgeColor ?>">
                                        <?= $row['kategori']; ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                Belum ada data.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="p-3">
                <?= $pager->links() ?>
            </div>

        </div>
    </div>
</div>

<style>
.pagination {
    display: flex;
    list-style: none;
    padding-left: 0;
}

.pagination li a,
.pagination li span {
    padding: 6px 12px;
    margin-right: 5px;
    border: 1px solid #454d55;
    background-color: #343a40;
    color: #20c997;
    text-decoration: none;
    border-radius: 4px;
}

.pagination li.active a,
.pagination li.active span {
    background-color: #20c997 !important;
    border-color: #20c997 !important;
    color: white !important;
}

.pagination li a:hover {
    background-color: #454d55;
    color: white;
}
</style>

<?= $this->endSection() ?>