<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Cards</title>
</head>

<body>
    <h1>My Cards</h1>
    <a href="/card/create">Add New Card</a>
    <ul>
        <?php foreach ($cards as $card): ?>
            <li>
                <?= htmlspecialchars($card['name']) ?> -
                <?= htmlspecialchars($card['card_number']) ?>
                (Balance:
                <?= htmlspecialchars($card['balance']) ?>)
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="/dashboard">Back to Dashboard</a>
</body>

</html>