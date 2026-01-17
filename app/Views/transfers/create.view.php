<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Make a Transfer</title>
</head>

<body>
    <h1>Transfer Money</h1>
    <form action="/transfer/create" method="POST">
        <label>From Card:</label>
        <select name="sender_id" required>
            <?php foreach ($cards as $card): ?>
                <option value="<?= $card['id'] ?>">
                    <?= htmlspecialchars($card['name']) ?> (
                    <?= $card['balance'] ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label>To Card:</label>
        <select name="receiver_id" required>
            <?php foreach ($cards as $card): ?>
                <option value="<?= $card['id'] ?>">
                    <?= htmlspecialchars($card['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Amount:</label>
        <input type="number" step="0.01" name="amount" required>

        <button type="submit">Transfer</button>
    </form>
    <a href="/dashboard">Back to Dashboard</a>
</body>

</html>