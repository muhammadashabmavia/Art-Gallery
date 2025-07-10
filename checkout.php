<?php
include 'include/header.php';
include 'include/menu.php';

// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "artwork";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch cart items from the database
$sql = "SELECT c.*, a.a_name, a.a_price
        FROM cart c
        JOIN uploadartwork a ON c.Artwork_ID = a.Artwork_ID";
$result = $conn->query($sql);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  
  // Assuming you have received the form data
  $methodId = ($_POST["payment_method"] == "Card") ? 1 : 2;
  $pEmail = $_POST["email"];
  $purchaseDate = date("Y-m-d H:i:s");
  $pStatus = "Pending"; // You can set the initial status as needed
  $country = $_POST["country"];

  // Fetch cart items from the database
  $sqlCart = "SELECT c.*, a.a_name, a.a_price
                FROM cart c
                JOIN uploadartwork a ON c.Artwork_ID = a.Artwork_ID";
  $resultCart = $conn->query($sqlCart);

  // Insert data into the Purchase table for each cart item
  while ($rowCart = $resultCart->fetch_assoc()) {
    $artworkId = $rowCart["Artwork_ID"];
    $purchasePrice = $rowCart["total_price"];

    $sqlInsert = "INSERT INTO purchase (purchase_price, method_id, p_email, purchase_date, p_status, p_country, Artwork_ID)
                      VALUES ('$purchasePrice', '$methodId', '$pEmail', '$purchaseDate', '$pStatus', '$country', '$artworkId')";

    // Execute the insert query
    $conn->query($sqlInsert);
  }

  // Now, you can delete the cart rows
  $sqlDeleteCart = "DELETE FROM cart";
  $conn->query($sqlDeleteCart);

  

  // You may also redirect the user to a confirmation page or perform any other necessary actions.
}

?>

<link href="./assets/css/main.min.css" type="text/css" rel="stylesheet">
</head>

<body>

  <div class="container mt-5">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="row">
        <div class="col-md-8">
          <!-- Customer Information -->
          <div class="card">
            <div class="card-header">
              <h3 style="color: black;">Pay With</h3>
            </div>
            <div class="card-body">
              <!-- Top Row with Two Options in One Row -->
              <div class="form-row mb-3 d-flex justify-content-center">
                <div class="col-md-6 mb-3 text-center">
                  <button type="button" class="btn btn-primary btn-block" style="width: 80%" onclick="showCardDetails()">Card</button>
                </div>
                <div class="col-md-6 mb-3 text-center">
                  <button type="button" class="btn btn-primary btn-block" style="width: 80%" onclick="showPayoneerDetails()">Payoneer</button>
                </div>
              </div>

              <!-- Card Details -->
              <div id="cardDetails" style="display: none;">
                <div class="form-group">
                  <label for="cardName">Name on Card:</label>
                  <input type="text" class="form-control" id="cardName" name="cardName" >
                </div>
                <div class="form-group">
                  <label for="cardNumber">Card Information:</label>
                  <input type="text" class="form-control" id="cardNumber" name="cardNumber" >
                </div>
                <div class="form-row mb-3 d-flex justify-content-center">
                  <div class="form-group col-md-6">
                    <label for="expiryDate">mm/yy:</label>
                    <input type="text" class="form-control" style="width: 80%" id="expiryDate" name="expiryDate">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="cvc">CVC:</label>
                    <input type="text" class="form-control" style="width: 80%" id="cvc" name="cvc">
                  </div>
                </div>
              </div>

              <!-- Contact Information -->
              <div class="form-group mt-4 mb-4">
                <hr style="border-top: 1px solid black;">
                <h3 style="color: black;">Contact Information</h3>
              </div>
              <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" class="form-control" id="country" name="country" required>
              </div>

              <!-- Add other relevant fields based on the selected option -->
              <!-- ... (Additional fields) ... -->
              <div class="mb-3"></div>

              <input type="hidden" name="payment_method" id="paymentMethod" value="Card">

              <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <!-- Order Summary -->
          <div class="card">
            <div class="card-header">
              <h3 style="color: black;">Order Summary</h3>
            </div>
            <div class="card-body">
              <!-- List of ordered items with prices and delete button -->
              <ul class="list-group">
                <?php
                $totalPrice = 0; // Initialize total price variable

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo '<li class="list-group-item">' . $row['a_name'] . ' - $' . $row['a_price'] . '
                                    <button type="button" class="btn btn-danger btn-sm float-right" onclick="deleteCartItem(' . $row['CART_ID'] . ')">Delete</button>
                                    </li>';
                    $totalPrice += $row['a_price'];
                  }
                } else {
                  echo '<li class="list-group-item">No items in the cart</li>';
                }
                ?>
              </ul>
              <div class="mb-3"></div>
              <hr>
              <p>Total Price: $<?php echo $totalPrice; ?></p>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

  <script>
    function showCardDetails() {
      document.getElementById("cardDetails").style.display = "block";
      document.getElementById("paymentMethod").value = "Card";
    }

    function showPayoneerDetails() {
      document.getElementById("cardDetails").style.display = "none";
      document.getElementById("paymentMethod").value = "Payoneer";
    }

    function deleteCartItem(cartId) {
      // Send an AJAX request to deleteCartItem.php
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Handle the response, e.g., refresh the cart content
          alert('Item with Cart ID ' + cartId + ' has been deleted.');
          location.reload(); // Reload the page for simplicity
        }
      };
      xhr.open('GET', 'controller/deleteCartItem.php?cartId=' + cartId, true);
      xhr.send();
    }

    // Function to show a thank you message and redirect to download page
    function showThankYouMessage() {
      alert('Thank you for your purchase!');
      // Redirect to the download page
      location.reload();
      // window.location.href = 'download.php?email=' + document.getElementById("email").value;
    }

    // Attach the function to the form submission
    document.querySelector('form').addEventListener('submit', function(event) {
      // You can perform any additional validation here before showing the thank-you message
      showThankYouMessage();
    });
  </script>

  <?php include 'include/footer.php'; ?>

</body>

</html>

<?php
// Close the database connection
$conn->close();
?>
