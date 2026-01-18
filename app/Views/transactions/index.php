<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="row mb-5">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-1">Transactions</h2>
            <p class="text-secondary mb-0">Track your spending and income</p>
        </div>
        <button class="btn btn-primary-premium" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
            <i class="fa-solid fa-plus me-2"></i>New Transaction
        </button>
    </div>
</div>

<div class="row mb-5">
    <!-- Category Limits / Usage -->
    <div class="col-md-12">
        <h5 class="mb-3">Category Spending Limits</h5>
        <div class="row">
            <?php
            // Mocking limit data or simple usage logic for UI demo
            // ideally this comes from controller with calculated totals
            $mockLimits = [
                'Food' => ['spent' => 450, 'limit' => 600, 'color' => 'warning'],
                'Transport' => ['spent' => 120, 'limit' => 200, 'color' => 'info'],
                'Entertainment' => ['spent' => 280, 'limit' => 300, 'color' => 'danger'],
                'Utilities' => ['spent' => 150, 'limit' => 150, 'color' => 'primary']
            ];

            // If we have categories, we can display them using mock data or just basic bars
            if (!empty($categories)):
                foreach ($categories as $cat):
                    $name = $cat['name'];
                    // Use mock data if available, else random for demo
                    $data = $mockLimits[$name] ?? ['spent' => rand(50, 400), 'limit' => 500, 'color' => 'primary'];
                    $percent = ($data['spent'] / $data['limit']) * 100;
                    $color = $percent > 90 ? 'danger' : ($percent > 70 ? 'warning' : 'success');
                    ?>
                    <div class="col-md-3 mb-3">
                        <div class="card-premium p-3 h-100">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold small"><?= htmlspecialchars($name) ?></span>
                                <span class="small text-secondary">$<?= $data['spent'] ?> / $<?= $data['limit'] ?></span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-<?= $color ?>" style="width: <?= $percent ?>%"></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; endif; ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card-premium">
            <div class="card-header-premium d-flex justify-content-between align-items-center">
                <h5 class="card-title">All Transactions</h5>
                <div class="d-flex gap-2">
                    <input type="text" class="form-control form-control-premium form-control-sm"
                        placeholder="Search...">
                    <button class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-filter"></i></button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-premium align-middle">
                    <thead>
                        <tr>
                            <th class="ps-4">Date</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $t): ?>
                            <tr>
                                <td class="ps-4 text-secondary text-nowrap">
                                    <?= date('M d, Y', strtotime($t['transaction_date'])) ?></td>
                                <td>
                                    <div class="fw-bold"><?= htmlspecialchars($t['title']) ?></div>
                                    <?php if (!empty($t['description'])): ?>
                                        <div class="small text-secondary text-truncate" style="max-width: 200px;">
                                            <?= htmlspecialchars($t['description']) ?></div>
                                    <?php endif; ?>
                                </td>
                                <td><span
                                        class="badge bg-light text-secondary border"><?= htmlspecialchars($t['category_name'] ?? '-') ?></span>
                                </td>
                                <td class="fw-bold <?= $t['type'] === 'income' ? 'text-success' : 'text-danger' ?>">
                                    <?= $t['type'] === 'income' ? '+' : '-' ?>$<?= number_format($t['amount'], 2) ?>
                                </td>
                                <td>
                                    <span
                                        class="badge-premium <?= $t['type'] === 'income' ? 'badge-income' : 'badge-expense' ?>">
                                        <?= ucfirst($t['type']) ?>
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="/spender-v2/public/transaction/delete?id=<?= $t['id'] ?>"
                                        class="btn btn-sm text-secondary hover-danger"
                                        onclick="return confirm('Are you sure?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($transactions)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-secondary">
                                    <i class="fa-solid fa-inbox fs-2 mb-3 d-block opacity-25"></i>
                                    No transactions found.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Transaction Modal (Reused) -->
<div class="modal fade" id="addTransactionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-premium border-0">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold">New Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form action="/spender-v2/public/transaction/create" method="POST">
                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-bold">TITLE</label>
                        <input type="text" name="title" class="form-control form-control-premium"
                            placeholder="e.g. Starbucks" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small text-secondary fw-bold">AMOUNT</label>
                            <input type="number" step="0.01" name="amount" class="form-control form-control-premium"
                                placeholder="0.00" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small text-secondary fw-bold">DATE</label>
                            <input type="date" name="date" class="form-control form-control-premium"
                                value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-bold">CATEGORY</label>
                        <select name="category_id" class="form-select form-control-premium">
                            <option value="">Select Category</option>
                            <?php if (isset($categories)): ?>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small text-secondary fw-bold">TYPE</label>
                        <div class="d-flex gap-2">
                            <input type="radio" class="btn-check" name="type" id="type-expense" value="expense" checked>
                            <label class="btn btn-outline-danger w-50" for="type-expense">Expense</label>

                            <input type="radio" class="btn-check" name="type" id="type-income" value="income">
                            <label class="btn btn-outline-success w-50" for="type-income">Income</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary-premium w-100 py-2">Save Transaction</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>