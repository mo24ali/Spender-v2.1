<?php require __DIR__ . '/layouts/header.php'; ?>

<div class="row mb-4">
    <div class="col-md-12">
        <h2>Dashboard</h2>
        <p class="text-muted">Welcome, <?= htmlspecialchars($user_name ?? 'User') ?></p>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card p-3 bg-success text-white">
            <h5>Total Income</h5>
            <h3>$<?= number_format($total_income, 2) ?></h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3 bg-danger text-white">
            <h5>Total Expenses</h5>
            <h3>$<?= number_format($total_expense, 2) ?></h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3 bg-primary text-white">
            <h5>Balance</h5>
            <h3>$<?= number_format($balance, 2) ?></h3>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Transactions</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
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
                                    <td><?= htmlspecialchars($t['transaction_date']) ?></td>
                                    <td><?= htmlspecialchars($t['title']) ?></td>
                                    <td><?= htmlspecialchars($t['category_name'] ?? '-') ?></td>
                                    <td class="<?= $t['type'] === 'income' ? 'text-success' : 'text-danger' ?>">
                                        <?= $t['type'] === 'income' ? '+' : '-' ?>$<?= number_format($t['amount'], 2) ?>
                                    </td>
                                    <td><span
                                            class="badge bg-<?= $t['type'] === 'income' ? 'success' : 'danger' ?>"><?= ucfirst($t['type']) ?></span>
                                    </td>
                                    <td>
                                        <a href="/spender-v2/public/transaction/delete?id=<?= $t['id'] ?>"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($transactions)): ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No transactions found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-4">
            <h5>Add Transaction</h5>
            <form action="/spender-v2/public/transaction/create" method="POST">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input type="number" step="0.01" name="amount" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select">
                        <option value="">Select Category</option>
                        <?php if (isset($categories)): ?>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-select" required>
                        <option value="expense">Expense</option>
                        <option value="income">Income</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Add Transaction</button>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/layouts/footer.php'; ?>