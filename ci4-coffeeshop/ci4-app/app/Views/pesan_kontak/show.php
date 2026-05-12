<?= $this->extend('base') ?>
<?= $this->section('content') ?>

<div class="w-full flex-1 flex flex-col">
    <!-- Header Actions -->
    <div class="flex justify-between items-end mb-lg">
        <div>
            <span class="font-label-md text-label-md text-primary tracking-widest uppercase mb-xs block">Detail Pesan</span>
            <h1 class="font-h1 text-h1 text-on-surface">Dari: <?= esc($result['nama']) ?></h1>
        </div>
        <div class="flex gap-md">
            <a href="<?= base_url('pesan-kontak') ?>" class="flex items-center gap-sm px-lg py-sm rounded-xl bg-surface-container-highest text-on-surface-variant font-button text-button hover:brightness-95 transition-all active:scale-95 shadow-sm">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali
            </a>
        </div>
    </div>

    <!-- Details Container -->
    <div class="glass-card rounded-xl p-xl shadow-sm border border-outline-variant/30">
        <div class="space-y-lg">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                <div class="space-y-sm">
                    <label class="font-label-md text-label-md text-on-surface-variant block">Nama Pengirim</label>
                    <input type="text" class="glass-input w-full px-md py-sm rounded-lg text-on-surface font-semibold bg-surface-container-low cursor-not-allowed" value="<?= esc($result['nama']) ?>" readonly disabled>
                </div>
                
                <div class="space-y-sm">
                    <label class="font-label-md text-label-md text-on-surface-variant block">Email Pengirim</label>
                    <input type="text" class="glass-input w-full px-md py-sm rounded-lg text-primary font-semibold bg-surface-container-low cursor-not-allowed" value="<?= esc($result['email']) ?>" readonly disabled>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                <div class="space-y-sm">
                    <label class="font-label-md text-label-md text-on-surface-variant block">Subjek Pesan</label>
                    <input type="text" class="glass-input w-full px-md py-sm rounded-lg text-on-surface font-medium bg-surface-container-low cursor-not-allowed" value="<?= esc($result['subjek']) ?>" readonly disabled>
                </div>
                
                <div class="space-y-sm">
                    <label class="font-label-md text-label-md text-on-surface-variant block">Waktu Dikirim</label>
                    <input type="text" class="glass-input w-full px-md py-sm rounded-lg text-on-surface-variant bg-surface-container-low cursor-not-allowed" value="<?= date('d F Y - H:i', strtotime($result['tanggal_dikirim'])) ?>" readonly disabled>
                </div>
            </div>

            <div class="space-y-sm flex-1 flex flex-col">
                <label class="font-label-md text-label-md text-on-surface-variant block">Isi Pesan</label>
                <textarea class="glass-input w-full p-md rounded-lg text-on-surface flex-1 resize-none leading-relaxed min-h-[150px] bg-surface-container-low cursor-not-allowed" readonly disabled><?= esc($result['pesan']) ?></textarea>
            </div>

            <div class="pt-md flex items-center justify-end gap-sm border-t border-outline-variant/30 mt-lg">
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?= urlencode($result['email']) ?>&su=Balasan%3A+<?= urlencode($result['subjek']) ?>" target="_blank" rel="noopener noreferrer" class="flex items-center gap-sm px-xl py-sm rounded-xl bg-blue-100 text-blue-700 font-button text-button hover:bg-blue-200 transition-all active:scale-95 shadow-sm">
                    <span class="material-symbols-outlined text-[20px]">reply</span>
                    Balas via Email (Gmail)
                </a>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>