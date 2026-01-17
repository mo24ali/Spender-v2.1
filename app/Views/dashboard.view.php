<h1>Welcome to Spender Dashboard</h1>
<p>Hello,
    <?= $_SESSION['user_name'] ?? 'Guest' ?>
</p>
<a href="/auth/logout">Logout</a>