<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?? 'Admin Panel | Kopi Kenangan'; ?></title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-card {
            background: rgba(255, 234, 222, 0.4);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(127, 118, 106, 0.15);
        }
        .glass-input {
            background: #ffffff;
            border: 1px solid #7f766a;
            transition: all 0.3s ease;
        }
        .glass-input:focus {
            border-color: #725a39;
            outline: none;
            box-shadow: 0 0 0 2px rgba(114, 90, 57, 0.2);
        }
    </style>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container": "#ffeade",
                        "on-tertiary": "#ffffff",
                        "on-error-container": "#93000a",
                        "on-surface-variant": "#4d453c",
                        "on-primary": "#ffffff",
                        "on-primary-fixed": "#281801",
                        "on-tertiary-container": "#494a38",
                        "on-primary-fixed-variant": "#584324",
                        "inverse-on-surface": "#ffede4",
                        "on-secondary": "#ffffff",
                        "on-secondary-container": "#796048",
                        "on-tertiary-fixed-variant": "#474836",
                        "primary": "#725a39",
                        "secondary-container": "#fedcbe",
                        "tertiary-fixed": "#e4e4cc",
                        "on-secondary-fixed-variant": "#59422c",
                        "tertiary-container": "#babaa3",
                        "error-container": "#ffdad6",
                        "on-secondary-fixed": "#291806",
                        "outline-variant": "#d1c5b8",
                        "tertiary-fixed-dim": "#c8c8b0",
                        "inverse-surface": "#452a16",
                        "on-tertiary-fixed": "#1b1d0e",
                        "surface-container-highest": "#ffdcc6",
                        "surface-container-high": "#ffe3d2",
                        "surface": "#fff8f5",
                        "surface-tint": "#725a39",
                        "on-surface": "#2d1604",
                        "primary-container": "#d2b48c",
                        "error": "#ba1a1a",
                        "surface-variant": "#ffdcc6",
                        "secondary": "#725a42",
                        "primary-fixed": "#feddb3",
                        "primary-fixed-dim": "#e1c299",
                        "background": "#fff8f5",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#fff1ea",
                        "surface-dim": "#ffd1b3",
                        "secondary-fixed-dim": "#e1c1a4",
                        "outline": "#7f766a",
                        "secondary-fixed": "#fedcbe",
                        "on-error": "#ffffff",
                        "tertiary": "#5e604d",
                        "inverse-primary": "#e1c299",
                        "on-primary-container": "#5b4526",
                        "on-background": "#2d1604",
                        "surface-bright": "#fff8f5"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "lg": "40px",
                        "gutter": "24px",
                        "base": "8px",
                        "sm": "12px",
                        "md": "24px",
                        "xs": "4px",
                        "container-max": "1440px",
                        "xl": "64px"
                    },
                    "fontFamily": {
                        "body-md": ["Epilogue"],
                        "display": ["Epilogue"],
                        "h3": ["Epilogue"],
                        "button": ["Epilogue"],
                        "label-md": ["Epilogue"],
                        "h1": ["Epilogue"],
                        "body-sm": ["Epilogue"],
                        "h2": ["Epilogue"],
                        "body-lg": ["Epilogue"]
                    },
                    "fontSize": {
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "display": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "h3": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                        "button": ["14px", {"lineHeight": "20px", "fontWeight": "600"}],
                        "label-md": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "h1": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                        "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                        "h2": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}]
                    }
                },
            },
        }
    </script>
</head>
<body class="bg-background text-on-surface font-body-md antialiased selection:bg-primary-container selection:text-on-primary-container">

<!-- SideNavBar -->
<aside class="fixed left-0 top-0 h-full flex flex-col py-md z-40 bg-secondary dark:bg-inverse-surface w-64 shadow-xl">
    <div class="px-md mb-xl">
        <a href="<?= base_url('/') ?>" class="block">
            <h1 class="font-h3 text-h3 font-bold text-on-secondary">Kopi Kenangan</h1>
            <p class="font-body-sm text-body-sm text-on-secondary/70">Management Portal</p>
        </a>
    </div>
    
    <?php
    $currentURL = current_url();
    $isMenuKopi = strpos($currentURL, 'menu-produk') !== false;
    $isPesanan = strpos($currentURL, 'pesanan') !== false && strpos($currentURL, 'desain-pesanan') === false;
    $isDesainPesanan = strpos($currentURL, 'desain-pesanan') !== false;
    $isPesanMasuk = strpos($currentURL, 'pesan-kontak') !== false;
    $isUser = strpos($currentURL, 'user') !== false;
    ?>

    <nav class="flex-1 space-y-xs">
        <a class="flex items-center gap-md <?= $isUser ? 'bg-primary-container text-on-primary-container rounded-lg' : 'text-on-secondary/70 hover:bg-secondary-fixed-dim/20 hover:text-on-secondary transition-all' ?> px-md py-sm mx-sm font-label-md text-label-md" href="<?= base_url('user') ?>">
            <span class="material-symbols-outlined">group</span>
            Manajemen User
        </a>
        <a class="flex items-center gap-md <?= $isMenuKopi ? 'bg-primary-container text-on-primary-container rounded-lg' : 'text-on-secondary/70 hover:bg-secondary-fixed-dim/20 hover:text-on-secondary transition-all' ?> px-md py-sm mx-sm font-label-md text-label-md" href="<?= base_url('menu-produk') ?>">
            <span class="material-symbols-outlined">local_cafe</span>
            Menu Kopi
        </a>
        <a class="flex items-center gap-md <?= $isPesanan ? 'bg-primary-container text-on-primary-container rounded-lg' : 'text-on-secondary/70 hover:bg-secondary-fixed-dim/20 hover:text-on-secondary transition-all' ?> px-md py-sm mx-sm font-label-md text-label-md" href="<?= base_url('pesanan') ?>">
            <span class="material-symbols-outlined">history</span>
            Pesanan
        </a>
        <a class="flex items-center gap-md <?= $isDesainPesanan ? 'bg-primary-container text-on-primary-container rounded-lg' : 'text-on-secondary/70 hover:bg-secondary-fixed-dim/20 hover:text-on-secondary transition-all' ?> px-md py-sm mx-sm font-label-md text-label-md" href="<?= base_url('desain-pesanan') ?>">
            <span class="material-symbols-outlined">design_services</span>
            Desain Pesanan
        </a>
        <a class="flex items-center gap-md <?= $isPesanMasuk ? 'bg-primary-container text-on-primary-container rounded-lg' : 'text-on-secondary/70 hover:bg-secondary-fixed-dim/20 hover:text-on-secondary transition-all' ?> px-md py-sm mx-sm font-label-md text-label-md" href="<?= base_url('pesan-kontak') ?>">
            <span class="material-symbols-outlined">mail</span>
            Pesan Masuk
        </a>
    </nav>
    <div class="mt-auto pt-md space-y-xs">
        <a class="flex items-center gap-md text-on-secondary/70 px-md py-sm mx-sm hover:bg-secondary-fixed-dim/20 hover:text-on-secondary transition-all font-label-md text-label-md" href="<?= base_url('logout') ?>">
            <span class="material-symbols-outlined">logout</span>
            Logout
        </a>
    </div>
