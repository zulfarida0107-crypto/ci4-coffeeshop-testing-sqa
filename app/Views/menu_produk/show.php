<?= $this->extend('base') ?>
<?= $this->section('content') ?>

<div class="w-full flex-1 flex flex-col">
    <!-- Header Actions -->
    <div class="flex justify-between items-end mb-lg">
        <div>
            <span class="font-label-md text-label-md text-primary tracking-widest uppercase mb-xs block">Product Inventory</span>
            <h1 class="font-h1 text-h1 text-on-surface"><?= esc($result['nama_produk']) ?></h1>
        </div>
        <div class="flex gap-md">
            <!-- Kembali Button: Blue (Read/Navigation) -->
            <a href="<?= base_url('menu-produk') ?>" class="flex items-center gap-sm px-lg py-sm rounded-xl bg-blue-600 text-white font-button text-button hover:bg-blue-700 transition-all active:scale-95 shadow-lg shadow-blue-200">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali
            </a>
            <!-- Edit Data Button: Yellow -->
            <a href="<?= base_url('menu-produk/edit/' . $result['id']) ?>" class="flex items-center gap-sm px-lg py-sm rounded-xl bg-yellow-400 text-on-surface font-button text-button hover:bg-yellow-500 transition-all active:scale-95 shadow-lg shadow-yellow-100">
                <span class="material-symbols-outlined">edit</span>
                Edit Data
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="grid grid-cols-12 gap-md flex-1">
        <!-- Left: Quick Info -->
        <div class="col-span-12 lg:col-span-4 space-y-md">
            <div class="glass-card rounded-xl p-md border-primary/20 bg-primary/5">
                <div class="mb-md">
                    <p class="font-label-md text-label-md text-outline mb-xs">Current Price</p>
                    <h2 class="font-h2 text-h2 text-primary">Rp <?= number_format($result['harga'], 0, ',', '.') ?></h2>
                </div>
                <div>
                    <p class="font-label-md text-label-md text-outline mb-xs">SKU ID</p>
                    <p class="font-body-md text-on-surface font-bold">#<?= esc($result['id']) ?></p>
                </div>
            </div>

            <div class="glass-card p-md rounded-xl flex items-center gap-md">
                <div class="w-12 h-12 rounded-lg bg-primary-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary">analytics</span>
                </div>
                <div>
                    <p class="font-label-md text-label-md text-outline">Sales Today</p>
                    <p class="font-h3 text-h3 text-on-surface">142 Cups</p>
                </div>
            </div>
            <div class="glass-card p-md rounded-xl flex items-center gap-md">
                <div class="w-12 h-12 rounded-lg bg-tertiary-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-tertiary">inventory</span>
                </div>
                <div>
                    <p class="font-label-md text-label-md text-outline">Stock Level</p>
                    <p class="font-h3 text-h3 text-on-surface">450 Unit</p>
                </div>
            </div>
            <div class="glass-card p-md rounded-xl flex items-center gap-md">
                <div class="w-12 h-12 rounded-lg bg-secondary-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-secondary">grade</span>
                </div>
                <div>
                    <p class="font-label-md text-label-md text-outline">Avg Rating</p>
                    <div class="flex items-center gap-xs">
                        <p class="font-h3 text-h3 text-on-surface">4.8</p>
                        <span class="material-symbols-outlined text-primary fill-1 text-sm">star</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Form Details -->
        <div class="col-span-12 lg:col-span-8">
            <div class="glass-card rounded-xl p-xl h-full flex flex-col gap-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                    <div class="space-y-sm">
                        <label class="font-label-md text-label-md text-outline block">ID Produk</label>
                        <input class="glass-input w-full px-md py-sm rounded-lg text-on-surface-variant bg-surface-container-low cursor-not-allowed" readonly="" type="text" value="<?= esc($result['id']) ?>"/>
                    </div>
                    <div class="space-y-sm">
                        <label class="font-label-md text-label-md text-outline block">Nama Produk</label>
                        <input class="glass-input w-full px-md py-sm rounded-lg text-on-surface font-semibold bg-surface-container-low cursor-not-allowed" readonly="" type="text" value="<?= esc($result['nama_produk']) ?>"/>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                    <div class="space-y-sm">
                        <label class="font-label-md text-label-md text-outline block">Harga (Rp)</label>
                        <div class="relative">
                            <span class="absolute left-md top-1/2 -translate-y-1/2 text-outline font-label-md">Rp</span>
                            <input class="glass-input w-full pl-xl pr-md py-sm rounded-lg text-on-surface bg-surface-container-low cursor-not-allowed" readonly="" type="number" value="<?= esc($result['harga']) ?>"/>
                        </div>
                    </div>
                    <div class="space-y-sm">
                        <label class="font-label-md text-label-md text-outline block">Kategori</label>
                        <div class="flex flex-wrap gap-sm">
                            <?php
                            $categories = ['Kopi', 'Non-Kopi', 'Pastry'];
                            foreach ($categories as $cat) :
                                if ($result['kategori'] == $cat) :
                            ?>
                                <span class="px-md py-sm bg-primary text-on-primary rounded-full font-label-md text-label-md flex items-center gap-xs">
                                    <?= esc($cat) ?>
                                    <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                </span>
                            <?php else : ?>
                                <span class="px-md py-sm border border-outline text-outline rounded-full font-label-md text-label-md transition-colors opacity-50 cursor-not-allowed">
                                    <?= esc($cat) ?>
                                </span>
                            <?php
                                endif;
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>

                <div class="space-y-sm flex-1 flex flex-col">
                    <label class="font-label-md text-label-md text-outline block">Deskripsi</label>
                    <textarea class="glass-input w-full p-md rounded-lg text-on-surface flex-1 resize-none leading-relaxed min-h-[120px] bg-surface-container-low cursor-not-allowed" readonly=""><?= esc($result['deskripsi']) ?: '-' ?></textarea>
                </div>

                <div class="flex items-center justify-between p-md bg-surface-container-highest/30 rounded-xl mt-auto">
                    <div class="flex items-center gap-sm">
                        <span class="material-symbols-outlined text-primary">info</span>
                        <p class="font-label-md text-label-md text-on-surface-variant">Last updated: just now by Admin</p>
                    </div>
                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 rounded-full border-2 border-surface bg-primary-container flex items-center justify-center text-[10px] font-bold">JD</div>
                        <div class="w-8 h-8 rounded-full border-2 border-surface bg-secondary-container flex items-center justify-center text-[10px] font-bold">AS</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>