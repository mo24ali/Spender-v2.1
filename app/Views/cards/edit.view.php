<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Card</title>
</head>

<body>
    <h1>Edit Card</h1>
    <form action="/cards/edit?id=<?= $card['id'] ?>" method="POST">
        <label>Card Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($card['name']) ?>" required>

        <label>Card Number (Last 4):</label>
        <input type="text" name="card_number" value="<?= htmlspecialchars($card['card_number']) ?>" required>

        <label>Balance:</label>
        <input type="number" step="0.01" name="balance" value="<?= htmlspecialchars($card['balance']) ?>" required>

        <label>Credit Limit:</label>
        <input type="number" step="0.01" name="limit" value="<?= htmlspecialchars($card['credit_limit']) ?>">

        <label>Expiry Date:</label>
        <input type="date" name="expiry_date" value="<?= htmlspecialchars($card['expiry_date']) ?>">

        <button type="submit">Update Card</button>
    </form>
</body>

</html>