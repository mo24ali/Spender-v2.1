<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-green-400 to-blue-500">Incomes
        </h1>
        <a href="/spender-v2/public/incomes/create"
            class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-2 rounded-lg hover:shadow-lg transition-all duration-300">
            Add New Income
        </a>
    </div>

    <div class="glass rounded-xl p-8 overflow-x-auto">
        <?php if (!empty($incomes)): ?>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-gray-400 border-b border-gray-700">
                        <th class="py-3 px-4">Title</th>
                        <th class="py-3 px-4">Amount</th>
                        <th class="py-3 px-4">Date</th>
                        <th class="py-3 px-4">Description</th>
                        <th class="py-3 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-300">
                    <?php foreach ($incomes as $income): ?>
                        <tr class="border-b border-gray-800 hover:bg-gray-800/50 transition duration-200">
                            <td class="py-3 px-4">
                                <?= htmlspecialchars($income['title']) ?>
                            </td>
                            <td class="py-3 px-4 text-green-400 font-bold">+$
                                <?= number_format($income['amount'], 2) ?>
                            </td>
                            <td class="py-3 px-4">
                                <?= htmlspecialchars($income['date']) ?>
                            </td>
                            <td class="py-3 px-4">
                                <?= htmlspecialchars($income['description'] ?? '') ?>
                            </td>
                            <td class="py-3 px-4">
                                <!-- Add edit/delete links if needed -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-gray-400 text-center py-4">No incomes found.</p>
        <?php endif; ?>
    </div>
</main>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>