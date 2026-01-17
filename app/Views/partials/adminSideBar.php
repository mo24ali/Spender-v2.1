<aside class="w-64 glass h-full fixed left-0 top-0 pt-20 px-4 border-r border-gray-700 hidden md:block">
    <div class="mb-8">
        <h2 class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-green-400 to-blue-500">Admin
            Panel</h2>
    </div>
    <nav class="space-y-2">
        <a href="/spender-v2/public/dashboard"
            class="block px-4 py-2 rounded hover:bg-white/10 transition <?= str_contains($_SERVER['REQUEST_URI'], 'dashboard') ? 'bg-white/10' : '' ?>">Overview</a>
        <a href="/spender-v2/public/users" class="block px-4 py-2 rounded hover:bg-white/10 transition">Users</a>
        <a href="/spender-v2/public/expenses" class="block px-4 py-2 rounded hover:bg-white/10 transition">All
            Expenses</a>
        <a href="/spender-v2/public/settings" class="block px-4 py-2 rounded hover:bg-white/10 transition">Settings</a>
    </nav>
</aside>