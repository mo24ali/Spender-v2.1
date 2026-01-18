<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spender V2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="/spender-v2/public/assets/css/style.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-premium mb-5">
        <div class="container">
            <a class="navbar-brand" href="/spender-v2/public/dashboard">
                <i class="fa-solid fa-wallet text-success me-2"></i>Spender
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-2">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'dashboard') ? 'active' : '' ?>"
                                href="/spender-v2/public/dashboard">
                                <i class="fa-solid fa-chart-pie me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'cards') ? 'active' : '' ?>"
                                href="/spender-v2/public/cards">
                                <i class="fa-solid fa-credit-card me-1"></i> Cards
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="/spender-v2/public/auth/logout">
                                <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/spender-v2/public/auth/login">Login</a></li>
                        <li class="nav-item"><a class="btn btn-primary-premium ms-2"
                                href="/spender-v2/public/auth/signup">Sign Up</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container pb-5">