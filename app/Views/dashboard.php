<?php require __DIR__ . '/layouts/header.php'; ?>

<div class="row mb-5">
    <div class="col-md-12 mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-1">Overview</h2>
            <p class="text-secondary mb-0">Financial summary for <?= date('F Y') ?></p>
        </div>
        <div>
            <button class="btn btn-primary-premium" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
                <i class="fa-solid fa-plus me-2"></i>Add Transaction
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="col-md-3">
        <div class="card-premium stat-card h-100">
            <span class="stat-label">Total Balance</span>
            <h3 class="stat-value text-primary">$<?= number_format($balance, 2) ?></h3>
            <div class="text-secondary small"><i class="fa-solid fa-wallet me-1"></i> Available</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-premium stat-card h-100">
            <span class="stat-label">Income</span>
            <h3 class="stat-value text-success">$<?= number_format($total_income, 2) ?></h3>
            <div class="text-success small"><i class="fa-solid fa-arrow-trend-up me-1"></i> +12% vs last month</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-premium stat-card h-100">
            <span class="stat-label">Expenses</span>
            <h3 class="stat-value text-danger">$<?= number_format($total_expense, 2) ?></h3>
            <div class="text-danger small"><i class="fa-solid fa-arrow-trend-down me-1"></i> -2% vs last month</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-premium stat-card h-100">
            <span class="stat-label">Budget Status</span>
            <!-- Placeholder for budget logic -->
            <div class="progress mt-2" style="height: 8px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 75%"></div>
            </div>
            <div class="text-secondary small mt-2">75% of budget remaining</div>
        </div>
    </div>
</div>

<div class="row mb-5">
    <!-- Main Chart -->
    <div class="col-md-8">
        <div class="card-premium h-100">
            <div class="card-header-premium d-flex justify-content-between align-items-center">
                <h5 class="card-title">Cash Flow</h5>
                <select class="form-select form-select-sm w-auto border-0 bg-light">
                    <option>This Year</option>
                    <option>Last Year</option>
                </select>
            </div>
            <div class="card-body p-4">
                <canvas id="cashFlowChart" height="120"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Doughnut Chart -->
    <div class="col-md-4">
        <div class="card-premium h-100">
            <div class="card-header-premium">
                <h5 class="card-title">Expenses by Category</h5>
            </div>
            <div class="card-body p-4 d-flex justify-content-center align-items-center">
                <canvas id="categoryChart" style="max-height: 250px;"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <h5 class="mb-3">My Cards</h5>
        <!-- Mock Card 1 -->
        <div class="card-premium p-4 mb-3 text-white" style="background: linear-gradient(135deg, #020024 0%, #090979 35%, #00d4ff 100%); border-radius: 16px;">
            <div class="d-flex justify-content-between mb-4">
                <i class="fa-brands fa-cc-visa fa-2x opacity-75"></i>
                <span class="badge bg-white bg-opacity-25">Primary</span>
            </div>
            <h4 class="mb-1">**** **** **** 4242</h4>
            <div class="d-flex justify-content-between align-items-end mt-4">
                <div>
                    <div class="small opacity-75">Card Holder</div>
                    <div class="fw-bold">Ali Ch</div>
                </div>
                <div>
                    <div class="small opacity-75">Expires</div>
                    <div class="fw-bold">12/28</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card-premium">
            <div class="card-header-premium">
                <h5 class="card-title">Recent Transactions</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-premium align-middle">
                    <thead>
                        <tr>
                            <th class="ps-4">Transaction</th>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $t): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-primary me-3" style="width: 40px; height: 40px;">
                                            <i class="fa-solid fa-receipt"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold"><?= htmlspecialchars($t['title']) ?></div>
                                            <div class="small text-secondary"><?= htmlspecialchars($t['description'] ?? 'No description') ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-secondary"><?= date('M d, Y', strtotime($t['transaction_date'])) ?></td>
                                <td><span class="badge bg-light text-secondary border"><?= htmlspecialchars($t['category_name'] ?? 'General') ?></span></td>
                                <td class="fw-bold <?= $t['type'] === 'income' ? 'text-success' : 'text-danger' ?>">
                                    <?= $t['type'] === 'income' ? '+' : '-' ?>$<?= number_format($t['amount'], 2) ?>
                                </td>
                                <td>
                                    <span class="badge-premium <?= $t['type'] === 'income' ? 'badge-income' : 'badge-expense' ?>">
                                        <?= ucfirst($t['type']) ?>
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="/spender-v2/public/transaction/delete?id=<?= $t['id'] ?>" 
                                       class="text-secondary hover-danger"
                                       onclick="return confirm('Delete this transaction?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($transactions)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-secondary">
                                    <i class="fa-solid fa-folder-open fs-2 mb-3 d-block opacity-25"></i>
                                    No transactions found. Start by adding one!
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Transaction Modal -->
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
                        <input type="text" name="title" class="form-control form-control-premium" placeholder="e.g. Starbucks" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small text-secondary fw-bold">AMOUNT</label>
                            <input type="number" step="0.01" name="amount" class="form-control form-control-premium" placeholder="0.00" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small text-secondary fw-bold">DATE</label>
                            <input type="date" name="date" class="form-control form-control-premium" value="<?= date('Y-m-d') ?>" required>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cash Flow Chart
        const ctxFlow = document.getElementById('cashFlowChart').getContext('2d');
        new Chart(ctxFlow, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [
                    {
                        label: 'Income',
                        data: [1200, 1900, 3000, 500, 2000, 3000],
                        borderColor: '#1bbf23',
                        backgroundColor: 'rgba(27, 191, 35, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Expense',
                        data: [1000, 1500, 800, 1200, 1800, 2500],
                        borderColor: '#ff3b30',
                        backgroundColor: 'rgba(0,0,0,0)',
                        tension: 0.4,
                        borderDash: [5, 5]
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'top' } },
                scales: { 
                    y: { beginAtZero: true, grid: { borderDash: [2, 4], color: '#f0f0f0' } },
                    x: { grid: { display: false } }
                }
            }
        });

        // Category Chart
        const ctxCat = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctxCat, {
            type: 'doughnut',
            data: {
                labels: ['Food', 'Rent', 'Transport', 'Utilities'],
                datasets: [{
                    data: [300, 1200, 150, 200],
                    backgroundColor: ['#ff9f43', '#54a0ff', '#5f27cd', '#ff6b6b'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                cutout: '70%',
                plugins: { legend: { position: 'bottom' } }
            }
        });
    });
</script>

<?php require __DIR__ . '/layouts/footer.php'; ?>