<?php
include 'dbconn.php';

$sql = "SELECT * FROM tblproducts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Products List</h2>";
    echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Quantity</th><th>Created At</th><th>Updated At</th><th>Actions</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["description"]."</td><td>".$row["price"]."</td><td>".$row["quantity"]."</td><td>".$row["created_at"]."</td><td>".$row["updated_at"]."</td><td><a href='update.php?id=".$row["id"]."'>Edit</a> | <a href='delete.php?id=".$row["id"]."' onclick='return confirm(\"Are you sure?\")'>Delete</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
