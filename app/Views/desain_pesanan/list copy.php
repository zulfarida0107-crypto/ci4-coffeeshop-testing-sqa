<?= $this->extend('base') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            <div class="card bg-secondary text-white border-0 shadow-lg" style="border-radius: 10px; overflow: hidden;">
                <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #343a40; border-bottom: 1px solid #454d55; padding: 15px 20px;">
                    <div class="h6 mb-0">
                        <i class="fa fa-image"></i>&nbsp; Daftar Desain Pesanan (Kue)
                    </div>
                    <div>
                        <a href="<?= base_url('desain-pesanan/add'); ?>" 
                           class="btn btn-sm" 
                           style="background-color: #20c997; color: white; font-weight: bold;">
                            <i class="fa fa-plus"></i>&nbsp; Tambah Desain
                        </a>
                        <a href="<?= base_url('desain-pesanan'); ?>" class="btn btn-outline-light btn-sm ml-1">
                            <i class="fa fa-refresh"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body p-0" style="background-color: #2c3034;">

                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="p-3">
                            <div class="alert alert-success bg-success text-white border-0 mb-0 shadow-sm">
                                <?= session()->getFlashdata('success'); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-dark table-hover table-striped mb-0 border-0" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size:13px; background-color: #343a40;">
                            <thead style="background-color: #23272b; color: #adb5bd; border-bottom: 2px solid #454d55;">
                                <tr>
                                    <th width="100" class="text-center py-3">Aksi</th>
                                    <th class="py-3">ID</th>
                                    <th class="py-3">ID Pesanan</th>
                                    <th class="py-3">File Desain (URL)</th>
                                    <th class="py-3">Keterangan</th>
                                    <th class="py-3 text-right pr-4">Tanggal Upload</th>
                                </tr>
                            </thead>

                            <tbody style="color: #e9ecef;">
                                <?php if (!empty($result)) : ?>
                                    <?php foreach ($result as $row) : ?>
                                        <tr style="border-bottom: 1px solid #454d55;">
                                            <td class="text-center align-middle">
                                                <div class="btn-group">
                                                    <a href="<?= base_url('desain-pesanan/edit/' . $row['id']); ?>" class="text-warning mr-3" title="Edit">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="<?= base_url('desain-pesanan/destroy/' . $row['id']); ?>" class="text-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus desain ini?')" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="align-middle"><strong>#<?= $row['id']; ?></strong></td>
                                            <td class="align-middle text-info"><?= $row['id_pesanan']; ?></td>
                                            <td class="align-middle">
                                                <a href="<?= $row['file_desain_url']; ?>" target="_blank" class="text-info d-inline-block text-truncate" style="max-width: 150px;">
                                                    <?= $row['file_desain_url']; ?>
                                                </a>
                                            </td>
                                            <td class="align-middle">
                                                <div class="text-truncate" style="max-width: 200px;" title="<?= $row['keterangan']; ?>">
                                                    <?= (strlen($row['keterangan']) > 50) ? substr($row['keterangan'], 0, 50) . '...' : $row['keterangan']; ?>
                                                </div>
                                            </td>
                                            <td class="align-middle text-right pr-4 text-muted small">
                                                <?= date('d M Y, H:i', strtotime($row['tanggal_upload'])); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <i class="fa fa-folder-open fa-2x d-block mb-2"></i>
                                            Belum ada data desain pesanan.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="p-3 d-flex justify-content-between align-items-center" style="background-color: #23272b;">
                        <span class="small text-muted">Total: <?= count($result ?? []) ?> entri</span>
                        <div class="pagination-wrapper">
                            <?= isset($pager) ? $pager->links() : '' ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Kustomisasi Scrollbar Table Responsive agar serasi dengan tema Dark */
.table-responsive::-webkit-scrollbar { height: 8px; background-color: #2c3034; }
.table-responsive::-webkit-scrollbar-thumb { background: #454d55; border-radius: 10px; }
.table-responsive::-webkit-scrollbar-thumb:hover { background: #20c997; }

/* Styling Pagination Kotak Toska Premium */
.pagination { display: flex; list-style: none; padding-left: 0; margin-bottom: 0; }
.pagination li a, .pagination li span { 
    padding: 6px 14px; margin-left: 5px; border: 1px solid #454d55; 
    background-color: #343a40; color: #20c997; text-decoration: none; border-radius: 4px; 
    transition: 0.3s;
}
.pagination li.active a, .pagination li.active span { 
    background-color: #20c997 !important; border-color: #20c997 !important; color: white !important; 
}
.pagination li a:hover { background-color: #454d55; color: white; }
</style>

<?= $this->endSection() ?>