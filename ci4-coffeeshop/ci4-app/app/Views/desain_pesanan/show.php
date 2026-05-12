<?= $this->extend('base') ?>
<?= $this->section('content') ?>

<div class="w-full flex-1 flex flex-col">
    <!-- Header Actions -->
    <div class="flex justify-between items-end mb-lg">
        <div>
            <span class="font-label-md text-label-md text-primary tracking-widest uppercase mb-xs block">Detail Data</span>
            <h1 class="font-h1 text-h1 text-on-surface">Desain Pesanan #<?= esc($result['id']) ?></h1>
        </div>
        <div class="flex gap-md">
            <a href="<?= base_url('desain-pesanan') ?>" class="flex items-center gap-sm px-lg py-sm rounded-xl bg-surface-container-highest text-on-surface-variant font-button text-button hover:brightness-95 transition-all active:scale-95 shadow-sm">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali
            </a>
            <a href="<?= base_url('desain-pesanan/edit/' . $result['id']) ?>" class="flex items-center gap-sm px-lg py-sm rounded-xl bg-yellow-400 text-on-surface font-button text-button hover:bg-yellow-500 transition-all active:scale-95 shadow-lg shadow-yellow-400/20">
                <span class="material-symbols-outlined">edit</span>
                Edit Data
            </a>
        </div>
    </div>

    <!-- Details Container -->
    <div class="glass-card rounded-xl p-xl shadow-sm border border-outline-variant/30">
        <div class="space-y-lg">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                <div class="space-y-sm">
                    <label class="font-label-md text-label-md text-on-surface-variant block">ID Desain</label>
                    <input type="text" class="glass-input w-full px-md py-sm rounded-lg text-on-surface-variant font-bold bg-surface-container-low cursor-not-allowed" value="#<?= esc($result['id']) ?>" readonly disabled>
                </div>
                
                <div class="space-y-sm">
                    <label class="font-label-md text-label-md text-on-surface-variant block">ID Pesanan Terkait</label>
                    <input type="text" class="glass-input w-full px-md py-sm rounded-lg text-on-surface font-semibold bg-surface-container-low cursor-not-allowed" value="<?= esc($result['id_pesanan']) ?>" readonly disabled>
                </div>
            </div>

            <div class="space-y-sm">
                <label class="font-label-md text-label-md text-on-surface-variant block">File Desain URL</label>
                <div class="flex gap-md">
                    <input type="text" class="glass-input w-full px-md py-sm rounded-lg text-on-surface bg-surface-container-low cursor-not-allowed flex-1" value="<?= esc($result['file_desain_url']) ?>" readonly disabled>
                    <a href="<?= esc($result['file_desain_url']) ?>" target="_blank" class="flex items-center justify-center px-lg bg-blue-100 text-blue-700 hover:bg-blue-200 transition-colors rounded-lg font-button text-button whitespace-nowrap">
                        <span class="material-symbols-outlined mr-1">open_in_new</span> Lihat File
                    </a>
                </div>
            </div>

            <div class="space-y-sm flex-1 flex flex-col">
                <label class="font-label-md text-label-md text-on-surface-variant block">Keterangan Tambahan</label>
                <textarea class="glass-input w-full p-md rounded-lg text-on-surface flex-1 resize-none leading-relaxed min-h-[120px] bg-surface-container-low cursor-not-allowed" readonly disabled><?= esc($result['keterangan']) ?: 'Tidak ada keterangan tambahan.' ?></textarea>
            </div>

            <div class="flex items-center justify-between p-md bg-surface-container-highest/30 rounded-xl mt-lg">
                <div class="flex items-center gap-sm">
                    <span class="material-symbols-outlined text-primary">cloud_done</span>
                    <div class="flex flex-col">
                        <span class="font-label-md text-[10px] text-on-surface-variant uppercase tracking-wider">Tanggal Upload</span>
                        <p class="font-body-sm font-semibold text-on-surface"><?= date('d F Y - H:i:s', strtotime($result['tanggal_upload'])); ?></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>