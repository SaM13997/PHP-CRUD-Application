<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if user information matches what was stored in localStorage
    if (isset($_SESSION["username"]) && $_SESSION["username"] === $username && $_SESSION["password"] === $password) {
        // Authentication successful, redirect to your protected page
        header("Location: index.php");
        exit();
    } else {
        // Authentication failed, display an error message
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
  <script src="https://cdn.jsdelivr.net/npm/@unocss/runtime"></script>

</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold mb-4">Login</h1>
        <form method="post" action="" class="space-y-4">
            <div class="flex flex-col">
                <label for="username" class="text-sm font-semibold">Username:</label>
                <input type="text" name="username" required
                    class="border rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="flex flex-col">
                <label for="password" class="text-sm font-semibold">Password:</label>
                <input type="password" name="password" required
                    class="border rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <button type="submit" name="login"
                class="bg-blue-500 text-white font-semibold px-4 py-2 rounded-full hover:bg-blue-600">Login</button>
        </form>
        <p class="text-sm mt-4">Don't have an account? <a href="register.php" class="text-blue-500">Register here</a>
        </p>

        <?php if (isset($error)) { ?>
            <p class="text-red-500 mt-4"><?php echo $error; ?></p>
        <?php } ?>
    </div>
</body>

</html>
