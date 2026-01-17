<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Transactions</title>
</head>

<body>
    <h1>Transaction History</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td>
                        <?= htmlspecialchars($transaction['transaction_date']) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($transaction['type']) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($transaction['amount']) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($transaction['description']) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($transaction['status']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/dashboard">Back to Dashboard</a>
</body>

</html>