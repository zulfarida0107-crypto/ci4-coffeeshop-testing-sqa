<?= $this->extend('base') ?>
<?= $this->section('content') ?>

<!-- Header Actions -->
<div class="flex justify-between items-end mb-lg">
    <div>
        <span class="font-label-md text-label-md text-primary tracking-widest uppercase mb-xs block">Management</span>
        <h1 class="font-h1 text-h1 text-on-surface">Daftar Pesan Masuk</h1>
    </div>
</div>

<!-- Content Table -->
<div class="glass-card rounded-xl border border-outline-variant/30 overflow-hidden shadow-sm flex-1 flex flex-col min-h-0">
    <div class="overflow-y-auto overflow-x-auto flex-1">
        <table class="w-full text-left border-collapse min-w-[800px]">
            <thead>
                <tr class="bg-surface-container-high border-b border-outline-variant/50 text-on-surface-variant font-label-md text-label-md uppercase tracking-wider">
                    <th class="px-md py-sm w-32 text-center">Aksi</th>
                    <th class="px-md py-sm w-16">ID</th>
                    <th class="px-md py-sm">Nama</th>
                    <th class="px-md py-sm">Email</th>
                    <th class="px-md py-sm">Subjek</th>
                    <th class="px-md py-sm">Isi Pesan</th>
                    <th class="px-md py-sm">Tanggal Dikirim</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/20 text-body-sm font-body-sm">
                <?php if (!empty($result) && is_array($result)) : ?>
                    <?php foreach ($result as $row) : ?>
                        <tr class="hover:bg-surface-container-low transition-colors group">
                            <td class="px-md py-sm">
                                <div class="flex items-center justify-center gap-xs">
                                    <a href="<?= base_url('pesan-kontak/show/' . $row['id']); ?>" class="w-8 h-8 flex items-center justify-center rounded-md bg-blue-100 text-blue-600 hover:bg-blue-200 transition-colors" title="Lihat Detail">
                                        <span class="material-symbols-outlined text-[18px]">visibility</span>
                                    </a>
                                    <a href="<?= base_url('pesan-kontak/destroy/' . $row['id']); ?>" class="w-8 h-8 flex items-center justify-center rounded-md bg-red-100 text-red-600 hover:bg-red-200 transition-colors" onclick="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')" title="Hapus">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </a>
                                </div>
                            </td>
                            <td class="px-md py-sm font-semibold text-on-surface">#<?= $row['id']; ?></td>
                            <td class="px-md py-sm text-on-surface font-medium"><?= esc($row['nama']); ?></td>
                            <td class="px-md py-sm text-primary"><?= esc($row['email']); ?></td>
                            <td class="px-md py-sm">
                                <span class="px-xs py-1 bg-surface-container-highest text-on-surface-variant border border-outline-variant rounded text-[11px] font-bold">
                                    <?= esc($row['subjek']); ?>
                                </span>
                            </td>
                            <td class="px-md py-sm text-on-surface-variant max-w-[200px] truncate" title="<?= esc($row['pesan']); ?>">
                                <?= esc($row['pesan']); ?>
                            </td>
                            <td class="px-md py-sm text-on-surface-variant">
                                <?= date('d M Y, H:i', strtotime($row['tanggal_dikirim'])); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7" class="px-md py-xl text-center text-on-surface-variant">
                            <span class="material-symbols-outlined text-4xl opacity-50 mb-sm block">drafts</span>
                            Belum ada pesan masuk yang tersedia.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination Footer -->
    <div class="px-md py-sm border-t border-outline-variant/30 bg-surface-container-low flex justify-between items-center">
        <span class="text-label-md font-label-md text-on-surface-variant">Menampilkan data pesan terbaru</span>
        <div class="ci4-tailwind-pagination">
            <?= $pager->links() ?>
        </div>
    </div>
</div>

<style>
    /* Styling CI4 Pager with Tailwind */
    .ci4-tailwind-pagination .pagination {
        display: flex;
        gap: 0.25rem;
    }
    .ci4-tailwind-pagination .pagination li a,
    .ci4-tailwind-pagination .pagination li span {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2rem;
        height: 2rem;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-weight: 500;
        background-color: transparent;
        color: #4d453c; /* on-surface-variant */
        border: 1px solid #d1c5b8; /* outline-variant */
        transition: all 0.2s;
    }
    .ci4-tailwind-pagination .pagination li a:hover {
        background-color: #ffeade; /* surface-container */
        color: #725a39; /* primary */
        border-color: #725a39;
    }
    .ci4-tailwind-pagination .pagination li.active a,
    .ci4-tailwind-pagination .pagination li.active span {
        background-color: #725a39; /* primary */
        color: white;
        border-color: #725a39;
    }
</style>

<?= $this->endSection() ?>