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
  <title>Laptop Emporium</title>
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
        <?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION["username"])) {
    echo '<a class="ml-auto" href="login.php">Logout</a>';
}
?>

    </div>
</nav>

<?php
if (!isset($_SESSION["username"])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

include "dbinit.php"; // Include the database connection file

// Handle Delete
if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $deleteQuery = mysqli_query($conn, "DELETE FROM laptops WHERE LaptopID = $id");
    if ($deleteQuery) {
        echo '<div class="bg-green-200 p-4">Laptop deleted successfully!</div>';
    } else {
        echo '<div class="bg-red-200 p-4">Error deleting Laptop: ' . mysqli_error($conn) . '</div>';
    }
}

// Handle Update (you can implement the update logic here)

$selectQuery = mysqli_query($conn, "SELECT * FROM laptops"); // Use the correct table name 'laptops'
?>

<!-- Your HTML code remains unchanged -->

<div class="p-5 bg-amber-200">
    <h1 class="text-5xl font-semibold">
        Products
    </h1>
</div>

<div class="container mx-auto mt-8">
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Laptop ID</th> <!-- Adjust the column names accordingly -->
                <th class="px-4 py-2">Laptop Name</th>
                <th class="px-4 py-2">Laptop GPU</th>
                <th class="px-4 py-2">Price</th>
                <th class="px-4 py-2">Laptop Description</th>
                <th class="px-4 py-2">Quantity Available</th>
                <th class="px-4 py-2">Product Added By</th>
                <th class="px-4 py-2">Options</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($selectQuery) > 0) {
                while ($row = mysqli_fetch_assoc($selectQuery)) {
            ?>
                    <tr>
                        <td class="px-4 py-2"><?php echo $row["LaptopID"] ?></td>
                        <td class="px-4 py-2"><?php echo $row["LaptopName"] ?></td>
                        <td class="px-4 py-2"><?php echo $row["LaptopGPU"] ?></td>
                        <td class="px-4 py-2"><?php echo $row["Price"] ?></td>
                        <td class="px-4 py-2"><?php echo $row["LaptopDescription"] ?></td>
                        <td class="px-4 py-2"><?php echo $row["QuantityAvailable"] ?></td>
                        <td class="px-4 py-2"><?php echo $row["ProductAddedBy"] ?></td>
                        <td class="px-4 py-2">
                            <div class="flex felx-col">
                              <a class="bg-white hover:bg-gray-200 py-2 px-4 block whitespace-no-wrap" href="?action=delete&id=<?php echo $row["LaptopID"] ?>">Delete</a>
                              <form action="Update.php" method="get">
                                  <input type="hidden" name="LaptopID" value="<?php echo $row["LaptopID"]; ?>">
                                  <button type="submit" class="bg-white hover:bg-gray-200 py-2 px-4 block whitespace-no-wrap">Update</button>
                              </form>
                            </div>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "No records found";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
