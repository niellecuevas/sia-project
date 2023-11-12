<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
</head>
<body>
    <h2>Create Account</h2>
    <form action="./php/create_account.php" method="post">
        <label for="staffId">Staff ID:</label>
        <input type="text" id="staffId" name="staffId" required><br>

        <label for="adminId">Admin ID:</label>
        <input type="text" id="adminId" name="adminId" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Create Account">
    </form>
</body>
</html>
