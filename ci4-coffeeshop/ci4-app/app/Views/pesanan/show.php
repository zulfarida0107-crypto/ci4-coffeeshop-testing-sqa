<?= $this->extend('base') ?>
<?= $this->section('content') ?>

<div class="w-full flex-1 flex flex-col">
    <!-- Header Actions -->
    <div class="flex justify-between items-end mb-lg">
        <div>
            <span class="font-label-md text-label-md text-primary tracking-widest uppercase mb-xs block">Detail Data</span>
            <h1 class="font-h1 text-h1 text-on-surface">Pesanan #<?= esc($result['id']) ?></h1>
        </div>
        <div class="flex gap-md">
            <a href="<?= base_url('pesanan') ?>" class="flex items-center gap-sm px-lg py-sm rounded-xl bg-surface-container-highest text-on-surface-variant font-button text-button hover:brightness-95 transition-all active:scale-95 shadow-sm">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali
            </a>
            <a href="<?= base_url('pesanan/edit/' . $result['id']) ?>" class="flex items-center gap-sm px-lg py-sm rounded-xl bg-yellow-400 text-on-surface font-button text-button hover:bg-yellow-500 transition-all active:scale-95 shadow-lg shadow-yellow-400/20">
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
                    <label class="font-label-md text-label-md text-on-surface-variant block">ID Pesanan</label>
                    <input type="text" class="glass-input w-full px-md py-sm rounded-lg text-on-surface-variant font-bold bg-surface-container-low cursor-not-allowed" value="#<?= esc($result['id']) ?>" readonly disabled>
                </div>
                
                <div class="space-y-sm">
                    <label class="font-label-md text-label-md text-on-surface-variant block">Nama Pelanggan</label>
                    <input type="text" class="glass-input w-full px-md py-sm rounded-lg text-on-surface font-semibold bg-surface-container-low cursor-not-allowed" value="<?= esc($result['nama_pelanggan']) ?>" readonly disabled>
                </div>
            </div>

            <div class="space-y-sm">
                <label class="font-label-md text-label-md text-on-surface-variant block">Judul Produk (ID)</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">local_cafe</span>
                    <input type="text" class="glass-input w-full pl-xl pr-md py-sm rounded-lg text-on-surface bg-surface-container-low cursor-not-allowed" value="<?= esc($result['nama_produk'] ?? 'ID Produk: ' . $result['id_produk']) ?>" readonly disabled>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                <div class="space-y-sm">
                    <label class="font-label-md text-label-md text-on-surface-variant block">Jumlah</label>
                    <input type="text" class="glass-input w-full px-md py-sm rounded-lg text-on-surface bg-surface-container-low cursor-not-allowed text-center font-bold" value="<?= esc($result['jumlah']) ?>" readonly disabled>
                </div>
                <div class="space-y-sm">
                    <label class="font-label-md text-label-md text-on-surface-variant block">Total Harga (Rp)</label>
                    <input type="text" class="glass-input w-full px-md py-sm rounded-lg text-primary font-bold bg-surface-container-low cursor-not-allowed" value="Rp <?= number_format($result['total_harga'], 0, ',', '.') ?>" readonly disabled>
                </div>
            </div>

            <div class="flex items-center justify-between p-md bg-surface-container-highest/30 rounded-xl border border-outline-variant/30 mt-lg">
                <div class="flex flex-col gap-xs">
                    <span class="font-label-md text-label-md text-on-surface-variant block">Status Pesanan</span>
                    <?php
                        $status = esc($result['status_pesanan']);
                        $bgClass = 'bg-gray-100 text-gray-800 border-gray-200';
                        if ($status == 'Baru') {
                            $bgClass = 'bg-blue-100 text-blue-800 border-blue-200';
                        } elseif ($status == 'Proses') {
                            $bgClass = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                        } elseif ($status == 'Selesai') {
                            $bgClass = 'bg-green-100 text-green-800 border-green-200';
                        }
                    ?>
                    <span class="px-sm py-1 rounded-md text-body-sm font-bold tracking-wider uppercase border inline-flex items-center justify-center w-fit <?= $bgClass ?>">
                        <?= $status ?>
                    </span>
                </div>
                <div class="flex flex-col text-right">
                    <span class="font-label-md text-[10px] text-on-surface-variant uppercase tracking-wider">Tanggal Pesanan</span>
                    <p class="font-body-sm font-semibold text-on-surface"><?= date('d F Y - H:i:s', strtotime($result['tanggal_pesanan'])); ?></p>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>