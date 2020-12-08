<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <link href="styles.css" rel="stylesheet"/>
        <script type="text/javascript" src="app.js"></script>
    </head>

    <h1>Ives Wholesale Dealers</h1>
    <h2>Searched Product List</h2>
    
    <?php 

    /* Setting up mysqli connection */
    $server = "localhost";
    $username = "id15301879_ivesej";
    $password = "otI!4RgyVp[5tg*q";
    $dbname = "id15301879_business";

    $conn = mysqli_connect($server, $username, $password, $dbname);
    
    /* Variables to store form data */
    if(empty($_POST['productName'])){
    $productName = null; // default value
    }else{
    $productName = mysqli_real_escape_string($conn, $_POST['productName']);
    }
   
    if(empty($_POST['warehouseCity'])){
    $warehouseCity = null; // default value
    }else{
    $warehouseCity = mysqli_real_escape_string($conn, $_POST['warehouseCity']);
    }
    
    if(empty($_POST['minQuantity'])){
    $minQuantity = 1; // default value
    }else{
    $minQuantity = mysqli_real_escape_string($conn, $_POST['minQuantity']);
    }
    
    if(empty($_POST['maxQuantity'])){
    $maxQuantity = 9999999; // default value
    }else{
    $maxQuantity = mysqli_real_escape_string($conn, $_POST['maxQuantity']);
    }
    
    if(empty($_POST['minPrice'])){
    $minPrice = 0.1; // default value
    }else{
    $minPrice = mysqli_real_escape_string($conn, $_POST['minPrice']);
    }
    
    if(empty($_POST['maxPrice'])){
    $maxPrice = 9999999; // default value
    } else {
    $maxPrice = mysqli_real_escape_string($conn, $_POST['maxPrice']);
    }
    
// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

// Setting up SQL query
$sql = "SELECT * FROM Products WHERE (pname LIKE '%$productName%')
        AND (city LIKE '%$warehouseCity%')
        AND (quantity >= $minQuantity)
        AND (quantity <= $maxQuantity)
        AND (price >= $minPrice)
        AND (price <= $maxPrice)";
        
$result = mysqli_query($conn, $sql);
$queryResults = mysqli_num_rows($result);

if($queryResults > 0) {
    echo "<table>";
        echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Name</th>";
            echo "<th>City</th>";
            echo "<th>Quantity</th>";
            echo "<th>Price</th>";
        echo "</tr>";
}
        
// Displaying query results
if($queryResults > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "
            <tr><td>".$row['pid']."</td>
            <td>".$row['pname']."</td>
            <td>".$row['city']."</td>
            <td>".$row['quantity']."</td>
            <td>".$row['price']."</td></tr>";
    }
    echo "</table>";
    
}   else {
        echo "There were no results found for the given search.";
    }
    
    echo "<button class='return' type ='button' onclick='goBack()'>Perform Another Search</button>";
?>
</html>