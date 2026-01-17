<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Card</title>
</head>

<body>
    <h1>Add New Card</h1>
    <form action="/card/create" method="POST">
        <input type="text" name="name" placeholder="Card Name (e.g. Visa)" required>
        <input type="text" name="card_number" placeholder="Card Number (Last 4 digits)" required>
        <input type="number" step="0.01" name="balance" placeholder="Current Balance" required>
        <input type="number" step="0.01" name="limit" placeholder="Credit Limit (Optional)">
        <label>Expiry Date:</label>
        <input type="date" name="expiry_date">
        <button type="submit">Add Card</button>
    </form>
</body>

</html>