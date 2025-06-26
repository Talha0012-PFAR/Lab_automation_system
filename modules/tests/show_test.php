<?php
include("../../includes/header.php");

// Delete logic
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $conn->query("DELETE FROM tests WHERE id = $id");
}

// Fetch all test records
$sql = "SELECT 
          tests.id,
          tests.test_id,
          products.product_name,
          test_types.test_name,
          tests.status,
          tests.tested_by,
          tests.remarks,
          tests.criteria,
          tests.observed_output
        FROM tests
        LEFT JOIN products ON tests.product_id = products.product_id
        LEFT JOIN test_types ON tests.test_type_id = test_types.id
        ORDER BY tests.id DESC";
$result = $conn->query($sql);
?>

<!-- Add Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<!-- Optional CSS to ensure table scrolls well -->
<style>
  .scrollable-table-container {
    overflow-x: auto;
    overflow-y: auto;
    max-height: 600px; /* Adjust height as needed */
  }

  table th, table td {
    white-space: nowrap;
    vertical-align: top;
  }
</style>

<div class="container-fluid page-body-wrapper">
  <?php include("../../includes/sidebar.php"); ?>

  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-center mb-4">All Tests</h4>

              <div class="scrollable-table-container">
                <table class="table table-bordered text-dark w-100">
                  <thead class="table-light">
                    <tr>
                      <th>ID (PK)</th>
                      <th>Test ID</th>
                      <th>Product</th>
                      <th>Test Type</th>
                      <th>Status</th>
                      <th>Tested By</th>
                      <th>Remarks</th>
                      <th>Criteria</th>
                      <th>Observed Output</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        $badgeClass = 'secondary';
                        $icon = '<i class="fas fa-question-circle"></i>';

                        if ($row['status'] === 'Passed') {
                          $badgeClass = 'success';
                          $icon = '<i class="fas fa-check-circle"></i>';
                        } elseif ($row['status'] === 'Failed') {
                          $badgeClass = 'danger';
                          $icon = '<i class="fas fa-times-circle"></i>';
                        } elseif ($row['status'] === 'Pending') {
                          $badgeClass = 'warning';
                          $icon = '<i class="fas fa-hourglass-half"></i>';
                        }
                    ?>
                      <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['test_id']; ?></td>
                        <td><?= $row['product_name']; ?></td>
                        <td><?= $row['test_name']; ?></td>
                        <td><span class="badge bg-<?= $badgeClass ?>"><?= $icon ?> <?= $row['status']; ?></span></td>
                        <td><?= $row['tested_by']; ?></td>
                        <td><?= $row['remarks']; ?></td>
                        <td><?= $row['criteria']; ?></td>
                        <td><?= $row['observed_output']; ?></td>
                        <td>
                          <a href="edit_test.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        </td>
                        <td>
                          <a href="show_test.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this test?')">Delete</a>
                        </td>
                      </tr>
                    <?php
                      }
                    } else {
                      echo "<tr><td colspan='11' class='text-center'>No test records found</td></tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div> <!-- scrollable-table-container -->

            </div> <!-- card-body -->
          </div> <!-- card -->
        </div> <!-- col -->
      </div> <!-- row -->
    </div> <!-- content-wrapper -->
  </div> <!-- main-panel -->
</div> <!-- page-body-wrapper -->

<?php include("../../includes/footer.php"); ?>
