<!-- resources/views/components/admin/profile-dropdown.blade.php -->
<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" 
            class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 focus:outline-none">
        <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
            <span class="text-white text-sm font-semibold">
                {{ strtoupper(substr(Auth::guard('admin')->user()->name, 0, 1)) }}
            </span>
        </div>
        <span class="hidden md:block">{{ Auth::guard('admin')->user()->name }}</span>
        <i class="fas fa-chevron-down text-xs"></i>
    </button>

    <div x-show="open" 
         @click.away="open = false"
         class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
        <div class="px-4 py-3 border-b border-gray-200">
            <p class="text-sm font-medium text-gray-900">{{ Auth::guard('admin')->user()->name }}</p>
            <p class="text-sm text-gray-500">{{ Auth::guard('admin')->user()->email }}</p>
            <p class="text-xs text-blue-600 mt-1">{{ Auth::guard('admin')->user()->role }}</p>
        </div>
        
        <div class="py-1">
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <i class="fas fa-user mr-2"></i>Profile
            </a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <i class="fas fa-cog mr-2"></i>Settings
            </a>
        </div>
        
        <div class="py-1 border-t border-gray-200">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" 
                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </button>
            </form>
        </div>
    </div>
</div>