<?= $this->extend('base') ?>
<?= $this->section('content') ?>

<div class="w-full flex-1 flex flex-col">
    <!-- Header Actions -->
    <div class="flex justify-between items-end mb-lg">
        <div>
            <span class="font-label-md text-label-md text-primary tracking-widest uppercase mb-xs block">Management</span>
            <h1 class="font-h1 text-h1 text-on-surface">Edit Menu Produk</h1>
        </div>
        <div class="flex gap-md">
            <a href="<?= base_url('menu-produk') ?>" class="flex items-center gap-sm px-lg py-sm rounded-xl bg-surface-container-highest text-on-surface-variant font-button text-button hover:brightness-95 transition-all active:scale-95 shadow-sm">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali
            </a>
        </div>
    </div>

    <!-- Form Container -->
    <div class="glass-card rounded-xl p-xl shadow-sm border border-outline-variant/30">
        <form action="<?= base_url('menu-produk/update/'.$result['id']) ?>" method="POST" class="space-y-lg">
            <?= csrf_field() ?>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                <div class="space-y-sm">
                    <label class="font-label-md text-label-md text-on-surface-variant block">Nama Produk</label>
                    <input type="text" name="nama_produk" value="<?= esc($result['nama_produk']) ?>" class="glass-input w-full px-md py-sm rounded-lg text-on-surface focus:ring-2 focus:ring-primary/20" required>
                </div>

                <div class="space-y-sm">
                    <label class="font-label-md text-label-md text-on-surface-variant block">Harga (Rupiah)</label>
                    <div class="relative">
                        <span class="absolute left-md top-1/2 -translate-y-1/2 text-outline font-label-md">Rp</span>
                        <input type="number" name="harga" value="<?= (int)$result['harga'] ?>" class="glass-input w-full pl-xl pr-md py-sm rounded-lg text-on-surface focus:ring-2 focus:ring-primary/20" required>
                    </div>
                </div>
            </div>

            <div class="space-y-sm">
                <label class="font-label-md text-label-md text-on-surface-variant block">Kategori</label>
                <div class="relative">
                    <select name="kategori" class="glass-input w-full px-md py-sm rounded-lg text-on-surface appearance-none focus:ring-2 focus:ring-primary/20" required>
                        <option value="Kopi" <?= $result['kategori'] == 'Kopi' ? 'selected' : '' ?>>Kopi</option>
                        <option value="Non-Kopi" <?= $result['kategori'] == 'Non-Kopi' ? 'selected' : '' ?>>Non-Kopi</option>
                        <option value="Pastry" <?= $result['kategori'] == 'Pastry' ? 'selected' : '' ?>>Pastry</option>
                    </select>
                    <span class="material-symbols-outlined absolute right-md top-1/2 -translate-y-1/2 text-outline pointer-events-none">arrow_drop_down</span>
                </div>
            </div>

            <div class="space-y-sm">
                <label class="font-label-md text-label-md text-on-surface-variant block">Deskripsi</label>
                <textarea name="deskripsi" class="glass-input w-full p-md rounded-lg text-on-surface resize-none leading-relaxed min-h-[120px] focus:ring-2 focus:ring-primary/20"><?= esc($result['deskripsi']) ?></textarea>
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