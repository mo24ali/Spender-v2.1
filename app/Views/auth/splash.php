<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome | Smart Wallet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #1e293b, #0f172a);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background: #020617;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            text-align: center;
        }

        h1 {
            margin-bottom: 10px;
        }

        p {
            color: #cbd5f5;
            margin-bottom: 30px;
        }

        .actions a {
            display: block;
            padding: 14px;
            margin-bottom: 12px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }

        .login {
            background: #2563eb;
            color: white;
        }

        .signup {
            background: transparent;
            color: #93c5fd;
            border: 2px solid #2563eb;
        }

        .login:hover {
            background: #1d4ed8;
        }

        .signup:hover {
            background: #1e40af;
            color: #fff;
        }

        footer {
            margin-top: 20px;
            font-size: 13px;
            color: #94a3b8;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Smart Wallet</h1>
        <p>Manage your finances securely and effortlessly</p>

        <div class="actions">
            <a href="/login" class="login">Login</a>
            <a href="/signup" class="signup">Create Account</a>
        </div>

        <footer>
            <?= date('Y') ?> Smart Wallet
        </footer>
    </div>

</body>

</html>