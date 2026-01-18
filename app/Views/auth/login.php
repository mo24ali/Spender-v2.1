<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-5">
        <div class="glass-card p-5">
            <div class="text-center mb-4">
                <h2 class="text-gradient fw-bold mb-2">Welcome Back</h2>
                <p class="text-secondary">Login to manage your expenses</p>
            </div>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger bg-danger bg-opacity-25 text-danger border-0">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            <form action="/spender-v2/public/auth/login" method="POST">
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control glass-input" placeholder="name@example.com"
                        required>
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control glass-input"
                        placeholder="Enter your password" required>
                </div>
                <button type="submit" class="glass-btn w-100 mb-3">Login</button>
            </form>
            <div class="mt-3 text-center">
                <p class="text-secondary">Don't have an account? <a href="/spender-v2/public/auth/signup"
                        class="text-info text-gradient fw-bold">Sign up</a></p>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>