<?php
include("../../includes/header.php"); 

// Delete logic
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM test_types WHERE id = $id";
  $result = $conn->query($sql);
}

// Fetch all test types
$sql = "SELECT * FROM test_types";
$result = $conn->query($sql);
?>

<div class="container-fluid page-body-wrapper">
  <?php include("../../includes/sidebar.php"); ?> <!-- Sidebar -->

  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-center mb-4">All Test Types</h4>
              <div class="table-responsive">
                <table class="table table-bordered text-dark">
                  <thead class="table-light">
                    <tr>
                      <th>ID</th>
                      <th>TEST NAME</th>
                      <th>DESCRIPTION</th>
                      <th>EDIT</th>
                      <th>DELETE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                    ?>
                      <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['test_name']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td>
                          <a href="edit_test_type.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        </td>
                        <td>
                          <a href="show_test_type.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this test type?')">Delete</a>
                        </td>
                      </tr>
                    <?php
                      }
                    } else {
                      echo "<tr><td colspan='5' class='text-center'>No test types found</td></tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div> <!-- card-body -->
          </div> <!-- card -->
        </div> <!-- col -->
      </div> <!-- row -->
    </div> <!-- content-wrapper -->
  </div> <!-- main-panel -->
</div> <!-- page-body-wrapper -->

<?php include("../../includes/footer.php"); ?>
