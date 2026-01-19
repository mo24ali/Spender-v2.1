<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Cards</title>
</head>

<body>
    <h1>My Cards</h1>
    <a href="/spender-v2/public/cards/create">Add New Card</a>
    <ul>
        <?php foreach ($cards as $card): ?>
            <li>
                <?= htmlspecialchars($card['name']) ?> -
                <?= htmlspecialchars($card['card_number']) ?>
                (Balance:
                <?= htmlspecialchars($card['balance']) ?>)
                <a href="/spender-v2/public/cards/edit?id=<?= $card['id'] ?>">Edit</a>
                <a href="/spender-v2/public/cards/delete?id=<?= $card['id'] ?>"
                    onclick="return confirm('Are you sure?')">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="/dashboard">Back to Dashboard</a>
</body>

</html>