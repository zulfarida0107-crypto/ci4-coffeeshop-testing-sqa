<?= $this->extend('base') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            <div class="card bg-secondary text-white border-0 shadow-lg">
                <div class="card-header" style="background-color: #343a40; border-bottom: 1px solid #454d55;">
                    <i class="fa fa-envelope"></i>&nbsp;Daftar Pesan Masuk

                    <div class="float-right">
                        <a href="<?= base_url('pesan-kontak'); ?>" class="btn btn-outline-light btn-sm ml-1">
                            <i class="fa fa-refresh"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body" style="background-color: #2c3034;">

                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success bg-success text-white border-0">
                            <?= session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <table class="table table-dark table-hover table-striped border-0" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size:13px; background-color: #343a40;">
                        <thead style="background-color: #23272b; color: #adb5bd; border-bottom: 2px solid #454d55;">
                            <tr>
                                <th width="80">Aksi</th>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Subjek</th>
                                <th>Pesan</th>
                                <th>Tanggal Dikirim</th>
                            </tr>
                        </thead>

                        <tbody style="color: #e9ecef;">
                            <?php if (!empty($result) && is_array($result)) : ?>
                                <?php foreach ($result as $row) : ?>
                                    <tr style="border-bottom: 1px solid #454d55;">
                                        <td>
                                            <a href="<?= base_url('pesan-kontak/show/' . $row['id']); ?>" title="View" class="text-info mr-2">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="<?= base_url('pesan-kontak/destroy/' . $row['id']); ?>" title="Delete" class="text-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>

                                        <td><strong><?= $row['id']; ?></strong></td>
                                        <td><?= $row['nama']; ?></td>
                                        <td><?= $row['email']; ?></td>
                                        <td><?= $row['subjek']; ?></td>
                                        <td>
                                            <?= (strlen($row['pesan']) > 50) ? substr($row['pesan'], 0, 50) . '...' : $row['pesan']; ?>
                                        </td>
                                        <td><?= $row['tanggal_dikirim']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Belum ada pesan masuk.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="mt-3">
                        <?= $pager->links() ?>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<style>
/* Styling Pagination agar serasi dengan tema Dark */
.pagination { display: flex; list-style: none; padding-left: 0; }
.pagination li a, .pagination li span { 
    padding: 6px 12px; margin-right: 5px; border: 1px solid #454d55; 
    background-color: #343a40; color: #20c997; text-decoration: none; border-radius: 4px; 
}
.pagination li.active a, .pagination li.active span { 
    background-color: #20c997 !important; border-color: #20c997 !important; color: white !important; 
}
.pagination li a:hover { background-color: #454d55; color: white; }
</style>

<?= $this->endSection() ?>