<?php require_once __DIR__ . '/../../Views/layouts/header.php'; ?>

<div class="container mt-5">
    <h2>Create Category</h2>
    <form action="/spender-v2/public/categories/create" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-select" id="type" name="type" required>
                <option value="income">Income</option>
                <option value="expense">Expense</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="/spender-v2/public/categories" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php require_once __DIR__ . '/../../Views/layouts/footer.php'; ?>