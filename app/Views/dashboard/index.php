<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>

<body>
    <h1>Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?></h1>
    <a href="/auth/logout">Logout</a>

    <section>
        <h2>My Cards</h2>
        <a href="/card/create">Add Card</a>
        <ul>
            <?php foreach ($cards as $card): ?>
                <li>
                    <?= htmlspecialchars($card['name']) ?>: $<?= htmlspecialchars($card['balance']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <section>
        <h2>Recent Transactions</h2>
        <a href="/transaction/index">View All</a> |
        <a href="/transfer/create">New Transfer</a> |
        <a href="/expense/create">Add Expense</a> |
        <a href="/income/create">Add Income</a>

        <table border="1">
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Type</th>
            </tr>
            <?php foreach ($recentTransactions as $transaction): ?>
                <tr>
                    <td><?= htmlspecialchars($transaction['transaction_date']) ?></td>
                    <td><?= htmlspecialchars($transaction['description']) ?></td>
                    <td>$<?= htmlspecialchars($transaction['amount']) ?></td>
                    <td><?= htmlspecialchars($transaction['type']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>
</body>

</html>