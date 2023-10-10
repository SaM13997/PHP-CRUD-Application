<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Store user information in localStorage
    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
  <script src="https://cdn.jsdelivr.net/npm/@unocss/runtime"></script>

</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold mb-4">Register</h1>
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
            <button type="submit" name="register"
                class="bg-blue-500 text-white font-semibold px-4 py-2 rounded-full hover:bg-blue-600">Register</button>
        </form>
        <p class="text-sm mt-4">Already have an account? <a href="login.php" class="text-blue-500">Login here</a></p>
    </div>
</body>

</html>
