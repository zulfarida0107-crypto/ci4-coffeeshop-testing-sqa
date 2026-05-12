<?= $this->extend('base') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="card bg-secondary text-white border-0 shadow-lg">
        
        <div class="card-header d-flex justify-content-between align-items-center" 
             style="background-color: #343a40; border-bottom: 1px solid #454d55;">
            <div>
                <i class="fa fa-envelope"></i>&nbsp; Daftar Pesanan Masuk
            </div>
            <div class="d-flex align-items-center">
                <a href="<?= base_url('pesanan/add'); ?>" class="btn btn-teal btn-sm mr-2" style="background-color: #20c997; color: white; border: none; font-weight: bold;">
                    <i class="fa fa-plus"></i> Tambah Pesanan
                </a>
                
                <a href="<?= base_url('pesanan'); ?>" class="btn btn-outline-light btn-sm">
                    <i class="fa fa-refresh"></i> Refresh
                </a>
            </div>
        </div>

        <div class="card-body p-0" style="background-color: #2c3034;">

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success m-3 border-0">
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-dark table-hover table-striped border-0 mb-0" 
                       style="font-family: 'Segoe UI', sans-serif; font-size:13px; min-width: 1000px;">

                    <thead style="background-color: #23272b; color: #adb5bd; border-bottom: 2px solid #454d55;">
                        <tr>
                            <th width="120" class="text-center">Aksi</th>
                            <th>ID</th>
                            <th>Nama Pelanggan</th> 
                            <th>Produk (ID)</th> 
                            <th>Jumlah</th> 
                            <th>Total Harga</th> 
                            <th>Status</th> 
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($result)) : ?>
                            <?php foreach ($result as $row) : ?>
                                <tr>
                                    <td class="text-center">
                                        <a href="<?= base_url('pesanan/edit/' . $row['id']); ?>" class="text-warning mr-2">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('pesanan/destroy/' . $row['id']); ?>" 
                                           class="text-danger"
                                           onclick="return confirm('Hapus pesanan ini?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>

                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['nama_pelanggan']; ?></td> 
                                    <td><?= $row['nama_produk'] ?? 'ID Produk: ' . $row['id_produk']; ?></td> 
                                    <td><?= $row['jumlah']; ?></td>
                                    <td>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td> 
                                    <td>
                                        <?php
                                            $badgeColor = 'badge-secondary';
                                            // Menyesuaikan ENUM status_pesanan dari DB: Baru, Proses, Selesai
                                            if ($row['status_pesanan'] == 'Baru') {
                                                $badgeColor = 'badge-info';
                                            } elseif ($row['status_pesanan'] == 'Proses') {
                                                $badgeColor = 'badge-warning text-white';
                                            } elseif ($row['status_pesanan'] == 'Selesai') {
                                                $badgeColor = 'badge-success';
                                            }
                                        ?>
                                        <span class="badge <?= $badgeColor ?>">
                                            <?= $row['status_pesanan']; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="7" class="text-center py-4">Belum ada data pesanan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="p-3 custom-pagination">
                <?= $pager->links() ?>
            </div>

        </div>
    </div>
</div>

<style>
/* Style Tombol Tambah (Teal) */
.btn-teal:hover {
    background-color: #17a67d !important;
}

/* Style untuk Pagination agar Kotak Hijau seperti Foto 3 */
.custom-pagination ul {
    display: flex;
    padding-left: 0;
    list-style: none;
    margin: 0;
}

.custom-pagination li a, 
.custom-pagination li span {
    display: block;
    padding: 0.5rem 0.75rem;
    margin-right: 5px;
    background-color: #20c997; /* Warna Hijau Utama */
    color: white;
    border-radius: 4px;
    text-decoration: none;
    font-weight: bold;
}

.custom-pagination li.active a,
.custom-pagination li.active span {
    background-color: #17a67d; /* Hijau lebih gelap untuk halaman aktif */
    cursor: default;
}

.custom-pagination li a:hover {
    background-color: #17a67d;
    color: white;
}
</style> 

<?= $this->endSection() ?>