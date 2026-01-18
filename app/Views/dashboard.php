<?php require __DIR__ . '/layouts/header.php'; ?>

<div class="row mb-4">
    <div class="col-md-12">
        <h2>Dashboard</h2>
        <p class="text-muted">Welcome, <?= htmlspecialchars($user_name ?? 'User') ?></p>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <h2 class="text-gradient">Dashboard</h2>
        <p class="text-secondary">Welcome back, <?= htmlspecialchars($user_name ?? 'User') ?></p>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="glass-card p-4 text-center">
            <h5 class="text-success mb-2">Total Income</h5>
            <h3 class="fw-bold">$<?= number_format($total_income, 2) ?></h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card p-4 text-center">
            <h5 class="text-danger mb-2">Total Expenses</h5>
            <h3 class="fw-bold">$<?= number_format($total_expense, 2) ?></h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card p-4 text-center">
            <h5 class="text-info mb-2">Balance</h5>
            <h3 class="fw-bold">$<?= number_format($balance, 2) ?></h3>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="glass-card h-100">
            <div class="card-header d-flex justify-content-between align-items-center p-4">
                <h5 class="mb-0">Recent Transactions</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Date</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transactions as $t): ?>
                                <tr>
                                    <td class="ps-4 text-secondary"><?= htmlspecialchars($t['transaction_date']) ?></td>
                                    <td class="fw-bold text-light"><?= htmlspecialchars($t['title']) ?></td>
                                    <td class="text-secondary"><?= htmlspecialchars($t['category_name'] ?? '-') ?></td>
                                    <td class="<?= $t['type'] === 'income' ? 'text-success' : 'text-danger' ?> fw-bold">
                                        <?= $t['type'] === 'income' ? '+' : '-' ?>$<?= number_format($t['amount'], 2) ?>
                                    </td>
                                    <td>
                                        <span
                                            class="badge bg-<?= $t['type'] === 'income' ? 'success' : 'danger' ?> bg-opacity-25 text-<?= $t['type'] === 'income' ? 'success' : 'danger' ?>">
                                            <?= ucfirst($t['type']) ?>
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="/spender-v2/public/transaction/delete?id=<?= $t['id'] ?>"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($transactions)): ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No transactions found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card p-4">
            <h5 class="mb-4">Add Transaction</h5>
            <form action="/spender-v2/public/transaction/create" method="POST">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control glass-input" placeholder="e.g. Salary, Rent"
                        required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input type="number" step="0.01" name="amount" class="form-control glass-input" placeholder="0.00"
                        required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-control glass-input" value="<?= date('Y-m-d') ?>"
                        required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select glass-input">
                        <option value="">Select Category</option>
                        <?php if (isset($categories)): ?>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-select glass-input" required>
                        <option value="expense">Expense</option>
                        <option value="income">Income</option>
                    </select>
                </div>
                <button type="submit" class="glass-btn w-100">Add Transaction</button>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/layouts/footer.php'; ?>