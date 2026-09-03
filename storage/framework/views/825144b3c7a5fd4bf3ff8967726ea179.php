<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Inventory Management'); ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <?php echo $__env->make('layouts.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        
        <div class="flex flex-col flex-1 overflow-hidden">
            <?php echo $__env->make('layouts.partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            
            <main class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8">
                <?php if(session('success')): ?>
                <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span><?php echo e(session('success')); ?></span>
                    </div>
                </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span><?php echo e(session('error')); ?></span>
                    </div>
                </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </main>

            <?php echo $__env->make('layouts.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <!-- Currency Input Helper -->
    <script>
        // Rupiah Input Formatter
        function formatRupiahInput(input) {
            let value = input.value.replace(/[^\d]/g, '');
            if (value === '') {
                input.value = '';
                return;
            }

            // Format with thousand separator
            value = parseInt(value);
            if (isNaN(value)) {
                input.value = '';
                return;
            }

            input.value = value.toLocaleString('id-ID');
        }

        // Parse formatted input back to number
        function parseRupiahInput(value) {
            return parseInt(value.replace(/[^\d]/g, '')) || 0;
        }

        // Auto-format rupiah inputs
        document.addEventListener('DOMContentLoaded', function() {
            const rupiahInputs = document.querySelectorAll('input[data-format="rupiah"]');

            rupiahInputs.forEach(input => {
                // Format on input
                input.addEventListener('input', function() {
                    formatRupiahInput(this);
                });

                // Format on focus
                input.addEventListener('focus', function() {
                    formatRupiahInput(this);
                });

                // Format on blur
                input.addEventListener('blur', function() {
                    formatRupiahInput(this);
                });

                // Initial format
                if (input.value) {
                    formatRupiahInput(input);
                }
            });
        });
    </script>

    <!-- Mobile Menu JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileSidebar = document.getElementById('mobile-sidebar');
            const closeSidebarBtn = document.getElementById('close-sidebar-btn');
            const sidebarContent = mobileSidebar.querySelector('aside');

            function openSidebar() {
                mobileSidebar.classList.remove('hidden');
                setTimeout(() => {
                    sidebarContent.classList.remove('-translate-x-full');
                }, 10);
            }

            function closeSidebar() {
                sidebarContent.classList.add('-translate-x-full');
                setTimeout(() => {
                    mobileSidebar.classList.add('hidden');
                }, 300);
            }

            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', openSidebar);
            }

            if (closeSidebarBtn) {
                closeSidebarBtn.addEventListener('click', closeSidebar);
            }

            // Close sidebar when clicking on overlay
            mobileSidebar.addEventListener('click', function(e) {
                if (e.target === mobileSidebar) {
                    closeSidebar();
                }
            });

            // Close sidebar when clicking on navigation links
            const navLinks = mobileSidebar.querySelectorAll('nav a');
            navLinks.forEach(link => {
                link.addEventListener('click', closeSidebar);
            });
        });
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>

    <?php if(session('success')): ?>
    <script>
        showAlert('success', '<?php echo e(session('success')); ?>');
    </script>
    <?php endif; ?>

    <?php if(session('error')): ?>
    <script>
        showAlert('error', '<?php echo e(session('error')); ?>');
    </script>
    <?php endif; ?>
</body>
</html><?php /**PATH D:\2025\PROJECT\balai\resources\views/layouts/app.blade.php ENDPATH**/ ?>