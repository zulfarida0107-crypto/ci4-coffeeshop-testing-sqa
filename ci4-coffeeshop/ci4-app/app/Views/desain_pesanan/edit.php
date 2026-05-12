<?= $this->extend('base') ?>
<?= $this->section('content') ?>

<div class="w-full flex-1 flex flex-col">
    <!-- Header Actions -->
    <div class="flex justify-between items-end mb-lg">
        <div>
            <span class="font-label-md text-label-md text-primary tracking-widest uppercase mb-xs block">Management</span>
            <h1 class="font-h1 text-h1 text-on-surface">Edit Desain Pesanan #<?= esc($result['id']) ?></h1>
        </div>
        <div class="flex gap-md">
            <a href="<?= base_url('desain-pesanan') ?>" class="flex items-center gap-sm px-lg py-sm rounded-xl bg-surface-container-highest text-on-surface-variant font-button text-button hover:brightness-95 transition-all active:scale-95 shadow-sm">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali
            </a>
        </div>
    </div>

    <!-- Form Container -->
    <div class="glass-card rounded-xl p-xl shadow-sm border border-outline-variant/30">
        <form action="<?= base_url('desain-pesanan/update/' . $result['id']); ?>" method="post" class="space-y-lg">
            <?= csrf_field(); ?>
            
            <div class="grid grid-cols-1 gap-lg">
                <div class="space-y-sm">
                    <label class="font-label-md text-label-md text-on-surface-variant block">ID Pesanan</label>
                    <input type="number" name="id_pesanan" class="glass-input w-full px-md py-sm rounded-lg text-on-surface focus:ring-2 focus:ring-primary/20" value="<?= esc($result['id_pesanan']); ?>" required>
                </div>

                <div class="space-y-sm">
                    <label class="font-label-md text-label-md text-on-surface-variant block">URL File Desain</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">link</span>
                        <input type="text" name="file_desain_url" class="glass-input w-full pl-xl pr-md py-sm rounded-lg text-on-surface focus:ring-2 focus:ring-primary/20" value="<?= esc($result['file_desain_url']); ?>" required>
                    </div>
                </div>

                <div class="space-y-sm">
                    <label class="font-label-md text-label-md text-on-surface-variant block">Keterangan</label>
                    <textarea name="keterangan" class="glass-input w-full p-md rounded-lg text-on-surface resize-none leading-relaxed min-h-[120px] focus:ring-2 focus:ring-primary/20"><?= esc($result['keterangan']); ?></textarea>
                </div>
                
                <div class="space-y-sm">
                    <label class="font-label-md text-label-md text-on-surface-variant block">Tanggal Upload Terakhir</label>
                    <input type="text" class="glass-input w-full px-md py-sm rounded-lg text-on-surface-variant bg-surface-container-low cursor-not-allowed" value="<?= date('d F Y - H:i:s', strtotime($result['tanggal_upload'])); ?>" readonly disabled>
                    <p class="text-body-sm font-body-sm text-on-surface-variant/70 mt-1">Waktu akan diperbarui otomatis saat menekan tombol Update Data jika ada perubahan.</p>
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