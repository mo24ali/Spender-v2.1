<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Income</title>
</head>

<body>
    <h1>Add Income</h1>
    <form action="/income/create" method="POST">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="description" placeholder="Description"></textarea>
        <input type="number" step="0.01" name="amount" placeholder="Amount" required>

        <label>Deposit to Card:</label>
        <select name="card_id">
            <option value="">None (Cash)</option>
            <?php foreach ($cards as $card): ?>
                <option value="<?= $card['id'] ?>">
                    <?= htmlspecialchars($card['name']) ?> (
                    <?= $card['balance'] ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label>Date Received:</label>
        <input type="date" name="date" required>

        <button type="submit">Save Income</button>
    </form>
</body>

</html>