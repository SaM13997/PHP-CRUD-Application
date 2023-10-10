<?php
include "dbinit.php"; // Include the database connection file

// Check if LaptopID is provided in the URL
if (isset($_GET["LaptopID"])) {
    $LaptopID = $_GET["LaptopID"];

    $selectQuery = mysqli_query($conn, "SELECT * FROM laptops WHERE LaptopID = $LaptopID");

    if (mysqli_num_rows($selectQuery) == 1) {
        $row = mysqli_fetch_assoc($selectQuery);
        $LaptopName = $row["LaptopName"];
        $LaptopGPU = $row["LaptopGPU"];
        $LaptopDescription = $row["LaptopDescription"];
        $QuantityAvailable = $row["QuantityAvailable"];
        $Price = $row["Price"];
    } else {
        echo "Laptop not found.";
        exit();
    }
} else {
    echo "LaptopID not provided.";
    exit();
}

// Check if the form is submitted for updating
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update"])) {
    $newLaptopName = $_POST["newLaptopName"];
    $newLaptopGPU = $_POST["newLaptopGPU"];
    $newLaptopDescription = $_POST["newLaptopDescription"];
    $newQuantityAvailable = $_POST["newQuantityAvailable"];
    $newPrice = $_POST["newPrice"];

    $updateQuery = "UPDATE laptops SET LaptopName=?, LaptopGPU=?, LaptopDescription=?, QuantityAvailable=?, Price=? WHERE LaptopID=?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "ssssdi", $newLaptopName, $newLaptopGPU, $newLaptopDescription, $newQuantityAvailable, $newPrice, $LaptopID);

    if (mysqli_stmt_execute($stmt)) {
        echo '<div class="bg-green-200 p-4">Laptop updated successfully!</div>';
    } else {
        echo '<div class="bg-red-200 p-4">Error updating Laptop: ' . mysqli_error($conn) . '</div>';
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Laptop Details</title>
  <script src="https://cdn.jsdelivr.net/npm/@unocss/runtime"></script>
</head>
<body>
  <nav class="bg-blue-400 p-2 px-1">
    <div class="container mx-auto flex items-center">
        <a class="text-white text-2xl font-bold mr-8" href="#">LaptopEmporium</a>
        <button class="ml-2 navbar-toggler block sm:hidden" type="button" data-toggle="collapse" data-target="#navbarID">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="hidden sm:flex space-x-4" id="navbarID">
            <a class="text-white" href="./index.php">Products</a>
            <a class="text-white" href="./Create.php">Add Products</a>
        </div>
    </div>
</nav>
<div class="p-5 bg-amber-200">
    <h1 class="text-5xl font-semibold">
        Update Laptop Details
    </h1>
</div>

    <!-- Form to update laptop details -->
    <form class="mt-4 w-4/5" method="post" action="update.php?LaptopID=<?php echo $LaptopID; ?>">
        <label class="block text-gray-700 text-sm font-bold mt-2" for="newLaptopName">Laptop Name:</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="newLaptopName" value="<?php echo $LaptopName; ?>"><br>

        <label class="block text-gray-700 text-sm font-bold mt-2" for="newLaptopGPU">Laptop GPU:</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="newLaptopGPU" value="<?php echo $LaptopGPU; ?>"><br>

        <label class="block text-gray-700 text-sm font-bold mt-2" for="newLaptopDescription">Laptop Description:</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="newLaptopDescription" value="<?php echo $LaptopDescription; ?>"><br>

        <label class="block text-gray-700 text-sm font-bold mt-2" for="newQuantityAvailable">Quantity Available:</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" name="newQuantityAvailable" value="<?php echo $QuantityAvailable; ?>"><br>

        <label  class="block text-gray-700 text-sm font-bold mt-2" for="newPrice">Price:</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="newPrice" value="<?php echo $Price; ?>"><br>

        <input class="bg-amber-200 rounded-lg p-2 border border-amber-500  mt-4" type="submit" name="update" value="Update">
        <a class="bg-amber-200 rounded-lg p-2 mt-4" href="index.php">Go to products</a>
    </form>
</body>
</html>
