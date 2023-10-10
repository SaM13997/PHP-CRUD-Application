<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["username"])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Laptops</title>
    <!-- Including Tailwind CSS from CDN cause I prefer it over Bootstrap because it gives more control over underlying CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

<nav class="bg-blue-500 p-4">
    <div class="container mx-auto">
        <a class="text-white text-2xl font-bold" href="#">LaptopEmporium</a>
        <button class="ml-2 navbar-toggler block sm:hidden" type="button" data-toggle="collapse" data-target="#navbarID">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="hidden sm:flex space-x-4" id="navbarID">
            <a class="text-white" href="./index.php">List Laptop</a>
            <a class="text-white" href="./Create.php">Create Laptop</a>
        </div>
    </div>
</nav>

<div class="p-5 bg-warning">
    <h1 class="text-5xl font-semibold">
        Add Your Laptops
    </h1>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include "dbinit.php"; // Include the database connection file

    $name = $_POST["name"];
    $price = $_POST["price"];
    $desc = $_POST["desc"];
    $qty = intval($_POST["qty"]);
    $LaptopGPU = $_POST["LaptopGPU"];
    $ProductAddedBy = $_SESSION["username"];

    $insertQuery = "INSERT INTO laptops (LaptopName, LaptopGPU, LaptopDescription, QuantityAvailable, Price, ProductAddedBy) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($stmt, "sssids", $name, $LaptopGPU, $desc, $qty, $price, $ProductAddedBy);

    if (mysqli_stmt_execute($stmt)) {
        echo '<div class="bg-green-200 p-4">Laptop added successfully!</div>';
    } else {
        echo '<div class="bg-red-200 p-4">Error adding Laptop: ' . mysqli_error($conn) . '</div>';
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<div class="container mx-auto my-5">
    <form action="" method="post">
        <div class="mb-3">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Laptop Name</label>
            <input type="text" name="name" id="name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ""; ?>"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-3">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="qty">Laptop GPU</label>
            <input type="number" name="LaptopGPU" id="LaptopGPU" value="<?php echo isset($_POST["LaptopGPU"]) ? $_POST["LaptopGPU"] : ""; ?>"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-3">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="price">Price</label>
            <input type="number" name="price" id="price" value="<?php echo isset($_POST["price"]) ? $_POST["price"] : ""; ?>"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-3">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="desc">Description</label>
            <input type="text" name="desc" id="desc" value="<?php echo isset($_POST["desc"]) ? $_POST["desc"] : ""; ?>"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-3">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="qty">Quantity Available</label>
            <input type="number" name="qty" id="qty" value="<?php echo isset($_POST["qty"]) ? $_POST["qty"] : ""; ?>"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-3">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="qty">Product Added By</label>
            <p class="font-bold bg-red-100 p-1 roundex-sm"><?php echo $_SESSION["username"] ?></p>
        </div>
        <div class="mb-3">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Create
            </button>
        </div>
    </form>
</div>

</body>
</html>
