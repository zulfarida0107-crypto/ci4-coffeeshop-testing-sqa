<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Login | Kopi Kenangan</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Epilogue:wght@400;600;700&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "display": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "h3": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "button": ["14px", { "lineHeight": "20px", "fontWeight": "600" }],
                        "label-md": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                        "h1": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700" }],
                        "body-sm": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                        "h2": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            background-color: #fff8f5;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(114, 90, 57, 0.1);
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="font-body-md text-on-surface min-h-screen flex flex-col justify-center items-center bg-background p-md">
    <main class="relative z-10 w-full max-w-md">
        <!-- Login Card -->
        <div class="glass-card rounded-xl p-xl flex flex-col items-center shadow-2xl">
            <!-- Brand Identity -->
            <div class="mb-lg flex flex-col items-center">
                <div
                    class="w-16 h-16 rounded-full bg-primary-container flex items-center justify-center mb-md border border-primary/20 overflow-hidden">
                    <span class="material-symbols-outlined text-on-primary-container text-4xl">local_cafe</span>
                </div>
                <h1 class="font-h1 text-h1 text-primary tracking-tight">KOPI KENANGAN</h1>
                <p class="font-body-sm text-body-sm text-on-surface-variant text-center mt-xs">Silahkan login untuk
                    masuk ke panel</p>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="w-full bg-red-100 text-red-700 p-sm rounded-lg flex items-center gap-sm mb-md text-body-sm">
                    <span class="material-symbols-outlined text-red-700 text-xl">error</span>
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form action="<?= base_url('login/auth'); ?>" method="POST" class="w-full space-y-md">
                <?= csrf_field() ?>

                <!-- Username Field -->
                <div class="flex flex-col gap-xs">
                    <label class="font-label-md text-label-md text-on-surface-variant ml-xs"
                        for="username">Username</label>
                    <div class="relative group">
                        <span
                            class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">person</span>
                        <input
                            class="w-full h-12 bg-surface-container-low border-b-2 border-outline/30 focus:border-primary text-on-surface pl-xl pr-md outline-none transition-all placeholder:text-outline/50 rounded-t-lg"
                            id="username" name="username" placeholder="Enter your username" type="text" required />
                    </div>
                </div>

                <!-- Password Field -->
                <div class="flex flex-col gap-xs">
                    <label class="font-label-md text-label-md text-on-surface-variant ml-xs"
                        for="password">Password</label>
                    <div class="relative group">
                        <span
                            class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">lock</span>
                        <input
                            class="w-full h-12 bg-surface-container-low border-b-2 border-outline/30 focus:border-primary text-on-surface pl-xl pr-md outline-none transition-all placeholder:text-outline/50 rounded-t-lg"
                            id="password" name="password" placeholder="••••••••" type="password" required />
                        <button
                            class="absolute right-sm top-1/2 -translate-y-1/2 text-outline hover:text-on-surface transition-colors"
                            type="button"
                            onclick="const p = document.getElementById('password'); p.type = p.type === 'password' ? 'text' : 'password';">
                            <span class="material-symbols-outlined">visibility</span>
                        </button>
                    </div>
                </div>

                <!-- Login Button -->
                <button
                    class="w-full h-12 bg-[#33983c] text-white font-h3 text-button rounded-lg hover:brightness-110 active:scale-[0.98] transition-all flex items-center justify-center gap-sm shadow-lg shadow-green-900/10"
                    type="submit">
                    LOGIN
                    <span class="material-symbols-outlined text-[20px]">login</span>
                </button>
            </form>

            <!-- Footer Info -->
            <div class="mt-xl text-center">
                <p class="font-body-sm text-body-sm text-on-surface-variant">
                    Don't have an account?
                    <a class="text-primary font-bold ml-xs">Contact Admin</a>
                </p>
            </div>
        </div>
        <!-- Decorative Glow -->
        <div class="absolute -bottom-xl left-1/2 -translate-x-1/2 w-64 h-32 bg-primary/10 blur-3xl rounded-full -z-10">
        </div>
    </main>
</body>

</html>