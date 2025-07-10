<?php
include 'include/header.php';
include 'include/menu.php';

// Get the artwork ID from the URL
$artworkID = isset($_GET['artwork_id']) ? $_GET['artwork_id'] : null;

if (!$artworkID) {
   // Redirect or handle the case where no artwork ID is provided
   header('Location: index.php');
   exit;
}

include_once "./config/dbconnect.php"; 

// Query to retrieve artwork data for the specific artwork ID
$sql = "SELECT * FROM uploadartwork WHERE Artwork_ID = $artworkID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   $row = $result->fetch_assoc();
} else {
   // Redirect or handle the case where no matching artwork is found
   header('Location: index.php');
   exit;
}

// Handle the Add to Cart form submission
$addToCartMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    // Validate and sanitize data as needed
    $artworkID = mysqli_real_escape_string($conn, $_POST['artwork_id']);
    $totalPrice = mysqli_real_escape_string($conn, $row['a_price']); // You might want to calculate the total price based on quantity later

    // Insert data into the cart table
    $cartInsertSql = "INSERT INTO cart (Artwork_ID, total_price) VALUES ('$artworkID', '$totalPrice')";
    if ($conn->query($cartInsertSql) === TRUE) {
        $addToCartMessage = "Artwork added to the cart successfully";
    } else {
        $addToCartMessage = "Error: " . $cartInsertSql . "<br>" . $conn->error;
    }
}

?>

<link href="./assets/css/main.min.css" type="text/css" rel="stylesheet">
</head>

<body>
   <div class="container mt-5">
      <div class="row">
         <div class="col-md-6">
            <!-- Product Image -->
            <img src="uploads/<?= $row['a_image'] ?>" class="img-fluid" alt="Product Image">
         </div>
         <div class="col-md-6">
            <!-- Product Details -->
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title" style="font-weight: bold; font-size: 24px; color: #333; text-transform: uppercase;"><?= $row['a_name'] ?></h5>
                  <p class="card-text"><?= $row['a_decs'] ?></p>
                  <p class="card-text">Price: <?= $row['a_price'] ?> PKR</p>
                  <!-- Add more details as needed -->

                  <!-- Form to handle Add to Cart -->
                  <form method="post">
                      <input type="hidden" name="artwork_id" value="<?= $row['Artwork_ID'] ?>">
                      <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
                  </form>

                  <!-- Display the message in a dialog -->
                  <?php if ($addToCartMessage): ?>
                      <script>
                          alert('<?= $addToCartMessage ?>');
                      </script>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      </div>
   </div>

<?php include 'include/footer.php'; ?>
</body>
</html>
<?php
// Close the database connection
$conn->close();
?>
