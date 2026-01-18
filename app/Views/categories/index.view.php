<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-500">
            Categories</h1>
        <a href="/spender-v2/public/categories/create"
            class="bg-gradient-to-r from-purple-500 to-pink-600 text-white px-6 py-2 rounded-lg hover:shadow-lg transition-all duration-300">
            Add New Category
        </a>
    </div>

    <div class="glass rounded-xl p-8 overflow-x-auto">
        <?php if (!empty($categories)): ?>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-gray-400 border-b border-gray-700">
                        <th class="py-3 px-4">Name</th>
                        <th class="py-3 px-4">Type</th>
                        <th class="py-3 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-300">
                    <?php foreach ($categories as $category): ?>
                        <tr class="border-b border-gray-800 hover:bg-gray-800/50 transition duration-200">
                            <td class="py-3 px-4">
                                <?= htmlspecialchars($category['name']) ?>
                            </td>
                            <td class="py-3 px-4">
                                <span
                                    class="px-2 py-1 rounded-full text-xs font-semibold
                                    <?= $category['type'] === 'income' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' ?>">
                                    <?= ucfirst($category['type']) ?>
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <a href="/spender-v2/public/categories/delete?id=<?= $category['id'] ?>"
                                    class="text-red-400 hover:text-red-300 transition-colors"
                                    onclick="return confirm('Are you sure?')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-gray-400 text-center py-4">No categories found.</p>
        <?php endif; ?>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>