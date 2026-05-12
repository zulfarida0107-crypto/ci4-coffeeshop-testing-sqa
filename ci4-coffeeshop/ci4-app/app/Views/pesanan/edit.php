<?= $this->extend('base') ?>
<?= $this->section('content') ?>

<div class="w-full flex-1 flex flex-col">
    <!-- Header Actions -->
    <div class="flex justify-between items-end mb-lg">
        <div>
            <span class="font-label-md text-label-md text-primary tracking-widest uppercase mb-xs block">Management</span>
            <h1 class="font-h1 text-h1 text-on-surface">Edit Pesanan</h1>
        </div>
        <div class="flex gap-md">
            <a href="<?= base_url('pesanan') ?>" class="flex items-center gap-sm px-lg py-sm rounded-xl bg-surface-container-highest text-on-surface-variant font-button text-button hover:brightness-95 transition-all active:scale-95 shadow-sm">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali
            </a>
        </div>
    </div>

    <!-- Form Container -->
    <div class="glass-card rounded-xl p-xl shadow-sm border border-outline-variant/30">
        <form action="<?= base_url('pesanan/update/' . $result['id']); ?>" method="post" class="space-y-lg">
            <?= csrf_field(); ?>
            
            <div class="grid grid-cols-1 gap-lg">
                <div class="space-y-sm">
                    <label class="font-label-md text-label-md text-on-surface-variant block">Nama Pelanggan</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">person</span>
                        <input type="text" name="nama_pelanggan" class="glass-input w-full pl-xl pr-md py-sm rounded-lg text-on-surface focus:ring-2 focus:ring-primary/20" value="<?= esc($result['nama_pelanggan']) ?>" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-lg">
                    <div class="md:col-span-2 space-y-sm">
                        <label class="font-label-md text-label-md text-on-surface-variant block">Menu Produk</label>
                        <div class="relative">
                            <select name="id_produk" id="select-produk" class="glass-input w-full px-md py-sm rounded-lg text-on-surface appearance-none focus:ring-2 focus:ring-primary/20" required>
                                <option value="" data-harga="0">-- Pilih Menu --</option>
                                <?php foreach ($produk as $p) : ?>
                                    <option value="<?= $p['id']; ?>" data-harga="<?= $p['harga']; ?>" <?= ($p['id'] == $result['id_produk']) ? 'selected' : ''; ?>>
                                        #<?= $p['id']; ?> (<?= esc($p['nama_produk']); ?>) - Rp <?= number_format($p['harga'], 0, ',', '.'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <span class="material-symbols-outlined absolute right-md top-1/2 -translate-y-1/2 text-outline pointer-events-none">arrow_drop_down</span>
                        </div>
                    </div>
                    <div class="space-y-sm">
                        <label class="font-label-md text-label-md text-on-surface-variant block">Jumlah</label>
                        <input type="number" name="jumlah" id="input-jumlah" class="glass-input w-full px-md py-sm rounded-lg text-on-surface focus:ring-2 focus:ring-primary/20" value="<?= esc($result['jumlah']) ?>" min="1" required>
                    </div>
                </div>

                <div class="space-y-sm">
                    <label class="font-label-md text-label-md text-on-surface-variant block">Total Harga (Rp)</label>
                    <input type="number" step="0.01" name="total_harga" id="input-total-harga" class="glass-input w-full px-md py-sm rounded-lg text-on-surface-variant font-bold bg-surface-container-highest/50 cursor-not-allowed" value="<?= esc($result['total_harga']) ?>" readonly required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                    <div class="space-y-sm">
                        <label class="font-label-md text-label-md text-on-surface-variant block">Status Pesanan</label>
                        <div class="relative">
                            <select name="status_pesanan" class="glass-input w-full px-md py-sm rounded-lg text-on-surface appearance-none focus:ring-2 focus:ring-primary/20">
                                <option value="Baru" <?= $result['status_pesanan'] == 'Baru' ? 'selected' : '' ?>>Baru</option>
                                <option value="Proses" <?= $result['status_pesanan'] == 'Proses' ? 'selected' : '' ?>>Proses</option>
                                <option value="Selesai" <?= $result['status_pesanan'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-md top-1/2 -translate-y-1/2 text-outline pointer-events-none">arrow_drop_down</span>
                        </div>
                    </div>
                    <div class="space-y-sm">
                        <label class="font-label-md text-label-md text-on-surface-variant block">Waktu Pesanan</label>
                        <input type="text" class="glass-input w-full px-md py-sm rounded-lg text-on-surface-variant bg-surface-container-low cursor-not-allowed" value="<?= date('d F Y - H:i:s', strtotime($result['tanggal_pesanan'])); ?>" readonly disabled>
                        <p class="text-body-sm font-body-sm text-on-surface-variant/70 mt-1">Otomatis diperbarui jika ada perubahan.</p>
                    </div>
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

<?= $this->section('extra-js') ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    function hitungTotal() {
        let harga = $('#select-produk option:selected').data('harga') || 0;
        let qty = $('#input-jumlah').val() || 0;
        let total = harga * qty;
        $('#input-total-harga').val(total);
    }

    // Hitung saat produk atau jumlah berubah
    $('#select-produk, #input-jumlah').on('change keyup', function() {
        hitungTotal();
    });
});
</script>
<?= $this->endSection() ?>