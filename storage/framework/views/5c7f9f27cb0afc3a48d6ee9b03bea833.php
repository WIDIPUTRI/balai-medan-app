<header class="bg-white border-b border-gray-200 h-16 flex items-center px-4 md:px-6">
    <button id="mobile-menu-btn" class="lg:hidden mr-4 text-gray-600 hover:text-gray-900 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-200">
        <i class="fas fa-bars text-xl"></i>
    </button>
    
    <div class="flex-1 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <h2 class="text-lg md:text-xl font-semibold text-gray-800"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h2>
        </div>
        
        <div class="flex items-center space-x-4">
           
            
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <?php if(auth()->user()->photo): ?>
                    <img src="<?php echo e(asset('storage/' . auth()->user()->photo)); ?>?v=<?php echo e(filemtime(storage_path('app/public/' . auth()->user()->photo))); ?>" alt="<?php echo e(auth()->user()->name); ?>"
                         class="w-8 h-8 rounded-full object-cover border-2 border-gray-200">
                    <?php else: ?>
                    <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center">
                        <span class="text-sm font-semibold"><?php echo e(substr(auth()->user()->name, 0, 1)); ?></span>
                    </div>
                    <?php endif; ?>
                    <span class="hidden md:block text-sm font-medium text-gray-700"><?php echo e(auth()->user()->name); ?></span>
                    <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                </button>
                
                <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-48 bg-white rounded-lg border border-gray-200 py-2 z-50">
                    <div class="px-4 py-2 border-b border-gray-200">
                        <p class="text-sm font-medium text-gray-900"><?php echo e(auth()->user()->name); ?></p>
                        <p class="text-xs text-gray-500">Admin</p>
                    </div>
                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
[x-cloak] { display: none !important; }
</style><?php /**PATH D:\2025\PROJECT\balai\resources\views/layouts/partials/navbar.blade.php ENDPATH**/ ?>