<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome | Smart Wallet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="/spender-v2/public/assets/css/style.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="glass-card p-5 text-center">
                    <h1 class="text-gradient mb-3">Spender V2</h1>
                    <p class="text-secondary mb-4">Manage your finances securely and effortlessly</p>

                    <div class="actions">
                        <a href="/spender-v2/public/auth/login"
                            class="glass-btn w-100 d-block mb-3 text-white text-decoration-none">Login</a>
                        <a href="/spender-v2/public/auth/signup"
                            class="glass-btn w-100 d-block bg-transparent border border-white text-white text-decoration-none">Create
                            Account</a>
                    </div>

                    <footer class="mt-4 text-secondary text-sm">
                        &copy; <?= date('Y') ?> Spender V2
                    </footer>
                </div>
            </div>
        </div>
    </div>

</body>

</html>