<?= $this->extend('base') ?>
<?= $this->section('content') ?>

<div class="w-full flex-1 flex flex-col">
    <!-- Header Actions -->
    <div class="flex justify-between items-end mb-lg">
        <div>

            <span
                class="font-label-md text-label-md text-primary tracking-widest uppercase mb-xs block">Management</span>
            <h1 class="font-h1 text-h1 text-on-surface">Tambah Pesanan Baru</h1>
        </div>
        <div class="flex gap-md">
            <a href="<?= base_url('pesanan') ?>"
                class="flex items-center gap-sm px-lg py-sm rounded-xl bg-surface-container-highest text-on-surface-variant font-button text-button hover:brightness-95 transition-all active:scale-95 shadow-sm">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali
            </a>
        </div>
    </div>

    <!-- Form Container -->
    <div class="glass-card rounded-xl p-xl shadow-sm border border-outline-variant/30">
        <form action="<?= base_url('pesanan/store'); ?>" method="post" class="space-y-lg">
            <?= csrf_field(); ?>

            <div class="space-y-sm">
                <label class="font-label-md text-label-md text-on-surface-variant block">Nama Pelanggan</label>
                <div class="relative">
                    <span
                        class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">person</span>
                    <input type="text" name="nama_pelanggan"
                        class="glass-input w-full pl-xl pr-md py-sm rounded-lg text-on-surface placeholder:text-outline-variant/50 focus:ring-2 focus:ring-primary/20"
                        placeholder="Masukkan nama pelanggan..." value="<?= old('nama_pelanggan') ?>" required>
                </div>
            </div>

            <div class="border-t border-outline-variant/30 pt-lg mt-lg">
                <div class="flex justify-between items-center mb-md">
                    <label class="font-h3 text-h3 text-on-surface block">Daftar Menu Pesanan</label>
                    <button type="button" id="btn-tambah-menu"
                        class="flex items-center gap-xs px-sm py-xs rounded-lg bg-surface-container-highest text-primary font-label-md hover:bg-primary/10 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">add</span> Menu Lain
                    </button>
                </div>

                <div id="wrapper-menu" class="space-y-md">
                    <div
                        class="menu-item flex flex-col md:flex-row gap-sm items-end bg-surface-container-low p-md rounded-lg border border-outline-variant/20">
                        <div class="w-full md:w-5/12 space-y-xs">
                            <label class="font-label-md text-label-md text-on-surface-variant">Pilih Menu</label>
                            <div class="relative">
                                <select name="id_produk[]"
                                    class="glass-input w-full px-md py-sm rounded-lg text-on-surface appearance-none focus:ring-2 focus:ring-primary/20 select-produk"
                                    required>
                                    <option value="" data-harga="0">-- Pilih Menu --</option>
                                    <?php foreach ($produk as $p): ?>
                                        <option value="<?= $p['id']; ?>" data-harga="<?= $p['harga']; ?>">
                                            #<?= $p['id']; ?> (<?= esc($p['nama_produk']); ?>) - Rp
                                            <?= number_format($p['harga'], 0, ',', '.'); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <span
                                    class="material-symbols-outlined absolute right-md top-1/2 -translate-y-1/2 text-outline pointer-events-none">arrow_drop_down</span>
                            </div>
                        </div>
                        <div class="w-full md:w-2/12 space-y-xs">
                            <label class="font-label-md text-label-md text-on-surface-variant">Jumlah</label>
                            <input type="number" name="jumlah[]"
                                class="glass-input w-full px-md py-sm rounded-lg text-on-surface focus:ring-2 focus:ring-primary/20 input-jumlah text-center"
                                value="1" min="1" required>
                        </div>
                        <div class="w-full md:w-4/12 space-y-xs">
                            <label class="font-label-md text-label-md text-on-surface-variant">Sub-Total</label>
                            <input type="text"
                                class="glass-input w-full px-md py-sm rounded-lg text-on-surface-variant bg-surface-container-highest/50 cursor-not-allowed input-subtotal"
                                value="Rp 0" readonly>
                        </div>
                        <div class="w-full md:w-1/12 flex justify-end">
                            <button type="button"
                                class="w-full h-[42px] flex items-center justify-center rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition-colors btn-hapus-baris"
                                style="display:none;">
                                <span class="material-symbols-outlined text-[20px]">delete</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="bg-surface-container p-lg rounded-xl border border-outline-variant/30 flex flex-col md:flex-row justify-between items-center gap-lg">
                <div class="w-full md:w-1/3 space-y-xs">
                    <label class="font-label-md text-label-md text-on-surface-variant block">Status Pesanan</label>
                    <div class="relative">
                        <select name="status_pesanan"
                            class="glass-input w-full px-md py-sm rounded-lg text-on-surface appearance-none focus:ring-2 focus:ring-primary/20">
                            <option value="Baru">Baru</option>
                            <option value="Proses">Proses</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                        <span
                            class="material-symbols-outlined absolute right-md top-1/2 -translate-y-1/2 text-outline pointer-events-none">arrow_drop_down</span>
                    </div>
                </div>
                <div class="w-full md:w-2/3 text-right">
                    <span class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Total
                        Bayar</span>
                    <h3 id="grand-total" class="font-h1 text-[32px] text-primary font-bold">Rp 0</h3>
                    <input type="hidden" name="total_harga" id="input-total-harga" value="0">
                </div>
            </div>

            <div class="pt-md flex items-center justify-end gap-sm">
                <button type="submit"
                    class="flex items-center gap-sm px-xl py-sm rounded-xl bg-primary text-on-primary font-button text-button hover:brightness-110 transition-all active:scale-95 shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined">save</span>
                    Simpan Semua Pesanan
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        function hitungTotal() {
            let grandTotal = 0;
            $('.menu-item').each(function () {
                let harga = $(this).find('.select-produk option:selected').data('harga') || 0;
                let qty = $(this).find('.input-jumlah').val() || 0;
                let subtotal = harga * qty;

                $(this).find('.input-subtotal').val('Rp ' + subtotal.toLocaleString('id-ID'));
                grandTotal += subtotal;
            });
            $('#grand-total').text('Rp ' + grandTotal.toLocaleString('id-ID'));
            $('#input-total-harga').val(grandTotal);
        }

        $('#btn-tambah-menu').click(function () {
            let barisBaru = $('.menu-item:first').clone();
            barisBaru.find('.select-produk').val('');
            barisBaru.find('.input-jumlah').val(1);
            barisBaru.find('.input-subtotal').val('Rp 0');
            barisBaru.find('.btn-hapus-baris').show();
            $('#wrapper-menu').append(barisBaru);
        });

        $(document).on('click', '.btn-hapus-baris', function () {
            $(this).closest('.menu-item').remove();
            hitungTotal();
        });

        $(document).on('change', '.select-produk, .input-jumlah', function () {
            hitungTotal();
        });
    });
</script>
<?= $this->endSection() ?>