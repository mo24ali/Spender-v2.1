<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-5">
        <div class="glass-card p-5">
            <div class="text-center mb-4">
                <h2 class="text-gradient fw-bold mb-2">Create Account</h2>
                <p class="text-secondary">Join us and track your finances</p>
            </div>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger bg-danger bg-opacity-25 text-danger border-0">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="/spender-v2/public/auth/signup" method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="firstname" class="form-control glass-input" placeholder="John"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="lastname" class="form-control glass-input" placeholder="Doe" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control glass-input" placeholder="name@example.com"
                        required>
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control glass-input"
                        placeholder="Create a strong password" required>
                </div>
                <button type="submit" class="glass-btn w-100 mb-3">Sign Up</button>
            </form>

            <div class="mt-3 text-center">
                <p class="text-secondary">Already have an account? <a href="/spender-v2/public/auth/login"
                        class="text-info text-gradient fw-bold">Login</a></p>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>