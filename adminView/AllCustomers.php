  <div>
    <h2>All Customers</h2>
    <table class="table">
      <!-- Table headers -->
      <thead>
        <!-- Header row -->
        <tr>
          <!-- Header cells -->
          <th class="text-center">S.N.</th>
          <th class="text-center">Username</th>
          <th class="text-center">Email</th>
          <th class="text-center">Contact Number</th>
          <th class="text-center">Joining Date</th>
          <th class="text-center" colspan="2">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include_once "../config/dbconnect.php";
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        $count = 1;
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
              <td><?= $count ?></td>
              <td><?= $row["first_name"] ?> <?= $row["last_name"] ?></td>
              <td><?= $row["email"] ?></td>
              <td><?= $row["contact_no"] ?></td>
              <td><?= $row["registered_at"] ?></td>
              <td><button class="btn btn-primary" style="height:40px" onclick="userEditForm('<?= $row['user_id'] ?>')">Edit</button></td>
              <td><button class="btn btn-danger" style="height:40px" onclick="userDelete('<?= $row['user_id'] ?>')">Delete</button></td>
            </tr>
        <?php
            $count = $count + 1;
          }
        }
        ?>
      </tbody>
    </table>

    
   
  </div>
