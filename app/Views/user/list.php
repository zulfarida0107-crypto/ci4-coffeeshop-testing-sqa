<?= $this->extend('base') ?>
<?= $this->section('content') ?>

<!-- Header Actions -->
<div class="flex justify-between items-end mb-lg">
    <div>
        <span class="font-label-md text-label-md text-primary tracking-widest uppercase mb-xs block">Management</span>
        <h1 class="font-h1 text-h1 text-on-surface">Manajemen User</h1>
    </div>
    <div class="flex gap-md">
        <a href="<?= base_url('user/add'); ?>" class="flex items-center gap-sm px-lg py-sm rounded-xl bg-primary text-on-primary font-button text-button hover:brightness-110 transition-all active:scale-95 shadow-lg shadow-primary/20">
            <span class="material-symbols-outlined">add</span>
            Tambah User
        </a>
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
                    <th class="px-md py-sm">Username</th>
                    <th class="px-md py-sm">Nama Lengkap</th>
                    <th class="px-md py-sm">Role</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/20 text-body-sm font-body-sm">
                <?php if (!empty($result) && is_array($result)) : ?>
                    <?php foreach ($result as $row) : ?>
                        <tr class="hover:bg-surface-container-low transition-colors group">
                            <td class="px-md py-sm">
                                <div class="flex items-center justify-center gap-xs">
                                    <a href="<?= base_url('user/edit/' . $row['id']); ?>" class="w-8 h-8 flex items-center justify-center rounded-md bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition-colors" title="Edit">
                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                    </a>
                                    <a href="<?= base_url('user/destroy/' . $row['id']); ?>" class="w-8 h-8 flex items-center justify-center rounded-md bg-red-100 text-red-600 hover:bg-red-200 transition-colors" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')" title="Hapus">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </a>
                                </div>
                            </td>
                            <td class="px-md py-sm font-semibold text-on-surface">#<?= $row['id']; ?></td>
                            <td class="px-md py-sm text-on-surface font-medium"><?= esc($row['username']); ?></td>
                            <td class="px-md py-sm text-on-surface font-bold"><?= esc($row['nama_lengkap']); ?></td>
                            <td class="px-md py-sm">
                                <?php 
                                    $role = esc($row['role']);
                                    $bgClass = 'bg-gray-100 text-gray-800 border-gray-200';
                                    if ($role == 'admin') {
                                        $bgClass = 'bg-red-100 text-red-800 border-red-200';
                                    } elseif ($role == 'karyawan') {
                                        $bgClass = 'bg-blue-100 text-blue-800 border-blue-200';
                                    }
                                ?>
                                <span class="px-sm py-1 rounded-md text-[11px] font-bold tracking-wider uppercase border inline-flex items-center justify-center w-fit <?= $bgClass ?>">
                                    <?= $role; ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" class="px-md py-xl text-center text-on-surface-variant">
                            <span class="material-symbols-outlined text-4xl opacity-50 mb-sm block">group_off</span>
                            Belum ada data user.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination Footer -->
    <div class="px-md py-sm border-t border-outline-variant/30 bg-surface-container-low flex justify-between items-center">
        <span class="text-label-md font-label-md text-on-surface-variant">Menampilkan data user/pengguna</span>
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