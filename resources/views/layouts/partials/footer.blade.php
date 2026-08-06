<footer class="bg-white border-t border-gray-200 py-4 px-6 mt-auto">
    <div class="flex flex-col md:flex-row justify-between items-center space-y-2 md:space-y-0">
        <div class="text-sm text-gray-600">
            <p>&copy; {{ date('Y') }} Inventory Balai Medan. All rights reserved.</p>
        </div>
        
        <div class="flex items-center space-x-4 text-sm text-gray-600">
            <span>Version 1.0.0</span>
            <span class="hidden md:inline">|</span>
            <span>Laravel {{ app()->version() }}</span>
        </div>
    </div>
</footer>