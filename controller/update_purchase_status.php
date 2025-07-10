<?php
include_once "../config/dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["purchaseId"]) && isset($_POST["status"])) {
  $purchaseId = $_POST["purchaseId"];
  $status = $_POST["status"];

  $sql = "UPDATE purchase SET p_status = '$status' WHERE Purchase_ID = $purchaseId";
  $result = $conn->query($sql);

  if ($result) {
    echo "Update successful";
  } else {
    echo "Update failed";
  }
}
?>
