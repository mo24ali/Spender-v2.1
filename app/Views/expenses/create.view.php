<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Expense</title>
</head>

<body>
    <h1>Add Expense</h1>
    <form action="/expense/create" method="POST">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="description" placeholder="Description"></textarea>
        <input type="number" step="0.01" name="amount" placeholder="Amount" required>
        <label>Category:</label>
        <select name="category_id">
            <!-- Fetch categories dynamically later, assuming manual or empty for now or passing categories from controller -->
            <option value="">Uncategorized</option>
        </select>

        <label>Pay with Card:</label>
        <select name="card_id">
            <option value="">None (Cash/Other)</option>
            <?php foreach ($cards as $card): ?>
                <option value="<?= $card['id'] ?>">
                    <?= htmlspecialchars($card['name']) ?> (
                    <?= $card['balance'] ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label>Due Date:</label>
        <input type="date" name="due_date">

        <button type="submit">Save Expense</button>
    </form>
</body>

</html>