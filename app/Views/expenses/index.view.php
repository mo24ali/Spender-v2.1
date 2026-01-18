<?php require __DIR__ . '/../partials/head.php'; ?>
<?php require __DIR__ . '/../partials/nav.php'; ?>

<main class="flex-grow container mx-auto px-6 py-8">
    <div class="glass rounded-xl p-8">
        <h1 class="text-3xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-purple-500">
            <?= $title ?? 'Expenses' ?></h1>
        <p class="text-gray-300">This is the Expense page content.</p>
        <!-- Expense list/table will go here -->
    </div>
</main>

<?php require __DIR__ . '/../partials/footer.php'; ?>