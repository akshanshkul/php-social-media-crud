<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <div class="login-card">
        <h2>Social Network Login</h2>
        <form  action="insert.php"  method="POST">
            <label for="email">Email Address</label>
            <input type="email" id="email" placeholder="Email Address" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Password"  name="password" required>

            <button type="submit" name="login">Login</button>
            <div class="account-link">
                Don’t have account? <a href="./signup">Create Account</a>
            </div>
        </form>
    </div>
    <script src="assets/js/login.js"></script>
</body>

</html>