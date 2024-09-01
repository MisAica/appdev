<?php
include 'dbconn.php';


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['id']; 

$id = intval($id);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = floatval($_POST['price']);
    $quantity = $conn->real_escape_string($_POST['quantity']);

    $sql = "UPDATE tblproducts SET name='$name', description='$description', price='$price', quantity='$quantity' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: read.php"); 
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$sql = "SELECT * FROM tblproducts WHERE id=$id";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        die("Product not found.");
    }
} else {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Product</title>
</head>
<body>
    <h2>Update Product</h2>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea><br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" value="<?php echo htmlspecialchars($product['price']); ?>" required><br>
        <label for="quantity">Quantity:</label>
        <input type="text" id="quantity" name="quantity" value="<?php echo htmlspecialchars($product['quantity']); ?>" required><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