</aside>

<!-- Main Content -->
<main class="ml-64 h-screen flex flex-col">
    <!-- TopAppBar -->
    <header class="flex justify-between items-center w-full px-lg py-sm sticky top-0 z-50 bg-surface dark:bg-surface-dim shadow-sm border-b border-outline-variant dark:border-outline">
        <div class="flex items-center gap-lg flex-1">
            <!-- Search removed -->
        </div>
        <div class="flex items-center gap-lg">
            <div class="flex items-center gap-md text-on-surface-variant">
                <?php
                    $db = \Config\Database::connect();
                    $notifCount = $db->table('pesan_kontak')->countAllResults();
                    $latestMessages = $db->table('pesan_kontak')->orderBy('tanggal_dikirim', 'DESC')->limit(5)->get()->getResultArray();
                ?>
                <div class="relative group">
                    <button class="relative hover:bg-surface-container-high transition-colors p-xs rounded-full cursor-pointer flex items-center justify-center">
                        <span class="material-symbols-outlined">notifications</span>
                        <?php if($notifCount > 0): ?>
                            <span class="absolute top-0 right-0 w-4 h-4 bg-red-500 text-white text-[10px] font-bold flex items-center justify-center rounded-full"><?= $notifCount ?></span>
                        <?php endif; ?>
                    </button>
                    
                    <!-- Notification Popup -->
                    <div class="absolute right-0 mt-2 w-80 bg-surface rounded-xl shadow-lg border border-outline-variant/30 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50 flex flex-col">
                        <div class="p-sm border-b border-outline-variant/30 font-bold text-on-surface flex items-center justify-between">
                            <span>Pesan Masuk</span>
                            <span class="bg-primary text-white text-[10px] px-2 py-0.5 rounded-full"><?= $notifCount ?> Total</span>
                        </div>
                        <div class="max-h-64 overflow-y-auto">
                            <?php if(!empty($latestMessages)): ?>
                                <?php foreach($latestMessages as $msg): ?>
                                    <a href="<?= base_url('pesan-kontak/show/'.$msg['id']) ?>" class="block p-sm hover:bg-surface-container-low border-b border-outline-variant/10">
                                        <div class="flex justify-between items-start mb-1">
                                            <div class="font-semibold text-body-sm text-on-surface"><?= esc($msg['nama']) ?></div>
                                            <div class="text-[10px] text-on-surface-variant"><?= date('H:i', strtotime($msg['tanggal_dikirim'])) ?></div>
                                        </div>
                                        <div class="text-[12px] text-on-surface-variant truncate font-medium"><?= esc($msg['subjek']) ?></div>
                                        <div class="text-[11px] text-on-surface-variant/70 truncate"><?= esc($msg['pesan']) ?></div>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="p-md text-center text-body-sm text-on-surface-variant flex flex-col items-center gap-2">
                                    <span class="material-symbols-outlined text-3xl opacity-50">drafts</span>
                                    Belum ada pesan baru
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-2 text-center border-t border-outline-variant/30 bg-surface-container-lowest rounded-b-xl">
                            <a href="<?= base_url('pesan-kontak') ?>" class="text-primary text-[12px] font-bold hover:underline block w-full">Lihat Semua Pesan</a>
                        </div>
                    </div>
                </div>
                
                <div class="w-8 h-8 rounded-full overflow-hidden border border-outline-variant bg-surface-container ml-sm">
                    <img alt="Manager Profile" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name=Admin&background=random"/>
                </div>
            </div>
        </div>
    </header>

    <div class="flex-1 p-xl w-full flex flex-col min-h-0 overflow-y-auto">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined">check_circle</span>
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined">error</span>
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </div>

    <!-- FOOTER -->
    <footer class="py-sm bg-surface-container border-t border-outline-variant mt-auto text-center text-body-sm text-outline">
        <strong>Admin Panel | Kopi Kenangan &copy; 2026</strong> |
        CodeIgniter <?= CodeIgniter\CodeIgniter::CI_VERSION ?>
    </footer>
</main>

<?= $this->renderSection('extra-js') ?>
</body>
</html>