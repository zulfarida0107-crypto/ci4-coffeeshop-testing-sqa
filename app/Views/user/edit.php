<?= $this->extend('base') ?>
<?= $this->section('content') ?>

<div class="w-full flex-1 flex flex-col">
    <!-- Header Actions -->
    <div class="flex justify-between items-end mb-lg">
        <div>
            <span class="font-label-md text-label-md text-primary tracking-widest uppercase mb-xs block">Management</span>
            <h1 class="font-h1 text-h1 text-on-surface">Edit User: <?= esc($user['username']) ?></h1>
        </div>
        <div class="flex gap-md">
            <a href="<?= base_url('user') ?>" class="flex items-center gap-sm px-lg py-sm rounded-xl bg-surface-container-highest text-on-surface-variant font-button text-button hover:brightness-95 transition-all active:scale-95 shadow-sm">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali
            </a>
        </div>
    </div>

    <!-- Form Container -->
    <div class="glass-card rounded-xl p-xl shadow-sm border border-outline-variant/30">
        <form action="<?= base_url('user/update/' . $user['id']) ?>" method="POST" class="space-y-lg">
            <?= csrf_field() ?>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                <div class="space-y-sm">
                    <label class="font-label-md text-label-md text-on-surface-variant block">Username</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">account_circle</span>
                        <input type="text" name="username" class="glass-input w-full pl-xl pr-md py-sm rounded-lg text-on-surface focus:ring-2 focus:ring-primary/20" value="<?= esc($user['username']) ?>" required>
                    </div>
                </div>

                <div class="space-y-sm">
                    <label class="font-label-md text-label-md text-on-surface-variant block">Nama Lengkap</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">badge</span>
                        <input type="text" name="nama_lengkap" class="glass-input w-full pl-xl pr-md py-sm rounded-lg text-on-surface focus:ring-2 focus:ring-primary/20" value="<?= esc($user['nama_lengkap']) ?>" required>
                    </div>
                </div>
            </div>

            <div class="space-y-sm">
                <label class="font-label-md text-label-md text-on-surface-variant block">Role / Jabatan</label>
                <div class="relative">
                    <select name="role" class="glass-input w-full px-md py-sm rounded-lg text-on-surface appearance-none focus:ring-2 focus:ring-primary/20" required>
                        <option value="karyawan" <?= $user['role'] == 'karyawan' ? 'selected' : '' ?>>Karyawan</option>
                        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                    </select>
                    <span class="material-symbols-outlined absolute right-md top-1/2 -translate-y-1/2 text-outline pointer-events-none">arrow_drop_down</span>
                </div>
            </div>

            <div class="pt-md border-t border-outline-variant/30 flex items-center justify-end gap-sm">
                <button type="submit" class="flex items-center gap-sm px-xl py-sm rounded-xl bg-yellow-400 text-on-surface font-button text-button hover:bg-yellow-500 transition-all active:scale-95 shadow-lg shadow-yellow-400/20">
                    <span class="material-symbols-outlined">save</span>
                    Update Data
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>