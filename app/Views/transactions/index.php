<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="row mb-4">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
        <h2>All Transactions</h2>
        <a href="/spender-v2/public/dashboard" class="btn btn-outline-secondary">Back to Dashboard</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $t): ?>
                        <tr>
                            <td>
                                <?= htmlspecialchars($t['transaction_date']) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($t['title']) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($t['category_name'] ?? '-') ?>
                            </td>
                            <td class="<?= $t['type'] === 'income' ? 'text-success' : 'text-danger' ?>">
                                <?= $t['type'] === 'income' ? '+' : '-' ?>$
                                <?= number_format($t['amount'], 2) ?>
                            </td>
                            <td><span class="badge bg-<?= $t['type'] === 'income' ? 'success' : 'danger' ?>">
                                    <?= ucfirst($t['type']) ?>
                                </span></td>
                            <td>
                                <a href="/spender-v2/public/transaction/delete?id=<?= $t['id'] ?>"
                                    class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>