<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo e(config('app.name', 'Laravel')); ?> - Admin</title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>[x-cloak] { display: none !important; }</style>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        .farm-bg { background: linear-gradient(135deg, #eff6ff, #dbeafe, #bfdbfe); }
        aside { position: fixed; top: 0; left: 0; height: 100%; overflow-y: auto; }
        .main-content { margin-left: 16rem; }
        header { position: sticky; top: 0; z-index: 50; }
    </style>
</head>

<body class="bg-blue-50 font-sans antialiased">
<div class="min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-blue-700 text-white shadow-lg flex flex-col">
        <div class="p-6 text-center border-b border-blue-500">
            <h1 class="text-2xl font-extrabold tracking-wider text-yellow-300">KARSA FARM</h1>
            <p class="text-sm text-blue-200 mt-1">Admin Panel</p>
        </div>

        <nav class="flex-1 px-3 py-4">
            <ul class="space-y-2">
                <!-- Dashboard -->
                <li>
                    <a href="<?php echo e(route('admin.dashboard')); ?>"
                       class="flex items-center gap-3 py-2 px-3 rounded-lg hover:bg-blue-600 transition
                              <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-blue-800 font-semibold' : ''); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8m5-12l2 2m-2-2v12H5V5l2-2" />
                        </svg>
                        Dashboard
                    </a>
                </li>

                <!-- Data User -->
                <li>
                    <a href="<?php echo e(route('admin.users.index')); ?>"
                       class="flex items-center gap-3 py-2 px-3 rounded-lg hover:bg-blue-600 transition
                              <?php echo e(request()->routeIs('admin.users.*') ? 'bg-blue-800 font-semibold' : ''); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor">
                            <circle cx="12" cy="7" r="4"/><path d="M5.5 21a7.5 7.5 0 0113 0"/>
                        </svg>
                        Data User
                    </a>
                </li>

                

                <!-- Logout -->
                <li>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" title="Keluar dari aplikasi"
                                class="flex items-center gap-3 w-full py-2 px-3 rounded-lg bg-red-600 hover:bg-red-700 font-semibold transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col main-content">
        <!-- Header -->
        <header class="bg-blue-700 px-6 py-4 text-white flex items-center shadow-md">
            <h1 class="mx-auto text-lg font-bold tracking-wide"><?php echo $__env->yieldContent('header', 'Dashboard Admin'); ?></h1>
            <div class="ml-auto flex items-center space-x-3">
                <?php if(Auth::user()->foto): ?>
                    <img src="<?php echo e(asset('storage/' . Auth::user()->foto)); ?>" class="w-10 h-10 rounded-full object-cover border-2 border-white">
                <?php else: ?>
                    <div class="w-10 h-10 rounded-full bg-yellow-300 text-blue-900 flex items-center justify-center font-bold">
                        <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                    </div>
                <?php endif; ?>
                <span class="font-medium"><?php echo e(Auth::user()->name); ?></span>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 p-6 overflow-auto farm-bg">
            <div class="max-w-7xl mx-auto">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </main>
    </div>
</div>

<?php echo $__env->yieldContent('scripts'); ?>

</body>
</html>
<?php /**PATH C:\laragon\www\ternakpro2\resources\views/layouts/app_admin.blade.php ENDPATH**/ ?>