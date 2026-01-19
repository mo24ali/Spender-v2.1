<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="row mb-5">
    <div class="col-md-12">
        <h2 class="mb-1">Edit Transaction</h2>
        <p class="text-secondary mb-0">Update your transaction details</p>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card-premium p-4">
            <form action="/spender-v2/public/transaction/edit?id=<?= $transaction['id'] ?>" method="POST">
                <div class="mb-3">
                    <label class="form-label small text-secondary fw-bold">TITLE</label>
                    <input type="text" name="title" class="form-control form-control-premium"
                        value="<?= htmlspecialchars($transaction['title']) ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label small text-secondary fw-bold">AMOUNT</label>
                        <input type="number" step="0.01" name="amount" class="form-control form-control-premium"
                            value="<?= htmlspecialchars($transaction['amount']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label small text-secondary fw-bold">DATE</label>
                        <input type="date" name="date" class="form-control form-control-premium"
                            value="<?= htmlspecialchars($transaction['transaction_date']) ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-secondary fw-bold">CATEGORY</label>
                    <select name="category_id" class="form-select form-control-premium">
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $transaction['category_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label small text-secondary fw-bold">TYPE</label>
                    <div class="d-flex gap-2">
                        <input type="radio" class="btn-check" name="type" id="type-expense" value="expense"
                            <?= $transaction['type'] === 'expense' ? 'checked' : '' ?>>
                        <label class="btn btn-outline-danger w-50" for="type-expense">Expense</label>

                        <input type="radio" class="btn-check" name="type" id="type-income" value="income"
                            <?= $transaction['type'] === 'income' ? 'checked' : '' ?>>
                        <label class="btn btn-outline-success w-50" for="type-income">Income</label>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-premium w-100 py-2">Update Transaction</button>
                    <a href="/spender-v2/public/transaction/index"
                        class="btn btn-outline-secondary w-100 py-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>