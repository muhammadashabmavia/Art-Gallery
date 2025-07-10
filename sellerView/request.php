<?php
include "../include/header.php";
include_once "../config/dbconnect.php"; // Database connection

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action'], $_GET['id'])) {
    $artwork_id = $_GET['id'];
    $action = $_GET['action'];

    // Determine the status based on the action
    $new_status = ($action == 'approve') ? 'Approved' : 'Rejected';

    $sql = "UPDATE uploadartwork SET a_status = ? WHERE Artwork_ID = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('si', $new_status, $artwork_id);
        if ($stmt->execute()) {
            $message = '<div class="alert alert-success text-center" role="alert">Artwork ' . $new_status . ' successfully!</div>';
        } else {
            $message = '<div class="alert alert-danger text-center" role="alert">There was an error processing the request. Please try again.</div>';
        }
        $stmt->close();
    } else {
        $message = '<div class="alert alert-danger text-center" role="alert">There was an error preparing the query. Please try again.</div>';
    }
}

// Fetching artworks with 'Under Revision' status
$sql = "SELECT * FROM uploadartwork WHERE a_status = 'Under Revision'";
$result = $conn->query($sql);
?>

<div class="container mt-4">
    <h2 class="text-center">Artwork Requests</h2>
    <?php echo $message; ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Artwork Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Category</th>
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Fetch category name using the cat_id from the category table
                    $category_id = $row['Cat_ID'];
                    $category_sql = "SELECT Cat_name FROM category WHERE CAT_ID = '$category_id'";
                    $category_result = $conn->query($category_sql);
                    $category_name = $category_result->fetch_assoc()['Cat_name'];

                    echo "<tr>
                            <td>" . $row['a_name'] . "</td>
                            <td>" . $row['a_price'] . "</td>
                            <td>" . $row['a_decs'] . "</td>
                            <td>" . $category_name . "</td>
                            <td><img src='data:image/jpeg;base64," . base64_encode($row['a_image']) . "' width='100'></td>
                            <td>" . $row['a_status'] . "</td>
                            <td>
                                <a href='?action=approve&id=" . $row['Artwork_ID'] . "' class='btn btn-success'>Approve</a>
                                <a href='?action=reject&id=" . $row['Artwork_ID'] . "' class='btn btn-danger'>Reject</a>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>No requests available.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include "../include/footer.php"; ?>
